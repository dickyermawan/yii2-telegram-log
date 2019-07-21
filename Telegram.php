<?php
/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2019-07-21 17:52:46 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2019-07-21 17:54:24
 */

namespace dickyermawan\log;

use yii\log\Target;
use yii\base\InvalidConfigException;

class Telegram extends Target
{
    public $appName;
    /**
     * (Telegram bot token)[https://core.telegram.org/bots#botfather]
     * @var string
     */
    public $botToken;

    /**
     * Destination chat id or channel username
     * @var int|string
     */
    public $chatId;

    /**
     * Check required properties
     */
    public function init()
    {
        parent::init();
        foreach (['botToken', 'chatId'] as $property) {
            if ($this->$property === null) {
                throw new InvalidConfigException(self::className() . "::\$$property property must be set");
            }
        }
    }

    /**
     * Exports log [[messages]] to a specific destination.
     * Child classes must implement this method.
     */
    public function export()
    {
        $bot = new TelegramBot(['token' => $this->botToken]);

        $messages = array_map([$this, 'formatMessage'], $this->messages);

        $urlAkses = 'URL Error: 🤕'. PHP_EOL . "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}" . PHP_EOL;
        $messages[0] = $urlAkses . '⚠️⚠️⚠️' . PHP_EOL . $messages[0] . PHP_EOL . PHP_EOL . '✍️ Yii2 Telegram Log by:' . PHP_EOL . 'https://github.com/dickyermawan/yii2-telegram-log';
        ($this->appName) ?
            $messages[0] = '<strong>' . $this->appName . '</strong>' . PHP_EOL . PHP_EOL . $messages[0] :
            $messages[0] = '<strong>' . \Yii::$app->name . '</strong>' . PHP_EOL . PHP_EOL . $messages[0] ;

        foreach ($messages as $message) {
            $bot->sendMessage($this->chatId, $message);
        }
    }
}
