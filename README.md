# Contao Formhybrid Compatibility Bundle

A bundle enhancing [Formhybrid](https://github.com/heimrichhannot/contao-formhybrid) compatibility with our Contao 4 environment.

## Features
* support for [Encore Bundle](https://github.com/heimrichhannot/contao-encore-bundle)
* replaces jquery code with native js code
* js code is automatically added to pages where forms are included (needs formhybrid version >= 3.13)

> Not all js features ported yet

Currently ported js features:
* asynchronous form submit
* scroll to status message after submit
* submitOnChange

Current limitations:
* Only encore bundle is currently supported for assets

## Setup

1. Add this bundle as dependency

        composer require heimrichhannot/contao-formhybrid-compatibility-bundle

1. Update your Encore bundles file and your compile your webpack dependencies

1. Check if you need polyfills for supporting IE and (non-chromium) Edge (or other ~~annoying~~ outdated browsers) (see [Polyfills](#polyfills) section)

## Usage

### Styling when asynchronous form submit

A `submitting` class is added to the `form` element when doing an asynchronous form submit.   

## Develop

### JS Events

Following events are fired during lifecycle.

Event                    | Description
------------------------ | -----------
formhybrid_ajax_complete | Fired after an ajax event completed. For example after an asynchronous form submit.

### Polyfills

For compatibility with IE and Edge browsers you need to polyfill following js functions:

Function                     | Polyfill            | Required
---------------------------- | ------------------- | -------
ChildNode.replaceWith()      | https://developer.mozilla.org/de/docs/Web/API/ChildNode/replaceWith | Yes
CustomEvent                  | https://developer.mozilla.org/en-US/docs/Web/API/CustomEvent/CustomEvent | Optional, no finish event is fired
NodeList.prototype.forEach() | https://github.com/imagitama/nodelist-foreach-polyfill | Yes

Add these polyfill to your main project js entrypoint. 

## UPGRADE

### v0.4
* Renamed `HeimrichHannotContaoFormhybridCompatibilityBundle` to `HeimrichHannotFormhybridCompatibilityBundle`.
* JS code is automatically added to forms. If you don't want this, uncheck active on `contao-formhybrid-compatibility-bundle` entry in your encore settings.

### v0.2
* Async submit animation: Instead of adding animated dots to the submit button text when doing an asynchronous form submit, a `submitting` class is added to the form element.

