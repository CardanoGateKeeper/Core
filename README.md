# GateKeeper
An open source ticketing solution using Cardano Native Assets. Bridging Web 3.0 to IRL via Blockchain.

Developed by [Adam Dean](https://twitter.com/adamKDean) & [Latheesan Kanesamoorthy](https://twitter.com/LatheesanK) and maintained by the Cardano Community with ❤.

## Prerequisite
- Linux OS
- Make
- Git
- [Docker](https://docs.docker.com/desktop/install/linux-install/) / [Docker-Compose](https://docs.docker.com/compose/install/linux/)

## Local Install
- Open terminal and type `cd $HOME/Desktop`
- Run `docker network create --driver bridge local-gatekeeper` (**Only Required First Time Setup**)
- Clone repo `git clone git@github.com:latheesan-k/GateKeeper.git`
- Switch to repo dir `cd $HOME/Desktop/GateKeeper`
- Copy `application/.env.example` as `application/.env`
- Run `make buid` to build & start the containers
- Application should be running locally at [**https**://localhost:8020](https://localhost:8020)

> You can connect to the dev mysql instance via host `127.0.0.1` and port `33020`
> See credentials in [docker/docker-compose.yml](docker/docker-compose.yml)

## Available Make Commands (Local Development)
* `build` Rebuild all docker containers
* `up` Restart all docker containers
* `down` Shutdown all docker containers
* `composer-install` Run composer install
* `db-migrate` Run database migration(s)
* `db-refresh` Drop all database tables, re-run the migration(s) with seeds
* `status` View the status of all running containers
* `logs` View the logs out of all running containers
* `shell` Drop into an interactive shell inside _gatekeeper-web_ container
* `stats` View the resource usage of all running containers
* `artisan` Execute Laravel `artisan` command inside _gatekeeper-web_ container
* `admin` Create a new admin user
* `staff` Create a new staff user
* `change-password` Change user account password 

## Production Deployment Notes
* Coming Soon
