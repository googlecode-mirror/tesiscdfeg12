<?php

/**
 * TipoIndicador filter form base class.
 *
 * @package    cdfeg12
 * @subpackage filter
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTipoIndicadorFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'indicador'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo_discipulo' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'indicador'      => new sfValidatorPass(array('required' => false)),
      'tipo_discipulo' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('tipo_indicador_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoIndicador';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'indicador'      => 'Text',
      'tipo_discipulo' => 'Number',
    );
  }
}
