<?php
abstract class DaoFactory {

    protected static $clase_dao_impl;

    /**
    * Crea un instancia de la clase DAO.
    *
    * @return object|null
    * object si tiene éxito y null en caso contrario.
    */
    public static function crear_dao() {
        if (isset(static::$clase_dao_impl) && !empty(static::$clase_dao_impl)) {
            try {
                $dao = new static::$clase_dao_impl;
                return $dao;
            } catch (Exception $ex) {
                print 'ERROR: ' . $ex->getMessage() . '<br>';
            }
        }

        return null;
    }

}
?>
