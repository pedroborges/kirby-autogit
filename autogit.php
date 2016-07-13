<?php

/**
 * Kirby Auto Git Plugin
 *
 * @version   0.4.0
 * @author    Pedro Borges <oi@pedroborg.es>
 * @copyright Pedro Borges <oi@pedroborg.es>
 * @link      https://github.com/pedroborges/kirby-autogit
 * @license   MIT
 */

if (class_exists('Panel') or r::has('secret')) {
    // Load classes
    require_once(__DIR__ . DS . 'vendor' . DS . 'autoload.php');
    require_once(__DIR__ . DS . 'lib' . DS . 'autogit.php');

    // Load hooks
    require_once(__DIR__ . DS . 'lib' . DS . 'hooks.php');

    // Load routes
    if (c::get('autogit.webhook.secret', false)) {
        require_once(__DIR__ . DS . 'lib' . DS . 'routes.php');
    }

    // Load widgets
    if (c::get('autogit.widget', true)) {
        require_once(__DIR__ . DS . 'lib' . DS . 'widgets.php');
    }
}
