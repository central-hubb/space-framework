<h3>Finders</h3>

<p>
	ActiveRecord supports a number of methods by which you can find records such as: via primary key, dynamic
	field name finders. It has the ability to fetch all the records in a table with a simple call, or you can
	make use of options like order, limit, select, and group.
</p>

<p>
	There are essentially two groups of finders you will be working with: a single record result and multiple
	records result. Sometimes there will be little transparency for the method calls, meaning you may use the same
	method to get either one, but you will pass an option to that method to signify which type of result you will fetch.
</p>

<p>
	All methods used to fetch records from your database will go through Model::find(), with one exception,
	custom sql can be passed to Model::find_by_sql(). In all cases, the finder methods in ActiveRecord are
	statically invoked. This means you will always use the following type of syntax.
</p>

<pre class="language-php"><code class="language-php">class Book extends Model {}

Book::find('all');
Book::find('last');
Book::first();
Book::last();
Book::all();</code></pre>

<h4>Single record result</h4>

<p>
	Whenever you invoke a method which produces a single result, that method will return an instance of
	your model class. There are 3 different ways to fetch a single record result. We'll start with one
	of the most basic forms.
</p>

<h4>Find by primary key</h4>

<p>
	You can grab a record by passing a primary key to the find method. You may pass an options array as the second
	argument for creating specific queries. If no record is found, a RecordNotFound exception will be thrown.
</p>


<pre class="language-php"><code class="language-php">Grab the book with the primary key of 2
Book::find(2);
# sql => SELECT * FROM `books` WHERE id = 2</code></pre>

<h4>Find first</h4>

<p>
	You can get the first record back from your database two ways. If you do not pass conditions as the second
	argument, then this method will fetch all the results from your database, but will only return the very
	first result back to you. Null will be returned if no records are found.
</p>

<pre class="language-php"><code class="language-php"># Grab all books, but only return the first result back as your model object.
$book = Book::first();
echo "the first id is: {$book->id}" # => the first id is: 1
# sql => SELECT * FROM `books`

# this produces the same sql/result as above
Book::find('first');</code></pre>

<h4>Find last</h4>

<p>
	If you haven't yet fallen asleep reading this guide, you should've guessed this is the same as "find first",
	except that it will return the last result. Null will be returned if no records are found.
</p>


<pre class="language-php"><code class="language-php"># Grab all books, but only return the last result back as your model object.
$book = Book::last();
echo "the last id is: {$book->id}" # => the last id is: 32
# sql => SELECT * FROM `books`

# this produces the same sql/result as above
Book::find('last');</code></pre>

<h4>Multiple records result</h4>

<p>
	This type of result will always return an array of model objects. If your table holds no records, or your
	query yields no results, then an empty array will be given.
</p>

<h4>Find by primary key</h4>

<p>
	Just like the single record result for find by primary key, you can pass an array to the find method
	for multiple primary keys. Again, you may pass an options array as the last argument for creating specific
	queries. Every key which you use as an argument must produce a corresponding record, otherwise, a RecordNotFound
	exception will be thrown.
</p>

<pre class="language-php"><code class="language-php"># Grab books with the primary key of 2 or 3
Book::find(2,3);
# sql => SELECT * FROM `books` WHERE id IN (2,3)

# same as above
Book::find(array(2,3));</code></pre>

<h4>Find all</h4>

<p>
	There are 2 more ways which you can use to get multiple records back from your database. They use different
	methods; however, they are basically the same thing. If you do not pass an options array, then it will
	fetch all records.
</p>

<pre class="language-php"><code class="language-php"># Grab all books from the database
Book::all();
# sql => SELECT * FROM `books`

# same as above
Book::find('all');</code></pre>

<p>Here we pass some options to the same method so that we don't fetch every record.</p>

<pre class="language-php"><code class="language-php">$options = array('limit' => 2);
Book::all($options);
# sql => SELECT * FROM `books` LIMIT 0,2

# same as above
Book::find('all', $options);</code></pre>

<h4>Finder options</h4>

<p>
	There are a number of options available to pass to one of the finder methods for granularity. Let's start
	with one of the most important options: conditions.
</p>

<h4>Conditions</h4>

<p>
	This is the "WHERE" of a SQL statement. By creating conditions, ActiveRecord will parse them into a
	corresponding "WHERE" SQL statement to filter out your results. Conditions can be extremely simple by only
	supplying a string. They can also be as complex as you'd like by creating a conditions string that uses ? marks
	as placeholders for values. Let's start with a simple example of a conditions string.
</p>


<pre class="language-php"><code class="language-php"># fetch all the cheap books!
Book::all(array('conditions' => 'price < 15.00'));
# sql => SELECT * FROM `books` WHERE price < 15.00

# fetch all books that have "war" somewhere in the title
Book::find('all', array('conditions' => "title LIKE '%war%'"));
# sql => SELECT * FROM `books` WHERE title LIKE '%war%</code></pre>

<p>
	As stated, you can use *?* marks as placeholders for values which ActiveRecord will replace with your supplied
	values. The benefit of using this process is that ActiveRecord will escape your string in the backend with your
	database's native function to prevent SQL injection.
</p>


<pre class="language-php"><code class="language-php"># fetch all the cheap books!
Book::all(array('conditions' => array('price < ?', 15.00)));
# sql => SELECT * FROM `books` WHERE price < 15.00

# fetch all lousy romance novels
Book::find('all', array('conditions' => array('genre = ?', 'Romance')));
# sql => SELECT * FROM `books` WHERE genre = 'Romance'

# fetch all books with these authors
Book::find('all', array('conditions' => array('author_id in (?)', array(1,2,3))));
# sql => SELECT * FROM `books` WHERE author_id in (1,2,3)

# fetch all lousy romance novels which are cheap
Book::all(array('conditions' => array('genre = ? AND price < ?', 'Romance', 15.00)));
# sql => SELECT * FROM `books` WHERE genre = 'Romance' AND price < 15.00</code></pre>

<p>
	Here is a more complicated example. Again, the first index of the conditions array are the condition strings.
	The values in the array after that are the values which replace their corresponding ? marks.
</p>

<pre class="language-php"><code class="language-php"># fetch all cheap books by these authors
$cond = array('conditions'=>array('author_id in(?) AND price < ?', array(1,2,3), 15.00));
Book::all($cond);
# sql => SELECT * FROM `books` WHERE author_id in(1,2,3) AND price < 15.00</code></pre>

<h4>Limit & Offset</h4>

<p>
	This one should be fairly obvious. A limit option will produce a SQL limit clause for supported databases.
	It can be used in conjunction with the offset option.
</p>

<pre class="language-php"><code class="language-php"># fetch all but limit to 10 total books
Book::find('all', array('limit' => 10));
# sql => SELECT * FROM `books` LIMIT 0,10

# fetch all but limit to 10 total books starting at the 6th book
Book::find('all', array('limit' => 10, 'offset' => 5));
# sql => SELECT * FROM `books` LIMIT 5,10</code></pre>

<h4>Order</h4>

<p>Produces an ORDER BY SQL clause.</p>

<pre class="language-php"><code class="language-php"># order all books by title desc
Book::find('all', array('order' => 'title desc'));
# sql => SELECT * FROM `books` ORDER BY title desc

# order by most expensive and title
Book::find('all', array('order' => 'price desc, title asc'));
# sql => SELECT * FROM `books` ORDER BY price desc, title asc</code></pre>

<h4>Select</h4>

<p>
	Passing a select key in your options array will allow you to specify which columns you want back from the
	database. This is helpful when you have a table with too many columns, but you might only want 3 columns
	back for 50 records. It is also helpful when used with a group statement.
</p>

<pre class="language-php"><code class="language-php"># fetch all books, but only the id and title columns
Book::find('all', array('select' => 'id, title'));
# sql => SELECT id, title FROM `books`

# custom sql to feed some report
Book::find('all', array('select' => 'avg(price) as avg_price, avg(tax) as avg_tax'));
# sql => SELECT avg(price) as avg_price, avg(tax) as avg_tax FROM `books` LIMIT 5,10</code></pre>

<h4>From</h4>

<p>
	This designates the table you are selecting from. This can come in handy if you do a join or require finer control.
</p>

<pre class="language-php"><code class="language-php"># fetch the first book by aliasing the table name
Book::first(array('select'=> 'b.*', 'from' => 'books as b'));
# sql => SELECT b.* FROM books as b LIMIT 0,1</code></pre>