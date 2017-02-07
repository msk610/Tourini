<?php

class friend {
  private $mysqli;
  public function __construct() {
    $this->connect();
  }
  private function connect() {
    $this->mysqli = new mysqli( 'localhost', 'root', 'ums818Ezekiel', 'Tourini' );
  }
  public function friend($friend_term) {
    // Sanitize
    
    $query = $this->mysqli->query("
      SELECT *
      FROM friends join User
      WHERE User.uid = friends.uid1 and uid2 = $friend_term and friends.request is NULL;
    ");
    if ( ! $query->num_rows ) {
      return false;
    }
	
    // fetch
    while( $row = $query->fetch_object() ) {
      $rows[] = $row;
    }
    
    // result
    $friend_results = array(
      'count' => $query->num_rows,
      'results' => $rows,
    );
    return $friend_results;
  }
}