<?php
$fname = $_GET['fname'] ?? 'Joe';
$lname = $_GET['lname'] ?? '';
$color = $_GET['color'] ?? 'white';
$aus_array = $_GET['aus'] ?? [];
$marke = $_GET['marke'] ?? 'Unbekannt';

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
        <?php if (!empty($aus_array)): ?>
            <tr>
                <th colspan="2">Extras</th>
            </tr>
            <?php foreach ($aus_array as $aus): ?>
                <tr>
                    <td colspan="2"><?php echo htmlspecialchars($aus); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>
</body>
</html>
