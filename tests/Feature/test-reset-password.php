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

    public function test_no_email()
    {
        $payload = array(  );
        
        $this->call( 'POST' , $payload )
            ->assertStatus( 400 )
            ->assertPartialResponse( array( 
                'message' => 'You must provide an email address.',
                'code' => 'no_email'
            ) );
    }
    
    public function test_bad_email()
    {
        $payload = array( 'email' => 'bad_email@joe.doe.com' );

        $this->call( 'POST' , $payload )
            ->assertStatus( 500 )
            ->assertPartialResponse( array( 
                'message' => 'No user found with this email address.',
                'code' => 'bad_email'
            ) );
    }
}
