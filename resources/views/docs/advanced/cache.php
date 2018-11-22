<?php use App\Library\Framework\Component\Code; ?>

<article>
	<h1>Cache</h1>
	<h2>Configuration</h2>
	<p>Space MVC provides an expressive, unified API for various caching backends. The cache configuration is located at config/cache.php. In this file you may specify which cache driver you would like to be used by default throughout your application. Space MVC supports popular caching backends like <a href="https://memcached.org">Memcached</a> and <a href="https://redis.io">Redis</a> out of the box.</p>
	<p>The cache configuration file also contains various other options, which are documented within the file, so make sure to read over these options. By default, Space MVC is configured to use the file cache driver, which stores the serialized, cached objects in the filesystem. For larger applications, it is recommended that you use a more robust driver such as Memcached or Redis. You may even configure multiple cache configurations for the same driver.</p>
	<p><a name="driver-prerequisites"></a></p>
	<h3>Driver Prerequisites</h3>
	<h4>Database</h4>
	<p>When using the database cache driver, you will need to setup a table to contain the cache items. You'll find an example Schema declaration for the table below:</p>
	<?php echo Code::getHtmlStatic('Schema::create(\'cache\', function ($table) {
    $table-&gt;string(\'key\')-&gt;unique();
    $table-&gt;text(\'value\');
    $table-&gt;integer(\'expiration\');
});'); ?>
	<p>You may also use the php artisan cache:table Artisan command to generate a migration with the proper schema.</p>
	<h4>Memcached</h4>
	<p>Using the Memcached driver requires the <a href="https://pecl.php.net/package/memcached">Memcached PECL package</a> to be installed. You may list all of your Memcached servers in the config/cache.php configuration file:</p>
	<?php echo Code::getHtmlStatic('\'memcached\' =&gt; [
    [
        \'host\' =&gt; \'127.0.0.1\',
        \'port\' =&gt; 11211,
        \'weight\' =&gt; 100
    ],
],'); ?>
	<p>You may also set the host option to a UNIX socket path. If you do this, the port option should be set to 0:</p>
	<?php echo Code::getHtmlStatic('\'memcached\' =&gt; [
    [
        \'host\' =&gt; \'/var/run/memcached/memcached.sock\',
        \'port\' =&gt; 0,
        \'weight\' =&gt; 100
    ],
],'); ?>
	<h4>Redis</h4>
	<p>Before using a Redis cache with Space MVC, you will need to either install the predis/predis package (~1.0) via Composer or install the PhpRedis PHP extension via PECL.</p>
	<p>For more information on configuring Redis, consult its <a href="/docs/5.7/redis#configuration">Space MVC documentation page</a>.</p>
	<p><a name="cache-usage"></a></p>
	<h2><a href="#cache-usage">Cache Usage</a></h2>
	<p><a name="obtaining-a-cache-instance"></a></p>
	<h3>Obtaining A Cache Instance</h3>
	<p>The Illuminate\Contracts\Cache\Factory and Illuminate\Contracts\Cache\Repository <a href="/docs/5.7/contracts">contracts</a> provide access to Space MVC's cache services. The Factory contract provides access to all cache drivers defined for your application. The Repository contract is typically an implementation of the default cache driver for your application as specified by your cache configuration file.</p>
	<p>However, you may also use the Cache facade, which is what we will use throughout this documentation. The Cache facade provides convenient, terse access to the underlying implementations of the Space MVC cache contracts:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    /**
     * Show a list of all users of the application.
     *
     * @return Response
     */
    public function index()
    {
        $value = Cache::get(\'key\');

        //
    }
}'); ?>
	<h4>Accessing Multiple Cache Stores</h4>
	<p>Using the Cache facade, you may access various cache stores via the store method. The key passed to the store method should correspond to one of the stores listed in the stores configuration array in your cache configuration file:</p>
	<?php echo Code::getHtmlStatic('$value = Cache::store(\'file\')-&gt;get(\'foo\');

Cache::store(\'redis\')-&gt;put(\'bar\', \'baz\', 10);'); ?>
	<p><a name="retrieving-items-from-the-cache"></a></p>
	<h3>Retrieving Items From The Cache</h3>
	<p>The get method on the Cache facade is used to retrieve items from the cache. If the item does not exist in the cache, null will be returned. If you wish, you may pass a second argument to the get method specifying the default value you wish to be returned if the item doesn't exist:</p>
	<?php echo Code::getHtmlStatic('$value = Cache::get(\'key\');

$value = Cache::get(\'key\', \'default\');'); ?>
	<p>You may even pass a Closure as the default value. The result of the Closure will be returned if the specified item does not exist in the cache. Passing a Closure allows you to defer the retrieval of default values from a database or other external service:</p>
	<?php echo Code::getHtmlStatic('$value = Cache::get(\'key\', function () {
    return DB::table(...)-&gt;get();
});'); ?>
	<h4>Checking For Item Existence</h4>
	<p>The has method may be used to determine if an item exists in the cache. This method will return false if the value is null or false:</p>
	<?php echo Code::getHtmlStatic('if (Cache::has(\'key\')) {
    //
}'); ?>
	<h4>Incrementing / Decrementing Values</h4>
	<p>The increment and decrement methods may be used to adjust the value of integer items in the cache. Both of these methods accept an optional second argument indicating the amount by which to increment or decrement the item's value:</p>
	<?php echo Code::getHtmlStatic('Cache::increment(\'key\');
Cache::increment(\'key\', $amount);
Cache::decrement(\'key\');
Cache::decrement(\'key\', $amount);'); ?>
	<h4>Retrieve &amp; Store</h4>
	<p>Sometimes you may wish to retrieve an item from the cache, but also store a default value if the requested item doesn't exist. For example, you may wish to retrieve all users from the cache or, if they don't exist, retrieve them from the database and add them to the cache. You may do this using the Cache::remember method:</p>
	<?php echo Code::getHtmlStatic('$value = Cache::remember(\'users\', $minutes, function () {
    return DB::table(\'users\')-&gt;get();
});'); ?>
	<p>If the item does not exist in the cache, the Closure passed to the remember method will be executed and its result will be placed in the cache.</p>
	<p>You may use the rememberForever method to retrieve an item from the cache or store it forever:</p>
	<?php echo Code::getHtmlStatic('$value = Cache::rememberForever(\'users\', function () {
    return DB::table(\'users\')-&gt;get();
});'); ?>
	<h4>Retrieve &amp; Delete</h4>
	<p>If you need to retrieve an item from the cache and then delete the item, you may use the pull method. Like the get method, null will be returned if the item does not exist in the cache:</p>
	<?php echo Code::getHtmlStatic('$value = Cache::pull(\'key\');'); ?>
	<p><a name="storing-items-in-the-cache"></a></p>
	<h3>Storing Items In The Cache</h3>
	<p>You may use the put method on the Cache facade to store items in the cache. When you place an item in the cache, you need to specify the number of minutes for which the value should be cached:</p>
	<?php echo Code::getHtmlStatic('Cache::put(\'key\', \'value\', $minutes);'); ?>
	<p>Instead of passing the number of minutes as an integer, you may also pass a DateTime instance representing the expiration time of the cached item:</p>
	<?php echo Code::getHtmlStatic('$expiresAt = now()-&gt;addMinutes(10);

Cache::put(\'key\', \'value\', $expiresAt);'); ?>
	<h4>Store If Not Present</h4>
	<p>The add method will only add the item to the cache if it does not already exist in the cache store. The method will return true if the item is actually added to the cache. Otherwise, the method will return false:</p>
	<?php echo Code::getHtmlStatic('Cache::add(\'key\', \'value\', $minutes);'); ?>
	<h4>Storing Items Forever</h4>
	<p>The forever method may be used to store an item in the cache permanently. Since these items will not expire, they must be manually removed from the cache using the forget method:</p>
	<?php echo Code::getHtmlStatic('Cache::forever(\'key\', \'value\');'); ?>
	<p>If you are using the Memcached driver, items that are stored "forever" may be removed when the cache reaches its size limit.</p>
	<p><a name="removing-items-from-the-cache"></a></p>
	<h3>Removing Items From The Cache</h3>
	<p>You may remove items from the cache using the forget method:</p>
	<?php echo Code::getHtmlStatic('Cache::forget(\'key\');'); ?>
	<p>You may clear the entire cache using the flush method:</p>
	<?php echo Code::getHtmlStatic('Cache::flush();'); ?>
	<p>Flushing the cache does not respect the cache prefix and will remove all entries from the cache. Consider this carefully when clearing a cache which is shared by other applications.</p>
	<p><a name="atomic-locks"></a></p>
	<h3>Atomic Locks</h3>
	<p>To utilize this feature, your application must be using the memcached or redis cache driver as your application's default cache driver. In addition, all servers must be communicating with the same central cache server.</p>
	<p>Atomic locks allow for the manipulation of distributed locks without worrying about race conditions. For example, <a href="https://forge.space-mvc.com">Space MVC</a> uses atomic locks to ensure that only one remote task is being executed on a server at a time. You may create and manage locks using the Cache::lock method:</p>
	<?php echo Code::getHtmlStatic('if (Cache::lock(\'foo\', 10)-&gt;get()) {
    // Lock acquired for 10 seconds...

    Cache::lock(\'foo\')-&gt;release();
}'); ?>
	<p>The get method also accepts a Closure. After the Closure is executed, Space MVC will automatically release the lock:</p>
	<?php echo Code::getHtmlStatic('Cache::lock(\'foo\')-&gt;get(function () {
    // Lock acquired indefinitely and automatically released...
});'); ?>
	<p>If the lock is not available at the moment you request it, you may instruct Space MVC to wait for a specified number of seconds. If the lock can not be acquired within the specified time limit, an Illuminate\Contracts\Cache\LockTimeoutException will be thrown:</p>
	<?php echo Code::getHtmlStatic('if (Cache::lock(\'foo\', 10)-&gt;block(5)) {
    // Lock acquired after waiting maximum of 5 seconds...
}

Cache::lock(\'foo\', 10)-&gt;block(5, function () {
    // Lock acquired after waiting maximum of 5 seconds...
});'); ?>
	<p><a name="the-cache-helper"></a></p>
	<h3>The Cache Helper</h3>
	<p>In addition to using the Cache facade or <a href="/docs/5.7/contracts">cache contract</a>, you may also use the global cache function to retrieve and store data via the cache. When the cache function is called with a single, string argument, it will return the value of the given key:</p>
	<?php echo Code::getHtmlStatic('$value = cache(\'key\');'); ?>
	<p>If you provide an array of key / value pairs and an expiration time to the function, it will store values in the cache for the specified duration:</p>
	<?php echo Code::getHtmlStatic('cache([\'key\' =&gt; \'value\'], $minutes);

cache([\'key\' =&gt; \'value\'], now()-&gt;addSeconds(10));'); ?>
	<p>When the cache function is called without any arguments, it returns an instance of the Illuminate\Contracts\Cache\Factory implementation, allowing you to all other caching methods:</p>
	<?php echo Code::getHtmlStatic('cache()-&gt;remember(\'users\', $minutes, function () {
    return DB::table(\'users\')-&gt;get();
});'); ?>
	<p>When testing call to the global cache function, you may use the Cache::shouldReceive method just as if you were <a href="/docs/5.7/mocking#mocking-facades">testing a facade</a>.</p>
	<p><a name="cache-tags"></a></p>
	<h2><a href="#cache-tags">Cache Tags</a></h2>
	<blockquote class="has-icon">
		<p><div class="flag"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="90px" height="90px" viewBox="0 0 90 90" enable-background="new 0 0 90 90" xml:space="preserve"><path fill="#FFFFFF" d="M45 0C20.1 0 0 20.1 0 45s20.1 45 45 45 45-20.1 45-45S69.9 0 45 0zM45 74.5c-3.6 0-6.5-2.9-6.5-6.5s2.9-6.5 6.5-6.5 6.5 2.9 6.5 6.5S48.6 74.5 45 74.5zM52.1 23.9l-2.5 29.6c0 2.5-2.1 4.6-4.6 4.6 -2.5 0-4.6-2.1-4.6-4.6l-2.5-29.6c-0.1-0.4-0.1-0.7-0.1-1.1 0-4 3.2-7.2 7.2-7.2 4 0 7.2 3.2 7.2 7.2C52.2 23.1 52.2 23.5 52.1 23.9z"></path></svg></div> Cache tags are not supported when using the file or database cache drivers. Furthermore, when using multiple tags with caches that are stored "forever", performance will be best with a driver such as memcached, which automatically purges stale records.</p>
	</blockquote>
	<p><a name="storing-tagged-cache-items"></a></p>
	<h3>Storing Tagged Cache Items</h3>
	<p>Cache tags allow you to tag related items in the cache and then flush all cached values that have been assigned a given tag. You may access a tagged cache by passing in an ordered array of tag names. For example, let's access a tagged cache and put value in the cache:</p>
	<?php echo Code::getHtmlStatic('Cache::tags([\'people\', \'artists\'])-&gt;put(\'John\', $john, $minutes);

Cache::tags([\'people\', \'authors\'])-&gt;put(\'Anne\', $anne, $minutes);'); ?>
	<p><a name="accessing-tagged-cache-items"></a></p>
	<h3>Accessing Tagged Cache Items</h3>
	<p>To retrieve a tagged cache item, pass the same ordered list of tags to the tags method and then call the get method with the key you wish to retrieve:</p>
	<?php echo Code::getHtmlStatic('$john = Cache::tags([\'people\', \'artists\'])-&gt;get(\'John\');

$anne = Cache::tags([\'people\', \'authors\'])-&gt;get(\'Anne\');'); ?>
	<p><a name="removing-tagged-cache-items"></a></p>
	<h3>Removing Tagged Cache Items</h3>
	<p>You may flush all items that are assigned a tag or list of tags. For example, this statement would remove all caches tagged with either people, authors, or both. So, both Anne and John would be removed from the cache:</p>
	<?php echo Code::getHtmlStatic('Cache::tags([\'people\', \'authors\'])-&gt;flush();'); ?>
	<p>In contrast, this statement would remove only caches tagged with authors, so Anne would be removed, but not John:</p>
	<?php echo Code::getHtmlStatic('Cache::tags(\'authors\')-&gt;flush();'); ?>
	<p><a name="adding-custom-cache-drivers"></a></p>
	<h2><a href="#adding-custom-cache-drivers">Adding Custom Cache Drivers</a></h2>
	<p><a name="writing-the-driver"></a></p>
	<h3>Writing The Driver</h3>
	<p>To create our custom cache driver, we first need to implement the Illuminate\Contracts\Cache\Store <a href="/docs/5.7/contracts">contract</a>. So, a MongoDB cache implementation would look something like this:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Extensions;

use Illuminate\Contracts\Cache\Store;

class MongoStore implements Store
{
    public function get($key) {}
    public function many(array $keys);
    public function put($key, $value, $minutes) {}
    public function putMany(array $values, $minutes);
    public function increment($key, $value = 1) {}
    public function decrement($key, $value = 1) {}
    public function forever($key, $value) {}
    public function forget($key) {}
    public function flush() {}
    public function getPrefix() {}
}'); ?>
	<p>We just need to implement each of these methods using a MongoDB connection. For an example of how to implement each of these methods, take a look at the Illuminate\Cache\MemcachedStore in the framework source code. Once our implementation is complete, we can finish our custom driver registration.</p>
	<?php echo Code::getHtmlStatic('Cache::extend(\'mongo\', function ($app) {
    return Cache::repository(new MongoStore);
});'); ?>
	<p>If you're wondering where to put your custom cache driver code, you could create an Extensions namespace within your app directory. However, keep in mind that Space MVC does not have a rigid application structure and you are free to organize your application according to your preferences.</p>
	<p><a name="registering-the-driver"></a></p>
	<h3>Registering The Driver</h3>
	<p>To register the custom cache driver with Space MVC, we will use the extend method on the Cache facade. The call to Cache::extend could be done in the boot method of the default App\Providers\AppServiceProvider that ships with fresh Space MVC applications, or you may create your own service provider to house the extension - just don't forget to register the provider in the config/app.php provider array:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Providers;

use App\Extensions\MongoStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Cache::extend(\'mongo\', function ($app) {
            return Cache::repository(new MongoStore);
        });
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}'); ?>
	<p>The first argument passed to the extend method is the name of the driver. This will correspond to your driver option in the config/cache.php configuration file. The second argument is a Closure that should return an Illuminate\Cache\Repository instance. The Closure will be passed an $app instance, which is an instance of the <a href="/docs/5.7/container">service container</a>.</p>
	<p>Once your extension is registered, update your config/cache.php configuration file's driver option to the name of your extension.</p>
	<p><a name="events"></a></p>
	<h2><a href="#events">Events</a></h2>
	<p>To execute code on every cache operation, you may listen for the <a href="/docs/5.7/events">events</a> fired by the cache. Typically, you should place these event listeners within your EventServiceProvider:</p>
	<?php echo Code::getHtmlStatic('/**
 * The event listener mappings for the application.
 *
 * @var array
 */
protected $listen = [
    \'Illuminate\Cache\Events\CacheHit\' =&gt; [
        \'App\Listeners\LogCacheHit\',
    ],

    \'Illuminate\Cache\Events\CacheMissed\' =&gt; [
        \'App\Listeners\LogCacheMissed\',
    ],

    \'Illuminate\Cache\Events\KeyForgotten\' =&gt; [
        \'App\Listeners\LogKeyForgotten\',
    ],

    \'Illuminate\Cache\Events\KeyWritten\' =&gt; [
        \'App\Listeners\LogKeyWritten\',
    ],
];'); ?>
</article>