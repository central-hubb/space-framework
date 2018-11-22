<?php use App\Library\Framework\Component\Code; ?>

<article>
	<h1>Middleware</h1>
	<ul>
		<li><a href="#introduction">Introduction</a></li>
		<li><a href="#defining-middleware">Defining Middleware</a></li>
		<li><a href="#registering-middleware">Registering Middleware</a>
			<ul>
				<li><a href="#global-middleware">Global Middleware</a></li>
				<li><a href="#assigning-middleware-to-routes">Assigning Middleware To Routes</a></li>
				<li><a href="#middleware-groups">Middleware Groups</a></li>
			</ul></li>
		<li><a href="#middleware-parameters">Middleware Parameters</a></li>
		<li><a href="#terminable-middleware">Terminable Middleware</a></li>
	</ul>
	<p><a name="introduction"></a></p>
	<h2><a href="#introduction">Introduction</a></h2>
	<p>Middleware provide a convenient mechanism for filtering HTTP requests entering your application. For example, Space MVC includes a middleware that verifies the user of your application is authenticated. If the user is not authenticated, the middleware will redirect the user to the login screen. However, if the user is authenticated, the middleware will allow the request to proceed further into the application.</p>
	<p>Of course, additional middleware can be written to perform a variety of tasks besides authentication. A CORS middleware might be responsible for adding the proper headers to all responses leaving your application. A logging middleware might log all incoming requests to your application.</p>
	<p>There are several middleware included in the Space MVC framework, including middleware for authentication and CSRF protection. All of these middleware are located in the app/Http/Middleware directory.</p>
	<p><a name="defining-middleware"></a></p>
	<h2><a href="#defining-middleware">Defining Middleware</a></h2>
	<p>To create a new middleware, use the make:middleware Artisan command:</p>
	<?php echo Code::getHtmlStatic('php artisan make:middleware CheckAge'); ?>
	<p>This command will place a new CheckAge class within your app/Http/Middleware directory. In this middleware, we will only allow access to the route if the supplied age is greater than 200. Otherwise, we will redirect the users back to the home URI:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Http\Middleware;

use Closure;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request-&gt;age &lt;= 200) {
            return redirect(\'home\');
        }

        return $next($request);
    }
}'); ?>
	<p>As you can see, if the given age is less than or equal to 200, the middleware will return an HTTP redirect to the client; otherwise, the request will be passed further into the application. To pass the request deeper into the application (allowing the middleware to "pass"), call the $next callback with the $request.</p>
	<p>It's best to envision middleware as a series of "layers" HTTP requests must pass through before they hit your application. Each layer can examine the request and even reject it entirely.</p>
	<p>All middleware are resolved via the <a href="/docs/5.7/container">service container</a>, so you may type-hint any dependencies you need within a middleware's constructor.</p>
	<h3>Before &amp; After Middleware</h3>
	<p>Whether a middleware runs before or after a request depends on the middleware itself. For example, the following middleware would perform some task <strong>before</strong> the request is handled by the application:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Http\Middleware;

use Closure;

class BeforeMiddleware
{
    public function handle($request, Closure $next)
    {
        // Perform action

        return $next($request);
    }
}'); ?>
	<p>However, this middleware would perform its task <strong>after</strong> the request is handled by the application:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Http\Middleware;

use Closure;

class AfterMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Perform action

        return $response;
    }
}'); ?>
	<p><a name="registering-middleware"></a></p>
	<h2><a href="#registering-middleware">Registering Middleware</a></h2>
	<p><a name="global-middleware"></a></p>
	<h3>Global Middleware</h3>
	<p>If you want a middleware to run during every HTTP request to your application, list the middleware class in the $middleware property of your app/Http/Kernel.php class.</p>
	<p><a name="assigning-middleware-to-routes"></a></p>
	<h3>Assigning Middleware To Routes</h3>
	<p>If you would like to assign middleware to specific routes, you should first assign the middleware a key in your app/Http/Kernel.php file. By default, the $routeMiddleware property of this class contains entries for the middleware included with Space MVC. To add your own, append it to this list and assign it a key of your choosing:</p>
	<?php echo Code::getHtmlStatic('// Within App\Http\Kernel Class...

protected $routeMiddleware = [
    \'auth\' =&gt; \App\Http\Middleware\Authenticate::class,
    \'auth.basic\' =&gt; \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    \'bindings\' =&gt; \Illuminate\Routing\Middleware\SubstituteBindings::class,
    \'cache.headers\' =&gt; \Illuminate\Http\Middleware\SetCacheHeaders::class,
    \'can\' =&gt; \Illuminate\Auth\Middleware\Authorize::class,
    \'guest\' =&gt; \App\Http\Middleware\RedirectIfAuthenticated::class,
    \'signed\' =&gt; \Illuminate\Routing\Middleware\ValidateSignature::class,
    \'throttle\' =&gt; \Illuminate\Routing\Middleware\ThrottleRequests::class,
    \'verified\' =&gt; \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
];'); ?>
	<p>Once the middleware has been defined in the HTTP kernel, you may use the middleware method to assign middleware to a route:</p>
	<?php echo Code::getHtmlStatic('Route::get(\'admin/profile\', function () {
    //
})-&gt;middleware(\'auth\');'); ?>
	<p>You may also assign multiple middleware to the route:</p>
	<?php echo Code::getHtmlStatic('Route::get(\'/\', function () {
    //
})-&gt;middleware(\'first\', \'second\');'); ?>
	<p>When assigning middleware, you may also pass the fully qualified class name:</p>
	<?php echo Code::getHtmlStatic('use App\Http\Middleware\CheckAge;

Route::get(\'admin/profile\', function () {
    //
})-&gt;middleware(CheckAge::class);'); ?>
	<p><a name="middleware-groups"></a></p>
	<h3>Middleware Groups</h3>
	<p>Sometimes you may want to group several middleware under a single key to make them easier to assign to routes. You may do this using the $middlewareGroups property of your HTTP kernel.</p>
	<p>Out of the box, Space MVC comes with web and api middleware groups that contain common middleware you may want to apply to your web UI and API routes:</p>
	<?php echo Code::getHtmlStatic('/**
 * The application\'s route middleware groups.
 *
 * @var array
 */
protected $middlewareGroups = [
    \'web\' =&gt; [
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],

    \'api\' =&gt; [
        \'throttle:60,1\',
        \'auth:api\',
    ],
];'); ?>
	<p>Middleware groups may be assigned to routes and controller actions using the same syntax as individual middleware. Again, middleware groups make it more convenient to assign many middleware to a route at once:</p>
	<?php echo Code::getHtmlStatic('Route::get(\'/\', function () {
    //
})-&gt;middleware(\'web\');

Route::group([\'middleware\' =&gt; [\'web\']], function () {
    //
});'); ?>
	<p>Out of the box, the web middleware group is automatically applied to your routes/web.php file by the RouteServiceProvider.</p>
	<p><a name="middleware-parameters"></a></p>
	<h2><a href="#middleware-parameters">Middleware Parameters</a></h2>
	<p>Middleware can also receive additional parameters. For example, if your application needs to verify that the authenticated user has a given "role" before performing a given action, you could create a CheckRole middleware that receives a role name as an additional argument.</p>
	<p>Additional middleware parameters will be passed to the middleware after the $next argument:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (! $request-&gt;user()-&gt;hasRole($role)) {
            // Redirect...
        }

        return $next($request);
    }

}'); ?>
	<p>Middleware parameters may be specified when defining the route by separating the middleware name and parameters with a :. Multiple parameters should be delimited by commas:</p>
	<?php echo Code::getHtmlStatic('Route::put(\'post/{id}\', function ($id) {
    //
})-&gt;middleware(\'role:editor\');'); ?>
	<p><a name="terminable-middleware"></a></p>
	<h2><a href="#terminable-middleware">Terminable Middleware</a></h2>
	<p>Sometimes a middleware may need to do some work after the HTTP response has been prepared. For example, the "session" middleware included with Space MVC writes the session data to storage after the response has been fully prepared. If you define a terminate method on your middleware, it will automatically be called after the response is ready to be sent to the browser.</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace Illuminate\Session\Middleware;

use Closure;

class StartSession
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        // Store the session data...
    }
}'); ?>
	<p>The terminate method should receive both the request and the response. Once you have defined a terminable middleware, you should add it to the list of route or global middleware in the app/Http/Kernel.php file.</p>
	<p>When calling the terminate method on your middleware, Space MVC will resolve a fresh instance of the middleware from the <a href="/docs/5.7/container">service container</a>. If you would like to use the same middleware instance when the handle and terminate methods are called, register the middleware with the container using the container's singleton method.</p>
</article>