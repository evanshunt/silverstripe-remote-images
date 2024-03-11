# Silverstripe Remote Images Proxy

Module for using remote versions of image files when copying a site to a local environment. Inspired by the [Silverstripe Asset Proxy](https://github.com/bcairns/silverstripe-assetproxy) for SilverStripe 3.

## Installation

```bash
composer require evanshunt/silverstripe-remote-images
```

## Usage

Set a remote host in your `.env` file

```
REMOTE_IMAGES_PROXY_HOST=http://example.com
```

## Known issues

Files are downloaded locally, but not totally recognized by the CMS, leading to some not being cropped and issues in the assets admin area.
