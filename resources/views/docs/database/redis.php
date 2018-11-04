<article>
	<h1>Database: Redis</h1>
	<ul>
		<li><a href="#introduction">Introduction</a>
			<ul>
				<li><a href="#configuration">Configuration</a></li>
				<li><a href="#predis">Predis</a></li>
				<li><a href="#phpredis">PhpRedis</a></li>
			</ul></li>
		<li><a href="#interacting-with-redis">Interacting With Redis</a>
			<ul>
				<li><a href="#pipelining-commands">Pipelining Commands</a></li>
			</ul></li>
		<li><a href="#pubsub">Pub / Sub</a></li>
	</ul>
	<p><a name="introduction"></a></p>
	<h2><a href="#introduction">Introduction</a></h2>
	<p><a href="https://redis.io">Redis</a> is an open source, advanced key-value store. It is often referred to as a data structure server since keys can contain <a href="https://redis.io/topics/data-types#strings">strings</a>, <a href="https://redis.io/topics/data-types#hashes">hashes</a>, <a href="https://redis.io/topics/data-types#lists">lists</a>, <a href="https://redis.io/topics/data-types#sets">sets</a>, and <a href="https://redis.io/topics/data-types#sorted-sets">sorted sets</a>.</p>
	<p>Before using Redis with Space MVC, you will need to install the <code class=" language-php">predis<span class="token operator">/</span>predis</code> package via Composer:</p>
	<pre class=" language-php"><code class=" language-php">composer <span class="token keyword">require</span> predis<span class="token operator">/</span>predis</code></pre>
	<p>Alternatively, you may install the <a href="https://github.com/phpredis/phpredis">PhpRedis</a> PHP extension via PECL. The extension is more complex to install but may yield better performance for applications that make heavy use of Redis.</p>
	<p><a name="configuration"></a></p>
	<h3>Configuration</h3>
	<p>The Redis configuration for your application is located in the <code class=" language-php">config<span class="token operator">/</span>database<span class="token punctuation">.</span>php</code> configuration file. Within this file, you will see a <code class=" language-php">redis</code> array containing the Redis servers utilized by your application:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'redis'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>

    <span class="token string">'client'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'predis'</span><span class="token punctuation">,</span>

    <span class="token string">'default'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'host'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">env<span class="token punctuation">(</span></span><span class="token string">'REDIS_HOST'</span><span class="token punctuation">,</span> <span class="token string">'localhost'</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
        <span class="token string">'password'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">env<span class="token punctuation">(</span></span><span class="token string">'REDIS_PASSWORD'</span><span class="token punctuation">,</span> <span class="token keyword">null</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
        <span class="token string">'port'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">env<span class="token punctuation">(</span></span><span class="token string">'REDIS_PORT'</span><span class="token punctuation">,</span> <span class="token number">6379</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
        <span class="token string">'database'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">0</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>

<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<p>The default server configuration should suffice for development. However, you are free to modify this array based on your environment. Each Redis server defined in your configuration file is required to have a name, host, and port.</p>
	<h4>Configuring Clusters</h4>
	<p>If your application is utilizing a cluster of Redis servers, you should define these clusters within a <code class=" language-php">clusters</code> key of your Redis configuration:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'redis'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>

    <span class="token string">'client'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'predis'</span><span class="token punctuation">,</span>

    <span class="token string">'clusters'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'default'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
            <span class="token punctuation">[</span>
                <span class="token string">'host'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">env<span class="token punctuation">(</span></span><span class="token string">'REDIS_HOST'</span><span class="token punctuation">,</span> <span class="token string">'localhost'</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
                <span class="token string">'password'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">env<span class="token punctuation">(</span></span><span class="token string">'REDIS_PASSWORD'</span><span class="token punctuation">,</span> <span class="token keyword">null</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
                <span class="token string">'port'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">env<span class="token punctuation">(</span></span><span class="token string">'REDIS_PORT'</span><span class="token punctuation">,</span> <span class="token number">6379</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
                <span class="token string">'database'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">0</span><span class="token punctuation">,</span>
            <span class="token punctuation">]</span><span class="token punctuation">,</span>
        <span class="token punctuation">]</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>

<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<p>By default, clusters will perform client-side sharding across your nodes, allowing you to pool nodes and create a large amount of available RAM. However, note that client-side sharding does not handle failover; therefore, is primarily suited for cached data that is available from another primary data store. If you would like to use native Redis clustering, you should specify this in the <code class=" language-php">options</code> key of your Redis configuration:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'redis'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>

    <span class="token string">'client'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'predis'</span><span class="token punctuation">,</span>

    <span class="token string">'options'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'cluster'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'redis'</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>

    <span class="token string">'clusters'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
       <span class="token comment" spellcheck="true"> // ...
</span>    <span class="token punctuation">]</span><span class="token punctuation">,</span>

<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<p><a name="predis"></a></p>
	<h3>Predis</h3>
	<p>In addition to the default <code class=" language-php">host</code>, <code class=" language-php">port</code>, <code class=" language-php">database</code>, and <code class=" language-php">password</code> server configuration options, Predis supports additional <a href="https://github.com/nrk/predis/wiki/Connection-Parameters">connection parameters</a> that may be defined for each of your Redis servers. To utilize these additional configuration options, add them to your Redis server configuration in the <code class=" language-php">config<span class="token operator">/</span>database<span class="token punctuation">.</span>php</code> configuration file:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'default'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
    <span class="token string">'host'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">env<span class="token punctuation">(</span></span><span class="token string">'REDIS_HOST'</span><span class="token punctuation">,</span> <span class="token string">'localhost'</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
    <span class="token string">'password'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">env<span class="token punctuation">(</span></span><span class="token string">'REDIS_PASSWORD'</span><span class="token punctuation">,</span> <span class="token keyword">null</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
    <span class="token string">'port'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">env<span class="token punctuation">(</span></span><span class="token string">'REDIS_PORT'</span><span class="token punctuation">,</span> <span class="token number">6379</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
    <span class="token string">'database'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">0</span><span class="token punctuation">,</span>
    <span class="token string">'read_write_timeout'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">60</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<p><a name="phpredis"></a></p>
	<h3>PhpRedis</h3>
	<p>To utilize the PhpRedis extension, you should change the <code class=" language-php">client</code> option of your Redis configuration to <code class=" language-php">phpredis</code>. This option is found in your <code class=" language-php">config<span class="token operator">/</span>database<span class="token punctuation">.</span>php</code> configuration file:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'redis'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>

    <span class="token string">'client'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'phpredis'</span><span class="token punctuation">,</span>

   <span class="token comment" spellcheck="true"> // Rest of Redis configuration...
</span><span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<p>In addition to the default <code class=" language-php">host</code>, <code class=" language-php">port</code>, <code class=" language-php">database</code>, and <code class=" language-php">password</code> server configuration options, PhpRedis supports the following additional connection parameters: <code class=" language-php">persistent</code>, <code class=" language-php">prefix</code>, <code class=" language-php">read_timeout</code> and <code class=" language-php">timeout</code>. You may add any of these options to your Redis server configuration in the <code class=" language-php">config<span class="token operator">/</span>database<span class="token punctuation">.</span>php</code> configuration file:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'default'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
    <span class="token string">'host'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">env<span class="token punctuation">(</span></span><span class="token string">'REDIS_HOST'</span><span class="token punctuation">,</span> <span class="token string">'localhost'</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
    <span class="token string">'password'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">env<span class="token punctuation">(</span></span><span class="token string">'REDIS_PASSWORD'</span><span class="token punctuation">,</span> <span class="token keyword">null</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
    <span class="token string">'port'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">env<span class="token punctuation">(</span></span><span class="token string">'REDIS_PORT'</span><span class="token punctuation">,</span> <span class="token number">6379</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
    <span class="token string">'database'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">0</span><span class="token punctuation">,</span>
    <span class="token string">'read_timeout'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">60</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<p><a name="interacting-with-redis"></a></p>
	<h2><a href="#interacting-with-redis">Interacting With Redis</a></h2>
	<p>You may interact with Redis by calling various methods on the <code class=" language-php">Redis</code> <a href="/docs/5.7/facades">facade</a>. The <code class=" language-php">Redis</code> facade supports dynamic methods, meaning you may call any <a href="https://redis.io/commands">Redis command</a> on the facade and the command will be passed directly to Redis. In this example, we will call the Redis <code class=" language-php"><span class="token constant">GET</span></code> command by calling the <code class=" language-php">get</code> method on the <code class=" language-php">Redis</code> facade:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Controllers</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Controllers<span class="token punctuation">\</span>Controller</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>Redis</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">UserController</span> <span class="token keyword">extends</span> <span class="token class-name">Controller</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">showProfile<span class="token punctuation">(</span></span><span class="token variable">$id</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token variable">$user</span> <span class="token operator">=</span> <span class="token scope">Redis<span class="token punctuation">::</span></span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'user:profile:'</span><span class="token punctuation">.</span><span class="token variable">$id</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

        <span class="token keyword">return</span> <span class="token function">view<span class="token punctuation">(</span></span><span class="token string">'user.profile'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'user'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token variable">$user</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p>Of course, as mentioned above, you may call any of the Redis commands on the <code class=" language-php">Redis</code> facade. Space MVC uses magic methods to pass the commands to the Redis server, so pass the arguments the Redis command expects:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Redis<span class="token punctuation">::</span></span><span class="token function">set<span class="token punctuation">(</span></span><span class="token string">'name'</span><span class="token punctuation">,</span> <span class="token string">'Taylor'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$values</span> <span class="token operator">=</span> <span class="token scope">Redis<span class="token punctuation">::</span></span><span class="token function">lrange<span class="token punctuation">(</span></span><span class="token string">'names'</span><span class="token punctuation">,</span> <span class="token number">5</span><span class="token punctuation">,</span> <span class="token number">10</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>Alternatively, you may also pass commands to the server using the <code class=" language-php">command</code> method, which accepts the name of the command as its first argument, and an array of values as its second argument:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$values</span> <span class="token operator">=</span> <span class="token scope">Redis<span class="token punctuation">::</span></span><span class="token function">command<span class="token punctuation">(</span></span><span class="token string">'lrange'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'name'</span><span class="token punctuation">,</span> <span class="token number">5</span><span class="token punctuation">,</span> <span class="token number">10</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Using Multiple Redis Connections</h4>
	<p>You may get a Redis instance by calling the <code class=" language-php"><span class="token scope">Redis<span class="token punctuation">::</span></span>connection</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$redis</span> <span class="token operator">=</span> <span class="token scope">Redis<span class="token punctuation">::</span></span><span class="token function">connection<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>This will give you an instance of the default Redis server. You may also pass the connection or cluster name to the <code class=" language-php">connection</code> method to get a specific server or cluster as defined in your Redis configuration:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$redis</span> <span class="token operator">=</span> <span class="token scope">Redis<span class="token punctuation">::</span></span><span class="token function">connection<span class="token punctuation">(</span></span><span class="token string">'my-connection'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="pipelining-commands"></a></p>
	<h3>Pipelining Commands</h3>
	<p>Pipelining should be used when you need to send many commands to the server in one operation. The <code class=" language-php">pipeline</code> method accepts one argument: a <code class=" language-php">Closure</code> that receives a Redis instance. You may issue all of your commands to this Redis instance and they will all be executed within a single operation:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Redis<span class="token punctuation">::</span></span><span class="token function">pipeline<span class="token punctuation">(</span></span><span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$pipe</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">for</span> <span class="token punctuation">(</span><span class="token variable">$i</span> <span class="token operator">=</span> <span class="token number">0</span><span class="token punctuation">;</span> <span class="token variable">$i</span> <span class="token operator">&lt;</span> <span class="token number">1000</span><span class="token punctuation">;</span> <span class="token variable">$i</span><span class="token operator">++</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
        <span class="token variable">$pipe</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">set<span class="token punctuation">(</span></span><span class="token string">"key:$i"</span><span class="token punctuation">,</span> <span class="token variable">$i</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="pubsub"></a></p>
	<h2><a href="#pubsub">Pub / Sub</a></h2>
	<p>Space MVC provides a convenient interface to the Redis <code class=" language-php">publish</code> and <code class=" language-php">subscribe</code> commands. These Redis commands allow you to listen for messages on a given "channel". You may publish messages to the channel from another application, or even using another programming language, allowing easy communication between applications and processes.</p>
	<p>First, let's setup a channel listener using the <code class=" language-php">subscribe</code> method. We'll place this method call within an <a href="/docs/5.7/artisan">Artisan command</a> since calling the <code class=" language-php">subscribe</code> method begins a long-running process:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Console<span class="token punctuation">\</span>Commands</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Console<span class="token punctuation">\</span>Command</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>Redis</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">RedisSubscribe</span> <span class="token keyword">extends</span> <span class="token class-name">Command</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * The name and signature of the console command.
     *
     * @var string
     */</span>
    <span class="token keyword">protected</span> <span class="token variable">$signature</span> <span class="token operator">=</span> <span class="token string">'redis:subscribe'</span><span class="token punctuation">;</span>

    <span class="token comment" spellcheck="true">/**
     * The console command description.
     *
     * @var string
     */</span>
    <span class="token keyword">protected</span> <span class="token variable">$description</span> <span class="token operator">=</span> <span class="token string">'Subscribe to a Redis channel'</span><span class="token punctuation">;</span>

    <span class="token comment" spellcheck="true">/**
     * Execute the console command.
     *
     * @return mixed
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">handle<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token scope">Redis<span class="token punctuation">::</span></span><span class="token function">subscribe<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'test-channel'</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$message</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
            <span class="token keyword">echo</span> <span class="token variable">$message</span><span class="token punctuation">;</span>
        <span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p>Now we may publish messages to the channel using the <code class=" language-php">publish</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Route<span class="token punctuation">::</span></span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'publish'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> // Route logic...
</span>
    <span class="token scope">Redis<span class="token punctuation">::</span></span><span class="token function">publish<span class="token punctuation">(</span></span><span class="token string">'test-channel'</span><span class="token punctuation">,</span> <span class="token function">json_encode<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'foo'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'bar'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Wildcard Subscriptions</h4>
	<p>Using the <code class=" language-php">psubscribe</code> method, you may subscribe to a wildcard channel, which may be useful for catching all messages on all channels. The <code class=" language-php"><span class="token variable">$channel</span></code> name will be passed as the second argument to the provided callback <code class=" language-php">Closure</code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Redis<span class="token punctuation">::</span></span><span class="token function">psubscribe<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'*'</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$message</span><span class="token punctuation">,</span> <span class="token variable">$channel</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">echo</span> <span class="token variable">$message</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token scope">Redis<span class="token punctuation">::</span></span><span class="token function">psubscribe<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'users.*'</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$message</span><span class="token punctuation">,</span> <span class="token variable">$channel</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">echo</span> <span class="token variable">$message</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
</article>