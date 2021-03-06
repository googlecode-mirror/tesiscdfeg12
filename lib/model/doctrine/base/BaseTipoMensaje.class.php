<?php

/**
 * BaseTipoMensaje
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $nombre
 * @property Doctrine_Collection $Indicador
 * 
 * @method string              getNombre()    Returns the current record's "nombre" value
 * @method Doctrine_Collection getIndicador() Returns the current record's "Indicador" collection
 * @method TipoMensaje         setNombre()    Sets the current record's "nombre" value
 * @method TipoMensaje         setIndicador() Sets the current record's "Indicador" collection
 * 
 * @package    cdfeg12
 * @subpackage model
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTipoMensaje extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tipo_mensaje');
        $this->hasColumn('nombre', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Mensaje as Indicador', array(
             'local' => 'id',
             'foreign' => 'tipo_mensaje_id'));
    }
}