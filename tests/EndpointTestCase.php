<?php

namespace Tests;

use Tests\Decorator\RestResponse;
use WP_UnitTestCase;
use WP_REST_Server;
use WP_REST_Request;

abstract class EndpointTestCase extends WP_UnitTestCase     
{
    protected $server;
    protected string $endPoint;

    public function setUp(): void
    {
        parent::setUp();

        /** @var WP_REST_Server $wp_rest_server */
        global $wp_rest_server;
        $this->server = $wp_rest_server = new WP_REST_Server;
        do_action('rest_api_init');
    }

    protected function call( string $method , array $payload ): RestResponse
    {
        $request  = new WP_REST_Request( $method, $this->endPoint );
        $request->set_body_params( $payload );

        return new RestResponse( $this->server->dispatch( $request ) );
    }
}
