<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'RubroDaoComImpl.inc.php';

class RubroDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'RubroDaoComImpl';

}
?>