<?php

/**
 * Created by PhpStorm.
 * User: chanaka
 * Date: 10/26/16
 * Time: 12:03 PM
 *
 *  in the mount method mounts routes (using mounting mechanism provided by Silex)
 *
 *  example of mounting routes
 *  $app->mount(ROUTE_NAME,CONTROLLER_PROVIDER);
 *
 */

namespace plugins;

use Silex\Application;

class RouteMounter
{
    public static function mount(Application $app)
    {

        $pluginDirs = new \DirectoryIterator(dirname(__FILE__));
        while ($pluginDirs->valid()) {

            $plugin_abs_name = $pluginDirs->getFilename();
            if (strpos($plugin_abs_name, 'Plugin') !== false) {
                $plugin_name = str_replace('Plugin', '', $plugin_abs_name);
                $provider_path = dirname(__FILE__) . '/' . $pluginDirs->getFilename() .
                    "/Provider/" . $plugin_name . "ControllerProvider.php";

                if (file_exists($provider_path)) {
                    $route_name = strtolower($plugin_name);
                    $controller_provider = "plugins\\" . $pluginDirs->getFilename() . "\\Provider\\"
                        . $plugin_name . "ControllerProvider";
                    $app->mount($route_name, new $controller_provider());
                }
            }
            $pluginDirs->next();
        }
    }
}