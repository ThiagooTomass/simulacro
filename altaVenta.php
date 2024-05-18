<?PHP
include_once("heladeriaAlta.php");
class AltaVenta
{
    public static function ventasJson($mail)
    {
        $helados = [];
        if (file_exists("heladeria.json")) {

            $contenido_json = file_get_contents("heladeria.json");
            $helados = json_decode($contenido_json);
            $encontro = false;
            foreach ($helados as $helado) {
                if ($helado->sabor == $_POST['sabor'] && $helado->tipo == $_POST['tipo'] && $helado->stock > 0) {
                    $helado->stock--;
                    $encontro = true;

                    break;
                }
            }

            if ($encontro == false) {
                echo "No se encontraron coincidencia en los datos o no hay suficiente stock";
            } else {


                if (file_exists("ventas.json")) {
                    $ventas_contenido = file_get_contents("ventas.json");
                } else {
                    $ventas_contenido = "";
                }


                $ventas = json_decode($ventas_contenido);
                $fecha = date("y-m-d");
                $venta = array(

                    "id" =>  HeladeriaAlta::generarId("ventas.json"),
                    "mail" =>  $mail,
                    "fecha" => $fecha,
                    "numero de pedido" => rand(1, 100)
                );
                $ventas[] = $venta;

                if ($_FILES['imagen']['error'] == UPLOAD_ERR_OK) {

                    $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                    $nombre_archivo = $_POST['sabor'] . "_" . $_POST['tipo'] . "_" . $_POST['vaso'] . "_" . $_POST['mail'] . "_" . $fecha . "." . $extension;

                    if (move_uploaded_file($_FILES['imagen']['tmp_name'], 'ImagenesDeLaVenta/2024/' . $nombre_archivo)) {
                        echo "Imagen subida correctamente.";
                    } else {

                        echo "Hubo un error al subir la imagen.";
                    }
                } else {

                    echo "Error al cargar la imagen.";
                }

                file_put_contents("ventas.json", json_encode($ventas));

                file_put_contents("heladeria.json", json_encode($helados));
            }
        } else {
            echo "No hay helados";
        }
    }
}
