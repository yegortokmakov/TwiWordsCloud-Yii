<?php

class TwtMock extends \CApplicationComponent
{
    public $config;
    public function init(){}

    public function requestRateLimits($resources = 'search')
    {
        return [
            'search' => [
                '/search/tweets' => [
                    'limit' => 450,
                    'remaining' => 450,
                    'reset' => 1401731688,
                ],
            ],
        ];
    }

    public function requestTwitSearch($query, $max_id = false, $lang = 'en', $count = 100, $result_type = 'recent', $include_entities = false)
    {
        throw new Exception("Not implemented");
    }
}
