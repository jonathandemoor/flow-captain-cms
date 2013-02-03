<?php

class m130202_184221_tbl_users extends CDbMigration
{
	public function safeUp()
	{
		// Create the table
        $this->createTable('tbl_users', array(
			'id'						=> 'pk',
			'fullname'					=> 'string',
			'password'					=> 'string',
			'email'						=> 'string not null',
			'role_id'					=> 'int',
			'is_active'					=> 'boolean',
            'created_on'				=> 'int',
            'created_by'				=> 'string',
            'updated_on'				=> 'int',
            'updated_by'				=> 'string',
        ));
	}

	public function safeDown()
	{
		// Drop the table
        $this->dropTable('tbl_users');
	}
}