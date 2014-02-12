<?php

/**
 * Mensaje form base class.
 *
 * @method Mensaje getObject() Returns the current form's model object
 *
 * @package    cdfeg12
 * @subpackage form
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMensajeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'titulo'          => new sfWidgetFormTextarea(),
      'estado'          => new sfWidgetFormInputText(),
      'contenido'       => new sfWidgetFormTextarea(),
      'tipo_mensaje_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoMensaje'), 'add_empty' => false)),
      'discipulo_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Discipulo'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'titulo'          => new sfValidatorString(),
      'estado'          => new sfValidatorInteger(array('required' => false)),
      'contenido'       => new sfValidatorString(),
      'tipo_mensaje_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoMensaje'))),
      'discipulo_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Discipulo'))),
    ));

    $this->widgetSchema->setNameFormat('mensaje[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mensaje';
  }

}
