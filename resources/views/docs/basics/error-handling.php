<article>
	<h1>Error Handling</h1>
	<ul>
		<li><a href="#introduction">Introduction</a></li>
		<li><a href="#configuration">Configuration</a></li>
		<li><a href="#the-exception-handler">The Exception Handler</a>
			<ul>
				<li><a href="#report-method">Report Method</a></li>
				<li><a href="#render-method">Render Method</a></li>
				<li><a href="#renderable-exceptions">Reportable &amp; Renderable Exceptions</a></li>
			</ul></li>
		<li><a href="#http-exceptions">HTTP Exceptions</a>
			<ul>
				<li><a href="#custom-http-error-pages">Custom HTTP Error Pages</a></li>
			</ul></li>
	</ul>
	<p><a name="introduction"></a></p>
	<h2><a href="#introduction">Introduction</a></h2>
	<p>When you start a new Space MVC project, error and exception handling is already configured for you. The <code class=" language-php">App\<span class="token package">Exceptions<span class="token punctuation">\</span>Handler</span></code> class is where all exceptions triggered by your application are logged and then rendered back to the user. We'll dive deeper into this class throughout this documentation.</p>
	<p><a name="configuration"></a></p>
	<h2><a href="#configuration">Configuration</a></h2>
	<p>The <code class=" language-php">debug</code> option in your <code class=" language-php">config<span class="token operator">/</span>app<span class="token punctuation">.</span>php</code> configuration file determines how much information about an error is actually displayed to the user. By default, this option is set to respect the value of the <code class=" language-php"><span class="token constant">APP_DEBUG</span></code> environment variable, which is stored in your <code class=" language-php"><span class="token punctuation">.</span>env</code> file.</p>
	<p>For local development, you should set the <code class=" language-php"><span class="token constant">APP_DEBUG</span></code> environment variable to <code class=" language-php"><span class="token boolean">true</span></code>. In your production environment, this value should always be <code class=" language-php"><span class="token boolean">false</span></code>. If the value is set to <code class=" language-php"><span class="token boolean">true</span></code> in production, you risk exposing sensitive configuration values to your application's end users.</p>
	<p><a name="the-exception-handler"></a></p>
	<h2><a href="#the-exception-handler">The Exception Handler</a></h2>
	<p><a name="report-method"></a></p>
	<h3>The Report Method</h3>
	<p>All exceptions are handled by the <code class=" language-php">App\<span class="token package">Exceptions<span class="token punctuation">\</span>Handler</span></code> class. This class contains two methods: <code class=" language-php">report</code> and <code class=" language-php">render</code>. We'll examine each of these methods in detail. The <code class=" language-php">report</code> method is used to log exceptions or send them to an external service like <a href="https://bugsnag.com">Bugsnag</a> or <a href="https://github.com/getsentry/sentry-Space MVC">Sentry</a>. By default, the <code class=" language-php">report</code> method passes the exception to the base class where the exception is logged. However, you are free to log exceptions however you wish.</p>
	<p>For example, if you need to report different types of exceptions in different ways, you may use the PHP <code class=" language-php"><span class="token keyword">instanceof</span></code> comparison operator:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Report or log an exception.
 *
 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
 *
 * @param  \Exception  $exception
 * @return void
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">report<span class="token punctuation">(</span></span>Exception <span class="token variable">$exception</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token keyword">if</span> <span class="token punctuation">(</span><span class="token variable">$exception</span> <span class="token keyword">instanceof</span> <span class="token class-name">CustomException</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
       <span class="token comment" spellcheck="true"> //
</span>    <span class="token punctuation">}</span>

    <span class="token keyword">return</span> <span class="token scope"><span class="token keyword">parent</span><span class="token punctuation">::</span></span><span class="token function">report<span class="token punctuation">(</span></span><span class="token variable">$exception</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> Instead of making a lot of <code class=" language-php"><span class="token keyword">instanceof</span></code> checks in your <code class=" language-php">report</code> method, consider using <a href="/docs/5.7/errors#renderable-exceptions">reportable exceptions</a></p>
	</blockquote>
	<h4>The <code class=" language-php">report</code> Helper</h4>
	<p>Sometimes you may need to report an exception but continue handling the current request. The <code class=" language-php">report</code> helper function allows you to quickly report an exception using your exception handler's <code class=" language-php">report</code> method without rendering an error page:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">isValid<span class="token punctuation">(</span></span><span class="token variable">$value</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token keyword">try</span> <span class="token punctuation">{</span>
       <span class="token comment" spellcheck="true"> // Validate the value...
</span>    <span class="token punctuation">}</span> <span class="token keyword">catch</span> <span class="token punctuation">(</span><span class="token class-name">Exception</span> <span class="token variable">$e</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
        <span class="token function">report<span class="token punctuation">(</span></span><span class="token variable">$e</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

        <span class="token keyword">return</span> <span class="token boolean">false</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<h4>Ignoring Exceptions By Type</h4>
	<p>The <code class=" language-php"><span class="token variable">$dontReport</span></code> property of the exception handler contains an array of exception types that will not be logged. For example, exceptions resulting from 404 errors, as well as several other types of errors, are not written to your log files. You may add other exception types to this array as needed:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * A list of the exception types that should not be reported.
 *
 * @var array
 */</span>
<span class="token keyword">protected</span> <span class="token variable">$dontReport</span> <span class="token operator">=</span> <span class="token punctuation">[</span>
    \<span class="token scope">Illuminate<span class="token punctuation">\</span>Auth<span class="token punctuation">\</span>AuthenticationException<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
    \<span class="token scope">Illuminate<span class="token punctuation">\</span>Auth<span class="token punctuation">\</span>Access<span class="token punctuation">\</span>AuthorizationException<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
    \<span class="token scope">Symfony<span class="token punctuation">\</span>Component<span class="token punctuation">\</span>HttpKernel<span class="token punctuation">\</span>Exception<span class="token punctuation">\</span>HttpException<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
    \<span class="token scope">Illuminate<span class="token punctuation">\</span>Database<span class="token punctuation">\</span>Eloquent<span class="token punctuation">\</span>ModelNotFoundException<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
    \<span class="token scope">Illuminate<span class="token punctuation">\</span>Validation<span class="token punctuation">\</span>ValidationException<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">;</span></code></pre>
	<p><a name="render-method"></a></p>
	<h3>The Render Method</h3>
	<p>The <code class=" language-php">render</code> method is responsible for converting a given exception into an HTTP response that should be sent back to the browser. By default, the exception is passed to the base class which generates a response for you. However, you are free to check the exception type or return your own custom response:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Render an exception into an HTTP response.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \Exception  $exception
 * @return \Illuminate\Http\Response
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">render<span class="token punctuation">(</span></span><span class="token variable">$request</span><span class="token punctuation">,</span> Exception <span class="token variable">$exception</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token keyword">if</span> <span class="token punctuation">(</span><span class="token variable">$exception</span> <span class="token keyword">instanceof</span> <span class="token class-name">CustomException</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
        <span class="token keyword">return</span> <span class="token function">response<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">view<span class="token punctuation">(</span></span><span class="token string">'errors.custom'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token number">500</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>

    <span class="token keyword">return</span> <span class="token scope"><span class="token keyword">parent</span><span class="token punctuation">::</span></span><span class="token function">render<span class="token punctuation">(</span></span><span class="token variable">$request</span><span class="token punctuation">,</span> <span class="token variable">$exception</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="renderable-exceptions"></a></p>
	<h3>Reportable &amp; Renderable Exceptions</h3>
	<p>Instead of type-checking exceptions in the exception handler's <code class=" language-php">report</code> and <code class=" language-php">render</code> methods, you may define <code class=" language-php">report</code> and <code class=" language-php">render</code> methods directly on your custom exception. When these methods exist, they will be called automatically by the framework:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Exceptions</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Exception</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">RenderException</span> <span class="token keyword">extends</span> <span class="token class-name">Exception</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Report the exception.
     *
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">report<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
       <span class="token comment" spellcheck="true"> //
</span>    <span class="token punctuation">}</span>

    <span class="token comment" spellcheck="true">/**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">render<span class="token punctuation">(</span></span><span class="token variable">$request</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token keyword">return</span> <span class="token function">response<span class="token punctuation">(</span></span><span class="token punctuation">.</span><span class="token punctuation">.</span><span class="token punctuation">.</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="http-exceptions"></a></p>
	<h2><a href="#http-exceptions">HTTP Exceptions</a></h2>
	<p>Some exceptions describe HTTP error codes from the server. For example, this may be a "page not found" error (404), an "unauthorized error" (401) or even a developer generated 500 error. In order to generate such a response from anywhere in your application, you may use the <code class=" language-php">abort</code> helper:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">abort<span class="token punctuation">(</span></span><span class="token number">404</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>The <code class=" language-php">abort</code> helper will immediately raise an exception which will be rendered by the exception handler. Optionally, you may provide the response text:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token function">abort<span class="token punctuation">(</span></span><span class="token number">403</span><span class="token punctuation">,</span> <span class="token string">'Unauthorized action.'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="custom-http-error-pages"></a></p>
	<h3>Custom HTTP Error Pages</h3>
	<p>Space MVC makes it easy to display custom error pages for various HTTP status codes. For example, if you wish to customize the error page for 404 HTTP status codes, create a <code class=" language-php">resources<span class="token operator">/</span>views<span class="token operator">/</span>errors<span class="token operator">/</span><span class="token number">404</span><span class="token punctuation">.</span>blade<span class="token punctuation">.</span>php</code>. This file will be served on all 404 errors generated by your application. The views within this directory should be named to match the HTTP status code they correspond to. The <code class=" language-php">HttpException</code> instance raised by the <code class=" language-php">abort</code> function will be passed to the view as an <code class=" language-php"><span class="token variable">$exception</span></code> variable:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>h2</span><span class="token punctuation">&gt;</span></span></span><span class="token punctuation">{</span><span class="token punctuation">{</span> <span class="token variable">$exception</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">getMessage<span class="token punctuation">(</span></span><span class="token punctuation">)</span> <span class="token punctuation">}</span><span class="token punctuation">}</span><span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>h2</span><span class="token punctuation">&gt;</span></span></span></code></pre>
</article>