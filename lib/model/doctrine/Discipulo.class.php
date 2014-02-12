<?php

/**
 * Discipulo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    cdfeg12
 * @subpackage model
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Discipulo extends sfGuardUser {

    public function getLider() {
        return"{$this->getFirstName()} {$this->getLastName()}";
    }

    public function getFotografia() {
        $foto = parent::getFotografia();
        if ($foto == "") {
            if ($this->getGenero() == 1) {
                return "avatar_m.png";
            } else {
                return "avatar_h.png";
            }
        } else {
            return $foto;
        }
    }

    /**
     * Updates de type of one Discipulo according to de parameter
     * @param integer $tipo_discipulo the new type to set
     * @return string the result
     */
    public function actualizaTipo($tipo_discipulo) {
        $grupo = new sfGuardUserGroup();
        $this->setTipoDiscipulo($tipo_discipulo);
        if ($tipo_discipulo >= 2) {
            $this->setIsActive(true);
        }
        $discipulo_id = $this->getId();
        switch ($tipo_discipulo) {
            case 0:
                $grupo_disicpulo = Doctrine_Core::getTable('sfGuardUserGroup')->find(array($discipulo_id, 1));
                if ($grupo_disicpulo) {
                    $grupo_disicpulo->setGroupId(1);
                } else {
                    return "el discípulo no tiene asignado el grupo 1";
                }
                break;
            case 1:
                $grupo_disicpulo = Doctrine_Core::getTable('sfGuardUserGroup')->find(array($discipulo_id, 1));
                if ($grupo_disicpulo) {
                    $grupo_disicpulo->setGroupId(1);
                } else {
                    return "el discípulo no tiene asignado un grupo para actualizar";
                }
                break;
            case 2:
                $grupo_disicpulo = Doctrine_Core::getTable('sfGuardUserGroup')->find(array($discipulo_id, 1));
                if ($grupo_disicpulo) {
                    $grupo_disicpulo->setGroupId(2);
                } else {
                    return "el discípulo no tiene asignado un grupo para actualizar";
                }
                break;
            case 3:
                $grupo_disicpulo = Doctrine_Core::getTable('sfGuardUserGroup')->find(array($discipulo_id, 2));
                if ($grupo_disicpulo) {
                    $grupo_disicpulo->setGroupId(3);
                } else {
                    return "el discípulo no tiene asignado un grupo para actualizar";
                }
                break;
            case 4:
                $grupo_disicpulo = Doctrine_Core::getTable('sfGuardUserGroup')->find(array($discipulo_id, 3));
                if ($grupo_disicpulo) {
                    $grupo_disicpulo->setGroupId(4);
                } else {
                    return "el discípulo no tiene asignado un grupo para actualizar";
                }
                break;
            default:
                $grupo_disicpulo = Doctrine_Core::getTable('sfGuardUserGroup')->find(array($discipulo_id, 1));
                if ($grupo_disicpulo) {
                    $grupo_disicpulo->setGroupId(1);
                } else {
                    return "el discípulo no tiene asignado un grupo para actualizar";
                }
                break;
        }
        $grupo_disicpulo->save();
        $this->save();
        return 'ok';
    }

    /**
     * Magic Method to write de name of the Discipulo
     * @return type 
     */
    public function __toString() {
        return $this->getFirstName() . " " . $this->getLastName();
    }

    /**
     * Obtiene la edad del discipulo
     * @return type 
     */
    public function calculaEdad() {
        $nombre_imagen = "green_alert.png";
        $ano = date('Y');
        $mes = date('m');
        $dia = date('d');

        $fecha = explode('-', $this->getFechaNac());
        $anonas = $fecha[0];
        $mesnas = $fecha[1];
        $dianas = explode(' ', $fecha[2]);
        $dianas = $dianas[0];

        if (($mesnas == $mes) && ($dianas > $dia)) {
            $ano = ($ano - 1);
        }

        if ($mesnas > $mes) {
            $ano = ($ano - 1);
        }

        $edad = ($ano - $anonas);

        return $edad;
    }

}