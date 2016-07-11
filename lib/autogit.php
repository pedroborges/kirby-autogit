<?php

namespace Autogit;

use SebastianBergmann\Git\Git;
use C;

class Autogit extends Git
{
    protected $localBranch;
    protected $remoteBranch;
    protected $remoteName;

    public function __construct()
    {
        parent::__construct(kirby()->roots()->content());

        $this->localBranch  = c::get('autogit.branch', 'master');
        $this->remoteBranch = c::get('autogit.remote.branch', $this->localBranch);
        $this->remoteName   = c::get('autogit.remote.name', 'origin');

        $this->setBranch();
        $this->setUser(site()->user());
    }

    public static function save(...$params)
    {
        $git = new self;

        $message = $git->getMessage($params[0], array_slice($params, 1));

        $git->add();
        $git->commit($message);
    }

    public function add($path = false)
    {
        $path = $path ? $path : kirby()->roots()->content();
        $this->execute('add '.escapeshellarg($path));
    }

    public function commit($message)
    {
        $this->execute('commit -m '.escapeshellarg($message));
    }

    public function pull()
    {
        $this->execute("pull {$this->remoteName} {$this->remoteBranch}");
    }

    public function push()
    {
        $this->execute("push {$this->remoteName} {$this->remoteBranch}");
    }

    public function setBranch($branch = false)
    {
        $branch = $branch ? $branch : c::get('autogit.branch', 'master');
        $this->execute("checkout -q '{$branch}'");
    }

    protected function setUser($user)
    {
        $preferUser = c::get('autogit.panel.user', true);
        $userName = c::get('autogit.user.name', 'Kirby Auto Git');
        $userEmail = c::get('autogit.user.email', 'autogit@localhost');

        if ($preferUser and $user and $user->firstname()) {
            $userName = $user->firstname();

            if ($user->lastname()) {
                $userName .= ' '.$user->lastname();
            }

            $userEmail = $user->email();
        }

        $this->execute("config user.name '{$userName}'");
        $this->execute("config user.email '{$userEmail}'");
    }

    protected function getMessage($key, $params)
    {
        $translation = c::get('autogit.translation', false);

        if (! $translation) {
            $translations = require __DIR__.DS.'translations.php';
            $language = kirby()->option('panel.language', 'en');

            if (! array_key_exists($language, $translations)) {
                $language = 'en';
            }

            $translation = $translations[$language];
        }

        array_unshift($params, $translation[$key]);

        return sprintf(...$params);
    }
}
