<?php
/**
 * Created by PhpStorm.
 * User: José Manuel Cruz Sánchez
 * Date: 07/11/2019
 * Time: 16:51
 */
/*highlight_string("<?php\n\$data =\n" . var_export($nombres_archivos, true) . ";\n?>");*/


$ruta_absoluta_directorio = "C:/xampp/htdocs/reescalar-todas-imagenes-directorio/imagenes/";
$ancho_imagen = 150;
$token_seguridad = 'sdfinASf***++++23455';

reescalar_todas_imagenes_de_un_directorio($ruta_absoluta_directorio, $ancho_imagen, $token_seguridad);
/**
 * @param $ruta_absoluta_directorio la ruta absoluta del directorio terminando con '/'
 *          Ejemplo 'C:jose/imagenes/'
 * @param $ancho_imagen el ancho que aplicara a las imagenes
 */
function reescalar_todas_imagenes_de_un_directorio($ruta_absoluta_directorio, $ancho_imagen, $token_seguridad){
    if ($token_seguridad != 'sdfinASf***++++23455'){
        die();
    }
    $nombres_archivos = scandir($ruta_absoluta_directorio);
    $nombres_archivos = array_slice($nombres_archivos, 2);
    $rutas_simples = array();//solo para test
    for ($i = 0; $i < count($nombres_archivos); $i++){
        array_push($rutas_simples, 'imagenes/' . $nombres_archivos[$i]);//test

        $nombres_archivos[$i] = $ruta_absoluta_directorio . $nombres_archivos[$i];
        if (getimagesize($nombres_archivos[$i])[0] > $ancho_imagen){
            reescala($nombres_archivos[$i], $ancho_imagen);
        }
        //echo '<img src="'.$rutas_simples[$i].'">';//Para test
    }
}

function reescala($ruta_absoluta_imagen, $ancho_imagen){
    $img_resource = null;
    if (mime_content_type($ruta_absoluta_imagen) == 'image/png'){
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