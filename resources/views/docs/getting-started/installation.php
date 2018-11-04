<article>
    <h1>Installation</h1>
    <p><a name="server-requirements"></a></p>
    <h3>Server Requirements</h3>
    <p>The Space MVC framework has a few system requirements:</p>
    <div class="content-list">
        <ul>
            <li>PHP &gt;= 7.0.0</li>
            <li>PDO PHP Extension</li>
            <li>Mysql Database</li>
        </ul>
    </div>
    <p><a name="installing-Space MVC"></a></p>
    <h3>Installing Framework</h3>
    <p>You can install Space CRM quite easily using github and composer.</p>
    <pre class=" language-php"><code class=" language-php">git clone https://github.com/central-hubb/space-framework.git</code></pre>
    <pre class=" language-php"><code class=" language-php">composer install</code></pre>
    <p><a name="web-server-configuration"></a></p>
    <h2><a href="#web-server-configuration">Web Server Configuration</a></h2>
    <h4>Apache</h4>
    <p>Space MVC includes a <code class=" language-php"><span class="token keyword">public</span><span
                    class="token operator">/</span><span class="token punctuation">.</span>htaccess</code> file that is
        used to provide URLs without the <code class=" language-php">index<span
                    class="token punctuation">.</span>php</code> front controller in the path. Before serving Space MVC
        with Apache, be sure to enable the <code class=" language-php">mod_rewrite</code> module so the <code
                class=" language-php"><span class="token punctuation">.</span>htaccess</code> file will be honored by
        the server.</p>
    <p>If the <code class=" language-php"><span class="token punctuation">.</span>htaccess</code> file that ships with
        Space MVC does not work with your Apache installation, try this alternative:</p>
    <pre class=" language-php"><code class=" language-php">Options <span
                    class="token operator">+</span>FollowSymLinks <span class="token operator">-</span>Indexes
RewriteEngine On

RewriteCond <span class="token operator">%</span><span class="token punctuation">{</span><span class="token constant">HTTP</span><span
                    class="token punctuation">:</span>Authorization<span class="token punctuation">}</span> <span
                    class="token punctuation">.</span>
RewriteRule <span class="token punctuation">.</span><span class="token operator">*</span> <span
                    class="token operator">-</span> <span class="token punctuation">[</span>E<span
                    class="token operator">=</span><span class="token constant">HTTP_AUTHORIZATION</span><span
                    class="token punctuation">:</span><span class="token operator">%</span><span
                    class="token punctuation">{</span><span class="token constant">HTTP</span><span
                    class="token punctuation">:</span>Authorization<span class="token punctuation">}</span><span
                    class="token punctuation">]</span>

RewriteCond <span class="token operator">%</span><span class="token punctuation">{</span><span class="token constant">REQUEST_FILENAME</span><span
                    class="token punctuation">}</span> <span class="token operator">!</span><span
                    class="token operator">-</span>d
RewriteCond <span class="token operator">%</span><span class="token punctuation">{</span><span class="token constant">REQUEST_FILENAME</span><span
                    class="token punctuation">}</span> <span class="token operator">!</span><span
                    class="token operator">-</span>f
RewriteRule <span class="token operator">^</span> index<span class="token punctuation">.</span>php <span
                    class="token punctuation">[</span>L<span class="token punctuation">]</span></code></pre>
    <h4>Nginx</h4>
    <p>If you are using Nginx, the following directive in your site configuration will direct all requests to the <code
                class=" language-php">index<span class="token punctuation">.</span>php</code> front controller:</p>
    <pre class=" language-php"><code class=" language-php">location <span class="token operator">/</span> <span
                    class="token punctuation">{</span>
    try_files <span class="token variable">$uri</span> <span class="token variable">$uri</span><span
                    class="token operator">/</span> <span class="token operator">/</span>index<span
                    class="token punctuation">.</span>php<span class="token operator">?</span><span
                    class="token variable">$query_string</span><span class="token punctuation">;</span>
<span class="token punctuation">}</span></code></pre>
</article>
