<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Policy_features_mediclaim extends Admin_Controller {
 
    function __construct() 
    {
        parent::__construct();
		$this->load->model('policy_features_mediclaim_model');
		$this->load->model('policy_rider_mediclaim_model');
		$this->load->model('policy_variants_master_model');
	}
	
	public function mediclaim($variant_id = null)
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
				$exist = $this->util->getTableData($modelName='Policy_features_mediclaim_model', $type="single", $where, $fields = array());

				if (empty($exist))
				{
				}
				else 
				{
					if ($exist['status'] != 'active')
						$isActive = false;
					$modelType = 'update';
					$model = $exist;
					$feature_id = $exist['features_id'];
					//$oldPeerComparision = (isset($model['peer_comparision_variants']) && !empty($model['peer_comparision_variants'])) ? explode(',', $model['peer_comparision_variants']) : array();
					//	check if rider exists for current varient
					$where = array();
					$where[0]['field'] = 'variant_id';
					$where[0]['value'] = (int)$variant_id;
					$where[0]['compare'] = 'equal';
					$riders = $this->util->getTableData($modelName='Policy_rider_mediclaim_model', $type="all", $where, $fields = array());
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
				$allVarients = Policy_variants_master_model::getAllPolicyVariantsDetails(array('product_id'=>$policyModel['product_id'], 'sub_product_id'=>$policyModel['sub_product_id']));
			
				if($this->input->post('model') && $isActive == true)
				{
					
				//	set default post values
				
				//	$_POST['model']['peer_comparision_variants'] = (isset($_POST['model']['peer_comparision_variants']) && !empty($_POST['model']['peer_comparision_variants'])) ? implode(',', $_POST['model']['peer_comparision_variants']) : '';
				//	$newPeerComparision = explode(',', $_POST['model']['peer_comparision_variants']);

					$arrSerialize = array(	'coverage_amount','policy_terms','entry_age', 'renewal_age', 'no_medical_test_age', 'cashless_treatment','post_hosp',
											'pre_hosp','day_care', 'ayurvedic', 'co_pay','maternity_normal_delivery', 'maternity_caesarean_delivery',
											'maternity_new_born_baby_cover', 'maternity_addition_of_new_born', 'hospital_cash', 'emergency_ambulance', 
											'organ_donor_exp',  'e_opinion','domiciliary_treatment_expenses', 'family_discount', 'two_year_policy_option',
											'room_rent','icu_rent',
										);
					
//var_dump($_POST['model']['coverage_amount']);
					foreach ($arrSerialize as $k1=>$v1)
					{
						if (isset($_POST['model'][$v1]) && !empty($_POST['model'][$v1]))
						{  
							$_POST['model'][$v1] = serialize($_POST['model'][$v1]);
						}
					}
					
//var_dump($_POST['model']['coverage_amount']);die;	
//var_dump($_POST['model']['domiciliary_treatment_expenses']);die;		
					$arrParams = $this->input->post('model');
					//	set default values
					$arrParams['features_id'] = (isset($feature_id) && !empty($feature_id)) ? $feature_id : '';
					$arrParams['variant_id'] = (isset($variant_id) && !empty($variant_id)) ? $variant_id : '';
			
					
					//	set validation rules
					$validation_rules = array(
						array('field' => 'model[coverage_amount]', 'label' => 'coverage amount', 'rules' => 'required'),
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
						Util::updatePeerConnectionCountValue($newPeerComparision, $oldPeerComparision);
						
						//	save record for feature 
						$recordId = $this->policy_features_mediclaim_model->saveRecord($arrParams, $modelType);	
						if ($recordId != false)
							$saveData[] = true;
						else 
							$saveData[] = false;
						
						//	save records for rider
						if (!empty($riderPost))
						{
							// save records for varients
							$saveRiders = Util::saveRiderData($variant_id, $riderPost, $riderModelName = 'Policy_rider_mediclaim_model');

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
					$model = $_POST['model'];
					$riders = $_POST['riderModel'];
				}	
				$allVariants = Policy_variants_master_model::getAllPolicyVariantsDetails(array('product_id'=>$policyModel['product_id'], 'sub_product_id'=>$policyModel['sub_product_id']));
			
				$this->data['model'] = $model;
				$this->data['modelType'] = $modelType;
				$this->data['riderModel'] = $riders;
				$this->data['variantModel'] = $variantModel;
				$this->data['policyModel'] = $policyModel;
				$this->data['allVariants'] = $allVariants;
				$this->data['companyModel'] = $companyModel;

				$this->template->write_view('content', 'admin/policy_features/mediclaim', $this->data, TRUE);
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