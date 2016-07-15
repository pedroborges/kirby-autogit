<?php

/**
 * Kirby Auto Git Plugin
 *
 * @version   0.5.0
 * @author    Pedro Borges <oi@pedroborg.es>
 * @copyright Pedro Borges <oi@pedroborg.es>
 * @link      https://github.com/pedroborges/kirby-autogit
 * @license   MIT
 */

// Load Auto Git class and dependencies
require_once(__DIR__.DS.'vendor'.DS.'autoload.php');
require_once(__DIR__.DS.'lib'.DS.'autogit.php');

// Helper function that returns an Autogit\Autogit instance
function autogit() {
    return Autogit\Autogit::instance();
}

// Only load hooks, routes and widgets when
// the content directory is a Git repo
if (autogit()->isRepo()) {
    // Load hooks
    require_once(__DIR__.DS.'lib'.DS.'hooks.php');

    // Load routes
    if (c::get('autogit.webhook.secret', false) and autogit()->hasRemote()) {
        require_once(__DIR__.DS.'lib'.DS.'routes.php');
    }

    // Load widgets
    if (c::get('autogit.widget', true)) {
        kirby()->set('widget', 'autogit', __DIR__.DS.'widgets'.DS.'autogit');
    }
}
