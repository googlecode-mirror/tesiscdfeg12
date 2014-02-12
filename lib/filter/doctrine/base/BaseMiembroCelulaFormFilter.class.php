<?php

/**
 * MiembroCelula filter form base class.
 *
 * @package    cdfeg12
 * @subpackage filter
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMiembroCelulaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'celula_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Celula'), 'add_empty' => true)),
      'discipulo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Discipulo'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'celula_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Celula'), 'column' => 'id')),
      'discipulo_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Discipulo'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('miembro_celula_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MiembroCelula';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'celula_id'    => 'ForeignKey',
      'discipulo_id' => 'ForeignKey',
    );
  }
}
