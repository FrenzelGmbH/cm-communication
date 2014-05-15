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
'address'=>[
  'class' => 'frenzelgmbh\cmcommunication\Module',
],
'gridview' =>  [
  'class' => '\kartik\grid\Module'
],
```

After this, you should be able to see the set of build in widgets and options under:

http://yourhost/index.php?r=address/default/test

Design
======

The Address module is use to store address/location informations, that can be linked to any other "module".
So in general all modules are referenced by:

* mod_table (which should hold the table name VARCHAR(100))
* mod_id    (which should hold the primarey key of the referenced record INTEGER(11))

Geolocation
===========

The module tries to enrich each passed over address with the latitude and longitude, which will be looked
up by combining street, address and state information.


Widgets
=======

The "create"-Button:
```php
if(class_exists('\frenzelgmbh\cmcommunication\widgets\CreateAddressModal')){
  echo \frenzelgmbh\cmcommunication\widgets\CreateAddressModal::widget(array(
    'module'      => 'tbl_test',
    'id'          => 1
  )); 
}
```

The "related"-Grid:
```php
if(class_exists('\frenzelgmbh\cmcommunication\widgets\RelatedAddressGrid')){
  echo \frenzelgmbh\cmcommunication\widgets\RelatedAddressGrid::widget(array(
    'module'      => 'tbl_test',
    'id'          => 1
  )); 
}
```

Visitors IP Location:
```php
if(class_exists('\frenzelgmbh\cmcommunication\widgets\IPLocation')){
  echo \frenzelgmbh\cmcommunication\widgets\IPLocation::widget(); 
}
```
