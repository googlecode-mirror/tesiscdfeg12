<?php

/**
 * Discipulo filter form base class.
 *
 * @package    cdfeg12
 * @subpackage filter
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDiscipuloFormFilter extends sfGuardUserFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('discipulo_filters[%s]');
  }

  public function getModelName()
  {
    return 'Discipulo';
  }
}
