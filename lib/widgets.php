<?php

use Autogit\Autogit;

// Load widget
kirby()->set('widget', 'autogit', __DIR__ . DS . 'widgets');

// Add panel route
if (class_exists('Panel')) {
    panel()->routes([
        [
          'pattern' => 'autogit/(:any)',
          'method' => 'POST',
          'action' => function($action) {
              $validActions  = ['pull', 'push'];

              if (! in_array($action, $validActions)) {
                  return response::error('Invalid action.');
              }

              try {
                  $repo = new Autogit();
                  $repo->{$action}();
              } catch (\Exception $e) {
                  $errorMessage = empty($e->getMessage())
                      ? 'Something went wrong.'
                      : $e->getMessage();

                  return response::error($errorMessage);
              }

              return response::success('Done!');
          }
        ]
    ]);
}
