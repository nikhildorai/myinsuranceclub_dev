<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Policy_features_level_term extends Admin_Controller {
 
    function __construct() 
    {
        parent::__construct();
		$this->load->model('policy_features_level_term_model');
		$this->load->model('policy_rider_level_term_model');
		$this->load->model('policy_variants_master_model');
	}
	
	public function level_term($variant_id = null)
	{
		if (!empty($variant_id))
		{
			//default variables
			$where = $arrParams = $model = $riders = $policy = $policyModel = $variantModel = $saveData = $riderModel = $oldPeerComparision = $newPeerComparision = array();
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
						
				
				//	check if feature exists of not
				$where = array();
				$where[0]['field'] = 'variant_id';
				$where[0]['value'] = (int)$variant_id;
				$where[0]['compare'] = 'equal';
				$exist = $this->util->getTableData($modelName='Policy_features_level_term_model', $type="single", $where, $fields = array());
				if (empty($exist))
				{
				}
				else 
				{
					if ($exist['status'] != 'active')
						$isActive = false;
					$modelType = 'update';
					$model = $exist;
					$feature_id = $exist['feature_id'];
					$oldPeerComparision = explode(',', $model['pear_comparision_policies']);
					//	check if rider exists for current varient
					$where = array();
					$where[0]['field'] = 'variant_id';
					$where[0]['value'] = (int)$variant_id;
					$where[0]['compare'] = 'equal';
					$riders = $this->util->getTableData($modelName='Policy_rider_level_term_model', $type="all", $where, $fields = array());
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
				//$allVariants = Policy_variants_master_model::getAllPolicyVariantsDetails(array('product_id'=>13, 'sub_product_id'=>2));
				//$allVarients = Policy_variants_master_model::getAllPolicyVariantsDetails(array('product_id'=>$policyModel['product_id'], 'sub_product_id'=>$policyModel['sub_product_id']));
			
				if($this->input->post('model') && $isActive == true)
				{
					
					//	set default post values
					$_POST['model']['pear_comparision_policies'] = (isset($_POST['model']['pear_comparision_policies']) && !empty($_POST['model']['pear_comparision_policies'])) ? implode(',', $_POST['model']['pear_comparision_policies']) : '';
					$newPeerComparision = explode(',', $_POST['model']['pear_comparision_policies']);
					
					$arrParams = $this->input->post('model');
					//	set default values
					$arrParams['feature_id'] = (isset($feature_id) && !empty($feature_id)) ? $feature_id : '';
					$arrParams['variant_id'] = (isset($variant_id) && !empty($variant_id)) ? $variant_id : '';
					
					
					//	set validation rules
					$validation_rules = array(
						array('field' => 'model[minimum_sum_assured]', 'label' => 'minimum sum assured', 'rules' => 'required'),
						array('field' => 'model[maximum_sum_assured]', 'label' => 'maximum sum assured', 'rules' => 'required'),
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
						array('field' => 'model[pear_comparision_policies]', 'label' => 'Peer Comparison', 'rules' => 'required'),
					//	array('field' => 'model[]', 'label' => '', 'rules' => 'required'),
				*/		);
//var_dump($_POST);die;					
					$riderPost = $this->input->post('riderModel');
					$this->form_validation->set_rules($validation_rules);
					if ($this->form_validation->run())
					{
						//	update the peer comparision count for each variant
						Util::updatePeerConnectionCountValue($newPeerComparision, $oldPeerComparision);
						
						//	save record for feature 
						$recordId = $this->policy_features_level_term_model->saveRecord($arrParams, $modelType);	
						if ($recordId != false)
							$saveData[] = true;
						else 
							$saveData[] = false;
						
						//	save records for rider
						if (!empty($riderPost))
						{
							// save records for varients
							$saveRiders = Util::saveRiderData($variant_id, $riderPost, $riderModelName = 'Policy_rider_level_term_model');

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
				//$allVariants = Policy_variants_master_model::getAllPolicyVariantsDetails(array('product_id'=>$policyModel['product_id'], 'sub_product_id'=>$policyModel['sub_product_id']));
			
				$this->data['model'] = $model;
				$this->data['modelType'] = $modelType;
				$this->data['riderModel'] = $riders;
				$this->data['variantModel'] = $variantModel;
				$this->data['policyModel'] = $policyModel;
				//$this->data['allVariants'] = $allVariants;
//var_dump($this->data);die;	

				$this->template->write_view('content', 'admin/policy_features/level_term', $this->data, TRUE);
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