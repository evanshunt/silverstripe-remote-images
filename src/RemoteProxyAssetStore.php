<?php

namespace EvansHunt\RemoteImagesProxy;

use SilverStripe\Assets\Flysystem\FlysystemAssetStore;
use SilverStripe\Core\Environment;

class RemoteProxyAssetStore extends FlysystemAssetStore
{
    public function exists($filename, $hash, $variant = null)
    {
        return true; //delete this
        if (empty($filename) || empty($hash)) {
            return false;
        }

        if (parent::exists($filename, $hash, $variant)) {
            return true;
        }

        // require jakeasmith/http_build_url
        $remoteFilename = \http_build_url(
            Environment::getEnv('REMOTE_IMAGES_PROXY_HOST'),
            [
                'path' => ASSETS_DIR . '/' . $filename
            ]
        );

        $ch = curl_init($remoteFilename);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $responseCode == 200;
    }
}
