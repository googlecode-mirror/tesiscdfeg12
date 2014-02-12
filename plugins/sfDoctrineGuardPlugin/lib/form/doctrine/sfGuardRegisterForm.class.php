<?php

/**
 * sfGuardRegisterForm for registering new users
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: BasesfGuardChangeUserPasswordForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardRegisterForm extends BasesfGuardRegisterForm {

    /**
     * @see sfForm
     */
    public function configure() {
        if (!($this->getOption("currentUser") instanceof sfGuardUser)) {
            throw new InvalidArgumentException("No se ha transmitido el usuario desde la acción!");
        } else {
            $currentUser = $this->getOption("currentUser");
        }

        $maxyear = Date('Y');
        $years = range(1940, $maxyear);
        // Redefinición de tipo de campos

        $this->widgetSchema['direccion'] = new sfWidgetFormTextarea(
                array(), array(
            'maxlength' => sfConfig::get('app_caracteres_direccion')
                )
        );
        $this->widgetSchema['email_address'] = new sfWidgetFormInputText(
                array(), array(
            'maxlength' => sfConfig::get('app_caracteres_correo')
                )
        );
        $this->widgetSchema['est_civil'] = new sfWidgetFormChoice(array(
            'choices' => Doctrine_Core::getTable('Discipulo')->getCivilId()
        ));
        $this->widgetSchema['fecha_nac'] = new sfWidgetFormDate(array(
            'years' => array_combine($years, $years))
        );
        $this->widgetSchema['first_name'] = new sfWidgetFormInputText(
                array(), array(
            'maxlength' => sfConfig::get('app_caracteres_nombre')
                )
        );
        $this->widgetSchema['fotografia'] = new sfWidgetFormInputFile();
        $this->widgetSchema['genero'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['last_name'] = new sfWidgetFormInputText(
                array(), array(
            'maxlength' => sfConfig::get('app_caracteres_apellidos')
                )
        );
        $this->widgetSchema['movil'] = new sfWidgetFormInputText(
                array(), array(
            'maxlength' => sfConfig::get('app_digitos_movil')
                )
        );
        $this->widgetSchema['password'] = new sfWidgetFormInputPassword(
                array(), array(
            'maxlength' => sfConfig::get('app_caracteres_clave'),
            'autocomplete' => 'off'
                )
        );
        $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword(
                array(), array(
            'maxlength' => sfConfig::get('app_caracteres_clave'),
            'autocomplete' => 'off'
                )
        );
        $this->widgetSchema['sector_ciudad'] = new sfWidgetFormInputText(
                array(), array(
            'maxlength' => sfConfig::get('app_caracteres_sector')
                )
        );
        $this->widgetSchema['telefono'] = new sfWidgetFormInputText(
                array(), array(
            'maxlength' => sfConfig::get('app_digitos_telefono')
                )
        );
        $this->widgetSchema['username'] = new sfWidgetFormInputText(
                array(), array(
            'maxlength' => sfConfig::get('app_caracteres_usuario'),
            'autocomplete' => 'off'
                )
        );
        // Lista de validaciones
        $this->validatorSchema['direccion'] = new sfValidatorString(
                array(
            'min_length' => 10,
            'max_length' => sfConfig::get('app_caracteres_direccion')), array(
            'min_length' => '"%value%" muy pequeño, mínimo %min_length% caracteres',
            'max_length' => '"%value%" muy largo, máximo %max_length% caracteres')
        );
        $this->validatorSchema['email_address'] = new sfValidatorAnd(array(
            $this->validatorSchema['email_address'],
            new sfValidatorEmail(
                    array(
                'min_length' => 8,
                'max_length' => sfConfig::get('app_caracteres_correo')
                    ), array(
                'min_length' => '"%value%" muy pequeño, mínimo %min_length% caracteres',
                'max_length' => '"%value%" muy largo, máximo %max_length% caracteres',
                'invalid' => '"%value%" no es una dirección de correo electrónico')
            )
        ));
        $this->validatorSchema['est_civil'] = new sfValidatorChoice(array(
            'choices' => Doctrine_Core::getTable('Discipulo')->getCivil()
        ));
        $this->validatorSchema['fotografia'] = new sfValidatorFile(array(
            'required' => false,
            'path' => sfConfig::get('sf_upload_dir') . '/discipulos',
            'mime_types' => 'web_images',
        ));
        $this->validatorSchema['genero'] = new sfValidatorChoice(array(
            'choices' => array($currentUser->getGenero() => $currentUser->getGenero()),
        ));
        $this->validatorSchema['movil'] = new sfValidatorNumber(
                array('required' => false), array('invalid' => '"%value%" no es un número')
        );
        $this->validatorSchema['movil'] = new sfValidatorAnd(array(
            $this->validatorSchema['movil'],
            new sfValidatorString(
                    array(
                'min_length' => sfConfig::get('app_digitos_movil') - 1,
                'max_length' => sfConfig::get('app_digitos_movil')), array(
                'min_length' => '"%value%" muy pequeño, mínimo %min_length% caracteres',
                'max_length' => '"%value%" muy largo, máximo %max_length% caracteres')
            )
        ));
        $this->validatorSchema['password'] = new sfValidatorAnd(array(
            $this->validatorSchema['password'],
            new sfValidatorString(
                    array(
                'min_length' => 5,
                'max_length' => sfConfig::get('caracteres_clave')), array(
                'min_length' => 'Valor ingresado es muy pequeño, mínimo %min_length% caracteres',
                'max_length' => 'Valor ingresado es muy largo, máximo %max_length% caracteres')
            )
        ));
        $this->validatorSchema['password_again'] = new sfValidatorAnd(array(
            $this->validatorSchema['password_again'],
            new sfValidatorString(
                    array(
                'min_length' => 5,
                'max_length' => sfConfig::get('caracteres_clave')), array(
                'min_length' => 'Valor ingresado es muy pequeño, mínimo %min_length% caracteres',
                'max_length' => 'Valor ingresado es muy largo, máximo %max_length% caracteres')
            )
        ));
        $this->validatorSchema['sector_ciudad'] = new sfValidatorString(
                array(
            'min_length' => 2,
            'max_length' => 100), array(
            'min_length' => '"%value%" muy pequeño, mínimo %min_length% caracteres',
            'max_length' => '"%value%" muy largo, máximo %max_length% caracteres')
        );
        $this->validatorSchema['telefono'] = new sfValidatorNumber(
                array('required' => false), array('invalid' => '"%value%" no es un número')
        );
        $this->validatorSchema['telefono'] = new sfValidatorAnd(array(
            $this->validatorSchema['telefono'],
            new sfValidatorString(
                    array(
                'min_length' => sfConfig::get('app_digitos_telefono') - 1,
                'max_length' => sfConfig::get('app_digitos_telefono')), array(
                'min_length' => '"%value%" muy pequeño, mínimo %min_length% caracteres',
                'max_length' => '"%value%" muy largo, máximo %max_length% caracteres')
            )
        ));
        $this->validatorSchema['username'] = new sfValidatorAnd(array(
            $this->validatorSchema['username'],
            new sfValidatorString(
                    array(
                'min_length' => 5,
                'max_length' => 25), array(
                'min_length' => '"%value%" muy pequeño, mínimo %min_length% caracteres',
                'max_length' => '"%value%" muy largo, máximo %max_length% caracteres')
            )
        ));

        // Textos de ayuda bajo los campos del formulario
        $this->widgetSchema->setHelp('fecha_nac', 'Use el formato mm/dd/AAAA');
        $this->widgetSchema->setHelp('telefono', 'Ej. 022123123 para la cidudad de quito');
        $this->widgetSchema->setHelp('movil', 'Ej. 0989123123');
        $this->widgetSchema->setHelp('sector_ciudad', 'Ej. Centro, Sur, Inca, Cumbayá');

        //Etiquetas de los campos
        $this->widgetSchema->setLabels(array(
            'first_name' => 'Nombres',
            'last_name' => 'Apellidos',
            'email_address' => 'Correo electrónico',
            'username' => 'Usuario',
            'genero' => 'Género',
            'fecha_nac' => 'Fecha de nacimiento',
            'est_civil' => 'Estado Civil',
            'direccion' => 'Dirección',
            'telefono' => 'Teléfono',
            'movil' => 'Celular',
            'sector_ciudad' => 'Sector',
            'password' => 'Clave',
            'password_again' => 'Confirmar clave'
        ));
        //Ocultando campos
        unset($this['codigo_lider_cdfe'], $this['tipo_discipulo']);
    }

}
