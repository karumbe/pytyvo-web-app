<?php
abstract class DaoBase {

    public function obtener_por_codigo($codigo) {}

    public function obtener_por_nombre($nombre) {}

    public function obtener_todos($condicion_filtrado = null) {}

    public function obtener($expresion, $condicion_filtrado = null) {}

    public function agregar($usuario, $modelo) {}

    public function modificar($usuario, $modelo) {}

    public function borrar($usuario, $codigo) {}

    public function esta_relacionado($codigo) {}

    public function obtener_dto() {}

    protected function cargar_datos($modelo, $datos) {}

}
?>
