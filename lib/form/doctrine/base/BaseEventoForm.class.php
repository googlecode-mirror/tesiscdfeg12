<?php

/**
 * Evento form base class.
 *
 * @method Evento getObject() Returns the current form's model object
 *
 * @package    cdfeg12
 * @subpackage form
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEventoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'titulo'       => new sfWidgetFormTextarea(),
      'fecha_hora'   => new sfWidgetFormDateTime(),
      'lugar'        => new sfWidgetFormTextarea(),
      'descripcion'  => new sfWidgetFormTextarea(),
      'discipulo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Discipulo'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'titulo'       => new sfValidatorString(),
      'fecha_hora'   => new sfValidatorDateTime(),
      'lugar'        => new sfValidatorString(),
      'descripcion'  => new sfValidatorString(),
      'discipulo_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Discipulo'))),
    ));

    $this->widgetSchema->setNameFormat('evento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Evento';
  }

}
