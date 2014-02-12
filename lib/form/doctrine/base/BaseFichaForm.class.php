<?php

/**
 * Ficha form base class.
 *
 * @method Ficha getObject() Returns the current form's model object
 *
 * @package    cdfeg12
 * @subpackage form
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFichaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'descripcion'       => new sfWidgetFormTextarea(),
      'fecha'             => new sfWidgetFormDate(),
      'tipo_indicador_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoIndicador'), 'add_empty' => false)),
      'discipulo_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Discipulo'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'descripcion'       => new sfValidatorString(array('required' => false)),
      'fecha'             => new sfValidatorDate(array('required' => false)),
      'tipo_indicador_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoIndicador'))),
      'discipulo_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Discipulo'))),
    ));

    $this->widgetSchema->setNameFormat('ficha[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ficha';
  }

}
