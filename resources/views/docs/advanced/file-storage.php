<?php use App\Library\Framework\Component\Code; ?>

<article>
	<h1>File Storage</h1>
	<h2>Introduction</h2>
	<p>Space MVC provides a powerful filesystem abstraction thanks to the wonderful <a href="https://github.com/thephpleague/flysystem">Flysystem</a> PHP package by Frank de Jonge. The Space MVC Flysystem integration provides simple to use drivers for working with local filesystems, Amazon S3, and Rackspace Cloud Storage. Even better, it's amazingly simple to switch between these storage options as the API remains the same for each system.</p>
	<p><a name="configuration"></a></p>
	<h2><a href="#configuration">Configuration</a></h2>
	<p>The filesystem configuration file is located at config/filesystems.php. Within this file you may configure all of your "disks". Each disk represents a particular storage driver and storage location. Example configurations for each supported driver are included in the configuration file. So, modify the configuration to reflect your storage preferences and credentials.</p>
	<p>Of course, you may configure as many disks as you like, and may even have multiple disks that use the same driver.</p>
	<p><a name="the-public-disk"></a></p>
	<h3>The Public Disk</h3>
	<p>The public disk is intended for files that are going to be publicly accessible. By default, the public disk uses the local driver and stores these files in storage/app/public. To make them accessible from the web, you should create a symbolic link from public/storage to storage/app/public. This convention will keep your publicly accessible files in one directory that can be easily shared across deployments when using zero down-time deployment systems like <a href="https://envoyer.io">Envoyer</a>.</p>
	<p>To create the symbolic link, you may use the storage:link Artisan command:</p>
	<?php echo Code::getHtmlStatic('php artisan storage:link'); ?>
	<p>Of course, once a file has been stored and the symbolic link has been created, you can create a URL to the files using the asset helper:</p>
	<?php echo Code::getHtmlStatic('echo asset(\'storage/file.txt\');'); ?>
	<p><a name="the-local-driver"></a></p>
	<h3>The Local Driver</h3>
	<p>When using the local driver, all file operations are relative to the root directory defined in your configuration file. By default, this value is set to the storage/app directory. Therefore, the following method would store a file in storage/app/file.txt:</p>
	<?php echo Code::getHtmlStatic('Storage::disk(\'local\')-&gt;put(\'file.txt\', \'Contents\');'); ?>
	<p><a name="driver-prerequisites"></a></p>
	<h3>Driver Prerequisites</h3>
	<h4>Composer Packages</h4>
	<p>Before using the SFTP, S3, or Rackspace drivers, you will need to install the appropriate package via Composer:</p>
	<ul>
		<li>SFTP: league/flysystem-sftp ~1.0</li>
		<li>Amazon S3: league/flysystem-aws-s3-v3 ~1.0</li>
		<li>Rackspace: league/flysystem-rackspace ~1.0</li>
	</ul>
	<p>An absolute must for performance is to use a cached adapter. You will need an additional package for this:</p>
	<ul>
		<li>CachedAdapter: league/flysystem-cached-adapter ~1.0</li>
	</ul>
	<h4>S3 Driver Configuration</h4>
	<p>The S3 driver configuration information is located in your config/filesystems.php configuration file. This file contains an example configuration array for an S3 driver. You are free to modify this array with your own S3 configuration and credentials. For convenience, these environment variables match the naming convention used by the AWS CLI.</p>
	<h4>FTP Driver Configuration</h4>
	<p>Space MVC's Flysystem integrations works great with FTP; however, a sample configuration is not included with the framework's default filesystems.php configuration file. If you need to configure a FTP filesystem, you may use the example configuration below:</p>
	<?php echo Code::getHtmlStatic('\'ftp\' =&gt; [
    \'driver\'   =&gt; \'ftp\',
    \'host\'     =&gt; \'ftp.example.com\',
    \'username\' =&gt; \'your-username\',
    \'password\' =&gt; \'your-password\',

    // Optional FTP Settings...
    // \'port\'     =&gt; 21,
    // \'root\'     =&gt; \'\',
    // \'passive\'  =&gt; true,
    // \'ssl\'      =&gt; true,
    // \'timeout\'  =&gt; 30,
],'); ?>
	<h4>SFTP Driver Configuration</h4>
	<p>Space MVC's Flysystem integrations works great with SFTP; however, a sample configuration is not included with the framework's default filesystems.php configuration file. If you need to configure a SFTP filesystem, you may use the example configuration below:</p>
	<?php echo Code::getHtmlStatic('\'sftp\' =&gt; [
    \'driver\' =&gt; \'sftp\',
    \'host\' =&gt; \'example.com\',
    \'username\' =&gt; \'your-username\',
    \'password\' =&gt; \'your-password\',

    // Settings for SSH key based authentication...
    // \'privateKey\' =&gt; \'/path/to/privateKey\',
    // \'password\' =&gt; \'encryption-password\',

    // Optional SFTP Settings...
    // \'port\' =&gt; 22,
    // \'root\' =&gt; \'\',
    // \'timeout\' =&gt; 30,
],'); ?>
	<h4>Rackspace Driver Configuration</h4>
	<p>Space MVC's Flysystem integrations works great with Rackspace; however, a sample configuration is not included with the framework's default filesystems.php configuration file. If you need to configure a Rackspace filesystem, you may use the example configuration below:</p>
	<?php echo Code::getHtmlStatic('\'rackspace\' =&gt; [
    \'driver\'    =&gt; \'rackspace\',
    \'username\'  =&gt; \'your-username\',
    \'key\'       =&gt; \'your-key\',
    \'container\' =&gt; \'your-container\',
    \'endpoint\'  =&gt; \'https://identity.api.rackspacecloud.com/v2.0/\',
    \'region\'    =&gt; \'IAD\',
    \'url_type\'  =&gt; \'publicURL\',
],'); ?>
	<p><a name="caching"></a></p>
	<h3>Caching</h3>
	<p>To enable caching for a given disk, you may add a cache directive to the disk's configuration options. The cache option should be an array of caching options containing the disk name, the expire time in seconds, and the cache prefix:</p>
	<?php echo Code::getHtmlStatic('\'s3\' =&gt; [
    \'driver\' =&gt; \'s3\',

    // Other Disk Options...

    \'cache\' =&gt; [
        \'store\' =&gt; \'memcached\',
        \'expire\' =&gt; 600,
        \'prefix\' =&gt; \'cache-prefix\',
    ],
],'); ?>
	<p><a name="obtaining-disk-instances"></a></p>
	<h2><a href="#obtaining-disk-instances">Obtaining Disk Instances</a></h2>
	<p>The Storage facade may be used to interact with any of your configured disks. For example, you may use the put method on the facade to store an avatar on the default disk. If you call methods on the Storage facade without first calling the disk method, the method call will automatically be passed to the default disk:</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Support\Facades\Storage;

Storage::put(\'avatars/1\', $fileContents);'); ?>
	<p>If your applications interacts with multiple disks, you may use the disk method on the Storage facade to work with files on a particular disk:</p>
	<?php echo Code::getHtmlStatic('Storage::disk(\'s3\')-&gt;put(\'avatars/1\', $fileContents);'); ?>
	<p><a name="retrieving-files"></a></p>
	<h2><a href="#retrieving-files">Retrieving Files</a></h2>
	<p>The get method may be used to retrieve the contents of a file. The raw string contents of the file will be returned by the method. Remember, all file paths should be specified relative to the "root" location configured for the disk:</p>
	<?php echo Code::getHtmlStatic('$contents = Storage::get(\'file.jpg\');'); ?>
	<p>The exists method may be used to determine if a file exists on the disk:</p>
	<?php echo Code::getHtmlStatic('$exists = Storage::disk(\'s3\')-&gt;exists(\'file.jpg\');'); ?>
	<p><a name="downloading-files"></a></p>
	<h3>Downloading Files</h3>
	<p>The download method may be used to generate a response that forces the user's browser to download the file at the given path. The download method accepts a file name as the second argument to the method, which will determine the file name that is seen by the user downloading the file. Finally, you may pass an array of HTTP headers as the third argument to the method:</p>
	<?php echo Code::getHtmlStatic('return Storage::download(\'file.jpg\');

return Storage::download(\'file.jpg\', $name, $headers);'); ?>
	<p><a name="file-urls"></a></p>
	<h3>File URLs</h3>
	<p>You may use the url method to get the URL for the given file. If you are using the local driver, this will typically just prepend /storage to the given path and return a relative URL to the file. If you are using the s3 or rackspace driver, the fully qualified remote URL will be returned:</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Support\Facades\Storage;

$url = Storage::url(\'file.jpg\');'); ?>
	<p>Remember, if you are using the local driver, all files that should be publicly accessible should be placed in the storage/app/public directory. Furthermore, you should <a href="#the-public-disk">create a symbolic link</a> at public/storage which points to the storage/app/public directory.</p>
	<h4>Temporary URLs</h4>
	<p>For files stored using the s3 or rackspace driver, you may create a temporary URL to a given file using the temporaryUrl method. This methods accepts a path and a DateTime instance specifying when the URL should expire:</p>
	<?php echo Code::getHtmlStatic('$url = Storage::temporaryUrl(
    \'file.jpg\', now()-&gt;addMinutes(5)
);'); ?>
	<h4>Local URL Host Customization</h4>
	<p>If you would like to pre-define the host for files stored on a disk using the local driver, you may add a url option to the disk's configuration array:</p>
	<?php echo Code::getHtmlStatic('\'public\' =&gt; [
    \'driver\' =&gt; \'local\',
    \'root\' =&gt; storage_path(\'app/public\'),
    \'url\' =&gt; env(\'APP_URL\').\'/storage\',
    \'visibility\' =&gt; \'public\',
],'); ?>
	<p><a name="file-metadata"></a></p>
	<h3>File Metadata</h3>
	<p>In addition to reading and writing files, Space MVC can also provide information about the files themselves. For example, the size method may be used to get the size of the file in bytes:</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Support\Facades\Storage;

$size = Storage::size(\'file.jpg\');'); ?>
	<p>The lastModified method returns the UNIX timestamp of the last time the file was modified:</p>
	<?php echo Code::getHtmlStatic('$time = Storage::lastModified(\'file.jpg\');'); ?>
	<p><a name="storing-files"></a></p>
	<h2><a href="#storing-files">Storing Files</a></h2>
	<p>The put method may be used to store raw file contents on a disk. You may also pass a PHP resource to the put method, which will use Flysystem's underlying stream support. Using streams is greatly recommended when dealing with large files:</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Support\Facades\Storage;

Storage::put(\'file.jpg\', $contents);

Storage::put(\'file.jpg\', $resource);'); ?>
	<h4>Automatic Streaming</h4>
	<p>If you would like Space MVC to automatically manage streaming a given file to your storage location, you may use the putFile or putFileAs method. This method accepts either a Illuminate\Http\File or Illuminate\Http\UploadedFile instance and will automatically stream the file to your desired location:</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

// Automatically generate a unique ID for file name...
Storage::putFile(\'photos\', new File(\'/path/to/photo\'));

// Manually specify a file name...
Storage::putFileAs(\'photos\', new File(\'/path/to/photo\'), \'photo.jpg\');'); ?>
	<p>There are a few important things to note about the putFile method. Note that we only specified a directory name, not a file name. By default, the putFile method will generate a unique ID to serve as the file name. The file's extension will be determined by examining the file's MIME type. The path to the file will be returned by the putFile method so you can store the path, including the generated file name, in your database.</p>
	<p>The putFile and putFileAs methods also accept an argument to specify the "visibility" of the stored file. This is particularly useful if you are storing the file on a cloud disk such as S3 and would like the file to be publicly accessible:</p>
	<?php echo Code::getHtmlStatic('Storage::putFile(\'photos\', new File(\'/path/to/photo\'), \'public\');'); ?>
	<h4>Prepending &amp; Appending To Files</h4>
	<p>The prepend and append methods allow you to write to the beginning or end of a file:</p>
	<?php echo Code::getHtmlStatic('Storage::prepend(\'file.log\', \'Prepended Text\');

Storage::append(\'file.log\', \'Appended Text\');'); ?>
	<h4>Copying &amp; Moving Files</h4>
	<p>The copy method may be used to copy an existing file to a new location on the disk, while the move method may be used to rename or move an existing file to a new location:</p>
	<?php echo Code::getHtmlStatic('Storage::copy(\'old/file.jpg\', \'new/file.jpg\');

Storage::move(\'old/file.jpg\', \'new/file.jpg\');'); ?>
	<p><a name="file-uploads"></a></p>
	<h3>File Uploads</h3>
	<p>In web applications, one of the most common use-cases for storing files is storing user uploaded files such as profile pictures, photos, and documents. Space MVC makes it very easy to store uploaded files using the store method on an uploaded file instance. Call the store method with the path at which you wish to store the uploaded file:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserAvatarController extends Controller
{
    /**
     * Update the avatar for the user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        $path = $request-&gt;file(\'avatar\')-&gt;store(\'avatars\');

        return $path;
    }
}'); ?>
	<p>There are a few important things to note about this example. Note that we only specified a directory name, not a file name. By default, the store method will generate a unique ID to serve as the file name. The file's extension will be determined by examining the file's MIME type. The path to the file will be returned by the store method so you can store the path, including the generated file name, in your database.</p>
	<p>You may also call the putFile method on the Storage facade to perform the same file manipulation as the example above:</p>
	<?php echo Code::getHtmlStatic('$path = Storage::putFile(\'avatars\', $request-&gt;file(\'avatar\'));'); ?>
	<h4>Specifying A File Name</h4>
	<p>If you would not like a file name to be automatically assigned to your stored file, you may use the storeAs method, which receives the path, the file name, and the (optional) disk as its arguments:</p>
	<?php echo Code::getHtmlStatic('$path = $request-&gt;file(\'avatar\')-&gt;storeAs(
    \'avatars\', $request-&gt;user()-&gt;id
);'); ?>
	<p>Of course, you may also use the putFileAs method on the Storage facade, which will perform the same file manipulation as the example above:</p>
	<?php echo Code::getHtmlStatic('$path = Storage::putFileAs(
    \'avatars\', $request-&gt;file(\'avatar\'), $request-&gt;user()-&gt;id
);'); ?>
	<h4>Specifying A Disk</h4>
	<p>By default, this method will use your default disk. If you would like to specify another disk, pass the disk name as the second argument to the store method:</p>
	<?php echo Code::getHtmlStatic('$path = $request-&gt;file(\'avatar\')-&gt;store(
    \'avatars/\'.$request-&gt;user()-&gt;id, \'s3\'
);'); ?>
	<p><a name="file-visibility"></a></p>
	<h3>File Visibility</h3>
	<p>In Space MVC's Flysystem integration, "visibility" is an abstraction of file permissions across multiple platforms. Files may either be declared public or private. When a file is declared public, you are indicating that the file should generally be accessible to others. For example, when using the S3 driver, you may retrieve URLs for public files.</p>
	<p>You can set the visibility when setting the file via the put method:</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Support\Facades\Storage;

Storage::put(\'file.jpg\', $contents, \'public\');'); ?>
	<p>If the file has already been stored, its visibility can be retrieved and set via the getVisibility and setVisibility methods:</p>
	<?php echo Code::getHtmlStatic('$visibility = Storage::getVisibility(\'file.jpg\');

Storage::setVisibility(\'file.jpg\', \'public\')'); ?>
	<p><a name="deleting-files"></a></p>
	<h2><a href="#deleting-files">Deleting Files</a></h2>
	<p>The delete method accepts a single filename or an array of files to remove from the disk:</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Support\Facades\Storage;

Storage::delete(\'file.jpg\');

Storage::delete([\'file.jpg\', \'file2.jpg\']);'); ?>
	<p>If necessary, you may specify the disk that the file should be deleted from:</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Support\Facades\Storage;

Storage::disk(\'s3\')-&gt;delete(\'folder_path/file_name.jpg\');'); ?>
	<p><a name="directories"></a></p>
	<h2><a href="#directories">Directories</a></h2>
	<h4>Get All Files Within A Directory</h4>
	<p>The files method returns an array of all of the files in a given directory. If you would like to retrieve a list of all files within a given directory including all sub-directories, you may use the allFiles method:</p>
	<?php echo Code::getHtmlStatic('use Illuminate\Support\Facades\Storage;

$files = Storage::files($directory);

$files = Storage::allFiles($directory);'); ?>
	<h4>Get All Directories Within A Directory</h4>
	<p>The directories method returns an array of all the directories within a given directory. Additionally, you may use the allDirectories method to get a list of all directories within a given directory and all of its sub-directories:</p>
	<?php echo Code::getHtmlStatic('$directories = Storage::directories($directory);

// Recursive...
$directories = Storage::allDirectories($directory);'); ?>
	<h4>Create A Directory</h4>
	<p>The makeDirectory method will create the given directory, including any needed sub-directories:</p>
	<?php echo Code::getHtmlStatic('Storage::makeDirectory($directory);'); ?>
	<h4>Delete A Directory</h4>
	<p>Finally, the deleteDirectory may be used to remove a directory and all of its files:</p>
	<?php echo Code::getHtmlStatic('Storage::deleteDirectory($directory);'); ?>
	<p><a name="custom-filesystems"></a></p>
	<h2><a href="#custom-filesystems">Custom Filesystems</a></h2>
	<p>Space MVC's Flysystem integration provides drivers for several "drivers" out of the box; however, Flysystem is not limited to these and has adapters for many other storage systems. You can create a custom driver if you want to use one of these additional adapters in your Space MVC application.</p>
	<p>In order to set up the custom filesystem you will need a Flysystem adapter. Let's add a community maintained Dropbox adapter to our project:</p>
	<?php echo Code::getHtmlStatic('composer require spatie/flysystem-dropbox'); ?>
	<p>Next, you should create a <a href="/docs/5.7/providers">service provider</a> such as DropboxServiceProvider. In the provider's boot method, you may use the Storage facade's extend method to define the custom driver:</p>
	<?php echo Code::getHtmlStatic('&lt;?php

namespace App\Providers;

use Storage;
use League\Flysystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Spatie\Dropbox\Client as DropboxClient;
use Spatie\FlysystemDropbox\DropboxAdapter;

class DropboxServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend(\'dropbox\', function ($app, $config) {
            $client = new DropboxClient(
                $config[\'authorization_token\']
            );

            return new Filesystem(new DropboxAdapter($client));
        });
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}'); ?>
	<p>The first argument of the extend method is the name of the driver and the second is a Closure that receives the $app and $config variables. The resolver Closure must return an instance of League\Flysystem\Filesystem. The $config variable contains the values defined in config/filesystems.php for the specified disk.</p>
	<p>Once you have created the service provider to register the extension, you may use the dropbox driver in your config/filesystems.php configuration file.</p>
</article>