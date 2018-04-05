<?php defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH.'libraries/REST_Controller.php';

class Subscriber extends REST_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('subscribers_model', 'subscriber');
        $this->subscriber_state = $this->config->item('subscriber_state');
    }

    /**
     * Subscriber Resource Endpoint
     * @param email_address
     * @param name
     * @param lastname
     * @param state
     * @param company
     * @param country
     * @param city
     * @param state
     * @param zip
     * @param phone_number
     * @param state_of_origin
     *
     */


    public function index_get()
    {
        $condition = array();
        $all_subscribers = $this->subscriber->get_all('', $condition);
        $this->response_ok([
            'error' => false,
            'message' => count($all_subscribers) . ' data found',
            'data' => $all_subscribers
        ]);
    }

    public function index_post($id = null)
    {
        if (!empty($_POST)) {
            $email_address = addslashes($this->post('email_address'));
            $name = $this->post('name');
            $state = $this->post('state');
            $lastname = $this->post('lastname');
            $company = $this->post('company');
            $country = $this->post('country');
            $city = $this->post('city');
            $phone_number = $this->post('phone');
            $state_of_origin = $this->post('state_of_origin');
            $zip = $this->post('zip');


            $error = array();

            if (empty($email_address) && !$this->options->validate_email($email_address) == false) {
                $error[] = "Please provide email address";
            }
            if (empty($name)) {
                $error[] = 'Please provide name';
            }
            if (empty($state)) {
                $error[] = 'Please provide mail state';
            }
            if (!$this->options->validate_email_domain($email_address) == true) {
                $error[] = "Invalid Email Address, only a domain email address is allowed";
            }


            if (count($error) == 0) {
                $subscriber_data = array(
                    'email_address' => $email_address,
                    'name' => $name,
                    'state' => $this->clean_state($state),
                    'lastname' => $lastname,
                    'company' => $company,
                    'country' => $country,
                    'city' => $city,
                    'zip' => $zip,
                    'phone_number' => $this->options->phone_number_sanitizer($phone_number, $zip),
                    'state_of_origin' => $state_of_origin
                );

                
                if (isset($id) && is_numeric($id)) {
                    $status = $this->subscriber->update($subscriber_data, array('id'=>$id));
                } else {
                    $status = $this->subscriber->add($subscriber_data);
                }
                if ($status) {
                    $this->response_ok(['error' => false, 'status' => "Subscriber data Added Successfully!!!"]);
                } else {
                    $this->response_bad(['error' => true, 'status' => "Unable to add subscriber data!"]);
                }
            } else {
                $this->response_bad(['error' => true, 'status' => $error]);
            }
        }
    }


    public function subscriber_get()
    {
        $id = $this->get('id');
        $error = array();

        if (empty($id)) {
            $error[] = 'Id Missing';
        }

        if (count($error) == 0) {
            $get_subscriber = $this->subscriber->get(array('id'=>$id));
            $this->response_ok([
                'error' => false,
                'data' => $get_subscriber
            ]);
        } else {
            $this->response_bad([
                'error' => true,
                'data' => $error
            ]);
        }
    }

    public function subscriber_delete()
    {
        $id = $this->get('id');
        $error = array();

        if (empty($id)) {
            $error[] = 'Id Missing';
        }

        if (count($error) == 0) {
            $get_subscriber = $this->subscriber->delete(array('id'=>$id));
            $this->response_ok([
                'error' => false,
                'data' => $get_subscriber
            ]);
        }
    }

    
    public function clean_state($state)
    {
        switch ($state) {
            case 'active':
                return $this->subscriber_state['active'];
                break;
            case 'unsubscribed':
                return $this->subscriber_state['unsubscribed'];
                break;
            case 'junk':
                return $this->subscriber_state['junk'];
                break;
            case 'bounced':
                return $this->subscriber_state['bounced'];
                break;
            case 'unconfirmed':
                return $this->subscriber_state['unconfirmed'];
                break;
            default:
                return $this->subscriber_state['unconfirmed'];
                break;
        }
    }
}
