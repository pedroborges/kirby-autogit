<?php

/**
 * Kirby Auto Git Plugin
 *
 * @version   0.1.0
 * @author    Pedro Borges <oi@pedroborg.es>
 * @copyright Pedro Borges <oi@pedroborg.es>
 * @link      https://github.com/pedroborges/kirby-autogit
 * @license   MIT
 */

if (class_exists('Panel')) {
    // Load classes
    require_once(__DIR__ . DS . 'vendor' . DS . 'git' . DS . 'src' . DS . 'Git.php');
    require_once(__DIR__ . DS . 'vendor' . DS . 'git' . DS . 'src' . DS . 'Exception' . DS . 'Exception.php');
    require_once(__DIR__ . DS . 'vendor' . DS . 'git' . DS . 'src' . DS . 'Exception' . DS . 'RuntimeException.php');
    require_once(__DIR__ . DS . 'lib' . DS . 'autogit.php');

    // Load hooks
    require_once(__DIR__ . DS . 'lib' . DS . 'hooks.php');
}
