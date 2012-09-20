MilmSearch UI PHP
=======================

Introduction
------------
This is a UI Application written by PHP for MilmSearch that is 
a Mailing List Search System.

Installation
------------

Virtual Host
------------
Set up a virtual host to point to the public/ directory.

Setting up the virtual host is usually done within httpd.conf, 
extra/httpd-vhosts.conf or the file which matched your environment.

Ensure that NameVirtualHost is deﬁned and set to “*:80” or similar, 
and then deﬁne a virtual host along these lines:

```
<VirtualHost *:80>
    ServerName yourdomain
    DocumentRoot /path/to/milm-search-ui-php/public
    SetEnv APPLICATION_ENV "production"
    <Directory /path/to/milm-search-ui-php/public>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
```


