<?php

/**
 * Celula form base class.
 *
 * @method Celula getObject() Returns the current form's model object
 *
 * @package    cdfeg12
 * @subpackage form
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCelulaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'fecha'              => new sfWidgetFormDate(),
      'dias_celula'        => new sfWidgetFormInputText(),
      'horario_celula'     => new sfWidgetFormTime(),
      'discipulo_lider_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lider'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'fecha'              => new sfValidatorDate(),
      'dias_celula'        => new sfValidatorString(array('max_length' => 45)),
      'horario_celula'     => new sfValidatorTime(),
      'discipulo_lider_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lider'))),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Celula', 'column' => array('discipulo_lider_id')))
    );

    $this->widgetSchema->setNameFormat('celula[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Celula';
  }

}
