<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Crimson_model extends CI_Model {
	function __construct() {
		$this->load->database();
	}
	
	/*  
	 * @input none
	 * @output database object or No Data
	 * @description Find the forms associated with Crimson Forms module
	 * */
	function find_forms() {
		$sql = "SELECT * FROM crimson_forms";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return "No Data";
		}
	}
	
	function setup_database() {
		$sql = "CREATE TABLE crimson_forms (formid int primary key auto_increment, form_name varchar(100), form_table varchar(50), status tinyint default 1);";
	}
}

?>
