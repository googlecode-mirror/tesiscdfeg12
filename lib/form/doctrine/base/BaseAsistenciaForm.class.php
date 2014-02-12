<?php

/**
 * Asistencia form base class.
 *
 * @method Asistencia getObject() Returns the current form's model object
 *
 * @package    cdfeg12
 * @subpackage form
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAsistenciaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'reunion_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Reunion'), 'add_empty' => false)),
      'miembro_celula_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Miembro'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'reunion_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Reunion'))),
      'miembro_celula_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Miembro'))),
    ));

    $this->widgetSchema->setNameFormat('asistencia[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Asistencia';
  }

}
