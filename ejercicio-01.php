<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <a href="index.php">INICIO</a> <br>
    <header>
        <h1 id="centrado">Pago de salario a empleados</h1>
        <img src="img/generar-codigo-empleado.png" alt="Encabezado" width="50%" height="auto">
    </header>
    <?php
    // Desactivar la notificación de errores para evitar mostrar mensajes al usuario.
    error_reporting(0);

    // Inicializar variables
    $apellidos = $_POST["txt_apellidos"];
    $nombres = $_POST["txt_nombres"];
    $fecha_nacimiento = $_POST["txt_fecha"];
    $estado_civil = $_POST["sel_estado_civil"];
    $sexo = $_POST["txt_sexo"];

    ?>

    <form method="post" action="ejercicio-01.php">
        <table>
            <tr>
                <td>Apellidos:</td>
                <td><input type="text" name="txt_apellidos" value="<?php echo $nombres ?>" placeholder="Ingrese Apellidos" size="50"></td>
                <td><?php echo (isset($_POST['calcular']) && $_POST['txt_apellidos']) ? '' : '<h6>Registre apellidos...!!</h6>'; ?></td>
                <td>CODIGO <br> GENERADO</td>
            </tr>

            <tr>
                <td>Nombres:</td>
                <td><input type="text" name="txt_nombres" value="<?php echo $nombres ?>" placeholder="Ingrese Nombres" size="50"></td>
                <td><?php echo (isset($_POST['calcular']) && $_POST['txt_nombres']) ? '' : '<h6>Registre nombres...!!</h6>'; ?></td>
                <td> <?php
                        if (isset($_POST['calcular'])) {

                            // Obtener los valores desde el formulario
                            $apellidos = $_POST["txt_apellidos"];
                            $nombres = $_POST["txt_nombres"];
                            $fecha_nacimiento = $_POST["txt_fecha"];
                            $estado_civil = $_POST["sel_estado_civil"];
                            $sexo = $_POST["txt_sexo"];

                            // Validar fecha de nacimiento
                            $fecha_valida = DateTime::createFromFormat('d/m/Y', $fecha_nacimiento);
                            $fecha_valida = $fecha_valida !== false && array_sum($fecha_valida->getLastErrors()) === 0;

                            if ($fecha_valida) {
                                // Obtener el año actual
                                $ano_actual = date("y");

                                // Asignar valores numéricos para estado civil y sexo
                                $estado_civil_numero = [
                                    "soltero" => 1,
                                    "casado" => 2,
                                    "viudo" => 3,
                                    "divorciado" => 4
                                ][$estado_civil];
                                $sexo_numero = ($sexo == "masculino") ? 1 : 2;

                                // Calcular la edad a partir de la fecha de nacimiento
                                $fecha_nacimiento_dt = DateTime::createFromFormat('d/m/Y', $fecha_nacimiento);
                                $fecha_actual = new DateTime();
                                $edad = $fecha_actual->diff($fecha_nacimiento_dt)->y;

                                // Generar el código del empleado
                                $codigo_empleado = "{$ano_actual}{$estado_civil_numero}{$sexo_numero}{$edad}";
                            } else {
                                $codigo_empleado = "Fecha inválida";
                            }
                            echo $codigo_empleado;
                        }
                        ?></td>
            </tr>

            <tr>
                <td>fecha de nacimiemnto:</td>
                <td><input type="text" name="txt_fecha" value="<?php echo $fecha_nacimiento ?>" placeholder="dd/mm/aaaa"></td>
                <td><?php echo (isset($_POST['calcular']) && $_POST['txt_fecha']) ? '' : '<h6>Fecha no válida</h6>'; ?></td>
            </tr>

            <tr>
                <td>Estado Civil:</td>
                <td>
                    <select name="sel_estado_civil">
                        <option value="disable">
                            <h6>Seleccione</h6>
                        </option>
                        <option value="soltero" <?php if (isset($_POST['calcular']) && $_POST['sel_estado_civil'] == 'soltero') echo 'selected'; ?>>Soltero(a)</option>
                        <option value="casado" <?php if (isset($_POST['calcular']) && $_POST['sel_estado_civil'] == 'casado') echo 'selected'; ?>>Casado(a)</option>
                        <option value="viudo" <?php if (isset($_POST['calcular']) && $_POST['sel_estado_civil'] == 'viudo') echo 'selected'; ?>>Viudo(a)</option>
                        <option value="divorciado" <?php if (isset($_POST['calcular']) && $_POST['sel_estado_civil'] == 'divorciado') echo 'selected'; ?>>Divorciado(a)</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Sexo:</td>
                <td>
                    <input type="radio" name="txt_sexo" value="masculino"> Masculino
                    <input type="radio" name="txt_sexo" value="femenino"> Femenino
                </td>
            </tr>

            <tr>
                <td></td>
                <td><input type="submit" name="calcular" value="Autogenerar Código"></td>
            </tr>

        </table>
    </form>


</body>

</html>