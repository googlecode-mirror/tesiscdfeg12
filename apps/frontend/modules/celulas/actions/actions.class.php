<?php

/**
 * celulas actions.
 *
 * @package    cdfeg12
 * @subpackage celulas
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class celulasActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->celulas = Doctrine_Core::getTable('Celula')->getCelulasPorLider($this->getUser()->getUserId());
    }

    public function executeShow(sfWebRequest $request) {
        $this->celula = Doctrine_Core::getTable('Celula')->find(array($request->getParameter('id')));
        $this->historial = Doctrine_Core::getTable('Reunion')->getHistorial($this->celula->getId());
        $this->miembros = Doctrine_Core::getTable('MiembroCelula')->getMiembrosPorLider($this->celula->getDiscipuloLiderId());
        $this->form = new ReunionForm();
        $this->form->setDefault('celula_id', $request->getParameter('id'));
        $this->forward404Unless($this->celula);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new CelulaForm();
        $this->lideres = Doctrine_Core::getTable('MiembroCelula')->getMiembrosPorLider($this->getUser()->getUserId());
        $this->mi_id = $this->getUser()->getUserId();
        $this->mi_nombre = $this->getUser()->getName();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new CelulaForm();
        $this->lideres = Doctrine_Core::getTable('MiembroCelula')->getMiembrosPorLider($this->getUser()->getUserId());

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($celula = Doctrine_Core::getTable('Celula')->find(array($request->getParameter('id'))), sprintf('Object celula does not exist (%s).', $request->getParameter('id')));
        $this->form = new CelulaForm($celula);
        $this->lideres = Doctrine_Core::getTable('MiembroCelula')->getMiembrosPorLider($this->getUser()->getUserId());
        $this->mi_id = $this->getUser()->getUserId();
        $this->mi_nombre = $this->getUser()->getName();
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($celula = Doctrine_Core::getTable('Celula')->find(array($request->getParameter('id'))), sprintf('Object celula does not exist (%s).', $request->getParameter('id')));
        $this->form = new CelulaForm($celula);
        $this->lideres = Doctrine_Core::getTable('MiembroCelula')->getMiembrosPorLider($this->getUser()->getUserId());
        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($celula = Doctrine_Core::getTable('Celula')->find(array($request->getParameter('id'))), sprintf('Object celula does not exist (%s).', $request->getParameter('id')));
        $celula->delete();

        $this->redirect('celulas/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $celula = $form->save();
            $lider_id = $celula->getDiscipuloLiderId();
            if ($lider_id == $this->getUser()->getUserId() && $request->getMethod() != 'PUT') {
                $miembroCelula = new MiembroCelula;
                $miembroCelula->asignarLiderAsMiembro($celula->getId(), $this->getUser()->getUserId());
            }
            $this->redirect('celulas/index');
        }
        $this->mi_id = $this->getUser()->getUserId();
        $this->mi_nombre = $this->getUser()->getName();
    }

}
