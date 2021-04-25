#!/bin/bash
set -x
iip=`./cloneInstance.sh`
server_ip=`cat server_ip`
echo `ansible-playbook -i $iip, ansible/install_client.yml --extra-vars "ansible_user=ansible ansible_password=ansible server_ip=$server_ip" > ansible_output`
