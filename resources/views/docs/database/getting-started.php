<article>
	<h1>Database: Getting Started</h1>
    <p>This guide will show you the bare essentials to get up and running with php active record orm.</p>
    <p>The first steps are to include the orm library class and define our database connection.</p>
    <p>This class is automatically loaded by the space framework inside app/Library/Framework/Space.php</p>
    <p>All you need to do is set your database settings in the .env file.</p>


    <?php $code = "<?php

namespace App\Library\Framework;

/**
 * Class Orm
 *
 * @package App\Library\Framework
 */
class Orm
{
	/** @var array \$db */
	protected \$db = [
		'default' => [
			'hostname' => null,
			'username' => null,
			'password' => null,
			'database' => null,
		]
	];

	/**
	 * Orm constructor.
	 */
	public function __construct()
	{
		\$this->db = [
			'default' => [
				'hostname' => env('DB_HOSTNAME', 'localhost'),
				'username' => env('DB_USERNAME', 'root'),
				'password' => env('DB_PASSWORD', 'root'),
				'database' => env('DB_DATABASE', 'space_mvc'),
			]
		];
		
		\$connections = array(
			'default' => 'mysql://'.\$this->db['default']['username'].':'.\$this->db['default']['password'].'@'.\$this->db['default']['hostname'].'/'.\$this->db['default']['database']
		);

		\ActiveRecord\Config::initialize(function(\$cfg) use (\$connections)
		{
			\$cfg->set_model_directory(__DIR__.'/../../../app/Models');
			\$cfg->set_connections(\$connections);
			\$cfg->set_default_connection('default');
		});
	}
}

"; ?>


    <pre class="language-php"><code class="language-php"><?php echo htmlentities($code); ?></code></pre>

    <p>Next, lets create a model for a table called users. We'll save this class in the file models/User.php</p>


    <?php $code = "<?php

namespace App\Models;

use App\Library\Framework\Base\Model;

/**
 * Class User
 *
 * @package App\Models
 */
class User extends  Model
{
	/** @var string \$table_name */
	static \$table_name = 'users';
}"; ?>


    <pre class="language-php"><code class="language-php"><?php echo htmlentities($code); ?></code></pre>


    <p>Now you can access the users table thru the User model.</p>


	<?php
    $code = "# create Tito
\$user = User::create(array('name' => 'Tito', 'state' => 'VA'));
 
# read Tito
\$user = User::find_by_name('Tito');
 
# update Tito
\$user->name = 'Tito Jr';
\$user->save();

# delete Tito
\$user->delete();"; ?>


    <pre class="language-php"><code class="language-php"><?php echo htmlentities($code); ?></code></pre>

    <p>That's it! Pretty simple. Check out the other database pages for more in depth guides on using the php active record orm more.</p>

</article>