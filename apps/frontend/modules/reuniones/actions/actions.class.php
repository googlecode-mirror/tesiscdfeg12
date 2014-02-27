<?php

/**
 * reuniones actions.
 *
 * @package    cdfeg12
 * @subpackage reuniones
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reunionesActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->reunions = Doctrine_Core::getTable('Reunion')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->reunion = Doctrine_Core::getTable('Reunion')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->reunion);
        $this->celula = Doctrine_Core::getTable('Celula')->find(array($this->reunion->getCelulaId()));
        $this->miembros = Doctrine_Core::getTable('MiembroCelula')->getMiembrosPorLider($this->celula->getDiscipuloLiderId());
        $this->form = new ReunionForm();
        $this->form->setDefault('celula_id', $this->reunion->getCelulaId());
        $this->form->setDefault('fecha', $this->reunion->getFecha());
        $this->form->setDefault('palabra', $this->reunion->getPalabra());
        $this->form->setDefault('observaciones', $this->reunion->getObservaciones());
        $asistencias = '';
        foreach ($this->reunion->getAsistencias() as $asistencia) {
            $asistencias .= $asistencia->getMiembroCelulaId() . ",";
        }
        $this->form->setDefault('asistencias', $asistencias);
        if ($request->isXmlHttpRequest()) {
            return $this->setLayout(false);
        }
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new ReunionForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $reunion = $request->getParameter('reunion');
        $this->form = new ReunionForm();

        $this->processForm($request, $this->form, $reunion['celula_id']);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($reunion = Doctrine_Core::getTable('Reunion')->find(array($request->getParameter('id'))), sprintf('Object reunion does not exist (%s).', $request->getParameter('id')));
        $this->form = new ReunionForm($reunion);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($reunion = Doctrine_Core::getTable('Reunion')->find(array($request->getParameter('id'))), sprintf('Object reunion does not exist (%s).', $request->getParameter('id')));
        $this->form = new ReunionForm($reunion);
        $reunion = $request->getParameter('reunion');
        $this->processForm($request, $this->form, $reunion['celula_id']);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($reunion = Doctrine_Core::getTable('Reunion')->find(array($request->getParameter('id'))), sprintf('Object reunion does not exist (%s).', $request->getParameter('id')));
        $celula_id = $reunion->getCelulaId();
        foreach ($reunion->getAsistencias() as $borrable) {
            $borrable->delete();
        }
        $reunion->delete();
        $this->getUser()->setFlash('notice', "Reunión eliminada exitosamente", true);
        $this->redirect('celulas/show?id=' . $celula_id);
    }

    protected function processForm(sfWebRequest $request, sfForm $form, $celulaId = null) {
        $asistencia = $request->getParameter('reunion')['asistencias'];
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $fields = $form->getFormFieldSchema()->getValue();
        if ($form->isValid()) {
            $reunion = $form->save();
            foreach ($reunion->getAsistencias() as $borrable) {
                $borrable->delete();
            }
            $asistencias = explode(',', $asistencia);
            foreach ($asistencias as $key => $asistencia) {
                if ($asistencia > 0) {
                    $source = new Asistencia();
                    $source->setReunionId($reunion->getId());
                    $source->setMiembroCelulaId($asistencia);
                    $source->save();
                }
            }
            $this->getUser()->setFlash('notice', "Reunión guardada exitosamente", true);
            if (isset($celulaId)) {
                $this->redirect('celulas/show?id=' . $celulaId);
            } else {
                $this->forward('celulas', 'index');
            }
        }
        $this->getUser()->setFlash('error', "Error!!! " . $form->getErrorSchema(), true);
        if (isset($celulaId)) {
            $this->redirect('celulas/show?id=' . $celulaId);
        } else {
            $this->forward('celulas', 'index');
        }
    }

}
