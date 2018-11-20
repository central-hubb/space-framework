<?php

/**
 * Class CreateCodeContributorsTable
 *
 */
class CreateCodeContributorsTable
{
	/**
	 * up.
	 *
	 * @return string
	 */
	public function up()
	{
		$sql = '';
		$sql .= 'CREATE TABLE system_code_contributors'.'(';
		$sql .= 'id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,';
		$sql .= 'email VARCHAR(255) NOT NULL,';
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
		return 'drop table system_code_contributors';
	}
}
