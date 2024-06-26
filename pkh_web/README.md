# PHK Portal

## Installation
```
$ composer install && npm install
```

- Downgrade to version 1

```
sudo composer self-update --1
```

Open ```.env``` and enter necessary config for DB and Oauth Providers Settings.

```
$ ./cmd_db_reset.cmd
```

## Work Flow

**General Workflow**

```
$ ./cmd_web_start.cmd
```
Open new terminal
```
$ gulp && gulp watch
```

**Angular Generators**

```
$ artisan ng:page name       #New page inside angular/app/pages/
$ artisan ng:dialog name     #New custom dialog inside angular/dialogs/
$ artisan ng:component name  #New component inside angular/app/components/
$ artisan ng:service name    #New service inside angular/services/
$ artisan ng:filter name     #New filter inside angular/filters/
$ artisan ng:config name     #New config inside angular/config/
$ artisan ng:server name     #New server side
$ artisan ng:command name    #New server command
```

- My Generator

```
php artisan ng:server name      #New server side
php artisan ng:component name   # New frontend    
```

- Create new screen
```
php artisan ng:component [crm2700]
php artisan ng:server [crm2700]
```

- Create server with template 
```script
# import
php artisan ng:component tmp9999 --template=list 
# force with no-import
php artisan ng:component tmp9999 --template=list --force --no-import

php artisan ng:server tmp9999 --template=list --class-model=TrnAttendance --table-name=trn_attendance

# template create
php artisan ng:component tmp9999 --template=create --force --no-import
php artisan ng:server tmp9999 --template=create --class-model=TrnAttendance --table-name=trn_attendance
```

[Laravel Angular Generator] (https://github.com/jadjoubran/laravel-ng-artisan-generators)

**Generate model**
```
php artisan make:migration create_trn_guarantee
```

#### [Read Full Documentation] (http://silverbux.github.io/laravel-angular-admin)

## Features
* [JWT-Auth] (https://github.com/tymondesigns/jwt-auth)
* [Socialite] (https://github.com/laravel/socialite)
* [Dingo/API] (https://github.com/dingo/api)
* [Restangular] (https://github.com/mgonto/restangular)
* [UI-Router] (https://github.com/angular-ui/ui-router/)
* Access Control List
    * [Romanbican/Roles] (https://github.com/romanbican/roles)
    * [Angular ACL] (https://github.com/mikemclin/angular-acl)

## Built With
* [Laravel] (http://laravel.com)
* [Angularjs] (https://angularjs.org)
* [Twitter Bootstrap] (https://getbootstrap.com)
* [Composer] (https://getcomposer.org/)
* [Gulp.JS] (http://gulpjs.com/)
* [BOWER] (http://bower.io/)
* [NPM] (https://www.npmjs.com/)

## Deploy to heroku

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy)

1. Click deploy button
2. After build and "successfully deployed", Click Manage App
3. Go to settings and click "Reveal Config Vars"
4. Set necessary config for DB based from CLEARDB_DATABASE_URL or from your custom database
5. Execute migration and db seed with the following commands

**Database Migration**
```
$ heroku run php artisan migrate --app your_app_name
```
**Database Seeds**
```
$ heroku run php artisan migrate --app your_app_name
```

## Contributing

Thank you for contributing to this repository.

## Acknowledgments / Credits
This project wont be possible without the following, We acknowledge and are grateful to these developers for their contributions to open source. **All necessary credits are given**.

* [Laravel-Angular (Material)] (https://laravel-angular.readme.io)
* [AdminLTE] (https://github.com/almasaeed2010/AdminLTE)

# Command

* Import database from backup

D:\dev\webserver\xampp7\mysql\bin\mysql -u root -p -D phankhang3 < D:\Working\2017\PhanKhang\pkh-backup\database\pkh_db_prod.sql

# Troubleshoot

- Not found ...

```
php artisan clear-compiled 
composer dump-autoload
php artisan optimize
```

# History

## v1.32.2 (2019-09-15)
- Hide bang-gia page

## v1.23.4 (2019-05-27)
- Fix bug crm1650
- Crm0410: add format

## v1.23.2 (2019-05-02)
- Fix bug api mobile show price list
- Fix Rpt0518

## v1.23.1 (2019-05-02)
- Fix draw line in google map (hrm0151)
- Show checkin image in other links.

## v1.23.0 (2019-05-02)
- Show delivery signature

## v1.22.0 (2019-04-18)
- Fix bug Rpt0517

## v1.22.0 (2019-04-18)
- Add google chat notification error log
- Fix bug dompdf

## v1.21.0
- Add task feature
- Fix bug dompdf

## v1.20.4
- Fix bug hrm0141

## v1.17.0
- Add ADM0500 config screen