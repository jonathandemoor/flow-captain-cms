<?php

class m130202_184147_tbl_content_blocks extends CDbMigration
{
	public function safeUp()
	{
		// Create the table
        $this->createTable('tbl_content_blocks', array(
			'id'						=> 'pk',
			'name'						=> 'string not null',
			'page_id'					=> 'int',
			'title'						=> 'string',
			'content'					=> 'text',
			'content_short'				=> 'string',
            'created_on'				=> 'int',
            'created_by'				=> 'string',
            'updated_on'				=> 'int',
            'updated_by'				=> 'string',
        ));
	}

	public function safeDown()
	{
		// Drop the table
        $this->dropTable('tbl_content_blocks');
	}
}