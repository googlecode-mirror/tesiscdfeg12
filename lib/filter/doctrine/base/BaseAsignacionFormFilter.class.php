<?php

/**
 * Asignacion filter form base class.
 *
 * @package    cdfeg12
 * @subpackage filter
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAsignacionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fecha'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'discipulo_lider_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Asignacion'), 'add_empty' => true)),
      'discipulo_nuevo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DiscipuloNuevo'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'fecha'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'discipulo_lider_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Asignacion'), 'column' => 'id')),
      'discipulo_nuevo_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DiscipuloNuevo'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('asignacion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Asignacion';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'fecha'              => 'Date',
      'discipulo_lider_id' => 'ForeignKey',
      'discipulo_nuevo_id' => 'ForeignKey',
    );
  }
}
