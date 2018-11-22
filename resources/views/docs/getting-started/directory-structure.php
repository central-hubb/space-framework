<?php use App\Library\Framework\Component\Code; ?>

<article>
    <h1>Directory Structure</h1>
    <ul>
        <li><a href="#introduction">Introduction</a></li>
        <li><a href="#the-root-directory">The Root Directory</a>
            <ul>
                <li><a href="#the-root-app-directory">The app Directory</a></li>
                <li><a href="#the-config-directory">The config Directory</a></li>
                <li><a href="#the-database-directory">The database Directory</a></li>
                <li><a href="#the-public-directory">The public Directory</a></li>
                <li><a href="#the-resources-directory">The resources Directory</a>
                </li>
                <li><a href="#the-routes-directory">The routes Directory</a></li>
                <li><a href="#the-storage-directory">The storage Directory</a></li>
                <li><a href="#the-tests-directory">The tests Directory</a></li>
                <li><a href="#the-vendor-directory">The vendor Directory</a></li>
                <li><a href="#the-listeners-directory">The Models Directory</a></li>
                <li><a href="#the-listeners-directory">The Requests Directory</a></li>
                <li><a href="#the-events-directory">The Events Directory</a></li>
                <li><a href="#the-listeners-directory">The Listeners Directory</a></li>
            </ul>
        </li>
    </ul>

    <p><a name="introduction"></a></p>

    <h2><a href="#introduction">Introduction</a></h2>

    <p>The default Space MVC application structure is intended to provide a great starting point for both large and small
        applications. Of course, you are free to organize your application however you like. Space MVC imposes almost no
        restrictions on where any given class is located - as long as Composer can autoload the class.</p>

    <h4>Where Is The Models Directory?</h4>

    <p>When getting started with Space MVC, many developers are confused by the lack of a >models
        directory. However, the lack of such a directory is intentional. We find the word "models" ambiguous since it
        means many different things to many different people. Some developers refer to an application's "model" as the
        totality of all of its business logic, while others refer to "models" as classes that interact with a relational
        database.
    </p>

    <p><a name="the-root-app-directory"></a></p>

    <h4>The App Directory</h4>

    <p>The directory, as you might expect, contains the core code of your
        application. We'll explore this directory in more detail soon; however, almost all of the classes in your
        application will be in this directory.
    </p>

    <p><a name="the-config-directory"></a></p>

    <h4>The Config Directory</h4>

    <p>The directory, as the name implies, contains all of your application's
        configuration files. It's a great idea to read through all of these files and familiarize yourself with all of
        the options available to you.
    </p>
    <p><a name="the-database-directory"></a></p>

    <h4>The Database Directory</h4>

    <p>The directory contains your database migrations, model factories, and
        seeds. If you wish, you may also use this directory to hold an SQLite database.
    </p>

    <p><a name="the-public-directory"></a></p>

    <h4>The Public Directory</h4>

    <p>The public directory contains the index.php file, which is the entry
        point for all requests entering your application and configures autoloading. This directory also houses your
        assets such as images, JavaScript, and CSS.
    </p>

    <p><a name="the-resources-directory"></a></p>

    <h4>The Resources Directory</h4>

    <p>The resources directory contains your views as well as your raw, un-compiled
        assets such as LESS, SASS, or JavaScript. This directory also houses all of your language files.
    </p>
    <p><a name="the-routes-directory"></a></p>

    <h4>The Routes Directory</h4>

    <p>The routes directory contains all of the route definitions for your
        application. By default, several route files are included with Space MVC:
        web.php,
        api.php,
        console.php and
        channels.php.
    </p>

    <p>
        The web.php file contains routes that
        the RouteServiceProvider places in the web
        middleware group, which provides session state, CSRF protection, and cookie encryption. If your application does
        not offer a stateless, RESTful API, all of your routes will most likely be defined in the
        web.php file.
    </p>

    <p>The api.php file contains routes that
        the RouteServiceProvider places in the api
        middleware group, which provides rate limiting. These routes are intended to be stateless, so requests entering
        the application through these routes are intended to be authenticated via tokens and will not have access to
        session state.
    </p>

    <p>The console.php file is where you may
        define all of your Closure based console commands. Each Closure is bound to a command instance allowing a simple
        approach to interacting with each command's IO methods. Even though this file does not define HTTP routes, it
        defines console based entry points (routes) into your application.
    </p>

    <p>The channels.php file is where you may
        register all of the event broadcasting channels that your application supports.
    </p>

    <p><a name="the-storage-directory"></a></p>

    <h4>The Storage Directory</h4>

    <p>The storage directory contains your compiled Blade templates, file based
        sessions, file caches, and other files generated by the framework. This directory is segregated into
        app, framework, and logs directories. The app directory may
        be used to store any files generated by your application. The framework
        directory is used to store framework generated files and caches. Finally, the
        logs directory contains your application's log files.
    </p>

    <p>The storage/app/public directory may be used to store user-generated files, such as profile avatars, that should be publicly accessible. You should
        create a symbolic link at public/storage which points to this directory. You may create the
        link using the php artisan storage:link command.
    </p>

    <p><a name="the-tests-directory"></a></p>

    <h4>The Tests Directory</h4>

    <p>The tests directory contains your automated tests. An
        example <a href="https://phpunit.de/">PHPUnit</a> is provided out of the box. Each test class should be suffixed
        with the word Test. You may run your tests using the
        phpunit or php vendor/bin/phpunit commands.
    </p>

    <p><a name="the-vendor-directory"></a></p>

    <h4>The Vendor Directory</h4>

    <p>The vendor directory contains your <a href="https://getcomposer.org">Composer</a> dependencies.</p>

    <p><a name="the-broadcasting-directory"></a></p>

    <h4>The Events Directory</h4>

    <p>This directory does not exist by default, but will be created for you by the
       event:generate and
        make:event Artisan commands. The
        Events directory, as you might expect, houses event
            classes. Events may be used to alert other parts of your application that a given action has occurred,
        providing a great deal of flexibility and decoupling.
    </p>

    <h4>The Listeners Directory</h4>

    <p>
        This directory does not exist by default, but will be created for you if you execute the
        event:generate or make:listener
        Artisan commands. The Listeners directory contains the classes that handle your events. Event listeners
        receive an event instance and perform logic in response to the event being fired. For example, a
        UserRegistered event might be handled by a SendWelcomeEmail listener.
    </p>

    <p><a name="the-mail-directory"></a></p>

</article>