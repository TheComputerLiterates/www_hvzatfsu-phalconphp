<?php

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => 'www_hvzatfsu',
        'password'    => 'QmwRuZFw4XAmsnAe',
        'dbname'      => 'www_hvzatfsu',
    ),
    'application' => array(
        'controllersDir' => __DIR__ . '/../../app/controllers/',
        'modelsDir'      => __DIR__ . '/../../app/models/',
        'viewsDir'       => __DIR__ . '/../../app/views/',
        'pluginsDir'     => __DIR__ . '/../../app/plugins/',
        'formsDir'       => __DIR__ . '/../../app/forms/',
        'partialsDir'    => __DIR__ . '/../../app/views/partials/', 
        'libraryDir'     => __DIR__ . '/../../app/library/',
        'cacheDir'       => __DIR__ . '/../../app/cache/',
        'baseUri'        => '/hvz/',
    )
));
