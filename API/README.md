# API

## Installation

* Installation of the required packages:

```sh
docker-compose exec -it lr_api composer install
```

* Permission to the `storage` folder: 

```sh
docker-compose exec -it lr_api chmod -R 777 storage/
```