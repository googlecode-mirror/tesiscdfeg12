<?php

class myUser extends sfGuardSecurityUser {

    /**
     * Obtiene el id del usuario Logueado
     * @return Integer Id del usuario logueado 
     */
    public function getUserId() {
        if ($this->isAuthenticated())
            return $this->getGuardUser()->getId();
        else
            return 0;
    }
    public function getUserGenero() {
        if ($this->isAuthenticated())
            return $this->getGuardUser()->getGenero();
        else
            return 0;
    }

    public function getNameOfUser() {
        if ($this->isAuthenticated())
            return $this->getGuardUser()->getFirstName() . " " . $this->getGuardUser()->getLastName();
        else
            return 0;
    }

}
