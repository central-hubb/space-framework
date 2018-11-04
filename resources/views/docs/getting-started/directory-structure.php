<article>
    <h1>Directory Structure</h1>
    <ul>
        <li><a href="#introduction">Introduction</a></li>
        <li><a href="#the-root-directory">The Root Directory</a>
            <ul>
                <li><a href="#the-root-app-directory">The <code class=" language-php">app</code> Directory</a></li>
                <li><a href="#the-bootstrap-directory">The <code class=" language-php">bootstrap</code> Directory</a>
                </li>
                <li><a href="#the-config-directory">The <code class=" language-php">config</code> Directory</a></li>
                <li><a href="#the-database-directory">The <code class=" language-php">database</code> Directory</a></li>
                <li><a href="#the-public-directory">The <code class=" language-php"><span
                                    class="token keyword">public</span></code> Directory</a></li>
                <li><a href="#the-resources-directory">The <code class=" language-php">resources</code> Directory</a>
                </li>
                <li><a href="#the-routes-directory">The <code class=" language-php">routes</code> Directory</a></li>
                <li><a href="#the-storage-directory">The <code class=" language-php">storage</code> Directory</a></li>
                <li><a href="#the-tests-directory">The <code class=" language-php">tests</code> Directory</a></li>
                <li><a href="#the-vendor-directory">The <code class=" language-php">vendor</code> Directory</a></li>
            </ul>
        </li>
        <li><a href="#the-app-directory">The App Directory</a>
            <ul>
                <li><a href="#the-broadcasting-directory">The <code class=" language-php">Broadcasting</code> Directory</a>
                </li>
                <li><a href="#the-console-directory">The <code class=" language-php">Console</code> Directory</a></li>
                <li><a href="#the-events-directory">The <code class=" language-php">Events</code> Directory</a></li>
                <li><a href="#the-exceptions-directory">The <code class=" language-php">Exceptions</code> Directory</a>
                </li>
                <li><a href="#the-http-directory">The <code class=" language-php">Http</code> Directory</a></li>
                <li><a href="#the-jobs-directory">The <code class=" language-php">Jobs</code> Directory</a></li>
                <li><a href="#the-listeners-directory">The <code class=" language-php">Listeners</code> Directory</a>
                </li>
                <li><a href="#the-mail-directory">The <code class=" language-php">Mail</code> Directory</a></li>
                <li><a href="#the-notifications-directory">The <code class=" language-php">Notifications</code>
                        Directory</a></li>
                <li><a href="#the-policies-directory">The <code class=" language-php">Policies</code> Directory</a></li>
                <li><a href="#the-providers-directory">The <code class=" language-php">Providers</code> Directory</a>
                </li>
                <li><a href="#the-rules-directory">The <code class=" language-php">Rules</code> Directory</a></li>
            </ul>
        </li>
    </ul>
    <p><a name="introduction"></a></p>
    <h2><a href="#introduction">Introduction</a></h2>
    <p>The default Space MVC application structure is intended to provide a great starting point for both large and small
        applications. Of course, you are free to organize your application however you like. Space MVC imposes almost no
        restrictions on where any given class is located - as long as Composer can autoload the class.</p>
    <h4>Where Is The Models Directory?</h4>
    <p>When getting started with Space MVC, many developers are confused by the lack of a <code class=" language-php">models</code>
        directory. However, the lack of such a directory is intentional. We find the word "models" ambiguous since it
        means many different things to many different people. Some developers refer to an application's "model" as the
        totality of all of its business logic, while others refer to "models" as classes that interact with a relational
        database.</p>
    <p>For this reason, we choose to place Eloquent models in the <code class=" language-php">app</code> directory by
        default, and allow the developer to place them somewhere else if they choose.</p>
    <p><a name="the-root-directory"></a></p>
    <h2><a href="#the-root-directory">The Root Directory</a></h2>
    <p><a name="the-root-app-directory"></a></p>
    <h4>The App Directory</h4>
    <p>The <code class=" language-php">app</code> directory, as you might expect, contains the core code of your
        application. We'll explore this directory in more detail soon; however, almost all of the classes in your
        application will be in this directory.</p>
    <p><a name="the-bootstrap-directory"></a></p>
    <h4>The Bootstrap Directory</h4>
    <p>The <code class=" language-php">bootstrap</code> directory contains the <code class=" language-php">app<span
                    class="token punctuation">.</span>php</code> file which bootstraps the framework. This directory
        also houses a <code class=" language-php">cache</code> directory which contains framework generated files for
        performance optimization such as the route and services cache files.</p>
    <p><a name="the-config-directory"></a></p>
    <h4>The Config Directory</h4>
    <p>The <code class=" language-php">config</code> directory, as the name implies, contains all of your application's
        configuration files. It's a great idea to read through all of these files and familiarize yourself with all of
        the options available to you.</p>
    <p><a name="the-database-directory"></a></p>
    <h4>The Database Directory</h4>
    <p>The <code class=" language-php">database</code> directory contains your database migrations, model factories, and
        seeds. If you wish, you may also use this directory to hold an SQLite database.</p>
    <p><a name="the-public-directory"></a></p>
    <h4>The Public Directory</h4>
    <p>The <code class=" language-php"><span class="token keyword">public</span></code> directory contains the <code
                class=" language-php">index<span class="token punctuation">.</span>php</code> file, which is the entry
        point for all requests entering your application and configures autoloading. This directory also houses your
        assets such as images, JavaScript, and CSS.</p>
    <p><a name="the-resources-directory"></a></p>
    <h4>The Resources Directory</h4>
    <p>The <code class=" language-php">resources</code> directory contains your views as well as your raw, un-compiled
        assets such as LESS, SASS, or JavaScript. This directory also houses all of your language files.</p>
    <p><a name="the-routes-directory"></a></p>
    <h4>The Routes Directory</h4>
    <p>The <code class=" language-php">routes</code> directory contains all of the route definitions for your
        application. By default, several route files are included with Space MVC: <code class=" language-php">web<span
                    class="token punctuation">.</span>php</code>, <code class=" language-php">api<span
                    class="token punctuation">.</span>php</code>, <code class=" language-php">console<span
                    class="token punctuation">.</span>php</code> and <code class=" language-php">channels<span
                    class="token punctuation">.</span>php</code>.</p>
    <p>The <code class=" language-php">web<span class="token punctuation">.</span>php</code> file contains routes that
        the <code class=" language-php">RouteServiceProvider</code> places in the <code class=" language-php">web</code>
        middleware group, which provides session state, CSRF protection, and cookie encryption. If your application does
        not offer a stateless, RESTful API, all of your routes will most likely be defined in the <code
                class=" language-php">web<span class="token punctuation">.</span>php</code> file.</p>
    <p>The <code class=" language-php">api<span class="token punctuation">.</span>php</code> file contains routes that
        the <code class=" language-php">RouteServiceProvider</code> places in the <code class=" language-php">api</code>
        middleware group, which provides rate limiting. These routes are intended to be stateless, so requests entering
        the application through these routes are intended to be authenticated via tokens and will not have access to
        session state.</p>
    <p>The <code class=" language-php">console<span class="token punctuation">.</span>php</code> file is where you may
        define all of your Closure based console commands. Each Closure is bound to a command instance allowing a simple
        approach to interacting with each command's IO methods. Even though this file does not define HTTP routes, it
        defines console based entry points (routes) into your application.</p>
    <p>The <code class=" language-php">channels<span class="token punctuation">.</span>php</code> file is where you may
        register all of the event broadcasting channels that your application supports.</p>
    <p><a name="the-storage-directory"></a></p>
    <h4>The Storage Directory</h4>
    <p>The <code class=" language-php">storage</code> directory contains your compiled Blade templates, file based
        sessions, file caches, and other files generated by the framework. This directory is segregated into <code
                class=" language-php">app</code>, <code class=" language-php">framework</code>, and <code
                class=" language-php">logs</code> directories. The <code class=" language-php">app</code> directory may
        be used to store any files generated by your application. The <code class=" language-php">framework</code>
        directory is used to store framework generated files and caches. Finally, the <code
                class=" language-php">logs</code> directory contains your application's log files.</p>
    <p>The <code class=" language-php">storage<span class="token operator">/</span>app<span
                    class="token operator">/</span><span class="token keyword">public</span></code> directory may be
        used to store user-generated files, such as profile avatars, that should be publicly accessible. You should
        create a symbolic link at <code class=" language-php"><span class="token keyword">public</span><span
                    class="token operator">/</span>storage</code> which points to this directory. You may create the
        link using the <code class=" language-php">php artisan storage<span
                    class="token punctuation">:</span>link</code> command.</p>
    <p><a name="the-tests-directory"></a></p>
    <h4>The Tests Directory</h4>
    <p>The <code class=" language-php">tests</code> directory contains your automated tests. An example <a
                href="https://phpunit.de/">PHPUnit</a> is provided out of the box. Each test class should be suffixed
        with the word <code class=" language-php">Test</code>. You may run your tests using the <code
                class=" language-php">phpunit</code> or <code class=" language-php">php vendor<span
                    class="token operator">/</span>bin<span class="token operator">/</span>phpunit</code> commands.</p>
    <p><a name="the-vendor-directory"></a></p>
    <h4>The Vendor Directory</h4>
    <p>The <code class=" language-php">vendor</code> directory contains your <a
                href="https://getcomposer.org">Composer</a> dependencies.</p>
    <p><a name="the-app-directory"></a></p>
    <h2><a href="#the-app-directory">The App Directory</a></h2>
    <p>The majority of your application is housed in the <code class=" language-php">app</code> directory. By default,
        this directory is namespaced under <code class=" language-php">App</code> and is autoloaded by Composer using
        the <a href="http://www.php-fig.org/psr/psr-4/">PSR-4 autoloading standard</a>.</p>
    <p>The <code class=" language-php">app</code> directory contains a variety of additional directories such as <code
                class=" language-php">Console</code>, <code class=" language-php">Http</code>, and <code
                class=" language-php">Providers</code>. Think of the <code class=" language-php">Console</code> and
        <code class=" language-php">Http</code> directories as providing an API into the core of your application. The
        HTTP protocol and CLI are both mechanisms to interact with your application, but do not actually contain
        application logic. In other words, they are two ways of issuing commands to your application. The <code
                class=" language-php">Console</code> directory contains all of your Artisan commands, while the <code
                class=" language-php">Http</code> directory contains your controllers, middleware, and requests.</p>
    <p>A variety of other directories will be generated inside the <code class=" language-php">app</code> directory as
        you use the <code class=" language-php">make</code> Artisan commands to generate classes. So, for example, the
        <code class=" language-php">app<span class="token operator">/</span>Jobs</code> directory will not exist until
        you execute the <code class=" language-php">make<span class="token punctuation">:</span>job</code> Artisan
        command to generate a job class.</p>
    <blockquote class="has-icon">
        <p class="tip">
        <div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
                                                 version="1.1" x="0px" y="0px" width="56.6px" height="87.5px"
                                                 viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5"
                                                 xml:space="preserve"><path fill="#FFFFFF"
                                                                            d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span>
        </div>
        Many of the classes in the <code class=" language-php">app</code> directory can be generated by Artisan via
        commands. To review the available commands, run the <code class=" language-php">php artisan list make</code>
        command in your terminal.</p>
    </blockquote>
    <p><a name="the-broadcasting-directory"></a></p>
    <h4>The Broadcasting Directory</h4>
    <p>The <code class=" language-php">Broadcasting</code> directory contains all of the broadcast channel classes for
        your application. These classes are generated using the <code class=" language-php">make<span
                    class="token punctuation">:</span>channel</code> command. This directory does not exist by default,
        but will be created for you when you create your first channel. To learn more about channels, check out the
        documentation on <a href="/docs/5.7/broadcasting">event broadcasting</a>.</p>
    <p><a name="the-console-directory"></a></p>
    <h4>The Console Directory</h4>
    <p>The <code class=" language-php">Console</code> directory contains all of the custom Artisan commands for your
        application. These commands may be generated using the <code class=" language-php">make<span
                    class="token punctuation">:</span>command</code> command. This directory also houses your console
        kernel, which is where your custom Artisan commands are registered and your <a href="/docs/5.7/scheduling">scheduled
            tasks</a> are defined.</p>
    <p><a name="the-events-directory"></a></p>
    <h4>The Events Directory</h4>
    <p>This directory does not exist by default, but will be created for you by the <code
                class=" language-php">event<span class="token punctuation">:</span>generate</code> and <code
                class=" language-php">make<span class="token punctuation">:</span>event</code> Artisan commands. The
        <code class=" language-php">Events</code> directory, as you might expect, houses <a href="/docs/5.7/events">event
            classes</a>. Events may be used to alert other parts of your application that a given action has occurred,
        providing a great deal of flexibility and decoupling.</p>
    <p><a name="the-exceptions-directory"></a></p>
    <h4>The Exceptions Directory</h4>
    <p>The <code class=" language-php">Exceptions</code> directory contains your application's exception handler and is
        also a good place to place any exceptions thrown by your application. If you would like to customize how your
        exceptions are logged or rendered, you should modify the <code class=" language-php">Handler</code> class in
        this directory.</p>
    <p><a name="the-http-directory"></a></p>
    <h4>The Http Directory</h4>
    <p>The <code class=" language-php">Http</code> directory contains your controllers, middleware, and form requests.
        Almost all of the logic to handle requests entering your application will be placed in this directory.</p>
    <p><a name="the-jobs-directory"></a></p>
    <h4>The Jobs Directory</h4>
    <p>This directory does not exist by default, but will be created for you if you execute the <code
                class=" language-php">make<span class="token punctuation">:</span>job</code> Artisan command. The <code
                class=" language-php">Jobs</code> directory houses the <a href="/docs/5.7/queues">queueable jobs</a> for
        your application. Jobs may be queued by your application or run synchronously within the current request
        lifecycle. Jobs that run synchronously during the current request are sometimes referred to as "commands" since
        they are an implementation of the <a href="https://en.wikipedia.org/wiki/Command_pattern">command pattern</a>.
    </p>
    <p><a name="the-listeners-directory"></a></p>
    <h4>The Listeners Directory</h4>
    <p>This directory does not exist by default, but will be created for you if you execute the <code
                class=" language-php">event<span class="token punctuation">:</span>generate</code> or <code
                class=" language-php">make<span class="token punctuation">:</span>listener</code> Artisan commands. The
        <code class=" language-php">Listeners</code> directory contains the classes that handle your <a
                href="/docs/5.7/events">events</a>. Event listeners receive an event instance and perform logic in
        response to the event being fired. For example, a <code class=" language-php">UserRegistered</code> event might
        be handled by a <code class=" language-php">SendWelcomeEmail</code> listener.</p>
    <p><a name="the-mail-directory"></a></p>
    <h4>The Mail Directory</h4>
    <p>This directory does not exist by default, but will be created for you if you execute the <code
                class=" language-php">make<span class="token punctuation">:</span>mail</code> Artisan command. The <code
                class=" language-php">Mail</code> directory contains all of your classes that represent emails sent by
        your application. Mail objects allow you to encapsulate all of the logic of building an email in a single,
        simple class that may be sent using the <code class=" language-php"><span class="token scope">Mail<span
                        class="token punctuation">::</span></span>send</code> method.</p>
    <p><a name="the-notifications-directory"></a></p>
    <h4>The Notifications Directory</h4>
    <p>This directory does not exist by default, but will be created for you if you execute the <code
                class=" language-php">make<span class="token punctuation">:</span>notification</code> Artisan command.
        The <code class=" language-php">Notifications</code> directory contains all of the "transactional" notifications
        that are sent by your application, such as simple notifications about events that happen within your
        application. Space MVC's notification features abstracts sending notifications over a variety of drivers such as
        email, Slack, SMS, or stored in a database.</p>
    <p><a name="the-policies-directory"></a></p>
    <h4>The Policies Directory</h4>
    <p>This directory does not exist by default, but will be created for you if you execute the <code
                class=" language-php">make<span class="token punctuation">:</span>policy</code> Artisan command. The
        <code class=" language-php">Policies</code> directory contains the authorization policy classes for your
        application. Policies are used to determine if a user can perform a given action against a resource. For more
        information, check out the <a href="/docs/5.7/authorization">authorization documentation</a>.</p>
    <p><a name="the-providers-directory"></a></p>
    <h4>The Providers Directory</h4>
    <p>The <code class=" language-php">Providers</code> directory contains all of the <a href="/docs/5.7/providers">service
            providers</a> for your application. Service providers bootstrap your application by binding services in the
        service container, registering events, or performing any other tasks to prepare your application for incoming
        requests.</p>
    <p>In a fresh Space MVC application, this directory will already contain several providers. You are free to add your
        own providers to this directory as needed.</p>
    <p><a name="the-rules-directory"></a></p>
    <h4>The Rules Directory</h4>
    <p>This directory does not exist by default, but will be created for you if you execute the <code
                class=" language-php">make<span class="token punctuation">:</span>rule</code> Artisan command. The <code
                class=" language-php">Rules</code> directory contains the custom validation rule objects for your
        application. Rules are used to encapsulate complicated validation logic in a simple object. For more
        information, check out the <a href="/docs/5.7/validation">validation documentation</a>.</p>
</article>



