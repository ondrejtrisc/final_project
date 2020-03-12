<?php

class Territory
{
  public $name = null;
  public $player = null;
  public $force = null;

  public function __construct($name, $player, $force)
  {
    $this->name = $name;
    $this->player = $player;
    $this->force = $force;
  }
}

$game_state = [
  $brazil = new Territory('brazil', 1, 3),
  $argentina = new Territory('argentina', 1, 1),
  $peru = new Territory('peru', 2, 3),
  $venezuela = new Territory('venezuela', 2, 1)
];

$neighbours = [
  'brazil' => [$argentina, $peru, $venezuela],
  'argentina' => [$brazil, $peru],
  'peru' => [$brazil, $argentina, $venezuela],
  'venezuela' => [$brazil, $peru]
];

$fromName = $_GET['from'];
$toName = $_GET['to'];

foreach ($game_state as $territory)
{
  if ($territory->name === $fromName)
  {
    $fromTerritory = $territory;
    break;
  }
}

foreach ($game_state as $territory)
{
  if ($territory->name === $toName)
  {
    $toTerritory = $territory;
    break;
  }
}

if ($fromTerritory->force > $toTerritory->force)
{
  $toTerritory->force -= 1;
}
else
{
  $fromTerritory->force -= 1;
}

if($toTerritory->force === 0)
{
  $toTerritory->player = $fromTerritory->player;
  $toTerritory->force = $fromTerritory->force - 1;
  $fromTerritory->force = 1;
}

foreach ($game_state as $territory)
{
  $territory->hostileNeighbours = [];
  foreach ($neighbours[$territory->name] as $neighbour)
  {
    if ($territory->player !== $neighbour->player) {
      $territory->hostileNeighbours[] = $neighbour->name;
    }
  }
}

header('Content-type: application/json');
echo json_encode($game_state);

?>
