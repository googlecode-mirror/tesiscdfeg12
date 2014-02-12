<?php

/**
 * Celula filter form base class.
 *
 * @package    cdfeg12
 * @subpackage filter
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCelulaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fecha'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'dias_celula'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'horario_celula'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'discipulo_lider_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lider'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'fecha'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'dias_celula'        => new sfValidatorPass(array('required' => false)),
      'horario_celula'     => new sfValidatorPass(array('required' => false)),
      'discipulo_lider_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lider'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('celula_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Celula';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'fecha'              => 'Date',
      'dias_celula'        => 'Text',
      'horario_celula'     => 'Text',
      'discipulo_lider_id' => 'ForeignKey',
    );
  }
}
