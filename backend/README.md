Required operations to deploy the project: 

1. php artisan migrate:fresh --path=database/migrations/fleet_mcp --database=fleet_mcp --seed
description: "mcp" database keeps the master enteries. This would route users as per their client. 

2. php artisan tenants:admin --fresh --seed
description: Through "admin" database, admin operations will be handled.

3. php artisan auth:install
description: install passport with below detail

Add in .env file
PASSWORD_CLIENT_ID: 1
PASSWORD_CLIENT_SECRET: ZWYgA8ng7grxFOrwfAgmFLtt6mYCMNjwJ9b0CqmX

#php artisan tenants:migrate --fresh --seed
#description: The command would do migration for all client databases.

excute below command if facing 500 error on authentication:
php artisan passport:keys
