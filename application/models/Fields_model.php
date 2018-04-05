<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fields_Model extends CI_Model {
	
	private $field =  null;

	function __construct(){
		parent::__construct();
		$this->field = Options::$_field;
	}


	public function get_all($start,$limit,$condition=array(),$order="date_created desc"){
		$query = $this->db->order_by($order);
		if(!empty($condition)){
			$query = $query->get_where($this->field, $condition,$start,$limit);
		}else{
			$query = $query->get($this->field,$start,$limit);
		}
		$data = $query->result_array();
		return $data;
	}

	public function get_total($condition=array()){
		return $this->db->where($condition)->from($this->field)->count_all_results();
	}


	public function get($condition){
		$query = $this->db->get_where($this->field, $condition);
		$data = $query->row_array();
		if(!empty($data)){
			return $data;
		}else{
			return false;
		}
	}

	public function check($condition){
		$query = $this->db->get_where($this->field, $condition);
		$data = $query->row_array();
		if(!empty($data)){
			return $data;
		}else{
			return false;
		}
	}


	public function add($data){
		$status = $this->check(array('email_address'=>$data['email_address']));
		if(empty($status)) {
			$data['date_created'] = date('Y-m-d H:i:s');
			$this->db->insert($this->field, $data);
			return $this->db->insert_id();
		}else
			return false;
	}

	public function update($data,$condition){
		$this->db->update($this->field, $data, $condition);
		if($this->db->affected_rows()){
			$update_data = $this->get($condition);
			return $update_data['field_id'];
		}

	}

	public function delete($condition){
		$this->db->delete($this->field, $condition);
		return $this->db->affected_rows();
	}

}
