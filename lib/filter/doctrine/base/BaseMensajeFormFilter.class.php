<?php

/**
 * Mensaje filter form base class.
 *
 * @package    cdfeg12
 * @subpackage filter
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMensajeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'titulo'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'estado'          => new sfWidgetFormFilterInput(),
      'contenido'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo_mensaje_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoMensaje'), 'add_empty' => true)),
      'discipulo_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Discipulo'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'titulo'          => new sfValidatorPass(array('required' => false)),
      'estado'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'contenido'       => new sfValidatorPass(array('required' => false)),
      'tipo_mensaje_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoMensaje'), 'column' => 'id')),
      'discipulo_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Discipulo'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('mensaje_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mensaje';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'titulo'          => 'Text',
      'estado'          => 'Number',
      'contenido'       => 'Text',
      'tipo_mensaje_id' => 'ForeignKey',
      'discipulo_id'    => 'ForeignKey',
    );
  }
}
