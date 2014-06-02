<?php

class TwtTest extends CTestCase
{
    public function testRequestRateLimits()
    {
        $rateLimits = Yii::app()->TwtOrigin->requestRateLimits('search');

        $this->assertArrayHasKey('search',         $rateLimits, 'Invalid Twitter response');
        $this->assertArrayHasKey('/search/tweets', $rateLimits['search'], 'Invalid Twitter response');
        $this->assertArrayHasKey('limit',          $rateLimits['search']['/search/tweets'], 'Invalid Twitter response');
        $this->assertArrayHasKey('remaining',      $rateLimits['search']['/search/tweets'], 'Invalid Twitter response');
        $this->assertArrayHasKey('reset',          $rateLimits['search']['/search/tweets'], 'Invalid Twitter response');

        $this->assertGreaterThan(0, $rateLimits['search']['/search/tweets']['limit'], 'Twitter API empty limit');
    }

    public function testRequestRateLimitsError()
    {
        $this->setExpectedException('Exception');
        Yii::app()->TwtOrigin->requestRateLimits('incorrect+_|value');
    }

    public function testRequestTwitSearch()
    {
        // Get 3 recent twits containing 'twitter' in English
        $result = Yii::app()->TwtOrigin->requestTwitSearch('twitter', false, 'en', 3, 'recent');
        $result = json_decode($result, true);

        $this->assertArrayHasKey('statuses',        $result, 'Invalid Twitter response');
        $this->assertArrayHasKey('search_metadata', $result, 'Invalid Twitter response');

        $statuses = $result['statuses'];
        $this->assertEquals(3, count($statuses));

        $this->assertArrayHasKey('id_str',     $statuses[0]);
        $this->assertArrayHasKey('text',       $statuses[0]);
        $this->assertArrayHasKey('created_at', $statuses[0]);
        $this->assertArrayHasKey('user',       $statuses[0]);
    }
}