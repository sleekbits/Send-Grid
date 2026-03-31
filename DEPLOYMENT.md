# Deployment Guide (Production URL)

This project is configured to run on a hosted URL (not localhost), e.g.:
- `APP_URL=https://queue.liveblog365.com`

## 1) Environment variables
Create `.env` from `.env.example` and set your **real** values:

```bash
cp .env.example .env
```

Set database values for your hosting provider:
- `DB_CONNECTION=mysql`
- `DB_HOST=sql105.ezyro.com`
- `DB_PORT=3306`
- `DB_DATABASE=...`
- `DB_USERNAME=...`
- `DB_PASSWORD=...`

## 2) Install dependencies
```bash
composer install --no-dev --optimize-autoloader
```

If Packagist is blocked in your environment, install from a machine/network that can reach Packagist or use a Composer mirror.

## 3) Laravel bootstrap
```bash
php artisan key:generate
php artisan migrate --force
php artisan db:seed --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 4) Queue + scheduler
```bash
php artisan queue:table
php artisan migrate --force
php artisan queue:work --tries=3 --timeout=120
```

Cron:
```cron
* * * * * cd /path/to/app && php artisan schedule:run >> /dev/null 2>&1
```

## 5) Web server
Point web root to `public/` and ensure HTTPS is enabled for `queue.liveblog365.com`.

## 6) Security notes
- Do **not** commit real DB passwords or SMTP passwords to git.
- Rotate credentials if they were shared in chat/tickets.
- Keep `APP_DEBUG=false` in production.
