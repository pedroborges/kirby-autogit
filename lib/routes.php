<?php

use Autogit\Autogit;

kirby()->routes([
    [
        'pattern' => c::get('autogit.webhook.url', 'autogit') . '/(:any)',
        'method'  => 'GET|POST',
        'action'  => function($action) {
            $secretMatches = r::get('secret') === c::get('autogit.webhook.secret');
            $validActions  = ['pull', 'push'];
            $errorMessage  = 'Something went wrong.';

            if (! $secretMatches or ! in_array($action, $validActions)) {
                return response::error($errorMessage);
            }

            try {
                $repo = new Autogit();
                $repo->{$action}();
            } catch (\Exception $e) {
                $errorMessage = empty($e->getMessage())
                    ? $errorMessage
                    : $e->getMessage();

                return response::error($errorMessage);
            }

            return response::success('Done!');
        }
    ]
]);
