<?php
include_once 'Utiles.inc.php';
include_once 'ValidadorBase.inc.php';

abstract class ValidadorBaseComImpl extends ValidadorBase {

    protected $aviso_inicio = '<div class="alert alert-danger alerta-peligro" role="alert"';
    protected $aviso_cierre = '</div>';
    protected $clase_modelo = '';

    protected $bandera = 0;
    protected $repositorio = null;

    protected $codigo = 0;
    protected $nombre = '';
    protected $vigente = false;

    protected $error_bandera = '';
    protected $error_repositorio = '';

    protected $error_codigo = '';
    protected $error_nombre = '';
    protected $error_vigente = '';

    /**
    * Constructor.
    *
    * @param integer $bandera
    * La bandera que especifica el tipo de validación a realizar.
    *
    * @param object $repositorio
    * El objeto que permite el acceso a la base de datos.
    *
    * @param object $modelo
    * El objeto del cual se obtendrán los datos.
    */
    public function __construct($bandera, $repositorio, $modelo = null) {
        $this->validar_bandera($bandera);
        $this->validar_repositorio($repositorio);
        $this->establecer_valores($modelo);
    }

    /**
    * Valida y establece el código del registro.
    *
    * @param integer $codigo
    * Código del registro.
    *
    * @return boolean
    * Devuelve true si tiene éxito y false en caso contrario.
    */
    # @Override
    public function validar_codigo($codigo, $minimo = 0, $maximo = 9999) {
        # inicio { validaciones del parámetro }
        if (!isset($codigo) || !is_int($codigo)) {
            $this->error_codigo = 'Código: Debe ser de tipo entero.';
            return false;
        } else
            $this->codigo = $codigo;

        if ($codigo < $minimo) {
            $this->error_codigo =
                'Código: Debe ser mayor o igual a ' . $minimo . '.';
            return false;
        } elseif ($codigo > $maximo) {
            $this->error_codigo =
                'Código: Debe ser menor o igual a ' . $maximo . '.';
            return false;
        }

        if ($this->error_bandera !== '') {
            $this->error_codigo =
                'Código: Error al validar el parámetro $bandera.';
            return false;
        }

        if ($this->error_repositorio !== '') {
            $this->error_codigo =
                'Código: Error al validar el parámetro $repositorio.';
            return false;
        }
        # fin { validacines del parámetro }

        if ($this->bandera === 1) {    // agregar.
            if ($codigo !== 0) {
                $this->error_codigo = 'Código: Debe ser igual a cero.';
                return false;
            }
        }

        if ($this->bandera === 2) {    // modificar.
            if ($codigo <= 0) {
                $this->error_codigo = 'Código: Debe ser mayor que cero.';
                return false;
            }

            if (!$this->repositorio->codigo_existe($codigo)) {
                $this->error_codigo = 'Código: No existe.';
                return false;
            }
        }

        $this->error_codigo = '';
        return true;
    }

    /**
    * Valida y establece el nombre del registro.
    *
    * @param string $nombre
    * Nombre del registro.
    *
    * @return boolean
    * Devuelve true si tiene éxito y false en caso contrario.
    */
    # @Override
    public function validar_nombre($nombre, $minimo = 6, $maximo = 30) {
        # inicio { validaciones del parámetro }
        if (!$this->variable_iniciada($nombre) || !is_string($nombre)) {
            $this->error_nombre =
                'El nombre no puede quedar en blanco.';
            return false;
        } else
            $this->nombre = Utiles::alltrim(Utiles::upper($nombre));

        if (strlen(utf8_decode($this->nombre)) < $minimo) {
            $this->error_nombre =
                'El nombre es demasiado corto (mínimo ' . $minimo .
                ' caracteres).';
            return false;
        } elseif (strlen(utf8_decode($this->nombre)) > $maximo) {
            $this->error_nombre =
                'El nombre es demasiado largo (máximo ' . $maximo .
                ' caracteres).';
            return false;
        }

        if ($this->error_bandera !== '') {
            $this->error_nombre = 'ERROR: La bandera no es válida.';
            return false;
        }

        if ($this->error_repositorio !== '') {
            $this->error_nombre =
                'ERROR: El repositorio no es válido.';
            return false;
        }

        if (!$this->validar_codigo($this->codigo)) {
            $this->error_nombre = 'ERROR: El código no es válido.';
            return false;
        }
        # fin { validaciones del parámetro }

        if ($this->bandera === 1) {    // agregar.
            if ($this->repositorio->nombre_existe($this->nombre)) {
                $this->error_nombre = 'El nombre ya existe.';
                return false;
            }
        }

        if ($this->bandera === 2) {    // modificar.
            $modelo = $this->repositorio->obtener_por_nombre($this->nombre);

            if (is_object($modelo)) {
                if ($modelo->obtener_codigo() !== $this->codigo) {
                    $this->error_nombre = 'El nombre ya existe.';
                    return false;
                }
            }
        }

        $this->error_nombre = '';
        return true;
    }

    /**
    * Valida y establece la vigencia del registro.
    *
    * @param boolean $vigente
    * Vigencia del registro.
    *
    * @return boolean
    * Devuelve true si tiene éxito y false en caso contrario.
    */
    # @Override
    public function validar_vigente($vigente) {
        if (!isset($vigente) || !is_bool($vigente)) {
            $this->error_vigente = 'Vigente: Debe ser de tipo lógico.';
            return false;
        } else
            $this->vigente = $vigente;

        $this->error_vigente = '';
        return true;
    }

    /**
    * Determina si todas las propiedades son válidas.
    *
    * @return boolean
    * Devuelve true si son válidas y false en caso contrario.
    */
    # @Override
    public function es_valido() {
        $this->validar();

        if ($this->error_bandera === '' &&
                $this->error_repositorio === '' &&
                $this->error_codigo === '' &&
                $this->error_nombre === '' &&
                $this->error_vigente === '')
            return true;
        else
            return false;
    }

    /**
    * Devuelve un objeto con los datos validados.
    *
    * @return object|null
    * Devuelve un objeto si tiene éxito y nulo en caso contrario.
    */
    # @Override
    public function obtener_modelo() {
        $modelo = null;

        if ($this->es_valido()) {
            try {
                $modelo = $this->obtener_valores(new $this->clase_modelo());
            } catch (Exception $ex) {
                print 'ERROR: ' . $ex->getMessage() . '<br>';
                die();
            }
        }

        return $modelo;
    }

    /**
    * Devuelve el código del registro.
    *
    * @return integer
    */
    # @Override
    public function obtener_codigo() {
        return $this->codigo;
    }

    /**
    * Devuelve el nombre del registro.
    *
    * @return string
    */
    # @Override
    public function obtener_nombre() {
        return $this->nombre;
    }

    /**
    * Devuelve la vigencia del registro.
    *
    * @return boolean
    */
    # @Override
    public function esta_vigente() {
        return $this->vigente;
    }

    /**
    * Devuelve el error del código del registro.
    *
    * @return string
    */
    # @Override
    public function obtener_error_codigo() {
        return $this->error_codigo;
    }

    /**
    * Devuelve el error del nombre del registro.
    *
    * @return string
    */
    # @Override
    public function obtener_error_nombre() {
        return $this->error_nombre;
    }

    /**
    * Devuelve el error de la vigencia del registro.
    *
    * @return string
    */
    # @Override
    public function obtener_error_vigente() {
        return $this->error_vigente;
    }

    /**
    * Muestra el valor de la propiedad $codigo.
    */
    # @Override
    public function mostrar_codigo() {
        echo 'value="' . $this->codigo . '"';
    }

    /**
    * Muestra el valor de la propiedad $nombre.
    */
    # @Override
    public function mostrar_nombre() {
        if ($this->nombre !== '')
            echo 'value="' . $this->nombre . '"';
    }

    /**
    * Muestra el valor de la propiedad $vigente.
    */
    # @Override
    public function mostrar_vigente() {
        if ($this->vigente)
            echo 'checked';
    }

    /**
    * Muestra el error de la propiedad $codigo.
    */
    # @Override
    public function mostrar_error_codigo() {
        if ($this->error_codigo !== '')
            echo $this->aviso_inicio .
                 $this->error_codigo .
                 $this->aviso_cierre;
    }

    /**
    * Muestra el error de la propiedad $nombre.
    */
    # @Override
    public function mostrar_error_nombre() {
        if ($this->error_nombre !== '')
            echo $this->aviso_inicio .
                 ' id="error-nombre">' .
                 $this->error_nombre .
                 $this->aviso_cierre;
        else
            echo $this->aviso_inicio .
                 ' id="error-nombre">' .
                 $this->aviso_cierre;
    }

    /**
    * Muestra el error de la propiedad $vigente.
    */
    # @Override
    public function mostrar_error_vigente() {
        if ($this->error_vigente !== '')
            echo $this->aviso_inicio .
                 $this->error_vigente .
                 $this->aviso_cierre;
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
    # @Override
    protected function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable))
            return true;
        else
            return false;
    }

    /**
    * Valida y establece el valor de la bandera.
    *
    * @param integer $bandera
    * La variable a ser evaluada.
    *
    * @return boolean
    * Devuelve true si tiene éxito y false en caso contrario.
    */
    # @Override
    protected function validar_bandera($bandera) {
        if (!$this->variable_iniciada($bandera) || !is_int($bandera)) {
            $this->error_bandera = 'Bandera: Debe ser de tipo entero.';
            return false;
        } else
            $this->bandera = $bandera;

        if ($bandera < 1 || $bandera > 2) {
            $this->error_bandera = 'Bandera: Debe ser un valor entre 1 y 2.';
            return false;
        }

        $this->error_bandera = '';
        return true;
    }

    /**
    * Valida y establece el objeto repositorio.
    *
    * @param object $repositorio
    * El objeto a ser evaluado.
    *
    * @return boolean
    * Devuelve true si tiene éxito y false en caso contrario.
    */
    # @Override
    protected function validar_repositorio($repositorio) {
        if (!$this->variable_iniciada($repositorio) ||
                !is_object($repositorio)) {
            $this->error_repositorio = 'Repositorio: Debe ser de tipo objeto.';
            return false;
        } else
            $this->repositorio = $repositorio;

        $this->error_repositorio = '';
        return true;
    }

    /**
    * Determina si la variable $modelo es del tipo de objeto de la propiedad
    * $clase_modelo.
    *
    * @param object $modelo
    * El objeto a ser evaluado.
    *
    * @return boolean
    * Devuelve true si el objeto es válido y false en caso contrario.
    */
    # @Override
    protected function es_modelo($modelo) {
        if ($this->variable_iniciada($this->clase_modelo))
            if (isset($modelo) &&
                    is_object($modelo) &&
                    get_class($modelo) === $this->clase_modelo)
                return true;

        return false;
    }

    /**
    * Devuelve un objeto con los valores de las propiedades del validador.
    *
    * @param object $modelo
    * El objeto en el cual se guardarán los valores.
    *
    * @return object|null
    * Devuelve un objeto si tiene éxito y nulo en caso contrario.
    */
    # @Override
    protected function obtener_valores($modelo) {
        if (!$this->es_modelo($modelo))
            return null;

        try {
            $modelo->establecer_codigo($this->codigo);
            $modelo->establecer_nombre($this->nombre);
            $modelo->establecer_vigente($this->vigente);

            return $modelo;
        } catch (Exception $ex) {
            print 'ERROR: ' . $ex->getMessage() . '<br>';
            die();
        }

        return null;
    }

    /**
    * Valida y establece las propiedades del validador a partir de un objeto.
    *
    * @param object $modelo
    * El objeto del cual se obtendrán los datos.
    *
    * @return boolean
    * Devuelve true si tiene éxito y false en caso contrario.
    */
    # @Override
    protected function establecer_valores($modelo) {
        # inicio { validación del parámetro }
        if (!$this->es_modelo($modelo))
            return false;

        if ($this->error_bandera !== '')
            return false;

        if ($this->error_repositorio !== '')
            return false;
        # fin { validación del parámetro }

        try {
            $i_codigo = (int) $modelo->obtener_codigo();
            $s_nombre = (string) $modelo->obtener_nombre();
            $b_vigente = (boolean) $modelo->esta_vigente();

            $this->codigo = $i_codigo;
            $this->nombre = $s_nombre;
            $this->vigente = $b_vigente;

            return true;
        } catch (Exception $ex) {
            print 'ERROR: ' . $ex->getMessage() . '<br>';
            die();
        }

        return false;
    }

    /**
    * Valida todas las propiedades.
    */
    # @Override
    protected function validar() {
        $this->validar_codigo($this->codigo);
        $this->validar_nombre($this->nombre);
        $this->validar_vigente($this->vigente);
    }

}
?>
