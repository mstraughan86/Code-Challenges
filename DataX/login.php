<?php

public function checkCredentials($username, $password)
{
	$con = new mysqli($db_servername, $db_username, $db_password, $db_name);
	
	$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
	
	$result = mysqli_query($con, $sql);
	$check = mysqli_fetch_array($result);
	
	if(isset($check))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

?>