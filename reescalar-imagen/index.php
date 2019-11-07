<?php
/**
 * Created by PhpStorm.
 * User: SantiagoPonce
 * Date: 07/11/2019
 * Time: 16:51
 */
if (isset($_FILES['imagen'])){
    reescalar_imagen_temporal_antes_de_guardar($_FILES['imagen'], 500);
    move_uploaded_file( $_FILES['imagen']['tmp_name'], $_FILES['imagen']['name']);

    echo '<img src="'.$_FILES['imagen']['name'].'">';
}else{
    echo '<form action="index.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="imagen" id="imagen">
            <input type="submit" value="Upload Image" name="submit">
        </form>';
}

function reescalar_imagen_temporal_antes_de_guardar($imagen, $nuevo_ancho){
    $img_name = pathinfo($imagen['name']);
    $img_extension = $img_name['extension']; // get the extension of the file
    $img_resource = null;
    if ($img_extension == 'png'){
        $img_resource = imagecreatefrompng($imagen['tmp_name']);
    }
    else if($img_extension === 'jpg'){
        $img_resource = imagecreatefromjpeg($imagen['tmp_name']);
    }
    else if($img_extension === 'bmp'){
        $img_resource = imagecreatefrombmp($imagen['tmp_name']);
    }
    else if($img_extension === 'gif'){
        $img_resource = imagecreatefromgif($imagen['tmp_name']);
    }
    $img_escalada = imagescale($img_resource, $nuevo_ancho);
    //$img_escalada
    //ruta donde guardar. En este caso sobreescribo la img de memoria temporal pero podria guardarla ya directamente
    imagejpeg($img_escalada, $imagen['tmp_name']);
}

