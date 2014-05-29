<?php

class m140526_080133_init_requests_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_request', array(
            'id'       => 'pk',
            'keyword'  => 'text',
            'date'     => 'integer',
            'response' => 'text',
        ));
	}

	public function down()
	{
		$this->dropTable('tbl_request');
	}
}