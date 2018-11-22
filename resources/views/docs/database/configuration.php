<div class="wiki">
	<h2 id="Configuration-Setup">Database : Configuration</h2>


	<ul id="topic-list">
		<li><a href="/docs/database/configuration#default-connection">Default connection</a></li>
		<li><a href="/docs/database/configuration#multi-connections">Multi-connections</a></li>
		<li><a href="/docs/database/configuration#encoding">Setting the encoding</a></li>
	</ul>


	<p>Setup is very easy and straight-forward. There are essentially only two configuration points you must concern yourself with:</p>


	<ol>
		<li>Setting the model auto_load directory.</li>
		<li>Configuring your database connections.</li>
	</ol>


	<p>By setting the model auto_load directory, you are telling PHP where to look for your model classes. This means that you can have an app/folder structure of your choice as long as you have a real directory that holds your model classes. Each class should have it's own php file that is the same name of the class with a .php extension of course.</p>


	<p>There are two ways you can initialize your configuration options. The easiest path is wrapping the calls in a closure which is sent through the Config initializer method. This is a neat and clean way to take advantage of PHP's new closure feature.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no"> 1</span> <span class="c"># inclue the ActiveRecord library</span>
<span class="no"> 2</span> <span class="pd">require_once</span> <span class="s"><span class="dl">'</span><span class="k">php-activerecord/ActiveRecord.php</span><span class="dl">'</span></span>;
<span class="no"> 3</span>
<span class="no"> 4</span> <span class="co">ActiveRecord</span>\<span class="co">Config</span>::initialize(<span class="r">function</span>(<span class="lv">$cfg</span>)
<span class="no"> 5</span> {
<span class="no"> 6</span>   <span class="lv">$cfg</span>-&gt;set_model_directory(<span class="s"><span class="dl">'</span><span class="k">/path/to/your/model_directory</span><span class="dl">'</span></span>);
<span class="no"> 7</span>   <span class="lv">$cfg</span>-&gt;set_connections(<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">development</span><span class="dl">'</span></span> =&gt;
<span class="no"> 8</span>     <span class="s"><span class="dl">'</span><span class="k">mysql://username:password@localhost/database_name</span><span class="dl">'</span></span>));
<span class="no"> 9</span> });
</span></code></pre>

	<p>That's it! ActiveRecord takes care of the rest for you. It does not require that you map your table schema to yaml/xml files. It will query the database for this information and cache it so that it does not make multiple calls to the database for a single schema.</p>


	<p>If you aren't feeling fancy, you can drop the closure and access the ActiveRecord\Config singleton directly.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="lv">$cfg</span> = <span class="co">ActiveRecord</span>\<span class="co">Config</span>::instance();
<span class="no">2</span> <span class="lv">$cfg</span>-&gt;set_model_directory(<span class="s"><span class="dl">'</span><span class="k">/path/to/your/model_directory</span><span class="dl">'</span></span>);
<span class="no">3</span> <span class="lv">$cfg</span>-&gt;set_connections(<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">development</span><span class="dl">'</span></span> =&gt;
<span class="no">4</span>   <span class="s"><span class="dl">'</span><span class="k">mysql://username:password@localhost/database_name</span><span class="dl">'</span></span>));
</span></code></pre>

	<h4 id="default-connections">Default connection</h4>


	<p>The development connection is the default by convention. You can change this by setting a new default connection based off of one of the connections you passed to set_connections.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no"> 1</span> <span class="lv">$connections</span> = <span class="pd">array</span>(
<span class="no"> 2</span>   <span class="s"><span class="dl">'</span><span class="k">development</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">mysql://username:password@localhost/development</span><span class="dl">'</span></span>,
<span class="no"> 3</span>   <span class="s"><span class="dl">'</span><span class="k">production</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">mysql://username:password@localhost/production</span><span class="dl">'</span></span>,
<span class="no"> 4</span>   <span class="s"><span class="dl">'</span><span class="k">test</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">mysql://username:password@localhost/test</span><span class="dl">'</span></span>
<span class="no"> 5</span> );
<span class="no"> 6</span>
<span class="no"> 7</span> <span class="c"># must issue a "use" statement in your closure if passing variables</span>
<span class="no"> 8</span> <span class="co">ActiveRecord</span>\<span class="co">Config</span>::initialize(<span class="r">function</span>(<span class="lv">$cfg</span>) <span class="r">use</span> (<span class="lv">$connections</span>)
<span class="no"> 9</span> {
<span class="no"><strong>10</strong></span>   <span class="lv">$cfg</span>-&gt;set_model_directory(<span class="s"><span class="dl">'</span><span class="k">/path/to/your/model_directory</span><span class="dl">'</span></span>);
<span class="no">11</span>   <span class="lv">$cfg</span>-&gt;set_connections(<span class="lv">$connections</span>);
<span class="no">12</span>
<span class="no">13</span>   <span class="c"># default connection is now production</span>
<span class="no">14</span>   <span class="lv">$cfg</span>-&gt;set_default_connection(<span class="s"><span class="dl">'</span><span class="k">production</span><span class="dl">'</span></span>);
<span class="no">15</span> });
</span></code></pre>

	<h4 id="multi-connections">Multi-connections</h4>


	<p>You can easily configure ActiveRecord to accept multiple database connections. All you have to do is specify the connection in the given model that should be using a different database.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no"> 1</span> <span class="lv">$connections</span> = <span class="pd">array</span>(
<span class="no"> 2</span>   <span class="s"><span class="dl">'</span><span class="k">development</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">mysql://username:password@localhost/development</span><span class="dl">'</span></span>,
<span class="no"> 3</span>   <span class="s"><span class="dl">'</span><span class="k">pgsql</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">pgsql://username:password@localhost/development</span><span class="dl">'</span></span>,
<span class="no"> 4</span>   <span class="s"><span class="dl">'</span><span class="k">sqlite</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">sqlite://my_database.db</span><span class="dl">'</span></span>,
<span class="no"> 5</span>   <span class="s"><span class="dl">'</span><span class="k">oci</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">oci://username:passsword@localhost/xe</span><span class="dl">'</span></span>
<span class="no"> 6</span> );
<span class="no"> 7</span>
<span class="no"> 8</span> <span class="c"># must issue a "use" statement in your closure if passing variables</span>
<span class="no"> 9</span> <span class="co">ActiveRecord</span>\<span class="co">Config</span>::initialize(<span class="r">function</span>(<span class="lv">$cfg</span>) <span class="r">use</span> (<span class="lv">$connections</span>)
<span class="no"><strong>10</strong></span> {
<span class="no">11</span>   <span class="lv">$cfg</span>-&gt;set_model_directory(<span class="s"><span class="dl">'</span><span class="k">/path/to/your/model_directory</span><span class="dl">'</span></span>);
<span class="no">12</span>   <span class="lv">$cfg</span>-&gt;set_connections(<span class="lv">$connections</span>);
<span class="no">13</span> });
</span></code></pre>

	<p>Your models would look like the following.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no"> 1</span> <span class="c"># SomeOciModel.php</span>
<span class="no"> 2</span> <span class="r">class</span> <span class="cl">SomeOciModel</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span>
<span class="no"> 3</span> {
<span class="no"> 4</span>   <span class="r">static</span> <span class="lv">$connection</span> = <span class="s"><span class="dl">'</span><span class="k">oci</span><span class="dl">'</span></span>;
<span class="no"> 5</span> }
<span class="no"> 6</span>
<span class="no"> 7</span> <span class="c"># SomeSqliteModel.php</span>
<span class="no"> 8</span> <span class="r">class</span> <span class="cl">SomeSqliteModel</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span>
<span class="no"> 9</span> {
<span class="no"><strong>10</strong></span>   <span class="r">static</span> <span class="lv">$connection</span> = <span class="s"><span class="dl">'</span><span class="k">sqlite</span><span class="dl">'</span></span>;
<span class="no">11</span> }
</span></code></pre>

	<p>You could also have a base 'connection' model so all sub-classes will inherit the db setting.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no"> 1</span> <span class="c"># OciModels.php</span>
<span class="no"> 2</span> <span class="r">abstract</span> <span class="r">class</span> <span class="cl">OciModels</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span>
<span class="no"> 3</span> {
<span class="no"> 4</span>   <span class="r">static</span> <span class="lv">$connection</span> = <span class="s"><span class="dl">'</span><span class="k">oci</span><span class="dl">'</span></span>;
<span class="no"> 5</span> }
<span class="no"> 6</span>
<span class="no"> 7</span> <span class="c"># AnotherOciModel.php</span>
<span class="no"> 8</span> <span class="r">class</span> <span class="cl">AnotherOciModel</span> <span class="r">extends</span> <span class="co">OciModels</span>
<span class="no"> 9</span> {
<span class="no"><strong>10</strong></span>    <span class="c"># automatically inherits the oci database</span>
<span class="no">11</span> }
</span></code></pre>

	<h4 id="encoding">Setting the encoding</h4>


	<p>The character encoding can be specified in your connection parameters:</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="lv">$config</span>-&gt;set_connections(<span class="pd">array</span>(
<span class="no">2</span>   <span class="s"><span class="dl">'</span><span class="k">development</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">mysql://user:pass@localhost/mydb?charset=utf8</span><span class="dl">'</span></span>)
<span class="no">3</span> );
</span></code></pre>
</div>