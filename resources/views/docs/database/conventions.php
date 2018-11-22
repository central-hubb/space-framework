<div class="wiki">
	<h2 id="Conventions">Conventions</h2>


	<p>Because we have embraced a convention over configuration philosophy, using our library is not painful. The conventions are easy to remember which will also contribute to stream-lining your productivity as a developer.</p>


	<p>If you've already seen the <a href="/docs/database/configuration" class="wiki-page">Configuration / Setup</a> guide, then you know that there isn't much to it. Therefore, using PHP ActiveRecord mainly requires you to acquaint yourself with some simple conventions. Once you've done that, you can move on to the more advanced features.</p>


	<p>ActiveRecord assumes the following conventions:</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="c"># name of your class represents the singular form of your table name.</span>
<span class="no">2</span> <span class="r">class</span> <span class="cl">Book</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span> {}
<span class="no">3</span>
<span class="no">4</span> <span class="c"># your table name would be "people" </span>
<span class="no">5</span> <span class="r">class</span> <span class="cl">Person</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span> {}
</span></code></pre>

	<p>The primary key of your table is named "id".</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="r">class</span> <span class="cl">Book</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span> {}
<span class="no">2</span>
<span class="no">3</span> <span class="c"># SELECT * FROM `books` where id = 1</span>
<span class="no">4</span> <span class="co">Book</span>::find(<span class="i">1</span>);
</span></code></pre>

	<h4>Overriding conventions</h4>


	<p>Even through ActiveRecord prefers to make assumptions about your table and primary key names, you can override them. Here is a simple example showing how one could configure a specific model.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no"> 1</span> <span class="r">class</span> <span class="cl">Book</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span>
<span class="no"> 2</span> {
<span class="no"> 3</span>   <span class="c"># explicit table name since our table is not "books" </span>
<span class="no"> 4</span>   <span class="r">static</span> <span class="lv">$table_name</span> = <span class="s"><span class="dl">'</span><span class="k">my_book</span><span class="dl">'</span></span>;
<span class="no"> 5</span>
<span class="no"> 6</span>   <span class="c"># explicit pk since our pk is not "id" </span>
<span class="no"> 7</span>   <span class="r">static</span> <span class="lv">$primary_key</span> = <span class="s"><span class="dl">'</span><span class="k">book_id</span><span class="dl">'</span></span>;
<span class="no"> 8</span>
<span class="no"> 9</span>   <span class="c"># explicit connection name since we always want our test db with this model</span>
<span class="no"><strong>10</strong></span>   <span class="r">static</span> <span class="lv">$connection</span> = <span class="s"><span class="dl">'</span><span class="k">test</span><span class="dl">'</span></span>;
<span class="no">11</span>
<span class="no">12</span>   <span class="c"># explicit database name will generate sql like so =&gt; my_db.my_book</span>
<span class="no">13</span>   <span class="r">static</span> <span class="lv">$db</span> = <span class="s"><span class="dl">'</span><span class="k">my_db</span><span class="dl">'</span></span>;
<span class="no">14</span> }
</span></code></pre>
</div>