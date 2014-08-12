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
					
					//	cashless treatment
					if (!empty($_POST['model']['cashless_treatment']))
					{
						$cashless_treatment = (isset($_POST['model']['cashless_treatment'][0]) ? $_POST['model']['cashless_treatment'][0] : 'No').' hospitals across '.(isset($_POST['model']['cashless_treatment'][1]) ? $_POST['model']['cashless_treatment'][1].' cities' : ' country');
						$_POST['model']['cashless_treatment'] = $cashless_treatment;
					}
					//	pre-existing dieseases
					if (!empty($_POST['model']['preexisting_diseases']))
					{
						$_POST['model']['preexisting_diseases'] = (isset($_POST['model']['preexisting_diseases']) ? $_POST['model']['preexisting_diseases'] : '0');
						$_POST['model']['preexisting_diseases'] .= ((int)$_POST['model']['preexisting_diseases'] > 1) ? ' years': ' year';
					}			
						
					//	min & max coverage account
					if (isset($_POST['model']['coverage_amount']) && !empty($_POST['model']['coverage_amount']))
					{
						$_POST['model']['minimum_coverage_amount'] = reset($_POST['model']['coverage_amount']['value']);
						$_POST['model']['maximum_coverage_amount'] = end($_POST['model']['coverage_amount']['value']);
						$_POST['model']['coverage_amount'] = serialize(array('value'=>implode(',', $_POST['model']['coverage_amount']['value']), 'comments'=>$_POST['model']['coverage_amount']['comment']));
					}
						
					//	min & max coverage account
					if (isset($_POST['model']['duration_of_coverage']) && !empty($_POST['model']['duration_of_coverage']))
					{
						$_POST['model']['minimum_policy_terms'] = reset($_POST['model']['duration_of_coverage']);
						$_POST['model']['maximum_policy_terms'] = end($_POST['model']['duration_of_coverage']);
						$_POST['model']['duration_of_coverage'] = implode(',', $_POST['model']['duration_of_coverage']);
					}
				
//var_dump($_POST);die;		
					//	minimum entry age
					if (isset($_POST['model']['minimum_entry_age']) && !empty($_POST['model']['minimum_entry_age']))
					{
						$_POST['model']['minimum_entry_age'] = implode(' ', $_POST['model']['minimum_entry_age']);
					}
					//	minimum entry age
					if (isset($_POST['model']['maximum_entry_age']) && !empty($_POST['model']['maximum_entry_age']))
					{
						$_POST['model']['maximum_entry_age'] = implode(' ', $_POST['model']['maximum_entry_age']);
					}
					//	entry age comments
					if (isset($_POST['model']['entry_age_comments']) && !empty($_POST['model']['entry_age_comments']))
					{
						$_POST['model']['entry_age_comments'] = serialize($_POST['model']['entry_age_comments']);
					}
//var_dump($_POST['model']['entry_age_comments']);die;	
					//	max renewal age
					if (isset($_POST['model']['maximum_renewal_age']) && !empty($_POST['model']['maximum_renewal_age']))
					{
						$lifelong = (in_array('lifelong', $_POST['model']['maximum_renewal_age'])) ? true : false;
						if ($lifelong == true)
							$_POST['model']['maximum_renewal_age'] = 'lifelong';
						else 
						{
							if(($key = array_search('lifelong', $_POST['model']['maximum_renewal_age'])) !== false) {
								unset($_POST['model']['maximum_renewal_age'][$key]);
							}
							if(($key = array_search('years', $_POST['model']['maximum_renewal_age'])) !== false) {
								unset($_POST['model']['maximum_renewal_age'][$key]);
							}
							$_POST['model']['maximum_renewal_age'] = implode(',', $_POST['model']['maximum_renewal_age']).' years';
						}
					}
										
					$arrParams = $this->input->post('model');
					//	set default values
					$arrParams['features_id'] = (isset($feature_id) && !empty($feature_id)) ? $feature_id : '';
					$arrParams['variant_id'] = (isset($variant_id) && !empty($variant_id)) ? $variant_id : '';
			
					
					//	set validation rules
					$validation_rules = array(
						array('field' => 'model[minimum_coverage_amount]', 'label' => 'minimum coverage amount', 'rules' => 'required'),
						array('field' => 'model[maximum_coverage_amount]', 'label' => 'maximum coverage amount', 'rules' => 'required'),
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