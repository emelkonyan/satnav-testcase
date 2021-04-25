aws ec2 run-instances --image-id ami-08b94e5f6686e6bbf --count 1 --instance-type t2.micro --key-name test2 --security-group-ids sg-0df1f119e55ead7f2 --subnet-id subnet-c90b5685 --output text --query 'Instances[*].NetworkInterfaces[*].PrivateIpAddress'


