# Dealers Warehouse Assessment

## Dependencies
- Docker

## Setup
From within the `dealers-warehouse-assessment` directory, run the following command:

`docker build -t dealers-warehouse-assessment . && docker run -p 8000:80 dealers-warehouse-assessment`

This will build the docker container, as well as (upon a successful build) run the container and bind to port 8000.

Visit http://localhost:8000 to see the website! It should have two customers currently.
