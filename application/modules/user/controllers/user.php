<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
    13/07/15
    Created by Andri Nugraha Ramdhon (andri.nugraha.r@gmail.com)
    Class as a controller for user data
*/
class User extends MX_Controller {
    // Variable
    var $username = 'username';
    var $password = 'password';
    var $firstname = 'firstname';
    var $lastname = 'lastname';

    var $attribute = 'attribute';
    var $key = 'key';
 
    // Constructor
    public function __construct()
    {
        parent::__construct(); 

        $this->load->model('mdl_user', 'model');
    }
 
    // Index
    public function index()
    {
    	//Just an example to ensure that we get into the function
        echo "<h1>Welcome to the world of Codeigniter</h1>";
        die();
    }

    // Logout
    public function logout($username, $password){
    	echo "<h3>This is logout function</h3>";
    }

    // Get all user data
    public function getAllUser(){
        $query = $this->model->getAll();

        $rows = array();

        foreach ($query->result() as $row) {
            $rows[] = $row;
        }

        // Encode to JSON
        print json_encode($rows);
    }

    // Get user data with username
    public function getUser($key){
        $query = $this->model->getWithKey($this->username, $key);

        $rows = array();

        foreach ($query->result() as $row) {
            $rows[] = $row;
        }

        // Encode to JSON
        print json_encode($rows);
    }

    // Update user data
    public function updateUser($key, $username, $password, $firstname, $lastname){
        $data = array(
                'username' => $username,
                'password' => $password,
                'firstname' => $firstname,
                'lastname' => $lastname,
            );

        $query = $this->model->updateWithKey($this->username, $key, $data);

        $this->getAllUser();
    }

    // Delete user data
    public function deleteUser($key){
        $query = $this->model->deleteWithKey($this->username, $key);

        $this->getAllUser();
    }

    // Add user data
    public function addUser($username, $password, $firstname, $lastname){
        $data = array(
            $this->username => $username, 
            $this->password => $password, 
            $this->firstname => $firstname,
            $this->lastname =>$lastname);

        $query = $this->model->add($data);

        $this->getAllUser();
    }

    // Login user
    public function loginUser($attribute, $key, $password){
        $data = array(
            $this->attribute => $attribute,
            $this->key => $key,
            $this->password => $password);

        $query = $this->model->login($data);

        $rows = array();

        foreach ($query->result() as $row) {
            $rows[] = $row;
        }

        print json_encode($rows);
    }

}
 
/* End of file user.php */
/* Location: ./application/modules/user/controllers/user.php */