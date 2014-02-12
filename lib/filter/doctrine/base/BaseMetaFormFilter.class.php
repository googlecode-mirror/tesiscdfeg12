<?php

/**
 * Meta filter form base class.
 *
 * @package    cdfeg12
 * @subpackage filter
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMetaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'titulo'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_cumplir' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'estado'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'discipulo_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Discipulo'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'titulo'        => new sfValidatorPass(array('required' => false)),
      'fecha_cumplir' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'estado'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'descripcion'   => new sfValidatorPass(array('required' => false)),
      'discipulo_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Discipulo'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('meta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Meta';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'titulo'        => 'Text',
      'fecha_cumplir' => 'Date',
      'estado'        => 'Number',
      'descripcion'   => 'Text',
      'discipulo_id'  => 'ForeignKey',
    );
  }
}
