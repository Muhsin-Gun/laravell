# PowerShell script to push to GitHub
Write-Host "Pushing to GitHub..." -ForegroundColor Cyan

# Configure git to use notepad as editor
git config --global core.editor "notepad"

# Add all files
git add -A

# Commit with message
git commit -m "Complete car rental platform: All dashboards, enhanced UI, professional features"

# Force push to main
git push origin main --force

Write-Host "Done! Check your GitHub repo." -ForegroundColor Green
pause
