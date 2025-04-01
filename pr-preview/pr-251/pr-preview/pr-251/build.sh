#!/bin/bash

BUILD_BASE="/opt/buildhome/repo"
INPUT_BASE="https://raw.githubusercontent.com/phalcon/assets/master/phalcon"

echo "Updating Sponsors"
wget -O "$BUILD_BASE/_includes/sponsors.html" "$INPUT_BASE/sponsors-fragment.html"

echo "Updating Fan Art"
wget -O "$BUILD_BASE/_includes/fanart.html" "$INPUT_BASE/fanart-fragment.html"

echo "Updating Footer"
wget -O "$BUILD_BASE/_includes/footer.html" "$INPUT_BASE/footer-fragment.html"

echo "Building Site"
jekyll build
