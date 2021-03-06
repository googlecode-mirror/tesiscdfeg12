<?php

/**
 * Ficha filter form base class.
 *
 * @package    cdfeg12
 * @subpackage filter
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFichaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'descripcion'       => new sfWidgetFormFilterInput(),
      'fecha'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'tipo_indicador_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoIndicador'), 'add_empty' => true)),
      'discipulo_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Discipulo'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'descripcion'       => new sfValidatorPass(array('required' => false)),
      'fecha'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'tipo_indicador_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoIndicador'), 'column' => 'id')),
      'discipulo_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Discipulo'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('ficha_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ficha';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'descripcion'       => 'Text',
      'fecha'             => 'Date',
      'tipo_indicador_id' => 'ForeignKey',
      'discipulo_id'      => 'ForeignKey',
    );
  }
}
