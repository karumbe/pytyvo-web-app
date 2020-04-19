<?php
include_once 'app/nucleo/ValidadorBaseComImpl.inc.php';
include_once 'app/modulos/depar/modelo/DeparDaoFactory.inc.php';
include_once 'Ciudad.inc.php';

class CiudadValidador extends ValidadorBaseComImpl {

    protected $clase_modelo = 'Ciudad';

    private $repositorio_departamen = null;

    private $departamen = 0;

    private $error_departamen = '';

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
    # @Override
    public function __construct($bandera, $repositorio, $modelo = null) {
        parent::__construct($bandera, $repositorio, $modelo);
        $this->repositorio_departamen = DeparDaoFactory::crear_dao();
    }

    /**
    * Valida y establece el código de ciudad.
    *
    * @param integer $codigo
    * Código de ciudad.
    *
    * @return boolean
    * Devuelve true si tiene éxito y false en caso contrario.
    */
    # @Override
    public function validar_codigo($codigo, $minimo = 0, $maximo = 99999) {
        return parent::validar_codigo($codigo);
    }

    /**
    * Valida y establece el código de departamento.
    *
    * @param integer $departamen
    * Código de departamento a ser validado.
    *
    * @return boolean
    * Devuelve true si tiene éxito y false en caso contrario.
    */
    public function validar_departamen($departamen) {
        # inicio { validaciones del parámetro }
        if (!isset($departamen) || !is_int($departamen)) {
            $this->error_departamen =
                'El código de departamento debe ser de tipo entero.';
            return false;
        } else
            $this->departamen = $departamen;
        # fin { validacines del parámetro }

        if ($departamen <= 0) {
            $this->error_departamen = 'Debe seleccionar un departamento.';
            return false;
        } elseif ($departamen > 999) {
            $this->error_departamen =
                'El código de departamento debe ser menor a un mil.';
            return false;
        }

        if (!is_null($this->repositorio_departamen)) {
            if (!$this->repositorio_departamen->codigo_existe($departamen)) {
                $this->error_departamen = 'El código de departamento no existe.';
                return false;
            }

            if (!$this->repositorio_departamen->esta_vigente($departamen)) {
                $this->error_departamen = 'El código de departamento no está vigente.';
                return false;
            }
        } else {
            $this->error_departamen =
                'El repositorio de departamentos no es válido.';
            return false;
        }

        $this->error_departamen = '';
        return true;
    }

    /**
    * Valida y establece el nombre de la ciudad.
    *
    * @param string $nombre
    * Nombre de la ciudad.
    *
    * @return boolean
    * Devuelve true si tiene éxito y false en caso contrario.
    */
    # @Override
    public function validar_nombre($nombre, $minimo = 3, $maximo = 30) {
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

        if (!$this->validar_departamen($this->departamen)) {
            $this->error_nombre = 'Debe seleccionar un departamento.';
            return false;
        }
        # fin { validaciones del parámetro }

        if ($this->bandera === 1) {    // agregar.
            if ($this->repositorio->nombre_existe($this->nombre,
                    $this->departamen)) {
                $this->error_nombre = 'El nombre ya existe.';
                return false;
            }
        }

        if ($this->bandera === 2) {    // modificar.
            $modelo = $this->repositorio->obtener_por_nombre($this->nombre,
                $this->departamen);

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
    * Determina si todas las propiedades son válidas.
    *
    * @return boolean
    * Devuelve true si son válidas y false en caso contrario.
    */
    # @Override
    public function es_valido() {
        if (parent::es_valido() &&
                $this->error_departamen === '')
            return true;
        else
            return false;
    }

    /**
    * Devuelve el código de departamento.
    *
    * @return integer
    */
    public function obtener_departamen() {
        return $this->departamen;
    }

    /**
    * Devuelve el error del código de departamento.
    *
    * @return string
    */
    public function obtener_error_departamen() {
        return $this->error_departamen;
    }

    /**
    * Muestra el valor de la propiedad $departamen.
    */
    public function mostrar_departamen() {
        echo 'value="' . $this->departamen . '"';
    }

    /**
    * Muestra el error de la propiedad $departamen.
    */
    public function mostrar_error_departamen() {
        if ($this->error_departamen !== '')
            echo $this->aviso_inicio .
                 ' id="error-departamen">' .
                 $this->error_departamen .
                 $this->aviso_cierre;
        else
            echo $this->aviso_inicio .
                 ' id="error-departamen">' .
                 $this->aviso_cierre;
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
        $modelo = parent::obtener_valores($modelo);

        if (!is_object($modelo))
            return null;

        try {
            $modelo->establecer_departamen($this->departamen);

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
        if (!parent::establecer_valores($modelo))
            return false;

        try {
            $i_departamen = (int) $modelo->obtener_departamen();

            $this->departamen = $i_departamen;

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
        $this->validar_departamen($this->departamen);
        $this->validar_nombre($this->nombre);
        $this->validar_vigente($this->vigente);
    }

}
?>
