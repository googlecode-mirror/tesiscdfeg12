<?php

/**
 * sfGuardUser form.
 *
 * @package    cdfeg12
 * @subpackage form
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserForm extends PluginsfGuardUserForm {

    public function configure() {

        if (!($this->getOption("currentUser") instanceof sfUser)) {
            throw new InvalidArgumentException("No se ha transmitido el usuario desde la acción!");
        } else {
            $currentUser = $this->getOption("currentUser");
        }
        $maxyear = Date('Y');
        $years = range(1940, $maxyear);
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
            'years' => array_combine($years, $years)
        ));
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
            'maxlength' => sfConfig::get('app_caracteres_clave')
                )
        );
        $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword(
                array(), array(
            'maxlength' => sfConfig::get('app_caracteres_clave')
                )
        );
        $this->widgetSchema->moveField('password_again', 'after', 'password');
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
        if ($currentUser->hasCredential("admin")) {
            $this->widgetSchema['tipo_discipulo'] = new sfWidgetFormChoice(array(
                'choices' => Doctrine_Core::getTable('Discipulo')->getTiposId()
            ));
        } else {
            $this->widgetSchema['tipo_discipulo'] = new sfWidgetFormInputHidden();
        }
        $this->widgetSchema['username'] = new sfWidgetFormInputText(
                array(), array(
            'maxlength' => sfConfig::get('app_caracteres_usuario')
                )
        );

        // Validaciones
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
            'choices' => Doctrine_Core::getTable('Discipulo')->getGenero()
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
        $this->validatorSchema['password']->setOption('required', false);
        $this->validatorSchema['password_again'] = clone $this->validatorSchema['password'];
        $this->mergePostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again', array(), array('invalid' => 'Las dos contraseñas deben ser iguales.')));

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
        $this->validatorSchema['tipo_discipulo'] = new sfValidatorChoice(array(
            'choices' => Doctrine_Core::getTable('Discipulo')->getTipos()
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

        // Etiquetas de campos
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
            'password_again' => 'Confirmar clave',
            'is_active' => 'Activo',
            'is_super_admin' => 'Administrador',
            'tipo_discipulo' => 'Tipo',
            'fotografia' => 'Fotografía',
            'codigo_lider_cdfe' => 'Código líder CDFE',
            'groups_list' => 'Lista de grupos',
            'permissions_list' => 'Lista de permisos'
        ));

        if (!$currentUser->hasCredential("admin")) {
            unset($this['groups_list'], $this['permissions_list'], $this['is_active'], $this['is_super_admin']);
        }
        // Deshabilitando campos no usados
        unset($this['algorithm'], $this['salt'], $this['created_at'], $this['updated_at'], $this['last_login']);
    }

}
