<?php

namespace frenzelgmbh\cmcommunication\widgets;

use Yii;

use frenzelgmbh\cmcommunication\models\Communication;
use frenzelgmbh\cmcommunication\models\CommunicationSearch;

use frenzelgmbh\appcommon\widgets\Portlet;

/**
 * Related Communication Grid
 * @author Philipp Frenzel <philipp@frenzel.net>
 * @copyright Copyright (c) 2014, Frenzel GmbH
 */

class RelatedCommunicationGrid extends Portlet
{
	/**
	 * const WIDGET_NAME must be defined for all widgets!
	 */
	const WIDGET_NAME = 'RelatedCommunicationGrid';
	
	/**
	 * [$title description]
	 * @var string title that will be displayed when enabling Admin Portlet
	 */
	public $title='Related Communications';
	
	/**
	 * [$module description]
	 * @var string the module, mostly we recommend to take the table name in which records will be stored
	 */
	public $module = NULL;

	/**
	 * [$id description]
	 * @var integer id that is the primarey key value of the reference value
	 */
	public $id = NULL;

	/**
	 * [init description]
	 * @return bool the result of the parent init call
	 */
	public function init() {		
		\frenzelgmbh\cmcommunication\communicationAsset::register(\Yii::$app->view);
		return parent::init();
	}

	/**
	 * [renderContent description]
	 * @return [type] [description]
	 */
	protected function renderContent()
	{
		$searchModel = new CommunicationSearch;
    	$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(),$this->module,$this->id);

	    echo $this->render('@frenzelgmbh/cmcommunication/widgets/views/_communication_grid', [
	        'dataProvider' => $dataProvider,
	        'searchModel' => $searchModel,
	    ]);
	}

}