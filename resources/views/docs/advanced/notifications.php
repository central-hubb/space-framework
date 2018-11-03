<article>
	<h1>Notifications</h1>
	<ul>
		<li><a href="#introduction">Introduction</a></li>
		<li><a href="#creating-notifications">Creating Notifications</a></li>
		<li><a href="#sending-notifications">Sending Notifications</a>
			<ul>
				<li><a href="#using-the-notifiable-trait">Using The Notifiable Trait</a></li>
				<li><a href="#using-the-notification-facade">Using The Notification Facade</a></li>
				<li><a href="#specifying-delivery-channels">Specifying Delivery Channels</a></li>
				<li><a href="#queueing-notifications">Queueing Notifications</a></li>
				<li><a href="#on-demand-notifications">On-Demand Notifications</a></li>
			</ul></li>
		<li><a href="#mail-notifications">Mail Notifications</a>
			<ul>
				<li><a href="#formatting-mail-messages">Formatting Mail Messages</a></li>
				<li><a href="#customizing-the-recipient">Customizing The Recipient</a></li>
				<li><a href="#customizing-the-subject">Customizing The Subject</a></li>
				<li><a href="#customizing-the-templates">Customizing The Templates</a></li>
			</ul></li>
		<li><a href="#markdown-mail-notifications">Markdown Mail Notifications</a>
			<ul>
				<li><a href="#generating-the-message">Generating The Message</a></li>
				<li><a href="#writing-the-message">Writing The Message</a></li>
				<li><a href="#customizing-the-components">Customizing The Components</a></li>
			</ul></li>
		<li><a href="#database-notifications">Database Notifications</a>
			<ul>
				<li><a href="#database-prerequisites">Prerequisites</a></li>
				<li><a href="#formatting-database-notifications">Formatting Database Notifications</a></li>
				<li><a href="#accessing-the-notifications">Accessing The Notifications</a></li>
				<li><a href="#marking-notifications-as-read">Marking Notifications As Read</a></li>
			</ul></li>
		<li><a href="#broadcast-notifications">Broadcast Notifications</a>
			<ul>
				<li><a href="#broadcast-prerequisites">Prerequisites</a></li>
				<li><a href="#formatting-broadcast-notifications">Formatting Broadcast Notifications</a></li>
				<li><a href="#listening-for-notifications">Listening For Notifications</a></li>
			</ul></li>
		<li><a href="#sms-notifications">SMS Notifications</a>
			<ul>
				<li><a href="#sms-prerequisites">Prerequisites</a></li>
				<li><a href="#formatting-sms-notifications">Formatting SMS Notifications</a></li>
				<li><a href="#customizing-the-from-number">Customizing The "From" Number</a></li>
				<li><a href="#routing-sms-notifications">Routing SMS Notifications</a></li>
			</ul></li>
		<li><a href="#slack-notifications">Slack Notifications</a>
			<ul>
				<li><a href="#slack-prerequisites">Prerequisites</a></li>
				<li><a href="#formatting-slack-notifications">Formatting Slack Notifications</a></li>
				<li><a href="#slack-attachments">Slack Attachments</a></li>
				<li><a href="#routing-slack-notifications">Routing Slack Notifications</a></li>
			</ul></li>
		<li><a href="#localizing-notifications">Localizing Notifications</a></li>
		<li><a href="#notification-events">Notification Events</a></li>
		<li><a href="#custom-channels">Custom Channels</a></li>
	</ul>
	<p><a name="introduction"></a></p>
	<h2><a href="#introduction">Introduction</a></h2>
	<p>In addition to support for <a href="/docs/5.7/mail">sending email</a>, Laravel provides support for sending notifications across a variety of delivery channels, including mail, SMS (via <a href="https://www.nexmo.com/">Nexmo</a>), and <a href="https://slack.com">Slack</a>. Notifications may also be stored in a database so they may be displayed in your web interface.</p>
	<p>Typically, notifications should be short, informational messages that notify users of something that occurred in your application. For example, if you are writing a billing application, you might send an "Invoice Paid" notification to your users via the email and SMS channels.</p>
	<p><a name="creating-notifications"></a></p>
	<h2><a href="#creating-notifications">Creating Notifications</a></h2>
	<p>In Laravel, each notification is represented by a single class (typically stored in the <code class=" language-php">app<span class="token operator">/</span>Notifications</code> directory). Don't worry if you don't see this directory in your application, it will be created for you when you run the <code class=" language-php">make<span class="token punctuation">:</span>notification</code> Artisan command:</p>
	<pre class=" language-php"><code class=" language-php">php artisan make<span class="token punctuation">:</span>notification InvoicePaid</code></pre>
	<p>This command will place a fresh notification class in your <code class=" language-php">app<span class="token operator">/</span>Notifications</code> directory. Each notification class contains a <code class=" language-php">via</code> method and a variable number of message building methods (such as <code class=" language-php">toMail</code> or <code class=" language-php">toDatabase</code>) that convert the notification to a message optimized for that particular channel.</p>
	<p><a name="sending-notifications"></a></p>
	<h2><a href="#sending-notifications">Sending Notifications</a></h2>
	<p><a name="using-the-notifiable-trait"></a></p>
	<h3>Using The Notifiable Trait</h3>
	<p>Notifications may be sent in two ways: using the <code class=" language-php">notify</code> method of the <code class=" language-php">Notifiable</code> trait or using the <code class=" language-php">Notification</code> <a href="/docs/5.7/facades">facade</a>. First, let's explore using the trait:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Notifications<span class="token punctuation">\</span>Notifiable</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Foundation<span class="token punctuation">\</span>Auth<span class="token punctuation">\</span>User</span> <span class="token keyword">as</span> Authenticatable<span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">User</span> <span class="token keyword">extends</span> <span class="token class-name">Authenticatable</span>
<span class="token punctuation">{</span>
    <span class="token keyword">use</span> <span class="token package">Notifiable</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p>This trait is utilized by the default <code class=" language-php">App\<span class="token package">User</span></code> model and contains one method that may be used to send notifications: <code class=" language-php">notify</code>. The <code class=" language-php">notify</code> method expects to receive a notification instance:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Notifications<span class="token punctuation">\</span>InvoicePaid</span><span class="token punctuation">;</span>

<span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">notify<span class="token punctuation">(</span></span><span class="token keyword">new</span> <span class="token class-name">InvoicePaid</span><span class="token punctuation">(</span><span class="token variable">$invoice</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> Remember, you may use the <code class=" language-php">Illuminate\<span class="token package">Notifications<span class="token punctuation">\</span>Notifiable</span></code> trait on any of your models. You are not limited to only including it on your <code class=" language-php">User</code> model.</p>
	</blockquote>
	<p><a name="using-the-notification-facade"></a></p>
	<h3>Using The Notification Facade</h3>
	<p>Alternatively, you may send notifications via the <code class=" language-php">Notification</code> <a href="/docs/5.7/facades">facade</a>. This is useful primarily when you need to send a notification to multiple notifiable entities such as a collection of users. To send notifications using the facade, pass all of the notifiable entities and the notification instance to the <code class=" language-php">send</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Notification<span class="token punctuation">::</span></span><span class="token function">send<span class="token punctuation">(</span></span><span class="token variable">$users</span><span class="token punctuation">,</span> <span class="token keyword">new</span> <span class="token class-name">InvoicePaid</span><span class="token punctuation">(</span><span class="token variable">$invoice</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="specifying-delivery-channels"></a></p>
	<h3>Specifying Delivery Channels</h3>
	<p>Every notification class has a <code class=" language-php">via</code> method that determines on which channels the notification will be delivered. Out of the box, notifications may be sent on the <code class=" language-php">mail</code>, <code class=" language-php">database</code>, <code class=" language-php">broadcast</code>, <code class=" language-php">nexmo</code>, and <code class=" language-php">slack</code> channels.</p>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> If you would like to use other delivery channels such as Telegram or Pusher, check out the community driven <a href="http://laravel-notification-channels.com">Laravel Notification Channels website</a>.</p>
	</blockquote>
	<p>The <code class=" language-php">via</code> method receives a <code class=" language-php"><span class="token variable">$notifiable</span></code> instance, which will be an instance of the class to which the notification is being sent. You may use <code class=" language-php"><span class="token variable">$notifiable</span></code> to determine which channels the notification should be delivered on:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Get the notification's delivery channels.
 *
 * @param  mixed  $notifiable
 * @return array
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">via<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token variable">$notifiable</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">prefers_sms</span> <span class="token operator">?</span> <span class="token punctuation">[</span><span class="token string">'nexmo'</span><span class="token punctuation">]</span> <span class="token punctuation">:</span> <span class="token punctuation">[</span><span class="token string">'mail'</span><span class="token punctuation">,</span> <span class="token string">'database'</span><span class="token punctuation">]</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="queueing-notifications"></a></p>
	<h3>Queueing Notifications</h3>
	<blockquote class="has-icon">
		<p class="note"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="90px" height="90px" viewBox="0 0 90 90" enable-background="new 0 0 90 90" xml:space="preserve"><path fill="#FFFFFF" d="M45 0C20.1 0 0 20.1 0 45s20.1 45 45 45 45-20.1 45-45S69.9 0 45 0zM45 74.5c-3.6 0-6.5-2.9-6.5-6.5s2.9-6.5 6.5-6.5 6.5 2.9 6.5 6.5S48.6 74.5 45 74.5zM52.1 23.9l-2.5 29.6c0 2.5-2.1 4.6-4.6 4.6 -2.5 0-4.6-2.1-4.6-4.6l-2.5-29.6c-0.1-0.4-0.1-0.7-0.1-1.1 0-4 3.2-7.2 7.2-7.2 4 0 7.2 3.2 7.2 7.2C52.2 23.1 52.2 23.5 52.1 23.9z"></path></svg></span></div> Before queueing notifications you should configure your queue and <a href="/docs/5.7/queues">start a worker</a>.</p>
	</blockquote>
	<p>Sending notifications can take time, especially if the channel needs an external API call to deliver the notification. To speed up your application's response time, let your notification be queued by adding the <code class=" language-php">ShouldQueue</code> interface and <code class=" language-php">Queueable</code> trait to your class. The interface and trait are already imported for all notifications generated using <code class=" language-php">make<span class="token punctuation">:</span>notification</code>, so you may immediately add them to your notification class:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Notifications</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Bus<span class="token punctuation">\</span>Queueable</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Notifications<span class="token punctuation">\</span>Notification</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Contracts<span class="token punctuation">\</span>Queue<span class="token punctuation">\</span>ShouldQueue</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">InvoicePaid</span> <span class="token keyword">extends</span> <span class="token class-name">Notification</span> <span class="token keyword">implements</span> <span class="token class-name">ShouldQueue</span>
<span class="token punctuation">{</span>
    <span class="token keyword">use</span> <span class="token package">Queueable</span><span class="token punctuation">;</span>

   <span class="token comment" spellcheck="true"> // ...
</span><span class="token punctuation">}</span></code></pre>
	<p>Once the <code class=" language-php">ShouldQueue</code> interface has been added to your notification, you may send the notification like normal. Laravel will detect the <code class=" language-php">ShouldQueue</code> interface on the class and automatically queue the delivery of the notification:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">notify<span class="token punctuation">(</span></span><span class="token keyword">new</span> <span class="token class-name">InvoicePaid</span><span class="token punctuation">(</span><span class="token variable">$invoice</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>If you would like to delay the delivery of the notification, you may chain the <code class=" language-php">delay</code> method onto your notification instantiation:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$when</span> <span class="token operator">=</span> <span class="token function">now<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">addMinutes<span class="token punctuation">(</span></span><span class="token number">10</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">notify<span class="token punctuation">(</span></span><span class="token punctuation">(</span><span class="token keyword">new</span> <span class="token class-name">InvoicePaid</span><span class="token punctuation">(</span><span class="token variable">$invoice</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">delay<span class="token punctuation">(</span></span><span class="token variable">$when</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="on-demand-notifications"></a></p>
	<h3>On-Demand Notifications</h3>
	<p>Sometimes you may need to send a notification to someone who is not stored as a "user" of your application. Using the <code class=" language-php"><span class="token scope">Notification<span class="token punctuation">::</span></span>route</code> method, you may specify ad-hoc notification routing information before sending the notification:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Notification<span class="token punctuation">::</span></span><span class="token function">route<span class="token punctuation">(</span></span><span class="token string">'mail'</span><span class="token punctuation">,</span> <span class="token string">'taylor@example.com'</span><span class="token punctuation">)</span>
            <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">route<span class="token punctuation">(</span></span><span class="token string">'nexmo'</span><span class="token punctuation">,</span> <span class="token string">'5555555555'</span><span class="token punctuation">)</span>
            <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">notify<span class="token punctuation">(</span></span><span class="token keyword">new</span> <span class="token class-name">InvoicePaid</span><span class="token punctuation">(</span><span class="token variable">$invoice</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="mail-notifications"></a></p>
	<h2><a href="#mail-notifications">Mail Notifications</a></h2>
	<p><a name="formatting-mail-messages"></a></p>
	<h3>Formatting Mail Messages</h3>
	<p>If a notification supports being sent as an email, you should define a <code class=" language-php">toMail</code> method on the notification class. This method will receive a <code class=" language-php"><span class="token variable">$notifiable</span></code> entity and should return a <code class=" language-php">Illuminate\<span class="token package">Notifications<span class="token punctuation">\</span>Messages<span class="token punctuation">\</span>MailMessage</span></code> instance. Mail messages may contain lines of text as well as a "call to action". Let's take a look at an example <code class=" language-php">toMail</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Get the mail representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return \Illuminate\Notifications\Messages\MailMessage
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">toMail<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token variable">$url</span> <span class="token operator">=</span> <span class="token function">url<span class="token punctuation">(</span></span><span class="token string">'/invoice/'</span><span class="token punctuation">.</span><span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">invoice</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">id</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

    <span class="token keyword">return</span> <span class="token punctuation">(</span><span class="token keyword">new</span> <span class="token class-name">MailMessage</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">greeting<span class="token punctuation">(</span></span><span class="token string">'Hello!'</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">line<span class="token punctuation">(</span></span><span class="token string">'One of your invoices has been paid!'</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">action<span class="token punctuation">(</span></span><span class="token string">'View Invoice'</span><span class="token punctuation">,</span> <span class="token variable">$url</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">line<span class="token punctuation">(</span></span><span class="token string">'Thank you for using our application!'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> Note we are using <code class=" language-php"><span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">invoice</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">id</span></code> in our <code class=" language-php">toMail</code> method. You may pass any data your notification needs to generate its message into the notification's constructor.</p>
	</blockquote>
	<p>In this example, we register a greeting, a line of text, a call to action, and then another line of text. These methods provided by the <code class=" language-php">MailMessage</code> object make it simple and fast to format small transactional emails. The mail channel will then translate the message components into a nice, responsive HTML email template with a plain-text counterpart. Here is an example of an email generated by the <code class=" language-php">mail</code> channel:</p>
	<img src="https://laravel.com/assets/img/notification-example.png" width="551" height="596">
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> When sending mail notifications, be sure to set the <code class=" language-php">name</code> value in your <code class=" language-php">config<span class="token operator">/</span>app<span class="token punctuation">.</span>php</code> configuration file. This value will be used in the header and footer of your mail notification messages.</p>
	</blockquote>
	<h4>Other Notification Formatting Options</h4>
	<p>Instead of defining the "lines" of text in the notification class, you may use the <code class=" language-php">view</code> method to specify a custom template that should be used to render the notification email:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Get the mail representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return \Illuminate\Notifications\Messages\MailMessage
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">toMail<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token punctuation">(</span><span class="token keyword">new</span> <span class="token class-name">MailMessage</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">view<span class="token punctuation">(</span></span>
        <span class="token string">'emails.name'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'invoice'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">invoice</span><span class="token punctuation">]</span>
    <span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p>In addition, you may return a <a href="/docs/5.7/mail">mailable object</a> from the <code class=" language-php">toMail</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Mail<span class="token punctuation">\</span>InvoicePaid</span> <span class="token keyword">as</span> Mailable<span class="token punctuation">;</span>

<span class="token comment" spellcheck="true">/**
 * Get the mail representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return Mailable
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">toMail<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token punctuation">(</span><span class="token keyword">new</span> <span class="token class-name">Mailable</span><span class="token punctuation">(</span><span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">invoice</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">to<span class="token punctuation">(</span></span><span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">email</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="error-messages"></a></p>
	<h4>Error Messages</h4>
	<p>Some notifications inform users of errors, such as a failed invoice payment. You may indicate that a mail message is regarding an error by calling the <code class=" language-php">error</code> method when building your message. When using the <code class=" language-php">error</code> method on a mail message, the call to action button will be red instead of blue:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Get the mail representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return \Illuminate\Notifications\Message
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">toMail<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token punctuation">(</span><span class="token keyword">new</span> <span class="token class-name">MailMessage</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">error<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">subject<span class="token punctuation">(</span></span><span class="token string">'Notification Subject'</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">line<span class="token punctuation">(</span></span><span class="token string">'...'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="customizing-the-recipient"></a></p>
	<h3>Customizing The Recipient</h3>
	<p>When sending notifications via the <code class=" language-php">mail</code> channel, the notification system will automatically look for an <code class=" language-php">email</code> property on your notifiable entity. You may customize which email address is used to deliver the notification by defining a <code class=" language-php">routeNotificationForMail</code> method on the entity:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Notifications<span class="token punctuation">\</span>Notifiable</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Foundation<span class="token punctuation">\</span>Auth<span class="token punctuation">\</span>User</span> <span class="token keyword">as</span> Authenticatable<span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">User</span> <span class="token keyword">extends</span> <span class="token class-name">Authenticatable</span>
<span class="token punctuation">{</span>
    <span class="token keyword">use</span> <span class="token package">Notifiable</span><span class="token punctuation">;</span>

    <span class="token comment" spellcheck="true">/**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">routeNotificationForMail<span class="token punctuation">(</span></span><span class="token variable">$notification</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token keyword">return</span> <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">email_address</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="customizing-the-subject"></a></p>
	<h3>Customizing The Subject</h3>
	<p>By default, the email's subject is the class name of the notification formatted to "title case". So, if your notification class is named <code class=" language-php">InvoicePaid</code>, the email's subject will be <code class=" language-php">Invoice Paid</code>. If you would like to specify an explicit subject for the message, you may call the <code class=" language-php">subject</code> method when building your message:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Get the mail representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return \Illuminate\Notifications\Messages\MailMessage
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">toMail<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token punctuation">(</span><span class="token keyword">new</span> <span class="token class-name">MailMessage</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">subject<span class="token punctuation">(</span></span><span class="token string">'Notification Subject'</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">line<span class="token punctuation">(</span></span><span class="token string">'...'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="customizing-the-templates"></a></p>
	<h3>Customizing The Templates</h3>
	<p>You can modify the HTML and plain-text template used by mail notifications by publishing the notification package's resources. After running this command, the mail notification templates will be located in the <code class=" language-php">resources<span class="token operator">/</span>views<span class="token operator">/</span>vendor<span class="token operator">/</span>notifications</code> directory:</p>
	<pre class=" language-php"><code class=" language-php">php artisan vendor<span class="token punctuation">:</span>publish <span class="token operator">--</span>tag<span class="token operator">=</span>laravel<span class="token operator">-</span>notifications</code></pre>
	<p><a name="markdown-mail-notifications"></a></p>
	<h2><a href="#markdown-mail-notifications">Markdown Mail Notifications</a></h2>
	<p>Markdown mail notifications allow you to take advantage of the pre-built templates of mail notifications, while giving you more freedom to write longer, customized messages. Since the messages are written in Markdown, Laravel is able to render beautiful, responsive HTML templates for the messages while also automatically generating a plain-text counterpart.</p>
	<p><a name="generating-the-message"></a></p>
	<h3>Generating The Message</h3>
	<p>To generate a notification with a corresponding Markdown template, you may use the <code class=" language-php"><span class="token operator">--</span>markdown</code> option of the <code class=" language-php">make<span class="token punctuation">:</span>notification</code> Artisan command:</p>
	<pre class=" language-php"><code class=" language-php">php artisan make<span class="token punctuation">:</span>notification InvoicePaid <span class="token operator">--</span>markdown<span class="token operator">=</span>mail<span class="token punctuation">.</span>invoice<span class="token punctuation">.</span>paid</code></pre>
	<p>Like all other mail notifications, notifications that use Markdown templates should define a <code class=" language-php">toMail</code> method on their notification class. However, instead of using the <code class=" language-php">line</code> and <code class=" language-php">action</code> methods to construct the notification, use the <code class=" language-php">markdown</code> method to specify the name of the Markdown template that should be used:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Get the mail representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return \Illuminate\Notifications\Messages\MailMessage
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">toMail<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token variable">$url</span> <span class="token operator">=</span> <span class="token function">url<span class="token punctuation">(</span></span><span class="token string">'/invoice/'</span><span class="token punctuation">.</span><span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">invoice</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">id</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

    <span class="token keyword">return</span> <span class="token punctuation">(</span><span class="token keyword">new</span> <span class="token class-name">MailMessage</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">subject<span class="token punctuation">(</span></span><span class="token string">'Invoice Paid'</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">markdown<span class="token punctuation">(</span></span><span class="token string">'mail.invoice.paid'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'url'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token variable">$url</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="writing-the-message"></a></p>
	<h3>Writing The Message</h3>
	<p>Markdown mail notifications use a combination of Blade components and Markdown syntax which allow you to easily construct notifications while leveraging Laravel's pre-crafted notification components:</p>
	<pre class=" language-php"><code class=" language-php">@<span class="token function">component<span class="token punctuation">(</span></span><span class="token string">'mail::message'</span><span class="token punctuation">)</span><span class="token comment" spellcheck="true">
# Invoice Paid
</span>
Your invoice has been paid<span class="token operator">!</span>

@<span class="token function">component<span class="token punctuation">(</span></span><span class="token string">'mail::button'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'url'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token variable">$url</span><span class="token punctuation">]</span><span class="token punctuation">)</span>
View Invoice
@endcomponent

Thanks<span class="token punctuation">,</span><span class="token markup"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>br</span><span class="token punctuation">&gt;</span></span></span>
<span class="token punctuation">{</span><span class="token punctuation">{</span> <span class="token function">config<span class="token punctuation">(</span></span><span class="token string">'app.name'</span><span class="token punctuation">)</span> <span class="token punctuation">}</span><span class="token punctuation">}</span>
@endcomponent</code></pre>
	<h4>Button Component</h4>
	<p>The button component renders a centered button link. The component accepts two arguments, a <code class=" language-php">url</code> and an optional <code class=" language-php">color</code>. Supported colors are <code class=" language-php">blue</code>, <code class=" language-php">green</code>, and <code class=" language-php">red</code>. You may add as many button components to a notification as you wish:</p>
	<pre class=" language-php"><code class=" language-php">@<span class="token function">component<span class="token punctuation">(</span></span><span class="token string">'mail::button'</span><span class="token punctuation">,</span> <span class="token punctuation">[</span><span class="token string">'url'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token variable">$url</span><span class="token punctuation">,</span> <span class="token string">'color'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'green'</span><span class="token punctuation">]</span><span class="token punctuation">)</span>
View Invoice
@endcomponent</code></pre>
	<h4>Panel Component</h4>
	<p>The panel component renders the given block of text in a panel that has a slightly different background color than the rest of the notification. This allows you to draw attention to a given block of text:</p>
	<pre class=" language-php"><code class=" language-php">@<span class="token function">component<span class="token punctuation">(</span></span><span class="token string">'mail::panel'</span><span class="token punctuation">)</span>
This is the panel content<span class="token punctuation">.</span>
@endcomponent</code></pre>
	<h4>Table Component</h4>
	<p>The table component allows you to transform a Markdown table into an HTML table. The component accepts the Markdown table as its content. Table column alignment is supported using the default Markdown table alignment syntax:</p>
	<pre class=" language-php"><code class=" language-php">@<span class="token function">component<span class="token punctuation">(</span></span><span class="token string">'mail::table'</span><span class="token punctuation">)</span>
<span class="token operator">|</span> Laravel       <span class="token operator">|</span> Table         <span class="token operator">|</span> Example  <span class="token operator">|</span>
<span class="token operator">|</span> <span class="token operator">--</span><span class="token operator">--</span><span class="token operator">--</span><span class="token operator">--</span><span class="token operator">--</span><span class="token operator">--</span><span class="token operator">-</span> <span class="token operator">|</span><span class="token punctuation">:</span><span class="token operator">--</span><span class="token operator">--</span><span class="token operator">--</span><span class="token operator">--</span><span class="token operator">--</span><span class="token operator">--</span><span class="token operator">-</span><span class="token punctuation">:</span><span class="token operator">|</span> <span class="token operator">--</span><span class="token operator">--</span><span class="token operator">--</span><span class="token operator">--</span><span class="token punctuation">:</span><span class="token operator">|</span>
<span class="token operator">|</span> Col <span class="token number">2</span> is      <span class="token operator">|</span> Centered      <span class="token operator">|</span> <span class="token variable">$10</span>      <span class="token operator">|</span>
<span class="token operator">|</span> Col <span class="token number">3</span> is      <span class="token operator">|</span> Right<span class="token operator">-</span>Aligned <span class="token operator">|</span> <span class="token variable">$20</span>      <span class="token operator">|</span>
@endcomponent</code></pre>
	<p><a name="customizing-the-components"></a></p>
	<h3>Customizing The Components</h3>
	<p>You may export all of the Markdown notification components to your own application for customization. To export the components, use the <code class=" language-php">vendor<span class="token punctuation">:</span>publish</code> Artisan command to publish the <code class=" language-php">laravel<span class="token operator">-</span>mail</code> asset tag:</p>
	<pre class=" language-php"><code class=" language-php">php artisan vendor<span class="token punctuation">:</span>publish <span class="token operator">--</span>tag<span class="token operator">=</span>laravel<span class="token operator">-</span>mail</code></pre>
	<p>This command will publish the Markdown mail components to the <code class=" language-php">resources<span class="token operator">/</span>views<span class="token operator">/</span>vendor<span class="token operator">/</span>mail</code> directory. The <code class=" language-php">mail</code> directory will contain a <code class=" language-php">html</code> and a <code class=" language-php">markdown</code> directory, each containing their respective representations of every available component. You are free to customize these components however you like.</p>
	<h4>Customizing The CSS</h4>
	<p>After exporting the components, the <code class=" language-php">resources<span class="token operator">/</span>views<span class="token operator">/</span>vendor<span class="token operator">/</span>mail<span class="token operator">/</span>html<span class="token operator">/</span>themes</code> directory will contain a <code class=" language-php"><span class="token keyword">default</span><span class="token punctuation">.</span>css</code> file. You may customize the CSS in this file and your styles will automatically be in-lined within the HTML representations of your Markdown notifications.</p>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> If you would like to build an entirely new theme for the Markdown components, write a new CSS file within the <code class=" language-php">html<span class="token operator">/</span>themes</code> directory and change the <code class=" language-php">theme</code> option of your <code class=" language-php">mail</code> configuration file.</p>
	</blockquote>
	<p><a name="database-notifications"></a></p>
	<h2><a href="#database-notifications">Database Notifications</a></h2>
	<p><a name="database-prerequisites"></a></p>
	<h3>Prerequisites</h3>
	<p>The <code class=" language-php">database</code> notification channel stores the notification information in a database table. This table will contain information such as the notification type as well as custom JSON data that describes the notification.</p>
	<p>You can query the table to display the notifications in your application's user interface. But, before you can do that, you will need to create a database table to hold your notifications. You may use the <code class=" language-php">notifications<span class="token punctuation">:</span>table</code> command to generate a migration with the proper table schema:</p>
	<pre class=" language-php"><code class=" language-php">php artisan notifications<span class="token punctuation">:</span>table

php artisan migrate</code></pre>
	<p><a name="formatting-database-notifications"></a></p>
	<h3>Formatting Database Notifications</h3>
	<p>If a notification supports being stored in a database table, you should define a <code class=" language-php">toDatabase</code> or <code class=" language-php">toArray</code> method on the notification class. This method will receive a <code class=" language-php"><span class="token variable">$notifiable</span></code> entity and should return a plain PHP array. The returned array will be encoded as JSON and stored in the <code class=" language-php">data</code> column of your <code class=" language-php">notifications</code> table. Let's take a look at an example <code class=" language-php">toArray</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Get the array representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return array
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">toArray<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token punctuation">[</span>
        <span class="token string">'invoice_id'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">invoice</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">id</span><span class="token punctuation">,</span>
        <span class="token string">'amount'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">invoice</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">amount</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<h4><code class=" language-php">toDatabase</code> Vs. <code class=" language-php">toArray</code></h4>
	<p>The <code class=" language-php">toArray</code> method is also used by the <code class=" language-php">broadcast</code> channel to determine which data to broadcast to your JavaScript client. If you would like to have two different array representations for the <code class=" language-php">database</code> and <code class=" language-php">broadcast</code> channels, you should define a <code class=" language-php">toDatabase</code> method instead of a <code class=" language-php">toArray</code> method.</p>
	<p><a name="accessing-the-notifications"></a></p>
	<h3>Accessing The Notifications</h3>
	<p>Once notifications are stored in the database, you need a convenient way to access them from your notifiable entities. The <code class=" language-php">Illuminate\<span class="token package">Notifications<span class="token punctuation">\</span>Notifiable</span></code> trait, which is included on Laravel's default <code class=" language-php">App\<span class="token package">User</span></code> model, includes a <code class=" language-php">notifications</code> Eloquent relationship that returns the notifications for the entity. To fetch notifications, you may access this method like any other Eloquent relationship. By default, notifications will be sorted by the <code class=" language-php">created_at</code> timestamp:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$user</span> <span class="token operator">=</span> <span class="token scope">App<span class="token punctuation">\</span>User<span class="token punctuation">::</span></span><span class="token function">find<span class="token punctuation">(</span></span><span class="token number">1</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token keyword">foreach</span> <span class="token punctuation">(</span><span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">notifications</span> <span class="token keyword">as</span> <span class="token variable">$notification</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">echo</span> <span class="token variable">$notification</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">type</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p>If you want to retrieve only the "unread" notifications, you may use the <code class=" language-php">unreadNotifications</code> relationship. Again, these notifications will be sorted by the <code class=" language-php">created_at</code> timestamp:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$user</span> <span class="token operator">=</span> <span class="token scope">App<span class="token punctuation">\</span>User<span class="token punctuation">::</span></span><span class="token function">find<span class="token punctuation">(</span></span><span class="token number">1</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token keyword">foreach</span> <span class="token punctuation">(</span><span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">unreadNotifications</span> <span class="token keyword">as</span> <span class="token variable">$notification</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token keyword">echo</span> <span class="token variable">$notification</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">type</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> To access your notifications from your JavaScript client, you should define a notification controller for your application which returns the notifications for a notifiable entity, such as the current user. You may then make an HTTP request to that controller's URI from your JavaScript client.</p>
	</blockquote>
	<p><a name="marking-notifications-as-read"></a></p>
	<h3>Marking Notifications As Read</h3>
	<p>Typically, you will want to mark a notification as "read" when a user views it. The <code class=" language-php">Illuminate\<span class="token package">Notifications<span class="token punctuation">\</span>Notifiable</span></code> trait provides a <code class=" language-php">markAsRead</code> method, which updates the <code class=" language-php">read_at</code> column on the notification's database record:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$user</span> <span class="token operator">=</span> <span class="token scope">App<span class="token punctuation">\</span>User<span class="token punctuation">::</span></span><span class="token function">find<span class="token punctuation">(</span></span><span class="token number">1</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token keyword">foreach</span> <span class="token punctuation">(</span><span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">unreadNotifications</span> <span class="token keyword">as</span> <span class="token variable">$notification</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
    <span class="token variable">$notification</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">markAsRead<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p>However, instead of looping through each notification, you may use the <code class=" language-php">markAsRead</code> method directly on a collection of notifications:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">unreadNotifications</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">markAsRead<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>You may also use a mass-update query to mark all of the notifications as read without retrieving them from the database:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$user</span> <span class="token operator">=</span> <span class="token scope">App<span class="token punctuation">\</span>User<span class="token punctuation">::</span></span><span class="token function">find<span class="token punctuation">(</span></span><span class="token number">1</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">unreadNotifications<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">update<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'read_at'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">now<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>Of course, you may <code class=" language-php">delete</code> the notifications to remove them from the table entirely:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">notifications<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">delete<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="broadcast-notifications"></a></p>
	<h2><a href="#broadcast-notifications">Broadcast Notifications</a></h2>
	<p><a name="broadcast-prerequisites"></a></p>
	<h3>Prerequisites</h3>
	<p>Before broadcasting notifications, you should configure and be familiar with Laravel's <a href="/docs/5.7/broadcasting">event broadcasting</a> services. Event broadcasting provides a way to react to server-side fired Laravel events from your JavaScript client.</p>
	<p><a name="formatting-broadcast-notifications"></a></p>
	<h3>Formatting Broadcast Notifications</h3>
	<p>The <code class=" language-php">broadcast</code> channel broadcasts notifications using Laravel's <a href="/docs/5.7/broadcasting">event broadcasting</a> services, allowing your JavaScript client to catch notifications in realtime. If a notification supports broadcasting, you should define a <code class=" language-php">toBroadcast</code> method on the notification class. This method will receive a <code class=" language-php"><span class="token variable">$notifiable</span></code> entity and should return a <code class=" language-php">BroadcastMessage</code> instance. The returned data will be encoded as JSON and broadcast to your JavaScript client. Let's take a look at an example <code class=" language-php">toBroadcast</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Notifications<span class="token punctuation">\</span>Messages<span class="token punctuation">\</span>BroadcastMessage</span><span class="token punctuation">;</span>

<span class="token comment" spellcheck="true">/**
 * Get the broadcastable representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return BroadcastMessage
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">toBroadcast<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token keyword">new</span> <span class="token class-name">BroadcastMessage</span><span class="token punctuation">(</span><span class="token punctuation">[</span>
        <span class="token string">'invoice_id'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">invoice</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">id</span><span class="token punctuation">,</span>
        <span class="token string">'amount'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">invoice</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">amount</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<h4>Broadcast Queue Configuration</h4>
	<p>All broadcast notifications are queued for broadcasting. If you would like to configure the queue connection or queue name that is used to queue the broadcast operation, you may use the <code class=" language-php">onConnection</code> and <code class=" language-php">onQueue</code> methods of the <code class=" language-php">BroadcastMessage</code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token punctuation">(</span><span class="token keyword">new</span> <span class="token class-name">BroadcastMessage</span><span class="token punctuation">(</span><span class="token variable">$data</span><span class="token punctuation">)</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">onConnection<span class="token punctuation">(</span></span><span class="token string">'sqs'</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">onQueue<span class="token punctuation">(</span></span><span class="token string">'broadcasts'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> In addition to the data you specify, broadcast notifications will also contain a <code class=" language-php">type</code> field containing the class name of the notification.</p>
	</blockquote>
	<p><a name="listening-for-notifications"></a></p>
	<h3>Listening For Notifications</h3>
	<p>Notifications will broadcast on a private channel formatted using a <code class=" language-php"><span class="token punctuation">{</span>notifiable<span class="token punctuation">}</span><span class="token punctuation">.</span><span class="token punctuation">{</span>id<span class="token punctuation">}</span></code> convention. So, if you are sending a notification to a <code class=" language-php">App\<span class="token package">User</span></code> instance with an ID of <code class=" language-php"><span class="token number">1</span></code>, the notification will be broadcast on the <code class=" language-php">App<span class="token punctuation">.</span>User<span class="token number">.1</span></code> private channel. When using <a href="/docs/5.7/broadcasting">Laravel Echo</a>, you may easily listen for notifications on a channel using the <code class=" language-php">notification</code> helper method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">Echo</span><span class="token punctuation">.</span><span class="token keyword">private</span><span class="token punctuation">(</span><span class="token string">'App.User.'</span> <span class="token operator">+</span> userId<span class="token punctuation">)</span>
    <span class="token punctuation">.</span><span class="token function">notification<span class="token punctuation">(</span></span><span class="token punctuation">(</span>notification<span class="token punctuation">)</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">{</span>
        console<span class="token punctuation">.</span><span class="token function">log<span class="token punctuation">(</span></span>notification<span class="token punctuation">.</span>type<span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Customizing The Notification Channel</h4>
	<p>If you would like to customize which channels a notifiable entity receives its broadcast notifications on, you may define a <code class=" language-php">receivesBroadcastNotificationsOn</code> method on the notifiable entity:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Notifications<span class="token punctuation">\</span>Notifiable</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Broadcasting<span class="token punctuation">\</span>PrivateChannel</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Foundation<span class="token punctuation">\</span>Auth<span class="token punctuation">\</span>User</span> <span class="token keyword">as</span> Authenticatable<span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">User</span> <span class="token keyword">extends</span> <span class="token class-name">Authenticatable</span>
<span class="token punctuation">{</span>
    <span class="token keyword">use</span> <span class="token package">Notifiable</span><span class="token punctuation">;</span>

    <span class="token comment" spellcheck="true">/**
     * The channels the user receives notification broadcasts on.
     *
     * @return string
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">receivesBroadcastNotificationsOn<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token keyword">return</span> <span class="token string">'users.'</span><span class="token punctuation">.</span><span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">id</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="sms-notifications"></a></p>
	<h2><a href="#sms-notifications">SMS Notifications</a></h2>
	<p><a name="sms-prerequisites"></a></p>
	<h3>Prerequisites</h3>
	<p>Sending SMS notifications in Laravel is powered by <a href="https://www.nexmo.com/">Nexmo</a>. Before you can send notifications via Nexmo, you need to install the <code class=" language-php">nexmo<span class="token operator">/</span>client</code> Composer package and add a few configuration options to your <code class=" language-php">config<span class="token operator">/</span>services<span class="token punctuation">.</span>php</code> configuration file. You may copy the example configuration below to get started:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'nexmo'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
    <span class="token string">'key'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">env<span class="token punctuation">(</span></span><span class="token string">'NEXMO_KEY'</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
    <span class="token string">'secret'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">env<span class="token punctuation">(</span></span><span class="token string">'NEXMO_SECRET'</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
    <span class="token string">'sms_from'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'15556666666'</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<p>The <code class=" language-php">sms_from</code> option is the phone number that your SMS messages will be sent from. You should generate a phone number for your application in the Nexmo control panel.</p>
	<p><a name="formatting-sms-notifications"></a></p>
	<h3>Formatting SMS Notifications</h3>
	<p>If a notification supports being sent as an SMS, you should define a <code class=" language-php">toNexmo</code> method on the notification class. This method will receive a <code class=" language-php"><span class="token variable">$notifiable</span></code> entity and should return a <code class=" language-php">Illuminate\<span class="token package">Notifications<span class="token punctuation">\</span>Messages<span class="token punctuation">\</span>NexmoMessage</span></code> instance:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Get the Nexmo / SMS representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return NexmoMessage
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">toNexmo<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token punctuation">(</span><span class="token keyword">new</span> <span class="token class-name">NexmoMessage</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">content<span class="token punctuation">(</span></span><span class="token string">'Your SMS message content'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<h4>Unicode Content</h4>
	<p>If your SMS message will contain unicode characters, you should call the <code class=" language-php">unicode</code> method when constructing the <code class=" language-php">NexmoMessage</code> instance:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Get the Nexmo / SMS representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return NexmoMessage
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">toNexmo<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token punctuation">(</span><span class="token keyword">new</span> <span class="token class-name">NexmoMessage</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">content<span class="token punctuation">(</span></span><span class="token string">'Your unicode message'</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">unicode<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="customizing-the-from-number"></a></p>
	<h3>Customizing The "From" Number</h3>
	<p>If you would like to send some notifications from a phone number that is different from the phone number specified in your <code class=" language-php">config<span class="token operator">/</span>services<span class="token punctuation">.</span>php</code> file, you may use the <code class=" language-php">from</code> method on a <code class=" language-php">NexmoMessage</code> instance:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Get the Nexmo / SMS representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return NexmoMessage
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">toNexmo<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token punctuation">(</span><span class="token keyword">new</span> <span class="token class-name">NexmoMessage</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">content<span class="token punctuation">(</span></span><span class="token string">'Your SMS message content'</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">from<span class="token punctuation">(</span></span><span class="token string">'15554443333'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="routing-sms-notifications"></a></p>
	<h3>Routing SMS Notifications</h3>
	<p>When sending notifications via the <code class=" language-php">nexmo</code> channel, the notification system will automatically look for a <code class=" language-php">phone_number</code> attribute on the notifiable entity. If you would like to customize the phone number the notification is delivered to, define a <code class=" language-php">routeNotificationForNexmo</code> method on the entity:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Notifications<span class="token punctuation">\</span>Notifiable</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Foundation<span class="token punctuation">\</span>Auth<span class="token punctuation">\</span>User</span> <span class="token keyword">as</span> Authenticatable<span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">User</span> <span class="token keyword">extends</span> <span class="token class-name">Authenticatable</span>
<span class="token punctuation">{</span>
    <span class="token keyword">use</span> <span class="token package">Notifiable</span><span class="token punctuation">;</span>

    <span class="token comment" spellcheck="true">/**
     * Route notifications for the Nexmo channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">routeNotificationForNexmo<span class="token punctuation">(</span></span><span class="token variable">$notification</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token keyword">return</span> <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">phone</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="slack-notifications"></a></p>
	<h2><a href="#slack-notifications">Slack Notifications</a></h2>
	<p><a name="slack-prerequisites"></a></p>
	<h3>Prerequisites</h3>
	<p>Before you can send notifications via Slack, you must install the Guzzle HTTP library via Composer:</p>
	<pre class=" language-php"><code class=" language-php">composer <span class="token keyword">require</span> guzzlehttp<span class="token operator">/</span>guzzle</code></pre>
	<p>You will also need to configure an <a href="https://api.slack.com/incoming-webhooks">"Incoming Webhook"</a> integration for your Slack team. This integration will provide you with a URL you may use when <a href="#routing-slack-notifications">routing Slack notifications</a>.</p>
	<p><a name="formatting-slack-notifications"></a></p>
	<h3>Formatting Slack Notifications</h3>
	<p>If a notification supports being sent as a Slack message, you should define a <code class=" language-php">toSlack</code> method on the notification class. This method will receive a <code class=" language-php"><span class="token variable">$notifiable</span></code> entity and should return a <code class=" language-php">Illuminate\<span class="token package">Notifications<span class="token punctuation">\</span>Messages<span class="token punctuation">\</span>SlackMessage</span></code> instance. Slack messages may contain text content as well as an "attachment" that formats additional text or an array of fields. Let's take a look at a basic <code class=" language-php">toSlack</code> example:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Get the Slack representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return SlackMessage
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">toSlack<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token punctuation">(</span><span class="token keyword">new</span> <span class="token class-name">SlackMessage</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">content<span class="token punctuation">(</span></span><span class="token string">'One of your invoices has been paid!'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p>In this example we are just sending a single line of text to Slack, which will create a message that looks like the following:</p>
	<img src="https://laravel.com/assets/img/basic-slack-notification.png">
	<h4>Customizing The Sender &amp; Recipient</h4>
	<p>You may use the <code class=" language-php">from</code> and <code class=" language-php">to</code> methods to customize the sender and recipient. The <code class=" language-php">from</code> method accepts a username and emoji identifier, while the <code class=" language-php">to</code> method accepts a channel or username:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Get the Slack representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return SlackMessage
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">toSlack<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token punctuation">(</span><span class="token keyword">new</span> <span class="token class-name">SlackMessage</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">from<span class="token punctuation">(</span></span><span class="token string">'Ghost'</span><span class="token punctuation">,</span> <span class="token string">':ghost:'</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">to<span class="token punctuation">(</span></span><span class="token comment" spellcheck="true">'#other')
</span>                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">content<span class="token punctuation">(</span></span>'This will be sent to<span class="token comment" spellcheck="true"> #other');
</span><span class="token punctuation">}</span></code></pre>
	<p>You may also use an image as your logo instead of an emoji:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Get the Slack representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return SlackMessage
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">toSlack<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token keyword">return</span> <span class="token punctuation">(</span><span class="token keyword">new</span> <span class="token class-name">SlackMessage</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">from<span class="token punctuation">(</span></span><span class="token string">'Laravel'</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">image<span class="token punctuation">(</span></span><span class="token string">'https://laravel.com/favicon.png'</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">content<span class="token punctuation">(</span></span><span class="token string">'This will display the Laravel logo next to the message'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="slack-attachments"></a></p>
	<h3>Slack Attachments</h3>
	<p>You may also add "attachments" to Slack messages. Attachments provide richer formatting options than simple text messages. In this example, we will send an error notification about an exception that occurred in an application, including a link to view more details about the exception:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Get the Slack representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return SlackMessage
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">toSlack<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token variable">$url</span> <span class="token operator">=</span> <span class="token function">url<span class="token punctuation">(</span></span><span class="token string">'/exceptions/'</span><span class="token punctuation">.</span><span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">exception</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">id</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

    <span class="token keyword">return</span> <span class="token punctuation">(</span><span class="token keyword">new</span> <span class="token class-name">SlackMessage</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">error<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">content<span class="token punctuation">(</span></span><span class="token string">'Whoops! Something went wrong.'</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">attachment<span class="token punctuation">(</span></span><span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$attachment</span><span class="token punctuation">)</span> <span class="token keyword">use</span> <span class="token punctuation">(</span><span class="token variable">$url</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
                    <span class="token variable">$attachment</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">title<span class="token punctuation">(</span></span><span class="token string">'Exception: File Not Found'</span><span class="token punctuation">,</span> <span class="token variable">$url</span><span class="token punctuation">)</span>
                               <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">content<span class="token punctuation">(</span></span><span class="token string">'File [background.jpg] was not found.'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
                <span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p>The example above will generate a Slack message that looks like the following:</p>
	<img src="https://laravel.com/assets/img/basic-slack-attachment.png">
	<p>Attachments also allow you to specify an array of data that should be presented to the user. The given data will be presented in a table-style format for easy reading:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Get the Slack representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return SlackMessage
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">toSlack<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token variable">$url</span> <span class="token operator">=</span> <span class="token function">url<span class="token punctuation">(</span></span><span class="token string">'/invoices/'</span><span class="token punctuation">.</span><span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">invoice</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">id</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

    <span class="token keyword">return</span> <span class="token punctuation">(</span><span class="token keyword">new</span> <span class="token class-name">SlackMessage</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">success<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">content<span class="token punctuation">(</span></span><span class="token string">'One of your invoices has been paid!'</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">attachment<span class="token punctuation">(</span></span><span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$attachment</span><span class="token punctuation">)</span> <span class="token keyword">use</span> <span class="token punctuation">(</span><span class="token variable">$url</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
                    <span class="token variable">$attachment</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">title<span class="token punctuation">(</span></span><span class="token string">'Invoice 1322'</span><span class="token punctuation">,</span> <span class="token variable">$url</span><span class="token punctuation">)</span>
                               <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">fields<span class="token punctuation">(</span></span><span class="token punctuation">[</span>
                                    <span class="token string">'Title'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'Server Expenses'</span><span class="token punctuation">,</span>
                                    <span class="token string">'Amount'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'$1,234'</span><span class="token punctuation">,</span>
                                    <span class="token string">'Via'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'American Express'</span><span class="token punctuation">,</span>
                                    <span class="token string">'Was Overdue'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">':-1:'</span><span class="token punctuation">,</span>
                                <span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
                <span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p>The example above will create a Slack message that looks like the following:</p>
	<img src="https://laravel.com/assets/img/slack-fields-attachment.png">
	<h4>Markdown Attachment Content</h4>
	<p>If some of your attachment fields contain Markdown, you may use the <code class=" language-php">markdown</code> method to instruct Slack to parse and display the given attachment fields as Markdown formatted text. The values accepted by this method are: <code class=" language-php">pretext</code>, <code class=" language-php">text</code>, and / or <code class=" language-php">fields</code>. For more information about Slack attachment formatting, check out the <a href="https://api.slack.com/docs/message-formatting#message_formatting">Slack API documentation</a>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Get the Slack representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return SlackMessage
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">toSlack<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token variable">$url</span> <span class="token operator">=</span> <span class="token function">url<span class="token punctuation">(</span></span><span class="token string">'/exceptions/'</span><span class="token punctuation">.</span><span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">exception</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">id</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

    <span class="token keyword">return</span> <span class="token punctuation">(</span><span class="token keyword">new</span> <span class="token class-name">SlackMessage</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">error<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">content<span class="token punctuation">(</span></span><span class="token string">'Whoops! Something went wrong.'</span><span class="token punctuation">)</span>
                <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">attachment<span class="token punctuation">(</span></span><span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$attachment</span><span class="token punctuation">)</span> <span class="token keyword">use</span> <span class="token punctuation">(</span><span class="token variable">$url</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
                    <span class="token variable">$attachment</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">title<span class="token punctuation">(</span></span><span class="token string">'Exception: File Not Found'</span><span class="token punctuation">,</span> <span class="token variable">$url</span><span class="token punctuation">)</span>
                               <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">content<span class="token punctuation">(</span></span><span class="token string">'File [background.jpg] was *not found*.'</span><span class="token punctuation">)</span>
                               <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">markdown<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'text'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
                <span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="routing-slack-notifications"></a></p>
	<h3>Routing Slack Notifications</h3>
	<p>To route Slack notifications to the proper location, define a <code class=" language-php">routeNotificationForSlack</code> method on your notifiable entity. This should return the webhook URL to which the notification should be delivered. Webhook URLs may be generated by adding an "Incoming Webhook" service to your Slack team:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Notifications<span class="token punctuation">\</span>Notifiable</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Foundation<span class="token punctuation">\</span>Auth<span class="token punctuation">\</span>User</span> <span class="token keyword">as</span> Authenticatable<span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">User</span> <span class="token keyword">extends</span> <span class="token class-name">Authenticatable</span>
<span class="token punctuation">{</span>
    <span class="token keyword">use</span> <span class="token package">Notifiable</span><span class="token punctuation">;</span>

    <span class="token comment" spellcheck="true">/**
     * Route notifications for the Slack channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">routeNotificationForSlack<span class="token punctuation">(</span></span><span class="token variable">$notification</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token keyword">return</span> <span class="token string">'https://hooks.slack.com/services/...'</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p><a name="localizing-notifications"></a></p>
	<h2><a href="#localizing-notifications">Localizing Notifications</a></h2>
	<p>Laravel allows you to send notifications in a locale other than the current language, and will even remember this locale if the notification is queued.</p>
	<p>To accomplish this, the <code class=" language-php">Illuminate\<span class="token package">Notifications<span class="token punctuation">\</span>Notification</span></code> class offers a <code class=" language-php">locale</code> method to set the desired language. The application will change into this locale when the notification is being formatted and then revert back to the previous locale when formatting is complete:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">notify<span class="token punctuation">(</span></span><span class="token punctuation">(</span><span class="token keyword">new</span> <span class="token class-name">InvoicePaid</span><span class="token punctuation">(</span><span class="token variable">$invoice</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">locale<span class="token punctuation">(</span></span><span class="token string">'es'</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>Localization of multiple notifiable entries may also be achieved via the <code class=" language-php">Notification</code> facade:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Notification<span class="token punctuation">::</span></span><span class="token function">locale<span class="token punctuation">(</span></span><span class="token string">'es'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">send<span class="token punctuation">(</span></span><span class="token variable">$users</span><span class="token punctuation">,</span> <span class="token keyword">new</span> <span class="token class-name">InvoicePaid</span><span class="token punctuation">(</span><span class="token variable">$invoice</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h3>User Preferred Locales</h3>
	<p>Sometimes, applications store each user's preferred locale. By implementing the <code class=" language-php">HasLocalePreference</code> contract on your notifiable model, you may instruct Laravel to use this stored locale when sending a notification:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Contracts<span class="token punctuation">\</span>Translation<span class="token punctuation">\</span>HasLocalePreference</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">User</span> <span class="token keyword">extends</span> <span class="token class-name">Model</span> <span class="token keyword">implements</span> <span class="token class-name">HasLocalePreference</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Get the user's preferred locale.
     *
     * @return string
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">preferredLocale<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token keyword">return</span> <span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">locale</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p>Once you have implemented the interface, Laravel will automatically use the preferred locale when sending notifications and mailables to the model. Therefore, there is no need to call the <code class=" language-php">locale</code> method when using this interface:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">notify<span class="token punctuation">(</span></span><span class="token keyword">new</span> <span class="token class-name">InvoicePaid</span><span class="token punctuation">(</span><span class="token variable">$invoice</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="notification-events"></a></p>
	<h2><a href="#notification-events">Notification Events</a></h2>
	<p>When a notification is sent, the <code class=" language-php">Illuminate\<span class="token package">Notifications<span class="token punctuation">\</span>Events<span class="token punctuation">\</span>NotificationSent</span></code> event is fired by the notification system. This contains the "notifiable" entity and the notification instance itself. You may register listeners for this event in your <code class=" language-php">EventServiceProvider</code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * The event listener mappings for the application.
 *
 * @var array
 */</span>
<span class="token keyword">protected</span> <span class="token variable">$listen</span> <span class="token operator">=</span> <span class="token punctuation">[</span>
    <span class="token string">'Illuminate\Notifications\Events\NotificationSent'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'App\Listeners\LogNotification'</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">;</span></code></pre>
	<blockquote class="has-icon">
		<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> After registering listeners in your <code class=" language-php">EventServiceProvider</code>, use the <code class=" language-php">event<span class="token punctuation">:</span>generate</code> Artisan command to quickly generate listener classes.</p>
	</blockquote>
	<p>Within an event listener, you may access the <code class=" language-php">notifiable</code>, <code class=" language-php">notification</code>, and <code class=" language-php">channel</code> properties on the event to learn more about the notification recipient or the notification itself:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Handle the event.
 *
 * @param  NotificationSent  $event
 * @return void
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">handle<span class="token punctuation">(</span></span>NotificationSent <span class="token variable">$event</span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> // $event-&gt;channel
</span>   <span class="token comment" spellcheck="true"> // $event-&gt;notifiable
</span>   <span class="token comment" spellcheck="true"> // $event-&gt;notification
</span><span class="token punctuation">}</span></code></pre>
	<p><a name="custom-channels"></a></p>
	<h2><a href="#custom-channels">Custom Channels</a></h2>
	<p>Laravel ships with a handful of notification channels, but you may want to write your own drivers to deliver notifications via other channels. Laravel makes it simple. To get started, define a class that contains a <code class=" language-php">send</code> method. The method should receive two arguments: a <code class=" language-php"><span class="token variable">$notifiable</span></code> and a <code class=" language-php"><span class="token variable">$notification</span></code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Channels</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Notifications<span class="token punctuation">\</span>Notification</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">VoiceChannel</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">send<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">,</span> Notification <span class="token variable">$notification</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token variable">$message</span> <span class="token operator">=</span> <span class="token variable">$notification</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">toVoice<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

       <span class="token comment" spellcheck="true"> // Send notification to the $notifiable instance...
</span>    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p>Once your notification channel class has been defined, you may return the class name from the <code class=" language-php">via</code> method of any of your notifications:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Notifications</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Bus<span class="token punctuation">\</span>Queueable</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Channels<span class="token punctuation">\</span>VoiceChannel</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Channels<span class="token punctuation">\</span>Messages<span class="token punctuation">\</span>VoiceMessage</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Notifications<span class="token punctuation">\</span>Notification</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Contracts<span class="token punctuation">\</span>Queue<span class="token punctuation">\</span>ShouldQueue</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">InvoicePaid</span> <span class="token keyword">extends</span> <span class="token class-name">Notification</span>
<span class="token punctuation">{</span>
    <span class="token keyword">use</span> <span class="token package">Queueable</span><span class="token punctuation">;</span>

    <span class="token comment" spellcheck="true">/**
     * Get the notification channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">via<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token keyword">return</span> <span class="token punctuation">[</span><span class="token scope">VoiceChannel<span class="token punctuation">::</span></span><span class="token keyword">class</span><span class="token punctuation">]</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>

    <span class="token comment" spellcheck="true">/**
     * Get the voice representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return VoiceMessage
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">toVoice<span class="token punctuation">(</span></span><span class="token variable">$notifiable</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
       <span class="token comment" spellcheck="true"> // ...
</span>    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
</article>