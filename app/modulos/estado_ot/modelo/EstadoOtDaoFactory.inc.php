<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'EstadoOtDaoComImpl.inc.php';

class EstadoOtDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'EstadoOtDaoComImpl';

}
?>
