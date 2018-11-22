<div class="wiki">

	<h1>Database : ORM</h1>

	<h3 id="Quick-Start">Getting Started</h3>

	<p>This guide will show you the bare essentials to get up and running with php-activerecord. I will assume you have downloaded the library into your include_path in a directory called php-activerecord.</p>

	<p>The first steps are to include the library and define our database connection:</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="pd">require_once</span> <span class="s"><span class="dl">'</span><span class="k">php-activerecord/ActiveRecord.php</span><span class="dl">'</span></span>;
<span class="no">2</span>
<span class="no">3</span> <span class="co">ActiveRecord</span>\<span class="co">Config</span>::initialize(<span class="r">function</span>(<span class="lv">$cfg</span>)
<span class="no">4</span> {
<span class="no">5</span>     <span class="lv">$cfg</span>-&gt;set_model_directory(<span class="s"><span class="dl">'</span><span class="k">models</span><span class="dl">'</span></span>);
<span class="no">6</span>     <span class="lv">$cfg</span>-&gt;set_connections(<span class="pd">array</span>(
<span class="no">7</span>         <span class="s"><span class="dl">'</span><span class="k">development</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">mysql://username:password@localhost/database_name</span><span class="dl">'</span></span>));
<span class="no">8</span> });
</span></code></pre>

	<p>Next, lets create a model for a table called users. We'll save this class in the file models/User.php</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="r">class</span> <span class="cl">User</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span>
<span class="no">2</span> {
<span class="no">3</span> }
</span></code></pre>

	<p>That's it! Now you can access the users table thru the User model.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no"> 1</span> <span class="c"># create Tito</span>
<span class="no"> 2</span> <span class="lv">$user</span> = <span class="co">User</span>::create(<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">name</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">Tito</span><span class="dl">'</span></span>, <span class="s"><span class="dl">'</span><span class="k">state</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">VA</span><span class="dl">'</span></span>));
<span class="no"> 3</span>
<span class="no"> 4</span> <span class="c"># read Tito</span>
<span class="no"> 5</span> <span class="lv">$user</span> = <span class="co">User</span>::find_by_name(<span class="s"><span class="dl">'</span><span class="k">Tito</span><span class="dl">'</span></span>);
<span class="no"> 6</span>
<span class="no"> 7</span> <span class="c"># update Tito</span>
<span class="no"> 8</span> <span class="lv">$user</span>-&gt;name = <span class="s"><span class="dl">'</span><span class="k">Tito Jr</span><span class="dl">'</span></span>;
<span class="no"> 9</span> <span class="lv">$user</span>-&gt;save();
<span class="no"><strong>10</strong></span>
<span class="no">11</span> <span class="c"># delete Tito</span>
<span class="no">12</span> <span class="lv">$user</span>-&gt;<span class="pd">delete</span>();
</span></code></pre>

	<p>That's it! Pretty simple.</p>
</div>