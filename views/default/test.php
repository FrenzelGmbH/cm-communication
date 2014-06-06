<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var string $module
 * @var integer $id
 */

$this->title = Yii::t('cm-communication', 'test');
?>

<div class="posts-default-index">
	<h1><?= $this->context->action->uniqueId; ?></h1>
	
	<fieldset>
		<legend>Create Button</legend>

		<div class="well">
			<p>
				Here we make the test for the create button, that will open a modal to create an 
				asscociated Communication to the passed over: <br>
				* MODULE <br>
				* ID <br>
			</p>
		</div>

		<?php 
      if(class_exists('\frenzelgmbh\cmcommunication\widgets\CreateCommunicationModal')){
        echo \frenzelgmbh\cmcommunication\widgets\CreateCommunicationModal::widget(array(
          'module'      => 1,
          'id'          => 1
        )); 
      }
    ?>

	</fieldset>

  <fieldset>
    <legend>Related Communication Grid</legend>

    <div class="well">
      <p>
        Here we make the test for the related Communication grid 
        which renders an asscociated Communication to the passed over: <br>
        * MODULE <br>
        * ID <br>
      </p>
    </div>

    <?php 
      if(class_exists('\frenzelgmbh\cmcommunication\widgets\RelatedCommunicationGrid')){
        echo \frenzelgmbh\cmcommunication\widgets\RelatedCommunicationGrid::widget(array(
          'module'      => 1,
          'id'          => 1
        )); 
      }
    ?>

  </fieldset>

  <fieldset>
    <legend>IP Location</legend>

    <div class="well">
      <p>
        IP Location, based upon the information we get from the enviroment variables.
      </p>
    </div>

    <?php 
      if(class_exists('\frenzelgmbh\cmcommunication\widgets\IPLocation')){
        echo \frenzelgmbh\cmcommunication\widgets\IPLocation::widget(); 
      }
    ?>

  </fieldset>

</div>
