<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'MotivoClieDaoComImpl.inc.php';

class MotivoClieDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'MotivoClieDaoComImpl';

}
?>