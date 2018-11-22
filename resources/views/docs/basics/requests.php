<?php use App\Library\Framework\Component\Code; ?>

<article>
	<h1>HTTP Requests</h1>
	<h4>Accessing The Request</h4>
	<p>To obtain an instance of the current HTTP request via dependency injection, you should type-hint the Illuminate\Http\Request class on your controller method. The incoming request instance will automatically be injected by the <a href="/docs/5.7/container">service container</a>:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $name = $request-&gt;input(\'name\');

        //
    }
}'); ?>
	<h4>Dependency Injection &amp; Route Parameters</h4>
	<p>If your controller method is also expecting input from a route parameter you should list your route parameters after your other dependencies. For example, if your route is defined like so:</p>
	<?php echo Code::getHtmlStatic('Route::put(\'user/{id}\', \'UserController@update\');'); ?>
	<p>You may still type-hint the Illuminate\Http\Request and access your route parameter id by defining your controller method as follows:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Update the specified user.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}'); ?>
	<h4>Accessing The Request Via Route Closures</h4>
	<p>You may also type-hint the Illuminate\Http\Request class on a route Closure. The service container will automatically inject the incoming request into the Closure when it is executed:</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Http\Request;

Route::get(\'/\', function (Request $request) {
    //
});'); ?>
	<p><a name="request-path-and-method"></a></p>
	<h3>Request Path &amp; Method</h3>
	<p>The Illuminate\Http\Request instance provides a variety of methods for examining the HTTP request for your application and extends the Symfony\Component\HttpFoundation\Request class. We will discuss a few of the most important methods below.</p>
	<h4>Retrieving The Request Path</h4>
	<p>The path method returns the request's path information. So, if the incoming request is targeted at http://domain.com/foo/bar, the path method will return foo/bar:</p>
	<?php echo Code::getHtmlStatic('$uri = $request-&gt;path();'); ?>
	<p>The is method allows you to verify that the incoming request path matches a given pattern. You may use the * character as a wildcard when utilizing this method:</p>
	<?php echo Code::getHtmlStatic('if ($request-&gt;is(\'admin/*\')) {
    //
}'); ?>
	<h4>Retrieving The Request URL</h4>
	<p>To retrieve the full URL for the incoming request you may use the url or fullUrl methods. The url method will return the URL without the query string, while the fullUrl method includes the query string:</p>
	<?php echo Code::getHtmlStatic('// Without Query String...
$url = $request-&gt;url();

// With Query String...
$url = $request-&gt;fullUrl();'); ?>
	<h4>Retrieving The Request Method</h4>
	<p>The method method will return the HTTP verb for the request. You may use the isMethod method to verify that the HTTP verb matches a given string:</p>
	<?php echo Code::getHtmlStatic('$method = $request-&gt;method();

if ($request-&gt;isMethod(\'post\')) {
    //
}'); ?>
	<p><a name="psr7-requests"></a></p>
	<h3>PSR-7 Requests</h3>
	<p>The <a href="http://www.php-fig.org/psr/psr-7/">PSR-7 standard</a> specifies interfaces for HTTP messages, including requests and responses. If you would like to obtain an instance of a PSR-7 request instead of a Space MVC request, you will first need to install a few libraries. Space MVC uses the <em>Symfony HTTP Message Bridge</em> component to convert typical Space MVC requests and responses into PSR-7 compatible implementations:</p>
	<?php echo Code::getHtmlStatic('composer require symfony/psr-http-message-bridge
composer require zendframework/zend-diactoros'); ?>
	<p>Once you have installed these libraries, you may obtain a PSR-7 request by type-hinting the request interface on your route Closure or controller method:</p>
	<?php echo Code::getHtmlStatic('use Psr\Http\Message\ServerRequestInterface;

Route::get(\'/\', function (ServerRequestInterface $request) {
    //
});'); ?>
	
		 If you return a PSR-7 response instance from a route or controller, it will automatically be converted back to a Space MVC response instance and be displayed by the framework.</p>
	
	<p><a name="input-trimming-and-normalization"></a></p>
	<h2><a href="#input-trimming-and-normalization">Input Trimming &amp; Normalization</a></h2>
	<p>By default, Space MVC includes the TrimStrings and ConvertEmptyStringsToNull middleware in your application's global middleware stack. These middleware are listed in the stack by the App\Http\Kernel class. These middleware will automatically trim all incoming string fields on the request, as well as convert any empty string fields to null. This allows you to not have to worry about these normalization concerns in your routes and controllers.</p>
	<p>If you would like to disable this behavior, you may remove the two middleware from your application's middleware stack by removing them from the $middleware property of your App\Http\Kernel class.</p>
	<p><a name="retrieving-input"></a></p>
	<h2><a href="#retrieving-input">Retrieving Input</a></h2>
	<h4>Retrieving All Input Data</h4>
	<p>You may also retrieve all of the input data as an array using the all method:</p>
	<?php echo Code::getHtmlStatic('$input = $request-&gt;all();'); ?>
	<h4>Retrieving An Input Value</h4>
	<p>Using a few simple methods, you may access all of the user input from your Illuminate\Http\Request instance without worrying about which HTTP verb was used for the request. Regardless of the HTTP verb, the input method may be used to retrieve user input:</p>
	<?php echo Code::getHtmlStatic('$name = $request-&gt;input(\'name\');'); ?>
	<p>You may pass a default value as the second argument to the input method. This value will be returned if the requested input value is not present on the request:</p>
	<?php echo Code::getHtmlStatic('$name = $request-&gt;input(\'name\', \'Sally\');'); ?>
	<p>When working with forms that contain array inputs, use "dot" notation to access the arrays:</p>
	<?php echo Code::getHtmlStatic('$name = $request-&gt;input(\'products.0.name\');

$names = $request-&gt;input(\'products.*.name\');'); ?>
	<h4>Retrieving Input From The Query String</h4>
	<p>While the input method retrieves values from entire request payload (including the query string), the query method will only retrieve values from the query string:</p>
	<?php echo Code::getHtmlStatic('$name = $request-&gt;query(\'name\');'); ?>
	<p>If the requested query string value data is not present, the second argument to this method will be returned:</p>
	<?php echo Code::getHtmlStatic('$name = $request-&gt;query(\'name\', \'Helen\');'); ?>
	<p>You may call the query method without any arguments in order to retrieve all of the query string values as an associative array:</p>
	<?php echo Code::getHtmlStatic('$query = $request-&gt;query();'); ?>
	<h4>Retrieving Input Via Dynamic Properties</h4>
	<p>You may also access user input using dynamic properties on the Illuminate\Http\Request instance. For example, if one of your application's forms contains a name field, you may access the value of the field like so:</p>
	<?php echo Code::getHtmlStatic('$name = $request-&gt;name;'); ?>
	<p>When using dynamic properties, Space MVC will first look for the parameter's value in the request payload. If it is not present, Space MVC will search for the field in the route parameters.</p>
	<h4>Retrieving JSON Input Values</h4>
	<p>When sending JSON requests to your application, you may access the JSON data via the input method as long as the Content-Type header of the request is properly set to application/json. You may even use "dot" syntax to dig into JSON arrays:</p>
	<?php echo Code::getHtmlStatic('$name = $request-&gt;input(\'user.name\');'); ?>
	<h4>Retrieving A Portion Of The Input Data</h4>
	<p>If you need to retrieve a subset of the input data, you may use the only and except methods. Both of these methods accept a single array or a dynamic list of arguments:</p>
	<?php echo Code::getHtmlStatic('$input = $request-&gt;only([\'username\', \'password\']);

$input = $request-&gt;only(\'username\', \'password\');

$input = $request-&gt;except([\'credit_card\']);

$input = $request-&gt;except(\'credit_card\');'); ?>
	
		 The only method returns all of the key / value pairs that you request; however, it will not return key / value pairs that are not present on the request.</p>
	
	<h4>Determining If An Input Value Is Present</h4>
	<p>You should use the has method to determine if a value is present on the request. The has method returns true if the value is present on the request:</p>
	<?php echo Code::getHtmlStatic('if ($request-&gt;has(\'name\')) {
    //
}'); ?>
	<p>When given an array, the has method will determine if all of the specified values are present:</p>
	<?php echo Code::getHtmlStatic('if ($request-&gt;has([\'name\', \'email\'])) {
    //
}'); ?>
	<p>If you would like to determine if a value is present on the request and is not empty, you may use the filled method:</p>
	<?php echo Code::getHtmlStatic('if ($request-&gt;filled(\'name\')) {
    //
}'); ?>
	<p><a name="old-input"></a></p>
	<h3>Old Input</h3>
	<p>Space MVC allows you to keep input from one request during the next request. This feature is particularly useful for re-populating forms after detecting validation errors. However, if you are using Space MVC's included <a href="/docs/5.7/validation">validation features</a>, it is unlikely you will need to manually use these methods, as some of Space MVC's built-in validation facilities will call them automatically.</p>
	<h4>Flashing Input To The Session</h4>
	<p>The flash method on the Illuminate\Http\Request class will flash the current input to the <a href="/docs/5.7/session">session</a> so that it is available during the user's next request to the application:</p>
	<?php echo Code::getHtmlStatic('$request-&gt;flash();'); ?>
	<p>You may also use the flashOnly and flashExcept methods to flash a subset of the request data to the session. These methods are useful for keeping sensitive information such as passwords out of the session:</p>
	<?php echo Code::getHtmlStatic('$request-&gt;flashOnly([\'username\', \'email\']);

$request-&gt;flashExcept(\'password\');'); ?>
	<h4>Flashing Input Then Redirecting</h4>
	<p>Since you often will want to flash input to the session and then redirect to the previous page, you may easily chain input flashing onto a redirect using the withInput method:</p>
	<?php echo Code::getHtmlStatic('return redirect(\'form\')-&gt;withInput();

return redirect(\'form\')-&gt;withInput(
    $request-&gt;except(\'password\')
);'); ?>
	<h4>Retrieving Old Input</h4>
	<p>To retrieve flashed input from the previous request, use the old method on the Request instance. The old method will pull the previously flashed input data from the <a href="/docs/5.7/session">session</a>:</p>
	<?php echo Code::getHtmlStatic('$username = $request-&gt;old(\'username\');'); ?>
	<p>Space MVC also provides a global old helper. If you are displaying old input within a <a href="/docs/5.7/blade">Blade template</a>, it is more convenient to use the old helper. If no old input exists for the given field, null will be returned:</p>
	<?php echo Code::getHtmlStatic('&lt;input type="text" name="username" value="{{ old(\'username\') }}"&gt;'); ?>
	<p><a name="cookies"></a></p>
	<h3>Cookies</h3>
	<h4>Retrieving Cookies From Requests</h4>
	<p>All cookies created by the Space MVC framework are encrypted and signed with an authentication code, meaning they will be considered invalid if they have been changed by the client. To retrieve a cookie value from the request, use the cookie method on a Illuminate\Http\Request instance:</p>
	<?php echo Code::getHtmlStatic('$value = $request-&gt;cookie(\'name\');'); ?>
	<p>Alternatively, you may use the Cookie facade to access cookie values:</p>
	<?php echo Code::getHtmlStatic('$value = Cookie::get(\'name\');'); ?>
	<h4>Attaching Cookies To Responses</h4>
	<p>You may attach a cookie to an outgoing Illuminate\Http\Response instance using the cookie method. You should pass the name, value, and number of minutes the cookie should be considered valid to this method:</p>
	<?php echo Code::getHtmlStatic('return response(\'Hello World\')-&gt;cookie(
    \'name\', \'value\', $minutes
);'); ?>
	<p>The cookie method also accepts a few more arguments which are used less frequently. Generally, these arguments have the same purpose and meaning as the arguments that would be given to PHP's native <a href="https://secure.php.net/manual/en/function.setcookie.php">setcookie</a> method:</p>
	<?php echo Code::getHtmlStatic('return response(\'Hello World\')-&gt;cookie(
    \'name\', \'value\', $minutes, $path, $domain, $secure, $httpOnly
);'); ?>
	<p>Alternatively, you can use the Cookie facade to "queue" cookies for attachment to the outgoing response from your application. The queue method accepts a Cookie instance or the arguments needed to create a Cookie instance. These cookies will be attached to the outgoing response before it is sent to the browser:</p>
	<?php echo Code::getHtmlStatic('Cookie::queue(Cookie::make(\'name\', \'value\', $minutes));

Cookie::queue(\'name\', \'value\', $minutes);'); ?>
	<h4>Generating Cookie Instances</h4>
	<p>If you would like to generate a Symfony\Component\HttpFoundation\Cookie instance that can be given to a response instance at a later time, you may use the global cookie helper. This cookie will not be sent back to the client unless it is attached to a response instance:</p>
	<?php echo Code::getHtmlStatic('$cookie = cookie(\'name\', \'value\', $minutes);

return response(\'Hello World\')-&gt;cookie($cookie);'); ?>
	<p><a name="files"></a></p>
	<h2><a href="#files">Files</a></h2>
	<p><a name="retrieving-uploaded-files"></a></p>
	<h3>Retrieving Uploaded Files</h3>
	<p>You may access uploaded files from a Illuminate\Http\Request instance using the file method or using dynamic properties. The file method returns an instance of the Illuminate\Http\UploadedFile class, which extends the PHP SplFileInfo class and provides a variety of methods for interacting with the file:</p>
	<?php echo Code::getHtmlStatic('$file = $request-&gt;file(\'photo\');

$file = $request-&gt;photo;'); ?>
	<p>You may determine if a file is present on the request using the hasFile method:</p>
	<?php echo Code::getHtmlStatic('if ($request-&gt;hasFile(\'photo\')) {
    //
}'); ?>
	<h4>Validating Successful Uploads</h4>
	<p>In addition to checking if the file is present, you may verify that there were no problems uploading the file via the isValid method:</p>
	<?php echo Code::getHtmlStatic('if ($request-&gt;file(\'photo\')-&gt;isValid()) {
    //
}'); ?>
	<h4>File Paths &amp; Extensions</h4>
	<p>The UploadedFile class also contains methods for accessing the file's fully-qualified path and its extension. The extension method will attempt to guess the file's extension based on its contents. This extension may be different from the extension that was supplied by the client:</p>
	<?php echo Code::getHtmlStatic('$path = $request-&gt;photo-&gt;path();

$extension = $request-&gt;photo-&gt;extension();'); ?>
	<h4>Other File Methods</h4>
	<p>There are a variety of other methods available on UploadedFile instances. Check out the <a href="http://api.symfony.com/3.0/Symfony/Component/HttpFoundation/File/UploadedFile.html">API documentation for the class</a> for more information regarding these methods.</p>
	<p><a name="storing-uploaded-files"></a></p>
	<h3>Storing Uploaded Files</h3>
	<p>To store an uploaded file, you will typically use one of your configured <a href="/docs/5.7/filesystem">filesystems</a>. The UploadedFile class has a store method which will move an uploaded file to one of your disks, which may be a location on your local filesystem or even a cloud storage location like Amazon S3.</p>
	<p>The store method accepts the path where the file should be stored relative to the filesystem's configured root directory. This path should not contain a file name, since a unique ID will automatically be generated to serve as the file name.</p>
	<p>The store method also accepts an optional second argument for the name of the disk that should be used to store the file. The method will return the path of the file relative to the disk's root:</p>
	<?php echo Code::getHtmlStatic('$path = $request-&gt;photo-&gt;store(\'images\');

$path = $request-&gt;photo-&gt;store(\'images\', \'s3\');'); ?>
	<p>If you do not want a file name to be automatically generated, you may use the storeAs method, which accepts the path, file name, and disk name as its arguments:</p>
	<?php echo Code::getHtmlStatic('$path = $request-&gt;photo-&gt;storeAs(\'images\', \'filename.jpg\');

$path = $request-&gt;photo-&gt;storeAs(\'images\', \'filename.jpg\', \'s3\');'); ?>
	<p><a name="configuring-trusted-proxies"></a></p>
	<h2><a href="#configuring-trusted-proxies">Configuring Trusted Proxies</a></h2>
	<p>When running your applications behind a load balancer that terminates TLS / SSL certificates, you may notice your application sometimes does not generate HTTPS links. Typically this is because your application is being forwarded traffic from your load balancer on port 80 and does not know it should generate secure links.</p>
	<p>To solve this, you may use the App\Http\Middleware\TrustProxies middleware that is included in your Space MVC application, which allows you to quickly customize the load balancers or proxies that should be trusted by your application. Your trusted proxies should be listed as an array on the $proxies property of this middleware. In addition to configuring the trusted proxies, you may configure the proxy $headers that should be trusted:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array
     */
    protected $proxies = [
        \'192.168.1.1\',
        \'192.168.1.2\',
    ];

    /**
     * The headers that should be used to detect proxies.
     *
     * @var string
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}'); ?>
	
		 If you are using AWS Elastic Load Balancing, your $headers value should be Request::HEADER_X_FORWARDED_AWS_ELB. For more information on the constants that may be used in the $headers property, check out Symfony's documentation on <a href="http://symfony.com/doc/current/deployment/proxies.html">trusting proxies</a>.</p>
	
	<h4>Trusting All Proxies</h4>
	<p>If you are using Amazon AWS or another "cloud" load balancer provider, you may not know the IP addresses of your actual balancers. In this case, you may use * to trust all proxies:</p>
	<?php echo Code::getHtmlStatic('/**
 * The trusted proxies for this application.
 *
 * @var array
 */
protected $proxies = \'*\';'); ?>
</article>