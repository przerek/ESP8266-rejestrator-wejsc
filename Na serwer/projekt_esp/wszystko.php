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

		$sql = "SELECT  dzien,miesiac,rok,godzina,minuta,sekunda,id FROM test ORDER BY id DESC ";

		$result = $conn->query($sql);

               echo '</br><a href="/projekt_esp/index.php">Dziś</a>';
        echo '</br><a href="/projekt_esp/histogram.php">Histogram</a>';
		if ($result->num_rows > 0) {

echo "</br>Wszystkich zamknięć furtki: ".$result->num_rows;

			echo '<table cellspacing="0" border="1" rules="rows" bordercolor="black" style="width:100%;">';
			echo '<tr>

					<td width="100px" bgcolor="silver" align="center">ID:</td>
                    <td width="100px" bgcolor="gray" align="center">Data:</td>
                    <td width="100px" bgcolor="silver" align="center">Godzina:</td>
				</tr>';
			while($row = $result->fetch_assoc()) {

                $id=$row["id"];
                $godzina=$row["godzina"];
                $minuta=$row["minuta"];
                $sekunda=$row["sekunda"];
                $dzien=$row["dzien"];
                $miesiac=$row["miesiac"];
                $rok=$row["rok"];

                if(strlen($godzina)==1)
                $godzina="0".$godzina;

                if(strlen($minuta)==1)
                $minuta="0".$minuta;

                if(strlen($sekunda)==1)
                $sekunda="0".$sekunda;

                if(strlen($dzien)==1)
                $dzien="0".$dzien;

                if(strlen($miesiac)==1)
                $miesiac="0".$miesiac;

				echo '<tr>
    					<td bgcolor="silver" align="center">'.$row["id"].'</td>
						<td bgcolor="gray" align="center">'.$dzien.".".$miesiac.".".$rok.'</td>
						<td bgcolor="silver" align="center">'.$godzina.":".$minuta.":".$sekunda."</td>
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