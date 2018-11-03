<article>
	<h1>Controllers</h1>
	<p>Instead of defining all of your request handling logic as Closures in route files, you may wish to organize this behavior using Controller classes. Controllers can group related request handling logic into a single class. Controllers are stored in the <code class=" language-php">app<span class="token operator">/</span>Http<span class="token operator">/</span>Controllers</code> directory.</p>

	<p><a name="defining-controllers"></a></p>
	<h3>Defining Controllers</h3>
	<p>Below is an example of a basic controller class. Note that the controller extends the base controller class included with Laravel. The base class provides a few convenience methods such as the <code class=" language-php">middleware</code> method, which may be used to attach middleware to controller actions:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Controllers</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>User</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Controllers<span class="token punctuation">\</span>Controller</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">UserController</span> <span class="token keyword">extends</span> <span class="token class-name">Controller</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">show<span class="token punctuation">(</span></span><span class="token variable">$id</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token keyword">return</span> <span class="token function">view<span class="token punctuation">(</span></span><span class="token string">'user.profile'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'user'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token scope">User<span class="token punctuation">::</span></span><span class="token function">findOrFail<span class="token punctuation">(</span></span><span class="token variable">$id</span><span class="token punctuation">)</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p>You can define a route to this controller action like so:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Route<span class="token punctuation">::</span></span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'user/{id}'</span><span class="token punctuation">,</span> <span class="token string">'UserController@show'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>Now, when a request matches the specified route URI, the <code class=" language-php">show</code> method on the <code class=" language-php">UserController</code> class will be executed. Of course, the route parameters will also be passed to the method.</p>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> Controllers are not <strong>required</strong> to extend a base class. However, you will not have access to convenience features such as the <code class=" language-php">middleware</code>, <code class=" language-php">validate</code>, and <code class=" language-php">dispatch</code> methods.</p>
	</blockquote>
	<p><a name="controllers-and-namespaces"></a></p>
	<h3>Controllers &amp; Namespaces</h3>
	<p>It is very important to note that we did not need to specify the full controller namespace when defining the controller route. Since the <code class=" language-php">RouteServiceProvider</code> loads your route files within a route group that contains the namespace, we only specified the portion of the class name that comes after the <code class=" language-php">App\<span class="token package">Http<span class="token punctuation">\</span>Controllers</span></code> portion of the namespace.</p>
	<p>If you choose to nest your controllers deeper into the <code class=" language-php">App\<span class="token package">Http<span class="token punctuation">\</span>Controllers</span></code> directory, use the specific class name relative to the <code class=" language-php">App\<span class="token package">Http<span class="token punctuation">\</span>Controllers</span></code> root namespace. So, if your full controller class is <code class=" language-php">App\<span class="token package">Http<span class="token punctuation">\</span>Controllers<span class="token punctuation">\</span>Photos<span class="token punctuation">\</span>AdminController</span></code>, you should register routes to the controller like so:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Route<span class="token punctuation">::</span></span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'foo'</span><span class="token punctuation">,</span> <span class="token string">'Photos\AdminController@method'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="single-action-controllers"></a></p>
</article>