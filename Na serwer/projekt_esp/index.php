<html>

<head>
    <title>Dane</title>
</head>

<body>
    <?php
		include('polaczenie.php');

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

$today = getdate();
$d=$today[mday];
$m=$today[mon];
$r=$today[year];
$g=$today[hours];
$min=$today[minutes];
$s=$today[seconds];

		$sql = "SELECT  dzien,miesiac,rok,godzina,minuta,sekunda FROM test WHERE dzien='$d' AND miesiac='$m'AND rok='$r' ORDER BY id DESC ";

		$result = $conn->query($sql);

        echo '</br><a href="/projekt_esp/wszystko.php">Wszystkie</a>';
        echo '</br><a href="/projekt_esp/histogram.php">Histogram</a>';
		if ($result->num_rows > 0) {

echo "</br>Zamknięć furtki dziś: ".$result->num_rows;

			echo '<table cellspacing="0" border="1" rules="rows" bordercolor="black" style="width:100%;">';
			echo '<tr>

					<td width="100px" bgcolor="silver" align="center">Godzina:</td>
				</tr>';
			while($row = $result->fetch_assoc()) {

                $godzina=$row["godzina"];
                $minuta=$row["minuta"];
                $sekunda=$row["sekunda"];

                if(strlen($godzina)==1)
                $godzina="0".$godzina;

                if(strlen($minuta)==1)
                $minuta="0".$minuta;

                if(strlen($sekunda)==1)
                $sekunda="0".$sekunda;

				echo '<tr>

					    	<td bgcolor="silver" align="center">' . $godzina.":".$minuta.":".$sekunda.  " </td>
					</tr>";
			}
			echo "</table>";

		} else {
			echo "Brak zarejestrowanych zamknięć";
		}

		$conn->close();
		?>
</body>

</html>