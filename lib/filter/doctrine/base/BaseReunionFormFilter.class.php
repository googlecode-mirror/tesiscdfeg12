<?php

/**
 * Reunion filter form base class.
 *
 * @package    cdfeg12
 * @subpackage filter
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseReunionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fecha'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'palabra'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'observaciones' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'celula_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Celula'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'fecha'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'palabra'       => new sfValidatorPass(array('required' => false)),
      'observaciones' => new sfValidatorPass(array('required' => false)),
      'celula_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Celula'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('reunion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Reunion';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'fecha'         => 'Date',
      'palabra'       => 'Text',
      'observaciones' => 'Text',
      'celula_id'     => 'ForeignKey',
    );
  }
}
