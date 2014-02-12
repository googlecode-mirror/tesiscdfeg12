<?php

/**
 * DiscipuloTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class DiscipuloTable extends sfGuardUserTable {

    static public $tipos = array(
        'Nuevo' => '0',
        'Asignado' => '1',
        'Discípulo' => '2',
        'Líder de Célula' => '3',
        'Líder de Red' => '4'
    );
    static public $tipos_id = array(
        '0' => 'Nuevo',
        '1' => 'Asignado',
        '2' => 'Discípulo',
        '3' => 'Líder de Célula',
        '4' => 'Líder de Red'
    );
    static public $civil = array(
        'Soltero' => 'soltero',
        'Casado' => 'casado',
        'Viudo' => 'viudo',
        'Divorciado' => 'divorciado',
        'Unión Libre' => 'union_libre'
    );
    static public $civil_id = array(
        'soltero' => 'Soltero',
        'casado' => 'Casado',
        'viudo' => 'Viudo',
        'divorciado' => 'Divorciado',
        'union_libre' => 'Unión Libre'
    );
    static public $genero = array(
        'Femenino' => '1',
        'Masculino' => '2'
    );
    static public $genero_id = array(
        '1' => 'Femenino',
        '2' => 'Masculino'
    );

    public static function getTipos() {
        return self::$tipos;
    }

    public static function getTiposId() {
        return self::$tipos_id;
    }

    public static function getGenero() {
        return self::$genero;
    }

    public static function getGeneroId() {
        return self::$genero_id;
    }
    public static function getCivil() {
        return self::$civil;
    }

    public static function getCivilId() {
        return self::$civil_id;
    }

    /**
     * Returns an instance of this class.
     *
     * @return object DiscipuloTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Discipulo');
    }

    /**
     * Obtiene la lista de discipulos filtrados por tipo de discipulo
     * @param type $tipo 'nuevo' => 0, 'discipulo' => 1, 'lider_celula' => 2, 'lider_red' => 3, 'asignado' => 4
     * @return Lista Lista de discipulos encontrados
     */
    public function listaPorTipo($tipo, $genero) {
        $q = $this->createQuery('d')
                ->where('d.tipo_discipulo = ?', $tipo)
                ->andWhere('d.genero = ?', $genero);
        return $q->execute();
    }

    /**
     * Obtiene la lista de todos los líderes
     * @return Lista Lideres obtenidos
     */
    public function listaLideres() {
//        $q = $this->createQuery('d')
//                ->leftJoin('d.Asignacion a')
//                ->whereIn('d.tipo_discipulo', array(3, 4))
//                ->having('COUNT(a.discipulo_lider_id) <= ' . sfConfig::get('app_max_num_asignados'));
        $q = $this->createQuery('d')->whereIn('d.tipo_discipulo', array(3, 4));
        return $q->execute();
    }

}