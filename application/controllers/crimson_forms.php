<?php
/**
 * Crimson Forms
 * 
 * Crimson Forms is a CodeIgniter based application that 
 * allows you to view and manage user submitted forms on your site
 * FILES:
 * 		/view/crimson_forms/header.php
 * 		/view/crimson_forms/body.php
 * 		/view/crimson_forms/footer.php
 * 		/css/all.css
 * 		/img
 * @author		Aaron Harvey
 * @copyright	Copyright (c) 2013, Crimson Cardinal. (http://www.crimson-cardinal.com/)
 * @link		http://www.crimson-cardinal.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Crimson_forms extends CI_Controller {
		
	function __construct() {
		parent::__construct();
		$this->load->model('crimson_model');
	}
	
	/**********************/
	/* CRIMSON FORMS HOME */
	/**********************/
	public function index() {
		//Generic page setup	
		$data['title'] = "Home";
		$data['h1_tag'] = "Forms Management";
		$data['center_right'] = '<a href="crimson_forms/add_form" class="button">NEW FORM</a>';
		$data['intro_text'] = 'Welcome to Crimson Forms! You can setup and manage all of your user submitted forms here.  Get started by clicking on <strong>"Add New"</strong> in the top 
        right corner.';
		
		//Begin building page
		$formList = $this->crimson_model->find_forms();
		$forms = "";
		//Cycle through forms
		if($formList != "No Data") {
			foreach($formList as $form) {
				$forms .= "<tr><td class=\"first\">$form->form_name</td><td>$form_actions</td><td>$form->form_id</td><td class=\"last\">last submission</td></tr>"; 
			}
		} else {
			$forms = "<tr><td colspan=5>$formList</td></tr>";
		}
		$data['page_content'] = '
		<div class="table"> 
	        <table class="listing" cellpadding="0" cellspacing="0">
	          <thead>
	            <th class="first" style="width: 75px; text-align: center;">Form ID</th>
	            <th>Form Name</th>
	            <th>Actions</th>
	            <th>Submissions</th>
	            <th class="last">Last Submission</th>
	          </thead>'.
	          $forms
	      .'</table>
      </div>';
		$this->load->view('crimson_forms/header.php', $data);
		$this->load->view('crimson_forms/body.php');
		$this->load->view('crimson_forms/footer.php');
	}
	
	public function add_form() {
		$this->load->helper(array('form', 'url'));
		$data['title'] = "New Form";
		$data['h1_tag'] = "Add a Form";
		$data['center_right'] = '';
		$status_options = array('active' => "Active", 'inactive' => "Inactive");
		$col_options = array('input' => "Input Area", 'select' => "Dropdown", 'textarea' => "Textarea", 'multiselect' => "Multiple Select", );
		$data['intro_text'] = 'Add a Field<br/>' . form_dropdown('new_form_type', $col_options, 'input', 'style="margin-top: -9px;"') . "<img id=\"add-field\" src=" . base_url() . "img/plus_icon.png style=\"cursor: pointer;\">";
		$data['page_content'] = "<div id=\"crimson-form-wrapper\">".  
		form_open('crimson_forms/submit_new_form') .
		form_fieldset('Form Information') . 
		form_label('Form Name', 'form_name') .
		form_input(array('name' => 'form_name', 'max_length' => '100', 'style'=>'width: 300px')).
		form_label('Status', 'form_status') .
		form_dropdown('form_status',$status_options, 'active') .
		form_fieldset_close().
		form_fieldset('Form Fields') .
		"<ul>" .
		"<li>" . form_label('Name') .
		form_input(array('name' => 'column1_name', 'max_length' => '100', 'style'=>'width: 300px'),'Submit', 'disabled=disabled') .
		form_label('Label') .
		form_input(array('name' => 'column1_label', 'max_length' => '100', 'style'=>'width: 100px'), 'Submit Form') .
		form_label('Status') . 
		form_dropdown('form_status',$status_options, 'active', 'disabled=disabled');
		"</ul>" .
		"</div>";
		$this->load->view('crimson_forms/header.php', $data);
		$this->load->view('crimson_forms/body.php');
		$this->load->view('crimson_forms/footer.php');
	}
	/***********************/
	/* INSTALLATION SCRIPT */
	/***********************/
	public function execute_install() {
		$this->crimson_model->setup_database();
		
	}
}
?>
	