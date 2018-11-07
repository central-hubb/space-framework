<?php

/**
 * Class CreateUsersTable
 *
 */
class CreateUsersTable
{
	/**
	 * up.
	 *
	 * @return string
	 */
	public function up()
	{
		$sql = '';
		$sql .= 'CREATE TABLE users'.'(';
		$sql .= 'id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,';
		$sql .= 'first_name VARCHAR(30) NOT NULL,';
		$sql .= 'last_name VARCHAR(30) NOT NULL,';
		$sql .= 'email VARCHAR(50),';
		$sql .= 'password VARCHAR(50),';
		$sql .= 'created_at TIMESTAMP,';
		$sql .= 'updated_at TIMESTAMP';
		$sql .= ');';
		return $sql;
	}

	/**
	 * down.
	 *
	 * @return string
	 */
	public function down()
	{
		return 'drop table users';
	}
}
