<?php
include_once 'app/nucleo/ModeloBase.inc.php';

class Familia extends ModeloBase {

    private $p1;
    private $p2;
    private $p3;
    private $p4;
    private $p5;

    /**
    * Constructor.
    *
    * @param integer $codigo
    * Código del registro.
    *
    * @param string $nombre
    * Nombre del registro.
    *
    * @param decimal $p1
    * Porcentaje para la lista 1.
    *
    * @param decimal $p2
    * Porcentaje para la lista 2.
    *
    * @param decimal $p3
    * Porcentaje para la lista 3.
    *
    * @param decimal $p4
    * Porcentaje para la lista 4.
    *
    * @param decimal $p5
    * Porcentaje para la lista 5.
    *
    * @param boolean $vigente
    * Vigencia del registro.
    */
    # @Override
    public function __construct($codigo = 0, $nombre = '',
            $p1 = 0, $p2 = 0, $p3 = 0, $p4 = 0, $p5 = 0, $vigente = false) {
        parent::__construct($codigo, $nombre, $vigente);
        $this->establecer_p1($p1);
        $this->establecer_p2($p2);
        $this->establecer_p3($p3);
        $this->establecer_p4($p4);
        $this->establecer_p5($p5);
    }

    /**
    * Devuelve el porcentaje para la lista 1.
    *
    * @return decimal
    */
    public function obtener_p1() {
        return $this->p1;
    }

    /**
    * Devuelve el porcentaje para la lista 2.
    *
    * @return decimal
    */
    public function obtener_p2() {
        return $this->p2;
    }

    /**
    * Devuelve el porcentaje para la lista 3.
    *
    * @return decimal
    */
    public function obtener_p3() {
        return $this->p3;
    }

    /**
    * Devuelve el porcentaje para la lista 4.
    *
    * @return decimal
    */
    public function obtener_p4() {
        return $this->p4;
    }

    /**
    * Devuelve el porcentaje para la lista 5.
    *
    * @return decimal
    */
    public function obtener_p5() {
        return $this->p5;
    }

    /**
    * Establece el porcentaje para la lista 1.
    *
    * @param decimal $p1
    * Porcentaje para la lista 1.
    */
    public function establecer_p1($p1) {
        $this->p1 = $p1;
    }

    /**
    * Establece el porcentaje para la lista 2.
    *
    * @param decimal $p2
    * Porcentaje para la lista 2.
    */
    public function establecer_p2($p2) {
        $this->p2 = $p2;
    }

    /**
    * Establece el porcentaje para la lista 3.
    *
    * @param decimal $p3
    * Porcentaje para la lista 3.
    */
    public function establecer_p3($p3) {
        $this->p3 = $p3;
    }

    /**
    * Establece el porcentaje para la lista 4.
    *
    * @param decimal $p4
    * Porcentaje para la lista 4.
    */
    public function establecer_p4($p4) {
        $this->p4 = $p4;
    }

    /**
    * Establece el porcentaje para la lista 5.
    *
    * @param decimal $p5
    * Porcentaje para la lista 5.
    */
    public function establecer_p5($p5) {
        $this->p5 = $p5;
    }

}
?>