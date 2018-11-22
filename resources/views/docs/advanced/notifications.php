<?php use App\Library\Framework\Component\Code; ?>

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
	<p>In addition to support for <a href="/docs/5.7/mail">sending email</a>, Space MVC provides support for sending notifications across a variety of delivery channels, including mail, SMS (via <a href="https://www.nexmo.com/">Nexmo</a>), and <a href="https://slack.com">Slack</a>. Notifications may also be stored in a database so they may be displayed in your web interface.</p>
	<p>Typically, notifications should be short, informational messages that notify users of something that occurred in your application. For example, if you are writing a billing application, you might send an "Invoice Paid" notification to your users via the email and SMS channels.</p>
	<p><a name="creating-notifications"></a></p>
	<h2><a href="#creating-notifications">Creating Notifications</a></h2>
	<p>In Space MVC, each notification is represented by a single class (typically stored in the app/Notifications directory). Don't worry if you don't see this directory in your application, it will be created for you when you run the make:notification Artisan command:</p>
	<?php echo Code::getHtmlStatic('php artisan make:notification InvoicePaid'); ?>
	<p>This command will place a fresh notification class in your app/Notifications directory. Each notification class contains a via method and a variable number of message building methods (such as toMail or toDatabase) that convert the notification to a message optimized for that particular channel.</p>
	<p><a name="sending-notifications"></a></p>
	<h2><a href="#sending-notifications">Sending Notifications</a></h2>
	<p><a name="using-the-notifiable-trait"></a></p>
	<h3>Using The Notifiable Trait</h3>
	<p>Notifications may be sent in two ways: using the notify method of the Notifiable trait or using the Notification <a href="/docs/5.7/facades">facade</a>. First, let's explore using the trait:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
}'); ?>
	<p>This trait is utilized by the default App\User model and contains one method that may be used to send notifications: notify. The notify method expects to receive a notification instance:</p>
	<?php echo Code::getHtmlStatic('use App\Notifications\InvoicePaid;

$user-&gt;notify(new InvoicePaid($invoice));'); ?>
	<p>Remember, you may use the Illuminate\Notifications\Notifiable trait on any of your models. You are not limited to only including it on your User model.</p>
	<p><a name="using-the-notification-facade"></a></p>
	<h3>Using The Notification Facade</h3>
	<p>Alternatively, you may send notifications via the Notification <a href="/docs/5.7/facades">facade</a>. This is useful primarily when you need to send a notification to multiple notifiable entities such as a collection of users. To send notifications using the facade, pass all of the notifiable entities and the notification instance to the send method:</p>
	<?php echo Code::getHtmlStatic('Notification::send($users, new InvoicePaid($invoice));'); ?>
	<p><a name="specifying-delivery-channels"></a></p>
	<h3>Specifying Delivery Channels</h3>
	<p>Every notification class has a via method that determines on which channels the notification will be delivered. Out of the box, notifications may be sent on the mail, database, broadcast, nexmo, and slack channels.</p>
	<p>If you would like to use other delivery channels such as Telegram or Pusher, check out the community driven <a href="http://Space MVC-notification-channels.com">Space MVC Notification Channels website</a>.</p>
	<p>The via method receives a $notifiable instance, which will be an instance of the class to which the notification is being sent. You may use $notifiable to determine which channels the notification should be delivered on:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the notification\'s delivery channels.
 *
 * @param  mixed  $notifiable
 * @return array
 */
public function via($notifiable)
{
    return $notifiable-&gt;prefers_sms ? [\'nexmo\'] : [\'mail\', \'database\'];
}'); ?>
	<p><a name="queueing-notifications"></a></p>
	<h3>Queueing Notifications</h3>
	<p>Before queueing notifications you should configure your queue and <a href="/docs/5.7/queues">start a worker</a>.</p>
	<p>Sending notifications can take time, especially if the channel needs an external API call to deliver the notification. To speed up your application's response time, let your notification be queued by adding the ShouldQueue interface and Queueable trait to your class. The interface and trait are already imported for all notifications generated using make:notification, so you may immediately add them to your notification class:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoicePaid extends Notification implements ShouldQueue
{
    use Queueable;

    // ...
}'); ?>
	<p>Once the ShouldQueue interface has been added to your notification, you may send the notification like normal. Space MVC will detect the ShouldQueue interface on the class and automatically queue the delivery of the notification:</p>
	<?php echo Code::getHtmlStatic('$user-&gt;notify(new InvoicePaid($invoice));'); ?>
	<p>If you would like to delay the delivery of the notification, you may chain the delay method onto your notification instantiation:</p>
	<?php echo Code::getHtmlStatic('$when = now()-&gt;addMinutes(10);

$user-&gt;notify((new InvoicePaid($invoice))-&gt;delay($when));'); ?>
	<p><a name="on-demand-notifications"></a></p>
	<h3>On-Demand Notifications</h3>
	<p>Sometimes you may need to send a notification to someone who is not stored as a "user" of your application. Using the Notification::route method, you may specify ad-hoc notification routing information before sending the notification:</p>
	<?php echo Code::getHtmlStatic('Notification::route(\'mail\', \'taylor@example.com\')
            -&gt;route(\'nexmo\', \'5555555555\')
            -&gt;notify(new InvoicePaid($invoice));'); ?>
	<p><a name="mail-notifications"></a></p>
	<h2><a href="#mail-notifications">Mail Notifications</a></h2>
	<p><a name="formatting-mail-messages"></a></p>
	<h3>Formatting Mail Messages</h3>
	<p>If a notification supports being sent as an email, you should define a toMail method on the notification class. This method will receive a $notifiable entity and should return a Illuminate\Notifications\Messages\MailMessage instance. Mail messages may contain lines of text as well as a "call to action". Let's take a look at an example toMail method:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the mail representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return \Illuminate\Notifications\Messages\MailMessage
 */
public function toMail($notifiable)
{
    $url = url(\'/invoice/\'.$this-&gt;invoice-&gt;id);

    return (new MailMessage)
                -&gt;greeting(\'Hello!\')
                -&gt;line(\'One of your invoices has been paid!\')
                -&gt;action(\'View Invoice\', $url)
                -&gt;line(\'Thank you for using our application!\');
}'); ?>
	<p>Note we are using $this-&gt;invoice-&gt;id in our toMail method. You may pass any data your notification needs to generate its message into the notification\'s constructor.</p>
	<p>In this example, we register a greeting, a line of text, a call to action, and then another line of text. These methods provided by the MailMessage object make it simple and fast to format small transactional emails. The mail channel will then translate the message components into a nice, responsive HTML email template with a plain-text counterpart. Here is an example of an email generated by the mail channel:</p>
	<img src="https://Space MVC.com/assets/img/notification-example.png" width="551" height="596">
	<p>When sending mail notifications, be sure to set the name value in your config/app.php configuration file. This value will be used in the header and footer of your mail notification messages.</p>
	<h4>Other Notification Formatting Options</h4>
	<p>Instead of defining the "lines" of text in the notification class, you may use the view method to specify a custom template that should be used to render the notification email:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the mail representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return \Illuminate\Notifications\Messages\MailMessage
 */
public function toMail($notifiable)
{
    return (new MailMessage)-&gt;view(
        \'emails.name\', [\'invoice\' =&gt; $this-&gt;invoice]
    );
}'); ?>
	<p>In addition, you may return a <a href="/docs/5.7/mail">mailable object</a> from the toMail method:</p>
	<?php echo Code::getHtmlStatic('use App\Mail\InvoicePaid as Mailable;

/**
 * Get the mail representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return Mailable
 */
public function toMail($notifiable)
{
    return (new Mailable($this-&gt;invoice))-&gt;to($this-&gt;user-&gt;email);
}'); ?>
	<p><a name="error-messages"></a></p>
	<h4>Error Messages</h4>
	<p>Some notifications inform users of errors, such as a failed invoice payment. You may indicate that a mail message is regarding an error by calling the error method when building your message. When using the error method on a mail message, the call to action button will be red instead of blue:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the mail representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return \Illuminate\Notifications\Message
 */
public function toMail($notifiable)
{
    return (new MailMessage)
                -&gt;error()
                -&gt;subject(\'Notification Subject\')
                -&gt;line(\'...\');
}'); ?>
	<p><a name="customizing-the-recipient"></a></p>
	<h3>Customizing The Recipient</h3>
	<p>When sending notifications via the mail channel, the notification system will automatically look for an email property on your notifiable entity. You may customize which email address is used to deliver the notification by defining a routeNotificationForMail method on the entity:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForMail($notification)
    {
        return $this-&gt;email_address;
    }
}'); ?>
	<p><a name="customizing-the-subject"></a></p>
	<h3>Customizing The Subject</h3>
	<p>By default, the email's subject is the class name of the notification formatted to "title case". So, if your notification class is named InvoicePaid, the email's subject will be Invoice Paid. If you would like to specify an explicit subject for the message, you may call the subject method when building your message:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the mail representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return \Illuminate\Notifications\Messages\MailMessage
 */
public function toMail($notifiable)
{
    return (new MailMessage)
                -&gt;subject(\'Notification Subject\')
                -&gt;line(\'...\');
}'); ?>
	<p><a name="customizing-the-templates"></a></p>
	<h3>Customizing The Templates</h3>
	<p>You can modify the HTML and plain-text template used by mail notifications by publishing the notification package's resources. After running this command, the mail notification templates will be located in the resources/views/vendor/notifications directory:</p>
	<?php echo Code::getHtmlStatic('php artisan vendor:publish --tag=Space MVC-notifications'); ?>
	<p><a name="markdown-mail-notifications"></a></p>
	<h2><a href="#markdown-mail-notifications">Markdown Mail Notifications</a></h2>
	<p>Markdown mail notifications allow you to take advantage of the pre-built templates of mail notifications, while giving you more freedom to write longer, customized messages. Since the messages are written in Markdown, Space MVC is able to render beautiful, responsive HTML templates for the messages while also automatically generating a plain-text counterpart.</p>
	<p><a name="generating-the-message"></a></p>
	<h3>Generating The Message</h3>
	<p>To generate a notification with a corresponding Markdown template, you may use the --markdown option of the make:notification Artisan command:</p>
	<?php echo Code::getHtmlStatic('php artisan make:notification InvoicePaid --markdown=mail.invoice.paid'); ?>
	<p>Like all other mail notifications, notifications that use Markdown templates should define a toMail method on their notification class. However, instead of using the line and action methods to construct the notification, use the markdown method to specify the name of the Markdown template that should be used:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the mail representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return \Illuminate\Notifications\Messages\MailMessage
 */
public function toMail($notifiable)
{
    $url = url(\'/invoice/\'.$this-&gt;invoice-&gt;id);

    return (new MailMessage)
                -&gt;subject(\'Invoice Paid\')
                -&gt;markdown(\'mail.invoice.paid\', [\'url\' =&gt; $url]);
}'); ?>
	<p><a name="writing-the-message"></a></p>
	<h3>Writing The Message</h3>
	<p>Markdown mail notifications use a combination of Blade components and Markdown syntax which allow you to easily construct notifications while leveraging Space MVC's pre-crafted notification components:</p>
	<?php echo Code::getHtmlStatic('@component(\'mail::message\')
# Invoice Paid

Your invoice has been paid!

@component(\'mail::button\', [\'url\' =&gt; $url])
View Invoice
@endcomponent

Thanks,&lt;br&gt;
{{ config(\'app.name\') }}
@endcomponent'); ?>
	<h4>Button Component</h4>
	<p>The button component renders a centered button link. The component accepts two arguments, a url and an optional color. Supported colors are blue, green, and red. You may add as many button components to a notification as you wish:</p>
	<?php echo Code::getHtmlStatic('@component(\'mail::button\', [\'url\' =&gt; $url, \'color\' =&gt; \'green\'])
View Invoice
@endcomponent'); ?>
	<h4>Panel Component</h4>
	<p>The panel component renders the given block of text in a panel that has a slightly different background color than the rest of the notification. This allows you to draw attention to a given block of text:</p>
	<?php echo Code::getHtmlStatic('@component(\'mail::panel\')
This is the panel content.
@endcomponent'); ?>
	<h4>Table Component</h4>
	<p>The table component allows you to transform a Markdown table into an HTML table. The component accepts the Markdown table as its content. Table column alignment is supported using the default Markdown table alignment syntax:</p>
	<?php echo Code::getHtmlStatic('@component(\'mail::table\')
| Space MVC       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
@endcomponent'); ?>
	<p><a name="customizing-the-components"></a></p>
	<h3>Customizing The Components</h3>
	<p>You may export all of the Markdown notification components to your own application for customization. To export the components, use the vendor:publish Artisan command to publish the Space MVC-mail asset tag:</p>
	<?php echo Code::getHtmlStatic('php artisan vendor:publish --tag=Space MVC-mail'); ?>
	<p>This command will publish the Markdown mail components to the resources/views/vendor/mail directory. The mail directory will contain a html and a markdown directory, each containing their respective representations of every available component. You are free to customize these components however you like.</p>
	<h4>Customizing The CSS</h4>
	<p>After exporting the components, the resources/views/vendor/mail/html/themes directory will contain a default.css file. You may customize the CSS in this file and your styles will automatically be in-lined within the HTML representations of your Markdown notifications.</p>
	<p>If you would like to build an entirely new theme for the Markdown components, write a new CSS file within the html/themes directory and change the theme option of your mail configuration file.</p>
	<p><a name="database-notifications"></a></p>
	<h2><a href="#database-notifications">Database Notifications</a></h2>
	<p><a name="database-prerequisites"></a></p>
	<h3>Prerequisites</h3>
	<p>The database notification channel stores the notification information in a database table. This table will contain information such as the notification type as well as custom JSON data that describes the notification.</p>
	<p>You can query the table to display the notifications in your application's user interface. But, before you can do that, you will need to create a database table to hold your notifications. You may use the notifications:table command to generate a migration with the proper table schema:</p>
	<?php echo Code::getHtmlStatic('php artisan notifications:table

php artisan migrate'); ?>
	<p><a name="formatting-database-notifications"></a></p>
	<h3>Formatting Database Notifications</h3>
	<p>If a notification supports being stored in a database table, you should define a toDatabase or toArray method on the notification class. This method will receive a $notifiable entity and should return a plain PHP array. The returned array will be encoded as JSON and stored in the data column of your notifications table. Let's take a look at an example toArray method:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the array representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return array
 */
public function toArray($notifiable)
{
    return [
        \'invoice_id\' =&gt; $this-&gt;invoice-&gt;id,
        \'amount\' =&gt; $this-&gt;invoice-&gt;amount,
    ];
}'); ?>
	<h4>toDatabase Vs. toArray</h4>
	<p>The toArray method is also used by the broadcast channel to determine which data to broadcast to your JavaScript client. If you would like to have two different array representations for the database and broadcast channels, you should define a toDatabase method instead of a toArray method.</p>
	<p><a name="accessing-the-notifications"></a></p>
	<h3>Accessing The Notifications</h3>
	<p>Once notifications are stored in the database, you need a convenient way to access them from your notifiable entities. The Illuminate\Notifications\Notifiable trait, which is included on Space MVC's default App\User model, includes a notifications Eloquent relationship that returns the notifications for the entity. To fetch notifications, you may access this method like any other Eloquent relationship. By default, notifications will be sorted by the created_at timestamp:</p>
	<?php echo Code::getHtmlStatic('$user = App\User::find(1);

foreach ($user-&gt;notifications as $notification) {
    echo $notification-&gt;type;
}'); ?>
	<p>If you want to retrieve only the "unread" notifications, you may use the unreadNotifications relationship. Again, these notifications will be sorted by the created_at timestamp:</p>
	<?php echo Code::getHtmlStatic('$user = App\User::find(1);

foreach ($user-&gt;unreadNotifications as $notification) {
    echo $notification-&gt;type;
}'); ?>
	<p>To access your notifications from your JavaScript client, you should define a notification controller for your application which returns the notifications for a notifiable entity, such as the current user. You may then make an HTTP request to that controller's URI from your JavaScript client.</p>
	<p><a name="marking-notifications-as-read"></a></p>
	<h3>Marking Notifications As Read</h3>
	<p>Typically, you will want to mark a notification as "read" when a user views it. The Illuminate\Notifications\Notifiable trait provides a markAsRead method, which updates the read_at column on the notification's database record:</p>
	<?php echo Code::getHtmlStatic('$user = App\User::find(1);

foreach ($user-&gt;unreadNotifications as $notification) {
    $notification-&gt;markAsRead();
}'); ?>
	<p>However, instead of looping through each notification, you may use the markAsRead method directly on a collection of notifications:</p>
	<?php echo Code::getHtmlStatic('$user-&gt;unreadNotifications-&gt;markAsRead();'); ?>
	<p>You may also use a mass-update query to mark all of the notifications as read without retrieving them from the database:</p>
	<?php echo Code::getHtmlStatic('$user = App\User::find(1);

$user-&gt;unreadNotifications()-&gt;update([\'read_at\' =&gt; now()]);'); ?>
	<p>Of course, you may delete the notifications to remove them from the table entirely:</p>
	<?php echo Code::getHtmlStatic('$user-&gt;notifications()-&gt;delete();'); ?>
	<p><a name="broadcast-notifications"></a></p>
	<h2><a href="#broadcast-notifications">Broadcast Notifications</a></h2>
	<p><a name="broadcast-prerequisites"></a></p>
	<h3>Prerequisites</h3>
	<p>Before broadcasting notifications, you should configure and be familiar with Space MVC's <a href="/docs/5.7/broadcasting">event broadcasting</a> services. Event broadcasting provides a way to react to server-side fired Space MVC events from your JavaScript client.</p>
	<p><a name="formatting-broadcast-notifications"></a></p>
	<h3>Formatting Broadcast Notifications</h3>
	<p>The broadcast channel broadcasts notifications using Space MVC's <a href="/docs/5.7/broadcasting">event broadcasting</a> services, allowing your JavaScript client to catch notifications in realtime. If a notification supports broadcasting, you should define a toBroadcast method on the notification class. This method will receive a $notifiable entity and should return a BroadcastMessage instance. The returned data will be encoded as JSON and broadcast to your JavaScript client. Let's take a look at an example toBroadcast method:</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Notifications\Messages\BroadcastMessage;

/**
 * Get the broadcastable representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return BroadcastMessage
 */
public function toBroadcast($notifiable)
{
    return new BroadcastMessage([
        \'invoice_id\' =&gt; $this-&gt;invoice-&gt;id,
        \'amount\' =&gt; $this-&gt;invoice-&gt;amount,
    ]);
}'); ?>
	<h4>Broadcast Queue Configuration</h4>
	<p>All broadcast notifications are queued for broadcasting. If you would like to configure the queue connection or queue name that is used to queue the broadcast operation, you may use the onConnection and onQueue methods of the BroadcastMessage:</p>
	<?php echo Code::getHtmlStatic('return (new BroadcastMessage($data))
                -&gt;onConnection(\'sqs\')
                -&gt;onQueue(\'broadcasts\');'); ?>
	<p>In addition to the data you specify, broadcast notifications will also contain a type field containing the class name of the notification.</p>
	<p><a name="listening-for-notifications"></a></p>
	<h3>Listening For Notifications</h3>
	<p>Notifications will broadcast on a private channel formatted using a {notifiable}.{id} convention. So, if you are sending a notification to a App\User instance with an ID of 1, the notification will be broadcast on the App.User.1 private channel. When using <a href="/docs/5.7/broadcasting">Space MVC Echo</a>, you may easily listen for notifications on a channel using the notification helper method:</p>
	<?php echo Code::getHtmlStatic('Echo.private(\'App.User.\' + userId)
    .notification((notification) =&gt; {
        console.log(notification.type);
    });'); ?>
	<h4>Customizing The Notification Channel</h4>
	<p>If you would like to customize which channels a notifiable entity receives its broadcast notifications on, you may define a receivesBroadcastNotificationsOn method on the notifiable entity:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return \'users.\'.$this-&gt;id;
    }
}'); ?>
	<p><a name="sms-notifications"></a></p>
	<h2><a href="#sms-notifications">SMS Notifications</a></h2>
	<p><a name="sms-prerequisites"></a></p>
	<h3>Prerequisites</h3>
	<p>Sending SMS notifications in Space MVC is powered by <a href="https://www.nexmo.com/">Nexmo</a>. Before you can send notifications via Nexmo, you need to install the nexmo/client Composer package and add a few configuration options to your config/services.php configuration file. You may copy the example configuration below to get started:</p>
	<?php echo Code::getHtmlStatic('\'nexmo\' =&gt; [
    \'key\' =&gt; env(\'NEXMO_KEY\'),
    \'secret\' =&gt; env(\'NEXMO_SECRET\'),
    \'sms_from\' =&gt; \'15556666666\',
],'); ?>
	<p>The sms_from option is the phone number that your SMS messages will be sent from. You should generate a phone number for your application in the Nexmo control panel.</p>
	<p><a name="formatting-sms-notifications"></a></p>
	<h3>Formatting SMS Notifications</h3>
	<p>If a notification supports being sent as an SMS, you should define a toNexmo method on the notification class. This method will receive a $notifiable entity and should return a Illuminate\Notifications\Messages\NexmoMessage instance:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the Nexmo / SMS representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return NexmoMessage
 */
public function toNexmo($notifiable)
{
    return (new NexmoMessage)
                -&gt;content(\'Your SMS message content\');
}'); ?>
	<h4>Unicode Content</h4>
	<p>If your SMS message will contain unicode characters, you should call the unicode method when constructing the NexmoMessage instance:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the Nexmo / SMS representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return NexmoMessage
 */
public function toNexmo($notifiable)
{
    return (new NexmoMessage)
                -&gt;content(\'Your unicode message\')
                -&gt;unicode();
}'); ?>
	<p><a name="customizing-the-from-number"></a></p>
	<h3>Customizing The "From" Number</h3>
	<p>If you would like to send some notifications from a phone number that is different from the phone number specified in your config/services.php file, you may use the from method on a NexmoMessage instance:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the Nexmo / SMS representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return NexmoMessage
 */
public function toNexmo($notifiable)
{
    return (new NexmoMessage)
                -&gt;content(\'Your SMS message content\')
                -&gt;from(\'15554443333\');
}'); ?>
	<p><a name="routing-sms-notifications"></a></p>
	<h3>Routing SMS Notifications</h3>
	<p>When sending notifications via the nexmo channel, the notification system will automatically look for a phone_number attribute on the notifiable entity. If you would like to customize the phone number the notification is delivered to, define a routeNotificationForNexmo method on the entity:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Route notifications for the Nexmo channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForNexmo($notification)
    {
        return $this-&gt;phone;
    }
}'); ?>
	<p><a name="slack-notifications"></a></p>
	<h2><a href="#slack-notifications">Slack Notifications</a></h2>
	<p><a name="slack-prerequisites"></a></p>
	<h3>Prerequisites</h3>
	<p>Before you can send notifications via Slack, you must install the Guzzle HTTP library via Composer:</p>
	<?php echo Code::getHtmlStatic('composer require guzzlehttp/guzzle'); ?>
	<p>You will also need to configure an <a href="https://api.slack.com/incoming-webhooks">"Incoming Webhook"</a> integration for your Slack team. This integration will provide you with a URL you may use when <a href="#routing-slack-notifications">routing Slack notifications</a>.</p>
	<p><a name="formatting-slack-notifications"></a></p>
	<h3>Formatting Slack Notifications</h3>
	<p>If a notification supports being sent as a Slack message, you should define a toSlack method on the notification class. This method will receive a $notifiable entity and should return a Illuminate\Notifications\Messages\SlackMessage instance. Slack messages may contain text content as well as an "attachment" that formats additional text or an array of fields. Let's take a look at a basic toSlack example:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the Slack representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return SlackMessage
 */
public function toSlack($notifiable)
{
    return (new SlackMessage)
                -&gt;content(\'One of your invoices has been paid!\');
}'); ?>
	<p>In this example we are just sending a single line of text to Slack, which will create a message that looks like the following:</p>
	<img src="https://Space MVC.com/assets/img/basic-slack-notification.png">
	<h4>Customizing The Sender &amp; Recipient</h4>
	<p>You may use the from and to methods to customize the sender and recipient. The from method accepts a username and emoji identifier, while the to method accepts a channel or username:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the Slack representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return SlackMessage
 */
public function toSlack($notifiable)
{
    return (new SlackMessage)
                -&gt;from(\'Ghost\', \':ghost:\')
                -&gt;to(\'#other\')
                -&gt;content(\'This will be sent to #other\');
}'); ?>
	<p>You may also use an image as your logo instead of an emoji:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the Slack representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return SlackMessage
 */
public function toSlack($notifiable)
{
    return (new SlackMessage)
                -&gt;from(\'Space MVC\')
                -&gt;image(\'https://Space MVC.com/favicon.png\')
                -&gt;content(\'This will display the Space MVC logo next to the message\');
}'); ?>
	<p><a name="slack-attachments"></a></p>
	<h3>Slack Attachments</h3>
	<p>You may also add "attachments" to Slack messages. Attachments provide richer formatting options than simple text messages. In this example, we will send an error notification about an exception that occurred in an application, including a link to view more details about the exception:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the Slack representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return SlackMessage
 */
public function toSlack($notifiable)
{
    $url = url(\'/exceptions/\'.$this-&gt;exception-&gt;id);

    return (new SlackMessage)
                -&gt;error()
                -&gt;content(\'Whoops! Something went wrong.\')
                -&gt;attachment(function ($attachment) use ($url) {
                    $attachment-&gt;title(\'Exception: File Not Found\', $url)
                               -&gt;content(\'File [background.jpg] was not found.\');
                });
}'); ?>
	<p>The example above will generate a Slack message that looks like the following:</p>
	<img src="https://Space MVC.com/assets/img/basic-slack-attachment.png">
	<p>Attachments also allow you to specify an array of data that should be presented to the user. The given data will be presented in a table-style format for easy reading:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the Slack representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return SlackMessage
 */
public function toSlack($notifiable)
{
    $url = url(\'/invoices/\'.$this-&gt;invoice-&gt;id);

    return (new SlackMessage)
                -&gt;success()
                -&gt;content(\'One of your invoices has been paid!\')
                -&gt;attachment(function ($attachment) use ($url) {
                    $attachment-&gt;title(\'Invoice 1322\', $url)
                               -&gt;fields([
                                    \'Title\' =&gt; \'Server Expenses\',
                                    \'Amount\' =&gt; \'$1,234\',
                                    \'Via\' =&gt; \'American Express\',
                                    \'Was Overdue\' =&gt; \':-1:\',
                                ]);
                });
}'); ?>
	<p>The example above will create a Slack message that looks like the following:</p>
	<img src="https://Space MVC.com/assets/img/slack-fields-attachment.png">
	<h4>Markdown Attachment Content</h4>
	<p>If some of your attachment fields contain Markdown, you may use the markdown method to instruct Slack to parse and display the given attachment fields as Markdown formatted text. The values accepted by this method are: pretext, text, and / or fields. For more information about Slack attachment formatting, check out the <a href="https://api.slack.com/docs/message-formatting#message_formatting">Slack API documentation</a>:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the Slack representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return SlackMessage
 */
public function toSlack($notifiable)
{
    $url = url(\'/exceptions/\'.$this-&gt;exception-&gt;id);

    return (new SlackMessage)
                -&gt;error()
                -&gt;content(\'Whoops! Something went wrong.\')
                -&gt;attachment(function ($attachment) use ($url) {
                    $attachment-&gt;title(\'Exception: File Not Found\', $url)
                               -&gt;content(\'File [background.jpg] was *not found*.\')
                               -&gt;markdown([\'text\']);
                });
}'); ?>
	<p><a name="routing-slack-notifications"></a></p>
	<h3>Routing Slack Notifications</h3>
	<p>To route Slack notifications to the proper location, define a routeNotificationForSlack method on your notifiable entity. This should return the webhook URL to which the notification should be delivered. Webhook URLs may be generated by adding an "Incoming Webhook" service to your Slack team:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Route notifications for the Slack channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForSlack($notification)
    {
        return \'https://hooks.slack.com/services/...\';
    }
}'); ?>
	<p><a name="localizing-notifications"></a></p>
	<h2><a href="#localizing-notifications">Localizing Notifications</a></h2>
	<p>Space MVC allows you to send notifications in a locale other than the current language, and will even remember this locale if the notification is queued.</p>
	<p>To accomplish this, the Illuminate\Notifications\Notification class offers a locale method to set the desired language. The application will change into this locale when the notification is being formatted and then revert back to the previous locale when formatting is complete:</p>
	<?php echo Code::getHtmlStatic('$user-&gt;notify((new InvoicePaid($invoice))-&gt;locale(\'es\'));'); ?>
	<p>Localization of multiple notifiable entries may also be achieved via the Notification facade:</p>
	<?php echo Code::getHtmlStatic('Notification::locale(\'es\')-&gt;send($users, new InvoicePaid($invoice));'); ?>
	<h3>User Preferred Locales</h3>
	<p>Sometimes, applications store each user's preferred locale. By implementing the HasLocalePreference contract on your notifiable model, you may instruct Space MVC to use this stored locale when sending a notification:</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Contracts\Translation\HasLocalePreference;

class User extends Model implements HasLocalePreference
{
    /**
     * Get the user\'s preferred locale.
     *
     * @return string
     */
    public function preferredLocale()
    {
        return $this-&gt;locale;
    }
}'); ?>
	<p>Once you have implemented the interface, Space MVC will automatically use the preferred locale when sending notifications and mailables to the model. Therefore, there is no need to call the locale method when using this interface:</p>
	<?php echo Code::getHtmlStatic('$user-&gt;notify(new InvoicePaid($invoice));'); ?>
	<p><a name="notification-events"></a></p>
	<h2><a href="#notification-events">Notification Events</a></h2>
	<p>When a notification is sent, the Illuminate\Notifications\Events\NotificationSent event is fired by the notification system. This contains the "notifiable" entity and the notification instance itself. You may register listeners for this event in your EventServiceProvider:</p>
	<?php echo Code::getHtmlStatic('/**
 * The event listener mappings for the application.
 *
 * @var array
 */
protected $listen = [
    \'Illuminate\Notifications\Events\NotificationSent\' =&gt; [
        \'App\Listeners\LogNotification\',
    ],
];'); ?>
	<p>After registering listeners in your EventServiceProvider, use the event:generate Artisan command to quickly generate listener classes.</p>
	<p>Within an event listener, you may access the notifiable, notification, and channel properties on the event to learn more about the notification recipient or the notification itself:</p>
	<?php echo Code::getHtmlStatic('/**
 * Handle the event.
 *
 * @param  NotificationSent  $event
 * @return void
 */
public function handle(NotificationSent $event)
{
    // $event-&gt;channel
    // $event-&gt;notifiable
    // $event-&gt;notification
}'); ?>
	<p><a name="custom-channels"></a></p>
	<h2><a href="#custom-channels">Custom Channels</a></h2>
	<p>Space MVC ships with a handful of notification channels, but you may want to write your own drivers to deliver notifications via other channels. Space MVC makes it simple. To get started, define a class that contains a send method. The method should receive two arguments: a $notifiable and a $notification:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class VoiceChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification-&gt;toVoice($notifiable);

        // Send notification to the $notifiable instance...
    }
}'); ?>
	<p>Once your notification channel class has been defined, you may return the class name from the via method of any of your notifications:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Channels\VoiceChannel;
use App\Channels\Messages\VoiceMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoicePaid extends Notification
{
    use Queueable;

    /**
     * Get the notification channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return [VoiceChannel::class];
    }

    /**
     * Get the voice representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return VoiceMessage
     */
    public function toVoice($notifiable)
    {
        // ...
    }
}'); ?>
</article>