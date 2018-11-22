<?php use App\Library\Framework\Component\Code; ?>

<article>
	<h1>HTTP Session</h1>
	<h4>Introduction</h4>
	<p>Since HTTP driven applications are stateless, sessions provide a way to store information about the user across multiple requests. Space MVC ships with a variety of session backends that are accessed through an expressive, unified API. Support for popular backends such as <a href="https://memcached.org">Memcached</a>, <a href="https://redis.io">Redis</a>, and databases is included out of the box.</p>
	<p><a name="configuration"></a></p>
	<h3>Configuration</h3>
	<p>The session configuration file is stored at config/session.php. Be sure to review the options available to you in this file. By default, Space MVC is configured to use the file session driver, which will work well for many applications. In production applications, you may consider using the memcached or redis drivers for even faster session performance.</p>
	<p>The session driver configuration option defines where session data will be stored for each request. Space MVC ships with several great drivers out of the box:</p>
	<div class="content-list">
		<ul>
			<li>file - sessions are stored in storage/framework/sessions.</li>
			<li>cookie - sessions are stored in secure, encrypted cookies.</li>
			<li>database - sessions are stored in a relational database.</li>
			<li>memcached / redis - sessions are stored in one of these fast, cache based stores.</li>
			<li>array - sessions are stored in a PHP array and will not be persisted.</li>
		</ul>
	</div>
	<p>The array driver is used during <a href="/docs/5.7/testing">testing</a> and prevents the data stored in the session from being persisted.</p>
	<p><a name="driver-prerequisites"></a></p>
	<h3>Driver Prerequisites</h3>
	<h4>Database</h4>
	<p>When using the database session driver, you will need to create a table to contain the session items. Below is an example Schema declaration for the table:</p>
	<?php echo Code::getHtmlStatic('Schema::create(\'sessions\', function ($table) {
    $table-&gt;string(\'id\')-&gt;unique();
    $table-&gt;unsignedInteger(\'user_id\')-&gt;nullable();
    $table-&gt;string(\'ip_address\', 45)-&gt;nullable();
    $table-&gt;text(\'user_agent\')-&gt;nullable();
    $table-&gt;text(\'payload\');
    $table-&gt;integer(\'last_activity\');
});'); ?>
	<p>You may use the session:table Artisan command to generate this migration:</p>
	<?php echo Code::getHtmlStatic('php artisan session:table

php artisan migrate'); ?>
	<h4>Redis</h4>
	<p>Before using Redis sessions with Space MVC, you will need to install the predis/predis package (~1.0) via Composer. You may configure your Redis connections in the database configuration file. In the session configuration file, the connection option may be used to specify which Redis connection is used by the session.</p>
	<p><a name="using-the-session"></a></p>
	<h2><a href="#using-the-session">Using The Session</a></h2>
	<p><a name="retrieving-data"></a></p>
	<h3>Retrieving Data</h3>
	<p>There are two primary ways of working with session data in Space MVC: the global session helper and via a Request instance. First, let's look at accessing the session via a Request instance, which can be type-hinted on a controller method. Remember, controller method dependencies are automatically injected via the Space MVC <a href="/docs/5.7/container">service container</a>:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $value = $request-&gt;session()-&gt;get(\'key\');

        //
    }
}'); ?>
	<p>When you retrieve an item from the session, you may also pass a default value as the second argument to the get method. This default value will be returned if the specified key does not exist in the session. If you pass a Closure as the default value to the get method and the requested key does not exist, the Closure will be executed and its result returned:</p>
	<?php echo Code::getHtmlStatic('$value = $request-&gt;session()-&gt;get(\'key\', \'default\');

$value = $request-&gt;session()-&gt;get(\'key\', function () {
    return \'default\';
});'); ?>
	<h4>The Global Session Helper</h4>
	<p>You may also use the global session PHP function to retrieve and store data in the session. When the session helper is called with a single, string argument, it will return the value of that session key. When the helper is called with an array of key / value pairs, those values will be stored in the session:</p>
	<?php echo Code::getHtmlStatic('Route::get(\'home\', function () {
    // Retrieve a piece of data from the session...
    $value = session(\'key\');

    // Specifying a default value...
    $value = session(\'key\', \'default\');

    // Store a piece of data in the session...
    session([\'key\' =&gt; \'value\']);
});'); ?>
	<p>There is little practical difference between using the session via an HTTP request instance versus using the global session helper. Both methods are <a href="/docs/5.7/testing">testable</a> via the assertSessionHas method which is available in all of your test cases.</p>
	<h4>Retrieving All Session Data</h4>
	<p>If you would like to retrieve all the data in the session, you may use the all method:</p>
	<?php echo Code::getHtmlStatic('$data = $request-&gt;session()-&gt;all();'); ?>
	<h4>Determining If An Item Exists In The Session</h4>
	<p>To determine if an item is present in the session, you may use the has method. The has method returns true if the item is present and is not null:</p>
	<?php echo Code::getHtmlStatic('if ($request-&gt;session()-&gt;has(\'users\')) {
    //
}'); ?>
	<p>To determine if an item is present in the session, even if its value is null, you may use the exists method. The exists method returns true if the item is present:</p>
	<?php echo Code::getHtmlStatic('if ($request-&gt;session()-&gt;exists(\'users\')) {
    //
}'); ?>
	<p><a name="storing-data"></a></p>
	<h3>Storing Data</h3>
	<p>To store data in the session, you will typically use the put method or the session helper:</p>
	<?php echo Code::getHtmlStatic('// Via a request instance...
$request-&gt;session()-&gt;put(\'key\', \'value\');

// Via the global helper...
session([\'key\' =&gt; \'value\']);'); ?>
	<h4>Pushing To Array Session Values</h4>
	<p>The push method may be used to push a new value onto a session value that is an array. For example, if the user.teams key contains an array of team names, you may push a new value onto the array like so:</p>
	<?php echo Code::getHtmlStatic('$request-&gt;session()-&gt;push(\'user.teams\', \'developers\');'); ?>
	<h4>Retrieving &amp; Deleting An Item</h4>
	<p>The pull method will retrieve and delete an item from the session in a single statement:</p>
	<?php echo Code::getHtmlStatic('$value = $request-&gt;session()-&gt;pull(\'key\', \'default\');'); ?>
	<p><a name="flash-data"></a></p>
	<h3>Flash Data</h3>
	<p>Sometimes you may wish to store items in the session only for the next request. You may do so using the flash method. Data stored in the session using this method will only be available during the subsequent HTTP request, and then will be deleted. Flash data is primarily useful for short-lived status messages:</p>
	<?php echo Code::getHtmlStatic('$request-&gt;session()-&gt;flash(\'status\', \'Task was successful!\');'); ?>
	<p>If you need to keep your flash data around for several requests, you may use the reflash method, which will keep all of the flash data for an additional request. If you only need to keep specific flash data, you may use the keep method:</p>
	<?php echo Code::getHtmlStatic('$request-&gt;session()-&gt;reflash();

$request-&gt;session()-&gt;keep([\'username\', \'email\']);'); ?>
	<p><a name="deleting-data"></a></p>
	<h3>Deleting Data</h3>
	<p>The forget method will remove a piece of data from the session. If you would like to remove all data from the session, you may use the flush method:</p>
	<?php echo Code::getHtmlStatic('$request-&gt;session()-&gt;forget(\'key\');

$request-&gt;session()-&gt;flush();'); ?>
	<p><a name="regenerating-the-session-id"></a></p>
	<h3>Regenerating The Session ID</h3>
	<p>Regenerating the session ID is often done in order to prevent malicious users from exploiting a <a href="https://en.wikipedia.org/wiki/Session_fixation">session fixation</a> attack on your application.</p>
	<p>Space MVC automatically regenerates the session ID during authentication if you are using the built-in LoginController; however, if you need to manually regenerate the session ID, you may use the regenerate method.</p>
	<?php echo Code::getHtmlStatic('$request-&gt;session()-&gt;regenerate();'); ?>
	<p><a name="adding-custom-session-drivers"></a></p>
	<h2><a href="#adding-custom-session-drivers">Adding Custom Session Drivers</a></h2>
	<p><a name="implementing-the-driver"></a></p>
	<h4>Implementing The Driver</h4>
	<p>Your custom session driver should implement the SessionHandlerInterface. This interface contains just a few simple methods we need to implement. A stubbed MongoDB implementation looks something like this:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Extensions;

class MongoSessionHandler implements \SessionHandlerInterface
{
    public function open($savePath, $sessionName) {}
    public function close() {}
    public function read($sessionId) {}
    public function write($sessionId, $data) {}
    public function destroy($sessionId) {}
    public function gc($lifetime) {}
}'); ?>
	<p>Space MVC does not ship with a directory to contain your extensions. You are free to place them anywhere you like. In this example, we have created an Extensions directory to house the MongoSessionHandler.</p>
	<p>Since the purpose of these methods is not readily understandable, let's quickly cover what each of the methods do:</p>
	<div class="content-list">
		<ul>
			<li>The open method would typically be used in file based session store systems. Since Space MVC ships with a file session driver, you will almost never need to put anything in this method. You can leave it as an empty stub. It is a fact of poor interface design (which we'll discuss later) that PHP requires us to implement this method.</li>
			<li>The close method, like the open method, can also usually be disregarded. For most drivers, it is not needed.</li>
			<li>The read method should return the string version of the session data associated with the given $sessionId. There is no need to do any serialization or other encoding when retrieving or storing session data in your driver, as Space MVC will perform the serialization for you.</li>
			<li>The write method should write the given $data string associated with the $sessionId to some persistent storage system, such as MongoDB, Dynamo, etc.  Again, you should not perform any serialization - Space MVC will have already handled that for you.</li>
			<li>The destroy method should remove the data associated with the $sessionId from persistent storage.</li>
			<li>The gc method should destroy all session data that is older than the given $lifetime, which is a UNIX timestamp. For self-expiring systems like Memcached and Redis, this method may be left empty.</li>
		</ul>
	</div>
	<p><a name="registering-the-driver"></a></p>
	<h4>Registering The Driver</h4>
	<p>Once your driver has been implemented, you are ready to register it with the framework. To add additional drivers to Space MVC's session backend, you may use the extend method on the Session <a href="/docs/5.7/facades">facade</a>. You should call the extend method from the boot method of a <a href="/docs/5.7/providers">service provider</a>. You may do this from the existing AppServiceProvider or create an entirely new provider:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Providers;

use App\Extensions\MongoSessionHandler;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class SessionServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Session::extend(\'mongo\', function ($app) {
            // Return implementation of SessionHandlerInterface...
            return new MongoSessionHandler;
        });
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}'); ?>
	<p>Once the session driver has been registered, you may use the mongo driver in your config/session.php configuration file.</p>
</article>