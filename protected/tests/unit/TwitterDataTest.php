<?php

class TwitterDataTest extends CTestCase
{
    public function testGetSearchRates()
    {
        $rateLimits = Yii::app()->TwitterData->getSearchRates();

        $this->assertArrayHasKey('limit',          $rateLimits);
        $this->assertArrayHasKey('remaining',      $rateLimits);
        $this->assertArrayHasKey('reset',          $rateLimits);

        $this->assertEquals(450, $rateLimits['limit']);
        $this->assertEquals(450, $rateLimits['remaining']);
    }
}