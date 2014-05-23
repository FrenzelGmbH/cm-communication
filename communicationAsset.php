<?php
/**
 * @link http://www.frenzel.net/
 * @author Philipp Frenzel <philipp@frenzel.net> 
 */

namespace frenzelgmbh\cmcommunication;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class communicationAsset extends AssetBundle
{
    public $sourcePath = '@frenzelgmbh/cmcommunication/assets';
    
    public $css = [
        'css/cm-communication.css'
    ];
    
    public $js = [];
    
    public $depends = [
      'frenzelgmbh\appcommon\commonAsset'
    ];
}
