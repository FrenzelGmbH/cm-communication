<?php

namespace net\frenzel\activity;

/**
 * @author Philipp Frenzel <philipp@frenzel.net> 
 */

class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public static $name = 'activity';

    /**
     * version
     */
    const VERSION = '0.1.0-dev';

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
