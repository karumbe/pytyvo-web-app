<?php
include_once 'app/nucleo/ValidadorBaseComImpl.inc.php';
include_once 'Familia.inc.php';

class FamiliaValidador extends ValidadorBaseComImpl {

    protected $clase_modelo = 'Familia';

    private $p1 = 0.0;
    private $p2 = 0.0;
    private $p3 = 0.0;
    private $p4 = 0.0;
    private $p5 = 0.0;

    private $error_p1 = '';
    private $error_p2 = '';
    private $error_p3 = '';
    private $error_p4 = '';
    private $error_p5 = '';

    /**
    * Valida y establece el porcentaje para la lista de precios 1.
    *
    * @param float $porcentaje
    * Porcentaje a ser validado.
    *
    * @return boolean
    * Devuelve true si tiene éxito y false en caso contrario.
    */
    public function validar_p1($porcentaje) {
        # inicio { validación del parámetro }
        if (!isset($porcentaje) || !is_float($porcentaje)) {
            $this->error_p1 = 'El porcentaje debe ser de tipo real.';
            return false;
        } else
            $this->p1 = $porcentaje;
        # fin { validación del parámetro }

        if ($porcentaje < 0) {
            $this->error_p1 = 'El porcentaje debe ser mayor o igual a cero.';
            return false;
        }

        if ($porcentaje > 1000) {
            $this->error_p1 = 'El porcentaje debe ser menor a un mil.';
            return false;
        }

        $this->error_p1 = '';
        return true;
    }

    /**
    * Valida y establece el porcentaje para la lista de precios 2.
    *
    * @param float $porcentaje
    * Porcentaje a ser validado.
    *
    * @return boolean
    * Devuelve true si tiene éxito y false en caso contrario.
    */
    public function validar_p2($porcentaje) {
        # inicio { validación del parámetro }
        if (!isset($porcentaje) || !is_float($porcentaje)) {
            $this->error_p2 = 'El porcentaje debe ser de tipo real.';
            return false;
        } else
            $this->p2 = $porcentaje;
        # fin { validación del parámetro }

        if ($porcentaje < 0) {
            $this->error_p2 = 'El porcentaje debe ser mayor o igual a cero.';
            return false;
        }

        if ($porcentaje > 1000) {
            $this->error_p2 = 'El porcentaje debe ser menor a un mil.';
            return false;
        }

        $this->error_p2 = '';
        return true;
    }

    /**
    * Valida y establece el porcentaje para la lista de precios 3.
    *
    * @param float $porcentaje
    * Porcentaje a ser validado.
    *
    * @return boolean
    * Devuelve true si tiene éxito y false en caso contrario.
    */
    public function validar_p3($porcentaje) {
        # inicio { validación del parámetro }
        if (!isset($porcentaje) || !is_float($porcentaje)) {
            $this->error_p3 = 'El porcentaje debe ser de tipo real.';
            return false;
        } else
            $this->p3 = $porcentaje;
        # fin { validación del parámetro }

        if ($porcentaje < 0) {
            $this->error_p3 = 'El porcentaje debe ser mayor o igual a cero.';
            return false;
        }

        if ($porcentaje > 1000) {
            $this->error_p3 = 'El porcentaje debe ser menor a un mil.';
            return false;
        }

        $this->error_p3 = '';
        return true;
    }

    /**
    * Valida y establece el porcentaje para la lista de precios 4.
    *
    * @param float $porcentaje
    * Porcentaje a ser validado.
    *
    * @return boolean
    * Devuelve true si tiene éxito y false en caso contrario.
    */
    public function validar_p4($porcentaje) {
        # inicio { validación del parámetro }
        if (!isset($porcentaje) || !is_float($porcentaje)) {
            $this->error_p4 = 'El porcentaje debe ser de tipo real.';
            return false;
        } else
            $this->p4 = $porcentaje;
        # fin { validación del parámetro }

        if ($porcentaje < 0) {
            $this->error_p4 = 'El porcentaje debe ser mayor o igual a cero.';
            return false;
        }

        if ($porcentaje > 1000) {
            $this->error_p4 = 'El porcentaje debe ser menor a un mil.';
            return false;
        }

        $this->error_p4 = '';
        return true;
    }

    /**
    * Valida y establece el porcentaje para la lista de precios 5.
    *
    * @param float $porcentaje
    * Porcentaje a ser validado.
    *
    * @return boolean
    * Devuelve true si tiene éxito y false en caso contrario.
    */
    public function validar_p5($porcentaje) {
        # inicio { validación del parámetro }
        if (!isset($porcentaje) || !is_float($porcentaje)) {
            $this->error_p5 = 'El porcentaje debe ser de tipo real.';
            return false;
        } else
            $this->p5 = $porcentaje;
        # fin { validación del parámetro }

        if ($porcentaje < 0) {
            $this->error_p5 = 'El porcentaje debe ser mayor o igual a cero.';
            return false;
        }

        if ($porcentaje > 1000) {
            $this->error_p5 = 'El porcentaje debe ser menor a un mil.';
            return false;
        }

        $this->error_p5 = '';
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
                $this->error_p1 === '' &&
                $this->error_p2 === '' &&
                $this->error_p3 === '' &&
                $this->error_p4 === '' &&
                $this->error_p5 === '')
            return true;
        else
            return false;
    }

    /**
    * Devuelve el porcentaje de la lista de precios 1.
    *
    * @return float
    */
    public function obtener_p1() {
        return $this->p1;
    }

    /**
    * Devuelve el porcentaje de la lista de precios 2.
    *
    * @return float
    */
    public function obtener_p2() {
        return $this->p2;
    }

    /**
    * Devuelve el porcentaje de la lista de precios 3.
    *
    * @return float
    */
    public function obtener_p3() {
        return $this->p3;
    }

    /**
    * Devuelve el porcentaje de la lista de precios 4.
    *
    * @return float
    */
    public function obtener_p4() {
        return $this->p4;
    }

    /**
    * Devuelve el porcentaje de la lista de precios 5.
    *
    * @return float
    */
    public function obtener_p5() {
        return $this->p5;
    }

    /**
    * Devuelve el error del porcentaje de la lista de precios 1.
    *
    * @return string
    */
    public function obtener_error_p1() {
        return $this->error_p1;
    }

    /**
    * Devuelve el error del porcentaje de la lista de precios 2.
    *
    * @return string
    */
    public function obtener_error_p2() {
        return $this->error_p2;
    }

    /**
    * Devuelve el error del porcentaje de la lista de precios 3.
    *
    * @return string
    */
    public function obtener_error_p3() {
        return $this->error_p3;
    }

    /**
    * Devuelve el error del porcentaje de la lista de precios 4.
    *
    * @return string
    */
    public function obtener_error_p4() {
        return $this->error_p4;
    }

    /**
    * Devuelve el error del porcentaje de la lista de precios 5.
    *
    * @return string
    */
    public function obtener_error_p5() {
        return $this->error_p5;
    }

    /**
    * Muestra el valor de la propiedad $p1.
    */
    public function mostrar_p1() {
        echo 'value="' . $this->p1 . '"';
    }

    /**
    * Muestra el valor de la propiedad $p2.
    */
    public function mostrar_p2() {
        echo 'value="' . $this->p2 . '"';
    }

    /**
    * Muestra el valor de la propiedad $p3.
    */
    public function mostrar_p3() {
        echo 'value="' . $this->p3 . '"';
    }

    /**
    * Muestra el valor de la propiedad $p4.
    */
    public function mostrar_p4() {
        echo 'value="' . $this->p4 . '"';
    }

    /**
    * Muestra el valor de la propiedad $p5.
    */
    public function mostrar_p5() {
        echo 'value="' . $this->p5 . '"';
    }

    /**
    * Muestra el error de la propiedad $p1.
    */
    public function mostrar_error_p1() {
        if ($this->error_p1 !== '')
            echo $this->aviso_inicio .
                 ' id="error-p1">' .
                 $this->error_p1 .
                 $this->aviso_cierre;
        else
            echo $this->aviso_inicio .
                 ' id="error-p1">' .
                 $this->aviso_cierre;
    }

    /**
    * Muestra el error de la propiedad $p2.
    */
    public function mostrar_error_p2() {
        if ($this->error_p2 !== '')
            echo $this->aviso_inicio .
                 ' id="error-p2">' .
                 $this->error_p2 .
                 $this->aviso_cierre;
        else
            echo $this->aviso_inicio .
                 ' id="error-p2">' .
                 $this->aviso_cierre;
    }

    /**
    * Muestra el error de la propiedad $p3.
    */
    public function mostrar_error_p3() {
        if ($this->error_p3 !== '')
            echo $this->aviso_inicio .
                 ' id="error-p3">' .
                 $this->error_p3 .
                 $this->aviso_cierre;
        else
            echo $this->aviso_inicio .
                 ' id="error-p3">' .
                 $this->aviso_cierre;
    }

    /**
    * Muestra el error de la propiedad $p4.
    */
    public function mostrar_error_p4() {
        if ($this->error_p4 !== '')
            echo $this->aviso_inicio .
                 ' id="error-p4">' .
                 $this->error_p4 .
                 $this->aviso_cierre;
        else
            echo $this->aviso_inicio .
                 ' id="error-p4">' .
                 $this->aviso_cierre;
    }

    /**
    * Muestra el error de la propiedad $p5.
    */
    public function mostrar_error_p5() {
        if ($this->error_p5 !== '')
            echo $this->aviso_inicio .
                 ' id="error-p5">' .
                 $this->error_p5 .
                 $this->aviso_cierre;
        else
            echo $this->aviso_inicio .
                 ' id="error-p5">' .
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
            $modelo->establecer_p1($this->p1);
            $modelo->establecer_p2($this->p2);
            $modelo->establecer_p3($this->p3);
            $modelo->establecer_p4($this->p4);
            $modelo->establecer_p5($this->p5);

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
            $f_p1 = (float) $modelo->obtener_p1();
            $f_p2 = (float) $modelo->obtener_p2();
            $f_p3 = (float) $modelo->obtener_p3();
            $f_p4 = (float) $modelo->obtener_p4();
            $f_p5 = (float) $modelo->obtener_p5();

            $this->p1 = $f_p1;
            $this->p2 = $f_p2;
            $this->p3 = $f_p3;
            $this->p4 = $f_p4;
            $this->p5 = $f_p5;

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

        $this->validar_p1($this->p1);
        $this->validar_p2($this->p2);
        $this->validar_p3($this->p3);
        $this->validar_p4($this->p4);
        $this->validar_p5($this->p5);
    }

}
?>
