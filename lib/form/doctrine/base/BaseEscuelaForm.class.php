<?php

/**
 * Escuela form base class.
 *
 * @method Escuela getObject() Returns the current form's model object
 *
 * @package    cdfeg12
 * @subpackage form
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEscuelaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'fecha_ingreso' => new sfWidgetFormDateTime(),
      'discipulo_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Discipulo'), 'add_empty' => false)),
      'nivel_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Nivel'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'fecha_ingreso' => new sfValidatorDateTime(),
      'discipulo_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Discipulo'))),
      'nivel_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Nivel'))),
    ));

    $this->widgetSchema->setNameFormat('escuela[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Escuela';
  }

}
