<div class="wiki">
	<h2 id="Associations">Database : Relationships</h2>

	<ul id="topic-list">
		<li><a href="/docs/database/relationships#common-options">Common options</a></li>
		<li><a href="/docs/database/relationships#has_many">has_many</a></li>
		<li><a href="/docs/database/relationships#has_many_through" title="many to many">has_many through</a></li>
		<li><a href="/docs/database/relationships#belongs_to">belongs_to</a></li>
		<li><a href="/docs/database/relationships#has_one">has_one</a></li>
		<li><a href="/docs/database/relationships#self-referential">Self-referential</a></li>
	</ul>


	<p>What are associations? By declaring associations on your models, you allow them to communicate with each other. These associations should match the way data in your tables relate to each other.</p>


	<h4 id="common-options">Common options</h4>


	<p>These are available amongst each type of association.</p>


	<p><strong>conditions</strong>: string/array of <a href="/docs/database/finders#conditions">finder conditions</a><br><strong>readonly</strong>: whether associated objects can be <a href="/docs/database/finders#read-only">saved/destroyed</a><br><strong>select</strong>: specify fields in the <a href="/docs/database/finders#select">select clause</a><br><strong>class_name</strong>: the class name of the associated model<br><strong>foreign_key</strong>: name of foreign_key</p>


	<p>Let's take a look at these options with a few different association types</p>


	<h5>conditions</h5>


	<p>Below, we specify that associated payments of an order object should not be void.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="r">class</span> <span class="cl">Order</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span> {
<span class="no">2</span>   <span class="r">static</span> <span class="lv">$has_many</span> = <span class="pd">array</span>(
<span class="no">3</span>     <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">payments</span><span class="dl">'</span></span>, <span class="s"><span class="dl">'</span><span class="k">conditions</span><span class="dl">'</span></span> =&gt; <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">void = ?</span><span class="dl">'</span></span> =&gt; <span class="pd">array</span>(<span class="i">0</span>)))
<span class="no">4</span>   );
<span class="no">5</span> }
</span></code></pre>

	<h5>readonly</h5>


	<p>If you add a readonly option to your association, then the associatied object cannot be saved, although, the base object can still be saved.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no"> 1</span> <span class="r">class</span> <span class="cl">Payment</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span> {
<span class="no"> 2</span>   <span class="r">static</span> <span class="lv">$belongs_to</span> = <span class="pd">array</span>(
<span class="no"> 3</span>     <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">user</span><span class="dl">'</span></span>, <span class="s"><span class="dl">'</span><span class="k">readonly</span><span class="dl">'</span></span> =&gt; <span class="pc">true</span>)
<span class="no"> 4</span>   );
<span class="no"> 5</span> }
<span class="no"> 6</span>
<span class="no"> 7</span> <span class="lv">$payment</span> = <span class="co">Payment</span>::first();
<span class="no"> 8</span> <span class="lv">$payment</span>-&gt;paid = <span class="i">1</span>;
<span class="no"> 9</span> <span class="lv">$payment</span>-&gt;save(); <span class="c"># this will save just fine</span>
<span class="no"><strong>10</strong></span>
<span class="no">11</span> <span class="lv">$payment</span>-&gt;user-&gt;first_name = <span class="s"><span class="dl">'</span><span class="k">John</span><span class="dl">'</span></span>;
<span class="no">12</span> <span class="lv">$payment</span>-&gt;user-&gt;save(); <span class="c"># this will throw a ReadOnlyException</span>
</span></code></pre>

	<h5>select</h5>


	<p>Sometimes you may not need all of the fields back from one of your associations (e.g. it may be a ridiculously large table) and so you can specify the particular fields you want.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="r">class</span> <span class="cl">Payment</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span> {
<span class="no">2</span>   <span class="r">static</span> <span class="lv">$belongs_to</span> = <span class="pd">array</span>(
<span class="no">3</span>     <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">person</span><span class="dl">'</span></span>, <span class="s"><span class="dl">'</span><span class="k">select</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">id, first_name, last_name</span><span class="dl">'</span></span>)
<span class="no">4</span>   );
<span class="no">5</span> }
</span></code></pre>

	<h5 id="class_name">class_name</h5>


	<p>In this example payment has a one-to-one relationship with a user, but we want to access the association thru "person." Thus, we have to provide the class name of the associated model; otherwise, ActiveRecord would try to look for a "Person" class.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="r">class</span> <span class="cl">Payment</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span> {
<span class="no">2</span>   <span class="r">static</span> <span class="lv">$belongs_to</span> = <span class="pd">array</span>(
<span class="no">3</span>     <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">person</span><span class="dl">'</span></span>, <span class="s"><span class="dl">'</span><span class="k">class_name</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">User</span><span class="dl">'</span></span>)
<span class="no">4</span>   );
<span class="no">5</span> }
</span></code></pre>

	<h4 id="has_many">has_many</h4>


	<p>A one-to-many relationship. You should use a pluralized form of the associated model when declaring a has_many association, unless you want to use the <a href="/docs/database/relationships#class_name">class_name</a> option.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no"> 1</span> <span class="c"># one-to-many association with the model "Payment" </span>
<span class="no"> 2</span> <span class="r">class</span> <span class="cl">User</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span> {
<span class="no"> 3</span>   <span class="r">static</span> <span class="lv">$has_many</span> = <span class="pd">array</span>(
<span class="no"> 4</span>     <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">payments</span><span class="dl">'</span></span>)
<span class="no"> 5</span>   );
<span class="no"> 6</span> }
<span class="no"> 7</span>
<span class="no"> 8</span> <span class="lv">$user</span> = <span class="co">User</span>::first();
<span class="no"> 9</span> <span class="pd">print_r</span>(<span class="lv">$user</span>-&gt;payments); <span class="c"># =&gt; will print an array of Payment objects</span>
<span class="no"><strong>10</strong></span>
<span class="no">11</span> <span class="lv">$payment</span> = <span class="lv">$user</span>-&gt;create_payment(<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">amount</span><span class="dl">'</span></span> =&gt; <span class="i">1</span>)); <span class="c"># build|create for associations.</span>
</span></code></pre>

	<p><img src="/images/guides/has_many.png" alt=""></p>


	<p>Options (not part of <a href="/docs/database/relationships#common-options">common options</a>)</p>


	<p><strong>limit/offset</strong>: limit the number of records<br><strong>primary_key</strong>: name of the primary_key of the association (assumed to be "id")<br><strong>group</strong>: GROUP BY clause<br><strong>order</strong>: ORDER BY clause<br><strong>through</strong>: the association used to go "through"</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="r">class</span> <span class="cl">Order</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span> {
<span class="no">2</span>   <span class="r">static</span> <span class="lv">$has_many</span> = <span class="pd">array</span>(
<span class="no">3</span>     <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">payments</span><span class="dl">'</span></span>, <span class="s"><span class="dl">'</span><span class="k">limit</span><span class="dl">'</span></span> =&gt; <span class="i">5</span>),
<span class="no">4</span>     <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">items</span><span class="dl">'</span></span>, <span class="s"><span class="dl">'</span><span class="k">order</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">name asc</span><span class="dl">'</span></span>, <span class="s"><span class="dl">'</span><span class="k">group</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">type</span><span class="dl">'</span></span>)
<span class="no">5</span>   );
<span class="no">6</span> }
</span></code></pre>

	<h5 id="has_many_through">has_many through (many to many)</h5>


	<p>This is a convenient way to configure a many-to-many association. In this example an order is associated with users by going the its payments association.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no"> 1</span> <span class="r">class</span> <span class="cl">Order</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span> {
<span class="no"> 2</span>   <span class="r">static</span> <span class="lv">$has_many</span> = <span class="pd">array</span>(
<span class="no"> 3</span>     <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">payments</span><span class="dl">'</span></span>),
<span class="no"> 4</span>     <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">users</span><span class="dl">'</span></span>, <span class="s"><span class="dl">'</span><span class="k">through</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">payments</span><span class="dl">'</span></span>)
<span class="no"> 5</span>   );
<span class="no"> 6</span> }
<span class="no"> 7</span>
<span class="no"> 8</span> <span class="r">class</span> <span class="cl">Payment</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span> {
<span class="no"> 9</span>   <span class="r">static</span> <span class="lv">$belongs_to</span> = <span class="pd">array</span>(
<span class="no"><strong>10</strong></span>     <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">user</span><span class="dl">'</span></span>),
<span class="no">11</span>     <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">order</span><span class="dl">'</span></span>)
<span class="no">12</span>   );
<span class="no">13</span> }
<span class="no">14</span>
<span class="no">15</span> <span class="r">class</span> <span class="cl">User</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span> {
<span class="no">16</span>   <span class="r">static</span> <span class="lv">$has_many</span> = <span class="pd">array</span>(
<span class="no">17</span>     <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">payments</span><span class="dl">'</span></span>)
<span class="no">18</span>   );
<span class="no">19</span> }
<span class="no"><strong>20</strong></span>
<span class="no">21</span> <span class="lv">$order</span> = <span class="co">Order</span>::first();
<span class="no">22</span> <span class="c"># direct access to users</span>
<span class="no">23</span> <span class="pd">print_r</span>(<span class="lv">$order</span>-&gt;users); <span class="c"># will print an array of User object</span>
</span></code></pre>

	<p><img src="/images/guides/has_many_through.png" alt=""></p>


	<h4 id="belongs_to">belongs_to</h4>


	<p>This indicates a one-to-one relationship. Its difference from <a href="/docs/database/relationships#has_one">has_one</a> is that the foreign key will be on the table which declares a belongs_to association. You should use a singular form of the associated model when declaring this association, unless you want to use the <a href="/docs/database/relationships#class_name">class_name</a> option.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="r">class</span> <span class="cl">Payment</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span> {
<span class="no">2</span>   <span class="r">static</span> <span class="lv">$belongs_to</span> = <span class="pd">array</span>(
<span class="no">3</span>     <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">user</span><span class="dl">'</span></span>)
<span class="no">4</span>   );
<span class="no">5</span> }
<span class="no">6</span>
<span class="no">7</span> <span class="lv">$payment</span> = <span class="co">Payment</span>::first();
<span class="no">8</span> <span class="pd">echo</span> <span class="lv">$payment</span>-&gt;user-&gt;first_name; <span class="c"># first_name of associated User object</span>
</span></code></pre>

	<p><img src="/images/guides/belongs_to.png" alt=""></p>


	<p>Options (not part of <a href="/docs/database/relationships#common-options">common options</a>)</p>


	<p><strong>primary_key</strong>: name of the primary_key of the association (assumed to be "id")</p>


	<h4 id="has_one">has_one</h4>


	<p>This indicates a one-to-one relationship. A has_one will have the foreign key on the associated table unlike <a href="/docs/database/relationships#belongs_to">belongs_to</a>. You should use a singular form of the associated model when declaring this association, unless you want to use the <a href="/docs/database/relationships#class_name">class_name</a> option.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="r">class</span> <span class="cl">Payment</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span> {
<span class="no">2</span>   <span class="r">static</span> <span class="lv">$has_one</span> = <span class="pd">array</span>(
<span class="no">3</span>     <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">receipt</span><span class="dl">'</span></span>)
<span class="no">4</span>   );
<span class="no">5</span> }
</span></code></pre>

	<p><img src="/images/guides/has_one.png" alt=""></p>


	<p>Options (not part of <a href="/docs/database/relationships#common-options">common options</a>)</p>


	<p><strong>primary_key</strong>: name of the primary_key of the association (assumed to be "id")<br><strong>through</strong>: the association used to go "through"</p>


	<h5>has_one through</h5>


	<p>A one-to-one association. In this example, an owner has a quarter_back by going through its team association.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no"> 1</span> <span class="r">class</span> <span class="cl">Owner</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span> {
<span class="no"> 2</span>   <span class="r">static</span> <span class="lv">$has_one</span> = <span class="pd">array</span>(
<span class="no"> 3</span>     <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">team</span><span class="dl">'</span></span>),
<span class="no"> 4</span>     <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">quarter_back</span><span class="dl">'</span></span>, <span class="s"><span class="dl">'</span><span class="k">through</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">team</span><span class="dl">'</span></span>)
<span class="no"> 5</span>   );
<span class="no"> 6</span> }
<span class="no"> 7</span>
<span class="no"> 8</span> <span class="r">class</span> <span class="cl">Team</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span> {
<span class="no"> 9</span>   <span class="r">static</span> <span class="lv">$belongs_to</span> = <span class="pd">array</span>(
<span class="no"><strong>10</strong></span>     <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">owner</span><span class="dl">'</span></span>)
<span class="no">11</span>   );
<span class="no">12</span>
<span class="no">13</span>   <span class="r">static</span> <span class="lv">$has_one</span> = <span class="pd">array</span>(
<span class="no">14</span>     <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">quarter_back</span><span class="dl">'</span></span>)
<span class="no">15</span>   );
<span class="no">16</span> }
<span class="no">17</span>
<span class="no">18</span> <span class="r">class</span> <span class="cl">QuarterBack</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span> {
<span class="no">19</span>   <span class="r">static</span> <span class="lv">$belongs_to</span> = <span class="pd">array</span>(
<span class="no"><strong>20</strong></span>     <span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">team</span><span class="dl">'</span></span>)
<span class="no">21</span>   );
<span class="no">22</span> }
</span></code></pre>

	<p><img src="/images/guides/has_one_through.png" alt=""></p>


	<h4 id="self-referential">Self-referential</h4>


	<p>Model's can declare associations to themselves. This can be helpful for table auditing, or in the example below, where a post would need to know about its parent.</p>


	<pre class="code"><code class="php syntaxhl"><span class="CodeRay"><span class="no">1</span> <span class="r">class</span> <span class="cl">Post</span> <span class="r">extends</span> <span class="co">ActiveRecord</span>\<span class="co">Model</span> {
<span class="no">2</span>   <span class="r">static</span> <span class="lv">$belongs_to</span> = <span class="pd">array</span>(<span class="pd">array</span>(<span class="s"><span class="dl">'</span><span class="k">parent_post</span><span class="dl">'</span></span>, <span class="s"><span class="dl">'</span><span class="k">class_name</span><span class="dl">'</span></span> =&gt; <span class="s"><span class="dl">'</span><span class="k">Post</span><span class="dl">'</span></span>));
<span class="no">3</span> }
</span></code></pre>

	<p><img src="/images/guides/belongs_to_self_referential.png" alt=""></p>
</div>