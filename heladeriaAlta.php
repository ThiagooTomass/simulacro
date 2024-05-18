<?php
class HeladeriaAlta
{
    public static function agregarAJSON()
    {

        $encontro = false;
        $helados = [];
        if (file_exists("heladeria.json")) {

            $contenido_json = file_get_contents("heladeria.json");

            $helados = json_decode($contenido_json);
            foreach ($helados as $helado) {
                if ($helado->sabor == $_POST['sabor'] && $helado->tipo == $_POST['tipo']) {
                    $helado->precio = rand(1, 100);
                    $helado->stock++;
                    $encontro = true;
                    break;
                }
            }
            if (!$encontro) {
                HeladeriaAlta::crearArray($helados);
            } else {
                HeladeriaAlta::actualizarJson($helados, "Producto actualizado");
            }
        } else {
            HeladeriaAlta::crearArray($helados);
        }
    }
    public static function crearArray($helados)
    {

        $helado = array(
            "id" =>  HeladeriaAlta::generarId("heladeria.json"),
            "sabor" => $_POST['sabor'],
            "precio" => $_POST['precio'],
            "tipo" => $_POST['tipo'],
            "vaso" => $_POST['vaso'],
            "stock" => $_POST['stock']
        );
        if ($_FILES['imagen']['error'] == UPLOAD_ERR_OK) {

            $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $nombre_archivo = $_POST['sabor'] . "_" . $_POST['tipo'] . "." . $extension;

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], 'ImagenesDeHelados/2024/' . $nombre_archivo)) {
                echo "Imagen subida correctamente.";
            } else {

                echo "Hubo un error al subir la imagen.";
            }
        } else {

            echo "Error al cargar la imagen.";
        }
        $helados[] = $helado;
        HeladeriaAlta::actualizarJson($helados, "Producto creado");
    }
    public static function actualizarJson($helados, $mensaje)
    {
        if (file_put_contents("heladeria.json", json_encode($helados))) {
            echo $mensaje;
        } else {
            echo "Error al crear json";
        }
    }
    public static function generarId($json)
    {
        if (file_exists($json)) {
            $contenido_json = file_get_contents($json);
            $ventas = json_decode($contenido_json);


            return $ventas[count($ventas) - 1]->id += 1;
        } else {
            return 1;
        }
    }
}
