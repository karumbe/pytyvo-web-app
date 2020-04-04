<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'MotivoNoDaoComImpl.inc.php';

class MotivoNoDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'MotivoNoDaoComImpl';

}
?>
