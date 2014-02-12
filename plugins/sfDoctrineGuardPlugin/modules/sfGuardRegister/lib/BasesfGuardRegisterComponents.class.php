<?php

class BasesfGuardRegisterComponents extends sfComponents
{
  public function executeForm()
  {
  	$this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($this->getUser()->getUserId())), sprintf('Object sf_guard_user does not exist (%s).', $this->getUser()->getUserId()));
    $this->form = new sfGuardRegisterForm(array(),array("currentUser" => $sf_guard_user));
  }
}