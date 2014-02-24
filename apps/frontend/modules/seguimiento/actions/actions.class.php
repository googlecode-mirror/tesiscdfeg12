<?php

/**
 * seguimiento actions.
 *
 * @package    cdfeg12
 * @subpackage seguimiento
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class seguimientoActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->seguimientos = Doctrine_Core::getTable('Seguimiento')
                ->createQuery('a')
                ->where('a.Asignacion.discipulo_lider_id = ?',$this->getUser()->getUserId())
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->seguimiento = Doctrine_Core::getTable('Seguimiento')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->seguimiento);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new SeguimientoForm();
        $this->asignados = Doctrine_Core::getTable('Asignacion')->getAsignadosPorLider($this->getUser()->getUserId());
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new SeguimientoForm();
        $this->asignados = Doctrine_Core::getTable('Asignacion')->getAsignadosPorLider($this->getUser()->getUserId());
        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($seguimiento = Doctrine_Core::getTable('Seguimiento')->find(array($request->getParameter('id'))), sprintf('Object seguimiento does not exist (%s).', $request->getParameter('id')));
        $this->form = new SeguimientoForm($seguimiento);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($seguimiento = Doctrine_Core::getTable('Seguimiento')->find(array($request->getParameter('id'))), sprintf('Object seguimiento does not exist (%s).', $request->getParameter('id')));
        $this->form = new SeguimientoForm($seguimiento);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($seguimiento = Doctrine_Core::getTable('Seguimiento')->find(array($request->getParameter('id'))), sprintf('Object seguimiento does not exist (%s).', $request->getParameter('id')));
        $seguimiento->delete();

        $this->redirect('seguimiento/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $seguimiento = $form->save();

//            $this->redirect('seguimiento/edit?id=' . $seguimiento->getId());
            $this->redirect('seguimiento/index');
        }
    }

}
