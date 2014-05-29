<?php

class Twt extends CApplicationComponent
{

    /**
     * Config
     * @var string
     */
    public $config;

    private $apiKey;
    private $apiSecret;
    private $accessToken;

    /**
     * Initialize the extension
     */
    public function init()
    {
        $this->apiKey    = $this->config['api_key'];
        $this->apiSecret = $this->config['api_secret'];
    }

    protected function requestAccessToken()
    {
        $bearer_token = base64_encode($this->apiKey . ':' . $this->apiSecret);

        # Getting access token for further queries
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.twitter.com/oauth2/token');
        curl_setopt($curl, CURLOPT_HEADER, 0); //выводим заголовки
        curl_setopt($curl, CURLOPT_POST, 1); //передача данных методом POST
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //теперь curl вернет нам ответ, а не выведет
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . $bearer_token,
            'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
        $res = curl_exec($curl);

        if(!$res) {
            $error = curl_error($curl).'('.curl_errno($curl).')';
            curl_close($curl);
            return false;
        }
        curl_close($curl);

        $ans = json_decode($res, true);
        if (isset($ans['access_token'])) {
            $this->accessToken = $ans['access_token'];
            return true;
        } else {
            return false;
        }
    }

    public function requestRateLimits($resources = 'search')
    {
        $this->requestAccessToken();

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.twitter.com/1.1/application/rate_limit_status.json?resources=' . $resources);
        curl_setopt($curl, CURLOPT_HEADER, 0); //выводим заголовки
        curl_setopt($curl, CURLOPT_POST, 0); //передача данных методом POST
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //теперь curl вернет нам ответ, а не выведет
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $this->accessToken,
        ));
        $res = curl_exec($curl);

        if(!$res) {
            $error = curl_error($curl).'('.curl_errno($curl).')';
            echo $error;
            die;
        }
        else {
            $ans = json_decode($res, true);
        }
        curl_close($curl);

        return $ans['resources'];
    }

    public function requestTwitSearch($query, $max_id = false, $lang = 'en', $count = 100, $result_type = 'recent', $include_entities = false)
    {
        $this->requestAccessToken();

        $options = [
            'q'                => urlencode($query),
            'lang'             => $lang,
            'count'            => $count,
            'result_type'      => $result_type,
            'include_entities' => $include_entities,
        ];

        if ($max_id)
            $options['max_id'] = $max_id;


        # Getting twitter feed
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.twitter.com/1.1/search/tweets.json?' . http_build_query($options));
        curl_setopt($curl, CURLOPT_HEADER, 0); //выводим заголовки
        curl_setopt($curl, CURLOPT_POST, 0); //передача данных методом POST
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //теперь curl вернет нам ответ, а не выведет
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $this->accessToken,
        ));
        $res = curl_exec($curl);

        if(!$res) {
            $error = curl_error($curl).'('.curl_errno($curl).')';
            echo $error;
            die;
        }
        else {
            $ans = json_decode($res, true);
        }
        curl_close($curl);
        return $res;
    }
}//end of method