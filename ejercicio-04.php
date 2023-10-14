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
        <img src="img/pension_estudiantes.png" alt="Encabezado" width="50%" height="auto">
    </header>
    <form action="" method="post">
        <table>
            <tr>
                <td>Alumno:</td>
                <td><input type="text" name="alumno" required></td>
            </tr>
            <tr>
                <td>Promedio Ponderado:</td>
                <td><input type="number" name="promedio" min="0" step="0.01" required></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="procesar" value="Procesar"></td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST['procesar'])) {
        $alumno = $_POST['alumno'];
        $promedio = $_POST['promedio'];

        // Función anónima para determinar la categoría del estudiante según su promedio
        $obtenerCategoria = function ($promedio) {
            if ($promedio > 17) return 'A';
            elseif ($promedio >= 14) return 'B';
            elseif ($promedio >= 12) return 'C';
            else return 'D';
        };

        // Función anónima para calcular la pensión del estudiante según su categoría
        $calcularPension = function ($categoria) {
            switch ($categoria) {
                case 'A':
                    return 550.00;
                case 'B':
                    return 650.00;
                case 'C':
                    return 750.00;
                case 'D':
                    return 800.00;
            }
        };

        // Función anónima para determinar la fecha actual
        $obtenerFechaActual = function () {
            return date('d/m/Y');
        };

        // Función anónima para asignar un valor constante de 5 cuotas para todos los estudiantes
        $obtenerNumeroCuotas = function () {
            return 5;
        };

        $categoria = $obtenerCategoria($promedio);
        $pension = $calcularPension($categoria);
        $fechaActual = $obtenerFechaActual();
        $numeroCuotas = $obtenerNumeroCuotas();

        // Imprimir resumen
        echo "<br><table>";
        echo "<tr><td>Alumno:</td><td>$alumno</td></tr>";
        echo "<tr><td>Promedio:</td><td>$promedio</td></tr>";
        echo "<tr><td>Categoría:</td><td>$categoria</td></tr>";
        echo "<tr><td><b>RESUMEN DE CUOTAS</b></td><td></td></tr>";
        echo "<tr><td>Monto Pensión:</td><td>\$$pension</td></tr>";
        echo "<tr><td>Fecha Actual:</td><td>$fechaActual</td></tr>";
        echo "<tr><td>Número de Cuotas:</td><td>$numeroCuotas</td></tr>";

        // Calcular y mostrar las fechas y montos de las cuotas
        $totalPorSemestre = 0;
        echo "<tr><td><b>RESUMEN DE FECHAS Y CUOTAS</b></td><td></td></tr>";
        for ($i = 1; $i <= $numeroCuotas; $i++) {
            $fecha = date('d/m/Y', strtotime("+1 month", strtotime($fechaActual)));
            $totalPorSemestre += $pension;
            echo "<tr><td>Fecha:</td><td>$fecha</td></tr>";
            echo "<tr><td>Monto por Cuota:</td><td>\$$pension</td></tr>";
            $fechaActual = $fecha;
        }
        echo "<tr><td>Total por Semestre:</td><td>\$$totalPorSemestre</td></tr>";
        echo "</table>";
    }
    ?>
</body>
</html>