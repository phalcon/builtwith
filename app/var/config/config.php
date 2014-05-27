<?php

return new \Phalcon\Config(array(
    'application' => array(
        'cdnUrl'         => 'http://d2yyr506dy8ck0.cloudfront.net',
        'controllersDir' => ROOT_PATH . '/app/controllers/',
        'modelsDir'      => ROOT_PATH . '/app/models/',
        'viewsDir'       => ROOT_PATH . '/app/views/',
        'varDir'         => ROOT_PATH . '/app/var/',
        'cacheDir'       => ROOT_PATH . '/app/var/cache/',
        'baseUri'        => '/',
    )
));
