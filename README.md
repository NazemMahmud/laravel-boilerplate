##TODOS

- Error handle
- Auth failure error handle, `middleware can't handle jwt exception`
- repository pattern
- sendPasswordResetLink
- reset Password
- resource API return
- ************* **ACL** ********************

## Database seed
- To drop all table with seed: ` php artisan db:seed --class=UserSeeder`
- Only seed: `php artisan migrate:fresh --seed`

## Redis
to config redis, check `config/database.php` file `redis` array

## Email
- to send email for registration validation **or** other purpose, please configure your email
- keys are given in `env.example` file for SMTP configuration
- Your given username email should have been enabled `ALLOW ACCESS FOR LESS SECURE APPS`
