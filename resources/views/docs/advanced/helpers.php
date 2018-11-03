<article>
	<h1>Helpers</h1>
	<ul>
		<li><a href="#introduction">Introduction</a></li>
		<li><a href="#available-methods">Available Methods</a></li>
	</ul>
	<p><a name="introduction"></a></p>
	<h2><a href="#introduction">Introduction</a></h2>
	<p>Laravel includes a variety of global "helper" PHP functions. Many of these functions are used by the framework itself; however, you are free to use them in your own applications if you find them convenient.</p>
	<p><a name="available-methods"></a></p>
	<h2><a href="#available-methods">Available Methods</a></h2>
	<style>
		.collection-method-list > p {
			column-count: 3; -moz-column-count: 3; -webkit-column-count: 3;
			column-gap: 2em; -moz-column-gap: 2em; -webkit-column-gap: 2em;
		}

		.collection-method-list a {
			display: block;
		}
	</style>
	<h3>Arrays &amp; Objects</h3>
	<div class="collection-method-list">
		<p><a href="#method-array-add">array_add</a>
			<a href="#method-array-collapse">array_collapse</a>
			<a href="#method-array-divide">array_divide</a>
			<a href="#method-array-dot">array_dot</a>
			<a href="#method-array-except">array_except</a>
			<a href="#method-array-first">array_first</a>
			<a href="#method-array-flatten">array_flatten</a>
			<a href="#method-array-forget">array_forget</a>
			<a href="#method-array-get">array_get</a>
			<a href="#method-array-has">array_has</a>
			<a href="#method-array-last">array_last</a>
			<a href="#method-array-only">array_only</a>
			<a href="#method-array-pluck">array_pluck</a>
			<a href="#method-array-prepend">array_prepend</a>
			<a href="#method-array-pull">array_pull</a>
			<a href="#method-array-random">array_random</a>
			<a href="#method-array-set">array_set</a>
			<a href="#method-array-sort">array_sort</a>
			<a href="#method-array-sort-recursive">array_sort_recursive</a>
			<a href="#method-array-where">array_where</a>
			<a href="#method-array-wrap">array_wrap</a>
			<a href="#method-data-fill">data_fill</a>
			<a href="#method-data-get">data_get</a>
			<a href="#method-data-set">data_set</a>
			<a href="#method-head">head</a>
			<a href="#method-last">last</a></p>
	</div>
	<h3>Paths</h3>
	<div class="collection-method-list">
		<p><a href="#method-app-path">app_path</a>
			<a href="#method-base-path">base_path</a>
			<a href="#method-config-path">config_path</a>
			<a href="#method-database-path">database_path</a>
			<a href="#method-mix">mix</a>
			<a href="#method-public-path">public_path</a>
			<a href="#method-resource-path">resource_path</a>
			<a href="#method-storage-path">storage_path</a></p>
	</div>
	<h3>Strings</h3>
	<div class="collection-method-list">
		<p><a href="#method-__">__</a>
			<a href="#method-camel-case">camel_case</a>
			<a href="#method-class-basename">class_basename</a>
			<a href="#method-e">e</a>
			<a href="#method-ends-with">ends_with</a>
			<a href="#method-kebab-case">kebab_case</a>
			<a href="#method-preg-replace-array">preg_replace_array</a>
			<a href="#method-snake-case">snake_case</a>
			<a href="#method-starts-with">starts_with</a>
			<a href="#method-str-after">str_after</a>
			<a href="#method-str-before">str_before</a>
			<a href="#method-str-contains">str_contains</a>
			<a href="#method-str-finish">str_finish</a>
			<a href="#method-str-is">str_is</a>
			<a href="#method-str-limit">str_limit</a>
			<a href="#method-str-ordered-uuid">Str::orderedUuid</a>
			<a href="#method-str-plural">str_plural</a>
			<a href="#method-str-random">str_random</a>
			<a href="#method-str-replace-array">str_replace_array</a>
			<a href="#method-str-replace-first">str_replace_first</a>
			<a href="#method-str-replace-last">str_replace_last</a>
			<a href="#method-str-singular">str_singular</a>
			<a href="#method-str-slug">str_slug</a>
			<a href="#method-str-start">str_start</a>
			<a href="#method-studly-case">studly_case</a>
			<a href="#method-title-case">title_case</a>
			<a href="#method-trans">trans</a>
			<a href="#method-trans-choice">trans_choice</a>
			<a href="#method-str-uuid">Str::uuid</a></p>
	</div>
	<h3>URLs</h3>
	<div class="collection-method-list">
		<p><a href="#method-action">action</a>
			<a href="#method-asset">asset</a>
			<a href="#method-secure-asset">secure_asset</a>
			<a href="#method-route">route</a>
			<a href="#method-secure-url">secure_url</a>
			<a href="#method-url">url</a></p>
	</div>
	<h3>Miscellaneous</h3>
	<div class="collection-method-list">
		<p><a href="#method-abort">abort</a>
			<a href="#method-abort-if">abort_if</a>
			<a href="#method-abort-unless">abort_unless</a>
			<a href="#method-app">app</a>
			<a href="#method-auth">auth</a>
			<a href="#method-back">back</a>
			<a href="#method-bcrypt">bcrypt</a>
			<a href="#method-blank">blank</a>
			<a href="#method-broadcast">broadcast</a>
			<a href="#method-cache">cache</a>
			<a href="#method-class-uses-recursive">class_uses_recursive</a>
			<a href="#method-collect">collect</a>
			<a href="#method-config">config</a>
			<a href="#method-cookie">cookie</a>
			<a href="#method-csrf-field">csrf_field</a>
			<a href="#method-csrf-token">csrf_token</a>
			<a href="#method-dd">dd</a>
			<a href="#method-decrypt">decrypt</a>
			<a href="#method-dispatch">dispatch</a>
			<a href="#method-dispatch-now">dispatch_now</a>
			<a href="#method-dump">dump</a>
			<a href="#method-encrypt">encrypt</a>
			<a href="#method-env">env</a>
			<a href="#method-event">event</a>
			<a href="#method-factory">factory</a>
			<a href="#method-filled">filled</a>
			<a href="#method-info">info</a>
			<a href="#method-logger">logger</a>
			<a href="#method-method-field">method_field</a>
			<a href="#method-now">now</a>
			<a href="#method-old">old</a>
			<a href="#method-optional">optional</a>
			<a href="#method-policy">policy</a>
			<a href="#method-redirect">redirect</a>
			<a href="#method-report">report</a>
			<a href="#method-request">request</a>
			<a href="#method-rescue">rescue</a>
			<a href="#method-resolve">resolve</a>
			<a href="#method-response">response</a>
			<a href="#method-retry">retry</a>
			<a href="#method-session">session</a>
			<a href="#method-tap">tap</a>
			<a href="#method-today">today</a>
			<a href="#method-throw-if">throw_if</a>
			<a href="#method-throw-unless">throw_unless</a>
			<a href="#method-trait-uses-recursive">trait_uses_recursive</a>
			<a href="#method-transform">transform</a>
			<a href="#method-validator">validator</a>
			<a href="#method-value">value</a>
			<a href="#method-view">view</a>
			<a href="#method-with">with</a></p>
	</div>
	<p><a name="method-listing"></a></p>
	<h2><a href="#method-listing">Method Listing</a></h2>
	<style>
		#collection-method code {
			font-size: 14px;
		}

		#collection-method:not(.first-collection-method) {
			margin-top: 50px;
		}
	</style>
	<p><a name="arrays"></a></p>
	<h2><a href="#arrays">Arrays &amp; Objects</a></h2>
	<p><a name="method-array-add"></a></p>
	<h4 id="collection-method" class="first-collection-method"><code class=" language-php"><span class="token function">array_add<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">array_add</code> function adds a given key / value pair to an array if the given key doesn't already exist in the array:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token function">array_add<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Desk'</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token string">'price'</span><span class="token punctuation">,</span> <span class="token number">100</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// ['name' =&gt; 'Desk', 'price' =&gt; 100]</span></code></pre>
	<p><a name="method-array-collapse"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">array_collapse<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">array_collapse</code> function collapses an array of arrays into a single array:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token function">array_collapse<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token punctuation">[</span><span class="token number">1</span><span class="token punctuation">,</span> <span class="token number">2</span><span class="token punctuation">,</span> <span class="token number">3</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token number">4</span><span class="token punctuation">,</span> <span class="token number">5</span><span class="token punctuation">,</span> <span class="token number">6</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token number">7</span><span class="token punctuation">,</span> <span class="token number">8</span><span class="token punctuation">,</span> <span class="token number">9</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// [1, 2, 3, 4, 5, 6, 7, 8, 9]</span></code></pre>
	<p><a name="method-array-divide"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">array_divide<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">array_divide</code> function returns two arrays, one containing the keys, and the other containing the values of the given array:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token punctuation">[</span><span class="token variable">$keys</span><span class="token punctuation">,</span> <span class="token variable">$values</span><span class="token punctuation">]</span> <span class="token operator">=</span> <span class="token function">array_divide<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Desk'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// $keys: ['name']
</span><span class="token comment" spellcheck="true">
// $values: ['Desk']</span></code></pre>
	<p><a name="method-array-dot"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">array_dot<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">array_dot</code> function flattens a multi-dimensional array into a single level array that uses "dot" notation to indicate depth:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token string">'products'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'desk'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'price'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">100</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$flattened</span> <span class="token operator">=</span> <span class="token function">array_dot<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// ['products.desk.price' =&gt; 100]</span></code></pre>
	<p><a name="method-array-except"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">array_except<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">array_except</code> function removes the given key / value pairs from an array:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Desk'</span><span class="token punctuation">,</span> <span class="token string">'price'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">100</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$filtered</span> <span class="token operator">=</span> <span class="token function">array_except<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'price'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// ['name' =&gt; 'Desk']</span></code></pre>
	<p><a name="method-array-first"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">array_first<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">array_first</code> function returns the first element of an array passing a given truth test:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token number">100</span><span class="token punctuation">,</span> <span class="token number">200</span><span class="token punctuation">,</span> <span class="token number">300</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$first</span> <span class="token operator">=</span> <span class="token function">array_first<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$value</span><span class="token punctuation">,</span> <span class="token variable">$key</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token variable">$value</span> <span class="token operator">&gt;=</span> <span class="token number">150</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// 200</span></code></pre>
	<p>A default value may also be passed as the third parameter to the method. This value will be returned if no value passes the truth test:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$first</span> <span class="token operator">=</span> <span class="token function">array_first<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">,</span> <span class="token variable">$callback</span><span class="token punctuation">,</span> <span class="token variable">$default</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-array-flatten"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">array_flatten<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">array_flatten</code> function flattens a multi-dimensional array into a single level array:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Joe'</span><span class="token punctuation">,</span> <span class="token string">'languages'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'PHP'</span><span class="token punctuation">,</span> <span class="token string">'Ruby'</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$flattened</span> <span class="token operator">=</span> <span class="token function">array_flatten<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// ['Joe', 'PHP', 'Ruby']</span></code></pre>
	<p><a name="method-array-forget"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">array_forget<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">array_forget</code> function removes a given key / value pair from a deeply nested array using "dot" notation:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token string">'products'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'desk'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'price'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">100</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token function">array_forget<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">,</span> <span class="token string">'products.desk'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// ['products' =&gt; []]</span></code></pre>
	<p><a name="method-array-get"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">array_get<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">array_get</code> function retrieves a value from a deeply nested array using "dot" notation:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token string">'products'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'desk'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'price'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">100</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$price</span> <span class="token operator">=</span> <span class="token function">array_get<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">,</span> <span class="token string">'products.desk.price'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// 100</span></code></pre>
	<p>The <code class=" language-php">array_get</code> function also accepts a default value, which will be returned if the specific key is not found:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$discount</span> <span class="token operator">=</span> <span class="token function">array_get<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">,</span> <span class="token string">'products.desk.discount'</span><span class="token punctuation">,</span> <span class="token number">0</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// 0</span></code></pre>
	<p><a name="method-array-has"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">array_has<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">array_has</code> function checks whether a given item or items exists in an array using "dot" notation:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token string">'product'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Desk'</span><span class="token punctuation">,</span> <span class="token string">'price'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">100</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$contains</span> <span class="token operator">=</span> <span class="token function">array_has<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">,</span> <span class="token string">'product.name'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// true
</span>
<span class="token variable">$contains</span> <span class="token operator">=</span> <span class="token function">array_has<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'product.price'</span><span class="token punctuation">,</span> <span class="token string">'product.discount'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// false</span></code></pre>
	<p><a name="method-array-last"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">array_last<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">array_last</code> function returns the last element of an array passing a given truth test:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token number">100</span><span class="token punctuation">,</span> <span class="token number">200</span><span class="token punctuation">,</span> <span class="token number">300</span><span class="token punctuation">,</span> <span class="token number">110</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$last</span> <span class="token operator">=</span> <span class="token function">array_last<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$value</span><span class="token punctuation">,</span> <span class="token variable">$key</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token variable">$value</span> <span class="token operator">&gt;=</span> <span class="token number">150</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// 300</span></code></pre>
	<p>A default value may be passed as the third argument to the method. This value will be returned if no value passes the truth test:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$last</span> <span class="token operator">=</span> <span class="token function">array_last<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">,</span> <span class="token variable">$callback</span><span class="token punctuation">,</span> <span class="token variable">$default</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-array-only"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">array_only<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">array_only</code> function returns only the specified key / value pairs from the given array:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Desk'</span><span class="token punctuation">,</span> <span class="token string">'price'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">100</span><span class="token punctuation">,</span> <span class="token string">'orders'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">10</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$slice</span> <span class="token operator">=</span> <span class="token function">array_only<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'name'</span><span class="token punctuation">,</span> <span class="token string">'price'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// ['name' =&gt; 'Desk', 'price' =&gt; 100]</span></code></pre>
	<p><a name="method-array-pluck"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">array_pluck<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">array_pluck</code> function retrieves all of the values for a given key from an array:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token punctuation">[</span>
    <span class="token punctuation">[</span><span class="token string">'developer'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'id'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">1</span><span class="token punctuation">,</span> <span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Taylor'</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
    <span class="token punctuation">[</span><span class="token string">'developer'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'id'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">2</span><span class="token punctuation">,</span> <span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Abigail'</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$names</span> <span class="token operator">=</span> <span class="token function">array_pluck<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">,</span> <span class="token string">'developer.name'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// ['Taylor', 'Abigail']</span></code></pre>
	<p>You may also specify how you wish the resulting list to be keyed:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$names</span> <span class="token operator">=</span> <span class="token function">array_pluck<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">,</span> <span class="token string">'developer.name'</span><span class="token punctuation">,</span> <span class="token string">'developer.id'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// [1 =&gt; 'Taylor', 2 =&gt; 'Abigail']</span></code></pre>
	<p><a name="method-array-prepend"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">array_prepend<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">array_prepend</code> function will push an item onto the beginning of an array:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token string">'one'</span><span class="token punctuation">,</span> <span class="token string">'two'</span><span class="token punctuation">,</span> <span class="token string">'three'</span><span class="token punctuation">,</span> <span class="token string">'four'</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$array</span> <span class="token operator">=</span> <span class="token function">array_prepend<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">,</span> <span class="token string">'zero'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// ['zero', 'one', 'two', 'three', 'four']</span></code></pre>
	<p>If needed, you may specify the key that should be used for the value:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token string">'price'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">100</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$array</span> <span class="token operator">=</span> <span class="token function">array_prepend<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">,</span> <span class="token string">'Desk'</span><span class="token punctuation">,</span> <span class="token string">'name'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// ['name' =&gt; 'Desk', 'price' =&gt; 100]</span></code></pre>
	<p><a name="method-array-pull"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">array_pull<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">array_pull</code> function returns and removes a key / value pair from an array:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Desk'</span><span class="token punctuation">,</span> <span class="token string">'price'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">100</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$name</span> <span class="token operator">=</span> <span class="token function">array_pull<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">,</span> <span class="token string">'name'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// $name: Desk
</span><span class="token comment" spellcheck="true">
// $array: ['price' =&gt; 100]</span></code></pre>
	<p>A default value may be passed as the third argument to the method. This value will be returned if the key doesn't exist:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$value</span> <span class="token operator">=</span> <span class="token function">array_pull<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">,</span> <span class="token variable">$key</span><span class="token punctuation">,</span> <span class="token variable">$default</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-array-random"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">array_random<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">array_random</code> function returns a random value from an array:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token number">1</span><span class="token punctuation">,</span> <span class="token number">2</span><span class="token punctuation">,</span> <span class="token number">3</span><span class="token punctuation">,</span> <span class="token number">4</span><span class="token punctuation">,</span> <span class="token number">5</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$random</span> <span class="token operator">=</span> <span class="token function">array_random<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// 4 - (retrieved randomly)</span></code></pre>
	<p>You may also specify the number of items to return as an optional second argument. Note that providing this argument will return an array, even if only one item is desired:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$items</span> <span class="token operator">=</span> <span class="token function">array_random<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">,</span> <span class="token number">2</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// [2, 5] - (retrieved randomly)</span></code></pre>
	<p><a name="method-array-set"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">array_set<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">array_set</code> function sets a value within a deeply nested array using "dot" notation:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token string">'products'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'desk'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'price'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">100</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token function">array_set<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">,</span> <span class="token string">'products.desk.price'</span><span class="token punctuation">,</span> <span class="token number">200</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// ['products' =&gt; ['desk' =&gt; ['price' =&gt; 200]]]</span></code></pre>
	<p><a name="method-array-sort"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">array_sort<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">array_sort</code> function sorts an array by its values:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token string">'Desk'</span><span class="token punctuation">,</span> <span class="token string">'Table'</span><span class="token punctuation">,</span> <span class="token string">'Chair'</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$sorted</span> <span class="token operator">=</span> <span class="token function">array_sort<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// ['Chair', 'Desk', 'Table']</span></code></pre>
	<p>You may also sort the array by the results of the given Closure:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token punctuation">[</span>
    <span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Desk'</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
    <span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Table'</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
    <span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Chair'</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$sorted</span> <span class="token operator">=</span> <span class="token function">array_values<span class="token punctuation">(</span></span><span class="token function">array_sort<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$value</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token variable">$value</span><span class="token punctuation">[</span><span class="token string">'name'</span><span class="token punctuation">]</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token comment" spellcheck="true">/*
    [
        ['name' =&gt; 'Chair'],
        ['name' =&gt; 'Desk'],
        ['name' =&gt; 'Table'],
    ]
*/</span></code></pre>
	<p><a name="method-array-sort-recursive"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">array_sort_recursive<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">array_sort_recursive</code> function recursively sorts an array using the <code class=" language-php">sort</code> function for numeric sub=arrays and <code class=" language-php">ksort</code> for associative sub-arrays:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token punctuation">[</span>
    <span class="token punctuation">[</span><span class="token string">'Roman'</span><span class="token punctuation">,</span> <span class="token string">'Taylor'</span><span class="token punctuation">,</span> <span class="token string">'Li'</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
    <span class="token punctuation">[</span><span class="token string">'PHP'</span><span class="token punctuation">,</span> <span class="token string">'Ruby'</span><span class="token punctuation">,</span> <span class="token string">'JavaScript'</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
    <span class="token punctuation">[</span><span class="token string">'one'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">1</span><span class="token punctuation">,</span> <span class="token string">'two'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">2</span><span class="token punctuation">,</span> <span class="token string">'three'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">3</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$sorted</span> <span class="token operator">=</span> <span class="token function">array_sort_recursive<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token comment" spellcheck="true">/*
    [
        ['JavaScript', 'PHP', 'Ruby'],
        ['one' =&gt; 1, 'three' =&gt; 3, 'two' =&gt; 2],
        ['Li', 'Roman', 'Taylor'],
    ]
*/</span></code></pre>
	<p><a name="method-array-where"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">array_where<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">array_where</code> function filters an array using the given Closure:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token number">100</span><span class="token punctuation">,</span> <span class="token string">'200'</span><span class="token punctuation">,</span> <span class="token number">300</span><span class="token punctuation">,</span> <span class="token string">'400'</span><span class="token punctuation">,</span> <span class="token number">500</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$filtered</span> <span class="token operator">=</span> <span class="token function">array_where<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$value</span><span class="token punctuation">,</span> <span class="token variable">$key</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token function">is_string<span class="token punctuation">(</span></span><span class="token variable">$value</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// [1 =&gt; '200', 3 =&gt; '400']</span></code></pre>
	<p><a name="method-array-wrap"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">array_wrap<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">array_wrap</code> function wraps the given value in an array. If the given value is already an array it will not be changed:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$string</span> <span class="token operator">=</span> <span class="token string">'Laravel'</span><span class="token punctuation">;</span>

<span class="token variable">$array</span> <span class="token operator">=</span> <span class="token function">array_wrap<span class="token punctuation">(</span></span><span class="token variable">$string</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// ['Laravel']</span></code></pre>
	<p>If the given value is null, an empty array will be returned:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$nothing</span> <span class="token operator">=</span> <span class="token keyword">null</span><span class="token punctuation">;</span>

<span class="token variable">$array</span> <span class="token operator">=</span> <span class="token function">array_wrap<span class="token punctuation">(</span></span><span class="token variable">$nothing</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// []</span></code></pre>
	<p><a name="method-data-fill"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">data_fill<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">data_fill</code> function sets a missing value within a nested array or object using "dot" notation:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$data</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token string">'products'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'desk'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'price'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">100</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token function">data_fill<span class="token punctuation">(</span></span><span class="token variable">$data</span><span class="token punctuation">,</span> <span class="token string">'products.desk.price'</span><span class="token punctuation">,</span> <span class="token number">200</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// ['products' =&gt; ['desk' =&gt; ['price' =&gt; 100]]]
</span>
<span class="token function">data_fill<span class="token punctuation">(</span></span><span class="token variable">$data</span><span class="token punctuation">,</span> <span class="token string">'products.desk.discount'</span><span class="token punctuation">,</span> <span class="token number">10</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// ['products' =&gt; ['desk' =&gt; ['price' =&gt; 100, 'discount' =&gt; 10]]]</span></code></pre>
	<p>This function also accepts asterisks as wildcards and will fill the target accordingly:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$data</span> <span class="token operator">=</span> <span class="token punctuation">[</span>
    <span class="token string">'products'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Desk 1'</span><span class="token punctuation">,</span> <span class="token string">'price'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">100</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
        <span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Desk 2'</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token function">data_fill<span class="token punctuation">(</span></span><span class="token variable">$data</span><span class="token punctuation">,</span> <span class="token string">'products.*.price'</span><span class="token punctuation">,</span> <span class="token number">200</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token comment" spellcheck="true">/*
    [
        'products' =&gt; [
            ['name' =&gt; 'Desk 1', 'price' =&gt; 100],
            ['name' =&gt; 'Desk 2', 'price' =&gt; 200],
        ],
    ]
*/</span></code></pre>
	<p><a name="method-data-get"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">data_get<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">data_get</code> function retrieves a value from a nested array or object using "dot" notation:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$data</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token string">'products'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'desk'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'price'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">100</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$price</span> <span class="token operator">=</span> <span class="token function">data_get<span class="token punctuation">(</span></span><span class="token variable">$data</span><span class="token punctuation">,</span> <span class="token string">'products.desk.price'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// 100</span></code></pre>
	<p>The <code class=" language-php">data_get</code> function also accepts a default value, which will be returned if the specified key is not found:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$discount</span> <span class="token operator">=</span> <span class="token function">data_get<span class="token punctuation">(</span></span><span class="token variable">$data</span><span class="token punctuation">,</span> <span class="token string">'products.desk.discount'</span><span class="token punctuation">,</span> <span class="token number">0</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// 0</span></code></pre>
	<p>The function also accepts wildcards using asterisks, which may target any key of the array or object:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$data</span> <span class="token operator">=</span> <span class="token punctuation">[</span>
    <span class="token string">'product-one'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Desk 1'</span><span class="token punctuation">,</span> <span class="token string">'price'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">100</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
    <span class="token string">'product-two'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Desk 2'</span><span class="token punctuation">,</span> <span class="token string">'price'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">150</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token function">data_get<span class="token punctuation">(</span></span><span class="token variable">$data</span><span class="token punctuation">,</span> <span class="token string">'*.name'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// ['Desk 1', 'Desk 2'];</span></code></pre>
	<p><a name="method-data-set"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">data_set<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">data_set</code> function sets a value within a nested array or object using "dot" notation:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$data</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token string">'products'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'desk'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'price'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">100</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token function">data_set<span class="token punctuation">(</span></span><span class="token variable">$data</span><span class="token punctuation">,</span> <span class="token string">'products.desk.price'</span><span class="token punctuation">,</span> <span class="token number">200</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// ['products' =&gt; ['desk' =&gt; ['price' =&gt; 200]]]</span></code></pre>
	<p>This function also accepts wildcards and will set values on the target accordingly:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$data</span> <span class="token operator">=</span> <span class="token punctuation">[</span>
    <span class="token string">'products'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Desk 1'</span><span class="token punctuation">,</span> <span class="token string">'price'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">100</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
        <span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Desk 2'</span><span class="token punctuation">,</span> <span class="token string">'price'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">150</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token function">data_set<span class="token punctuation">(</span></span><span class="token variable">$data</span><span class="token punctuation">,</span> <span class="token string">'products.*.price'</span><span class="token punctuation">,</span> <span class="token number">200</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token comment" spellcheck="true">/*
    [
        'products' =&gt; [
            ['name' =&gt; 'Desk 1', 'price' =&gt; 200],
            ['name' =&gt; 'Desk 2', 'price' =&gt; 200],
        ],
    ]
*/</span></code></pre>
	<p>By default, any existing values are overwritten. If you wish to only set a value if it doesn't exist, you may pass <code class=" language-php"><span class="token boolean">false</span></code> as the third argument:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$data</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token string">'products'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'desk'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'price'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">100</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token function">data_set<span class="token punctuation">(</span></span><span class="token variable">$data</span><span class="token punctuation">,</span> <span class="token string">'products.desk.price'</span><span class="token punctuation">,</span> <span class="token number">200</span><span class="token punctuation">,</span> <span class="token boolean">false</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// ['products' =&gt; ['desk' =&gt; ['price' =&gt; 100]]]</span></code></pre>
	<p><a name="method-head"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">head<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">head</code> function returns the first element in the given array:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token number">100</span><span class="token punctuation">,</span> <span class="token number">200</span><span class="token punctuation">,</span> <span class="token number">300</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$first</span> <span class="token operator">=</span> <span class="token function">head<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// 100</span></code></pre>
	<p><a name="method-last"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">last<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">last</code> function returns the last element in the given array:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$array</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token number">100</span><span class="token punctuation">,</span> <span class="token number">200</span><span class="token punctuation">,</span> <span class="token number">300</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$last</span> <span class="token operator">=</span> <span class="token function">last<span class="token punctuation">(</span></span><span class="token variable">$array</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// 300</span></code></pre>
	<p><a name="paths"></a></p>
	<h2><a href="#paths">Paths</a></h2>
	<p><a name="method-app-path"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">app_path<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">app_path</code> function returns the fully qualified path to the <code class=" language-php">app</code> directory. You may also use the <code class=" language-php">app_path</code> function to generate a fully qualified path to a file relative to the application directory:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$path</span> <span class="token operator">=</span> <span class="token function">app_path<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$path</span> <span class="token operator">=</span> <span class="token function">app_path<span class="token punctuation">(</span></span><span class="token string">'Http/Controllers/Controller.php'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-base-path"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">base_path<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">base_path</code> function returns the fully qualified path to the project root. You may also use the <code class=" language-php">base_path</code> function to generate a fully qualified path to a given file relative to the project root directory:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$path</span> <span class="token operator">=</span> <span class="token function">base_path<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$path</span> <span class="token operator">=</span> <span class="token function">base_path<span class="token punctuation">(</span></span><span class="token string">'vendor/bin'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-config-path"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">config_path<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">config_path</code> function returns the fully qualified path to the <code class=" language-php">config</code> directory. You may also use the <code class=" language-php">config_path</code> function to generate a fully qualified path to a given file within the application's configuration directory:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$path</span> <span class="token operator">=</span> <span class="token function">config_path<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$path</span> <span class="token operator">=</span> <span class="token function">config_path<span class="token punctuation">(</span></span><span class="token string">'app.php'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-database-path"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">database_path<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">database_path</code> function returns the fully qualified path to the <code class=" language-php">database</code> directory. You may also use the <code class=" language-php">database_path</code> function to generate a fully qualified path to a given file within the database directory:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$path</span> <span class="token operator">=</span> <span class="token function">database_path<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$path</span> <span class="token operator">=</span> <span class="token function">database_path<span class="token punctuation">(</span></span><span class="token string">'factories/UserFactory.php'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-mix"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">mix<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">mix</code> function returns the path to a <a href="/docs/5.7/mix">versioned Mix file</a>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$path</span> <span class="token operator">=</span> <span class="token function">mix<span class="token punctuation">(</span></span><span class="token string">'css/app.css'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-public-path"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">public_path<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">public_path</code> function returns the fully qualified path to the <code class=" language-php"><span class="token keyword">public</span></code> directory. You may also use the <code class=" language-php">public_path</code> function to generate a fully qualified path to a given file within the public directory:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$path</span> <span class="token operator">=</span> <span class="token function">public_path<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$path</span> <span class="token operator">=</span> <span class="token function">public_path<span class="token punctuation">(</span></span><span class="token string">'css/app.css'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-resource-path"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">resource_path<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">resource_path</code> function returns the fully qualified path to the <code class=" language-php">resources</code> directory. You may also use the <code class=" language-php">resource_path</code> function to generate a fully qualified path to a given file within the resources directory:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$path</span> <span class="token operator">=</span> <span class="token function">resource_path<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$path</span> <span class="token operator">=</span> <span class="token function">resource_path<span class="token punctuation">(</span></span><span class="token string">'sass/app.scss'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-storage-path"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">storage_path<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">storage_path</code> function returns the fully qualified path to the <code class=" language-php">storage</code> directory. You may also use the <code class=" language-php">storage_path</code> function to generate a fully qualified path to a given file within the storage directory:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$path</span> <span class="token operator">=</span> <span class="token function">storage_path<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$path</span> <span class="token operator">=</span> <span class="token function">storage_path<span class="token punctuation">(</span></span><span class="token string">'app/file.txt'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="strings"></a></p>
	<h2><a href="#strings">Strings</a></h2>
	<p><a name="method-__"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">__<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php"><span class="token constant">__</span></code> function translates the given translation string or translation key using your <a href="/docs/5.7/localization">localization files</a>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">echo</span> <span class="token function">__<span class="token punctuation">(</span></span><span class="token string">'Welcome to our application'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token keyword">echo</span> <span class="token function">__<span class="token punctuation">(</span></span><span class="token string">'messages.welcome'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>If the specified translation string or key does not exist, the <code class=" language-php"><span class="token constant">__</span></code> function will return the given value. So, using the example above, the <code class=" language-php"><span class="token constant">__</span></code> function would return <code class=" language-php">messages<span class="token punctuation">.</span>welcome</code> if that translation key does not exist.</p>
	<p><a name="method-camel-case"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">camel_case<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">camel_case</code> function converts the given string to <code class=" language-php">camelCase</code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$converted</span> <span class="token operator">=</span> <span class="token function">camel_case<span class="token punctuation">(</span></span><span class="token string">'foo_bar'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// fooBar</span></code></pre>
	<p><a name="method-class-basename"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">class_basename<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">class_basename</code> returns the class name of the given class with the class' namespace removed:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$class</span> <span class="token operator">=</span> <span class="token function">class_basename<span class="token punctuation">(</span></span><span class="token string">'Foo\Bar\Baz'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// Baz</span></code></pre>
	<p><a name="method-e"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">e<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">e</code> function runs PHP's <code class=" language-php">htmlspecialchars</code> function with the <code class=" language-php">double_encode</code> option set to <code class=" language-php"><span class="token boolean">true</span></code> by default:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">echo</span> <span class="token function">e<span class="token punctuation">(</span></span>'<span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>html</span><span class="token punctuation">&gt;</span></span></span>foo<span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>html</span><span class="token punctuation">&gt;</span></span></span>'<span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// &amp;lt;html&amp;gt;foo&amp;lt;/html&amp;gt;</span></code></pre>
	<p><a name="method-ends-with"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">ends_with<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">ends_with</code> function determines if the given string ends with the given value:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$result</span> <span class="token operator">=</span> <span class="token function">ends_with<span class="token punctuation">(</span></span><span class="token string">'This is my name'</span><span class="token punctuation">,</span> <span class="token string">'name'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// true</span></code></pre>
	<p><a name="method-kebab-case"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">kebab_case<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">kebab_case</code> function converts the given string to <code class=" language-php">kebab<span class="token operator">-</span><span class="token keyword">case</span></code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$converted</span> <span class="token operator">=</span> <span class="token function">kebab_case<span class="token punctuation">(</span></span><span class="token string">'fooBar'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// foo-bar</span></code></pre>
	<p><a name="method-preg-replace-array"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">preg_replace_array<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">preg_replace_array</code> function replaces a given pattern in the string sequentially using an array:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$string</span> <span class="token operator">=</span> <span class="token string">'The event will take place between :start and :end'</span><span class="token punctuation">;</span>

<span class="token variable">$replaced</span> <span class="token operator">=</span> <span class="token function">preg_replace_array<span class="token punctuation">(</span></span><span class="token string">'/:[a-z_]+/'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'8:30'</span><span class="token punctuation">,</span> <span class="token string">'9:00'</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token variable">$string</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// The event will take place between 8:30 and 9:00</span></code></pre>
	<p><a name="method-snake-case"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">snake_case<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">snake_case</code> function converts the given string to <code class=" language-php">snake_case</code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$converted</span> <span class="token operator">=</span> <span class="token function">snake_case<span class="token punctuation">(</span></span><span class="token string">'fooBar'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// foo_bar</span></code></pre>
	<p><a name="method-starts-with"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">starts_with<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">starts_with</code> function determines if the given string begins with the given value:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$result</span> <span class="token operator">=</span> <span class="token function">starts_with<span class="token punctuation">(</span></span><span class="token string">'This is my name'</span><span class="token punctuation">,</span> <span class="token string">'This'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// true</span></code></pre>
	<p><a name="method-str-after"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">str_after<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">str_after</code> function returns everything after the given value in a string:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$slice</span> <span class="token operator">=</span> <span class="token function">str_after<span class="token punctuation">(</span></span><span class="token string">'This is my name'</span><span class="token punctuation">,</span> <span class="token string">'This is'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// ' my name'</span></code></pre>
	<p><a name="method-str-before"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">str_before<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">str_before</code> function returns everything before the given value in a string:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$slice</span> <span class="token operator">=</span> <span class="token function">str_before<span class="token punctuation">(</span></span><span class="token string">'This is my name'</span><span class="token punctuation">,</span> <span class="token string">'my name'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// 'This is '</span></code></pre>
	<p><a name="method-str-contains"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">str_contains<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">str_contains</code> function determines if the given string contains the given value (case sensitive):</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$contains</span> <span class="token operator">=</span> <span class="token function">str_contains<span class="token punctuation">(</span></span><span class="token string">'This is my name'</span><span class="token punctuation">,</span> <span class="token string">'my'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// true</span></code></pre>
	<p>You may also pass an array of values to determine if the given string contains any of the values:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$contains</span> <span class="token operator">=</span> <span class="token function">str_contains<span class="token punctuation">(</span></span><span class="token string">'This is my name'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'my'</span><span class="token punctuation">,</span> <span class="token string">'foo'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// true</span></code></pre>
	<p><a name="method-str-finish"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">str_finish<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">str_finish</code> function adds a single instance of the given value to a string if it does not already end with the value:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$adjusted</span> <span class="token operator">=</span> <span class="token function">str_finish<span class="token punctuation">(</span></span><span class="token string">'this/string'</span><span class="token punctuation">,</span> <span class="token string">'/'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// this/string/
</span>
<span class="token variable">$adjusted</span> <span class="token operator">=</span> <span class="token function">str_finish<span class="token punctuation">(</span></span><span class="token string">'this/string/'</span><span class="token punctuation">,</span> <span class="token string">'/'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// this/string/</span></code></pre>
	<p><a name="method-str-is"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">str_is<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">str_is</code> function determines if a given string matches a given pattern. Asterisks may be used to indicate wildcards:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$matches</span> <span class="token operator">=</span> <span class="token function">str_is<span class="token punctuation">(</span></span><span class="token string">'foo*'</span><span class="token punctuation">,</span> <span class="token string">'foobar'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// true
</span>
<span class="token variable">$matches</span> <span class="token operator">=</span> <span class="token function">str_is<span class="token punctuation">(</span></span><span class="token string">'baz*'</span><span class="token punctuation">,</span> <span class="token string">'foobar'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// false</span></code></pre>
	<p><a name="method-str-limit"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">str_limit<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">str_limit</code> function truncates the given string at the specified length:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$truncated</span> <span class="token operator">=</span> <span class="token function">str_limit<span class="token punctuation">(</span></span><span class="token string">'The quick brown fox jumps over the lazy dog'</span><span class="token punctuation">,</span> <span class="token number">20</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// The quick brown fox...</span></code></pre>
	<p>You may also pass a third argument to change the string that will be appended to the end:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$truncated</span> <span class="token operator">=</span> <span class="token function">str_limit<span class="token punctuation">(</span></span><span class="token string">'The quick brown fox jumps over the lazy dog'</span><span class="token punctuation">,</span> <span class="token number">20</span><span class="token punctuation">,</span> <span class="token string">' (...)'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// The quick brown fox (...)</span></code></pre>
	<p><a name="method-str-ordered-uuid"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token scope">Str<span class="token punctuation">::</span></span><span class="token function">orderedUuid<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php"><span class="token scope">Str<span class="token punctuation">::</span></span>orderedUuid</code> method generates a "timestamp first" UUID that may be efficiently stored in an indexed database column:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Str</span><span class="token punctuation">;</span>

<span class="token keyword">return</span> <span class="token punctuation">(</span>string<span class="token punctuation">)</span> <span class="token scope">Str<span class="token punctuation">::</span></span><span class="token function">orderedUuid<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-str-plural"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">str_plural<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">str_plural</code> function converts a string to its plural form. This function currently only supports the English language:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$plural</span> <span class="token operator">=</span> <span class="token function">str_plural<span class="token punctuation">(</span></span><span class="token string">'car'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// cars
</span>
<span class="token variable">$plural</span> <span class="token operator">=</span> <span class="token function">str_plural<span class="token punctuation">(</span></span><span class="token string">'child'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// children</span></code></pre>
	<p>You may provide an integer as a second argument to the function to retrieve the singular or plural form of the string:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$plural</span> <span class="token operator">=</span> <span class="token function">str_plural<span class="token punctuation">(</span></span><span class="token string">'child'</span><span class="token punctuation">,</span> <span class="token number">2</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// children
</span>
<span class="token variable">$plural</span> <span class="token operator">=</span> <span class="token function">str_plural<span class="token punctuation">(</span></span><span class="token string">'child'</span><span class="token punctuation">,</span> <span class="token number">1</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// child</span></code></pre>
	<p><a name="method-str-random"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">str_random<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">str_random</code> function generates a random string of the specified length. This function uses PHP's <code class=" language-php">random_bytes</code> function:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$random</span> <span class="token operator">=</span> <span class="token function">str_random<span class="token punctuation">(</span></span><span class="token number">40</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-str-replace-array"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">str_replace_array<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">str_replace_array</code> function replaces a given value in the string sequentially using an array:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$string</span> <span class="token operator">=</span> <span class="token string">'The event will take place between ? and ?'</span><span class="token punctuation">;</span>

<span class="token variable">$replaced</span> <span class="token operator">=</span> <span class="token function">str_replace_array<span class="token punctuation">(</span></span><span class="token string">'?'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'8:30'</span><span class="token punctuation">,</span> <span class="token string">'9:00'</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token variable">$string</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// The event will take place between 8:30 and 9:00</span></code></pre>
	<p><a name="method-str-replace-first"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">str_replace_first<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">str_replace_first</code> function replaces the first occurrence of a given value in a string:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$replaced</span> <span class="token operator">=</span> <span class="token function">str_replace_first<span class="token punctuation">(</span></span><span class="token string">'the'</span><span class="token punctuation">,</span> <span class="token string">'a'</span><span class="token punctuation">,</span> <span class="token string">'the quick brown fox jumps over the lazy dog'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// a quick brown fox jumps over the lazy dog</span></code></pre>
	<p><a name="method-str-replace-last"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">str_replace_last<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">str_replace_last</code> function replaces the last occurrence of a given value in a string:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$replaced</span> <span class="token operator">=</span> <span class="token function">str_replace_last<span class="token punctuation">(</span></span><span class="token string">'the'</span><span class="token punctuation">,</span> <span class="token string">'a'</span><span class="token punctuation">,</span> <span class="token string">'the quick brown fox jumps over the lazy dog'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// the quick brown fox jumps over a lazy dog</span></code></pre>
	<p><a name="method-str-singular"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">str_singular<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">str_singular</code> function converts a string to its singular form. This function currently only supports the English language:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$singular</span> <span class="token operator">=</span> <span class="token function">str_singular<span class="token punctuation">(</span></span><span class="token string">'cars'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// car
</span>
<span class="token variable">$singular</span> <span class="token operator">=</span> <span class="token function">str_singular<span class="token punctuation">(</span></span><span class="token string">'children'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// child</span></code></pre>
	<p><a name="method-str-slug"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">str_slug<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">str_slug</code> function generates a URL friendly "slug" from the given string:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$slug</span> <span class="token operator">=</span> <span class="token function">str_slug<span class="token punctuation">(</span></span><span class="token string">'Laravel 5 Framework'</span><span class="token punctuation">,</span> <span class="token string">'-'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// laravel-5-framework</span></code></pre>
	<p><a name="method-str-start"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">str_start<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">str_start</code> function adds a single instance of the given value to a string if it does not already start with the value:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$adjusted</span> <span class="token operator">=</span> <span class="token function">str_start<span class="token punctuation">(</span></span><span class="token string">'this/string'</span><span class="token punctuation">,</span> <span class="token string">'/'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// /this/string
</span>
<span class="token variable">$adjusted</span> <span class="token operator">=</span> <span class="token function">str_start<span class="token punctuation">(</span></span><span class="token string">'/this/string'</span><span class="token punctuation">,</span> <span class="token string">'/'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// /this/string</span></code></pre>
	<p><a name="method-studly-case"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">studly_case<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">studly_case</code> function converts the given string to <code class=" language-php">StudlyCase</code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$converted</span> <span class="token operator">=</span> <span class="token function">studly_case<span class="token punctuation">(</span></span><span class="token string">'foo_bar'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// FooBar</span></code></pre>
	<p><a name="method-title-case"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">title_case<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">title_case</code> function converts the given string to <code class=" language-php">Title <span class="token keyword">Case</span></code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$converted</span> <span class="token operator">=</span> <span class="token function">title_case<span class="token punctuation">(</span></span><span class="token string">'a nice title uses the correct case'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// A Nice Title Uses The Correct Case</span></code></pre>
	<p><a name="method-trans"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">trans<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">trans</code> function translates the given translation key using your <a href="/docs/5.7/localization">localization files</a>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">echo</span> <span class="token function">trans<span class="token punctuation">(</span></span><span class="token string">'messages.welcome'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>If the specified translation key does not exist, the <code class=" language-php">trans</code> function will return the given key. So, using the example above, the <code class=" language-php">trans</code> function would return <code class=" language-php">messages<span class="token punctuation">.</span>welcome</code> if the translation key does not exist.</p>
	<p><a name="method-trans-choice"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">trans_choice<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">trans_choice</code> function translates the given translation key with inflection:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">echo</span> <span class="token function">trans_choice<span class="token punctuation">(</span></span><span class="token string">'messages.notifications'</span><span class="token punctuation">,</span> <span class="token variable">$unreadCount</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>If the specified translation key does not exist, the <code class=" language-php">trans_choice</code> function will return the given key. So, using the example above, the <code class=" language-php">trans_choice</code> function would return <code class=" language-php">messages<span class="token punctuation">.</span>notifications</code> if the translation key does not exist.</p>
	<p><a name="method-str-uuid"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token scope">Str<span class="token punctuation">::</span></span><span class="token function">uuid<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php"><span class="token scope">Str<span class="token punctuation">::</span></span>uuid</code> method generates a UUID (version 4):</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Str</span><span class="token punctuation">;</span>

<span class="token keyword">return</span> <span class="token punctuation">(</span>string<span class="token punctuation">)</span> <span class="token scope">Str<span class="token punctuation">::</span></span><span class="token function">uuid<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="urls"></a></p>
	<h2><a href="#urls">URLs</a></h2>
	<p><a name="method-action"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">action<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">action</code> function generates a URL for the given controller action. You do not need to pass the full namespace of the controller. Instead, pass the controller class name relative to the <code class=" language-php">App\<span class="token package">Http<span class="token punctuation">\</span>Controllers</span></code> namespace:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$url</span> <span class="token operator">=</span> <span class="token function">action<span class="token punctuation">(</span></span><span class="token string">'HomeController@index'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$url</span> <span class="token operator">=</span> <span class="token function">action<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token scope">HomeController<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span> <span class="token string">'index'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>If the method accepts route parameters, you may pass them as the second argument to the method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$url</span> <span class="token operator">=</span> <span class="token function">action<span class="token punctuation">(</span></span><span class="token string">'UserController@profile'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'id'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">1</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-asset"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">asset<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">asset</code> function generates a URL for an asset using the current scheme of the request (HTTP or HTTPS):</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$url</span> <span class="token operator">=</span> <span class="token function">asset<span class="token punctuation">(</span></span><span class="token string">'img/photo.jpg'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-secure-asset"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">secure_asset<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">secure_asset</code> function generates a URL for an asset using HTTPS:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$url</span> <span class="token operator">=</span> <span class="token function">secure_asset<span class="token punctuation">(</span></span><span class="token string">'img/photo.jpg'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-route"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">route<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">route</code> function generates a URL for the given named route:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$url</span> <span class="token operator">=</span> <span class="token function">route<span class="token punctuation">(</span></span><span class="token string">'routeName'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>If the route accepts parameters, you may pass them as the second argument to the method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$url</span> <span class="token operator">=</span> <span class="token function">route<span class="token punctuation">(</span></span><span class="token string">'routeName'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'id'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">1</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>By default, the <code class=" language-php">route</code> function generates an absolute URL. If you wish to generate a relative URL, you may pass <code class=" language-php"><span class="token boolean">false</span></code> as the third argument:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$url</span> <span class="token operator">=</span> <span class="token function">route<span class="token punctuation">(</span></span><span class="token string">'routeName'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'id'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">1</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token boolean">false</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-secure-url"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">secure_url<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">secure_url</code> function generates a fully qualified HTTPS URL to the given path:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$url</span> <span class="token operator">=</span> <span class="token function">secure_url<span class="token punctuation">(</span></span><span class="token string">'user/profile'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$url</span> <span class="token operator">=</span> <span class="token function">secure_url<span class="token punctuation">(</span></span><span class="token string">'user/profile'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token number">1</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-url"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">url<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">url</code> function generates a fully qualified URL to the given path:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$url</span> <span class="token operator">=</span> <span class="token function">url<span class="token punctuation">(</span></span><span class="token string">'user/profile'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$url</span> <span class="token operator">=</span> <span class="token function">url<span class="token punctuation">(</span></span><span class="token string">'user/profile'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token number">1</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>If no path is provided, a <code class=" language-php">Illuminate\<span class="token package">Routing<span class="token punctuation">\</span>UrlGenerator</span></code> instance is returned:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$current</span> <span class="token operator">=</span> <span class="token function">url<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">current<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$full</span> <span class="token operator">=</span> <span class="token function">url<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">full<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$previous</span> <span class="token operator">=</span> <span class="token function">url<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">previous<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="miscellaneous"></a></p>
	<h2><a href="#miscellaneous">Miscellaneous</a></h2>
	<p><a name="method-abort"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">abort<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">abort</code> function throws <a href="/docs/5.7/errors#http-exceptions">an HTTP exception</a> which will be rendered by the <a href="/docs/5.7/errors#the-exception-handler">exception handler</a>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">abort<span class="token punctuation">(</span></span><span class="token number">403</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>You may also provide the exception's response text and custom response headers:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">abort<span class="token punctuation">(</span></span><span class="token number">403</span><span class="token punctuation">,</span> <span class="token string">'Unauthorized.'</span><span class="token punctuation">,</span> <span class="token variable">$headers</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-abort-if"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">abort_if<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">abort_if</code> function throws an HTTP exception if a given boolean expression evaluates to <code class=" language-php"><span class="token boolean">true</span></code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">abort_if<span class="token punctuation">(</span></span><span class="token operator">!</span> <span class="token scope">Auth<span class="token punctuation">::</span></span><span class="token function">user<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">isAdmin<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">,</span> <span class="token number">403</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>Like the <code class=" language-php">abort</code> method, you may also provide the exception's response text as the third argument and an array of custom response headers as the fourth argument.</p>
	<p><a name="method-abort-unless"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">abort_unless<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">abort_unless</code> function throws an HTTP exception if a given boolean expression evaluates to <code class=" language-php"><span class="token boolean">false</span></code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">abort_unless<span class="token punctuation">(</span></span><span class="token scope">Auth<span class="token punctuation">::</span></span><span class="token function">user<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">isAdmin<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">,</span> <span class="token number">403</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>Like the <code class=" language-php">abort</code> method, you may also provide the exception's response text as the third argument and an array of custom response headers as the fourth argument.</p>
	<p><a name="method-app"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">app<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">app</code> function returns the <a href="/docs/5.7/container">service container</a> instance:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$container</span> <span class="token operator">=</span> <span class="token function">app<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>You may pass a class or interface name to resolve it from the container:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$api</span> <span class="token operator">=</span> <span class="token function">app<span class="token punctuation">(</span></span><span class="token string">'HelpSpot\API'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-auth"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">auth<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">auth</code> function returns an <a href="/docs/5.7/authentication">authenticator</a> instance. You may use it instead of the <code class=" language-php">Auth</code> facade for convenience:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$user</span> <span class="token operator">=</span> <span class="token function">auth<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">user<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>If needed, you may specify which guard instance you would like to access:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$user</span> <span class="token operator">=</span> <span class="token function">auth<span class="token punctuation">(</span></span><span class="token string">'admin'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">user<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-back"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">back<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">back</code> function generates a <a href="/docs/5.7/responses#redirects">redirect HTTP response</a> to the user's previous location:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token function">back<span class="token punctuation">(</span></span><span class="token variable">$status</span> <span class="token operator">=</span> <span class="token number">302</span><span class="token punctuation">,</span> <span class="token variable">$headers</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token variable">$fallback</span> <span class="token operator">=</span> <span class="token boolean">false</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token keyword">return</span> <span class="token function">back<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-bcrypt"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">bcrypt<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">bcrypt</code> function <a href="/docs/5.7/hashing">hashes</a> the given value using Bcrypt. You may use it as an alternative to the <code class=" language-php">Hash</code> facade:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$password</span> <span class="token operator">=</span> <span class="token function">bcrypt<span class="token punctuation">(</span></span><span class="token string">'my-secret-password'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-broadcast"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">broadcast<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">broadcast</code> function <a href="/docs/5.7/broadcasting">broadcasts</a> the given <a href="/docs/5.7/events">event</a> to its listeners:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">broadcast<span class="token punctuation">(</span></span><span class="token keyword">new</span> <span class="token class-name">UserRegistered</span><span class="token punctuation">(</span><span class="token variable">$user</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-blank"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">blank<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">blank</code> function returns whether the given value is "blank":</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">blank<span class="token punctuation">(</span></span><span class="token string">''</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token function">blank<span class="token punctuation">(</span></span><span class="token string">'   '</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token function">blank<span class="token punctuation">(</span></span><span class="token keyword">null</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token function">blank<span class="token punctuation">(</span></span><span class="token function">collect<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// true
</span>
<span class="token function">blank<span class="token punctuation">(</span></span><span class="token number">0</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token function">blank<span class="token punctuation">(</span></span><span class="token boolean">true</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token function">blank<span class="token punctuation">(</span></span><span class="token boolean">false</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// false</span></code></pre>
	<p>For the inverse of <code class=" language-php">blank</code>, see the <a href="#method-filled"><code class=" language-php">filled</code></a> method.</p>
	<p><a name="method-cache"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">cache<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">cache</code> function may be used to get values from the <a href="/docs/5.7/cache">cache</a>. If the given key does not exist in the cache, an optional default value will be returned:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$value</span> <span class="token operator">=</span> <span class="token function">cache<span class="token punctuation">(</span></span><span class="token string">'key'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$value</span> <span class="token operator">=</span> <span class="token function">cache<span class="token punctuation">(</span></span><span class="token string">'key'</span><span class="token punctuation">,</span> <span class="token string">'default'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>You may add items to the cache by passing an array of key / value pairs to the function. You should also pass the number of minutes or duration the cached value should be considered valid:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">cache<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'key'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'value'</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token number">5</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token function">cache<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'key'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'value'</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token function">now<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">addSeconds<span class="token punctuation">(</span></span><span class="token number">10</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-class-uses-recursive"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">class_uses_recursive<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">class_uses_recursive</code> function returns all traits used by a class, including traits used by all of its parent classes:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$traits</span> <span class="token operator">=</span> <span class="token function">class_uses_recursive<span class="token punctuation">(</span></span><span class="token scope">App<span class="token punctuation">\</span>User<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-collect"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">collect<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">collect</code> function creates a <a href="/docs/5.7/collections">collection</a> instance from the given value:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$collection</span> <span class="token operator">=</span> <span class="token function">collect<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'taylor'</span><span class="token punctuation">,</span> <span class="token string">'abigail'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-config"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">config<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">config</code> function gets the value of a <a href="/docs/5.7/configuration">configuration</a> variable. The configuration values may be accessed using "dot" syntax, which includes the name of the file and the option you wish to access. A default value may be specified and is returned if the configuration option does not exist:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$value</span> <span class="token operator">=</span> <span class="token function">config<span class="token punctuation">(</span></span><span class="token string">'app.timezone'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$value</span> <span class="token operator">=</span> <span class="token function">config<span class="token punctuation">(</span></span><span class="token string">'app.timezone'</span><span class="token punctuation">,</span> <span class="token variable">$default</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>You may set configuration variables at runtime by passing an array of key / value pairs:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">config<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'app.debug'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token boolean">true</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-cookie"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">cookie<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">cookie</code> function creates a new <a href="/docs/5.7/requests#cookies">cookie</a> instance:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$cookie</span> <span class="token operator">=</span> <span class="token function">cookie<span class="token punctuation">(</span></span><span class="token string">'name'</span><span class="token punctuation">,</span> <span class="token string">'value'</span><span class="token punctuation">,</span> <span class="token variable">$minutes</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-csrf-field"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">csrf_field<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">csrf_field</code> function generates an HTML <code class=" language-php">hidden</code> input field containing the value of the CSRF token. For example, using <a href="/docs/5.7/blade">Blade syntax</a>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token punctuation">{</span><span class="token punctuation">{</span> <span class="token function">csrf_field<span class="token punctuation">(</span></span><span class="token punctuation">)</span> <span class="token punctuation">}</span><span class="token punctuation">}</span></code></pre>
	<p><a name="method-csrf-token"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">csrf_token<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">csrf_token</code> function retrieves the value of the current CSRF token:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$token</span> <span class="token operator">=</span> <span class="token function">csrf_token<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-dd"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">dd<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">dd</code> function dumps the given variables and ends execution of the script:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">dd<span class="token punctuation">(</span></span><span class="token variable">$value</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token function">dd<span class="token punctuation">(</span></span><span class="token variable">$value1</span><span class="token punctuation">,</span> <span class="token variable">$value2</span><span class="token punctuation">,</span> <span class="token variable">$value3</span><span class="token punctuation">,</span> <span class="token punctuation">.</span><span class="token punctuation">.</span><span class="token punctuation">.</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>If you do not want to halt the execution of your script, use the <a href="#method-dump"><code class=" language-php">dump</code></a> function instead.</p>
	<p><a name="method-decrypt"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">decrypt<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">decrypt</code> function decrypts the given value using Laravel's <a href="/docs/5.7/encryption">encrypter</a>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$decrypted</span> <span class="token operator">=</span> <span class="token function">decrypt<span class="token punctuation">(</span></span><span class="token variable">$encrypted_value</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-dispatch"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">dispatch<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">dispatch</code> function pushes the given <a href="/docs/5.7/queues#creating-jobs">job</a> onto the Laravel <a href="/docs/5.7/queues">job queue</a>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">dispatch<span class="token punctuation">(</span></span><span class="token keyword">new</span> <span class="token class-name">App<span class="token punctuation">\</span>Jobs<span class="token punctuation">\</span>SendEmails</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-dispatch-now"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">dispatch_now<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">dispatch_now</code> function runs the given <a href="/docs/5.7/queues#creating-jobs">job</a> immediately and returns the value from its <code class=" language-php">handle</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$result</span> <span class="token operator">=</span> <span class="token function">dispatch_now<span class="token punctuation">(</span></span><span class="token keyword">new</span> <span class="token class-name">App<span class="token punctuation">\</span>Jobs<span class="token punctuation">\</span>SendEmails</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-dump"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">dump<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">dump</code> function dumps the given variables:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">dump<span class="token punctuation">(</span></span><span class="token variable">$value</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token function">dump<span class="token punctuation">(</span></span><span class="token variable">$value1</span><span class="token punctuation">,</span> <span class="token variable">$value2</span><span class="token punctuation">,</span> <span class="token variable">$value3</span><span class="token punctuation">,</span> <span class="token punctuation">.</span><span class="token punctuation">.</span><span class="token punctuation">.</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>If you want to stop executing the script after dumping the variables, use the <a href="#method-dd"><code class=" language-php">dd</code></a> function instead.</p>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> You may use Artisan's <code class=" language-php">dump<span class="token operator">-</span>server</code> command to intercept all <code class=" language-php">dump</code> calls and display them in your console window instead of your browser.</p>
	</blockquote>
	<p><a name="method-encrypt"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">encrypt<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">encrypt</code> function encrypts the given value using Laravel's <a href="/docs/5.7/encryption">encrypter</a>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$encrypted</span> <span class="token operator">=</span> <span class="token function">encrypt<span class="token punctuation">(</span></span><span class="token variable">$unencrypted_value</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-env"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">env<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">env</code> function retrieves the value of an <a href="/docs/5.7/configuration#environment-configuration">environment variable</a> or returns a default value:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$env</span> <span class="token operator">=</span> <span class="token function">env<span class="token punctuation">(</span></span><span class="token string">'APP_ENV'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// Returns 'production' if APP_ENV is not set...
</span><span class="token variable">$env</span> <span class="token operator">=</span> <span class="token function">env<span class="token punctuation">(</span></span><span class="token string">'APP_ENV'</span><span class="token punctuation">,</span> <span class="token string">'production'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<blockquote class="has-icon">
		<p class="note"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="90px" height="90px" viewBox="0 0 90 90" enable-background="new 0 0 90 90" xml:space="preserve"><path fill="#FFFFFF" d="M45 0C20.1 0 0 20.1 0 45s20.1 45 45 45 45-20.1 45-45S69.9 0 45 0zM45 74.5c-3.6 0-6.5-2.9-6.5-6.5s2.9-6.5 6.5-6.5 6.5 2.9 6.5 6.5S48.6 74.5 45 74.5zM52.1 23.9l-2.5 29.6c0 2.5-2.1 4.6-4.6 4.6 -2.5 0-4.6-2.1-4.6-4.6l-2.5-29.6c-0.1-0.4-0.1-0.7-0.1-1.1 0-4 3.2-7.2 7.2-7.2 4 0 7.2 3.2 7.2 7.2C52.2 23.1 52.2 23.5 52.1 23.9z"></path></svg></span></div> If you execute the <code class=" language-php">config<span class="token punctuation">:</span>cache</code> command during your deployment process, you should be sure that you are only calling the <code class=" language-php">env</code> function from within your configuration files. Once the configuration has been cached, the <code class=" language-php"><span class="token punctuation">.</span>env</code> file will not be loaded and all calls to the <code class=" language-php">env</code> function will return <code class=" language-php"><span class="token keyword">null</span></code>.</p>
	</blockquote>
	<p><a name="method-event"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">event<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">event</code> function dispatches the given <a href="/docs/5.7/events">event</a> to its listeners:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">event<span class="token punctuation">(</span></span><span class="token keyword">new</span> <span class="token class-name">UserRegistered</span><span class="token punctuation">(</span><span class="token variable">$user</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-factory"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">factory<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">factory</code> function creates a model factory builder for a given class, name, and amount. It can be used while <a href="/docs/5.7/database-testing#writing-factories">testing</a> or <a href="/docs/5.7/seeding#using-model-factories">seeding</a>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$user</span> <span class="token operator">=</span> <span class="token function">factory<span class="token punctuation">(</span></span><span class="token scope">App<span class="token punctuation">\</span>User<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">make<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-filled"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">filled<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">filled</code> function returns whether the given value is not "blank":</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">filled<span class="token punctuation">(</span></span><span class="token number">0</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token function">filled<span class="token punctuation">(</span></span><span class="token boolean">true</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token function">filled<span class="token punctuation">(</span></span><span class="token boolean">false</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// true
</span>
<span class="token function">filled<span class="token punctuation">(</span></span><span class="token string">''</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token function">filled<span class="token punctuation">(</span></span><span class="token string">'   '</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token function">filled<span class="token punctuation">(</span></span><span class="token keyword">null</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token function">filled<span class="token punctuation">(</span></span><span class="token function">collect<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// false</span></code></pre>
	<p>For the inverse of <code class=" language-php">filled</code>, see the <a href="#method-blank"><code class=" language-php">blank</code></a> method.</p>
	<p><a name="method-info"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">info<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">info</code> function will write information to the <a href="/docs/5.7/errors#logging">log</a>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">info<span class="token punctuation">(</span></span><span class="token string">'Some helpful information!'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>An array of contextual data may also be passed to the function:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">info<span class="token punctuation">(</span></span><span class="token string">'User login attempt failed.'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'id'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">id</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-logger"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">logger<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">logger</code> function can be used to write a <code class=" language-php">debug</code> level message to the <a href="/docs/5.7/errors#logging">log</a>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">logger<span class="token punctuation">(</span></span><span class="token string">'Debug message'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>An array of contextual data may also be passed to the function:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">logger<span class="token punctuation">(</span></span><span class="token string">'User has logged in.'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'id'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">id</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>A <a href="/docs/5.7/errors#logging">logger</a> instance will be returned if no value is passed to the function:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">logger<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">error<span class="token punctuation">(</span></span><span class="token string">'You are not allowed here.'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-method-field"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">method_field<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">method_field</code> function generates an HTML <code class=" language-php">hidden</code> input field containing the spoofed value of the form's HTTP verb. For example, using <a href="/docs/5.7/blade">Blade syntax</a>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>form</span> <span class="token attr-name">method</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>POST<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span></span>
    <span class="token punctuation">{</span><span class="token punctuation">{</span> <span class="token function">method_field<span class="token punctuation">(</span></span><span class="token string">'DELETE'</span><span class="token punctuation">)</span> <span class="token punctuation">}</span><span class="token punctuation">}</span>
<span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>form</span><span class="token punctuation">&gt;</span></span></span></code></pre>
	<p><a name="method-now"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">now<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">now</code> function creates a new <code class=" language-php">Illuminate\<span class="token package">Support<span class="token punctuation">\</span>Carbon</span></code> instance for the current time:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$now</span> <span class="token operator">=</span> <span class="token function">now<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-old"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">old<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">old</code> function <a href="/docs/5.7/requests#retrieving-input">retrieves</a> an <a href="/docs/5.7/requests#old-input">old input</a> value flashed into the session:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$value</span> <span class="token operator">=</span> <span class="token function">old<span class="token punctuation">(</span></span><span class="token string">'value'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$value</span> <span class="token operator">=</span> <span class="token function">old<span class="token punctuation">(</span></span><span class="token string">'value'</span><span class="token punctuation">,</span> <span class="token string">'default'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-optional"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">optional<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">optional</code> function accepts any argument and allows you to access properties or call methods on that object. If the given object is <code class=" language-php"><span class="token keyword">null</span></code>, properties and methods will return <code class=" language-php"><span class="token keyword">null</span></code> instead of causing an error:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token function">optional<span class="token punctuation">(</span></span><span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">address</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">street</span><span class="token punctuation">;</span>

<span class="token punctuation">{</span><span class="token operator">!</span><span class="token operator">!</span> <span class="token function">old<span class="token punctuation">(</span></span><span class="token string">'name'</span><span class="token punctuation">,</span> <span class="token function">optional<span class="token punctuation">(</span></span><span class="token variable">$user</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">name</span><span class="token punctuation">)</span> <span class="token operator">!</span><span class="token operator">!</span><span class="token punctuation">}</span></code></pre>
	<p>The <code class=" language-php">optional</code> function also accepts a Closure as its second argument. The Closure will be invoked if the value provided as the first argument is not null:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token function">optional<span class="token punctuation">(</span></span><span class="token scope">User<span class="token punctuation">::</span></span><span class="token function">find<span class="token punctuation">(</span></span><span class="token variable">$id</span><span class="token punctuation">)</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$user</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token keyword">new</span> <span class="token class-name">DummyUser</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-policy"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">policy<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">policy</code> method retrieves a <a href="/docs/5.7/authorization#creating-policies">policy</a> instance for a given class:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$policy</span> <span class="token operator">=</span> <span class="token function">policy<span class="token punctuation">(</span></span><span class="token scope">App<span class="token punctuation">\</span>User<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-redirect"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">redirect<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">redirect</code> function returns a <a href="/docs/5.7/responses#redirects">redirect HTTP response</a>, or returns the redirector instance if called with no arguments:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token function">redirect<span class="token punctuation">(</span></span><span class="token variable">$to</span> <span class="token operator">=</span> <span class="token keyword">null</span><span class="token punctuation">,</span> <span class="token variable">$status</span> <span class="token operator">=</span> <span class="token number">302</span><span class="token punctuation">,</span> <span class="token variable">$headers</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token variable">$secure</span> <span class="token operator">=</span> <span class="token keyword">null</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token keyword">return</span> <span class="token function">redirect<span class="token punctuation">(</span></span><span class="token string">'/home'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token keyword">return</span> <span class="token function">redirect<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">route<span class="token punctuation">(</span></span><span class="token string">'route.name'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-report"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">report<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">report</code> function will report an exception using your <a href="/docs/5.7/errors#the-exception-handler">exception handler</a>'s <code class=" language-php">report</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">report<span class="token punctuation">(</span></span><span class="token variable">$e</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-request"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">request<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">request</code> function returns the current <a href="/docs/5.7/requests">request</a> instance or obtains an input item:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$request</span> <span class="token operator">=</span> <span class="token function">request<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$value</span> <span class="token operator">=</span> <span class="token function">request<span class="token punctuation">(</span></span><span class="token string">'key'</span><span class="token punctuation">,</span> <span class="token variable">$default</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-rescue"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">rescue<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">rescue</code> function executes the given Closure and catches any exceptions that occur during its execution. All exceptions that are caught will be sent to your <a href="/docs/5.7/errors#the-exception-handler">exception handler</a>'s <code class=" language-php">report</code> method; however, the request will continue processing:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token function">rescue<span class="token punctuation">(</span></span><span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">method<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>You may also pass a second argument to the <code class=" language-php">rescue</code> function. This argument will be the "default" value that should be returned if an exception occurs while executing the Closure:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token function">rescue<span class="token punctuation">(</span></span><span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">method<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">,</span> <span class="token boolean">false</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token keyword">return</span> <span class="token function">rescue<span class="token punctuation">(</span></span><span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">method<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">failure<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-resolve"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">resolve<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">resolve</code> function resolves a given class or interface name to its instance using the <a href="/docs/5.7/container">service container</a>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$api</span> <span class="token operator">=</span> <span class="token function">resolve<span class="token punctuation">(</span></span><span class="token string">'HelpSpot\API'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-response"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">response<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">response</code> function creates a <a href="/docs/5.7/responses">response</a> instance or obtains an instance of the response factory:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token function">response<span class="token punctuation">(</span></span><span class="token string">'Hello World'</span><span class="token punctuation">,</span> <span class="token number">200</span><span class="token punctuation">,</span> <span class="token variable">$headers</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token keyword">return</span> <span class="token function">response<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">json<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'foo'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'bar'</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token number">200</span><span class="token punctuation">,</span> <span class="token variable">$headers</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-retry"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">retry<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">retry</code> function attempts to execute the given callback until the given maximum attempt threshold is met. If the callback does not throw an exception, its return value will be returned. If the callback throws an exception, it will automatically be retried. If the maximum attempt count is exceeded, the exception will be thrown:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token function">retry<span class="token punctuation">(</span></span><span class="token number">5</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> // Attempt 5 times while resting 100ms in between attempts...
</span><span class="token punctuation">}</span><span class="token punctuation">,</span> <span class="token number">100</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-session"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">session<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">session</code> function may be used to get or set <a href="/docs/5.7/session">session</a> values:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$value</span> <span class="token operator">=</span> <span class="token function">session<span class="token punctuation">(</span></span><span class="token string">'key'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>You may set values by passing an array of key / value pairs to the function:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">session<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'chairs'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">7</span><span class="token punctuation">,</span> <span class="token string">'instruments'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">3</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>The session store will be returned if no value is passed to the function:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$value</span> <span class="token operator">=</span> <span class="token function">session<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'key'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token function">session<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">put<span class="token punctuation">(</span></span><span class="token string">'key'</span><span class="token punctuation">,</span> <span class="token variable">$value</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-tap"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">tap<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">tap</code> function accepts two arguments: an arbitrary <code class=" language-php"><span class="token variable">$value</span></code> and a Closure. The <code class=" language-php"><span class="token variable">$value</span></code> will be passed to the Closure and then be returned by the <code class=" language-php">tap</code> function. The return value of the Closure is irrelevant:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$user</span> <span class="token operator">=</span> <span class="token function">tap<span class="token punctuation">(</span></span><span class="token scope">User<span class="token punctuation">::</span></span><span class="token function">first<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$user</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">name</span> <span class="token operator">=</span> <span class="token string">'taylor'</span><span class="token punctuation">;</span>

    <span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">save<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>If no Closure is passed to the <code class=" language-php">tap</code> function, you may call any method on the given <code class=" language-php"><span class="token variable">$value</span></code>. The return value of the method you call will always be <code class=" language-php"><span class="token variable">$value</span></code>, regardless of what the method actually returns in its definition. For example, the Eloquent <code class=" language-php">update</code> method typically returns an integer. However, we can force the method to return the model itself by chaining the <code class=" language-php">update</code> method call through the <code class=" language-php">tap</code> function:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$user</span> <span class="token operator">=</span> <span class="token function">tap<span class="token punctuation">(</span></span><span class="token variable">$user</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">update<span class="token punctuation">(</span></span><span class="token punctuation">[</span>
    <span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token variable">$name</span><span class="token punctuation">,</span>
    <span class="token string">'email'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token variable">$email</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-today"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">today<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">today</code> function creates a new <code class=" language-php">Illuminate\<span class="token package">Support<span class="token punctuation">\</span>Carbon</span></code> instance for the current date:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$today</span> <span class="token operator">=</span> <span class="token function">today<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-throw-if"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">throw_if<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">throw_if</code> function throws the given exception if a given boolean expression evaluates to <code class=" language-php"><span class="token boolean">true</span></code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">throw_if<span class="token punctuation">(</span></span><span class="token operator">!</span> <span class="token scope">Auth<span class="token punctuation">::</span></span><span class="token function">user<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">isAdmin<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">,</span> <span class="token scope">AuthorizationException<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token function">throw_if<span class="token punctuation">(</span></span>
    <span class="token operator">!</span> <span class="token scope">Auth<span class="token punctuation">::</span></span><span class="token function">user<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">isAdmin<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">,</span>
    <span class="token scope">AuthorizationException<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
    <span class="token string">'You are not allowed to access this page'</span>
<span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-throw-unless"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">throw_unless<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">throw_unless</code> function throws the given exception if a given boolean expression evaluates to <code class=" language-php"><span class="token boolean">false</span></code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">throw_unless<span class="token punctuation">(</span></span><span class="token scope">Auth<span class="token punctuation">::</span></span><span class="token function">user<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">isAdmin<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">,</span> <span class="token scope">AuthorizationException<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token function">throw_unless<span class="token punctuation">(</span></span>
    <span class="token scope">Auth<span class="token punctuation">::</span></span><span class="token function">user<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">isAdmin<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">,</span>
    <span class="token scope">AuthorizationException<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
    <span class="token string">'You are not allowed to access this page'</span>
<span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-trait-uses-recursive"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">trait_uses_recursive<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">trait_uses_recursive</code> function returns all traits used by a trait:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$traits</span> <span class="token operator">=</span> <span class="token function">trait_uses_recursive<span class="token punctuation">(</span></span>\<span class="token scope">Illuminate<span class="token punctuation">\</span>Notifications<span class="token punctuation">\</span>Notifiable<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-transform"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">transform<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">transform</code> function executes a <code class=" language-php">Closure</code> on a given value if the value is not <a href="#method-blank">blank</a> and returns the result of the <code class=" language-php">Closure</code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$callback</span> <span class="token operator">=</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$value</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token variable">$value</span> <span class="token operator">*</span> <span class="token number">2</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">;</span>

<span class="token variable">$result</span> <span class="token operator">=</span> <span class="token function">transform<span class="token punctuation">(</span></span><span class="token number">5</span><span class="token punctuation">,</span> <span class="token variable">$callback</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// 10</span></code></pre>
	<p>A default value or <code class=" language-php">Closure</code> may also be passed as the third parameter to the method. This value will be returned if the given value is blank:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$result</span> <span class="token operator">=</span> <span class="token function">transform<span class="token punctuation">(</span></span><span class="token keyword">null</span><span class="token punctuation">,</span> <span class="token variable">$callback</span><span class="token punctuation">,</span> <span class="token string">'The value is blank'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// The value is blank</span></code></pre>
	<p><a name="method-validator"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">validator<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">validator</code> function creates a new <a href="/docs/5.7/validation">validator</a> instance with the given arguments. You may use it instead of the <code class=" language-php">Validator</code> facade for convenience:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$validator</span> <span class="token operator">=</span> <span class="token function">validator<span class="token punctuation">(</span></span><span class="token variable">$data</span><span class="token punctuation">,</span> <span class="token variable">$rules</span><span class="token punctuation">,</span> <span class="token variable">$messages</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-value"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">value<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">value</code> function returns the value it is given. However, if you pass a <code class=" language-php">Closure</code> to the function, the <code class=" language-php">Closure</code> will be executed then its result will be returned:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$result</span> <span class="token operator">=</span> <span class="token function">value<span class="token punctuation">(</span></span><span class="token boolean">true</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// true
</span>
<span class="token variable">$result</span> <span class="token operator">=</span> <span class="token function">value<span class="token punctuation">(</span></span><span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token boolean">false</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// false</span></code></pre>
	<p><a name="method-view"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">view<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">view</code> function retrieves a <a href="/docs/5.7/views">view</a> instance:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token function">view<span class="token punctuation">(</span></span><span class="token string">'auth.login'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="method-with"></a></p>
	<h4 id="collection-method"><code class=" language-php"><span class="token function">with<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code></h4>
	<p>The <code class=" language-php">with</code> function returns the value it is given. If a <code class=" language-php">Closure</code> is passed as the second argument to the function, the <code class=" language-php">Closure</code> will be executed and its result will be returned:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$callback</span> <span class="token operator">=</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$value</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token punctuation">(</span><span class="token function">is_numeric<span class="token punctuation">(</span></span><span class="token variable">$value</span><span class="token punctuation">)</span><span class="token punctuation">)</span> <span class="token operator">?</span> <span class="token variable">$value</span> <span class="token operator">*</span> <span class="token number">2</span> <span class="token punctuation">:</span> <span class="token number">0</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">;</span>

<span class="token variable">$result</span> <span class="token operator">=</span> <span class="token function">with<span class="token punctuation">(</span></span><span class="token number">5</span><span class="token punctuation">,</span> <span class="token variable">$callback</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// 10
</span>
<span class="token variable">$result</span> <span class="token operator">=</span> <span class="token function">with<span class="token punctuation">(</span></span><span class="token keyword">null</span><span class="token punctuation">,</span> <span class="token variable">$callback</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// 0
</span>
<span class="token variable">$result</span> <span class="token operator">=</span> <span class="token function">with<span class="token punctuation">(</span></span><span class="token number">5</span><span class="token punctuation">,</span> <span class="token keyword">null</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// 5</span></code></pre>
</article>