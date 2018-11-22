<?php use App\Library\Framework\Component\Code; ?>

<div class="wiki">
	<h2 id="Basic-CRUD">Database : Basic CRUD</h2>


	<ul id="topic-list">
		<li><a href="/docs/database/basic-crud#create">Create</a></li>
		<li><a href="/docs/database/basic-crud#read">Read</a></li>
		<li><a href="/docs/database/basic-crud#update">Update</a></li>
		<li><a href="/docs/database/basic-crud#delete">Delete</a></li>
		<li><a href="/docs/database/basic-crud#massive">Massive</a></li>
	</ul>


	<p><a href="http://en.wikipedia.org/wiki/Create,_read,_update_and_delete" class="external">CRUD</a> as defined by Wikipedia:</p>


	<blockquote>

		<p>Create, read, update and delete (CRUD) are the four basic functions of persistent storage, a major part of nearly all computer software. Sometimes CRUD is expanded with the words retrieve instead of read or destroy instead of delete. It is also sometimes used to describe user interface conventions that facilitate viewing, searching, and changing information; often using computer-based forms and reports.</p>


	</blockquote>

	<p>In other words, CRUD is the day-to-day tedium of saving and reading data. ActiveRecord removes the remedial and encumbering task of hand-writing SQL queries. Instead, you will only need to write the relevant parts to work with your data.</p>


	<h4 id="create">Create</h4>


	<p>This is where you save records to your database. Here we create a new post by instantiating a new object and then invoking the save() method.</p>


	<?php echo Code::getHtmlStatic(' 1 $post = new Post();
 2 $post-&gt;title = \'My first blog post!!\';
 3 $post-&gt;author_id = 5;
 4 $post-&gt;save();
 5 # INSERT INTO `posts` (title,author_id) VALUES(\'My first blog post!!\', 5)
 6
 7 # the below methods accomplish the same thing
 8
 9 $attributes = array(\'title\' =&gt; \'My first blog post!!\', \'author_id\' =&gt; 5);
10 $post = new Post($attributes);
11 $post-&gt;save();
12 # same sql as above
13
14 $post = Post::create($attributes);
15 # same sql as above
'); ?>

	<h4 id="read">Read</h4>


	<p>These are your basic methods to find and retrieve records from your database. See the <a href="/docs/database/finders" class="wiki-page">Finders</a> section for more details.</p>


	<?php echo Code::getHtmlStatic(' 1 $post = Post::find(1);
 2 echo $post-&gt;title; # \'My first blog post!!\'
 3 echo $post-&gt;author_id; # 5
 4
 5 # also the same since it is the first record in the db
 6 $post = Post::first();
 7
 8 # using dynamic finders
 9 $post = Post::find_by_name(\'The Decider\');
10 $post = Post::find_by_name_and_id(\'The Bridge Builder\',100);
11 $post = Post::find_by_name_or_id(\'The Bridge Builder\',100);
12
13 # using some conditions
14 $posts = Post::find(\'all\',array(\'conditions\' =&gt; array(\'name=?\',\'The Bridge Builder\')));
'); ?>

	<h4 id="update">Update</h4>


	<p>To update you would just need to find a record first and then change one of its attributes. It keeps an array of attributes that are "dirty" (that have been modified) and so our sql will only update the fields modified.</p>


	<?php echo Code::getHtmlStatic('1 $post = Post::find(1);
2 echo $post-&gt;title; # \'My first blog post!!\'
3 $post-&gt;title = \'Some real title\';
4 $post-&gt;save();
5 # UPDATE `posts` SET title=\'Some real title\' WHERE id=1
6
7 $post-&gt;update_attributes(array(\'title\' =&gt; \'Some other title\', \'author_id\' =&gt; 1));
8 # UPDATE `posts` SET title=\'Some other title\', author_id=1 WHERE id=1
'); ?>

	<h4 id="delete">Delete</h4>


	<p>Deleting a record will not destroy the object. This means that it will call sql to delete the record in your database, however, you can still use the object.</p>


	<?php echo Code::getHtmlStatic('1 $post = Post::find(1);
2 $post-&gt;delete();
3 # DELETE FROM `posts` WHERE id=1
4
5 echo $post-&gt;title; # Some other title
'); ?>

	<h4 id="massive">Massive Update or Delete</h4>


	<p>You can do a massive update or massive delete easily. Look at this example:</p>


	<?php echo Code::getHtmlStatic(' 1 # MASSIVE UPDATE
 2 # Model::table()-&gt;update(AttributesToUpdate, WhereToUpdate);
 3 Post::table()-&gt;update(array(\'title\' =&gt; \'Massive title!\', /* Other attributes... */, array(\'id\' =&gt; array(1, 3, 7));
 4 # UPDATE `posts` SET title = `Massive title!` WHERE id IN (1, 3, 7)
 5
 6 # MASSIVE DELETE
 7 # Model::table()-&gt;delete(WhereToDelete);
 8 Post::table()-&gt;delete(array(\'id\' =&gt; array(5, 9, 26, 30));
 9 # DELETE FROM `posts` WHERE id IN (5, 9, 26, 30)
'); ?>
</div>