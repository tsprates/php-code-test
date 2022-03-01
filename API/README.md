# API

## Installation

* Installation of the required packages:

```sh
docker-compose exec lr_api composer install
```

* Permission to the `storage` directory: 

```sh
docker-compose exec lr_api chown -R www-data:www-data storage/
```

* *Optional*. To access `artisan`:

```sh
docker exec -it lr_api /bin/sh
```
