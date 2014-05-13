<?php

class m140317_185518_tbl_news_translations extends CDbMigration
{
	public function up()
	{
		// Create the table
        $this->createTable('tbl_news_translations', array(
			'id'						=> 'pk',
			'news_id'					=> 'int',
			'language'					=> 'string',
			'title'						=> 'string not null',
			'content'					=> 'text not null',
			'content_short'				=> 'string'
        ));
	}

	public function safeDown()
	{
		// Drop the table
        $this->dropTable('tbl_news_translations');
	}
}