CREATE USER 'admin'@'192.168.50.4' identified by 'password';
GRANT ALL PRIVILEGES ON *.* TO 'admin'@'192.168.50.4';
FLUSH PRIVILEGES;
CREATE DATABASE Fii_auto;
