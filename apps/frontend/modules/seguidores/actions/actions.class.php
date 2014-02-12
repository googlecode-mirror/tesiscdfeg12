<?php

/**
 * seguidores actions.
 *
 * @package    cdfeg12
 * @subpackage seguidores
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class seguidoresActions extends sfActions {

	public function executeIndex(sfWebRequest $request) {
		$this->miembro_celulas = Doctrine_Core::getTable('MiembroCelula')->getMiembrosPorLider($this->getUser()->getUserId(), 0);
	}

	public function executeShow(sfWebRequest $request) {
		$this->miembro_celula = Doctrine_Core::getTable('MiembroCelula')->find(array($request->getParameter('id')));
		$this->forward404Unless($this->miembro_celula);
	}

	public function executeNew(sfWebRequest $request) {
		$this->form = new MiembroCelulaForm();
		$this->tipos = Doctrine_Core::getTable('Discipulo')->getTipos();
		$this->asignados = Doctrine_Core::getTable('Asignacion')->getAsignadosPorLider($this->getUser()->getUserId());
		$this->lideres = Doctrine_Core::getTable('Celula')->getCelulasPorLider($this->getUser()->getUserId());
	}

	public function executeCreate(sfWebRequest $request) {
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new MiembroCelulaForm();

		$this->processForm($request, $this->form);

		$this->setTemplate('new');
	}

	public function executeEdit(sfWebRequest $request) {
		$this->forward404Unless($miembro_celula = Doctrine_Core::getTable('MiembroCelula')->find(array($request->getParameter('id'))), sprintf('Object miembro_celula does not exist (%s).', $request->getParameter('id')));
		$this->form = new MiembroCelulaForm($miembro_celula);
		$this->tipos = Doctrine_Core::getTable('Discipulo')->getTipos();
		$this->asignados = Doctrine_Core::getTable('Asignacion')->getAsignadosPorLider($this->getUser()->getUserId());
		$this->lideres = Doctrine_Core::getTable('Celula')->getCelulasPorLider($this->getUser()->getUserId());
	}

	public function executeUpdate(sfWebRequest $request) {
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($miembro_celula = Doctrine_Core::getTable('MiembroCelula')->find(array($request->getParameter('id'))), sprintf('Object miembro_celula does not exist (%s).', $request->getParameter('id')));
		$this->form = new MiembroCelulaForm($miembro_celula);

		$this->processForm($request, $this->form);

		$this->setTemplate('edit');
	}

	public function executeDelete(sfWebRequest $request) {
		$request->checkCSRFProtection();

		$this->forward404Unless($miembro_celula = Doctrine_Core::getTable('MiembroCelula')->find(array($request->getParameter('id'))), sprintf('Object miembro_celula does not exist (%s).', $request->getParameter('id')));
		$miembro_celula->delete();

		$this->redirect('seguidores/index');
	}

	protected function processForm(sfWebRequest $request, sfForm $form) {
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid()) {
			$miembro_celula = $form->save();
			$discipulo = Doctrine_Core::getTable('Discipulo')->find($miembro_celula->getDiscipuloId());
			$discipulo->actualizaTipo(2);
			//      $this->redirect('seguidores/edit?id='.$miembro_celula->getId());
			$this->redirect('seguidores/index');
		}
	}

}
