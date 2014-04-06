<?php

/**
 * MiembroCelula form.
 *
 * @package    cdfeg12
 * @subpackage form
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MiembroCelulaForm extends BaseMiembroCelulaForm {

    public function configure() {
		$this->widgetSchema['discipulo_id'] = new sfWidgetFormInputHidden();
		$this->widgetSchema['celula_id']    = new sfWidgetFormInputHidden();
    }

}
