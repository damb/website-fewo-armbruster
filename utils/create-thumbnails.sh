#!/bin/bash

PATH_GALLERY="../gallery"
PATH_GALLERY_THUMBNAILS="${PATH_GALLERY}/thumbnails"

for f in ${PATH_GALLERY}/*.jpg
do
  fname="$(basename $f)"
  convert \
    -define jpeg:size=500x180 \
    "${f}" \
    -auto-orient \
    -thumbnail 360x120 \
    -unsharp 0x.5 \
    "${PATH_GALLERY_THUMBNAILS}/${fname}"
done
