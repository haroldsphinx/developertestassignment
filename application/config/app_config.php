<?php
// Codeigniter access check, remove it for direct use
if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/*
 *---------------------------------------------------------------
 * APP NAME
 *---------------------------------------------------------------if
 *
 * This is the name for the application.
 * It is set to MailerLite Test but can be updated based on any new requirement from product.
 */
$config["app_name"] = "MailerLite Test";


/*
 *---------------------------------------------------------------
 * CHECK IF ON PRODUCTION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * Check if the application is LIVE on the production server.
 */
$is_web_app_live = (ENVIRONMENT === 'development');

$config['subscriber_state'] = array(
    'unsubscribed' => '0',
    'active' => '1',
    'unconfirmed' => '2',
    'junk' => '3',
    'bounced' => '4'
);

