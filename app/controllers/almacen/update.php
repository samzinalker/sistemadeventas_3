<?php
include ('../../config.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id_usuario'])) {
    echo "No autenticado";
    exit();
}
$id_usuario = $_SESSION['id_usuario'];
$id_producto = $_POST['id_producto'] ?? null;

// Otros campos del producto
$nombre = $_POST['nombre'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$stock = $_POST['stock'] ?? 0;
// ...otros campos según tu formulario...

if ($id_producto) {
    // Verificar que el producto pertenece al usuario autenticado
    $sql_check = "SELECT id_producto FROM tb_almacen WHERE id_producto = :id_producto AND id_usuario = :id_usuario";
    $query_check = $pdo->prepare($sql_check);
    $query_check->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
    $query_check->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $query_check->execute();

    if ($query_check->rowCount() === 1) {
        // Solo actualizar si el producto es del usuario autenticado
        $sql = "UPDATE tb_almacen SET nombre = :nombre, descripcion = :descripcion, stock = :stock
                WHERE id_producto = :id_producto AND id_usuario = :id_usuario";
        $query = $pdo->prepare($sql);
        $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $query->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $query->bindParam(':stock', $stock, PDO::PARAM_INT);
        $query->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $query->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

        if ($query->execute()) {
            header('Location: ../../../almacen/index.php?mensaje=Producto actualizado correctamente');
            exit();
        } else {
            echo "Error al actualizar el producto";
        }
    } else {
        echo "No autorizado para editar este producto";
    }
} else {
    echo "Error: ID de producto no proporcionado";
}
?>