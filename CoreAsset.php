<?php
namespace net\frenzel\communication;

/**
 * @author Philipp Frenzel <philipp@frenzel.net> 
 */

use yii\web\AssetBundle;

/**
 * Module asset bundle.
 */
class CoreAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@net/frenzel/communication/assets';
    
    /**
     * @inheritdoc
     */
    public $css = [
        'css/frenzel_communication.css'
    ];
    
    /**
     * @inheritdoc
     */
    public $js = [];
    
    /**
     * @inheritdoc
     */
    public $depends = [
    	'yii\web\JqueryAsset',
        'yii\web\YiiAsset'
    ];
}
