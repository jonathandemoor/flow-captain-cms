<?php

class m130202_191318_tbl_projects extends CDbMigration
{
	public function safeUp()
	{
		// Create the table
        $this->createTable('tbl_projects', array(
            'id'							=> 'pk',
			'title'							=> 'string not null',
			'content'						=> 'text',
			'url'							=> 'string',
            'created_on'					=> 'int',
            'created_by'					=> 'string',
            'updated_on'					=> 'int',
            'updated_by'					=> 'string',
        ));
	}

	public function safeDown()
	{
		// Drop the table
        $this->dropTable('tbl_projects');
	}
}