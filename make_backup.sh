#!/usr/bin/env bash
mysqldump -u fimbo -pfimbo fimbo > `date +%d-%m-%y_%H.%M.%S.`fimbo.dump.sql
tar -czf ./`date +%d-%m-%y_%H.%M.%S.`fimbo.images.tar.gz /var/www/html/fimbo/public/images
