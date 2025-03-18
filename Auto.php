<?php
class Auto
{
    private $id;
    public $hersteller;
    private $name;
    private $ps;
    private $farbe;
    private $baujahr;

    public function __construct(int $id, string $hersteller, string $name, int $ps, string $farbe, int $baujahr)
    {
        $this->id = $id;
        $this->hersteller = $hersteller;
        $this->name = $name;
        $this->ps = $ps;
        $this->farbe = $farbe;
        $this->baujahr = $baujahr;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<?php

$vwAuto = new Auto(1, "VW", "Golf", 90, "Blau", 1996 );

$vwAuto->setId(345676);
echo $vwAuto->getId();

?>
</body>
</html>
