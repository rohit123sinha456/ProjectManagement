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