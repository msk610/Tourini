<?php

class search {
  private $mysqli;
  public function __construct() {
    $this->connect();
  }
  private function connect() {
    $this->mysqli = new mysqli( 'localhost', 'root', 'ums818Ezekiel', 'Tourini' );
  }
  public function search($search_term) {
    // Sanitize
    $sanitized = $this->mysqli->real_escape_string($search_term);
    
    $query = $this->mysqli->query("
		SELECT distinct(User.uid),message, firstName, lastName
		      FROM User JOIN message JOIN Location JOIN Pictures
		      WHERE User.firstName LIKE '%{$sanitized}%'
		      OR User.lastName LIKE '%{$sanitized}%'
			  or User.uname LIKE '%{$sanitized}%'
		      or Message.message LIKE '%{$sanitized}%'
			  or Message.timeSent LIKE '%{$sanitized}%'
		      or Location.city LIKE '%{$sanitized}%'
		      or Pictures.caption LIKE '%{$sanitized}%'
		      or Pictures.timeTaken LIKE '%{$sanitized}%'
		      group by Pictures.timeTaken, Message.timeSent,User.profilePic,Message.message;
    ");
    
    if ( ! $query->num_rows ) {
      return false;
    }

    // fetch
    while( $row = $query->fetch_object() ) {
      $rows[] = $row;
    }
    
    // result
    $search_results = array(
      'count' => $query->num_rows,
      'results' => $rows,
    );
    return $search_results;
  }
}