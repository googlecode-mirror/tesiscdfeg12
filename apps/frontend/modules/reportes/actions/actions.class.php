<?php

/**
 * reportes actions.
 *
 * @package    cdfeg12
 * @subpackage reportes
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reportesActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $genero = $this->getUser()->getUserGenero();
        $this->tipos = Doctrine_Core::getTable('Discipulo')->getTipos();
        $this->tipos_id = Doctrine_Core::getTable('Discipulo')->getTiposId();
        foreach ($this->tipos_id as $key => $tipo) {
            $countDiscipulos[$tipo] = Doctrine_Core::getTable('Discipulo')->getCountPorTipo($key, $genero);
        }
        $this->countDiscipulos = $countDiscipulos;
        $this->actividades = Doctrine_Core::getTable('ActividadSeguimiento')->createQuery('a')
                ->where('a.id >= 4')
                ->execute();
        
        
        $fechas = Doctrine_Core::getTable('Seguimiento')->getYearsMonths();
        $_fechas = array();
        foreach ($fechas as $fecha) {
            $res = Doctrine_Core::getTable('Seguimiento')->filtrarGenero($genero, $fecha['year'], $fecha['month']);
            if(isset($res) && count($res)){
                $_fechas[] = $res;
            }
        }
        $this->fechas = $_fechas;
        
        
        
        $this->celulas = Doctrine_Core::getTable('Celula')->getCelulasConReuniones($genero);
    }

}
