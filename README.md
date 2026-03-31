# Send-Grid Campaign Platform (Laravel)

Production-oriented Laravel architecture for bulk email sending and campaign management with secure authentication, RBAC, queue-based delivery, reporting, and modern dashboard UX.

## Features Implemented
- Secure auth-ready architecture (email verification, forgot/reset password, remember me support through Laravel auth stack).
- Session timeout middleware and security config.
- Role-based access control with 4 required roles: Super Admin, Admin, Campaign Manager, Viewer.
- Activity log hooks for critical actions.
- Contact management with import/export, dedupe by email, filtering.
- Campaign management (draft/scheduled/processing/sent/paused/failed, duplicate, test send, pause/resume).
- Template management structure with merge tag-ready HTML content.
- Queue-based bulk sending job with chunking, retries, duplicate-send prevention.
- SMTP profile data model with encrypted password field storage design.
- KPI-ready dashboard and reporting routes.
- REST-style route definitions for web and API access.

## Project Structure
- `app/Models` – domain models (User, Contact, Campaign, EmailTemplate, EmailLog)
- `app/Http/Controllers` – CRUD + dashboard + settings + analytics flows
- `app/Http/Requests` – form validation
- `app/Http/Middleware` – session timeout
- `app/Services` – campaign orchestration and import/export services
- `app/Jobs` – queued campaign delivery engine
- `app/Mail` – test and bulk email mailables
- `database/migrations` – relational schema
- `database/seeders` – sample roles, permissions, admin user, seed data
- `resources/views` – Blade dashboard + modules with unified layout

## Setup
1. `composer install`
2. `cp .env.example .env`
3. Configure DB and mail credentials.
4. `php artisan key:generate`
5. `php artisan migrate --seed`
6. `php artisan storage:link`
7. `php artisan queue:table && php artisan migrate`
8. `php artisan serve`

## Queue + Scheduler + Cron
Run queue worker:
```bash
php artisan queue:work --tries=3 --timeout=120
```

Cron entry:
```cron
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

## Default Credentials
- Email: `admin@example.com`
- Password: `Password@123`

## Production Notes
- Enable Redis queue/cache for throughput.
- Configure Horizon for queue monitoring.
- Use HTTPS-only cookies and secure session storage.
- Configure provider webhooks for open/click/bounce tracking.
- Encrypt SMTP secrets using Laravel encrypted casts or app-level key vault integration.

## Troubleshooting Composer Install
If `composer install` fails with `CONNECT tunnel failed, response 403`, your environment blocks access to Packagist.
Use one of these approaches:
1. Run the install from a network-enabled machine.
2. Configure a private Packagist mirror (Satis/Private Packagist) and set Composer repositories.
3. Set outbound proxy credentials for Composer in CI/container.
