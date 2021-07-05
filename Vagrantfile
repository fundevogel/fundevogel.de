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
        image: 'generic/ubuntu2004',
        driver: 'kvm',
        ip: '192.168.69.69',
        synced_folder: '/vagrant',
        mount_options: ['nolock, vers=3, udp, actimeo=2'],
        cpus: 2,
        memory: 2048,
        ansible: '2.9.6',
        playbook: 'lib/ansible/playbook.yml',
    }

    # Basic VM settings
    config.vm.define conf[:name]
    config.vm.hostname = conf[:name]
    config.vm.box = conf[:image]
    config.vm.synced_folder '.', conf[:synced_folder], type: 'nfs', mount_options: conf[:mount_options]

    # Network settings
    config.vm.network :private_network, ip: conf[:ip]
    config.vm.network :forwarded_port, guest: 80, host: 80
    config.vm.network :forwarded_port, guest: 443, host: 443
    config.vm.network :forwarded_port, guest: 9090, host: 9090

    # Create VM using KVM hypervisor
    # See https://github.com/vagrant-libvirt/vagrant-libvirt
    config.vm.provider :libvirt do |libvirt|
        # Provider settings
        libvirt.driver = conf[:driver]
        libvirt.cpus = conf[:cpus]
        libvirt.memory = conf[:memory]
    end

    # Disable default behavior introduced in Vagrant 1.7, ensuring
    # that all Vagrant machines will use the same SSH key pair
    # See https://github.com/mitchellh/vagrant/issues/5005
    config.ssh.insert_key = false
    config.ssh.keep_alive = true

    # Enable SSH agent forwarding
    config.ssh.forward_agent = true

    # Provision VM using Ansible
    # See https://www.vagrantup.com/docs/provisioning/ansible_local
    config.vm.provision :ansible_local do |ansible|
        ansible.playbook = conf[:playbook]
        ansible.version = conf[:ansible]
        ansible.install_mode = 'pip3'
        # Enable as needed
        # ansible.verbose = 'vv'
    end
end
