<?php
$ruta = '../';
require("encabezado.php");

?>

<main class="container py-3">
    <section class="d-flex justify-content-center">
        <form class="p-4 border rounded w-50" action="configuracion_ok.php" method="POST">
            <fieldset>
                <legend class="text-center mb-4">Elección de Tema</legend>

                <section class="form-check">
                    <input class="form-check-input" 
                           type="radio" 
                           name="tema" 
                           id="tema_claro"
                           value="claro"
                           <?php if (!empty($_COOKIE['tema']) && $_COOKIE['tema'] == "claro") echo "checked"; ?>>
                    <label class="form-check-label" for="tema_claro">Tema Claro</label>
                </section>

                <section class="form-check">
                    <input class="form-check-input" 
                           type="radio" 
                           name="tema" 
                           id="tema_oscuro"
                           value="oscuro"
                           <?php if (!empty($_COOKIE['tema']) && $_COOKIE['tema'] == "oscuro") echo "checked"; ?>>
                    <label class="form-check-label" for="tema_oscuro">Tema Oscuro</label>
                </section>

                <button type="submit" class="btn btn-primary w-100 mt-4">Confirmar</button>
            </fieldset>
        </form>
    </section>
</main>

<?php require("pie.php"); ?>

