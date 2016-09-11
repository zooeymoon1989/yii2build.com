<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'extensions'=>require(__DIR__. '/../../vendor/yiisoft/extensions.php'),
    'modules'=>[
        'social'=>[
            'class'=>'kartik\social\Module',
            'disqus'=>[
                'settings'=>['shortname'=>'DISQUS_SHORTNAME']
            ],
            //facebook
            'facebook'=>[
                'appId'=>'459115857624021',
                'secret'=>'bd7d9cb5ec4e20066823a25bdb9f58b3'
            ],
            //google
            'google'=>[
                'clientId'=>'API_CLIENT_ID',
                'pageId'=>'PLUS_PAGE_ID',
                'profileId'=>'PLUS_PROFILE_ID'
            ],
            // the global settings for the google analytic plugin widget
            'googleAnalytics' => [
                'id' => 'TRACKING_ID',
                'domain' => 'TRACKING_DOMAIN',
            ],
            // the global settings for the twitter plugin widget
            'twitter' => [
                'screenName' => 'TWITTER_SCREEN_NAME'
            ],
        ]
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'mycomponent'=>[
            'class'=>'components\MyComponent',
        ],
    ],
];
