# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

  config.vm.box = "debian/stretch64"

  config.vm.hostname = "gupek"

  config.vm.synced_folder "./", "/var/www/gupek"

  config.vm.provider :lxc do |lxc|
    lxc.customize 'cgroup.cpuset.cpus', '1'
    lxc.customize 'cgroup.memory.limit_in_bytes', '1024M'
  end

#  config.vm.provision "shell" do |s|
#    s.inline = "apt-get --yes install aptitude; aptitude update; aptitude --assume-yes safe-upgrade; aptitude --assume-yes install php7.0-cli php7.0-curl php7.0-fpm php7.0-intl php7.0-json php7.0-mysql php7.0-xml php7.0-zip php-xdebug git"
#  end

  config.vm.provision "shell", inline: <<-SHELL
    apt-get --yes install aptitude
    aptitude update
    aptitude --assume-yes safe-upgrade
    aptitude --assume-yes install php7.0-cli php7.0-curl php7.0-fpm php7.0-intl php7.0-json php7.0-mysql php7.0-xml php7.0-zip php-xdebug git
    aptitude install nginx-full
    aptitude --assume-yes install mariadb-server
    mysql -u root --execute "CREATE DATABASE gupek;"
    mysql -u root --execute "GRANT ALL ON gupek.* TO gupek@localhost IDENTIFIED BY 'qwe123';"
  SHELL

end
