To set up the project on cPanel, follow these instructions:

**Running the Project Locally:**
1. Ensure you have XAMPP installed and running. Start XAMPP if it's not already running.
2. Move the project folder to the `htdocs` folder of your XAMPP installation.
3. Open your web browser and enter the following URL to run the project locally: `http://127.0.0.1/project-folder-name/`.
4. In the project folder, locate the `config.php` file. Replace `define('BASE_URL', 'http://127.0.0.1/shamba/');` with `define('BASE_URL', 'http://127.0.0.1/project-folder/');`.
5. Look for the `getActiveRecordId` function in most of the files (usually at the bottom, e.g., in the footer). Replace `var url = 'http://127.0.0.1/shamba/';` with `var url = 'http://127.0.0.1/folder-name/';`. Keep the rest of the URL content unchanged.

**Running the Project on a Server (cPanel):**
1. Upload the project folder to your web server using FTP or cPanel's file manager.
2. In the project folder, locate the `config.php` file. Replace `define('BASE_URL', 'http://127.0.0.1/shamba/');` with `define('BASE_URL', 'domain name');`.
3. Look for the `getActiveRecordId` function in most of the files (usually at the bottom, e.g., in the footer). Replace `var url = 'http://127.0.0.1/shamba/';` with `var url = 'domain name';`. Keep the rest of the URL content unchanged.

**Database Connection:**
1. Navigate to the `project-folder/database/Database.php` file.
2. Update the database connection settings based on your cPanel configuration. Modify the following lines:
   ```php
   $this -> db_host     = "127.0.0.1"; // Replace with your database host.
   $this -> db_user     = ""; // Replace with your database username.
   $this -> db_password = ""; // Replace with your database password.
   $this -> db_name     = ""; // Replace with your database name.
   ```
   
   Fill in the appropriate values for your cPanel-hosted database.

These instructions should help you set up and run your project on cPanel. Make sure to replace the placeholders with your actual domain name, database credentials, and project folder names as needed.
