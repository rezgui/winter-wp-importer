<?php

namespace Rezgui\Wpimporter;

use Backend;
use Rezgui\Wpimporter\Models\Wpimporter;
use System\Classes\PluginBase;
use System\Classes\PluginManager;

/**
 * Wpimporter Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * @var array Plugin dependencies
     *
     * Dependencies not required as plugins will be checked on the fly
     */
    public $require = [];

    /**
     * On Boot functions
     *
     * @return void
     */
    public function boot()
    {
        //Defaults
        $blogPost = 'Winter\\Blog\\Models\\Post';
        $plugin = Wpimporter::getBlogVersionInstalled();

        //If we have a plugin installed, then overwrite fillables
        if ($blogPost) {
            $blogPost::extend(function ($model) {
                $model->fillable(['user_id', 'title', 'slug', 'excerpt', 'content', 'published_at', 'published']);
            });
        }
    }

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Wordpress Post Importer',
            'description' => 'Allows you to import Wordpress Posts into Winter Blog plugin',
            'author'      => 'Rezgui',
            'icon'        => 'icon-download'
        ];
    }

    /**
     * Returns settings menu items.
     *
     * @return array
     */
    public function registerSettings()
    {
        $plugin = Wpimporter::getBlogVersionInstalled();

        return [
            'wpimportersettings' => [
                'label'       => 'Wordpress Importer for Blog',
                'description' => 'Import Wordpress posts into Blog plugin.',
                'icon'        => 'icon-download',
                'class'       => 'Rezgui\wpimporter\Models\Wpimporter',
                'order'       => 1
            ]
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        //Access to Components
        return [
            'Rezgui.rezgui.access_component_menu'   => ['tab' => 'Component Section', 'label' => 'Access to Component Section', 'order' => 800],
            'Rezgui.wpimporter.access_wpimporter' => ['tab' => 'Component Section', 'label' => 'Access to WP Importer', 'order' => 801],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [];
    }
}
