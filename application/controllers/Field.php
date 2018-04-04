<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'libraries/REST_Controller.php';

class field extends REST_Controller 
{
    var $data = array();

    public function __construct()
     {
        parent::__construct();
        $this->load->model('field_model', 'field');
        $this->field_state = $this->config->item('field_state');
    }

    /**
     * field Resource Endpoint
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

    public function index_get()
      {
        $condition = array();
        $all_fields = $this->field->get_all('', $condition);
        $this->response_ok([
            'error' => false,
            'message' => count($all_fields) . ' data found',
            'data' => $all_fields
        ]);
      } 

    public function field_get()
    {
        $id = $this->get('id');
        $error = array();

        if (empty($id)) $error[] = 'Id Missing';

        if (count($error) == 0) {
            $get_field = $this->field->get(array('id'=>$id));
            $this->response_ok([
                'error' => false,
                'data' => $get_field
            ]);   
        }

    }

    public function field_delete_get()
    {
        $id = $this->get('id');
        $error = array();

        if (empty($id)) $error[] = 'Id Missing';

        if (count($error) == 0) {
            $get_field = $this->field->delete(array('id'=>$id));
            $this->response_ok([
                'error' => false,
                'data' => $get_field
            ]);   
        }
    }

    public function index_post($id = null)
    {
        if (!empty($_POST))
        {
            $title = $this->post('title');
            $type = $this->post('type');
            
            $error = array();

            if (empty($title)) $error[] = 'Please provide field title';
            if (empty($type)) $error[] = 'Please provide field type';


            if (count($error) == 0) 
            {
                $field_data = array(
                    'title' => $title,
                    'type' => $type
                );

                
                if (isset($id) && is_numeric($id)) 
                {
                    $status = $this->field->update($field_data, array('id'=>$id));
                }else{
                    $status = $this->field->add($field_data);
                }
                if ($status)
                    $this->response_ok(['error' => false, 'status' => "field data Added Successfully!!!"]);
                else
                    $this->response_bad(['error' => true, 'status' => "Unable to add field data!"]);
            }else
                $this->response_bad(['error' => true, 'status' => $error]);
        }
    }


      

    
}