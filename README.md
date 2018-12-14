# Contao Formhybrid Compatibility Bundle

A bundle enhancing compatibility with our Contao 4 environment.

## Features
* support for [Encore Bundle](https://github.com/heimrichhannot/contao-encore-bundle)
* replaces jquery code with native js code

> Not all js features ported yet

Currently ported js features:
* asynchronous form submit

## Install

TODO

## Usage

Add `contao-formhybrid-vanilla-bundle` as active entry on your form pages or on your root page.

## Develop

### JS Events

Following events are fired during lifecycle.

Event                    | Description
------------------------ | -----------
formhybrid_ajax_complete | Fired after an ajax event completed. For example after an asynchronous form submit. 