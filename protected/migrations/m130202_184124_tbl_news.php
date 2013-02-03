<?php

class m130202_184124_tbl_news extends CDbMigration
{
	public function safeUp()
	{
		// Create the table
        $this->createTable('tbl_news', array(
			'id'						=> 'pk',
			'title'						=> 'string not null',
			'content'					=> 'text not null',
			'content_short'				=> 'string',
			'date'						=> 'int',
            'created_on'				=> 'int',
            'created_by'				=> 'string',
            'updated_on'				=> 'int',
            'updated_by'				=> 'string',
        ));
	}

	public function safeDown()
	{
		// Drop the table
        $this->dropTable('tbl_news');
	}
}