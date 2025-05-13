<?php
if (isset($_POST['entidad'])) {
    // Ruta donde se guardarán los archivos
    $entidad = $_POST['entidad'];

    $directorioDestino = $_SERVER['DOCUMENT_ROOT'] . "/turismo/public/uploads/$entidad/";
    if (!file_exists($directorioDestino)) mkdir($directorioDestino, 0777, true);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
        $archivo = $_FILES['file'];

        $rutaWebP = $directorioDestino . pathinfo($archivo['name'], PATHINFO_FILENAME) . ".webp";

        if (!file_exists($rutaWebP)) {
            if (convertirAWebP($archivo['tmp_name'], $rutaWebP)) {
                echo "Archivo convertido y guardado como WebP exitosamente.";
            } else {
                echo "Error al convertir el archivo.";
            }
        }else{
            echo "El archivo ya existe.";
        }
    } else {
        echo "No se recibió ningún archivo.";
    }
}
function convertirAWebP($rutaOrigen, $rutaDestino, $calidad = 80)
{
    $tipoMime = mime_content_type($rutaOrigen);
    $imagen = match ($tipoMime) {
        'image/jpeg' => imagecreatefromjpeg($rutaOrigen),
        'image/png' => imagecreatefrompng($rutaOrigen),
        default => false,
    };

    if (!$imagen) return false;
    if ($tipoMime === 'image/png') {
        imagepalettetotruecolor($imagen);
        imagesavealpha($imagen, true);
    }
    $resultado = imagewebp($imagen, $rutaDestino, $calidad);
    imagedestroy($imagen);
    return $resultado;
}
