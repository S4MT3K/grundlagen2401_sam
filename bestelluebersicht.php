<?php
$fname = $_GET['fname'] ?? 'John';
$lname = $_GET['lname'] ?? 'Dorian';
$color = $_GET['color'] ?? 'Black';
$optionsArray = $_GET['options'] ?? ['ABS', 'Sportsitze', 'Lichtpaket', '19" Chrom Felgen'];
$marke = $_GET['marke'] ?? 'Seat';

$bestelltext = "";

function getDBConnection(): PDO
{
    // Das Objekt benoetigt den der Ort der DBMS, den DBname, Username, Passwort.
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "auto_240617";
    // gibt ein Objekt der Klasse PDO zurück
    return new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
}

function createBestellEintrag(string $thename, string $theother, string $thecolor) : void
{
    //holen unserer Datenbank Verbindung
    $dbcon = getDBConnection();

    // Erstellen ein PDOStatment Objekt und teilen es mit einen SQL Befehl an die Datenbank zu senden
    $stmt_create = "INSERT INTO bestellungen (vorname, nachname, farbcode) VALUES (:fname, :lname, :fcode)"; // Unsere "Normale" (all) abfrage an die Datenbank

    //Vorbereitung unseres SQL-Befehls
    $request = $dbcon->prepare($stmt_create);

    //nachfolgend werden unsere parameter "überprüft" und gebunden, sodass sie sicher an die Datenbank gesendet werden können!
    $request->bindParam(":fname", $thename, 2);
    $request->bindParam(":lname", $theother, 2);
    $request->bindParam(":fcode", $thecolor, 2);

    //Inline bzw. kompakte möglichkeit es direkt im Execute zu binden und auszuführen!
    //$request->execute([    ':fname' => $fname,    ':lname' => $lname,    ':color' => $color,    ':brand' => $marke]);

    // Schicke den Befehl ab
    $request->execute();
}

//Wenn Server GET Request erhält und die bestellt variable in der GET-Variable Vorhanden, dann:
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset ($_GET["bestellt"]))
{
    //zeigt eine Meldung, die die Bestellung bestätigt.
    $bestelltext = "<p> AUTO ERFOLGREICH BESTELLT </p>";
    //Bestellung in Datenbank Schreiben
    createBestellEintrag($fname, $lname, $color);
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestellübersicht!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        td, th {
            border: 1px solid #ccc;
            padding: 10px;
        }
        .color-box {
            width: 50px;
            height: 20px;
            background-color: <?php echo htmlspecialchars($color); ?>;
            border: 1px solid #000;
            display: inline-block;
        }
        .button-container {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Bestellübersicht</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Marke</th>
        </tr>
        <tr>
            <td><?php echo htmlspecialchars($fname . ' ' . $lname); ?></td>
            <td><?php echo htmlspecialchars($marke); ?></td>
        </tr>
        <tr>
            <th>Farbe</th>
            <th>Vorschau</th>
        </tr>
        <tr>
            <td><?php echo htmlspecialchars($color); ?></td>
            <td><span class="color-box"></span></td>
        </tr>
        <?php if (!empty($optionsArray)): ?>
            <tr>
                <th colspan="2">Extras</th>
            </tr>
            <?php foreach ($optionsArray as $option): ?>
                <tr>
                    <td colspan="2"><?php echo htmlspecialchars($option); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <div class="button-container">
        <form method="get">
            <input type="hidden" name="bestellt" value="1">
            <button type="submit">Bestellen</button>
        </form>
        <?php echo $bestelltext ?>
    </div>
</div>

</body>
</html>