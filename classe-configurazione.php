<?php

  header('Content-Type: application/json');
  
  class Configurazione {

    public $id;
    public $title;
    public $description;

    function __construct($id, $title = '', $description = '') {
      $this -> id = $id;
      $this -> title = $title;
      $this -> description = $description;
    }

    public function __toString() {
      return "[" . $this -> id . "] "
                . $this -> title . " - "
                . substr($this -> description, 0, 5);
    }
  }

  $server = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "HotelDB";

  $conn = new mysqli($server, $username, $password, $dbname);

  if ($conn -> connect_errno) {
    echo json_encode(-1);
    return;
  }

  $sql = "
      SELECT *
      FROM configurazioni
  ";

  $res = $conn -> query($sql);

  if ($res -> num_rows < 1) {
    echo json_encode(-2);
    return;
  }

  $confs = [];
  while($conf = $res -> fetch_assoc()) {

    $myConf = new Configurazione( $conf['id'], $conf['title'], $conf['description'] );
    $confs[] = $myConf;
  }

  echo json_encode($confs);

?>