<?php
include_once 'app/nucleo/ValidadorBaseComImpl.inc.php';
include_once 'app/modulos/maquina/modelo/MaquinaDaoFactory.inc.php';
include_once 'app/modulos/marca_ot/modelo/MarcaOtDaoFactory.inc.php';
include_once 'Modelo.inc.php';

class ModeloValidador extends ValidadorBaseComImpl {

    protected $clase_modelo = 'Modelo';

    private $repositorio_maquina = null;
    private $repositorio_marca = null;

    private $maquina = 0;
    private $marca = 0;

    private $error_maquina = '';
    private $error_marca = '';

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
        $this->repositorio_maquina = MaquinaDaoFactory::crear_dao();
        $this->repositorio_marca = MarcaOtDaoFactory::crear_dao();
    }

    /**
    * Valida y establece el código de máquina.
    *
    * @param integer $maquina
    * Código de máquina a ser validado.
    *
    * @return boolean
    * Devuelve true si tiene éxito y false en caso contrario.
    */
    public function validar_maquina($maquina) {
        # inicio { validaciones del parámetro }
        if (!isset($maquina) || !is_int($maquina)) {
            $this->error_maquina =
                'El código de máquina debe ser de tipo entero.';
            return false;
        } else
            $this->maquina = $maquina;
        # fin { validacines del parámetro }

        if ($maquina <= 0) {
            $this->error_maquina = 'Debe seleccionar una máquina.';
            return false;
        } elseif ($maquina > 999) {
            $this->error_maquina =
                'El código de máquina debe ser menor a un mil.';
            return false;
        }

        if (!is_null($this->repositorio_maquina)) {
            if (!$this->repositorio_maquina->codigo_existe($maquina)) {
                $this->error_maquina = 'El código de máquina no existe.';
                return false;
            }

            if (!$this->repositorio_maquina->esta_vigente($maquina)) {
                $this->error_maquina = 'El código de máquina no está vigente.';
                return false;
            }
        } else {
            $this->error_maquina =
                'El repositorio de máquinas no es válido.';
            return false;
        }

        $this->error_maquina = '';
        return true;
    }

    /**
    * Valida y establece el código de marca.
    *
    * @param integer $marca
    * Código de marca a ser validado.
    *
    * @return boolean
    * Devuelve true si tiene éxito y false en caso contrario.
    */
    public function validar_marca($marca) {
        # inicio { validaciones del parámetro }
        if (!isset($marca) || !is_int($marca)) {
            $this->error_marca =
                'El código de marca debe ser de tipo entero.';
            return false;
        } else
            $this->marca = $marca;
        # fin { validacines del parámetro }

        if ($marca <= 0) {
            $this->error_marca = 'Debe seleccionar una marca.';
            return false;
        } elseif ($marca > 9999) {
            $this->error_marca =
                'El código de marca debe ser menor a diez mil.';
            return false;
        }

        if (!is_null($this->repositorio_marca)) {
            if (!$this->repositorio_marca->codigo_existe($marca)) {
                $this->error_marca = 'El código de marca no existe.';
                return false;
            }

            if (!$this->repositorio_marca->esta_vigente($marca)) {
                $this->error_marca = 'El código de marca no está vigente.';
                return false;
            }
        } else {
            $this->error_marca =
                'El repositorio de marcas no es válido.';
            return false;
        }

        $this->error_marca = '';
        return true;
    }

    /**
    * Valida y establece el nombre del modelo.
    *
    * @param string $nombre
    * Nombre del modelo.
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

        if (!$this->validar_maquina($this->maquina)) {
            $this->error_nombre = 'Debe seleccionar una máquina.';
            return false;
        }

        if (!$this->validar_marca($this->marca)) {
            $this->error_nombre = 'Debe seleccionar una marca.';
            return false;
        }
        # fin { validaciones del parámetro }

        if ($this->bandera === 1) {    // agregar.
            if ($this->repositorio->nombre_existe($this->nombre, $this->maquina,
                    $this->marca)) {
                $this->error_nombre = 'El nombre ya existe.';
                return false;
            }
        }

        if ($this->bandera === 2) {    // modificar.
            $modelo = $this->repositorio->obtener_por_nombre($this->nombre,
                $this->maquina, $this->marca);

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
                $this->error_maquina === '' &&
                $this->error_marca === '')
            return true;
        else
            return false;
    }

    /**
    * Devuelve el código de máquina.
    *
    * @return integer
    */
    public function obtener_maquina() {
        return $this->maquina;
    }

    /**
    * Devuelve el código de marca.
    *
    * @return integer
    */
    public function obtener_marca() {
        return $this->marca;
    }

    /**
    * Devuelve el error del código de máquina.
    *
    * @return string
    */
    public function obtener_error_maquina() {
        return $this->error_maquina;
    }

    /**
    * Devuelve el error del código de marca.
    *
    * @return string
    */
    public function obtener_error_marca() {
        return $this->error_marca;
    }

    /**
    * Muestra el valor de la propiedad $maquina.
    */
    public function mostrar_maquina() {
        echo 'value="' . $this->maquina . '"';
    }

    /**
    * Muestra el valor de la propiedad $marca.
    */
    public function mostrar_marca() {
        echo 'value="' . $this->marca . '"';
    }

    /**
    * Muestra el error de la propiedad $maquina.
    */
    public function mostrar_error_maquina() {
        if ($this->error_maquina !== '')
            echo $this->aviso_inicio .
                 ' id="error-maquina">' .
                 $this->error_maquina .
                 $this->aviso_cierre;
        else
            echo $this->aviso_inicio .
                 ' id="error-maquina">' .
                 $this->aviso_cierre;
    }

    /**
    * Muestra el error de la propiedad $marca.
    */
    public function mostrar_error_marca() {
        if ($this->error_marca !== '')
            echo $this->aviso_inicio .
                 ' id="error-marca">' .
                 $this->error_marca .
                 $this->aviso_cierre;
        else
            echo $this->aviso_inicio .
                 ' id="error-marca">' .
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
            $modelo->establecer_maquina($this->maquina);
            $modelo->establecer_marca($this->marca);

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
            $i_maquina = (int) $modelo->obtener_maquina();
            $i_marca = (int) $modelo->obtener_marca();

            $this->maquina = $i_maquina;
            $this->marca = $i_marca;

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
        $this->validar_maquina($this->maquina);
        $this->validar_marca($this->marca);
        $this->validar_nombre($this->nombre);
        $this->validar_vigente($this->vigente);
    }

}
?>
