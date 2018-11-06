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

    <blockquote class="has-icon">
		<p class="tip">
		Any variable in your .env file can be overridden by external environment variables such as server-level or system-level environment variables.
        </p>
	</blockquote>

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

    <?php  /*
	<p>If you need to define an environment variable with a value that contains spaces, you may do so by enclosing the
		value in double quotes.</p>
	<pre class=" language-php"><code class=" language-php"><span class="token constant">APP_NAME</span><span
				class="token operator">=</span><span class="token string">"My Application"</span></code></pre>
	<p><a name="retrieving-environment-configuration"></a></p>
	<h3>Retrieving Environment Configuration</h3>
	<p>All of the variables listed in this file will be loaded into the <code class=" language-php"><span
				class="token global">$_ENV</span></code> PHP super-global when your application receives a request.
		However, you may use the <code class=" language-php">env</code> helper to retrieve values from these variables
		in your configuration files. In fact, if you review the Space MVC configuration files, you will notice several of
		the options already using this helper:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'debug'</span> <span
				class="token operator">=</span><span class="token operator">&gt;</span> <span
				class="token function">env<span class="token punctuation">(</span></span><span class="token string">'APP_DEBUG'</span><span
				class="token punctuation">,</span> <span class="token boolean">false</span><span
				class="token punctuation">)</span><span class="token punctuation">,</span></code></pre>
	<p>The second value passed to the <code class=" language-php">env</code> function is the "default value". This value
		will be used if no environment variable exists for the given key.</p>
	<p><a name="determining-the-current-environment"></a></p>
	<h3>Determining The Current Environment</h3>
	<p>The current application environment is determined via the <code class=" language-php"><span
				class="token constant">APP_ENV</span></code> variable from your <code class=" language-php"><span
				class="token punctuation">.</span>env</code> file. You may access this value via the <code
			class=" language-php">environment</code> method on the <code class=" language-php">App</code> <a
			href="/docs/5.7/facades">facade</a>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$environment</span> <span
				class="token operator">=</span> <span class="token scope">App<span
					class="token punctuation">::</span></span><span class="token function">environment<span
					class="token punctuation">(</span></span><span class="token punctuation">)</span><span
				class="token punctuation">;</span></code></pre>
	<p>You may also pass arguments to the <code class=" language-php">environment</code> method to check if the
		environment matches a given value. The method will return <code class=" language-php"><span
				class="token boolean">true</span></code> if the environment matches any of the given values:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">if</span> <span
				class="token punctuation">(</span><span class="token scope">App<span
					class="token punctuation">::</span></span><span class="token function">environment<span
					class="token punctuation">(</span></span><span class="token string">'local'</span><span
				class="token punctuation">)</span><span class="token punctuation">)</span> <span
				class="token punctuation">{</span>
<span class="token comment" spellcheck="true"> // The environment is local
</span><span class="token punctuation">}</span>

<span class="token keyword">if</span> <span class="token punctuation">(</span><span class="token scope">App<span
					class="token punctuation">::</span></span><span class="token function">environment<span
					class="token punctuation">(</span></span><span class="token punctuation">[</span><span
				class="token string">'local'</span><span class="token punctuation">,</span> <span
				class="token string">'staging'</span><span class="token punctuation">]</span><span
				class="token punctuation">)</span><span class="token punctuation">)</span> <span
				class="token punctuation">{</span>
<span class="token comment" spellcheck="true"> // The environment is either local OR staging...
</span><span class="token punctuation">}</span></code></pre>
	<blockquote class="has-icon">
		<p class="tip">
		<div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg"
		                                         xmlns:xlink="http://www.w3.org/1999/xlink"
		                                         xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
		                                         version="1.1" x="0px" y="0px" width="56.6px" height="87.5px"
		                                         viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5"
		                                         xml:space="preserve"><path fill="#FFFFFF"
		                                                                    d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span>
		</div>
		The current application environment detection can be overridden by a server-level <code
			class=" language-php"><span class="token constant">APP_ENV</span></code> environment variable. This can
		be useful when you need to share the same application for different environment configurations, so you can set
		up a given host to match a given environment in your server's configurations.</p>
	</blockquote>
	<p><a name="hiding-environment-variables-from-debug"></a></p>*/  ?>


</article>
