# Craft4 Starter

NOTE: THIS PROJECT IS NOT COMPLETE, DO NOT USE IT YET

This is the base project from which all VCA projects using Craft4 are built.

The templates/css/config etc are a from-scratch rebuild starting from a beta of Craft4. It is not an upgrade from our previous Craft3 based starter project, though it does re-use some code.

For our development environment we are switching from Pixel & Tonic's "Nitro", which is limited and seems to be more or less abandoned, to a DDEV based system which is heavily copied from onedarnleyroad/craftcms - but with our own customisations (we don't use Tailwind, Alpine etc).

## VCA Staff Orientation

We used to use GIT on a self-hosted server in the VCA offices. Moving to GitHub should give us some benefits:

- We don't have to manage the set-up and maintenance of a GIT server
- The office, office network, and office hardware will not be points of failure
- Checkouts should be faster as we aren't limited to the office upload speed
- Backups are handled by Microsoft instead of us
- It is much easier to onboard anyone new, or a freelancer
- It will allow us to put sites live via GIT rather than SFTP
- We will be able to take advantage of things like Issues if we want

You may want to download [GitHub Desktop](https://desktop.github.com/) as a GUI for managing GitHub projects, though it is not necessary.

## Branches

You may not be aware of "branches" in GIT. We have so far always worked on the `master` branch (now called `main` to avoid problematic language). From now on, we will make use of Branches to better organise things.

Our default branch is called `develop` and it means that anything in the branch is a work in progress. The stuff in it is expected to change. When we decide we want to make a website live, we will create a new branch called `live` and all of our work will be copied into that branch. We'll then checkout the `live` branch on the live server.

This means we can work locally on a `develop` branch without effecting anything in the `live` branch. When we're done adding new features and making changes we can then _merge_ the changes from the `develop` branch into the `live` branch. Then all we need to do is `git pull` on the live server to get it to reflect the new work. This way the live server only ever uses the `live` branch, and we **only ever work on the `develop` branch**, we never do work directly on the `live` branch.

We're also able to make new branches. For example if we had a site that was live, that was also having some new features developed, but we also needed to run some updates on the live site without deploying our in-progress work... we'd create a new temporary branch _from_ `live` called `updates`, run the updates on that, commit them, then _merge_ `updates` into `live`... then we just `git pull` on live and it'll have the updates, without any of our in-progress work.

Because databases are not kept in GIT we may sometimes need (locally) more than one database per project, to reflect a live or develop branch. Just something to keep in mind.

## Changes from our Craft3 build

- macros are now split out from one giant file into multiple more targeted files.
  - e.g., `{% import '_macros/helpers' as helpers -%}`
- Craft4 now has [Laravel's "Collections"](https://laravel.com/docs/9.x/collections) and we should use those almost every time. Here's a [catch-up on Collection](https://craftquest.io/articles/easier-eager-loading-with-collections)
  - `.all()` and `.one()` are now usually replaced with `.collect()`

## Creating a new project

Now uses DDEV, and this repository is itself a Craft CMS starter project using DDEV for local hosting and Vite for front-end bundling and HMR.

> 1. `composer create-project...`
> 2. `make install`
> 3. `make dev`

## The development environment

- [DDEV](https://ddev.readthedocs.io/) for local development
- [Vite 2.x](https://vitejs.dev/) for front-end bundling & HMR
- [Makefile](https://www.gnu.org/software/make/manual/make.html) for common CLI commands

## Local machine prerequisites:

1. [Docker](https://www.docker.com/)
2. [DDEV](https://ddev.readthedocs.io/), minimum version 1.19
3. Optional but recommended, [Composer](https://getcomposer.org/)

## Getting Started

### Option 1: With Composer (recommended)

If you have [Composer](https://getcomposer.org/) installed on your local machine - or an alias to a Docker container - you can use `create-project` to pull the latest tagged release.

Open terminal prompt, and run:

```shell
composer create-project view-creative-agency/craft4-starter PATH --no-install
```

Make sure that `PATH` is a **new** or **existing and empty** folder on your own machine.

### Option 2: With Git CLI

Alternatively you can clone the repo via the Git CLI:

```shell
git clone git@github.com:view-creative-agency/craft4-starter.git PATH
```

Make sure that `PATH` is a **new** _or_ **existing and empty** folder on your own machine.

Next, you'll want to discard the existing `/.git` directory. In the terminal, run:

```shell
cd PATH
rm -rf .git
```

Last, clean up and set some default files for use:

```shell
cp .env.example .env
mv -f composer.json.default composer.json
mv -f .gitignore.default .gitignore
rm CHANGELOG.md && rm LICENSE.md && rm README.md
```

### Option 3: Manual Download

Download a copy of the repo to your local machine and move to where you want to your project to run. Similar to above, you'll then want to clean up and set some default files for use. In the terminal, run:

```shell
cd PATH
cp .env.example .env
mv -f composer.json.default composer.json
mv -f .gitignore.default .gitignore
rm CHANGELOG.md && rm LICENSE.md && rm README.md
```

## Configuring DDEV

```shell
ddev config
```

Follow the prompts.

- **Project name:** e.g. `mysite` would result in a project URL of `https://mysite.ddev.site` (make note of this for later in the installation process)
- **Docroot location:** defaults to `web`, keep as-is
- **Project Type:** defaults to `craftcms`, keep as-is

## Installing Craft

### Getting the existing example CMS with data included (recommended):

```shell
make seed
```

This will install everything you need, and start up your browser with the project running.

### To install a clean version of Craft with a totally blank database:

```shell
make install
```

Follow the prompts.

This command will:

1. Copy your local SSH keys into the container (handy if you are setting up [craft-scripts](https://github.com/nystudio107/craft-scripts/))
2. Start your DDEV project
3. Install Composer
4. Install npm
5. Do a one-time build of Vite
6. Generate `APP_ID` and save to your `.env` file
7. Generate `SECURITY_KEY` and save to your `.env` file
8. Installing Craft for the first time, allowing you to set the admin's account credentials
9. Install all Craft plugins

Once the process is complete, type `ddev launch` to open the project in your default browser. 🚀

## Local development with Vite

To begin development with Vite's dev server & HMR, run:

```shell
make dev
```

This command will:

1. Copy your local SSH keys into the container (handy if you are setting up [craft-scripts](https://github.com/nystudio107/craft-scripts/))
2. Start your DDEV project
3. Install Composer
4. Install npm
5. Do a one-time build of Vite
6. Spin up the Vite dev server

Open up a browser to your project domain to verify that Vite is connected. Begin crafting beautiful things. ❤️

An important point: At this moment the project is *NOT IN GIT* it's just there on your machine.
You must make a new repo for it yourself - see the wiki.

## Makefile

A Makefile has been included to provide a unified CLI for common development commands.

- `make install` - Runs a complete one-time process to set the project up and install Craft.
- `make up` - Starts the DDEV project, ensuring that SSH keys have been added, and npm & Composer have been installed.
- `make dev` - Runs a one-time build of all front-end assets, then starts Vite's server for HMR.
- `make build` - Builds all front-end assets.
- `make composer xxx` - Run Composer commands inside the container, e.g. `make composer install`
- `make craft xxx` - Run Craft commands inside the container, e.g. `make craft project-config/touch`
- `make npm xxx` - Run npm commands inside the container, e.g. `make npm install`
- `make pull` - Pull remote db & assets (requires setting up [craft-scripts](https://github.com/nystudio107/craft-scripts/)

### Adding PostCSS Plugins

Needs to be done as something like: `ddev exec npm install --save-dev postcss-nesting`
After which you can edit the `postcss.config.js` file to actually use it.

## Acknowledgements & Credits

- [Pixel & Tonic](https://pixelandtonic.com/) Makers of Craft CMS.
- [nystudio107](https://nystudio107.com/) Just a legend in the Craft world. You know him.
- [One Darnley Road](https://github.com/onedarnleyroad) Wrangling Craft and DDEV together.
