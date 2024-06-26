# Image

- Folder tree: FILE_ROOT_DIR
```
/home/sysadmin_pkh/app-prod/pkh-www-data    (FILE_ROOT_DIR)
|-- image                                   (NEW: FILE_ROOT_DIR_PORTAL)
|   |-- delivery_sign
|   |-- product_market
|   |-- store_checkin
|   |-- store_note
|   |-- store_sign
|-- image-web                               (NEW: FILE_ROOT_DIR_WEB)
|   |-- frontend
|   |   |-- img
|   |   |   |-- news                        (FILE_ROOT_DIR_IMG_WEB)
|   |   |   |   |-- thumb
|   |-- products
```

- scripts for docker
```batch
mkdir -p /home/sysadmin_pkh/app-prod/pkh-www-data/image/delivery_sign
mkdir -p /home/sysadmin_pkh/app-prod/pkh-www-data/image/product_market
mkdir -p /home/sysadmin_pkh/app-prod/pkh-www-data/image/store_checkin
mkdir -p /home/sysadmin_pkh/app-prod/pkh-www-data/image/store_note
mkdir -p /home/sysadmin_pkh/app-prod/pkh-www-data/image/store_sign
mkdir -p /home/sysadmin_pkh/app-prod/pkh-www-data/image-web/frontend/img/news/thumb
```