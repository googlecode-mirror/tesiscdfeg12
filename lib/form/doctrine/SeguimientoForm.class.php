<?php

/**
 * Seguimiento form.
 *
 * @package    cdfeg12
 * @subpackage form
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SeguimientoForm extends BaseSeguimientoForm {

    public function configure() {
        $this->widgetSchema['asignacion_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['descripcion'] = new sfWidgetFormTextarea(
                        array(),
                        array(
                            'maxlength' => sfConfig::get('app_caracteres_descripcion')
                        )
        );
        $this->widgetSchema['fecha'] = new sfWidgetFormInputText(
                        array(),
                        array(
                            'maxlength' => sfConfig::get('app_digitos_fecha')
                        )
        );
        $this->validatorSchema['asignacion_id'] = new sfValidatorAnd(array(
                    new sfValidatorDoctrineChoice(
                            array(
                                'model' => $this->getRelatedModelName('Asignacion')
                    )),
                    new sfValidatorNumber(
                            array('required' => true),
                            array(
                                'invalid' => '"%value%" no es un Id válido',
                                'required' => 'Discípulo: el campo es obligatorio'
                                )
                    )
                ));
        $this->validatorSchema['descripcion'] = new sfValidatorAnd(array(
                    $this->validatorSchema['descripcion'],
                    new sfValidatorString(
                            array(
                                'min_length' => 10,
                                'max_length' => sfConfig::get('app_caracteres_descripcion')),
                            array(
                                'min_length' => 'Descripción muy corta, mínimo %min_length% caracteres',
                                'max_length' => 'Descripción muy larga, máximo %max_length% caracteres')
                    )
                ));
        $this->validatorSchema['fecha'] = new sfValidatorDate(
                        array(),
                        array('invalid' => '"%value%" no es una fecha válida')
        );
    }

}
