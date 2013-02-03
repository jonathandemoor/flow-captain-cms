<?php

class m130202_191255_tbl_contacts extends CDbMigration
{
	public function safeUp()
	{
		// Create the table
        $this->createTable('tbl_contacts', array(
            'id'							=> 'pk',
			'name'							=> 'string',
			'email'							=> 'string',
			'message'						=> 'text',
			'company'						=> 'string',
            'created_on'					=> 'int',
            'created_by'					=> 'string',
            'updated_on'					=> 'int',
            'updated_by'					=> 'string',
        ));
	}

	public function safeDown()
	{
		// Drop the table
        $this->dropTable('tbl_contacts');
	}
}