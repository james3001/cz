README
======

This directory should be used to place project specfic documentation including
but not limited to project notes, generated API/phpdoc documentation, or
manual files generated or hand written.  Ideally, this directory would remain
in your development environment only and should not be deployed with your
application to it's final production location.


Setting Up Your VHOST
=====================

The following is a sample VHOST you might want to consider for your project.

<VirtualHost *:80>
    ServerAdmin ernestex@gmail.com
    DocumentRoot "C:\cz\src\cz\public"
    ServerName cz
    ErrorLog "logs/cz-error.log"
    CustomLog "logs/cz-access.log" common
	<Directory "C:\cz\src\cz\public">
		Options Indexes FollowSymLinks
		AllowOverride all
		Order Allow,Deny
		Allow from all
	</Directory>	
</VirtualHost>