<?php

/**
 * sfGuardUserAdminForm for admin generators
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardUserAdminForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardUserAdminForm extends BasesfGuardUserAdminForm {

    /**
     * @see sfForm
     */
    public function configure() {
        $maxyear = Date('Y');
        $years = range(1940, $maxyear);
// Definición de campos
        $this->widgetSchema['direccion'] = new sfWidgetFormTextarea(
                        array(),
                        array(
                            'maxlength' => sfConfig::get('app_caracteres_direccion')
                        )
        );
        $this->widgetSchema['email_address'] = new sfWidgetFormInputText(
                        array(),
                        array(
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
                        array(),
                        array(
                            'maxlength' => sfConfig::get('app_caracteres_nombre')
                        )
        );
        $this->widgetSchema['fotografia'] = new sfWidgetFormInputFile();
        $this->widgetSchema['genero'] = new sfWidgetFormChoice(array(
                    'choices' => Doctrine_Core::getTable('Discipulo')->getGeneroId()
                ));
        $this->widgetSchema['last_name'] = new sfWidgetFormInputText(
                        array(),
                        array(
                            'maxlength' => sfConfig::get('app_caracteres_apellidos')
                        )
        );
        $this->widgetSchema['movil'] = new sfWidgetFormInputText(
                        array(),
                        array(
                            'maxlength' => sfConfig::get('app_digitos_movil')
                        )
        );
        $this->widgetSchema['password'] = new sfWidgetFormInputPassword(
                        array(),
                        array(
                            'maxlength' => sfConfig::get('app_caracteres_clave')
                        )
        );
        $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword(
                        array(),
                        array(
                            'maxlength' => sfConfig::get('app_caracteres_clave')
                        )
        );
        $this->widgetSchema['sector_ciudad'] = new sfWidgetFormInputText(
                        array(),
                        array(
                            'maxlength' => sfConfig::get('app_caracteres_sector')
                        )
        );
        $this->widgetSchema['telefono'] = new sfWidgetFormInputText(
                        array(),
                        array(
                            'maxlength' => sfConfig::get('app_digitos_telefono')
                        )
        );
        $this->widgetSchema['tipo_discipulo'] = new sfWidgetFormChoice(array(
                    'choices' => Doctrine_Core::getTable('Discipulo')->getTiposId()
                ));
        $this->widgetSchema['username'] = new sfWidgetFormInputText(
                        array(),
                        array(
                            'maxlength' => sfConfig::get('app_caracteres_usuario')
                        )
        );
// Validaciones de campos
        $this->validatorSchema['direccion'] = new sfValidatorString(
                        array(
                            'min_length' => 10,
                            'max_length' => sfConfig::get('app_caracteres_direccion')),
                        array(
                            'min_length' => '"%value%" muy pequeño, mínimo %min_length% caracteres',
                            'max_length' => '"%value%" muy largo, máximo %max_length% caracteres')
        );
        $this->validatorSchema['email_address'] = new sfValidatorAnd(array(
                    $this->validatorSchema['email_address'],
                    new sfValidatorEmail(
                            array(
                                'min_length' => 8,
                                'max_length' => sfConfig::get('app_caracteres_correo')
                            ),
                            array(
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
                        array('required' => false),
                        array('invalid' => '"%value%" no es un número')
        );
        $this->validatorSchema['movil'] = new sfValidatorAnd(array(
                    $this->validatorSchema['movil'],
                    new sfValidatorString(
                            array(
                                'min_length' => sfConfig::get('app_digitos_movil') - 1,
                                'max_length' => sfConfig::get('app_digitos_movil')),
                            array(
                                'min_length' => '"%value%" muy pequeño, mínimo %min_length% caracteres',
                                'max_length' => '"%value%" muy largo, máximo %max_length% caracteres')
                    )
                ));
        $this->mergePostValidator(new sfValidatorSchemaCompare(
                        'password',
                        sfValidatorSchemaCompare::EQUAL,
                        'password_again',
                        array(),
                        array('invalid' => 'Las dos contraseñas deben ser iguales.')
        ));
        $this->validatorSchema['password']->setOption('required', false);
        $this->validatorSchema['password_again']->setOption('required', false);
        $this->validatorSchema['telefono'] = new sfValidatorNumber(
                        array('required' => false),
                        array('invalid' => '"%value%" no es un número')
        );
        $this->validatorSchema['telefono'] = new sfValidatorAnd(array(
                    $this->validatorSchema['telefono'],
                    new sfValidatorString(
                            array(
                                'min_length' => sfConfig::get('app_digitos_telefono') - 1,
                                'max_length' => sfConfig::get('app_digitos_telefono')),
                            array(
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
                                'max_length' => 25),
                            array(
                                'min_length' => '"%value%" muy pequeño, mínimo %min_length% caracteres',
                                'max_length' => '"%value%" muy largo, máximo %max_length% caracteres')
                    )
                ));
// Textos de ayuda bajo los campos del formulario
        $this->widgetSchema->setHelp('fecha_nac', 'Use el formato mm/dd/AAAA');
        $this->widgetSchema->setHelp('telefono', 'Ej. 022123123 para la cidudad de quito');
        $this->widgetSchema->setHelp('movil', 'Ej. 099123123');
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
    }

}
