<?php
include_once 'app/nucleo/DaoBaseComImpl.inc.php';
include_once 'Cliente.inc.php';

class ClienteDaoComImpl extends DaoBaseComImpl {

    protected $com = 'Pytyvo.Cliente';
    protected $clase_modelo = 'Cliente';

    /**
    * Carga los datos de un objeto del tipo SimpleXMLElement a otro objeto
    * del tipo especificado en el parámetro $modelo.
    *
    * @param object $modelo
    * Modelo en el que se cargarán los datos.
    *
    * @param SimpleXMLElement object $datos.
    * Objeto que contiene los datos.
    *
    * @return object|null
    * object si tiene éxito y null en caso contrario.
    */
    # @Override
    protected function cargar_datos($modelo, $datos) {
        if ($this->validar_modelo($modelo) && $this->validar_datos($datos)) {
            try {
                $i_codigo = (int) $datos->codigo;
                $s_nombre = (string) $datos->nombre;
                $s_direc1 = (string) $datos->direc1;
                $s_direc2 = (string) $datos->direc2;
                $s_direc3 = (string) $datos->direc3;
                $s_direc4 = (string) $datos->direc4;
                $s_direc5 = (string) $datos->direc5;
                $s_direc6 = (string) $datos->direc6;
                $s_direc7 = (string) $datos->direc7;
                $s_direc8 = (string) $datos->direc8;
                $s_direc9 = (string) $datos->direc9;
                $i_departamen = (int) $datos->departamen;
                $i_ciudad = (int) $datos->ciudad;
                $i_barrio = (int) $datos->barrio;
                $s_telefono = (string) $datos->telefono;
                $s_fax = (string) $datos->fax;
                $s_correo = (string) $datos->e_mail;
                $d_fechanac = (string) $datos->fechanac;
                $s_contacto = (string) $datos->contacto;
                $s_ruc = (string) $datos->ruc;
                $s_documento = (string) $datos->documento;
                $i_limite_cre = (int) $datos->limite_cre;
                $d_fec_ioper = (string) $datos->fec_ioper;
                $i_motivoclie = (int) $datos->motivoclie;
                $s_odatosclie = (string) $datos->odatosclie;
                $i_saldo_actu = (int) $datos->saldo_actu;
                $f_saldo_usd = (float) $datos->saldo_usd;
                $s_obs1 = (string) $datos->obs1;
                $s_obs2 = (string) $datos->obs2;
                $s_obs3 = (string) $datos->obs3;
                $s_obs4 = (string) $datos->obs4;
                $s_obs5 = (string) $datos->obs5;
                $s_obs6 = (string) $datos->obs6;
                $s_obs7 = (string) $datos->obs7;
                $s_obs8 = (string) $datos->obs8;
                $s_obs9 = (string) $datos->obs9;
                $s_obs10 = (string) $datos->obs10;
                $s_ref1 = (string) $datos->ref1;
                $s_ref2 = (string) $datos->ref2;
                $s_ref3 = (string) $datos->ref3;
                $s_ref4 = (string) $datos->ref4;
                $s_ref5 = (string) $datos->ref5;
                $i_lista = (int) $datos->lista;
                $i_plazo = (int) $datos->plazo;
                $i_vendedor = (int) $datos->vendedor;
                $s_cuenta = (string) $datos->cuenta;
                $i_ruta = (int) $datos->ruta;
                $s_facturar = (string) $datos->facturar;
                $s_estado = (string) $datos->estado;

                $modelo->establecer_codigo($i_codigo);
                $modelo->establecer_nombre($s_nombre);
                $modelo->establecer_direc1($s_direc1);
                $modelo->establecer_direc2($s_direc2);
                $modelo->establecer_direc3($s_direc3);
                $modelo->establecer_direc4($s_direc4);
                $modelo->establecer_direc5($s_direc5);
                $modelo->establecer_direc6($s_direc6);
                $modelo->establecer_direc7($s_direc7);
                $modelo->establecer_direc8($s_direc8);
                $modelo->establecer_direc9($s_direc9);
                $modelo->establecer_departamen($i_departamen);
                $modelo->establecer_ciudad($i_ciudad);
                $modelo->establecer_barrio($i_barrio);
                $modelo->establecer_telefono($s_telefono);
                $modelo->establecer_fax($s_fax);
                $modelo->establecer_correo($s_correo);
                $modelo->establecer_fechanac($d_fechanac);
                $modelo->establecer_contacto($s_contacto);
                $modelo->establecer_ruc($s_ruc);
                $modelo->establecer_documento($s_documento);
                $modelo->establecer_limite_cre($i_limite_cre);
                $modelo->establecer_fec_ioper($d_fec_ioper);
                $modelo->establecer_motivoclie($i_motivoclie);
                $modelo->establecer_odatosclie($s_odatosclie);
                $modelo->establecer_saldo_actu($i_saldo_actu);
                $modelo->establecer_saldo_usd($f_saldo_usd);
                $modelo->establecer_obs1($s_obs1);
                $modelo->establecer_obs2($s_obs2);
                $modelo->establecer_obs3($s_obs3);
                $modelo->establecer_obs4($s_obs4);
                $modelo->establecer_obs5($s_obs5);
                $modelo->establecer_obs6($s_obs6);
                $modelo->establecer_obs7($s_obs7);
                $modelo->establecer_obs8($s_obs8);
                $modelo->establecer_obs9($s_obs9);
                $modelo->establecer_obs10($s_obs10);
                $modelo->establecer_ref1($s_ref1);
                $modelo->establecer_ref2($s_ref2);
                $modelo->establecer_ref3($s_ref3);
                $modelo->establecer_ref4($s_ref4);
                $modelo->establecer_ref5($s_ref5);
                $modelo->establecer_lista($i_lista);
                $modelo->establecer_plazo($i_plazo);
                $modelo->establecer_vendedor($i_vendedor);
                $modelo->establecer_cuenta($s_cuenta);
                $modelo->establecer_ruta($i_ruta);
                $modelo->establecer_facturar($s_facturar);
                $modelo->establecer_estado($s_estado);

                return $modelo;
            } catch (Exception $ex) {
                print 'ERROR: ' . $ex->getMessage() . '<br>';
                die();
            }
        }

        return null;
    }

    /**
    * Determina si una variable es de tipo entero y se encuentra dentro de
    * cierto rango.
    *
    * @param integer $valor
    * La variable a ser evaluada.
    *
    * @return boolean
    * Devuelve true si la variable es válida y false en caso contrario.
    */
    # @Override
    protected function validar_param_codigo($valor) {
        return Utiles::rango_entero($valor, 1, 99999);
    }

}
?>