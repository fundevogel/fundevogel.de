#!/bin/bash

for file in *
do
  convert $file -sampling-factor 4:2:0 -strip -quality 85 $file
done
