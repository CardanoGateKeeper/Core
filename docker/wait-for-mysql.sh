#!/bin/bash

while [ $(docker ps | grep -c "healthy.*gatekeeper-mysql$") == 0 ]
do
  echo "Waiting for database to be healthy"
  sleep 5s
done
