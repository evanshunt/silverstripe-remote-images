<?php

namespace EvansHunt\RemoteImagesProxy;

use SilverStripe\Control\Controller;
use SilverStripe\Core\Environment;
use SilverStripe\Core\Extension;

class DBFileExtension extends Extension
{
    public function updateURL(&$url)
    {
        // require jakeasmith/http_build_url
        $localURL = \http_build_url(Controller::curr()->getRequest()->getHost(), ['path' => $url]);

        $ch = curl_init($localURL);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if (!$responseCode == 200) {
            $url = \http_build_url(
                Environment::getEnv('REMOTE_IMAGES_PROXY_HOST'),
                [
                    'path' => $url
                ]
            );
        }

        return $url;
    }
}
