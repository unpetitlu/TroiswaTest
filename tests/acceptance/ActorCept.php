<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage('/actor');
$I->see('Actor list');
$I->click('Create a new entry');
$I->see('Actor creation');



$I->fillField('troiswa_testbundle_actor[prenom]', 'davert');
$I->fillField('troiswa_testbundle_actor[prenom]','qwerty');
$I->selectOption('troiswa_testbundle_actor[movies][]','1');
$I->click('Create');
$I->see('Actor');