<?php use App\Library\Framework\Component\Code; ?>

<div class="wiki">
	<h2 id="Associations">Database : Relationships</h2>

	<ul id="topic-list">
		<li><a href="/docs/database/relationships#common-options">Common options</a></li>
		<li><a href="/docs/database/relationships#has_many">has_many</a></li>
		<li><a href="/docs/database/relationships#has_many_through" title="many to many">has_many through</a></li>
		<li><a href="/docs/database/relationships#belongs_to">belongs_to</a></li>
		<li><a href="/docs/database/relationships#has_one">has_one</a></li>
		<li><a href="/docs/database/relationships#self-referential">Self-referential</a></li>
	</ul>


	<p>What are associations? By declaring associations on your models, you allow them to communicate with each other. These associations should match the way data in your tables relate to each other.</p>


	<h4 id="common-options">Common options</h4>


	<p>These are available amongst each type of association.</p>


	<p><strong>conditions</strong>: string/array of <a href="/docs/database/finders#conditions">finder conditions</a><br><strong>readonly</strong>: whether associated objects can be <a href="/docs/database/finders#read-only">saved/destroyed</a><br><strong>select</strong>: specify fields in the <a href="/docs/database/finders#select">select clause</a><br><strong>class_name</strong>: the class name of the associated model<br><strong>foreign_key</strong>: name of foreign_key</p>


	<p>Let's take a look at these options with a few different association types</p>


	<h5>conditions</h5>


	<p>Below, we specify that associated payments of an order object should not be void.</p>


	<?php echo Code::getHtmlStatic('1 class Order extends ActiveRecord\Model {
2   static $has_many = array(
3     array(\'payments\', \'conditions\' =&gt; array(\'void = ?\' =&gt; array(0)))
4   );
5 }
'); ?>

	<h5>readonly</h5>


	<p>If you add a readonly option to your association, then the associatied object cannot be saved, although, the base object can still be saved.</p>


	<?php echo Code::getHtmlStatic(' 1 class Payment extends ActiveRecord\Model {
 2   static $belongs_to = array(
 3     array(\'user\', \'readonly\' =&gt; true)
 4   );
 5 }
 6
 7 $payment = Payment::first();
 8 $payment-&gt;paid = 1;
 9 $payment-&gt;save(); # this will save just fine
10
11 $payment-&gt;user-&gt;first_name = \'John\';
12 $payment-&gt;user-&gt;save(); # this will throw a ReadOnlyException
'); ?>

	<h5>select</h5>


	<p>Sometimes you may not need all of the fields back from one of your associations (e.g. it may be a ridiculously large table) and so you can specify the particular fields you want.</p>


	<?php echo Code::getHtmlStatic('1 class Payment extends ActiveRecord\Model {
2   static $belongs_to = array(
3     array(\'person\', \'select\' =&gt; \'id, first_name, last_name\')
4   );
5 }
'); ?>

	<h5 id="class_name">class_name</h5>


	<p>In this example payment has a one-to-one relationship with a user, but we want to access the association thru "person." Thus, we have to provide the class name of the associated model; otherwise, ActiveRecord would try to look for a "Person" class.</p>


	<?php echo Code::getHtmlStatic('1 class Payment extends ActiveRecord\Model {
2   static $belongs_to = array(
3     array(\'person\', \'class_name\' =&gt; \'User\')
4   );
5 }
'); ?>

	<h4 id="has_many">has_many</h4>


	<p>A one-to-many relationship. You should use a pluralized form of the associated model when declaring a has_many association, unless you want to use the <a href="/docs/database/relationships#class_name">class_name</a> option.</p>


	<?php echo Code::getHtmlStatic(' 1 # one-to-many association with the model "Payment" 
 2 class User extends ActiveRecord\Model {
 3   static $has_many = array(
 4     array(\'payments\')
 5   );
 6 }
 7
 8 $user = User::first();
 9 print_r($user-&gt;payments); # =&gt; will print an array of Payment objects
10
11 $payment = $user-&gt;create_payment(array(\'amount\' =&gt; 1)); # build|create for associations.
'); ?>

	<p><img src="/images/guides/has_many.png" alt=""></p>


	<p>Options (not part of <a href="/docs/database/relationships#common-options">common options</a>)</p>


	<p><strong>limit/offset</strong>: limit the number of records<br><strong>primary_key</strong>: name of the primary_key of the association (assumed to be "id")<br><strong>group</strong>: GROUP BY clause<br><strong>order</strong>: ORDER BY clause<br><strong>through</strong>: the association used to go "through"</p>


	<?php echo Code::getHtmlStatic('1 class Order extends ActiveRecord\Model {
2   static $has_many = array(
3     array(\'payments\', \'limit\' =&gt; 5),
4     array(\'items\', \'order\' =&gt; \'name asc\', \'group\' =&gt; \'type\')
5   );
6 }
'); ?>

	<h5 id="has_many_through">has_many through (many to many)</h5>


	<p>This is a convenient way to configure a many-to-many association. In this example an order is associated with users by going the its payments association.</p>


	<?php echo Code::getHtmlStatic(' 1 class Order extends ActiveRecord\Model {
 2   static $has_many = array(
 3     array(\'payments\'),
 4     array(\'users\', \'through\' =&gt; \'payments\')
 5   );
 6 }
 7
 8 class Payment extends ActiveRecord\Model {
 9   static $belongs_to = array(
10     array(\'user\'),
11     array(\'order\')
12   );
13 }
14
15 class User extends ActiveRecord\Model {
16   static $has_many = array(
17     array(\'payments\')
18   );
19 }
<strong>20</strong>
21 $order = Order::first();
22 # direct access to users
23 print_r($order-&gt;users); # will print an array of User object
'); ?>

	<p><img src="/images/guides/has_many_through.png" alt=""></p>


	<h4 id="belongs_to">belongs_to</h4>


	<p>This indicates a one-to-one relationship. Its difference from <a href="/docs/database/relationships#has_one">has_one</a> is that the foreign key will be on the table which declares a belongs_to association. You should use a singular form of the associated model when declaring this association, unless you want to use the <a href="/docs/database/relationships#class_name">class_name</a> option.</p>


	<?php echo Code::getHtmlStatic('1 class Payment extends ActiveRecord\Model {
2   static $belongs_to = array(
3     array(\'user\')
4   );
5 }
6
7 $payment = Payment::first();
8 echo $payment-&gt;user-&gt;first_name; # first_name of associated User object
'); ?>

	<p><img src="/images/guides/belongs_to.png" alt=""></p>


	<p>Options (not part of <a href="/docs/database/relationships#common-options">common options</a>)</p>


	<p><strong>primary_key</strong>: name of the primary_key of the association (assumed to be "id")</p>


	<h4 id="has_one">has_one</h4>


	<p>This indicates a one-to-one relationship. A has_one will have the foreign key on the associated table unlike <a href="/docs/database/relationships#belongs_to">belongs_to</a>. You should use a singular form of the associated model when declaring this association, unless you want to use the <a href="/docs/database/relationships#class_name">class_name</a> option.</p>


	<?php echo Code::getHtmlStatic('1 class Payment extends ActiveRecord\Model {
2   static $has_one = array(
3     array(\'receipt\')
4   );
5 }
'); ?>

	<p><img src="/images/guides/has_one.png" alt=""></p>


	<p>Options (not part of <a href="/docs/database/relationships#common-options">common options</a>)</p>


	<p><strong>primary_key</strong>: name of the primary_key of the association (assumed to be "id")<br><strong>through</strong>: the association used to go "through"</p>


	<h5>has_one through</h5>


	<p>A one-to-one association. In this example, an owner has a quarter_back by going through its team association.</p>


	<?php echo Code::getHtmlStatic(' 1 class Owner extends ActiveRecord\Model {
 2   static $has_one = array(
 3     array(\'team\'),
 4     array(\'quarter_back\', \'through\' =&gt; \'team\')
 5   );
 6 }
 7
 8 class Team extends ActiveRecord\Model {
 9   static $belongs_to = array(
10     array(\'owner\')
11   );
12
13   static $has_one = array(
14     array(\'quarter_back\')
15   );
16 }
17
18 class QuarterBack extends ActiveRecord\Model {
19   static $belongs_to = array(
<strong>20</strong>     array(\'team\')
21   );
22 }
'); ?>

	<p><img src="/images/guides/has_one_through.png" alt=""></p>


	<h4 id="self-referential">Self-referential</h4>


	<p>Model's can declare associations to themselves. This can be helpful for table auditing, or in the example below, where a post would need to know about its parent.</p>


	<?php echo Code::getHtmlStatic('1 class Post extends ActiveRecord\Model {
2   static $belongs_to = array(array(\'parent_post\', \'class_name\' =&gt; \'Post\'));
3 }
'); ?>

	<p><img src="/images/guides/belongs_to_self_referential.png" alt=""></p>
</div>