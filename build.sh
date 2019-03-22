#!/usr/bin/env bash

rm -f ./build/oc-redirectconidtionsuseragent-plugin.zip
zip -r ./build/oc-redirectconidtionsuseragent-plugin.zip . -x@build-exclude.txt
