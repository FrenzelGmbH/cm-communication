<?php

namespace net\frenzel\communication;

/**
 * @author Philipp Frenzel <philipp@frenzel.net> 
 */

class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public static $name = 'communication';

    /**
     * version
     */
    const VERSION = '0.1.0-dev';

    /** @var string|null */
    public $userIdentityClass = null;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->userIdentityClass === null) {
            $this->userIdentityClass = \Yii::$app->getUser()->identityClass;
        }
    }
}
