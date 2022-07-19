# Changelog
All notable changes to this project will be documented in this file.

## [0.6.1] - 2022-07-19
- Fixed: path to encore entry
- Fixed: missing upgrade notice in readme

## [0.6.0] - 2022-07-19
- Changed: [BREAKING] renamed bundle namespace to FormhybridCompatibilityBundle ([#1])
- Changed: minimum php version is now 7.4 ([#1])
- Changed: minimum contao version is now 4.9 ([#1])
- Changed: code modernization and cleanup ([#1])

## [0.5.8] - 2022-07-19
- Fixed: redirect after ajax submit

## [0.5.7] - 2022-01-21
- Added: formhybrid_ajax_start js event
- Fixed: exception on async form events if form action url is not absolute

## [0.5.6] - 2021-11-29
- Fixed: restored bootstrap modal support for ajaxFormSubmit listener

## [0.5.5] - 2021-11-26

- Fixed: ajaxFormSubmit event listener to be placed on the form element, so it will be removed together with the form element

## [0.5.4] - 2021-10-15

- Changed: pass response data as detail to formhybrid_ajax_complete event
- Changed: add submitted flag to async form submit response data

## [0.5.3] - 2021-10-11

- Added: php8 support

## [0.5.2] - 2021-04-08
- added select and textarea to be disabled on formsubmit

## [0.5.1] - 2020-11-25
* added support for submitOnChange onclick event

## [0.5.0] - 2020-08-17
* added support for submitOnChange
* minimum formhybrid module version is now 3.15.0

## [0.4.2] - 2020-07-15
* fixed console error when no form on current page

## [0.4.1] - 2020-06-05
* fixed issue in composer.json

## [0.4.0] - 2020-06-05
* added automatic asset inclusion for forms with formhybrid version >= 3.13
* added scroll to statusmessage on synchronous submit
* renamed bundle class according to conventions
* raised minimum encore bundle version to 1.5

## [0.3.0] - 2019-06-11

#### Changed
* use `EventUtil.addDynamicEventListener` to async submit formhybrid forms

## [0.2.4] - 2019-01-23

#### Changed
* updated package dependencies

## [0.2.3] - 2019-01-16

#### Fixed
* correctly focus first input on error

## [0.2.2] - 2019-01-22

#### Changed 
* updated package dependencies

## [0.2.1] - 2019-01-21

#### Changed
* replaced dynamic import with static import due IE incompatibility

## [0.2.0] - 2019-01-16

#### Changed
* some renaming and refactoring to reflect conventions and better syntax support
* add `submitting` class to form while sending asynchronous instead of showing dot animation
* also submit `button` elements disabled when submitting asynchronous

## [0.1.1] - 2018-12-19

#### Fixed
* removed a dev output

## [0.1.0] - 2018-12-14

#### Added
* encore config
* asynchronous form submit


[#1]: https://github.com/heimrichhannot/contao-formhybrid-compatibility-bundle/pull/1