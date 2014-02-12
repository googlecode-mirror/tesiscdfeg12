<?php

/**
 * Evento form.
 *
 * @package    cdfeg12
 * @subpackage form
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EventoForm extends BaseEventoForm
{
  public function configure() {
      $this->widgetSchema['fecha_hora'] = new sfWidgetFormInputText();
  }
}
