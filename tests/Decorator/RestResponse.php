<?php

namespace Tests\Decorator;

use WP_REST_Response;
use WP_UnitTestCase;

class RestResponse extends WP_UnitTestCase
{
    protected $response;

    public function __construct(WP_REST_Response $response)
    {
        $this->response = $response;
    }

    public function assertStatus( int $statusCode ): self 
    {
        $this->assertEquals( $statusCode , $this->response->get_status() );

        return $this;
    }

    public function assertPartialResponse( array $expected ): self 
    {
        $this->assertArraySubset( $expected , $this->response->get_data() );

        return $this;
    }
}
