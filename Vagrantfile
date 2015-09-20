# encoding: utf-8

Vagrant::configure("2") do |config|
  config.vm.box = "precise64"
  config.vm.network "forwarded_port", guest:80, host:3000
  config.vm.provision "shell", :inline => <<-SHELL
    apt-get update
    apt-get install -y puppet
  SHELL
  config.vm.provider :virtualbox do |vb|
            vb.name = "Ubuntu 1"
  end
  config.vm.provision :puppet
end
