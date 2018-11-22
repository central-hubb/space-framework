<?php use App\Library\Framework\Component\Code; ?>

<article>
	<h1>Error Handling</h1>
	<h4><a href="#introduction">Introduction</a></h4>
	<p>When you start a new Space MVC project, error and exception handling is already configured for you. The App\Exceptions\Handler class is where all exceptions triggered by your application are logged and then rendered back to the user. We'll dive deeper into this class throughout this documentation.</p>
	<p><a name="configuration"></a></p>
	<h2><a href="#configuration">Configuration</a></h2>
	<p>The debug option in your config/app.php configuration file determines how much information about an error is actually displayed to the user. By default, this option is set to respect the value of the APP_DEBUG environment variable, which is stored in your .env file.</p>
	<p>For local development, you should set the APP_DEBUG environment variable to true. In your production environment, this value should always be false. If the value is set to true in production, you risk exposing sensitive configuration values to your application's end users.</p>
	<p><a name="the-exception-handler"></a></p>
	<h2><a href="#the-exception-handler">The Exception Handler</a></h2>
	<p><a name="report-method"></a></p>
	<h3>The Report Method</h3>
	<p>All exceptions are handled by the App\Exceptions\Handler class. This class contains two methods: report and render. We'll examine each of these methods in detail. The report method is used to log exceptions or send them to an external service like <a href="https://bugsnag.com">Bugsnag</a> or <a href="https://github.com/getsentry/sentry-Space MVC">Sentry</a>. By default, the report method passes the exception to the base class where the exception is logged. However, you are free to log exceptions however you wish.</p>
	<p>For example, if you need to report different types of exceptions in different ways, you may use the PHP instanceof comparison operator:</p>
	<?php echo Code::getHtmlStatic('/**
 * Report or log an exception.
 *
 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
 *
 * @param  \Exception  $exception
 * @return void
 */
public function report(Exception $exception)
{
    if ($exception instanceof CustomException) {
        //
    }

    return parent::report($exception);
}'); ?>
	<p>Instead of making a lot of instanceof checks in your report method, consider using <a href="/docs/5.7/errors#renderable-exceptions">reportable exceptions</a></p>
	<h4>The report Helper</h4>
	<p>Sometimes you may need to report an exception but continue handling the current request. The report helper function allows you to quickly report an exception using your exception handler's report method without rendering an error page:</p>
	<?php echo Code::getHtmlStatic('public function isValid($value)
{
    try {
        // Validate the value...
    } catch (Exception $e) {
        report($e);

        return false;
    }
}'); ?>
	<h4>Ignoring Exceptions By Type</h4>
	<p>The $dontReport property of the exception handler contains an array of exception types that will not be logged. For example, exceptions resulting from 404 errors, as well as several other types of errors, are not written to your log files. You may add other exception types to this array as needed:</p>
	<?php echo Code::getHtmlStatic('/**
 * A list of the exception types that should not be reported.
 *
 * @var array
 */
protected $dontReport = [
    \Illuminate\Auth\AuthenticationException::class,
    \Illuminate\Auth\Access\AuthorizationException::class,
    \Symfony\Component\HttpKernel\Exception\HttpException::class,
    \Illuminate\Database\Eloquent\ModelNotFoundException::class,
    \Illuminate\Validation\ValidationException::class,
];'); ?>
	<p><a name="render-method"></a></p>
	<h3>The Render Method</h3>
	<p>The render method is responsible for converting a given exception into an HTTP response that should be sent back to the browser. By default, the exception is passed to the base class which generates a response for you. However, you are free to check the exception type or return your own custom response:</p>
	<?php echo Code::getHtmlStatic('/**
 * Render an exception into an HTTP response.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \Exception  $exception
 * @return \Illuminate\Http\Response
 */
public function render($request, Exception $exception)
{
    if ($exception instanceof CustomException) {
        return response()-&gt;view(\'errors.custom\', [], 500);
    }

    return parent::render($request, $exception);
}'); ?>
	<p><a name="renderable-exceptions"></a></p>
	<h3>Reportable &amp; Renderable Exceptions</h3>
	<p>Instead of type-checking exceptions in the exception handler's report and render methods, you may define report and render methods directly on your custom exception. When these methods exist, they will be called automatically by the framework:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Exceptions;

use Exception;

class RenderException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response(...);
    }
}'); ?>
	<p><a name="http-exceptions"></a></p>
	<h2><a href="#http-exceptions">HTTP Exceptions</a></h2>
	<p>Some exceptions describe HTTP error codes from the server. For example, this may be a "page not found" error (404), an "unauthorized error" (401) or even a developer generated 500 error. In order to generate such a response from anywhere in your application, you may use the abort helper:</p>
	<?php echo Code::getHtmlStatic('abort(404);'); ?>
	<p>The abort helper will immediately raise an exception which will be rendered by the exception handler. Optionally, you may provide the response text:</p>
	<?php echo Code::getHtmlStatic('abort(403, \'Unauthorized action.\');'); ?>
	<p><a name="custom-http-error-pages"></a></p>
	<h3>Custom HTTP Error Pages</h3>
	<p>Space MVC makes it easy to display custom error pages for various HTTP status codes. For example, if you wish to customize the error page for 404 HTTP status codes, create a resources/views/errors/404.blade.php. This file will be served on all 404 errors generated by your application. The views within this directory should be named to match the HTTP status code they correspond to. The HttpException instance raised by the abort function will be passed to the view as an $exception variable:</p>
	<?php echo Code::getHtmlStatic('&lt;h2&gt;{{ $exception-&gt;getMessage() }}&lt;/h2&gt;'); ?>
</article>