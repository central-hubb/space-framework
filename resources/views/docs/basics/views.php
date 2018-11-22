<article>
	<h1>Views</h1>
	<h4>Creating Views</h4>
	<p>Views contain the HTML served by your application and separate your controller / application logic from your presentation logic. Views are stored in the <code class=" language-php">resources<span class="token operator">/</span>views</code> directory. A simple view might look something like this:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token markup"><span class="token comment" spellcheck="true">&lt;!-- View stored in resources/views/greeting.blade.php --&gt;</span></span>

<span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>html</span><span class="token punctuation">&gt;</span></span></span>
    <span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>body</span><span class="token punctuation">&gt;</span></span></span>
        <span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>h1</span><span class="token punctuation">&gt;</span></span></span>Hello<span class="token punctuation">,</span> <span class="token punctuation">{</span><span class="token punctuation">{</span> <span class="token variable">$name</span> <span class="token punctuation">}</span><span class="token punctuation">}</span><span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>h1</span><span class="token punctuation">&gt;</span></span></span>
    <span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>body</span><span class="token punctuation">&gt;</span></span></span>
<span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>html</span><span class="token punctuation">&gt;</span></span></span></code></pre>
	<p>Since this view is stored at <code class=" language-php">resources<span class="token operator">/</span>views<span class="token operator">/</span>greeting<span class="token punctuation">.</span>blade<span class="token punctuation">.</span>php</code>, we may return it using the global <code class=" language-php">view</code> helper like so:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Route<span class="token punctuation">::</span></span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'/'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token function">view<span class="token punctuation">(</span></span><span class="token string">'greeting'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'James'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>As you can see, the first argument passed to the <code class=" language-php">view</code> helper corresponds to the name of the view file in the <code class=" language-php">resources<span class="token operator">/</span>views</code> directory. The second argument is an array of data that should be made available to the view. In this case, we are passing the <code class=" language-php">name</code> variable, which is displayed in the view using <a href="/docs/5.7/blade">Blade syntax</a>.</p>
	<p>Of course, views may also be nested within sub-directories of the <code class=" language-php">resources<span class="token operator">/</span>views</code> directory. "Dot" notation may be used to reference nested views. For example, if your view is stored at <code class=" language-php">resources<span class="token operator">/</span>views<span class="token operator">/</span>admin<span class="token operator">/</span>profile<span class="token punctuation">.</span>blade<span class="token punctuation">.</span>php</code>, you may reference it like so:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token function">view<span class="token punctuation">(</span></span><span class="token string">'admin.profile'</span><span class="token punctuation">,</span> <span class="token variable">$data</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Determining If A View Exists</h4>
	<p>If you need to determine if a view exists, you may use the <code class=" language-php">View</code> facade. The <code class=" language-php">exists</code> method will return <code class=" language-php"><span class="token boolean">true</span></code> if the view exists:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>View</span><span class="token punctuation">;</span>

<span class="token keyword">if</span> <span class="token punctuation">(</span><span class="token scope">View<span class="token punctuation">::</span></span><span class="token function">exists<span class="token punctuation">(</span></span><span class="token string">'emails.customer'</span><span class="token punctuation">)</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span></code></pre>
	<h4>Creating The First Available View</h4>
	<p>Using the <code class=" language-php">first</code> method, you may create the first view that exists in a given array of views. This is useful if your application or package allows views to be customized or overwritten:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token function">view<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">first<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'custom.admin'</span><span class="token punctuation">,</span> <span class="token string">'admin'</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token variable">$data</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>Of course, you may also call this method via the <code class=" language-php">View</code> <a href="/docs/5.7/facades">facade</a>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>View</span><span class="token punctuation">;</span>

<span class="token keyword">return</span> <span class="token scope">View<span class="token punctuation">::</span></span><span class="token function">first<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'custom.admin'</span><span class="token punctuation">,</span> <span class="token string">'admin'</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token variable">$data</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="passing-data-to-views"></a></p>
	<h2><a href="#passing-data-to-views">Passing Data To Views</a></h2>
	<p>As you saw in the previous examples, you may pass an array of data to views:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token function">view<span class="token punctuation">(</span></span><span class="token string">'greetings'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Victoria'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>When passing information in this manner, the data should be an array with key / value pairs. Inside your view, you can then access each value using its corresponding key, such as <code class=" language-php"><span class="token php"><span class="token delimiter">&lt;?php</span> <span class="token keyword">echo</span> <span class="token variable">$key</span><span class="token punctuation">;</span> <span class="token delimiter">?&gt;</span></span></code>. As an alternative to passing a complete array of data to the <code class=" language-php">view</code> helper function, you may use the <code class=" language-php">with</code> method to add individual pieces of data to the view:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token function">view<span class="token punctuation">(</span></span><span class="token string">'greeting'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">with<span class="token punctuation">(</span></span><span class="token string">'name'</span><span class="token punctuation">,</span> <span class="token string">'Victoria'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="sharing-data-with-all-views"></a></p>
	<h4>Sharing Data With All Views</h4>
	<p>Occasionally, you may need to share a piece of data with all views that are rendered by your application. You may do so using the view facade's <code class=" language-php">share</code> method. Typically, you should place calls to <code class=" language-php">share</code> within a service provider's <code class=" language-php">boot</code> method. You are free to add them to the <code class=" language-php">AppServiceProvider</code> or generate a separate service provider to house them:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Providers</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>View</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">AppServiceProvider</span> <span class="token keyword">extends</span> <span class="token class-name">ServiceProvider</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Bootstrap any application services.
     *
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">boot<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token scope">View<span class="token punctuation">::</span></span><span class="token function">share<span class="token punctuation">(</span></span><span class="token string">'key'</span><span class="token punctuation">,</span> <span class="token string">'value'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
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
	<p><a name="view-composers"></a></p>
	<h2><a href="#view-composers">View Composers</a></h2>
	<p>View composers are callbacks or class methods that are called when a view is rendered. If you have data that you want to be bound to a view each time that view is rendered, a view composer can help you organize that logic into a single location.</p>
	<p>For this example, let's register the view composers within a <a href="/docs/5.7/providers">service provider</a>. We'll use the <code class=" language-php">View</code> facade to access the underlying <code class=" language-php">Illuminate\<span class="token package">Contracts<span class="token punctuation">\</span>View<span class="token punctuation">\</span>Factory</span></code> contract implementation. Remember, Space MVC does not include a default directory for view composers. You are free to organize them however you wish. For example, you could create an <code class=" language-php">app<span class="token operator">/</span>Http<span class="token operator">/</span>ViewComposers</code> directory:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Providers</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>View</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>ServiceProvider</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">ComposerServiceProvider</span> <span class="token keyword">extends</span> <span class="token class-name">ServiceProvider</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Register bindings in the container.
     *
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">boot<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
       <span class="token comment" spellcheck="true"> // Using class based composers...
</span>        <span class="token scope">View<span class="token punctuation">::</span></span><span class="token function">composer<span class="token punctuation">(</span></span>
            <span class="token string">'profile'</span><span class="token punctuation">,</span> <span class="token string">'App\Http\ViewComposers\ProfileComposer'</span>
        <span class="token punctuation">)</span><span class="token punctuation">;</span>

       <span class="token comment" spellcheck="true"> // Using Closure based composers...
</span>        <span class="token scope">View<span class="token punctuation">::</span></span><span class="token function">composer<span class="token punctuation">(</span></span><span class="token string">'dashboard'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$view</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
           <span class="token comment" spellcheck="true"> //
</span>        <span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
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
	<blockquote class="has-icon">
		<p class="note"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="90px" height="90px" viewBox="0 0 90 90" enable-background="new 0 0 90 90" xml:space="preserve"><path fill="#FFFFFF" d="M45 0C20.1 0 0 20.1 0 45s20.1 45 45 45 45-20.1 45-45S69.9 0 45 0zM45 74.5c-3.6 0-6.5-2.9-6.5-6.5s2.9-6.5 6.5-6.5 6.5 2.9 6.5 6.5S48.6 74.5 45 74.5zM52.1 23.9l-2.5 29.6c0 2.5-2.1 4.6-4.6 4.6 -2.5 0-4.6-2.1-4.6-4.6l-2.5-29.6c-0.1-0.4-0.1-0.7-0.1-1.1 0-4 3.2-7.2 7.2-7.2 4 0 7.2 3.2 7.2 7.2C52.2 23.1 52.2 23.5 52.1 23.9z"></path></svg></span></div> Remember, if you create a new service provider to contain your view composer registrations, you will need to add the service provider to the <code class=" language-php">providers</code> array in the <code class=" language-php">config<span class="token operator">/</span>app<span class="token punctuation">.</span>php</code> configuration file.</p>
	</blockquote>
	<p>Now that we have registered the composer, the <code class=" language-php">ProfileComposer@compose</code> method will be executed each time the <code class=" language-php">profile</code> view is being rendered. So, let's define the composer class:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>ViewComposers</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>View<span class="token punctuation">\</span>View</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Repositories<span class="token punctuation">\</span>UserRepository</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">ProfileComposer</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * The user repository implementation.
     *
     * @var UserRepository
     */</span>
    <span class="token keyword">protected</span> <span class="token variable">$users</span><span class="token punctuation">;</span>

    <span class="token comment" spellcheck="true">/**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">__construct<span class="token punctuation">(</span></span>UserRepository <span class="token variable">$users</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
       <span class="token comment" spellcheck="true"> // Dependencies automatically resolved by service container...
</span>        <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">users</span> <span class="token operator">=</span> <span class="token variable">$users</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>

    <span class="token comment" spellcheck="true">/**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">compose<span class="token punctuation">(</span></span>View <span class="token variable">$view</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token variable">$view</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">with<span class="token punctuation">(</span></span><span class="token string">'count'</span><span class="token punctuation">,</span> <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">users</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">count<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p>Just before the view is rendered, the composer's <code class=" language-php">compose</code> method is called with the <code class=" language-php">Illuminate\<span class="token package">View<span class="token punctuation">\</span>View</span></code> instance. You may use the <code class=" language-php">with</code> method to bind data to the view.</p>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> All view composers are resolved via the <a href="/docs/5.7/container">service container</a>, so you may type-hint any dependencies you need within a composer's constructor.</p>
	</blockquote>
	<h4>Attaching A Composer To Multiple Views</h4>
	<p>You may attach a view composer to multiple views at once by passing an array of views as the first argument to the <code class=" language-php">composer</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">View<span class="token punctuation">::</span></span><span class="token function">composer<span class="token punctuation">(</span></span>
    <span class="token punctuation">[</span><span class="token string">'profile'</span><span class="token punctuation">,</span> <span class="token string">'dashboard'</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
    <span class="token string">'App\Http\ViewComposers\MyViewComposer'</span>
<span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>The <code class=" language-php">composer</code> method also accepts the <code class=" language-php"><span class="token operator">*</span></code> character as a wildcard, allowing you to attach a composer to all views:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">View<span class="token punctuation">::</span></span><span class="token function">composer<span class="token punctuation">(</span></span><span class="token string">'*'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$view</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>View Creators</h4>
	<p>View <strong>creators</strong> are very similar to view composers; however, they are executed immediately after the view is instantiated instead of waiting until the view is about to render. To register a view creator, use the <code class=" language-php">creator</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">View<span class="token punctuation">::</span></span><span class="token function">creator<span class="token punctuation">(</span></span><span class="token string">'profile'</span><span class="token punctuation">,</span> <span class="token string">'App\Http\ViewCreators\ProfileCreator'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
</article><article>
	<h1>Views</h1>
	<ul>
		<li><a href="#creating-views">Creating Views</a></li>
		<li><a href="#passing-data-to-views">Passing Data To Views</a>
			<ul>
				<li><a href="#sharing-data-with-all-views">Sharing Data With All Views</a></li>
			</ul></li>
		<li><a href="#view-composers">View Composers</a></li>
	</ul>
	<p><a name="creating-views"></a></p>
	<h2><a href="#creating-views">Creating Views</a></h2>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> Looking for more information on how to write Blade templates? Check out the full <a href="/docs/5.7/blade">Blade documentation</a> to get started.</p>
	</blockquote>
	<p>Views contain the HTML served by your application and separate your controller / application logic from your presentation logic. Views are stored in the <code class=" language-php">resources<span class="token operator">/</span>views</code> directory. A simple view might look something like this:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token markup"><span class="token comment" spellcheck="true">&lt;!-- View stored in resources/views/greeting.blade.php --&gt;</span></span>

<span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>html</span><span class="token punctuation">&gt;</span></span></span>
    <span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>body</span><span class="token punctuation">&gt;</span></span></span>
        <span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>h1</span><span class="token punctuation">&gt;</span></span></span>Hello<span class="token punctuation">,</span> <span class="token punctuation">{</span><span class="token punctuation">{</span> <span class="token variable">$name</span> <span class="token punctuation">}</span><span class="token punctuation">}</span><span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>h1</span><span class="token punctuation">&gt;</span></span></span>
    <span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>body</span><span class="token punctuation">&gt;</span></span></span>
<span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>html</span><span class="token punctuation">&gt;</span></span></span></code></pre>
	<p>Since this view is stored at <code class=" language-php">resources<span class="token operator">/</span>views<span class="token operator">/</span>greeting<span class="token punctuation">.</span>blade<span class="token punctuation">.</span>php</code>, we may return it using the global <code class=" language-php">view</code> helper like so:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Route<span class="token punctuation">::</span></span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'/'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token function">view<span class="token punctuation">(</span></span><span class="token string">'greeting'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'James'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>As you can see, the first argument passed to the <code class=" language-php">view</code> helper corresponds to the name of the view file in the <code class=" language-php">resources<span class="token operator">/</span>views</code> directory. The second argument is an array of data that should be made available to the view. In this case, we are passing the <code class=" language-php">name</code> variable, which is displayed in the view using <a href="/docs/5.7/blade">Blade syntax</a>.</p>
	<p>Of course, views may also be nested within sub-directories of the <code class=" language-php">resources<span class="token operator">/</span>views</code> directory. "Dot" notation may be used to reference nested views. For example, if your view is stored at <code class=" language-php">resources<span class="token operator">/</span>views<span class="token operator">/</span>admin<span class="token operator">/</span>profile<span class="token punctuation">.</span>blade<span class="token punctuation">.</span>php</code>, you may reference it like so:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token function">view<span class="token punctuation">(</span></span><span class="token string">'admin.profile'</span><span class="token punctuation">,</span> <span class="token variable">$data</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Determining If A View Exists</h4>
	<p>If you need to determine if a view exists, you may use the <code class=" language-php">View</code> facade. The <code class=" language-php">exists</code> method will return <code class=" language-php"><span class="token boolean">true</span></code> if the view exists:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>View</span><span class="token punctuation">;</span>

<span class="token keyword">if</span> <span class="token punctuation">(</span><span class="token scope">View<span class="token punctuation">::</span></span><span class="token function">exists<span class="token punctuation">(</span></span><span class="token string">'emails.customer'</span><span class="token punctuation">)</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span></code></pre>
	<h4>Creating The First Available View</h4>
	<p>Using the <code class=" language-php">first</code> method, you may create the first view that exists in a given array of views. This is useful if your application or package allows views to be customized or overwritten:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token function">view<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">first<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'custom.admin'</span><span class="token punctuation">,</span> <span class="token string">'admin'</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token variable">$data</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>Of course, you may also call this method via the <code class=" language-php">View</code> <a href="/docs/5.7/facades">facade</a>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>View</span><span class="token punctuation">;</span>

<span class="token keyword">return</span> <span class="token scope">View<span class="token punctuation">::</span></span><span class="token function">first<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'custom.admin'</span><span class="token punctuation">,</span> <span class="token string">'admin'</span><span class="token punctuation">]</span><span class="token punctuation">,</span> <span class="token variable">$data</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="passing-data-to-views"></a></p>
	<h2><a href="#passing-data-to-views">Passing Data To Views</a></h2>
	<p>As you saw in the previous examples, you may pass an array of data to views:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token function">view<span class="token punctuation">(</span></span><span class="token string">'greetings'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Victoria'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>When passing information in this manner, the data should be an array with key / value pairs. Inside your view, you can then access each value using its corresponding key, such as <code class=" language-php"><span class="token php"><span class="token delimiter">&lt;?php</span> <span class="token keyword">echo</span> <span class="token variable">$key</span><span class="token punctuation">;</span> <span class="token delimiter">?&gt;</span></span></code>. As an alternative to passing a complete array of data to the <code class=" language-php">view</code> helper function, you may use the <code class=" language-php">with</code> method to add individual pieces of data to the view:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token function">view<span class="token punctuation">(</span></span><span class="token string">'greeting'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">with<span class="token punctuation">(</span></span><span class="token string">'name'</span><span class="token punctuation">,</span> <span class="token string">'Victoria'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="sharing-data-with-all-views"></a></p>
	<h4>Sharing Data With All Views</h4>
	<p>Occasionally, you may need to share a piece of data with all views that are rendered by your application. You may do so using the view facade's <code class=" language-php">share</code> method. Typically, you should place calls to <code class=" language-php">share</code> within a service provider's <code class=" language-php">boot</code> method. You are free to add them to the <code class=" language-php">AppServiceProvider</code> or generate a separate service provider to house them:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Providers</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>View</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">AppServiceProvider</span> <span class="token keyword">extends</span> <span class="token class-name">ServiceProvider</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Bootstrap any application services.
     *
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">boot<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token scope">View<span class="token punctuation">::</span></span><span class="token function">share<span class="token punctuation">(</span></span><span class="token string">'key'</span><span class="token punctuation">,</span> <span class="token string">'value'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
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
	<p><a name="view-composers"></a></p>
	<h2><a href="#view-composers">View Composers</a></h2>
	<p>View composers are callbacks or class methods that are called when a view is rendered. If you have data that you want to be bound to a view each time that view is rendered, a view composer can help you organize that logic into a single location.</p>
	<p>For this example, let's register the view composers within a <a href="/docs/5.7/providers">service provider</a>. We'll use the <code class=" language-php">View</code> facade to access the underlying <code class=" language-php">Illuminate\<span class="token package">Contracts<span class="token punctuation">\</span>View<span class="token punctuation">\</span>Factory</span></code> contract implementation. Remember, Space MVC does not include a default directory for view composers. You are free to organize them however you wish. For example, you could create an <code class=" language-php">app<span class="token operator">/</span>Http<span class="token operator">/</span>ViewComposers</code> directory:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Providers</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>View</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>ServiceProvider</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">ComposerServiceProvider</span> <span class="token keyword">extends</span> <span class="token class-name">ServiceProvider</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Register bindings in the container.
     *
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">boot<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
       <span class="token comment" spellcheck="true"> // Using class based composers...
</span>        <span class="token scope">View<span class="token punctuation">::</span></span><span class="token function">composer<span class="token punctuation">(</span></span>
            <span class="token string">'profile'</span><span class="token punctuation">,</span> <span class="token string">'App\Http\ViewComposers\ProfileComposer'</span>
        <span class="token punctuation">)</span><span class="token punctuation">;</span>

       <span class="token comment" spellcheck="true"> // Using Closure based composers...
</span>        <span class="token scope">View<span class="token punctuation">::</span></span><span class="token function">composer<span class="token punctuation">(</span></span><span class="token string">'dashboard'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$view</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
           <span class="token comment" spellcheck="true"> //
</span>        <span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
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
	<blockquote class="has-icon">
		<p class="note"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="90px" height="90px" viewBox="0 0 90 90" enable-background="new 0 0 90 90" xml:space="preserve"><path fill="#FFFFFF" d="M45 0C20.1 0 0 20.1 0 45s20.1 45 45 45 45-20.1 45-45S69.9 0 45 0zM45 74.5c-3.6 0-6.5-2.9-6.5-6.5s2.9-6.5 6.5-6.5 6.5 2.9 6.5 6.5S48.6 74.5 45 74.5zM52.1 23.9l-2.5 29.6c0 2.5-2.1 4.6-4.6 4.6 -2.5 0-4.6-2.1-4.6-4.6l-2.5-29.6c-0.1-0.4-0.1-0.7-0.1-1.1 0-4 3.2-7.2 7.2-7.2 4 0 7.2 3.2 7.2 7.2C52.2 23.1 52.2 23.5 52.1 23.9z"></path></svg></span></div> Remember, if you create a new service provider to contain your view composer registrations, you will need to add the service provider to the <code class=" language-php">providers</code> array in the <code class=" language-php">config<span class="token operator">/</span>app<span class="token punctuation">.</span>php</code> configuration file.</p>
	</blockquote>
	<p>Now that we have registered the composer, the <code class=" language-php">ProfileComposer@compose</code> method will be executed each time the <code class=" language-php">profile</code> view is being rendered. So, let's define the composer class:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>ViewComposers</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>View<span class="token punctuation">\</span>View</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Repositories<span class="token punctuation">\</span>UserRepository</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">ProfileComposer</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * The user repository implementation.
     *
     * @var UserRepository
     */</span>
    <span class="token keyword">protected</span> <span class="token variable">$users</span><span class="token punctuation">;</span>

    <span class="token comment" spellcheck="true">/**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">__construct<span class="token punctuation">(</span></span>UserRepository <span class="token variable">$users</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
       <span class="token comment" spellcheck="true"> // Dependencies automatically resolved by service container...
</span>        <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">users</span> <span class="token operator">=</span> <span class="token variable">$users</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>

    <span class="token comment" spellcheck="true">/**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">compose<span class="token punctuation">(</span></span>View <span class="token variable">$view</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token variable">$view</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">with<span class="token punctuation">(</span></span><span class="token string">'count'</span><span class="token punctuation">,</span> <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">users</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">count<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p>Just before the view is rendered, the composer's <code class=" language-php">compose</code> method is called with the <code class=" language-php">Illuminate\<span class="token package">View<span class="token punctuation">\</span>View</span></code> instance. You may use the <code class=" language-php">with</code> method to bind data to the view.</p>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> All view composers are resolved via the <a href="/docs/5.7/container">service container</a>, so you may type-hint any dependencies you need within a composer's constructor.</p>
	</blockquote>
	<h4>Attaching A Composer To Multiple Views</h4>
	<p>You may attach a view composer to multiple views at once by passing an array of views as the first argument to the <code class=" language-php">composer</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">View<span class="token punctuation">::</span></span><span class="token function">composer<span class="token punctuation">(</span></span>
    <span class="token punctuation">[</span><span class="token string">'profile'</span><span class="token punctuation">,</span> <span class="token string">'dashboard'</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
    <span class="token string">'App\Http\ViewComposers\MyViewComposer'</span>
<span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>The <code class=" language-php">composer</code> method also accepts the <code class=" language-php"><span class="token operator">*</span></code> character as a wildcard, allowing you to attach a composer to all views:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">View<span class="token punctuation">::</span></span><span class="token function">composer<span class="token punctuation">(</span></span><span class="token string">'*'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$view</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>View Creators</h4>
	<p>View <strong>creators</strong> are very similar to view composers; however, they are executed immediately after the view is instantiated instead of waiting until the view is about to render. To register a view creator, use the <code class=" language-php">creator</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">View<span class="token punctuation">::</span></span><span class="token function">creator<span class="token punctuation">(</span></span><span class="token string">'profile'</span><span class="token punctuation">,</span> <span class="token string">'App\Http\ViewCreators\ProfileCreator'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
</article>