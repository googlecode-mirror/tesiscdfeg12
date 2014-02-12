<?php

/**
 * Seguimiento form base class.
 *
 * @method Seguimiento getObject() Returns the current form's model object
 *
 * @package    cdfeg12
 * @subpackage form
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSeguimientoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'descripcion'              => new sfWidgetFormTextarea(),
      'fecha'                    => new sfWidgetFormDate(),
      'asignacion_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Asignacion'), 'add_empty' => false)),
      'actividad_seguimiento_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ActividadSeguimiento'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'descripcion'              => new sfValidatorString(),
      'fecha'                    => new sfValidatorDate(),
      'asignacion_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Asignacion'))),
      'actividad_seguimiento_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ActividadSeguimiento'))),
    ));

    $this->widgetSchema->setNameFormat('seguimiento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Seguimiento';
  }

}
