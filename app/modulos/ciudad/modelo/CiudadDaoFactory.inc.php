<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'CiudadDaoComImpl.inc.php';

class CiudadDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'CiudadDaoComImpl';

}
?>
