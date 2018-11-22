<?php use App\Library\Framework\Component\Code; ?>

<article>
	<h1>Helpers</h1>
	<ul>
		<li><a href="#introduction">Introduction</a></li>
		<li><a href="#available-methods">Available Methods</a></li>
	</ul>
	<p><a name="introduction"></a></p>
	<h2><a href="#introduction">Introduction</a></h2>
	<p>Space MVC includes a variety of global "helper" PHP functions. Many of these functions are used by the framework itself; however, you are free to use them in your own applications if you find them convenient.</p>
	<p><a name="available-methods"></a></p>
	<h2><a href="#available-methods">Available Methods</a></h2>
	<style>
		.collection-method-list > p {
			column-count: 3; -moz-column-count: 3; -webkit-column-count: 3;
			column-gap: 2em; -moz-column-gap: 2em; -webkit-column-gap: 2em;
		}

		.collection-method-list a {
			display: block;
		}
	</style>
	<h3>Arrays &amp; Objects</h3>
	<div class="collection-method-list">
		<p><a href="#method-array-add">array_add</a>
			<a href="#method-array-collapse">array_collapse</a>
			<a href="#method-array-divide">array_divide</a>
			<a href="#method-array-dot">array_dot</a>
			<a href="#method-array-except">array_except</a>
			<a href="#method-array-first">array_first</a>
			<a href="#method-array-flatten">array_flatten</a>
			<a href="#method-array-forget">array_forget</a>
			<a href="#method-array-get">array_get</a>
			<a href="#method-array-has">array_has</a>
			<a href="#method-array-last">array_last</a>
			<a href="#method-array-only">array_only</a>
			<a href="#method-array-pluck">array_pluck</a>
			<a href="#method-array-prepend">array_prepend</a>
			<a href="#method-array-pull">array_pull</a>
			<a href="#method-array-random">array_random</a>
			<a href="#method-array-set">array_set</a>
			<a href="#method-array-sort">array_sort</a>
			<a href="#method-array-sort-recursive">array_sort_recursive</a>
			<a href="#method-array-where">array_where</a>
			<a href="#method-array-wrap">array_wrap</a>
			<a href="#method-data-fill">data_fill</a>
			<a href="#method-data-get">data_get</a>
			<a href="#method-data-set">data_set</a>
			<a href="#method-head">head</a>
			<a href="#method-last">last</a></p>
	</div>
	<h3>Paths</h3>
	<div class="collection-method-list">
		<p><a href="#method-app-path">app_path</a>
			<a href="#method-base-path">base_path</a>
			<a href="#method-config-path">config_path</a>
			<a href="#method-database-path">database_path</a>
			<a href="#method-mix">mix</a>
			<a href="#method-public-path">public_path</a>
			<a href="#method-resource-path">resource_path</a>
			<a href="#method-storage-path">storage_path</a></p>
	</div>
	<h3>Strings</h3>
	<div class="collection-method-list">
		<p><a href="#method-__">__</a>
			<a href="#method-camel-case">camel_case</a>
			<a href="#method-class-basename">class_basename</a>
			<a href="#method-e">e</a>
			<a href="#method-ends-with">ends_with</a>
			<a href="#method-kebab-case">kebab_case</a>
			<a href="#method-preg-replace-array">preg_replace_array</a>
			<a href="#method-snake-case">snake_case</a>
			<a href="#method-starts-with">starts_with</a>
			<a href="#method-str-after">str_after</a>
			<a href="#method-str-before">str_before</a>
			<a href="#method-str-contains">str_contains</a>
			<a href="#method-str-finish">str_finish</a>
			<a href="#method-str-is">str_is</a>
			<a href="#method-str-limit">str_limit</a>
			<a href="#method-str-ordered-uuid">Str::orderedUuid</a>
			<a href="#method-str-plural">str_plural</a>
			<a href="#method-str-random">str_random</a>
			<a href="#method-str-replace-array">str_replace_array</a>
			<a href="#method-str-replace-first">str_replace_first</a>
			<a href="#method-str-replace-last">str_replace_last</a>
			<a href="#method-str-singular">str_singular</a>
			<a href="#method-str-slug">str_slug</a>
			<a href="#method-str-start">str_start</a>
			<a href="#method-studly-case">studly_case</a>
			<a href="#method-title-case">title_case</a>
			<a href="#method-trans">trans</a>
			<a href="#method-trans-choice">trans_choice</a>
			<a href="#method-str-uuid">Str::uuid</a></p>
	</div>
	<h3>URLs</h3>
	<div class="collection-method-list">
		<p><a href="#method-action">action</a>
			<a href="#method-asset">asset</a>
			<a href="#method-secure-asset">secure_asset</a>
			<a href="#method-route">route</a>
			<a href="#method-secure-url">secure_url</a>
			<a href="#method-url">url</a></p>
	</div>
	<h3>Miscellaneous</h3>
	<div class="collection-method-list">
		<p><a href="#method-abort">abort</a>
			<a href="#method-abort-if">abort_if</a>
			<a href="#method-abort-unless">abort_unless</a>
			<a href="#method-app">app</a>
			<a href="#method-auth">auth</a>
			<a href="#method-back">back</a>
			<a href="#method-bcrypt">bcrypt</a>
			<a href="#method-blank">blank</a>
			<a href="#method-broadcast">broadcast</a>
			<a href="#method-cache">cache</a>
			<a href="#method-class-uses-recursive">class_uses_recursive</a>
			<a href="#method-collect">collect</a>
			<a href="#method-config">config</a>
			<a href="#method-cookie">cookie</a>
			<a href="#method-csrf-field">csrf_field</a>
			<a href="#method-csrf-token">csrf_token</a>
			<a href="#method-dd">dd</a>
			<a href="#method-decrypt">decrypt</a>
			<a href="#method-dispatch">dispatch</a>
			<a href="#method-dispatch-now">dispatch_now</a>
			<a href="#method-dump">dump</a>
			<a href="#method-encrypt">encrypt</a>
			<a href="#method-env">env</a>
			<a href="#method-event">event</a>
			<a href="#method-factory">factory</a>
			<a href="#method-filled">filled</a>
			<a href="#method-info">info</a>
			<a href="#method-logger">logger</a>
			<a href="#method-method-field">method_field</a>
			<a href="#method-now">now</a>
			<a href="#method-old">old</a>
			<a href="#method-optional">optional</a>
			<a href="#method-policy">policy</a>
			<a href="#method-redirect">redirect</a>
			<a href="#method-report">report</a>
			<a href="#method-request">request</a>
			<a href="#method-rescue">rescue</a>
			<a href="#method-resolve">resolve</a>
			<a href="#method-response">response</a>
			<a href="#method-retry">retry</a>
			<a href="#method-session">session</a>
			<a href="#method-tap">tap</a>
			<a href="#method-today">today</a>
			<a href="#method-throw-if">throw_if</a>
			<a href="#method-throw-unless">throw_unless</a>
			<a href="#method-trait-uses-recursive">trait_uses_recursive</a>
			<a href="#method-transform">transform</a>
			<a href="#method-validator">validator</a>
			<a href="#method-value">value</a>
			<a href="#method-view">view</a>
			<a href="#method-with">with</a></p>
	</div>
	<p><a name="method-listing"></a></p>
	<h2><a href="#method-listing">Method Listing</a></h2>
	<style>
		#collection-method code {
			font-size: 14px;
		}

		#collection-method:not(.first-collection-method) {
			margin-top: 50px;
		}
	</style>
	<p><a name="arrays"></a></p>
	<h2><a href="#arrays">Arrays &amp; Objects</a></h2>
	<p><a name="method-array-add"></a></p>
	<h4 id="collection-method" class="first-collection-method">array_add()</h4>
	<p>The array_add function adds a given key / value pair to an array if the given key doesn't already exist in the array:</p>
	<?php echo Code::getHtmlStatic('$array = array_add([\'name\' =&gt; \'Desk\'], \'price\', 100);

// [\'name\' =&gt; \'Desk\', \'price\' =&gt; 100]'); ?>
	<p><a name="method-array-collapse"></a></p>
	<h4 id="collection-method">array_collapse()</h4>
	<p>The array_collapse function collapses an array of arrays into a single array:</p>
	<?php echo Code::getHtmlStatic('$array = array_collapse([[1, 2, 3], [4, 5, 6], [7, 8, 9]]);

// [1, 2, 3, 4, 5, 6, 7, 8, 9]'); ?>
	<p><a name="method-array-divide"></a></p>
	<h4 id="collection-method">array_divide()</h4>
	<p>The array_divide function returns two arrays, one containing the keys, and the other containing the values of the given array:</p>
	<?php echo Code::getHtmlStatic('[$keys, $values] = array_divide([\'name\' =&gt; \'Desk\']);

// $keys: [\'name\']

// $values: [\'Desk\']'); ?>
	<p><a name="method-array-dot"></a></p>
	<h4 id="collection-method">array_dot()</h4>
	<p>The array_dot function flattens a multi-dimensional array into a single level array that uses "dot" notation to indicate depth:</p>
	<?php echo Code::getHtmlStatic('$array = [\'products\' =&gt; [\'desk\' =&gt; [\'price\' =&gt; 100]]];

$flattened = array_dot($array);

// [\'products.desk.price\' =&gt; 100]'); ?>
	<p><a name="method-array-except"></a></p>
	<h4 id="collection-method">array_except()</h4>
	<p>The array_except function removes the given key / value pairs from an array:</p>
	<?php echo Code::getHtmlStatic('$array = [\'name\' =&gt; \'Desk\', \'price\' =&gt; 100];

$filtered = array_except($array, [\'price\']);

// [\'name\' =&gt; \'Desk\']'); ?>
	<p><a name="method-array-first"></a></p>
	<h4 id="collection-method">array_first()</h4>
	<p>The array_first function returns the first element of an array passing a given truth test:</p>
	<?php echo Code::getHtmlStatic('$array = [100, 200, 300];

$first = array_first($array, function ($value, $key) {
    return $value &gt;= 150;
});

// 200'); ?>
	<p>A default value may also be passed as the third parameter to the method. This value will be returned if no value passes the truth test:</p>
	<?php echo Code::getHtmlStatic('$first = array_first($array, $callback, $default);'); ?>
	<p><a name="method-array-flatten"></a></p>
	<h4 id="collection-method">array_flatten()</h4>
	<p>The array_flatten function flattens a multi-dimensional array into a single level array:</p>
	<?php echo Code::getHtmlStatic('$array = [\'name\' =&gt; \'Joe\', \'languages\' =&gt; [\'PHP\', \'Ruby\']];

$flattened = array_flatten($array);

// [\'Joe\', \'PHP\', \'Ruby\']'); ?>
	<p><a name="method-array-forget"></a></p>
	<h4 id="collection-method">array_forget()</h4>
	<p>The array_forget function removes a given key / value pair from a deeply nested array using "dot" notation:</p>
	<?php echo Code::getHtmlStatic('$array = [\'products\' =&gt; [\'desk\' =&gt; [\'price\' =&gt; 100]]];

array_forget($array, \'products.desk\');

// [\'products\' =&gt; []]'); ?>
	<p><a name="method-array-get"></a></p>
	<h4 id="collection-method">array_get()</h4>
	<p>The array_get function retrieves a value from a deeply nested array using "dot" notation:</p>
	<?php echo Code::getHtmlStatic('$array = [\'products\' =&gt; [\'desk\' =&gt; [\'price\' =&gt; 100]]];

$price = array_get($array, \'products.desk.price\');

// 100'); ?>
	<p>The array_get function also accepts a default value, which will be returned if the specific key is not found:</p>
	<?php echo Code::getHtmlStatic('$discount = array_get($array, \'products.desk.discount\', 0);

// 0'); ?>
	<p><a name="method-array-has"></a></p>
	<h4 id="collection-method">array_has()</h4>
	<p>The array_has function checks whether a given item or items exists in an array using "dot" notation:</p>
	<?php echo Code::getHtmlStatic('$array = [\'product\' =&gt; [\'name\' =&gt; \'Desk\', \'price\' =&gt; 100]];

$contains = array_has($array, \'product.name\');

// true

$contains = array_has($array, [\'product.price\', \'product.discount\']);

// false'); ?>
	<p><a name="method-array-last"></a></p>
	<h4 id="collection-method">array_last()</h4>
	<p>The array_last function returns the last element of an array passing a given truth test:</p>
	<?php echo Code::getHtmlStatic('$array = [100, 200, 300, 110];

$last = array_last($array, function ($value, $key) {
    return $value &gt;= 150;
});

// 300'); ?>
	<p>A default value may be passed as the third argument to the method. This value will be returned if no value passes the truth test:</p>
	<?php echo Code::getHtmlStatic('$last = array_last($array, $callback, $default);'); ?>
	<p><a name="method-array-only"></a></p>
	<h4 id="collection-method">array_only()</h4>
	<p>The array_only function returns only the specified key / value pairs from the given array:</p>
	<?php echo Code::getHtmlStatic('$array = [\'name\' =&gt; \'Desk\', \'price\' =&gt; 100, \'orders\' =&gt; 10];

$slice = array_only($array, [\'name\', \'price\']);

// [\'name\' =&gt; \'Desk\', \'price\' =&gt; 100]'); ?>
	<p><a name="method-array-pluck"></a></p>
	<h4 id="collection-method">array_pluck()</h4>
	<p>The array_pluck function retrieves all of the values for a given key from an array:</p>
	<?php echo Code::getHtmlStatic('$array = [
    [\'developer\' =&gt; [\'id\' =&gt; 1, \'name\' =&gt; \'Taylor\']],
    [\'developer\' =&gt; [\'id\' =&gt; 2, \'name\' =&gt; \'Abigail\']],
];

$names = array_pluck($array, \'developer.name\');

// [\'Taylor\', \'Abigail\']'); ?>
	<p>You may also specify how you wish the resulting list to be keyed:</p>
	<?php echo Code::getHtmlStatic('$names = array_pluck($array, \'developer.name\', \'developer.id\');

// [1 =&gt; \'Taylor\', 2 =&gt; \'Abigail\']'); ?>
	<p><a name="method-array-prepend"></a></p>
	<h4 id="collection-method">array_prepend()</h4>
	<p>The array_prepend function will push an item onto the beginning of an array:</p>
	<?php echo Code::getHtmlStatic('$array = [\'one\', \'two\', \'three\', \'four\'];

$array = array_prepend($array, \'zero\');

// [\'zero\', \'one\', \'two\', \'three\', \'four\']'); ?>
	<p>If needed, you may specify the key that should be used for the value:</p>
	<?php echo Code::getHtmlStatic('$array = [\'price\' =&gt; 100];

$array = array_prepend($array, \'Desk\', \'name\');

// [\'name\' =&gt; \'Desk\', \'price\' =&gt; 100]'); ?>
	<p><a name="method-array-pull"></a></p>
	<h4 id="collection-method">array_pull()</h4>
	<p>The array_pull function returns and removes a key / value pair from an array:</p>
	<?php echo Code::getHtmlStatic('$array = [\'name\' =&gt; \'Desk\', \'price\' =&gt; 100];

$name = array_pull($array, \'name\');

// $name: Desk

// $array: [\'price\' =&gt; 100]'); ?>
	<p>A default value may be passed as the third argument to the method. This value will be returned if the key doesn\'t exist:</p>
	<?php echo Code::getHtmlStatic('$value = array_pull($array, $key, $default);'); ?>
	<p><a name="method-array-random"></a></p>
	<h4 id="collection-method">array_random()</h4>
	<p>The array_random function returns a random value from an array:</p>
	<?php echo Code::getHtmlStatic('$array = [1, 2, 3, 4, 5];

$random = array_random($array);

// 4 - (retrieved randomly)'); ?>
	<p>You may also specify the number of items to return as an optional second argument. Note that providing this argument will return an array, even if only one item is desired:</p>
	<?php echo Code::getHtmlStatic('$items = array_random($array, 2);

// [2, 5] - (retrieved randomly)'); ?>
	<p><a name="method-array-set"></a></p>
	<h4 id="collection-method">array_set()</h4>
	<p>The array_set function sets a value within a deeply nested array using "dot" notation:</p>
	<?php echo Code::getHtmlStatic('$array = [\'products\' =&gt; [\'desk\' =&gt; [\'price\' =&gt; 100]]];

array_set($array, \'products.desk.price\', 200);

// [\'products\' =&gt; [\'desk\' =&gt; [\'price\' =&gt; 200]]]'); ?>
	<p><a name="method-array-sort"></a></p>
	<h4 id="collection-method">array_sort()</h4>
	<p>The array_sort function sorts an array by its values:</p>
	<?php echo Code::getHtmlStatic('$array = [\'Desk\', \'Table\', \'Chair\'];

$sorted = array_sort($array);

// [\'Chair\', \'Desk\', \'Table\']'); ?>
	<p>You may also sort the array by the results of the given Closure:</p>
	<?php echo Code::getHtmlStatic('$array = [
    [\'name\' =&gt; \'Desk\'],
    [\'name\' =&gt; \'Table\'],
    [\'name\' =&gt; \'Chair\'],
];

$sorted = array_values(array_sort($array, function ($value) {
    return $value[\'name\'];
}));

/*
    [
        [\'name\' =&gt; \'Chair\'],
        [\'name\' =&gt; \'Desk\'],
        [\'name\' =&gt; \'Table\'],
    ]
*/'); ?>
	<p><a name="method-array-sort-recursive"></a></p>
	<h4 id="collection-method">array_sort_recursive()</h4>
	<p>The array_sort_recursive function recursively sorts an array using the sort function for numeric sub=arrays and ksort for associative sub-arrays:</p>
	<?php echo Code::getHtmlStatic('$array = [
    [\'Roman\', \'Taylor\', \'Li\'],
    [\'PHP\', \'Ruby\', \'JavaScript\'],
    [\'one\' =&gt; 1, \'two\' =&gt; 2, \'three\' =&gt; 3],
];

$sorted = array_sort_recursive($array);

/*
    [
        [\'JavaScript\', \'PHP\', \'Ruby\'],
        [\'one\' =&gt; 1, \'three\' =&gt; 3, \'two\' =&gt; 2],
        [\'Li\', \'Roman\', \'Taylor\'],
    ]
*/'); ?>
	<p><a name="method-array-where"></a></p>
	<h4 id="collection-method">array_where()</h4>
	<p>The array_where function filters an array using the given Closure:</p>
	<?php echo Code::getHtmlStatic('$array = [100, \'200\', 300, \'400\', 500];

$filtered = array_where($array, function ($value, $key) {
    return is_string($value);
});

// [1 =&gt; \'200\', 3 =&gt; \'400\']'); ?>
	<p><a name="method-array-wrap"></a></p>
	<h4 id="collection-method">array_wrap()</h4>
	<p>The array_wrap function wraps the given value in an array. If the given value is already an array it will not be changed:</p>
	<?php echo Code::getHtmlStatic('$string = \'Space MVC\';

$array = array_wrap($string);

// [\'Space MVC\']'); ?>
	<p>If the given value is null, an empty array will be returned:</p>
	<?php echo Code::getHtmlStatic('$nothing = null;

$array = array_wrap($nothing);

// []'); ?>
	<p><a name="method-data-fill"></a></p>
	<h4 id="collection-method">data_fill()</h4>
	<p>The data_fill function sets a missing value within a nested array or object using "dot" notation:</p>
	<?php echo Code::getHtmlStatic('$data = [\'products\' =&gt; [\'desk\' =&gt; [\'price\' =&gt; 100]]];

data_fill($data, \'products.desk.price\', 200);

// [\'products\' =&gt; [\'desk\' =&gt; [\'price\' =&gt; 100]]]

data_fill($data, \'products.desk.discount\', 10);

// [\'products\' =&gt; [\'desk\' =&gt; [\'price\' =&gt; 100, \'discount\' =&gt; 10]]]'); ?>
	<p>This function also accepts asterisks as wildcards and will fill the target accordingly:</p>
	<?php echo Code::getHtmlStatic('$data = [
    \'products\' =&gt; [
        [\'name\' =&gt; \'Desk 1\', \'price\' =&gt; 100],
        [\'name\' =&gt; \'Desk 2\'],
    ],
];

data_fill($data, \'products.*.price\', 200);

/*
    [
        \'products\' =&gt; [
            [\'name\' =&gt; \'Desk 1\', \'price\' =&gt; 100],
            [\'name\' =&gt; \'Desk 2\', \'price\' =&gt; 200],
        ],
    ]
*/'); ?>
	<p><a name="method-data-get"></a></p>
	<h4 id="collection-method">data_get()</h4>
	<p>The data_get function retrieves a value from a nested array or object using "dot" notation:</p>
	<?php echo Code::getHtmlStatic('$data = [\'products\' =&gt; [\'desk\' =&gt; [\'price\' =&gt; 100]]];

$price = data_get($data, \'products.desk.price\');

// 100'); ?>
	<p>The data_get function also accepts a default value, which will be returned if the specified key is not found:</p>
	<?php echo Code::getHtmlStatic('$discount = data_get($data, \'products.desk.discount\', 0);

// 0'); ?>
	<p>The function also accepts wildcards using asterisks, which may target any key of the array or object:</p>
	<?php echo Code::getHtmlStatic('$data = [
    \'product-one\' =&gt; [\'name\' =&gt; \'Desk 1\', \'price\' =&gt; 100],
    \'product-two\' =&gt; [\'name\' =&gt; \'Desk 2\', \'price\' =&gt; 150],
];

data_get($data, \'*.name\');

// [\'Desk 1\', \'Desk 2\'];'); ?>
	<p><a name="method-data-set"></a></p>
	<h4 id="collection-method">data_set()</h4>
	<p>The data_set function sets a value within a nested array or object using "dot" notation:</p>
	<?php echo Code::getHtmlStatic('$data = [\'products\' =&gt; [\'desk\' =&gt; [\'price\' =&gt; 100]]];

data_set($data, \'products.desk.price\', 200);

// [\'products\' =&gt; [\'desk\' =&gt; [\'price\' =&gt; 200]]]'); ?>
	<p>This function also accepts wildcards and will set values on the target accordingly:</p>
	<?php echo Code::getHtmlStatic('$data = [
    \'products\' =&gt; [
        [\'name\' =&gt; \'Desk 1\', \'price\' =&gt; 100],
        [\'name\' =&gt; \'Desk 2\', \'price\' =&gt; 150],
    ],
];

data_set($data, \'products.*.price\', 200);

/*
    [
        \'products\' =&gt; [
            [\'name\' =&gt; \'Desk 1\', \'price\' =&gt; 200],
            [\'name\' =&gt; \'Desk 2\', \'price\' =&gt; 200],
        ],
    ]
*/'); ?>
	<p>By default, any existing values are overwritten. If you wish to only set a value if it doesn\'t exist, you may pass false as the third argument:</p>
	<?php echo Code::getHtmlStatic('$data = [\'products\' =&gt; [\'desk\' =&gt; [\'price\' =&gt; 100]]];

data_set($data, \'products.desk.price\', 200, false);

// [\'products\' =&gt; [\'desk\' =&gt; [\'price\' =&gt; 100]]]'); ?>
	<p><a name="method-head"></a></p>
	<h4 id="collection-method">head()</h4>
	<p>The head function returns the first element in the given array:</p>
	<?php echo Code::getHtmlStatic('$array = [100, 200, 300];

$first = head($array);

// 100'); ?>
	<p><a name="method-last"></a></p>
	<h4 id="collection-method">last()</h4>
	<p>The last function returns the last element in the given array:</p>
	<?php echo Code::getHtmlStatic('$array = [100, 200, 300];

$last = last($array);

// 300'); ?>
	<p><a name="paths"></a></p>
	<h2><a href="#paths">Paths</a></h2>
	<p><a name="method-app-path"></a></p>
	<h4 id="collection-method">app_path()</h4>
	<p>The app_path function returns the fully qualified path to the app directory. You may also use the app_path function to generate a fully qualified path to a file relative to the application directory:</p>
	<?php echo Code::getHtmlStatic('$path = app_path();

$path = app_path(\'Http/Controllers/Controller.php\');'); ?>
	<p><a name="method-base-path"></a></p>
	<h4 id="collection-method">base_path()</h4>
	<p>The base_path function returns the fully qualified path to the project root. You may also use the base_path function to generate a fully qualified path to a given file relative to the project root directory:</p>
	<?php echo Code::getHtmlStatic('$path = base_path();

$path = base_path(\'vendor/bin\');'); ?>
	<p><a name="method-config-path"></a></p>
	<h4 id="collection-method">config_path()</h4>
	<p>The config_path function returns the fully qualified path to the config directory. You may also use the config_path function to generate a fully qualified path to a given file within the application's configuration directory:</p>
	<?php echo Code::getHtmlStatic('$path = config_path();

$path = config_path(\'app.php\');'); ?>
	<p><a name="method-database-path"></a></p>
	<h4 id="collection-method">database_path()</h4>
	<p>The database_path function returns the fully qualified path to the database directory. You may also use the database_path function to generate a fully qualified path to a given file within the database directory:</p>
	<?php echo Code::getHtmlStatic('$path = database_path();

$path = database_path(\'factories/UserFactory.php\');'); ?>
	<p><a name="method-mix"></a></p>
	<h4 id="collection-method">mix()</h4>
	<p>The mix function returns the path to a <a href="/docs/5.7/mix">versioned Mix file</a>:</p>
	<?php echo Code::getHtmlStatic('$path = mix(\'css/app.css\');'); ?>
	<p><a name="method-public-path"></a></p>
	<h4 id="collection-method">public_path()</h4>
	<p>The public_path function returns the fully qualified path to the public directory. You may also use the public_path function to generate a fully qualified path to a given file within the public directory:</p>
	<?php echo Code::getHtmlStatic('$path = public_path();

$path = public_path(\'css/app.css\');'); ?>
	<p><a name="method-resource-path"></a></p>
	<h4 id="collection-method">resource_path()</h4>
	<p>The resource_path function returns the fully qualified path to the resources directory. You may also use the resource_path function to generate a fully qualified path to a given file within the resources directory:</p>
	<?php echo Code::getHtmlStatic('$path = resource_path();

$path = resource_path(\'sass/app.scss\');'); ?>
	<p><a name="method-storage-path"></a></p>
	<h4 id="collection-method">storage_path()</h4>
	<p>The storage_path function returns the fully qualified path to the storage directory. You may also use the storage_path function to generate a fully qualified path to a given file within the storage directory:</p>
	<?php echo Code::getHtmlStatic('$path = storage_path();

$path = storage_path(\'app/file.txt\');'); ?>
	<p><a name="strings"></a></p>
	<h2><a href="#strings">Strings</a></h2>
	<p><a name="method-__"></a></p>
	<h4 id="collection-method">__()</h4>
	<p>The __ function translates the given translation string or translation key using your <a href="/docs/5.7/localization">localization files</a>:</p>
	<?php echo Code::getHtmlStatic('echo __(\'Welcome to our application\');

echo __(\'messages.welcome\');'); ?>
	<p>If the specified translation string or key does not exist, the __ function will return the given value. So, using the example above, the __ function would return messages.welcome if that translation key does not exist.</p>
	<p><a name="method-camel-case"></a></p>
	<h4 id="collection-method">camel_case()</h4>
	<p>The camel_case function converts the given string to camelCase:</p>
	<?php echo Code::getHtmlStatic('$converted = camel_case(\'foo_bar\');

// fooBar'); ?>
	<p><a name="method-class-basename"></a></p>
	<h4 id="collection-method">class_basename()</h4>
	<p>The class_basename returns the class name of the given class with the class\' namespace removed:</p>
	<?php echo Code::getHtmlStatic('$class = class_basename(\'Foo\Bar\Baz\');

// Baz'); ?>
	<p><a name="method-e"></a></p>
	<h4 id="collection-method">e()</h4>
	<p>The e function runs PHP's htmlspecialchars function with the double_encode option set to true by default:</p>
	<?php echo Code::getHtmlStatic('echo e(\'&lt;html&gt;foo&lt;/html&gt;\');

// &amp;lt;html&amp;gt;foo&amp;lt;/html&amp;gt;'); ?>
	<p><a name="method-ends-with"></a></p>
	<h4 id="collection-method">ends_with()</h4>
	<p>The ends_with function determines if the given string ends with the given value:</p>
	<?php echo Code::getHtmlStatic('$result = ends_with(\'This is my name\', \'name\');

// true'); ?>
	<p><a name="method-kebab-case"></a></p>
	<h4 id="collection-method">kebab_case()</h4>
	<p>The kebab_case function converts the given string to kebab-case:</p>
	<?php echo Code::getHtmlStatic('$converted = kebab_case(\'fooBar\');

// foo-bar'); ?>
	<p><a name="method-preg-replace-array"></a></p>
	<h4 id="collection-method">preg_replace_array()</h4>
	<p>The preg_replace_array function replaces a given pattern in the string sequentially using an array:</p>
	<?php echo Code::getHtmlStatic('$string = \'The event will take place between :start and :end\';

$replaced = preg_replace_array(\'/:[a-z_]+/\', [\'8:30\', \'9:00\'], $string);

// The event will take place between 8:30 and 9:00'); ?>
	<p><a name="method-snake-case"></a></p>
	<h4 id="collection-method">snake_case()</h4>
	<p>The snake_case function converts the given string to snake_case:</p>
	<?php echo Code::getHtmlStatic('$converted = snake_case(\'fooBar\');

// foo_bar'); ?>
	<p><a name="method-starts-with"></a></p>
	<h4 id="collection-method">starts_with()</h4>
	<p>The starts_with function determines if the given string begins with the given value:</p>
	<?php echo Code::getHtmlStatic('$result = starts_with(\'This is my name\', \'This\');

// true'); ?>
	<p><a name="method-str-after"></a></p>
	<h4 id="collection-method">str_after()</h4>
	<p>The str_after function returns everything after the given value in a string:</p>
	<?php echo Code::getHtmlStatic('$slice = str_after(\'This is my name\', \'This is\');

// \' my name\''); ?>
	<p><a name="method-str-before"></a></p>
	<h4 id="collection-method">str_before()</h4>
	<p>The str_before function returns everything before the given value in a string:</p>
	<?php echo Code::getHtmlStatic('$slice = str_before(\'This is my name\', \'my name\');

// \'This is \''); ?>
	<p><a name="method-str-contains"></a></p>
	<h4 id="collection-method">str_contains()</h4>
	<p>The str_contains function determines if the given string contains the given value (case sensitive):</p>
	<?php echo Code::getHtmlStatic('$contains = str_contains(\'This is my name\', \'my\');

// true'); ?>
	<p>You may also pass an array of values to determine if the given string contains any of the values:</p>
	<?php echo Code::getHtmlStatic('$contains = str_contains(\'This is my name\', [\'my\', \'foo\']);

// true'); ?>
	<p><a name="method-str-finish"></a></p>
	<h4 id="collection-method">str_finish()</h4>
	<p>The str_finish function adds a single instance of the given value to a string if it does not already end with the value:</p>
	<?php echo Code::getHtmlStatic('$adjusted = str_finish(\'this/string\', \'/\');

// this/string/

$adjusted = str_finish(\'this/string/\', \'/\');

// this/string/'); ?>
	<p><a name="method-str-is"></a></p>
	<h4 id="collection-method">str_is()</h4>
	<p>The str_is function determines if a given string matches a given pattern. Asterisks may be used to indicate wildcards:</p>
	<?php echo Code::getHtmlStatic('$matches = str_is(\'foo*\', \'foobar\');

// true

$matches = str_is(\'baz*\', \'foobar\');

// false'); ?>
	<p><a name="method-str-limit"></a></p>
	<h4 id="collection-method">str_limit()</h4>
	<p>The str_limit function truncates the given string at the specified length:</p>
	<?php echo Code::getHtmlStatic('$truncated = str_limit(\'The quick brown fox jumps over the lazy dog\', 20);

// The quick brown fox...'); ?>
	<p>You may also pass a third argument to change the string that will be appended to the end:</p>
	<?php echo Code::getHtmlStatic('$truncated = str_limit(\'The quick brown fox jumps over the lazy dog\', 20, \' (...)\');

// The quick brown fox (...)'); ?>
	<p><a name="method-str-ordered-uuid"></a></p>
	<h4 id="collection-method">Str::orderedUuid()</h4>
	<p>The Str::orderedUuid method generates a "timestamp first" UUID that may be efficiently stored in an indexed database column:</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Support\Str;

return (string) Str::orderedUuid();'); ?>
	<p><a name="method-str-plural"></a></p>
	<h4 id="collection-method">str_plural()</h4>
	<p>The str_plural function converts a string to its plural form. This function currently only supports the English language:</p>
	<?php echo Code::getHtmlStatic('$plural = str_plural(\'car\');

// cars

$plural = str_plural(\'child\');

// children'); ?>
	<p>You may provide an integer as a second argument to the function to retrieve the singular or plural form of the string:</p>
	<?php echo Code::getHtmlStatic('$plural = str_plural(\'child\', 2);

// children

$plural = str_plural(\'child\', 1);

// child'); ?>
	<p><a name="method-str-random"></a></p>
	<h4 id="collection-method">str_random()</h4>
	<p>The str_random function generates a random string of the specified length. This function uses PHP's random_bytes function:</p>
	<?php echo Code::getHtmlStatic('$random = str_random(40);'); ?>
	<p><a name="method-str-replace-array"></a></p>
	<h4 id="collection-method">str_replace_array()</h4>
	<p>The str_replace_array function replaces a given value in the string sequentially using an array:</p>
	<?php echo Code::getHtmlStatic('$string = \'The event will take place between ? and ?\';

$replaced = str_replace_array(\'?\', [\'8:30\', \'9:00\'], $string);

// The event will take place between 8:30 and 9:00'); ?>
	<p><a name="method-str-replace-first"></a></p>
	<h4 id="collection-method">str_replace_first()</h4>
	<p>The str_replace_first function replaces the first occurrence of a given value in a string:</p>
	<?php echo Code::getHtmlStatic('$replaced = str_replace_first(\'the\', \'a\', \'the quick brown fox jumps over the lazy dog\');

// a quick brown fox jumps over the lazy dog'); ?>
	<p><a name="method-str-replace-last"></a></p>
	<h4 id="collection-method">str_replace_last()</h4>
	<p>The str_replace_last function replaces the last occurrence of a given value in a string:</p>
	<?php echo Code::getHtmlStatic('$replaced = str_replace_last(\'the\', \'a\', \'the quick brown fox jumps over the lazy dog\');

// the quick brown fox jumps over a lazy dog'); ?>
	<p><a name="method-str-singular"></a></p>
	<h4 id="collection-method">str_singular()</h4>
	<p>The str_singular function converts a string to its singular form. This function currently only supports the English language:</p>
	<?php echo Code::getHtmlStatic('$singular = str_singular(\'cars\');

// car

$singular = str_singular(\'children\');

// child'); ?>
	<p><a name="method-str-slug"></a></p>
	<h4 id="collection-method">str_slug()</h4>
	<p>The str_slug function generates a URL friendly "slug" from the given string:</p>
	<?php echo Code::getHtmlStatic('$slug = str_slug(\'Space MVC 5 Framework\', \'-\');

// Space MVC'); ?>
	<p><a name="method-str-start"></a></p>
	<h4 id="collection-method">str_start()</h4>
	<p>The str_start function adds a single instance of the given value to a string if it does not already start with the value:</p>
	<?php echo Code::getHtmlStatic('$adjusted = str_start(\'this/string\', \'/\');

// /this/string

$adjusted = str_start(\'/this/string\', \'/\');

// /this/string'); ?>
	<p><a name="method-studly-case"></a></p>
	<h4 id="collection-method">studly_case()</h4>
	<p>The studly_case function converts the given string to StudlyCase:</p>
	<?php echo Code::getHtmlStatic('$converted = studly_case(\'foo_bar\');

// FooBar'); ?>
	<p><a name="method-title-case"></a></p>
	<h4 id="collection-method">title_case()</h4>
	<p>The title_case function converts the given string to Title Case:</p>
	<?php echo Code::getHtmlStatic('$converted = title_case(\'a nice title uses the correct case\');

// A Nice Title Uses The Correct Case'); ?>
	<p><a name="method-trans"></a></p>
	<h4 id="collection-method">trans()</h4>
	<p>The trans function translates the given translation key using your <a href="/docs/5.7/localization">localization files</a>:</p>
	<?php echo Code::getHtmlStatic('echo trans(\'messages.welcome\');'); ?>
	<p>If the specified translation key does not exist, the trans function will return the given key. So, using the example above, the trans function would return messages.welcome if the translation key does not exist.</p>
	<p><a name="method-trans-choice"></a></p>
	<h4 id="collection-method">trans_choice()</h4>
	<p>The trans_choice function translates the given translation key with inflection:</p>
	<?php echo Code::getHtmlStatic('echo trans_choice(\'messages.notifications\', $unreadCount);'); ?>
	<p>If the specified translation key does not exist, the trans_choice function will return the given key. So, using the example above, the trans_choice function would return messages.notifications if the translation key does not exist.</p>
	<p><a name="method-str-uuid"></a></p>
	<h4 id="collection-method">Str::uuid()</h4>
	<p>The Str::uuid method generates a UUID (version 4):</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Support\Str;

return (string) Str::uuid();'); ?>
	<p><a name="urls"></a></p>
	<h2><a href="#urls">URLs</a></h2>
	<p><a name="method-action"></a></p>
	<h4 id="collection-method">action()</h4>
	<p>The action function generates a URL for the given controller action. You do not need to pass the full namespace of the controller. Instead, pass the controller class name relative to the App\Http\Controllers namespace:</p>
	<?php echo Code::getHtmlStatic('$url = action(\'HomeController@index\');

$url = action([HomeController::class, \'index\']);'); ?>
	<p>If the method accepts route parameters, you may pass them as the second argument to the method:</p>
	<?php echo Code::getHtmlStatic('$url = action(\'UserController@profile\', [\'id\' =&gt; 1]);'); ?>
	<p><a name="method-asset"></a></p>
	<h4 id="collection-method">asset()</h4>
	<p>The asset function generates a URL for an asset using the current scheme of the request (HTTP or HTTPS):</p>
	<?php echo Code::getHtmlStatic('$url = asset(\'img/photo.jpg\');'); ?>
	<p><a name="method-secure-asset"></a></p>
	<h4 id="collection-method">secure_asset()</h4>
	<p>The secure_asset function generates a URL for an asset using HTTPS:</p>
	<?php echo Code::getHtmlStatic('$url = secure_asset(\'img/photo.jpg\');'); ?>
	<p><a name="method-route"></a></p>
	<h4 id="collection-method">route()</h4>
	<p>The route function generates a URL for the given named route:</p>
	<?php echo Code::getHtmlStatic('$url = route(\'routeName\');'); ?>
	<p>If the route accepts parameters, you may pass them as the second argument to the method:</p>
	<?php echo Code::getHtmlStatic('$url = route(\'routeName\', [\'id\' =&gt; 1]);'); ?>
	<p>By default, the route function generates an absolute URL. If you wish to generate a relative URL, you may pass false as the third argument:</p>
	<?php echo Code::getHtmlStatic('$url = route(\'routeName\', [\'id\' =&gt; 1], false);'); ?>
	<p><a name="method-secure-url"></a></p>
	<h4 id="collection-method">secure_url()</h4>
	<p>The secure_url function generates a fully qualified HTTPS URL to the given path:</p>
	<?php echo Code::getHtmlStatic('$url = secure_url(\'user/profile\');

$url = secure_url(\'user/profile\', [1]);'); ?>
	<p><a name="method-url"></a></p>
	<h4 id="collection-method">url()</h4>
	<p>The url function generates a fully qualified URL to the given path:</p>
	<?php echo Code::getHtmlStatic('$url = url(\'user/profile\');

$url = url(\'user/profile\', [1]);'); ?>
	<p>If no path is provided, a Illuminate\Routing\UrlGenerator instance is returned:</p>
	<?php echo Code::getHtmlStatic('$current = url()-&gt;current();

$full = url()-&gt;full();

$previous = url()-&gt;previous();'); ?>
	<p><a name="miscellaneous"></a></p>
	<h2><a href="#miscellaneous">Miscellaneous</a></h2>
	<p><a name="method-abort"></a></p>
	<h4 id="collection-method">abort()</h4>
	<p>The abort function throws <a href="/docs/5.7/errors#http-exceptions">an HTTP exception</a> which will be rendered by the <a href="/docs/5.7/errors#the-exception-handler">exception handler</a>:</p>
	<?php echo Code::getHtmlStatic('abort(403);'); ?>
	<p>You may also provide the exception's response text and custom response headers:</p>
	<?php echo Code::getHtmlStatic('abort(403, \'Unauthorized.\', $headers);'); ?>
	<p><a name="method-abort-if"></a></p>
	<h4 id="collection-method">abort_if()</h4>
	<p>The abort_if function throws an HTTP exception if a given boolean expression evaluates to true:</p>
	<?php echo Code::getHtmlStatic('abort_if(! Auth::user()-&gt;isAdmin(), 403);'); ?>
	<p>Like the abort method, you may also provide the exception's response text as the third argument and an array of custom response headers as the fourth argument.</p>
	<p><a name="method-abort-unless"></a></p>
	<h4 id="collection-method">abort_unless()</h4>
	<p>The abort_unless function throws an HTTP exception if a given boolean expression evaluates to false:</p>
	<?php echo Code::getHtmlStatic('abort_unless(Auth::user()-&gt;isAdmin(), 403);'); ?>
	<p>Like the abort method, you may also provide the exception's response text as the third argument and an array of custom response headers as the fourth argument.</p>
	<p><a name="method-app"></a></p>
	<h4 id="collection-method">app()</h4>
	<p>The app function returns the <a href="/docs/5.7/container">service container</a> instance:</p>
	<?php echo Code::getHtmlStatic('$container = app();'); ?>
	<p>You may pass a class or interface name to resolve it from the container:</p>
	<?php echo Code::getHtmlStatic('$api = app(\'HelpSpot\API\');'); ?>
	<p><a name="method-auth"></a></p>
	<h4 id="collection-method">auth()</h4>
	<p>The auth function returns an <a href="/docs/5.7/authentication">authenticator</a> instance. You may use it instead of the Auth facade for convenience:</p>
	<?php echo Code::getHtmlStatic('$user = auth()-&gt;user();'); ?>
	<p>If needed, you may specify which guard instance you would like to access:</p>
	<?php echo Code::getHtmlStatic('$user = auth(\'admin\')-&gt;user();'); ?>
	<p><a name="method-back"></a></p>
	<h4 id="collection-method">back()</h4>
	<p>The back function generates a <a href="/docs/5.7/responses#redirects">redirect HTTP response</a> to the user's previous location:</p>
	<?php echo Code::getHtmlStatic('return back($status = 302, $headers = [], $fallback = false);

return back();'); ?>
	<p><a name="method-bcrypt"></a></p>
	<h4 id="collection-method">bcrypt()</h4>
	<p>The bcrypt function <a href="/docs/5.7/hashing">hashes</a> the given value using Bcrypt. You may use it as an alternative to the Hash facade:</p>
	<?php echo Code::getHtmlStatic('$password = bcrypt(\'my-secret-password\');'); ?>
	<p><a name="method-broadcast"></a></p>
	<h4 id="collection-method">broadcast()</h4>
	<p>The broadcast function <a href="/docs/5.7/broadcasting">broadcasts</a> the given <a href="/docs/5.7/events">event</a> to its listeners:</p>
	<?php echo Code::getHtmlStatic('broadcast(new UserRegistered($user));'); ?>
	<p><a name="method-blank"></a></p>
	<h4 id="collection-method">blank()</h4>
	<p>The blank function returns whether the given value is "blank":</p>
	<?php echo Code::getHtmlStatic('blank(\'\');
blank(\'   \');
blank(null);
blank(collect());

// true

blank(0);
blank(true);
blank(false);

// false'); ?>
	<p>For the inverse of blank, see the <a href="#method-filled">filled</a> method.</p>
	<p><a name="method-cache"></a></p>
	<h4 id="collection-method">cache()</h4>
	<p>The cache function may be used to get values from the <a href="/docs/5.7/cache">cache</a>. If the given key does not exist in the cache, an optional default value will be returned:</p>
	<?php echo Code::getHtmlStatic('$value = cache(\'key\');

$value = cache(\'key\', \'default\');'); ?>
	<p>You may add items to the cache by passing an array of key / value pairs to the function. You should also pass the number of minutes or duration the cached value should be considered valid:</p>
	<?php echo Code::getHtmlStatic('cache([\'key\' =&gt; \'value\'], 5);

cache([\'key\' =&gt; \'value\'], now()-&gt;addSeconds(10));'); ?>
	<p><a name="method-class-uses-recursive"></a></p>
	<h4 id="collection-method">class_uses_recursive()</h4>
	<p>The class_uses_recursive function returns all traits used by a class, including traits used by all of its parent classes:</p>
	<?php echo Code::getHtmlStatic('$traits = class_uses_recursive(App\User::class);'); ?>
	<p><a name="method-collect"></a></p>
	<h4 id="collection-method">collect()</h4>
	<p>The collect function creates a <a href="/docs/5.7/collections">collection</a> instance from the given value:</p>
	<?php echo Code::getHtmlStatic('$collection = collect([\'taylor\', \'abigail\']);'); ?>
	<p><a name="method-config"></a></p>
	<h4 id="collection-method">config()</h4>
	<p>The config function gets the value of a <a href="/docs/5.7/configuration">configuration</a> variable. The configuration values may be accessed using "dot" syntax, which includes the name of the file and the option you wish to access. A default value may be specified and is returned if the configuration option does not exist:</p>
	<?php echo Code::getHtmlStatic('$value = config(\'app.timezone\');

$value = config(\'app.timezone\', $default);'); ?>
	<p>You may set configuration variables at runtime by passing an array of key / value pairs:</p>
	<?php echo Code::getHtmlStatic('config([\'app.debug\' =&gt; true]);'); ?>
	<p><a name="method-cookie"></a></p>
	<h4 id="collection-method">cookie()</h4>
	<p>The cookie function creates a new <a href="/docs/5.7/requests#cookies">cookie</a> instance:</p>
	<?php echo Code::getHtmlStatic('$cookie = cookie(\'name\', \'value\', $minutes);'); ?>
	<p><a name="method-csrf-field"></a></p>
	<h4 id="collection-method">csrf_field()</h4>
	<p>The csrf_field function generates an HTML hidden input field containing the value of the CSRF token. For example, using <a href="/docs/5.7/blade">Blade syntax</a>:</p>
	<?php echo Code::getHtmlStatic('{{ csrf_field() }}'); ?>
	<p><a name="method-csrf-token"></a></p>
	<h4 id="collection-method">csrf_token()</h4>
	<p>The csrf_token function retrieves the value of the current CSRF token:</p>
	<?php echo Code::getHtmlStatic('$token = csrf_token();'); ?>
	<p><a name="method-dd"></a></p>
	<h4 id="collection-method">dd()</h4>
	<p>The dd function dumps the given variables and ends execution of the script:</p>
	<?php echo Code::getHtmlStatic('dd($value);

dd($value1, $value2, $value3, ...);'); ?>
	<p>If you do not want to halt the execution of your script, use the <a href="#method-dump">dump</a> function instead.</p>
	<p><a name="method-decrypt"></a></p>
	<h4 id="collection-method">decrypt()</h4>
	<p>The decrypt function decrypts the given value using Space MVC's <a href="/docs/5.7/encryption">encrypter</a>:</p>
	<?php echo Code::getHtmlStatic('$decrypted = decrypt($encrypted_value);'); ?>
	<p><a name="method-dispatch"></a></p>
	<h4 id="collection-method">dispatch()</h4>
	<p>The dispatch function pushes the given <a href="/docs/5.7/queues#creating-jobs">job</a> onto the Space MVC <a href="/docs/5.7/queues">job queue</a>:</p>
	<?php echo Code::getHtmlStatic('dispatch(new App\Jobs\SendEmails);'); ?>
	<p><a name="method-dispatch-now"></a></p>
	<h4 id="collection-method">dispatch_now()</h4>
	<p>The dispatch_now function runs the given <a href="/docs/5.7/queues#creating-jobs">job</a> immediately and returns the value from its handle method:</p>
	<?php echo Code::getHtmlStatic('$result = dispatch_now(new App\Jobs\SendEmails);'); ?>
	<p><a name="method-dump"></a></p>
	<h4 id="collection-method">dump()</h4>
	<p>The dump function dumps the given variables:</p>
	<?php echo Code::getHtmlStatic('dump($value);

dump($value1, $value2, $value3, ...);'); ?>
	<p>If you want to stop executing the script after dumping the variables, use the <a href="#method-dd">dd</a> function instead.</p>
	<p>You may use Artisan's dump-server command to intercept all dump calls and display them in your console window instead of your browser.</p>
	<p><a name="method-encrypt"></a></p>
	<h4 id="collection-method">encrypt()</h4>
	<p>The encrypt function encrypts the given value using Space MVC's <a href="/docs/5.7/encryption">encrypter</a>:</p>
	<?php echo Code::getHtmlStatic('$encrypted = encrypt($unencrypted_value);'); ?>
	<p><a name="method-env"></a></p>
	<h4 id="collection-method">env()</h4>
	<p>The env function retrieves the value of an <a href="/docs/5.7/configuration#environment-configuration">environment variable</a> or returns a default value:</p>
	<?php echo Code::getHtmlStatic('$env = env(\'APP_ENV\');

// Returns \'production\' if APP_ENV is not set...
$env = env(\'APP_ENV\', \'production\');'); ?>
	<p>If you execute the config:cache command during your deployment process, you should be sure that you are only calling the env function from within your configuration files. Once the configuration has been cached, the .env file will not be loaded and all calls to the env function will return null.</p>
	<p><a name="method-event"></a></p>
	<h4 id="collection-method">event()</h4>
	<p>The event function dispatches the given <a href="/docs/5.7/events">event</a> to its listeners:</p>
	<?php echo Code::getHtmlStatic('event(new UserRegistered($user));'); ?>
	<p><a name="method-factory"></a></p>
	<h4 id="collection-method">factory()</h4>
	<p>The factory function creates a model factory builder for a given class, name, and amount. It can be used while <a href="/docs/5.7/database-testing#writing-factories">testing</a> or <a href="/docs/5.7/seeding#using-model-factories">seeding</a>:</p>
	<?php echo Code::getHtmlStatic('$user = factory(App\User::class)-&gt;make();'); ?>
	<p><a name="method-filled"></a></p>
	<h4 id="collection-method">filled()</h4>
	<p>The filled function returns whether the given value is not "blank":</p>
	<?php echo Code::getHtmlStatic('filled(0);
filled(true);
filled(false);

// true

filled(\'\');
filled(\'   \');
filled(null);
filled(collect());

// false'); ?>
	<p>For the inverse of filled, see the <a href="#method-blank">blank</a> method.</p>
	<p><a name="method-info"></a></p>
	<h4 id="collection-method">info()</h4>
	<p>The info function will write information to the <a href="/docs/5.7/errors#logging">log</a>:</p>
	<?php echo Code::getHtmlStatic('info(\'Some helpful information!\');'); ?>
	<p>An array of contextual data may also be passed to the function:</p>
	<?php echo Code::getHtmlStatic('info(\'User login attempt failed.\', [\'id\' =&gt; $user-&gt;id]);'); ?>
	<p><a name="method-logger"></a></p>
	<h4 id="collection-method">logger()</h4>
	<p>The logger function can be used to write a debug level message to the <a href="/docs/5.7/errors#logging">log</a>:</p>
	<?php echo Code::getHtmlStatic('logger(\'Debug message\');'); ?>
	<p>An array of contextual data may also be passed to the function:</p>
	<?php echo Code::getHtmlStatic('logger(\'User has logged in.\', [\'id\' =&gt; $user-&gt;id]);'); ?>
	<p>A <a href="/docs/5.7/errors#logging">logger</a> instance will be returned if no value is passed to the function:</p>
	<?php echo Code::getHtmlStatic('logger()-&gt;error(\'You are not allowed here.\');'); ?>
	<p><a name="method-method-field"></a></p>
	<h4 id="collection-method">method_field()</h4>
	<p>The method_field function generates an HTML hidden input field containing the spoofed value of the form's HTTP verb. For example, using <a href="/docs/5.7/blade">Blade syntax</a>:</p>
	<?php echo Code::getHtmlStatic('&lt;form method="POST"&gt;
    {{ method_field(\'DELETE\') }}
&lt;/form&gt;'); ?>
	<p><a name="method-now"></a></p>
	<h4 id="collection-method">now()</h4>
	<p>The now function creates a new Illuminate\Support\Carbon instance for the current time:</p>
	<?php echo Code::getHtmlStatic('$now = now();'); ?>
	<p><a name="method-old"></a></p>
	<h4 id="collection-method">old()</h4>
	<p>The old function <a href="/docs/5.7/requests#retrieving-input">retrieves</a> an <a href="/docs/5.7/requests#old-input">old input</a> value flashed into the session:</p>
	<?php echo Code::getHtmlStatic('$value = old(\'value\');

$value = old(\'value\', \'default\');'); ?>
	<p><a name="method-optional"></a></p>
	<h4 id="collection-method">optional()</h4>
	<p>The optional function accepts any argument and allows you to access properties or call methods on that object. If the given object is null, properties and methods will return null instead of causing an error:</p>
	<?php echo Code::getHtmlStatic('return optional($user-&gt;address)-&gt;street;

{!! old(\'name\', optional($user)-&gt;name) !!}'); ?>
	<p>The optional function also accepts a Closure as its second argument. The Closure will be invoked if the value provided as the first argument is not null:</p>
	<?php echo Code::getHtmlStatic('return optional(User::find($id), function ($user) {
    return new DummyUser;
});'); ?>
	<p><a name="method-policy"></a></p>
	<h4 id="collection-method">policy()</h4>
	<p>The policy method retrieves a <a href="/docs/5.7/authorization#creating-policies">policy</a> instance for a given class:</p>
	<?php echo Code::getHtmlStatic('$policy = policy(App\User::class);'); ?>
	<p><a name="method-redirect"></a></p>
	<h4 id="collection-method">redirect()</h4>
	<p>The redirect function returns a <a href="/docs/5.7/responses#redirects">redirect HTTP response</a>, or returns the redirector instance if called with no arguments:</p>
	<?php echo Code::getHtmlStatic('return redirect($to = null, $status = 302, $headers = [], $secure = null);

return redirect(\'/home\');

return redirect()-&gt;route(\'route.name\');'); ?>
	<p><a name="method-report"></a></p>
	<h4 id="collection-method">report()</h4>
	<p>The report function will report an exception using your <a href="/docs/5.7/errors#the-exception-handler">exception handler</a>'s report method:</p>
	<?php echo Code::getHtmlStatic('report($e);'); ?>
	<p><a name="method-request"></a></p>
	<h4 id="collection-method">request()</h4>
	<p>The request function returns the current <a href="/docs/5.7/requests">request</a> instance or obtains an input item:</p>
	<?php echo Code::getHtmlStatic('$request = request();

$value = request(\'key\', $default);'); ?>
	<p><a name="method-rescue"></a></p>
	<h4 id="collection-method">rescue()</h4>
	<p>The rescue function executes the given Closure and catches any exceptions that occur during its execution. All exceptions that are caught will be sent to your <a href="/docs/5.7/errors#the-exception-handler">exception handler</a>'s report method; however, the request will continue processing:</p>
	<?php echo Code::getHtmlStatic('return rescue(function () {
    return $this-&gt;method();
});'); ?>
	<p>You may also pass a second argument to the rescue function. This argument will be the "default" value that should be returned if an exception occurs while executing the Closure:</p>
	<?php echo Code::getHtmlStatic('return rescue(function () {
    return $this-&gt;method();
}, false);

return rescue(function () {
    return $this-&gt;method();
}, function () {
    return $this-&gt;failure();
});'); ?>
	<p><a name="method-resolve"></a></p>
	<h4 id="collection-method">resolve()</h4>
	<p>The resolve function resolves a given class or interface name to its instance using the <a href="/docs/5.7/container">service container</a>:</p>
	<?php echo Code::getHtmlStatic('$api = resolve(\'HelpSpot\API\');'); ?>
	<p><a name="method-response"></a></p>
	<h4 id="collection-method">response()</h4>
	<p>The response function creates a <a href="/docs/5.7/responses">response</a> instance or obtains an instance of the response factory:</p>
	<?php echo Code::getHtmlStatic('return response(\'Hello World\', 200, $headers);

return response()-&gt;json([\'foo\' =&gt; \'bar\'], 200, $headers);'); ?>
	<p><a name="method-retry"></a></p>
	<h4 id="collection-method">retry()</h4>
	<p>The retry function attempts to execute the given callback until the given maximum attempt threshold is met. If the callback does not throw an exception, its return value will be returned. If the callback throws an exception, it will automatically be retried. If the maximum attempt count is exceeded, the exception will be thrown:</p>
	<?php echo Code::getHtmlStatic('return retry(5, function () {
    // Attempt 5 times while resting 100ms in between attempts...
}, 100);'); ?>
	<p><a name="method-session"></a></p>
	<h4 id="collection-method">session()</h4>
	<p>The session function may be used to get or set <a href="/docs/5.7/session">session</a> values:</p>
	<?php echo Code::getHtmlStatic('$value = session(\'key\');'); ?>
	<p>You may set values by passing an array of key / value pairs to the function:</p>
	<?php echo Code::getHtmlStatic('session([\'chairs\' =&gt; 7, \'instruments\' =&gt; 3]);'); ?>
	<p>The session store will be returned if no value is passed to the function:</p>
	<?php echo Code::getHtmlStatic('$value = session()-&gt;get(\'key\');

session()-&gt;put(\'key\', $value);'); ?>
	<p><a name="method-tap"></a></p>
	<h4 id="collection-method">tap()</h4>
	<p>The tap function accepts two arguments: an arbitrary $value and a Closure. The $value will be passed to the Closure and then be returned by the tap function. The return value of the Closure is irrelevant:</p>
	<?php echo Code::getHtmlStatic('$user = tap(User::first(), function ($user) {
    $user-&gt;name = \'taylor\';

    $user-&gt;save();
});'); ?>
	<p>If no Closure is passed to the tap function, you may call any method on the given $value. The return value of the method you call will always be $value, regardless of what the method actually returns in its definition. For example, the Eloquent update method typically returns an integer. However, we can force the method to return the model itself by chaining the update method call through the tap function:</p>
	<?php echo Code::getHtmlStatic('$user = tap($user)-&gt;update([
    \'name\' =&gt; $name,
    \'email\' =&gt; $email,
]);'); ?>
	<p><a name="method-today"></a></p>
	<h4 id="collection-method">today()</h4>
	<p>The today function creates a new Illuminate\Support\Carbon instance for the current date:</p>
	<?php echo Code::getHtmlStatic('$today = today();'); ?>
	<p><a name="method-throw-if"></a></p>
	<h4 id="collection-method">throw_if()</h4>
	<p>The throw_if function throws the given exception if a given boolean expression evaluates to true:</p>
	<?php echo Code::getHtmlStatic('throw_if(! Auth::user()-&gt;isAdmin(), AuthorizationException::class);

throw_if(
    ! Auth::user()-&gt;isAdmin(),
    AuthorizationException::class,
    \'You are not allowed to access this page\'
);'); ?>
	<p><a name="method-throw-unless"></a></p>
	<h4 id="collection-method">throw_unless()</h4>
	<p>The throw_unless function throws the given exception if a given boolean expression evaluates to false:</p>
	<?php echo Code::getHtmlStatic('throw_unless(Auth::user()-&gt;isAdmin(), AuthorizationException::class);

throw_unless(
    Auth::user()-&gt;isAdmin(),
    AuthorizationException::class,
    \'You are not allowed to access this page\'
);'); ?>
	<p><a name="method-trait-uses-recursive"></a></p>
	<h4 id="collection-method">trait_uses_recursive()</h4>
	<p>The trait_uses_recursive function returns all traits used by a trait:</p>
	<?php echo Code::getHtmlStatic('$traits = trait_uses_recursive(\Illuminate\Notifications\Notifiable::class);'); ?>
	<p><a name="method-transform"></a></p>
	<h4 id="collection-method">transform()</h4>
	<p>The transform function executes a Closure on a given value if the value is not <a href="#method-blank">blank</a> and returns the result of the Closure:</p>
	<?php echo Code::getHtmlStatic('$callback = function ($value) {
    return $value * 2;
};

$result = transform(5, $callback);

// 10'); ?>
	<p>A default value or Closure may also be passed as the third parameter to the method. This value will be returned if the given value is blank:</p>
	<?php echo Code::getHtmlStatic('$result = transform(null, $callback, \'The value is blank\');

// The value is blank'); ?>
	<p><a name="method-validator"></a></p>
	<h4 id="collection-method">validator()</h4>
	<p>The validator function creates a new <a href="/docs/5.7/validation">validator</a> instance with the given arguments. You may use it instead of the Validator facade for convenience:</p>
	<?php echo Code::getHtmlStatic('$validator = validator($data, $rules, $messages);'); ?>
	<p><a name="method-value"></a></p>
	<h4 id="collection-method">value()</h4>
	<p>The value function returns the value it is given. However, if you pass a Closure to the function, the Closure will be executed then its result will be returned:</p>
	<?php echo Code::getHtmlStatic('$result = value(true);

// true

$result = value(function () {
    return false;
});

// false'); ?>
	<p><a name="method-view"></a></p>
	<h4 id="collection-method">view()</h4>
	<p>The view function retrieves a <a href="/docs/5.7/views">view</a> instance:</p>
	<?php echo Code::getHtmlStatic('return view(\'auth.login\');'); ?>
	<p><a name="method-with"></a></p>
	<h4 id="collection-method">with()</h4>
	<p>The with function returns the value it is given. If a Closure is passed as the second argument to the function, the Closure will be executed and its result will be returned:</p>
	<?php echo Code::getHtmlStatic('$callback = function ($value) {
    return (is_numeric($value)) ? $value * 2 : 0;
};

$result = with(5, $callback);

// 10

$result = with(null, $callback);

// 0

$result = with(5, null);

// 5'); ?>
</article>