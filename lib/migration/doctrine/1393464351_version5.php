<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version5 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->dropTable('sf_guard_user');
        $this->changeColumn('reunion', 'observaciones', 'clob', '', array(
             'notnull' => '',
             ));
    }

    public function down()
    {
        $this->createTable('sf_guard_user', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'autoincrement' => '1',
              'primary' => '1',
             ),
             'first_name' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'length' => '255',
             ),
             'last_name' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'length' => '255',
             ),
             'email_address' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'unique' => '1',
              'length' => '255',
             ),
             'fecha_nac' => 
             array(
              'type' => 'timestamp',
              'notnull' => '1',
              'length' => '25',
             ),
             'est_civil' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'length' => '15',
             ),
             'fotografia' => 
             array(
              'type' => 'string',
              'notnull' => '',
              'default' => '',
              'length' => '255',
             ),
             'genero' => 
             array(
              'type' => 'integer',
              'notnull' => '1',
              'length' => '2',
             ),
             'tipo_discipulo' => 
             array(
              'type' => 'integer',
              'notnull' => '1',
              'length' => '2',
             ),
             'codigo_lider_cdfe' => 
             array(
              'type' => 'string',
              'fixed' => '1',
              'notnull' => '',
              'length' => '10',
             ),
             'direccion' => 
             array(
              'type' => 'clob',
              'notnull' => '1',
              'length' => '',
             ),
             'telefono' => 
             array(
              'type' => 'string',
              'notnull' => '',
              'length' => '12',
             ),
             'movil' => 
             array(
              'type' => 'string',
              'fixed' => '1',
              'notnull' => '',
              'length' => '12',
             ),
             'sector_ciudad' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'length' => '100',
             ),
             'username' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'unique' => '1',
              'length' => '128',
             ),
             'algorithm' => 
             array(
              'type' => 'string',
              'default' => 'sha1',
              'notnull' => '1',
              'length' => '128',
             ),
             'salt' => 
             array(
              'type' => 'string',
              'length' => '128',
             ),
             'password' => 
             array(
              'type' => 'string',
              'length' => '128',
             ),
             'is_active' => 
             array(
              'type' => 'boolean',
              'default' => '0',
              'length' => '25',
             ),
             'is_super_admin' => 
             array(
              'type' => 'boolean',
              'default' => '0',
              'length' => '25',
             ),
             'last_login' => 
             array(
              'type' => 'timestamp',
              'length' => '25',
             ),
             'created_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             'updated_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             ), array(
             'type' => '',
             'indexes' => 
             array(
              'is_active_idx' => 
              array(
              'fields' => 
              array(
               0 => 'is_active',
              ),
              ),
             ),
             'primary' => 
             array(
              0 => 'id',
             ),
             'collate' => '',
             'charset' => '',
             ));
    }
}