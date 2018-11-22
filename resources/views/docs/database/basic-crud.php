<div class="wiki">
	<h2 id="Basic-CRUD">Database : Basic CRUD</h2>


	<ul id="topic-list">
		<li><a href="/docs/database/basic-crud#create">Create</a></li>
		<li><a href="/docs/database/basic-crud#read">Read</a></li>
		<li><a href="/docs/database/basic-crud#update">Update</a></li>
		<li><a href="/docs/database/basic-crud#delete">Delete</a></li>
		<li><a href="/docs/database/basic-crud#massive">Massive</a></li>
	</ul>


	<p><a href="http://en.wikipedia.org/wiki/Create,_read,_update_and_delete" class="external">CRUD</a> as defined by Wikipedia:</p>


	<blockquote>

		<p>Create, read, update and delete (CRUD) are the four basic functions of persistent storage, a major part of nearly all computer software. Sometimes CRUD is expanded with the words retrieve instead of read or destroy instead of delete. It is also sometimes used to describe user interface conventions that facilitate viewing, searching, and changing information; often using computer-based forms and reports.</p>


	</blockquote>

	<p>In other words, CRUD is the day-to-day tedium of saving and reading data. ActiveRecord removes the remedial and encumbering task of hand-writing SQL queries. Instead, you will only need to write the relevant parts to work with your data.</p>


	<h4 id="create">Create</h4>


	<p>This is where you save records to your database. Here we create a new post by instantiating a new object and then invoking the save() method.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no"> 1</span> <span class="lv">$post</span> = <span class="r">new</span> <span class="co">Post</span>();
<span class="no"> 2</span> <span class="lv">$post</span>-&gt;title = <span class="s"><span class="dl">'</span><span class="k">My first blog post!!</span><span class="dl">'</span></span>;
<span class="no"> 3</span> <span class="lv">$post</span>-&gt;author_id = <span class="i">5</span>;
<span class="no"> 4</span> <span class="lv">$post</span>-&gt;save();
<span class="no"> 5</span> <span class="c"># INSERT INTO `posts` (title,author_id) VALUES('My first blog post!!', 5)</span>
<span class="no"> 6</span>
<span class="no"> 7</span> <span class="c"># the below methods accomplish the same thing</span>
<span class="no"> 8</span>
<span class="no"> 9</span> <span class="lv">$attributes</span> = <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">title</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">My first blog post!!</span><span class="dl">'</span></span>, <span class="s"><span class="dl">'</span><span class="k">author_id</span><span class="dl">'</span></span> =&gt; <span class="i">5</span>);
<span class="no"><strong>10</strong></span> <span class="lv">$post</span> = <span class="r">new</span> <span class="co">Post</span>(<span class="lv">$attributes</span>);
<span class="no">11</span> <span class="lv">$post</span>-&gt;save();
<span class="no">12</span> <span class="c"># same sql as above</span>
<span class="no">13</span>
<span class="no">14</span> <span class="lv">$post</span> = <span class="co">Post</span>::create(<span class="lv">$attributes</span>);
<span class="no">15</span> <span class="c"># same sql as above</span>
</span></code></pre>

	<h4 id="read">Read</h4>


	<p>These are your basic methods to find and retrieve records from your database. See the <a href="/docs/database/finders" class="wiki-page">Finders</a> section for more details.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no"> 1</span> <span class="lv">$post</span> = <span class="co">Post</span>::find(<span class="i">1</span>);
<span class="no"> 2</span> <span class="pd">echo</span> <span class="lv">$post</span>-&gt;title; <span class="c"># 'My first blog post!!'</span>
<span class="no"> 3</span> <span class="pd">echo</span> <span class="lv">$post</span>-&gt;author_id; <span class="c"># 5</span>
<span class="no"> 4</span>
<span class="no"> 5</span> <span class="c"># also the same since it is the first record in the db</span>
<span class="no"> 6</span> <span class="lv">$post</span> = <span class="co">Post</span>::first();
<span class="no"> 7</span>
<span class="no"> 8</span> <span class="c"># using dynamic finders</span>
<span class="no"> 9</span> <span class="lv">$post</span> = <span class="co">Post</span>::find_by_name(<span class="s"><span class="dl">'</span><span class="k">The Decider</span><span class="dl">'</span></span>);
<span class="no"><strong>10</strong></span> <span class="lv">$post</span> = <span class="co">Post</span>::find_by_name_and_id(<span class="s"><span class="dl">'</span><span class="k">The Bridge Builder</span><span class="dl">'</span></span>,<span class="i">100</span>);
<span class="no">11</span> <span class="lv">$post</span> = <span class="co">Post</span>::find_by_name_or_id(<span class="s"><span class="dl">'</span><span class="k">The Bridge Builder</span><span class="dl">'</span></span>,<span class="i">100</span>);
<span class="no">12</span>
<span class="no">13</span> <span class="c"># using some conditions</span>
<span class="no">14</span> <span class="lv">$posts</span> = <span class="co">Post</span>::find(<span class="s"><span class="dl">'</span><span class="k">all</span><span class="dl">'</span></span>,<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">conditions</span><span class="dl">'</span></span> =&gt; <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">name=?</span><span class="dl">'</span></span>,<span class="s"><span class="dl">'</span><span class="k">The Bridge Builder</span><span class="dl">'</span></span>)));
</span></code></pre>

	<h4 id="update">Update</h4>


	<p>To update you would just need to find a record first and then change one of its attributes. It keeps an array of attributes that are "dirty" (that have been modified) and so our sql will only update the fields modified.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="lv">$post</span> = <span class="co">Post</span>::find(<span class="i">1</span>);
<span class="no">2</span> <span class="pd">echo</span> <span class="lv">$post</span>-&gt;title; <span class="c"># 'My first blog post!!'</span>
<span class="no">3</span> <span class="lv">$post</span>-&gt;title = <span class="s"><span class="dl">'</span><span class="k">Some real title</span><span class="dl">'</span></span>;
<span class="no">4</span> <span class="lv">$post</span>-&gt;save();
<span class="no">5</span> <span class="c"># UPDATE `posts` SET title='Some real title' WHERE id=1</span>
<span class="no">6</span>
<span class="no">7</span> <span class="lv">$post</span>-&gt;update_attributes(<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">title</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">Some other title</span><span class="dl">'</span></span>, <span class="s"><span class="dl">'</span><span class="k">author_id</span><span class="dl">'</span></span> =&gt; <span class="i">1</span>));
<span class="no">8</span> <span class="c"># UPDATE `posts` SET title='Some other title', author_id=1 WHERE id=1</span>
</span></code></pre>

	<h4 id="delete">Delete</h4>


	<p>Deleting a record will not destroy the object. This means that it will call sql to delete the record in your database, however, you can still use the object.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="lv">$post</span> = <span class="co">Post</span>::find(<span class="i">1</span>);
<span class="no">2</span> <span class="lv">$post</span>-&gt;<span class="pd">delete</span>();
<span class="no">3</span> <span class="c"># DELETE FROM `posts` WHERE id=1</span>
<span class="no">4</span>
<span class="no">5</span> <span class="pd">echo</span> <span class="lv">$post</span>-&gt;title; <span class="c"># Some other title</span>
</span></code></pre>

	<h4 id="massive">Massive Update or Delete</h4>


	<p>You can do a massive update or massive delete easily. Look at this example:</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no"> 1</span> <span class="c"># MASSIVE UPDATE</span>
<span class="no"> 2</span> <span class="c"># Model::table()-&gt;update(AttributesToUpdate, WhereToUpdate);</span>
<span class="no"> 3</span> <span class="co">Post</span>::table()-&gt;update(<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">title</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">Massive title!</span><span class="dl">'</span></span>, <span class="c">/* Other attributes... */</span>, <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">id</span><span class="dl">'</span></span> =&gt; <span class="pd">array</span>(<span class="i">1</span>, <span class="i">3</span>, <span class="i">7</span>));
<span class="no"> 4</span> <span class="c"># UPDATE `posts` SET title = `Massive title!` WHERE id IN (1, 3, 7)</span>
<span class="no"> 5</span>
<span class="no"> 6</span> <span class="c"># MASSIVE DELETE</span>
<span class="no"> 7</span> <span class="c"># Model::table()-&gt;delete(WhereToDelete);</span>
<span class="no"> 8</span> <span class="co">Post</span>::table()-&gt;<span class="pd">delete</span>(<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">id</span><span class="dl">'</span></span> =&gt; <span class="pd">array</span>(<span class="i">5</span>, <span class="i">9</span>, <span class="i">26</span>, <span class="i">30</span>));
<span class="no"> 9</span> <span class="c"># DELETE FROM `posts` WHERE id IN (5, 9, 26, 30)</span>
</span></code></pre>
</div>