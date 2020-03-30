<?php
include_once 'app/nucleo/DaoFactory.inc.php';
include_once 'MarcaOtDaoComImpl.inc.php';

class MarcaOtDaoFactory extends DaoFactory {

    protected static $clase_dao_impl = 'MarcaOtDaoComImpl';

}
?>
