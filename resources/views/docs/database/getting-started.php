<?php use App\Library\Framework\Component\Code; ?>

<div class="wiki">

	<h1>Database : ORM</h1>

	<h3 id="Quick-Start">Getting Started</h3>

	<p>This guide will show you the bare essentials to get up and running with php-activerecord. I will assume you have downloaded the library into your include_path in a directory called php-activerecord.</p>

	<p>The first steps are to include the library and define our database connection:</p>


	<?php echo Code::getHtmlStatic('1 require_once \'php-activerecord/ActiveRecord.php\';
2
3 ActiveRecord\Config::initialize(function($cfg)
4 {
5     $cfg-&gt;set_model_directory(\'models\');
6     $cfg-&gt;set_connections(array(
7         \'development\' =&gt; \'mysql://username:password@localhost/database_name\'));
8 });
'); ?>

	<p>Next, lets create a model for a table called users. We\ll save this class in the file models/User.php</p>


	<?php echo Code::getHtmlStatic('1 class User extends ActiveRecord\Model
2 {
3 }
'); ?>

	<p>That's it! Now you can access the users table thru the User model.</p>


	<?php echo Code::getHtmlStatic(' 1 # create Tito
 2 $user = User::create(array(\'name\' =&gt; \'Tito\', \'state\' =&gt; \'VA\'));
 3
 4 # read Tito
 5 $user = User::find_by_name(\'Tito\');
 6
 7 # update Tito
 8 $user-&gt;name = \'Tito Jr\';
 9 $user-&gt;save();
10
11 # delete Tito
12 $user-&gt;delete();
'); ?>

	<p>That's it! Pretty simple.</p>
</div>