<?php
	//$conn = new SQLite3('db/db_member.sqlite3');
	$conn = new PDO('sqlite:db/db_member.sqlite3');
	
	$query = "CREATE TABLE IF NOT EXISTS member(mem_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username TEXT, password TEXT, firstname TEXT, lastname TEXT)";
	
	$conn->exec($query);
?>