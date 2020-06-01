# -*- mode: ruby -*-
# vi: set ft=ruby :

# Optimized for Vagrant 1.8 and above, which introduced `ansible_local` provisioner
# See https://github.com/hashicorp/vagrant/blob/v1.8.0/CHANGELOG.md
Vagrant.require_version '>= 1.8.0'

# See https://www.vagrantup.com/docs/other/environmental-variables.html#vagrant_no_parallel
ENV['VAGRANT_NO_PARALLEL'] = 'yes'

# @name: KirbyDev
# @author: S1SYYPHOS
# @version: v0.1
Vagrant.configure(2) do |config|
    # Settings
    conf = {
        name: 'KirbyDev',
        lts: '20.04',
        ip: '192.168.69.69',
        cpus: 1,
        memory: 512,
        ansible: '2.9.0',
        playbook: 'lib/playbook.yml',
    }

    # Basic VM settings
    config.vm.define conf[:name]
    config.vm.hostname = conf[:name]
    config.vm.box = 'bento/ubuntu-' + conf[:lts]

    # Network settings
    config.vm.network :forwarded_port, guest: 80, host: 8080
    config.vm.network :private_network, ip: conf[:ip]

    # Create VM using VirtualBox
    # See https://www.vagrantup.com/docs/providers/virtualbox
    # TODO: Switch to `vagrant-libvirt`
    config.vm.provider :virtualbox do |vb|
        vb.name = conf[:name] + ' @ ' + conf[:lts]
        vb.cpus = conf[:cpus]
        vb.memory = conf[:memory]
    end

    # Disable default behavior introduced in Vagrant 1.7, ensuring
    # that all Vagrant machines will use the same SSH key pair
    # See https://github.com/mitchellh/vagrant/issues/5005
    config.ssh.insert_key = false
    config.ssh.keep_alive = true

    # Provision VM using Ansible
    # See https://www.vagrantup.com/docs/provisioning/ansible_local
    config.vm.provision :ansible_local do |ansible|
        ansible.playbook = conf[:playbook]
        ansible.version = conf[:ansible]
        ansible.install_mode = 'pip'
        ansible.verbose = 'vv'
        ansible.extra_vars = {
        ansible_python_interpreter: '/usr/bin/python3'
    }

    end
end
