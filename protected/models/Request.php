<?php

/**
 * Request table class.
 */
class Request extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'tbl_request';
    }
}
