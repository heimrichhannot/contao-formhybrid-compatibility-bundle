# Contao Formhybrid Compatibility Bundle

A bundle enhancing [Formhybrid](https://github.com/heimrichhannot/contao-formhybrid) compatibility with our Contao 4 environment.

## Features
* support for [Encore Bundle](https://github.com/heimrichhannot/contao-encore-bundle)
* replaces jquery code with native js code

> Not all js features ported yet

Currently ported js features:
* asynchronous form submit
* scroll to status message after submit

## Install

1. Add this bundle as dependency
```sh
composer require heimrichhannot/contao-formhybrid-compatibility-bundle
```

1. Update your Encore bundles file and your compile your webpack dependencies

## Usage

Add `contao-formhybrid-compatibility-bundle` as active entry on your form pages or on your root page.

## Develop

### JS Events

Following events are fired during lifecycle.

Event                    | Description
------------------------ | -----------
formhybrid_ajax_complete | Fired after an ajax event completed. For example after an asynchronous form submit. 