<?php

/**
 * disipulos actions.
 *
 * @package    cdfeg12
 * @subpackage disipulos
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class disipulosActions extends sfActions {

	public function executeCambiarEstado(sfWebRequest $request) {
		$this->forwardUnless($id = $request->getParameter('id'), 'disipulos', 'index');
		$discipulo = Doctrine_Core::getTable('Discipulo')->find(array($id));
		$estado = $discipulo->cambiarEstado();
		$this->getUser()->setFlash('notice', 'Se ha cambiado el estado del discípulo ' . $discipulo . ' a ' . $estado, false);
		$this->forward('disipulos', 'index');
	}

	public function executeIndex(sfWebRequest $request) {
		$this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($this->getUser()->getUserId())), sprintf('Object sf_guard_user does not exist (%s).', $this->getUser()->getUserId()));
		$this->tipos_id = Doctrine_Core::getTable('Discipulo')->getTiposId();
		$this->genero_id = Doctrine_Core::getTable('Discipulo')->getGeneroId();
		$currentUser = $this->getUser();
		if($currentUser->hasCredential("admin")){
			$this->sf_guard_users = Doctrine_Core::getTable('sfGuardUser')
			->createQuery('a')
			->execute();
		} else {
			$this->sf_guard_users = Doctrine_Core::getTable('sfGuardUser')->getDiscipulosGenero($sf_guard_user->getGenero());
		}
	}

	public function executeShow(sfWebRequest $request) {
		$this->sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id')));
		$this->forward404Unless($this->sf_guard_user);
	}

	public function executeCumpleaneros(sfWebRequest $request) {
		$this->miembros = Doctrine_Core::getTable('MiembroCelula')->getMiembrosPorLider($this->getUser()->getUserId());
	}

	public function executeNew(sfWebRequest $request) {
		$this->form = new sfGuardUserForm();
	}

	public function executeCreate(sfWebRequest $request) {
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new sfGuardUserForm();

		$this->processForm($request, $this->form);

		$this->setTemplate('new');
	}

	public function executeEdit(sfWebRequest $request) {
		$this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
		$this->form = new sfGuardUserForm($sf_guard_user, array("currentUser" => $this->getUser()));
	}

	public function executeUpdate(sfWebRequest $request) {
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
		$this->form = new sfGuardUserForm($sf_guard_user, array("currentUser" => $this->getUser()));

		$this->processForm($request, $this->form);

		$this->setTemplate('edit');
	}

	public function executeDelete(sfWebRequest $request) {
		$request->checkCSRFProtection();

		$this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
		if ($sf_guard_user->delete()) {
			$this->getUser()->setFlash('notice', 'Se ha eliminado exitosamente al discípulo ', false);
		} else {
			$this->getUser()->setFlash('error', 'No se pudo eliminar al discípulo ', false);
		}

		$this->redirect('disipulos/index');
	}

	public function executeBorrado(sfWebRequest $request) {
		$this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
		if ($sf_guard_user->delete()) {
			$this->getUser()->setFlash('notice', 'Se ha eliminado exitosamente al discípulo ', false);
		} else {
			$this->getUser()->setFlash('error', 'No se pudo eliminar al discípulo ', false);
		}
		$this->forward('disipulos', 'index');
	}

	protected function processForm(sfWebRequest $request, sfForm $form) {
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid()) {
			$tipoDiscipulo = $form->getValue('tipo_discipulo');
			$form->setDefault('groups_list', array(0 => $tipoDiscipulo));
			$sf_guard_user = $form->save();
			$nombre_foto = $sf_guard_user->getfotografia();
			if($nombre_foto) {
				Utilitarios::cambiarFoto($nombre_foto);
			}
			$this->getUser()->setFlash('notice', 'La información fue guardada correctamente ', false);
			//            $this->redirect('disipulos/edit?id=' . $sf_guard_user->getId());
			$this->forward('disipulos', 'index');
		} else {
			$this->getUser()->setFlash('error', 'No se pudieron guardar los cambios, revise los mensajes de error', false);
		}
	}

}
