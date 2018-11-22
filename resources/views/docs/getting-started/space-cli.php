<?php use App\Library\Framework\Component\Code; ?>

<article>
    <h2>Space Command Line Interface (CLI) Tool</h2>
    <p>Space is the command-line interface included with Space MVC. It provides a number of helpful commands that can
        assist you while you build your application. To view a list of all available Space commands, you may use the
        list command:</p>
    <?php echo Code::getHtmlStatic('php space list'); ?>
    <p>Every command also includes a "help" screen which displays and describes the command's available arguments and
        options. To view a help screen, precede the name of the command with help:
    </p>
    <?php echo Code::getHtmlStatic('php space help migrate'); ?>
    <h4>Space MVC REPL</h4>
    <p>All Space MVC applications include Tinker, a REPL powered by the <a href="https://github.com/bobthecow/psysh">PsySH</a>
        package. Tinker allows you to interact with your entire Space MVC application on the command line, including the
        Eloquent ORM, jobs, events, and more. To enter the Tinker environment, run the tinker
        Space command:</p>
    <?php echo Code::getHtmlStatic('php space tinker'); ?>
    <p><a name="writing-commands"></a></p>
    <h2><a href="#writing-commands">Writing Commands</a></h2>
    <p>In addition to the commands provided with Space, you may also build your own custom commands. Commands are
        typically stored in the app/Console/Commands directory; however, you are free to choose your own
        storage location as long as your commands can be loaded by Composer.</p>
    <p><a name="generating-commands"></a></p>
    <h3>Generating Commands</h3>
    <p>To create a new command, use the make:command
        Space command. This command will create a new command class in the app/Console/Commands
        directory. Don't worry if this directory does not exist in your application, since it will be created the first
        time you run the make:command Space
        command. The generated command will include the default set of properties and methods that are present on all
        commands:</p>
    <?php echo Code::getHtmlStatic('php space make:command SendEmails'); ?>
    <p><a name="command-structure"></a></p>
    <h3>Command Structure</h3>
    <p>After generating your command, you should fill in the signature and description properties of the class, which will be used when displaying
        your command on the list screen. The handle method will be called when your command is executed. You may place
        your command logic in this method.</p>
    <p>For greater code reuse, it is good practice to keep your console commands light and let them defer to
    application services to accomplish their tasks. In the example below, note that we inject a service class to do
    the "heavy lifting" of sending the e-mails.</p>
    <p>Let's take a look at an example command. Note that we are able to inject any dependencies we need into the
        command's constructor or handle method. The Space MVC <a
                href="/docs/5.7/container">service container</a> will automatically inject all dependencies type-hinted
        in the constructor or handle method:</p>

    <?php echo Code::getHtmlStatic('&lt;?php

namespace App\Console\Commands;

use App\User;
use App\DripEmailer;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected \$signature = \'email:send {user}\';

    /**
     * The console command description.
     *
     * @var string
     */
    protected \$description = \'Send drip e-mails to a user\';

    /**
     * The drip e-mail service.
     *
     * @var DripEmailer
     */
    protected \$drip;

    /**
     * Create a new command instance.
     *
     * @param  DripEmailer  \$drip
     * @return void
     */
    public function __construct(DripEmailer \$drip)
    {
        parent::__construct();

        \$this->drip = \$drip;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \$this->drip->send(User::find(\$this->argument(\'user\')));
    }
}'); ?>
    <?php echo Code::getHtmlStatic('&lt;?php

namespace App\Console\Commands;

use App\User;
use App\DripEmailer;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = \'email:send {user}\';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = \'Send drip e-mails to a user\';

    /**
     * The drip e-mail service.
     *
     * @var DripEmailer
     */
    protected $drip;

    /**
     * Create a new command instance.
     *
     * @param  DripEmailer  $drip
     * @return void
     */
    public function __construct(DripEmailer $drip)
    {
        parent::__construct();

        $this-&gt;drip = $drip;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this-&gt;drip-&gt;send(User::find($this-&gt;argument(\'user\')));
    }
}'); ?>
    <p><a name="closure-commands"></a></p>
    <h3>Closure Commands</h3>
    <p>Closure based commands provide an alternative to defining console commands as classes. In the same way that route
        Closures are an alternative to controllers, think of command Closures as an alternative to command classes.
        Within the commands method of your app/Console/Kernel.php file, Space MVC loads the routes/console.php file:</p>
    <?php echo Code::getHtmlStatic('/**
 * Register the Closure based commands for the application.
 *
 * @return void
 */
protected function commands()
{
    require base_path(\'routes/console.php\');
}'); ?>
    <p>Even though this file does not define HTTP routes, it defines console based entry points (routes) into your
        application. Within this file, you may define all of your Closure based routes using the Space::command
        method. The command method accepts two arguments: the <a
                href="#defining-input-expectations">command signature</a> and a Closure which receives the commands
        arguments and options:</p>
    <?php echo Code::getHtmlStatic('Space::command(\'build {project}\', function ($project) {
    $this-&gt;info("Building {$project}!");
});'); ?>
    <p>The Closure is bound to the underlying command instance, so you have full access to all of the helper methods you
        would typically be able to access on a full command class.</p>
    <h4>Type-Hinting Dependencies</h4>
    <p>In addition to receiving your command's arguments and options, command Closures may also type-hint additional
        dependencies that you would like resolved out of the <a href="/docs/5.7/container">service container</a>:</p>
    <?php echo Code::getHtmlStatic('use App\User;
use App\DripEmailer;

Space::command(\'email:send {user}\', function (DripEmailer $drip, $user) {
    $drip-&gt;send(User::find($user));
});'); ?>
    <h4>Closure Command Descriptions</h4>
    <p>When defining a Closure based command, you may use the describe method to add
        a description to the command. This description will be displayed when you run the php
            space list or php space help commands:</p>
    <?php echo Code::getHtmlStatic('Space::command(\'build {project}\', function ($project) {
    $this-&gt;info("Building {$project}!");
})-&gt;describe(\'Build the project\');'); ?>
    <p><a name="defining-input-expectations"></a></p>
    <h2><a href="#defining-input-expectations">Defining Input Expectations</a></h2>
    <p>When writing console commands, it is common to gather input from the user through arguments or options. Space MVC
        makes it very convenient to define the input you expect from the user using the signature
        property on your commands. The signature property allows you to define the
        name, arguments, and options for the command in a single, expressive, route-like syntax.</p>
    <p><a name="arguments"></a></p>
    <h3>Arguments</h3>
    <p>All user supplied arguments and options are wrapped in curly braces. In the following example, the command
        defines one <strong>required</strong> argument: user:</p>
    <?php echo Code::getHtmlStatic('/**
 * The name and signature of the console command.
 *
 * @var string
 */
protected $signature = \'email:send {user}\';'); ?>
    <p>You may also make arguments optional and define default values for arguments:</p>
    <?php echo Code::getHtmlStatic('// Optional argument...
email:send {user?}

// Optional argument with default value...
email:send {user=foo}'); ?>
    <p><a name="options"></a></p>
    <h3>Options</h3>
    <p>Options, like arguments, are another form of user input. Options are prefixed by two hyphens (--) when they are specified on the
        command line. There are two types of options: those that receive a value and those that don't. Options that
        don't receive a value serve as a boolean "switch". Let's take a look at an example of this type of option:</p>
    <?php echo Code::getHtmlStatic('/**
 * The name and signature of the console command.
 *
 * @var string
 */
protected $signature = \'email:send {user} {--queue}\';'); ?>
    <p>In this example, the --queue switch may be
        specified when calling the Space command. If the --queue switch is passed, the value of the option will be true. Otherwise, the value will be false:</p>
    <?php echo Code::getHtmlStatic('php space email:send 1 --queue'); ?>
    <p><a name="options-with-values"></a></p>
    <h4>Options With Values</h4>
    <p>Next, let's take a look at an option that expects a value. If the user must specify a value for an option, suffix
        the option name with a = sign:</p>
    <?php echo Code::getHtmlStatic('/**
 * The name and signature of the console command.
 *
 * @var string
 */
protected $signature = \'email:send {user} {--queue=}\';'); ?>
    <p>In this example, the user may pass a value for the option like so:</p>
    <?php echo Code::getHtmlStatic('php space email:send 1 --queue=default'); ?>
    <p>You may assign default values to options by specifying the default value after the option name. If no option
        value is passed by the user, the default value will be used:</p>
    <?php echo Code::getHtmlStatic('email:send {user} {--queue=default}'); ?>
    <p><a name="option-shortcuts"></a></p>
    <h4>Option Shortcuts</h4>
    <p>To assign a shortcut when defining an option, you may specify it before the option name and use a | delimiter to
        separate the shortcut from the full option name:</p>
    <?php echo Code::getHtmlStatic('email:send {user} {--Q|queue}'); ?>
    <p><a name="input-arrays"></a></p>
    <h3>Input Arrays</h3>
    <p>If you would like to define arguments or options to expect array inputs, you may use the * character. First, let's take a look
        at an example that specifies an array argument:</p>
    <?php echo Code::getHtmlStatic('email:send {user*}'); ?>
    <p>When calling this method, the user arguments may be passed in order to the
        command line. For example, the following command will set the value of user
        to ['foo', 'bar']:</p>
    <?php echo Code::getHtmlStatic('php space email:send foo bar'); ?>
    <p>When defining an option that expects an array input, each option value passed to the command should be prefixed
        with the option name:</p>
    <?php echo Code::getHtmlStatic('email:send {user} {--id=*}

php space email:send --id=1 --id=2'); ?>
    <p><a name="input-descriptions"></a></p>
    <h3>Input Descriptions</h3>
    <p>You may assign descriptions to input arguments and options by separating the parameter from the description using
        a colon. If you need a little extra room to define your command, feel free to spread the definition across
        multiple lines:</p>
    <?php echo Code::getHtmlStatic('/**
 * The name and signature of the console command.
 *
 * @var string
 */
protected $signature = \'email:send
                        {user : The ID of the user}
                        {--queue= : Whether the job should be queued}\';'); ?>
    <p><a name="command-io"></a></p>
    <h2><a href="#command-io">Command I/O</a></h2>
    <p><a name="retrieving-input"></a></p>
    <h3>Retrieving Input</h3>
    <p>While your command is executing, you will obviously need to access the values for the arguments and options
        accepted by your command. To do so, you may use the argument and option methods:</p>
    <?php echo Code::getHtmlStatic('/**
 * Execute the console command.
 *
 * @return mixed
 */
public function handle()
{
    $userId = $this-&gt;argument(\'user\');

    //
}'); ?>
    <p>If you need to retrieve all of the arguments as an array, call the arguments
        method:</p>
    <?php echo Code::getHtmlStatic('$arguments = $this-&gt;arguments();'); ?>
    <p>Options may be retrieved just as easily as arguments using the option method.
        To retrieve all of the options as an array, call the options method:</p>
    <?php echo Code::getHtmlStatic('// Retrieve a specific option...
$queueName = $this-&gt;option(\'queue\');

// Retrieve all options...
$options = $this-&gt;options();'); ?>
    <p>If the argument or option does not exist, null will be returned.</p>
    <p><a name="prompting-for-input"></a></p>
    <h3>Prompting For Input</h3>
    <p>In addition to displaying output, you may also ask the user to provide input during the execution of your
        command. The ask method will prompt the user with the given question, accept
        their input, and then return the user's input back to your command:</p>
    <?php echo Code::getHtmlStatic('/**
 * Execute the console command.
 *
 * @return mixed
 */
public function handle()
{
    $name = $this-&gt;ask(\'What is your name?\');
}'); ?>
    <p>The secret method is similar to ask, but
        the user's input will not be visible to them as they type in the console. This method is useful when asking for
        sensitive information such as a password:</p>
    <?php echo Code::getHtmlStatic('$password = $this-&gt;secret(\'What is the password?\');'); ?>
    <h4>Asking For Confirmation</h4>
    <p>If you need to ask the user for a simple confirmation, you may use the confirm
        method. By default, this method will return false.
        However, if the user enters y or yes in
        response to the prompt, the method will return true.</p>
    <?php echo Code::getHtmlStatic('if ($this-&gt;confirm(\'Do you wish to continue?\')) {
    //
}'); ?>
    <h4>Auto-Completion</h4>
    <p>The anticipate method can be used to provide auto-completion for possible
        choices. The user can still choose any answer, regardless of the auto-completion hints:</p>
    <?php echo Code::getHtmlStatic('$name = $this-&gt;anticipate(\'What is your name?\', [\'Taylor\', \'Dayle\']);'); ?>
    <h4>Multiple Choice Questions</h4>
    <p>If you need to give the user a predefined set of choices, you may use the choice method. You may set the array index of the default value to be
        returned if no option is chosen:</p>
    <?php echo Code::getHtmlStatic('$name = $this-&gt;choice(\'What is your name?\', [\'Taylor\', \'Dayle\'], $defaultIndex);'); ?>
    <p><a name="writing-output"></a></p>
    <h3>Writing Output</h3>
    <p>To send output to the console, use the line, info, comment, question and error methods. Each of
        these methods will use appropriate ANSI colors for their purpose. For example, let's display some general
        information to the user. Typically, the info method will display in the
        console as green text:</p>
    <?php echo Code::getHtmlStatic('/**
 * Execute the console command.
 *
 * @return mixed
 */
public function handle()
{
    $this-&gt;info(\'Display this on the screen\');
}'); ?>
    <p>To display an error message, use the error method. Error message text is
        typically displayed in red:</p>
    <?php echo Code::getHtmlStatic('$this-&gt;error(\'Something went wrong!\');'); ?>
    <p>If you would like to display plain, uncolored console output, use the line
        method:</p>
    <?php echo Code::getHtmlStatic('$this-&gt;line(\'Display this on the screen\');'); ?>
    <h4>Table Layouts</h4>
    <p>The table method makes it easy to correctly format multiple rows / columns of
        data. Just pass in the headers and rows to the method. The width and height will be dynamically calculated based
        on the given data:</p>
    <?php echo Code::getHtmlStatic('$headers = [\'Name\', \'Email\'];

$users = App\User::all([\'name\', \'email\'])-&gt;toArray();

$this-&gt;table($headers, $users);'); ?>
    <h4>Progress Bars</h4>
    <p>For long running tasks, it could be helpful to show a progress indicator. Using the output object, we can start,
        advance and stop the Progress Bar. First, define the total number of steps the process will iterate through.
        Then, advance the Progress Bar after processing each item:</p>
    <?php echo Code::getHtmlStatic('$users = App\User::all();

$bar = $this-&gt;output-&gt;createProgressBar(count($users));

$bar-&gt;start();

foreach ($users as $user) {
    $this-&gt;performTask($user);

    $bar-&gt;advance();
}

$bar-&gt;finish();'); ?>
    <p>For more advanced options, check out the <a
                href="https://symfony.com/doc/current/components/console/helpers/progressbar.html">Symfony Progress Bar
            component documentation</a>.</p>
    <p><a name="registering-commands"></a></p>
    <h2><a href="#registering-commands">Registering Commands</a></h2>
    <p>Because of the load method call in your console kernel's commands method, all commands within the app/Console/Commands directory will automatically be registered with
        Space. In fact, you are free to make additional calls to the load method to
        scan other directories for Space commands:</p>
    <?php echo Code::getHtmlStatic('/**
 * Register the commands for the application.
 *
 * @return void
 */
protected function commands()
{
    $this-&gt;load(__DIR__.\'/Commands\');
    $this-&gt;load(__DIR__.\'/MoreCommands\');

    // ...
}'); ?>
    <p>You may also manually register commands by adding its class name to the $commands property of your app/Console/Kernel.php file. When Space boots, all the commands listed in this
        property will be resolved by the <a href="/docs/5.7/container">service container</a> and registered with Space:
    </p>
    <?php echo Code::getHtmlStatic('protected $commands = [
    Commands\SendEmails::class
];'); ?>
    <p><a name="programmatically-executing-commands"></a></p>
    <h2><a href="#programmatically-executing-commands">Programmatically Executing Commands</a></h2>
    <p>Sometimes you may wish to execute an Space command outside of the CLI. For example, you may wish to fire an Space
        command from a route or controller. You may use the call method on the Space facade to accomplish this. The call method accepts either the command's name or class as the first
        argument, and an array of command parameters as the second argument. The exit code will be returned:</p>
    <?php echo Code::getHtmlStatic('Route::get(\'/foo\', function () {
    $exitCode = Space::call(\'email:send\', [
        \'user\' =&gt; 1, \'--queue\' =&gt; \'default\'
    ]);

    //
});'); ?>
    <p>Using the queue method on the Space facade,
        you may even queue Space commands so they are processed in the background by your <a href="/docs/5.7/queues">queue
            workers</a>. Before using this method, make sure you have configured your queue and are running a queue
        listener:</p>
    <?php echo Code::getHtmlStatic('Route::get(\'/foo\', function () {
    Space::queue(\'email:send\', [
        \'user\' =&gt; 1, \'--queue\' =&gt; \'default\'
    ]);

    //
});'); ?>
    <p>You may also specify the connection or queue the Space command should be dispatched to:</p>
    <?php echo Code::getHtmlStatic('Space::queue(\'email:send\', [
    \'user\' =&gt; 1, \'--queue\' =&gt; \'default\'
])-&gt;onConnection(\'redis\')-&gt;onQueue(\'commands\');'); ?>
    <h4>Passing Array Values</h4>
    <p>If your command defines an option that accepts an array, you may pass an array of values to that option:</p>
    <?php echo Code::getHtmlStatic('Route::get(\'/foo\', function () {
    $exitCode = Space::call(\'email:send\', [
        \'user\' =&gt; 1, \'--id\' =&gt; [5, 13]
    ]);
});'); ?>
    <h4>Passing Boolean Values</h4>
    <p>If you need to specify the value of an option that does not accept string values, such as the --force flag on the migrate:refresh command, you should
        pass true or false:</p>
    <?php echo Code::getHtmlStatic('$exitCode = Space::call(\'migrate:refresh\', [
    \'--force\' =&gt; true,
]);'); ?>
    <p><a name="calling-commands-from-other-commands"></a></p>
    <h3>Calling Commands From Other Commands</h3>
    <p>Sometimes you may wish to call other commands from an existing Space command. You may do so using the call method. This call method accepts
        the command name and an array of command parameters:</p>
    <?php echo Code::getHtmlStatic('/**
 * Execute the console command.
 *
 * @return mixed
 */
public function handle()
{
    $this-&gt;call(\'email:send\', [
        \'user\' =&gt; 1, \'--queue\' =&gt; \'default\'
    ]);

    //
}'); ?>
    <p>If you would like to call another console command and suppress all of its output, you may use the callSilent method. The callSilent method
        has the same signature as the call method:</p>
    <?php echo Code::getHtmlStatic('$this-&gt;callSilent(\'email:send\', [
    \'user\' =&gt; 1, \'--queue\' =&gt; \'default\'
]);'); ?>
</article>