<?php
class Cliente {

    private $codigo = 0;
    private $nombre = '';
    private $direc1 = '';
    private $direc2 = '';
    private $direc3 = '';
    private $direc4 = '';
    private $direc5 = '';
    private $direc6 = '';
    private $direc7 = '';
    private $direc8 = '';
    private $direc9 = '';
    private $departamen = 0;
    private $ciudad = 0;
    private $barrio = 0;
    private $telefono = '';
    private $fax = '';
    private $correo = '';
    private $fechanac = '0000-00-00';
    private $contacto = '';
    private $ruc = '';
    private $documento = '';
    private $limite_cre = 0;
    private $fec_ioper = '0000-00-00';
    private $motivoclie = 0;
    private $odatosclie = '';
    private $saldo_actu = 0;
    private $saldo_usd = 0;
    private $obs1 = '';
    private $obs2 = '';
    private $obs3 = '';
    private $obs4 = '';
    private $obs5 = '';
    private $obs6 = '';
    private $obs7 = '';
    private $obs8 = '';
    private $obs9 = '';
    private $obs10 = '';
    private $ref1 = '';
    private $ref2 = '';
    private $ref3 = '';
    private $ref4 = '';
    private $ref5 = '';
    private $lista = 1;
    private $plazo = 0;
    private $vendedor = 0;
    private $cuenta = '';
    private $ruta = 0;
    private $facturar = 'N';
    private $estado = 'I';

    /**
    * Devuelve el código del cliente.
    *
    * @return integer
    */
    public function obtener_codigo() {
        return $this->codigo;
    }

    /**
    * Devuelve el nombre del cliente.
    *
    * @return string
    */
    public function obtener_nombre() {
        return $this->nombre;
    }

    /**
    * Devuelve la dirección 1.
    *
    * @return string
    */
    public function obtener_direc1() {
        return $this->direc1;
    }

    /**
    * Devuelve la dirección 2.
    *
    * @return string
    */
    public function obtener_direc2() {
        return $this->direc2;
    }

    /**
    * Devuelve la dirección 3.
    *
    * @return string
    */
    public function obtener_direc3() {
        return $this->direc3;
    }

    /**
    * Devuelve la dirección 4.
    *
    * @return string
    */
    public function obtener_direc4() {
        return $this->direc4;
    }

    /**
    * Devuelve la dirección 5.
    *
    * @return string
    */
    public function obtener_direc5() {
        return $this->direc5;
    }

    /**
    * Devuelve la dirección 6.
    *
    * @return string
    */
    public function obtener_direc6() {
        return $this->direc6;
    }

    /**
    * Devuelve la dirección 7.
    *
    * @return string
    */
    public function obtener_direc7() {
        return $this->direc7;
    }

    /**
    * Devuelve la dirección 8.
    *
    * @return string
    */
    public function obtener_direc8() {
        return $this->direc8;
    }

    /**
    * Devuelve la dirección 9.
    *
    * @return string
    */
    public function obtener_direc9() {
        return $this->direc9;
    }

    /**
    * Devuelve el código del departamento.
    *
    * @return integer
    */
    public function obtener_departamen() {
        return $this->departamen;
    }

    /**
    * Devuelve el código del ciudad.
    *
    * @return integer
    */
    public function obtener_ciudad() {
        return $this->ciudad;
    }

    /**
    * Devuelve el código del barrio.
    *
    * @return integer
    */
    public function obtener_barrio() {
        return $this->barrio;
    }

    /**
    * Devuelve el número de teléfono.
    *
    * @return string
    */
    public function obtener_telefono() {
        return $this->telefono;
    }

    /**
    * Devuelve el número de fax.
    *
    * @return string
    */
    public function obtener_fax() {
        return $this->fax;
    }

    /**
    * Devuelve la dirección de correo electrónico.
    *
    * @return string
    */
    public function obtener_correo() {
        return $this->correo;
    }

    /**
    * Devuelve la fecha de nacimiento.
    *
    * @return date
    */
    public function obtener_fechanac() {
        return $this->fechanac;
    }

    /**
    * Devuelve el nombre del contacto.
    *
    * @return string
    */
    public function obtener_contacto() {
        return $this->contacto;
    }

    /**
    * Devuelve el número de RUC.
    *
    * @return string
    */
    public function obtener_ruc() {
        return $this->ruc;
    }

    /**
    * Devuelve el número de documento.
    *
    * @return string
    */
    public function obtener_documento() {
        return $this->documento;
    }

    /**
    * Devuelve el límite de crédito en Guaraníes.
    *
    * @return integer
    */
    public function obtener_limite_cre() {
        return $this->limite_cre;
    }

    /**
    * Devuelve la fecha de inicio de operaciones.
    *
    * @return date
    */
    public function obtener_fec_ioper() {
        return $this->fec_ioper;
    }

    /**
    * Devuelve el código del motivo de ser cliente.
    *
    * @return integer
    */
    public function obtener_motivoclie() {
        return $this->motivoclie;
    }

    /**
    * Devuelve otros datos del cliente.
    *
    * @return string
    */
    public function obtener_odatosclie() {
        return $this->odatosclie;
    }

    /**
    * Devuelve el saldo actual en Guaraníes.
    *
    * @return integer
    */
    public function obtener_saldo_actu() {
        return $this->saldo_actu;
    }

    /**
    * Devuelve el saldo actual en Dólares Estadounidenses.
    *
    * @return decimal
    */
    public function obtener_saldo_usd() {
        return $this->saldo_usd;
    }

    /**
    * Devuelve la observación 1.
    *
    * @return string
    */
    public function obtener_obs1() {
        return $this->obs1;
    }

    /**
    * Devuelve la observación 2.
    *
    * @return string
    */
    public function obtener_obs2() {
        return $this->obs2;
    }

    /**
    * Devuelve la observación 3.
    *
    * @return string
    */
    public function obtener_obs3() {
        return $this->obs3;
    }

    /**
    * Devuelve la observación 4.
    *
    * @return string
    */
    public function obtener_obs4() {
        return $this->obs4;
    }

    /**
    * Devuelve la observación 5.
    *
    * @return string
    */
    public function obtener_obs5() {
        return $this->obs5;
    }

    /**
    * Devuelve la observación 6.
    *
    * @return string
    */
    public function obtener_obs6() {
        return $this->obs6;
    }

    /**
    * Devuelve la observación 7.
    *
    * @return string
    */
    public function obtener_obs7() {
        return $this->obs7;
    }

    /**
    * Devuelve la observación 8.
    *
    * @return string
    */
    public function obtener_obs8() {
        return $this->obs8;
    }

    /**
    * Devuelve la observación 9.
    *
    * @return string
    */
    public function obtener_obs9() {
        return $this->obs9;
    }

    /**
    * Devuelve la observación 10.
    *
    * @return string
    */
    public function obtener_obs10() {
        return $this->obs10;
    }

    /**
    * Devuelve la referencia 1.
    *
    * @return string
    */
    public function obtener_ref1() {
        return $this->ref1;
    }

    /**
    * Devuelve la referencia 2.
    *
    * @return string
    */
    public function obtener_ref2() {
        return $this->ref2;
    }

    /**
    * Devuelve la referencia 3.
    *
    * @return string
    */
    public function obtener_ref3() {
        return $this->ref3;
    }

    /**
    * Devuelve la referencia 4.
    *
    * @return string
    */
    public function obtener_ref4() {
        return $this->ref4;
    }

    /**
    * Devuelve la referencia 5.
    *
    * @return string
    */
    public function obtener_ref5() {
        return $this->ref5;
    }

    /**
    * Devuelve el número de lista de precios.
    *
    * @return integer
    */
    public function obtener_lista() {
        return $this->lista;
    }

    /**
    * Devuelve el código del plazo del crédito.
    *
    * @return integer
    */
    public function obtener_plazo() {
        return $this->plazo;
    }

    /**
    * Devuelve el código del vendedor.
    *
    * @return integer
    */
    public function obtener_vendedor() {
        return $this->vendedor;
    }

    /**
    * Devuelve el código de la cuenta de mayor.
    *
    * @return string
    */
    public function obtener_cuenta() {
        return $this->cuenta;
    }

    /**
    * Devuelve el código de la ruta.
    *
    * @return integer
    */
    public function obtener_ruta() {
        return $this->ruta;
    }

    /**
    * Devuelve si se puede facturar con cuenta atrasada.
    *
    * @return string
    * 'S' si se puede y 'N' en caso contrario (predeterminado).
    */
    public function obtener_facturar() {
        return $this->facturar;
    }

    /**
    * Devuelve si el cliente está activo.
    *
    * @return string
    * 'A' si lo está e 'I' en caso contrario (predeterminado).
    */
    public function obtener_estado() {
        return $this->estado;
    }

    /**
    * Establece el código del cliente.
    *
    * @param integer $codigo
    * Código del cliente.
    */
    public function establecer_codigo($codigo) {
        $this->codigo = $codigo;
    }

    /**
    * Establece el nombre del cliente.
    *
    * @param string $nombre
    * Nombre del cliente.
    */
    public function establecer_nombre($nombre) {
        $this->nombre = $nombre;
    }

    /**
    * Establece la dirección 1.
    *
    * @param string $direc1
    * Dirección 1.
    */
    public function establecer_direc1($direc1) {
        $this->direc1 = $direc1;
    }

    /**
    * Establece la dirección 2.
    *
    * @param string $direc2
    * Dirección 2.
    */
    public function establecer_direc2($direc2) {
        $this->direc2 = $direc2;
    }

    /**
    * Establece la dirección 3.
    *
    * @param string $direc3
    * Dirección 3.
    */
    public function establecer_direc3($direc3) {
        $this->direc3 = $direc3;
    }

    /**
    * Establece la dirección 4.
    *
    * @param string $direc4
    * Dirección 4.
    */
    public function establecer_direc4($direc4) {
        $this->direc4 = $direc4;
    }

    /**
    * Establece la dirección 5.
    *
    * @param string $direc5
    * Dirección 5.
    */
    public function establecer_direc5($direc5) {
        $this->direc5 = $direc5;
    }

    /**
    * Establece la dirección 6.
    *
    * @param string $direc6
    * Dirección 6.
    */
    public function establecer_direc6($direc6) {
        $this->direc6 = $direc6;
    }

    /**
    * Establece la dirección 7.
    *
    * @param string $direc7
    * Dirección 7.
    */
    public function establecer_direc7($direc7) {
        $this->direc7 = $direc7;
    }

    /**
    * Establece la dirección 8.
    *
    * @param string $direc8
    * Dirección 8.
    */
    public function establecer_direc8($direc8) {
        $this->direc8 = $direc8;
    }

    /**
    * Establece la dirección 9.
    *
    * @param string $direc9
    * Dirección 9.
    */
    public function establecer_direc9($direc9) {
        $this->direc9 = $direc9;
    }

    /**
    * Establece el código del departamento.
    *
    * @param integer $departamen
    * Código del departamento.
    */
    public function establecer_departamen($departamen) {
        $this->departamen = $departamen;
    }

    /**
    * Establece el código de la ciudad.
    *
    * @param integer $ciudad
    * Código de la ciudad.
    */
    public function establecer_ciudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    /**
    * Establece el código del barrio.
    *
    * @param integer $barrio
    * Código del barrio.
    */
    public function establecer_barrio($barrio) {
        $this->barrio = $barrio;
    }

    /**
    * Establece el número de teléfono.
    *
    * @param string $telefono
    * Número de teléfono.
    */
    public function establecer_telefono($telefono) {
        $this->telefono = $telefono;
    }

    /**
    * Establece el número de fax.
    *
    * @param string $fax
    * Número de fax.
    */
    public function establecer_fax($fax) {
        $this->fax = $fax;
    }

    /**
    * Establece la dirección de correo electrónico.
    *
    * @param string $correo
    * Dirección de correo electrónico.
    */
    public function establecer_correo($correo) {
        $this->correo = $correo;
    }

    /**
    * Establece la fecha de nacimiento.
    *
    * @param date $fechanac
    * Fecha de nacimiento.
    */
    public function establecer_fechanac($fechanac) {
        $this->fechanac = $fechanac;
    }

    /**
    * Establece el nombre del contacto.
    *
    * @param string $contacto
    * Nombre del contacto.
    */
    public function establecer_contacto($contacto) {
        $this->contacto = $contacto;
    }

    /**
    * Establece el número de RUC.
    *
    * @param string $ruc
    * Número de RUC.
    */
    public function establecer_ruc($ruc) {
        $this->ruc = $ruc;
    }

    /**
    * Establece el número de documento.
    *
    * @param string $documento
    * Número de documento.
    */
    public function establecer_documento($documento) {
        $this->documento = $documento;
    }

    /**
    * Establece el límite de crédito en Guaraníes.
    *
    * @param integer $limite_cre
    * Límite de crédito en Guaraníes.
    */
    public function establecer_limite_cre($limite_cre) {
        $this->limite_cre = $limite_cre;
    }

    /**
    * Establece la fecha de inicio de operaciones.
    *
    * @param date $fec_ioper
    * Fecha de inicio de operaciones.
    */
    public function establecer_fec_ioper($fec_ioper) {
        $this->fec_ioper = $fec_ioper;
    }

    /**
    * Establece el código del motivo de ser cliente.
    *
    * @param integer $motivoclie
    * Código del motivo de ser cliente.
    */
    public function establecer_motivoclie($motivoclie) {
        $this->motivoclie = $motivoclie;
    }

    /**
    * Establece otros datos del cliente.
    *
    * @param string $odatosclie
    * Otros datos del cliente.
    */
    public function establecer_odatosclie($odatosclie) {
        $this->odatosclie = $odatosclie;
    }

    /**
    * Establece el saldo actual en Guaraníes.
    *
    * @param integer $saldo_actu
    * Saldo actual en Guaraníes.
    */
    public function establecer_saldo_actu($saldo_actu) {
        $this->saldo_actu = $saldo_actu;
    }

    /**
    * Establece el saldo actual en Dólares Estadounidenses.
    *
    * @param decimal $saldo_usd
    * Saldo actual en Dólares Estadounidenses.
    */
    public function establecer_saldo_usd($saldo_usd) {
        $this->saldo_usd = $saldo_usd;
    }

    /**
    * Establece la observación 1.
    *
    * @param string $obs1
    * Observación 1.
    */
    public function establecer_obs1($obs1) {
        $this->obs1 = $obs1;
    }

    /**
    * Establece la observación 2.
    *
    * @param string $obs2
    * Observación 2.
    */
    public function establecer_obs2($obs2) {
        $this->obs2 = $obs2;
    }

    /**
    * Establece la observación 3.
    *
    * @param string $obs3
    * Observación 3.
    */
    public function establecer_obs3($obs3) {
        $this->obs3 = $obs3;
    }

    /**
    * Establece la observación 4.
    *
    * @param string $obs4
    * Observación 4.
    */
    public function establecer_obs4($obs4) {
        $this->obs4 = $obs4;
    }

    /**
    * Establece la observación 5.
    *
    * @param string $obs5
    * Observación 5.
    */
    public function establecer_obs5($obs5) {
        $this->obs5 = $obs5;
    }

    /**
    * Establece la observación 6.
    *
    * @param string $obs6
    * Observación 6.
    */
    public function establecer_obs6($obs6) {
        $this->obs6 = $obs6;
    }

    /**
    * Establece la observación 7.
    *
    * @param string $obs7
    * Observación 7.
    */
    public function establecer_obs7($obs7) {
        $this->obs7 = $obs7;
    }

    /**
    * Establece la observación 8.
    *
    * @param string $obs8
    * Observación 8.
    */
    public function establecer_obs8($obs8) {
        $this->obs8 = $obs8;
    }

    /**
    * Establece la observación 9.
    *
    * @param string $obs9
    * Observación 9.
    */
    public function establecer_obs9($obs9) {
        $this->obs9 = $obs9;
    }

    /**
    * Establece la observación 10.
    *
    * @param string $obs10
    * Observación 10.
    */
    public function establecer_obs10($obs10) {
        $this->obs10 = $obs10;
    }

    /**
    * Establece la referencia 1.
    *
    * @param string $ref1
    * Referencia 1.
    */
    public function establecer_ref1($ref1) {
        $this->ref1 = $ref1;
    }

    /**
    * Establece la referencia 2.
    *
    * @param string $ref2
    * Referencia 2.
    */
    public function establecer_ref2($ref2) {
        $this->ref2 = $ref2;
    }

    /**
    * Establece la referencia 3.
    *
    * @param string $ref3
    * Referencia 3.
    */
    public function establecer_ref3($ref3) {
        $this->ref3 = $ref3;
    }

    /**
    * Establece la referencia 4.
    *
    * @param string $ref4
    * Referencia 4.
    */
    public function establecer_ref4($ref4) {
        $this->ref4 = $ref4;
    }

    /**
    * Establece la referencia 5.
    *
    * @param string $ref5
    * Referencia 5.
    */
    public function establecer_ref5($ref5) {
        $this->ref5 = $ref5;
    }

    /**
    * Establece el número de lista de precios.
    *
    * @param integer $lista
    * Número de lista de precios.
    */
    public function establecer_lista($lista) {
        $this->lista = $lista;

        if ($this->lista < 1 || $this->lista > 5)
            $this->lista = 1;
    }

    /**
    * Establece el código del plazo del crédito.
    *
    * @param integer $plazo
    * Código del plazo del crédito.
    */
    public function establecer_plazo($plazo) {
        $this->plazo = $plazo;
    }

    /**
    * Establece el código del vendedor.
    *
    * @param integer $vendedor
    * Código del vendedor.
    */
    public function establecer_vendedor($vendedor) {
        $this->vendedor = $vendedor;
    }

    /**
    * Establece el código de la cuenta de mayor.
    *
    * @param string $cuenta
    * Código de la cuenta de mayor.
    */
    public function establecer_cuenta($cuenta) {
        $this->cuenta = $cuenta;
    }

    /**
    * Establece el código de la ruta.
    *
    * @param integer $ruta
    * Código de la ruta.
    */
    public function establecer_ruta($ruta) {
        $this->ruta = $ruta;
    }

    /**
    * Establece si se puede facturar con cuenta atrasada.
    *
    * @param string $facturar
    * 'S' si se puede y 'N' en caso contrario (predeterminado).
    */
    public function establecer_facturar($facturar) {
        $this->facturar = trim(strtoupper($facturar));

        if ($this->facturar !== 'S')
            $this->facturar = 'N';
    }

    /**
    * Establece si el cliente está activo.
    *
    * @param string $estado
    * 'A' si lo está e 'I' en caso contrario (predeterminado).
    */
    public function establecer_estado($estado) {
        $this->estado = trim(strtoupper($estado));

        if ($this->estado !== 'A')
            $this->estado = 'I';
    }

}
?>