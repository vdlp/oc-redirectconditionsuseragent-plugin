# Vdlp.RedirectConditions.UserAgent (extension)

This is an extension plugin for the [Redirect](https://octobercms.com/plugin/vdlp-redirect) plugin for OctoberCMS.

## Requirements

- Plugin `Vdlp.Redirect`
- Plugin `Vdlp.RedirectConditions`

## Conditions

### `CrawlerCondition`

On a positive match the redirect will take place if the request came from a Crawler.

### `DeviceCondition`

On a positive match the redirect will take place if the request came from a specific device.

Available device types to choose from:

* Smartphone
* Tablet
* Desktop

### `OperationSystemCondition`

On a positive match the redirect will take place if the request came from a specific operating system.

Available operation system families to choose from:

* Android
* AmigaOS
* Apple TV
* BlackBerry
* Brew
* BeOS
* Chrome OS
* Firefox OS
* Gaming Console
* Google TV
* IBM
* iOS
* RISC OS
* GNU/Linux
* Mac
* Mobile Gaming Console
* Real-time OS
* Other Mobile
* Symbian
* Unix
* WebTV
* Windows
* Windows Mobile

## Unit tests

To run the Unit Tests of this plugin, execute the following command from the project root: 

```
vendor/bin/phpunit plugins/vdlp/redirectconditionsuseragent
```

## Questions? Need help?

If you have any question about how to use this plugin, please don't hesitate to contact us at octobercms@vdlp.nl. We're happy to help you. You can also visit the support forum and drop your questions/issues there.
