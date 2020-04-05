<?php
include_once 'app/nucleo/ValidadorBaseComImpl.inc.php';
include_once 'Moneda.inc.php';

class MonedaValidador extends ValidadorBaseComImpl {

    protected $clase_modelo = 'Moneda';

    private $simbolo = '';
    private $decimales = false;

    private $error_simbolo = '';
    private $error_decimales = '';

    /**
    * Valida y establece el símbolo de la moneda.
    *
    * @param string $simbolo
    * Símbolo de la moneda.
    *
    * @return boolean
    * Devuelve true si tiene éxito y false en caso contrario.
    */
    public function validar_simbolo($simbolo, $minimo = 1, $maximo = 4) {
        # inicio { validaciones del parámetro }
        if (!$this->variable_iniciada($simbolo) || !is_string($simbolo)) {
            $this->error_simbolo =
                'El símbolo no puede quedar en blanco.';
            return false;
        } else
            $this->simbolo = Utiles::alltrim(Utiles::upper($simbolo));

        if (strlen(utf8_decode($this->simbolo)) < $minimo) {
            $this->error_simbolo =
                'El símbolo es demasiado corto (mínimo ' . $minimo .
                ' caracter).';
            return false;
        } elseif (strlen(utf8_decode($this->simbolo)) > $maximo) {
            $this->error_simbolo =
                'El símbolo es demasiado largo (máximo ' . $maximo .
                ' caracteres).';
            return false;
        }

        if ($this->error_bandera !== '') {
            $this->error_simbolo = 'ERROR: La bandera no es válida.';
            return false;
        }

        if ($this->error_repositorio !== '') {
            $this->error_simbolo =
                'ERROR: El repositorio no es válido.';
            return false;
        }

        if (!$this->validar_codigo($this->codigo)) {
            $this->error_simbolo = 'ERROR: El código no es válido.';
            return false;
        }
        # fin { validaciones del parámetro }

        if ($this->bandera === 1) {    // agregar.
            if ($this->repositorio->simbolo_existe($this->simbolo)) {
                $this->error_simbolo = 'El símbolo ya existe.';
                return false;
            }
        }

        if ($this->bandera === 2) {    // modificar.
            $modelo = $this->repositorio->obtener_por_simbolo($this->simbolo);

            if (is_object($modelo)) {
                if ($modelo->obtener_codigo() !== $this->codigo) {
                    $this->error_simbolo = 'El símbolo ya existe.';
                    return false;
                }
            }
        }

        $this->error_simbolo = '';
        return true;
    }

    /**
    * Valida y establece si la moneda utiliza decimales.
    *
    * @param boolean $decimales
    * Decimales de la moneda.
    *
    * @return boolean
    * Devuelve true si tiene éxito y false en caso contrario.
    */
    public function validar_decimales($decimales) {
        if (!isset($decimales) || !is_bool($decimales)) {
            $this->error_decimales = 'Decimales: Debe ser de tipo lógico.';
            return false;
        } else
            $this->decimales = $decimales;

        $this->error_decimales = '';
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
                $this->error_simbolo === '' &&
                $this->error_decimales === '')
            return true;
        else
            return false;
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
    public function utiliza_decimales() {
        return $this->decimales;
    }

    /**
    * Devuelve el error del símbolo de la moneda.
    *
    * @return string
    */
    public function obtener_error_simbolo() {
        return $this->error_simbolo;
    }

    /**
    * Devuelve el error de decimales de la moneda.
    *
    * @return string
    */
    public function obtener_error_decimales() {
        return $this->error_decimales;
    }

    /**
    * Muestra el valor de la propiedad $simbolo.
    */
    public function mostrar_simbolo() {
        echo 'value="' . $this->simbolo . '"';
    }

    /**
    * Muestra el valor de la propiedad $decimales.
    */
    public function mostrar_decimales() {
        if ($this->decimales)
            echo 'checked';
    }

    /**
    * Muestra el error de la propiedad $simbolo.
    */
    public function mostrar_error_simbolo() {
        if ($this->error_simbolo !== '')
            echo $this->aviso_inicio .
                 ' id="error-simbolo">' .
                 $this->error_simbolo .
                 $this->aviso_cierre;
        else
            echo $this->aviso_inicio .
                 ' id="error-simbolo">' .
                 $this->aviso_cierre;
    }

    /**
    * Muestra el error de la propiedad $decimales.
    */
    public function mostrar_error_decimales() {
        if ($this->error_decimales !== '')
            echo $this->aviso_inicio .
                 $this->error_decimales .
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
            $modelo->establecer_simbolo($this->simbolo);
            $modelo->establecer_decimales($this->decimales);

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
            $s_simbolo = (string) $modelo->obtener_simbolo();
            $b_decimales = (boolean) $modelo->utiliza_decimales();

            $this->simbolo = $s_simbolo;
            $this->decimales = $b_decimales;

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
        parent::validar();

        $this->validar_simbolo($this->simbolo);
        $this->validar_decimales($this->decimales);
    }

}
?>
