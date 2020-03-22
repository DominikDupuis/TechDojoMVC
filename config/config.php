<?php	
	interface Config
	{	
		const URL = "localhost/calendrier";
		const DB_HOST = "localhost";
		const DB_USER = "root";
		const DB_PWD = "1234";
		const DB_NAME = "utilisateurs";
	}
?>	

<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '1234');
define('DB_NAME', 'utilisateurs');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
	die("ERREUR. CONNECTION ÉCHOUÉ " . mysqli_connect_error());
}
?>