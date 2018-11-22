<?php use App\Library\Framework\Component\Code; ?>

<article>
	<h1>Views</h1>
	<h4>Creating Views</h4>
	<p>Looking for more information on how to write Blade templates? Check out the full <a href="/docs/5.7/blade">Blade documentation</a> to get started.</p>
	<p>Views contain the HTML served by your application and separate your controller / application logic from your presentation logic. Views are stored in the resources/views directory. A simple view might look something like this:</p>
	<?php echo Code::getHtmlStatic('&lt;!-- View stored in resources/views/greeting.blade.php --&gt;

&lt;html&gt;
    &lt;body&gt;
        &lt;h1&gt;Hello, {{ $name }}&lt;/h1&gt;
    &lt;/body&gt;
&lt;/html&gt;'); ?>
	<p>Since this view is stored at resources/views/greeting.blade.php, we may return it using the global view helper like so:</p>
	<?php echo Code::getHtmlStatic('Route::get(\'/\', function () {
    return view(\'greeting\', [\'name\' =&gt; \'James\']);
});'); ?>
	<p>As you can see, the first argument passed to the view helper corresponds to the name of the view file in the resources/views directory. The second argument is an array of data that should be made available to the view. In this case, we are passing the name variable, which is displayed in the view using <a href="/docs/5.7/blade">Blade syntax</a>.</p>
	<p>Of course, views may also be nested within sub-directories of the resources/views directory. "Dot" notation may be used to reference nested views. For example, if your view is stored at resources/views/admin/profile.blade.php, you may reference it like so:</p>
	<?php echo Code::getHtmlStatic('return view(\'admin.profile\', $data);'); ?>
	<h4>Determining If A View Exists</h4>
	<p>If you need to determine if a view exists, you may use the View facade. The exists method will return true if the view exists:</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Support\Facades\View;

if (View::exists(\'emails.customer\')) {
    //
}'); ?>
	<h4>Creating The First Available View</h4>
	<p>Using the first method, you may create the first view that exists in a given array of views. This is useful if your application or package allows views to be customized or overwritten:</p>
	<?php echo Code::getHtmlStatic('return view()-&gt;first([\'custom.admin\', \'admin\'], $data);'); ?>
	<p>Of course, you may also call this method via the View <a href="/docs/5.7/facades">facade</a>:</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Support\Facades\View;

return View::first([\'custom.admin\', \'admin\'], $data);'); ?>
	<p><a name="passing-data-to-views"></a></p>
	<h2><a href="#passing-data-to-views">Passing Data To Views</a></h2>
	<p>As you saw in the previous examples, you may pass an array of data to views:</p>
	<?php echo Code::getHtmlStatic('return view(\'greetings\', [\'name\' =&gt; \'Victoria\']);'); ?>
	<p>When passing information in this manner, the data should be an array with key / value pairs. Inside your view, you can then access each value using its corresponding key, such as &lt;?php echo $key; ?&gt;. As an alternative to passing a complete array of data to the view helper function, you may use the with method to add individual pieces of data to the view:</p>
	<?php echo Code::getHtmlStatic('return view(\'greeting\')-&gt;with(\'name\', \'Victoria\');'); ?>
	<p><a name="sharing-data-with-all-views"></a></p>
	<h4>Sharing Data With All Views</h4>
	<p>Occasionally, you may need to share a piece of data with all views that are rendered by your application. You may do so using the view facade's share method. Typically, you should place calls to share within a service provider's boot method. You are free to add them to the AppServiceProvider or generate a separate service provider to house them:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Providers;

use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share(\'key\', \'value\');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}'); ?>
	<p><a name="view-composers"></a></p>
	<h2><a href="#view-composers">View Composers</a></h2>
	<p>View composers are callbacks or class methods that are called when a view is rendered. If you have data that you want to be bound to a view each time that view is rendered, a view composer can help you organize that logic into a single location.</p>
	<p>For this example, let's register the view composers within a <a href="/docs/5.7/providers">service provider</a>. We'll use the View facade to access the underlying Illuminate\Contracts\View\Factory contract implementation. Remember, Space MVC does not include a default directory for view composers. You are free to organize them however you wish. For example, you could create an app/Http/ViewComposers directory:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer(
            \'profile\', \'App\Http\ViewComposers\ProfileComposer\'
        );

        // Using Closure based composers...
        View::composer(\'dashboard\', function ($view) {
            //
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}'); ?>
	<p>Remember, if you create a new service provider to contain your view composer registrations, you will need to add the service provider to the providers array in the config/app.php configuration file.</p>
	<p>Now that we have registered the composer, the ProfileComposer@compose method will be executed each time the profile view is being rendered. So, let's define the composer class:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;

class ProfileComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        // Dependencies automatically resolved by service container...
        $this-&gt;users = $users;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view-&gt;with(\'count\', $this-&gt;users-&gt;count());
    }
}'); ?>
	<p>Just before the view is rendered, the composer's compose method is called with the Illuminate\View\View instance. You may use the with method to bind data to the view.</p>
	<p>All view composers are resolved via the <a href="/docs/5.7/container">service container</a>, so you may type-hint any dependencies you need within a composer's constructor.</p>
	<h4>Attaching A Composer To Multiple Views</h4>
	<p>You may attach a view composer to multiple views at once by passing an array of views as the first argument to the composer method:</p>
	<?php echo Code::getHtmlStatic('View::composer(
    [\'profile\', \'dashboard\'],
    \'App\Http\ViewComposers\MyViewComposer\'
);'); ?>
	<p>The composer method also accepts the * character as a wildcard, allowing you to attach a composer to all views:</p>
	<?php echo Code::getHtmlStatic('View::composer(\'*\', function ($view) {
    //
});'); ?>
	<h4>View Creators</h4>
	<p>View <strong>creators</strong> are very similar to view composers; however, they are executed immediately after the view is instantiated instead of waiting until the view is about to render. To register a view creator, use the creator method:</p>
	<?php echo Code::getHtmlStatic('View::creator(\'profile\', \'App\Http\ViewCreators\ProfileCreator\');'); ?>
</article>