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
        case 'mssql':
          $tableOptions = null;
          break;
        default:
          throw new RuntimeException('Your database is not supported!');
    }

		$this->createTable('{{%net_frenzel_communication}}',[
      'id'                => Schema::TYPE_PK,
      
      //content and content type
      'text'              => Schema::TYPE_STRING .'(200)',
      'type'              => Schema::TYPE_INTEGER . ' DEFAULT 1',
      
      //related to which record
      'entity'            => Schema::TYPE_STRING,
      'entity_id'         => Schema::TYPE_INTEGER . ' NOT NULL',

      //blamable
      'created_by'        => Schema::TYPE_INTEGER . ' NOT NULL',
      'updated_by'        => Schema::TYPE_INTEGER . ' NOT NULL',
      
      // timestamps
      'created_at'        => Schema::TYPE_INTEGER . ' NOT NULL',
      'updated_at'        => Schema::TYPE_INTEGER . ' NOT NULL',
      'deleted_at'        => Schema::TYPE_INTEGER . ' DEFAULT NULL',
      
      //Foreign Keys
    ],$tableOptions);
	}

	public function down()
	{
		$this->dropTable('{{%net_frenzel_communication}}');
	}
}
