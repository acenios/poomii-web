<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
    13/07/15
    Created by Andri Nugraha Ramdhon (andri.nugraha.r@gmail.com)
    Class as a model for user data
*/
class Mdl_User extends CI_Model {
    // Variable
	var $table = 'tbl_user';

    var $username = 'username';
    var $password = 'password';

    var $attribute = 'attribute';

	// Constructor
	public function __construct()
    {
        parent::__construct(); 

        $this->load->database();
    }

    // Get all data
    public function getAll(){
    	$query = $this->db->get($this->table);

    	return $query;
    }

    // Get data with attribute and key
    public function getWithKey($attribute, $key){
    	$this->db->where($attribute, $key);
	    $query = $this->db->get($this->table);

    	return $query;
    }

    // Update data with attribute and key
    public function updateWithKey($attribute, $key, $data){
    	$this->db->where($attribute, $key);
		$query = $this->db->update($this->table, $data); 
    }

    // Delete data with attribute and key
    public function deleteWithKey($attribute, $key){
        $this->db->where($attribute, $key);
        $query = $this->db->delete($this->table);
    }

    // Add new data
    public function add($data){
        $this->db->insert($this->table, $data);
        $query = $this->db->insert_id();
    }

    // Login
    public function login($data){
        $condition = array(
            $data['attribute'] => $data['key'],
            $this->password => $data['password']);
        $this->db->select($this->username);
        $this->db->from($this->table);
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

}
 
/* End of file mdl_user.php */
/* Location: ./application/modules/user/models/mdl_user.php */