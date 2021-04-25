# satnav-testcase

## Design Diagram
![image](https://drive.google.com/uc?export=view&id=1A3Xz4cRKwP3Bm-FZ21mDOQrJgqbtMbQt)

The solution is based on AWS-powered infrastucture, ansible and PHP/NodesdfJs.
For simplification reasons values like IDs, usernames and passwords are harcoded - in a real-world exampled these should be kept in `.cfg` or `.env` files and vaults.

The code is deployed into an `Orchestrator` instance, which is used to manage the rest of the infrastucture.

Inside the `scripts` folder there are two main scripts:
- `createServer.sh` uses a pre-made Amazon Machine Image (AMI), prebaked with all the neccessary tools, to create an EC2 instance. The `createInstance.sh` command outputs the new instance's IP, which is saved in a `server_ip` file for later usage, and used to invoke the `install_server` ansible playbook. The playbook uploads the `src/server.php` file and starts the server instance on port 1617.

- `createClient.sh` uses the same AMI to create an EC2 instance. After that the `install_client` ansible playbook is called, using the new instance's IP as a parameter and the content of the `server_ip` file as an extra var to be inserted in the `src/client.js` file. At the end of the playbook the client is started, which connects to the server.

The PHP server is designed with a non-blocking port, meaning that unlimitted number of clients can be started and they all will connect to the same server instance(IP).

## Future releases
![image](https://drive.google.com/uc?export=view&id=1ZPs55NCzAqw_CpzsWQEjefOhoyxPWqTc)

This diagram show the possible future updates on the design

1. The server should be behind a Load balancer. That will help to 
- use a static IP address for the clients
- deploy unlimited amount of server instances to balance the load.

2. The Orchestrator should monitor the CPU and memory load accross the server instances, and in case of increased load should deploy new instance and register it in the Load balancer.

3. The events should be generated and inserted in a DB. This will ensure uniform messages accros the server instances.

4. All instances (clients and servers) should log into a single host (AWS bucket) - that will be way easier to keep track of all the async proccesses.
