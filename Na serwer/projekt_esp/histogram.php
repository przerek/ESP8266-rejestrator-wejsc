<?php
				include('polaczenie.php');

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
		$sql = "SELECT id, dzien,miesiac,rok,godzina,minuta,sekunda FROM test ORDER BY id DESC";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {

for ($x = 0; $x < 1440; $x++) 
    $tab[$x] = "";     

while($row = $result->fetch_assoc()) {
	$ktora=$row["godzina"]*60+$row["minuta"];
	$tab[$ktora]++;
}

$dataPoints = array();
$ile_minut_w_przedziale=60;
$etykieta=0;
$temp=0;

	  for ($x = 0; $x <1440; $x++) {

		  if(($x%$ile_minut_w_przedziale!=0||$x==0)&&$x!=1439){
		  $temp=$temp+$tab[$x];
	}else{

		  $dataPoints[$etykieta] = array();
			$dataPoints[$etykieta]['y'] = $temp;
		  $dataPoints[$etykieta]['label'] = $etykieta; 

		$temp=$tab[$x];
		$etykieta++;
	}

} 

echo '</br><a href="/projekt_esp/index.php">Dziś</a>';
 echo '</br><a href="/projekt_esp/wszystko.php">Wszystkie</a>';

		} else {
			echo "0 results";
		}
		$conn->close();
		?>

    <!DOCTYPE HTML>
    <html>

    <head>
        <script>
            window.onload = function() {

                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    theme: "light3",
                    title: {
                        text: "Histogram"
                    },
                    axisY: {
                        title: "Liczba zamknięć"
                    },
                    data: [{
                        type: "column",
                        yValueFormatString: "#,##0.## zamknięć",
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }]
                });
                chart.render();

            }
        </script>

    </head>

    <body>

        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </body>

    </html>