<?php
		include('polaczenie.php');

$conn = new mysqli($servername, $username, $password, $dbname); //Utworzenie połączenia z MySQL

if ($conn->connect_error) { //Sprawdzenie połączenia z MySQL
    die("Connection failed: " . $conn->connect_error); //Wyświetlenie informacji o problemie z połączeniem
}



$today = getdate();
$d=$today[mday];
$m=$today[mon];
$r=$today[year];

$g=$today[hours];
$min=$today[minutes];
$s=$today[seconds];

$sql = "INSERT INTO test (Dzien,Miesiac,Rok,Godzina,Minuta,Sekunda)
VALUES ('$d','$m','$r','$g','$min','$s')"; 


if ($conn->query($sql) === TRUE) { //Sprawdzenie czy dane zostały poprawnie dodane do tabeli
    echo "Rekord zostal dodany poprawnie!"; //Wyświetlenie komunikatu o powodzeniu
} else {
    echo "Error: " . $sql . "<br>" . $conn->error; //Wyświetlenie komunikatu o niepowodzeniu wraz z informacjami na temat błędu
}

$conn->close(); //Zamknięcie połączenia z MySQL
?>