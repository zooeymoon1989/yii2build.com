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
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
//                'facebook' => [
//                    'class' => 'yii\authclient\clients\Facebook',
//                    'clientId' => '1368883696465757',
//                    'authUrl' => 'https://www.facebook.com/dialog/oauth?display=popup',
//                    'clientSecret' => '4d282bae19beadea1e801fb306547e90',
//                ],
                'github' => [
                    'class' => 'yii\authclient\clients\GitHub',
                    'clientId' => '84253cb21276e732547f',
                    'clientSecret' => 'df589ca7ab301ccab4700a07fff1e935fb9e390d',
                ],
                'twitter' => [
                    'class' => 'yii\authclient\clients\Twitter',
                    'consumerKey' => 'vpKiLHMdvlGNosVXP4TaDhoXc',
                    'consumerSecret' => 'TI6TQcC0UNHU9iiAddH12OJRJrq0ICp37l25yNEqj6bWSYKS7M',
                ],
//                'google' => [
//                    'class' => 'yii\authclient\clients\GoogleOAuth',
//                    'clientId' => '108969290916829736875',
//                    'clientSecret' => '8b5ae9244f0ba2039623480ec95b1290e8adf856',
//                ],
//                'linkedin' => [
//                    'class' => 'yii\authclient\clients\LinkedIn',
//                    'clientId' => '81qhutg3hzvmty',
//                    'clientSecret' => '1TZtMxxhPeYX5Kp1',
//                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'assetManager'=>[
            'bundles'=>[
                // use bootstrap css from CDN
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null, // do not use file from our server
                    'css' => [
                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css'
                    ]
                ],
                // use fontawesome css from CDN
                'frontend\assets\FontAwesomeAsset' => [
                    'sourcePath' => null, // do not use file from our server
                    'css' => [
                        'https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'
                    ]
                ],
                // use fontawesome css from CDN
                'backend\assets\FontAwesomeAsset' => [
                    'sourcePath' => null, // do not use file from our server
                    'css' => [
                        'https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'
                    ]
                ],
                // use bootstrap js from CDN
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => null, // do not use file from our server
                    'js' =>[
                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js'
                    ]
                ],
                // use jquery from CDN
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null, // do not publish the bundle
                    'js' => [
                        'https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'
                    ]
                ]
            ],

        ],
        'mycomponent'=>[
            'class'=>'components\MyComponent',
        ],
        'faqwidget'=>[
            'class'=>'components\FaqWidget'
        ]
    ],
];
