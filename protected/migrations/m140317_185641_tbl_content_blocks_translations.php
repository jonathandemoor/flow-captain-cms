<?php

class m140317_185641_tbl_content_blocks_translations extends CDbMigration
{
	public function up()
	{
		// Create the table
        $this->createTable('tbl_content_blocks_translations', array(
			'id'						=> 'pk',
			'content_blocks_id'			=> 'int',
			'name'						=> 'string not null',
			'title'						=> 'string',
			'content'					=> 'text',
			'content_short'				=> 'string'
        ));
	}

	public function down()
	{
		echo "m140317_185641_tbl_content_blocks_translations does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}