# infolink

## mengaktifkan dan memverifikasi modul sqlite3 dan pdo_sqlite di Apache2


php -v
sudo apt update
sudo apt install sqlite3 
sudo apt install php8.2-sqlite3

sudo nano /etc/php/8.2/apache2/php.ini

extension=pdo_sqlite
extension=sqlite3


extension=pdo_sqlite




Jika Anda menggunakan Composer, pastikan Anda telah menambahkan dependensi yang diperlukan dalam file composer.json dan menginstalnya:

{
    "require": {
        "ext-pdo_sqlite": "*"
    }
}



composer require phpmailer/phpmailer


sudo chown -R www-data:www-data /var/www/nama_aplikasi
sudo chmod -R 755 /var/www/nama_aplikasi

sudo systemctl restart apache2

