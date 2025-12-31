<?php

$ruta = '../';
require('encabezado.php');
require('conexion.php');
?>

<main class="container">

    <h2 class="text-center my-4">Mi Carrito</h2>

    <section class="row text-center">
        <section class="d-flex justify-content-center pt-3">

            <?php
            if (!empty($_SESSION['carrito'])) {
                $conexion = conectar();

                $consulta = 'SELECT nombre, categoria, precio, foto FROM articulo WHERE id_articulo = ?';
                $sentencia = mysqli_prepare($conexion, $consulta);

                echo '
                <table class="table table-bordered table-hover table-striped w-auto">
                <caption class="caption-top text-center bg-dark text-white">Listado de Artículos en Carrito</caption>
                <tr>
                    <th class="bg-secondary text-white">Nombre</th>
                    <th class="bg-secondary text-white">Categoría</th>
                    <th class="bg-secondary text-white">Precio</th>
                    <th class="bg-secondary text-white">Foto</th>
                    <th class="bg-secondary text-white">Cantidad</th>
                    <th class="bg-secondary text-white">Subtotal</th>
                </tr>';

                $suma = 0;

                foreach ($_SESSION['carrito'] as $id => $cant) {

                    mysqli_stmt_bind_param($sentencia, "i", $id);
                    mysqli_stmt_execute($sentencia);
                    mysqli_stmt_bind_result($sentencia, $nombre, $categoria, $precio, $foto);
                    mysqli_stmt_fetch($sentencia);

                    echo '
                    <tr>
                        <td>' . $nombre . '</td>
                        <td>' . $categoria . '</td>
                        <td>$AR ' . number_format($precio, 2, ",", ".") . '</td>
                        <td><img src="../img/articulos/' . $foto . '" style="width:64px; height:64px; object-fit:cover;"></td>
                        <td>' . $cant . '</td>
                        <td>$AR ' . number_format($precio * $cant, 2, ",", ".") . '</td>
                    </tr>';

                    $suma += $precio * $cant;
                }

                mysqli_stmt_close($sentencia);

                echo '</table>';
            } else {
                echo '<h3 class="text-center mt-5 text-danger">El carrito está vacío.</h3>';
            }
            ?>

        </section> 
    </section> 

   
    <?php if (!empty($_SESSION['carrito'])) { ?>
        <section class="mt-4 text-center">
            <h3>Total: $AR <?php echo number_format($suma, 2, ",", "."); ?></h3>
        </section>
    <?php } ?>

    <section class="d-flex justify-content-center my-5">
        <a href="articulo_listado.php" class="btn btn-primary px-4 py-2">Volver al Listado</a>
    </section>

</main>

<?php require("pie.php"); ?>
