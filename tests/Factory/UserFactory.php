<?php

namespace Tests\Factory;

class UserFactory
{    
    protected ?string $code = null;

    public function make( array $override = [] ): array
    {
        $data = array(
            'username' => 'JoeDoe',
            'password' => 'password', 
            'email' => 'joe.doe@domain.com'
        ) + $override;
          
        $userId = wp_create_user( $data['username'], $data['password'], $data['email']);

        if ($this->code) {
            update_user_meta( $userId, 'bdpws-password-reset-code' , array(
                'code' => $this->code,
                'expiry' => strtotime( 'now' ) + 999,
                'attempt' => 0,
              ));
        }

        return $data + array( 'id' => $userId );
    }

    public function withCode( string $code ): self 
    {
        $this->code = $code;

        return $this;
    }
}
