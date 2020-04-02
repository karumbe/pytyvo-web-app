<?php
include_once 'app/nucleo/DaoBaseComImpl.inc.php';
include_once 'Usuario.inc.php';

class UsuarioDaoComImpl extends DaoBaseComImpl {

    protected $com = 'Pytyvo.Usuario';

    /**
    * Verifica si un nombre de usuario existe.
    *
    * @param string $nombre_usuario
    * Nombre de usuario.
    *
    * @return boolean
    * true si existe u ocurre un error y false en caso contrario.
    */
    public function usuario_existe($nombre_usuario) {
        $usuario_existe = true;

        try {
            $this->conectar();

            if (isset($this->conexion)) {
                $resultado = $this->conexion->UsuarioExiste($nombre_usuario);

                if (!$resultado) {
                    $usuario_existe = false;
                }
            }
        } catch (Exception $ex) {
            print 'ERROR: ' . $ex->getMessage() . '<br>';
        }

        $this->desconectar();

        return $usuario_existe;
    }

    /**
    * Realiza una búsqueda por nombre de usuario.
    *
    * @param string $nombre_usuario
    * Nombre de usuario.
    *
    * @return object|null
    * object si tiene éxito y null en caso contrario.
    */
    public function obtener_por_usuario($nombre_usuario) {
        $usuario = null;

        try {
            $this->conectar();

            if (isset($this->conexion)) {
                $resultado = $this->conexion->ObtenerPorUsuario($nombre_usuario);

                if ($xml = simplexml_load_string($resultado)) {
                    foreach ($xml as $fila) {
                        $usuario = new Usuario();

                        $i_codigo = (int) $fila->codigo;
                        $s_nombre = (string) $fila->nombre;
                        $s_usuario = (string) $fila->usuario;
                        $s_clave = (string) $fila->clave;
                        $b_vigente = (boolean)
                            ($fila->vigente == 'true') ? true : false;

                        $usuario->establecer_codigo($i_codigo);
                        $usuario->establecer_nombre($s_nombre);
                        $usuario->establecer_usuario($s_usuario);
                        $usuario->establecer_clave($s_clave);
                        $usuario->establecer_vigente($b_vigente);
                    }
                } else {
                    # print 'No se ha podido cargar la cadena XML.' . '<br>';
                }
            }
        } catch (Exception $ex) {
            print 'ERROR: ' . $ex->getMessage() . '<br>';
        }

        $this->desconectar();

        return $usuario;
    }

}
?>
