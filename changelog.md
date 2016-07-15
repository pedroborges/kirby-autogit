# Change Log
All notable changes to this project will be documented in this file.

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
