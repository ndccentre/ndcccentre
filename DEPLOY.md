# Deployment Guide — ndpccenter.co.tz (cPanel)

## Initial Server Setup (run once via cPanel Terminal)

### 1. Clone the repository into your domain root

```bash
cd ~
# Remove default public_html content or point domain to project/public
git clone https://github.com/ndccentre/ndcccentre.git ndpccenter.co.tz
cd ndpccenter.co.tz
```

### 2. Install dependencies

```bash
composer install --no-dev --optimize-autoloader
```

### 3. Setup Node.js (if not available)

```bash
# Install NVM
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh | bash
source ~/.bashrc
nvm install 20
nvm use 20

# Build assets
npm ci --ignore-scripts
npm run build
```

### 4. Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` with your database credentials:
```
APP_NAME="NDPCC"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://ndpccenter.co.tz

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

### 5. Run migrations and seed

```bash
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
```

### 6. Point domain to public folder

In cPanel → Domains → ndpccenter.co.tz:
- Set Document Root to: `/home/username/ndpccenter.co.tz/public`

Or create a symlink:
```bash
# If domain points to public_html
rm -rf ~/public_html
ln -s ~/ndpccenter.co.tz/public ~/public_html
```

### 7. Setup cron for scheduled tasks

In cPanel → Cron Jobs, add:
```
* * * * * cd /home/username/ndpccenter.co.tz && php artisan schedule:run >> /dev/null 2>&1
```

This runs `youtube:import` hourly and `youtube:check-live` every 10 minutes automatically.

---

## GitHub Secrets (for automatic deployment)

Go to GitHub repo → Settings → Secrets and variables → Actions, add:

| Secret | Value |
|--------|-------|
| `CPANEL_HOST` | Your server IP or hostname (e.g., `server123.web-hosting.com`) |
| `CPANEL_USERNAME` | Your cPanel SSH username |
| `CPANEL_PASSWORD` | Your cPanel password |
| `CPANEL_PORT` | SSH port (usually `22` or custom like `2222`) |

---

## How Auto-Deploy Works

Every push to `main` branch triggers:
1. SSH into your cPanel server
2. `git pull` latest code
3. `composer install` (production)
4. `npm ci && npm run build`
5. `php artisan migrate --force`
6. Cache config/routes/views
7. Import YouTube videos

---

## Manual Deploy (if needed)

SSH into cPanel and run:
```bash
cd ~/ndpccenter.co.tz
git pull origin main
composer install --no-dev --optimize-autoloader
npm ci --ignore-scripts && npm run build
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
