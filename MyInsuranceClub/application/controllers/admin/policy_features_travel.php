<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Policy_features_travel extends Admin_Controller {
 
    function __construct() 
    {
        parent::__construct();
		$this->load->model('policy_features_travel_model');
		$this->load->model('policy_rider_travel_model');
		$this->load->model('policy_variants_master_model');
	}
	
	public function travel_insurance($variant_id = null)
	{
		if (!empty($variant_id))
		{
			//default variables
			$where = $arrParams = $model = $riders = $policy = $policyModel = $companyModel = $variantModel = $saveData = $riderModel = $oldPeerComparision = $newPeerComparision = array();
			$feature_id = '';
			
			
			//	check if active variant exists
			$where[0]['field'] = 'variant_id';
			$where[0]['value'] = (int)$variant_id;
			$where[0]['compare'] = 'equal';
			$where[1]['field'] = 'status';
			$where[1]['value'] = 'active';
			$where[1]['compare'] = 'equal';
			$variantModel = $this->util->getTableData($modelName='Policy_variants_master_model', $type="all", $where, $fields = array());
			if (empty($variantModel))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
				redirect('admin/policy/index');
			}
			else 
			{
				$variantModel = reset($variantModel);
				$modelType = 'create';
				$this->data['message'] = '';
				$sessionMsg = $this->session->flashdata('message');
				$this->data['message'] = ( !empty($sessionMsg)) ? $sessionMsg : '';
				$this->session->set_flashdata('message','');	
				$isActive = true;
				
				//	get the policy of variant
				$where[0]['field'] = 'policy_id';
				$where[0]['value'] = (int)$variantModel['policy_id'];
				$where[0]['compare'] = 'equal';
				$policyModel = $this->util->getTableData($modelName='Policy_master_model', $type="single", $where, $fields = array());
						
				
				//	get the company of variant
				$where[0]['field'] = 'company_id';
				$where[0]['value'] = (int)$policyModel['company_id'];
				$where[0]['compare'] = 'equal';
				$companyModel = $this->util->getTableData($modelName='Insurance_company_master_model', $type="single", $where, $fields = array());
						
				
				//	check if feature exists of not
				$where = array();
				$where[0]['field'] = 'variant_id';
				$where[0]['value'] = (int)$variant_id;
				$where[0]['compare'] = 'equal';
				$exist = $this->util->getTableData($modelName='Policy_features_travel_model', $type="single", $where, $fields = array());

				if (empty($exist))
				{
				}
				else 
				{
					if ($exist['status'] != 'active')
						$isActive = false;
					$modelType = 'update';
					$model = $exist;
					$feature_id = (!empty($exist)) ? $exist['features_id'] : '';
					//$oldPeerComparision = (isset($model['peer_comparision_variants']) && !empty($model['peer_comparision_variants'])) ? explode(',', $model['peer_comparision_variants']) : array();
					//	check if rider exists for current varient
					$where = array();
					$where[0]['field'] = 'variant_id';
					$where[0]['value'] = (int)$variant_id;
					$where[0]['compare'] = 'equal';
					$riders = $this->util->getTableData($modelName='Policy_rider_travel_model', $type="all", $where, $fields = array());
					if (!empty($riders))
						$riders = Util::rearrangeRiders($riders);
				}		
				
				//Ckeditor's configuration
				$this->data['ckeditor'] = array(
					//ID of the textarea that will be replaced
				//	'class' => 	'ckeditor',
					'id'=>'ckeditor1',
					'path'	=>	'JS/ckeditor',
					//Optionnal values
					'config' => Util::getCKEditorConfig(),
				);
				
				
				//	get all the varients from others policies for peer comparison
				//$allVarients = Policy_variants_master_model::getAllPolicyVariantsDetails(array('product_id'=>$policyModel['product_id'], 'sub_product_id'=>$policyModel['sub_product_id']));
			
				if($this->input->post('model') && $isActive == true)
				{
					
				//	set default post values
				
				//	$_POST['model']['peer_comparision_variants'] = (isset($_POST['model']['peer_comparision_variants']) && !empty($_POST['model']['peer_comparision_variants'])) ? implode(',', $_POST['model']['peer_comparision_variants']) : '';
				//	$newPeerComparision = explode(',', $_POST['model']['peer_comparision_variants']);
					
					$arrSerialize = array(	'coverage_amount', 'policy_terms','entry_age','renewal_age', 'no_medical_test_age','no_medical_sum_assured_limit','cashless_treatment',
											'pre_existing_diseases','free_look_period','grace_period', 'cumulative_bonus', 'medical_expenses','dental','emergency_medical_evacuation',
											'repatriation_of_mortal_remains','total_loss_of_checked_baggage','delay_of_checked_baggage','loss_of_passport','loss_of_visa','personal_liability',
											'trip_cancellation','trip_curtailment','trip_interruption','hospital_daily_cash','personal_accident','personal_accident_common_carrier',
											'accident_sickness_medical_expenses_reimbursement','accidental_death_air_travel','flight_delay','hijack_daily_allowance','automatic_extension_of_policy',
											'emergency_cash_advance','missed_connection','sponsor_protection','bounced_bookings','fraudulent_charges', 'home_burglary', 'study_interuption','compassionate_visit',
											'bail_bond','felonious_assault','maternity_benefit_for_termination_of_pregnancy','other_medical_treatment','red_services','in_hospital_indemnity_accident',
											'assistance_services','in_hospital_indemnity_accident','accommodation_charges_on_delay','loss_of_ticket','transportation','replacement_of_staff',
											'missed_departure','loss_of_personal_documents','childcare_benefits','accidental_death_and_dismemberment','accidental_death_and_dismemberment_common_carrier',
											'personal_accident_domestic','political_risk_and_catastrop_evacuation','fire_cover_for_building','fire_cover_for_home_content','emergency_hotel_extension',
											'golfe_hole_in_one','any_one_illness','any_one_accident','tution_fees','accident_to_sponsor','family_visit','international_driving_license_loss',
											'reunion_expenses','transportation_of_mortal_remains','ped','additioal_si_for_accidental_hospitalization','business_class','return_of_minor_children','out_patient_care');
					foreach ($arrSerialize as $k1=>$v1)
					{
						if (isset($_POST['model'][$v1]) && !empty($_POST['model'][$v1]))
						{  
							$_POST['model'][$v1] = serialize($_POST['model'][$v1]);
						}
					}		
					
//var_dump($_POST['model']);die;		
					$arrParams = $this->input->post('model');
					//	set default values
					$arrParams['features_id'] = (isset($feature_id) && !empty($feature_id)) ? $feature_id : '';
					$arrParams['variant_id'] = (isset($variant_id) && !empty($variant_id)) ? $variant_id : '';
			
					
					//	set validation rules
					$validation_rules = array(
						array('field' => 'model[coverage_amount]', 'label' => 'minimum coverage amount', 'rules' => 'required'),
			//			array('field' => 'model[maximum_coverage_amount]', 'label' => 'maximum coverage amount', 'rules' => 'required'),
			/*			array('field' => 'model[minimum_policy_terms]', 'label' => 'minimum policy terms', 'rules' => 'required'),
						array('field' => 'model[maximum_policy_terms]', 'label' => 'maximum policy terms', 'rules' => 'required'),
						array('field' => 'model[premium_payment_terms]', 'label' => 'premium payment terms', 'rules' => 'required'),
						array('field' => 'model[minimum_entry_age]', 'label' => 'minimum entry age', 'rules' => 'required'),
						array('field' => 'model[maximum_entry_age]', 'label' => 'maximum entry age', 'rules' => 'required'),
						array('field' => 'model[minimum_age_at_maturity]', 'label' => 'minimum age at maturity', 'rules' => 'required'),
						array('field' => 'model[maximum_age_at_maturity]', 'label' => 'maximum age at maturity', 'rules' => 'required'),
						array('field' => 'model[minimum_premium]', 'label' => 'minimum premium', 'rules' => 'required'),
						array('field' => 'model[maximum_premium]', 'label' => 'maximum premium', 'rules' => 'required'),
						array('field' => 'model[payment_modes]', 'label' => 'payment modes', 'rules' => 'required'),
						array('field' => 'model[peer_comparision_variants]', 'label' => 'Peer Comparison', 'rules' => 'required'),
					//	array('field' => 'model[]', 'label' => '', 'rules' => 'required'),
				*/		);				
					$riderPost = $this->input->post('riderModel');
					$this->form_validation->set_rules($validation_rules);
					
					if ($this->form_validation->run())
					{
						//	update the peer comparision count for each variant
					//	Util::updatePeerConnectionCountValue($newPeerComparision, $oldPeerComparision);
						
						//	save record for feature 
						$recordId = $this->policy_features_travel_model->saveRecord($arrParams, $modelType);	
						if ($recordId != false)
							$saveData[] = true;
						else 
							$saveData[] = false;
					
						//	save records for rider
						if (!empty($riderPost))
						{
							// save records for varients
							$saveRiders = Util::saveRiderData($variant_id, $riderPost, $riderModelName = 'Policy_rider_travel_model');

							if ($saveRiders['result'] == true)
								$saveData[] = true;
							else 
							{
								$saveData[] = false;
								$this->data['message'] .= $saveRiders['msg'];
								$this->data['msgType'] = 'error';
							}
							$riders = $saveRiders['riderModel'];	
						}
						
						if (!in_array(false, $saveData))
						{
							$this->data['message'] = '<p class="status_msg">Record saved successfully.</p>';
						//	$this->session->set_flashdata('message', '<p class="status_msg">Record saved successfully.</p>');
							$this->data['msgType'] = 'success';
						}
						
					}	
					else 
					{
						// 	Set validation errors.
						$this->data['message'] = validation_errors('<p class="error_msg">', '</p>'); 
						$this->data['msgType'] = 'error';
					}	

					$model = (isset($_POST['model']) && !empty($_POST['model'])) ? $_POST['model'] : array();
					$riders = (isset($_POST['riderModel']) && !empty($_POST['riderModel'])) ? $_POST['riderModel'] : array();
				}	
				//$allVariants = Policy_variants_master_model::getAllPolicyVariantsDetails(array('product_id'=>$policyModel['product_id'], 'sub_product_id'=>$policyModel['sub_product_id']));
			
				$this->data['model'] = $model;
				$this->data['modelType'] = $modelType;
				$this->data['riderModel'] = $riders;
				$this->data['variantModel'] = $variantModel;
				$this->data['policyModel'] = $policyModel;
				//$this->data['allVariants'] = $allVariants;
				$this->data['companyModel'] = $companyModel;

				$this->template->write_view('content', 'admin/policy_features/travel', $this->data, TRUE);
				$this->template->render();
			}
		}
		else 
		{
			$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
			redirect('admin/policy/index');
		}
	}
	
}

/* End of file auth_lite.php */
/* Location: ./application/controllers/auth_lite.php */