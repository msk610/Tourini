<?php

class profile {
  private $mysqli;
  public function __construct() {
    $this->connect();
  }
  private function connect() {
    $this->mysqli = new mysqli( 'localhost', 'root', 'ums818Ezekiel', 'Tourini' );
  }
  public function profile($profile_term) {

    $query = $this->mysqli->query("
	    SELECT distinct(uid),profilePic,firstName,lastName
	         FROM friends join User
	         WHERE (friends.uid1 = $profile_term OR friends.uid2 = $profile_term) and (User.uid = friends.uid2 OR User.uid = friends.uid1) and friends.request = 1;
    ");
    if ( ! $query->num_rows ) {
      return false;
    }
    // fetch
    while( $row = $query->fetch_object() ) {
      $rows[] = $row;
    }
    
    // result
    $profile_results = array(
      'count' => $query->num_rows,
      'results' => $rows,
    );
    return $profile_results;
  }
}