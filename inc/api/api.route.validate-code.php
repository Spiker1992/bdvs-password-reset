<?php

/**
*
* Add an endpoint to validate a code without resetting the password
*
**/

add_action( 'rest_api_init', function () {  
  $route_namespace = apply_filters( 'bdpwr_route_namespace' , 'bdpwr/v1' );
  register_rest_route( $route_namespace , '/validate-code' , array(

    'methods' => 'POST',

    'callback' => function( $data ) {

      if ( empty( $data['email'] ) || $data['email'] === '' ) {
        return new WP_Error( 'no_email' , 'You must provide an email address.' , array( 'status' => 400 ));
      }

      if( empty( $data['code'] ) || $data['code'] === '' ) {
        return new WP_Error( 'no_code' , 'You must provide a code.' , array( 'status' => 400 ) );
      }

      $exists = email_exists( $data['email'] );

      if( ! $exists ) {
        return new WP_Error( 'bad_email' , 'No user found with this email address.' , array( 'status' => 500 ));
      }
      
      try {
        $user = bdpwr_get_user( $exists );
        $user->validate_code( $data['code'] );
      }
      
      catch( Exception $e ) {
        return new WP_Error( 'bad_request' , $e->getMessage() , array( 'status' => 500 ));
      }

      return array(
        'data' => array(
          'status' => 200,
        ),
        'message' => 'The code supplied is valid.',
      );

    },

    'permission_callback' => function() {
      return true;
    },

  ));  
});
