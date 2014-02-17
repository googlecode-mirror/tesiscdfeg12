<?php

/**
 * asignacion actions.
 *
 * @package    cdfeg12
 * @subpackage asignacion
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class asignacionActions extends sfActions {

    public function executeAsignarNuevos(sfWebRequest $request) {
        $this->tipos = Doctrine_Core::getTable('Discipulo')->getTipos();
        $this->forwardUnless($cadena_ids = $request->getParameter('cadena_ids'), 'asignacion', 'index');
        $cadena_ids = explode('|', $cadena_ids);
        $id_lider = $cadena_ids[0];
        $lista_nuevos = $cadena_ids[1];
        $lista_nuevos = explode('-', $lista_nuevos);
        for ($i = 0; $i < count($lista_nuevos); $i++) {
            $asignacion = new Asignacion();
            $lider = Doctrine_Core::getTable('Discipulo')->find($id_lider);
            $discipulo = Doctrine_Core::getTable('Discipulo')->find($lista_nuevos[$i]);
            if (Doctrine_Core::getTable('Asignacion')->estaAsginado($discipulo->getId(), $lider->getId()) == 0) {
                $actualizacion = $discipulo->actualizaTipo(1);
                if (sfConfig::get('app_envia_mails')) {
                    $mensaje = Swift_Message::newInstance()
                            ->setFrom(sfConfig::get('app_correo_cuenta_salida'), sfConfig::get('app_correo_nombre_salida'))
                            ->setTo($discipulo->getEmailAddress())
                            ->setSubject(sfConfig::get('app_correo_subject_asignacion'))
                            ->setBody($this->getPartial('correoAsignacionDiscipulo', array('discipulo' => $discipulo, 'lider' => $lider)));
                    $correo = $this->getMailer()->send($mensaje);
                    $mensaje = Swift_Message::newInstance()
                            ->setFrom(sfConfig::get('app_correo_cuenta_salida'), sfConfig::get('app_correo_nombre_salida'))
                            ->setTo($lider->getEmailAddress())
                            ->setSubject(sfConfig::get('app_correo_subject_lider'))
                            ->setBody($this->getPartial('correoAsignacionLider', array('discipulo' => $discipulo, 'lider' => $lider)));
                    $correo = $this->getMailer()->send($mensaje);
                    $valida = $this->validaAsignacion($lider, $discipulo, $actualizacion, $correo);
                } else {
                    $valida = $this->validaAsignacion($lider, $discipulo, $actualizacion);
                }

                if ($valida == 'ok') {
                    $asignado = $asignacion->asignarNuevos($id_lider, $lista_nuevos[$i]);
                    if ($asignado == 'ok') {
                        $flash_tipo = 'notice';
                        $flash_msg = 'Se han asignado los discipulos de forma correcta';
                    } else {
                        $flash_tipo = 'error';
                        $flash_msg = 'Ha ocurrido un error al asignar: ' . $asignado;
                    }
                } else {
                    $flash_tipo = 'error';
                    $flash_msg = $valida;
                }
            } else {
                $flash_tipo = 'error';
                $flash_msg = 'Ha ocurrido un error al asignar: El discípulo ' . $discipulo . ' ya ha sido asignado al lìder ' . $lider . '.';
            }
        }
        $this->getUser()->setFlash($flash_tipo, $flash_msg, false);
        $this->forward('asignacion', 'index');
    }

    /**
     * Verifica los datos para realizar la asignación.
     * @param sfGuardUser $lider
     * @param sfGuardUser $discipulo
     * @param type $actualizacion
     * @param type $correo
     * @return string 
     */
    private function validaAsignacion(sfGuardUser $lider, sfGuardUser $discipulo, $actualizacion, $correo = null) {
        $resultado = 'ok';
        if ($lider->getGenero() != $discipulo->getGenero()) {
            $resultado = "Los géneros del Líder y del Discípulo no coinciden";
        }
        if ($actualizacion != 'ok') {
            $resultado = "Error al actualizar discipulo: " . $actualizacion;
        }
        if ($correo && ($correo <= 0 || is_nan($correo)) && sfConfig::get('app_envia_mails')) {
            $resultado = "Error al enviar el correo: " . $correo;
        }
        return $resultado;
    }

    public function executeIndex(sfWebRequest $request) {
        $this->current_user = $this->getUser();
        $this->tipos = Doctrine_Core::getTable('Discipulo')->getTipos();
        $this->tipos_id = Doctrine_Core::getTable('Discipulo')->getTiposId();
        $this->nuevos = Doctrine_Core::getTable('Discipulo')->getDiscipulosSinCelula($this->getUser()->getUserGenero());
        $this->discipulos = Doctrine_Core::getTable('MiembroCelula')->getMiembrosLideresPorLider($this->getUser()->getUserId());
    }

    public function executeShow(sfWebRequest $request) {
        $this->discipulo = Doctrine_Core::getTable('Discipulo')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->discipulo);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new DiscipuloForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new DiscipuloForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($discipulo = Doctrine_Core::getTable('Discipulo')->find(array($request->getParameter('id'))), sprintf('Object discipulo does not exist (%s).', $request->getParameter('id')));
        $this->form = new DiscipuloForm($discipulo);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($discipulo = Doctrine_Core::getTable('Discipulo')->find(array($request->getParameter('id'))), sprintf('Object discipulo does not exist (%s).', $request->getParameter('id')));
        $this->form = new DiscipuloForm($discipulo);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($discipulo = Doctrine_Core::getTable('Discipulo')->find(array($request->getParameter('id'))), sprintf('Object discipulo does not exist (%s).', $request->getParameter('id')));
        $discipulo->delete();

        $this->redirect('asignacion/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $discipulo = $form->save();

            $this->redirect('asignacion/edit?id=' . $discipulo->getId());
        }
    }

}
