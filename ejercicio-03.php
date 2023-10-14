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
        <img src="img/venta_productos.png" alt="Encabezado" width="50%" height="auto">
    </header>
    <form action="ejercicio-03.php" method="post">
        <table>
            <tr>
                <td>Nro Venta:</td>
                <td>00001</td>
            </tr>
            <tr>
                <td>Fecha:</td>
                <td>22-05-23</td>
            </tr>
            <tr>
                <td>Hora:</td>
                <td>07:58 PM</td>
            </tr>
            <tr>
                <td>Producto:</td>
                <td>
                    <select name="producto">
                        <option value="mouse">Mouse óptico</option>
                        <option value="teclado">Teclado multimedia</option>
                        <option value="parlantes">Parlantes USB</option>
                        <option value="auriculares">Auriculares gamer</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Cantidad:</td>
                <td><input type="number" name="cantidad" min="1" required></td>
            </tr>
            <tr>
                <td>Precio:</td>
                <td>
                    <?php
                    $producto = $_POST['producto'];
                    $precio = 0;

                    switch ($producto) {
                        case 'mouse':
                            $precio = 30;
                            break;
                        case 'teclado':
                            $precio = 40;
                            break;
                        case 'parlantes':
                            $precio = 50;
                            break;
                        case 'auriculares':
                            $precio = 60;
                            break;
                    }
                    echo "$" . $precio . ".00";
                    ?>
                </td>
            </tr>
        </table>
        <input type="submit" name="procesar" value="PROCESAR">
    </form>
</body>
</html>