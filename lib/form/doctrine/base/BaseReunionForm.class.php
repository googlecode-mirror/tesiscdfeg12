<?php

/**
 * Reunion form base class.
 *
 * @method Reunion getObject() Returns the current form's model object
 *
 * @package    cdfeg12
 * @subpackage form
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseReunionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'fecha'         => new sfWidgetFormDate(),
      'palabra'       => new sfWidgetFormTextarea(),
      'observaciones' => new sfWidgetFormTextarea(),
      'celula_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Celula'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'fecha'         => new sfValidatorDate(),
      'palabra'       => new sfValidatorString(),
      'observaciones' => new sfValidatorString(),
      'celula_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Celula'))),
    ));

    $this->widgetSchema->setNameFormat('reunion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Reunion';
  }

}
