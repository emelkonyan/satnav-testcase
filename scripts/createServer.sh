#!/bin/bash
set -x
`./cloneInstance.sh > server_ip`
iip=`cat server_ip`
`ansible-playbook -i $iip, ansible/install_server.yml --extra-vars "ansible_user=ansible ansible_password=ansible" > ansible_putput`
