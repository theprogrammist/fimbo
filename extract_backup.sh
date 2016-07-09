#!/usr/bin/env bash
if [ "$#" -ne 2 ]
then
    echo "two files needed - dump.sql and images.tar.gz"
    exit 0
fi

g="${1##*.}"
f="${1%.*}"
t="${f##*.}"

if [ $t.$g = "tar.gz" ]
then
    images=$1
    sql=$2
else
    images=$2
    sql=$1
fi

path_to_images="/var/www/html/fimbo/public/images/"

mysql -u fimbo -pfimbo fimbo < $sql
tar -xzf $images --directory $path_to_images
find $path_to_images -type f -exec mv -f {} $path_to_images \;
find $path_to_images* -type d -exec rm -rf {} \;
