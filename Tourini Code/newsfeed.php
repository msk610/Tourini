<?php

class newsfeed {
  private $mysqli;
  public function __construct() {
    $this->connect();
  }
  private function connect() {
    $this->mysqli = new mysqli( 'localhost', 'root', 'ums818Ezekiel', 'Tourini' );
  }
  public function newsfeed($newsfeed_term) {

    $query = $this->mysqli->query("
	    SELECT Pictures.caption, User.firstName, User.lastName, User.profilePic, User.uid
	   	FROM User as mainUser
	   	JOIN Friends ON mainUser.uid = Friends.uid1 OR mainUser.uid = Friends.uid2 
	       JOIN Pictures ON Pictures.uid = Friends.uid1 OR Pictures.uid = Friends.uid2 
	       Join User ON User.uid = Pictures.uid
	       WHERE mainUser.uid = $newsfeed_term
	       group by Pictures.pid;
    ");
    if ( ! $query->num_rows ) {
      return false;
    }
    // fetch
    while( $row = $query->fetch_object() ) {
      $rows[] = $row;
    }
    
    // result
    $newsfeed_results = array(
      'count' => $query->num_rows,
      'results' => $rows,
    );
    return $newsfeed_results;
  }
}

class newsfeedm {
  private $mysqli;
  public function __construct() {
    $this->connect();
  }
  private function connect() {
    $this->mysqli = new mysqli( 'localhost', 'root', 'ums818Ezekiel', 'Tourini' );
  }
  public function newsfeedm($newsfeedm_term) {

    $query = $this->mysqli->query("
	    SELECT message.message, User.firstName, User.lastName, User.profilePic, User.uid
	   	FROM User as mainUser
	   	JOIN Friends ON mainUser.uid = Friends.uid1 OR mainUser.uid = Friends.uid2 
	       JOIN message ON message.uid = Friends.uid1 OR message.uid = Friends.uid2 
	       Join User ON User.uid = message.uid
	       WHERE mainUser.uid = $newsfeedm_term
	       group by message.mid;
    ");
    if ( ! $query->num_rows ) {
      return false;
    }
    // fetch
    while( $row = $query->fetch_object() ) {
      $rows[] = $row;
    }
    
    // result
    $newsfeedm_results = array(
      'count' => $query->num_rows,
      'results' => $rows,
    );
    return $newsfeedm_results;
  }
}

class newsfeedl {
  private $mysqli;
  public function __construct() {
    $this->connect();
  }
  private function connect() {
    $this->mysqli = new mysqli( 'localhost', 'root', 'ums818Ezekiel', 'Tourini' );
  }
  public function newsfeedl($newsfeedl_term) {

    $query = $this->mysqli->query("
	    SELECT location.longitude, location.latitude, location.city, User.firstName, User.lastName, User.profilePic, User.uid
	   	   FROM User as mainUser
	   	   JOIN Friends ON mainUser.uid = Friends.uid1 OR mainUser.uid = Friends.uid2 
	       JOIN location ON location.uid = Friends.uid1 OR location.uid = Friends.uid2 
	       Join User ON User.uid = location.uid
	       WHERE mainUser.uid = $newsfeedl_term
	       group by location.lid;
    ");
    if ( ! $query->num_rows ) {
      return false;
    }
    // fetch
    while( $row = $query->fetch_object() ) {
      $rows[] = $row;
    }
    
    // result
    $newsfeedl_results = array(
      'count' => $query->num_rows,
      'results' => $rows,
    );
    return $newsfeedl_results;
  }
}