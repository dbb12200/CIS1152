# Git Cheat Sheet

Assuming you followed the instructions from lab 1 to setup the upstream repostitory the following instructions are a simplified version of the much longer instructions found in Lab 1.

## Howto Add to Your Repository

```bash
git add -A .
git commit -m "NOT THIS MESSAGE!"
git push origin master
```

## Howto Fetch from the Upstream Repository

```bash
git fetch upstream
git checkout master
git merge upstream/master
git commit -m "Merge in from Upstream"
```
