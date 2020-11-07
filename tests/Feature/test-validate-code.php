<?php

namespace Tests\Feature;

use Tests\Factory\UserFactory;
use Tests\EndpointTestCase; 

class WP_Test_Validate_Code extends EndpointTestCase     
{ 
    protected string $endPoint = '/bdpwr/v1/validate-code'; 

    public function test_validate_code()
    {
        $code = 'my_code';
        $user = (new UserFactory)
            ->withCode($code)
            ->make();

        $payload = array( 
            'email' => $user['email'],
            'code' => $code,
        );
    
        $this->call( 'POST' , $payload )
            ->assertStatus( 200 )
            ->assertPartialResponse( array( 'message' => 'The code supplied is valid.' ) );
    }
}
