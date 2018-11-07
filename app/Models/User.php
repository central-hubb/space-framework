<?php

namespace App\Models;

use App\Library\Framework\Base\Model;

/**
 * Class User
 *
 * @package App\Models
 */
class User extends Model
{
// explicit table name since our table is not "books"
	static $table_name = 'users';
	static $primary_key = 'id';
	static $connection = 'default';
	static $db = 'space_mvc';
}