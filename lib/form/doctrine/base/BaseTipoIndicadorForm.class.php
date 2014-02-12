<?php

/**
 * TipoIndicador form base class.
 *
 * @method TipoIndicador getObject() Returns the current form's model object
 *
 * @package    cdfeg12
 * @subpackage form
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTipoIndicadorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'indicador'      => new sfWidgetFormInputText(),
      'tipo_discipulo' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'indicador'      => new sfValidatorString(array('max_length' => 100)),
      'tipo_discipulo' => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('tipo_indicador[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoIndicador';
  }

}
