<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// require APPPATH.'libraries/REST_Controller.php';

class Subscriber extends CI_Controller 
{
    var $data = array();

    public function __construct()
     {
        parent::__construct();
        $this->load->model('subscriber_model', 'subscriber');
        $this->subscriber_state = $this->ci->config->item('subscriber_state');
    }

    /**
     * Subscriber Resource Endpoint
     * @param email_address
     * @param name
     * @param state
     * 
     */


     /**
      * Field Resources
      * @param  title
      * @param  type
      */

    public function index()
      {
          $response = array('response' => 200, 'body' => 'Welcome to MailerLite Api Response!');
          echo $response;
      }

    function subsciber_get ($id=null)
    {

    }

    function subscriber_post()
    {

    }

    function subsciber_put()
    {

    }

    function subsciber_delete()
    {
        
    }



    function validate_input() 
    {
        $email_address = $this->post('email_address');
        $name = $this->post('name');
        $state = $this->post('state');

        if (empty(email_address)) $error[] = 'Provide Email Address';
        
    }

    function clean_state ($state) 
    {
        switch ($state) {
            case 'active': 
                return $this->subscriber_state->active;
                break;
            case 'unsubscribed':
                return $this->subscriber_state->unsubscribed;
                break;
            case 'junk':
                return $this->subscriber_state->junk;
                break;
            case 'bounced':
                return $this->subscriber_state->bounced;
                break;
            case 'unconfirmed':
                return $this->subscriber_state->unconfirmed;
                break;
            default:
                return $this->subscriber_state->unconfirmed;
                break;
        }
    }

    

   

    
}