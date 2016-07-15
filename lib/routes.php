<?php

function autogitRoute($action, $source = null) {
    try {
        autogit()->{$action}();
    } catch (\Exception $e) {
        $errorMessage = empty($e->getMessage())
            ? 'Something went wrong.'
            : $e->getMessage();

        return response::error($errorMessage);
    }

    kirby()->trigger("autogit.{$action}", $source);

    return response::success('Done!');
}

// Add widget route
if (class_exists('Panel')) {
    panel()->routes([
        [
            'pattern' => 'autogit/(:any)',
            'method' => 'POST',
            'action' => function($action) {
                $validActions  = ['pull', 'push'];

                if (! in_array($action, $validActions)) {
                    return response::error('Something went wrong.');
                }

                return autogitRoute($action, 'widget');
            }
        ]
    ]);
}

// Add webhook route
kirby()->routes([
    [
        'pattern' => c::get('autogit.webhook.url', 'autogit').'/(:any)',
        'method'  => 'GET|POST',
        'action'  => function($action) {
            $secretMatches = r::get('secret') === c::get('autogit.webhook.secret');
            $validActions  = ['pull', 'push'];

            if (! $secretMatches or ! in_array($action, $validActions)) {
                return go(site()->errorPage());
            }

            return autogitRoute($action, 'webhook');
        }
    ]
]);
