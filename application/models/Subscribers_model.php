<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscribers_Model extends CI_Model {
	
	private $subscriber =  null;

	function __construct(){
		parent::__construct();
		$this->subscriber = Options::$_subscriber;
	}


	public function get_all($start,$limit,$condition=array(),$order="date_created desc"){
		$query = $this->db->order_by($order);
		if(!empty($condition)){
			$query = $query->get_where($this->subscriber, $condition,$start,$limit);
		}else{
			$query = $query->get($this->subscriber,$start,$limit);
		}
		$data = $query->result_array();
		return $data;
	}

	public function get_total($condition=array()){
		return $this->db->where($condition)->from($this->subscriber)->count_all_results();
	}


	public function get($condition){
		$query = $this->db->get_where($this->subscriber, $condition);
		$data = $query->row_array();
		if(!empty($data)){
			return $data;
		}else{
			return false;
		}
	}

	public function check($condition){
		$query = $this->db->get_where($this->subscriber, $condition);
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
			$this->db->insert($this->subscriber, $data);
			return $this->db->insert_id();
		}else
			return false;
	}

	public function update($data,$condition){
		$this->db->update($this->subscriber, $data, $condition);
		if($this->db->affected_rows()){
			$update_data = $this->get($condition);
			return $update_data['subscriber_id'];
		}

	}

	public function delete($condition){
		$this->db->delete($this->subscriber, $condition);
		return $this->db->affected_rows();
	}

}
