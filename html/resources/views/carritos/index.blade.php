<?php
sessionStr::start($id, 'carrito')
//return response()->json($_POST);

//session_start();
//session:array();

$mensaje='';

if (!isset($_SESSION['carrito'])) {
    $producto=array(
        'id' => $id,
        'nombre' => $nombre,
        'cantidad' => $cantidad,
        'precio' => $precio,
    );
    $_SESSION['carrito'][0]=$producto;
} else {
    $numeroProductos=count($_SESSION['carrito']);
    $producto=array(
        'id' => $id,
        'nombre' => $nombre,
        'cantidad' => $cantidad,
        'precio' => $precio,
    );
    $_SESSION['carrito'][$numeroProductos]=$producto;
}
echo $mensaje=print_r($_SESSION,true);
echo $mensaje;

echo "prueba";
