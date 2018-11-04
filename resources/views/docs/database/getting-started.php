<article>
	<h1>Database: Getting Started</h1>
	<ul>
		<li><a href="#introduction">Introduction</a>
			<ul>
				<li><a href="#configuration">Configuration</a></li>
				<li><a href="#read-and-write-connections">Read &amp; Write Connections</a></li>
				<li><a href="#using-multiple-database-connections">Using Multiple Database Connections</a></li>
			</ul></li>
		<li><a href="#running-queries">Running Raw SQL Queries</a>
			<ul>
				<li><a href="#listening-for-query-events">Listening For Query Events</a></li>
			</ul></li>
		<li><a href="#database-transactions">Database Transactions</a></li>
	</ul>
	<p><a name="introduction"></a></p>
	<h2><a href="#introduction">Introduction</a></h2>
	<p>Space MVC makes interacting with databases extremely simple across a variety of database backends using either raw SQL, the <a href="/docs/5.7/queries">fluent query builder</a>, and the <a href="/docs/5.7/eloquent">Eloquent ORM</a>. Currently, Space MVC supports four databases:</p>
	<div class="content-list">
		<ul>
			<li>MySQL</li>
			<li>PostgreSQL</li>
			<li>SQLite</li>
			<li>SQL Server</li>
		</ul>
	</div>
	<p><a name="configuration"></a></p>
	<h3>Configuration</h3>
	<p>The database configuration for your application is located at <code class=" language-php">config<span class="token operator">/</span>database<span class="token punctuation">.</span>php</code>. In this file you may define all of your database connections, as well as specify which connection should be used by default. Examples for most of the supported database systems are provided in this file.</p>
	<p>By default, Space MVC's sample <a href="/docs/5.7/configuration#environment-configuration">environment configuration</a> is ready to use with <a href="/docs/5.7/homestead">Space MVC Homestead</a>, which is a convenient virtual machine for doing Space MVC development on your local machine. Of course, you are free to modify this configuration as needed for your local database.</p>
	<h4>SQLite Configuration</h4>
	<p>After creating a new SQLite database using a command such as <code class=" language-php">touch database<span class="token operator">/</span>database<span class="token punctuation">.</span>sqlite</code>, you can easily configure your environment variables to point to this newly created database by using the database's absolute path:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token constant">DB_CONNECTION</span><span class="token operator">=</span>sqlite
<span class="token constant">DB_DATABASE</span><span class="token operator">=</span><span class="token operator">/</span>absolute<span class="token operator">/</span>path<span class="token operator">/</span>to<span class="token operator">/</span>database<span class="token punctuation">.</span>sqlite</code></pre>
	<p>To enable foreign key constraints for SQLite connections, you should add the <code class=" language-php">foreign_key_constraints</code> option to your <code class=" language-php">config<span class="token operator">/</span>database<span class="token punctuation">.</span>php</code> configuration file:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'sqlite'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
   <span class="token comment" spellcheck="true"> // ...
</span>    <span class="token string">'foreign_key_constraints'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token boolean">true</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<p><a name="read-and-write-connections"></a></p>
	<h3>Read &amp; Write Connections</h3>
	<p>Sometimes you may wish to use one database connection for SELECT statements, and another for INSERT, UPDATE, and DELETE statements. Space MVC makes this a breeze, and the proper connections will always be used whether you are using raw queries, the query builder, or the Eloquent ORM.</p>
	<p>To see how read / write connections should be configured, let's look at this example:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'mysql'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
    <span class="token string">'read'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'host'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'192.168.1.1'</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>
    <span class="token string">'write'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'host'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'196.168.1.2'</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>
    <span class="token string">'sticky'</span>    <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token boolean">true</span><span class="token punctuation">,</span>
    <span class="token string">'driver'</span>    <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'mysql'</span><span class="token punctuation">,</span>
    <span class="token string">'database'</span>  <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'database'</span><span class="token punctuation">,</span>
    <span class="token string">'username'</span>  <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'root'</span><span class="token punctuation">,</span>
    <span class="token string">'password'</span>  <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">''</span><span class="token punctuation">,</span>
    <span class="token string">'charset'</span>   <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'utf8mb4'</span><span class="token punctuation">,</span>
    <span class="token string">'collation'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'utf8mb4_unicode_ci'</span><span class="token punctuation">,</span>
    <span class="token string">'prefix'</span>    <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">''</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<p>Note that three keys have been added to the configuration array: <code class=" language-php">read</code>, <code class=" language-php">write</code> and <code class=" language-php">sticky</code>. The <code class=" language-php">read</code> and <code class=" language-php">write</code> keys have array values containing a single key: <code class=" language-php">host</code>. The rest of the database options for the <code class=" language-php">read</code> and <code class=" language-php">write</code> connections will be merged from the main <code class=" language-php">mysql</code> array.</p>
	<p>You only need to place items in the <code class=" language-php">read</code> and <code class=" language-php">write</code> arrays if you wish to override the values from the main array. So, in this case, <code class=" language-php"><span class="token number">192.168</span><span class="token punctuation">.</span><span class="token number">1.1</span></code> will be used as the host for the "read" connection, while <code class=" language-php"><span class="token number">192.168</span><span class="token punctuation">.</span><span class="token number">1.2</span></code> will be used for the "write" connection. The database credentials, prefix, character set, and all other options in the main <code class=" language-php">mysql</code> array will be shared across both connections.</p>
	<h4>The <code class=" language-php">sticky</code> Option</h4>
	<p>The <code class=" language-php">sticky</code> option is an <em>optional</em> value that can be used to allow the immediate reading of records that have been written to the database during the current request cycle. If the <code class=" language-php">sticky</code> option is enabled and a "write" operation has been performed against the database during the current request cycle, any further "read" operations will use the "write" connection. This ensures that any data written during the request cycle can be immediately read back from the database during that same request. It is up to you to decide if this is the desired behavior for your application.</p>
	<p><a name="using-multiple-database-connections"></a></p>
	<h3>Using Multiple Database Connections</h3>
	<p>When using multiple connections, you may access each connection via the <code class=" language-php">connection</code> method on the <code class=" language-php"><span class="token constant">DB</span></code> facade. The <code class=" language-php">name</code> passed to the <code class=" language-php">connection</code> method should correspond to one of the connections listed in your <code class=" language-php">config<span class="token operator">/</span>database<span class="token punctuation">.</span>php</code> configuration file:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$users</span> <span class="token operator">=</span> <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">connection<span class="token punctuation">(</span></span><span class="token string">'foo'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">select<span class="token punctuation">(</span></span><span class="token punctuation">.</span><span class="token punctuation">.</span><span class="token punctuation">.</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>You may also access the raw, underlying PDO instance using the <code class=" language-php">getPdo</code> method on a connection instance:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$pdo</span> <span class="token operator">=</span> <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">connection<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">getPdo<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="running-queries"></a></p>
	<h2><a href="#running-queries">Running Raw SQL Queries</a></h2>
	<p>Once you have configured your database connection, you may run queries using the <code class=" language-php"><span class="token constant">DB</span></code> facade. The <code class=" language-php"><span class="token constant">DB</span></code> facade provides methods for each type of query: <code class=" language-php">select</code>, <code class=" language-php">update</code>, <code class=" language-php">insert</code>, <code class=" language-php">delete</code>, and <code class=" language-php">statement</code>.</p>
	<h4>Running A Select Query</h4>
	<p>To run a basic query, you may use the <code class=" language-php">select</code> method on the <code class=" language-php"><span class="token constant">DB</span></code> facade:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Controllers</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>DB</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Controllers<span class="token punctuation">\</span>Controller</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">UserController</span> <span class="token keyword">extends</span> <span class="token class-name">Controller</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Show a list of all of the application's users.
     *
     * @return Response
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">index<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token variable">$users</span> <span class="token operator">=</span> <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">select<span class="token punctuation">(</span></span><span class="token string">'select * from users where active = ?'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token number">1</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

        <span class="token keyword">return</span> <span class="token function">view<span class="token punctuation">(</span></span><span class="token string">'user.index'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'users'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token variable">$users</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p>The first argument passed to the <code class=" language-php">select</code> method is the raw SQL query, while the second argument is any parameter bindings that need to be bound to the query. Typically, these are the values of the <code class=" language-php">where</code> clause constraints. Parameter binding provides protection against SQL injection.</p>
	<p>The <code class=" language-php">select</code> method will always return an <code class=" language-php"><span class="token keyword">array</span></code> of results. Each result within the array will be a PHP <code class=" language-php">stdClass</code> object, allowing you to access the values of the results:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">foreach</span> <span class="token punctuation">(</span><span class="token variable">$users</span> <span class="token keyword">as</span> <span class="token variable">$user</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">echo</span> <span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">name</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<h4>Using Named Bindings</h4>
	<p>Instead of using <code class=" language-php"><span class="token operator">?</span></code> to represent your parameter bindings, you may execute a query using named bindings:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$results</span> <span class="token operator">=</span> <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">select<span class="token punctuation">(</span></span><span class="token string">'select * from users where id = :id'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'id'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">1</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Running An Insert Statement</h4>
	<p>To execute an <code class=" language-php">insert</code> statement, you may use the <code class=" language-php">insert</code> method on the <code class=" language-php"><span class="token constant">DB</span></code> facade. Like <code class=" language-php">select</code>, this method takes the raw SQL query as its first argument and bindings as its second argument:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">insert<span class="token punctuation">(</span></span><span class="token string">'insert into users (id, name) values (?, ?)'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token number">1</span><span class="token punctuation">,</span> <span class="token string">'Dayle'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Running An Update Statement</h4>
	<p>The <code class=" language-php">update</code> method should be used to update existing records in the database. The number of rows affected by the statement will be returned:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$affected</span> <span class="token operator">=</span> <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">update<span class="token punctuation">(</span></span><span class="token string">'update users set votes = 100 where name = ?'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'John'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Running A Delete Statement</h4>
	<p>The <code class=" language-php">delete</code> method should be used to delete records from the database. Like <code class=" language-php">update</code>, the number of rows affected will be returned:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$deleted</span> <span class="token operator">=</span> <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">delete<span class="token punctuation">(</span></span><span class="token string">'delete from users'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Running A General Statement</h4>
	<p>Some database statements do not return any value. For these types of operations, you may use the <code class=" language-php">statement</code> method on the <code class=" language-php"><span class="token constant">DB</span></code> facade:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">statement<span class="token punctuation">(</span></span><span class="token string">'drop table users'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="listening-for-query-events"></a></p>
	<h3>Listening For Query Events</h3>
	<p>If you would like to receive each SQL query executed by your application, you may use the <code class=" language-php">listen</code> method. This method is useful for logging queries or debugging. You may register your query listener in a <a href="/docs/5.7/providers">service provider</a>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Providers</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>DB</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>ServiceProvider</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">AppServiceProvider</span> <span class="token keyword">extends</span> <span class="token class-name">ServiceProvider</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Bootstrap any application services.
     *
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">boot<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">listen<span class="token punctuation">(</span></span><span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$query</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
           <span class="token comment" spellcheck="true"> // $query-&gt;sql
</span>           <span class="token comment" spellcheck="true"> // $query-&gt;bindings
</span>           <span class="token comment" spellcheck="true"> // $query-&gt;time
</span>        <span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>

    <span class="token comment" spellcheck="true">/**
     * Register the service provider.
     *
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">register<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
       <span class="token comment" spellcheck="true"> //
</span>    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="database-transactions"></a></p>
	<h2><a href="#database-transactions">Database Transactions</a></h2>
	<p>You may use the <code class=" language-php">transaction</code> method on the <code class=" language-php"><span class="token constant">DB</span></code> facade to run a set of operations within a database transaction. If an exception is thrown within the transaction <code class=" language-php">Closure</code>, the transaction will automatically be rolled back. If the <code class=" language-php">Closure</code> executes successfully, the transaction will automatically be committed. You don't need to worry about manually rolling back or committing while using the <code class=" language-php">transaction</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">transaction<span class="token punctuation">(</span></span><span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">update<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'votes'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">1</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

    <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'posts'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">delete<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Handling Deadlocks</h4>
	<p>The <code class=" language-php">transaction</code> method accepts an optional second argument which defines the number of times a transaction should be reattempted when a deadlock occurs. Once these attempts have been exhausted, an exception will be thrown:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">transaction<span class="token punctuation">(</span></span><span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">update<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'votes'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">1</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

    <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'posts'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">delete<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">,</span> <span class="token number">5</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Manually Using Transactions</h4>
	<p>If you would like to begin a transaction manually and have complete control over rollbacks and commits, you may use the <code class=" language-php">beginTransaction</code> method on the <code class=" language-php"><span class="token constant">DB</span></code> facade:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">beginTransaction<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>You can rollback the transaction via the <code class=" language-php">rollBack</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">rollBack<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>Lastly, you can commit a transaction via the <code class=" language-php">commit</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">commit<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> The <code class=" language-php"><span class="token constant">DB</span></code> facade's transaction methods control the transactions for both the <a href="/docs/5.7/queries">query builder</a> and <a href="/docs/5.7/eloquent">Eloquent ORM</a>.</p>
	</blockquote>
</article>