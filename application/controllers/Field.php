<?php defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH.'libraries/REST_Controller.php';

class Field extends REST_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('fields_model', 'field');
    }

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

    public function get_field_by_id_get()
    {
        $id = $this->get('id');
        $error = array();

        if (empty($id)) {
            $error[] = 'Id Missing';
        }

        if (count($error) == 0) {
            $get_field = $this->field->get(array('id'=>$id));
            $this->response_ok([
                'error' => false,
                'data' => $get_field
            ]);
        }
    }

    public function delete_field_get()
    {
        $id = $this->get('id');
        $error = array();

        if (empty($id)) {
            $error[] = 'Id Missing';
        }

        if (count($error) == 0) {
            $get_field = $this->field->delete(array('id'=>$id));
            $this->response_ok([
                'error' => false,
                'data' => $get_field
            ]);
        }
    }

    public function edit_field_post()
    {
        if (empty($_POST))
        {
            $id = $this->post('id');
            $title = $this->post('title');
            $type = $this->post('type');
            $error = array();

            if (empty($id)) {
                $error[] = 'Please provide subscriber id you wish to modify';
            }

           
            if (empty($title)) {
                $error[] = 'Please provide field title';
            }
            if (empty($type)) {
                $error[] = 'Please provide field type';
            }
            

            if (count($error) == 0) {
                $field_data = array(
                    'title' => $title,
                    'type' => $type
                );

                $status = $this->field->update(array($field_data, 'id' => $id));

                if ($status) {
                    $this->response_ok([
                        'error' => false,
                        'status' => "Field data updated successfully!"
                    ]);
                }else {
                     $this->response_bad([
                        'error' => true,
                        'status' => "Unable to update field info!"
                    ]);
                }

            }

        }
        
    }

    public function index_post($id = null)
    {
        if (!empty($_POST)) {
            $title = $this->post('title');
            $type = $this->post('type');
            
            $error = array();

            if (empty($title)) {
                $error[] = 'Please provide field title';
            }
            if (empty($type)) {
                $error[] = 'Please provide field type';
            }


            if (count($error) == 0) {
                $field_data = array(
                    'title' => $title,
                    'type' => $type
                );

                
                if (isset($id) && is_numeric($id)) {
                    $status = $this->field->update($field_data, array('id'=>$id));
                } else {
                    $status = $this->field->add($field_data);
                }
                if ($status) {
                    $this->response_ok(['error' => false, 'status' => "field data Added Successfully!!!"]);
                } else {
                    $this->response_bad(['error' => true, 'status' => "Unable to add field data!"]);
                }
            } else {
                $this->response_bad(['error' => true, 'status' => $error]);
            }
        }
    }
}
