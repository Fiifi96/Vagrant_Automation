$scipt_web = <<-SCRIPT
sudo apt update
echo "y" | sudo apt install apache2
echo "y" | sudo ufw enable
sudo ufw allow http
sudo ufw allow ssh
sudo apt install php libapache2-mod-php
sudo systemctl restart apache2
apt-get install mysql-client -y
SCRIPT

$mysql_install_client = <<-SCRIPT
sudo apt update
echo "y" | sudo apt install mysql-server
echo "y" | sudo ufw enable
sudo ufw allow mysql
sudo ufw allow ssh
sed -i "s/.*bind-address.*/bind-address = 0.0.0.0/g" /etc/mysql/mysql.conf.d/mysqld.cnf
sudo mysql < /vagrant/mysql_conf.sql
sudo service mysql restart 
SCRIPT



Vagrant.configure("2") do |config|
 
  config.vm.box = "bento/ubuntu-20.04"
  config.vm.synced_folder ".", "/vagrant/"
  config.vm.provider "virtualbox" do |v|
    v.linked_clone = true
    v.memory = 1024
    v.cpus = 1
  end  

  config.vm.define "web" do |web|
    web.vm.hostname = "web"
    #web.vm.network "public_network"
    web.vm.network "private_network", ip: "192.168.50.4";
    web.vm.provision "shell" , inline: $scipt_web
    web.vm.provision "file", source: "/Users/Fiifi/Fii_code/local_lab/index.php", destination: "~/index.php"
    web.vm.provision "shell" , inline: "sudo cp index.php /var/www/html/index.php"
    # web.vm.provision "shell" , inline: "sudo rm /var/www/html/index.html "
    #sudo mysql -h 192.168.50.5 -u admin -p
  end

  config.vm.define "db" do |db|
    db.vm.hostname = "mysql"
    db.vm.network "forwarded_port", guest: 3306, host: 3306
    #db.vm.network "public_network"
    db.vm.network "private_network", ip: "192.168.50.5";
    #db.vm.provision "file", source: "/Users/Fiifi/Fii_code/local_lab/bootstrap.sh", destination: "~/bootstrap.sh"
    #db.vm.provision "shell" , inline: "sudo cp ~/bootstrap.sh /tmp/"
    db.vm.provision "shell" , inline: $mysql_install_client
  end

end
