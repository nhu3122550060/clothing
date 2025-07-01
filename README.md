# BE-Clothing

This document provides instructions for setting up and running the BE-Clothing application using Docker.

## Prerequisites

- Docker
- Docker Compose

## Setup Instructions

1. Clone the repository
```bash
git clone [repository-url]
cd be-clothing
```

2. Build and start the containers
```bash
docker-compose up -d --build
```

3. Access the application
- Web Application: http://localhost:9090
- PHPMyAdmin: http://localhost:9091
  - Server: db
  - Username: clothing_user
  - Password: clothing_password

## Database Configuration

- Host: db
- Database: clothing_db
- Username: clothing_user
- Password: clothing_password
- Root Password: root_password

## Container Information

The setup includes three containers:
1. **app** - PHP 8.4 Apache web server
2. **db** - MySQL 8.0 database server
3. **phpmyadmin** - PHPMyAdmin for database management

## Common Commands

- Start containers: `docker-compose up -d`
- Stop containers: `docker-compose down`
- View logs: `docker-compose logs -f`
- Rebuild containers: `docker-compose up -d --build`
- Access PHP container: `docker-compose exec app bash`
- Access MySQL container: `docker-compose exec db bash`

## Directory Structure

- `/public` - Web root directory
- `/app` - Application files
- `/tests` - Test files
- `/vendor` - Composer dependencies

## Notes

- The application files are mounted as a volume, so changes to the code will be reflected immediately
- Database data is persisted in a Docker volume
- Apache mod_rewrite is enabled for URL rewriting
- Composer dependencies are installed during container build

## Troubleshooting

1. If you can't connect to the database, ensure:
   - The containers are running (`docker-compose ps`)
   - The database credentials are correct
   - The database service is healthy (`docker-compose logs db`)

2. If the web application shows errors:
   - Check the Apache logs (`docker-compose logs app`)
   - Ensure all PHP extensions are installed
   - Verify the database connection settings
