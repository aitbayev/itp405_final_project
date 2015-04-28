<?php

class PlaceTest extends TestCase{

    public function testValidateReturnsFalseIfReviewIsMissing(){
        $validation = \App\Models\Place::validate([]);
        $this->assertEquals($validation->passes(), false);
    }

    public function testValidateReturnsTrueIfReviewIsPresent(){
        $validation = \App\Models\Place::validate([
            'place_id' => '1',
            'user_id' => '1',
            'review' => 'Great!!!'
        ]);
        $this->assertEquals($validation->passes(), true);
    }

    public function testReturnFalseIfMethodReturnsEmptyArray(){
        $countries = App\Models\Place::getReviews('');
        $this->assertEmpty($countries);
    }

    public function testReturnsTrueIfMethodReturnsNotEmptyArray(){
        $countries = App\Models\Place::getReviews('3');
        $this->assertNotEmpty($countries);
    }

}

