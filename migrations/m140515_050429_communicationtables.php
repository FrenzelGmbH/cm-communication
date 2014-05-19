<?php

/**
 * The migration script for the communication
 * @author Philipp Frenzel <philipp@frenzel.net>
 * @copyright Frenzel GmbH
 * @version 1.0
 */

use yii\db\Schema;

class m140515_050429_communicationtables extends \yii\db\Migration
{
	public function up()
	{
    
    switch (Yii::$app->db->driverName) {
      case 'mysql':
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        break;
      case 'pgsql':
        $tableOptions = null;
        break;
      default:
        throw new RuntimeException('Your database is not supported!');
    }

		$this->createTable('{{%communication}}',[
      'id'                => Schema::TYPE_PK,
      'mobile'            => Schema::TYPE_STRING .'(200)',
      'phone'             => Schema::TYPE_STRING .'(200)',
      'fax'               => Schema::TYPE_STRING .'(200)',
      'email'             => Schema::TYPE_STRING .'(200)',
      //possible reference to user
      'user_id'           => Schema::TYPE_INTEGER.' NULL',
      //module fields
      'mod_table'         => Schema::TYPE_STRING .'(100)',
      'mod_id'            => Schema::TYPE_INTEGER.' NULL',
      //interface fields
      'system_key'        => Schema::TYPE_STRING .'(100)',
      'system_name'       => Schema::TYPE_STRING .'(100)',
      'system_upate'      => Schema::TYPE_INTEGER.' DEFAULT NULL',
      // timestamps
      'created_at'        => Schema::TYPE_INTEGER . ' NOT NULL',
      'updated_at'        => Schema::TYPE_INTEGER . ' NOT NULL',
      'deleted_at'        => Schema::TYPE_INTEGER . ' DEFAULT NULL',
      //Foreign Keys
      'communication_type_id' => Schema::TYPE_INTEGER,      
    ],$tableOptions);

    $this->createTable('{{%communication_type}}',[
      'id'                => Schema::TYPE_PK,
      'name'              => Schema::TYPE_STRING .'(100)',
      //possible reference to user
      'user_id'           => Schema::TYPE_INTEGER.' NULL',
      //interface fields
      'system_key'        => Schema::TYPE_STRING .'(100)',
      'system_name'       => Schema::TYPE_STRING .'(100)',
      'system_upate'      => Schema::TYPE_INTEGER.' DEFAULT NULL',
      // timestamps
      'created_at'        => Schema::TYPE_INTEGER . ' NOT NULL',
      'updated_at'        => Schema::TYPE_INTEGER . ' NOT NULL',
      'deleted_at'        => Schema::TYPE_INTEGER . ' DEFAULT NULL'
    ],$tableOptions);

    $this->addForeignKey('fk_communication_communication_type', '{{%communication}}', 'communication_type_id', '{{%communication_type}}', 'id', 'CASCADE', 'RESTRICT');

	}

	public function down()
	{
		//drop FK's first
    $this->dropForeignKey('fk_communication_communication_type', '{{%communication}}');

    $this->dropTable('{{%communication_type}}');
		$this->dropTable('{{%communication}}');
	}
}
