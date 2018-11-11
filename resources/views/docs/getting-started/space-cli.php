<article>
    <h2>Space Command Line Interface (CLI) Tool</h2>
    <p>Space is the command-line interface included with Space MVC. It provides a number of helpful commands that can
        assist you while you build your application. To view a list of all available Space commands, you may use the
        <code class=" language-php">list</code> command:</p>
    <pre class=" language-php"><code class=" language-php">php space list</code></pre>
    <p>Every command also includes a "help" screen which displays and describes the command's available arguments and
        options. To view a help screen, precede the name of the command with <code class=" language-php">help</code>:
    </p>
    <pre class=" language-php"><code class=" language-php">php space help migrate</code></pre>
    <h4>Space MVC REPL</h4>
    <p>All Space MVC applications include Tinker, a REPL powered by the <a href="https://github.com/bobthecow/psysh">PsySH</a>
        package. Tinker allows you to interact with your entire Space MVC application on the command line, including the
        Eloquent ORM, jobs, events, and more. To enter the Tinker environment, run the <code class=" language-php">tinker</code>
        Space command:</p>
    <pre class=" language-php"><code class=" language-php">php space tinker</code></pre>
    <p><a name="writing-commands"></a></p>
    <h2><a href="#writing-commands">Writing Commands</a></h2>
    <p>In addition to the commands provided with Space, you may also build your own custom commands. Commands are
        typically stored in the app<span class="token operator">/</span>Console<span
                    class="token operator">/</span>Commands directory; however, you are free to choose your own
        storage location as long as your commands can be loaded by Composer.</p>
    <p><a name="generating-commands"></a></p>
    <h3>Generating Commands</h3>
    <p>To create a new command, use the <code class=" language-php">make<span class="token punctuation">:</span>command</code>
        Space command. This command will create a new command class in the <code class=" language-php">app<span
                    class="token operator">/</span>Console<span class="token operator">/</span>Commands</code>
        directory. Don't worry if this directory does not exist in your application, since it will be created the first
        time you run the <code class=" language-php">make<span class="token punctuation">:</span>command</code> Space
        command. The generated command will include the default set of properties and methods that are present on all
        commands:</p>
    <pre class=" language-php"><code class=" language-php">php space make<span class="token punctuation">:</span>command SendEmails</code></pre>
    <p><a name="command-structure"></a></p>
    <h3>Command Structure</h3>
    <p>After generating your command, you should fill in the <code class=" language-php">signature</code> and <code
                class=" language-php">description</code> properties of the class, which will be used when displaying
        your command on the <code class=" language-php">list</code> screen. The <code
                class=" language-php">handle</code> method will be called when your command is executed. You may place
        your command logic in this method.</p>
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
        For greater code reuse, it is good practice to keep your console commands light and let them defer to
        application services to accomplish their tasks. In the example below, note that we inject a service class to do
        the "heavy lifting" of sending the e-mails.</p>
    </blockquote>
    <p>Let's take a look at an example command. Note that we are able to inject any dependencies we need into the
        command's constructor or <code class=" language-php">handle</code> method. The Space MVC <a
                href="/docs/5.7/container">service container</a> will automatically inject all dependencies type-hinted
        in the constructor or <code class=" language-php">handle</code> method:</p>

	<?php

	$code = "<?php

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
	protected \$signature = 'email:send {user}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected \$description = 'Send drip e-mails to a user';

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
		\$this->drip->send(User::find(\$this->argument('user')));
	}
}
";
	?>
    <pre class="language-php">
        <code class="language-php"><?php echo htmlentities($code); ?></code>
    </pre>


    <pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Console<span
                        class="token punctuation">\</span>Commands</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">App<span
                        class="token punctuation">\</span>User</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>DripEmailer</span><span
                    class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Console<span
                        class="token punctuation">\</span>Command</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">SendEmails</span> <span class="token keyword">extends</span> <span
                    class="token class-name">Command</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * The name and signature of the console command.
     *
     * @var string
     */</span>
    <span class="token keyword">protected</span> <span class="token variable">$signature</span> <span
                    class="token operator">=</span> <span class="token string">'email:send {user}'</span><span
                    class="token punctuation">;</span>

    <span class="token comment" spellcheck="true">/**
     * The console command description.
     *
     * @var string
     */</span>
    <span class="token keyword">protected</span> <span class="token variable">$description</span> <span
                    class="token operator">=</span> <span class="token string">'Send drip e-mails to a user'</span><span
                    class="token punctuation">;</span>

    <span class="token comment" spellcheck="true">/**
     * The drip e-mail service.
     *
     * @var DripEmailer
     */</span>
    <span class="token keyword">protected</span> <span class="token variable">$drip</span><span
                    class="token punctuation">;</span>

    <span class="token comment" spellcheck="true">/**
     * Create a new command instance.
     *
     * @param  DripEmailer  $drip
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">__construct<span
                        class="token punctuation">(</span></span>DripEmailer <span
                    class="token variable">$drip</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token scope"><span class="token keyword">parent</span><span
                    class="token punctuation">::</span></span><span class="token function">__construct<span
                        class="token punctuation">(</span></span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span>

        <span class="token this">$this</span><span class="token operator">-</span><span
                    class="token operator">&gt;</span><span class="token property">drip</span> <span
                    class="token operator">=</span> <span class="token variable">$drip</span><span
                    class="token punctuation">;</span>
    <span class="token punctuation">}</span>

    <span class="token comment" spellcheck="true">/**
     * Execute the console command.
     *
     * @return mixed
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">handle<span
                        class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token this">$this</span><span class="token operator">-</span><span
                    class="token operator">&gt;</span><span class="token property">drip</span><span
                    class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">send<span
                        class="token punctuation">(</span></span><span class="token scope">User<span
                        class="token punctuation">::</span></span><span class="token function">find<span
                        class="token punctuation">(</span></span><span class="token this">$this</span><span
                    class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">argument<span
                        class="token punctuation">(</span></span><span class="token string">'user'</span><span
                    class="token punctuation">)</span><span class="token punctuation">)</span><span
                    class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
    <p><a name="closure-commands"></a></p>
    <h3>Closure Commands</h3>
    <p>Closure based commands provide an alternative to defining console commands as classes. In the same way that route
        Closures are an alternative to controllers, think of command Closures as an alternative to command classes.
        Within the <code class=" language-php">commands</code> method of your <code class=" language-php">app<span
                    class="token operator">/</span>Console<span class="token operator">/</span>Kernel<span
                    class="token punctuation">.</span>php</code> file, Space MVC loads the <code class=" language-php">routes<span
                    class="token operator">/</span>console<span class="token punctuation">.</span>php</code> file:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Register the Closure based commands for the application.
 *
 * @return void
 */</span>
<span class="token keyword">protected</span> <span class="token keyword">function</span> <span class="token function">commands<span
                        class="token punctuation">(</span></span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token keyword">require</span> <span class="token function">base_path<span
                        class="token punctuation">(</span></span><span
                    class="token string">'routes/console.php'</span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
    <p>Even though this file does not define HTTP routes, it defines console based entry points (routes) into your
        application. Within this file, you may define all of your Closure based routes using the <code
                class=" language-php"><span class="token scope">Space<span class="token punctuation">::</span></span>command</code>
        method. The <code class=" language-php">command</code> method accepts two arguments: the <a
                href="#defining-input-expectations">command signature</a> and a Closure which receives the commands
        arguments and options:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token scope">Space<span
                        class="token punctuation">::</span></span><span class="token function">command<span
                        class="token punctuation">(</span></span><span
                    class="token string">'build {project}'</span><span class="token punctuation">,</span> <span
                    class="token keyword">function</span> <span class="token punctuation">(</span><span
                    class="token variable">$project</span><span class="token punctuation">)</span> <span
                    class="token punctuation">{</span>
    <span class="token this">$this</span><span class="token operator">-</span><span
                    class="token operator">&gt;</span><span class="token function">info<span
                        class="token punctuation">(</span></span><span
                    class="token string">"Building {$project}!"</span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
    <p>The Closure is bound to the underlying command instance, so you have full access to all of the helper methods you
        would typically be able to access on a full command class.</p>
    <h4>Type-Hinting Dependencies</h4>
    <p>In addition to receiving your command's arguments and options, command Closures may also type-hint additional
        dependencies that you would like resolved out of the <a href="/docs/5.7/container">service container</a>:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span
                    class="token package">App<span class="token punctuation">\</span>User</span><span
                    class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>DripEmailer</span><span
                    class="token punctuation">;</span>

<span class="token scope">Space<span class="token punctuation">::</span></span><span class="token function">command<span
                        class="token punctuation">(</span></span><span
                    class="token string">'email:send {user}'</span><span class="token punctuation">,</span> <span
                    class="token keyword">function</span> <span class="token punctuation">(</span>DripEmailer <span
                    class="token variable">$drip</span><span class="token punctuation">,</span> <span
                    class="token variable">$user</span><span class="token punctuation">)</span> <span
                    class="token punctuation">{</span>
    <span class="token variable">$drip</span><span class="token operator">-</span><span
                    class="token operator">&gt;</span><span class="token function">send<span
                        class="token punctuation">(</span></span><span class="token scope">User<span
                        class="token punctuation">::</span></span><span class="token function">find<span
                        class="token punctuation">(</span></span><span class="token variable">$user</span><span
                    class="token punctuation">)</span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
    <h4>Closure Command Descriptions</h4>
    <p>When defining a Closure based command, you may use the <code class=" language-php">describe</code> method to add
        a description to the command. This description will be displayed when you run the <code class=" language-php">php
            space list</code> or <code class=" language-php">php space help</code> commands:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token scope">Space<span
                        class="token punctuation">::</span></span><span class="token function">command<span
                        class="token punctuation">(</span></span><span
                    class="token string">'build {project}'</span><span class="token punctuation">,</span> <span
                    class="token keyword">function</span> <span class="token punctuation">(</span><span
                    class="token variable">$project</span><span class="token punctuation">)</span> <span
                    class="token punctuation">{</span>
    <span class="token this">$this</span><span class="token operator">-</span><span
                    class="token operator">&gt;</span><span class="token function">info<span
                        class="token punctuation">(</span></span><span
                    class="token string">"Building {$project}!"</span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span
                    class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">describe<span
                        class="token punctuation">(</span></span><span
                    class="token string">'Build the project'</span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span></code></pre>
    <p><a name="defining-input-expectations"></a></p>
    <h2><a href="#defining-input-expectations">Defining Input Expectations</a></h2>
    <p>When writing console commands, it is common to gather input from the user through arguments or options. Space MVC
        makes it very convenient to define the input you expect from the user using the <code class=" language-php">signature</code>
        property on your commands. The <code class=" language-php">signature</code> property allows you to define the
        name, arguments, and options for the command in a single, expressive, route-like syntax.</p>
    <p><a name="arguments"></a></p>
    <h3>Arguments</h3>
    <p>All user supplied arguments and options are wrapped in curly braces. In the following example, the command
        defines one <strong>required</strong> argument: <code class=" language-php">user</code>:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * The name and signature of the console command.
 *
 * @var string
 */</span>
<span class="token keyword">protected</span> <span class="token variable">$signature</span> <span
                    class="token operator">=</span> <span class="token string">'email:send {user}'</span><span
                    class="token punctuation">;</span></code></pre>
    <p>You may also make arguments optional and define default values for arguments:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">// Optional argument...
</span>email<span class="token punctuation">:</span>send <span class="token punctuation">{</span>user<span
                    class="token operator">?</span><span class="token punctuation">}</span>
<span class="token comment" spellcheck="true">
// Optional argument with default value...
</span>email<span class="token punctuation">:</span>send <span class="token punctuation">{</span>user<span
                    class="token operator">=</span>foo<span class="token punctuation">}</span></code></pre>
    <p><a name="options"></a></p>
    <h3>Options</h3>
    <p>Options, like arguments, are another form of user input. Options are prefixed by two hyphens (<code
                class=" language-php"><span class="token operator">--</span></code>) when they are specified on the
        command line. There are two types of options: those that receive a value and those that don't. Options that
        don't receive a value serve as a boolean "switch". Let's take a look at an example of this type of option:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * The name and signature of the console command.
 *
 * @var string
 */</span>
<span class="token keyword">protected</span> <span class="token variable">$signature</span> <span
                    class="token operator">=</span> <span class="token string">'email:send {user} {--queue}'</span><span
                    class="token punctuation">;</span></code></pre>
    <p>In this example, the <code class=" language-php"><span class="token operator">--</span>queue</code> switch may be
        specified when calling the Space command. If the <code class=" language-php"><span
                    class="token operator">--</span>queue</code> switch is passed, the value of the option will be <code
                class=" language-php"><span class="token boolean">true</span></code>. Otherwise, the value will be <code
                class=" language-php"><span class="token boolean">false</span></code>:</p>
    <pre class=" language-php"><code class=" language-php">php space email<span
                    class="token punctuation">:</span>send <span class="token number">1</span> <span
                    class="token operator">--</span>queue</code></pre>
    <p><a name="options-with-values"></a></p>
    <h4>Options With Values</h4>
    <p>Next, let's take a look at an option that expects a value. If the user must specify a value for an option, suffix
        the option name with a <code class=" language-php"><span class="token operator">=</span></code> sign:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * The name and signature of the console command.
 *
 * @var string
 */</span>
<span class="token keyword">protected</span> <span class="token variable">$signature</span> <span
                    class="token operator">=</span> <span
                    class="token string">'email:send {user} {--queue=}'</span><span
                    class="token punctuation">;</span></code></pre>
    <p>In this example, the user may pass a value for the option like so:</p>
    <pre class=" language-php"><code class=" language-php">php space email<span
                    class="token punctuation">:</span>send <span class="token number">1</span> <span
                    class="token operator">--</span>queue<span class="token operator">=</span><span
                    class="token keyword">default</span></code></pre>
    <p>You may assign default values to options by specifying the default value after the option name. If no option
        value is passed by the user, the default value will be used:</p>
    <pre class=" language-php"><code class=" language-php">email<span class="token punctuation">:</span>send <span
                    class="token punctuation">{</span>user<span class="token punctuation">}</span> <span
                    class="token punctuation">{</span><span class="token operator">--</span>queue<span
                    class="token operator">=</span><span class="token keyword">default</span><span
                    class="token punctuation">}</span></code></pre>
    <p><a name="option-shortcuts"></a></p>
    <h4>Option Shortcuts</h4>
    <p>To assign a shortcut when defining an option, you may specify it before the option name and use a | delimiter to
        separate the shortcut from the full option name:</p>
    <pre class=" language-php"><code class=" language-php">email<span class="token punctuation">:</span>send <span
                    class="token punctuation">{</span>user<span class="token punctuation">}</span> <span
                    class="token punctuation">{</span><span class="token operator">--</span>Q<span
                    class="token operator">|</span>queue<span class="token punctuation">}</span></code></pre>
    <p><a name="input-arrays"></a></p>
    <h3>Input Arrays</h3>
    <p>If you would like to define arguments or options to expect array inputs, you may use the <code
                class=" language-php"><span class="token operator">*</span></code> character. First, let's take a look
        at an example that specifies an array argument:</p>
    <pre class=" language-php"><code class=" language-php">email<span class="token punctuation">:</span>send <span
                    class="token punctuation">{</span>user<span class="token operator">*</span><span
                    class="token punctuation">}</span></code></pre>
    <p>When calling this method, the <code class=" language-php">user</code> arguments may be passed in order to the
        command line. For example, the following command will set the value of <code class=" language-php">user</code>
        to <code class=" language-php"><span class="token punctuation">[</span><span
                    class="token string">'foo'</span><span class="token punctuation">,</span> <span
                    class="token string">'bar'</span><span class="token punctuation">]</span></code>:</p>
    <pre class=" language-php"><code class=" language-php">php space email<span class="token punctuation">:</span>send foo bar</code></pre>
    <p>When defining an option that expects an array input, each option value passed to the command should be prefixed
        with the option name:</p>
    <pre class=" language-php"><code class=" language-php">email<span class="token punctuation">:</span>send <span
                    class="token punctuation">{</span>user<span class="token punctuation">}</span> <span
                    class="token punctuation">{</span><span class="token operator">--</span>id<span
                    class="token operator">=</span><span class="token operator">*</span><span class="token punctuation">}</span>

php space email<span class="token punctuation">:</span>send <span class="token operator">--</span>id<span
                    class="token operator">=</span><span class="token number">1</span> <span
                    class="token operator">--</span>id<span class="token operator">=</span><span
                    class="token number">2</span></code></pre>
    <p><a name="input-descriptions"></a></p>
    <h3>Input Descriptions</h3>
    <p>You may assign descriptions to input arguments and options by separating the parameter from the description using
        a colon. If you need a little extra room to define your command, feel free to spread the definition across
        multiple lines:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * The name and signature of the console command.
 *
 * @var string
 */</span>
<span class="token keyword">protected</span> <span class="token variable">$signature</span> <span
                    class="token operator">=</span> 'email<span class="token punctuation">:</span>send
                        <span class="token punctuation">{</span>user <span class="token punctuation">:</span> The <span
                    class="token constant">ID</span> of the user<span class="token punctuation">}</span>
                        <span class="token punctuation">{</span><span class="token operator">--</span>queue<span
                    class="token operator">=</span> <span class="token punctuation">:</span> Whether the job should be queued<span
                    class="token punctuation">}</span>'<span class="token punctuation">;</span></code></pre>
    <p><a name="command-io"></a></p>
    <h2><a href="#command-io">Command I/O</a></h2>
    <p><a name="retrieving-input"></a></p>
    <h3>Retrieving Input</h3>
    <p>While your command is executing, you will obviously need to access the values for the arguments and options
        accepted by your command. To do so, you may use the <code class=" language-php">argument</code> and <code
                class=" language-php">option</code> methods:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Execute the console command.
 *
 * @return mixed
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">handle<span
                        class="token punctuation">(</span></span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token variable">$userId</span> <span class="token operator">=</span> <span
                    class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span
                    class="token function">argument<span class="token punctuation">(</span></span><span
                    class="token string">'user'</span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span>

   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span></code></pre>
    <p>If you need to retrieve all of the arguments as an <code class=" language-php"><span
                    class="token keyword">array</span></code>, call the <code class=" language-php">arguments</code>
        method:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token variable">$arguments</span> <span
                    class="token operator">=</span> <span class="token this">$this</span><span
                    class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">arguments<span
                        class="token punctuation">(</span></span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span></code></pre>
    <p>Options may be retrieved just as easily as arguments using the <code class=" language-php">option</code> method.
        To retrieve all of the options as an array, call the <code class=" language-php">options</code> method:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">// Retrieve a specific option...
</span><span class="token variable">$queueName</span> <span class="token operator">=</span> <span class="token this">$this</span><span
                    class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">option<span
                        class="token punctuation">(</span></span><span class="token string">'queue'</span><span
                    class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// Retrieve all options...
</span><span class="token variable">$options</span> <span class="token operator">=</span> <span
                    class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span
                    class="token function">options<span class="token punctuation">(</span></span><span
                    class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
    <p>If the argument or option does not exist, <code class=" language-php"><span
                    class="token keyword">null</span></code> will be returned.</p>
    <p><a name="prompting-for-input"></a></p>
    <h3>Prompting For Input</h3>
    <p>In addition to displaying output, you may also ask the user to provide input during the execution of your
        command. The <code class=" language-php">ask</code> method will prompt the user with the given question, accept
        their input, and then return the user's input back to your command:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Execute the console command.
 *
 * @return mixed
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">handle<span
                        class="token punctuation">(</span></span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token variable">$name</span> <span class="token operator">=</span> <span
                    class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span
                    class="token function">ask<span class="token punctuation">(</span></span><span class="token string">'What is your name?'</span><span
                    class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
    <p>The <code class=" language-php">secret</code> method is similar to <code class=" language-php">ask</code>, but
        the user's input will not be visible to them as they type in the console. This method is useful when asking for
        sensitive information such as a password:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token variable">$password</span> <span
                    class="token operator">=</span> <span class="token this">$this</span><span
                    class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">secret<span
                        class="token punctuation">(</span></span><span
                    class="token string">'What is the password?'</span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span></code></pre>
    <h4>Asking For Confirmation</h4>
    <p>If you need to ask the user for a simple confirmation, you may use the <code class=" language-php">confirm</code>
        method. By default, this method will return <code class=" language-php"><span class="token boolean">false</span></code>.
        However, if the user enters <code class=" language-php">y</code> or <code class=" language-php">yes</code> in
        response to the prompt, the method will return <code class=" language-php"><span
                    class="token boolean">true</span></code>.</p>
    <pre class=" language-php"><code class=" language-php"><span class="token keyword">if</span> <span
                    class="token punctuation">(</span><span class="token this">$this</span><span class="token operator">-</span><span
                    class="token operator">&gt;</span><span class="token function">confirm<span
                        class="token punctuation">(</span></span><span
                    class="token string">'Do you wish to continue?'</span><span class="token punctuation">)</span><span
                    class="token punctuation">)</span> <span class="token punctuation">{</span>
   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span></code></pre>
    <h4>Auto-Completion</h4>
    <p>The <code class=" language-php">anticipate</code> method can be used to provide auto-completion for possible
        choices. The user can still choose any answer, regardless of the auto-completion hints:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token variable">$name</span> <span
                    class="token operator">=</span> <span class="token this">$this</span><span
                    class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">anticipate<span
                        class="token punctuation">(</span></span><span
                    class="token string">'What is your name?'</span><span class="token punctuation">,</span> <span
                    class="token punctuation">[</span><span class="token string">'Taylor'</span><span
                    class="token punctuation">,</span> <span class="token string">'Dayle'</span><span
                    class="token punctuation">]</span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span></code></pre>
    <h4>Multiple Choice Questions</h4>
    <p>If you need to give the user a predefined set of choices, you may use the <code
                class=" language-php">choice</code> method. You may set the array index of the default value to be
        returned if no option is chosen:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token variable">$name</span> <span
                    class="token operator">=</span> <span class="token this">$this</span><span
                    class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">choice<span
                        class="token punctuation">(</span></span><span
                    class="token string">'What is your name?'</span><span class="token punctuation">,</span> <span
                    class="token punctuation">[</span><span class="token string">'Taylor'</span><span
                    class="token punctuation">,</span> <span class="token string">'Dayle'</span><span
                    class="token punctuation">]</span><span class="token punctuation">,</span> <span
                    class="token variable">$defaultIndex</span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span></code></pre>
    <p><a name="writing-output"></a></p>
    <h3>Writing Output</h3>
    <p>To send output to the console, use the <code class=" language-php">line</code>, <code
                class=" language-php">info</code>, <code class=" language-php">comment</code>, <code
                class=" language-php">question</code> and <code class=" language-php">error</code> methods. Each of
        these methods will use appropriate ANSI colors for their purpose. For example, let's display some general
        information to the user. Typically, the <code class=" language-php">info</code> method will display in the
        console as green text:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Execute the console command.
 *
 * @return mixed
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">handle<span
                        class="token punctuation">(</span></span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token this">$this</span><span class="token operator">-</span><span
                    class="token operator">&gt;</span><span class="token function">info<span
                        class="token punctuation">(</span></span><span
                    class="token string">'Display this on the screen'</span><span
                    class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
    <p>To display an error message, use the <code class=" language-php">error</code> method. Error message text is
        typically displayed in red:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token this">$this</span><span
                    class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">error<span
                        class="token punctuation">(</span></span><span
                    class="token string">'Something went wrong!'</span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span></code></pre>
    <p>If you would like to display plain, uncolored console output, use the <code class=" language-php">line</code>
        method:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token this">$this</span><span
                    class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">line<span
                        class="token punctuation">(</span></span><span
                    class="token string">'Display this on the screen'</span><span
                    class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
    <h4>Table Layouts</h4>
    <p>The <code class=" language-php">table</code> method makes it easy to correctly format multiple rows / columns of
        data. Just pass in the headers and rows to the method. The width and height will be dynamically calculated based
        on the given data:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token variable">$headers</span> <span
                    class="token operator">=</span> <span class="token punctuation">[</span><span class="token string">'Name'</span><span
                    class="token punctuation">,</span> <span class="token string">'Email'</span><span
                    class="token punctuation">]</span><span class="token punctuation">;</span>

<span class="token variable">$users</span> <span class="token operator">=</span> <span class="token scope">App<span
                        class="token punctuation">\</span>User<span class="token punctuation">::</span></span><span
                    class="token function">all<span class="token punctuation">(</span></span><span
                    class="token punctuation">[</span><span class="token string">'name'</span><span
                    class="token punctuation">,</span> <span class="token string">'email'</span><span
                    class="token punctuation">]</span><span class="token punctuation">)</span><span
                    class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">toArray<span
                        class="token punctuation">(</span></span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span>

<span class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span
                    class="token function">table<span class="token punctuation">(</span></span><span
                    class="token variable">$headers</span><span class="token punctuation">,</span> <span
                    class="token variable">$users</span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span></code></pre>
    <h4>Progress Bars</h4>
    <p>For long running tasks, it could be helpful to show a progress indicator. Using the output object, we can start,
        advance and stop the Progress Bar. First, define the total number of steps the process will iterate through.
        Then, advance the Progress Bar after processing each item:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token variable">$users</span> <span
                    class="token operator">=</span> <span class="token scope">App<span
                        class="token punctuation">\</span>User<span class="token punctuation">::</span></span><span
                    class="token function">all<span class="token punctuation">(</span></span><span
                    class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$bar</span> <span class="token operator">=</span> <span
                    class="token this">$this</span><span class="token operator">-</span><span class="token operator">&gt;</span><span
                    class="token property">output</span><span class="token operator">-</span><span
                    class="token operator">&gt;</span><span class="token function">createProgressBar<span
                        class="token punctuation">(</span></span><span class="token function">count<span
                        class="token punctuation">(</span></span><span class="token variable">$users</span><span
                    class="token punctuation">)</span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span>

<span class="token variable">$bar</span><span class="token operator">-</span><span
                    class="token operator">&gt;</span><span class="token function">start<span class="token punctuation">(</span></span><span
                    class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token keyword">foreach</span> <span class="token punctuation">(</span><span
                    class="token variable">$users</span> <span class="token keyword">as</span> <span
                    class="token variable">$user</span><span class="token punctuation">)</span> <span
                    class="token punctuation">{</span>
    <span class="token this">$this</span><span class="token operator">-</span><span
                    class="token operator">&gt;</span><span class="token function">performTask<span
                        class="token punctuation">(</span></span><span class="token variable">$user</span><span
                    class="token punctuation">)</span><span class="token punctuation">;</span>

    <span class="token variable">$bar</span><span class="token operator">-</span><span
                    class="token operator">&gt;</span><span class="token function">advance<span
                        class="token punctuation">(</span></span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span>
<span class="token punctuation">}</span>

<span class="token variable">$bar</span><span class="token operator">-</span><span
                    class="token operator">&gt;</span><span class="token function">finish<span
                        class="token punctuation">(</span></span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span></code></pre>
    <p>For more advanced options, check out the <a
                href="https://symfony.com/doc/current/components/console/helpers/progressbar.html">Symfony Progress Bar
            component documentation</a>.</p>
    <p><a name="registering-commands"></a></p>
    <h2><a href="#registering-commands">Registering Commands</a></h2>
    <p>Because of the <code class=" language-php">load</code> method call in your console kernel's <code
                class=" language-php">commands</code> method, all commands within the <code
                class=" language-php">app<span class="token operator">/</span>Console<span
                    class="token operator">/</span>Commands</code> directory will automatically be registered with
        Space. In fact, you are free to make additional calls to the <code class=" language-php">load</code> method to
        scan other directories for Space commands:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Register the commands for the application.
 *
 * @return void
 */</span>
<span class="token keyword">protected</span> <span class="token keyword">function</span> <span class="token function">commands<span
                        class="token punctuation">(</span></span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token this">$this</span><span class="token operator">-</span><span
                    class="token operator">&gt;</span><span class="token function">load<span
                        class="token punctuation">(</span></span><span class="token constant">__DIR__</span><span
                    class="token punctuation">.</span><span class="token string">'/Commands'</span><span
                    class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token this">$this</span><span class="token operator">-</span><span
                    class="token operator">&gt;</span><span class="token function">load<span
                        class="token punctuation">(</span></span><span class="token constant">__DIR__</span><span
                    class="token punctuation">.</span><span class="token string">'/MoreCommands'</span><span
                    class="token punctuation">)</span><span class="token punctuation">;</span>

   <span class="token comment" spellcheck="true"> // ...
</span><span class="token punctuation">}</span></code></pre>
    <p>You may also manually register commands by adding its class name to the <code class=" language-php"><span
                    class="token variable">$commands</span></code> property of your <code class=" language-php">app<span
                    class="token operator">/</span>Console<span class="token operator">/</span>Kernel<span
                    class="token punctuation">.</span>php</code> file. When Space boots, all the commands listed in this
        property will be resolved by the <a href="/docs/5.7/container">service container</a> and registered with Space:
    </p>
    <pre class=" language-php"><code class=" language-php"><span class="token keyword">protected</span> <span
                    class="token variable">$commands</span> <span class="token operator">=</span> <span
                    class="token punctuation">[</span>
    <span class="token scope">Commands<span class="token punctuation">\</span>SendEmails<span class="token punctuation">::</span></span><span
                    class="token keyword">class</span>
<span class="token punctuation">]</span><span class="token punctuation">;</span></code></pre>
    <p><a name="programmatically-executing-commands"></a></p>
    <h2><a href="#programmatically-executing-commands">Programmatically Executing Commands</a></h2>
    <p>Sometimes you may wish to execute an Space command outside of the CLI. For example, you may wish to fire an Space
        command from a route or controller. You may use the <code class=" language-php">call</code> method on the <code
                class=" language-php">Space</code> facade to accomplish this. The <code
                class=" language-php">call</code> method accepts either the command's name or class as the first
        argument, and an array of command parameters as the second argument. The exit code will be returned:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token scope">Route<span
                        class="token punctuation">::</span></span><span class="token function">get<span
                        class="token punctuation">(</span></span><span class="token string">'/foo'</span><span
                    class="token punctuation">,</span> <span class="token keyword">function</span> <span
                    class="token punctuation">(</span><span class="token punctuation">)</span> <span
                    class="token punctuation">{</span>
    <span class="token variable">$exitCode</span> <span class="token operator">=</span> <span
                    class="token scope">Space<span class="token punctuation">::</span></span><span
                    class="token function">call<span class="token punctuation">(</span></span><span
                    class="token string">'email:send'</span><span class="token punctuation">,</span> <span
                    class="token punctuation">[</span>
        <span class="token string">'user'</span> <span class="token operator">=</span><span
                    class="token operator">&gt;</span> <span class="token number">1</span><span
                    class="token punctuation">,</span> <span class="token string">'--queue'</span> <span
                    class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'default'</span>
    <span class="token punctuation">]</span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span>

   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span></code></pre>
    <p>Using the <code class=" language-php">queue</code> method on the <code class=" language-php">Space</code> facade,
        you may even queue Space commands so they are processed in the background by your <a href="/docs/5.7/queues">queue
            workers</a>. Before using this method, make sure you have configured your queue and are running a queue
        listener:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token scope">Route<span
                        class="token punctuation">::</span></span><span class="token function">get<span
                        class="token punctuation">(</span></span><span class="token string">'/foo'</span><span
                    class="token punctuation">,</span> <span class="token keyword">function</span> <span
                    class="token punctuation">(</span><span class="token punctuation">)</span> <span
                    class="token punctuation">{</span>
    <span class="token scope">Space<span class="token punctuation">::</span></span><span
                    class="token function">queue<span class="token punctuation">(</span></span><span
                    class="token string">'email:send'</span><span class="token punctuation">,</span> <span
                    class="token punctuation">[</span>
        <span class="token string">'user'</span> <span class="token operator">=</span><span
                    class="token operator">&gt;</span> <span class="token number">1</span><span
                    class="token punctuation">,</span> <span class="token string">'--queue'</span> <span
                    class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'default'</span>
    <span class="token punctuation">]</span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span>

   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span></code></pre>
    <p>You may also specify the connection or queue the Space command should be dispatched to:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token scope">Space<span
                        class="token punctuation">::</span></span><span class="token function">queue<span
                        class="token punctuation">(</span></span><span class="token string">'email:send'</span><span
                    class="token punctuation">,</span> <span class="token punctuation">[</span>
    <span class="token string">'user'</span> <span class="token operator">=</span><span
                    class="token operator">&gt;</span> <span class="token number">1</span><span
                    class="token punctuation">,</span> <span class="token string">'--queue'</span> <span
                    class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'default'</span>
<span class="token punctuation">]</span><span class="token punctuation">)</span><span
                    class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">onConnection<span
                        class="token punctuation">(</span></span><span class="token string">'redis'</span><span
                    class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span
                    class="token function">onQueue<span class="token punctuation">(</span></span><span
                    class="token string">'commands'</span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span></code></pre>
    <h4>Passing Array Values</h4>
    <p>If your command defines an option that accepts an array, you may pass an array of values to that option:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token scope">Route<span
                        class="token punctuation">::</span></span><span class="token function">get<span
                        class="token punctuation">(</span></span><span class="token string">'/foo'</span><span
                    class="token punctuation">,</span> <span class="token keyword">function</span> <span
                    class="token punctuation">(</span><span class="token punctuation">)</span> <span
                    class="token punctuation">{</span>
    <span class="token variable">$exitCode</span> <span class="token operator">=</span> <span
                    class="token scope">Space<span class="token punctuation">::</span></span><span
                    class="token function">call<span class="token punctuation">(</span></span><span
                    class="token string">'email:send'</span><span class="token punctuation">,</span> <span
                    class="token punctuation">[</span>
        <span class="token string">'user'</span> <span class="token operator">=</span><span
                    class="token operator">&gt;</span> <span class="token number">1</span><span
                    class="token punctuation">,</span> <span class="token string">'--id'</span> <span
                    class="token operator">=</span><span class="token operator">&gt;</span> <span
                    class="token punctuation">[</span><span class="token number">5</span><span
                    class="token punctuation">,</span> <span class="token number">13</span><span
                    class="token punctuation">]</span>
    <span class="token punctuation">]</span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span>
<span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
    <h4>Passing Boolean Values</h4>
    <p>If you need to specify the value of an option that does not accept string values, such as the <code
                class=" language-php"><span class="token operator">--</span>force</code> flag on the <code
                class=" language-php">migrate<span class="token punctuation">:</span>refresh</code> command, you should
        pass <code class=" language-php"><span class="token boolean">true</span></code> or <code
                class=" language-php"><span class="token boolean">false</span></code>:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token variable">$exitCode</span> <span
                    class="token operator">=</span> <span class="token scope">Space<span
                        class="token punctuation">::</span></span><span class="token function">call<span
                        class="token punctuation">(</span></span><span
                    class="token string">'migrate:refresh'</span><span class="token punctuation">,</span> <span
                    class="token punctuation">[</span>
    <span class="token string">'--force'</span> <span class="token operator">=</span><span
                    class="token operator">&gt;</span> <span class="token boolean">true</span><span
                    class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
    <p><a name="calling-commands-from-other-commands"></a></p>
    <h3>Calling Commands From Other Commands</h3>
    <p>Sometimes you may wish to call other commands from an existing Space command. You may do so using the <code
                class=" language-php">call</code> method. This <code class=" language-php">call</code> method accepts
        the command name and an array of command parameters:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token comment" spellcheck="true">/**
 * Execute the console command.
 *
 * @return mixed
 */</span>
<span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">handle<span
                        class="token punctuation">(</span></span><span class="token punctuation">)</span>
<span class="token punctuation">{</span>
    <span class="token this">$this</span><span class="token operator">-</span><span
                    class="token operator">&gt;</span><span class="token function">call<span
                        class="token punctuation">(</span></span><span class="token string">'email:send'</span><span
                    class="token punctuation">,</span> <span class="token punctuation">[</span>
        <span class="token string">'user'</span> <span class="token operator">=</span><span
                    class="token operator">&gt;</span> <span class="token number">1</span><span
                    class="token punctuation">,</span> <span class="token string">'--queue'</span> <span
                    class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'default'</span>
    <span class="token punctuation">]</span><span class="token punctuation">)</span><span
                    class="token punctuation">;</span>

   <span class="token comment" spellcheck="true"> //
</span><span class="token punctuation">}</span></code></pre>
    <p>If you would like to call another console command and suppress all of its output, you may use the <code
                class=" language-php">callSilent</code> method. The <code class=" language-php">callSilent</code> method
        has the same signature as the <code class=" language-php">call</code> method:</p>
    <pre class=" language-php"><code class=" language-php"><span class="token this">$this</span><span
                    class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">callSilent<span
                        class="token punctuation">(</span></span><span class="token string">'email:send'</span><span
                    class="token punctuation">,</span> <span class="token punctuation">[</span>
    <span class="token string">'user'</span> <span class="token operator">=</span><span
                    class="token operator">&gt;</span> <span class="token number">1</span><span
                    class="token punctuation">,</span> <span class="token string">'--queue'</span> <span
                    class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'default'</span>
<span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
</article>