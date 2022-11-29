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
