<?php use App\Library\Framework\Component\Code; ?>

<article>
	<h1>Broadcasting</h1>
	<ul>
		<li><a href="#introduction">Introduction</a>
			<ul>
				<li><a href="#configuration">Configuration</a></li>
				<li><a href="#driver-prerequisites">Driver Prerequisites</a></li>
			</ul></li>
		<li><a href="#concept-overview">Concept Overview</a>
			<ul>
				<li><a href="#using-example-application">Using An Example Application</a></li>
			</ul></li>
		<li><a href="#defining-broadcast-events">Defining Broadcast Events</a>
			<ul>
				<li><a href="#broadcast-name">Broadcast Name</a></li>
				<li><a href="#broadcast-data">Broadcast Data</a></li>
				<li><a href="#broadcast-queue">Broadcast Queue</a></li>
				<li><a href="#broadcast-conditions">Broadcast Conditions</a></li>
			</ul></li>
		<li><a href="#authorizing-channels">Authorizing Channels</a>
			<ul>
				<li><a href="#defining-authorization-routes">Defining Authorization Routes</a></li>
				<li><a href="#defining-authorization-callbacks">Defining Authorization Callbacks</a></li>
				<li><a href="#defining-channel-classes">Defining Channel Classes</a></li>
			</ul></li>
		<li><a href="#broadcasting-events">Broadcasting Events</a>
			<ul>
				<li><a href="#only-to-others">Only To Others</a></li>
			</ul></li>
		<li><a href="#receiving-broadcasts">Receiving Broadcasts</a>
			<ul>
				<li><a href="#installing-Space MVC-echo">Installing Space MVC Echo</a></li>
				<li><a href="#listening-for-events">Listening For Events</a></li>
				<li><a href="#leaving-a-channel">Leaving A Channel</a></li>
				<li><a href="#namespaces">Namespaces</a></li>
			</ul></li>
		<li><a href="#presence-channels">Presence Channels</a>
			<ul>
				<li><a href="#authorizing-presence-channels">Authorizing Presence Channels</a></li>
				<li><a href="#joining-presence-channels">Joining Presence Channels</a></li>
				<li><a href="#broadcasting-to-presence-channels">Broadcasting To Presence Channels</a></li>
			</ul></li>
		<li><a href="#client-events">Client Events</a></li>
		<li><a href="#notifications">Notifications</a></li>
	</ul>
	<p><a name="introduction"></a></p>
	<h2><a href="#introduction">Introduction</a></h2>
	<p>In many modern web applications, WebSockets are used to implement realtime, live-updating user interfaces. When some data is updated on the server, a message is typically sent over a WebSocket connection to be handled by the client. This provides a more robust, efficient alternative to continually polling your application for changes.</p>
	<p>To assist you in building these types of applications, Space MVC makes it easy to "broadcast" your <a href="/docs/5.7/events">events</a> over a WebSocket connection. Broadcasting your Space MVC events allows you to share the same event names between your server-side code and your client-side JavaScript application.</p>
	<p>Before diving into event broadcasting, make sure you have read all of the documentation regarding Space MVC <a href="/docs/5.7/events">events and listeners</a>.</p>
	<p><a name="configuration"></a></p>
	<h3>Configuration</h3>
	<p>All of your application's event broadcasting configuration is stored in the config/broadcasting.php configuration file. Space MVC supports several broadcast drivers out of the box: <a href="https://pusher.com">Pusher</a>, <a href="/docs/5.7/redis">Redis</a>, and a log driver for local development and debugging. Additionally, a null driver is included which allows you to totally disable broadcasting. A configuration example is included for each of these drivers in the config/broadcasting.php configuration file.</p>
	<h4>Broadcast Service Provider</h4>
	<p>Before broadcasting any events, you will first need to register the App\Providers\BroadcastServiceProvider. In fresh Space MVC applications, you only need to uncomment this provider in the providers array of your config/app.php configuration file. This provider will allow you to register the broadcast authorization routes and callbacks.</p>
	<h4>CSRF Token</h4>
	<p><a href="#installing-Space MVC-echo">Space MVC Echo</a> will need access to the current session's CSRF token. You should verify that your application's head HTML element defines a meta tag containing the CSRF token:</p>
	<?php echo Code::getHtmlStatic('&lt;meta name="csrf-token" content="{{ csrf_token() }}"&gt;'); ?>
	<p><a name="driver-prerequisites"></a></p>
	<h3>Driver Prerequisites</h3>
	<h4>Pusher</h4>
	<p>If you are broadcasting your events over <a href="https://pusher.com">Pusher</a>, you should install the Pusher PHP SDK using the Composer package manager:</p>
	<?php echo Code::getHtmlStatic('composer require pusher/pusher-php-server "~3.0"'); ?>
	<p>Next, you should configure your Pusher credentials in the config/broadcasting.php configuration file. An example Pusher configuration is already included in this file, allowing you to quickly specify your Pusher key, secret, and application ID. The config/broadcasting.php file's pusher configuration also allows you to specify additional options that are supported by Pusher, such as the cluster:</p>
	<?php echo Code::getHtmlStatic('\'options\' =&gt; [
    \'cluster\' =&gt; \'eu\',
    \'encrypted\' =&gt; true
],'); ?>
	<p>When using Pusher and <a href="#installing-Space MVC-echo">Space MVC Echo</a>, you should specify pusher as your desired broadcaster when instantiating the Echo instance in your resources/js/bootstrap.js file:</p>
	<?php echo Code::getHtmlStatic('import Echo from "Space MVC-echo"

window.Pusher = require(\'pusher-js\');

window.Echo = new Echo({
    broadcaster: \'pusher\',
    key: \'your-pusher-key\'
});'); ?>
	<h4>Redis</h4>
	<p>If you are using the Redis broadcaster, you should install the Predis library:</p>
	<?php echo Code::getHtmlStatic('composer require predis/predis'); ?>
	<p>The Redis broadcaster will broadcast messages using Redis' pub / sub feature; however, you will need to pair this with a WebSocket server that can receive the messages from Redis and broadcast them to your WebSocket channels.</p>
	<p>When the Redis broadcaster publishes an event, it will be published on the event's specified channel names and the payload will be a JSON encoded string containing the event name, a data payload, and the user that generated the event's socket ID (if applicable).</p>
	<h4>Socket.IO</h4>
	<p>If you are going to pair the Redis broadcaster with a Socket.IO server, you will need to include the Socket.IO JavaScript client library in your application. You may install it via the NPM package manager:</p>
	<?php echo Code::getHtmlStatic('npm install --save socket.io-client'); ?>
	<p>Next, you will need to instantiate Echo with the socket.io connector and a host.</p>
	<?php echo Code::getHtmlStatic('import Echo from "Space MVC-echo"

window.io = require(\'socket.io-client\');

window.Echo = new Echo({
    broadcaster: \'socket.io\',
    host: window.location.hostname + \':6001\'
});'); ?>
	<p>Finally, you will need to run a compatible Socket.IO server. Space MVC does not include a Socket.IO server implementation; however, a community driven Socket.IO server is currently maintained at the <a href="https://github.com/tlaverdure/Space MVC-echo-server">tlaverdure/Space MVC-echo-server</a> GitHub repository.</p>
	<h4>Queue Prerequisites</h4>
	<p>Before broadcasting events, you will also need to configure and run a <a href="/docs/5.7/queues">queue listener</a>. All event broadcasting is done via queued jobs so that the response time of your application is not seriously affected.</p>
	<p><a name="concept-overview"></a></p>
	<h2><a href="#concept-overview">Concept Overview</a></h2>
	<p>Space MVC's event broadcasting allows you to broadcast your server-side Space MVC events to your client-side JavaScript application using a driver-based approach to WebSockets. Currently, Space MVC ships with <a href="https://pusher.com">Pusher</a> and Redis drivers. The events may be easily consumed on the client-side using the <a href="#installing-Space MVC-echo">Space MVC Echo</a> Javascript package.</p>
	<p>Events are broadcast over "channels", which may be specified as public or private. Any visitor to your application may subscribe to a public channel without any authentication or authorization; however, in order to subscribe to a private channel, a user must be authenticated and authorized to listen on that channel.</p>
	<p><a name="using-example-application"></a></p>
	<h3>Using An Example Application</h3>
	<p>Before diving into each component of event broadcasting, let's take a high level overview using an e-commerce store as an example. We won't discuss the details of configuring <a href="https://pusher.com">Pusher</a> or <a href="#installing-Space MVC-echo">Space MVC Echo</a> since that will be discussed in detail in other sections of this documentation.</p>
	<p>In our application, let's assume we have a page that allows users to view the shipping status for their orders. Let's also assume that a ShippingStatusUpdated event is fired when a shipping status update is processed by the application:</p>
	<?php echo Code::getHtmlStatic('event(new ShippingStatusUpdated($update));'); ?>
	<h4>The ShouldBroadcast Interface</h4>
	<p>When a user is viewing one of their orders, we don't want them to have to refresh the page to view status updates. Instead, we want to broadcast the updates to the application as they are created. So, we need to mark the ShippingStatusUpdated event with the ShouldBroadcast interface. This will instruct Space MVC to broadcast the event when it is fired:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ShippingStatusUpdated implements ShouldBroadcast
{
    /**
     * Information about the shipping status update.
     *
     * @var string
     */
    public $update;
}'); ?>
	<p>The ShouldBroadcast interface requires our event to define a broadcastOn method. This method is responsible for returning the channels that the event should broadcast on. An empty stub of this method is already defined on generated event classes, so we only need to fill in its details. We only want the creator of the order to be able to view status updates, so we will broadcast the event on a private channel that is tied to the order:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the channels the event should broadcast on.
 *
 * @return array
 */
public function broadcastOn()
{
    return new PrivateChannel(\'order.\'.$this-&gt;update-&gt;order_id);
}'); ?>
	<h4>Authorizing Channels</h4>
	<p>Remember, users must be authorized to listen on private channels. We may define our channel authorization rules in the routes/channels.php file. In this example, we need to verify that any user attempting to listen on the private order.1 channel is actually the creator of the order:</p>
	<?php echo Code::getHtmlStatic('Broadcast::channel(\'order.{orderId}\', function ($user, $orderId) {
    return $user-&gt;id === Order::findOrNew($orderId)-&gt;user_id;
});'); ?>
	<p>The channel method accepts two arguments: the name of the channel and a callback which returns true or false indicating whether the user is authorized to listen on the channel.</p>
	<p>All authorization callbacks receive the currently authenticated user as their first argument and any additional wildcard parameters as their subsequent arguments. In this example, we are using the {orderId} placeholder to indicate that the "ID" portion of the channel name is a wildcard.</p>
	<h4>Listening For Event Broadcasts</h4>
	<p>Next, all that remains is to listen for the event in our JavaScript application. We can do this using Space MVC Echo. First, we'll use the private method to subscribe to the private channel. Then, we may use the listen method to listen for the ShippingStatusUpdated event. By default, all of the event's public properties will be included on the broadcast event:</p>
	<?php echo Code::getHtmlStatic('Echo.private(`order.${orderId}`)
    .listen(\'ShippingStatusUpdated\', (e) =&gt; {
        console.log(e.update);
    });'); ?>
	<p><a name="defining-broadcast-events"></a></p>
	<h2><a href="#defining-broadcast-events">Defining Broadcast Events</a></h2>
	<p>To inform Space MVC that a given event should be broadcast, implement the Illuminate\Contracts\Broadcasting\ShouldBroadcast interface on the event class. This interface is already imported into all event classes generated by the framework so you may easily add it to any of your events.</p>
	<p>The ShouldBroadcast interface requires you to implement a single method: broadcastOn. The broadcastOn method should return a channel or array of channels that the event should broadcast on. The channels should be instances of Channel, PrivateChannel, or PresenceChannel. Instances of Channel represent public channels that any user may subscribe to, while PrivateChannels and PresenceChannels represent private channels that require <a href="#authorizing-channels">channel authorization</a>:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ServerCreated implements ShouldBroadcast
{
    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this-&gt;user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel(\'user.\'.$this-&gt;user-&gt;id);
    }
}'); ?>
	<p>Then, you only need to <a href="/docs/5.7/events">fire the event</a> as you normally would. Once the event has been fired, a <a href="/docs/5.7/queues">queued job</a> will automatically broadcast the event over your specified broadcast driver.</p>
	<p><a name="broadcast-name"></a></p>
	<h3>Broadcast Name</h3>
	<p>By default, Space MVC will broadcast the event using the event's class name. However, you may customize the broadcast name by defining a broadcastAs method on the event:</p>
	<?php echo Code::getHtmlStatic('/**
 * The event\'s broadcast name.
 *
 * @return string
 */
public function broadcastAs()
{
    return \'server.created\';
}'); ?>
	<p>If you customize the broadcast name using the broadcastAs method, you should make sure to register your listener with a leading . character. This will instruct Echo to not prepend the application's namespace to the event:</p>
	<?php echo Code::getHtmlStatic('.listen(\'.server.created\', function (e) {
    ....
});'); ?>
	<p><a name="broadcast-data"></a></p>
	<h3>Broadcast Data</h3>
	<p>When an event is broadcast, all of its public properties are automatically serialized and broadcast as the event's payload, allowing you to access any of its public data from your JavaScript application. So, for example, if your event has a single public $user property that contains an Eloquent model, the event's broadcast payload would be:</p>
	<?php echo Code::getHtmlStatic('{
    "user": {
        "id": 1,
        "name": "Patrick Stewart"
        ...
    }
}'); ?>
	<p>However, if you wish to have more fine-grained control over your broadcast payload, you may add a broadcastWith method to your event. This method should return the array of data that you wish to broadcast as the event payload:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the data to broadcast.
 *
 * @return array
 */
public function broadcastWith()
{
    return [\'id\' =&gt; $this-&gt;user-&gt;id];
}'); ?>
	<p><a name="broadcast-queue"></a></p>
	<h3>Broadcast Queue</h3>
	<p>By default, each broadcast event is placed on the default queue for the default queue connection specified in your queue.php configuration file. You may customize the queue used by the broadcaster by defining a broadcastQueue property on your event class. This property should specify the name of the queue you wish to use when broadcasting:</p>
	<?php echo Code::getHtmlStatic('/**
 * The name of the queue on which to place the event.
 *
 * @var string
 */
public $broadcastQueue = \'your-queue-name\';'); ?>
	<p>If you want to broadcast your event using the sync queue instead of the default queue driver, you can implement the ShouldBroadcastNow interface instead of ShouldBroadcast:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class ShippingStatusUpdated implements ShouldBroadcastNow
{
    //
}'); ?>
	<p><a name="broadcast-conditions"></a></p>
	<h3>Broadcast Conditions</h3>
	<p>Sometimes you want to broadcast your event only if a given condition is true. You may define these conditions by adding a broadcastWhen method to your event class:</p>
	<?php echo Code::getHtmlStatic('/**
 * Determine if this event should broadcast.
 *
 * @return bool
 */
public function broadcastWhen()
{
    return $this-&gt;value &gt; 100;
}'); ?>
	<p><a name="authorizing-channels"></a></p>
	<h2><a href="#authorizing-channels">Authorizing Channels</a></h2>
	<p>Private channels require you to authorize that the currently authenticated user can actually listen on the channel. This is accomplished by making an HTTP request to your Space MVC application with the channel name and allowing your application to determine if the user can listen on that channel. When using <a href="#installing-Space MVC-echo">Space MVC Echo</a>, the HTTP request to authorize subscriptions to private channels will be made automatically; however, you do need to define the proper routes to respond to these requests.</p>
	<p><a name="defining-authorization-routes"></a></p>
	<h3>Defining Authorization Routes</h3>
	<p>Thankfully, Space MVC makes it easy to define the routes to respond to channel authorization requests. In the BroadcastServiceProvider included with your Space MVC application, you will see a call to the Broadcast::routes method. This method will register the /broadcasting/auth route to handle authorization requests:</p>
	<?php echo Code::getHtmlStatic('Broadcast::routes();'); ?>
	<p>The Broadcast::routes method will automatically place its routes within the web middleware group; however, you may pass an array of route attributes to the method if you would like to customize the assigned attributes:</p>
	<?php echo Code::getHtmlStatic('Broadcast::routes($attributes);'); ?>
	<h4>Customizing The Authorization Endpoint</h4>
	<p>By default, Echo will use the /broadcasting/auth endpoint to authorize channel access. However, you may specify your own authorization endpoint by passing the authEndpoint configuration option to your Echo instance:</p>
	<?php echo Code::getHtmlStatic('window.Echo = new Echo({
    broadcaster: \'pusher\',
    key: \'your-pusher-key\',
    authEndpoint: \'/custom/endpoint/auth\'
});'); ?>
	<p><a name="defining-authorization-callbacks"></a></p>
	<h3>Defining Authorization Callbacks</h3>
	<p>Next, we need to define the logic that will actually perform the channel authorization. This is done in the routes/channels.php file that is included with your application. In this file, you may use the Broadcast::channel method to register channel authorization callbacks:</p>
	<?php echo Code::getHtmlStatic('Broadcast::channel(\'order.{orderId}\', function ($user, $orderId) {
    return $user-&gt;id === Order::findOrNew($orderId)-&gt;user_id;
});'); ?>
	<p>The channel method accepts two arguments: the name of the channel and a callback which returns true or false indicating whether the user is authorized to listen on the channel.</p>
	<p>All authorization callbacks receive the currently authenticated user as their first argument and any additional wildcard parameters as their subsequent arguments. In this example, we are using the {orderId} placeholder to indicate that the "ID" portion of the channel name is a wildcard.</p>
	<h4>Authorization Callback Model Binding</h4>
	<p>Just like HTTP routes, channel routes may also take advantage of implicit and explicit <a href="/docs/5.7/routing#route-model-binding">route model binding</a>. For example, instead of receiving the string or numeric order ID, you may request an actual Order model instance:</p>
	<?php echo Code::getHtmlStatic('use App\Order;

Broadcast::channel(\'order.{order}\', function ($user, Order $order) {
    return $user-&gt;id === $order-&gt;user_id;
});'); ?>
	<p><a name="defining-channel-classes"></a></p>
	<h3>Defining Channel Classes</h3>
	<p>If your application is consuming many different channels, your routes/channels.php file could become bulky. So, instead of using Closures to authorize channels, you may use channel classes. To generate a channel class, use the make:channel Artisan command. This command will place a new channel class in the App/Broadcasting directory.</p>
	<?php echo Code::getHtmlStatic('php artisan make:channel OrderChannel'); ?>
	<p>Next, register your channel in your routes/channels.php file:</p>
	<?php echo Code::getHtmlStatic('use App\Broadcasting\OrderChannel;

Broadcast::channel(\'order.{order}\', OrderChannel::class);'); ?>
	<p>Finally, you may place the authorization logic for your channel in the channel class' join method. This join method will house the same logic you would have typically placed in your channel authorization Closure. Of course, you may also take advantage of channel model binding:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Broadcasting;

use App\User;
use App\Order;

class OrderChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user\'s access to the channel.
     *
     * @param  \App\User  $user
     * @param  \App\Order  $order
     * @return array|bool
     */
    public function join(User $user, Order $order)
    {
        return $user-&gt;id === $order-&gt;user_id;
    }
}'); ?>
	<p>Like many other classes in Space MVC, channel classes will automatically be resolved by the <a href="/docs/5.7/container">service container</a>. So, you may type-hint any dependencies required by your channel in its constructor.</p>
	<p><a name="broadcasting-events"></a></p>
	<h2><a href="#broadcasting-events">Broadcasting Events</a></h2>
	<p>Once you have defined an event and marked it with the ShouldBroadcast interface, you only need to fire the event using the event function. The event dispatcher will notice that the event is marked with the ShouldBroadcast interface and will queue the event for broadcasting:</p>
	<?php echo Code::getHtmlStatic('event(new ShippingStatusUpdated($update));'); ?>
	<p><a name="only-to-others"></a></p>
	<h3>Only To Others</h3>
	<p>When building an application that utilizes event broadcasting, you may substitute the event function with the broadcast function. Like the event function, the broadcast function dispatches the event to your server-side listeners:</p>
	<?php echo Code::getHtmlStatic('broadcast(new ShippingStatusUpdated($update));'); ?>
	<p>However, the broadcast function also exposes the toOthers method which allows you to exclude the current user from the broadcast's recipients:</p>
	<?php echo Code::getHtmlStatic('broadcast(new ShippingStatusUpdated($update))-&gt;toOthers();'); ?>
	<p>To better understand when you may want to use the toOthers method, let's imagine a task list application where a user may create a new task by entering a task name. To create a task, your application might make a request to a /task end-point which broadcasts the task's creation and returns a JSON representation of the new task. When your JavaScript application receives the response from the end-point, it might directly insert the new task into its task list like so:</p>
	<?php echo Code::getHtmlStatic('axios.post(\'/task\', task)
    .then((response) =&gt; {
        this.tasks.push(response.data);
    });'); ?>
	<p>However, remember that we also broadcast the task's creation. If your JavaScript application is listening for this event in order to add tasks to the task list, you will have duplicate tasks in your list: one from the end-point and one from the broadcast. You may solve this by using the toOthers method to instruct the broadcaster to not broadcast the event to the current user.</p>
	<blockquote class="has-icon">
		<p><div class="flag"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="90px" height="90px" viewBox="0 0 90 90" enable-background="new 0 0 90 90" xml:space="preserve"><path fill="#FFFFFF" d="M45 0C20.1 0 0 20.1 0 45s20.1 45 45 45 45-20.1 45-45S69.9 0 45 0zM45 74.5c-3.6 0-6.5-2.9-6.5-6.5s2.9-6.5 6.5-6.5 6.5 2.9 6.5 6.5S48.6 74.5 45 74.5zM52.1 23.9l-2.5 29.6c0 2.5-2.1 4.6-4.6 4.6 -2.5 0-4.6-2.1-4.6-4.6l-2.5-29.6c-0.1-0.4-0.1-0.7-0.1-1.1 0-4 3.2-7.2 7.2-7.2 4 0 7.2 3.2 7.2 7.2C52.2 23.1 52.2 23.5 52.1 23.9z"></path></svg></div> Your event must use the Illuminate\Broadcasting\InteractsWithSockets trait in order to call the toOthers method.</p>
	</blockquote>
	<h4>Configuration</h4>
	<p>When you initialize a Space MVC Echo instance, a socket ID is assigned to the connection. If you are using <a href="https://vuejs.org">Vue</a> and <a href="https://github.com/mzabriskie/axios">Axios</a>, the socket ID will automatically be attached to every outgoing request as a X-Socket-ID header. Then, when you call the toOthers method, Space MVC will extract the socket ID from the header and instruct the broadcaster to not broadcast to any connections with that socket ID.</p>
	<p>If you are not using Vue and Axios, you will need to manually configure your JavaScript application to send the X-Socket-ID header. You may retrieve the socket ID using the Echo.socketId method:</p>
	<?php echo Code::getHtmlStatic('var socketId = Echo.socketId();'); ?>
	<p><a name="receiving-broadcasts"></a></p>
	<h2><a href="#receiving-broadcasts">Receiving Broadcasts</a></h2>
	<p><a name="installing-Space MVC-echo"></a></p>
	<h3>Installing Space MVC Echo</h3>
	<p>Space MVC Echo is a JavaScript library that makes it painless to subscribe to channels and listen for events broadcast by Space MVC. You may install Echo via the NPM package manager. In this example, we will also install the pusher-js package since we will be using the Pusher broadcaster:</p>
	<?php echo Code::getHtmlStatic('npm install --save Space MVC-echo pusher-js'); ?>
	<p>Once Echo is installed, you are ready to create a fresh Echo instance in your application's JavaScript. A great place to do this is at the bottom of the resources/js/bootstrap.js file that is included with the Space MVC framework:</p>
	<?php echo Code::getHtmlStatic('import Echo from "Space MVC-echo"

window.Echo = new Echo({
    broadcaster: \'pusher\',
    key: \'your-pusher-key\'
});'); ?>
	<p>When creating an Echo instance that uses the pusher connector, you may also specify a cluster as well as whether the connection should be encrypted:</p>
	<?php echo Code::getHtmlStatic('window.Echo = new Echo({
    broadcaster: \'pusher\',
    key: \'your-pusher-key\',
    cluster: \'eu\',
    encrypted: true
});'); ?>
	<h4>Using An Existing Client Instance</h4>
	<p>If you already have a Pusher or Socket.io client instance that you would like Echo to utilize, you may pass it to Echo via the client configuration option:</p>
	<?php echo Code::getHtmlStatic('const client = require(\'pusher-js\');

window.Echo = new Echo({
    broadcaster: \'pusher\',
    key: \'your-pusher-key\',
    client: client
});'); ?>
	<p><a name="listening-for-events"></a></p>
	<h3>Listening For Events</h3>
	<p>Once you have installed and instantiated Echo, you are ready to start listening for event broadcasts. First, use the channel method to retrieve an instance of a channel, then call the listen method to listen for a specified event:</p>
	<?php echo Code::getHtmlStatic('Echo.channel(\'orders\')
    .listen(\'OrderShipped\', (e) =&gt; {
        console.log(e.order.name);
    });'); ?>
	<p>If you would like to listen for events on a private channel, use the private method instead. You may continue to chain calls to the listen method to listen for multiple events on a single channel:</p>
	<?php echo Code::getHtmlStatic('Echo.private(\'orders\')
    .listen(...)
    .listen(...)
    .listen(...);'); ?>
	<p><a name="leaving-a-channel"></a></p>
	<h3>Leaving A Channel</h3>
	<p>To leave a channel, you may call the leave method on your Echo instance:</p>
	<?php echo Code::getHtmlStatic('Echo.leave(\'orders\');'); ?>
	<p><a name="namespaces"></a></p>
	<h3>Namespaces</h3>
	<p>You may have noticed in the examples above that we did not specify the full namespace for the event classes. This is because Echo will automatically assume the events are located in the App\Events namespace. However, you may configure the root namespace when you instantiate Echo by passing a namespace configuration option:</p>
	<?php echo Code::getHtmlStatic('window.Echo = new Echo({
    broadcaster: \'pusher\',
    key: \'your-pusher-key\',
    namespace: \'App.Other.Namespace\'
});'); ?>
	<p>Alternatively, you may prefix event classes with a . when subscribing to them using Echo. This will allow you to always specify the fully-qualified class name:</p>
	<?php echo Code::getHtmlStatic('Echo.channel(\'orders\')
    .listen(\'.Namespace.Event.Class\', (e) =&gt; {
        //
    });'); ?>
	<p><a name="presence-channels"></a></p>
	<h2><a href="#presence-channels">Presence Channels</a></h2>
	<p>Presence channels build on the security of private channels while exposing the additional feature of awareness of who is subscribed to the channel. This makes it easy to build powerful, collaborative application features such as notifying users when another user is viewing the same page.</p>
	<p><a name="authorizing-presence-channels"></a></p>
	<h3>Authorizing Presence Channels</h3>
	<p>All presence channels are also private channels; therefore, users must be <a href="#authorizing-channels">authorized to access them</a>. However, when defining authorization callbacks for presence channels, you will not return true if the user is authorized to join the channel. Instead, you should return an array of data about the user.</p>
	<p>The data returned by the authorization callback will be made available to the presence channel event listeners in your JavaScript application. If the user is not authorized to join the presence channel, you should return false or null:</p>
	<?php echo Code::getHtmlStatic('Broadcast::channel(\'chat.{roomId}\', function ($user, $roomId) {
    if ($user-&gt;canJoinRoom($roomId)) {
        return [\'id\' =&gt; $user-&gt;id, \'name\' =&gt; $user-&gt;name];
    }
});'); ?>
	<p><a name="joining-presence-channels"></a></p>
	<h3>Joining Presence Channels</h3>
	<p>To join a presence channel, you may use Echo's join method. The join method will return a PresenceChannel implementation which, along with exposing the listen method, allows you to subscribe to the here, joining, and leaving events.</p>
	<?php echo Code::getHtmlStatic('Echo.join(`chat.${roomId}`)
    .here((users) =&gt; {
        //
    })
    .joining((user) =&gt; {
        console.log(user.name);
    })
    .leaving((user) =&gt; {
        console.log(user.name);
    });'); ?>
	<p>The here callback will be executed immediately once the channel is joined successfully, and will receive an array containing the user information for all of the other users currently subscribed to the channel. The joining method will be executed when a new user joins a channel, while the leaving method will be executed when a user leaves the channel.</p>
	<p><a name="broadcasting-to-presence-channels"></a></p>
	<h3>Broadcasting To Presence Channels</h3>
	<p>Presence channels may receive events just like public or private channels. Using the example of a chatroom, we may want to broadcast NewMessage events to the room's presence channel. To do so, we'll return an instance of PresenceChannel from the event's broadcastOn method:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the channels the event should broadcast on.
 *
 * @return Channel|array
 */
public function broadcastOn()
{
    return new PresenceChannel(\'room.\'.$this-&gt;message-&gt;room_id);
}'); ?>
	<p>Like public or private events, presence channel events may be broadcast using the broadcast function. As with other events, you may use the toOthers method to exclude the current user from receiving the broadcast:</p>
	<?php echo Code::getHtmlStatic('broadcast(new NewMessage($message));

broadcast(new NewMessage($message))-&gt;toOthers();'); ?>
	<p>You may listen for the join event via Echo's listen method:</p>
	<?php echo Code::getHtmlStatic('Echo.join(`chat.${roomId}`)
    .here(...)
    .joining(...)
    .leaving(...)
    .listen(\'NewMessage\', (e) =&gt; {
        //
    });'); ?>
	<p><a name="client-events"></a></p>
	<h2><a href="#client-events">Client Events</a></h2>
	<p>When using <a href="https://pusher.com">Pusher</a>, you must enable the "Client Events" option in the "App Settings" section of your <a href="https://dashboard.pusher.com/">application dashboard</a> in order to send client events.</p>
	<p>Sometimes you may wish to broadcast an event to other connected clients without hitting your Space MVC application at all. This can be particularly useful for things like "typing" notifications, where you want to alert users of your application that another user is typing a message on a given screen.</p>
	<p>To broadcast client events, you may use Echo's whisper method:</p>
	<?php echo Code::getHtmlStatic('Echo.private(\'chat\')
    .whisper(\'typing\', {
        name: this.user.name
    });'); ?>
	<p>To listen for client events, you may use the listenForWhisper method:</p>
	<?php echo Code::getHtmlStatic('Echo.private(\'chat\')
    .listenForWhisper(\'typing\', (e) =&gt; {
        console.log(e.name);
    });'); ?>
	<p><a name="notifications"></a></p>
	<h2><a href="#notifications">Notifications</a></h2>
	<p>By pairing event broadcasting with <a href="/docs/5.7/notifications">notifications</a>, your JavaScript application may receive new notifications as they occur without needing to refresh the page. First, be sure to read over the documentation on using <a href="/docs/5.7/notifications#broadcast-notifications">the broadcast notification channel</a>.</p>
	<p>Once you have configured a notification to use the broadcast channel, you may listen for the broadcast events using Echo's notification method. Remember, the channel name should match the class name of the entity receiving the notifications:</p>
	<?php echo Code::getHtmlStatic('Echo.private(`App.User.${userId}`)
    .notification((notification) =&gt; {
        console.log(notification.type);
    });'); ?>
	<p>In this example, all notifications sent to App\User instances via the broadcast channel would be received by the callback. A channel authorization callback for the App.User.{id} channel is included in the default BroadcastServiceProvider that ships with the Space MVC framework.</p>
</article>