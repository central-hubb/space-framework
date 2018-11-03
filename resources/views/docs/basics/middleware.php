<article>
	<h1>Middleware</h1>
	<ul>
		<li><a href="#introduction">Introduction</a></li>
		<li><a href="#defining-middleware">Defining Middleware</a></li>
		<li><a href="#registering-middleware">Registering Middleware</a>
			<ul>
				<li><a href="#global-middleware">Global Middleware</a></li>
				<li><a href="#assigning-middleware-to-routes">Assigning Middleware To Routes</a></li>
				<li><a href="#middleware-groups">Middleware Groups</a></li>
			</ul></li>
		<li><a href="#middleware-parameters">Middleware Parameters</a></li>
		<li><a href="#terminable-middleware">Terminable Middleware</a></li>
	</ul>
	<p><a name="introduction"></a></p>
	<h2><a href="#introduction">Introduction</a></h2>
	<p>Middleware provide a convenient mechanism for filtering HTTP requests entering your application. For example, Laravel includes a middleware that verifies the user of your application is authenticated. If the user is not authenticated, the middleware will redirect the user to the login screen. However, if the user is authenticated, the middleware will allow the request to proceed further into the application.</p>
	<p>Of course, additional middleware can be written to perform a variety of tasks besides authentication. A CORS middleware might be responsible for adding the proper headers to all responses leaving your application. A logging middleware might log all incoming requests to your application.</p>
	<p>There are several middleware included in the Laravel framework, including middleware for authentication and CSRF protection. All of these middleware are located in the <code class=" language-php">app<span class="token operator">/</span>Http<span class="token operator">/</span>Middleware</code> directory.</p>
	<p><a name="defining-middleware"></a></p>
	<h2><a href="#defining-middleware">Defining Middleware</a></h2>
	<p>To create a new middleware, use the <code class=" language-php">make<span class="token punctuation">:</span>middleware</code> Artisan command:</p>
	<pre class=" language-php"><code class=" language-php">php artisan make<span class="token punctuation">:</span>middleware CheckAge</code></pre>
	<p>This command will place a new <code class=" language-php">CheckAge</code> class within your <code class=" language-php">app<span class="token operator">/</span>Http<span class="token operator">/</span>Middleware</code> directory. In this middleware, we will only allow access to the route if the supplied <code class=" language-php">age</code> is greater than 200. Otherwise, we will redirect the users back to the <code class=" language-php">home</code> URI:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Middleware</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Closure</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">CheckAge</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">handle<span class="token punctuation">(</span></span><span class="token variable">$request</span><span class="token punctuation">,</span> Closure <span class="token variable">$next</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token keyword">if</span> <span class="token punctuation">(</span><span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">age</span> <span class="token operator">&lt;=</span> <span class="token number">200</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
            <span class="token keyword">return</span> <span class="token function">redirect<span class="token punctuation">(</span></span><span class="token string">'home'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
        <span class="token punctuation">}</span>

        <span class="token keyword">return</span> <span class="token variable">$next</span><span class="token punctuation">(</span><span class="token variable">$request</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p>As you can see, if the given <code class=" language-php">age</code> is less than or equal to <code class=" language-php"><span class="token number">200</span></code>, the middleware will return an HTTP redirect to the client; otherwise, the request will be passed further into the application. To pass the request deeper into the application (allowing the middleware to "pass"), call the <code class=" language-php"><span class="token variable">$next</span></code> callback with the <code class=" language-php"><span class="token variable">$request</span></code>.</p>
	<p>It's best to envision middleware as a series of "layers" HTTP requests must pass through before they hit your application. Each layer can examine the request and even reject it entirely.</p>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> All middleware are resolved via the <a href="/docs/5.7/container">service container</a>, so you may type-hint any dependencies you need within a middleware's constructor.</p>
	</blockquote>
	<h3>Before &amp; After Middleware</h3>
	<p>Whether a middleware runs before or after a request depends on the middleware itself. For example, the following middleware would perform some task <strong>before</strong> the request is handled by the application:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Middleware</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Closure</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">BeforeMiddleware</span>
<span class="token punctuation">{</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">handle<span class="token punctuation">(</span></span><span class="token variable">$request</span><span class="token punctuation">,</span> Closure <span class="token variable">$next</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
       <span class="token comment" spellcheck="true"> // Perform action
</span>
        <span class="token keyword">return</span> <span class="token variable">$next</span><span class="token punctuation">(</span><span class="token variable">$request</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p>However, this middleware would perform its task <strong>after</strong> the request is handled by the application:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Middleware</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Closure</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">AfterMiddleware</span>
<span class="token punctuation">{</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">handle<span class="token punctuation">(</span></span><span class="token variable">$request</span><span class="token punctuation">,</span> Closure <span class="token variable">$next</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token variable">$response</span> <span class="token operator">=</span> <span class="token variable">$next</span><span class="token punctuation">(</span><span class="token variable">$request</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

       <span class="token comment" spellcheck="true"> // Perform action
</span>
        <span class="token keyword">return</span> <span class="token variable">$response</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="registering-middleware"></a></p>
	<h2><a href="#registering-middleware">Registering Middleware</a></h2>
	<p><a name="global-middleware"></a></p>
	<h3>Global Middleware</h3>
	<p>If you want a middleware to run during every HTTP request to your application, list the middleware class in the <code class=" language-php"><span class="token variable">$middleware</span></code> property of your <code class=" language-php">app<span class="token operator">/</span>Http<span class="token operator">/</span>Kernel<span class="token punctuation">.</span>php</code> class.</p>
	<p><a name="assigning-middleware-to-routes"></a></p>
	<h3>Assigning Middleware To Routes</h3>
	<p>If you would like to assign middleware to specific routes, you should first assign the middleware a key in your <code class=" language-php">app<span class="token operator">/</span>Http<span class="token operator">/</span>Kernel<span class="token punctuation">.</span>php</code> file. By default, the <code class=" language-php"><span class="token variable">$routeMiddleware</span></code> property of this class contains entries for the middleware included with Laravel. To add your own, append it to this list and assign it a key of your choosing:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">// Within App\Http\Kernel Class...
</span>
<span class="token keyword">protected</span> <span class="token variable">$routeMiddleware</span> <span class="token operator">=</span> <span class="token punctuation">[</span>
    <span class="token string">'auth'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> \<span class="token scope">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Middleware<span class="token punctuation">\</span>Authenticate<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
    <span class="token string">'auth.basic'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> \<span class="token scope">Illuminate<span class="token punctuation">\</span>Auth<span class="token punctuation">\</span>Middleware<span class="token punctuation">\</span>AuthenticateWithBasicAuth<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
    <span class="token string">'bindings'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> \<span class="token scope">Illuminate<span class="token punctuation">\</span>Routing<span class="token punctuation">\</span>Middleware<span class="token punctuation">\</span>SubstituteBindings<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
    <span class="token string">'cache.headers'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> \<span class="token scope">Illuminate<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Middleware<span class="token punctuation">\</span>SetCacheHeaders<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
    <span class="token string">'can'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> \<span class="token scope">Illuminate<span class="token punctuation">\</span>Auth<span class="token punctuation">\</span>Middleware<span class="token punctuation">\</span>Authorize<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
    <span class="token string">'guest'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> \<span class="token scope">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Middleware<span class="token punctuation">\</span>RedirectIfAuthenticated<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
    <span class="token string">'signed'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> \<span class="token scope">Illuminate<span class="token punctuation">\</span>Routing<span class="token punctuation">\</span>Middleware<span class="token punctuation">\</span>ValidateSignature<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
    <span class="token string">'throttle'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> \<span class="token scope">Illuminate<span class="token punctuation">\</span>Routing<span class="token punctuation">\</span>Middleware<span class="token punctuation">\</span>ThrottleRequests<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
    <span class="token string">'verified'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> \<span class="token scope">Illuminate<span class="token punctuation">\</span>Auth<span class="token punctuation">\</span>Middleware<span class="token punctuation">\</span>EnsureEmailIsVerified<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">;</span></code></pre>
	<p>Once the middleware has been defined in the HTTP kernel, you may use the <code class=" language-php">middleware</code> method to assign middleware to a route:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Route<span class="token punctuation">::</span></span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'admin/profile'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">middleware<span class="token punctuation">(</span></span><span class="token string">'auth'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>You may also assign multiple middleware to the route:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Route<span class="token punctuation">::</span></span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'/'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">middleware<span class="token punctuation">(</span></span><span class="token string">'first'</span><span class="token punctuation">,</span> <span class="token string">'second'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>When assigning middleware, you may also pass the fully qualified class name:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Middleware<span class="token punctuation">\</span>CheckAge</span><span class="token punctuation">;</span>

<span class="token scope">Route<span class="token punctuation">::</span></span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'admin/profile'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">middleware<span class="token punctuation">(</span></span><span class="token scope">CheckAge<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="middleware-groups"></a></p>
	<h3>Middleware Groups</h3>
	<p>Sometimes you may want to group several middleware under a single key to make them easier to assign to routes. You may do this using the <code class=" language-php"><span class="token variable">$middlewareGroups</span></code> property of your HTTP kernel.</p>
	<p>Out of the box, Laravel comes with <code class=" language-php">web</code> and <code class=" language-php">api</code> middleware groups that contain common middleware you may want to apply to your web UI and API routes:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * The application's route middleware groups.
 *
 * @var array
 */</span>
<span class="token keyword">protected</span> <span class="token variable">$middlewareGroups</span> <span class="token operator">=</span> <span class="token punctuation">[</span>
    <span class="token string">'web'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        \<span class="token scope">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Middleware<span class="token punctuation">\</span>EncryptCookies<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
        \<span class="token scope">Illuminate<span class="token punctuation">\</span>Cookie<span class="token punctuation">\</span>Middleware<span class="token punctuation">\</span>AddQueuedCookiesToResponse<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
        \<span class="token scope">Illuminate<span class="token punctuation">\</span>Session<span class="token punctuation">\</span>Middleware<span class="token punctuation">\</span>StartSession<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
        \<span class="token scope">Illuminate<span class="token punctuation">\</span>View<span class="token punctuation">\</span>Middleware<span class="token punctuation">\</span>ShareErrorsFromSession<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
        \<span class="token scope">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Middleware<span class="token punctuation">\</span>VerifyCsrfToken<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
        \<span class="token scope">Illuminate<span class="token punctuation">\</span>Routing<span class="token punctuation">\</span>Middleware<span class="token punctuation">\</span>SubstituteBindings<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>

    <span class="token string">'api'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'throttle:60,1'</span><span class="token punctuation">,</span>
        <span class="token string">'auth:api'</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">;</span></code></pre>
	<p>Middleware groups may be assigned to routes and controller actions using the same syntax as individual middleware. Again, middleware groups make it more convenient to assign many middleware to a route at once:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Route<span class="token punctuation">::</span></span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'/'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">middleware<span class="token punctuation">(</span></span><span class="token string">'web'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token scope">Route<span class="token punctuation">::</span></span><span class="token function">group<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'middleware'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'web'</span><span class="token punctuation">]</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> Out of the box, the <code class=" language-php">web</code> middleware group is automatically applied to your <code class=" language-php">routes<span class="token operator">/</span>web<span class="token punctuation">.</span>php</code> file by the <code class=" language-php">RouteServiceProvider</code>.</p>
	</blockquote>
	<p><a name="middleware-parameters"></a></p>
	<h2><a href="#middleware-parameters">Middleware Parameters</a></h2>
	<p>Middleware can also receive additional parameters. For example, if your application needs to verify that the authenticated user has a given "role" before performing a given action, you could create a <code class=" language-php">CheckRole</code> middleware that receives a role name as an additional argument.</p>
	<p>Additional middleware parameters will be passed to the middleware after the <code class=" language-php"><span class="token variable">$next</span></code> argument:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Middleware</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Closure</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">CheckRole</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">handle<span class="token punctuation">(</span></span><span class="token variable">$request</span><span class="token punctuation">,</span> Closure <span class="token variable">$next</span><span class="token punctuation">,</span> <span class="token variable">$role</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token keyword">if</span> <span class="token punctuation">(</span><span class="token operator">!</span> <span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">user<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">hasRole<span class="token punctuation">(</span></span><span class="token variable">$role</span><span class="token punctuation">)</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
           <span class="token comment" spellcheck="true"> // Redirect...
</span>        <span class="token punctuation">}</span>

        <span class="token keyword">return</span> <span class="token variable">$next</span><span class="token punctuation">(</span><span class="token variable">$request</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>

<span class="token punctuation">}</span></code></pre>
	<p>Middleware parameters may be specified when defining the route by separating the middleware name and parameters with a <code class=" language-php"><span class="token punctuation">:</span></code>. Multiple parameters should be delimited by commas:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Route<span class="token punctuation">::</span></span><span class="token function">put<span class="token punctuation">(</span></span><span class="token string">'post/{id}'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$id</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">middleware<span class="token punctuation">(</span></span><span class="token string">'role:editor'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="terminable-middleware"></a></p>
	<h2><a href="#terminable-middleware">Terminable Middleware</a></h2>
	<p>Sometimes a middleware may need to do some work after the HTTP response has been prepared. For example, the "session" middleware included with Laravel writes the session data to storage after the response has been fully prepared. If you define a <code class=" language-php">terminate</code> method on your middleware, it will automatically be called after the response is ready to be sent to the browser.</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Session<span class="token punctuation">\</span>Middleware</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Closure</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">StartSession</span>
<span class="token punctuation">{</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">handle<span class="token punctuation">(</span></span><span class="token variable">$request</span><span class="token punctuation">,</span> Closure <span class="token variable">$next</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token keyword">return</span> <span class="token variable">$next</span><span class="token punctuation">(</span><span class="token variable">$request</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>

    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">terminate<span class="token punctuation">(</span></span><span class="token variable">$request</span><span class="token punctuation">,</span> <span class="token variable">$response</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
       <span class="token comment" spellcheck="true"> // Store the session data...
</span>    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p>The <code class=" language-php">terminate</code> method should receive both the request and the response. Once you have defined a terminable middleware, you should add it to the list of route or global middleware in the <code class=" language-php">app<span class="token operator">/</span>Http<span class="token operator">/</span>Kernel<span class="token punctuation">.</span>php</code> file.</p>
	<p>When calling the <code class=" language-php">terminate</code> method on your middleware, Laravel will resolve a fresh instance of the middleware from the <a href="/docs/5.7/container">service container</a>. If you would like to use the same middleware instance when the <code class=" language-php">handle</code> and <code class=" language-php">terminate</code> methods are called, register the middleware with the container using the container's <code class=" language-php">singleton</code> method.</p>
</article>