<article>
	<h1>Events</h1>
	<ul>
		<li><a href="#introduction">Introduction</a></li>
		<li><a href="#registering-events-and-listeners">Registering Events &amp; Listeners</a>
			<ul>
				<li><a href="#generating-events-and-listeners">Generating Events &amp; Listeners</a></li>
				<li><a href="#manually-registering-events">Manually Registering Events</a></li>
			</ul></li>
		<li><a href="#defining-events">Defining Events</a></li>
		<li><a href="#defining-listeners">Defining Listeners</a></li>
		<li><a href="#queued-event-listeners">Queued Event Listeners</a>
			<ul>
				<li><a href="#manually-accessing-the-queue">Manually Accessing The Queue</a></li>
				<li><a href="#handling-failed-jobs">Handling Failed Jobs</a></li>
			</ul></li>
		<li><a href="#dispatching-events">Dispatching Events</a></li>
		<li><a href="#event-subscribers">Event Subscribers</a>
			<ul>
				<li><a href="#writing-event-subscribers">Writing Event Subscribers</a></li>
				<li><a href="#registering-event-subscribers">Registering Event Subscribers</a></li>
			</ul></li>
	</ul>
	<p><a name="introduction"></a></p>
	<h2><a href="#introduction">Introduction</a></h2>
	<p>Space MVC's events provide a simple observer implementation, allowing you to subscribe and listen for various events that occur in your application. Event classes are typically stored in the <code class=" language-php">app<span class="token operator">/</span>Events</code> directory, while their listeners are stored in <code class=" language-php">app<span class="token operator">/</span>Listeners</code>. Don't worry if you don't see these directories in your application, since they will be created for you as you generate events and listeners using Artisan console commands.</p>
	<p>Events serve as a great way to decouple various aspects of your application, since a single event can have multiple listeners that do not depend on each other. For example, you may wish to send a Slack notification to your user each time an order has shipped. Instead of coupling your order processing code to your Slack notification code, you can raise an <code class=" language-php">OrderShipped</code> event, which a listener can receive and transform into a Slack notification.</p>
	<p><a name="registering-events-and-listeners"></a></p>
	<h2><a href="#registering-events-and-listeners">Registering Events &amp; Listeners</a></h2>
	<p>The <code class=" language-php">EventServiceProvider</code> included with your Space MVC application provides a convenient place to register all of your application's event listeners. The <code class=" language-php">listen</code> property contains an array of all events (keys) and their listeners (values). Of course, you may add as many events to this array as your application requires. For example, let's add a <code class=" language-php">OrderShipped</code> event:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * The event listener mappings for the application.
 *
 * @var array
 */</span>
<span class="token keyword">protected</span> <span class="token variable">$listen</span> <span class="token operator">=</span> <span class="token punctuation">[</span>
    <span class="token string">'App\Events\OrderShipped'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'App\Listeners\SendShipmentNotification'</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">;</span></code></pre>
	<p><a name="generating-events-and-listeners"></a></p>
	<h3>Generating Events &amp; Listeners</h3>
	<p>Of course, manually creating the files for each event and listener is cumbersome. Instead, add listeners and events to your <code class=" language-php">EventServiceProvider</code> and use the <code class=" language-php">event<span class="token punctuation">:</span>generate</code> command. This command will generate any events or listeners that are listed in your <code class=" language-php">EventServiceProvider</code>. Of course, events and listeners that already exist will be left untouched:</p>
	<pre class=" language-php"><code class=" language-php">php artisan event<span class="token punctuation">:</span>generate</code></pre>
	<p><a name="manually-registering-events"></a></p>
	<h3>Manually Registering Events</h3>
	<p>Typically, events should be registered via the <code class=" language-php">EventServiceProvider</code> <code class=" language-php"><span class="token variable">$listen</span></code> array; however, you may also register Closure based events manually in the <code class=" language-php">boot</code> method of your <code class=" language-php">EventServiceProvider</code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Register any other events for your application.
 *
 * @return void
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">boot<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token scope"><span class="token keyword">parent</span><span class="token punctuation">::</span></span><span class="token function">boot<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>

    <span class="token scope">Event<span class="token punctuation">::</span></span><span class="token function">listen<span class="token punctuation">(</span></span><span class="token string">'event.name'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$foo</span><span class="token punctuation">,</span> <span class="token variable">$bar</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
       <span class="token comment" spellcheck="true"> //
</span>    <span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<h4>Wildcard Event Listeners</h4>
	<p>You may even register listeners using the <code class=" language-php"><span class="token operator">*</span></code> as a wildcard parameter, allowing you to catch multiple events on the same listener. Wildcard listeners receive the event name as their first argument, and the entire event data array as their second argument:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Event<span class="token punctuation">::</span></span><span class="token function">listen<span class="token punctuation">(</span></span><span class="token string">'event.*'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$eventName</span><span class="token punctuation">,</span> <span class="token keyword">array</span> <span class="token variable">$data</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="defining-events"></a></p>
	<h2><a href="#defining-events">Defining Events</a></h2>
	<p>An event class is a data container which holds the information related to the event. For example, let's assume our generated <code class=" language-php">OrderShipped</code> event receives an <a href="/docs/5.7/eloquent">Eloquent ORM</a> object:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Events</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Order</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Queue<span class="token punctuation">\</span>SerializesModels</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">OrderShipped</span>
<span class="token punctuation">{</span>
    <span class="token keyword">use</span> <span class="token package">SerializesModels</span><span class="token punctuation">;</span>

    <span class="token keyword">public</span> <span class="token variable">$order</span><span class="token punctuation">;</span>

    <span class="token comment" spellcheck="true">/**
     * Create a new event instance.
     *
     * @param  \App\Order  $order
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">__construct<span class="token punctuation">(</span></span>Order <span class="token variable">$order</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">order</span> <span class="token operator">=</span> <span class="token variable">$order</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p>As you can see, this event class contains no logic. It is a container for the <code class=" language-php">Order</code> instance that was purchased. The <code class=" language-php">SerializesModels</code> trait used by the event will gracefully serialize any Eloquent models if the event object is serialized using PHP's <code class=" language-php">serialize</code> function.</p>
	<p><a name="defining-listeners"></a></p>
	<h2><a href="#defining-listeners">Defining Listeners</a></h2>
	<p>Next, let's take a look at the listener for our example event. Event listeners receive the event instance in their <code class=" language-php">handle</code> method. The <code class=" language-php">event<span class="token punctuation">:</span>generate</code> command will automatically import the proper event class and type-hint the event on the <code class=" language-php">handle</code> method. Within the <code class=" language-php">handle</code> method, you may perform any actions necessary to respond to the event:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Listeners</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Events<span class="token punctuation">\</span>OrderShipped</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">SendShipmentNotification</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Create the event listener.
     *
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">__construct<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
       <span class="token comment" spellcheck="true"> //
</span>    <span class="token punctuation">}</span>

    <span class="token comment" spellcheck="true">/**
     * Handle the event.
     *
     * @param  \App\Events\OrderShipped  $event
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">handle<span class="token punctuation">(</span></span>OrderShipped <span class="token variable">$event</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
       <span class="token comment" spellcheck="true"> // Access the order using $event-&gt;order...
</span>    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> Your event listeners may also type-hint any dependencies they need on their constructors. All event listeners are resolved via the Space MVC <a href="/docs/5.7/container">service container</a>, so dependencies will be injected automatically.</p>
	</blockquote>
	<h4>Stopping The Propagation Of An Event</h4>
	<p>Sometimes, you may wish to stop the propagation of an event to other listeners. You may do so by returning <code class=" language-php"><span class="token boolean">false</span></code> from your listener's <code class=" language-php">handle</code> method.</p>
	<p><a name="queued-event-listeners"></a></p>
	<h2><a href="#queued-event-listeners">Queued Event Listeners</a></h2>
	<p>Queueing listeners can be beneficial if your listener is going to perform a slow task such as sending an e-mail or making an HTTP request. Before getting started with queued listeners, make sure to <a href="/docs/5.7/queues">configure your queue</a> and start a queue listener on your server or local development environment.</p>
	<p>To specify that a listener should be queued, add the <code class=" language-php">ShouldQueue</code> interface to the listener class. Listeners generated by the <code class=" language-php">event<span class="token punctuation">:</span>generate</code> Artisan command already have this interface imported into the current namespace, so you can use it immediately:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Listeners</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Events<span class="token punctuation">\</span>OrderShipped</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Contracts<span class="token punctuation">\</span>Queue<span class="token punctuation">\</span>ShouldQueue</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">SendShipmentNotification</span> <span class="token keyword">implements</span> <span class="token class-name">ShouldQueue</span>
<span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span></code></pre>
	<p>That's it! Now, when this listener is called for an event, it will be automatically queued by the event dispatcher using Space MVC's <a href="/docs/5.7/queues">queue system</a>. If no exceptions are thrown when the listener is executed by the queue, the queued job will automatically be deleted after it has finished processing.</p>
	<h4>Customizing The Queue Connection &amp; Queue Name</h4>
	<p>If you would like to customize the queue connection and queue name used by an event listener, you may define <code class=" language-php"><span class="token variable">$connection</span></code> and <code class=" language-php"><span class="token variable">$queue</span></code> properties on your listener class:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Listeners</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Events<span class="token punctuation">\</span>OrderShipped</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Contracts<span class="token punctuation">\</span>Queue<span class="token punctuation">\</span>ShouldQueue</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">SendShipmentNotification</span> <span class="token keyword">implements</span> <span class="token class-name">ShouldQueue</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */</span>
    <span class="token keyword">public</span> <span class="token variable">$connection</span> <span class="token operator">=</span> <span class="token string">'sqs'</span><span class="token punctuation">;</span>

    <span class="token comment" spellcheck="true">/**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */</span>
    <span class="token keyword">public</span> <span class="token variable">$queue</span> <span class="token operator">=</span> <span class="token string">'listeners'</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="manually-accessing-the-queue"></a></p>
	<h3>Manually Accessing The Queue</h3>
	<p>If you need to manually access the listener's underlying queue job's <code class=" language-php">delete</code> and <code class=" language-php">release</code> methods, you may do so using the <code class=" language-php">Illuminate\<span class="token package">Queue<span class="token punctuation">\</span>InteractsWithQueue</span></code> trait. This trait is imported by default on generated listeners and provides access to these methods:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Listeners</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Events<span class="token punctuation">\</span>OrderShipped</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Queue<span class="token punctuation">\</span>InteractsWithQueue</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Contracts<span class="token punctuation">\</span>Queue<span class="token punctuation">\</span>ShouldQueue</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">SendShipmentNotification</span> <span class="token keyword">implements</span> <span class="token class-name">ShouldQueue</span>
<span class="token punctuation">{</span>
    <span class="token keyword">use</span> <span class="token package">InteractsWithQueue</span><span class="token punctuation">;</span>

    <span class="token comment" spellcheck="true">/**
     * Handle the event.
     *
     * @param  \App\Events\OrderShipped  $event
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">handle<span class="token punctuation">(</span></span>OrderShipped <span class="token variable">$event</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token keyword">if</span> <span class="token punctuation">(</span><span class="token boolean">true</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
            <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">release<span class="token punctuation">(</span></span><span class="token number">30</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
        <span class="token punctuation">}</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="handling-failed-jobs"></a></p>
	<h3>Handling Failed Jobs</h3>
	<p>Sometimes your queued event listeners may fail. If queued listener exceeds the maximum number of attempts as defined by your queue worker, the <code class=" language-php">failed</code> method will be called on your listener. The <code class=" language-php">failed</code> method receives the event instance and the exception that caused the failure:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Listeners</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Events<span class="token punctuation">\</span>OrderShipped</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Queue<span class="token punctuation">\</span>InteractsWithQueue</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Contracts<span class="token punctuation">\</span>Queue<span class="token punctuation">\</span>ShouldQueue</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">SendShipmentNotification</span> <span class="token keyword">implements</span> <span class="token class-name">ShouldQueue</span>
<span class="token punctuation">{</span>
    <span class="token keyword">use</span> <span class="token package">InteractsWithQueue</span><span class="token punctuation">;</span>

    <span class="token comment" spellcheck="true">/**
     * Handle the event.
     *
     * @param  \App\Events\OrderShipped  $event
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">handle<span class="token punctuation">(</span></span>OrderShipped <span class="token variable">$event</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
       <span class="token comment" spellcheck="true"> //
</span>    <span class="token punctuation">}</span>

    <span class="token comment" spellcheck="true">/**
     * Handle a job failure.
     *
     * @param  \App\Events\OrderShipped  $event
     * @param  \Exception  $exception
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">failed<span class="token punctuation">(</span></span>OrderShipped <span class="token variable">$event</span><span class="token punctuation">,</span> <span class="token variable">$exception</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
       <span class="token comment" spellcheck="true"> //
</span>    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="dispatching-events"></a></p>
	<h2><a href="#dispatching-events">Dispatching Events</a></h2>
	<p>To dispatch an event, you may pass an instance of the event to the <code class=" language-php">event</code> helper. The helper will dispatch the event to all of its registered listeners. Since the <code class=" language-php">event</code> helper is globally available, you may call it from anywhere in your application:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Controllers</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Order</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Events<span class="token punctuation">\</span>OrderShipped</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Controllers<span class="token punctuation">\</span>Controller</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">OrderController</span> <span class="token keyword">extends</span> <span class="token class-name">Controller</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Ship the given order.
     *
     * @param  int  $orderId
     * @return Response
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">ship<span class="token punctuation">(</span></span><span class="token variable">$orderId</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token variable">$order</span> <span class="token operator">=</span> <span class="token scope">Order<span class="token punctuation">::</span></span><span class="token function">findOrFail<span class="token punctuation">(</span></span><span class="token variable">$orderId</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

       <span class="token comment" spellcheck="true"> // Order shipment logic...
</span>
        <span class="token function">event<span class="token punctuation">(</span></span><span class="token keyword">new</span> <span class="token class-name">OrderShipped</span><span class="token punctuation">(</span><span class="token variable">$order</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> When testing, it can be helpful to assert that certain events were dispatched without actually triggering their listeners. Space MVC's <a href="/docs/5.7/mocking#event-fake">built-in testing helpers</a> makes it a cinch.</p>
	</blockquote>
	<p><a name="event-subscribers"></a></p>
	<h2><a href="#event-subscribers">Event Subscribers</a></h2>
	<p><a name="writing-event-subscribers"></a></p>
	<h3>Writing Event Subscribers</h3>
	<p>Event subscribers are classes that may subscribe to multiple events from within the class itself, allowing you to define several event handlers within a single class. Subscribers should define a <code class=" language-php">subscribe</code> method, which will be passed an event dispatcher instance. You may call the <code class=" language-php">listen</code> method on the given dispatcher to register event listeners:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Listeners</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">UserEventSubscriber</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Handle user login events.
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">onUserLogin<span class="token punctuation">(</span></span><span class="token variable">$event</span><span class="token punctuation">)</span> <span class="token punctuation">{</span><span class="token punctuation">}</span>

    <span class="token comment" spellcheck="true">/**
     * Handle user logout events.
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">onUserLogout<span class="token punctuation">(</span></span><span class="token variable">$event</span><span class="token punctuation">)</span> <span class="token punctuation">{</span><span class="token punctuation">}</span>

    <span class="token comment" spellcheck="true">/**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">subscribe<span class="token punctuation">(</span></span><span class="token variable">$events</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token variable">$events</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">listen<span class="token punctuation">(</span></span>
            <span class="token string">'Illuminate\Auth\Events\Login'</span><span class="token punctuation">,</span>
            <span class="token string">'App\Listeners\UserEventSubscriber@onUserLogin'</span>
        <span class="token punctuation">)</span><span class="token punctuation">;</span>

        <span class="token variable">$events</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">listen<span class="token punctuation">(</span></span>
            <span class="token string">'Illuminate\Auth\Events\Logout'</span><span class="token punctuation">,</span>
            <span class="token string">'App\Listeners\UserEventSubscriber@onUserLogout'</span>
        <span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="registering-event-subscribers"></a></p>
	<h3>Registering Event Subscribers</h3>
	<p>After writing the subscriber, you are ready to register it with the event dispatcher. You may register subscribers using the <code class=" language-php"><span class="token variable">$subscribe</span></code> property on the <code class=" language-php">EventServiceProvider</code>. For example, let's add the <code class=" language-php">UserEventSubscriber</code> to the list:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Providers</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Foundation<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Providers<span class="token punctuation">\</span>EventServiceProvider</span> <span class="token keyword">as</span> ServiceProvider<span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">EventServiceProvider</span> <span class="token keyword">extends</span> <span class="token class-name">ServiceProvider</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * The event listener mappings for the application.
     *
     * @var array
     */</span>
    <span class="token keyword">protected</span> <span class="token variable">$listen</span> <span class="token operator">=</span> <span class="token punctuation">[</span>
       <span class="token comment" spellcheck="true"> //
</span>    <span class="token punctuation">]</span><span class="token punctuation">;</span>

    <span class="token comment" spellcheck="true">/**
     * The subscriber classes to register.
     *
     * @var array
     */</span>
    <span class="token keyword">protected</span> <span class="token variable">$subscribe</span> <span class="token operator">=</span> <span class="token punctuation">[</span>
        <span class="token string">'App\Listeners\UserEventSubscriber'</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
</article>