<?php

namespace Tests\Feature;

use Tests\Factory\UserFactory;
use Tests\EndpointTestCase; 

class WP_Test_Reset_Password extends EndpointTestCase     
{ 
    protected string $endPoint = '/bdpwr/v1/reset-password'; 

    public function test_reset_password()
    {
        $user = (new UserFactory)->make();
        $payload = array( 'email' => $user['email'] );

        $this->call( 'POST' , $payload )
            ->assertStatus( 200 )
            ->assertPartialResponse( array( 'message' => 'A password reset email has been sent to your email address.' ) );
    }
}
