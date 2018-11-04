<article>
	<h1>Database: Migrations</h1>
	<ul>
		<li><a href="#introduction">Introduction</a></li>
		<li><a href="#generating-migrations">Generating Migrations</a></li>
		<li><a href="#migration-structure">Migration Structure</a></li>
		<li><a href="#running-migrations">Running Migrations</a>
			<ul>
				<li><a href="#rolling-back-migrations">Rolling Back Migrations</a></li>
			</ul></li>
		<li><a href="#tables">Tables</a>
			<ul>
				<li><a href="#creating-tables">Creating Tables</a></li>
				<li><a href="#renaming-and-dropping-tables">Renaming / Dropping Tables</a></li>
			</ul></li>
		<li><a href="#columns">Columns</a>
			<ul>
				<li><a href="#creating-columns">Creating Columns</a></li>
				<li><a href="#column-modifiers">Column Modifiers</a></li>
				<li><a href="#modifying-columns">Modifying Columns</a></li>
				<li><a href="#dropping-columns">Dropping Columns</a></li>
			</ul></li>
		<li><a href="#indexes">Indexes</a>
			<ul>
				<li><a href="#creating-indexes">Creating Indexes</a></li>
				<li><a href="#renaming-indexes">Renaming Indexes</a></li>
				<li><a href="#dropping-indexes">Dropping Indexes</a></li>
				<li><a href="#foreign-key-constraints">Foreign Key Constraints</a></li>
			</ul></li>
	</ul>
	<p><a name="introduction"></a></p>
	<h2><a href="#introduction">Introduction</a></h2>
	<p>Migrations are like version control for your database, allowing your team to easily modify and share the application's database schema. Migrations are typically paired with Space MVC's schema builder to easily build your application's database schema. If you have ever had to tell a teammate to manually add a column to their local database schema, you've faced the problem that database migrations solve.</p>
	<p>The Space MVC <code class=" language-php">Schema</code> <a href="/docs/5.7/facades">facade</a> provides database agnostic support for creating and manipulating tables across all of Space MVC's supported database systems.</p>
	<p><a name="generating-migrations"></a></p>
	<h2><a href="#generating-migrations">Generating Migrations</a></h2>
	<p>To create a migration, use the <code class=" language-php">make<span class="token punctuation">:</span>migration</code> <a href="/docs/5.7/artisan">Artisan command</a>:</p>
	<pre class=" language-php"><code class=" language-php">php artisan make<span class="token punctuation">:</span>migration create_users_table</code></pre>
	<p>The new migration will be placed in your <code class=" language-php">database<span class="token operator">/</span>migrations</code> directory. Each migration file name contains a timestamp which allows Space MVC to determine the order of the migrations.</p>
	<p>The <code class=" language-php"><span class="token operator">--</span>table</code> and <code class=" language-php"><span class="token operator">--</span>create</code> options may also be used to indicate the name of the table and whether the migration will be creating a new table. These options pre-fill the generated migration stub file with the specified table:</p>
	<pre class=" language-php"><code class=" language-php">php artisan make<span class="token punctuation">:</span>migration create_users_table <span class="token operator">--</span>create<span class="token operator">=</span>users

php artisan make<span class="token punctuation">:</span>migration add_votes_to_users_table <span class="token operator">--</span>table<span class="token operator">=</span>users</code></pre>
	<p>If you would like to specify a custom output path for the generated migration, you may use the <code class=" language-php"><span class="token operator">--</span>path</code> option when executing the <code class=" language-php">make<span class="token punctuation">:</span>migration</code> command. The given path should be relative to your application's base path.</p>
	<p><a name="migration-structure"></a></p>
	<h2><a href="#migration-structure">Migration Structure</a></h2>
	<p>A migration class contains two methods: <code class=" language-php">up</code> and <code class=" language-php">down</code>. The <code class=" language-php">up</code> method is used to add new tables, columns, or indexes to your database, while the <code class=" language-php">down</code> method should reverse the operations performed by the <code class=" language-php">up</code> method.</p>
	<p>Within both of these methods you may use the Space MVC schema builder to expressively create and modify tables. To learn about all of the methods available on the <code class=" language-php">Schema</code> builder, <a href="#creating-tables">check out its documentation</a>. For example, this migration example creates a <code class=" language-php">flights</code> table:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>Schema</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Database<span class="token punctuation">\</span>Schema<span class="token punctuation">\</span>Blueprint</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Database<span class="token punctuation">\</span>Migrations<span class="token punctuation">\</span>Migration</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">CreateFlightsTable</span> <span class="token keyword">extends</span> <span class="token class-name">Migration</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Run the migrations.
     *
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">up<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">create<span class="token punctuation">(</span></span><span class="token string">'flights'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span>Blueprint <span class="token variable">$table</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
            <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">increments<span class="token punctuation">(</span></span><span class="token string">'id'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
            <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">string<span class="token punctuation">(</span></span><span class="token string">'name'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
            <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">string<span class="token punctuation">(</span></span><span class="token string">'airline'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
            <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">timestamps<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
        <span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>

    <span class="token comment" spellcheck="true">/**
     * Reverse the migrations.
     *
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">down<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">drop<span class="token punctuation">(</span></span><span class="token string">'flights'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="running-migrations"></a></p>
	<h2><a href="#running-migrations">Running Migrations</a></h2>
	<p>To run all of your outstanding migrations, execute the <code class=" language-php">migrate</code> Artisan command:</p>
	<pre class=" language-php"><code class=" language-php">php artisan migrate</code></pre>
	<blockquote class="has-icon">
		<p class="note"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="90px" height="90px" viewBox="0 0 90 90" enable-background="new 0 0 90 90" xml:space="preserve"><path fill="#FFFFFF" d="M45 0C20.1 0 0 20.1 0 45s20.1 45 45 45 45-20.1 45-45S69.9 0 45 0zM45 74.5c-3.6 0-6.5-2.9-6.5-6.5s2.9-6.5 6.5-6.5 6.5 2.9 6.5 6.5S48.6 74.5 45 74.5zM52.1 23.9l-2.5 29.6c0 2.5-2.1 4.6-4.6 4.6 -2.5 0-4.6-2.1-4.6-4.6l-2.5-29.6c-0.1-0.4-0.1-0.7-0.1-1.1 0-4 3.2-7.2 7.2-7.2 4 0 7.2 3.2 7.2 7.2C52.2 23.1 52.2 23.5 52.1 23.9z"></path></svg></span></div> If you are using the <a href="/docs/5.7/homestead">Homestead virtual machine</a>, you should run this command from within your virtual machine.</p>
	</blockquote>
	<h4>Forcing Migrations To Run In Production</h4>
	<p>Some migration operations are destructive, which means they may cause you to lose data. In order to protect you from running these commands against your production database, you will be prompted for confirmation before the commands are executed. To force the commands to run without a prompt, use the <code class=" language-php"><span class="token operator">--</span>force</code> flag:</p>
	<pre class=" language-php"><code class=" language-php">php artisan migrate <span class="token operator">--</span>force</code></pre>
	<p><a name="rolling-back-migrations"></a></p>
	<h3>Rolling Back Migrations</h3>
	<p>To rollback the latest migration operation, you may use the <code class=" language-php">rollback</code> command. This command rolls back the last "batch" of migrations, which may include multiple migration files:</p>
	<pre class=" language-php"><code class=" language-php">php artisan migrate<span class="token punctuation">:</span>rollback</code></pre>
	<p>You may rollback a limited number of migrations by providing the <code class=" language-php">step</code> option to the <code class=" language-php">rollback</code> command. For example, the following command will rollback the last five migrations:</p>
	<pre class=" language-php"><code class=" language-php">php artisan migrate<span class="token punctuation">:</span>rollback <span class="token operator">--</span>step<span class="token operator">=</span><span class="token number">5</span></code></pre>
	<p>The <code class=" language-php">migrate<span class="token punctuation">:</span>reset</code> command will roll back all of your application's migrations:</p>
	<pre class=" language-php"><code class=" language-php">php artisan migrate<span class="token punctuation">:</span>reset</code></pre>
	<h4>Rollback &amp; Migrate In Single Command</h4>
	<p>The <code class=" language-php">migrate<span class="token punctuation">:</span>refresh</code> command will roll back all of your migrations and then execute the <code class=" language-php">migrate</code> command. This command effectively re-creates your entire database:</p>
	<pre class=" language-php"><code class=" language-php">php artisan migrate<span class="token punctuation">:</span>refresh
<span class="token comment" spellcheck="true">
// Refresh the database and run all database seeds...
</span>php artisan migrate<span class="token punctuation">:</span>refresh <span class="token operator">--</span>seed</code></pre>
	<p>You may rollback &amp; re-migrate a limited number of migrations by providing the <code class=" language-php">step</code> option to the <code class=" language-php">refresh</code> command. For example, the following command will rollback &amp; re-migrate the last five migrations:</p>
	<pre class=" language-php"><code class=" language-php">php artisan migrate<span class="token punctuation">:</span>refresh <span class="token operator">--</span>step<span class="token operator">=</span><span class="token number">5</span></code></pre>
	<h4>Drop All Tables &amp; Migrate</h4>
	<p>The <code class=" language-php">migrate<span class="token punctuation">:</span>fresh</code> command will drop all tables from the database and then execute the <code class=" language-php">migrate</code> command:</p>
	<pre class=" language-php"><code class=" language-php">php artisan migrate<span class="token punctuation">:</span>fresh

php artisan migrate<span class="token punctuation">:</span>fresh <span class="token operator">--</span>seed</code></pre>
	<p><a name="tables"></a></p>
	<h2><a href="#tables">Tables</a></h2>
	<p><a name="creating-tables"></a></p>
	<h3>Creating Tables</h3>
	<p>To create a new database table, use the <code class=" language-php">create</code> method on the <code class=" language-php">Schema</code> facade. The <code class=" language-php">create</code> method accepts two arguments. The first is the name of the table, while the second is a <code class=" language-php">Closure</code> which receives a <code class=" language-php">Blueprint</code> object that may be used to define the new table:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">create<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span>Blueprint <span class="token variable">$table</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">increments<span class="token punctuation">(</span></span><span class="token string">'id'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>Of course, when creating the table, you may use any of the schema builder's <a href="#creating-columns">column methods</a> to define the table's columns.</p>
	<h4>Checking For Table / Column Existence</h4>
	<p>You may easily check for the existence of a table or column using the <code class=" language-php">hasTable</code> and <code class=" language-php">hasColumn</code> methods:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">if</span> <span class="token punctuation">(</span><span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">hasTable<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span>

<span class="token keyword">if</span> <span class="token punctuation">(</span><span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">hasColumn<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">,</span> <span class="token string">'email'</span><span class="token punctuation">)</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span></code></pre>
	<h4>Database Connection &amp; Table Options</h4>
	<p>If you want to perform a schema operation on a database connection that is not your default connection, use the <code class=" language-php">connection</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">connection<span class="token punctuation">(</span></span><span class="token string">'foo'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">create<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span>Blueprint <span class="token variable">$table</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">increments<span class="token punctuation">(</span></span><span class="token string">'id'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>You may use the following commands on the schema builder to define the table's options:</p>
	<table>
		<thead>
		<tr>
			<th>Command</th>
			<th>Description</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">engine</span> <span class="token operator">=</span> <span class="token string">'InnoDB'</span><span class="token punctuation">;</span></code></td>
			<td>Specify the table storage engine (MySQL).</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">charset</span> <span class="token operator">=</span> <span class="token string">'utf8'</span><span class="token punctuation">;</span></code></td>
			<td>Specify a default character set for the table (MySQL).</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">collation</span> <span class="token operator">=</span> <span class="token string">'utf8_unicode_ci'</span><span class="token punctuation">;</span></code></td>
			<td>Specify a default collation for the table (MySQL).</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">temporary<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Create a temporary table (except SQL Server).</td>
		</tr>
		</tbody>
	</table>
	<p><a name="renaming-and-dropping-tables"></a></p>
	<h3>Renaming / Dropping Tables</h3>
	<p>To rename an existing database table, use the <code class=" language-php">rename</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">rename<span class="token punctuation">(</span></span><span class="token variable">$from</span><span class="token punctuation">,</span> <span class="token variable">$to</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>To drop an existing table, you may use the <code class=" language-php">drop</code> or <code class=" language-php">dropIfExists</code> methods:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">drop<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">dropIfExists<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Renaming Tables With Foreign Keys</h4>
	<p>Before renaming a table, you should verify that any foreign key constraints on the table have an explicit name in your migration files instead of letting Space MVC assign a convention based name. Otherwise, the foreign key constraint name will refer to the old table name.</p>
	<p><a name="columns"></a></p>
	<h2><a href="#columns">Columns</a></h2>
	<p><a name="creating-columns"></a></p>
	<h3>Creating Columns</h3>
	<p>The <code class=" language-php">table</code> method on the <code class=" language-php">Schema</code> facade may be used to update existing tables. Like the <code class=" language-php">create</code> method, the <code class=" language-php">table</code> method accepts two arguments: the name of the table and a <code class=" language-php">Closure</code> that receives a <code class=" language-php">Blueprint</code> instance you may use to add columns to the table:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span>Blueprint <span class="token variable">$table</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">string<span class="token punctuation">(</span></span><span class="token string">'email'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Available Column Types</h4>
	<p>Of course, the schema builder contains a variety of column types that you may specify when building your tables:</p>
	<table>
		<thead>
		<tr>
			<th>Command</th>
			<th>Description</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">bigIncrements<span class="token punctuation">(</span></span><span class="token string">'id'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Auto-incrementing UNSIGNED BIGINT (primary key) equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">bigInteger<span class="token punctuation">(</span></span><span class="token string">'votes'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>BIGINT equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">binary<span class="token punctuation">(</span></span><span class="token string">'data'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>BLOB equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">boolean<span class="token punctuation">(</span></span><span class="token string">'confirmed'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>BOOLEAN equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">char<span class="token punctuation">(</span></span><span class="token string">'name'</span><span class="token punctuation">,</span> <span class="token number">100</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>CHAR equivalent column with an optional length.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">date<span class="token punctuation">(</span></span><span class="token string">'created_at'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>DATE equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">dateTime<span class="token punctuation">(</span></span><span class="token string">'created_at'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>DATETIME equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">dateTimeTz<span class="token punctuation">(</span></span><span class="token string">'created_at'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>DATETIME (with timezone) equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">decimal<span class="token punctuation">(</span></span><span class="token string">'amount'</span><span class="token punctuation">,</span> <span class="token number">8</span><span class="token punctuation">,</span> <span class="token number">2</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>DECIMAL equivalent column with a precision (total digits) and scale (decimal digits).</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">double<span class="token punctuation">(</span></span><span class="token string">'amount'</span><span class="token punctuation">,</span> <span class="token number">8</span><span class="token punctuation">,</span> <span class="token number">2</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>DOUBLE equivalent column with a precision (total digits) and scale (decimal digits).</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">enum<span class="token punctuation">(</span></span><span class="token string">'level'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'easy'</span><span class="token punctuation">,</span> <span class="token string">'hard'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>ENUM equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">float<span class="token punctuation">(</span></span><span class="token string">'amount'</span><span class="token punctuation">,</span> <span class="token number">8</span><span class="token punctuation">,</span> <span class="token number">2</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>FLOAT equivalent column with a precision (total digits) and scale (decimal digits).</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">geometry<span class="token punctuation">(</span></span><span class="token string">'positions'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>GEOMETRY equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">geometryCollection<span class="token punctuation">(</span></span><span class="token string">'positions'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>GEOMETRYCOLLECTION equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">increments<span class="token punctuation">(</span></span><span class="token string">'id'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Auto-incrementing UNSIGNED INTEGER (primary key) equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">integer<span class="token punctuation">(</span></span><span class="token string">'votes'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>INTEGER equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">ipAddress<span class="token punctuation">(</span></span><span class="token string">'visitor'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>IP address equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">json<span class="token punctuation">(</span></span><span class="token string">'options'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>JSON equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">jsonb<span class="token punctuation">(</span></span><span class="token string">'options'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>JSONB equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">lineString<span class="token punctuation">(</span></span><span class="token string">'positions'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>LINESTRING equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">longText<span class="token punctuation">(</span></span><span class="token string">'description'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>LONGTEXT equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">macAddress<span class="token punctuation">(</span></span><span class="token string">'device'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>MAC address equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">mediumIncrements<span class="token punctuation">(</span></span><span class="token string">'id'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Auto-incrementing UNSIGNED MEDIUMINT (primary key) equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">mediumInteger<span class="token punctuation">(</span></span><span class="token string">'votes'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>MEDIUMINT equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">mediumText<span class="token punctuation">(</span></span><span class="token string">'description'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>MEDIUMTEXT equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">morphs<span class="token punctuation">(</span></span><span class="token string">'taggable'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Adds <code class=" language-php">taggable_id</code> UNSIGNED BIGINT and <code class=" language-php">taggable_type</code> VARCHAR equivalent columns.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">multiLineString<span class="token punctuation">(</span></span><span class="token string">'positions'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>MULTILINESTRING equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">multiPoint<span class="token punctuation">(</span></span><span class="token string">'positions'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>MULTIPOINT equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">multiPolygon<span class="token punctuation">(</span></span><span class="token string">'positions'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>MULTIPOLYGON equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">nullableMorphs<span class="token punctuation">(</span></span><span class="token string">'taggable'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Adds nullable versions of <code class=" language-php"><span class="token function">morphs<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code> columns.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">nullableTimestamps<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Alias of <code class=" language-php"><span class="token function">timestamps<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code> method.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">point<span class="token punctuation">(</span></span><span class="token string">'position'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>POINT equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">polygon<span class="token punctuation">(</span></span><span class="token string">'positions'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>POLYGON equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">rememberToken<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Adds a nullable <code class=" language-php">remember_token</code> VARCHAR(100) equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">smallIncrements<span class="token punctuation">(</span></span><span class="token string">'id'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Auto-incrementing UNSIGNED SMALLINT (primary key) equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">smallInteger<span class="token punctuation">(</span></span><span class="token string">'votes'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>SMALLINT equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">softDeletes<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Adds a nullable <code class=" language-php">deleted_at</code> TIMESTAMP equivalent column for soft deletes.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">softDeletesTz<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Adds a nullable <code class=" language-php">deleted_at</code> TIMESTAMP (with timezone) equivalent column for soft deletes.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">string<span class="token punctuation">(</span></span><span class="token string">'name'</span><span class="token punctuation">,</span> <span class="token number">100</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>VARCHAR equivalent column with a optional length.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">text<span class="token punctuation">(</span></span><span class="token string">'description'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>TEXT equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">time<span class="token punctuation">(</span></span><span class="token string">'sunrise'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>TIME equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">timeTz<span class="token punctuation">(</span></span><span class="token string">'sunrise'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>TIME (with timezone) equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">timestamp<span class="token punctuation">(</span></span><span class="token string">'added_on'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>TIMESTAMP equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">timestampTz<span class="token punctuation">(</span></span><span class="token string">'added_on'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>TIMESTAMP (with timezone) equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">timestamps<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Adds nullable <code class=" language-php">created_at</code> and <code class=" language-php">updated_at</code> TIMESTAMP equivalent columns.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">timestampsTz<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Adds nullable <code class=" language-php">created_at</code> and <code class=" language-php">updated_at</code> TIMESTAMP (with timezone) equivalent columns.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">tinyIncrements<span class="token punctuation">(</span></span><span class="token string">'id'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Auto-incrementing UNSIGNED TINYINT (primary key) equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">tinyInteger<span class="token punctuation">(</span></span><span class="token string">'votes'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>TINYINT equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">unsignedBigInteger<span class="token punctuation">(</span></span><span class="token string">'votes'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>UNSIGNED BIGINT equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">unsignedDecimal<span class="token punctuation">(</span></span><span class="token string">'amount'</span><span class="token punctuation">,</span> <span class="token number">8</span><span class="token punctuation">,</span> <span class="token number">2</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>UNSIGNED DECIMAL equivalent column with a precision (total digits) and scale (decimal digits).</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">unsignedInteger<span class="token punctuation">(</span></span><span class="token string">'votes'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>UNSIGNED INTEGER equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">unsignedMediumInteger<span class="token punctuation">(</span></span><span class="token string">'votes'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>UNSIGNED MEDIUMINT equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">unsignedSmallInteger<span class="token punctuation">(</span></span><span class="token string">'votes'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>UNSIGNED SMALLINT equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">unsignedTinyInteger<span class="token punctuation">(</span></span><span class="token string">'votes'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>UNSIGNED TINYINT equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">uuid<span class="token punctuation">(</span></span><span class="token string">'id'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>UUID equivalent column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">year<span class="token punctuation">(</span></span><span class="token string">'birth_year'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>YEAR equivalent column.</td>
		</tr>
		</tbody>
	</table>
	<p><a name="column-modifiers"></a></p>
	<h3>Column Modifiers</h3>
	<p>In addition to the column types listed above, there are several column "modifiers" you may use while adding a column to a database table. For example, to make the column "nullable", you may use the <code class=" language-php">nullable</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span>Blueprint <span class="token variable">$table</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">string<span class="token punctuation">(</span></span><span class="token string">'email'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">nullable<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>Below is a list of all the available column modifiers. This list does not include the <a href="#creating-indexes">index modifiers</a>:</p>
	<table>
		<thead>
		<tr>
			<th>Modifier</th>
			<th>Description</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><code class=" language-php"><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">after<span class="token punctuation">(</span></span><span class="token string">'column'</span><span class="token punctuation">)</span></code></td>
			<td>Place the column "after" another column (MySQL)</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">autoIncrement<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></td>
			<td>Set INTEGER columns as auto-increment (primary key)</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">charset<span class="token punctuation">(</span></span><span class="token string">'utf8'</span><span class="token punctuation">)</span></code></td>
			<td>Specify a character set for the column (MySQL)</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">collation<span class="token punctuation">(</span></span><span class="token string">'utf8_unicode_ci'</span><span class="token punctuation">)</span></code></td>
			<td>Specify a collation for the column (MySQL/SQL Server)</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">comment<span class="token punctuation">(</span></span><span class="token string">'my comment'</span><span class="token punctuation">)</span></code></td>
			<td>Add a comment to a column (MySQL)</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token keyword">default</span><span class="token punctuation">(</span><span class="token variable">$value</span><span class="token punctuation">)</span></code></td>
			<td>Specify a "default" value for the column</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">first<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></td>
			<td>Place the column "first" in the table (MySQL)</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">nullable<span class="token punctuation">(</span></span><span class="token variable">$value</span> <span class="token operator">=</span> <span class="token boolean">true</span><span class="token punctuation">)</span></code></td>
			<td>Allows (by default) NULL values to be inserted into the column</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">storedAs<span class="token punctuation">(</span></span><span class="token variable">$expression</span><span class="token punctuation">)</span></code></td>
			<td>Create a stored generated column (MySQL)</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">unsigned<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></td>
			<td>Set INTEGER columns as UNSIGNED (MySQL)</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">useCurrent<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></td>
			<td>Set TIMESTAMP columns to use CURRENT_TIMESTAMP as default value</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">virtualAs<span class="token punctuation">(</span></span><span class="token variable">$expression</span><span class="token punctuation">)</span></code></td>
			<td>Create a virtual generated column (MySQL)</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">generatedAs<span class="token punctuation">(</span></span><span class="token variable">$expression</span><span class="token punctuation">)</span></code></td>
			<td>Create an identity column with specified sequence options (PostgreSQL)</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">always<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></td>
			<td>Defines the precedence of sequence values over input for an identity column (PostgreSQL)</td>
		</tr>
		</tbody>
	</table>
	<p><a name="modifying-columns"></a></p>
	<h3>Modifying Columns</h3>
	<h4>Prerequisites</h4>
	<p>Before modifying a column, be sure to add the <code class=" language-php">doctrine<span class="token operator">/</span>dbal</code> dependency to your <code class=" language-php">composer<span class="token punctuation">.</span>json</code> file. The Doctrine DBAL library is used to determine the current state of the column and create the SQL queries needed to make the specified adjustments to the column:</p>
	<pre class=" language-php"><code class=" language-php">composer <span class="token keyword">require</span> doctrine<span class="token operator">/</span>dbal</code></pre>
	<h4>Updating Column Attributes</h4>
	<p>The <code class=" language-php">change</code> method allows you to modify some existing column types to a new type or modify the column's attributes. For example, you may wish to increase the size of a string column. To see the <code class=" language-php">change</code> method in action, let's increase the size of the <code class=" language-php">name</code> column from 25 to 50:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span>Blueprint <span class="token variable">$table</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">string<span class="token punctuation">(</span></span><span class="token string">'name'</span><span class="token punctuation">,</span> <span class="token number">50</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">change<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>We could also modify a column to be nullable:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span>Blueprint <span class="token variable">$table</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">string<span class="token punctuation">(</span></span><span class="token string">'name'</span><span class="token punctuation">,</span> <span class="token number">50</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">nullable<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">change<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<blockquote class="has-icon">
		<p class="note"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="90px" height="90px" viewBox="0 0 90 90" enable-background="new 0 0 90 90" xml:space="preserve"><path fill="#FFFFFF" d="M45 0C20.1 0 0 20.1 0 45s20.1 45 45 45 45-20.1 45-45S69.9 0 45 0zM45 74.5c-3.6 0-6.5-2.9-6.5-6.5s2.9-6.5 6.5-6.5 6.5 2.9 6.5 6.5S48.6 74.5 45 74.5zM52.1 23.9l-2.5 29.6c0 2.5-2.1 4.6-4.6 4.6 -2.5 0-4.6-2.1-4.6-4.6l-2.5-29.6c-0.1-0.4-0.1-0.7-0.1-1.1 0-4 3.2-7.2 7.2-7.2 4 0 7.2 3.2 7.2 7.2C52.2 23.1 52.2 23.5 52.1 23.9z"></path></svg></span></div> Only the following column types can be "changed": bigInteger, binary, boolean, date, dateTime, dateTimeTz, decimal, integer, json, longText, mediumText, smallInteger, string, text, time, unsignedBigInteger, unsignedInteger and unsignedSmallInteger.</p>
	</blockquote>
	<h4>Renaming Columns</h4>
	<p>To rename a column, you may use the <code class=" language-php">renameColumn</code> method on the Schema builder. Before renaming a column, be sure to add the <code class=" language-php">doctrine<span class="token operator">/</span>dbal</code> dependency to your <code class=" language-php">composer<span class="token punctuation">.</span>json</code> file:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span>Blueprint <span class="token variable">$table</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">renameColumn<span class="token punctuation">(</span></span><span class="token string">'from'</span><span class="token punctuation">,</span> <span class="token string">'to'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<blockquote class="has-icon">
		<p class="note"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="90px" height="90px" viewBox="0 0 90 90" enable-background="new 0 0 90 90" xml:space="preserve"><path fill="#FFFFFF" d="M45 0C20.1 0 0 20.1 0 45s20.1 45 45 45 45-20.1 45-45S69.9 0 45 0zM45 74.5c-3.6 0-6.5-2.9-6.5-6.5s2.9-6.5 6.5-6.5 6.5 2.9 6.5 6.5S48.6 74.5 45 74.5zM52.1 23.9l-2.5 29.6c0 2.5-2.1 4.6-4.6 4.6 -2.5 0-4.6-2.1-4.6-4.6l-2.5-29.6c-0.1-0.4-0.1-0.7-0.1-1.1 0-4 3.2-7.2 7.2-7.2 4 0 7.2 3.2 7.2 7.2C52.2 23.1 52.2 23.5 52.1 23.9z"></path></svg></span></div> Renaming any column in a table that also has a column of type <code class=" language-php">enum</code> is not currently supported.</p>
	</blockquote>
	<p><a name="dropping-columns"></a></p>
	<h3>Dropping Columns</h3>
	<p>To drop a column, use the <code class=" language-php">dropColumn</code> method on the Schema builder. Before dropping columns from a SQLite database, you will need to add the <code class=" language-php">doctrine<span class="token operator">/</span>dbal</code> dependency to your <code class=" language-php">composer<span class="token punctuation">.</span>json</code> file and run the <code class=" language-php">composer update</code> command in your terminal to install the library:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span>Blueprint <span class="token variable">$table</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">dropColumn<span class="token punctuation">(</span></span><span class="token string">'votes'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>You may drop multiple columns from a table by passing an array of column names to the <code class=" language-php">dropColumn</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span>Blueprint <span class="token variable">$table</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">dropColumn<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'votes'</span><span class="token punctuation">,</span> <span class="token string">'avatar'</span><span class="token punctuation">,</span> <span class="token string">'location'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<blockquote class="has-icon">
		<p class="note"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="90px" height="90px" viewBox="0 0 90 90" enable-background="new 0 0 90 90" xml:space="preserve"><path fill="#FFFFFF" d="M45 0C20.1 0 0 20.1 0 45s20.1 45 45 45 45-20.1 45-45S69.9 0 45 0zM45 74.5c-3.6 0-6.5-2.9-6.5-6.5s2.9-6.5 6.5-6.5 6.5 2.9 6.5 6.5S48.6 74.5 45 74.5zM52.1 23.9l-2.5 29.6c0 2.5-2.1 4.6-4.6 4.6 -2.5 0-4.6-2.1-4.6-4.6l-2.5-29.6c-0.1-0.4-0.1-0.7-0.1-1.1 0-4 3.2-7.2 7.2-7.2 4 0 7.2 3.2 7.2 7.2C52.2 23.1 52.2 23.5 52.1 23.9z"></path></svg></span></div> Dropping or modifying multiple columns within a single migration while using a SQLite database is not supported.</p>
	</blockquote>
	<h4>Available Command Aliases</h4>
	<table>
		<thead>
		<tr>
			<th>Command</th>
			<th>Description</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">dropRememberToken<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Drop the <code class=" language-php">remember_token</code> column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">dropSoftDeletes<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Drop the <code class=" language-php">deleted_at</code> column.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">dropSoftDeletesTz<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Alias of <code class=" language-php"><span class="token function">dropSoftDeletes<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code> method.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">dropTimestamps<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Drop the <code class=" language-php">created_at</code> and <code class=" language-php">updated_at</code> columns.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">dropTimestampsTz<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Alias of <code class=" language-php"><span class="token function">dropTimestamps<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code> method.</td>
		</tr>
		</tbody>
	</table>
	<p><a name="indexes"></a></p>
	<h2><a href="#indexes">Indexes</a></h2>
	<p><a name="creating-indexes"></a></p>
	<h3>Creating Indexes</h3>
	<p>The schema builder supports several types of indexes. First, let's look at an example that specifies a column's values should be unique. To create the index, we can chain the <code class=" language-php">unique</code> method onto the column definition:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">string<span class="token punctuation">(</span></span><span class="token string">'email'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">unique<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>Alternatively, you may create the index after defining the column. For example:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">unique<span class="token punctuation">(</span></span><span class="token string">'email'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>You may even pass an array of columns to an index method to create a compound (or composite) index:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">index<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'account_id'</span><span class="token punctuation">,</span> <span class="token string">'created_at'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>Space MVC will automatically generate a reasonable index name, but you may pass a second argument to the method to specify the name yourself:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">unique<span class="token punctuation">(</span></span><span class="token string">'email'</span><span class="token punctuation">,</span> <span class="token string">'unique_email'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Available Index Types</h4>
	<p>Each index method accepts an optional second argument to specify the name of the index. If omitted, the name will be derived from the names of the table and column(s).</p>
	<table>
		<thead>
		<tr>
			<th>Command</th>
			<th>Description</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">primary<span class="token punctuation">(</span></span><span class="token string">'id'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Adds a primary key.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">primary<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'id'</span><span class="token punctuation">,</span> <span class="token string">'parent_id'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Adds composite keys.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">unique<span class="token punctuation">(</span></span><span class="token string">'email'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Adds a unique index.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">index<span class="token punctuation">(</span></span><span class="token string">'state'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Adds a plain index.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">spatialIndex<span class="token punctuation">(</span></span><span class="token string">'location'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Adds a spatial index. (except SQLite)</td>
		</tr>
		</tbody>
	</table>
	<h4>Index Lengths &amp; MySQL / MariaDB</h4>
	<p>Space MVC uses the <code class=" language-php">utf8mb4</code> character set by default, which includes support for storing "emojis" in the database. If you are running a version of MySQL older than the 5.7.7 release or MariaDB older than the 10.2.2 release, you may need to manually configure the default string length generated by migrations in order for MySQL to create indexes for them. You may configure this by calling the <code class=" language-php"><span class="token scope">Schema<span class="token punctuation">::</span></span>defaultStringLength</code> method within your <code class=" language-php">AppServiceProvider</code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>Schema</span><span class="token punctuation">;</span>

<span class="token comment" spellcheck="true">/**
 * Bootstrap any application services.
 *
 * @return void
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">boot<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">defaultStringLength<span class="token punctuation">(</span></span><span class="token number">191</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p>Alternatively, you may enable the <code class=" language-php">innodb_large_prefix</code> option for your database. Refer to your database's documentation for instructions on how to properly enable this option.</p>
	<p><a name="renaming-indexes"></a></p>
	<h3>Renaming Indexes</h3>
	<p>To rename an index, you may use the <code class=" language-php">renameIndex</code> method. This method accepts the current index name as its first argument and the desired name as its second argument:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">renameIndex<span class="token punctuation">(</span></span><span class="token string">'from'</span><span class="token punctuation">,</span> <span class="token string">'to'</span><span class="token punctuation">)</span></code></pre>
	<p><a name="dropping-indexes"></a></p>
	<h3>Dropping Indexes</h3>
	<p>To drop an index, you must specify the index's name. By default, Space MVC automatically assigns a reasonable name to the indexes. Concatenate the table name, the name of the indexed column, and the index type. Here are some examples:</p>
	<table>
		<thead>
		<tr>
			<th>Command</th>
			<th>Description</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">dropPrimary<span class="token punctuation">(</span></span><span class="token string">'users_id_primary'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Drop a primary key from the "users" table.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">dropUnique<span class="token punctuation">(</span></span><span class="token string">'users_email_unique'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Drop a unique index from the "users" table.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">dropIndex<span class="token punctuation">(</span></span><span class="token string">'geo_state_index'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Drop a basic index from the "geo" table.</td>
		</tr>
		<tr>
			<td><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">dropSpatialIndex<span class="token punctuation">(</span></span><span class="token string">'geo_location_spatialindex'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></td>
			<td>Drop a spatial index from the "geo" table  (except SQLite).</td>
		</tr>
		</tbody>
	</table>
	<p>If you pass an array of columns into a method that drops indexes, the conventional index name will be generated based on the table name, columns and key type:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'geo'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span>Blueprint <span class="token variable">$table</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">dropIndex<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'state'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span><span class="token comment" spellcheck="true"> // Drops index 'geo_state_index'
</span><span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="foreign-key-constraints"></a></p>
	<h3>Foreign Key Constraints</h3>
	<p>Space MVC also provides support for creating foreign key constraints, which are used to force referential integrity at the database level. For example, let's define a <code class=" language-php">user_id</code> column on the <code class=" language-php">posts</code> table that references the <code class=" language-php">id</code> column on a <code class=" language-php">users</code> table:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'posts'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span>Blueprint <span class="token variable">$table</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">unsignedInteger<span class="token punctuation">(</span></span><span class="token string">'user_id'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

    <span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">foreign<span class="token punctuation">(</span></span><span class="token string">'user_id'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">references<span class="token punctuation">(</span></span><span class="token string">'id'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">on<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>You may also specify the desired action for the "on delete" and "on update" properties of the constraint:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">foreign<span class="token punctuation">(</span></span><span class="token string">'user_id'</span><span class="token punctuation">)</span>
      <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">references<span class="token punctuation">(</span></span><span class="token string">'id'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">on<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span>
      <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">onDelete<span class="token punctuation">(</span></span><span class="token string">'cascade'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>To drop a foreign key, you may use the <code class=" language-php">dropForeign</code> method. Foreign key constraints use the same naming convention as indexes. So, we will concatenate the table name and the columns in the constraint then suffix the name with "_foreign":</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">dropForeign<span class="token punctuation">(</span></span><span class="token string">'posts_user_id_foreign'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>Or, you may pass an array value which will automatically use the conventional constraint name when dropping:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$table</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">dropForeign<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'user_id'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>You may enable or disable foreign key constraints within your migrations by using the following methods:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">enableForeignKeyConstraints<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token scope">Schema<span class="token punctuation">::</span></span><span class="token function">disableForeignKeyConstraints<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<blockquote class="has-icon">
		<p class="note"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="90px" height="90px" viewBox="0 0 90 90" enable-background="new 0 0 90 90" xml:space="preserve"><path fill="#FFFFFF" d="M45 0C20.1 0 0 20.1 0 45s20.1 45 45 45 45-20.1 45-45S69.9 0 45 0zM45 74.5c-3.6 0-6.5-2.9-6.5-6.5s2.9-6.5 6.5-6.5 6.5 2.9 6.5 6.5S48.6 74.5 45 74.5zM52.1 23.9l-2.5 29.6c0 2.5-2.1 4.6-4.6 4.6 -2.5 0-4.6-2.1-4.6-4.6l-2.5-29.6c-0.1-0.4-0.1-0.7-0.1-1.1 0-4 3.2-7.2 7.2-7.2 4 0 7.2 3.2 7.2 7.2C52.2 23.1 52.2 23.5 52.1 23.9z"></path></svg></span></div> SQLite disables foreign key constraints by default. When using SQLite, make sure to <a href="/docs/5.7/database#configuration">enable foreign key support</a> in your database configuration before attempting to create them in your migrations.</p>
	</blockquote>
</article>