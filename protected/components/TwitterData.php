<?php

// This component is used for caching Twitter API queries
class TwitterData extends CComponent
{
	public function init()
	{
	}

	protected function clearRatesCache()
	{
		unset(Yii::app()->session['limitSearch']);
	}

	public function getSearchRates()
	{
		if (!isset(Yii::app()->session['limitSearch'])) {
			Yii::app()->session['limitSearch'] = Yii::app()->Twt->requestRateLimits('search')['search']['/search/tweets'];
		}

		return Yii::app()->session['limitSearch'];
	}

	public function getCacheList()
	{
		return Request::model()->findAll();
	}

	public function deleteCacheEntry($key)
	{
		return Request::model()->deleteByPk(['id' => $key]);
	}

	public function getData($keyword, $minCount = 2)
	{
		$keyword = $this->prettyWord($keyword);

		if ($requestCache = Request::model()->find('keyword=:keyword', [':keyword' => $keyword])) {
			$statuses = json_decode($requestCache->response, true);
		} else {
			$twitterResponse = Yii::app()->Twt->requestTwitSearch($keyword);
			list($responseStatuses, $maxId) = $this->prepareStatusId($twitterResponse);
			$statuses = $responseStatuses;

			$twitterResponse = Yii::app()->Twt->requestTwitSearch($keyword, $maxId);
			list($responseStatuses, $maxId) = $this->prepareStatusId($twitterResponse);
			$statuses += $responseStatuses;

			$twitterResponse = Yii::app()->Twt->requestTwitSearch($keyword, $maxId);
			list($responseStatuses, $maxId) = $this->prepareStatusId($twitterResponse);
			$statuses += $responseStatuses;

			$this->clearRatesCache();

			$requestCache = new Request;
			$requestCache->keyword  = $keyword;
			$requestCache->response = json_encode($statuses);
			$requestCache->date     = time();
			$requestCache->save();
		}

		$wordsCount = $this->prepareWordsCount($statuses);
		unset($wordsCount[$keyword]);

		$wordsCount = array_filter($wordsCount, function($element) use ($minCount) {
			return $element >= $minCount;
		});

		return $wordsCount;
	}

	protected function prepareStatusId($data)
	{
		$statuses = json_decode($data, true)['statuses'];
		$min_id = 0;

		foreach ($statuses as $status) {
			if ($min_id == 0) $min_id = $status['id'];
			if ($status['id'] < $min_id) $min_id = $status['id'];
		}

		return [$statuses, $min_id];
	}

	protected function prepareWordsCount($data)
	{
		$words = [];

		foreach ($data as $twit) {
			foreach (explode(' ', $twit['text']) as $word) {
				$word = $this->prettyWord($word);

				if (strlen($word) > 4 && stripos($word, 'http') === false) {
					$words[] = $word;
				}
			}
		}

		$words_count = array_count_values($words);
		arsort($words_count);

		return $words_count;
	}

	protected function prettyWord($word)
	{
		$word = preg_replace("/[^a-zA-Z0-9@]+/", "", $word);
		$word = ucfirst(strtolower($word));

		return $word;
	}
}