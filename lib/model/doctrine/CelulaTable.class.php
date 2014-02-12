<?php

/**
 * CelulaTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CelulaTable extends Doctrine_Table {

    static public $dias = array(
        'lunes' => 'Lunes',
        'martes' => 'Martes',
        'miércoles' => 'Miércoles',
        'jueves' => 'Jueves',
        'viernes' => 'Viernes',
        'sabado' => 'Sábado',
        'domingo' => 'Domingo'
    );
    
    public static function getDias() {
        return self::$dias;
    }

    /**
     * Returns an instance of this class.
     *
     * @return object CelulaTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Celula');
    }

    /**
     * Obtiene la lista de células de un lider
     * @param Integer $id_lider Id del lider a cosultar
     * @return Lista Lista de células de un lider 
     */
    public function getCelulasPorLider($id_lider) {
        $q = $this->createQuery('c')
                ->where('c.discipulo_lider_id = ?', $id_lider);
        return $q->execute();
    }

}