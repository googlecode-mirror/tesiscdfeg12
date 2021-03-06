<?php

/**
 * AsignacionTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class AsignacionTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object AsignacionTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Asignacion');
    }

    /**
     * Obtiene la lista de asignaciones dadas a lides consultado
     * @param Integer $id_lider Identificacion del lider
     */
    public function getAsignadosPorLider($id_lider) {
        $q = $this->createQuery('as')
                ->innerJoin('as.DiscipuloNuevo d')
                ->where('as.discipulo_lider_id = ?', $id_lider)
                ->andWhere('d.id NOT IN (SELECT m.discipulo_id FROM MiembroCelula AS m)');
//                ->andWhere('d.tipo_discipulo = 1');
        return $q->execute();
    }

    public function estaAsginado($id_nuevo, $id_lider) {
        $q = $this->createQuery('as')
                ->where('as.discipulo_nuevo_id = ?', $id_nuevo)
                ->andWhere('as.discipulo_lider_id = ?', $id_nuevo);
        $r = $q->execute();
        $c_r = count($r->getData());
        return $c_r;
    }

}
