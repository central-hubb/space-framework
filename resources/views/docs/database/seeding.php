<article>
	<h1>Database: Seeding</h1>
	<ul>
		<li><a href="#introduction">Introduction</a></li>
		<li><a href="#writing-seeders">Writing Seeders</a>
			<ul>
				<li><a href="#using-model-factories">Using Model Factories</a></li>
				<li><a href="#calling-additional-seeders">Calling Additional Seeders</a></li>
			</ul></li>
		<li><a href="#running-seeders">Running Seeders</a></li>
	</ul>
	<p><a name="introduction"></a></p>
	<h2><a href="#introduction">Introduction</a></h2>
	<p>Laravel includes a simple method of seeding your database with test data using seed classes. All seed classes are stored in the <code class=" language-php">database<span class="token operator">/</span>seeds</code> directory. Seed classes may have any name you wish, but probably should follow some sensible convention, such as <code class=" language-php">UsersTableSeeder</code>, etc. By default, a <code class=" language-php">DatabaseSeeder</code> class is defined for you. From this class, you may use the <code class=" language-php">call</code> method to run other seed classes, allowing you to control the seeding order.</p>
	<p><a name="writing-seeders"></a></p>
	<h2><a href="#writing-seeders">Writing Seeders</a></h2>
	<p>To generate a seeder, execute the <code class=" language-php">make<span class="token punctuation">:</span>seeder</code> <a href="/docs/5.7/artisan">Artisan command</a>. All seeders generated by the framework will be placed in the <code class=" language-php">database<span class="token operator">/</span>seeds</code> directory:</p>
	<pre class=" language-php"><code class=" language-php">php artisan make<span class="token punctuation">:</span>seeder UsersTableSeeder</code></pre>
	<p>A seeder class only contains one method by default: <code class=" language-php">run</code>. This method is called when the <code class=" language-php">db<span class="token punctuation">:</span>seed</code> <a href="/docs/5.7/artisan">Artisan command</a> is executed. Within the <code class=" language-php">run</code> method, you may insert data into your database however you wish. You may use the <a href="/docs/5.7/queries">query builder</a> to manually insert data or you may use <a href="/docs/5.7/database-testing#writing-factories">Eloquent model factories</a>.</p>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> <a href="/docs/5.7/eloquent#mass-assignment">Mass assignment protection</a> is automatically disabled during database seeding.</p>
	</blockquote>
	<p>As an example, let's modify the default <code class=" language-php">DatabaseSeeder</code> class and add a database insert statement to the <code class=" language-php">run</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Database<span class="token punctuation">\</span>Seeder</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>DB</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">DatabaseSeeder</span> <span class="token keyword">extends</span> <span class="token class-name">Seeder</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Run the database seeds.
     *
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">run<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token scope">DB<span class="token punctuation">::</span></span><span class="token function">table<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">insert<span class="token punctuation">(</span></span><span class="token punctuation">[</span>
            <span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">str_random<span class="token punctuation">(</span></span><span class="token number">10</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
            <span class="token string">'email'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">str_random<span class="token punctuation">(</span></span><span class="token number">10</span><span class="token punctuation">)</span><span class="token punctuation">.</span><span class="token string">'@gmail.com'</span><span class="token punctuation">,</span>
            <span class="token string">'password'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">bcrypt<span class="token punctuation">(</span></span><span class="token string">'secret'</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
        <span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> You may type-hint any dependencies you need within the <code class=" language-php">run</code> method's signature. They will automatically be resolved via the Laravel <a href="/docs/5.7/container">service container</a>.</p>
	</blockquote>
	<p><a name="using-model-factories"></a></p>
	<h3>Using Model Factories</h3>
	<p>Of course, manually specifying the attributes for each model seed is cumbersome. Instead, you can use <a href="/docs/5.7/database-testing#writing-factories">model factories</a> to conveniently generate large amounts of database records. First, review the <a href="/docs/5.7/database-testing#writing-factories">model factory documentation</a> to learn how to define your factories. Once you have defined your factories, you may use the <code class=" language-php">factory</code> helper function to insert records into your database.</p>
	<p>For example, let's create 50 users and attach a relationship to each user:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Run the database seeds.
 *
 * @return void
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">run<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token function">factory<span class="token punctuation">(</span></span><span class="token scope">App<span class="token punctuation">\</span>User<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span> <span class="token number">50</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">create<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">each<span class="token punctuation">(</span></span><span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$u</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
        <span class="token variable">$u</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">posts<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">save<span class="token punctuation">(</span></span><span class="token function">factory<span class="token punctuation">(</span></span><span class="token scope">App<span class="token punctuation">\</span>Post<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">make<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="calling-additional-seeders"></a></p>
	<h3>Calling Additional Seeders</h3>
	<p>Within the <code class=" language-php">DatabaseSeeder</code> class, you may use the <code class=" language-php">call</code> method to execute additional seed classes. Using the <code class=" language-php">call</code> method allows you to break up your database seeding into multiple files so that no single seeder class becomes overwhelmingly large. Pass the name of the seeder class you wish to run:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Run the database seeds.
 *
 * @return void
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">run<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">call<span class="token punctuation">(</span></span><span class="token punctuation">[</span>
        <span class="token scope">UsersTableSeeder<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
        <span class="token scope">PostsTableSeeder<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
        <span class="token scope">CommentsTableSeeder<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="running-seeders"></a></p>
	<h2><a href="#running-seeders">Running Seeders</a></h2>
	<p>Once you have written your seeder, you may need to regenerate Composer's autoloader using the <code class=" language-php">dump<span class="token operator">-</span>autoload</code> command:</p>
	<pre class=" language-php"><code class=" language-php">composer dump<span class="token operator">-</span>autoload</code></pre>
	<p>Now you may use the <code class=" language-php">db<span class="token punctuation">:</span>seed</code> Artisan command to seed your database. By default, the <code class=" language-php">db<span class="token punctuation">:</span>seed</code> command runs the <code class=" language-php">DatabaseSeeder</code> class, which may be used to call other seed classes. However, you may use the <code class=" language-php"><span class="token operator">--</span><span class="token keyword">class</span></code> option to specify a specific seeder class to run individually:</p>
	<pre class=" language-php"><code class=" language-php">php artisan db<span class="token punctuation">:</span>seed

php artisan db<span class="token punctuation">:</span>seed <span class="token operator">--</span><span class="token keyword">class</span><span class="token operator">=</span>UsersTableSeeder</code></pre>
	<p>You may also seed your database using the <code class=" language-php">migrate<span class="token punctuation">:</span>refresh</code> command, which will also rollback and re-run all of your migrations. This command is useful for completely re-building your database:</p>
	<pre class=" language-php"><code class=" language-php">php artisan migrate<span class="token punctuation">:</span>refresh <span class="token operator">--</span>seed</code></pre>
</article>