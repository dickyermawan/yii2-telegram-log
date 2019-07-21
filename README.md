# Yii 2.0 Telegram Log #

Yii2 telegram log to sends log in Yii2 to telegram.

## Installation ##

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require dickyermawan/yii2-telegram-log
```

or add

```
"dickyermawan/yii2-telegram-log": "*"
```

to the require section of your `composer.json` file.

## How To Use ##

You should set [telegram bot token](https://core.telegram.org/bots#botfather) and chatId in your config file.
You can use the @get_id_bot bot to obtain it. It should look like 123456789.

```
'componenst' => [
    'log' => [
        'targets' => [
            [
                'class' => 'dickyermawan\log\Telegram',
                'levels' => ['error'],
                'botToken' => '123456:abcde', // bot token secret key
                'chatId' => '123456', // chat id or channel username with @ like 12345 or @channel
                'appName' => 'YOUR APP NAME', // optional (default is \Yii::$app->name)
            ],
        ],
    ],
]
```
