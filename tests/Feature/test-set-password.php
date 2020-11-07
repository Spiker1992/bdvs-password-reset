<?php

namespace Tests\Feature;

use Tests\EndpointTestCase; 

class WP_Test_Set_Password extends EndpointTestCase     
{ 
    protected string $endPoint = '/bdpwr/v1/set-password'; 

    public function test_set_password()
    {
        $this->markTestSkipped( 'To do.' );
    }
}
