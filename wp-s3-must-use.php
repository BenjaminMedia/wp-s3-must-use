<?php
/*
Plugin Name: Must Use - WP Offload S3
Plugin URI: http://wordpress.org/extend/plugins/amazon-s3-and-cloudfront/
Description: Automatically Enables and configures the WP Offload S3 module.
Author: Bonnier Publications - Alf Henderson
Version: 0.1
*/

namespace BonnierWP;

use Amazon_S3_And_CloudFront;

add_filter('pre_site_option_' . Amazon_S3_And_CloudFront::SETTINGS_KEY, function ($option) {

    if (getenv('AWS_S3_BUCKET')) {

        $overideOptions = [
            'bucket' => getenv('AWS_S3_BUCKET'),
            'cloudfront' => getenv('AWS_S3_ClOUDFRONT') ? getenv('AWS_S3_ClOUDFRONT') : '',
            'object-prefix' => getenv('AWS_S3_UPLOADS_PATH') ? getenv('AWS_S3_UPLOADS_PATH') : 'content/uploads/',
            'remove-local-file' => 1,
            'copy-to-s3' => 1,
            'serve-from-s3' => 1,
            'object-versioning' => 1
        ];

        return $overideOptions;
    }
    return $option;
});

add_filter('option_active_plugins', function ($activePlugins) {

    $mustUsePlugins = [
        'amazon-s3-and-cloudfront/wordpress-s3.php',
        'amazon-web-services/amazon-web-services.php'
    ];

    // Make sure the $activePlugins only contains the must use plugin once
    foreach ($mustUsePlugins as $mustUsePlugin) {
        if(!in_array($mustUsePlugin, $activePlugins)) {
            $activePlugins[] = $mustUsePlugin;
        }
    }

    return $activePlugins;
});