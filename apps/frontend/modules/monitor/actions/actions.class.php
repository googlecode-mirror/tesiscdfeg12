<?php

/**
 * monitor actions.
 *
 * @package    cdfeg12
 * @subpackage monitor
 * @author     Karina Garcia, Dario Chuquilla
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class monitorActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $id_usuario = $this->getIdDiscipulo($request);
        $this->tipos_id = Doctrine_Core::getTable('Discipulo')->getTiposId();
        $this->discipulo = Doctrine_Core::getTable('sfGuardUser')->getDiscipuloPorId($id_usuario);
        $this->asignados = Doctrine_Core::getTable('Asignacion')->getAsignadosPorLider($id_usuario);
        $this->asignados_encuentro = Doctrine_Core::getTable('Seguimiento')->getSeguimientosPorActividad($id_usuario, 'Enviado a encuentro');
        $this->seguidores = Doctrine_Core::getTable('MiembroCelula')->getMiembrosPorLider($id_usuario);
        $this->escuelas = Doctrine_Core::getTable('Escuela')->getNivelesElv($id_usuario);
        $this->metas = Doctrine_Core::getTable('Meta')->listaSinCompletados($id_usuario);
        $this->modulo = 'monitor';
    }

    /**
     * Obtiene el id del discipulo con validacion
     * @param sfWebRequest $request pa{ametro de request
     * @return Integer El id del discipulo
     */
    private function getIdDiscipulo(sfWebRequest $request) {
        $id_usuario = $request->getParameter('id_discipulo');
        $id_usuario = $id_usuario == 0 ? $this->getUser()->getUserId() : $id_usuario;
        return $id_usuario;
    }

}
