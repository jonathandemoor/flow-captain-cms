<?php

class m130202_184204_tbl_pages extends CDbMigration
{
	public function safeUp()
	{
		// Create the table
        $this->createTable('tbl_pages', array(
			'id'						=> 'pk',
			'name'						=> 'string not null',
            'created_on'				=> 'int',
            'created_by'				=> 'string',
            'updated_on'				=> 'int',
            'updated_by'				=> 'string',
        ));
	}

	public function safeDown()
	{
		// Drop the table
        $this->dropTable('tbl_pages');
	}
}