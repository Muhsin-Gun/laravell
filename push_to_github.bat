@echo off
echo Pushing to GitHub...
git config core.editor "notepad"
git add .
git commit -m "Complete car rental platform with enhanced UI"
git push origin main --force
echo Done!
pause
