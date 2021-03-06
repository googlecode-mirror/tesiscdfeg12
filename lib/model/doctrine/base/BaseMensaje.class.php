<?php

/**
 * BaseMensaje
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $titulo
 * @property integer $estado
 * @property clob $contenido
 * @property integer $tipo_mensaje_id
 * @property integer $discipulo_id
 * @property sfGuardUser $Discipulo
 * @property TipoMensaje $TipoMensaje
 * 
 * @method string      getTitulo()          Returns the current record's "titulo" value
 * @method integer     getEstado()          Returns the current record's "estado" value
 * @method clob        getContenido()       Returns the current record's "contenido" value
 * @method integer     getTipoMensajeId()   Returns the current record's "tipo_mensaje_id" value
 * @method integer     getDiscipuloId()     Returns the current record's "discipulo_id" value
 * @method sfGuardUser getDiscipulo()       Returns the current record's "Discipulo" value
 * @method TipoMensaje getTipoMensaje()     Returns the current record's "TipoMensaje" value
 * @method Mensaje     setTitulo()          Sets the current record's "titulo" value
 * @method Mensaje     setEstado()          Sets the current record's "estado" value
 * @method Mensaje     setContenido()       Sets the current record's "contenido" value
 * @method Mensaje     setTipoMensajeId()   Sets the current record's "tipo_mensaje_id" value
 * @method Mensaje     setDiscipuloId()     Sets the current record's "discipulo_id" value
 * @method Mensaje     setDiscipulo()       Sets the current record's "Discipulo" value
 * @method Mensaje     setTipoMensaje()     Sets the current record's "TipoMensaje" value
 * 
 * @package    cdfeg12
 * @subpackage model
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseMensaje extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('mensaje');
        $this->hasColumn('titulo', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '',
             ));
        $this->hasColumn('estado', 'integer', 1, array(
             'type' => 'integer',
             'length' => 1,
             ));
        $this->hasColumn('contenido', 'clob', null, array(
             'type' => 'clob',
             'notnull' => true,
             ));
        $this->hasColumn('tipo_mensaje_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('discipulo_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as Discipulo', array(
             'local' => 'discipulo_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('TipoMensaje', array(
             'local' => 'tipo_mensaje_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}