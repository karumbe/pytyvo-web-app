<?php
abstract class ValidadorBase {

    public function validar_codigo($codigo) {}

    public function validar_nombre($nombre) {}

    public function validar_vigente($vigente) {}

    public function es_valido() {}

    public function obtener_modelo() {}

    public function obtener_codigo() {}

    public function obtener_nombre() {}

    public function esta_vigente() {}

    public function obtener_error_codigo() {}

    public function obtener_error_nombre() {}

    public function obtener_error_vigente() {}

    public function mostrar_codigo() {}

    public function mostrar_nombre() {}

    public function mostrar_vigente() {}

    public function mostrar_error_codigo() {}

    public function mostrar_error_nombre() {}

    public function mostrar_error_vigente() {}

    protected function variable_iniciada($variable) {}

    protected function validar_bandera($bandera) {}

    protected function validar_repositorio($repositorio) {}

    protected function es_modelo($modelo) {}

    protected function obtener_valores($modelo) {}

    protected function establecer_valores($modelo) {}

    protected function validar() {}

}
?>