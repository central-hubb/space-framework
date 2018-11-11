<h3>Basic CRUD</h3>

<p>
	Create, read, update and delete (CRUD) are the four basic functions of persistent storage, a major part of
	nearly all computer software. Sometimes CRUD is expanded with the words retrieve instead of read or destroy
	instead of delete. It is also sometimes used to describe user interface conventions that facilitate viewing,
	searching, and changing information; often using computer-based forms and reports.
</p>

<p>
	In other words, CRUD is the day-to-day tedium of saving and reading data. ActiveRecord removes the remedial and
	encumbering task of hand-writing SQL queries. Instead, you will only need to write the relevant parts to work
	with your data.
</p>


<h4>Create</h4>

<p>
	This is where you save records to your database. Here we create a new post by instantiating a new object and
	then invoking the save() method.
</p>

<pre class="language-php"><code class="language-php">$post = new Post();
$post->title = 'My first blog post!!';
$post->author_id = 5;
$post->save();
# INSERT INTO `posts` (title,author_id) VALUES('My first blog post!!', 5)

# the below methods accomplish the same thing
$attributes = array('title' => 'My first blog post!!', 'author_id' => 5);
$post = new Post($attributes);
$post->save();

# same sql as above
$post = Post::create($attributes);
# same sql as above</code></pre>

<h4>Read</h4>

<p>
	These are your basic methods to find and retrieve records from your database. See the Finders section
	for more details.
</p>


<pre class="language-php"><code class="language-php">$post = Post::find(1);
echo $post->title; # 'My first blog post!!'
echo $post->author_id; # 5

# also the same since it is the first record in the db
$post = Post::first();

# using dynamic finders
$post = Post::find_by_name('The Decider');
$post = Post::find_by_name_and_id('The Bridge Builder',100);
$post = Post::find_by_name_or_id('The Bridge Builder',100);

# using some conditions
$posts = Post::find('all',array('conditions' => array('name=?','The Bridge Builder')));</code></pre>

<h4>Update</h4>

<p>
	To update you would just need to find a record first and then change one of its attributes. It keeps an array
	of attributes that are "dirty" (that have been modified) and so our sql will only update the fields modified.
</p>

<pre class="language-php"><code class="language-php">$post = Post::find(1);
echo $post->title; # 'My first blog post!!'
$post->title = 'Some real title';
$post->save();

# UPDATE `posts` SET title='Some real title' WHERE id=1
$post->update_attributes(array('title' => 'Some other title', 'author_id' => 1));
# UPDATE `posts` SET title='Some other title', author_id=1 WHERE id=1</code></pre>


<h4>Delete</h4>

<p>
	Deleting a record will not destroy the object. This means that it will call sql to delete the
	record in your database, however, you can still use the object.
</p>


<pre class="language-php"><code class="language-php">$post = Post::find(1);
$post->delete();
# DELETE FROM `posts` WHERE id=1

echo $post->title; # Some other title</code></pre>


<h4>Massive Update or Delete</h4>

<p>You can do a massive update or massive delete easily. Look at this example:</p>

<pre class="language-php"><code class="language-php"># MASSIVE UPDATE
# Model::table()->update(AttributesToUpdate, WhereToUpdate);
Post::table()->update(array('title' => 'Massive title!', /* Other attributes... */, array('id' => array(1, 3, 7));

# UPDATE `posts` SET title = `Massive title!` WHERE id IN (1, 3, 7)

# MASSIVE DELETE
# Model::table()->delete(WhereToDelete);
Post::table()->delete(array('id' => array(5, 9, 26, 30));
# DELETE FROM `posts` WHERE id IN (5, 9, 26, 30)</code></pre>