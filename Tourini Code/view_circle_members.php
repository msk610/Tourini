<?php
class view_circle_members {
  private $mysqli;
  public function __construct() {
    $this->connect();
  }
  private function connect() {
    $this->mysqli = new mysqli( 'localhost', 'root', 'ums818Ezekiel', 'Tourini' );
  }
  public function view_circle_members($circle_name) {
    $query = $this->mysqli->query("
		Select firstName, lastName, profilePic, uid 
			FROM User
		    Where uid in (select distinct(uid2)
					from circles join User
					where circles.circle_name = '".$circle_name."');
    ");
    if ( ! $query->num_rows ) {
      return false;
    }
	
    // fetch
    while( $row = $query->fetch_object() ) {
      $rows[] = $row;
    }
	
    // result
    $view_circle_result = array(
      'count' => $query->num_rows,
      'results' => $rows
    );
    return $view_circle_result;
  }
}