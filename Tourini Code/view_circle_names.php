<?php

class view_circles {
  private $mysqli;
  public function __construct() {
    $this->connect();
  }
  private function connect() {
    $this->mysqli = new mysqli( 'localhost', 'root', 'ums818Ezekiel', 'Tourini' );
  }
  public function view_circles($uid) {
    // Sanitize
    
    $query = $this->mysqli->query("
		select distinct(circle_name)
			from circles
		    where uid1 = $uid;
    ");
    if ( ! $query->num_rows ) {
      return false;
    }
	
    // fetch
    while( $row = $query->fetch_object() ) {
      $rows[] = $row;
    }

    // result
    $view_circles_results = array(
      'count' => $query->num_rows,
      'results' => $rows
    );
    return $view_circles_results;
  }
}