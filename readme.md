# Kirby Auto Git [![Release](https://img.shields.io/github/release/pedroborges/kirby-autogit.svg)](https://github.com/pedroborges/kirby-autogit/releases) [![Issues](https://img.shields.io/github/issues/pedroborges/kirby-autogit.svg)](https://github.com/pedroborges/kirby-autogit/issues)

Auto Git is a Kirby CMS plugin that commits to a Git repo every time content is changed via Kirby's Panel… It does a few more things too!

## Main features
- Works on any Kirby structure
- Auto-commit
- Webhook URLs for pull and push events
- Panel widget for pushing/pulling manually
- Localized commit messages
- Uses panel user as commit author
- Triggers pull and push events

## Requirements
- Git
- Kirby 2.3.0+
- PHP 5.6+

> If you can't upgrade to Kirby 2.3.0+ but want to use Auto Git, auto-commit and webhook features should work fine on Kirby 2.1.0+.

## Installation

### Site Structure
You can use whatever site structure fits your needs better. It doesn't matter whether your `content` folder is part of the main Git repo or is a submodule. Auto Git is smart enough to only commit changes made inside the `content` folder.

> Internally Auto Git uses `kirby()->roots()->content()` to detect the `content` folder. It can have whatever name you've registered on your Kirby installation.

> In case there's anything inside the `content` that you don't want to commit, make sure to add it to `.gitignore`.

### Download
[Download the files](https://github.com/pedroborges/kirby-autogit/archive/master.zip) and place them inside `site/plugins/autogit`.

### Kirby CLI
Kirby's [command line interface](https://github.com/getkirby/cli) makes installing the Auto Git a breeze:

    $ kirby plugin:install pedroborges/kirby-autogit

Updating couldn't be any easier, simply run:

    $ kirby plugin:update pedroborges/kirby-autogit

### Git Submodule
You can add the Auto Git as a Git submodule.

    $ cd your/project/root
    $ git submodule add https://github.com/pedroborges/kirby-autogit.git site/plugins/autogit
    $ git submodule update --init --recursive
    $ git commit -am "Add Kirby Auto Git"

Updating is as easy as running a few commands.

    $ cd your/project/root
    $ git submodule foreach git checkout master
    $ git submodule foreach git pull
    $ git commit -am "Update submodules"
    $ git submodule update --init --recursive

## Options
The following options can be set in your `/site/config/config.php`:

    c::set('autogit.branch',         'master');
    c::set('autogit.remote.name',    'origin');
    c::set('autogit.remote.branch',  'master');

    c::set('autogit.webhook.secret', false);
    c::set('autogit.webhook.url',    'autogit');

    c::set('autogit.panel.user',     true);
    c::set('autogit.user.name',      'Auto Git');
    c::set('autogit.user.email',     'autogit@localhost');

    c::set('autogit.widget',         true);

    c::set('autogit.language',       'en');
    c::set('autogit.translation', [
        'site.update'  => 'Changed site options',
        'page.create'  => 'Created page %s',
        'page.update'  => 'Updated page %s',
        'page.delete'  => 'Deleted page %s',
        'page.sort'    => 'Sorted page %s',
        'page.hide'    => 'Hid page %s',
        'page.move'    => 'Moved page %1$s to %2$s',
        'file.upload'  => 'Uploaded file %s',
        'file.replace' => 'Replaced file %s',
        'file.rename'  => 'Renamed file %s',
        'file.update'  => 'Updated file %s',
        'file.sort'    => 'Sorted file %s',
        'file.delete'  => 'Deleted file %s',
    ]);

### autogit.branch
Git branch where commits will go to. Auto Git **won't** create the branch for you, make sure it exists prior to changing the default value.

### autogit.remote.name
Which remote repository to use. Defaults to `origin`.

> Auto Git won't add the remote repo for you. Add one on your server prior to using this feature.

### autogit.remote.branch
Which remote branch to use when pulling/pushing. In case one is not provided, Auto Git will try to use the same branch as the local one.

### autogit.webhook.secret
Auto Git provides a webhook which you can use to trigger `pull` and `push` commands from other services. The webhook will be activated **only** when a `secret` has been defined:

    // Pick a long string
    c::get('autogit.webhook.secret', 'MySuperSecret16');

After that, the following URLs will be available to you:

    https://yousite.com/autogit/pull?secret=MySuperSecret16
    https://yousite.com/autogit/push?secret=MySuperSecret16

> Don't forget to pass the `secret` as an argument.

> Webhooks we only be enabled when the remote repository defined in the `autogit.remote.name` option exists. Add one by running `git remote add <name> <url>`.

To pull changes on your server every time the remote repo receives a new push, go to **your repo** on Bitbucket/Github/Gitlab then navigate to `settings` > `webhooks` > `add webhook` (these steps are almost the same across all providers).

- URL: `https://yousite.com/autogit/pull?secret=MySuperSecret16`
- Secret: _leave blank_
- Events/triggers: select `push` only
- Status: `active`
- SSL: `enable` (if your site supports it)

> Alternatively you can schedule a cron job to run `$ git push` and/or `$ git pull` frequently.

### autogit.webhook.url
Change the webhook URL segment to something else. Defaults to `autogit`.

    // https://yousite.com/webhook/pull?secret=MySuperSecret16
    c::get('autogit.webhook.url', 'webhook');

### autogit.panel.user
Defines if Auto Git should use Kirby's panel user name and email as commit author. This will enable you to see who made each change on your Git client of choice or simply by running `$ git log`. **The user must have first name and email set on their account info.**

![User detail](https://raw.githubusercontent.com/pedroborges/kirby-autogit/master/images/account_info.png)

> Options `autogit.user.name` and `autogit.user.email` will be overridden when this is set to `true`.

### autogit.user.name
Default commit author name. Applied only when the option `autogit.panel.user` is set to `false` or when user's first name isn't set on his account info.

### autogit.user.email
Default commit author email. Applied only when the option `autogit.panel.user` is set to `false` or when user's first name isn't set on his account info.

### autogit.widget
Auto Git will add a widget to the Panel by default, set this option to false to hide it.

![Auto Git widget](https://raw.githubusercontent.com/pedroborges/kirby-autogit/master/images/widget.png)

> In case a remote repository doesn't exist, the widget will only display an error message. Run `git remote add <name> <url>` to enable this feature.

### autogit.language
Default commit language. You can choose from any of the languages that ships with Auto Git: `'en'`, `'pt_BR'` or `'pt_PT'`.

You can also use the `autogit.translation` option to provide a custom translation (see below).

> Other languages are more than welcome. Feel free to send a pull request!

### autogit.translation
An array containing a custom translation. This will override the default translation set in `autogit.language`.

## Roadmap
- [X] Pull and push webhooks
- [X] Panel widget (pull/push buttons)
- [X] Trigger pull and push events
- [ ] Panel widget (show commit history)
- [ ] Panel widget (undo button)
- [ ] Panel widget (show commit diff)

## Change Log
All notable changes to this project will be documented at: <https://github.com/pedroborges/kirby-autogit/blob/master/changelog.md>

## License
Auto Git is open-sourced software licensed under the [MIT license](http://www.opensource.org/licenses/mit-license.php).

Copyright © 2016 Pedro Borges <oi@pedroborg.es>
