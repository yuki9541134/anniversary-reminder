<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    // ユーザーページ
    $routes->connect('/users/login_form', ['controller' => 'Users', 'action' => 'loginForm']);
    $routes->connect('/users/login', ['controller' => 'Users', 'action' => 'login'])
        ->setMethods(['POST']);
    $routes->connect('/users/logout', ['controller' => 'Users', 'action' => 'logout']);
    $routes->connect('/users/new', ['controller' => 'Users', 'action' => 'new']);
    $routes->connect('/users/add', ['controller' => 'Users', 'action' => 'add'])
        ->setMethods(['POST']);

    // 大切な人ページ
    $routes->connect('/precious-users/index', ['controller' => 'PreciousUsers', 'action' => 'index']);
    $routes->connect('/precious-users/new', ['controller' => 'PreciousUsers', 'action' => 'new']);
    $routes->connect('/precious-users/add', ['controller' => 'PreciousUsers', 'action' => 'add'])
        ->setMethods(['POST']);
    $routes->connect('/precious-users/edit/:id', ['controller' => 'PreciousUsers', 'action' => 'edit'])
        ->setPass(['id']);
    $routes->connect('/precious-users/update', ['controller' => 'PreciousUsers', 'action' => 'update'])
        ->setMethods(['POST', 'PUT']);
    $routes->connect('/precious-users/delete/:id', ['controller' => 'PreciousUsers', 'action' => 'delete'])
        ->setPass(['id'])
        ->setMethods(['POST','DELETE']);

    // 記念日ページ
    $routes->connect('/anniversaries/index', ['controller' => 'Anniversaries', 'action' => 'index']);
    $routes->connect('/anniversaries/new', ['controller' => 'Anniversaries', 'action' => 'new']);
    $routes->connect('/anniversaries/add', ['controller' => 'Anniversaries', 'action' => 'add'])
        ->setMethods(['POST']);
});

/**
 * Load all plugin routes. See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
