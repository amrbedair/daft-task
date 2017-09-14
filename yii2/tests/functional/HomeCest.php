<?php

class HomeCest {
    
    public function _before(\FunctionalTester $I) {
        
        $I->amOnRoute('/site/index');
    }

    public function openHomePage(\FunctionalTester $I) {
        
        $I->see('Distilled SCH Beer Application');
        $I->see('Another Beer');
        $I->see('Search');
    }


    public function submitEmptyQuery(\FunctionalTester $I) {
        
        $I->submitForm('#frm-search', [
            'SearchForm[term]' => '',
        ]);
        $I->expectTo('see validations errors');
        $I->see('Search Query cannot be blank.');
    }
    
    public function submitBadInput(\FunctionalTester $I) {
    
        $I->submitForm('#frm-search', [
            'SearchForm[term]' => '_',
        ]);
        $I->expectTo('see validations errors');
        $I->see('Invalid Search Query; only letters, numbers, hyphens and spaces are allowed');
    }
    
    public function submitValidInput(\FunctionalTester $I) {
    
        $I->submitForm('#frm-search', [
            'SearchForm[term]' => 'S-Turns',
        ]);
        $I->expectTo('S-Turns');
        $I->see('S-Turns', 'strong');
        
    }
    
    public function getAnotherBeer(\FunctionalTester $I) {
        
        $text = $I->grabTextFrom("#pjax-bear-container");
        $I->see($text);
        $I->click('Another Beer');
        $I->dontSee($text);
    }

}