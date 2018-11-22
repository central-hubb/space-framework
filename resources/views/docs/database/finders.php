<div class="wiki">
	<h2 id="Finders">Database : Finders</h2>


	<ul id="topic-list">
		<li><a href="/docs/database/finders#single-record-result">Single record result</a></li>
		<li><a href="/docs/database/finders#multiple-records-result">Multiple records result</a></li>
		<li><a href="/docs/database/finders#finder-options">Finder options</a></li>
		<li><a href="/docs/database/finders#conditions">Conditions</a></li>
		<li><a href="/docs/database/finders#limit-offset">Limit &amp; Offset</a></li>
		<li><a href="/docs/database/finders#order">Order</a></li>
		<li><a href="/docs/database/finders#select">Select</a></li>
		<li><a href="/docs/database/finders#from">From</a></li>
		<li><a href="/docs/database/finders#group">Group</a></li>
		<li><a href="/docs/database/finders#having">Having</a></li>
		<li><a href="/docs/database/finders#read-only">Read only</a></li>
		<li><a href="/docs/database/finders#dynamic-finders">Dynamic finders</a></li>
		<li><a href="/docs/database/finders#joins">Joins</a></li>
		<li><a href="/docs/database/finders#find-by-custom-sql">Find by custom SQL</a></li>
		<li><a href="/docs/database/finders#eager-loading">Eager loading associations</a></li>
	</ul>


	<p>ActiveRecord supports a number of methods by which you can find records such as: via primary key, dynamic field name finders. It has the ability to fetch all the records in a table with a simple call, or you can make use of options like order, limit, select, and group.</p>


	<p>There are essentially two groups of finders you will be working with: <a href="/docs/database/finders#single-record-result">a single record result</a> and <a href="/docs/database/finders#multiple-records-result">multiple records result</a>. Sometimes there will be little transparency for the method calls, meaning you may use the same method to get either one, but you will pass an option to that method to signify which type of result you will fetch.</p>


	<p>All methods used to fetch records from your database will go through <strong>Model::find()</strong>, with one exception, custom sql can be passed to <a href="/docs/database/finders#find-by-custom-sql">Model::find_by_sql()</a>. In all cases, the finder methods in ActiveRecord are statically invoked. This means you will always use the following type of syntax.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="r">class</span> <span class="cl">Book</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span> {}
<span class="no">2</span> 
<span class="no">3</span> <span class="co">Book</span>::find(<span class="s"><span class="dl">'</span><span class="k">all</span><span class="dl">'</span></span>);
<span class="no">4</span> <span class="co">Book</span>::find(<span class="s"><span class="dl">'</span><span class="k">last</span><span class="dl">'</span></span>);
<span class="no">5</span> <span class="co">Book</span>::first();
<span class="no">6</span> <span class="co">Book</span>::last();
<span class="no">7</span> <span class="co">Book</span>::all();
</span></code></pre>

	<h4 id="single-record-result">Single record result</h4>


	<p>Whenever you invoke a method which produces a single result, that method will return an instance of your model class. There are 3 different ways to fetch a single record result. We'll start with one of the most basic forms.</p>


	<h4>Find by primary key</h4>


	<p>You can grab a record by passing a primary key to the find method. You may pass an <a href="/docs/database/finders#finder-options">options array</a> as the second argument for creating specific queries. If no record is found, a RecordNotFound exception will be thrown.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="c"># Grab the book with the primary key of 2</span>
<span class="no">2</span> <span class="co">Book</span>::find(<span class="i">2</span>);
<span class="no">3</span> <span class="c"># sql =&gt; SELECT * FROM `books` WHERE id = 2</span>
</span></code></pre>

	<h4>Find first</h4>


	<p>You can get the first record back from your database two ways. If you do not pass conditions as the second argument, then this method will fetch all the results from your database, but will only return the very first result back to you. Null will be returned if no records are found.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="c"># Grab all books, but only return the first result back as your model object.</span>
<span class="no">2</span> <span class="lv">$book</span> = <span class="co">Book</span>::first();
<span class="no">3</span> <span class="pd">echo</span> <span class="s"><span class="dl">"</span><span class="k">the first id is: </span><span class="il"><span class="dl">{</span><span class="lv">$book</span>-&gt;id<span class="dl">}</span></span><span class="dl">"</span></span> <span class="c"># =&gt; the first id is: 1</span>
<span class="no">4</span> <span class="c"># sql =&gt; SELECT * FROM `books`</span>
<span class="no">5</span> 
<span class="no">6</span> <span class="c"># this produces the same sql/result as above</span>
<span class="no">7</span> <span class="co">Book</span>::find(<span class="s"><span class="dl">'</span><span class="k">first</span><span class="dl">'</span></span>);
</span></code></pre>

	<h4>Find last</h4>


	<p>If you haven't yet fallen asleep reading this guide, you should've guessed this is the same as "find first", except that it will return the last result. Null will be returned if no records are found.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="c"># Grab all books, but only return the last result back as your model object.</span>
<span class="no">2</span> <span class="lv">$book</span> = <span class="co">Book</span>::last();
<span class="no">3</span> <span class="pd">echo</span> <span class="s"><span class="dl">"</span><span class="k">the last id is: </span><span class="il"><span class="dl">{</span><span class="lv">$book</span>-&gt;id<span class="dl">}</span></span><span class="dl">"</span></span> <span class="c"># =&gt; the last id is: 32</span>
<span class="no">4</span> <span class="c"># sql =&gt; SELECT * FROM `books`</span>
<span class="no">5</span> 
<span class="no">6</span> <span class="c"># this produces the same sql/result as above</span>
<span class="no">7</span> <span class="co">Book</span>::find(<span class="s"><span class="dl">'</span><span class="k">last</span><span class="dl">'</span></span>);
</span></code></pre>

	<h4 id="multiple-records-result">Multiple records result</h4>


	<p>This type of result will always return an array of model objects. If your table holds no records, or your query yields no results, then an empty array will be given.</p>


	<h4>Find by primary key</h4>


	<p>Just like the single record result for find by primary key, you can pass an array to the find method for multiple primary keys. Again, you may pass an <a href="/docs/database/finders#finder-options">options array</a> as the last argument for creating specific queries. Every key which you use as an argument must produce a corresponding record, otherwise, a RecordNotFound exception will be thrown.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="c"># Grab books with the primary key of 2 or 3</span>
<span class="no">2</span> <span class="co">Book</span>::find(<span class="i">2</span>,<span class="i">3</span>);
<span class="no">3</span> <span class="c"># sql =&gt; SELECT * FROM `books` WHERE id IN (2,3)</span>
<span class="no">4</span> 
<span class="no">5</span> <span class="c"># same as above</span>
<span class="no">6</span> <span class="co">Book</span>::find(<span class="pd">array</span>(<span class="i">2</span>,<span class="i">3</span>));
</span></code></pre>

	<h4>Find all</h4>


	<p>There are 2 more ways which you can use to get multiple records back from your database. They use different methods; however, they are basically the same thing. If you do not pass an <a href="/docs/database/finders#finder-options">options array</a>, then it will fetch all records.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="c"># Grab all books from the database</span>
<span class="no">2</span> <span class="co">Book</span>::all();
<span class="no">3</span> <span class="c"># sql =&gt; SELECT * FROM `books`</span>
<span class="no">4</span> 
<span class="no">5</span> <span class="c"># same as above</span>
<span class="no">6</span> <span class="co">Book</span>::find(<span class="s"><span class="dl">'</span><span class="k">all</span><span class="dl">'</span></span>);
</span></code></pre>

	<p>Here we pass some options to the same method so that we don't fetch <strong>every</strong> record.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="lv">$options</span> = <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">limit</span><span class="dl">'</span></span> =&gt; <span class="i">2</span>);
<span class="no">2</span> <span class="co">Book</span>::all(<span class="lv">$options</span>);
<span class="no">3</span> <span class="c"># sql =&gt; SELECT * FROM `books` LIMIT 0,2</span>
<span class="no">4</span> 
<span class="no">5</span> <span class="c"># same as above</span>
<span class="no">6</span> <span class="co">Book</span>::find(<span class="s"><span class="dl">'</span><span class="k">all</span><span class="dl">'</span></span>, <span class="lv">$options</span>);
</span></code></pre>

	<h4 id="finder-options">Finder options</h4>


	<p>There are a number of options available to pass to one of the finder methods for granularity. Let's start with one of the most important options: conditions.</p>


	<h4 id="conditions">Conditions</h4>


	<p>This is the "WHERE" of a SQL statement. By creating conditions, ActiveRecord will parse them into a corresponding "WHERE" SQL statement to filter out your results. Conditions can be extremely simple by only supplying a string. They can also be as complex as you'd like by creating a conditions string that uses ? marks as placeholders for values. Let's start with a simple example of a conditions string.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="c"># fetch all the cheap books!</span>
<span class="no">2</span> <span class="co">Book</span>::all(<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">conditions</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">price &lt; 15.00</span><span class="dl">'</span></span>));
<span class="no">3</span> <span class="c"># sql =&gt; SELECT * FROM `books` WHERE price &lt; 15.00</span>
<span class="no">4</span> 
<span class="no">5</span> <span class="c"># fetch all books that have "war" somewhere in the title</span>
<span class="no">6</span> <span class="co">Book</span>::find(<span class="s"><span class="dl">'</span><span class="k">all</span><span class="dl">'</span></span>, <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">conditions</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">"</span><span class="k">title LIKE '%war%'</span><span class="dl">"</span></span>));
<span class="no">7</span> <span class="c"># sql =&gt; SELECT * FROM `books` WHERE title LIKE '%war%'</span>
</span></code></pre>

	<p>As stated, you can use *?* marks as placeholders for values which ActiveRecord will replace with your supplied values. The benefit of using this process is that ActiveRecord will escape your string in the backend with your database's native function to prevent SQL injection.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no"> 1</span> <span class="c"># fetch all the cheap books!</span>
<span class="no"> 2</span> <span class="co">Book</span>::all(<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">conditions</span><span class="dl">'</span></span> =&gt; <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">price &lt; ?</span><span class="dl">'</span></span>, <span class="fl">15.00</span>)));
<span class="no"> 3</span> <span class="c"># sql =&gt; SELECT * FROM `books` WHERE price &lt; 15.00</span>
<span class="no"> 4</span> 
<span class="no"> 5</span> <span class="c"># fetch all lousy romance novels</span>
<span class="no"> 6</span> <span class="co">Book</span>::find(<span class="s"><span class="dl">'</span><span class="k">all</span><span class="dl">'</span></span>, <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">conditions</span><span class="dl">'</span></span> =&gt; <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">genre = ?</span><span class="dl">'</span></span>, <span class="s"><span class="dl">'</span><span class="k">Romance</span><span class="dl">'</span></span>)));
<span class="no"> 7</span> <span class="c"># sql =&gt; SELECT * FROM `books` WHERE genre = 'Romance'</span>
<span class="no"> 8</span> 
<span class="no"> 9</span> <span class="c"># fetch all books with these authors</span>
<span class="no"><strong>10</strong></span> <span class="co">Book</span>::find(<span class="s"><span class="dl">'</span><span class="k">all</span><span class="dl">'</span></span>, <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">conditions</span><span class="dl">'</span></span> =&gt; <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">author_id in (?)</span><span class="dl">'</span></span>, <span class="pd">array</span>(<span class="i">1</span>,<span class="i">2</span>,<span class="i">3</span>))));
<span class="no">11</span> <span class="c"># sql =&gt; SELECT * FROM `books` WHERE author_id in (1,2,3)</span>
<span class="no">12</span> 
<span class="no">13</span> <span class="c"># fetch all lousy romance novels which are cheap</span>
<span class="no">14</span> <span class="co">Book</span>::all(<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">conditions</span><span class="dl">'</span></span> =&gt; <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">genre = ? AND price &lt; ?</span><span class="dl">'</span></span>, <span class="s"><span class="dl">'</span><span class="k">Romance</span><span class="dl">'</span></span>, <span class="fl">15.00</span>)));
<span class="no">15</span> <span class="c"># sql =&gt; SELECT * FROM `books` WHERE genre = 'Romance' AND price &lt; 15.00</span>
</span></code></pre>

	<p>Here is a more complicated example. Again, the first index of the conditions array are the condition strings. The values in the array after that are the values which replace their corresponding ? marks.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="c"># fetch all cheap books by these authors</span>
<span class="no">2</span> <span class="lv">$cond</span> =<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">conditions</span><span class="dl">'</span></span>=&gt;<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">author_id in(?) AND price &lt; ?</span><span class="dl">'</span></span>, <span class="pd">array</span>(<span class="i">1</span>,<span class="i">2</span>,<span class="i">3</span>), <span class="fl">15.00</span>));
<span class="no">3</span> <span class="co">Book</span>::all(<span class="lv">$cond</span>);
<span class="no">4</span> <span class="c"># sql =&gt; SELECT * FROM `books` WHERE author_id in(1,2,3) AND price &lt; 15.00</span>
</span></code></pre>

	<h4 id="limit-offset">Limit &amp; Offset</h4>


	<p>This one should be fairly obvious. A limit option will produce a SQL limit clause for supported databases. It can be used in conjunction with the <strong>offset</strong> option.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="c"># fetch all but limit to 10 total books</span>
<span class="no">2</span> <span class="co">Book</span>::find(<span class="s"><span class="dl">'</span><span class="k">all</span><span class="dl">'</span></span>, <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">limit</span><span class="dl">'</span></span> =&gt; <span class="i">10</span>));
<span class="no">3</span> <span class="c"># sql =&gt; SELECT * FROM `books` LIMIT 0,10</span>
<span class="no">4</span> 
<span class="no">5</span> <span class="c"># fetch all but limit to 10 total books starting at the 6th book</span>
<span class="no">6</span> <span class="co">Book</span>::find(<span class="s"><span class="dl">'</span><span class="k">all</span><span class="dl">'</span></span>, <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">limit</span><span class="dl">'</span></span> =&gt; <span class="i">10</span>, <span class="s"><span class="dl">'</span><span class="k">offset</span><span class="dl">'</span></span> =&gt; <span class="i">5</span>));
<span class="no">7</span> <span class="c"># sql =&gt; SELECT * FROM `books` LIMIT 5,10</span>
</span></code></pre>

	<h4 id="order">Order</h4>


	<p>Produces an ORDERY BY SQL clause.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="c"># order all books by title desc</span>
<span class="no">2</span> <span class="co">Book</span>::find(<span class="s"><span class="dl">'</span><span class="k">all</span><span class="dl">'</span></span>, <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">order</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">title desc</span><span class="dl">'</span></span>));
<span class="no">3</span> <span class="c"># sql =&gt; SELECT * FROM `books` ORDER BY title desc</span>
<span class="no">4</span> 
<span class="no">5</span> <span class="c"># order by most expensive and title</span>
<span class="no">6</span> <span class="co">Book</span>::find(<span class="s"><span class="dl">'</span><span class="k">all</span><span class="dl">'</span></span>, <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">order</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">price desc, title asc</span><span class="dl">'</span></span>));
<span class="no">7</span> <span class="c"># sql =&gt; SELECT * FROM `books` ORDER BY price desc, title asc</span>
</span></code></pre>

	<h4 id="select">Select</h4>


	<p>Passing a select key in your <a href="/docs/database/finders#finder-options">options array</a> will allow you to specify which columns you want back from the database. This is helpful when you have a table with too many columns, but you might only want 3 columns back for 50 records. It is also helpful when used with a group statement.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="c"># fetch all books, but only the id and title columns</span>
<span class="no">2</span> <span class="co">Book</span>::find(<span class="s"><span class="dl">'</span><span class="k">all</span><span class="dl">'</span></span>, <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">select</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">id, title</span><span class="dl">'</span></span>));
<span class="no">3</span> <span class="c"># sql =&gt; SELECT id, title FROM `books`</span>
<span class="no">4</span> 
<span class="no">5</span> <span class="c"># custom sql to feed some report</span>
<span class="no">6</span> <span class="co">Book</span>::find(<span class="s"><span class="dl">'</span><span class="k">all</span><span class="dl">'</span></span>, <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">select</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">avg(price) as avg_price, avg(tax) as avg_tax</span><span class="dl">'</span></span>));
<span class="no">7</span> <span class="c"># sql =&gt; SELECT avg(price) as avg_price, avg(tax) as avg_tax FROM `books` LIMIT 5,10</span>
</span></code></pre>

	<h4 id="from">From</h4>


	<p>This designates the table you are selecting from. This can come in handy if you do a <a href="/docs/database/finders#joins">join</a> or require finer control.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="c"># fetch the first book by aliasing the table name</span>
<span class="no">2</span> <span class="co">Book</span>::first(<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">select</span><span class="dl">'</span></span>=&gt; <span class="s"><span class="dl">'</span><span class="k">b.*</span><span class="dl">'</span></span>, <span class="s"><span class="dl">'</span><span class="k">from</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">books as b</span><span class="dl">'</span></span>));
<span class="no">3</span> <span class="c"># sql =&gt; SELECT b.* FROM books as b LIMIT 0,1</span>
</span></code></pre>

	<h4 id="group">Group</h4>


	<p>Generate a GROUP BY clause.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="c"># group all books by prices</span>
<span class="no">2</span> <span class="co">Book</span>::all(<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">group</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">price</span><span class="dl">'</span></span>));
<span class="no">3</span> <span class="c"># sql =&gt; SELECT * FROM `books` GROUP BY price</span>
</span></code></pre>

	<h4 id="having">Having</h4>


	<p>Generate a HAVING clause to add conditions to your GROUP BY.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="c"># group all books by prices greater than $45</span>
<span class="no">2</span> <span class="co">Book</span>::all(<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">group</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">price</span><span class="dl">'</span></span>, <span class="s"><span class="dl">'</span><span class="k">having</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">price &gt; 45.00</span><span class="dl">'</span></span>));
<span class="no">3</span> <span class="c"># sql =&gt; SELECT * FROM `books` GROUP BY price HAVING price &gt; 45.00</span>
</span></code></pre>

	<h4 id="read-only">Read only</h4>


	<p>Readonly models are just that: readonly. If you try to save a readonly model, then a ReadOnlyException will be thrown.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no"> 1</span> <span class="c"># specify the object is readonly and cannot be saved</span>
<span class="no"> 2</span> <span class="lv">$book</span> = <span class="co">Book</span>::first(<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">readonly</span><span class="dl">'</span></span> =&gt; <span class="pc">true</span>));
<span class="no"> 3</span> 
<span class="no"> 4</span> <span class="r">try</span> {
<span class="no"> 5</span>   <span class="lv">$book</span>-&gt;save();
<span class="no"> 6</span> } <span class="r">catch</span> (<span class="co">ActiveRecord</span>\<span class="co">ReadOnlyException</span> <span class="lv">$e</span>) {
<span class="no"> 7</span>   <span class="pd">echo</span> <span class="lv">$e</span>-&gt;getMessage();
<span class="no"> 8</span>   <span class="c"># =&gt; Book::save() cannot be invoked because this model is set to read only</span>
<span class="no"> 9</span> }
</span></code></pre>

	<h4 id="dynamic-finders">Dynamic finders</h4>


	<p>These offer a quick and easy way to construct conditions without having to pass in a bloated array option. This option makes use of PHP 5.3's <a href="http://www.php.net/lsb" class="external">late static binding</a> combined with <a href="http://www.php.net/__callstatic" class="external">__callStatic()</a> allowing you to invoke undefined static methods on your model. You can either use YourModel::find_by which returns a <a href="/docs/database/finders#single-record-result">single record result</a> and YourModel::find_all_by returns <a href="/docs/database/finders#multiple-records-result">multiple records result</a>. All you have to do is add an underscore and another field name after either of those two methods. Let's take a look.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no"> 1</span> <span class="c"># find a single book by the title of War and Peace</span>
<span class="no"> 2</span> <span class="lv">$book</span> = <span class="co">Book</span>::find_by_title(<span class="s"><span class="dl">'</span><span class="k">War and Peace</span><span class="dl">'</span></span>);
<span class="no"> 3</span> <span class="c">#sql =&gt; SELECT * FROM `books` WHERE title = 'War and Peace'</span>
<span class="no"> 4</span> 
<span class="no"> 5</span> <span class="c"># find all discounted books</span>
<span class="no"> 6</span> <span class="lv">$book</span> = <span class="co">Book</span>::find_all_by_discounted(<span class="i">1</span>);
<span class="no"> 7</span> <span class="c">#sql =&gt; SELECT * FROM `books` WHERE discounted = 1</span>
<span class="no"> 8</span> 
<span class="no"> 9</span> <span class="c"># find all discounted books by given author</span>
<span class="no"><strong>10</strong></span> <span class="lv">$book</span> = <span class="co">Book</span>::find_all_by_discounted_and_author_id(<span class="i">1</span>, <span class="i">5</span>);
<span class="no">11</span> <span class="c">#sql =&gt; SELECT * FROM `books` WHERE discounted = 1 AND author_id = 5</span>
<span class="no">12</span> 
<span class="no">13</span> <span class="c"># find all discounted books or those which cost 5 bux</span>
<span class="no">14</span> <span class="lv">$book</span> = <span class="co">Book</span>::find_by_discounted_or_price(<span class="i">1</span>, <span class="fl">5.00</span>);
<span class="no">15</span> <span class="c">#sql =&gt; SELECT * FROM `books` WHERE discounted = 1 OR price = 5.00</span>
</span></code></pre>

	<h4 id="joins">Joins</h4>


	<p>A join option may be passed to specify SQL JOINS. There are two ways to produce a JOIN. You may pass custom SQL to perform a join as a simple string. By default, the joins option will not <a href="/docs/database/finders#select">select</a> the attributes from the joined table; instead, it will only select the attributes from your model's table. You can pass a select option to specify the fields.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="c"># fetch all books joining their corresponding authors</span>
<span class="no">2</span> <span class="lv">$join</span> = <span class="s"><span class="dl">'</span><span class="k">LEFT JOIN authors a ON(books.author_id = a.author_id)</span><span class="dl">'</span></span>;
<span class="no">3</span> <span class="lv">$book</span> = <span class="co">Book</span>::all(<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">joins</span><span class="dl">'</span></span> =&gt; <span class="lv">$join</span>));
<span class="no">4</span> <span class="c"># sql =&gt; SELECT `books`.* FROM `books`</span>
<span class="no">5</span> <span class="c">#      LEFT JOIN authors a ON(books.author_id = a.author_id)</span>
</span></code></pre>

	<p>Or, you may specify a join via an <a href="/docs/database/relationships">related</a> model.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no"> 1</span> <span class="r">class</span> <span class="cl">Book</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span>
<span class="no"> 2</span> {
<span class="no"> 3</span>   <span class="r">static</span> <span class="lv">$belongs_to</span> = <span class="pd">array</span>(<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">author</span><span class="dl">'</span></span>),<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">publisher</span><span class="dl">'</span></span>));
<span class="no"> 4</span> }
<span class="no"> 5</span> 
<span class="no"> 6</span> <span class="c"># fetch all books joining their corresponding author</span>
<span class="no"> 7</span> <span class="lv">$book</span> = <span class="co">Book</span>::all(<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">joins</span><span class="dl">'</span></span> =&gt; <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">author</span><span class="dl">'</span></span>)));
<span class="no"> 8</span> <span class="c"># sql =&gt; SELECT `books`.* FROM `books`</span>
<span class="no"> 9</span> <span class="c">#      INNER JOIN `authors` ON(`books`.author_id = `authors`.id)</span>
<span class="no"><strong>10</strong></span> 
<span class="no">11</span> <span class="c"># here's a compound join</span>
<span class="no">12</span> <span class="lv">$book</span> = <span class="co">Book</span>::all(<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">joins</span><span class="dl">'</span></span> =&gt; <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">author</span><span class="dl">'</span></span>, <span class="s"><span class="dl">'</span><span class="k">publisher</span><span class="dl">'</span></span>)));
<span class="no">13</span> <span class="c"># sql =&gt; SELECT `books`.* FROM `books`</span>
<span class="no">14</span> <span class="c">#      INNER JOIN `authors` ON(`books`.author_id = `authors`.id)</span>
<span class="no">15</span> <span class="c">#         INNER JOIN `publishers` ON(`books`.publisher_id = `publishers`.id)</span>
</span></code></pre>

	<p>Joins can be combined with strings and associated models.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no"> 1</span> <span class="r">class</span> <span class="cl">Book</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span>
<span class="no"> 2</span> {
<span class="no"> 3</span>   <span class="r">static</span> <span class="lv">$belongs_to</span> = <span class="pd">array</span>(<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">publisher</span><span class="dl">'</span></span>));
<span class="no"> 4</span> }
<span class="no"> 5</span> 
<span class="no"> 6</span> <span class="lv">$join</span> = <span class="s"><span class="dl">'</span><span class="k">LEFT JOIN authors a ON(books.author_id = a.author_id)</span><span class="dl">'</span></span>;
<span class="no"> 7</span> <span class="c"># here we use our $join string and the association publisher</span>
<span class="no"> 8</span> <span class="lv">$book</span> = <span class="co">Book</span>::all(<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">joins</span><span class="dl">'</span></span> =&gt; <span class="lv">$join</span>, <span class="s"><span class="dl">'</span><span class="k">publisher</span><span class="dl">'</span></span>));
<span class="no"> 9</span> <span class="c"># sql =&gt; SELECT `books`.* FROM `books`</span>
<span class="no"><strong>10</strong></span> <span class="c">#      LEFT JOIN authors a ON(books.author_id = a.author_id)</span>
<span class="no">11</span> <span class="c">#         INNER JOIN `publishers` ON(`books`.publisher_id = `publishers`.id)</span>
</span></code></pre>

	<h4 id="find-by-custom-sql">Find by custom SQL</h4>


	<p>If, for some reason, you need to create a complicated SQL query beyond the capacity of <a href="/docs/database/finders#finder-options">finder options</a>, then you can pass a custom SQL query through Model::find_by_sql(). This will render your model as <a href="/docs/database/finders#read-only">readonly</a> so that you cannot use any write methods on your returned model(s).</p>


	<p><strong>Caution:</strong> find_by_sql() will NOT prevent SQL injection like all other finder methods. The burden to secure your custom find_by_sql() query is on you. You can use the Model::connection()-&gt;escape() method to escape SQL strings.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="c"># this will return a single result of a book model with only the title as an attirubte</span>
<span class="no">2</span> <span class="lv">$book</span> = <span class="co">Book</span>::find_by_sql(<span class="s"><span class="dl">'</span><span class="k">select title from `books`</span><span class="dl">'</span></span>);
<span class="no">3</span> 
<span class="no">4</span> <span class="c"># you can even select from another table</span>
<span class="no">5</span> <span class="lv">$cached_book</span> = <span class="co">Book</span>::find_by_sql(<span class="s"><span class="dl">'</span><span class="k">select * from books_cache</span><span class="dl">'</span></span>);
<span class="no">6</span> <span class="c"># this will give you the attributes from the books_cache table</span>
</span></code></pre>

	<h4 id="eager-loading">Eager loading associations</h4>


	<p>Eager loading retrieves the base model and its associations using only a few queries. This avoids the N + 1 problem.</p>


	<p>Imagine you have this code which finds 10 posts and then displays each post's author's first name.<br></p><pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="lv">$posts</span> = <span class="co">Post</span>::find(<span class="s"><span class="dl">'</span><span class="k">all</span><span class="dl">'</span></span>, <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">limit</span><span class="dl">'</span></span> =&gt; <span class="i">10</span>));
<span class="no">2</span> <span class="r">foreach</span> (<span class="lv">$posts</span> <span class="r">as</span> <span class="lv">$post</span>)
<span class="no">3</span>   <span class="pd">echo</span> <span class="lv">$post</span>-&gt;author-&gt;first_name;
</span></code></pre><p></p>


	<p>What happens here is the we get 11 queries, 1 to find 10 posts, + 10 (one per each post to get the first name from the authors table).</p>


	<p>We solve this problem by using the <strong>include</strong> option which would only issue two queries instead of 11. Here's how this would be done:</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="lv">$posts</span> = <span class="co">Post</span>::find(<span class="s"><span class="dl">'</span><span class="k">all</span><span class="dl">'</span></span>, <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">limit</span><span class="dl">'</span></span> =&gt; <span class="i">10</span>, <span class="s"><span class="dl">'</span><span class="k">include</span><span class="dl">'</span></span> =&gt; <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">author</span><span class="dl">'</span></span>)));
<span class="no">2</span> <span class="r">foreach</span> (<span class="lv">$posts</span> <span class="r">as</span> <span class="lv">$post</span>)
<span class="no">3</span>   <span class="pd">echo</span> <span class="lv">$post</span>-&gt;author-&gt;first_name;
<span class="no">4</span> 
<span class="no">5</span> <span class="co">SELECT</span> * <span class="co">FROM</span> <span class="s"><span class="dl">`</span><span class="k">posts</span><span class="dl">`</span></span> <span class="co">LIMIT</span> <span class="i">10</span>
<span class="no">6</span> <span class="co">SELECT</span> * <span class="co">FROM</span> <span class="s"><span class="dl">`</span><span class="k">authors</span><span class="dl">`</span></span> <span class="co">WHERE</span> <span class="s"><span class="dl">`</span><span class="k">post_id</span><span class="dl">`</span></span> <span class="co">IN</span> (<span class="i">1</span>,<span class="i">2</span>,<span class="i">3</span>,<span class="i">4</span>,<span class="i">5</span>,<span class="i">6</span>,<span class="i">7</span>,<span class="i">8</span>,<span class="i">9</span>,<span class="i">10</span>)
</span></code></pre>

	<p>Since <strong>include</strong> uses an array, you can specify more than one association:<br></p><pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="lv">$posts</span> = <span class="co">Post</span>::find(<span class="s"><span class="dl">'</span><span class="k">all</span><span class="dl">'</span></span>, <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">limit</span><span class="dl">'</span></span> =&gt; <span class="i">10</span>, <span class="s"><span class="dl">'</span><span class="k">include</span><span class="dl">'</span></span> =&gt; <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">author</span><span class="dl">'</span></span>, <span class="s"><span class="dl">'</span><span class="k">comments</span><span class="dl">'</span></span>)));
</span></code></pre><p></p>


	<p>You can also <strong>nest</strong> the <strong>include</strong> option to eager load associations of associations. The following would find the first post, eager load the first post's category, its associated comments and the associated comments' author:</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="lv">$posts</span> = <span class="co">Post</span>::find(<span class="s"><span class="dl">'</span><span class="k">first</span><span class="dl">'</span></span>, <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">include</span><span class="dl">'</span></span> =&gt; <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">category</span><span class="dl">'</span></span>, <span class="s"><span class="dl">'</span><span class="k">comments</span><span class="dl">'</span></span> =&gt; <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">author</span><span class="dl">'</span></span>))));
</span></code></pre>
</div>