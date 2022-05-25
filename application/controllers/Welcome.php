<?php
defined('BASEPATH') or exit('no direct script allowed');

class Welcome extends CI_Controller
{
	private $survivour_api_path = 'http://localhost/restfull_api_project_in_ci/survivour_api/';

    function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		// Curl operation to get api data
		$path = curl_init($this->survivour_api_path . 'survivour_all_or_single_data/');
		curl_setopt($path, CURLOPT_RETURNTRANSFER, true);
		$data['survivour'] = json_decode(trim(curl_exec($path)));
		curl_close($path);
		// echo $data['survivour']->result[0]->name;
		// echo '<pre>';print_r($data['survivour']);

		$data['page_title'] = 'Survivor Base';
		$this->load->view('survivor',$data);
	}

	public function addNewSurvivor_formData()
	{
		// I don't used form validation here
		$formData['name'] = $this->input->post('name');
		$formData['age'] = $this->input->post('age');
		$formData['gender'] = $this->input->post('gender');
		$formData['latitude'] = $this->input->post('latitude');
		$formData['longitude'] = $this->input->post('longitude');
		// echo '<pre>';print_r($formData);

		// Create curl to access api v1.0
		$data_string = json_encode($formData);
		echo '<pre>';print_r($data_string);
		// $data_string = $formData;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->survivour_api_path . 'survivour_form_data');
		curl_setopt($ch, CURLOPT_POST, "POST");
		// curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		// curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		// set http header for post request
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($data_string))
		);
		// Submiting the post request.
		$get_response = curl_exec($ch);
		// CLose the curl session handle

		// CUrl v1.1
		// $data_string = json_encode($formData);
		// $ch = curl_init();                    // Initiate cURL
		// $url = "survivour_form_data/"; // Where you want to post data
		// curl_setopt($ch, CURLOPT_URL,$this->survivour_api_path . $url);
		// curl_setopt($ch, CURLOPT_POST, true);  // Tell cURL you want to post something
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); // Define what you want to post
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the output in string format
		// $output = curl_exec ($ch); // Execute

		// curl_close ($ch); // Close cURL handle

		// var_dump($output); // Show output
		// curl_close($ch);
		
		// if($get_response === 'success'){

		// }

		// echo $get_response;
		echo json_encode($get_response);
	}
    
	// Database query
	public function db()
	{
		$this->db->query("CREATE TABLE IF NOT EXISTS survivor(
			id int(8) not null auto_increment primary key,
			name varchar(100) not null,
			age int(3) not null,
			gender varchar(10) not null,
			latitude float(15) null,
			longitude float(15) null
		)");

		$this->db->query("CREATE TABLE IF NOT EXISTS inventory(
			id int(8) not null auto_increment primary key,
			survivor_id int(8),
			water int(2) not null,
			food int(2) not null,
			medication int(2) not null,
			ammunition int(2) not null
		)");

		$this->db->query("CREATE TABLE IF NOT EXISTS survivor_old_location(
			id int(8) not null auto_increment primary key,
			survivor_id int(8),
			latitude float(15) null,
			longitude float(15) null
		)");
	}
}
