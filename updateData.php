<?php

$base      = "/opt/build/repo/";
echo "Updating Sponsors" . PHP_EOL;

$data = file_get_contents(
    'https://raw.githubusercontent.com/phalcon/assets/master/phalcon/sponsors-fragment.html'
);

file_put_contents(
    $base . '_includes/sponsors.html',
    $data
);

echo "Updating Fan Art" . PHP_EOL;

$data = file_get_contents(
    'https://raw.githubusercontent.com/phalcon/assets/master/phalcon/fanart-fragment.html'
);

file_put_contents(
    $base . '_includes/fanart.html',
    $data
);

echo "Updating Footer" . PHP_EOL;

$data = file_get_contents(
    'https://raw.githubusercontent.com/phalcon/assets/master/phalcon/footer-fragment.html'
);

file_put_contents(
    $base . '_includes/footer.html',
    $data
);
