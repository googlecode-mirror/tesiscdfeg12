<?php

/**
 * Reunion form.
 *
 * @package    cdfeg12
 * @subpackage form
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ReunionForm extends BaseReunionForm {

    public function configure() {
        $this->widgetSchema['asistencias'] = new sfWidgetFormInputText();

        #Widgets
        $this->widgetSchema['celula_id'] = new sfWidgetFormInputText();
        $this->widgetSchema['fecha'] = new sfWidgetFormInputText(
                array(), array(
            'maxlength' => sfConfig::get('app_digitos_fecha')
                )
        );
        #Validators
        $this->validatorSchema['fecha'] = new sfValidatorDate(
                array('required' => true), array('invalid' => '"%value%" no es una fecha válida')
        );
        $this->validatorSchema['asistencias'] = new sfValidatorString(
                array('required' => true)
        );
        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(
                array(
            'model' => 'Reunion',
            'column' => array('fecha', 'celula_id'),
                ), array(
            'invalid' => 'Ya se ha creado una reunión similar'
                ))
        );
        #Ayudas
        $this->widgetSchema->setHelps(array(
            'fecha' => 'Defina la fecha en la que inició la célula'
        ));
        #Etiquetas
//        $this->widgetSchema->setLabels(array(
//            'dias_celula' => 'Días',
//            'horario_celula' => 'Horario'
//        ));
    }

}
