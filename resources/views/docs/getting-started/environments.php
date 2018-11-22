<?php use App\Library\Framework\Component\Code; ?>

<article>

	<h2>Environment Configuration</h2>

	<p>It is often helpful to have different configuration values based on the environment where the application is
		running. For example, you may wish to use a different cache driver locally than you do on your production
		server.</p>

	<p>To make this a cinch, Space MVC utilizes the <a href="https://github.com/vlucas/phpdotenv">DotEnv</a> PHP library
		by Vance Lucas. In a fresh Space MVC installation, the root directory of your application will
        contain a .env .example file. If you install Space MVC via Composer, this
		file will automatically be renamed to .env. Otherwise, you should rename the file manually.
    </p>

	<p>Your .env file should not be committed to your application's source control, since each developer / server
        using your application could require a
		different environment configuration. Furthermore, this would be a security risk in the event an intruder gains
		access to your source control repository, since any sensitive credentials would get exposed.
    </p>

	<p>If you are developing with a team, you may wish to continue including a .env.example file
		with your application. By putting place-holder values in the example configuration file, other developers on
		your team can clearly see which environment variables are needed to run your application. You may also create a
		.env.testing
		file. This file will override the env
		file when running PHPUnit tests or executing Artisan commands with the --env=testing option.
    </p>

    <p>
		Any variable in your .env file can be overridden by external environment variables such as server-level or system-level environment variables.
        </p>
	
    <p><a name="environment-variable-types"></a></p>

    <h3>Environment Variable Types</h3>

    <p>All variables in your .env files are parsed as strings, so some reserved values have been created
        to allow you to return a wider range of types from the env()
		function:
    </p>

    <table class="table table-striped">
		<thead>
		<tr>
			<th>
               .env Value
            </th>
			<th>env()
				Value
			</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td>true</td>
			<td>(bool) true</td>
		</tr>
		<tr>
			<td>(true)</td>
			<td>(bool) true</td>
		</tr>
		<tr>
			<td>false</td>
			<td>(bool) false</td>
		</tr>
		<tr>
			<td>(false)</td>
			<td>(bool) false</td>
		</tr>
		<tr>
			<td>empty</td>
			<td>(string) ''</td>
		</tr>
		<tr>
			<td>(empty)</td>
			<td>(string) ''</td>
		</tr>
		<tr>
			<td>null</td>
			<td>(null) null</td>
		</tr>
		<tr>
			<td>(null)</td>
			<td>(null) null</td>
		</tr>
		</tbody>
	</table>

    <p>If you need to define an environment variable with a value that contains spaces, you may do so by enclosing the
		value in double quotes.</p>
	<?php echo Code::getHtmlStatic('APP_NAME="My Application"'); ?>
	<p><a name="retrieving-environment-configuration"></a></p>
	<h3>Retrieving Environment Configuration</h3>
	<p>All of the variables listed in this file will be loaded into the $_ENV PHP super-global when your application receives a request.
		However, you may use the env helper to retrieve values from these variables
		in your configuration files. In fact, if you review the Space MVC configuration files, you will notice several of
		the options already using this helper:</p>
	<?php echo Code::getHtmlStatic('\'debug\' =&gt; env(\'APP_DEBUG\', false),'); ?>
	<p>The second value passed to the env function is the "default value". This value
		will be used if no environment variable exists for the given key.</p>
	<p><a name="determining-the-current-environment"></a></p>
	<h3>Determining The Current Environment</h3>
	<p>The current application environment is determined via the APP_ENV variable from your .env file. You may access this value via the environment method on the App <a
			href="/docs/5.7/facades">facade</a>:</p>
	<?php echo Code::getHtmlStatic('$environment = App::environment();'); ?>
	<p>You may also pass arguments to the environment method to check if the
		environment matches a given value. The method will return true if the environment matches any of the given values:</p>
	<?php echo Code::getHtmlStatic('if (App::environment(\'local\')) {
 // The environment is local
}

if (App::environment([\'local\', \'staging\'])) {
 // The environment is either local OR staging...
}'); ?>
	<p>
		The current application environment detection can be overridden by a server-level APP_ENV environment variable. This can
		be useful when you need to share the same application for different environment configurations, so you can set
		up a given host to match a given environment in your server's configurations.</p>
	<p><a name="hiding-environment-variables-from-debug"></a></p>


</article>