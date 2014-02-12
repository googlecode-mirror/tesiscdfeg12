<?php

/**
 * Celula form.
 *
 * @package    cdfeg12
 * @subpackage form
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CelulaForm extends BaseCelulaForm {

    public function configure() {
        $this->widgetSchema['dias_celula'] = new sfWidgetFormChoice(array(
                    'choices' => Doctrine_Core::getTable('celula')->getDias()
                ));
        $this->widgetSchema['discipulo_lider_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['fecha'] = new sfWidgetFormInputText(
                        array(),
                        array(
                            'maxlength' => sfConfig::get('app_digitos_fecha')
                        )
        );
        $this->widgetSchema['horario_celula'] = new sfWidgetFormTime(array(
                    'can_be_empty' => false,
                    'hours' => Utilitarios::generarRangoHorario(7, 21),
                    'minutes' => Utilitarios::generarRangoHorario(0, 59, 15)
                ));
        $this->validatorSchema['fecha'] = new sfValidatorDate(
                        array('required' => true),
                        array('invalid' => '"%value%" no es una fecha válida')
        );
        $this->validatorSchema['horario_celula'] = new sfValidatorTime(
                        array('required' => true),
                        array('invalid' => '"%value%" no es una hora válida')
        );
        $this->widgetSchema->setHelps(array(
            'fecha' => 'Defina la fecha en la que inició la célula',
            'horario_celula' => 'Use el formato hh:mm de 24 horas'
        ));
        $this->widgetSchema->setLabels(array(
            'dias_celula' => 'Días',
            'horario_celula' => 'Horario'
        ));
    }

}
