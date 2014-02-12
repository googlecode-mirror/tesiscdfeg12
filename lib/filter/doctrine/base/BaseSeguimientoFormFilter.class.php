<?php

/**
 * Seguimiento filter form base class.
 *
 * @package    cdfeg12
 * @subpackage filter
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSeguimientoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'descripcion'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha'                    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'asignacion_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Asignacion'), 'add_empty' => true)),
      'actividad_seguimiento_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ActividadSeguimiento'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'descripcion'              => new sfValidatorPass(array('required' => false)),
      'fecha'                    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'asignacion_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Asignacion'), 'column' => 'id')),
      'actividad_seguimiento_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ActividadSeguimiento'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('seguimiento_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Seguimiento';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'descripcion'              => 'Text',
      'fecha'                    => 'Date',
      'asignacion_id'            => 'ForeignKey',
      'actividad_seguimiento_id' => 'ForeignKey',
    );
  }
}
