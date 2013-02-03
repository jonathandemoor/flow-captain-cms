<?php

class m130202_191227_tbl_roles extends CDbMigration
{
	public function safeUp()
	{
		// Create the table
        $this->createTable('tbl_roles', array(
			'id'				=> 'pk',
			'name'				=> 'string',
            'created_on'		=> 'int',
            'created_by'		=> 'string',
            'updated_on'		=> 'int',
            'updated_by'		=> 'string',
        ));
	}

	public function safeDown()
	{
		// Drop the table
        $this->dropTable('tbl_roles');
	}
}