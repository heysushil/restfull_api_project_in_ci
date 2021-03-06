<?php
require APPPATH . '/libraries/REST_Controller.php';
class Survivour_api extends REST_Controller
{

	/**
	 * Defined few common used values here
	 * @param survivor for table names
	 * @param inventory for table names
	 * 
	 * 
	 */

	 private $survivor = 'survivor';
	 private $inventory = 'inventory';

    function __construct($config = 'rest')
    {
        parent::__construct($config);
    }

	/**
	 * Function survivour_form_data_post
	 * 
	 * @param name dataType -> varchar
	 * @param age dataType -> int
	 * @param gender dataType -> varchar
	 * @param latitude dataType -> float
	 * @param longitude dataType -> float
	 * 
	 * After store new surviour also provide some resource to our surviour so that he/she can heal them self
	 * Proving resource are
	 * @param water dataType -> int
	 * @param food dataType -> int
	 * @param medication dataType -> int
	 * @param ammunition dataType -> int
	 * 
	 * These resource also will refilable 	 
	 */

	public function survivour_all_or_single_data_get()
	{
		$id = $this->input->get('id');
		if($id != null){
			$data['success'] = 'Get single servivour data.';
			$data['result'] = $this->Model_common->getWhereContiondata($this->survivor, array('id'=>$id));
		}else{
			$data['success'] = 'Get all servivour data.';
			$data['result'] = $this->Model_common->getAllData($this->survivor);
		}
		$this->response($data, 200);
	}

	public function inventory_and_survivour_all_or_single_data_get()
	{
		$id = $this->input->get('id');
		if($id != null){
			$data['success'] = 'Get single servivour data.';
			$data['result'] = $this->db->query("SELECT s.name, i.* FROM survivor s LEFT JOIN inventory i ON s.id=i.survivor_id WHERE s.id=$id ORDER BY s.id DESC")->result_array();
		}else{
			$data['success'] = 'Get all inverntory data.';
			$data['result'] = $this->db->query("SELECT s.name, i.* FROM survivor s LEFT JOIN inventory i ON s.id=i.survivor_id ORDER BY s.id DESC")->result_array();
		}
		$this->response($data, 200);
	}

	public function survivour_form_data_post()
	{
		$arrayData['name']      = $this->input->post('name'); 
		$arrayData['age']       = $this->input->post('age');
		$arrayData['gender']    = $this->input->post('gender');   
		$arrayData['latitude']  = $this->input->post('latitude');     
		$arrayData['longitude'] = $this->input->post('longitude');  
			
		// echo 'Enter in api: <pre>';print_r($arrayData);
		// Insert data on db
		$result = $this->Model_common->insertData($this->survivor, $arrayData);
		$survivor_id = $this->db->insert_id();
		if($result === true){
			// Surviour if added to our database then provide him/her these resource
			// 10 is a scale form 0 to 10 for magering the resource quantity.
			$resourceArrayData['survivor_id']= $survivor_id;
			$resourceArrayData['water']      = 100;  
			$resourceArrayData['food']       = 100; 
			$resourceArrayData['medication'] = 100;       
			$resourceArrayData['ammunition'] = 100;       			
			$resourceResult = $this->Model_common->insertData($this->inventory, $resourceArrayData);
			if($resourceResult === true){
				$response['success'] = 'New Surviour founded and recorded on our database successfully. Alos we provide resources successfully to the survivour';				
			}else{
				$response['error'] = 'New Surviour founded and recorded on our database successfully. But we failed to provide resources to the survivour because robots came and attacked us.';
			}	
			$this->response($response, 200);		
		}else{
			$response['error'] = 'Ohh no, there is some problem, try again hurry or we loss you.';
			$this->response($response, 502);
		}
	}

	/**
	 * Function survivour_location_update_post
	 * @param id need to update specific survivours location
	 * 
	 * @param latitude dataType = double
	 * @param longitude dataType = double
	 */
	public function survivour_location_update_post()
	{
		$id = $this->input->post('id');
		if($id != null)
		{
			$arrayData['latitude']  = $this->input->post('latitude');     
			$arrayData['longitude'] = $this->input->post('longitude');
			$result = $this->Model_common->updateData($this->survivor, $arrayData, array('id'=>$id));
			// $result = $this->db->set($arrayData)->where('id',$id)->update($this->survivor);
			if($result === true){
				$response['success'] = 'Yes, surviour successfully changed location and safe for know.';
				$this->response($response, 200);
			}else{
				$response['error'] = ' Ohh no, there is some problem, try again hurry or we loss you.';
				$this->response($response, 502);
			}
		}else{
			$response['error'] = 'Id not get: '. $id . 'Alert, you are not allowed to do this.';
			$this->response($response, 502);
		}
	}

	/**
	 * Function survivour_flag_infected_post
	 * use to update survivour stats as infected or if survivour not revour then update to not infected from her
	 * 
	 * @param id need for survivour identification
	 * @param flag dataType = int use to update status 0 to 1 for infected
	 */
	public function survivour_flag_infected_post()
	{
		$id = $this->input->post('id');
		if($id != null)
		{

			$arrayData['flag']  = $this->input->post('flag') == 0 ? 1 : 0;			
			$result = $this->Model_common->updateData($this->survivor, $arrayData, array('id'=>$id));
			if($result === true){
				// $response['flag'] = $this->db->query("SELECT flag FROM survivor WHERE id=$id")->result_array();
				$response['success'] = 'Ohh no, surviour infected. Others be safe';
				$this->response($response, 200);
			}else{
				$response['error'] = 'Great, some how you are safe and not infected.';
				$this->response($response, 502);
			}
		}else{
			$response['error'] = 'Alert, you are not allowed to do this.';
			$this->response($response, 502);
		}
	}

	/**
	 * Function survivour_flag_report_get
	 * Need one param flag which have 2 condtion
	 * 0: not infected
	 * 1: infected
	 * 
	 * @param flag int
	 * 
	 * It's generated infrected and non infected report by this value
	 * 
	 */
	public function survivour_flag_report_get()
	{
		$flag = $this->input->get('flag');
		if($flag != null)
		{
			$response['result'] = $this->Model_common->getWhereContiondata($this->survivor, array('flag'=>$flag));
			$response['success'] = 'Yes, you the the total report';
			$this->response($response, 200);
		}else{
			$response['error'] = 'Alert, you are not allowed to do this.';
			$this->response($response, 502);
		}
	}

	/**
	 * Funtion survivour dead is use to delete one data form database.
	 */
	public function survivour_dead_post()
	{
		$id = $this->input->post('id');
		if($id != null)
		{			
			$result = $this->Model_common->deleteData($this->survivor,array('id'=>$id));
			$this->Model_common->deleteData($this->inventory,array('survivor_id'=>$id));
			if($result === true){
				$response['success'] = 'Ohh no, we lost one surviour.';
				$this->response($response, 200);
			}else{
				$response['error'] = 'Great, some how you are safe and not dead yet.';
				$this->response($response, 502);
			}
		}else{
			$response['error'] = 'Alert, you are not allowed to do this.';
			$this->response($response, 502);
		}
	}
}
