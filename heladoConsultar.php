<?php
/*(1pt.) HeladoConsultar.php: (por POST) Se ingresa Sabor y Tipo, si coincide con algún registro del archivo
heladeria.json, retornar “existe”. De lo contrario informar si no existe el tipo o el nombre. */
class HeladoConsultar
{

    public static function verificarSaborPrecio()
    {
        $helados = [];
        if (file_exists("heladeria.json")) {

            $contenido_json = file_get_contents("heladeria.json");

            $helados = json_decode($contenido_json);
            $encontro = false;
            foreach ($helados as $helado) {
                if ($helado->sabor == $_POST['sabor'] && $helado->tipo == $_POST['tipo']) {
                    $encontro = true;
                    return "existe";
                }
            }
            if ($encontro == false) {
                return "No se encontraron similitudes en el sabor o en el tipo.";
            }
        }
    }
}
