- Prune

```
git fsck --unreachable --no-reflog
git reflog expire --expire="1 hour" --all
git reflog expire --expire-unreachable="1 hour" --all
git prune --expire="1 hour" -v
git gc --aggressive --prune="1 hour"
```

```
git reflog expire --expire-unreachable="30m" --all
git prune --expire="30m" -v
git gc --prune="30m"
git reset --hard HEAD~1
git push -f
```