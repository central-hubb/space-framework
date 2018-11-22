<?php use App\Library\Framework\Component\Code; ?>

<article>
	<h1>Validation</h1>
	<h4>Introduction</h4>
	<p>Space MVC provides several different approaches to validate your application's incoming data. By default, Space MVC's base controller class uses a ValidatesRequests trait which provides a convenient method to validate incoming HTTP request with a variety of powerful validation rules.</p>
	<p><a name="validation-quickstart"></a></p>
	<h2><a href="#validation-quickstart">Validation Quickstart</a></h2>
	<p>To learn about Space MVC's powerful validation features, let's look at a complete example of validating a form and displaying the error messages back to the user.</p>
	<p><a name="quick-defining-the-routes"></a></p>
	<h3>Defining The Routes</h3>
	<p>First, let's assume we have the following routes defined in our routes/web.php file:</p>
	<?php echo Code::getHtmlStatic('Route::get(\'post/create\', \'PostController@create\');

Route::post(\'post\', \'PostController@store\');'); ?>
	<p>Of course, the GET route will display a form for the user to create a new blog post, while the POST route will store the new blog post in the database.</p>
	<p><a name="quick-creating-the-controller"></a></p>
	<h3>Creating The Controller</h3>
	<p>Next, let's take a look at a simple controller that handles these routes. We'll leave the store method empty for now:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Show the form to create a new blog post.
     *
     * @return Response
     */
    public function create()
    {
        return view(\'post.create\');
    }

    /**
     * Store a new blog post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Validate and store the blog post...
    }
}'); ?>
	<p><a name="quick-writing-the-validation-logic"></a></p>
	<h3>Writing The Validation Logic</h3>
	<p>Now we are ready to fill in our store method with the logic to validate the new blog post. To do this, we will use the validate method provided by the Illuminate\Http\Request object. If the validation rules pass, your code will keep executing normally; however, if validation fails, an exception will be thrown and the proper error response will automatically be sent back to the user. In the case of a traditional HTTP request, a redirect response will be generated, while a JSON response will be sent for AJAX requests.</p>
	<p>To get a better understanding of the validate method, let's jump back into the store method:</p>
	<?php echo Code::getHtmlStatic('/**
 * Store a new blog post.
 *
 * @param  Request  $request
 * @return Response
 */
public function store(Request $request)
{
    $validatedData = $request-&gt;validate([
        \'title\' =&gt; \'required|unique:posts|max:255\',
        \'body\' =&gt; \'required\',
    ]);

    // The blog post is valid...
}'); ?>
	<p>As you can see, we pass the desired validation rules into the validate method. Again, if the validation fails, the proper response will automatically be generated. If the validation passes, our controller will continue executing normally.</p>
	<h4>Stopping On First Validation Failure</h4>
	<p>Sometimes you may wish to stop running validation rules on an attribute after the first validation failure. To do so, assign the bail rule to the attribute:</p>
	<?php echo Code::getHtmlStatic('$request-&gt;validate([
    \'title\' =&gt; \'bail|required|unique:posts|max:255\',
    \'body\' =&gt; \'required\',
]);'); ?>
	<p>In this example, if the unique rule on the title attribute fails, the max rule will not be checked. Rules will be validated in the order they are assigned.</p>
	<h4>A Note On Nested Attributes</h4>
	<p>If your HTTP request contains "nested" parameters, you may specify them in your validation rules using "dot" syntax:</p>
	<?php echo Code::getHtmlStatic('$request-&gt;validate([
    \'title\' =&gt; \'required|unique:posts|max:255\',
    \'author.name\' =&gt; \'required\',
    \'author.description\' =&gt; \'required\',
]);'); ?>
	<p><a name="quick-displaying-the-validation-errors"></a></p>
	<h3>Displaying The Validation Errors</h3>
	<p>So, what if the incoming request parameters do not pass the given validation rules? As mentioned previously, Space MVC will automatically redirect the user back to their previous location. In addition, all of the validation errors will automatically be <a href="/docs/5.7/session#flash-data">flashed to the session</a>.</p>
	<p>Again, notice that we did not have to explicitly bind the error messages to the view in our GET route. This is because Space MVC will check for errors in the session data, and automatically bind them to the view if they are available. The $errors variable will be an instance of Illuminate\Support\MessageBag. For more information on working with this object, <a href="#working-with-error-messages">check out its documentation</a>.</p>
	<p>The $errors variable is bound to the view by the Illuminate\View\Middleware\ShareErrorsFromSession middleware, which is provided by the web middleware group. <strong>When this middleware is applied an $errors variable will always be available in your views</strong>, allowing you to conveniently assume the $errors variable is always defined and can be safely used.</p>
	<p>So, in our example, the user will be redirected to our controller's create method when validation fails, allowing us to display the error messages in the view:</p>
	<?php echo Code::getHtmlStatic('&lt;!-- /resources/views/post/create.blade.php --&gt;

&lt;h1&gt;Create Post&lt;/h1&gt;

@if ($errors-&gt;any())
    &lt;div class="alert alert-danger"&gt;
        &lt;ul&gt;
            @foreach ($errors-&gt;all() as $error)
                &lt;li&gt;{{ $error }}&lt;/li&gt;
            @endforeach
        &lt;/ul&gt;
    &lt;/div&gt;
@endif

&lt;!-- Create Post Form --&gt;'); ?>
	<p><a name="a-note-on-optional-fields"></a></p>
	<h3>A Note On Optional Fields</h3>
	<p>By default, Space MVC includes the TrimStrings and ConvertEmptyStringsToNull middleware in your application's global middleware stack. These middleware are listed in the stack by the App\Http\Kernel class. Because of this, you will often need to mark your "optional" request fields as nullable if you do not want the validator to consider null values as invalid. For example:</p>
	<?php echo Code::getHtmlStatic('$request-&gt;validate([
    \'title\' =&gt; \'required|unique:posts|max:255\',
    \'body\' =&gt; \'required\',
    \'publish_at\' =&gt; \'nullable|date\',
]);'); ?>
	<p>In this example, we are specifying that the publish_at field may be either null or a valid date representation. If the nullable modifier is not added to the rule definition, the validator would consider null an invalid date.</p>
	<p><a name="quick-ajax-requests-and-validation"></a></p>
	<h4>AJAX Requests &amp; Validation</h4>
	<p>In this example, we used a traditional form to send data to the application. However, many applications use AJAX requests. When using the validate method during an AJAX request, Space MVC will not generate a redirect response. Instead, Space MVC generates a JSON response containing all of the validation errors. This JSON response will be sent with a 422 HTTP status code.</p>
	<p><a name="form-request-validation"></a></p>
	<h2><a href="#form-request-validation">Form Request Validation</a></h2>
	<p><a name="creating-form-requests"></a></p>
	<h3>Creating Form Requests</h3>
	<p>For more complex validation scenarios, you may wish to create a "form request". Form requests are custom request classes that contain validation logic. To create a form request class, use the make:request Artisan CLI command:</p>
	<?php echo Code::getHtmlStatic('php artisan make:request StoreBlogPost'); ?>
	<p>The generated class will be placed in the app/Http/Requests directory. If this directory does not exist, it will be created when you run the make:request command. let's add a few validation rules to the rules method:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the validation rules that apply to the request.
 *
 * @return array
 */
public function rules()
{
    return [
        \'title\' =&gt; \'required|unique:posts|max:255\',
        \'body\' =&gt; \'required\',
    ];
}'); ?>
	<p>You may type-hint any dependencies you need within the rules method's signature. They will automatically be resolved via the Space MVC <a href="/docs/5.7/container">service container</a>.</p>
	<p>So, how are the validation rules evaluated? All you need to do is type-hint the request on your controller method. The incoming form request is validated before the controller method is called, meaning you do not need to clutter your controller with any validation logic:</p>
	<?php echo Code::getHtmlStatic('/**
 * Store the incoming blog post.
 *
 * @param  StoreBlogPost  $request
 * @return Response
 */
public function store(StoreBlogPost $request)
{
    // The incoming request is valid...

    // Retrieve the validated input data...
    $validated = $request-&gt;validated();
}'); ?>
	<p>If validation fails, a redirect response will be generated to send the user back to their previous location. The errors will also be flashed to the session so they are available for display. If the request was an AJAX request, a HTTP response with a 422 status code will be returned to the user including a JSON representation of the validation errors.</p>
	<h4>Adding After Hooks To Form Requests</h4>
	<p>If you would like to add an "after" hook to a form request, you may use the withValidator method. This method receives the fully constructed validator, allowing you to call any of its methods before the validation rules are actually evaluated:</p>
	<?php echo Code::getHtmlStatic('/**
 * Configure the validator instance.
 *
 * @param  \Illuminate\Validation\Validator  $validator
 * @return void
 */
public function withValidator($validator)
{
    $validator-&gt;after(function ($validator) {
        if ($this-&gt;somethingElseIsInvalid()) {
            $validator-&gt;errors()-&gt;add(\'field\', \'Something is wrong with this field!\');
        }
    });
}'); ?>
	<p><a name="authorizing-form-requests"></a></p>
	<h3>Authorizing Form Requests</h3>
	<p>The form request class also contains an authorize method. Within this method, you may check if the authenticated user actually has the authority to update a given resource. For example, you may determine if a user actually owns a blog comment they are attempting to update:</p>
	<?php echo Code::getHtmlStatic('/**
 * Determine if the user is authorized to make this request.
 *
 * @return bool
 */
public function authorize()
{
    $comment = Comment::find($this-&gt;route(\'comment\'));

    return $comment &amp;&amp; $this-&gt;user()-&gt;can(\'update\', $comment);
}'); ?>
	<p>Since all form requests extend the base Space MVC request class, we may use the user method to access the currently authenticated user. Also note the call to the route method in the example above. This method grants you access to the URI parameters defined on the route being called, such as the {comment} parameter in the example below:</p>
	<?php echo Code::getHtmlStatic('Route::post(\'comment/{comment}\');'); ?>
	<p>If the authorize method returns false, a HTTP response with a 403 status code will automatically be returned and your controller method will not execute.</p>
	<p>If you plan to have authorization logic in another part of your application, return true from the authorize method:</p>
	<?php echo Code::getHtmlStatic('/**
 * Determine if the user is authorized to make this request.
 *
 * @return bool
 */
public function authorize()
{
    return true;
}'); ?>
	<p>You may type-hint any dependencies you need within the authorize method's signature. They will automatically be resolved via the Space MVC <a href="/docs/5.7/container">service container</a>.</p>
	<p><a name="customizing-the-error-messages"></a></p>
	<h3>Customizing The Error Messages</h3>
	<p>You may customize the error messages used by the form request by overriding the messages method. This method should return an array of attribute / rule pairs and their corresponding error messages:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the error messages for the defined validation rules.
 *
 * @return array
 */
public function messages()
{
    return [
        \'title.required\' =&gt; \'A title is required\',
        \'body.required\'  =&gt; \'A message is required\',
    ];
}'); ?>
	<p><a name="manually-creating-validators"></a></p>
	<h2><a href="#manually-creating-validators">Manually Creating Validators</a></h2>
	<p>If you do not want to use the validate method on the request, you may create a validator instance manually using the Validator <a href="/docs/5.7/facades">facade</a>. The make method on the facade generates a new validator instance:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Store a new blog post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request-&gt;all(), [
            \'title\' =&gt; \'required|unique:posts|max:255\',
            \'body\' =&gt; \'required\',
        ]);

        if ($validator-&gt;fails()) {
            return redirect(\'post/create\')
                        -&gt;withErrors($validator)
                        -&gt;withInput();
        }

        // Store the blog post...
    }
}'); ?>
	<p>The first argument passed to the make method is the data under validation. The second argument is the validation rules that should be applied to the data.</p>
	<p>After checking if the request validation failed, you may use the withErrors method to flash the error messages to the session. When using this method, the $errors variable will automatically be shared with your views after redirection, allowing you to easily display them back to the user. The withErrors method accepts a validator, a MessageBag, or a PHP array.</p>
	<p><a name="automatic-redirection"></a></p>
	<h3>Automatic Redirection</h3>
	<p>If you would like to create a validator instance manually but still take advantage of the automatic redirection offered by the requests's validate method, you may call the validate method on an existing validator instance. If validation fails, the user will automatically be redirected or, in the case of an AJAX request, a JSON response will be returned:</p>
	<?php echo Code::getHtmlStatic('Validator::make($request-&gt;all(), [
    \'title\' =&gt; \'required|unique:posts|max:255\',
    \'body\' =&gt; \'required\',
])-&gt;validate();'); ?>
	<p><a name="named-error-bags"></a></p>
	<h3>Named Error Bags</h3>
	<p>If you have multiple forms on a single page, you may wish to name the MessageBag of errors, allowing you to retrieve the error messages for a specific form. Pass a name as the second argument to withErrors:</p>
	<?php echo Code::getHtmlStatic('return redirect(\'register\')
            -&gt;withErrors($validator, \'login\');'); ?>
	<p>You may then access the named MessageBag instance from the $errors variable:</p>
	<?php echo Code::getHtmlStatic('{{ $errors-&gt;login-&gt;first(\'email\') }}'); ?>
	<p><a name="after-validation-hook"></a></p>
	<h3>After Validation Hook</h3>
	<p>The validator also allows you to attach callbacks to be run after validation is completed. This allows you to easily perform further validation and even add more error messages to the message collection. To get started, use the after method on a validator instance:</p>
	<?php echo Code::getHtmlStatic('$validator = Validator::make(...);

$validator-&gt;after(function ($validator) {
    if ($this-&gt;somethingElseIsInvalid()) {
        $validator-&gt;errors()-&gt;add(\'field\', \'Something is wrong with this field!\');
    }
});

if ($validator-&gt;fails()) {
    //
}'); ?>
	<p><a name="working-with-error-messages"></a></p>
	<h2><a href="#working-with-error-messages">Working With Error Messages</a></h2>
	<p>After calling the errors method on a Validator instance, you will receive an Illuminate\Support\MessageBag instance, which has a variety of convenient methods for working with error messages. The $errors variable that is automatically made available to all views is also an instance of the MessageBag class.</p>
	<h4>Retrieving The First Error Message For A Field</h4>
	<p>To retrieve the first error message for a given field, use the first method:</p>
	<?php echo Code::getHtmlStatic('$errors = $validator-&gt;errors();

echo $errors-&gt;first(\'email\');'); ?>
	<h4>Retrieving All Error Messages For A Field</h4>
	<p>If you need to retrieve an array of all the messages for a given field, use the get method:</p>
	<?php echo Code::getHtmlStatic('foreach ($errors-&gt;get(\'email\') as $message) {
    //
}'); ?>
	<p>If you are validating an array form field, you may retrieve all of the messages for each of the array elements using the * character:</p>
	<?php echo Code::getHtmlStatic('foreach ($errors-&gt;get(\'attachments.*\') as $message) {
    //
}'); ?>
	<h4>Retrieving All Error Messages For All Fields</h4>
	<p>To retrieve an array of all messages for all fields, use the all method:</p>
	<?php echo Code::getHtmlStatic('foreach ($errors-&gt;all() as $message) {
    //
}'); ?>
	<h4>Determining If Messages Exist For A Field</h4>
	<p>The has method may be used to determine if any error messages exist for a given field:</p>
	<?php echo Code::getHtmlStatic('if ($errors-&gt;has(\'email\')) {
    //
}'); ?>
	<p><a name="custom-error-messages"></a></p>
	<h3>Custom Error Messages</h3>
	<p>If needed, you may use custom error messages for validation instead of the defaults. There are several ways to specify custom messages. First, you may pass the custom messages as the third argument to the Validator::make method:</p>
	<?php echo Code::getHtmlStatic('$messages = [
    \'required\' =&gt; \'The :attribute field is required.\',
];

$validator = Validator::make($input, $rules, $messages);'); ?>
	<p>In this example, the :attribute place-holder will be replaced by the actual name of the field under validation. You may also utilize other place-holders in validation messages. For example:</p>
	<?php echo Code::getHtmlStatic('$messages = [
    \'same\'    =&gt; \'The :attribute and :other must match.\',
    \'size\'    =&gt; \'The :attribute must be exactly :size.\',
    \'between\' =&gt; \'The :attribute value :input is not between :min - :max.\',
    \'in\'      =&gt; \'The :attribute must be one of the following types: :values\',
];'); ?>
	<h4>Specifying A Custom Message For A Given Attribute</h4>
	<p>Sometimes you may wish to specify a custom error messages only for a specific field. You may do so using "dot" notation. Specify the attribute's name first, followed by the rule:</p>
	<?php echo Code::getHtmlStatic('$messages = [
    \'email.required\' =&gt; \'We need to know your e-mail address!\',
];'); ?>
	<p><a name="localization"></a></p>
	<h4>Specifying Custom Messages In Language Files</h4>
	<p>In most cases, you will probably specify your custom messages in a language file instead of passing them directly to the Validator. To do so, add your messages to custom array in the resources/lang/xx/validation.php language file.</p>
	<?php echo Code::getHtmlStatic('\'custom\' =&gt; [
    \'email\' =&gt; [
        \'required\' =&gt; \'We need to know your e-mail address!\',
    ],
],'); ?>
	<h4>Specifying Custom Attributes In Language Files</h4>
	<p>If you would like the :attribute portion of your validation message to be replaced with a custom attribute name, you may specify the custom name in the attributes array of your resources/lang/xx/validation.php language file:</p>
	<?php echo Code::getHtmlStatic('\'attributes\' =&gt; [
    \'email\' =&gt; \'email address\',
],'); ?>
	<p><a name="available-validation-rules"></a></p>
	<h2><a href="#available-validation-rules">Available Validation Rules</a></h2>
	<p>Below is a list of all available validation rules and their function:</p>
	<style>
		.collection-method-list > p {
			column-count: 3; -moz-column-count: 3; -webkit-column-count: 3;
			column-gap: 2em; -moz-column-gap: 2em; -webkit-column-gap: 2em;
		}

		.collection-method-list a {
			display: block;
		}
	</style>
	<div class="collection-method-list">
		<p><a href="#rule-accepted">Accepted</a>
			<a href="#rule-active-url">Active URL</a>
			<a href="#rule-after">After (Date)</a>
			<a href="#rule-after-or-equal">After Or Equal (Date)</a>
			<a href="#rule-alpha">Alpha</a>
			<a href="#rule-alpha-dash">Alpha Dash</a>
			<a href="#rule-alpha-num">Alpha Numeric</a>
			<a href="#rule-array">Array</a>
			<a href="#rule-bail">Bail</a>
			<a href="#rule-before">Before (Date)</a>
			<a href="#rule-before-or-equal">Before Or Equal (Date)</a>
			<a href="#rule-between">Between</a>
			<a href="#rule-boolean">Boolean</a>
			<a href="#rule-confirmed">Confirmed</a>
			<a href="#rule-date">Date</a>
			<a href="#rule-date-equals">Date Equals</a>
			<a href="#rule-date-format">Date Format</a>
			<a href="#rule-different">Different</a>
			<a href="#rule-digits">Digits</a>
			<a href="#rule-digits-between">Digits Between</a>
			<a href="#rule-dimensions">Dimensions (Image Files)</a>
			<a href="#rule-distinct">Distinct</a>
			<a href="#rule-email">E-Mail</a>
			<a href="#rule-exists">Exists (Database)</a>
			<a href="#rule-file">File</a>
			<a href="#rule-filled">Filled</a>
			<a href="#rule-gt">Greater Than</a>
			<a href="#rule-gte">Greater Than Or Equal</a>
			<a href="#rule-image">Image (File)</a>
			<a href="#rule-in">In</a>
			<a href="#rule-in-array">In Array</a>
			<a href="#rule-integer">Integer</a>
			<a href="#rule-ip">IP Address</a>
			<a href="#rule-json">JSON</a>
			<a href="#rule-lt">Less Than</a>
			<a href="#rule-lte">Less Than Or Equal</a>
			<a href="#rule-max">Max</a>
			<a href="#rule-mimetypes">MIME Types</a>
			<a href="#rule-mimes">MIME Type By File Extension</a>
			<a href="#rule-min">Min</a>
			<a href="#rule-not-in">Not In</a>
			<a href="#rule-not-regex">Not Regex</a>
			<a href="#rule-nullable">Nullable</a>
			<a href="#rule-numeric">Numeric</a>
			<a href="#rule-present">Present</a>
			<a href="#rule-regex">Regular Expression</a>
			<a href="#rule-required">Required</a>
			<a href="#rule-required-if">Required If</a>
			<a href="#rule-required-unless">Required Unless</a>
			<a href="#rule-required-with">Required With</a>
			<a href="#rule-required-with-all">Required With All</a>
			<a href="#rule-required-without">Required Without</a>
			<a href="#rule-required-without-all">Required Without All</a>
			<a href="#rule-same">Same</a>
			<a href="#rule-size">Size</a>
			<a href="#rule-string">String</a>
			<a href="#rule-timezone">Timezone</a>
			<a href="#rule-unique">Unique (Database)</a>
			<a href="#rule-url">URL</a>
			<a href="#rule-uuid">UUID</a></p>
	</div>
	<p><a name="rule-accepted"></a></p>
	<h4>accepted</h4>
	<p>The field under validation must be <em>yes</em>, <em>on</em>, <em>1</em>, or <em>true</em>. This is useful for validating "Terms of Service" acceptance.</p>
	<p><a name="rule-active-url"></a></p>
	<h4>active_url</h4>
	<p>The field under validation must have a valid A or AAAA record according to the dns_get_record PHP function.</p>
	<p><a name="rule-after"></a></p>
	<h4>after:<em>date</em></h4>
	<p>The field under validation must be a value after a given date. The dates will be passed into the strtotime PHP function:</p>
	<?php echo Code::getHtmlStatic('\'start_date\' =&gt; \'required|date|after:tomorrow\''); ?>
	<p>Instead of passing a date string to be evaluated by strtotime, you may specify another field to compare against the date:</p>
	<?php echo Code::getHtmlStatic('\'finish_date\' =&gt; \'required|date|after:start_date\''); ?>
	<p><a name="rule-after-or-equal"></a></p>
	<h4>after_or_equal:<em>date</em></h4>
	<p>The field under validation must be a value after or equal to the given date. For more information, see the <a href="#rule-after">after</a> rule.</p>
	<p><a name="rule-alpha"></a></p>
	<h4>alpha</h4>
	<p>The field under validation must be entirely alphabetic characters.</p>
	<p><a name="rule-alpha-dash"></a></p>
	<h4>alpha_dash</h4>
	<p>The field under validation may have alpha-numeric characters, as well as dashes and underscores.</p>
	<p><a name="rule-alpha-num"></a></p>
	<h4>alpha_num</h4>
	<p>The field under validation must be entirely alpha-numeric characters.</p>
	<p><a name="rule-array"></a></p>
	<h4>array</h4>
	<p>The field under validation must be a PHP array.</p>
	<p><a name="rule-bail"></a></p>
	<h4>bail</h4>
	<p>Stop running validation rules after the first validation failure.</p>
	<p><a name="rule-before"></a></p>
	<h4>before:<em>date</em></h4>
	<p>The field under validation must be a value preceding the given date. The dates will be passed into the PHP strtotime function. In addition, like the <a href="#rule-after">after</a> rule, the name of another field under validation may be supplied as the value of date.</p>
	<p><a name="rule-before-or-equal"></a></p>
	<h4>before_or_equal:<em>date</em></h4>
	<p>The field under validation must be a value preceding or equal to the given date. The dates will be passed into the PHP strtotime function. In addition, like the <a href="#rule-after">after</a> rule, the name of another field under validation may be supplied as the value of date.</p>
	<p><a name="rule-between"></a></p>
	<h4>between:<em>min</em>,<em>max</em></h4>
	<p>The field under validation must have a size between the given <em>min</em> and <em>max</em>. Strings, numerics, arrays, and files are evaluated in the same fashion as the <a href="#rule-size">size</a> rule.</p>
	<p><a name="rule-boolean"></a></p>
	<h4>boolean</h4>
	<p>The field under validation must be able to be cast as a boolean. Accepted input are true, false, 1, 0, "1", and "0".</p>
	<p><a name="rule-confirmed"></a></p>
	<h4>confirmed</h4>
	<p>The field under validation must have a matching field of foo_confirmation. For example, if the field under validation is password, a matching password_confirmation field must be present in the input.</p>
	<p><a name="rule-date"></a></p>
	<h4>date</h4>
	<p>The field under validation must be a valid date according to the strtotime PHP function.</p>
	<p><a name="rule-date-equals"></a></p>
	<h4>date_equals:<em>date</em></h4>
	<p>The field under validation must be equal to the given date. The dates will be passed into the PHP strtotime function.</p>
	<p><a name="rule-date-format"></a></p>
	<h4>date_format:<em>format</em></h4>
	<p>The field under validation must match the given <em>format</em>. You should use <strong>either</strong> date or date_format when validating a field, not both.</p>
	<p><a name="rule-different"></a></p>
	<h4>different:<em>field</em></h4>
	<p>The field under validation must have a different value than <em>field</em>.</p>
	<p><a name="rule-digits"></a></p>
	<h4>digits:<em>value</em></h4>
	<p>The field under validation must be <em>numeric</em> and must have an exact length of <em>value</em>.</p>
	<p><a name="rule-digits-between"></a></p>
	<h4>digits_between:<em>min</em>,<em>max</em></h4>
	<p>The field under validation must have a length between the given <em>min</em> and <em>max</em>.</p>
	<p><a name="rule-dimensions"></a></p>
	<h4>dimensions</h4>
	<p>The file under validation must be an image meeting the dimension constraints as specified by the rule's parameters:</p>
	<?php echo Code::getHtmlStatic('\'avatar\' =&gt; \'dimensions:min_width=100,min_height=200\''); ?>
	<p>Available constraints are: <em>min_width</em>, <em>max_width</em>, <em>min_height</em>, <em>max_height</em>, <em>width</em>, <em>height</em>, <em>ratio</em>.</p>
	<p>A <em>ratio</em> constraint should be represented as width divided by height. This can be specified either by a statement like 3/2 or a float like 1.5:</p>
	<?php echo Code::getHtmlStatic('\'avatar\' =&gt; \'dimensions:ratio=3/2\''); ?>
	<p>Since this rule requires several arguments, you may use the Rule::dimensions method to fluently construct the rule:</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Validation\Rule;

Validator::make($data, [
    \'avatar\' =&gt; [
        \'required\',
        Rule::dimensions()-&gt;maxWidth(1000)-&gt;maxHeight(500)-&gt;ratio(3 / 2),
    ],
]);'); ?>
	<p><a name="rule-distinct"></a></p>
	<h4>distinct</h4>
	<p>When working with arrays, the field under validation must not have any duplicate values.</p>
	<?php echo Code::getHtmlStatic('\'foo.*.id\' =&gt; \'distinct\''); ?>
	<p><a name="rule-email"></a></p>
	<h4>email</h4>
	<p>The field under validation must be formatted as an e-mail address.</p>
	<p><a name="rule-exists"></a></p>
	<h4>exists:<em>table</em>,<em>column</em></h4>
	<p>The field under validation must exist on a given database table.</p>
	<h4>Basic Usage Of Exists Rule</h4>
	<?php echo Code::getHtmlStatic('\'state\' =&gt; \'exists:states\''); ?>
	<p>If the column option is not specified, the field name will be used.</p>
	<h4>Specifying A Custom Column Name</h4>
	<?php echo Code::getHtmlStatic('\'state\' =&gt; \'exists:states,abbreviation\''); ?>
	<p>Occasionally, you may need to specify a specific database connection to be used for the exists query. You can accomplish this by prepending the connection name to the table name using "dot" syntax:</p>
	<?php echo Code::getHtmlStatic('\'email\' =&gt; \'exists:connection.staff,email\''); ?>
	<p>If you would like to customize the query executed by the validation rule, you may use the Rule class to fluently define the rule. In this example, we'll also specify the validation rules as an array instead of using the | character to delimit them:</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Validation\Rule;

Validator::make($data, [
    \'email\' =&gt; [
        \'required\',
        Rule::exists(\'staff\')-&gt;where(function ($query) {
            $query-&gt;where(\'account_id\', 1);
        }),
    ],
]);'); ?>
	<p><a name="rule-file"></a></p>
	<h4>file</h4>
	<p>The field under validation must be a successfully uploaded file.</p>
	<p><a name="rule-filled"></a></p>
	<h4>filled</h4>
	<p>The field under validation must not be empty when it is present.</p>
	<p><a name="rule-gt"></a></p>
	<h4>gt:<em>field</em></h4>
	<p>The field under validation must be greater than the given <em>field</em>. The two fields must be of the same type. Strings, numerics, arrays, and files are evaluated using the same conventions as the size rule.</p>
	<p><a name="rule-gte"></a></p>
	<h4>gte:<em>field</em></h4>
	<p>The field under validation must be greater than or equal to the given <em>field</em>. The two fields must be of the same type. Strings, numerics, arrays, and files are evaluated using the same conventions as the size rule.</p>
	<p><a name="rule-image"></a></p>
	<h4>image</h4>
	<p>The file under validation must be an image (jpeg, png, bmp, gif, or svg)</p>
	<p><a name="rule-in"></a></p>
	<h4>in:<em>foo</em>,<em>bar</em>,...</h4>
	<p>The field under validation must be included in the given list of values. Since this rule often requires you to implode an array, the Rule::in method may be used to fluently construct the rule:</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Validation\Rule;

Validator::make($data, [
    \'zones\' =&gt; [
        \'required\',
        Rule::in([\'first-zone\', \'second-zone\']),
    ],
]);'); ?>
	<p><a name="rule-in-array"></a></p>
	<h4>in_array:<em>anotherfield</em>.*</h4>
	<p>The field under validation must exist in <em>anotherfield</em>'s values.</p>
	<p><a name="rule-integer"></a></p>
	<h4>integer</h4>
	<p>The field under validation must be an integer.</p>
	<p><a name="rule-ip"></a></p>
	<h4>ip</h4>
	<p>The field under validation must be an IP address.</p>
	<h4>ipv4</h4>
	<p>The field under validation must be an IPv4 address.</p>
	<h4>ipv6</h4>
	<p>The field under validation must be an IPv6 address.</p>
	<p><a name="rule-json"></a></p>
	<h4>json</h4>
	<p>The field under validation must be a valid JSON string.</p>
	<p><a name="rule-lt"></a></p>
	<h4>lt:<em>field</em></h4>
	<p>The field under validation must be less than the given <em>field</em>. The two fields must be of the same type. Strings, numerics, arrays, and files are evaluated using the same conventions as the size rule.</p>
	<p><a name="rule-lte"></a></p>
	<h4>lte:<em>field</em></h4>
	<p>The field under validation must be less than or equal to the given <em>field</em>. The two fields must be of the same type. Strings, numerics, arrays, and files are evaluated using the same conventions as the size rule.</p>
	<p><a name="rule-max"></a></p>
	<h4>max:<em>value</em></h4>
	<p>The field under validation must be less than or equal to a maximum <em>value</em>. Strings, numerics, arrays, and files are evaluated in the same fashion as the <a href="#rule-size">size</a> rule.</p>
	<p><a name="rule-mimetypes"></a></p>
	<h4>mimetypes:<em>text/plain</em>,...</h4>
	<p>The file under validation must match one of the given MIME types:</p>
	<?php echo Code::getHtmlStatic('\'video\' =&gt; \'mimetypes:video/avi,video/mpeg,video/quicktime\''); ?>
	<p>To determine the MIME type of the uploaded file, the file's contents will be read and the framework will attempt to guess the MIME type, which may be different from the client provided MIME type.</p>
	<p><a name="rule-mimes"></a></p>
	<h4>mimes:<em>foo</em>,<em>bar</em>,...</h4>
	<p>The file under validation must have a MIME type corresponding to one of the listed extensions.</p>
	<h4>Basic Usage Of MIME Rule</h4>
	<?php echo Code::getHtmlStatic('\'photo\' =&gt; \'mimes:jpeg,bmp,png\''); ?>
	<p>Even though you only need to specify the extensions, this rule actually validates against the MIME type of the file by reading the file's contents and guessing its MIME type.</p>
	<p>A full listing of MIME types and their corresponding extensions may be found at the following location: <a href="https://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types">https://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types</a></p>
	<p><a name="rule-min"></a></p>
	<h4>min:<em>value</em></h4>
	<p>The field under validation must have a minimum <em>value</em>. Strings, numerics, arrays, and files are evaluated in the same fashion as the <a href="#rule-size">size</a> rule.</p>
	<p><a name="rule-not-in"></a></p>
	<h4>not_in:<em>foo</em>,<em>bar</em>,...</h4>
	<p>The field under validation must not be included in the given list of values. The Rule::notIn method may be used to fluently construct the rule:</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Validation\Rule;

Validator::make($data, [
    \'toppings\' =&gt; [
        \'required\',
        Rule::notIn([\'sprinkles\', \'cherries\']),
    ],
]);'); ?>
	<p><a name="rule-not-regex"></a></p>
	<h4>not_regex:<em>pattern</em></h4>
	<p>The field under validation must not match the given regular expression.</p>
	<p>Internally, this rule uses the PHP preg_match function. The pattern specified should obey the same formatting required by preg_match and thus also include valid delimiters. For example: 'email' =&gt; 'regex:/^.+@.+$/i'.</p>
	<p><strong>Note:</strong> When using the regex / not_regex patterns, it may be necessary to specify rules in an array instead of using pipe delimiters, especially if the regular expression contains a pipe character.</p>
	<p><a name="rule-nullable"></a></p>
	<h4>nullable</h4>
	<p>The field under validation may be null. This is particularly useful when validating primitive such as strings and integers that can contain null values.</p>
	<p><a name="rule-numeric"></a></p>
	<h4>numeric</h4>
	<p>The field under validation must be numeric.</p>
	<p><a name="rule-present"></a></p>
	<h4>present</h4>
	<p>The field under validation must be present in the input data but can be empty.</p>
	<p><a name="rule-regex"></a></p>
	<h4>regex:<em>pattern</em></h4>
	<p>The field under validation must match the given regular expression.</p>
	<p>Internally, this rule uses the PHP preg_match function. The pattern specified should obey the same formatting required by preg_match and thus also include valid delimiters. For example: 'email' =&gt; 'regex:/^.+@.+$/i'.</p>
	<p><strong>Note:</strong> When using the regex / not_regex patterns, it may be necessary to specify rules in an array instead of using pipe delimiters, especially if the regular expression contains a pipe character.</p>
	<p><a name="rule-required"></a></p>
	<h4>required</h4>
	<p>The field under validation must be present in the input data and not empty. A field is considered "empty" if one of the following conditions are true:</p>
	<div class="content-list">
		<ul>
			<li>The value is null.</li>
			<li>The value is an empty string.</li>
			<li>The value is an empty array or empty Countable object.</li>
			<li>The value is an uploaded file with no path.</li>
		</ul>
	</div>
	<p><a name="rule-required-if"></a></p>
	<h4>required_if:<em>anotherfield</em>,<em>value</em>,...</h4>
	<p>The field under validation must be present and not empty if the <em>anotherfield</em> field is equal to any <em>value</em>.</p>
	<p><a name="rule-required-unless"></a></p>
	<h4>required_unless:<em>anotherfield</em>,<em>value</em>,...</h4>
	<p>The field under validation must be present and not empty unless the <em>anotherfield</em> field is equal to any <em>value</em>.</p>
	<p><a name="rule-required-with"></a></p>
	<h4>required_with:<em>foo</em>,<em>bar</em>,...</h4>
	<p>The field under validation must be present and not empty <em>only if</em> any of the other specified fields are present.</p>
	<p><a name="rule-required-with-all"></a></p>
	<h4>required_with_all:<em>foo</em>,<em>bar</em>,...</h4>
	<p>The field under validation must be present and not empty <em>only if</em> all of the other specified fields are present.</p>
	<p><a name="rule-required-without"></a></p>
	<h4>required_without:<em>foo</em>,<em>bar</em>,...</h4>
	<p>The field under validation must be present and not empty <em>only when</em> any of the other specified fields are not present.</p>
	<p><a name="rule-required-without-all"></a></p>
	<h4>required_without_all:<em>foo</em>,<em>bar</em>,...</h4>
	<p>The field under validation must be present and not empty <em>only when</em> all of the other specified fields are not present.</p>
	<p><a name="rule-same"></a></p>
	<h4>same:<em>field</em></h4>
	<p>The given <em>field</em> must match the field under validation.</p>
	<p><a name="rule-size"></a></p>
	<h4>size:<em>value</em></h4>
	<p>The field under validation must have a size matching the given <em>value</em>. For string data, <em>value</em> corresponds to the number of characters. For numeric data, <em>value</em> corresponds to a given integer value. For an array, <em>size</em> corresponds to the count of the array. For files, <em>size</em> corresponds to the file size in kilobytes.</p>
	<p><a name="rule-string"></a></p>
	<h4>string</h4>
	<p>The field under validation must be a string. If you would like to allow the field to also be null, you should assign the nullable rule to the field.</p>
	<p><a name="rule-timezone"></a></p>
	<h4>timezone</h4>
	<p>The field under validation must be a valid timezone identifier according to the timezone_identifiers_list PHP function.</p>
	<p><a name="rule-unique"></a></p>
	<h4>unique:<em>table</em>,<em>column</em>,<em>except</em>,<em>idColumn</em></h4>
	<p>The field under validation must be unique in a given database table. If the column option is not specified, the field name will be used.</p>
	<p><strong>Specifying A Custom Column Name:</strong></p>
	<?php echo Code::getHtmlStatic('\'email\' =&gt; \'unique:users,email_address\''); ?>
	<p><strong>Custom Database Connection</strong></p>
	<p>Occasionally, you may need to set a custom connection for database queries made by the Validator. As seen above, setting unique:users as a validation rule will use the default database connection to query the database. To override this, specify the connection and the table name using "dot" syntax:</p>
	<?php echo Code::getHtmlStatic('\'email\' =&gt; \'unique:connection.users,email_address\''); ?>
	<p><strong>Forcing A Unique Rule To Ignore A Given ID:</strong></p>
	<p>Sometimes, you may wish to ignore a given ID during the unique check. For example, consider an "update profile" screen that includes the user's name, e-mail address, and location. Of course, you will want to verify that the e-mail address is unique. However, if the user only changes the name field and not the e-mail field, you do not want a validation error to be thrown because the user is already the owner of the e-mail address.</p>
	<p>To instruct the validator to ignore the user's ID, we'll use the Rule class to fluently define the rule. In this example, we'll also specify the validation rules as an array instead of using the | character to delimit the rules:</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Validation\Rule;

Validator::make($data, [
    \'email\' =&gt; [
        \'required\',
        Rule::unique(\'users\')-&gt;ignore($user-&gt;id),
    ],
]);'); ?>
	<p>If your table uses a primary key column name other than id, you may specify the name of the column when calling the ignore method:</p>
	<?php echo Code::getHtmlStatic('\'email\' =&gt; Rule::unique(\'users\')-&gt;ignore($user-&gt;id, \'user_id\')'); ?>
	<p><strong>Adding Additional Where Clauses:</strong></p>
	<p>You may also specify additional query constraints by customizing the query using the where method. For example, let's add a constraint that verifies the account_id is 1:</p>
	<?php echo Code::getHtmlStatic('\'email\' =&gt; Rule::unique(\'users\')-&gt;where(function ($query) {
    return $query-&gt;where(\'account_id\', 1);
})'); ?>
	<p><a name="rule-url"></a></p>
	<h4>url</h4>
	<p>The field under validation must be a valid URL.</p>
	<p><a name="rule-uuid"></a></p>
	<h4>uuid</h4>
	<p>The field under validation must be a valid RFC 4122 (version 1, 3, 4, or 5) universally unique identifier (UUID).</p>
	<p><a name="conditionally-adding-rules"></a></p>
	<h2><a href="#conditionally-adding-rules">Conditionally Adding Rules</a></h2>
	<h4>Validating When Present</h4>
	<p>In some situations, you may wish to run validation checks against a field <strong>only</strong> if that field is present in the input array. To quickly accomplish this, add the sometimes rule to your rule list:</p>
	<?php echo Code::getHtmlStatic('$v = Validator::make($data, [
    \'email\' =&gt; \'sometimes|required|email\',
]);'); ?>
	<p>In the example above, the email field will only be validated if it is present in the $data array.</p>
	<p>If you are attempting to validate a field that should always be present but may be empty, check out <a href="#a-note-on-optional-fields">this note on optional fields</a></p>
	<h4>Complex Conditional Validation</h4>
	<p>Sometimes you may wish to add validation rules based on more complex conditional logic. For example, you may wish to require a given field only if another field has a greater value than 100. Or, you may need two fields to have a given value only when another field is present. Adding these validation rules doesn't have to be a pain. First, create a Validator instance with your <em>static rules</em> that never change:</p>
	<?php echo Code::getHtmlStatic('$v = Validator::make($data, [
    \'email\' =&gt; \'required|email\',
    \'games\' =&gt; \'required|numeric\',
]);'); ?>
	<p>let's assume our web application is for game collectors. If a game collector registers with our application and they own more than 100 games, we want them to explain why they own so many games. For example, perhaps they run a game resale shop, or maybe they just enjoy collecting. To conditionally add this requirement, we can use the sometimes method on the Validator instance.</p>
	<?php echo Code::getHtmlStatic('$v-&gt;sometimes(\'reason\', \'required|max:500\', function ($input) {
    return $input-&gt;games &gt;= 100;
});'); ?>
	<p>The first argument passed to the sometimes method is the name of the field we are conditionally validating. The second argument is the rules we want to add. If the Closure passed as the third argument returns true, the rules will be added. This method makes it a breeze to build complex conditional validations. You may even add conditional validations for several fields at once:</p>
	<?php echo Code::getHtmlStatic('$v-&gt;sometimes([\'reason\', \'cost\'], \'required\', function ($input) {
    return $input-&gt;games &gt;= 100;
});'); ?>
	<p>The $input parameter passed to your Closure will be an instance of Illuminate\Support\Fluent and may be used to access your input and files.</p>
	<p><a name="validating-arrays"></a></p>
	<h2><a href="#validating-arrays">Validating Arrays</a></h2>
	<p>Validating array based form input fields doesn't have to be a pain. You may use "dot notation" to validate attributes within an array. For example, if the incoming HTTP request contains a photos[profile] field, you may validate it like so:</p>
	<?php echo Code::getHtmlStatic('$validator = Validator::make($request-&gt;all(), [
    \'photos.profile\' =&gt; \'required|image\',
]);'); ?>
	<p>You may also validate each element of an array. For example, to validate that each e-mail in a given array input field is unique, you may do the following:</p>
	<?php echo Code::getHtmlStatic('$validator = Validator::make($request-&gt;all(), [
    \'person.*.email\' =&gt; \'email|unique:users\',
    \'person.*.first_name\' =&gt; \'required_with:person.*.last_name\',
]);'); ?>
	<p>Likewise, you may use the * character when specifying your validation messages in your language files, making it a breeze to use a single validation message for array based fields:</p>
	<?php echo Code::getHtmlStatic('\'custom\' =&gt; [
    \'person.*.email\' =&gt; [
        \'unique\' =&gt; \'Each person must have a unique e-mail address\',
    ]
],'); ?>
	<p><a name="custom-validation-rules"></a></p>
	<h2><a href="#custom-validation-rules">Custom Validation Rules</a></h2>
	<p><a name="using-rule-objects"></a></p>
	<h3>Using Rule Objects</h3>
	<p>Space MVC provides a variety of helpful validation rules; however, you may wish to specify some of your own. One method of registering custom validation rules is using rule objects. To generate a new rule object, you may use the make:rule Artisan command. let's use this command to generate a rule that verifies a string is uppercase. Space MVC will place the new rule in the app/Rules directory:</p>
	<?php echo Code::getHtmlStatic('php artisan make:rule Uppercase'); ?>
	<p>Once the rule has been created, we are ready to define its behavior. A rule object contains two methods: passes and message. The passes method receives the attribute value and name, and should return true or false depending on whether the attribute value is valid or not. The message method should return the validation error message that should be used when validation fails:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Uppercase implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return strtoupper($value) === $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return \'The :attribute must be uppercase.\';
    }
}'); ?>
	<p>Of course, you may call the trans helper from your message method if you would like to return an error message from your translation files:</p>
	<?php echo Code::getHtmlStatic('/**
 * Get the validation error message.
 *
 * @return string
 */
public function message()
{
    return trans(\'validation.uppercase\');
}'); ?>
	<p>Once the rule has been defined, you may attach it to a validator by passing an instance of the rule object with your other validation rules:</p>
	<?php echo Code::getHtmlStatic('use App\Rules\Uppercase;

$request-&gt;validate([
    \'name\' =&gt; [\'required\', \'string\', new Uppercase],
]);'); ?>
	<p><a name="using-closures"></a></p>
	<h3>Using Closures</h3>
	<p>If you only need the functionality of a custom rule once throughout your application, you may use a Closure instead of a rule object. The Closure receives the attribute's name, the attribute's value, and a $fail callback that should be called if validation fails:</p>
	<?php echo Code::getHtmlStatic('$validator = Validator::make($request-&gt;all(), [
    \'title\' =&gt; [
        \'required\',
        \'max:255\',
        function ($attribute, $value, $fail) {
            if ($value === \'foo\') {
                $fail($attribute.\' is invalid.\');
            }
        },
    ],
]);'); ?>
	<p><a name="using-extensions"></a></p>
	<h3>Using Extensions</h3>
	<p>Another method of registering custom validation rules is using the extend method on the Validator <a href="/docs/5.7/facades">facade</a>. let's use this method within a <a href="/docs/5.7/providers">service provider</a> to register a custom validation rule:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend(\'foo\', function ($attribute, $value, $parameters, $validator) {
            return $value == \'foo\';
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
	<p>The custom validator Closure receives four arguments: the name of the $attribute being validated, the $value of the attribute, an array of $parameters passed to the rule, and the Validator instance.</p>
	<p>You may also pass a class and method to the extend method instead of a Closure:</p>
	<?php echo Code::getHtmlStatic('Validator::extend(\'foo\', \'FooValidator@validate\');'); ?>
	<h4>Defining The Error Message</h4>
	<p>You will also need to define an error message for your custom rule. You can do so either using an inline custom message array or by adding an entry in the validation language file. This message should be placed in the first level of the array, not within the custom array, which is only for attribute-specific error messages:</p>
	<?php echo Code::getHtmlStatic('"foo" =&gt; "Your input was invalid!",

"accepted" =&gt; "The :attribute must be accepted.",

// The rest of the validation error messages...'); ?>
	<p>When creating a custom validation rule, you may sometimes need to define custom place-holder replacements for error messages. You may do so by creating a custom Validator as described above then making a call to the replacer method on the Validator facade. You may do this within the boot method of a <a href="/docs/5.7/providers">service provider</a>:</p>
	<?php echo Code::getHtmlStatic('/**
 * Bootstrap any application services.
 *
 * @return void
 */
public function boot()
{
    Validator::extend(...);

    Validator::replacer(\'foo\', function ($message, $attribute, $rule, $parameters) {
        return str_replace(...);
    });
}'); ?>
	<h4>Implicit Extensions</h4>
	<p>By default, when an attribute being validated is not present or contains an empty value as defined by the <a href="#rule-required">required</a> rule, normal validation rules, including custom extensions, are not run. For example, the <a href="#rule-unique">unique</a> rule will not be run against a null value:</p>
	<?php echo Code::getHtmlStatic('$rules = [\'name\' =&gt; \'unique\'];

$input = [\'name\' =&gt; null];

Validator::make($input, $rules)-&gt;passes(); // true'); ?>
	<p>For a rule to run even when an attribute is empty, the rule must imply that the attribute is required. To create such an "implicit" extension, use the Validator::extendImplicit() method:</p>
	<?php echo Code::getHtmlStatic('Validator::extendImplicit(\'foo\', function ($attribute, $value, $parameters, $validator) {
    return $value == \'foo\';
});'); ?>
	<p>An "implicit" extension only <em>implies</em> that the attribute is required. Whether it actually invalidates a missing or empty attribute is up to you.</p>
</article>