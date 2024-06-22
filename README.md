
## About LeaderBoard

LeaderBoard for best services

--------


### Docker 

> Install Docker


- `git clone https://github.com/bmahesh4it/leaderboard.git`
- `cd leaderboard`
- Setup .env file
```
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=db_laravel
    DB_USERNAME=root
    DB_PASSWORD=root
```
- `docker-compose exec app php artisan key:generate`
- `docker-compose exec app php artisan migrate`


### Docker restart
``` 
docker-compose restart app
docker-compose restart web
docker-compose restart db
 ```


#### DB : seed

- `docker-compose exec app php artisan db:seed --class=DatabaseSeeder`

#### Clear cache:
 `docker-compose exec app php artisan cache:clear`

> http://localhost:8000/
