# Initial commands

# Installing Wordpress

$ curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar

$ php wp-cli.phar core download
$ php wp-cli.phar language core install pt_BR –activate
$ php wp-cli.phar --info

# Copy root files
Copy the files .editorconfig, wp-config.lcl.php, wp-config.tst.php, wp-config.prd.php to the root of your project
On this files, you will change the DB info to each especific environment
Also, change the website url and the tables prefix
Use the following link (https://api.wordpress.org/secret-key/1.1/salt/) to generate wordpress salts - change them on your wp-config files

Copy and rename the file for your environment to initialize the website - wp-config.lcl.php -> wp-config.php to initialize localhost website

# Adding submodules

$ git submodule add https://github.com/vinigarcia87/storms-framework.git wp-content/plugins/storms-framework
$ git submodule add https://github.com/vinigarcia87/storms-woocommerce-pagseguro-fields-api.git wp-content/plugins/storms-woocommerce-pagseguro-fields-api
$ git submodule add https://github.com/vinigarcia87/storms-woocommerce-receipt.git wp-content/plugins/storms-woocommerce-receipt
$ git submodule add https://github.com/vinigarcia87/storms-woocommerce-disable-products.git wp-content/plugins/storms-woocommerce-disable-products
$ git submodule add https://github.com/vinigarcia87/storms-woocommerce-calculost.git wp-content/plugins/storms-woocommerce-calculost
$ git submodule add https://github.com/vinigarcia87/storms-woocommerce-ping-api.git wp-content/plugins/storms-woocommerce-ping-api

$ git submodule add https://github.com/vinigarcia87/storms-theme.git wp-content/themes/storms-theme

// Also, run the following command, to add your theme as submodule
$ git submodule add https://github.com/vinigarcia87/storms-mycustomwebsite.git wp-content/themes/storms-mycustomwebsite

# Configuring httpd-vhosts.config

Add this lines on C:\Windows\System32\drivers\etc\hosts file

127.0.0.1	mycustomwebsite.dev.br
::1 mycustomwebsite.dev.br

Add this block on c:\wamp64\bin\apache\apache2.4.41\conf\extra\httpd-vhosts.conf file

<VirtualHost *:80>
	ServerName mycustomwebsite.dev.br
	DocumentRoot "c:/wamp64/www/mycustomwebsite"
	<Directory  "c:/wamp64/www/mycustomwebsite/">
		Options +Indexes +Includes +FollowSymLinks +MultiViews
		AllowOverride All
		Require local
	</Directory>
</VirtualHost>


