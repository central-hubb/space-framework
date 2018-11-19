<?php

/**
 * Class CreateSystemMailingListTable
 *
 */
class CreateSystemMailingListTable
{
	/**
	 * up.
	 *
	 * @return string
	 */
	public function up()
	{
		$sql = '';
		$sql .= 'CREATE TABLE system_mailing_list'.'(';
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
		return 'drop table system_mailing_list';
	}
}
