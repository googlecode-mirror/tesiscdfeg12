<?php

/**
 * escuela actions.
 *
 * @package    cdfeg12
 * @subpackage escuela
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class escuelaActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->escuelas = Doctrine_Core::getTable('Escuela')->getElvByLiderId($this->getUser()->getUserId());
    }

    public function executeShow(sfWebRequest $request) {
        $this->escuela = Doctrine_Core::getTable('Escuela')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->escuela);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new EscuelaForm();
        $this->seguidores = Doctrine_Core::getTable('MiembroCelula')->getMiembrosPorLider($this->getUser()->getUserId());
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new EscuelaForm();
        $this->seguidores = Doctrine_Core::getTable('MiembroCelula')->getMiembrosPorLider($this->getUser()->getUserId());

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($escuela = Doctrine_Core::getTable('Escuela')->find(array($request->getParameter('id'))), sprintf('Object escuela does not exist (%s).', $request->getParameter('id')));
        $this->form = new EscuelaForm($escuela);
        $this->seguidores = Doctrine_Core::getTable('MiembroCelula')->getMiembrosPorLider($this->getUser()->getUserId());
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($escuela = Doctrine_Core::getTable('Escuela')->find(array($request->getParameter('id'))), sprintf('Object escuela does not exist (%s).', $request->getParameter('id')));
        $this->form = new EscuelaForm($escuela);
        $this->seguidores = Doctrine_Core::getTable('MiembroCelula')->getMiembrosPorLider($this->getUser()->getUserId());

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($escuela = Doctrine_Core::getTable('Escuela')->find(array($request->getParameter('id'))), sprintf('Object escuela does not exist (%s).', $request->getParameter('id')));
        $escuela->delete();

        $this->redirect('escuela/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $escuela = $form->save();
            if ($escuela->getNivelId() >= 5) {
                $discipulo = Doctrine_Core::getTable('Discipulo')->find($escuela->getDiscipuloId());
                $discipulo->actualizaTipo(3);
            }
//      $this->redirect('escuela/edit?id='.$escuela->getId());
            $this->redirect('escuela/index');
        }
    }

}
