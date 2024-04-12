#!/bin/bash

#todo tao bien luu tru path cua file nay de lam path co so

---------------------------


# serve website: cd ../../../ && /usr/bin/php7.4 -S localhost:8000

which php7.4 
# result: /usr/bin/php7.4

/usr/bin/php7.4 /usr/bin/composer update
# php composer update se ko tuong minh phien ban php nao


# Tao symbol link
rm -rf /var/www/pj_wordpress/assets
ln -s /var/www/pj_wordpress/wp-content/themes/datlx/assets /var/www/pj_wordpress/