<?php
// Spajanje na bazu podataka
$servername = "ucka.veleri.hr";
$username = "pkomljenovic";
$password = "11";
$dbname = "pkomljenovic";

$conn = new mysqli($servername, $username, $password, $dbname);

// Provjera veze
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Dohvaćanje odabrane vrijednosti žanra
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $selected_genre = $_GET["zanr"];

    // SQL upit za dohvaćanje filmova prema odabranom žanru
    $sql = "SELECT * FROM Filmovi WHERE zanr = '$selected_genre' ";
    $result = $conn->query($sql);

    // Prikaz rezultata
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='film'>";
            echo "<h3>{$row['naslov']}</h3>";

            
            echo "<img src='{$row['slika_url']}' alt='{$row['naslov']}'>";

            echo "<p>Godina izlaska: {$row['godina']}</p>";
            echo "<p>Ocjena: {$row['ocjena']}</p>";
            echo "<p>Zanr: {$row['zanr']}</p>";
            echo "<a href='{$row['viseInfoLink']}' class='vise-info' target='_blank'>Više o filmu</a>";
            echo "</div>";
        }
    } else {
        echo "<p>Nema dostupnih filmova za odabrani žanr.</p>";
    }
}

// Zatvaranje veze s bazom podataka
$conn->close();
?>