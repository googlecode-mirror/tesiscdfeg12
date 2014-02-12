<?php

/**
 * Meta form.
 *
 * @package    cdfeg12
 * @subpackage form
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MetaForm extends BaseMetaForm {

    public function configure() {
// Definición de elementos del formulario
        $this->widgetSchema['descripcion'] = new sfWidgetFormTextarea(
                        array(),
                        array(
                            'maxlength' => sfConfig::get('app_meta_caracteres_descripcion')
                        )
        );
        $this->widgetSchema['discipulo_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['fecha_cumplir'] = new sfWidgetFormInputText(
                        array(),
                        array(
                            'maxlength' => sfConfig::get('app_digitos_fecha')
                        )
        );
        $this->widgetSchema['titulo'] = new sfWidgetFormInputText(
                        array(),
                        array(
                            'maxlength' => sfConfig::get('app_meta_caracteres_titulo')
                        )
        );
// Validaciones de campos
        $this->validatorSchema['descripcion'] = new sfValidatorString(
                        array(
                            'min_length' => 10,
                            'max_length' => sfConfig::get('app_meta_caracteres_descripcion')),
                        array(
                            'min_length' => 'Descripción muy corta, mínimo %min_length% caracteres',
                            'max_length' => 'Descripción muy larga, máximo %max_length% caracteres')
        );
        $this->validatorSchema['fecha_cumplir'] = new sfValidatorDate(
                        array('required' => true),
                        array('invalid' => '"%value%" no es una fecha válida')
        );
        $this->validatorSchema['titulo'] = new sfValidatorString(
                        array(
                            'min_length' => 10,
                            'max_length' => sfConfig::get('app_meta_caracteres_titulo')),
                        array(
                            'min_length' => 'Título muy corto, mínimo %min_length% caracteres',
                            'max_length' => 'Título muy largo, máximo %max_length% caracteres')
        );
// Textos de ayuda
        $this->widgetSchema->setHelps(array(
            'fecha_cumplir' => 'Defina la fecha para cumplir con la meta'
        ));
// Etiquetas de los campos
        $this->widgetSchema->setLabels(array(
            'titulo' => 'Título',
            'fecha_cumplir' => 'Fecha',
            'descripcion' => 'Descrición'
        ));
        unset($this['estado']);
    }

}
