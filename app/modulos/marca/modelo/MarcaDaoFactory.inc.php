<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'MarcaDaoComImpl.inc.php';

class MarcaDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'MarcaDaoComImpl';

}
?>