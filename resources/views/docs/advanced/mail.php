<?php use App\Library\Framework\Component\Code; ?>

<article>
	<h1>Mail</h1>
	<p>Space MVC provides a clean, simple API over the popular <a href="https://swiftmailer.symfony.com/">SwiftMailer</a> library with drivers for SMTP, Mailgun, SparkPost, Amazon SES, PHP's mail function, and sendmail, allowing you to quickly get started sending mail through a local or cloud based service of your choice.</p>
	<p><a name="driver-prerequisites"></a></p>
	<h3>Driver Prerequisites</h3>
	<p>The API based drivers such as Mailgun and SparkPost are often simpler and faster than SMTP servers. If possible, you should use one of these drivers. All of the API drivers require the Guzzle HTTP library, which may be installed via the Composer package manager:</p>
	<?php echo Code::getHtmlStatic('composer require guzzlehttp/guzzle'); ?>
	<h4>Mailgun Driver</h4>
	<p>To use the Mailgun driver, first install Guzzle, then set the driver option in your config/mail.php configuration file to mailgun. Next, verify that your config/services.php configuration file contains the following options:</p>
	<?php echo Code::getHtmlStatic('\'mailgun\' =&gt; [
    \'domain\' =&gt; \'your-mailgun-domain\',
    \'secret\' =&gt; \'your-mailgun-key\',
],'); ?>
	<p>If you are not using the "US" <a href="https://documentation.mailgun.com/en/latest/api-intro.html#mailgun-regions">Mailgun region</a>, you may define your region's endpoint in the services configuration file:</p>
	<?php echo Code::getHtmlStatic('\'mailgun\' =&gt; [
    \'domain\' =&gt; \'your-mailgun-domain\',
    \'secret\' =&gt; \'your-mailgun-key\',
    \'endpoint\' =&gt; \'api.eu.mailgun.net\',
],'); ?>
	<h4>SparkPost Driver</h4>
	<p>To use the SparkPost driver, first install Guzzle, then set the driver option in your config/mail.php configuration file to sparkpost. Next, verify that your config/services.php configuration file contains the following options:</p>
	<?php echo Code::getHtmlStatic('\'sparkpost\' =&gt; [
    \'secret\' =&gt; \'your-sparkpost-key\',
],'); ?>
	<p>If necessary, you may also configure which <a href="https://developers.sparkpost.com/api/#header-endpoints">API endpoint</a> should be used:</p>
	<?php echo Code::getHtmlStatic('\'sparkpost\' =&gt; [
    \'secret\' =&gt; \'your-sparkpost-key\',
    \'options\' =&gt; [
        \'endpoint\' =&gt; \'https://api.eu.sparkpost.com/api/v1/transmissions\',
    ],
],'); ?>
	<h4>SES Driver</h4>
	<p>To use the Amazon SES driver you must first install the Amazon AWS SDK for PHP. You may install this library by adding the following line to your composer.json file's require section and running the composer update command:</p>
	<?php echo Code::getHtmlStatic('"aws/aws-sdk-php": "~3.0"'); ?>
	<p>Next, set the driver option in your config/mail.php configuration file to ses and verify that your config/services.php configuration file contains the following options:</p>
	<?php echo Code::getHtmlStatic('\'ses\' =&gt; [
    \'key\' =&gt; \'your-ses-key\',
    \'secret\' =&gt; \'your-ses-secret\',
    \'region\' =&gt; \'ses-region\',  // e.g. us-east-1
],'); ?>
	<p>If you need to include <a href="https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-email-2010-12-01.html#sendrawemail">additional options</a> when executing the SES SendRawEmail request, you may define an options array within your ses configuration:</p>
	<?php echo Code::getHtmlStatic('\'ses\' =&gt; [
    \'key\' =&gt; \'your-ses-key\',
    \'secret\' =&gt; \'your-ses-secret\',
    \'region\' =&gt; \'ses-region\',  // e.g. us-east-1
    \'options\' =&gt; [
        \'ConfigurationSetName\' =&gt; \'MyConfigurationSet\',
        \'Tags\' =&gt; [
            [
                \'Name\' =&gt; \'foo\',
                \'Value\' =&gt; \'bar\',
            ],
        ],
    ],
],'); ?>
	<p><a name="generating-mailables"></a></p>
	<h2><a href="#generating-mailables">Generating Mailables</a></h2>
	<p>In Space MVC, each type of email sent by your application is represented as a "mailable" class. These classes are stored in the app/Mail directory. Don't worry if you don't see this directory in your application, since it will be generated for you when you create your first mailable class using the make:mail command:</p>
	<?php echo Code::getHtmlStatic('php artisan make:mail OrderShipped'); ?>
	<p><a name="writing-mailables"></a></p>
	<h2><a href="#writing-mailables">Writing Mailables</a></h2>
	<p>All of a mailable class' configuration is done in the build method. Within this method, you may call various methods such as from, subject, view, and attach to configure the email's presentation and delivery.</p>
	<p><a name="configuring-the-sender"></a></p>
	<h3>Configuring The Sender</h3>
	<h4>Using The from Method</h4>
	<p>First, let's explore configuring the sender of the email. Or, in other words, who the email is going to be "from". There are two ways to configure the sender. First, you may use the from method within your mailable class' build method:</p>
	<?php echo Code::getHtmlStatic('/**
 * Build the message.
 *
 * @return $this
 */
public function build()
{
    return $this-&gt;from(\'example@example.com\')
                -&gt;view(\'emails.orders.shipped\');
}'); ?>
	<h4>Using A Global from Address</h4>
	<p>However, if your application uses the same "from" address for all of its emails, it can become cumbersome to call the from method in each mailable class you generate. Instead, you may specify a global "from" address in your config/mail.php configuration file. This address will be used if no other "from" address is specified within the mailable class:</p>
	<?php echo Code::getHtmlStatic('\'from\' =&gt; [\'address\' =&gt; \'example@example.com\', \'name\' =&gt; \'App Name\'],'); ?>
	<p>In addition, you may define a global "reply_to" address within your config/mail.php configuration file:</p>
	<?php echo Code::getHtmlStatic('\'reply_to\' =&gt; [\'address\' =&gt; \'example@example.com\', \'name\' =&gt; \'App Name\'],'); ?>
	<p><a name="configuring-the-view"></a></p>
	<h3>Configuring The View</h3>
	<p>Within a mailable class' build method, you may use the view method to specify which template should be used when rendering the email's contents. Since each email typically uses a <a href="/docs/5.7/blade">Blade template</a> to render its contents, you have the full power and convenience of the Blade templating engine when building your email's HTML:</p>
	<?php echo Code::getHtmlStatic('/**
 * Build the message.
 *
 * @return $this
 */
public function build()
{
    return $this-&gt;view(\'emails.orders.shipped\');
}'); ?>
	<p>You may wish to create a resources/views/emails directory to house all of your email templates; however, you are free to place them wherever you wish within your resources/views directory.</p>
	<h4>Plain Text Emails</h4>
	<p>If you would like to define a plain-text version of your email, you may use the text method. Like the view method, the text method accepts a template name which will be used to render the contents of the email. You are free to define both a HTML and plain-text version of your message:</p>
	<?php echo Code::getHtmlStatic('/**
 * Build the message.
 *
 * @return $this
 */
public function build()
{
    return $this-&gt;view(\'emails.orders.shipped\')
                -&gt;text(\'emails.orders.shipped_plain\');
}'); ?>
	<p><a name="view-data"></a></p>
	<h3>View Data</h3>
	<h4>Via Public Properties</h4>
	<p>Typically, you will want to pass some data to your view that you can utilize when rendering the email's HTML. There are two ways you may make data available to your view. First, any public property defined on your mailable class will automatically be made available to the view. So, for example, you may pass data into your mailable class' constructor and set that data to public properties defined on the class:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this-&gt;order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this-&gt;view(\'emails.orders.shipped\');
    }
}'); ?>
	<p>Once the data has been set to a public property, it will automatically be available in your view, so you may access it like you would access any other data in your Blade templates:</p>
	<?php echo Code::getHtmlStatic('&lt;div&gt;
    Price: {{ $order-&gt;price }}
&lt;/div&gt;'); ?>
	<h4>Via The with Method:</h4>
	<p>If you would like to customize the format of your email's data before it is sent to the template, you may manually pass your data to the view via the with method. Typically, you will still pass data via the mailable class' constructor; however, you should set this data to protected or private properties so the data is not automatically made available to the template. Then, when calling the with method, pass an array of data that you wish to make available to the template:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    protected $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this-&gt;order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this-&gt;view(\'emails.orders.shipped\')
                    -&gt;with([
                        \'orderName\' =&gt; $this-&gt;order-&gt;name,
                        \'orderPrice\' =&gt; $this-&gt;order-&gt;price,
                    ]);
    }
}'); ?>
	<p>Once the data has been passed to the with method, it will automatically be available in your view, so you may access it like you would access any other data in your Blade templates:</p>
	<?php echo Code::getHtmlStatic('&lt;div&gt;
    Price: {{ $orderPrice }}
&lt;/div&gt;'); ?>
	<p><a name="attachments"></a></p>
	<h3>Attachments</h3>
	<p>To add attachments to an email, use the attach method within the mailable class' build method. The attach method accepts the full path to the file as its first argument:</p>
	<?php echo Code::getHtmlStatic('    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this-&gt;view(\'emails.orders.shipped\')
                    -&gt;attach(\'/path/to/file\');
    }'); ?>
	<p>When attaching files to a message, you may also specify the display name and / or MIME type by passing an array as the second argument to the attach method:</p>
	<?php echo Code::getHtmlStatic('    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this-&gt;view(\'emails.orders.shipped\')
                    -&gt;attach(\'/path/to/file\', [
                        \'as\' =&gt; \'name.pdf\',
                        \'mime\' =&gt; \'application/pdf\',
                    ]);
    }'); ?>
	<h4>Attaching Files from Disk</h4>
	<p>If you have stored a file on one of your <a href="/docs/5.7/filesystem">filesystem disks</a>, you may attach it to the email using the attachFromStorage method:</p>
	<?php echo Code::getHtmlStatic('/**
 * Build the message.
 *
 * @return $this
 */
 public function build()
 {
    return $this-&gt;view(\'email.orders.shipped\')
                -&gt;attachFromStorage(\'/path/to/file\');
 }'); ?>
	<p>If necessary, you may specify the file's attachment name and additional options using the second and third arguments to the attachFromStorage method:</p>
	<?php echo Code::getHtmlStatic('/**
 * Build the message.
 *
 * @return $this
 */
 public function build()
 {
    return $this-&gt;view(\'email.orders.shipped\')
                -&gt;attachFromStorage(\'/path/to/file\', \'name.pdf\', [
                    \'mime\' =&gt; \'application/pdf\'
                ]);
 }'); ?>
	<p>The attachFromStorageDisk method may be used if you need to specify a storage disk other than your default disk:</p>
	<?php echo Code::getHtmlStatic('/**
 * Build the message.
 *
 * @return $this
 */
 public function build()
 {
    return $this-&gt;view(\'email.orders.shipped\')
                -&gt;attachFromStorageDisk(\'s3\', \'/path/to/file\');
 }'); ?>
	<h4>Raw Data Attachments</h4>
	<p>The attachData method may be used to attach a raw string of bytes as an attachment. For example, you might use this method if you have generated a PDF in memory and want to attach it to the email without writing it to disk. The attachData method accepts the raw data bytes as its first argument, the name of the file as its second argument, and an array of options as its third argument:</p>
	<?php echo Code::getHtmlStatic('    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this-&gt;view(\'emails.orders.shipped\')
                    -&gt;attachData($this-&gt;pdf, \'name.pdf\', [
                        \'mime\' =&gt; \'application/pdf\',
                    ]);
    }'); ?>
	<p><a name="inline-attachments"></a></p>
	<h3>Inline Attachments</h3>
	<p>Embedding inline images into your emails is typically cumbersome; however, Space MVC provides a convenient way to attach images to your emails and retrieving the appropriate CID. To embed an inline image, use the embed method on the $message variable within your email template. Space MVC automatically makes the $message variable available to all of your email templates, so you don't need to worry about passing it in manually:</p>
	<?php echo Code::getHtmlStatic('&lt;body&gt;
    Here is an image:

    &lt;img src="{{ $message-&gt;embed($pathToFile) }}"&gt;
&lt;/body&gt;'); ?>
	<blockquote class="has-icon">
		<p><div class="flag"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="90px" height="90px" viewBox="0 0 90 90" enable-background="new 0 0 90 90" xml:space="preserve"><path fill="#FFFFFF" d="M45 0C20.1 0 0 20.1 0 45s20.1 45 45 45 45-20.1 45-45S69.9 0 45 0zM45 74.5c-3.6 0-6.5-2.9-6.5-6.5s2.9-6.5 6.5-6.5 6.5 2.9 6.5 6.5S48.6 74.5 45 74.5zM52.1 23.9l-2.5 29.6c0 2.5-2.1 4.6-4.6 4.6 -2.5 0-4.6-2.1-4.6-4.6l-2.5-29.6c-0.1-0.4-0.1-0.7-0.1-1.1 0-4 3.2-7.2 7.2-7.2 4 0 7.2 3.2 7.2 7.2C52.2 23.1 52.2 23.5 52.1 23.9z"></path></svg></div> $message variable is not available in markdown messages.</p>
	</blockquote>
	<h4>Embedding Raw Data Attachments</h4>
	<p>If you already have a raw data string you wish to embed into an email template, you may use the embedData method on the $message variable:</p>
	<?php echo Code::getHtmlStatic('&lt;body&gt;
    Here is an image from raw data:

    &lt;img src="{{ $message-&gt;embedData($data, $name) }}"&gt;
&lt;/body&gt;'); ?>
	<p><a name="customizing-the-swiftmailer-message"></a></p>
	<h3>Customizing The SwiftMailer Message</h3>
	<p>The withSwiftMessage method of the Mailable base class allows you to register a callback which will be invoked with the raw SwiftMailer message instance before sending the message. This gives you an opportunity to customize the message before it is delivered:</p>
	<?php echo Code::getHtmlStatic('    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this-&gt;view(\'emails.orders.shipped\');

        $this-&gt;withSwiftMessage(function ($message) {
            $message-&gt;getHeaders()
                    -&gt;addTextHeader(\'Custom-Header\', \'HeaderValue\');
        });
    }'); ?>
	<p><a name="markdown-mailables"></a></p>
	<h2><a href="#markdown-mailables">Markdown Mailables</a></h2>
	<p>Markdown mailable messages allow you to take advantage of the pre-built templates and components of mail notifications in your mailables. Since the messages are written in Markdown, Space MVC is able to render beautiful, responsive HTML templates for the messages while also automatically generating a plain-text counterpart.</p>
	<p><a name="generating-markdown-mailables"></a></p>
	<h3>Generating Markdown Mailables</h3>
	<p>To generate a mailable with a corresponding Markdown template, you may use the --markdown option of the make:mail Artisan command:</p>
	<?php echo Code::getHtmlStatic('php artisan make:mail OrderShipped --markdown=emails.orders.shipped'); ?>
	<p>Then, when configuring the mailable within its build method, call the markdown method instead of the view method. The markdown methods accepts the name of the Markdown template and an optional array of data to make available to the template:</p>
	<?php echo Code::getHtmlStatic('/**
 * Build the message.
 *
 * @return $this
 */
public function build()
{
    return $this-&gt;from(\'example@example.com\')
                -&gt;markdown(\'emails.orders.shipped\');
}'); ?>
	<p><a name="writing-markdown-messages"></a></p>
	<h3>Writing Markdown Messages</h3>
	<p>Markdown mailables use a combination of Blade components and Markdown syntax which allow you to easily construct mail messages while leveraging Space MVC's pre-crafted components:</p>
	<?php echo Code::getHtmlStatic('@component(\'mail::message\')
# Order Shipped

Your order has been shipped!

@component(\'mail::button\', [\'url\' =&gt; $url])
View Order
@endcomponent

Thanks,&lt;br&gt;
{{ config(\'app.name\') }}
@endcomponent'); ?>
	<p>Do not use excess indentation when writing Markdown emails. Markdown parsers will render indented content as code blocks.</p>
	<h4>Button Component</h4>
	<p>The button component renders a centered button link. The component accepts two arguments, a url and an optional color. Supported colors are primary, success, and error. You may add as many button components to a message as you wish:</p>
	<?php echo Code::getHtmlStatic('@component(\'mail::button\', [\'url\' =&gt; $url, \'color\' =&gt; \'success\'])
View Order
@endcomponent'); ?>
	<h4>Panel Component</h4>
	<p>The panel component renders the given block of text in a panel that has a slightly different background color than the rest of the message. This allows you to draw attention to a given block of text:</p>
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
	<p>You may export all of the Markdown mail components to your own application for customization. To export the components, use the vendor:publish Artisan command to publish the Space MVC-mail asset tag:</p>
	<?php echo Code::getHtmlStatic('php artisan vendor:publish --tag=Space MVC-mail'); ?>
	<p>This command will publish the Markdown mail components to the resources/views/vendor/mail directory. The mail directory will contain a html and a markdown directory, each containing their respective representations of every available component. The components in the html directory are used to generate the HTML version of your email, and their counterparts in the markdown directory are used to generate the plain-text version. You are free to customize these components however you like.</p>
	<h4>Customizing The CSS</h4>
	<p>After exporting the components, the resources/views/vendor/mail/html/themes directory will contain a default.css file. You may customize the CSS in this file and your styles will automatically be in-lined within the HTML representations of your Markdown mail messages.</p>
	<blockquote class="has-icon">
		<p><div class="flag"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></div> If you would like to build an entirely new theme for the Markdown components, write a new CSS file within the html/themes directory and change the theme option of your mail configuration file.</p>
	</blockquote>
	<p><a name="sending-mail"></a></p>
	<h2><a href="#sending-mail">Sending Mail</a></h2>
	<p>To send a message, use the to method on the Mail <a href="/docs/5.7/facades">facade</a>. The to method accepts an email address, a user instance, or a collection of users. If you pass an object or collection of objects, the mailer will automatically use their email and name properties when setting the email recipients, so make sure these attributes are available on your objects. Once you have specified your recipients, you may pass an instance of your mailable class to the send method:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Http\Controllers;

use App\Order;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Ship the given order.
     *
     * @param  Request  $request
     * @param  int  $orderId
     * @return Response
     */
    public function ship(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        // Ship order...

        Mail::to($request-&gt;user())-&gt;send(new OrderShipped($order));
    }
}'); ?>
	<p>Of course, you are not limited to just specifying the "to" recipients when sending a message. You are free to set "to", "cc", and "bcc" recipients all within a single, chained method call:</p>
	<?php echo Code::getHtmlStatic('Mail::to($request-&gt;user())
    -&gt;cc($moreUsers)
    -&gt;bcc($evenMoreUsers)
    -&gt;send(new OrderShipped($order));'); ?>
	<p><a name="rendering-mailables"></a></p>
	<h2><a href="#rendering-mailables">Rendering Mailables</a></h2>
	<p>Sometimes you may wish to capture the HTML content of a mailable without sending it. To accomplish this, you may call the render method of the mailable. This method will return the evaluated contents of the mailable as a string:</p>
	<?php echo Code::getHtmlStatic('$invoice = App\Invoice::find(1);

return (new App\Mail\InvoicePaid($invoice))-&gt;render();'); ?>
	<p><a name="previewing-mailables-in-the-browser"></a></p>
	<h3>Previewing Mailables In The Browser</h3>
	<p>When designing a mailable's template, it is convenient to quickly preview the rendered mailable in your browser like a typical Blade template. For this reason, Space MVC allows you to return any mailable directly from a route Closure or controller. When a mailable is returned, it will be rendered and displayed in the browser, allowing you to quickly preview its design without needing to send it to an actual email address:</p>
	<?php echo Code::getHtmlStatic('Route::get(\'/mailable\', function () {
    $invoice = App\Invoice::find(1);

    return new App\Mail\InvoicePaid($invoice);
});'); ?>
	<p><a name="queueing-mail"></a></p>
	<h3>Queueing Mail</h3>
	<h4>Queueing A Mail Message</h4>
	<p>Since sending email messages can drastically lengthen the response time of your application, many developers choose to queue email messages for background sending. Space MVC makes this easy using its built-in <a href="/docs/5.7/queues">unified queue API</a>. To queue a mail message, use the queue method on the Mail facade after specifying the message's recipients:</p>
	<?php echo Code::getHtmlStatic('Mail::to($request-&gt;user())
    -&gt;cc($moreUsers)
    -&gt;bcc($evenMoreUsers)
    -&gt;queue(new OrderShipped($order));'); ?>
	<p>This method will automatically take care of pushing a job onto the queue so the message is sent in the background. Of course, you will need to <a href="/docs/5.7/queues">configure your queues</a> before using this feature.</p>
	<h4>Delayed Message Queueing</h4>
	<p>If you wish to delay the delivery of a queued email message, you may use the later method. As its first argument, the later method accepts a DateTime instance indicating when the message should be sent:</p>
	<?php echo Code::getHtmlStatic('$when = now()-&gt;addMinutes(10);

Mail::to($request-&gt;user())
    -&gt;cc($moreUsers)
    -&gt;bcc($evenMoreUsers)
    -&gt;later($when, new OrderShipped($order));'); ?>
	<h4>Pushing To Specific Queues</h4>
	<p>Since all mailable classes generated using the make:mail command make use of the Illuminate\Bus\Queueable trait, you may call the onQueue and onConnection methods on any mailable class instance, allowing you to specify the connection and queue name for the message:</p>
	<?php echo Code::getHtmlStatic('$message = (new OrderShipped($order))
                -&gt;onConnection(\'sqs\')
                -&gt;onQueue(\'emails\');

Mail::to($request-&gt;user())
    -&gt;cc($moreUsers)
    -&gt;bcc($evenMoreUsers)
    -&gt;queue($message);'); ?>
	<h4>Queueing By Default</h4>
	<p>If you have mailable classes that you want to always be queued, you may implement the ShouldQueue contract on the class. Now, even if you call the send method when mailing, the mailable will still be queued since it implements the contract:</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable implements ShouldQueue
{
    //
}'); ?>
	<p><a name="localizing-mailables"></a></p>
	<h2><a href="#localizing-mailables">Localizing Mailables</a></h2>
	<p>Space MVC allows you to send mailables in a locale other than the current language, and will even remember this locale if the mail is queued.</p>
	<p>To accomplish this, the Illuminate\Mail\Mailable class offers a locale method to set the desired language. The application will change into this locale when the mailable is being formatted and then revert back to the previous locale when formatting is complete:</p>
	<?php echo Code::getHtmlStatic('Mail::to($request-&gt;user())-&gt;send(
    (new OrderShipped($order))-&gt;locale(\'es\')
);'); ?>
	<h3>User Preferred Locales</h3>
	<p>Sometimes, applications store each user's preferred locale. By implementing the HasLocalePreference contract on one or more of your models, you may instruct Space MVC to use this stored locale when sending mail:</p>
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
	<p>Once you have implemented the interface, Space MVC will automatically use the preferred locale when sending mailables and notifications to the model. Therefore, there is no need to call the locale method when using this interface:</p>
	<?php echo Code::getHtmlStatic('Mail::to($request-&gt;user())-&gt;send(new OrderShipped($order));'); ?>
	<p><a name="mail-and-local-development"></a></p>
	<h2><a href="#mail-and-local-development">Mail &amp; Local Development</a></h2>
	<p>When developing an application that sends email, you probably don't want to actually send emails to live email addresses. Space MVC provides several ways to "disable" the actual sending of emails during local development.</p>
	<h4>Log Driver</h4>
	<p>Instead of sending your emails, the log mail driver will write all email messages to your log files for inspection. For more information on configuring your application per environment, check out the <a href="/docs/5.7/configuration#environment-configuration">configuration documentation</a>.</p>
	<h4>Universal To</h4>
	<p>Another solution provided by Space MVC is to set a universal recipient of all emails sent by the framework. This way, all the emails generated by your application will be sent to a specific address, instead of the address actually specified when sending the message. This can be done via the to option in your config/mail.php configuration file:</p>
	<?php echo Code::getHtmlStatic('\'to\' =&gt; [
    \'address\' =&gt; \'example@example.com\',
    \'name\' =&gt; \'Example\'
],'); ?>
	<h4>Mailtrap</h4>
	<p>Finally, you may use a service like <a href="https://mailtrap.io">Mailtrap</a> and the smtp driver to send your email messages to a "dummy" mailbox where you may view them in a true email client. This approach has the benefit of allowing you to actually inspect the final emails in Mailtrap's message viewer.</p>
	<p><a name="events"></a></p>
	<h2><a href="#events">Events</a></h2>
	<p>Space MVC fires two events during the process of sending mail messages. The MessageSending event is fired prior to a message being sent, while the MessageSent event is fired after a message has been sent. Remember, these events are fired when the mail is being <em>sent</em>, not when it is queued. You may register an event listener for this event in your EventServiceProvider:</p>
	<?php echo Code::getHtmlStatic('/**
 * The event listener mappings for the application.
 *
 * @var array
 */
protected $listen = [
    \'Illuminate\Mail\Events\MessageSending\' =&gt; [
        \'App\Listeners\LogSendingMessage\',
    ],
    \'Illuminate\Mail\Events\MessageSent\' =&gt; [
        \'App\Listeners\LogSentMessage\',
    ],
];'); ?>
</article>