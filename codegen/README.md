# Code generation (codegen)

Codegen (code generation app) can be used when adding additional pages/functionality and database tables to the main freezer management application.
Codegen does just what it sounds like it does, it creates PHP scripts based on your database tables. It creates scripts for adding and editing data for a database table and scripts to list the records within the tables and sets up the database classes so you can treat database tables as objects in your code. Of course these are only starter/boilerplate scripts but they setup most of the database interactions for you to work off of in the event you wish to add additional database tables and functionality to the freezer management application.

## Loading the app in Docker

Once we have the environment variables updated, use the following command to start the database and web application (adjust the naming of the `docker-compose.dev.yml` and `.env.dev` file references if you are using different file names):

Assuming you are in the root project directory in your bash terminal, you can use the following commands to copy the `_core_qcodo` from our main src directory, open the codegen directory, then create the Docker images. To do that simply copy the following groups of commands (copy the parentheses and everything in between them) and enter it into the bash terminal:

# sudo mkdir -p codegen/initdb (for some reason this is failing even when the directory does not exist)
```s cmd
(
rm codegen/initdb/*
cp -r initdb/* codegen/initdb
cp -r src/_core_qcodo codegen/src
cd codegen
docker compose -f docker-compose.codegen.yml --env-file .env.codegen up
)
```

Once the Docker containers are created, to run the codegen against the latest database tables, go to [http://localhost:8000]. The results screen will tell you what was generated and any issues it found in the database configuration. You should then find that additional folders such as `codegen\src\form_drafts` and `codegen\src\includes\formbase_classes_generated` folders are created and contain new files.

If you visit [http://localhost:8000/form_drafts/] for instance it should show you a list of the database tables with links to view the contents of the table or add new records.