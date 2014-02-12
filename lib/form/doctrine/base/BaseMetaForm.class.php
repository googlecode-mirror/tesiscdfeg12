<?php

/**
 * Meta form base class.
 *
 * @method Meta getObject() Returns the current form's model object
 *
 * @package    cdfeg12
 * @subpackage form
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMetaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'titulo'        => new sfWidgetFormInputText(),
      'fecha_cumplir' => new sfWidgetFormDateTime(),
      'estado'        => new sfWidgetFormInputText(),
      'descripcion'   => new sfWidgetFormTextarea(),
      'discipulo_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Discipulo'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'titulo'        => new sfValidatorString(array('max_length' => 200)),
      'fecha_cumplir' => new sfValidatorDateTime(),
      'estado'        => new sfValidatorInteger(),
      'descripcion'   => new sfValidatorString(),
      'discipulo_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Discipulo'))),
    ));

    $this->widgetSchema->setNameFormat('meta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Meta';
  }

}
