<?php

class ConsultasVentas
{

    public static function consultaVentasPorDia($fecha = null)
    {
        $contador = 0;
        if ($fecha == null) {
            $fecha = date('y-m-d', strtotime('-1 day'));
        }

        $contenido_json = file_get_contents("ventas.json");
        $ventas = json_decode($contenido_json, true);

        foreach ($ventas as $venta) {
            if ($venta['fecha'] == $fecha) {
                $contador++;
            }
        }
        echo "Los helados vendidos en la fecha de " . $fecha . " es de " . $contador . "<br> <br>";
    }
    public static function listaVentasUsuario($usuario)
    {
        $contenido_json = file_get_contents("ventas.json");
        $ventas = json_decode($contenido_json, true);

        foreach ($ventas as $venta) {
            if ($venta['mail'] == $usuario) {
                var_dump($venta);
                echo "<br>";
            }
        }
    }
}
