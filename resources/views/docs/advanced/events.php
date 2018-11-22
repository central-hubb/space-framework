<?php use App\Library\Framework\Component\Code; ?>

<article>
	<h1>Events</h1>
	<p>Space MVC's events provide a simple observer implementation, allowing you to subscribe and listen for various events that occur in your application. Event classes are typically stored in the app/Events directory, while their listeners are stored in app/Listeners. Don't worry if you don't see these directories in your application, since they will be created for you as you generate events and listeners using Artisan console commands.</p>
	<p>Events serve as a great way to decouple various aspects of your application, since a single event can have multiple listeners that do not depend on each other. For example, you may wish to send a Slack notification to your user each time an order has shipped. Instead of coupling your order processing code to your Slack notification code, you can raise an OrderShipped event, which a listener can receive and transform into a Slack notification.</p>
	<p><a name="registering-events-and-listeners"></a></p>
	<h2><a href="#registering-events-and-listeners">Registering Events &amp; Listeners</a></h2>
	<p>The EventServiceProvider included with your Space MVC application provides a convenient place to register all of your application's event listeners. The listen property contains an array of all events (keys) and their listeners (values). Of course, you may add as many events to this array as your application requires. For example, let's add a OrderShipped event:</p>
	<?php echo Code::getHtmlStatic('/**
 * The event listener mappings for the application.
 *
 * @var array
 */
protected $listen = [
    \'App\Events\OrderShipped\' =&gt; [
        \'App\Listeners\SendShipmentNotification\',
    ],
];'); ?>
	<p><a name="generating-events-and-listeners"></a></p>
	<h3>Generating Events &amp; Listeners</h3>
	<p>Of course, manually creating the files for each event and listener is cumbersome. Instead, add listeners and events to your EventServiceProvider and use the event:generate command. This command will generate any events or listeners that are listed in your EventServiceProvider. Of course, events and listeners that already exist will be left untouched:</p>
	<?php echo Code::getHtmlStatic('php artisan event:generate'); ?>
	<p><a name="manually-registering-events"></a></p>
	<h3>Manually Registering Events</h3>
	<p>Typically, events should be registered via the EventServiceProvider $listen array; however, you may also register Closure based events manually in the boot method of your EventServiceProvider:</p>
	<?php echo Code::getHtmlStatic('/**
 * Register any other events for your application.
 *
 * @return void
 */
public function boot()
{
    parent::boot();

    Event::listen(\'event.name\', function ($foo, $bar) {
        //
    });
}'); ?>
	<h4>Wildcard Event Listeners</h4>
	<p>You may even register listeners using the * as a wildcard parameter, allowing you to catch multiple events on the same listener. Wildcard listeners receive the event name as their first argument, and the entire event data array as their second argument:</p>
	<?php echo Code::getHtmlStatic('Event::listen(\'event.*\', function ($eventName, array $data) {
    //
});'); ?>
	<p><a name="defining-events"></a></p>
	<h2><a href="#defining-events">Defining Events</a></h2>
	<p>An event class is a data container which holds the information related to the event. For example, let's assume our generated OrderShipped event receives an <a href="/docs/5.7/eloquent">Eloquent ORM</a> object:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Events;

use App\Order;
use Illuminate\Queue\SerializesModels;

class OrderShipped
{
    use SerializesModels;

    public $order;

    /**
     * Create a new event instance.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this-&gt;order = $order;
    }
}'); ?>
	<p>As you can see, this event class contains no logic. It is a container for the Order instance that was purchased. The SerializesModels trait used by the event will gracefully serialize any Eloquent models if the event object is serialized using PHP's serialize function.</p>
	<p><a name="defining-listeners"></a></p>
	<h2><a href="#defining-listeners">Defining Listeners</a></h2>
	<p>Next, let's take a look at the listener for our example event. Event listeners receive the event instance in their handle method. The event:generate command will automatically import the proper event class and type-hint the event on the handle method. Within the handle method, you may perform any actions necessary to respond to the event:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Listeners;

use App\Events\OrderShipped;

class SendShipmentNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderShipped  $event
     * @return void
     */
    public function handle(OrderShipped $event)
    {
        // Access the order using $event-&gt;order...
    }
}'); ?>
	<p>Your event listeners may also type-hint any dependencies they need on their constructors. All event listeners are resolved via the Space MVC <a href="/docs/5.7/container">service container</a>, so dependencies will be injected automatically.</p>
	<h4>Stopping The Propagation Of An Event</h4>
	<p>Sometimes, you may wish to stop the propagation of an event to other listeners. You may do so by returning false from your listener's handle method.</p>
	<p><a name="queued-event-listeners"></a></p>
	<h2><a href="#queued-event-listeners">Queued Event Listeners</a></h2>
	<p>Queueing listeners can be beneficial if your listener is going to perform a slow task such as sending an e-mail or making an HTTP request. Before getting started with queued listeners, make sure to <a href="/docs/5.7/queues">configure your queue</a> and start a queue listener on your server or local development environment.</p>
	<p>To specify that a listener should be queued, add the ShouldQueue interface to the listener class. Listeners generated by the event:generate Artisan command already have this interface imported into the current namespace, so you can use it immediately:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Listeners;

use App\Events\OrderShipped;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendShipmentNotification implements ShouldQueue
{
    //
}'); ?>
	<p>That's it! Now, when this listener is called for an event, it will be automatically queued by the event dispatcher using Space MVC's <a href="/docs/5.7/queues">queue system</a>. If no exceptions are thrown when the listener is executed by the queue, the queued job will automatically be deleted after it has finished processing.</p>
	<h4>Customizing The Queue Connection &amp; Queue Name</h4>
	<p>If you would like to customize the queue connection and queue name used by an event listener, you may define $connection and $queue properties on your listener class:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Listeners;

use App\Events\OrderShipped;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendShipmentNotification implements ShouldQueue
{
    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = \'sqs\';

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = \'listeners\';
}'); ?>
	<p><a name="manually-accessing-the-queue"></a></p>
	<h3>Manually Accessing The Queue</h3>
	<p>If you need to manually access the listener's underlying queue job's delete and release methods, you may do so using the Illuminate\Queue\InteractsWithQueue trait. This trait is imported by default on generated listeners and provides access to these methods:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Listeners;

use App\Events\OrderShipped;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendShipmentNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderShipped  $event
     * @return void
     */
    public function handle(OrderShipped $event)
    {
        if (true) {
            $this-&gt;release(30);
        }
    }
}'); ?>
	<p><a name="handling-failed-jobs"></a></p>
	<h3>Handling Failed Jobs</h3>
	<p>Sometimes your queued event listeners may fail. If queued listener exceeds the maximum number of attempts as defined by your queue worker, the failed method will be called on your listener. The failed method receives the event instance and the exception that caused the failure:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Listeners;

use App\Events\OrderShipped;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendShipmentNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderShipped  $event
     * @return void
     */
    public function handle(OrderShipped $event)
    {
        //
    }

    /**
     * Handle a job failure.
     *
     * @param  \App\Events\OrderShipped  $event
     * @param  \Exception  $exception
     * @return void
     */
    public function failed(OrderShipped $event, $exception)
    {
        //
    }
}'); ?>
	<p><a name="dispatching-events"></a></p>
	<h2><a href="#dispatching-events">Dispatching Events</a></h2>
	<p>To dispatch an event, you may pass an instance of the event to the event helper. The helper will dispatch the event to all of its registered listeners. Since the event helper is globally available, you may call it from anywhere in your application:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Http\Controllers;

use App\Order;
use App\Events\OrderShipped;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Ship the given order.
     *
     * @param  int  $orderId
     * @return Response
     */
    public function ship($orderId)
    {
        $order = Order::findOrFail($orderId);

        // Order shipment logic...

        event(new OrderShipped($order));
    }
}'); ?>
	<p>When testing, it can be helpful to assert that certain events were dispatched without actually triggering their listeners. Space MVC's <a href="/docs/5.7/mocking#event-fake">built-in testing helpers</a> makes it a cinch.</p>
	<p><a name="event-subscribers"></a></p>
	<h2><a href="#event-subscribers">Event Subscribers</a></h2>
	<p><a name="writing-event-subscribers"></a></p>
	<h3>Writing Event Subscribers</h3>
	<p>Event subscribers are classes that may subscribe to multiple events from within the class itself, allowing you to define several event handlers within a single class. Subscribers should define a subscribe method, which will be passed an event dispatcher instance. You may call the listen method on the given dispatcher to register event listeners:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Listeners;

class UserEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function onUserLogin($event) {}

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event) {}

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events-&gt;listen(
            \'Illuminate\Auth\Events\Login\',
            \'App\Listeners\UserEventSubscriber@onUserLogin\'
        );

        $events-&gt;listen(
            \'Illuminate\Auth\Events\Logout\',
            \'App\Listeners\UserEventSubscriber@onUserLogout\'
        );
    }
}'); ?>
	<p><a name="registering-event-subscribers"></a></p>
	<h3>Registering Event Subscribers</h3>
	<p>After writing the subscriber, you are ready to register it with the event dispatcher. You may register subscribers using the $subscribe property on the EventServiceProvider. For example, let's add the UserEventSubscriber to the list:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        \'App\Listeners\UserEventSubscriber\',
    ];
}'); ?>
</article>