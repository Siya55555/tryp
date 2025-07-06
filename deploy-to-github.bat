@echo off
echo ========================================
echo Laravel Deployment to GitHub
echo ========================================

echo.
echo Step 1: Initializing Git repository...
git init

echo.
echo Step 2: Adding all files to Git...
git add .

echo.
echo Step 3: Creating initial commit...
git commit -m "Initial commit for Render deployment"

echo.
echo Step 4: Adding GitHub remote...
git remote add origin https://github.com/Siya55555/tryp.git

echo.
echo Step 5: Pushing to GitHub...
git push -u origin main

echo.
echo ========================================
echo Deployment files created successfully!
echo ========================================
echo.
echo Next steps:
echo 1. Go to https://render.com
echo 2. Sign up with your GitHub account
echo 3. Create a new Web Service
echo 4. Select your repository: Siya55555/tryp
echo 5. Follow the deployment guide in DEPLOYMENT_GUIDE.md
echo.
pause 