# Backup db repo

- Clone source

```
git clone https://phucuong1112@bitbucket.org/phucuong1112/pkh-backup.git -b pkh_db_prod_20200928_200001 --depth 1
cd pkh-backup\database
docker cp .\pkh_db_prod.sql mysql:/
docker exec -i -w /opt/pkh_src/pkh_web phpdev_container bash -c "mysql -u user -pabc123456 phankhang < /pkh_db_prod.sql"
```

- Cleanup backup

```bash
DIR_GIT=/home/sysadmin_pkh/pkh-backup
git --git-dir=${DIR_GIT}/.git/ --work-tree=${DIR_GIT} status

echo "GC"
cd ${DIR_GIT}
#git reflog expire --expire="1 hour" --all
#git reflog expire --expire-unreachable="1 hour" --all
#git prune --expire="1 hour" -v
#git gc --prune="1 hour"

DAY_0=`date "+%Y%m%d"`
DAY_1=`date -d "1 day ago" "+%Y%m%d"`
DAY_2=`date -d "2 day ago" "+%Y%m%d"`
DAY_3=`date -d "3 day ago" "+%Y%m%d"`
DAY_4=`date -d "4 day ago" "+%Y%m%d"`
DAY_5=`date -d "5 day ago" "+%Y%m%d"`
DAY_6=`date -d "6 day ago" "+%Y%m%d"`
DAY_7=`date -d "7 day ago" "+%Y%m%d"`
DAY_8=`date -d "8 day ago" "+%Y%m%d"`
DAY_9=`date -d "9 day ago" "+%Y%m%d"`
DAY_10=`date -d "10 day ago" "+%Y%m%d"`

echo $DAY_0
echo $DAY_1
echo $DAY_2
echo $DAY_3
echo $DAY_4
echo $DAY_5
echo $DAY_6
echo $DAY_7
echo $DAY_8
echo $DAY_9
echo $DAY_10

prefix="origin/"
git branch --remote | grep pkh_db | grep -v pkh_db_prod_$DAY_0 | grep -v pkh_db_prod_$DAY_1 | grep -v pkh_db_prod_$DAY_2 | grep -v pkh_db_prod_$DAY_3 | grep -v pkh_db_prod_$DAY_4 | grep -v pkh_db_prod_$DAY_5 | while read -r F
do
   CUR_BRANCH=${F/#$prefix}
   git --git-dir=${DIR_GIT}/.git/ --work-tree=${DIR_GIT} branch -D ${CUR_BRANCH}
   git --git-dir=${DIR_GIT}/.git/ --work-tree=${DIR_GIT} branch -D -r ${prefix}${CUR_BRANCH}
done

# git --git-dir=${DIR_GIT}/.git/ --work-tree=${DIR_GIT} push
```