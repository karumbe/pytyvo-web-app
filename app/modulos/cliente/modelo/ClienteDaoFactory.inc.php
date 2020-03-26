<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'ClienteDaoComImpl.inc.php';

class ClienteDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'ClienteDaoComImpl';

}
?>