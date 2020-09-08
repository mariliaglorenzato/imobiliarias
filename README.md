# imobiliarias

sudo touch /etc/sites-enabled/imobiliarias.conf
<VirtualHost *:80>
    ServerName www.imobmarilia.com
    DocumentRoot /var/www/imobiliarias/public/
</VirtualHost>

a2ensite imobiliarias -> habilitar
(a2dissite imobiliarias -> desabilitar)

systemctl reload apache2

/etc/hosts
127.0.0.1 localhost
127.0.0.1 www.imobmarilia.com


/etc/apache2/apache2.conf
<Directory /var/www/>
	Options Indexes FollowSymLinks
	AllowOverride All (geralmente fica "AllowOverride None")
	Require all granted
</Directory>


sudo a2enmod rewrite