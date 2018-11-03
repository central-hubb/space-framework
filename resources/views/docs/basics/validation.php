<article>
	<h1>Validation</h1>
	<ul>
		<li><a href="#introduction">Introduction</a></li>
		<li><a href="#validation-quickstart">Validation Quickstart</a>
			<ul>
				<li><a href="#quick-defining-the-routes">Defining The Routes</a></li>
				<li><a href="#quick-creating-the-controller">Creating The Controller</a></li>
				<li><a href="#quick-writing-the-validation-logic">Writing The Validation Logic</a></li>
				<li><a href="#quick-displaying-the-validation-errors">Displaying The Validation Errors</a></li>
				<li><a href="#a-note-on-optional-fields">A Note On Optional Fields</a></li>
			</ul></li>
		<li><a href="#form-request-validation">Form Request Validation</a>
			<ul>
				<li><a href="#creating-form-requests">Creating Form Requests</a></li>
				<li><a href="#authorizing-form-requests">Authorizing Form Requests</a></li>
				<li><a href="#customizing-the-error-messages">Customizing The Error Messages</a></li>
			</ul></li>
		<li><a href="#manually-creating-validators">Manually Creating Validators</a>
			<ul>
				<li><a href="#automatic-redirection">Automatic Redirection</a></li>
				<li><a href="#named-error-bags">Named Error Bags</a></li>
				<li><a href="#after-validation-hook">After Validation Hook</a></li>
			</ul></li>
		<li><a href="#working-with-error-messages">Working With Error Messages</a>
			<ul>
				<li><a href="#custom-error-messages">Custom Error Messages</a></li>
			</ul></li>
		<li><a href="#available-validation-rules">Available Validation Rules</a></li>
		<li><a href="#conditionally-adding-rules">Conditionally Adding Rules</a></li>
		<li><a href="#validating-arrays">Validating Arrays</a></li>
		<li><a href="#custom-validation-rules">Custom Validation Rules</a>
			<ul>
				<li><a href="#using-rule-objects">Using Rule Objects</a></li>
				<li><a href="#using-closures">Using Closures</a></li>
				<li><a href="#using-extensions">Using Extensions</a></li>
			</ul></li>
	</ul>
	<p><a name="introduction"></a></p>
	<h2><a href="#introduction">Introduction</a></h2>
	<p>Laravel provides several different approaches to validate your application's incoming data. By default, Laravel's base controller class uses a <code class=" language-php">ValidatesRequests</code> trait which provides a convenient method to validate incoming HTTP request with a variety of powerful validation rules.</p>
	<p><a name="validation-quickstart"></a></p>
	<h2><a href="#validation-quickstart">Validation Quickstart</a></h2>
	<p>To learn about Laravel's powerful validation features, let's look at a complete example of validating a form and displaying the error messages back to the user.</p>
	<p><a name="quick-defining-the-routes"></a></p>
	<h3>Defining The Routes</h3>
	<p>First, let's assume we have the following routes defined in our <code class=" language-php">routes<span class="token operator">/</span>web<span class="token punctuation">.</span>php</code> file:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Route<span class="token punctuation">::</span></span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'post/create'</span><span class="token punctuation">,</span> <span class="token string">'PostController@create'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token scope">Route<span class="token punctuation">::</span></span><span class="token function">post<span class="token punctuation">(</span></span><span class="token string">'post'</span><span class="token punctuation">,</span> <span class="token string">'PostController@store'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>Of course, the <code class=" language-php"><span class="token constant">GET</span></code> route will display a form for the user to create a new blog post, while the <code class=" language-php"><span class="token constant">POST</span></code> route will store the new blog post in the database.</p>
	<p><a name="quick-creating-the-controller"></a></p>
	<h3>Creating The Controller</h3>
	<p>Next, let's take a look at a simple controller that handles these routes. We'll leave the <code class=" language-php">store</code> method empty for now:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Controllers</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Request</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Controllers<span class="token punctuation">\</span>Controller</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">PostController</span> <span class="token keyword">extends</span> <span class="token class-name">Controller</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Show the form to create a new blog post.
     *
     * @return Response
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">create<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token keyword">return</span> <span class="token function">view<span class="token punctuation">(</span></span><span class="token string">'post.create'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>

    <span class="token comment" spellcheck="true">/**
     * Store a new blog post.
     *
     * @param  Request  $request
     * @return Response
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">store<span class="token punctuation">(</span></span>Request <span class="token variable">$request</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
       <span class="token comment" spellcheck="true"> // Validate and store the blog post...
</span>    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="quick-writing-the-validation-logic"></a></p>
	<h3>Writing The Validation Logic</h3>
	<p>Now we are ready to fill in our <code class=" language-php">store</code> method with the logic to validate the new blog post. To do this, we will use the <code class=" language-php">validate</code> method provided by the <code class=" language-php">Illuminate\<span class="token package">Http<span class="token punctuation">\</span>Request</span></code> object. If the validation rules pass, your code will keep executing normally; however, if validation fails, an exception will be thrown and the proper error response will automatically be sent back to the user. In the case of a traditional HTTP request, a redirect response will be generated, while a JSON response will be sent for AJAX requests.</p>
	<p>To get a better understanding of the <code class=" language-php">validate</code> method, let's jump back into the <code class=" language-php">store</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Store a new blog post.
 *
 * @param  Request  $request
 * @return Response
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">store<span class="token punctuation">(</span></span>Request <span class="token variable">$request</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token variable">$validatedData</span> <span class="token operator">=</span> <span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">validate<span class="token punctuation">(</span></span><span class="token punctuation">[</span>
        <span class="token string">'title'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'required|unique:posts|max:255'</span><span class="token punctuation">,</span>
        <span class="token string">'body'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'required'</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

   <span class="token comment" spellcheck="true"> // The blog post is valid...
</span><span class="token punctuation">}</span></code></pre>
	<p>As you can see, we pass the desired validation rules into the <code class=" language-php">validate</code> method. Again, if the validation fails, the proper response will automatically be generated. If the validation passes, our controller will continue executing normally.</p>
	<h4>Stopping On First Validation Failure</h4>
	<p>Sometimes you may wish to stop running validation rules on an attribute after the first validation failure. To do so, assign the <code class=" language-php">bail</code> rule to the attribute:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">validate<span class="token punctuation">(</span></span><span class="token punctuation">[</span>
    <span class="token string">'title'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'bail|required|unique:posts|max:255'</span><span class="token punctuation">,</span>
    <span class="token string">'body'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'required'</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>In this example, if the <code class=" language-php">unique</code> rule on the <code class=" language-php">title</code> attribute fails, the <code class=" language-php">max</code> rule will not be checked. Rules will be validated in the order they are assigned.</p>
	<h4>A Note On Nested Attributes</h4>
	<p>If your HTTP request contains "nested" parameters, you may specify them in your validation rules using "dot" syntax:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">validate<span class="token punctuation">(</span></span><span class="token punctuation">[</span>
    <span class="token string">'title'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'required|unique:posts|max:255'</span><span class="token punctuation">,</span>
    <span class="token string">'author.name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'required'</span><span class="token punctuation">,</span>
    <span class="token string">'author.description'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'required'</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="quick-displaying-the-validation-errors"></a></p>
	<h3>Displaying The Validation Errors</h3>
	<p>So, what if the incoming request parameters do not pass the given validation rules? As mentioned previously, Laravel will automatically redirect the user back to their previous location. In addition, all of the validation errors will automatically be <a href="/docs/5.7/session#flash-data">flashed to the session</a>.</p>
	<p>Again, notice that we did not have to explicitly bind the error messages to the view in our <code class=" language-php"><span class="token constant">GET</span></code> route. This is because Laravel will check for errors in the session data, and automatically bind them to the view if they are available. The <code class=" language-php"><span class="token variable">$errors</span></code> variable will be an instance of <code class=" language-php">Illuminate\<span class="token package">Support<span class="token punctuation">\</span>MessageBag</span></code>. For more information on working with this object, <a href="#working-with-error-messages">check out its documentation</a>.</p>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> The <code class=" language-php"><span class="token variable">$errors</span></code> variable is bound to the view by the <code class=" language-php">Illuminate\<span class="token package">View<span class="token punctuation">\</span>Middleware<span class="token punctuation">\</span>ShareErrorsFromSession</span></code> middleware, which is provided by the <code class=" language-php">web</code> middleware group. <strong>When this middleware is applied an <code class=" language-php"><span class="token variable">$errors</span></code> variable will always be available in your views</strong>, allowing you to conveniently assume the <code class=" language-php"><span class="token variable">$errors</span></code> variable is always defined and can be safely used.</p>
	</blockquote>
	<p>So, in our example, the user will be redirected to our controller's <code class=" language-php">create</code> method when validation fails, allowing us to display the error messages in the view:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token markup"><span class="token comment" spellcheck="true">&lt;!-- /resources/views/post/create.blade.php --&gt;</span></span>

<span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>h1</span><span class="token punctuation">&gt;</span></span></span>Create Post<span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>h1</span><span class="token punctuation">&gt;</span></span></span>

@<span class="token keyword">if</span> <span class="token punctuation">(</span><span class="token variable">$errors</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">any<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">)</span>
    <span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>alert alert-danger<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span></span>
        <span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>ul</span><span class="token punctuation">&gt;</span></span></span>
            @<span class="token keyword">foreach</span> <span class="token punctuation">(</span><span class="token variable">$errors</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">all<span class="token punctuation">(</span></span><span class="token punctuation">)</span> <span class="token keyword">as</span> <span class="token variable">$error</span><span class="token punctuation">)</span>
                <span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>li</span><span class="token punctuation">&gt;</span></span></span><span class="token punctuation">{</span><span class="token punctuation">{</span> <span class="token variable">$error</span> <span class="token punctuation">}</span><span class="token punctuation">}</span><span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>li</span><span class="token punctuation">&gt;</span></span></span>
            @<span class="token keyword">endforeach</span>
        <span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>ul</span><span class="token punctuation">&gt;</span></span></span>
    <span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span></span>
@<span class="token keyword">endif</span>

<span class="token markup"><span class="token comment" spellcheck="true">&lt;!-- Create Post Form --&gt;</span></span></code></pre>
	<p><a name="a-note-on-optional-fields"></a></p>
	<h3>A Note On Optional Fields</h3>
	<p>By default, Laravel includes the <code class=" language-php">TrimStrings</code> and <code class=" language-php">ConvertEmptyStringsToNull</code> middleware in your application's global middleware stack. These middleware are listed in the stack by the <code class=" language-php">App\<span class="token package">Http<span class="token punctuation">\</span>Kernel</span></code> class. Because of this, you will often need to mark your "optional" request fields as <code class=" language-php">nullable</code> if you do not want the validator to consider <code class=" language-php"><span class="token keyword">null</span></code> values as invalid. For example:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">validate<span class="token punctuation">(</span></span><span class="token punctuation">[</span>
    <span class="token string">'title'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'required|unique:posts|max:255'</span><span class="token punctuation">,</span>
    <span class="token string">'body'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'required'</span><span class="token punctuation">,</span>
    <span class="token string">'publish_at'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'nullable|date'</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>In this example, we are specifying that the <code class=" language-php">publish_at</code> field may be either <code class=" language-php"><span class="token keyword">null</span></code> or a valid date representation. If the <code class=" language-php">nullable</code> modifier is not added to the rule definition, the validator would consider <code class=" language-php"><span class="token keyword">null</span></code> an invalid date.</p>
	<p><a name="quick-ajax-requests-and-validation"></a></p>
	<h4>AJAX Requests &amp; Validation</h4>
	<p>In this example, we used a traditional form to send data to the application. However, many applications use AJAX requests. When using the <code class=" language-php">validate</code> method during an AJAX request, Laravel will not generate a redirect response. Instead, Laravel generates a JSON response containing all of the validation errors. This JSON response will be sent with a 422 HTTP status code.</p>
	<p><a name="form-request-validation"></a></p>
	<h2><a href="#form-request-validation">Form Request Validation</a></h2>
	<p><a name="creating-form-requests"></a></p>
	<h3>Creating Form Requests</h3>
	<p>For more complex validation scenarios, you may wish to create a "form request". Form requests are custom request classes that contain validation logic. To create a form request class, use the <code class=" language-php">make<span class="token punctuation">:</span>request</code> Artisan CLI command:</p>
	<pre class=" language-php"><code class=" language-php">php artisan make<span class="token punctuation">:</span>request StoreBlogPost</code></pre>
	<p>The generated class will be placed in the <code class=" language-php">app<span class="token operator">/</span>Http<span class="token operator">/</span>Requests</code> directory. If this directory does not exist, it will be created when you run the <code class=" language-php">make<span class="token punctuation">:</span>request</code> command. Let's add a few validation rules to the <code class=" language-php">rules</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Get the validation rules that apply to the request.
 *
 * @return array
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">rules<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token punctuation">[</span>
        <span class="token string">'title'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'required|unique:posts|max:255'</span><span class="token punctuation">,</span>
        <span class="token string">'body'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'required'</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> You may type-hint any dependencies you need within the <code class=" language-php">rules</code> method's signature. They will automatically be resolved via the Laravel <a href="/docs/5.7/container">service container</a>.</p>
	</blockquote>
	<p>So, how are the validation rules evaluated? All you need to do is type-hint the request on your controller method. The incoming form request is validated before the controller method is called, meaning you do not need to clutter your controller with any validation logic:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Store the incoming blog post.
 *
 * @param  StoreBlogPost  $request
 * @return Response
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">store<span class="token punctuation">(</span></span>StoreBlogPost <span class="token variable">$request</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> // The incoming request is valid...
</span>
   <span class="token comment" spellcheck="true"> // Retrieve the validated input data...
</span>    <span class="token variable">$validated</span> <span class="token operator">=</span> <span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">validated<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p>If validation fails, a redirect response will be generated to send the user back to their previous location. The errors will also be flashed to the session so they are available for display. If the request was an AJAX request, a HTTP response with a 422 status code will be returned to the user including a JSON representation of the validation errors.</p>
	<h4>Adding After Hooks To Form Requests</h4>
	<p>If you would like to add an "after" hook to a form request, you may use the <code class=" language-php">withValidator</code> method. This method receives the fully constructed validator, allowing you to call any of its methods before the validation rules are actually evaluated:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Configure the validator instance.
 *
 * @param  \Illuminate\Validation\Validator  $validator
 * @return void
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">withValidator<span class="token punctuation">(</span></span><span class="token variable">$validator</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token variable">$validator</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">after<span class="token punctuation">(</span></span><span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$validator</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
        <span class="token keyword">if</span> <span class="token punctuation">(</span><span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">somethingElseIsInvalid<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
            <span class="token variable">$validator</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">errors<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">add<span class="token punctuation">(</span></span><span class="token string">'field'</span><span class="token punctuation">,</span> <span class="token string">'Something is wrong with this field!'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
        <span class="token punctuation">}</span>
    <span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="authorizing-form-requests"></a></p>
	<h3>Authorizing Form Requests</h3>
	<p>The form request class also contains an <code class=" language-php">authorize</code> method. Within this method, you may check if the authenticated user actually has the authority to update a given resource. For example, you may determine if a user actually owns a blog comment they are attempting to update:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Determine if the user is authorized to make this request.
 *
 * @return bool
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">authorize<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token variable">$comment</span> <span class="token operator">=</span> <span class="token scope">Comment<span class="token punctuation">::</span></span><span class="token function">find<span class="token punctuation">(</span></span><span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">route<span class="token punctuation">(</span></span><span class="token string">'comment'</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

    <span class="token keyword">return</span> <span class="token variable">$comment</span> <span class="token operator">&amp;&amp;</span> <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">user<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">can<span class="token punctuation">(</span></span><span class="token string">'update'</span><span class="token punctuation">,</span> <span class="token variable">$comment</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p>Since all form requests extend the base Laravel request class, we may use the <code class=" language-php">user</code> method to access the currently authenticated user. Also note the call to the <code class=" language-php">route</code> method in the example above. This method grants you access to the URI parameters defined on the route being called, such as the <code class=" language-php"><span class="token punctuation">{</span>comment<span class="token punctuation">}</span></code> parameter in the example below:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Route<span class="token punctuation">::</span></span><span class="token function">post<span class="token punctuation">(</span></span><span class="token string">'comment/{comment}'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>If the <code class=" language-php">authorize</code> method returns <code class=" language-php"><span class="token boolean">false</span></code>, a HTTP response with a 403 status code will automatically be returned and your controller method will not execute.</p>
	<p>If you plan to have authorization logic in another part of your application, return <code class=" language-php"><span class="token boolean">true</span></code> from the <code class=" language-php">authorize</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Determine if the user is authorized to make this request.
 *
 * @return bool
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">authorize<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token boolean">true</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> You may type-hint any dependencies you need within the <code class=" language-php">authorize</code> method's signature. They will automatically be resolved via the Laravel <a href="/docs/5.7/container">service container</a>.</p>
	</blockquote>
	<p><a name="customizing-the-error-messages"></a></p>
	<h3>Customizing The Error Messages</h3>
	<p>You may customize the error messages used by the form request by overriding the <code class=" language-php">messages</code> method. This method should return an array of attribute / rule pairs and their corresponding error messages:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Get the error messages for the defined validation rules.
 *
 * @return array
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">messages<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token punctuation">[</span>
        <span class="token string">'title.required'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'A title is required'</span><span class="token punctuation">,</span>
        <span class="token string">'body.required'</span>  <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'A message is required'</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="manually-creating-validators"></a></p>
	<h2><a href="#manually-creating-validators">Manually Creating Validators</a></h2>
	<p>If you do not want to use the <code class=" language-php">validate</code> method on the request, you may create a validator instance manually using the <code class=" language-php">Validator</code> <a href="/docs/5.7/facades">facade</a>. The <code class=" language-php">make</code> method on the facade generates a new validator instance:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Controllers</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Validator</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Request</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Controllers<span class="token punctuation">\</span>Controller</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">PostController</span> <span class="token keyword">extends</span> <span class="token class-name">Controller</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Store a new blog post.
     *
     * @param  Request  $request
     * @return Response
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">store<span class="token punctuation">(</span></span>Request <span class="token variable">$request</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token variable">$validator</span> <span class="token operator">=</span> <span class="token scope">Validator<span class="token punctuation">::</span></span><span class="token function">make<span class="token punctuation">(</span></span><span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">all<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">,</span> <span class="token punctuation">[</span>
            <span class="token string">'title'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'required|unique:posts|max:255'</span><span class="token punctuation">,</span>
            <span class="token string">'body'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'required'</span><span class="token punctuation">,</span>
        <span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

        <span class="token keyword">if</span> <span class="token punctuation">(</span><span class="token variable">$validator</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">fails<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
            <span class="token keyword">return</span> <span class="token function">redirect<span class="token punctuation">(</span></span><span class="token string">'post/create'</span><span class="token punctuation">)</span>
                        <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">withErrors<span class="token punctuation">(</span></span><span class="token variable">$validator</span><span class="token punctuation">)</span>
                        <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">withInput<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
        <span class="token punctuation">}</span>

       <span class="token comment" spellcheck="true"> // Store the blog post...
</span>    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p>The first argument passed to the <code class=" language-php">make</code> method is the data under validation. The second argument is the validation rules that should be applied to the data.</p>
	<p>After checking if the request validation failed, you may use the <code class=" language-php">withErrors</code> method to flash the error messages to the session. When using this method, the <code class=" language-php"><span class="token variable">$errors</span></code> variable will automatically be shared with your views after redirection, allowing you to easily display them back to the user. The <code class=" language-php">withErrors</code> method accepts a validator, a <code class=" language-php">MessageBag</code>, or a PHP <code class=" language-php"><span class="token keyword">array</span></code>.</p>
	<p><a name="automatic-redirection"></a></p>
	<h3>Automatic Redirection</h3>
	<p>If you would like to create a validator instance manually but still take advantage of the automatic redirection offered by the requests's <code class=" language-php">validate</code> method, you may call the <code class=" language-php">validate</code> method on an existing validator instance. If validation fails, the user will automatically be redirected or, in the case of an AJAX request, a JSON response will be returned:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Validator<span class="token punctuation">::</span></span><span class="token function">make<span class="token punctuation">(</span></span><span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">all<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">,</span> <span class="token punctuation">[</span>
    <span class="token string">'title'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'required|unique:posts|max:255'</span><span class="token punctuation">,</span>
    <span class="token string">'body'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'required'</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">validate<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="named-error-bags"></a></p>
	<h3>Named Error Bags</h3>
	<p>If you have multiple forms on a single page, you may wish to name the <code class=" language-php">MessageBag</code> of errors, allowing you to retrieve the error messages for a specific form. Pass a name as the second argument to <code class=" language-php">withErrors</code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token function">redirect<span class="token punctuation">(</span></span><span class="token string">'register'</span><span class="token punctuation">)</span>
            <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">withErrors<span class="token punctuation">(</span></span><span class="token variable">$validator</span><span class="token punctuation">,</span> <span class="token string">'login'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>You may then access the named <code class=" language-php">MessageBag</code> instance from the <code class=" language-php"><span class="token variable">$errors</span></code> variable:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token punctuation">{</span><span class="token punctuation">{</span> <span class="token variable">$errors</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">login</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">first<span class="token punctuation">(</span></span><span class="token string">'email'</span><span class="token punctuation">)</span> <span class="token punctuation">}</span><span class="token punctuation">}</span></code></pre>
	<p><a name="after-validation-hook"></a></p>
	<h3>After Validation Hook</h3>
	<p>The validator also allows you to attach callbacks to be run after validation is completed. This allows you to easily perform further validation and even add more error messages to the message collection. To get started, use the <code class=" language-php">after</code> method on a validator instance:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$validator</span> <span class="token operator">=</span> <span class="token scope">Validator<span class="token punctuation">::</span></span><span class="token function">make<span class="token punctuation">(</span></span><span class="token punctuation">.</span><span class="token punctuation">.</span><span class="token punctuation">.</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$validator</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">after<span class="token punctuation">(</span></span><span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$validator</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">if</span> <span class="token punctuation">(</span><span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">somethingElseIsInvalid<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
        <span class="token variable">$validator</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">errors<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">add<span class="token punctuation">(</span></span><span class="token string">'field'</span><span class="token punctuation">,</span> <span class="token string">'Something is wrong with this field!'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token keyword">if</span> <span class="token punctuation">(</span><span class="token variable">$validator</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">fails<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span></code></pre>
	<p><a name="working-with-error-messages"></a></p>
	<h2><a href="#working-with-error-messages">Working With Error Messages</a></h2>
	<p>After calling the <code class=" language-php">errors</code> method on a <code class=" language-php">Validator</code> instance, you will receive an <code class=" language-php">Illuminate\<span class="token package">Support<span class="token punctuation">\</span>MessageBag</span></code> instance, which has a variety of convenient methods for working with error messages. The <code class=" language-php"><span class="token variable">$errors</span></code> variable that is automatically made available to all views is also an instance of the <code class=" language-php">MessageBag</code> class.</p>
	<h4>Retrieving The First Error Message For A Field</h4>
	<p>To retrieve the first error message for a given field, use the <code class=" language-php">first</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$errors</span> <span class="token operator">=</span> <span class="token variable">$validator</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">errors<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token keyword">echo</span> <span class="token variable">$errors</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">first<span class="token punctuation">(</span></span><span class="token string">'email'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Retrieving All Error Messages For A Field</h4>
	<p>If you need to retrieve an array of all the messages for a given field, use the <code class=" language-php">get</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">foreach</span> <span class="token punctuation">(</span><span class="token variable">$errors</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'email'</span><span class="token punctuation">)</span> <span class="token keyword">as</span> <span class="token variable">$message</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span></code></pre>
	<p>If you are validating an array form field, you may retrieve all of the messages for each of the array elements using the <code class=" language-php"><span class="token operator">*</span></code> character:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">foreach</span> <span class="token punctuation">(</span><span class="token variable">$errors</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'attachments.*'</span><span class="token punctuation">)</span> <span class="token keyword">as</span> <span class="token variable">$message</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span></code></pre>
	<h4>Retrieving All Error Messages For All Fields</h4>
	<p>To retrieve an array of all messages for all fields, use the <code class=" language-php">all</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">foreach</span> <span class="token punctuation">(</span><span class="token variable">$errors</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">all<span class="token punctuation">(</span></span><span class="token punctuation">)</span> <span class="token keyword">as</span> <span class="token variable">$message</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span></code></pre>
	<h4>Determining If Messages Exist For A Field</h4>
	<p>The <code class=" language-php">has</code> method may be used to determine if any error messages exist for a given field:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">if</span> <span class="token punctuation">(</span><span class="token variable">$errors</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">has<span class="token punctuation">(</span></span><span class="token string">'email'</span><span class="token punctuation">)</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span></code></pre>
	<p><a name="custom-error-messages"></a></p>
	<h3>Custom Error Messages</h3>
	<p>If needed, you may use custom error messages for validation instead of the defaults. There are several ways to specify custom messages. First, you may pass the custom messages as the third argument to the <code class=" language-php"><span class="token scope">Validator<span class="token punctuation">::</span></span>make</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$messages</span> <span class="token operator">=</span> <span class="token punctuation">[</span>
    <span class="token string">'required'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'The :attribute field is required.'</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$validator</span> <span class="token operator">=</span> <span class="token scope">Validator<span class="token punctuation">::</span></span><span class="token function">make<span class="token punctuation">(</span></span><span class="token variable">$input</span><span class="token punctuation">,</span> <span class="token variable">$rules</span><span class="token punctuation">,</span> <span class="token variable">$messages</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>In this example, the <code class=" language-php"><span class="token punctuation">:</span>attribute</code> place-holder will be replaced by the actual name of the field under validation. You may also utilize other place-holders in validation messages. For example:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$messages</span> <span class="token operator">=</span> <span class="token punctuation">[</span>
    <span class="token string">'same'</span>    <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'The :attribute and :other must match.'</span><span class="token punctuation">,</span>
    <span class="token string">'size'</span>    <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'The :attribute must be exactly :size.'</span><span class="token punctuation">,</span>
    <span class="token string">'between'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'The :attribute value :input is not between :min - :max.'</span><span class="token punctuation">,</span>
    <span class="token string">'in'</span>      <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'The :attribute must be one of the following types: :values'</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">;</span></code></pre>
	<h4>Specifying A Custom Message For A Given Attribute</h4>
	<p>Sometimes you may wish to specify a custom error messages only for a specific field. You may do so using "dot" notation. Specify the attribute's name first, followed by the rule:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$messages</span> <span class="token operator">=</span> <span class="token punctuation">[</span>
    <span class="token string">'email.required'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'We need to know your e-mail address!'</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">;</span></code></pre>
	<p><a name="localization"></a></p>
	<h4>Specifying Custom Messages In Language Files</h4>
	<p>In most cases, you will probably specify your custom messages in a language file instead of passing them directly to the <code class=" language-php">Validator</code>. To do so, add your messages to <code class=" language-php">custom</code> array in the <code class=" language-php">resources<span class="token operator">/</span>lang<span class="token operator">/</span>xx<span class="token operator">/</span>validation<span class="token punctuation">.</span>php</code> language file.</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'custom'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
    <span class="token string">'email'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'required'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'We need to know your e-mail address!'</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<h4>Specifying Custom Attributes In Language Files</h4>
	<p>If you would like the <code class=" language-php"><span class="token punctuation">:</span>attribute</code> portion of your validation message to be replaced with a custom attribute name, you may specify the custom name in the <code class=" language-php">attributes</code> array of your <code class=" language-php">resources<span class="token operator">/</span>lang<span class="token operator">/</span>xx<span class="token operator">/</span>validation<span class="token punctuation">.</span>php</code> language file:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'attributes'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
    <span class="token string">'email'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'email address'</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<p><a name="available-validation-rules"></a></p>
	<h2><a href="#available-validation-rules">Available Validation Rules</a></h2>
	<p>Below is a list of all available validation rules and their function:</p>
	<style>
		.collection-method-list > p {
			column-count: 3; -moz-column-count: 3; -webkit-column-count: 3;
			column-gap: 2em; -moz-column-gap: 2em; -webkit-column-gap: 2em;
		}

		.collection-method-list a {
			display: block;
		}
	</style>
	<div class="collection-method-list">
		<p><a href="#rule-accepted">Accepted</a>
			<a href="#rule-active-url">Active URL</a>
			<a href="#rule-after">After (Date)</a>
			<a href="#rule-after-or-equal">After Or Equal (Date)</a>
			<a href="#rule-alpha">Alpha</a>
			<a href="#rule-alpha-dash">Alpha Dash</a>
			<a href="#rule-alpha-num">Alpha Numeric</a>
			<a href="#rule-array">Array</a>
			<a href="#rule-bail">Bail</a>
			<a href="#rule-before">Before (Date)</a>
			<a href="#rule-before-or-equal">Before Or Equal (Date)</a>
			<a href="#rule-between">Between</a>
			<a href="#rule-boolean">Boolean</a>
			<a href="#rule-confirmed">Confirmed</a>
			<a href="#rule-date">Date</a>
			<a href="#rule-date-equals">Date Equals</a>
			<a href="#rule-date-format">Date Format</a>
			<a href="#rule-different">Different</a>
			<a href="#rule-digits">Digits</a>
			<a href="#rule-digits-between">Digits Between</a>
			<a href="#rule-dimensions">Dimensions (Image Files)</a>
			<a href="#rule-distinct">Distinct</a>
			<a href="#rule-email">E-Mail</a>
			<a href="#rule-exists">Exists (Database)</a>
			<a href="#rule-file">File</a>
			<a href="#rule-filled">Filled</a>
			<a href="#rule-gt">Greater Than</a>
			<a href="#rule-gte">Greater Than Or Equal</a>
			<a href="#rule-image">Image (File)</a>
			<a href="#rule-in">In</a>
			<a href="#rule-in-array">In Array</a>
			<a href="#rule-integer">Integer</a>
			<a href="#rule-ip">IP Address</a>
			<a href="#rule-json">JSON</a>
			<a href="#rule-lt">Less Than</a>
			<a href="#rule-lte">Less Than Or Equal</a>
			<a href="#rule-max">Max</a>
			<a href="#rule-mimetypes">MIME Types</a>
			<a href="#rule-mimes">MIME Type By File Extension</a>
			<a href="#rule-min">Min</a>
			<a href="#rule-not-in">Not In</a>
			<a href="#rule-not-regex">Not Regex</a>
			<a href="#rule-nullable">Nullable</a>
			<a href="#rule-numeric">Numeric</a>
			<a href="#rule-present">Present</a>
			<a href="#rule-regex">Regular Expression</a>
			<a href="#rule-required">Required</a>
			<a href="#rule-required-if">Required If</a>
			<a href="#rule-required-unless">Required Unless</a>
			<a href="#rule-required-with">Required With</a>
			<a href="#rule-required-with-all">Required With All</a>
			<a href="#rule-required-without">Required Without</a>
			<a href="#rule-required-without-all">Required Without All</a>
			<a href="#rule-same">Same</a>
			<a href="#rule-size">Size</a>
			<a href="#rule-string">String</a>
			<a href="#rule-timezone">Timezone</a>
			<a href="#rule-unique">Unique (Database)</a>
			<a href="#rule-url">URL</a>
			<a href="#rule-uuid">UUID</a></p>
	</div>
	<p><a name="rule-accepted"></a></p>
	<h4>accepted</h4>
	<p>The field under validation must be <em>yes</em>, <em>on</em>, <em>1</em>, or <em>true</em>. This is useful for validating "Terms of Service" acceptance.</p>
	<p><a name="rule-active-url"></a></p>
	<h4>active_url</h4>
	<p>The field under validation must have a valid A or AAAA record according to the <code class=" language-php">dns_get_record</code> PHP function.</p>
	<p><a name="rule-after"></a></p>
	<h4>after:<em>date</em></h4>
	<p>The field under validation must be a value after a given date. The dates will be passed into the <code class=" language-php">strtotime</code> PHP function:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'start_date'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'required|date|after:tomorrow'</span></code></pre>
	<p>Instead of passing a date string to be evaluated by <code class=" language-php">strtotime</code>, you may specify another field to compare against the date:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'finish_date'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'required|date|after:start_date'</span></code></pre>
	<p><a name="rule-after-or-equal"></a></p>
	<h4>after_or_equal:<em>date</em></h4>
	<p>The field under validation must be a value after or equal to the given date. For more information, see the <a href="#rule-after">after</a> rule.</p>
	<p><a name="rule-alpha"></a></p>
	<h4>alpha</h4>
	<p>The field under validation must be entirely alphabetic characters.</p>
	<p><a name="rule-alpha-dash"></a></p>
	<h4>alpha_dash</h4>
	<p>The field under validation may have alpha-numeric characters, as well as dashes and underscores.</p>
	<p><a name="rule-alpha-num"></a></p>
	<h4>alpha_num</h4>
	<p>The field under validation must be entirely alpha-numeric characters.</p>
	<p><a name="rule-array"></a></p>
	<h4>array</h4>
	<p>The field under validation must be a PHP <code class=" language-php"><span class="token keyword">array</span></code>.</p>
	<p><a name="rule-bail"></a></p>
	<h4>bail</h4>
	<p>Stop running validation rules after the first validation failure.</p>
	<p><a name="rule-before"></a></p>
	<h4>before:<em>date</em></h4>
	<p>The field under validation must be a value preceding the given date. The dates will be passed into the PHP <code class=" language-php">strtotime</code> function. In addition, like the <a href="#rule-after"><code class=" language-php">after</code></a> rule, the name of another field under validation may be supplied as the value of <code class=" language-php">date</code>.</p>
	<p><a name="rule-before-or-equal"></a></p>
	<h4>before_or_equal:<em>date</em></h4>
	<p>The field under validation must be a value preceding or equal to the given date. The dates will be passed into the PHP <code class=" language-php">strtotime</code> function. In addition, like the <a href="#rule-after"><code class=" language-php">after</code></a> rule, the name of another field under validation may be supplied as the value of <code class=" language-php">date</code>.</p>
	<p><a name="rule-between"></a></p>
	<h4>between:<em>min</em>,<em>max</em></h4>
	<p>The field under validation must have a size between the given <em>min</em> and <em>max</em>. Strings, numerics, arrays, and files are evaluated in the same fashion as the <a href="#rule-size"><code class=" language-php">size</code></a> rule.</p>
	<p><a name="rule-boolean"></a></p>
	<h4>boolean</h4>
	<p>The field under validation must be able to be cast as a boolean. Accepted input are <code class=" language-php"><span class="token boolean">true</span></code>, <code class=" language-php"><span class="token boolean">false</span></code>, <code class=" language-php"><span class="token number">1</span></code>, <code class=" language-php"><span class="token number">0</span></code>, <code class=" language-php"><span class="token string">"1"</span></code>, and <code class=" language-php"><span class="token string">"0"</span></code>.</p>
	<p><a name="rule-confirmed"></a></p>
	<h4>confirmed</h4>
	<p>The field under validation must have a matching field of <code class=" language-php">foo_confirmation</code>. For example, if the field under validation is <code class=" language-php">password</code>, a matching <code class=" language-php">password_confirmation</code> field must be present in the input.</p>
	<p><a name="rule-date"></a></p>
	<h4>date</h4>
	<p>The field under validation must be a valid date according to the <code class=" language-php">strtotime</code> PHP function.</p>
	<p><a name="rule-date-equals"></a></p>
	<h4>date_equals:<em>date</em></h4>
	<p>The field under validation must be equal to the given date. The dates will be passed into the PHP <code class=" language-php">strtotime</code> function.</p>
	<p><a name="rule-date-format"></a></p>
	<h4>date_format:<em>format</em></h4>
	<p>The field under validation must match the given <em>format</em>. You should use <strong>either</strong> <code class=" language-php">date</code> or <code class=" language-php">date_format</code> when validating a field, not both.</p>
	<p><a name="rule-different"></a></p>
	<h4>different:<em>field</em></h4>
	<p>The field under validation must have a different value than <em>field</em>.</p>
	<p><a name="rule-digits"></a></p>
	<h4>digits:<em>value</em></h4>
	<p>The field under validation must be <em>numeric</em> and must have an exact length of <em>value</em>.</p>
	<p><a name="rule-digits-between"></a></p>
	<h4>digits_between:<em>min</em>,<em>max</em></h4>
	<p>The field under validation must have a length between the given <em>min</em> and <em>max</em>.</p>
	<p><a name="rule-dimensions"></a></p>
	<h4>dimensions</h4>
	<p>The file under validation must be an image meeting the dimension constraints as specified by the rule's parameters:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'avatar'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'dimensions:min_width=100,min_height=200'</span></code></pre>
	<p>Available constraints are: <em>min_width</em>, <em>max_width</em>, <em>min_height</em>, <em>max_height</em>, <em>width</em>, <em>height</em>, <em>ratio</em>.</p>
	<p>A <em>ratio</em> constraint should be represented as width divided by height. This can be specified either by a statement like <code class=" language-php"><span class="token number">3</span><span class="token operator">/</span><span class="token number">2</span></code> or a float like <code class=" language-php"><span class="token number">1.5</span></code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'avatar'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'dimensions:ratio=3/2'</span></code></pre>
	<p>Since this rule requires several arguments, you may use the <code class=" language-php"><span class="token scope">Rule<span class="token punctuation">::</span></span>dimensions</code> method to fluently construct the rule:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Validation<span class="token punctuation">\</span>Rule</span><span class="token punctuation">;</span>

<span class="token scope">Validator<span class="token punctuation">::</span></span><span class="token function">make<span class="token punctuation">(</span></span><span class="token variable">$data</span><span class="token punctuation">,</span> <span class="token punctuation">[</span>
    <span class="token string">'avatar'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'required'</span><span class="token punctuation">,</span>
        <span class="token scope">Rule<span class="token punctuation">::</span></span><span class="token function">dimensions<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">maxWidth<span class="token punctuation">(</span></span><span class="token number">1000</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">maxHeight<span class="token punctuation">(</span></span><span class="token number">500</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">ratio<span class="token punctuation">(</span></span><span class="token number">3</span> <span class="token operator">/</span> <span class="token number">2</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="rule-distinct"></a></p>
	<h4>distinct</h4>
	<p>When working with arrays, the field under validation must not have any duplicate values.</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'foo.*.id'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'distinct'</span></code></pre>
	<p><a name="rule-email"></a></p>
	<h4>email</h4>
	<p>The field under validation must be formatted as an e-mail address.</p>
	<p><a name="rule-exists"></a></p>
	<h4>exists:<em>table</em>,<em>column</em></h4>
	<p>The field under validation must exist on a given database table.</p>
	<h4>Basic Usage Of Exists Rule</h4>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'state'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'exists:states'</span></code></pre>
	<p>If the <code class=" language-php">column</code> option is not specified, the field name will be used.</p>
	<h4>Specifying A Custom Column Name</h4>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'state'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'exists:states,abbreviation'</span></code></pre>
	<p>Occasionally, you may need to specify a specific database connection to be used for the <code class=" language-php">exists</code> query. You can accomplish this by prepending the connection name to the table name using "dot" syntax:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'email'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'exists:connection.staff,email'</span></code></pre>
	<p>If you would like to customize the query executed by the validation rule, you may use the <code class=" language-php">Rule</code> class to fluently define the rule. In this example, we'll also specify the validation rules as an array instead of using the <code class=" language-php"><span class="token operator">|</span></code> character to delimit them:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Validation<span class="token punctuation">\</span>Rule</span><span class="token punctuation">;</span>

<span class="token scope">Validator<span class="token punctuation">::</span></span><span class="token function">make<span class="token punctuation">(</span></span><span class="token variable">$data</span><span class="token punctuation">,</span> <span class="token punctuation">[</span>
    <span class="token string">'email'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'required'</span><span class="token punctuation">,</span>
        <span class="token scope">Rule<span class="token punctuation">::</span></span><span class="token function">exists<span class="token punctuation">(</span></span><span class="token string">'staff'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where<span class="token punctuation">(</span></span><span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$query</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
            <span class="token variable">$query</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where<span class="token punctuation">(</span></span><span class="token string">'account_id'</span><span class="token punctuation">,</span> <span class="token number">1</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
        <span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="rule-file"></a></p>
	<h4>file</h4>
	<p>The field under validation must be a successfully uploaded file.</p>
	<p><a name="rule-filled"></a></p>
	<h4>filled</h4>
	<p>The field under validation must not be empty when it is present.</p>
	<p><a name="rule-gt"></a></p>
	<h4>gt:<em>field</em></h4>
	<p>The field under validation must be greater than the given <em>field</em>. The two fields must be of the same type. Strings, numerics, arrays, and files are evaluated using the same conventions as the <code class=" language-php">size</code> rule.</p>
	<p><a name="rule-gte"></a></p>
	<h4>gte:<em>field</em></h4>
	<p>The field under validation must be greater than or equal to the given <em>field</em>. The two fields must be of the same type. Strings, numerics, arrays, and files are evaluated using the same conventions as the <code class=" language-php">size</code> rule.</p>
	<p><a name="rule-image"></a></p>
	<h4>image</h4>
	<p>The file under validation must be an image (jpeg, png, bmp, gif, or svg)</p>
	<p><a name="rule-in"></a></p>
	<h4>in:<em>foo</em>,<em>bar</em>,...</h4>
	<p>The field under validation must be included in the given list of values. Since this rule often requires you to <code class=" language-php">implode</code> an array, the <code class=" language-php"><span class="token scope">Rule<span class="token punctuation">::</span></span>in</code> method may be used to fluently construct the rule:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Validation<span class="token punctuation">\</span>Rule</span><span class="token punctuation">;</span>

<span class="token scope">Validator<span class="token punctuation">::</span></span><span class="token function">make<span class="token punctuation">(</span></span><span class="token variable">$data</span><span class="token punctuation">,</span> <span class="token punctuation">[</span>
    <span class="token string">'zones'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'required'</span><span class="token punctuation">,</span>
        <span class="token scope">Rule<span class="token punctuation">::</span></span><span class="token function">in<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'first-zone'</span><span class="token punctuation">,</span> <span class="token string">'second-zone'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="rule-in-array"></a></p>
	<h4>in_array:<em>anotherfield</em>.*</h4>
	<p>The field under validation must exist in <em>anotherfield</em>'s values.</p>
	<p><a name="rule-integer"></a></p>
	<h4>integer</h4>
	<p>The field under validation must be an integer.</p>
	<p><a name="rule-ip"></a></p>
	<h4>ip</h4>
	<p>The field under validation must be an IP address.</p>
	<h4>ipv4</h4>
	<p>The field under validation must be an IPv4 address.</p>
	<h4>ipv6</h4>
	<p>The field under validation must be an IPv6 address.</p>
	<p><a name="rule-json"></a></p>
	<h4>json</h4>
	<p>The field under validation must be a valid JSON string.</p>
	<p><a name="rule-lt"></a></p>
	<h4>lt:<em>field</em></h4>
	<p>The field under validation must be less than the given <em>field</em>. The two fields must be of the same type. Strings, numerics, arrays, and files are evaluated using the same conventions as the <code class=" language-php">size</code> rule.</p>
	<p><a name="rule-lte"></a></p>
	<h4>lte:<em>field</em></h4>
	<p>The field under validation must be less than or equal to the given <em>field</em>. The two fields must be of the same type. Strings, numerics, arrays, and files are evaluated using the same conventions as the <code class=" language-php">size</code> rule.</p>
	<p><a name="rule-max"></a></p>
	<h4>max:<em>value</em></h4>
	<p>The field under validation must be less than or equal to a maximum <em>value</em>. Strings, numerics, arrays, and files are evaluated in the same fashion as the <a href="#rule-size"><code class=" language-php">size</code></a> rule.</p>
	<p><a name="rule-mimetypes"></a></p>
	<h4>mimetypes:<em>text/plain</em>,...</h4>
	<p>The file under validation must match one of the given MIME types:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'video'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'mimetypes:video/avi,video/mpeg,video/quicktime'</span></code></pre>
	<p>To determine the MIME type of the uploaded file, the file's contents will be read and the framework will attempt to guess the MIME type, which may be different from the client provided MIME type.</p>
	<p><a name="rule-mimes"></a></p>
	<h4>mimes:<em>foo</em>,<em>bar</em>,...</h4>
	<p>The file under validation must have a MIME type corresponding to one of the listed extensions.</p>
	<h4>Basic Usage Of MIME Rule</h4>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'photo'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'mimes:jpeg,bmp,png'</span></code></pre>
	<p>Even though you only need to specify the extensions, this rule actually validates against the MIME type of the file by reading the file's contents and guessing its MIME type.</p>
	<p>A full listing of MIME types and their corresponding extensions may be found at the following location: <a href="https://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types">https://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types</a></p>
	<p><a name="rule-min"></a></p>
	<h4>min:<em>value</em></h4>
	<p>The field under validation must have a minimum <em>value</em>. Strings, numerics, arrays, and files are evaluated in the same fashion as the <a href="#rule-size"><code class=" language-php">size</code></a> rule.</p>
	<p><a name="rule-not-in"></a></p>
	<h4>not_in:<em>foo</em>,<em>bar</em>,...</h4>
	<p>The field under validation must not be included in the given list of values. The <code class=" language-php"><span class="token scope">Rule<span class="token punctuation">::</span></span>notIn</code> method may be used to fluently construct the rule:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Validation<span class="token punctuation">\</span>Rule</span><span class="token punctuation">;</span>

<span class="token scope">Validator<span class="token punctuation">::</span></span><span class="token function">make<span class="token punctuation">(</span></span><span class="token variable">$data</span><span class="token punctuation">,</span> <span class="token punctuation">[</span>
    <span class="token string">'toppings'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'required'</span><span class="token punctuation">,</span>
        <span class="token scope">Rule<span class="token punctuation">::</span></span><span class="token function">notIn<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'sprinkles'</span><span class="token punctuation">,</span> <span class="token string">'cherries'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="rule-not-regex"></a></p>
	<h4>not_regex:<em>pattern</em></h4>
	<p>The field under validation must not match the given regular expression.</p>
	<p>Internally, this rule uses the PHP <code class=" language-php">preg_match</code> function. The pattern specified should obey the same formatting required by <code class=" language-php">preg_match</code> and thus also include valid delimiters. For example: <code class=" language-php"><span class="token string">'email'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'regex:/^.+@.+$/i'</span></code>.</p>
	<p><strong>Note:</strong> When using the <code class=" language-php">regex</code> / <code class=" language-php">not_regex</code> patterns, it may be necessary to specify rules in an array instead of using pipe delimiters, especially if the regular expression contains a pipe character.</p>
	<p><a name="rule-nullable"></a></p>
	<h4>nullable</h4>
	<p>The field under validation may be <code class=" language-php"><span class="token keyword">null</span></code>. This is particularly useful when validating primitive such as strings and integers that can contain <code class=" language-php"><span class="token keyword">null</span></code> values.</p>
	<p><a name="rule-numeric"></a></p>
	<h4>numeric</h4>
	<p>The field under validation must be numeric.</p>
	<p><a name="rule-present"></a></p>
	<h4>present</h4>
	<p>The field under validation must be present in the input data but can be empty.</p>
	<p><a name="rule-regex"></a></p>
	<h4>regex:<em>pattern</em></h4>
	<p>The field under validation must match the given regular expression.</p>
	<p>Internally, this rule uses the PHP <code class=" language-php">preg_match</code> function. The pattern specified should obey the same formatting required by <code class=" language-php">preg_match</code> and thus also include valid delimiters. For example: <code class=" language-php"><span class="token string">'email'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'regex:/^.+@.+$/i'</span></code>.</p>
	<p><strong>Note:</strong> When using the <code class=" language-php">regex</code> / <code class=" language-php">not_regex</code> patterns, it may be necessary to specify rules in an array instead of using pipe delimiters, especially if the regular expression contains a pipe character.</p>
	<p><a name="rule-required"></a></p>
	<h4>required</h4>
	<p>The field under validation must be present in the input data and not empty. A field is considered "empty" if one of the following conditions are true:</p>
	<div class="content-list">
		<ul>
			<li>The value is <code class=" language-php"><span class="token keyword">null</span></code>.</li>
			<li>The value is an empty string.</li>
			<li>The value is an empty array or empty <code class=" language-php">Countable</code> object.</li>
			<li>The value is an uploaded file with no path.</li>
		</ul>
	</div>
	<p><a name="rule-required-if"></a></p>
	<h4>required_if:<em>anotherfield</em>,<em>value</em>,...</h4>
	<p>The field under validation must be present and not empty if the <em>anotherfield</em> field is equal to any <em>value</em>.</p>
	<p><a name="rule-required-unless"></a></p>
	<h4>required_unless:<em>anotherfield</em>,<em>value</em>,...</h4>
	<p>The field under validation must be present and not empty unless the <em>anotherfield</em> field is equal to any <em>value</em>.</p>
	<p><a name="rule-required-with"></a></p>
	<h4>required_with:<em>foo</em>,<em>bar</em>,...</h4>
	<p>The field under validation must be present and not empty <em>only if</em> any of the other specified fields are present.</p>
	<p><a name="rule-required-with-all"></a></p>
	<h4>required_with_all:<em>foo</em>,<em>bar</em>,...</h4>
	<p>The field under validation must be present and not empty <em>only if</em> all of the other specified fields are present.</p>
	<p><a name="rule-required-without"></a></p>
	<h4>required_without:<em>foo</em>,<em>bar</em>,...</h4>
	<p>The field under validation must be present and not empty <em>only when</em> any of the other specified fields are not present.</p>
	<p><a name="rule-required-without-all"></a></p>
	<h4>required_without_all:<em>foo</em>,<em>bar</em>,...</h4>
	<p>The field under validation must be present and not empty <em>only when</em> all of the other specified fields are not present.</p>
	<p><a name="rule-same"></a></p>
	<h4>same:<em>field</em></h4>
	<p>The given <em>field</em> must match the field under validation.</p>
	<p><a name="rule-size"></a></p>
	<h4>size:<em>value</em></h4>
	<p>The field under validation must have a size matching the given <em>value</em>. For string data, <em>value</em> corresponds to the number of characters. For numeric data, <em>value</em> corresponds to a given integer value. For an array, <em>size</em> corresponds to the <code class=" language-php">count</code> of the array. For files, <em>size</em> corresponds to the file size in kilobytes.</p>
	<p><a name="rule-string"></a></p>
	<h4>string</h4>
	<p>The field under validation must be a string. If you would like to allow the field to also be <code class=" language-php"><span class="token keyword">null</span></code>, you should assign the <code class=" language-php">nullable</code> rule to the field.</p>
	<p><a name="rule-timezone"></a></p>
	<h4>timezone</h4>
	<p>The field under validation must be a valid timezone identifier according to the <code class=" language-php">timezone_identifiers_list</code> PHP function.</p>
	<p><a name="rule-unique"></a></p>
	<h4>unique:<em>table</em>,<em>column</em>,<em>except</em>,<em>idColumn</em></h4>
	<p>The field under validation must be unique in a given database table. If the <code class=" language-php">column</code> option is not specified, the field name will be used.</p>
	<p><strong>Specifying A Custom Column Name:</strong></p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'email'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'unique:users,email_address'</span></code></pre>
	<p><strong>Custom Database Connection</strong></p>
	<p>Occasionally, you may need to set a custom connection for database queries made by the Validator. As seen above, setting <code class=" language-php">unique<span class="token punctuation">:</span>users</code> as a validation rule will use the default database connection to query the database. To override this, specify the connection and the table name using "dot" syntax:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'email'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'unique:connection.users,email_address'</span></code></pre>
	<p><strong>Forcing A Unique Rule To Ignore A Given ID:</strong></p>
	<p>Sometimes, you may wish to ignore a given ID during the unique check. For example, consider an "update profile" screen that includes the user's name, e-mail address, and location. Of course, you will want to verify that the e-mail address is unique. However, if the user only changes the name field and not the e-mail field, you do not want a validation error to be thrown because the user is already the owner of the e-mail address.</p>
	<p>To instruct the validator to ignore the user's ID, we'll use the <code class=" language-php">Rule</code> class to fluently define the rule. In this example, we'll also specify the validation rules as an array instead of using the <code class=" language-php"><span class="token operator">|</span></code> character to delimit the rules:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Validation<span class="token punctuation">\</span>Rule</span><span class="token punctuation">;</span>

<span class="token scope">Validator<span class="token punctuation">::</span></span><span class="token function">make<span class="token punctuation">(</span></span><span class="token variable">$data</span><span class="token punctuation">,</span> <span class="token punctuation">[</span>
    <span class="token string">'email'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'required'</span><span class="token punctuation">,</span>
        <span class="token scope">Rule<span class="token punctuation">::</span></span><span class="token function">unique<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">ignore<span class="token punctuation">(</span></span><span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">id</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>If your table uses a primary key column name other than <code class=" language-php">id</code>, you may specify the name of the column when calling the <code class=" language-php">ignore</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'email'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token scope">Rule<span class="token punctuation">::</span></span><span class="token function">unique<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">ignore<span class="token punctuation">(</span></span><span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">id</span><span class="token punctuation">,</span> <span class="token string">'user_id'</span><span class="token punctuation">)</span></code></pre>
	<p><strong>Adding Additional Where Clauses:</strong></p>
	<p>You may also specify additional query constraints by customizing the query using the <code class=" language-php">where</code> method. For example, let's add a constraint that verifies the <code class=" language-php">account_id</code> is <code class=" language-php"><span class="token number">1</span></code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'email'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token scope">Rule<span class="token punctuation">::</span></span><span class="token function">unique<span class="token punctuation">(</span></span><span class="token string">'users'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where<span class="token punctuation">(</span></span><span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$query</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token variable">$query</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">where<span class="token punctuation">(</span></span><span class="token string">'account_id'</span><span class="token punctuation">,</span> <span class="token number">1</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span></code></pre>
	<p><a name="rule-url"></a></p>
	<h4>url</h4>
	<p>The field under validation must be a valid URL.</p>
	<p><a name="rule-uuid"></a></p>
	<h4>uuid</h4>
	<p>The field under validation must be a valid RFC 4122 (version 1, 3, 4, or 5) universally unique identifier (UUID).</p>
	<p><a name="conditionally-adding-rules"></a></p>
	<h2><a href="#conditionally-adding-rules">Conditionally Adding Rules</a></h2>
	<h4>Validating When Present</h4>
	<p>In some situations, you may wish to run validation checks against a field <strong>only</strong> if that field is present in the input array. To quickly accomplish this, add the <code class=" language-php">sometimes</code> rule to your rule list:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$v</span> <span class="token operator">=</span> <span class="token scope">Validator<span class="token punctuation">::</span></span><span class="token function">make<span class="token punctuation">(</span></span><span class="token variable">$data</span><span class="token punctuation">,</span> <span class="token punctuation">[</span>
    <span class="token string">'email'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'sometimes|required|email'</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>In the example above, the <code class=" language-php">email</code> field will only be validated if it is present in the <code class=" language-php"><span class="token variable">$data</span></code> array.</p>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> If you are attempting to validate a field that should always be present but may be empty, check out <a href="#a-note-on-optional-fields">this note on optional fields</a></p>
	</blockquote>
	<h4>Complex Conditional Validation</h4>
	<p>Sometimes you may wish to add validation rules based on more complex conditional logic. For example, you may wish to require a given field only if another field has a greater value than 100. Or, you may need two fields to have a given value only when another field is present. Adding these validation rules doesn't have to be a pain. First, create a <code class=" language-php">Validator</code> instance with your <em>static rules</em> that never change:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$v</span> <span class="token operator">=</span> <span class="token scope">Validator<span class="token punctuation">::</span></span><span class="token function">make<span class="token punctuation">(</span></span><span class="token variable">$data</span><span class="token punctuation">,</span> <span class="token punctuation">[</span>
    <span class="token string">'email'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'required|email'</span><span class="token punctuation">,</span>
    <span class="token string">'games'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'required|numeric'</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>Let's assume our web application is for game collectors. If a game collector registers with our application and they own more than 100 games, we want them to explain why they own so many games. For example, perhaps they run a game resale shop, or maybe they just enjoy collecting. To conditionally add this requirement, we can use the <code class=" language-php">sometimes</code> method on the <code class=" language-php">Validator</code> instance.</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$v</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">sometimes<span class="token punctuation">(</span></span><span class="token string">'reason'</span><span class="token punctuation">,</span> <span class="token string">'required|max:500'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$input</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token variable">$input</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">games</span> <span class="token operator">&gt;=</span> <span class="token number">100</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>The first argument passed to the <code class=" language-php">sometimes</code> method is the name of the field we are conditionally validating. The second argument is the rules we want to add. If the <code class=" language-php">Closure</code> passed as the third argument returns <code class=" language-php"><span class="token boolean">true</span></code>, the rules will be added. This method makes it a breeze to build complex conditional validations. You may even add conditional validations for several fields at once:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$v</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">sometimes<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'reason'</span><span class="token punctuation">,</span> <span class="token string">'cost'</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token string">'required'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$input</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token variable">$input</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">games</span> <span class="token operator">&gt;=</span> <span class="token number">100</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> The <code class=" language-php"><span class="token variable">$input</span></code> parameter passed to your <code class=" language-php">Closure</code> will be an instance of <code class=" language-php">Illuminate\<span class="token package">Support<span class="token punctuation">\</span>Fluent</span></code> and may be used to access your input and files.</p>
	</blockquote>
	<p><a name="validating-arrays"></a></p>
	<h2><a href="#validating-arrays">Validating Arrays</a></h2>
	<p>Validating array based form input fields doesn't have to be a pain. You may use "dot notation" to validate attributes within an array. For example, if the incoming HTTP request contains a <code class=" language-php">photos<span class="token punctuation">[</span>profile<span class="token punctuation">]</span></code> field, you may validate it like so:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$validator</span> <span class="token operator">=</span> <span class="token scope">Validator<span class="token punctuation">::</span></span><span class="token function">make<span class="token punctuation">(</span></span><span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">all<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">,</span> <span class="token punctuation">[</span>
    <span class="token string">'photos.profile'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'required|image'</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>You may also validate each element of an array. For example, to validate that each e-mail in a given array input field is unique, you may do the following:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$validator</span> <span class="token operator">=</span> <span class="token scope">Validator<span class="token punctuation">::</span></span><span class="token function">make<span class="token punctuation">(</span></span><span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">all<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">,</span> <span class="token punctuation">[</span>
    <span class="token string">'person.*.email'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'email|unique:users'</span><span class="token punctuation">,</span>
    <span class="token string">'person.*.first_name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'required_with:person.*.last_name'</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>Likewise, you may use the <code class=" language-php"><span class="token operator">*</span></code> character when specifying your validation messages in your language files, making it a breeze to use a single validation message for array based fields:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'custom'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
    <span class="token string">'person.*.email'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'unique'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Each person must have a unique e-mail address'</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span>
<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<p><a name="custom-validation-rules"></a></p>
	<h2><a href="#custom-validation-rules">Custom Validation Rules</a></h2>
	<p><a name="using-rule-objects"></a></p>
	<h3>Using Rule Objects</h3>
	<p>Laravel provides a variety of helpful validation rules; however, you may wish to specify some of your own. One method of registering custom validation rules is using rule objects. To generate a new rule object, you may use the <code class=" language-php">make<span class="token punctuation">:</span>rule</code> Artisan command. Let's use this command to generate a rule that verifies a string is uppercase. Laravel will place the new rule in the <code class=" language-php">app<span class="token operator">/</span>Rules</code> directory:</p>
	<pre class=" language-php"><code class=" language-php">php artisan make<span class="token punctuation">:</span>rule Uppercase</code></pre>
	<p>Once the rule has been created, we are ready to define its behavior. A rule object contains two methods: <code class=" language-php">passes</code> and <code class=" language-php">message</code>. The <code class=" language-php">passes</code> method receives the attribute value and name, and should return <code class=" language-php"><span class="token boolean">true</span></code> or <code class=" language-php"><span class="token boolean">false</span></code> depending on whether the attribute value is valid or not. The <code class=" language-php">message</code> method should return the validation error message that should be used when validation fails:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Rules</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Contracts<span class="token punctuation">\</span>Validation<span class="token punctuation">\</span>Rule</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">Uppercase</span> <span class="token keyword">implements</span> <span class="token class-name">Rule</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">passes<span class="token punctuation">(</span></span><span class="token variable">$attribute</span><span class="token punctuation">,</span> <span class="token variable">$value</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token keyword">return</span> <span class="token function">strtoupper<span class="token punctuation">(</span></span><span class="token variable">$value</span><span class="token punctuation">)</span> <span class="token operator">===</span> <span class="token variable">$value</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>

    <span class="token comment" spellcheck="true">/**
     * Get the validation error message.
     *
     * @return string
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">message<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token keyword">return</span> <span class="token string">'The :attribute must be uppercase.'</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p>Of course, you may call the <code class=" language-php">trans</code> helper from your <code class=" language-php">message</code> method if you would like to return an error message from your translation files:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Get the validation error message.
 *
 * @return string
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">message<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token function">trans<span class="token punctuation">(</span></span><span class="token string">'validation.uppercase'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p>Once the rule has been defined, you may attach it to a validator by passing an instance of the rule object with your other validation rules:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Rules<span class="token punctuation">\</span>Uppercase</span><span class="token punctuation">;</span>

<span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">validate<span class="token punctuation">(</span></span><span class="token punctuation">[</span>
    <span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'required'</span><span class="token punctuation">,</span> <span class="token string">'string'</span><span class="token punctuation">,</span> <span class="token keyword">new</span> <span class="token class-name">Uppercase</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="using-closures"></a></p>
	<h3>Using Closures</h3>
	<p>If you only need the functionality of a custom rule once throughout your application, you may use a Closure instead of a rule object. The Closure receives the attribute's name, the attribute's value, and a <code class=" language-php"><span class="token variable">$fail</span></code> callback that should be called if validation fails:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$validator</span> <span class="token operator">=</span> <span class="token scope">Validator<span class="token punctuation">::</span></span><span class="token function">make<span class="token punctuation">(</span></span><span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">all<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">,</span> <span class="token punctuation">[</span>
    <span class="token string">'title'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'required'</span><span class="token punctuation">,</span>
        <span class="token string">'max:255'</span><span class="token punctuation">,</span>
        <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$attribute</span><span class="token punctuation">,</span> <span class="token variable">$value</span><span class="token punctuation">,</span> <span class="token variable">$fail</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
            <span class="token keyword">if</span> <span class="token punctuation">(</span><span class="token variable">$value</span> <span class="token operator">===</span> <span class="token string">'foo'</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
                <span class="token variable">$fail</span><span class="token punctuation">(</span><span class="token variable">$attribute</span><span class="token punctuation">.</span><span class="token string">' is invalid.'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
            <span class="token punctuation">}</span>
        <span class="token punctuation">}</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="using-extensions"></a></p>
	<h3>Using Extensions</h3>
	<p>Another method of registering custom validation rules is using the <code class=" language-php">extend</code> method on the <code class=" language-php">Validator</code> <a href="/docs/5.7/facades">facade</a>. Let's use this method within a <a href="/docs/5.7/providers">service provider</a> to register a custom validation rule:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Providers</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>ServiceProvider</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>Validator</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">AppServiceProvider</span> <span class="token keyword">extends</span> <span class="token class-name">ServiceProvider</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Bootstrap any application services.
     *
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">boot<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token scope">Validator<span class="token punctuation">::</span></span><span class="token function">extend<span class="token punctuation">(</span></span><span class="token string">'foo'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$attribute</span><span class="token punctuation">,</span> <span class="token variable">$value</span><span class="token punctuation">,</span> <span class="token variable">$parameters</span><span class="token punctuation">,</span> <span class="token variable">$validator</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
            <span class="token keyword">return</span> <span class="token variable">$value</span> <span class="token operator">==</span> <span class="token string">'foo'</span><span class="token punctuation">;</span>
        <span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>

    <span class="token comment" spellcheck="true">/**
     * Register the service provider.
     *
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">register<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
       <span class="token comment" spellcheck="true"> //
</span>    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p>The custom validator Closure receives four arguments: the name of the <code class=" language-php"><span class="token variable">$attribute</span></code> being validated, the <code class=" language-php"><span class="token variable">$value</span></code> of the attribute, an array of <code class=" language-php"><span class="token variable">$parameters</span></code> passed to the rule, and the <code class=" language-php">Validator</code> instance.</p>
	<p>You may also pass a class and method to the <code class=" language-php">extend</code> method instead of a Closure:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Validator<span class="token punctuation">::</span></span><span class="token function">extend<span class="token punctuation">(</span></span><span class="token string">'foo'</span><span class="token punctuation">,</span> <span class="token string">'FooValidator@validate'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Defining The Error Message</h4>
	<p>You will also need to define an error message for your custom rule. You can do so either using an inline custom message array or by adding an entry in the validation language file. This message should be placed in the first level of the array, not within the <code class=" language-php">custom</code> array, which is only for attribute-specific error messages:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">"foo"</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">"Your input was invalid!"</span><span class="token punctuation">,</span>

<span class="token string">"accepted"</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">"The :attribute must be accepted."</span><span class="token punctuation">,</span>
<span class="token comment" spellcheck="true">
// The rest of the validation error messages...</span></code></pre>
	<p>When creating a custom validation rule, you may sometimes need to define custom place-holder replacements for error messages. You may do so by creating a custom Validator as described above then making a call to the <code class=" language-php">replacer</code> method on the <code class=" language-php">Validator</code> facade. You may do this within the <code class=" language-php">boot</code> method of a <a href="/docs/5.7/providers">service provider</a>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Bootstrap any application services.
 *
 * @return void
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">boot<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token scope">Validator<span class="token punctuation">::</span></span><span class="token function">extend<span class="token punctuation">(</span></span><span class="token punctuation">.</span><span class="token punctuation">.</span><span class="token punctuation">.</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

    <span class="token scope">Validator<span class="token punctuation">::</span></span><span class="token function">replacer<span class="token punctuation">(</span></span><span class="token string">'foo'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$message</span><span class="token punctuation">,</span> <span class="token variable">$attribute</span><span class="token punctuation">,</span> <span class="token variable">$rule</span><span class="token punctuation">,</span> <span class="token variable">$parameters</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
        <span class="token keyword">return</span> <span class="token function">str_replace<span class="token punctuation">(</span></span><span class="token punctuation">.</span><span class="token punctuation">.</span><span class="token punctuation">.</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<h4>Implicit Extensions</h4>
	<p>By default, when an attribute being validated is not present or contains an empty value as defined by the <a href="#rule-required"><code class=" language-php">required</code></a> rule, normal validation rules, including custom extensions, are not run. For example, the <a href="#rule-unique"><code class=" language-php">unique</code></a> rule will not be run against a <code class=" language-php"><span class="token keyword">null</span></code> value:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$rules</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'unique'</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$input</span> <span class="token operator">=</span> <span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token keyword">null</span><span class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token scope">Validator<span class="token punctuation">::</span></span><span class="token function">make<span class="token punctuation">(</span></span><span class="token variable">$input</span><span class="token punctuation">,</span> <span class="token variable">$rules</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">passes<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span><span class="token comment" spellcheck="true"> // true</span></code></pre>
	<p>For a rule to run even when an attribute is empty, the rule must imply that the attribute is required. To create such an "implicit" extension, use the <code class=" language-php"><span class="token scope">Validator<span class="token punctuation">::</span></span><span class="token function">extendImplicit<span class="token punctuation">(</span></span><span class="token punctuation">)</span></code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Validator<span class="token punctuation">::</span></span><span class="token function">extendImplicit<span class="token punctuation">(</span></span><span class="token string">'foo'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$attribute</span><span class="token punctuation">,</span> <span class="token variable">$value</span><span class="token punctuation">,</span> <span class="token variable">$parameters</span><span class="token punctuation">,</span> <span class="token variable">$validator</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token variable">$value</span> <span class="token operator">==</span> <span class="token string">'foo'</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<blockquote class="has-icon">
		<p class="note"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="90px" height="90px" viewBox="0 0 90 90" enable-background="new 0 0 90 90" xml:space="preserve"><path fill="#FFFFFF" d="M45 0C20.1 0 0 20.1 0 45s20.1 45 45 45 45-20.1 45-45S69.9 0 45 0zM45 74.5c-3.6 0-6.5-2.9-6.5-6.5s2.9-6.5 6.5-6.5 6.5 2.9 6.5 6.5S48.6 74.5 45 74.5zM52.1 23.9l-2.5 29.6c0 2.5-2.1 4.6-4.6 4.6 -2.5 0-4.6-2.1-4.6-4.6l-2.5-29.6c-0.1-0.4-0.1-0.7-0.1-1.1 0-4 3.2-7.2 7.2-7.2 4 0 7.2 3.2 7.2 7.2C52.2 23.1 52.2 23.5 52.1 23.9z"></path></svg></span></div> An "implicit" extension only <em>implies</em> that the attribute is required. Whether it actually invalidates a missing or empty attribute is up to you.</p>
	</blockquote>
</article>