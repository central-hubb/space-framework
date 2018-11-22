<article>
	<h1>File Storage</h1>
	<h2>Introduction</h2>
	<p>Space MVC provides a powerful filesystem abstraction thanks to the wonderful <a href="https://github.com/thephpleague/flysystem">Flysystem</a> PHP package by Frank de Jonge. The Space MVC Flysystem integration provides simple to use drivers for working with local filesystems, Amazon S3, and Rackspace Cloud Storage. Even better, it's amazingly simple to switch between these storage options as the API remains the same for each system.</p>
	<p><a name="configuration"></a></p>
	<h2><a href="#configuration">Configuration</a></h2>
	<p>The filesystem configuration file is located at <code class=" language-php">config<span class="token operator">/</span>filesystems<span class="token punctuation">.</span>php</code>. Within this file you may configure all of your "disks". Each disk represents a particular storage driver and storage location. Example configurations for each supported driver are included in the configuration file. So, modify the configuration to reflect your storage preferences and credentials.</p>
	<p>Of course, you may configure as many disks as you like, and may even have multiple disks that use the same driver.</p>
	<p><a name="the-public-disk"></a></p>
	<h3>The Public Disk</h3>
	<p>The <code class=" language-php"><span class="token keyword">public</span></code> disk is intended for files that are going to be publicly accessible. By default, the <code class=" language-php"><span class="token keyword">public</span></code> disk uses the <code class=" language-php">local</code> driver and stores these files in <code class=" language-php">storage<span class="token operator">/</span>app<span class="token operator">/</span><span class="token keyword">public</span></code>. To make them accessible from the web, you should create a symbolic link from <code class=" language-php"><span class="token keyword">public</span><span class="token operator">/</span>storage</code> to <code class=" language-php">storage<span class="token operator">/</span>app<span class="token operator">/</span><span class="token keyword">public</span></code>. This convention will keep your publicly accessible files in one directory that can be easily shared across deployments when using zero down-time deployment systems like <a href="https://envoyer.io">Envoyer</a>.</p>
	<p>To create the symbolic link, you may use the <code class=" language-php">storage<span class="token punctuation">:</span>link</code> Artisan command:</p>
	<pre class=" language-php"><code class=" language-php">php artisan storage<span class="token punctuation">:</span>link</code></pre>
	<p>Of course, once a file has been stored and the symbolic link has been created, you can create a URL to the files using the <code class=" language-php">asset</code> helper:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">echo</span> <span class="token function">asset<span class="token punctuation">(</span></span><span class="token string">'storage/file.txt'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="the-local-driver"></a></p>
	<h3>The Local Driver</h3>
	<p>When using the <code class=" language-php">local</code> driver, all file operations are relative to the <code class=" language-php">root</code> directory defined in your configuration file. By default, this value is set to the <code class=" language-php">storage<span class="token operator">/</span>app</code> directory. Therefore, the following method would store a file in <code class=" language-php">storage<span class="token operator">/</span>app<span class="token operator">/</span>file<span class="token punctuation">.</span>txt</code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">disk<span class="token punctuation">(</span></span><span class="token string">'local'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">put<span class="token punctuation">(</span></span><span class="token string">'file.txt'</span><span class="token punctuation">,</span> <span class="token string">'Contents'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="driver-prerequisites"></a></p>
	<h3>Driver Prerequisites</h3>
	<h4>Composer Packages</h4>
	<p>Before using the SFTP, S3, or Rackspace drivers, you will need to install the appropriate package via Composer:</p>
	<ul>
		<li>SFTP: <code class=" language-php">league<span class="token operator">/</span>flysystem<span class="token operator">-</span>sftp <span class="token operator">~</span><span class="token number">1.0</span></code></li>
		<li>Amazon S3: <code class=" language-php">league<span class="token operator">/</span>flysystem<span class="token operator">-</span>aws<span class="token operator">-</span>s3<span class="token operator">-</span>v3 <span class="token operator">~</span><span class="token number">1.0</span></code></li>
		<li>Rackspace: <code class=" language-php">league<span class="token operator">/</span>flysystem<span class="token operator">-</span>rackspace <span class="token operator">~</span><span class="token number">1.0</span></code></li>
	</ul>
	<p>An absolute must for performance is to use a cached adapter. You will need an additional package for this:</p>
	<ul>
		<li>CachedAdapter: <code class=" language-php">league<span class="token operator">/</span>flysystem<span class="token operator">-</span>cached<span class="token operator">-</span>adapter <span class="token operator">~</span><span class="token number">1.0</span></code></li>
	</ul>
	<h4>S3 Driver Configuration</h4>
	<p>The S3 driver configuration information is located in your <code class=" language-php">config<span class="token operator">/</span>filesystems<span class="token punctuation">.</span>php</code> configuration file. This file contains an example configuration array for an S3 driver. You are free to modify this array with your own S3 configuration and credentials. For convenience, these environment variables match the naming convention used by the AWS CLI.</p>
	<h4>FTP Driver Configuration</h4>
	<p>Space MVC's Flysystem integrations works great with FTP; however, a sample configuration is not included with the framework's default <code class=" language-php">filesystems<span class="token punctuation">.</span>php</code> configuration file. If you need to configure a FTP filesystem, you may use the example configuration below:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'ftp'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
    <span class="token string">'driver'</span>   <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'ftp'</span><span class="token punctuation">,</span>
    <span class="token string">'host'</span>     <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'ftp.example.com'</span><span class="token punctuation">,</span>
    <span class="token string">'username'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'your-username'</span><span class="token punctuation">,</span>
    <span class="token string">'password'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'your-password'</span><span class="token punctuation">,</span>

   <span class="token comment" spellcheck="true"> // Optional FTP Settings...
</span>   <span class="token comment" spellcheck="true"> // 'port'     =&gt; 21,
</span>   <span class="token comment" spellcheck="true"> // 'root'     =&gt; '',
</span>   <span class="token comment" spellcheck="true"> // 'passive'  =&gt; true,
</span>   <span class="token comment" spellcheck="true"> // 'ssl'      =&gt; true,
</span>   <span class="token comment" spellcheck="true"> // 'timeout'  =&gt; 30,
</span><span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<h4>SFTP Driver Configuration</h4>
	<p>Space MVC's Flysystem integrations works great with SFTP; however, a sample configuration is not included with the framework's default <code class=" language-php">filesystems<span class="token punctuation">.</span>php</code> configuration file. If you need to configure a SFTP filesystem, you may use the example configuration below:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'sftp'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
    <span class="token string">'driver'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'sftp'</span><span class="token punctuation">,</span>
    <span class="token string">'host'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'example.com'</span><span class="token punctuation">,</span>
    <span class="token string">'username'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'your-username'</span><span class="token punctuation">,</span>
    <span class="token string">'password'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'your-password'</span><span class="token punctuation">,</span>

   <span class="token comment" spellcheck="true"> // Settings for SSH key based authentication...
</span>   <span class="token comment" spellcheck="true"> // 'privateKey' =&gt; '/path/to/privateKey',
</span>   <span class="token comment" spellcheck="true"> // 'password' =&gt; 'encryption-password',
</span>
   <span class="token comment" spellcheck="true"> // Optional SFTP Settings...
</span>   <span class="token comment" spellcheck="true"> // 'port' =&gt; 22,
</span>   <span class="token comment" spellcheck="true"> // 'root' =&gt; '',
</span>   <span class="token comment" spellcheck="true"> // 'timeout' =&gt; 30,
</span><span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<h4>Rackspace Driver Configuration</h4>
	<p>Space MVC's Flysystem integrations works great with Rackspace; however, a sample configuration is not included with the framework's default <code class=" language-php">filesystems<span class="token punctuation">.</span>php</code> configuration file. If you need to configure a Rackspace filesystem, you may use the example configuration below:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'rackspace'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
    <span class="token string">'driver'</span>    <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'rackspace'</span><span class="token punctuation">,</span>
    <span class="token string">'username'</span>  <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'your-username'</span><span class="token punctuation">,</span>
    <span class="token string">'key'</span>       <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'your-key'</span><span class="token punctuation">,</span>
    <span class="token string">'container'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'your-container'</span><span class="token punctuation">,</span>
    <span class="token string">'endpoint'</span>  <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'https://identity.api.rackspacecloud.com/v2.0/'</span><span class="token punctuation">,</span>
    <span class="token string">'region'</span>    <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'IAD'</span><span class="token punctuation">,</span>
    <span class="token string">'url_type'</span>  <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'publicURL'</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<p><a name="caching"></a></p>
	<h3>Caching</h3>
	<p>To enable caching for a given disk, you may add a <code class=" language-php">cache</code> directive to the disk's configuration options. The <code class=" language-php">cache</code> option should be an array of caching options containing the <code class=" language-php">disk</code> name, the <code class=" language-php">expire</code> time in seconds, and the cache <code class=" language-php">prefix</code>:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'s3'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
    <span class="token string">'driver'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'s3'</span><span class="token punctuation">,</span>

   <span class="token comment" spellcheck="true"> // Other Disk Options...
</span>
    <span class="token string">'cache'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
        <span class="token string">'store'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'memcached'</span><span class="token punctuation">,</span>
        <span class="token string">'expire'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token number">600</span><span class="token punctuation">,</span>
        <span class="token string">'prefix'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'cache-prefix'</span><span class="token punctuation">,</span>
    <span class="token punctuation">]</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<p><a name="obtaining-disk-instances"></a></p>
	<h2><a href="#obtaining-disk-instances">Obtaining Disk Instances</a></h2>
	<p>The <code class=" language-php">Storage</code> facade may be used to interact with any of your configured disks. For example, you may use the <code class=" language-php">put</code> method on the facade to store an avatar on the default disk. If you call methods on the <code class=" language-php">Storage</code> facade without first calling the <code class=" language-php">disk</code> method, the method call will automatically be passed to the default disk:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>Storage</span><span class="token punctuation">;</span>

<span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">put<span class="token punctuation">(</span></span><span class="token string">'avatars/1'</span><span class="token punctuation">,</span> <span class="token variable">$fileContents</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>If your applications interacts with multiple disks, you may use the <code class=" language-php">disk</code> method on the <code class=" language-php">Storage</code> facade to work with files on a particular disk:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">disk<span class="token punctuation">(</span></span><span class="token string">'s3'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">put<span class="token punctuation">(</span></span><span class="token string">'avatars/1'</span><span class="token punctuation">,</span> <span class="token variable">$fileContents</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="retrieving-files"></a></p>
	<h2><a href="#retrieving-files">Retrieving Files</a></h2>
	<p>The <code class=" language-php">get</code> method may be used to retrieve the contents of a file. The raw string contents of the file will be returned by the method. Remember, all file paths should be specified relative to the "root" location configured for the disk:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$contents</span> <span class="token operator">=</span> <span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'file.jpg'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>The <code class=" language-php">exists</code> method may be used to determine if a file exists on the disk:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$exists</span> <span class="token operator">=</span> <span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">disk<span class="token punctuation">(</span></span><span class="token string">'s3'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">exists<span class="token punctuation">(</span></span><span class="token string">'file.jpg'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="downloading-files"></a></p>
	<h3>Downloading Files</h3>
	<p>The <code class=" language-php">download</code> method may be used to generate a response that forces the user's browser to download the file at the given path. The <code class=" language-php">download</code> method accepts a file name as the second argument to the method, which will determine the file name that is seen by the user downloading the file. Finally, you may pass an array of HTTP headers as the third argument to the method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">download<span class="token punctuation">(</span></span><span class="token string">'file.jpg'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token keyword">return</span> <span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">download<span class="token punctuation">(</span></span><span class="token string">'file.jpg'</span><span class="token punctuation">,</span> <span class="token variable">$name</span><span class="token punctuation">,</span> <span class="token variable">$headers</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="file-urls"></a></p>
	<h3>File URLs</h3>
	<p>You may use the <code class=" language-php">url</code> method to get the URL for the given file. If you are using the <code class=" language-php">local</code> driver, this will typically just prepend <code class=" language-php"><span class="token operator">/</span>storage</code> to the given path and return a relative URL to the file. If you are using the <code class=" language-php">s3</code> or <code class=" language-php">rackspace</code> driver, the fully qualified remote URL will be returned:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>Storage</span><span class="token punctuation">;</span>

<span class="token variable">$url</span> <span class="token operator">=</span> <span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">url<span class="token punctuation">(</span></span><span class="token string">'file.jpg'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<blockquote class="has-icon">
		<p class="note"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="90px" height="90px" viewBox="0 0 90 90" enable-background="new 0 0 90 90" xml:space="preserve"><path fill="#FFFFFF" d="M45 0C20.1 0 0 20.1 0 45s20.1 45 45 45 45-20.1 45-45S69.9 0 45 0zM45 74.5c-3.6 0-6.5-2.9-6.5-6.5s2.9-6.5 6.5-6.5 6.5 2.9 6.5 6.5S48.6 74.5 45 74.5zM52.1 23.9l-2.5 29.6c0 2.5-2.1 4.6-4.6 4.6 -2.5 0-4.6-2.1-4.6-4.6l-2.5-29.6c-0.1-0.4-0.1-0.7-0.1-1.1 0-4 3.2-7.2 7.2-7.2 4 0 7.2 3.2 7.2 7.2C52.2 23.1 52.2 23.5 52.1 23.9z"></path></svg></span></div> Remember, if you are using the <code class=" language-php">local</code> driver, all files that should be publicly accessible should be placed in the <code class=" language-php">storage<span class="token operator">/</span>app<span class="token operator">/</span><span class="token keyword">public</span></code> directory. Furthermore, you should <a href="#the-public-disk">create a symbolic link</a> at <code class=" language-php"><span class="token keyword">public</span><span class="token operator">/</span>storage</code> which points to the <code class=" language-php">storage<span class="token operator">/</span>app<span class="token operator">/</span><span class="token keyword">public</span></code> directory.</p>
	</blockquote>
	<h4>Temporary URLs</h4>
	<p>For files stored using the <code class=" language-php">s3</code> or <code class=" language-php">rackspace</code> driver, you may create a temporary URL to a given file using the <code class=" language-php">temporaryUrl</code> method. This methods accepts a path and a <code class=" language-php">DateTime</code> instance specifying when the URL should expire:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$url</span> <span class="token operator">=</span> <span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">temporaryUrl<span class="token punctuation">(</span></span>
    <span class="token string">'file.jpg'</span><span class="token punctuation">,</span> <span class="token function">now<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">addMinutes<span class="token punctuation">(</span></span><span class="token number">5</span><span class="token punctuation">)</span>
<span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Local URL Host Customization</h4>
	<p>If you would like to pre-define the host for files stored on a disk using the <code class=" language-php">local</code> driver, you may add a <code class=" language-php">url</code> option to the disk's configuration array:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token string">'public'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
    <span class="token string">'driver'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'local'</span><span class="token punctuation">,</span>
    <span class="token string">'root'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">storage_path<span class="token punctuation">(</span></span><span class="token string">'app/public'</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
    <span class="token string">'url'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">env<span class="token punctuation">(</span></span><span class="token string">'APP_URL'</span><span class="token punctuation">)</span><span class="token punctuation">.</span><span class="token string">'/storage'</span><span class="token punctuation">,</span>
    <span class="token string">'visibility'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'public'</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
	<p><a name="file-metadata"></a></p>
	<h3>File Metadata</h3>
	<p>In addition to reading and writing files, Space MVC can also provide information about the files themselves. For example, the <code class=" language-php">size</code> method may be used to get the size of the file in bytes:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>Storage</span><span class="token punctuation">;</span>

<span class="token variable">$size</span> <span class="token operator">=</span> <span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">size<span class="token punctuation">(</span></span><span class="token string">'file.jpg'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>The <code class=" language-php">lastModified</code> method returns the UNIX timestamp of the last time the file was modified:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$time</span> <span class="token operator">=</span> <span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">lastModified<span class="token punctuation">(</span></span><span class="token string">'file.jpg'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="storing-files"></a></p>
	<h2><a href="#storing-files">Storing Files</a></h2>
	<p>The <code class=" language-php">put</code> method may be used to store raw file contents on a disk. You may also pass a PHP <code class=" language-php">resource</code> to the <code class=" language-php">put</code> method, which will use Flysystem's underlying stream support. Using streams is greatly recommended when dealing with large files:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>Storage</span><span class="token punctuation">;</span>

<span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">put<span class="token punctuation">(</span></span><span class="token string">'file.jpg'</span><span class="token punctuation">,</span> <span class="token variable">$contents</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">put<span class="token punctuation">(</span></span><span class="token string">'file.jpg'</span><span class="token punctuation">,</span> <span class="token variable">$resource</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Automatic Streaming</h4>
	<p>If you would like Space MVC to automatically manage streaming a given file to your storage location, you may use the <code class=" language-php">putFile</code> or <code class=" language-php">putFileAs</code> method. This method accepts either a <code class=" language-php">Illuminate\<span class="token package">Http<span class="token punctuation">\</span>File</span></code> or <code class=" language-php">Illuminate\<span class="token package">Http<span class="token punctuation">\</span>UploadedFile</span></code> instance and will automatically stream the file to your desired location:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>File</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>Storage</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// Automatically generate a unique ID for file name...
</span><span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">putFile<span class="token punctuation">(</span></span><span class="token string">'photos'</span><span class="token punctuation">,</span> <span class="token keyword">new</span> <span class="token class-name">File</span><span class="token punctuation">(</span><span class="token string">'/path/to/photo'</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// Manually specify a file name...
</span><span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">putFileAs<span class="token punctuation">(</span></span><span class="token string">'photos'</span><span class="token punctuation">,</span> <span class="token keyword">new</span> <span class="token class-name">File</span><span class="token punctuation">(</span><span class="token string">'/path/to/photo'</span><span class="token punctuation">)</span><span class="token punctuation">,</span> <span class="token string">'photo.jpg'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>There are a few important things to note about the <code class=" language-php">putFile</code> method. Note that we only specified a directory name, not a file name. By default, the <code class=" language-php">putFile</code> method will generate a unique ID to serve as the file name. The file's extension will be determined by examining the file's MIME type. The path to the file will be returned by the <code class=" language-php">putFile</code> method so you can store the path, including the generated file name, in your database.</p>
	<p>The <code class=" language-php">putFile</code> and <code class=" language-php">putFileAs</code> methods also accept an argument to specify the "visibility" of the stored file. This is particularly useful if you are storing the file on a cloud disk such as S3 and would like the file to be publicly accessible:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">putFile<span class="token punctuation">(</span></span><span class="token string">'photos'</span><span class="token punctuation">,</span> <span class="token keyword">new</span> <span class="token class-name">File</span><span class="token punctuation">(</span><span class="token string">'/path/to/photo'</span><span class="token punctuation">)</span><span class="token punctuation">,</span> <span class="token string">'public'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Prepending &amp; Appending To Files</h4>
	<p>The <code class=" language-php">prepend</code> and <code class=" language-php">append</code> methods allow you to write to the beginning or end of a file:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">prepend<span class="token punctuation">(</span></span><span class="token string">'file.log'</span><span class="token punctuation">,</span> <span class="token string">'Prepended Text'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">append<span class="token punctuation">(</span></span><span class="token string">'file.log'</span><span class="token punctuation">,</span> <span class="token string">'Appended Text'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Copying &amp; Moving Files</h4>
	<p>The <code class=" language-php">copy</code> method may be used to copy an existing file to a new location on the disk, while the <code class=" language-php">move</code> method may be used to rename or move an existing file to a new location:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">copy<span class="token punctuation">(</span></span><span class="token string">'old/file.jpg'</span><span class="token punctuation">,</span> <span class="token string">'new/file.jpg'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">move<span class="token punctuation">(</span></span><span class="token string">'old/file.jpg'</span><span class="token punctuation">,</span> <span class="token string">'new/file.jpg'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="file-uploads"></a></p>
	<h3>File Uploads</h3>
	<p>In web applications, one of the most common use-cases for storing files is storing user uploaded files such as profile pictures, photos, and documents. Space MVC makes it very easy to store uploaded files using the <code class=" language-php">store</code> method on an uploaded file instance. Call the <code class=" language-php">store</code> method with the path at which you wish to store the uploaded file:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Controllers</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Request</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Controllers<span class="token punctuation">\</span>Controller</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">UserAvatarController</span> <span class="token keyword">extends</span> <span class="token class-name">Controller</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Update the avatar for the user.
     *
     * @param  Request  $request
     * @return Response
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">update<span class="token punctuation">(</span></span>Request <span class="token variable">$request</span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token variable">$path</span> <span class="token operator">=</span> <span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">file<span class="token punctuation">(</span></span><span class="token string">'avatar'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">store<span class="token punctuation">(</span></span><span class="token string">'avatars'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

        <span class="token keyword">return</span> <span class="token variable">$path</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p>There are a few important things to note about this example. Note that we only specified a directory name, not a file name. By default, the <code class=" language-php">store</code> method will generate a unique ID to serve as the file name. The file's extension will be determined by examining the file's MIME type. The path to the file will be returned by the <code class=" language-php">store</code> method so you can store the path, including the generated file name, in your database.</p>
	<p>You may also call the <code class=" language-php">putFile</code> method on the <code class=" language-php">Storage</code> facade to perform the same file manipulation as the example above:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$path</span> <span class="token operator">=</span> <span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">putFile<span class="token punctuation">(</span></span><span class="token string">'avatars'</span><span class="token punctuation">,</span> <span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">file<span class="token punctuation">(</span></span><span class="token string">'avatar'</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Specifying A File Name</h4>
	<p>If you would not like a file name to be automatically assigned to your stored file, you may use the <code class=" language-php">storeAs</code> method, which receives the path, the file name, and the (optional) disk as its arguments:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$path</span> <span class="token operator">=</span> <span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">file<span class="token punctuation">(</span></span><span class="token string">'avatar'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">storeAs<span class="token punctuation">(</span></span>
    <span class="token string">'avatars'</span><span class="token punctuation">,</span> <span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">user<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">id</span>
<span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>Of course, you may also use the <code class=" language-php">putFileAs</code> method on the <code class=" language-php">Storage</code> facade, which will perform the same file manipulation as the example above:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$path</span> <span class="token operator">=</span> <span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">putFileAs<span class="token punctuation">(</span></span>
    <span class="token string">'avatars'</span><span class="token punctuation">,</span> <span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">file<span class="token punctuation">(</span></span><span class="token string">'avatar'</span><span class="token punctuation">)</span><span class="token punctuation">,</span> <span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">user<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">id</span>
<span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Specifying A Disk</h4>
	<p>By default, this method will use your default disk. If you would like to specify another disk, pass the disk name as the second argument to the <code class=" language-php">store</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$path</span> <span class="token operator">=</span> <span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">file<span class="token punctuation">(</span></span><span class="token string">'avatar'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">store<span class="token punctuation">(</span></span>
    <span class="token string">'avatars/'</span><span class="token punctuation">.</span><span class="token variable">$request</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">user<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">id</span><span class="token punctuation">,</span> <span class="token string">'s3'</span>
<span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="file-visibility"></a></p>
	<h3>File Visibility</h3>
	<p>In Space MVC's Flysystem integration, "visibility" is an abstraction of file permissions across multiple platforms. Files may either be declared <code class=" language-php"><span class="token keyword">public</span></code> or <code class=" language-php"><span class="token keyword">private</span></code>. When a file is declared <code class=" language-php"><span class="token keyword">public</span></code>, you are indicating that the file should generally be accessible to others. For example, when using the S3 driver, you may retrieve URLs for <code class=" language-php"><span class="token keyword">public</span></code> files.</p>
	<p>You can set the visibility when setting the file via the <code class=" language-php">put</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>Storage</span><span class="token punctuation">;</span>

<span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">put<span class="token punctuation">(</span></span><span class="token string">'file.jpg'</span><span class="token punctuation">,</span> <span class="token variable">$contents</span><span class="token punctuation">,</span> <span class="token string">'public'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>If the file has already been stored, its visibility can be retrieved and set via the <code class=" language-php">getVisibility</code> and <code class=" language-php">setVisibility</code> methods:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$visibility</span> <span class="token operator">=</span> <span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">getVisibility<span class="token punctuation">(</span></span><span class="token string">'file.jpg'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">setVisibility<span class="token punctuation">(</span></span><span class="token string">'file.jpg'</span><span class="token punctuation">,</span> <span class="token string">'public'</span><span class="token punctuation">)</span></code></pre>
	<p><a name="deleting-files"></a></p>
	<h2><a href="#deleting-files">Deleting Files</a></h2>
	<p>The <code class=" language-php">delete</code> method accepts a single filename or an array of files to remove from the disk:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>Storage</span><span class="token punctuation">;</span>

<span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">delete<span class="token punctuation">(</span></span><span class="token string">'file.jpg'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">delete<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'file.jpg'</span><span class="token punctuation">,</span> <span class="token string">'file2.jpg'</span><span class="token punctuation">]</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p>If necessary, you may specify the disk that the file should be deleted from:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>Storage</span><span class="token punctuation">;</span>

<span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">disk<span class="token punctuation">(</span></span><span class="token string">'s3'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">delete<span class="token punctuation">(</span></span><span class="token string">'folder_path/file_name.jpg'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="directories"></a></p>
	<h2><a href="#directories">Directories</a></h2>
	<h4>Get All Files Within A Directory</h4>
	<p>The <code class=" language-php">files</code> method returns an array of all of the files in a given directory. If you would like to retrieve a list of all files within a given directory including all sub-directories, you may use the <code class=" language-php">allFiles</code> method:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>Facades<span class="token punctuation">\</span>Storage</span><span class="token punctuation">;</span>

<span class="token variable">$files</span> <span class="token operator">=</span> <span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">files<span class="token punctuation">(</span></span><span class="token variable">$directory</span><span class="token punctuation">)</span><span class="token punctuation">;</span>

<span class="token variable">$files</span> <span class="token operator">=</span> <span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">allFiles<span class="token punctuation">(</span></span><span class="token variable">$directory</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Get All Directories Within A Directory</h4>
	<p>The <code class=" language-php">directories</code> method returns an array of all the directories within a given directory. Additionally, you may use the <code class=" language-php">allDirectories</code> method to get a list of all directories within a given directory and all of its sub-directories:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token variable">$directories</span> <span class="token operator">=</span> <span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">directories<span class="token punctuation">(</span></span><span class="token variable">$directory</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// Recursive...
</span><span class="token variable">$directories</span> <span class="token operator">=</span> <span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">allDirectories<span class="token punctuation">(</span></span><span class="token variable">$directory</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Create A Directory</h4>
	<p>The <code class=" language-php">makeDirectory</code> method will create the given directory, including any needed sub-directories:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">makeDirectory<span class="token punctuation">(</span></span><span class="token variable">$directory</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<h4>Delete A Directory</h4>
	<p>Finally, the <code class=" language-php">deleteDirectory</code> may be used to remove a directory and all of its files:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">deleteDirectory<span class="token punctuation">(</span></span><span class="token variable">$directory</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	<p><a name="custom-filesystems"></a></p>
	<h2><a href="#custom-filesystems">Custom Filesystems</a></h2>
	<p>Space MVC's Flysystem integration provides drivers for several "drivers" out of the box; however, Flysystem is not limited to these and has adapters for many other storage systems. You can create a custom driver if you want to use one of these additional adapters in your Space MVC application.</p>
	<p>In order to set up the custom filesystem you will need a Flysystem adapter. Let's add a community maintained Dropbox adapter to our project:</p>
	<pre class=" language-php"><code class=" language-php">composer <span class="token keyword">require</span> spatie<span class="token operator">/</span>flysystem<span class="token operator">-</span>dropbox</code></pre>
	<p>Next, you should create a <a href="/docs/5.7/providers">service provider</a> such as <code class=" language-php">DropboxServiceProvider</code>. In the provider's <code class=" language-php">boot</code> method, you may use the <code class=" language-php">Storage</code> facade's <code class=" language-php">extend</code> method to define the custom driver:</p>
	<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Providers</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Storage</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">League<span class="token punctuation">\</span>Flysystem<span class="token punctuation">\</span>Filesystem</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Illuminate<span class="token punctuation">\</span>Support<span class="token punctuation">\</span>ServiceProvider</span><span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Spatie<span class="token punctuation">\</span>Dropbox<span class="token punctuation">\</span>Client</span> <span class="token keyword">as</span> DropboxClient<span class="token punctuation">;</span>
<span class="token keyword">use</span> <span class="token package">Spatie<span class="token punctuation">\</span>FlysystemDropbox<span class="token punctuation">\</span>DropboxAdapter</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">DropboxServiceProvider</span> <span class="token keyword">extends</span> <span class="token class-name">ServiceProvider</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Perform post-registration booting of services.
     *
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">boot<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token scope">Storage<span class="token punctuation">::</span></span><span class="token function">extend<span class="token punctuation">(</span></span><span class="token string">'dropbox'</span><span class="token punctuation">,</span> <span class="token keyword">function</span> <span class="token punctuation">(</span><span class="token variable">$app</span><span class="token punctuation">,</span> <span class="token variable">$config</span><span class="token punctuation">)</span> <span class="token punctuation">{</span>
            <span class="token variable">$client</span> <span class="token operator">=</span> <span class="token keyword">new</span> <span class="token class-name">DropboxClient</span><span class="token punctuation">(</span>
                <span class="token variable">$config</span><span class="token punctuation">[</span><span class="token string">'authorization_token'</span><span class="token punctuation">]</span>
            <span class="token punctuation">)</span><span class="token punctuation">;</span>

            <span class="token keyword">return</span> <span class="token keyword">new</span> <span class="token class-name">Filesystem</span><span class="token punctuation">(</span><span class="token keyword">new</span> <span class="token class-name">DropboxAdapter</span><span class="token punctuation">(</span><span class="token variable">$client</span><span class="token punctuation">)</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
        <span class="token punctuation">}</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>

    <span class="token comment" spellcheck="true">/**
     * Register bindings in the container.
     *
     * @return void
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">register<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
       <span class="token comment" spellcheck="true"> //
</span>    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
	<p>The first argument of the <code class=" language-php">extend</code> method is the name of the driver and the second is a Closure that receives the <code class=" language-php"><span class="token variable">$app</span></code> and <code class=" language-php"><span class="token variable">$config</span></code> variables. The resolver Closure must return an instance of <code class=" language-php">League\<span class="token package">Flysystem<span class="token punctuation">\</span>Filesystem</span></code>. The <code class=" language-php"><span class="token variable">$config</span></code> variable contains the values defined in <code class=" language-php">config<span class="token operator">/</span>filesystems<span class="token punctuation">.</span>php</code> for the specified disk.</p>
	<p>Once you have created the service provider to register the extension, you may use the <code class=" language-php">dropbox</code> driver in your <code class=" language-php">config<span class="token operator">/</span>filesystems<span class="token punctuation">.</span>php</code> configuration file.</p>
</article>