<!--
The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [MAJOR.MINOR.BUGFIX] - YEAR-MONTH-DAY
### Added (new features)
### Changed (changes in existing functionality)
### Deprecated (soon-to-be removed features)
### Removed (now removed features)
### Fixed (any bug fixes)
### Security (case of vulnerabilities)

The purpose of a changelog entry is to document the noteworthy difference, often across multiple commits, to communicate them clearly to end users
-->

# view-creative-agency/craft4-starter Changelog

## [1.0.40] 2024-01-12

### Fixed

- `config/blitz.php` had wrong values for SSI, now fixed.

## [1.0.39] 2024-01-08

### Changed

- Project Config files regenerated and new `seed.sql` to ensure that `Listing Image` does not have any constraints on it.

## [1.0.38] 2024-01-08

### Added

- Added a `uc_toggle` to show checkbox inputs as toggles.
- Now includes default translation files
- DDEV added a couple of new config files

### Changed

### Fixed

- `blitz.php` uncommented the Integrations; turns out they're all enabled by default, and their being set in this file is counter-productive as it then *disables* integrations that are commented out here.
	- This in turn fixes an issue where FeedMe imports might cause massive Blitz refresh queue jobs, because it was not operating in Batch mode without the integration functioning.
- Version numbering for the changelog got out of sync somewhere along the line.

## [1.0.35] 2023-11-28

### Added

- Sprig powered site search template

### Changed

- Updated News section to use the CardListing partial
- Saved Entries card listing now supports its own buttons
- Breadcrumbs can now opt out of listing the current page

## [1.0.34] 2023-11-11

### Fixed

- Ensure the subfolders for the `/backups` are kept.
- Ensure we actually keep the `_gitignore` folder.

## [1.0.33] 2023-11-11

### Changed

- Public User Account templates from Optec (/customer) and Blitz exceptions
- JSDoc implemented throughout multiple JS files
- Use `data-entry-type` rather than classes on the body
- Sprig no longer requires explicit loading of its own JS


## [1.0.33] 2023-09-06

### Fixed

- Removed database zip file that should not have been in the repo
- Fixed release date in changelog

## [1.0.32] 2023-09-05

### Changed

- Updated CKEditor defaults
- Updated packages
- All *.sql files are now gitignored to avoid accidental commits in other repos
- Updated Swiper
- Twitter is now X for logos
- Blitz will no longer cache URLs with query parameters

### Fixed

- Wheelform default email notification template now works properly
	- Which also fixes issues with Sprig "not sending forms"

## [1.0.31] 2023-07-10

### Changed

- Updated the Fetch JS wrapper to use modern private method syntax.
- Updated PostCSS nesting plugin for more modern features.
- The "Simple" CKEditor config no longer allows headings.
- The Helpers.js file has been refactored and modernised, with JSDoc comments too.
- We now target ES11 instead of ES6.
- JS that used to inject classes for state management now use data attributes instead, the CSS has also been updated.

### Added

- Initial code for CSS View Transitions.
- Image macro now outputs the Focal Point from the original image.
- Singles are now pre-loaded.

### Fixed

- Fixed error templates being missing (e.g., 404)

## [1.0.30] 2023-05-30

### Changed

- We now prevent User Enumeration attacks by default
- All `{% include ... %}` Twig templates now use the `.twig` file extension to keep PHP Storm happy.
- GitIgnore has been fixed to allow retention of `/backup/files` and `/backup/database` directories (but not their content)

### Removed

- Legacy Redactor code removed from templates

### Added

- CSS View Transitions supported by default
- IsSystemLive now controlled through the .env file

### Fixed

- Imager Optimizers set to ones available in Ubuntu 22.04
- Blitz config set to siteID 2, which is our default siteID for some reason
- Added missing favicon folder and content

## [1.0.29] 2023-05-11

### Changed

- HTML Purifier now allows all youtube and vimeo URLs
- Redactor configs removed

## [1.0.28] 2023-04-19

### Added

- CKEditor plugin
- Verbb Hyper plugin
- Closure plugin; so we can use Collection operations that require passing a function

### Changed

- Removed redundant commands from Makefile, as DDEV does them
- Updated npm dependencies (Vite 4, PCSS Nesting)
- Removed legacy SCSS includes from PCSS files
- Replaced Redactor fields with CKEditor fields
	- This due to official Pixel & Tonic recommendations. The existing Redactor plugin is based on an older Redactor version which is End Of Life. The newer Redactor isn't suitable, and CKEditor5 has good accessibility. Their recommendation is to switch.

### Removed

- Redactor plugin

## [1.0.27] 2023-03-21

### Added

- Added example "Saved / Liked Entries" functionality

### Changed

- Updated jsconfig to exclude un-needed folders

## [1.0.26] 2023-03-20

### Added

- Updated packages
- Default example for a search form
- Default example for a listing card
- Default templates for various system emails
- Default template for Commerce PDF of an Order

## [1.0.25] 2023-03-14

### Added

- New CSS to handle animation on page load for hero images

### Changed

- Adjusted default spacing between grouped elements in Mixed Content
- Globals are now Entries, in line with their scheduled removal from Craft 5
- Improved "AJAX" pop-up look and behaviour
- Re-named triggers for "data on scroll" to be more consistent
- Updated seed.sql

## [1.0.23] & [1.0.24] - 2023-03-07

### Removed

- Default module (in line with the base Pixel & Tonic Craft build)

### Added

- Generator (in line with the base Pixel & Tonic Craft build)
  - More info: [Generator documentation](https://craftcms.com/docs/4.x/extend/generator.html)

### Changed

- Store Plugin license keys in the .env file rather than in the Database
- Added Eager loading for "self loaded fields" on Entries
- Visually improved Sprig loaded forms (they get a spinner and 16:9 layout while loading)
- Breadcrumbs now have an ability to be manually defined or automatically generated

## [1.0.22] - 2023-02-17

### Changed

- SEOmatic auto-detects a live env and configures accordingly

## [1.0.21] - 2023-02-16

### Changed

- `uc_popup` now displays better.

### Added

- Example `_singles/contact.twig` template using Sprig and Wheelform so it's safe to use with Blitz
- Default config for Blitz, should it get installed for the project
  - `enableTemplateCaching` config setting is automatically disabled if Blitz is enabled, or the project is in a dev environment
- PATH_TO_MOCK_IMAGE - when in a dev environment, and set; replaces all images with this one (to allow dev work without needing all the content images).

### Fixed

- Added missing CSS to respect the choice of "text by image" expansion method within Mixed Content fields
- Added missing `.env` parameter for PATH_TO_CWEBP which is needed only on staging and live servers; Ubuntu doesn't have WebP support compiled into ImageMagik.

## [1.0.20] - 2023-02-12

### Added

- New animations for loading in sections on scroll
- All possible Email config is now controlled from `.env`

### Fixed

- /scripts/backup-db.sh database filename
- CRON is now able to run `scripts/backup.sh`
- "TEST_TO_EMAIL_ADDRESS" is now only applied when in a dev environment

### Changed

- Simplified all scripts
- Improved the `_macros/images.twig` to use an `aboveTheFold` parameter, controlling lazy-loading and fetch-priority
- Removed now pointless "HTML5 block elements" reset, browsers don't need it anymore

## [1.0.19] - 2023-01-24

### Added

- scripts to automate Permissions tasks
- `ll` now works inside DDEV ssh sessions

### Changed

- More accessible "visually hidden" CSS
- Use `expose` instead of `ports` for more secure DDEV configuration
- Moved the `composer install` and `npm install` steps into DDEV hooks, rather than as steps in the Makefile

## [1.0.18] - 2023-01-11

## Changed

- Updated the seed database for Gaz's user account preferences
- made Vite `serverPublic` relative so asset paths work on multisite projects

## [1.0.17] - 2023-01-04

### Fixed

- Sync scripts (for real this time)

## [1.0.16] - 2023-01-04

### Fixed

- Sync scripts

## [1.0.15] - 2023-01-04

### Added

- Container Query Polyfill is now included, and example PCSS and HTML exist to illustrate the use of Container Queries
- `/scripts` have been added to aid some common tasks
  - `pull-from-staging.sh` downloads `/web/content` to local from staging
  - `push-to-staging.sh` uploads `/web/content` and `/web/dist` from local to staging
  - `pull-from-live.sh` downloads `/web/content` to local from live
  - `push-to-live.sh` uploads `/web/content` and `/web/dist` from local to live
  - `backup.sh` backs up `/web/content` and a database dump to `/backups`

### Changed

- Mixed Content macro now wraps common-series of the same block type for styling purposes
  - e.g., "image, text, faq, faq, faq, text" would get the faq's wrapped in a container div
- Craft template caches are now enabled in any environment that is not Dev
- The Swiper library is now loaded from local files and not a CDN

## [1.0.14] - 2022-12-05

### Fixed

- Bug in markup for the JPG output of image macro
- Incorrect path for SVGs on social-share include

### Changed

- Updated seed database with new test-page content
- New options for image handling on Text by Image matrix blocks
- Always use shapes in the CMS and not just colours
- New example image macro that calls a sibling macro

## [1.0.13] - 2022-11-30

## Added

- `_macros/images.twig` for handling HTML output of imagerX named transforms
- Added example image macro for "nested" macros

## Changed

- Adjusted various templates to use the new image macro rather than hardcode the image HTML per instance of use

## [1.0.12] - 2022-11-30

## Changed

- Minor refactor of \_layout head

### Fixed

- Fixed broken ImagerX transforms using strings when numbers should have been used
- Fixed broken responsive-navigation.js
- layout class l_constrain now takes up 100% of available space by default

## [1.0.11] - 2022-11-29

### Changed

- Updated the `seed.sql` to include default password protected users

## [1.0.10] - 2022-10-26

### Changed

- Stopped the `seed.sql` from making it into new repositories, it's only needed for initial set-up

### Fixed

- Updated the README.md with more details about how to use this project
- Clarified what needs editing in the `.env.ddev` file after running this project

## [1.0.9] - 2022-10-25

### Added

- `make seed` command to populate the project with a starter database

### Fixed

- Duplicate key-value pair in .env.ddev
- Makefile mistake with seed command

## [1.0.8] - 2022-10-24

### Added

- `make seed` command to populate the project with a starter database

### Fixed

- Incorrect plugin name causing `make install` to fail

## [1.0.7] - 2022-10-24

This release marks the first attempt at a properly complete project ready to actually use.

### Changed

- Built out templates
- Built out basic PCSS
- Built out basic JS

## [1.0.6] - 2022-10-04

### Changed

- Vite now working correctly, with HMR
- Base CSS now working correctly

## [1.0.5] - 2022-07-10

### Changed

- Prevent full page reloading when JS changes [mirrored from OneDarnleyRoad update](https://github.com/onedarnleyroad/craftcms/commit/8bc36fc228965130d1cff01a68ee3920143a34f7)

## [1.0.4] - 2022-05-12

### Added

- Vite/PostCSS configured to use W3C draft spec compliant PostCSS Nesting
- Our normal starter Project Config settings for fields, sections, etc

### Changed

- Fixed alias paths so that Craft now runs correctly
- Fixed Makefile so that the correct plugins are installed
- Simplified the .env.example to remove unused variables
- Edited _layout.twig to remove jQuery based JS
- Edited _layout.twig to remove manual sourced CSS and switch out for Vite
- Edited index.twig to be a more normal base-line

## [1.0.3] - 2022-05-11

### Removed

- Purge remaining Tailwind detritus

## [1.0.2] - 2022-05-11

### Added

- Missing bootstrap.php file

## [1.0.1] - 2022-05-11

### Changed

- Fixed composer.json ready for Packagist

## [1.0.0] - 2022-05-11

### Added

- Everything; based on onedarnleyroad/craftcms
