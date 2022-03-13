# Laravel

Used Laravel version 8 for this.

## Implemented

- JWT Authentication ( for registration, login, refresh token)
- Email verification while registration. Email verification is customized [See Pull #7](https://github.com/NazemMahmud/laravel-boilerplate/pull/7) to get idea about cusomized information
- Used Redis (phpredis). For this redis extension need to be installed in your PHP environment

## Upcoming TODOS

- Error handle
- sendPasswordResetLink
- reset Password
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

### Note:
Auth failure error handle, `middleware can't handle JWT exception`
