<?php
function readAutoArray() : array
{
    // Das Objekt benoetigt den der Ort der DBMS, den DBname, Username, Passwort.
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "auto_240617";

    // Erstellen ein Objekt der Klasse PDO
    $dbcon = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $stmt_read = "Select * from auto"; // Unsere "Normale" (all) abfrage an die Datenbank

    // Erstellen ein PDOStatment Objekt und teilen es mit einen SQL Befehl an die Datenbank zu senden
    $request = $dbcon->prepare($stmt_read);
    // Schicke den Befehl ab
    $request->execute();
    // Wir holen uns die Antwort
    $result = $request->fetchAll(PDO::FETCH_ASSOC);
    //Geben unsere Variable (in dem Fall ein Assoziatives Array) zurück
    return $result;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto kaufen!</title>
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
            width: 300px;
        }
        h2 {
            text-align: center;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        input, select {
            width: 90%;
            max-width: 250px;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .checkbox-group, .radio-group {
            display: flex;
            flex-direction: column;
        }
        .submit-btn {
            width: 100%;
            background: #28a745;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 15px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        .submit-btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Auto kaufen</h2>
    <form action="auto_beamter.php" method="get">
        <label for="fname">Vorname:</label>
        <input id="fname" type="text" name="fname" required>

        <label for="lname">Nachname:</label>
        <input id="lname" type="text" name="lname" required>

        <label>Farbe:</label>
        <div class="radio-group">
            <input id="red" type="radio" name="color" value="red"> <label for="red">Rot</label>
            <input id="green" type="radio" name="color" value="green"> <label for="green">Grün</label>
            <input id="blue" type="radio" name="color" value="blue"> <label for="blue">Blau</label>
        </div>

        <label>Extras:</label>
        <div class="checkbox-group">
            <input id="aus_1" type="checkbox" name="aus[]" value="abs"> <label for="aus_1">ABS</label>
            <input id="aus_2" type="checkbox" name="aus[]" value="klima"> <label for="aus_2">Klima</label>
            <input id="aus_3" type="checkbox" name="aus[]" value="airbag"> <label for="aus_3">Airbag</label>
        </div>

        <label for="marke">Marke:</label>
        <select id="marke" name="marke">
            <?php
            $markenarray = readAutoArray();

            for ($i = 0; $i < count($markenarray); $i++){
                echo "<option value='" . $markenarray[$i]["hersteller"] . "'>" . $markenarray[$i]["hersteller"] . "</option>";


            }
            ?>
        </select>

        <button type="submit" class="submit-btn">Bestellen</button>
    </form>
</div>
</body>
</html>
