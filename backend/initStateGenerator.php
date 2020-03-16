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

class Game
{
  public $id = null;
  public $players = null;
  public $territories = [];
    

  public function __construct($id, $players)
  {
    $this->id = $id;
    $this->players = $players;
    $this->territories = [
      new Territory('brazil', null, 0),
      new Territory('argentina', null, 0),
      new Territory('peru', null, 0),
      new Territory('venezuela', null, 0)
    ];
  }
}

class Player
{
  public $name = null;
  public $territories = [];
  public $total_force = 0;

  public function __construct($name, $territories, $total_force)
  {
    $this->name = $name;
    $this->territories = $territories;
    $this->total_force = $total_force;
  }
}

$num_players = 2;
$initial_force = 5;

$game = new Game(1, []);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//This block of code is supposed to generate the initial state of game instead of manual distribution of forces and territories
for ($i = 0; $i < $num_players; $i++){
  $game->players[$i] = new Player('Player'.$i, [], $initial_force);
}

//initial distribution of territories (one troop added to each territory)
$territories = $game->territories;
shuffle($territories);
$pl = 0;
foreach($territories as $territory){
  $territory->player = $game->players[$pl]->name;   //$game->players[$pl]
  $territory->force = 1;
  $game->players[$pl]->territories[] = $territory->name;
  // echo $territory->name." - ".$game->players[$pl]->name."\n";
  // echo $game->players[$pl]->territories[0]->name."\n";

  if($pl == $num_players - 1){
    $pl = 0;
  }else{
    $pl++;
  }
}

//distribution of remaining troops
for($i = 1; $i < $initial_force-1; $i++){
  foreach($game->players as $player){
    $territory = $player->territories[rand(0, count($player->territories)-1)];
    foreach($game->territories as $ter){
      if($ter->name == $territory){
        $ter->force += 1;
        break;
      }
    }
  }
}

foreach($game->territories as $ter){
  var_dump($ter->name." ".$ter->player." ".$ter->force);
}

// var_dump($game->territories[0]->player->territories[0]->player);
// var_dump($game->territories);
// var_dump($game->players[1]->territories);
// header('Content-type: application/json');
// echo json_encode($game);