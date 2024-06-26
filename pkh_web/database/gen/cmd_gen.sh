#/bin/bash

ANT_HOME=/Users/cuongnp/data/soft/apache-ant-1.10.9
ANT_LIB=$ANT_HOME/lib
ANT_DIR=$ANT_HOME/bin
JAVACMD=java
GEN_DIR=temp/tpl-laravel-admin
DEST_DIR=../../app

echo $ANT_DIR/ant -lib "./lib/*.jar:./lib/**.*" -f ./gen-laravel-admin.xml
#$ANT_DIR/ant -lib "$ANT_LIB:lib/**.*" -f gen-laravel-admin.xml
$ANT_DIR/ant -lib "./lib/*.jar:./lib/**.*" -f ./gen-laravel-admin.xml
#$ANT_DIR/ant -lib "/Volumes/Data/workspace/pkh/pkh_src/pkh_web/database/gen/lib/*.jar:/Volumes/Data/workspace/pkh/pkh_src/pkh_web/database/gen/lib/**.*" -f ./gen-laravel-admin.xml
#/Users/cuongnp/data/soft/apache-ant-1.10.9/bin/ant -lib "/Volumes/Data/workspace/pkh/pkh_src/pkh_web/database/gen/lib/*.jar:/Volumes/Data/workspace/pkh/pkh_src/pkh_web/database/gen/lib/**.*" -f ./gen-laravel-admin.xml


mkdir -p $GEN_DIR
rm -f $GEN_DIR/App/Models/PasswordResets.php
rm -f $GEN_DIR/App/Models/PermissionRole.php
rm -f $GEN_DIR/App/Models/Permissions.php
rm -f $GEN_DIR/App/Models/PermissionUser.php
rm -f $GEN_DIR/App/Models/Roles.php
rm -f $GEN_DIR/App/Models/RoleUser.php
rm -f $GEN_DIR/App/Models/Users.php

rsync -avz $GEN_DIR/App/Models/ $DEST_DIR/Models/

rm -f $GEN_DIR/App/Models/*.php 
rm -rf $GEN_DIR
rm -rf null
