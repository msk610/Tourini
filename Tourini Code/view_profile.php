<?php

class view {
  private $mysqli;
  public function __construct() {
    $this->connect();
  }
  private function connect() {
    $this->mysqli = new mysqli( 'localhost', 'root', 'ums818Ezekiel', 'Tourini' );
  }
  public function view($view_term) {

    $query = $this->mysqli->query("
		SELECT distinct(uid),profilePic,firstName,lastName,dob,gender
		      FROM friends join User
		      WHERE User.uid = friends.uid2 and uid = $view_term and friends.request = 1;
    ");
    if ( ! $query->num_rows ) {
      return false;
    }
    // fetch
    while( $row = $query->fetch_object() ) {
      $rows[] = $row;
    }
    
    // result
    $view_results = array(
      'count' => $query->num_rows,
      'results' => $rows,
    );
    return $view_results;
  }
}