<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'UsuarioDaoComImpl.inc.php';

class UsuarioDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'UsuarioDaoComImpl';

}
?>