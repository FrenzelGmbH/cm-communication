cm-communication
==========

Common Address Module (Frenzel GmbH 2014) v.0.1

Installation
============

Add the following line to your composer.json require section:

```
"frenzelgmbh/cmcommunication":"*"
```

```
php yii migrate --migrationPath=@vendor/frenzelgmbh/cmcommunication/migrations
```

Inside your yii-config, pls. add the following lines to your modules section. As you
might see, the gridview needs to be implemented too.
```
'communication'=>[
  'class' => 'frenzelgmbh\cmcommunication\Module',
],
'gridview' =>  [
  'class' => '\kartik\grid\Module'
],
```

After this, you should be able to see the set of build in widgets and options under:

http://yourhost/index.php?r=communication/default/test

Design
======

The Address module is use to store address/location informations, that can be linked to any other "module".
So in general all modules are referenced by:

* mod_table (which should hold the table name VARCHAR(100))
* mod_id    (which should hold the primarey key of the referenced record INTEGER(11))

Datastructure
=============
This module allows you to store communication data related to any other "record" and "module" you pass by as parameters.
It allows you to save 1:n communication records, while one record of communication can be filled with the following fields:
* Communication Type (INTEGER) References communication_type table
* Phone
* Mobile
* Fax
* EMail
Pls. notice, that records aren't deleted in all of our models, they just get marked as deleted!

Widgets
=======

The "create"-Button:
```php
if(class_exists('\frenzelgmbh\cmcommunication\widgets\CreateCommunicationModal')){
  echo \frenzelgmbh\cmcommunication\widgets\CreateCommunicationModal::widget(array(
    'module'      => 'tbl_test',
    'id'          => 1
  )); 
}
```

The "related"-Grid:
```php
if(class_exists('\frenzelgmbh\cmcommunication\widgets\RelatedCommunicationGrid')){
  echo \frenzelgmbh\cmcommunication\widgets\RelatedCommunicationGrid::widget(array(
    'module'      => 'tbl_test',
    'id'          => 1
  )); 
}
```
