<?php

/**
 * Asignacion form base class.
 *
 * @method Asignacion getObject() Returns the current form's model object
 *
 * @package    cdfeg12
 * @subpackage form
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAsignacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'fecha'              => new sfWidgetFormDate(),
      'discipulo_lider_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Asignacion'), 'add_empty' => false)),
      'discipulo_nuevo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DiscipuloNuevo'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'fecha'              => new sfValidatorDate(),
      'discipulo_lider_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Asignacion'))),
      'discipulo_nuevo_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DiscipuloNuevo'))),
    ));

    $this->widgetSchema->setNameFormat('asignacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Asignacion';
  }

}
