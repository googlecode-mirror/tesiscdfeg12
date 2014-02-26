<?php

/**
 * Celula
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    cdfeg12
 * @subpackage model
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Celula extends BaseCelula {

    public function getNumeroReuniones($fecha = null) {
        $reunion = Doctrine_Core::getTable('Reunion')->createQuery('r')
                ->where('r.celula_id = ?', $this->getId());
        if(isset($fecha) && $fecha != ''){
            $reunion->andWhere('r.fecha > ?', $fecha);
        }
        return $reunion->count();
    }

    public function getNumeroMiembros() {
        $miembros = Doctrine_Core::getTable('MiembroCelula')->createQuery('m')
                ->where('m.celula_id = ?', $this->getId())
        ;
        return $miembros->count();
    }

    public function getReunion() {
        $reunion = Doctrine_Core::getTable('Reunion')->createQuery('r')
                ->where('r.celula_id = ?', $this->getId());
        return $reunion->execute();
    }

    public function getAsistenciasReales() {
        $totalAsistencias = 0;
        foreach ($this->getReunion() as $key => $reunion) {
            $totalAsistencias += $reunion->getNumeroAsistencias();
        }
        return $totalAsistencias;
    }

    public function getMiembros() {
        $miembros = Doctrine_Core::getTable('MiembroCelula')->createQuery('m')
                ->where('m.celula_id = ?', $this->getId())
        ;
        return $miembros->execute();
    }

    public function getPorcentajeAssitencias() {
        $esperadas = $this->getNumeroMiembros() * $this->getNumeroReuniones();
        return number_format(($this->getAsistenciasReales() / $esperadas) * 100, 2);
    }

    public function __toString() {
        return $this->getLider()->getFirstName() . " " . $this->getLider()->getLastName();
    }

}
