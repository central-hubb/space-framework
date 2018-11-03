<article>
	<h1>Logging</h1>
	<ul>
		<li><a href="#introduction">Introduction</a></li>
		<li><a href="#configuration">Configuration</a>
			<ul>
				<li><a href="#building-log-stacks">Building Log Stacks</a></li>
			</ul></li>
		<li><a href="#writing-log-messages">Writing Log Messages</a>
			<ul>
				<li><a href="#writing-to-specific-channels">Writing To Specific Channels</a></li>
			</ul></li>
		<li><a href="#advanced-monolog-channel-customization">Advanced Monolog Channel Customization</a>
			<ul>
				<li><a href="#customizing-monolog-for-channels">Customizing Monolog For Channels</a></li>
				<li><a href="#creating-monolog-handler-channels">Creating Monolog Handler Channels</a></li>
				<li><a href="#creating-channels-via-factories">Creating Channels Via Factories</a></li>
			</ul></li>
	</ul>
	<p><a name="introduction"></a></p>
	<h2><a href="#introduction">Introduction</a></h2>
	<p>To help you learn more about what's happening within your application, Laravel provides robust logging services that allow you to log messages to files, the system error log, and even to Slack to notify your entire team.</p>
	<p>Under the hood, Laravel utilizes the <a href="https://github.com/Seldaek/monolog">Monolog</a> library, which provides support for a variety of powerful log handlers. Laravel makes it a cinch to configure these handlers, allowing you to mix and match them to customize your application's log handling.</p>
	<p><a name="configuration"></a></p>
	<h2><a href="#configuration">Configuration</a></h2>
	<p>All of the configuration for your application's logging system is housed in the <code class=" language-php">config<span class="token operator">/</span>logging<span class="token punctuation">.</span>php</code> configuration file. This file allows you to configure your application's log channels, so be sure to review each of the available channels and their options. Of course, we'll review a few common options below.</p>
	<p>By default, Laravel will use the <code class=" language-php">stack</code> channel when logging messages. The <code class=" language-php">stack</code> channel is used to aggregate multiple log channels into a single channel. For more information on building stacks, check out the <a href="#building-log-stacks">documentation below</a>.</p>
	<h4>Configuring The Channel Name</h4>
	<p>By default, Monolog is instantiated with a "channel name" that matches the current environment, such as <code class=" language-php">production</code> or <code class=" language-php">local</code>. To change this value, add a <code class=" language-php">name</code> option to your channel's configuration:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'stack'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
    <span class="token string">'driver'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'stack'</span><span class="token punctuation">,</span>
    <span class="token string">'name'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'channel-name'</span><span class="token punctuation">,</span>
    <span class="token string">'channels'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'single'</span><span class="token punctuation">,</span> <span class="token string">'slack'</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<h4>Available Channel Drivers</h4>
	<table>
		<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><code class=" language-php">stack</code></td>
			<td>A wrapper to facilitate creating "multi-channel" channels</td>
		</tr>
		<tr>
			<td><code class=" language-php">single</code></td>
			<td>A single file or path based logger channel (<code class=" language-php">StreamHandler</code>)</td>
		</tr>
		<tr>
			<td><code class=" language-php">daily</code></td>
			<td>A <code class=" language-php">RotatingFileHandler</code> based Monolog driver which rotates daily</td>
		</tr>
		<tr>
			<td><code class=" language-php">slack</code></td>
			<td>A <code class=" language-php">SlackWebhookHandler</code> based Monolog driver</td>
		</tr>
		<tr>
			<td><code class=" language-php">syslog</code></td>
			<td>A <code class=" language-php">SyslogHandler</code> based Monolog driver</td>
		</tr>
		<tr>
			<td><code class=" language-php">errorlog</code></td>
			<td>A <code class=" language-php">ErrorLogHandler</code> based Monolog driver</td>
		</tr>
		<tr>
			<td><code class=" language-php">monolog</code></td>
			<td>A Monolog factory driver that may use any supported Monolog handler</td>
		</tr>
		<tr>
			<td><code class=" language-php">custom</code></td>
			<td>A driver that calls a specified factory to create a channel</td>
		</tr>
		</tbody>
	</table>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> Check out the documentation on <a href="#advanced-monolog-channel-customization">advanced channel customization</a> to learn more about the <code class=" language-php">monolog</code> and <code class=" language-php">custom</code> drivers.</p>
	</blockquote>
	<h4>Configuring The Slack Channel</h4>
	<p>The <code class=" language-php">slack</code> channel requires a <code class=" language-php">url</code> configuration option. This URL should match a URL for an <a href="https://slack.com/apps/A0F7XDUAZ-incoming-webhooks">incoming webhook</a> that you have configured for your Slack team.</p>
	<p><a name="building-log-stacks"></a></p>
	<h3>Building Log Stacks</h3>
	<p>As previously mentioned, the <code class=" language-php">stack</code> driver allows you to combine multiple channels into a single log channel. To illustrate how to use log stacks, let's take a look at an example configuration that you might see in a production application:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'channels'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
    <span class="token string">'stack'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'driver'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'stack'</span><span class="token punctuation">,</span>
        <span class="token string">'channels'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token string">'syslog'</span><span class="token punctuation">,</span> <span class="token string">'slack'</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>

    <span class="token string">'syslog'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'driver'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'syslog'</span><span class="token punctuation">,</span>
        <span class="token string">'level'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'debug'</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>

    <span class="token string">'slack'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'driver'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'slack'</span><span class="token punctuation">,</span>
        <span class="token string">'url'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">env<span class="token punctuation">(</span></span><span class="token string">'LOG_SLACK_WEBHOOK_URL'</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
        <span class="token string">'username'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Laravel Log'</span><span class="token punctuation">,</span>
        <span class="token string">'emoji'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">':boom:'</span><span class="token punctuation">,</span>
        <span class="token string">'level'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'critical'</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<p>Let's dissect this configuration. First, notice our <code class=" language-php">stack</code> channel aggregates two other channels via its <code class=" language-php">channels</code> option: <code class=" language-php">syslog</code> and <code class=" language-php">slack</code>. So, when logging messages, both of these channels will have the opportunity to log the message.</p>
	<h4>Log Levels</h4>
	<p>Take note of the <code class=" language-php">level</code> configuration option present on the <code class=" language-php">syslog</code> and <code class=" language-php">slack</code> channel configurations in the example above. This option determines the minimum "level" a message must be in order to be logged by the channel. Monolog, which powers Laravel's logging services, offers all of the log levels defined in the <a href="https://tools.ietf.org/html/rfc5424">RFC 5424 specification</a>: <strong>emergency</strong>, <strong>alert</strong>, <strong>critical</strong>, <strong>error</strong>, <strong>warning</strong>, <strong>notice</strong>, <strong>info</strong>, and <strong>debug</strong>.</p>
	<p>So, imagine we log a message using the <code class=" language-php">debug</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Log<span class="token punctuation">::</span></span><span class="token function">debug<span class="token punctuation">(</span></span><span class="token string">'An informational message.'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>Given our configuration, the <code class=" language-php">syslog</code> channel will write the message to the system log; however, since the error message is not <code class=" language-php">critical</code> or above, it will not be sent to Slack. However, if we log an <code class=" language-php">emergency</code> message, it will be sent to both the system log and Slack since the <code class=" language-php">emergency</code> level is above our minimum level threshold for both channels:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Log<span class="token punctuation">::</span></span><span class="token function">emergency<span class="token punctuation">(</span></span><span class="token string">'The system is down!'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="writing-log-messages"></a></p>
	<h2><a href="#writing-log-messages">Writing Log Messages</a></h2>
	<p>You may write information to the logs using the <code class=" language-php">Log</code> <a href="/docs/5.7/facades">facade</a>. As previously mentioned, the logger provides the eight logging levels defined in the <a href="https://tools.ietf.org/html/rfc5424">RFC 5424 specification</a>: <strong>emergency</strong>, <strong>alert</strong>, <strong>critical</strong>, <strong>error</strong>, <strong>warning</strong>, <strong>notice</strong>, <strong>info</strong> and <strong>debug</strong>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Log<span class="token punctuation">::</span></span><span class="token function">emergency<span class="token punctuation">(</span></span><span class="token variable">$message</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token scope">Log<span class="token punctuation">::</span></span><span class="token function">alert<span class="token punctuation">(</span></span><span class="token variable">$message</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token scope">Log<span class="token punctuation">::</span></span><span class="token function">critical<span class="token punctuation">(</span></span><span class="token variable">$message</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token scope">Log<span class="token punctuation">::</span></span><span class="token function">error<span class="token punctuation">(</span></span><span class="token variable">$message</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token scope">Log<span class="token punctuation">::</span></span><span class="token function">warning<span class="token punctuation">(</span></span><span class="token variable">$message</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token scope">Log<span class="token punctuation">::</span></span><span class="token function">notice<span class="token punctuation">(</span></span><span class="token variable">$message</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token scope">Log<span class="token punctuation">::</span></span><span class="token function">info<span class="token punctuation">(</span></span><span class="token variable">$message</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token scope">Log<span class="token punctuation">::</span></span><span class="token function">debug<span class="token punctuation">(</span></span><span class="token variable">$message</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>So, you may call any of these methods to log a message for the corresponding level. By default, the message will be written to the default log channel as configured by your <code class=" language-php">config<span class="token operator">/</span>logging<span class="token punctuation">.</span>php</code> configuration file:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Controllers</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>User</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>Log</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Controllers<span class="token punctuation">\</span>Controller</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">UserController</span> <span class="token keyword">extends</span> <span class="token class-name">Controller</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">showProfile<span class="token punctuation">(</span></span><span class="token variable">$id</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token scope">Log<span class="token punctuation">::</span></span><span class="token function">info<span class="token punctuation">(</span></span><span class="token string">'Showing user profile for user: '</span><span class="token punctuation">.</span><span class="token variable">$id</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

        <span class="token keyword">return</span> <span class="token function">view<span class="token punctuation">(</span></span><span class="token string">'user.profile'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'user'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token scope">User<span class="token punctuation">::</span></span><span class="token function">findOrFail<span class="token punctuation">(</span></span><span class="token variable">$id</span><span class="token punctuation">)</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<h4>Contextual Information</h4>
	<p>An array of contextual data may also be passed to the log methods. This contextual data will be formatted and displayed with the log message:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Log<span class="token punctuation">::</span></span><span class="token function">info<span class="token punctuation">(</span></span><span class="token string">'User failed to login.'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'id'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">id</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="writing-to-specific-channels"></a></p>
	<h3>Writing To Specific Channels</h3>
	<p>Sometimes you may wish to log a message to a channel other than your application's default channel. You may use the <code class=" language-php">channel</code> method on the <code class=" language-php">Log</code> facade to retrieve and log to any channel defined in your configuration file:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Log<span class="token punctuation">::</span></span><span class="token function">channel<span class="token punctuation">(</span></span><span class="token string">'slack'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">info<span class="token punctuation">(</span></span><span class="token string">'Something happened!'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>If you would like to create an on-demand logging stack consisting of multiple channels, you may use the <code class=" language-php">stack</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Log<span class="token punctuation">::</span></span><span class="token function">stack<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'single'</span><span class="token punctuation">,</span> <span class="token string">'slack'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">info<span class="token punctuation">(</span></span><span class="token string">'Something happened!'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="advanced-monolog-channel-customization"></a></p>
	<h2><a href="#advanced-monolog-channel-customization">Advanced Monolog Channel Customization</a></h2>
	<p><a name="customizing-monolog-for-channels"></a></p>
	<h3>Customizing Monolog For Channels</h3>
	<p>Sometimes you may need complete control over how Monolog is configured for an existing channel. For example, you may want to configure a custom Monolog <code class=" language-php">FormatterInterface</code> implementation for a given channel's handlers.</p>
	<p>To get started, define a <code class=" language-php">tap</code> array on the channel's configuration. The <code class=" language-php">tap</code> array should contain a list of classes that should have an opportunity to customize (or "tap" into) the Monolog instance after it is created:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'single'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
    <span class="token string">'driver'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'single'</span><span class="token punctuation">,</span>
    <span class="token string">'tap'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span><span class="token scope">App<span class="token punctuation">\</span>Logging<span class="token punctuation">\</span>CustomizeFormatter<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">]</span><span class="token punctuation">,</span>
    <span class="token string">'path'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">storage_path<span class="token punctuation">(</span></span><span class="token string">'logs/laravel.log'</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
    <span class="token string">'level'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'debug'</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<p>Once you have configured the <code class=" language-php">tap</code> option on your channel, you're ready to define the class that will customize your Monolog instance. This class only needs a single method: <code class=" language-php">__invoke</code>, which receives an <code class=" language-php">Illuminate\<span class="token package">Log<span class="token punctuation">\</span>Logger</span></code> instance. The <code class=" language-php">Illuminate\<span class="token package">Log<span class="token punctuation">\</span>Logger</span></code> instance proxies all method calls to the underlying Monolog instance:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Logging</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">CustomizeFormatter</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Customize the given logger instance.
     *
     * @param  \Illuminate\Log\Logger  $logger
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">__invoke<span class="token punctuation">(</span></span><span class="token variable">$logger</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token keyword">foreach</span> <span class="token punctuation">(</span><span class="token variable">$logger</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">getHandlers<span class="token punctuation">(</span></span><span class="token punctuation">)</span> <span class="token keyword">as</span> <span class="token variable">$handler</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
            <span class="token variable">$handler</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">setFormatter<span class="token punctuation">(</span></span><span class="token punctuation">.</span><span class="token punctuation">.</span><span class="token punctuation">.</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
        <span class="token punctuation">}</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> All of your "tap" classes are resolved by the <a href="/docs/5.7/container">service container</a>, so any constructor dependencies they require will automatically be injected.</p>
	</blockquote>
	<p><a name="creating-monolog-handler-channels"></a></p>
	<h3>Creating Monolog Handler Channels</h3>
	<p>Monolog has a variety of <a href="https://github.com/Seldaek/monolog/tree/master/src/Monolog/Handler">available handlers</a>. In some cases, the type of logger you wish to create is merely a Monolog driver with an instance of a specific handler.  These channels can be created using the <code class=" language-php">monolog</code> driver.</p>
	<p>When using the <code class=" language-php">monolog</code> driver, the <code class=" language-php">handler</code> configuration option is used to specify which handler will be instantiated. Optionally, any constructor parameters the handler needs may be specified using the <code class=" language-php">handler_with</code> configuration option:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'logentries'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
    <span class="token string">'driver'</span>  <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'monolog'</span><span class="token punctuation">,</span>
    <span class="token string">'handler'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token scope">Monolog<span class="token punctuation">\</span>Handler<span class="token punctuation">\</span>SyslogUdpHandler<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
    <span class="token string">'handler_with'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'host'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'my.logentries.internal.datahubhost.company.com'</span><span class="token punctuation">,</span>
        <span class="token string">'port'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'10000'</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<h4>Monolog Formatters</h4>
	<p>When using the <code class=" language-php">monolog</code> driver, the Monolog <code class=" language-php">LineFormatter</code> will be used as the default formatter. However, you may customize the type of formatter passed to the handler using the <code class=" language-php">formatter</code> and <code class=" language-php">formatter_with</code> configuration options:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'browser'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
    <span class="token string">'driver'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'monolog'</span><span class="token punctuation">,</span>
    <span class="token string">'handler'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token scope">Monolog<span class="token punctuation">\</span>Handler<span class="token punctuation">\</span>BrowserConsoleHandler<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
    <span class="token string">'formatter'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token scope">Monolog<span class="token punctuation">\</span>Formatter<span class="token punctuation">\</span>HtmlFormatter<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
    <span class="token string">'formatter_with'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'dateFormat'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Y-m-d'</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<p>If you are using a Monolog handler that is capable of providing its own formatter, you may set the value of the <code class=" language-php">formatter</code> configuration option to <code class=" language-php"><span class="token keyword">default</span></code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'newrelic'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
    <span class="token string">'driver'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'monolog'</span><span class="token punctuation">,</span>
    <span class="token string">'handler'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token scope">Monolog<span class="token punctuation">\</span>Handler<span class="token punctuation">\</span>NewRelicHandler<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
    <span class="token string">'formatter'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'default'</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<p><a name="creating-channels-via-factories"></a></p>
	<h3>Creating Channels Via Factories</h3>
	<p>If you would like to define an entirely custom channel in which you have full control over Monolog's instantiation and configuration, you may specify a <code class=" language-php">custom</code> driver type in your <code class=" language-php">config<span class="token operator">/</span>logging<span class="token punctuation">.</span>php</code> configuration file. Your configuration should include a <code class=" language-php">via</code> option to point to the factory class which will be invoked to create the Monolog instance:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'channels'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
    <span class="token string">'custom'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'driver'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'custom'</span><span class="token punctuation">,</span>
        <span class="token string">'via'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token scope">App<span class="token punctuation">\</span>Logging<span class="token punctuation">\</span>CreateCustomLogger<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<p>Once you have configured the <code class=" language-php">custom</code> channel, you're ready to define the class that will create your Monolog instance. This class only needs a single method: <code class=" language-php">__invoke</code>, which should return the Monolog instance:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Logging</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Monolog<span class="token punctuation">\</span>Logger</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">CreateCustomLogger</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Create a custom Monolog instance.
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">__invoke<span class="token punctuation">(</span></span><span class="token keyword">array</span> <span class="token variable">$config</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token keyword">return</span> <span class="token keyword">new</span> <span class="token class-name">Logger</span><span class="token punctuation">(</span><span class="token punctuation">.</span><span class="token punctuation">.</span><span class="token punctuation">.</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
</article>