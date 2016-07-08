# Kirby Auto Git Plugin [![Release](https://img.shields.io/github/release/pedroborges/kirby-autogit.svg)](https://github.com/pedroborges/kirby-autogit/releases) [![Issues](https://img.shields.io/github/issues/pedroborges/kirby-autogit.svg)](https://github.com/pedroborges/kirby-autogit/issues)

## Requirements
- Kirby 2.2.3+
- PHP 5.6+

## Main features
- Works on any Kirby structure
- Auto commit
- Localized commit messages
- Panel user as commit author

## Installation

### Site Structure
You can use whatever site structure fits better your needs. It doesn't matter whether your `content` folder is part of the main Git repo or is a submodule. Auto Git is smart enough to only commit changes made inside the `content` folder.

> Internally Auto Git uses `kirby()->roots()->content()` to detect the `content` folder. It can have whatever name you've registered on your Kirby installation.

### Download
[Download the files](https://github.com/pedroborges/kirby-autogit/archive/master.zip) and place them inside `site/plugins/autogit`.

### Kirby CLI
Kirby's [command line interface](https://github.com/getkirby/cli) makes installing the Auto Git plugin a breeze:

    $ kirby plugin:install pedroborges/kirby-autogit

Updating couldn't be any easier, simply run:

    $ kirby plugin:update pedroborges/kirby-autogit

### Git Submodule
You can add the Auto Git plugin as a Git submodule.

    $ cd your/project/root
    $ git submodule add https://github.com/pedroborges/kirby-autogit.git site/plugins/autogit
    $ git submodule update --init --recursive
    $ git commit -am "Add Kirby Auto Git plugin"

Updating is as easy as running a few commands.

    $ cd your/project/root
    $ git submodule foreach git checkout master
    $ git submodule foreach git pull
    $ git commit -am "Update submodules"
    $ git submodule update --init --recursive

## Options
The following options can be set in your `/site/config/config.php`:

    c::set('autogit.branch', 'master');
    c::set('autogit.panel.user', true);
    c::set('autogit.user.name', 'Auto Git');
    c::set('autogit.user.email', 'autogit@localhost');
    c::set('autogit.language', 'en');
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
Sets the Git branch where commits will go to. Auto Git **won't** create the branch for you, make sure it exists prior to changing the default value.

### autogit.panel.user
Sets if Auto Git should use Kirby's panel user name and email as commit author. This will enable you to see who made each change on your Git client of choice or simply by running `$ git log`. **The user must have first name and email set on their account info.**

![User detail](https://raw.githubusercontent.com/pedroborges/kirby-autogit/master/account_info.png)

> Options `autogit.user.name` and `autogit.user.email` will be overridden when this is set to `true`.

### autogit.user.name
Default commit author name. Applied only when the option `autogit.panel.user` is set to `false` or when user's first name isn't set on his account info.

### autogit.user.email
Default commit author email. Applied only when the option `autogit.panel.user` is set to `false` or when user's first name isn't set on his account info.

### autogit.language
Default commit language. You can choose from any of the languages that ships with Auto Git: `'en'`, `'pt_BR'` or `'pt_PT'`.

You can also use the `autogit.translation` option to provide a custom translation, see below.

> Feel free to send a pull request to add support for more languages.

### autogit.translation
An array containing a custom translation. This will override the default translation set in `autogit.language`.

## Roadmap
- Pull and push webhooks
- Panel widget

## FAQ

### How do I push commits from my server to a remote repo?
Right now the recommended way is to use a cron job to run `$ git push` frequently. Soon you'll have the option to do this manually from a panel widget or automatically by using a webhook to easily integrate with other services.

## License
<http://www.opensource.org/licenses/mit-license.php>

## Author
Pedro Borges <oi@pedroborg.es>
