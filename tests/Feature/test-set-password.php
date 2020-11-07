<?php

namespace Tests\Feature;

use Tests\EndpointTestCase;
use Tests\Factory\UserFactory;

class WP_Test_Set_Password extends EndpointTestCase     
{ 
    protected string $endPoint = '/bdpwr/v1/set-password'; 

    /**
     * @group current
     */
    public function test_set_password()
    {
        $code = 'my_code';
        $user = (new UserFactory)
            ->withCode($code)
            ->make();

        $payload = array( 
            'email' => $user['email'],
            'code' => $code,
            'password' => 'my_password',
        );
    
        $this->call( 'POST' , $payload )
            ->assertStatus( 200 )
            ->assertPartialResponse( array( 'message' => 'Password reset successfully.' ) );
    }
}
