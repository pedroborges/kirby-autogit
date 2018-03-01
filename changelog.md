# Change Log
All notable changes to this project will be documented in this file.

## [0.6.1] - 2018-03-01
### Fixed
- Bug where panel routes where not being registered.

## [0.6.0] - 2018-02-13
### Added
- `autogit` option: disables the plugin.

### Changed
- Git `user.name` and `user.email` local configuration are no longer replaced. Instead, the plugin now sets the author with the `git commit --author` flag.
- The plugin no longer checks if the `content` folder is a Git repo since it required an extra command to be run. Use the `autogit` option to disable the plugin when needed.

### Removed
- `autogit.branch` option: Auto Git will always use local current branch.

## [0.5.0] - 2016-07-15
### Added
- `autogit()` global function.
- Auto Git now triggers its own hooks: `autogit.pull` and `autogit.push`.
- Enable webhooks only when a remote repository has been setup.
- Show error on the widget when a remote repository has not been setup yet.

### Changed
- Allow Auto Git to run on older Git releases.
- Redirect to error page when webhooks secret mismatches.
- Show Git errors on the widget when pulling/pushing.
- Widget title to "Sync Content".

### Fixed
- Disable button when another action is in progress.

## [0.4.0] - 2016-07-13
### Added
- Panel widget with pull/push buttons.

## [0.3.0] - 2016-07-08
### Fixed
- Library sebastian/git was not being included on the release tarball.


## [0.2.0] - 2016-07-08
### Added
- Webhooks.

## [0.1] - 2016-07-08
### Added
- Panel hooks.
- en, pt-BR and pt-PT translation.
