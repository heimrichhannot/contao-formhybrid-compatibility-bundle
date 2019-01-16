# Contao Formhybrid Compatibility Bundle

A bundle enhancing [Formhybrid](https://github.com/heimrichhannot/contao-formhybrid) compatibility with our Contao 4 environment.

## Features
* support for [Encore Bundle](https://github.com/heimrichhannot/contao-encore-bundle)
* replaces jquery code with native js code

> Not all js features ported yet

Currently ported js features:
* asynchronous form submit
* scroll to status message after submit

## Setup

1. Add this bundle as dependency
```sh
composer require heimrichhannot/contao-formhybrid-compatibility-bundle
```

1. Update your Encore bundles file and your compile your webpack dependencies

1. Add `contao-formhybrid-compatibility-bundle` as active entry on your form pages or on your root page.

## Usage

### Styling when asynchronous form submit

A `submitting` class is added to the `form` element when doing an asynchronous form submit.   

## Develop

### JS Events

Following events are fired during lifecycle.

Event                    | Description
------------------------ | -----------
formhybrid_ajax_complete | Fired after an ajax event completed. For example after an asynchronous form submit. 

## UPGRADE

### Async submit animation

Since: v0.2  
Applies to updates from: module, v0.1

Instead of adding animated dots to the submit button text when doing an asynchronous form submit, a `submitting` class is added to the form element.

