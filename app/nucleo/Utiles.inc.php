<?php
class Utiles {

    /**
    * Elimina todos los espacios iniciales y finales de la expresión de
    * caracteres especificada.
    *
    * @param string $expresion
    * Especifica una expresión de caracteres para eliminar los espacios
    * iniciales y finales.
    *
    * @return string
    * Devuelve la expresión especificada sin espacios iniciales o finales.
    */
    public static function alltrim($expresion) {
        $expresion = trim($expresion);

        do {
            $expresion = str_replace('  ', ' ', $expresion);
        } while (strpos($expresion, '  ') > 0);

        return $expresion;
    }

    /**
    * Devuelve la expresión de caracteres especificada en mayúsculas.
    *
    * @param string $expresion
    * Especifica la expresión de caracteres que upper() convertirá a mayúsculas.
    *
    * @return string
    */
    public static function upper($expresion) {
        return mb_convert_case($expresion, MB_CASE_UPPER, 'UTF-8');
    }

    /**
    * Devuelve una expresión de caracteres especificada en letras minúsculas.
    *
    * @param string $expresion
    * Especifica la expresión de caracteres que lower() convertirá a minúsculas.
    *
    * @return string
    */
    public static function lower($expresion) {
        return mb_convert_case($expresion, MB_CASE_LOWER, 'UTF-8');
    }

    /**
    * Devuelve de una expresión de caracteres una cadena en mayúscula según
    * corresponda para nombres propios.
    *
    * @param string $expresion
    * Especifica la expresión de caracteres desde la cual proper() devuelve una
    * cadena de caracteres en mayúscula.
    *
    * @return string
    */
    public static function proper($expresion) {
        return mb_convert_case($expresion, MB_CASE_TITLE, 'UTF-8');
    }

    /**
    * Prepara una expresión de caracteres especificada para realizar búsquedas
    * SQL (Structured Query Language).
    *
    * @param string $expresion
    * Especifica la expresión de caracteres que será preparada.
    *
    * @return string
    */
    public static function preparar_para_buscar($expresion) {
        $expresion = self::alltrim(self::upper($expresion));

        if ($expresion !== '')
            $expresion = '%' . $expresion . '%';

        return $expresion;
    }

    /**
    * Determina si una variable está definida y no está vacía.
    *
    * @param string $variable
    * La variable a ser evaluada.
    *
    * @return boolean
    * Devuelve true si la variable está definida y no está vacía, false en caso
    * contrario.
    */
    public static function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable))
            return true;

        return false;
    }

    /**
    * Determina si una variable está definida y es de tipo entero.
    *
    * @param integer $variable
    * La variable a ser evaluada.
    *
    * @return boolean
    * Devuelve true si la variable está definida y es de tipo entero, false
    * en caso contrario.
    */
    public static function es_entero($variable) {
        if (isset($variable))
            if (gettype($variable) === 'integer')
                return true;

        return false;
    }

    /**
    * Determina si una variable está definida, no esté vacía, sea de tipo
    * entero y mayor que cero.
    *
    * @param integer $variable
    * La variable a ser evaluada.
    *
    * @return boolean
    * Devuelve true si la variable está definida, no esté vacía, sea de tipo
    * entero y mayor que cero, false en caso contrario.
    */
    public static function es_entero_positivo($variable) {
        if (self::variable_iniciada($variable))
            if (gettype($variable) === 'integer' &&
                    $variable > 0)
                return true;

        return false;
    }

    /**
    * Determina si un número entero está dentro de un cierto rango.
    *
    * @param integer $valor
    * La variable a ser evaluada.
    *
    * @param integer $minimo
    * Especifica el valor mínimo.
    *
    * @param integer $maximo
    * Especifica el valor máximo.
    *
    * @return boolean
    * Devuelve true si la variable se encuentra dentro del rango
    * especificado y false en caso contrario.
    */
    public static function rango_entero($valor, $minimo, $maximo) {
        if (self::es_entero($valor) &&
                self::es_entero($minimo) &&
                self::es_entero($maximo))
            if ($maximo > $minimo)
                if ($valor >= $minimo && $valor <= $maximo)
                    return true;

        return false;
    }

    /**
    * Determina si un texto se encuentra dentro de cierta longitud.
    *
    * @param string $valor
    * La variable a ser evaluada.
    *
    * @param integer $minima
    * Especifica la longitud mínima.
    *
    * @param integer $maxima
    * Especifica la longitud máxima.
    *
    * @return boolean
    * Devuelve true si la variable se encuentra dentro de la longitud
    * especificada y false en caso contrario.
    */
    public static function longitud_texto($valor, $minima, $maxima) {
        if (is_string($valor) &&
                self::es_entero($minima) &&
                self::es_entero($maxima))
            if ($maxima >= $minima)
                if (mb_strlen($valor) >= $minima &&
                        mb_strlen($valor) <= $maxima)
                    return true;

        return false;
    }

    /**
    * Crea la paginación de resultados de búsquedas.
    *
    * @param integer $pagina
    * Página actual.
    *
    * @param integer $total
    * Total de páginas.
    *
    * @param string $url
    * URL para los enlaces a las diferentes páginas.
    *
    * @return string
    * Devuelve una cadena de caracteres con el HTML de la paginación.
    */
    public static function obtener_paginacion($pagina, $total, $url) {
        $html =  '<nav aria-label="Page navigation"><ul class="pagination justify-content-end">';

        if ($total > 5)
            $html .=  '<li class="page-item"><a class="page-link" href="#">Inicio</a></li>';

        for ($i = 1; $i <= $total; $i++) {
            if ($i !== $pagina)
                $html .=  '<li class="page-item"><a class="page-link" href="' . $url . $i . '">' . $i . '</a></li>';
            else
                $html .=  '<li class="page-item active"><a class="page-link" href="#">' . $i . '<span class="sr-only">(current)</span></a></li>';
        }

        if ($total > 5)
            $html .=  '<li class="page-item"><a class="page-link" href="#">Fin</a></li>';

        $html .=  '</ul></nav>';

        return $html;
    }

    /**
    * Devuelve una expresión de caracteres con la fecha/hora actual.
    * Ejemplo: mié. 25 sep. 13:36
    *
    * @return string
    */
    public static function obtener_fecha_hora_actual_texto() {
        $dia = utf8_decode(self::obtener_dia());
        $dia = substr(strtolower($dia), 0, 3) . '.';
        $dia = utf8_encode($dia);
        // $dia = self::reemplazar_por_entidad_html($dia);
        $mes = substr(self::lower(self::obtener_mes()), 0, 3). '.';
        $hora = date('G') . ':' . date('i');

        return $dia . ' ' . date('d') . ' ' . $mes . ' ' . $hora;
    }

    /**
    * Devuelve el día de la semana a partir de una expresión de carácter.
    *
    * @param string $expresion
    * Especifica la expresión de carácter desde la cual se obtendrá el día de
    * la semana.
    *
    * @return string
    * Devuelve una expresión de caracteres con el día de la semana o una
    * expresión de carácter vacía en caso de que el parámetro sea inválido.
    */
    public static function obtener_dia($expresion = null) {
        if (is_null($expresion))
            $expresion = date('N');

        $expresion = (int) $expresion;

        switch ($expresion) {
            case 1:
                $dia = 'Lunes';
                break;
            case 2:
                $dia = 'Martes';
                break;
            case 3:
                $dia = 'Miércoles';
                break;
            case 4:
                $dia = 'Jueves';
                break;
            case 5:
                $dia = 'Viernes';
                break;
            case 6:
                $dia = 'Sábado';
                break;
            case 7:
                $dia = 'Domingo';
                break;
            default:
                $dia = '';
                break;
        }

        return $dia;
    }

    /**
    * Devuelve el nombre del mes a partir de una expresión numérica.
    *
    * @param string $expresion
    * Especifica la expresión de caracteres desde la cual se obtendrá el mes del
    * año.
    *
    * @return string
    * Devuelve una expresión de caracteres con el mes del año o una expresión
    * de carácter vacía en caso de que el parámetro sea inválido.
    */
    public static function obtener_mes($expresion = null) {
        if (is_null($expresion))
            $expresion = date('n');

        $expresion = (int) $expresion;

        switch ($expresion) {
            case 1:
                $mes = 'Enero';
                break;
            case 2:
                $mes = 'Febrero';
                break;
            case 3:
                $mes = 'Marzo';
                break;
            case 4:
                $mes = 'Abril';
                break;
            case 5:
                $mes = 'Mayo';
                break;
            case 6:
                $mes = 'Junio';
                break;
            case 7:
                $mes = 'Julio';
                break;
            case 8:
                $mes = 'Agosto';
                break;
            case 9:
                $mes = 'Septiembre';
                break;
            case 10:
                $mes = 'Octubre';
                break;
            case 11:
                $mes = 'Noviembre';
                break;
            case 12:
                $mes = 'Diciembre';
                break;
            default:
                $mes = '';
                break;
        }

        return $mes;
    }

    /**
    * Devuelve una expresión de caracteres con los caracteres especiales
    * reemplazados por código numéricos de entidades html.
    *
    * @param string $expresion
    * Especifica la expresión de caracteres en la cual se realizará el
    * reemplazo.
    *
    * @return string
    * Devuelve una expresión de caracteres con los caracteres especiales
    * reemplazados o una expresión de carácter vacía en caso de que el
    * parámetro sea inválido.
    */
    public static function reemplazar_por_entidad_html($expresion = null) {
        if (is_null($expresion) || gettype($expresion) !== 'string')
            $expresion = '';

        if ($expresion !== '') {
            $expresion = str_replace('á', '&#225;', $expresion);
            $expresion = str_replace('é', '&#233;', $expresion);
            $expresion = str_replace('í', '&#237;', $expresion);
            $expresion = str_replace('ó', '&#243;', $expresion);
            $expresion = str_replace('ú', '&#250;', $expresion);
            $expresion = str_replace('ñ', '&#241;', $expresion);
            $expresion = str_replace('&', '&#38;', $expresion);
            $expresion = str_replace('õ', '&#245;', $expresion);
        }

        return $expresion;
    }

    /**
    * Determina si una variable es de tipo cadena y corresponde al formato de
    * fecha aaaa-mm-dd.
    *
    * @param string $variable
    * La variable a ser evaluada.
    *
    * @return boolean
    * Devuelve true si la variable es de tipo cadena y corresponde al formato de
    * fecha aaaa-mm-dd, false en caso contrario.
    */
    public static function es_fecha($variable) {
        if (is_null($variable) || gettype($variable) !== 'string')
            return false;

        if (date('Y-m-d', strtotime($variable)) === $variable)
            return true;

        return false;
    }

    /**
    * Determina la cantidad de días transcurridos entre dos fechas.
    *
    * @param string $inicio
    * La fecha inicial, debe estar en formato aaaa-mm-dd.
    *
    * @param string $fin
    * La fecha final, debe estar en formato aaaa-mm-dd.
    *
    * @return integer|null
    * Devuelve un entero si se pudo realizar el cálculo, null en caso contrario.
    */
    public static function diferencia_entre_fechas($inicio, $fin) {
        if (!self::es_fecha($inicio) || !self::es_fecha($fin))
            return null;

        $inicio = new DateTime($inicio);
        $fin = new DateTime($fin);
        $diferencia = $inicio->diff($fin);

        return (int) $diferencia->format('%R%a');
    }

    /**
    * Devuelve el tipo de petición.
    *
    * @return string
    */
    public static function obtener_peticion() {
        $peticion = '';

        if (isset($_POST['crear']))
            $peticion = 'crear';
        elseif (isset($_POST['leer']))
            $peticion = 'leer';
        elseif (isset($_POST['actualizar']))
            $peticion = 'actualizar';
        elseif (isset($_POST['borrar']))
            $peticion = 'borrar';
        elseif (isset($_POST['accion_solicitada']))
            $peticion = $_POST['accion_solicitada'];

        return $peticion;
    }

    /**
    * Devuelve el título de la página solicitada por el usuario.
    *
    * @param string $peticion
    * La petición CRUD del usuario.
    *
    * @param string $repositorio
    * El nombre del repositorio.
    *
    * @return string
    */
    public static function obtener_titulo($peticion, $repositorio) {
        $titulo = '';

        if (self::variable_iniciada($peticion) &&
                self::variable_iniciada($repositorio)) {
            switch ($peticion) {
                case 'crear':
                    if ($repositorio !== 'Familia' &&
                            $repositorio !== 'Unidad de medida' &&
                            $repositorio !== 'Marca' &&
                            $repositorio !== 'Maquina')
                        $titulo = 'Nuevo';
                    else
                        $titulo = 'Nueva';

                    break;
                case 'leer':
                    $titulo = 'Ver';
                    break;
                case 'actualizar':
                    $titulo = 'Editar';
                    break;
                case 'borrar':
                    $titulo = 'Eliminar';
                    break;
            }

            $titulo = $titulo . ' | ' . $repositorio;
        }

        return $titulo;
    }

    /**
    * Devuelve la clase CSS que será utilizada por el botón submit del
    * formulario.
    *
    * @param string $peticion
    * La petición CRUD del usuario.
    *
    * @return string
    */
    public static function obtener_clase_boton_submit($peticion) {
        $texto = '';

        if (self::variable_iniciada($peticion))
            switch ($peticion) {
                case 'crear':
                    $texto = 'btn btn-primary btn-md';
                    break;
                case 'actualizar':
                    $texto = 'btn btn-success btn-md';
                    break;
                case 'borrar':
                    $texto = 'btn btn-danger btn-md';
                    break;
            }

        return $texto;
    }

    /**
    * Devuelve el título que será utilizado por el botón submit del
    * formulario.
    *
    * @param string $peticion
    * La petición CRUD del usuario.
    *
    * @return string
    */
    public static function obtener_titulo_boton_submit($peticion) {
        $texto = '';

        if (self::variable_iniciada($peticion))
            switch ($peticion) {
                case 'crear':
                    $texto = 'Guardar los cambios y cerrar formulario';
                    break;
                case 'actualizar':
                    $texto = 'Actualizar los cambios y cerrar formulario';
                    break;
                case 'borrar':
                    $texto = 'Eliminar registro y cerrar formulario';
                    break;
            }

        return $texto;
    }

    /**
    * Devuelve el texto que será utilizado por el botón submit del
    * formulario.
    *
    * @param string $peticion
    * La petición CRUD del usuario.
    *
    * @return string
    */
    public static function obtener_texto_boton_submit($peticion) {
        $texto = '';

        if (self::variable_iniciada($peticion))
            switch ($peticion) {
                case 'crear':
                    $texto = 'Guardar';
                    break;
                case 'actualizar':
                    $texto = 'Actualizar';
                    break;
                case 'borrar':
                    $texto = 'Eliminar';
                    break;
            }

        return $texto;
    }

    /**
    * Devuelve el texto que será utilizado por el botón cancelar del
    * formulario.
    *
    * @param string $peticion
    * La petición CRUD del usuario.
    *
    * @return string
    */
    public static function obtener_texto_boton_cancelar($peticion) {
        $texto = '';

        if (self::variable_iniciada($peticion))
            if ($peticion == 'leer')
                $texto = 'Cerrar';
            else
                $texto = 'Cancelar';

        return $texto;
    }

    /**
    * Devuelve el título que será utilizado por el botón cancelar del
    * formulario.
    *
    * @param string $peticion
    * La petición CRUD del usuario.
    *
    * @return string
    */
    public static function obtener_titulo_boton_cancelar($peticion) {
        $texto = '';

        if (self::variable_iniciada($peticion))
            switch ($peticion) {
                case 'crear':
                case 'actualizar':
                    $texto =
                        'Cancelar los cambios y cerrar formulario';
                    break;
                case 'borrar':
                    $texto =
                        'Cancelar eliminación y cerrar formulario';
                    break;
                case 'leer':
                    $texto = 'Cerrar formulario';
                    break;
            }

        return $texto;
    }

    /**
    * Proporciona mensaje de retroalimentación contextual para
    * acciones típicas de los usuarios con un puñado de mensajes de
    * alerta disponibles y flexibles.
    *
    * @param string $mensaje
    * El mensaje a mostrar.
    *
    * @param string $tipo
    * El tipo de mensaje a mostrar.
    *
    * @return void
    */
    public static function mostrar_mensaje($mensaje, $tipo = 'peligro') {
        $aviso_cierre = '</div>';
        $aviso = '';

        if (self::variable_iniciada($mensaje) &&
                self::variable_iniciada($tipo)) {
            # Determina el tipo de mensaje a mostrar.
            switch ($tipo) {
                case 'primario':
                    $aviso_inicio =
                        '<div class="alert alert-primary" role="alert">';
                    break;
                case 'secundario':
                    $aviso_inicio =
                        '<div class="alert alert-secondary" role="alert">';
                    break;
                case 'exito':
                    $aviso_inicio =
                        '<div class="alert alert-success" role="alert">';
                    break;
                case 'peligro':
                    $aviso_inicio =
                        '<div class="alert alert-danger" role="alert">';
                    break;
                case 'advertencia':
                    $aviso_inicio =
                        '<div class="alert alert-warning" role="alert">';
                    break;
                case 'informacion':
                    $aviso_inicio =
                        '<div class="alert alert-info" role="alert">';
                    break;
                case 'claro':
                    $aviso_inicio =
                        '<div class="alert alert-light" role="alert">';
                    break;
                case 'oscuro':
                    $aviso_inicio =
                        '<div class="alert alert-dark" role="alert">';
                    break;
            }

            # Establece el mensaje.
            $aviso = $aviso_inicio . $mensaje . $aviso_cierre;
        }

        echo $aviso;
    }

    /**
    * Determina si una variable está definida y es de tipo texto.
    *
    * @param string $variable
    * La variable a ser evaluada.
    *
    * @return boolean
    * Devuelve true si la variable está definida y es de tipo texto, false
    * en caso contrario.
    */
    public static function es_texto($variable) {
        if (isset($variable))
            if (gettype($variable) === 'string')
                return true;

        return false;
    }

    /**
    * Filtra una variable con el filtro que se indique.
    *
    * Elimina etiquetas, opcionalmente elimina o codifica caracteres
    * especiales.
    *
    * @param string $variable
    * La cadena de caracteres a ser filtrada.
    *
    * @return string
    * Devuelve una cadena de caracteres filtrada.
    */
    public static function limpiar_entrada($variable) {
        if (!self::es_texto($variable))
            return '';

        $texto = htmlspecialchars_decode($variable, ENT_QUOTES);
        //$texto = filter_var($texto, FILTER_SANITIZE_STRING);

        return $texto;
    }

    /**
    * Convierte caracteres especiales en entidades HTML.
    *
    * @param string $variable
    * La cadena de caracteres a ser convertida.
    *
    * @return string
    * Devuelve una cadena de caracteres convertida.
    */
    public static function escapar_salida($variable) {
        if (!self::es_texto($variable))
            return '';

        $texto = htmlspecialchars($variable, ENT_QUOTES);

        return $texto;
    }

}
?>
