<?php

/**
 * Escuela form.
 *
 * @package    cdfeg12
 * @subpackage form
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EscuelaForm extends BaseEscuelaForm {

    public function configure() {
        $this->widgetSchema['discipulo_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['fecha_ingreso'] = new sfWidgetFormInputText(
                        array(),
                        array(
                            'maxlength' => sfConfig::get('app_digitos_fecha')
                        )
        );
        $this->validatorSchema['fecha_ingreso'] = new sfValidatorDate(
                        array('required' => true),
                        array('invalid' => '"%value%" no es una fecha válida')
        );
        $this->widgetSchema->setHelps(array(
            'fecha_ingreso' => 'Defina la fecha en la que inició el nivel'
        ));
        $this->widgetSchema->setLabels(array(
            'fecha_ingreso' => 'Fecha'
        ));
    }

}
