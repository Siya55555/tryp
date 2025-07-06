# Laravel Deployment Guide for Render

## Prerequisites
1. GitHub account (username: Siya55555)
2. Render account (sign up at https://render.com)
3. Your Laravel project pushed to GitHub

## Step 1: Prepare Your Repository

### 1.1 Push to GitHub
```bash
# Initialize git if not already done
git init
git add .
git commit -m "Initial commit for Render deployment"

# Add your GitHub repository as remote
git remote add origin https://github.com/Siya55555/tryp.git
git push -u origin main
```

### 1.2 Create .env.example (if not exists)
Copy your current .env file and remove sensitive data:
```bash
cp .env .env.example
# Edit .env.example and remove sensitive values
```

## Step 2: Deploy to Render

### 2.1 Sign up for Render
1. Go to https://render.com
2. Sign up with your GitHub account
3. Connect your GitHub account

### 2.2 Create New Web Service
1. Click "New +" → "Web Service"
2. Connect your GitHub repository
3. Select your repository: `Siya55555/tryp`

### 2.3 Configure the Service
- **Name**: `tryp-laravel-app`
- **Environment**: `PHP`
- **Region**: Choose closest to your users
- **Branch**: `main`
- **Root Directory**: Leave empty (root of repo)

### 2.4 Build & Deploy Settings
- **Build Command**: 
```bash
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

- **Start Command**:
```bash
php artisan migrate --force
vendor/bin/heroku-php-apache2 public/
```

### 2.5 Environment Variables
Add these environment variables in Render dashboard:

#### Required Variables:
```
APP_NAME=Trip
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app-name.onrender.com
LOG_CHANNEL=stderr
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

#### Database Variables (will be auto-filled):
```
DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=your-db-name
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password
```

#### Mail Variables:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mail-username
MAIL_PASSWORD=your-mail-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
```

#### Turnstile Variables:
```
TURNSTILE_SITE_KEY=your-turnstile-site-key
TURNSTILE_SECRET_KEY=your-turnstile-secret-key
```

#### Stripe Variables:
```
STRIPE_KEY=your-stripe-public-key
STRIPE_SECRET=your-stripe-secret-key
STRIPE_WEBHOOK_SECRET=your-stripe-webhook-secret
```

## Step 3: Create Database

### 3.1 Create PostgreSQL Database
1. In Render dashboard, click "New +" → "PostgreSQL"
2. Name: `tryp-database`
3. Plan: Free
4. Region: Same as your web service

### 3.2 Connect Database to Web Service
1. Go to your web service settings
2. Add the database environment variables automatically
3. Render will auto-populate DB_HOST, DB_PORT, etc.

## Step 4: Deploy

### 4.1 Initial Deployment
1. Click "Create Web Service"
2. Render will automatically build and deploy your app
3. Wait for deployment to complete (5-10 minutes)

### 4.2 Verify Deployment
1. Check the deployment logs for any errors
2. Visit your app URL: `https://your-app-name.onrender.com`
3. Test the main functionality

## Step 5: Post-Deployment

### 5.1 Run Migrations
If migrations didn't run automatically:
1. Go to your web service in Render
2. Click "Shell"
3. Run: `php artisan migrate --force`

### 5.2 Seed Database (Optional)
```bash
php artisan db:seed
```

### 5.3 Set up Custom Domain (Optional)
1. Go to your web service settings
2. Add custom domain
3. Update DNS records

## Troubleshooting

### Common Issues:
1. **Build fails**: Check composer.json and PHP version
2. **Database connection**: Verify environment variables
3. **500 errors**: Check logs in Render dashboard
4. **Migration issues**: Run migrations manually in shell

### Useful Commands:
```bash
# Check logs
php artisan log:clear

# Clear cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Regenerate app key
php artisan key:generate
```

## Support
- Render Documentation: https://render.com/docs
- Laravel Documentation: https://laravel.com/docs
- GitHub Repository: https://github.com/Siya55555/tryp

## Next Steps
1. Set up email service (Mailgun, SendGrid, etc.)
2. Configure file storage (AWS S3, etc.)
3. Set up monitoring and logging
4. Configure SSL certificates
5. Set up CI/CD pipeline

---
**Note**: The free tier has limitations:
- Services sleep after 15 minutes of inactivity
- Limited bandwidth
- No persistent storage (use external storage) 