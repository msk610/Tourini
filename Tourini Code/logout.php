<?php
	session_start();
	
	$_SESSION = array();

	//delete cookies
	if (ini_get("session.use_cookies")) {
	    $params = session_get_cookie_params();
	    setcookie(session_name(), '', time() - 42000,
	        $params["path"], $params["domain"],
	        $params["secure"], $params["httponly"]
	    );
	}
	
	if(session_destroy()) {
		header("Location: http://127.0.0.1/Tourini/index.php?new_user=Sign-out was Successful!"); /* Redirect browser */
	}
?>