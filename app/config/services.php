<?php

use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
}, true);

/**
 * Setting up the view component
 */
$di->set('view', function () use ($config) {

    $view = new View();

    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines(array(
        '.volt' => function ($view, $di) use ($config) {

            $volt = new VoltEngine($view, $di);

            $volt->setOptions(array(
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_'
            ));

            return $volt;
        },
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
    ));

    return $view;
}, true);

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function () use ($config) {
    return new DbAdapter(array(
        'host' => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname' => $config->database->dbname
    ));
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

/**
 * Make custom dispatcher for security redirects
 */
$di->set('dispatcher',function() use ($di) {
    //obtain the standared eventsManager from DI 
    $eventsManager = $di->getShared('eventsManager');
    
    //Instantiate the Security plugin
    $security = new Security($di);
    
    //listen for events produced in the dispatcher using the Security plugin
    $eventsManager->attach('dispatch',$security);
    
    $dispatcher = new Phalcon\Mvc\Dispatcher();
    
    //bind the EventsManager to the Dispatcher
    $dispatcher->setEventsManager($eventsManager);
    
    return $dispatcher;
});

/**
 * Setup flash service
 */
$di->set('flash',function(){
   return new \Phalcon\Flash\Direct(array(
    'error'     =>  'alert alert-danger',
    'success'   =>  'alert alert-success',
    'notice'    =>  'alert alert-info',
    ));
});
$di->set('flashSession',function(){
   return new \Phalcon\Flash\Session(array(
    'error'     =>  'alert alert-danger',
    'success'   =>  'alert alert-success',
    'notice'    =>  'alert alert-info',
));
});

/**
 * Register a user component
 */
$di->set('elements',function(){
    return new Elements();
});