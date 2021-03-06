# Changelog
All notable changes to this project will be documented in this file.

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
