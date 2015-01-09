#!/bin/bash

cat cartoWifi.txt | awk -F " " '{
	print $1,"\n",$2,"",$3
}'
