<?php
class CuentaPorCobrar {

    private $tipodocu = 0;
    private $nrodocu = 0;
    private $nrofact = '';
    private $cuota = '';
    private $fecha_emi = '0000-00-00';
    private $fecha_vto = '0000-00-00';
    private $saldo = 0;
    private $dias = 0;
    private $cod_moneda = 0;
    private $moneda = '';
    private $simbolo = '';
    private $decimales = false;
    private $cod_cliente = 0;
    private $cliente = '';
    private $ruc = '';
    private $direccion = '';
    private $departamen = '';
    private $ciudad = '';
    private $telefono = '';

    /**
    * Devuelve el tipo de documento.
    *
    * @return integer
    */
    public function obtener_tipodocu() {
        return $this->tipodocu;
    }

    /**
    * Devuelve el número de documento.
    *
    * @return integer
    */
    public function obtener_nrodocu() {
        return $this->nrodocu;
    }

    /**
    * Devuelve el número de factura con el formato 999-999-9999999.
    *
    * @return string
    */
    public function obtener_nrofact() {
        return $this->nrofact;
    }

    /**
    * Devuelve el número de cuota.
    *
    * @return string
    */
    public function obtener_cuota() {
        return $this->cuota;
    }

    /**
    * Devuelve la fecha de emisión del documento.
    *
    * @return date
    */
    public function obtener_fecha_emi() {
        return $this->fecha_emi;
    }

    /**
    * Devuelve la fecha de vencimiento de la cuota.
    *
    * @return date
    */
    public function obtener_fecha_vto() {
        return $this->fecha_vto;
    }

    /**
    * Devuelve el saldo de la cuota.
    *
    * @return decimal
    */
    public function obtener_saldo() {
        return $this->saldo;
    }

    /**
    * Devuelve un número que de ser positivo significa que faltan días para el
    * vencimiento y si es negativo indica la cantidad de días de atraso.
    *
    * @return integer
    */
    public function obtener_dias() {
        return $this->dias;
    }

    /**
    * Devuelve el código de la moneda.
    *
    * @return integer
    */
    public function obtener_cod_moneda() {
        return $this->cod_moneda;
    }

    /**
    * Devuelve el nombre de la moneda.
    *
    * @return string
    */
    public function obtener_moneda() {
        return $this->moneda;
    }

    /**
    * Devuelve el símbolo de la moneda.
    *
    * @return string
    */
    public function obtener_simbolo() {
        return $this->simbolo;
    }

    /**
    * Devuelve si la moneda utiliza decimales.
    *
    * @return boolean
    */
    public function obtener_decimales() {
        return $this->decimales;
    }

    /**
    * Devuelve el código del cliente.
    *
    * @return integer
    */
    public function obtener_cod_cliente() {
        return $this->cod_cliente;
    }

    /**
    * Devuelve el nombre del cliente.
    *
    * @return string
    */
    public function obtener_cliente() {
        return $this->cliente;
    }

    /**
    * Devuelve el RUC del cliente.
    *
    * @return string
    */
    public function obtener_ruc() {
        return $this->ruc;
    }

    /**
    * Devuelve la dirección del cliente.
    *
    * @return string
    */
    public function obtener_direccion() {
        return $this->direccion;
    }

    /**
    * Devuelve el nombre del departamento.
    *
    * @return string
    */
    public function obtener_departamen() {
        return $this->departamen;
    }

    /**
    * Devuelve el nombre de la ciudad.
    *
    * @return string
    */
    public function obtener_ciudad() {
        return $this->ciudad;
    }

    /**
    * Devuelve el teléfono del cliente.
    *
    * @return string
    */
    public function obtener_telefono() {
        return $this->telefono;
    }

    /**
    * Establece el tipo de documento.
    *
    * @param integer $tipodocu
    * Tipo de documento.
    */
    public function establecer_tipodocu($tipodocu) {
        $this->tipodocu = $tipodocu;
    }

    /**
    * Establece el número de documento.
    *
    * @param integer $nrodocu
    * Número de documento.
    */
    public function establecer_nrodocu($nrodocu) {
        $this->nrodocu = $nrodocu;
    }

    /**
    * Establece el número de factura con el formato 999-999-9999999.
    *
    * @param string $nrofact
    * Número de factura.
    */
    public function establecer_nrofact($nrofact) {
        $this->nrofact = $nrofact;
    }

    /**
    * Establece el número de cuota.
    *
    * @param string $cuota
    * Número de cuota.
    */
    public function establecer_cuota($cuota) {
        $this->cuota = $cuota;
    }

    /**
    * Establece la fecha de emisión del documento.
    *
    * @param date $fecha_emi
    * Fecha de emisión del documento.
    */
    public function establecer_fecha_emi($fecha_emi) {
        $this->fecha_emi = $fecha_emi;
    }

    /**
    * Establece la fecha de vencimiento de la cuota.
    *
    * @param date $fecha_vto
    * Fecha de vencimiento de la cuota.
    */
    public function establecer_fecha_vto($fecha_vto) {
        $this->fecha_vto = $fecha_vto;
    }

    /**
    * Establece el saldo de la cuota.
    *
    * @param decimal $saldo
    * Saldo de la cuota.
    */
    public function establecer_saldo($saldo) {
        $this->saldo = $saldo;
    }

    /**
    * Establece un número que de ser positivo significa que faltan días para el
    * vencimiento y si es negativo indica la cantidad de días de atraso.
    *
    * @param integer $dias
    * Si es positivo indica número de días que faltan para vencer.
    * Si es negativo indica la cantidad de días de atraso.
    */
    public function establecer_dias($dias) {
        $this->dias = $dias;
    }

    /**
    * Establece el código de la moneda.
    *
    * @param integer $cod_moneda
    * Código de la moneda.
    */
    public function establecer_cod_moneda($cod_moneda) {
        $this->cod_moneda = $cod_moneda;
    }

    /**
    * Establece el nombre de la moneda.
    *
    * @param string $moneda
    * Nombre de la moneda.
    */
    public function establecer_moneda($moneda) {
        $this->moneda = $moneda;
    }

    /**
    * Establece el símbolo de la moneda.
    *
    * @param string $simbolo
    * Símbolo de la moneda.
    */
    public function establecer_simbolo($simbolo) {
        $this->simbolo = $simbolo;
    }

    /**
    * Establece si la moneda utiliza decimales.
    *
    * @param boolean $decimales
    * true si utiliza y false en caso contrario (predeterminado).
    */
    public function establecer_decimales($decimales) {
        $this->decimales = $decimales;
    }

    /**
    * Establece el código del cliente.
    *
    * @param integer $cod_cliente
    * Código del cliente.
    */
    public function establecer_cod_cliente($cod_cliente) {
        $this->cod_cliente = $cod_cliente;
    }

    /**
    * Establece el nombre del cliente.
    *
    * @param string $cliente
    * Nombre del cliente.
    */
    public function establecer_cliente($cliente) {
        $this->cliente = $cliente;
    }

    /**
    * Establece el RUC del cliente.
    *
    * @param string $ruc
    * RUC del cliente.
    */
    public function establecer_ruc($ruc) {
        $this->ruc = $ruc;
    }

    /**
    * Establece la dirección del cliente.
    *
    * @param string $direccion
    * Dirección del cliente.
    */
    public function establecer_direccion($direccion) {
        $this->direccion = $direccion;
    }

    /**
    * Establece el nombre del departamento.
    *
    * @param string $departamen
    * Nombre del departamento.
    */
    public function establecer_departamen($departamen) {
        $this->departamen = $departamen;
    }

    /**
    * Establece el nombre de la ciudad.
    *
    * @param string $ciudad
    * Nombre de la ciudad
    */
    public function establecer_ciudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    /**
    * Establece el teléfono del cliente.
    *
    * @param string $telefono
    * Teléfono del cliente.
    */
    public function establecer_telefono($telefono) {
        $this->telefono = $telefono;
    }

}
?>