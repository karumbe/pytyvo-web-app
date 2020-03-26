<?php
require_once 'app/nucleo/pdf.inc.php';
include_once 'app/nucleo/config.inc.php';
include_once 'app/nucleo/Utiles.inc.php';
include_once 'app/nucleo/ControlSesion.inc.php';
include_once 'app/nucleo/Redireccion.inc.php';
include_once 'app/modulos/cliente/modelo/ClienteDaoFactory.inc.php';
include_once dirname(__DIR__) . '/modelo/CuentaPorCobrarDaoFactory.inc.php';

if (!ControlSesion::sesion_iniciada())
    Redireccion::redirigir(RUTA_LOGIN);

if (!Utiles::variable_iniciada($codigo))
    Redireccion::redirigir(RUTA_404);



# inicio { repositorio: cliente }
$repositorio_cliente = ClienteDaoFactory::crear_dao();

if (is_null($repositorio_cliente) ||
        !$repositorio_cliente->codigo_existe($codigo))
    Redireccion::redirigir(RUTA_404);
# fin { repositorio: cliente }



# inicio { repositorio: cuenta_por_cobrar }
$repositorio_cuenta_por_cobrar = CuentaPorCobrarDaoFactory::crear_dao();
$cuentas_por_cobrar = array();

if (!is_null($repositorio_cuenta_por_cobrar))
    $cuentas_por_cobrar = $repositorio_cuenta_por_cobrar->obtener_por_codigo(
        $codigo);

if (!count($cuentas_por_cobrar))
    Redireccion::redirigir(RUTA_404);
# fin { repositorio: cuenta_por_cobrar }



# inicio { calcula los totales por moneda }
$totales = array();

foreach ($cuentas_por_cobrar as $fila) {
    $cod_moneda = $fila->obtener_cod_moneda();    // índice del arreglo.
    $fecha_vto = new DateTime($fila->obtener_fecha_vto());
    $fecha_actual = new DateTime('now');
    $fecha_ultimo_dia = new DateTime($fecha_actual->format('Y-m-t'));

    // Si no existe el código de la moneda en el arreglo, entonces lo creamos.
    if (!isset($totales[$cod_moneda]))
        $totales[$cod_moneda] = array(
            'cod_moneda' => $fila->obtener_cod_moneda(),
            'moneda' => $fila->obtener_moneda(),
            'simbolo' => $fila->obtener_simbolo(),
            'decimales' => $fila->obtener_decimales() ? 2 : 0,
            'vencidos' => 0,
            'a_vencer' => 0,
            'venc_del_mes' => 0,
            'total' => 0
        );

    if ($fila->obtener_dias() <= 0)
        $totales[$cod_moneda]['vencidos'] =
            $totales[$cod_moneda]['vencidos'] + $fila->obtener_saldo();

    if ($fila->obtener_dias() > 0)
        $totales[$cod_moneda]['a_vencer'] =
            $totales[$cod_moneda]['a_vencer'] + $fila->obtener_saldo();

    if ($fecha_vto <= $fecha_ultimo_dia)
        $totales[$cod_moneda]['venc_del_mes'] =
            $totales[$cod_moneda]['venc_del_mes'] + $fila->obtener_saldo();

    $totales[$cod_moneda]['total'] =
        $totales[$cod_moneda]['total'] + $fila->obtener_saldo();
}
# fin { calcula los totales por moneda }



class MyPDF extends PDF {

    const TITULO_INFORME = 'ESTADO DE CUENTA';
    const DIRECCION_EMPRESA = 'Mecánicos de Aviación N° 1610';
    const CIUDAD_EMPRESA = 'Asunción - Paraguay';
    const INFO_PIE_INFORME = 'web: www.ayaimportaciones.com.py | correo: ventas@ayaimportaciones.com.py | teléfono: 021 501-005 | celular: 0981 700-011';

    private $totales = array();
    private $cuentas_por_cobrar = array();

    function Header()  {
        // Logo de la empresa.
        $this->Image('img/logo.png', 30, 8, 50);
        // Arial normal 8.
        $this->SetFont('Arial', '', 8);
        // Página.
        $this->SetXY(150, 12);
        $this->Cell(20, 0, utf8_decode('Página: ' . $this->PageNo()));
        // Fecha.
        $this->SetXY(150, 16);
        $this->Cell(20, 0, utf8_decode('Fecha: ') . date('d/m/Y H:i:s'));
        // Dirección.
        $this->Ln(4);
        $this->Cell(50, 0, utf8_decode(self::DIRECCION_EMPRESA), 0, 1, 'C');
        // Ciudad.
        $this->Ln(4);
        $this->Cell(50, 0, utf8_decode(self::CIUDAD_EMPRESA), 0, 1, 'C');
        // Título.
        $this->Ln(8);
        $this->SetFont('Arial', 'BU', 10);
        $this->Cell(0, 0, utf8_decode(self::TITULO_INFORME), 0 , 1, 'C');
        // Salto de línea.
        $this->Ln(10);
    }

    private function configurar_pagina() {
        $this->SetMargins(30, 8, 20);
        $this->SetAuthor($_SESSION['cod_usuario'] . '#' . $_SESSION['token'],
            true);
        $this->SetTitle('Estado de Cuenta', true);
        $this->AddPage();
    }

    private function encabezado() {
        // Nombre del cliente.
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(120, 0,
            '** ' .
            utf8_decode($this->cuentas_por_cobrar[0]->obtener_cliente()), 0, 0);

        // RUC del cliente.
        $this->SetFont('Arial', '', 9);
        $this->Cell(100, 0,
            utf8_decode('RUC: ') .
            utf8_decode($this->cuentas_por_cobrar[0]->obtener_ruc()));

        // Dirección del cliente.
        $this->Ln(5);
        $this->Cell(3.3);
        $this->Cell(120, 0,
            utf8_decode('Dirección: ') .
            utf8_decode($this->cuentas_por_cobrar[0]->obtener_direccion()));

        // Ciudad y departamento del cliente.
        $this->Ln(5);
        $this->Cell(3.3);
        $this->Cell(116.7, 0,
            utf8_decode('Ciudad: ') .
            utf8_decode($this->cuentas_por_cobrar[0]->obtener_ciudad()) .
            utf8_decode('   |   Dpto.: ') .
            utf8_decode($this->cuentas_por_cobrar[0]->obtener_departamen()),
            0, 0);

        // Código del cliente.
        $this->SetFont('Arial', '', 9);
        $this->Cell(100, 0,
            utf8_decode('Cód. Cliente: ') .
            $this->cuentas_por_cobrar[0]->obtener_cod_cliente());

        // Teléfono del cliente.
        $this->Ln(5);
        $this->Cell(3.3);
        $this->Cell(117, 0,
            utf8_decode('Teléfono: ') .
            utf8_decode($this->cuentas_por_cobrar[0]->obtener_telefono()));

        // Título de la tabla.
        $this->Ln(6);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(32, 7, utf8_decode('Factura N°'), 0, 0, 'C');
        $this->Cell(16, 7, utf8_decode('Cuota'), 0, 0, 'C');
        $this->Cell(26, 7, utf8_decode('Fecha'), 0, 0, 'C');
        $this->Cell(26, 7, utf8_decode('Fecha'), 0, 0, 'C');
        $this->Cell(28, 7, utf8_decode('Saldo     '), 0, 0, 'R');
        $this->Cell(16, 7, utf8_decode('Días'), 0, 0, 'R');
        $this->Cell(16, 7, utf8_decode('Suc.'), 0, 0, 'C');
        $this->Ln(4);
        $this->Cell(48);
        $this->Cell(26, 7, utf8_decode('Emisión'), 0, 0, 'C');
        $this->Cell(26, 7, utf8_decode('Vencimiento'), 0, 0, 'C');
        $this->RoundedRect(30, 62, 160, 12, 2, '1234', 'D');
    }

    private function detalle() {
        foreach ($this->totales as $moneda) {
            $simbolo = $moneda['simbolo'];

            // Símbolo de la moneda y el nombre de la moneda.
            $this->Ln(12);
            $this->SetFont('Arial', '', 9);
            $this->Cell(0, 0,
                utf8_decode($simbolo . ' - ' . $moneda['moneda']));
            $this->Ln(3);

            for ($i = 0; $i < count($this->cuentas_por_cobrar); $i++) {
                $fila = $this->cuentas_por_cobrar[$i];

                if ($fila->obtener_cod_moneda() === $moneda['cod_moneda']) {
                    // Número de factura.
                    $this->Cell(32, 7,
                        utf8_decode($fila->obtener_nrofact()), 0, 0, 'C');
                    // Cuota.
                    $this->Cell(16, 7,
                        utf8_decode($fila->obtener_cuota()), 0, 0, 'C');
                    // Fecha de emisión.
                    $this->Cell(26, 7,
                        utf8_decode(date('d/m/Y',
                        strtotime($fila->obtener_fecha_emi()))), 0, 0, 'C');
                    // Fecha de vencimiento.
                    $this->Cell(26, 7,
                        utf8_decode(date('d/m/Y',
                        strtotime($fila->obtener_fecha_vto()))), 0, 0, 'C');
                    // Saldo.
                    $this->Cell(28, 7,
                        utf8_decode(number_format($fila->obtener_saldo(),
                        $moneda['decimales'], ',', '.') . '     '), 0, 0, 'R');
                    // Días.
                    $this->Cell(16, 7,
                        utf8_decode($fila->obtener_dias()), 0, 0, 'R');
                    // Sucursal.
                    $this->Cell(16, 7, utf8_decode('00'), 0, 0, 'C');
                    $this->Ln(5);
                }
            }

            // Dibuja la caja para los totales.
            $this->Ln(3);
            $this->SetDrawColor(214,214,214);
            $this->SetFillColor(214,214,214);
            $this->RoundedRect($this->GetX(), $this->GetY(), 160, 12, 2, '1234', 'DF');

            // Imprime las etiquetas de los totales.
            $this->SetFont('Arial', 'B', 9);
            $this->Cell(32, 7, utf8_decode('Vencidos   '), 0, 0, 'R');
            $this->Cell(16);
            $this->Cell(26, 7, utf8_decode('A Vencer   '), 0, 0, 'R');
            $this->Cell(26);
            $this->Cell(28, 7, utf8_decode('TOTAL     '), 0, 0, 'R');
            $this->Cell(16);
            $this->Cell(16, 7, utf8_decode('Venc. del Mes    '), 0, 0, 'R');

            // Imprime los valores de los totales.
            $this->Ln(5);
            $this->Cell(32, 7,
                number_format($moneda['vencidos'],
                $moneda['decimales'], ',', '.') . '   ', 0, 0, 'R');
            $this->Cell(16);
            $this->SetFont('Arial', '', 9);
            $this->Cell(26, 7,
                number_format($moneda['a_vencer'],
                $moneda['decimales'], ',', '.') . '   ', 0, 0, 'R');
            $this->Cell(26);
            $this->SetFont('Arial', 'B', 9);
            $this->Cell(28, 7,
                number_format($moneda['total'],
                $moneda['decimales'], ',', '.') . '     ', 0, 0, 'R');
            $this->Cell(16);
            $this->SetFont('Arial', '', 9);
            $this->Cell(16, 7,
                number_format($moneda['venc_del_mes'],
                $moneda['decimales'], ',', '.') . '    ', 0, 0, 'R');
        }
    }

    private function pie() {
        $this->Ln(6);
        $this->SetFont('Arial', '', 7);
        $this->Cell(0, 7, utf8_decode(self::INFO_PIE_INFORME), 0, 0, 'C');
    }

    public function establecer_datos($cuentas_por_cobrar, $totales) {
        $this->cuentas_por_cobrar = $cuentas_por_cobrar;
        $this->totales = $totales;
    }

    public function generar_informe() {
        $this->configurar_pagina();
        $this->encabezado();
        $this->detalle();
        $this->pie();
        $this->Output('D', 'EC_' . $this->cuentas_por_cobrar[0]->obtener_ruc() .
            '.pdf');
    }

}

$pdf = new MyPDF();
$pdf->establecer_datos($cuentas_por_cobrar, $totales);
$pdf->generar_informe();
?>