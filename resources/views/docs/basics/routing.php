<?php use App\Library\Framework\Component\Code; ?>

<article>
    <h1>Routing</h1>
    <p><a name="basic-routing"></a></p>
    <h2><a href="#basic-routing">Basic Routing</a></h2>
    <p>The most basic Laravel routes accept a URI and a Closure, providing a very
        simple and expressive method of defining routes:</p>
    <?php echo Code::getHtmlStatic('&#x3C;?php
    return [

        // introduction
        [
            \'uri\' => \'/docs/introduction/what-is-space\',
            \'controller\' => \'Docs\IntroductionController\',
            \'action\' => \'whatIsSpace\',
        ],

        // getting started
        [
            \'uri\' => \'/docs/getting-started/installation\',
            \'controller\' => \'Docs\IndexController\',
            \'action\' => \'installation\',
        ],
'); ?>


    <?php echo Code::getHtmlStatic('Route::get(\'foo\', function () {
    return \'Hello World\';
});'); ?>

    <h4>The Default Route Files</h4>
    <p>
        All Laravel routes are defined in your route files, which are located in the routes directory. These files are
        automatically loaded by the framework. The  routes/web.php file defines routes that are for your web interface.
        These routes are assigned the web middleware group, which provides features like session state and CSRF protection.
        The routes in routes/api.php are stateless and are assigned the api middleware group.

        For most applications, you will begin by defining routes in your routes/web.php file. The routes defined in
        routes/web.php may be accessed by entering the defined route's URL in your browser. For example, you may access
        the following route by navigating to http://your-app.test/user in your browser:
    </p>

    <?php echo Code::getHtmlStatic('Route::get(\'/user\', \'UserController@index\');'); ?>


    <p>
        Routes defined in the routes/api.php file are nested within a route group by the  RouteServiceProvider.
        Within this group, the /api URI prefix is automatically applied so you do not need to manually apply it to
        every route in the file. You may modify the prefix and other route group options by modifying your
        RouteServiceProvider class.
    </p>
    <h4>Available Router Methods</h4>
    <p>The router allows you to register routes that respond to any HTTP verb:</p>


    <?php echo Code::getHtmlStatic('Route::get($uri, $callback);
Route::post($uri, $callback);
Route::put($uri, $callback);
Route::patch($uri, $callback);
Route::delete($uri, $callback);
Route::options($uri, $callback);'); ?>


    <p>Sometimes you may need to register a route that responds to multiple HTTP verbs. You may do so using the match method. Or, you may even register a route that responds to all HTTP verbs using the any method:</p>
    <?php echo Code::getHtmlStatic('Route::match([\'get\', \'post\'], \'/\', function () {
    //
});

Route::any(\'foo\', function () {
    //
});'); ?>
    <h4>CSRF Protection</h4>
    <p>Any HTML forms pointing to POST, PUT, or DELETE routes that are defined in the web routes file should include a CSRF token field. Otherwise, the request will be rejected. You can read more about CSRF protection in the <a href="/docs/5.7/csrf">CSRF documentation</a>:</p>
    <?php echo Code::getHtmlStatic('<form method="POST" action="/profile">
    @csrf
    ...
</form>'); ?>
    <p><a name="redirect-routes"></a></p>
    <h3>Redirect Routes</h3>
    <p>If you are defining a route that redirects to another URI, you may use the Route::redirect method. This method provides a convenient shortcut so that you do not have to define a full route or controller for performing a simple redirect:</p>
    <?php echo Code::getHtmlStatic('Route::redirect(\'/here\', \'/there\', 301);'); ?>
    <p><a name="view-routes"></a></p>
    <h3>View Routes</h3>
    <p>If your route only needs to return a view, you may use the Route::view method. Like the redirect method, this method provides a simple shortcut so that you do not have to define a full route or controller. The view method accepts a URI as its first argument and a view name as its second argument. In addition, you may provide an array of data to pass to the view as an optional third argument:</p>
    <?php echo Code::getHtmlStatic('Route::view(\'/welcome\', \'welcome\');

Route::view(\'/welcome\', \'welcome\', [\'name\' =&gt; \'Taylor\']);'); ?>
    <p><a name="route-parameters"></a></p>
    <h2><a href="#route-parameters">Route Parameters</a></h2>
    <p><a name="required-parameters"></a></p>
    <h3>Required Parameters</h3>
    <p>Of course, sometimes you will need to capture segments of the URI within your route. For example, you may need to capture a user's ID from the URL. You may do so by defining route parameters:</p>
    <?php echo Code::getHtmlStatic('Route::get(\'user/{id}\', function ($id) {
    return \'User \'.$id;
});'); ?>
    <p>You may define as many route parameters as required by your route:</p>
    <?php echo Code::getHtmlStatic('Route::get(\'posts/{post}/comments/{comment}\', function ($postId, $commentId) {
    //
});'); ?>
    <p>Route parameters are always encased within {} braces and should consist of alphabetic characters, and may not contain a - character. Instead of using the - character, use an underscore (_). Route parameters are injected into route callbacks / controllers based on their order - the names of the callback / controller arguments do not matter.</p>
    <p><a name="parameters-optional-parameters"></a></p>
    <h3>Optional Parameters</h3>
    <p>Occasionally you may need to specify a route parameter, but make the presence of that route parameter optional. You may do so by placing a ? mark after the parameter name. Make sure to give the route's corresponding variable a default value:</p>
    <?php echo Code::getHtmlStatic('Route::get(\'user/{name?}\', function ($name = null) {
    return $name;
});

Route::get(\'user/{name?}\', function ($name = \'John\') {
    return $name;
});'); ?>
    <p><a name="parameters-regular-expression-constraints"></a></p>
    <h3>Regular Expression Constraints</h3>
    <p>You may constrain the format of your route parameters using the where method on a route instance. The where method accepts the name of the parameter and a regular expression defining how the parameter should be constrained:</p>
    <?php echo Code::getHtmlStatic('Route::get(\'user/{name}\', function ($name) {
    //
})-&gt;where(\'name\', \'[A-Za-z]+\');

Route::get(\'user/{id}\', function ($id) {
    //
})-&gt;where(\'id\', \'[0-9]+\');

Route::get(\'user/{id}/{name}\', function ($id, $name) {
    //
})-&gt;where([\'id\' =&gt; \'[0-9]+\', \'name\' =&gt; \'[a-z]+\']);'); ?>
    <p><a name="parameters-global-constraints"></a></p>
    <h4>Global Constraints</h4>
    <p>If you would like a route parameter to always be constrained by a given regular expression, you may use the pattern method. You should define these patterns in the boot method of your RouteServiceProvider:</p>
    <?php echo Code::getHtmlStatic('/**
 * Define your route model bindings, pattern filters, etc.
 *
 * @return void
 */
public function boot()
{
    Route::pattern(\'id\', \'[0-9]+\');

    parent::boot();
}'); ?>
    <p>Once the pattern has been defined, it is automatically applied to all routes using that parameter name:</p>
    <?php echo Code::getHtmlStatic('Route::get(\'user/{id}\', function ($id) {
    // Only executed if {id} is numeric...
});'); ?>
    <p><a name="named-routes"></a></p>
    <h2><a href="#named-routes">Named Routes</a></h2>
    <p>Named routes allow the convenient generation of URLs or redirects for specific routes. You may specify a name for a route by chaining the name method onto the route definition:</p>
    <?php echo Code::getHtmlStatic('Route::get(\'user/profile\', function () {
    //
})-&gt;name(\'profile\');'); ?>
    <p>You may also specify route names for controller actions:</p>
    <?php echo Code::getHtmlStatic('Route::get(\'user/profile\', \'UserProfileController@show\')-&gt;name(\'profile\');'); ?>
    <h4>Generating URLs To Named Routes</h4>
    <p>Once you have assigned a name to a given route, you may use the route's name when generating URLs or redirects via the global route function:</p>
    <?php echo Code::getHtmlStatic('// Generating URLs...
$url = route(\'profile\');

// Generating Redirects...
return redirect()-&gt;route(\'profile\');'); ?>
    <p>If the named route defines parameters, you may pass the parameters as the second argument to the route function. The given parameters will automatically be inserted into the URL in their correct positions:</p>
    <?php echo Code::getHtmlStatic('Route::get(\'user/{id}/profile\', function ($id) {
    //
})-&gt;name(\'profile\');

$url = route(\'profile\', [\'id\' =&gt; 1]);'); ?>
    <h4>Inspecting The Current Route</h4>
    <p>If you would like to determine if the current request was routed to a given named route, you may use the named method on a Route instance. For example, you may check the current route name from a route middleware:</p>
    <?php echo Code::getHtmlStatic('/**
 * Handle an incoming request.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \Closure  $next
 * @return mixed
 */
public function handle($request, Closure $next)
{
    if ($request-&gt;route()-&gt;named(\'profile\')) {
        //
    }

    return $next($request);
}'); ?>
    <p><a name="route-groups"></a></p>
    <h2><a href="#route-groups">Route Groups</a></h2>
    <p>Route groups allow you to share route attributes, such as middleware or namespaces, across a large number of routes without needing to define those attributes on each individual route. Shared attributes are specified in an array format as the first parameter to the Route::group method.</p>
    <p><a name="route-group-middleware"></a></p>
    <h3>Middleware</h3>
    <p>To assign middleware to all routes within a group, you may use the middleware method before defining the group. Middleware are executed in the order they are listed in the array:</p>
    <?php echo Code::getHtmlStatic('Route::middleware([\'first\', \'second\'])-&gt;group(function () {
    Route::get(\'/\', function () {
        // Uses first &amp; second Middleware
    });

    Route::get(\'user/profile\', function () {
        // Uses first &amp; second Middleware
    });
});'); ?>
    <p><a name="route-group-namespaces"></a></p>
    <h3>Namespaces</h3>
    <p>Another common use-case for route groups is assigning the same PHP namespace to a group of controllers using the namespace method:</p>
    <?php echo Code::getHtmlStatic('Route::namespace(\'Admin\')-&gt;group(function () {
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
});'); ?>
    <p>Remember, by default, the RouteServiceProvider includes your route files within a namespace group, allowing you to register controller routes without specifying the full App\Http\Controllers namespace prefix. So, you only need to specify the portion of the namespace that comes after the base App\Http\Controllers namespace.</p>
    <p><a name="route-group-sub-domain-routing"></a></p>
    <h3>Sub-Domain Routing</h3>
    <p>Route groups may also be used to handle sub-domain routing. Sub-domains may be assigned route parameters just like route URIs, allowing you to capture a portion of the sub-domain for usage in your route or controller. The sub-domain may be specified by calling the domain method before defining the group:</p>
    <?php echo Code::getHtmlStatic('Route::domain(\'{account}.myapp.com\')-&gt;group(function () {
    Route::get(\'user/{id}\', function ($account, $id) {
        //
    });
});'); ?>
    <p><a name="route-group-prefixes"></a></p>
    <h3>Route Prefixes</h3>
    <p>The prefix method may be used to prefix each route in the group with a given URI. For example, you may want to prefix all route URIs within the group with admin:</p>
    <?php echo Code::getHtmlStatic('Route::prefix(\'admin\')-&gt;group(function () {
    Route::get(\'users\', function () {
        // Matches The "/admin/users" URL
    });
});'); ?>
    <p><a name="route-group-name-prefixes"></a></p>
    <h3>Route Name Prefixes</h3>
    <p>The name method may be used to prefix each route name in the group with a given string. For example, you may want to prefix all of the grouped route's names with admin. The given string is prefixed to the route name exactly as it is specified, so we will be sure to provide the trailing . character in the prefix:</p>
    <?php echo Code::getHtmlStatic('Route::name(\'admin.\')-&gt;group(function () {
    Route::get(\'users\', function () {
        // Route assigned name "admin.users"...
    })-&gt;name(\'users\');
});'); ?>
    <p><a name="route-model-binding"></a></p>
    <h2><a href="#route-model-binding">Route Model Binding</a></h2>
    <p>When injecting a model ID to a route or controller action, you will often query to retrieve the model that corresponds to that ID. Laravel route model binding provides a convenient way to automatically inject the model instances directly into your routes. For example, instead of injecting a user's ID, you can inject the entire User model instance that matches the given ID.</p>
    <p><a name="implicit-binding"></a></p>
    <h3>Implicit Binding</h3>
    <p>Laravel automatically resolves Eloquent models defined in routes or controller actions whose type-hinted variable names match a route segment name. For example:</p>
    <?php echo Code::getHtmlStatic('Route::get(\'api/users/{user}\', function (App\User $user) {
    return $user-&gt;email;
});'); ?>
    <p>Since the $user variable is type-hinted as the App\User Eloquent model and the variable name matches the {user} URI segment, Laravel will automatically inject the model instance that has an ID matching the corresponding value from the request URI. If a matching model instance is not found in the database, a 404 HTTP response will automatically be generated.</p>
    <h4>Customizing The Key Name</h4>
    <p>If you would like model binding to use a database column other than id when retrieving a given model class, you may override the getRouteKeyName method on the Eloquent model:</p>
    <?php echo Code::getHtmlStatic('/**
 * Get the route key for the model.
 *
 * @return string
 */
public function getRouteKeyName()
{
    return \'slug\';
}'); ?>
    <p><a name="explicit-binding"></a></p>
    <h3>Explicit Binding</h3>
    <p>To register an explicit binding, use the router's model method to specify the class for a given parameter. You should define your explicit model bindings in the boot method of the RouteServiceProvider class:</p>
    <?php echo Code::getHtmlStatic('public function boot()
{
    parent::boot();

    Route::model(\'user\', App\User::class);
}'); ?>
    <p>Next, define a route that contains a {user} parameter:</p>
    <?php echo Code::getHtmlStatic('Route::get(\'profile/{user}\', function (App\User $user) {
    //
});'); ?>
    <p>Since we have bound all {user} parameters to the App\User model, a User instance will be injected into the route. So, for example, a request to profile/1 will inject the User instance from the database which has an ID of 1.</p>
    <p>If a matching model instance is not found in the database, a 404 HTTP response will be automatically generated.</p>
    <h4>Customizing The Resolution Logic</h4>
    <p>If you wish to use your own resolution logic, you may use the Route::bind method. The Closure you pass to the bind method will receive the value of the URI segment and should return the instance of the class that should be injected into the route:</p>
    <?php echo Code::getHtmlStatic('public function boot()
{
    parent::boot();

    Route::bind(\'user\', function ($value) {
        return App\User::where(\'name\', $value)-&gt;first() ?? abort(404);
    });
}'); ?>
    <p><a name="fallback-routes"></a></p>
    <h2><a href="#fallback-routes">Fallback Routes</a></h2>
    <p>Using the Route::fallback method, you may define a route that will be executed when no other route matches the incoming request. Typically, unhandled requests will automatically render a "404" page via your application's exception handler. However, since you may define the fallback route within your routes/web.php file, all middleware in the web middleware group will apply to the route. Of course, you are free to add additional middleware to this route as needed:</p>
    <?php echo Code::getHtmlStatic('Route::fallback(function () {
    //
});'); ?>
    <p><a name="rate-limiting"></a></p>
    <h2><a href="#rate-limiting">Rate Limiting</a></h2>
    <p>Laravel includes a <a href="/docs/5.7/middleware">middleware</a> to rate limit access to routes within your application. To get started, assign the throttle middleware to a route or a group of routes. The throttle middleware accepts two parameters that determine the maximum number of requests that can be made in a given number of minutes. For example, let's specify that an authenticated user may access the following group of routes 60 times per minute:</p>
    <?php echo Code::getHtmlStatic('Route::middleware(\'auth:api\', \'throttle:60,1\')-&gt;group(function () {
    Route::get(\'/user\', function () {
        //
    });
});'); ?>
    <h4>Dynamic Rate Limiting</h4>
    <p>You may specify a dynamic request maximum based on an attribute of the authenticated User model. For example, if your User model contains a rate_limit attribute, you may pass the name of the attribute to the throttle middleware so that it is used to calculate the maximum request count:</p>
    <?php echo Code::getHtmlStatic('Route::middleware(\'auth:api\', \'throttle:rate_limit,1\')-&gt;group(function () {
    Route::get(\'/user\', function () {
        //
    });
});'); ?>
    <p><a name="form-method-spoofing"></a></p>
    <h2><a href="#form-method-spoofing">Form Method Spoofing</a></h2>
    <p>HTML forms do not support PUT, PATCH or DELETE actions. So, when defining PUT, PATCH or DELETE routes that are called from an HTML form, you will need to add a hidden _method field to the form. The value sent with the _method field will be used as the HTTP request method:</p>
    <?php echo Code::getHtmlStatic('&lt;form action="/foo/bar" method="POST"&gt;
    &lt;input type="hidden" name="_method" value="PUT"&gt;
    &lt;input type="hidden" name="_token" value="{{ csrf_token() }}"&gt;
&lt;/form&gt;'); ?>
    <p>You may use the @method Blade directive to generate the _method input:</p>
    <?php echo Code::getHtmlStatic('&lt;form action="/foo/bar" method="POST"&gt;
    @method(\'PUT\')
    @csrf
&lt;/form&gt;'); ?>
    <p><a name="accessing-the-current-route"></a></p>
    <h2><a href="#accessing-the-current-route">Accessing The Current Route</a></h2>
    <p>You may use the current, currentRouteName, and currentRouteAction methods on the Route facade to access information about the route handling the incoming request:</p>
    <?php echo Code::getHtmlStatic('$route = Route::current();

$name = Route::currentRouteName();

$action = Route::currentRouteAction();'); ?>
    <p>Refer to the API documentation for both the <a href="https://laravel.com/api/5.7/Illuminate/Routing/Router.html">underlying class of the Route facade</a> and <a href="https://laravel.com/api/5.7/Illuminate/Routing/Route.html">Route instance</a> to review all accessible methods.</p>
</article>


