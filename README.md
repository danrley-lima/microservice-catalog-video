To run the tests, follow these steps:

1. Make sure the development environment is set up and Docker is running.

2. Open a terminal and navigate to the root of the project.

3. Start the app-php container by running the command:
```
  docker-compose up -d
```

4. Once the container is started, access the terminal of the app-php container with the command:
```
  docker exec -it app-php bash
```

5. Now you are inside the app-php container. To run the tests, use the command:
```
  ./vendor/bin/phpunit
```