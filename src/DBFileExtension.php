<?php

namespace EvansHunt\RemoteImagesProxy;

use SilverStripe\Control\Controller;
use SilverStripe\Core\Environment;
use SilverStripe\Core\Extension;

class DBFileExtension extends Extension
{
    public function updateURL($url)
    {
        $localFilename = preg_replace('/\/' . ASSETS_DIR . '/', '', $url);
        $localPath = ASSETS_PATH . $localFilename;

        // Probably not sufficient to prevent all issues and perhaps not a specific enough request
        // But this prevents errors on CMS upload.
        if (Controller::curr()->getRequest()->param('Action') === 'upload') {
            return $url;
        }

        if (!file_exists($localPath)) {
            $remoteUrl = \http_build_url(
                Environment::getEnv('REMOTE_IMAGES_PROXY_HOST'),
                [
                    'path' => $url
                ]
            );

            $directory = dirname($localPath);

            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            file_put_contents($localPath, file_get_contents($remoteUrl));
        }
    }
}
