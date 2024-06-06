<?php
require_once("datos_conexion.php");
$con = mysqli_connect($host, $username, $password, $dbname) or die ("No se ha podido conectar con la base de datos");
$query_poblaciones = "SELECT DISTINCT poblacion FROM locales";
$result_poblaciones = mysqli_query($con, $query_poblaciones);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Búsqueda de Locales</title>
</head>
<body>
    <h1>Búsqueda de Locales</h1>
    <form action="mostrar_locales.php" method="get">
        <label for="tipo">Tipo de Local:</label>
        <select name="tipo" id="tipo">
            <option value="Restaurantes">Restaurantes</option>
            <option value="Bares">Bares</option>
            <option value="Discotecas">Discotecas</option>
        </select>
        
        <label for="poblacion">Población:</label>
        <select name="poblacion" id="poblacion">
            <?php while($row = mysqli_fetch_array($result_poblaciones)): ?>
                <option value="<?php echo $row['poblacion']; ?>"><?php echo $row['poblacion']; ?></option>
            <?php endwhile; ?>
        </select>
        
        <input type="submit" value="Buscar">
    </form>
</body>
</html>