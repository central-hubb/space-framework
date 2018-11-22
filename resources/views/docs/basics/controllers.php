<?php use App\Library\Framework\Component\Code; ?>

<article>
	<h1>Controllers</h1>
	<p>Instead of defining all of your request handling logic as Closures in route files, you may wish to organize this behavior using Controller classes. Controllers can group related request handling logic into a single class. Controllers are stored in the app/Http/Controllers directory.</p>

	<p><a name="defining-controllers"></a></p>
	<h3>Defining Controllers</h3>
	<p>Below is an example of a basic controller class. Note that the controller extends the base controller class included with Space MVC. The base class provides a few convenience methods such as the  middleware method, which may be used to attach middleware to controller actions:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
        return view(\'user.profile\', [\'user\' =&gt; User::findOrFail($id)]);
    }
}'); ?>
	<p>You can define a route to this controller action like so:</p>
	<?php echo Code::getHtmlStatic('Route::get(\'user/{id}\', \'UserController@show\');'); ?>
	<p>Now, when a request matches the specified route URI, the show method on the UserController class will be executed. Of course, the route parameters will also be passed to the method.</p>
	Controllers are not required to extend a base class. However, you will not have access to convenience features such as the middleware, validate, and dispatch methods.</p>
	<p><a name="controllers-and-namespaces"></a></p>
	<h3>Controllers &amp; Namespaces</h3>
	<p>It is very important to note that we did not need to specify the full controller namespace when defining the controller route. Since the RouteServiceProvider loads your route files within a route group that contains the namespace, we only specified the portion of the class name that comes after the App\Http\Controllers portion of the namespace.</p>
	<p>If you choose to nest your controllers deeper into the <code class=" language-php">App\Http\Controllers</code> directory, use the specific class name relative to the <code class=" language-php">App\Http\Controllers</code> root namespace. So, if your full controller class is <code class=" language-php">App\Http\Controllers\Photos\AdminController</code>, you should register routes to the controller like so:</p>
	<?php echo Code::getHtmlStatic('Route::get(\'foo\', \'Photos\AdminController@method\');'); ?>
	<p><a name="single-action-controllers"></a></p>
</article>