

<?php
// Establecer conexión con la base de datos y obtener los parámetros tipo y poblacion de la URL
require_once("datos_conexion.php");
$con = mysqli_connect($host, $username, $password, $dbname) or die ("No se ha podido conectar con la base de datos");
$tipo = $_GET['tipo'];
$poblacion = $_GET['poblacion'];

// Consulta para obtener los locales según el tipo y la población seleccionados
$query = "SELECT * FROM locales WHERE tipo = '$tipo' AND poblacion = '$poblacion'";
$result = mysqli_query($con, $query);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mapa de locales</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <script type="text/javascript">
        
        //funcion que inicializa un mapa de google maps, definimos un objeto para la localización py poder centrar el mapa en la primera visualización, independientemente de las demás consultas
        function initMap() {
            const myLatLng = { lat: 42.57442, lng: -0.54910 };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 5,
                center: myLatLng,
            });

            let misMarcadores = []; // array que almacena los marcadores de los locales guardados en la base de datos
            
            <?php
            while ($locales = mysqli_fetch_array($result)) {
                extract($locales);
                list($lat, $lng) = explode(',', $coordenadas);
                echo "misMarcadores.push(['" . $nombre . "', new google.maps.LatLng(" . $lat . ", " . $lng . "), '" . $poblacion . "', '" . $tipo . "']);";
            }
            ?>
            // objeto infoWindow para mostrar informacion al hacer clic en un marcador
            const infowindow = new google.maps.InfoWindow();

            misMarcadores.forEach(([title, position, poblacion, tipo]) => {
                const marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: title,
                });

                marker.addListener("click", () => {
                    infowindow.setContent("<h3>" + title + "</h3><p>Población: " + poblacion + "</p><p>Tipo: " + tipo + "</p>");
                    infowindow.open(map, marker);
                });
            });
        }

        window.initMap = initMap;
                
      //7809a67252b095f4914feef62eefa0f4 api key openwheater  
      

    </script>
</head>
<body>
<div id="map"></div>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrKTFMjZs2aIyOIhBdIuTCepRsi48yF38&callback=initMap&v=weekly"
        defer>

</script> 
</body>
</html>
