<?php

/**
 * Kirby Auto Git Plugin
 *
 * @version   0.6.1
 * @author    Pedro Borges <oi@pedroborg.es>
 * @copyright Pedro Borges <oi@pedroborg.es>
 * @link      https://github.com/pedroborges/kirby-autogit
 * @license   MIT
 */

if (c::get('autogit', true)) {
    // Load Auto Git class and dependencies
    require_once(__DIR__.DS.'vendor'.DS.'autoload.php');
    require_once(__DIR__.DS.'lib'.DS.'autogit.php');
    
    // Helper function that returns an Autogit\Autogit instance
    function autogit() {
        return Autogit\Autogit::instance();
    }
    
    // Load routes
    require_once(__DIR__.DS.'lib'.DS.'routes.php');
    
    // Only load hooks, routes and widgets when
    // the content directory is a Git repo
    if (function_exists('panel')) {
        // Load hooks
        require_once(__DIR__.DS.'lib'.DS.'hooks.php');
    
        // Load widgets
        if (c::get('autogit.widget', true)) {
            kirby()->set('widget', 'autogit', __DIR__.DS.'widgets'.DS.'autogit');
        }
    }
}
