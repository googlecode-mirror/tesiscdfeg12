<?php

/**
 * metas actions.
 *
 * @package    cdfeg12
 * @subpackage metas
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class metasActions extends sfActions {

    /**
     * Cambia el estado de la meta seleccionada a cumplida
     * @param sfWebRequest $request
     */
    public function executeCompletar(sfWebRequest $request) {
        $this->forwardUnless($id = $request->getParameter('id'), 'metas', 'index');
        $this->meta = Doctrine_Core::getTable('Meta')->find(array($id));
        if ($this->meta->completarMeta() == 'ok') {
            $this->getUser()->setFlash('notice', 'Se ha cambiado el estado de su meta a Completada', false);
        } else {
            $this->getUser()->setFlash('error', 'Ha ocurrido un error', false);
        }
        $this->forward($request->getParameter('modulo'), 'index');
    }

    public function executeIndex(sfWebRequest $request) {
        $this->metas = Doctrine_Core::getTable('Meta')->listaSinCompletados($this->getUser()->getUserId());
        $this->modulo = 'metas';
    }

    public function executeShow(sfWebRequest $request) {
        $this->meta = Doctrine_Core::getTable('Meta')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->meta);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new MetaForm();
        $this->form->setDefault('discipulo_id', $this->getUser()->getUserId());
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new MetaForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($meta = Doctrine_Core::getTable('Meta')->find(array($request->getParameter('id'))), sprintf('Object meta does not exist (%s).', $request->getParameter('id')));
        $this->form = new MetaForm($meta);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($meta = Doctrine_Core::getTable('Meta')->find(array($request->getParameter('id'))), sprintf('Object meta does not exist (%s).', $request->getParameter('id')));
        $this->form = new MetaForm($meta);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($meta = Doctrine_Core::getTable('Meta')->find(array($request->getParameter('id'))), sprintf('Object meta does not exist (%s).', $request->getParameter('id')));
        if($meta->delete()) {
            $this->getUser()->setFlash('notice', 'Se ha eliminado la meta exitosamente', false);
        } else {
            $this->getUser()->setFlash('error', 'La meta no pudo ser eliminada', false);
        }

//        $this->redirect('metas/index');
        $this->forward('metas', 'index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $meta = $form->save();
            $this->getUser()->setFlash('notice', 'Se ha registrado su nueva meta', false);
//            $this->redirect('metas/index');
            $this->forward('metas', 'index');
        }
        $this->getUser()->setFlash('error', 'Error... La información ingresada no es válida', false);
    }

}
