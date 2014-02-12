<?php

/**
 * MiembroCelula form base class.
 *
 * @method MiembroCelula getObject() Returns the current form's model object
 *
 * @package    cdfeg12
 * @subpackage form
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMiembroCelulaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'celula_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Celula'), 'add_empty' => false)),
      'discipulo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Discipulo'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'celula_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Celula'))),
      'discipulo_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Discipulo'))),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'MiembroCelula', 'column' => array('celula_id', 'discipulo_id')))
    );

    $this->widgetSchema->setNameFormat('miembro_celula[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MiembroCelula';
  }

}
