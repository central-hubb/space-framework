<h3>Conventions</h3>

<p>
	Because we have embraced a convention over configuration philosophy, using our library is not painful. The
	conventions are easy to remember which will also contribute to stream-lining your productivity as a developer.
</p>

<p>
	If you've already seen the Configuration / Setup guide, then you know that there isn't much to it. Therefore,
	using PHP ActiveRecord mainly requires you to acquaint yourself with some simple conventions. Once you've done
	that, you can move on to the more advanced features.
</p>

<p>ActiveRecord assumes the following conventions:</p>


<pre class="language-php"><code class="language-php"># name of your class represents the singular form of your table name.
class Book extends Model {}

# your table name would be "people"
class Person extends Model {}</code></pre>


The primary key of your table is named "id".

<pre class="language-php"><code class="language-php">class Book extends Model {}

# SELECT * FROM `books` where id = 1
Book::find(1);</code></pre>

<h3>Overriding conventions</h3>

<p>
	Even through ActiveRecord prefers to make assumptions about your table and primary key names, you can
	override them. Here is a simple example showing how one could configure a specific model.
</p>

<pre class="language-php"><code class="language-php">class Book extends Model
{
	# explicit table name since our table is not "books"
	static $table_name = 'my_book';

	# explicit pk since our pk is not "id"
    static $primary_key = 'book_id';

    # explicit connection name since we always want our test db with this model
    static $connection = 'test';

    # explicit database name will generate sql like so => my_db.my_book
    static $db = 'my_db';
 }</code>
</pre>