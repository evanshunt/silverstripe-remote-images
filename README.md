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

Currently this module will not download the remote file, just inject it into the markup.
