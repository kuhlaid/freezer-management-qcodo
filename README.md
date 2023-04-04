# Freezer management system

Disclaimer: for context, this system was originally designed in 2013 (before the wide use of virtual cloud computing). The creation of this application was very specific to the needs at the time, so the use by others in the year 2023 was not considered. This app uses probably one of the best PHP frameworks ever designed (QCodo - [https://github.com/qcodo/qcodo]). While this is an older framework, it still holds up to the test of time for simplicity and ease of use. If you want to change something (the styling, adding pages, etc.), go for it. The `_core_qcodo` directory contains the framework, so unless you are making system wide changes you do not need to bother with this directory. Also the `codegen` directory contains a separate app for generating code for you based on the database tables, so if you wish to expand the freeze management app, then that is a good place to start if you are creating additional database tables.

Also, you will need to implement your own security model. Whether that means putting the application behind Shibboleth authentication or Google Auth, that is up to you. As far as access control, this app. was originally designed for only one admin which is defined under the `/src/includes/acl-8.php` script. A separate 'view-only' access using the `/src/includes/acl-13.php` script was created but rarely used. You can build of these files to restrict access.

One option for using this app is to simply load it onto a single lab computer (it does not need to be connected to the network) and run it locally on that machine for whomever has access into that machine. However you will need to make sure you have a database backup plan (but you will want that no matter what).

## Database

This app assumes you are using MySQL for the database. You can use another type of database but you might need to edit some of the code to do it.

## Configuration

Before you begin you need to check the environment variables in the `.env.dev` file and use them as they are or make edits to meet your needs.

Also the `sampledb_pt__user.sql` has a insert statement at the end for a sample user using the following SQL statement (modify if you need other users or you simply wish to use other values for the user):

```s SQL
INSERT INTO `pt__user` (`firstname`, `lastname`, `email`, `active`, `onyen`) VALUES ('User', 'One', 'user_one@home.edu', '1', 'user1');
```

## Loading the app in Docker

Once we have the environment variables updated, use the following command to start the database and web application (adjust the naming of the `docker-compose.dev.yml` and `.env.dev` file references if you are using different file names, and delete any Docker containers and images that currently exist for this project so you know you are working with fresh copies):

`docker compose -f docker-compose.dev.yml --env-file .env.dev up`

## Managing the database

Once the database container is created in Docker, probably the easiest way to access and work with the database is to use MySQL Workbench (using version 8 at the time of this writing). Simply create a new connection using hostname `127.0.0.1` and port `8082` then the `root` username; you will be prompted for the root password when connecting.

## Issues

### Docker compose

If you are getting Docker authentication issues trying to run the compose command, remove the `{ "credsStore" : desktop }` from the following file [https://github.com/docker/docker-credential-helpers/issues/60]:

`nano ~/.docker/config.json`
