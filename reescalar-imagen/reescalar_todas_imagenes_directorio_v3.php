<?php
/**
 * Created by PhpStorm.
 * User: José Manuel Cruz Sánchez
 * Date: 27/11/2019
 * Time: 16:23
 */

/*$ruta_absoluta_directorio = "C:/xampp/htdocs/reescalar-todas-imagenes-directorio/imagenes/";
$ancho_imagen = 150;
$token_seguridad = 'sdfinASf***++++23455';

main_reescalar_imagenes_en_directorio($ruta_absoluta_directorio, $ancho_imagen, $token_seguridad);*/

function main_reescalar_imagenes_en_directorio($ruta_absoluta_directorio, $ancho_imagen, $token_seguridad){
    if ($token_seguridad != 'sdfinASf***++++23455'){
        die();
    }
    $imagenes_reescaladas = array();

    $array_archivos = get_todos_archivos_en_directorio($ruta_absoluta_directorio);
    for ($i = 0; $i < count($array_archivos); $i++){
        if (getimagesize($array_archivos[$i])[0] > $ancho_imagen){
            $imagen_reescalada = null;
            $imagen_reescalada = array();
            $imagen_reescalada['Ruta Fichero'] = $array_archivos[$i];
            $imagen_reescalada['Tamano Anterior'] = filesize($array_archivos[$i]);
            reescala($array_archivos[$i], $ancho_imagen);
            $imagen_reescalada['Tamano Posterior'] = filesize($array_archivos[$i]);
            array_push($imagenes_reescaladas, $imagen_reescalada);
        }
    }
}

function reescala($ruta_absoluta_imagen, $ancho_imagen){
    $img_resource = null;
    if (mime_content_type($ruta_absoluta_imagen) === 'image/png'){
        $img_resource = imagecreatefrompng($ruta_absoluta_imagen);
    }
    else if(mime_content_type($ruta_absoluta_imagen) === 'image/jpeg'){
        $img_resource = imagecreatefromjpeg($ruta_absoluta_imagen);
    }
    else if(mime_content_type($ruta_absoluta_imagen) === 'image/bmp'){
        $img_resource = imagecreatefrombmp($ruta_absoluta_imagen);
    }
    else if(mime_content_type($ruta_absoluta_imagen) === 'image/gif'){
        $img_resource = imagecreatefromgif($ruta_absoluta_imagen);
    }
    $img_escalada = imagescale($img_resource, $ancho_imagen);
    imagejpeg($img_escalada, $ruta_absoluta_imagen);
}

function get_todos_archivos_en_directorio($ruta_absoluta_directorio){
    $todos_nombres_archivos = array();
    $array_subdirectorios = get_array_todos_subdirectorios($ruta_absoluta_directorio);
    for ($i = 0; $i < count($array_subdirectorios); $i++){
        $nombres_archivos = null;
        $nombres_archivos = get_array_todos_archivos_en_directorio($array_subdirectorios[$i]);
        $todos_nombres_archivos = array_merge($todos_nombres_archivos, $nombres_archivos);

    }
    return $todos_nombres_archivos;
}

function get_array_todos_archivos_en_directorio($ruta_directorio){
    $nombres_archivos = array_filter(glob($ruta_directorio . '*'), 'is_file');
    $nombres_archivos = array_filter($nombres_archivos, 'exif_imagetype');
    return $nombres_archivos;
}

function get_array_todos_subdirectorios($ruta_absoluta_directorio){
    if (substr($ruta_absoluta_directorio, -1) === '/'){
        $ruta = substr($ruta_absoluta_directorio, 0, -1);
    }else{
        $ruta = $ruta_absoluta_directorio;
    }

    $iter = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($ruta, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST,
        RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
    );

    $paths = array($ruta);
    foreach ($iter as $ruta => $dir) {
        if ($dir->isDir()) {
            $paths[] = str_replace('\\', '/', $ruta) . '/';
        }
    }
    $paths[0] = $paths[0] . '/';
    return $paths;
}