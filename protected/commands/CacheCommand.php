<?php

class CacheCommand extends CConsoleCommand
{
	public function actionIndex()
	{
		$data = Yii::app()->TwitterData->getCacheList();

		if (count($data)) {
			foreach ($data as $key => $cacheEntry) {
				echo ' Entry #' . $key . ": \t" . count(json_decode($cacheEntry['response'])) . ' words for ' . $cacheEntry['keyword'] . PHP_EOL;
			}
		} else {
			echo ' Cache is empty.' . PHP_EOL;
		}

		// var_dump($data);

		echo PHP_EOL;
		echo 'To delete cache entry use: ' . PHP_EOL;
		echo '       ./yiic cache delete --num=<Entry #>';
		echo PHP_EOL;
		echo PHP_EOL;
	}

	public function actionDelete($num)
	{
		echo ' Rows affected: ';
		echo Yii::app()->TwitterData->deleteCacheEntry($num);
		echo PHP_EOL;
		echo PHP_EOL;
	}
}