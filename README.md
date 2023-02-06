![Vue.js](https://img.shields.io/badge/vuejs-%2335495e.svg?style=for-the-badge&logo=vuedotjs&logoColor=%234FC08D)
![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)

# Dishwashing App
Inventory management system for kitchenware. It's a monolithic restful SPA built with Laravel and Vue.js.

## Quick start
1. Install dependencies: `composer install`
2. Copy `.env.example` to `.env` and set your database credentials
3. Generate an app encryption key: `php artisan key:generate`
4. Migrate the database: `php artisan migrate`
5. Seed the database: `php artisan db:seed`
6. Install NPM dependencies: `npm install`
7. Build the front-end: `npm run dev`
8. Start the local development server: `php artisan serve`

## Using Laravel Sail
```bash
sail up -d
```

```bash
sail artisan migrate:fresh --seed
```
