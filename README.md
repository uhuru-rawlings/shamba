### HOW TO RUN THE PROJECT
#### Localy
<ul>
<li>Have xampp, start xampp</li>
<li>move folder to inside <code>htdocs</code> folder</li>
<li>go to your browser an enter <code>http://127.0.0.1/project-folder-name/</code> to run</li>
<li>go back to the folder and look for <code>config.php</code> inside relapce <code>define('BASE_URL', 'http://127.0.0.1/shamba/');</code> with <code>define('BASE_URL', 'http://127.0.0.1/project-folder/');</code></li>
<li>You will need to look for this function <code>getActiveRecordId</code> it is in most of the file at the bottom(footer), replace <code>var url = 'http://127.0.0.1/shamba/';</code> with <code>var url = 'http://127.0.0.1/folder-name/';</code> the rest of the content of the url should remail the way they are.</li>
</ul>
#### Server
<ul>
<li>go back to the folder and look for <code>config.php</code> inside relapce <code>define('BASE_URL', 'http://127.0.0.1/shamba/');</code> with <code>define('BASE_URL', 'domain name');</code></li>
<li>You will need to look for this function <code>getActiveRecordId</code> it is in most of the file at the bottom(footer), replace <code>var url = 'http://127.0.0.1/shamba/';</code> with <code>var url = 'domain name';</code> the rest of the content of the url should remail the way they are.</li>
</ul>


#### Database connection
<ul>
<li>Go to <code>project-folder/database/Database.php</code> and update only <code>            } else {
                $this -> db_host     = "127.0.0.1";
                $this -> db_user     = "";
                $this -> db_password = "";
                $this -> db_name     = "";
            }</code></li>
</ul>