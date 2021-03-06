<?php

/**
 * sfGuardUserGroupTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class sfGuardUserGroupTable extends PluginsfGuardUserGroupTable {

    /**
     * Returns an instance of this class.
     *
     * @return object sfGuardUserGroupTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('sfGuardUserGroup');
    }

    /**
     * Obtiene El grupo basado en los IDs de discipulo y grupo
     * @param Integer $discipulo_id Id del Discipulo
     * @param Integer $grupo_id id del Grupo
     * @return List lista de registros encontrados
     */
    public function getGrupoPorIds($discipulo_id, $grupo_id) {
        $q = $this->createQuery('g')
                ->where('g.user_id = ?', $discipulo_id)
                ->andWhere('g.group_id = ?', $grupo_id);
        return $q->execute();
    }

}