# Update the .env
APP_DEBUG =false
DB_HOST=db

# Change the permissions of composer.lock storage bootstrap/cache
chmod -R 777 composer.lock storage/ bootstrap/cache

# Build app
docker-compose build app

# If gettinng 403 forbidden ( Very bad Idea- Dont Do it)
- comment out the apt-get update and install line
- php extension install line from mbstring ( keep the pdo_sql wala part )

# Follow the link
https://www.digitalocean.com/community/tutorials/how-to-install-and-set-up-laravel-with-docker-compose-on-ubuntu-22-04#step-6-running-the-application-with-docker-compose

# After Executing the php artisan key generate as per the link

# For some reason check if publi/venders/chart.js has chart.min.js and not Chart.min.js
(If possible change in code to accept Chart.min.js)

# Connect to the MYSQL Server container from remote
- IP is the server IP
- Port is 33061
- user root
- pwd null

# Then create a Database known as pms ( db_init.sql is doing that -still check)

# The goto the ssh terminal and migrate the database and seed it
## To migrate the databsae 
- php artisan clear the cache and clear the route cache
- docker-compose exec app php artisan migrate
- (Optional) docker-compose exec app php artisan migrate:refresh (removes all dataa)

## To seed the data base
- docker-compose exec app php artisan db:seed
