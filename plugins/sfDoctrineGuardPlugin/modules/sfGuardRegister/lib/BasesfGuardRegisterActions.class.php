<?php

class BasesfGuardRegisterActions extends sfActions {

	public function executeIndex(sfWebRequest $request) {
		//        if ($this->getUser()->isAuthenticated()) {
		//            $this->getUser()->setFlash('notice', 'You are already registered and signed in!');
		//            $this->redirect('@homepage');
		//        }

		$this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($this->getUser()->getUserId())), sprintf('Object sf_guard_user does not exist (%s).', $this->getUser()->getUserId()));
		$this->form = new sfGuardRegisterForm(array(),array('currentUser' => $sf_guard_user));
		$this->form->setDefault('genero', $sf_guard_user->getGenero());
		$grupo = new sfGuardUserGroup();
		if ($request->isMethod('post')) {
			$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
			if ($this->form->isValid()) {
				$user = $this->form->save();
				$grupo->asignarGrupo($user->getId(), 1);
				$nombre_foto = $user->getFotografia();
				if ($nombre_foto != "") {
					Utilitarios::cambiarFoto($nombre_foto);
				}
				$this->getUser()->setFlash('notice', 'Discípulo registrado exitosamente', FALSE);
				$this->redirect('discipulos');
			}
		}
	}

}