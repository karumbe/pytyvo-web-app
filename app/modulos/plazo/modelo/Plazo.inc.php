<?php
include_once 'app/nucleo/ModeloBase.inc.php';

class Plazo extends ModeloBase {

    private $num_vtos;
    private $separacion;
    private $primero;
    private $resto;

    /**
    * Constructor.
    *
    * @param integer $codigo
    * Código del plazo.
    *
    * @param string $nombre
    * Nombre del plazo.
    *
    * @param integer $num_vtos
    * Número de vencimientos.
    *
    * @param string $separacion
    * Separación entre los vencimientos.
    *
    * @param integer $primero
    * Días o meses para el primer vencimiento.
    *
    * @param integer $resto
    * Días o meses para el resto de los vencimientos.
    *
    * @param boolean $vigente
    * Vigencia del registro.
    */
    # @Override
    public function __constructor($codigo, $nombre, $vigente = false,
            $num_vtos = 0, $separacion = 'D', $primero = 0, $resto = 0) {
        parent::__constructor($codigo, $nombre, $vigente);
        $this->establecer_num_vtos($num_vtos);
        $this->establecer_separacion($separacion);
        $this->establecer_primero($primero);
        $this->establecer_resto($resto);
    }

    /**
    * Devuelve el número de vencimientos.
    *
    * @return integer
    */
    public function obtener_num_vtos() {
        return $this->num_vtos;
    }

    /**
    * Devuelve la separación entre los vencimientos.
    *
    * @return string
    * 'M' para mes o 'D' para día (predeterminado).
    */
    public function obtener_separacion() {
        return $this->separacion;
    }

    /**
    * Devuelve los días o los meses para el primer vencimiento.
    *
    * @return integer
    */
    public function obtener_primero() {
        return $this->primero;
    }

    /**
    * Devuelve los días o los meses para el resto de los vencimientos.
    *
    * @return integer
    */
    public function obtener_resto() {
        return $this->resto;
    }

    /**
    * Establece el número de vencimientos.
    *
    * @param integer $num_vtos
    * Número de vencimientos.
    */
    public function establecer_num_vtos($num_vtos) {
        $this->num_vtos = $num_vtos;
    }

    /**
    * Establece la separación entre los vencimientos.
    *
    * @param string $separacion
    * Separación entre los vencimientos.
    */
    public function establecer_separacion($separacion) {
        $this->separacion = trim(strtoupper($separacion));

        if ($this->separacion !== 'M')
            $this->separacion = 'D';
    }

    /**
    * Establece los días o los meses para el primer vencimiento.
    *
    * @param integer $primero
    * Días o meses para el primer vencimiento.
    */
    public function establecer_primero($primero) {
        $this->primero = $primero;
    }

    /**
    * Establece los días o los meses para el resto de los vencimientos.
    *
    * @param integer $resto
    * Días o meses para el resto de los vencimientos.
    */
    public function establecer_resto($resto) {
        $this->resto = $resto;
    }

}
?>