<?php

use Autogit\Autogit;

kirby()->routes([
    [
        'pattern' => c::get('autogit.webhook.url', 'autogit') . '/(:any)',
        'method'  => 'GET|POST',
        'action'  => function($action) {
            $secretMatches = r::get('secret') === c::get('autogit.webhook.secret');
            $validActions  = ['pull', 'push'];

            if (! $secretMatches or ! in_array($action, $validActions)) {
                return response::error('Something went wrong', 404);
            }

            try {
                $repo   = new Autogit();
                $output = $repo->{$action}();
            } catch (\Exception $e) {
                return response::error($e->getMessage());
            }

            return response::success();
        }
    ]
]);
