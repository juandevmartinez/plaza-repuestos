## Installing / Getting started

### 1. Clone the repository

Checkout to develop branch:
```$ git checkout develop```

You should now have the following structure:

```
docker-WP
└───scripts
│   └───...
└───src
│   └───themes
│   └───plugins
│   └───gulp
│   .env
│   docker-compose.yml
│   Dockerfile
│   ...
```

The work directory will be **src**. Themes folder correspond to the themes on wordpress and Plugins folder to the plugins installes on this wordpress.

## Development


### Pre-requisites
You must have [Docker](https://www.docker.com/) installed on your machine. Everything outlined in this project gets run within the Docker container. Docker will download them and install them into the container during the build process.

### Setup
#### Setting the environment

Run `docker-compose build`

#### Run the project

Run `docker-compose up` or `docker-compose up -d`

#### Paths for Gulp 
Gulp is configured to watch for any JS and SCSS files within your themes. JS is split into two categories, one being the plugins, and the second being the app.js. We separated the plugins so they can be loaded first to the page. Then the app.js can utilize that.

The files must be placed like the following:
```
- themes
│   └───my-theme
    │   └───src
        │   └───sass
            │   └───styles.scss
            │   └───...
        │   └───js
            │   └───script1.js
            │   └───script2.js
                │   └───plugins
                    │   └───jquery.js
                    │   └───flexslider.js
    │   └───...
```

#### Managing Database
The project comes with the Adminer. You can access the Adminer at [localhost:8080](http://localhost:8080).
