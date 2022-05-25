<?php
defined('BASEPATH') or exit('no direct script allowed');

class Welcome extends CI_Controller
{	

    function __construct()
    {
        parent::__construct();
		$this->survivour_api_path = base_url() . '/survivour_api/';
    }

	/**
	 * Function index
	 * survivour: get specific data to forword on html page for showing them as per required modals.
	 * inventory: get specific data to forword on html page for showing them as per required modals.
	 * infected: get specific data to forword on html page for showing them as per required modals.
	 * noninfected: get specific data to forword on html page for showing them as per required modals.	 
	 */
	public function index()
	{
		// Curl operation to get api data
		$path = curl_init($this->survivour_api_path . 'survivour_all_or_single_data/');
		curl_setopt($path, CURLOPT_RETURNTRANSFER, true);
		$data['survivour'] = json_decode(trim(curl_exec($path)));
		curl_close($path);

		// Get invertory related data
		$pathInventory = curl_init($this->survivour_api_path . 'inventory_and_survivour_all_or_single_data/');
		curl_setopt($pathInventory, CURLOPT_RETURNTRANSFER, true);
		$data['inventory'] = json_decode(trim(curl_exec($pathInventory)));
		curl_close($pathInventory);

		// Get infected and non infected survivours report
		$infected = curl_init($this->survivour_api_path . 'survivour_flag_report?flag=0');
		curl_setopt($infected, CURLOPT_RETURNTRANSFER, true);
		$data['infected'] = json_decode(trim(curl_exec($infected)));
		curl_close($infected);

		// Get infected and non infected survivours report
		$noninfected = curl_init($this->survivour_api_path . 'survivour_flag_report?flag=1');
		curl_setopt($noninfected, CURLOPT_RETURNTRANSFER, true);
		$data['noninfected'] = json_decode(trim(curl_exec($noninfected)));
		curl_close($noninfected);

		// Access robots file to send the data to html page
		$file = 'assets/uploads/robots.json';
		$data['robots'] = $this->readRobotData($file);

		// echo '<pre>'; print_r($data['robots']);
		$data['page_title'] = 'Survivor Base';
		$this->load->view('survivor',$data);
	}

	public function readRobotData($file)
	{		
		// $file = 'assets/uploads/robots.json';
		if(file_exists($file) === true){			
			// read json file
			$readjsonFile = file_get_contents($file);

			// Convert json to array			
			$robotData = json_decode($readjsonFile, true);
			// $data['flyingRobots'] = count(array_count_values($data['roboData'], ))
			$data['Land'] = array_count_values(array_column($robotData, 'category'))['Land'];
			$data['Flying'] = array_count_values(array_column($robotData, 'category'))['Flying'];
			return $data;
			// echo count($robotData);
			// foreach($robotData as $key => $value){
			// 	echo $value['category'] == 'Land' ? count($value['category']) : '';
			// }
			// echo '<pre>'; print_r($value);
		}
	}
}
