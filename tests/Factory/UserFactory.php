<?php

namespace Tests\Factory;

class UserFactory
{
    public static function make( array $override = [] ): array
    {
        $data = array(
            'username' => 'JoeDoe',
            'password' => 'password', 
            'email' => 'joe.doe@domain.com'
        ) + $override;
          
        $userId = wp_create_user( $data['username'], $data['password'], $data['email']);

        return $data + array( 'id' => $userId );
    }
}
