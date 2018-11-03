<article>
	<h1>HTTP Session</h1>
	<ul>
		<li><a href="#introduction">Introduction</a>
			<ul>
				<li><a href="#configuration">Configuration</a></li>
				<li><a href="#driver-prerequisites">Driver Prerequisites</a></li>
			</ul></li>
		<li><a href="#using-the-session">Using The Session</a>
			<ul>
				<li><a href="#retrieving-data">Retrieving Data</a></li>
				<li><a href="#storing-data">Storing Data</a></li>
				<li><a href="#flash-data">Flash Data</a></li>
				<li><a href="#deleting-data">Deleting Data</a></li>
				<li><a href="#regenerating-the-session-id">Regenerating The Session ID</a></li>
			</ul></li>
		<li><a href="#adding-custom-session-drivers">Adding Custom Session Drivers</a>
			<ul>
				<li><a href="#implementing-the-driver">Implementing The Driver</a></li>
				<li><a href="#registering-the-driver">Registering The Driver</a></li>
			</ul></li>
	</ul>
	<p><a name="introduction"></a></p>
	<h2><a href="#introduction">Introduction</a></h2>
	<p>Since HTTP driven applications are stateless, sessions provide a way to store information about the user across multiple requests. Laravel ships with a variety of session backends that are accessed through an expressive, unified API. Support for popular backends such as <a href="https://memcached.org">Memcached</a>, <a href="https://redis.io">Redis</a>, and databases is included out of the box.</p>
	<p><a name="configuration"></a></p>
	<h3>Configuration</h3>
	<p>The session configuration file is stored at <code class=" language-php">config<span class="token operator">/</span>session<span class="token punctuation">.</span>php</code>. Be sure to review the options available to you in this file. By default, Laravel is configured to use the <code class=" language-php">file</code> session driver, which will work well for many applications. In production applications, you may consider using the <code class=" language-php">memcached</code> or <code class=" language-php">redis</code> drivers for even faster session performance.</p>
	<p>The session <code class=" language-php">driver</code> configuration option defines where session data will be stored for each request. Laravel ships with several great drivers out of the box:</p>
	<div class="content-list">
		<ul>
			<li><code class=" language-php">file</code> - sessions are stored in <code class=" language-php">storage<span class="token operator">/</span>framework<span class="token operator">/</span>sessions</code>.</li>
			<li><code class=" language-php">cookie</code> - sessions are stored in secure, encrypted cookies.</li>
			<li><code class=" language-php">database</code> - sessions are stored in a relational database.</li>
			<li><code class=" language-php">memcached</code> / <code class=" language-php">redis</code> - sessions are stored in one of these fast, cache based stores.</li>
			<li><code class=" language-php"><span class="token keyword">array</span></code> - sessions are stored in a PHP array and will not be persisted.</li>
		</ul>
	</div>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> The array driver is used during <a href="/docs/5.7/testing">testing</a> and prevents the data stored in the session from being persisted.</p>
	</blockquote>
	<p><a name="driver-prerequisites"></a></p>
	<h3>Driver Prerequisites</h3>
	<h4>Database</h4>
	<p>When using the <code class=" language-php">database</code> session driver, you will need to create a table to contain the session items. Below is an example <code class=" language-php">Schema</code> declaration for the table:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">create<span class="token punctuation">(</span></span><span class="token string">'sessions'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$table</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">string<span class="token punctuation">(</span></span><span class="token string">'id'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">unique<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">unsignedInteger<span class="token punctuation">(</span></span><span class="token string">'user_id'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">nullable<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">string<span class="token punctuation">(</span></span><span class="token string">'ip_address'</span><span class="token punctuation">,</span> <span class="token number">45</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">nullable<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">text<span class="token punctuation">(</span></span><span class="token string">'user_agent'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">nullable<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">text<span class="token punctuation">(</span></span><span class="token string">'payload'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">integer<span class="token punctuation">(</span></span><span class="token string">'last_activity'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>You may use the <code class=" language-php">session<span class="token punctuation">:</span>table</code> Artisan command to generate this migration:</p>
	<pre class=" language-php"><code class=" language-php">php artisan session<span class="token punctuation">:</span>table

php artisan migrate</code></pre>
	<h4>Redis</h4>
	<p>Before using Redis sessions with Laravel, you will need to install the <code class=" language-php">predis<span class="token operator">/</span>predis</code> package (~1.0) via Composer. You may configure your Redis connections in the <code class=" language-php">database</code> configuration file. In the <code class=" language-php">session</code> configuration file, the <code class=" language-php">connection</code> option may be used to specify which Redis connection is used by the session.</p>
	<p><a name="using-the-session"></a></p>
	<h2><a href="#using-the-session">Using The Session</a></h2>
	<p><a name="retrieving-data"></a></p>
	<h3>Retrieving Data</h3>
	<p>There are two primary ways of working with session data in Laravel: the global <code class=" language-php">session</code> helper and via a <code class=" language-php">Request</code> instance. First, let's look at accessing the session via a <code class=" language-php">Request</code> instance, which can be type-hinted on a controller method. Remember, controller method dependencies are automatically injected via the Laravel <a href="/docs/5.7/container">service container</a>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Controllers</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Request</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Controllers<span class="token punctuation">\</span>Controller</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">UserController</span> <span class="token keyword">extends</span> <span class="token class-name">Controller</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Show the profile for the given user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">show<span class="token punctuation">(</span></span>Request <span class="token variable">$request</span><span class="token punctuation">,</span> <span class="token variable">$id</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token variable">$value</span> <span class="token operator">=</span> <span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">session<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'key'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

       <span class="token comment" spellcheck="true"> //
</span>    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p>When you retrieve an item from the session, you may also pass a default value as the second argument to the <code class=" language-php">get</code> method. This default value will be returned if the specified key does not exist in the session. If you pass a <code class=" language-php">Closure</code> as the default value to the <code class=" language-php">get</code> method and the requested key does not exist, the <code class=" language-php">Closure</code> will be executed and its result returned:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$value</span> <span class="token operator">=</span> <span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">session<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'key'</span><span class="token punctuation">,</span> <span class="token string">'default'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$value</span> <span class="token operator">=</span> <span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">session<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'key'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token string">'default'</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>The Global Session Helper</h4>
	<p>You may also use the global <code class=" language-php">session</code> PHP function to retrieve and store data in the session. When the <code class=" language-php">session</code> helper is called with a single, string argument, it will return the value of that session key. When the helper is called with an array of key / value pairs, those values will be stored in the session:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Route<span class="token punctuation">::</span></span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'home'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> // Retrieve a piece of data from the session...
</span>    <span class="token variable">$value</span> <span class="token operator">=</span> <span class="token function">session<span class="token punctuation">(</span></span><span class="token string">'key'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

   <span class="token comment" spellcheck="true"> // Specifying a default value...
</span>    <span class="token variable">$value</span> <span class="token operator">=</span> <span class="token function">session<span class="token punctuation">(</span></span><span class="token string">'key'</span><span class="token punctuation">,</span> <span class="token string">'default'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

   <span class="token comment" spellcheck="true"> // Store a piece of data in the session...
</span>    <span class="token function">session<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'key'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'value'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> There is little practical difference between using the session via an HTTP request instance versus using the global <code class=" language-php">session</code> helper. Both methods are <a href="/docs/5.7/testing">testable</a> via the <code class=" language-php">assertSessionHas</code> method which is available in all of your test cases.</p>
	</blockquote>
	<h4>Retrieving All Session Data</h4>
	<p>If you would like to retrieve all the data in the session, you may use the <code class=" language-php">all</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$data</span> <span class="token operator">=</span> <span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">session<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">all<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Determining If An Item Exists In The Session</h4>
	<p>To determine if an item is present in the session, you may use the <code class=" language-php">has</code> method. The <code class=" language-php">has</code> method returns <code class=" language-php"><span class="token boolean">true</span></code> if the item is present and is not <code class=" language-php"><span class="token keyword">null</span></code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">if</span> <span class="token punctuation">(</span><span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">session<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">has<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span></code></pre>
	<p>To determine if an item is present in the session, even if its value is <code class=" language-php"><span class="token keyword">null</span></code>, you may use the <code class=" language-php">exists</code> method. The <code class=" language-php">exists</code> method returns <code class=" language-php"><span class="token boolean">true</span></code> if the item is present:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">if</span> <span class="token punctuation">(</span><span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">session<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">exists<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span></code></pre>
	<p><a name="storing-data"></a></p>
	<h3>Storing Data</h3>
	<p>To store data in the session, you will typically use the <code class=" language-php">put</code> method or the <code class=" language-php">session</code> helper:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">// Via a request instance...
</span><span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">session<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">put<span class="token punctuation">(</span></span><span class="token string">'key'</span><span class="token punctuation">,</span> <span class="token string">'value'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// Via the global helper...
</span><span class="token function">session<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'key'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'value'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Pushing To Array Session Values</h4>
	<p>The <code class=" language-php">push</code> method may be used to push a new value onto a session value that is an array. For example, if the <code class=" language-php">user<span class="token punctuation">.</span>teams</code> key contains an array of team names, you may push a new value onto the array like so:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">session<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">push<span class="token punctuation">(</span></span><span class="token string">'user.teams'</span><span class="token punctuation">,</span> <span class="token string">'developers'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Retrieving &amp; Deleting An Item</h4>
	<p>The <code class=" language-php">pull</code> method will retrieve and delete an item from the session in a single statement:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$value</span> <span class="token operator">=</span> <span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">session<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">pull<span class="token punctuation">(</span></span><span class="token string">'key'</span><span class="token punctuation">,</span> <span class="token string">'default'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="flash-data"></a></p>
	<h3>Flash Data</h3>
	<p>Sometimes you may wish to store items in the session only for the next request. You may do so using the <code class=" language-php">flash</code> method. Data stored in the session using this method will only be available during the subsequent HTTP request, and then will be deleted. Flash data is primarily useful for short-lived status messages:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">session<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">flash<span class="token punctuation">(</span></span><span class="token string">'status'</span><span class="token punctuation">,</span> <span class="token string">'Task was successful!'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>If you need to keep your flash data around for several requests, you may use the <code class=" language-php">reflash</code> method, which will keep all of the flash data for an additional request. If you only need to keep specific flash data, you may use the <code class=" language-php">keep</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">session<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">reflash<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">session<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">keep<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'username'</span><span class="token punctuation">,</span> <span class="token string">'email'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="deleting-data"></a></p>
	<h3>Deleting Data</h3>
	<p>The <code class=" language-php">forget</code> method will remove a piece of data from the session. If you would like to remove all data from the session, you may use the <code class=" language-php">flush</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">session<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">forget<span class="token punctuation">(</span></span><span class="token string">'key'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">session<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">flush<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="regenerating-the-session-id"></a></p>
	<h3>Regenerating The Session ID</h3>
	<p>Regenerating the session ID is often done in order to prevent malicious users from exploiting a <a href="https://en.wikipedia.org/wiki/Session_fixation">session fixation</a> attack on your application.</p>
	<p>Laravel automatically regenerates the session ID during authentication if you are using the built-in <code class=" language-php">LoginController</code>; however, if you need to manually regenerate the session ID, you may use the <code class=" language-php">regenerate</code> method.</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">session<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">regenerate<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="adding-custom-session-drivers"></a></p>
	<h2><a href="#adding-custom-session-drivers">Adding Custom Session Drivers</a></h2>
	<p><a name="implementing-the-driver"></a></p>
	<h4>Implementing The Driver</h4>
	<p>Your custom session driver should implement the <code class=" language-php">SessionHandlerInterface</code>. This interface contains just a few simple methods we need to implement. A stubbed MongoDB implementation looks something like this:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Extensions</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">MongoSessionHandler</span> <span class="token keyword">implements</span> <span class="token class-name"><span class="token punctuation">\</span>SessionHandlerInterface</span>
<span class="token punctuation">{</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">open<span class="token punctuation">(</span></span><span class="token variable">$savePath</span><span class="token punctuation">,</span> <span class="token variable">$sessionName</span><span class="token punctuation">)</span> <span class="token punctuation">{</span><span class="token punctuation">}</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">close<span class="token punctuation">(</span></span><span class="token punctuation">)</span> <span class="token punctuation">{</span><span class="token punctuation">}</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">read<span class="token punctuation">(</span></span><span class="token variable">$sessionId</span><span class="token punctuation">)</span> <span class="token punctuation">{</span><span class="token punctuation">}</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">write<span class="token punctuation">(</span></span><span class="token variable">$sessionId</span><span class="token punctuation">,</span> <span class="token variable">$data</span><span class="token punctuation">)</span> <span class="token punctuation">{</span><span class="token punctuation">}</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">destroy<span class="token punctuation">(</span></span><span class="token variable">$sessionId</span><span class="token punctuation">)</span> <span class="token punctuation">{</span><span class="token punctuation">}</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">gc<span class="token punctuation">(</span></span><span class="token variable">$lifetime</span><span class="token punctuation">)</span> <span class="token punctuation">{</span><span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> Laravel does not ship with a directory to contain your extensions. You are free to place them anywhere you like. In this example, we have created an <code class=" language-php">Extensions</code> directory to house the <code class=" language-php">MongoSessionHandler</code>.</p>
	</blockquote>
	<p>Since the purpose of these methods is not readily understandable, let's quickly cover what each of the methods do:</p>
	<div class="content-list">
		<ul>
			<li>The <code class=" language-php">open</code> method would typically be used in file based session store systems. Since Laravel ships with a <code class=" language-php">file</code> session driver, you will almost never need to put anything in this method. You can leave it as an empty stub. It is a fact of poor interface design (which we'll discuss later) that PHP requires us to implement this method.</li>
			<li>The <code class=" language-php">close</code> method, like the <code class=" language-php">open</code> method, can also usually be disregarded. For most drivers, it is not needed.</li>
			<li>The <code class=" language-php">read</code> method should return the string version of the session data associated with the given <code class=" language-php"><span class="token variable">$sessionId</span></code>. There is no need to do any serialization or other encoding when retrieving or storing session data in your driver, as Laravel will perform the serialization for you.</li>
			<li>The <code class=" language-php">write</code> method should write the given <code class=" language-php"><span class="token variable">$data</span></code> string associated with the <code class=" language-php"><span class="token variable">$sessionId</span></code> to some persistent storage system, such as MongoDB, Dynamo, etc.  Again, you should not perform any serialization - Laravel will have already handled that for you.</li>
			<li>The <code class=" language-php">destroy</code> method should remove the data associated with the <code class=" language-php"><span class="token variable">$sessionId</span></code> from persistent storage.</li>
			<li>The <code class=" language-php">gc</code> method should destroy all session data that is older than the given <code class=" language-php"><span class="token variable">$lifetime</span></code>, which is a UNIX timestamp. For self-expiring systems like Memcached and Redis, this method may be left empty.</li>
		</ul>
	</div>
	<p><a name="registering-the-driver"></a></p>
	<h4>Registering The Driver</h4>
	<p>Once your driver has been implemented, you are ready to register it with the framework. To add additional drivers to Laravel's session backend, you may use the <code class=" language-php">extend</code> method on the <code class=" language-php">Session</code> <a href="/docs/5.7/facades">facade</a>. You should call the <code class=" language-php">extend</code> method from the <code class=" language-php">boot</code> method of a <a href="/docs/5.7/providers">service provider</a>. You may do this from the existing <code class=" language-php">AppServiceProvider</code> or create an entirely new provider:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Providers</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Extensions<span class="token punctuation">\</span>MongoSessionHandler</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>Session</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>ServiceProvider</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">SessionServiceProvider</span> <span class="token keyword">extends</span> <span class="token class-name">ServiceProvider</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Perform post-registration booting of services.
     *
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">boot<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token scope">Session<span class="token punctuation">::</span></span><span class="token function">extend<span class="token punctuation">(</span></span><span class="token string">'mongo'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$app</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
           <span class="token comment" spellcheck="true"> // Return implementation of SessionHandlerInterface...
</span>            <span class="token keyword">return</span> <span class="token keyword">new</span> <span class="token class-name">MongoSessionHandler</span><span class="token punctuation">;</span>
        <span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>

    <span class="token comment" spellcheck="true">/**
     * Register bindings in the container.
     *
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">register<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
       <span class="token comment" spellcheck="true"> //
</span>    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p>Once the session driver has been registered, you may use the <code class=" language-php">mongo</code> driver in your <code class=" language-php">config<span class="token operator">/</span>session<span class="token punctuation">.</span>php</code> configuration file.</p>
</article>