.PHONY: build dev composer craft pull seed up install

build: up
	ddev exec npm run build
dev: build
	ddev exec npm run serve
pull: up
	ddev exec bash scripts/pull_assets.sh
	ddev exec bash scripts/pull_db.sh
seed: up build
	ddev exec php craft setup/app-id \
		$(filter-out $@,$(MAKECMDGOALS))
	ddev exec php craft setup/security-key \
		$(filter-out $@,$(MAKECMDGOALS))
	ddev import-db --src=seed.sql
	ddev exec php craft up
	ddev exec php craft project-config/write
install: up build
	ddev exec php craft setup/app-id \
		$(filter-out $@,$(MAKECMDGOALS))
	ddev exec php craft setup/security-key \
		$(filter-out $@,$(MAKECMDGOALS))
	ddev exec php craft install \
		$(filter-out $@,$(MAKECMDGOALS))
	ddev exec php craft plugin/install imager-x
	ddev exec php craft plugin/install redactor
	ddev exec php craft plugin/install seomatic
	ddev exec php craft plugin/install minify
	ddev exec php craft plugin/install image-resizer
	ddev exec php craft plugin/install navigation
	ddev exec php craft plugin/install wheelform
	ddev exec php craft plugin/install sprig
	ddev exec php craft plugin/install vite
	ddev exec php craft plugin/install blitz
	ddev exec php craft plugin/install blitz-recommendations
	ddev exec php craft plugin/install phpdotenv
up:
	# if DDEV hasn't been set up, set it up and install the Composer and NPM things
	if [ ! "$$(ddev describe | grep OK)" ]; then \
		ddev auth ssh; \
		ddev start; \
	fi
%:
	@:
# ref: https://stackoverflow.com/questions/6273608/how-to-pass-argument-to-makefile-from-command-line
