<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['opcion'])) {
        if ($_POST['opcion'] == "altaventa") {
            if (isset($_POST['mail']) && isset($_POST['sabor']) && isset($_POST['tipo']) && isset($_FILES['imagen']) && isset($_POST['vaso'])) {
                include_once("altaVenta.php");
                AltaVenta::ventasJson($_POST['mail']);
            } else {
                echo "Params insuficientes ";
            }
        } elseif ($_POST['opcion'] == "heladeriaalta") {
            if (isset($_POST['sabor']) && isset($_POST['precio']) && isset($_POST['tipo']) && isset($_POST['vaso']) && isset($_POST['stock'])) {
                include_once("heladeriaAlta.php");
                HeladeriaAlta::agregarAJSON();
            } else {
                echo "Params insuficientes ";
            }
        } elseif ($_POST['opcion'] == "heladeriaconsultar") {
            if (isset($_POST['sabor']) && isset($_POST['tipo'])) {
                include_once("heladoConsultar.php");
                echo HeladoConsultar::verificarSaborPrecio();
            } else {
                echo "Params insuficientes ";
            }
        }
    } else {
        echo "falta parametro de opcion";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['opcion'])) {
        if ($_GET['opcion'] == "consultasVentas") {
            include_once("consultasVentas.php");
            ConsultasVentas::consultaVentasPorDia();
            if (isset($_GET['usuario'])) {
                ConsultasVentas::listaVentasUsuario($_GET['usuario']);
            }
        } else {
            echo "No existe esa opcion";
        }
    } else {
        echo "Falta parametro opcion.";
    }
}
