<?php

/**
 * Asistencia filter form base class.
 *
 * @package    cdfeg12
 * @subpackage filter
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAsistenciaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'reunion_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Reunion'), 'add_empty' => true)),
      'miembro_celula_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Miembro'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'reunion_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Reunion'), 'column' => 'id')),
      'miembro_celula_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Miembro'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('asistencia_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Asistencia';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'reunion_id'        => 'ForeignKey',
      'miembro_celula_id' => 'ForeignKey',
    );
  }
}
