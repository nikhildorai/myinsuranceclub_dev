<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Variants extends Admin_Controller {
    function __construct() 
    {
        parent::__construct();
		$this->load->model('policy_health_features_model');
		$this->load->model('policy_variants_master_model');
		$this->load->model('policy_master_model');
	}

    public function index()
	{
		$this->load->library('table');
		$this->load->library('pagination');
		$arrParams 	= array();
		if (isset($_GET))
			$arrParams = $_GET;
		$this->data['search_query'] = $arrParams;
		// Set any returned status/error messages..		
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
		$this->session->set_flashdata('message','');		
		$this->data['records'] 	= $this->policy_master_model->get_all_policy($arrParams);

		//	pagination
		$config = $this->util->get_pagination_params();
		$config['total_rows'] 	= $this->data['records']->num_rows();
		$this->pagination->initialize($config); 		
		$this->template->write_view('content', 'admin/policy/index', $this->data, TRUE);
		$this->template->render();
	}

    public function health($variant_id = null)
	{
		$modelType = 'create';
		//	check if policy id exists
		$variantModel = array();
		$this->data['message'] = '';
		$company_id = '';
		if ((isset($_GET['policy_id']) && !empty($_GET['policy_id'])) || !empty($policy_id))
		{
			if (isset($_GET['policy_id']))
				$policy_id = $_GET['policy_id'];
			$where = array();
			$where[0]['field'] = 'policy_id';
			$where[0]['value'] = (int)$policy_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='Policy_master_model', $type="single", $where, $fields = array());
			if (empty($exist))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
				redirect('admin/company/index');
			}
			else 
			{
				$policyModel = $exist;
				$company_id = $policyModel['company_id'];
				$modelType = 'update';
			}
		}
	
		//	check if post data is available
		if ($this->input->post('policyModel'))
		{
		
		}
		$this->data['modelType'] = $modelType;
		$this->data['variantModel'] = $variantModel;
		$this->template->write_view('content', 'admin/variant/health', $this->data, TRUE);
		$this->template->render();
	}
	
	public function saveVarientData($policy_id, $variantPost = array())
	{
		$return = $variantModel = array();
		$result = false;
		
		$msg = '<p class="error_msg">Undefined error in variant.</p>';
		if (!empty($variantPost))
		{
			foreach ($variantPost as $k1=>$v1)
			{
				foreach ($variantPost[$k1] as $k2=>$v2)
				{
					$variantModel[$k2][$k1] = $v2;
					$variantModel[$k2]['policy_id'] = $policy_id;
				}
			}
					
			if (!empty($variantModel))
			{
				$variantErrors = array();
				$arrSkip = array('variant_id', 'comments');
				foreach ($variantModel as $k3=>$v3)
				{
					if (!empty($v3))
					{
						$chkEmpty = true;
						foreach ($v3 as $k5=>$v5)
						{
							if (empty($v5) && !in_array($k5, $arrSkip))
								$chkEmpty = false;
						}
					}
					if ($chkEmpty == true)
					{
				  		$variantSave[] = true;
					}
					else 
					{
						$variantSave[] = false;
						$variantErrors[] = 'Some fields are empty for variant.';
					}
				}
			}
			if (!in_array(false, $variantSave))
			{
				$where = $existingVarientsIds = array();
				$where[0]['field'] = 'policy_id';
				$where[0]['value'] = (int)$policy_id;
				$where[0]['compare'] = 'equal';
	
				//	Add/update variants
				if (!empty($variantModel))
				{
					foreach ($variantModel as $k6=>$v6)
					{
						//	un comment to update existing records with previous status
					//	$v6['status'] = 'active';
						$savedVarients[] = $selectedVariantsIds[] = $this->addUpdateVariants($model = $v6, $policy_id);
					}
				}
			
				$existingVarients = $this->util->getTableData($modelName='Policy_variants_master_model', $type="all", $where, $fields = array());
				if (!empty($existingVarients))
				{
					foreach ($existingVarients as $k1=>$v1)
					{
						$existingVarientsIds[] = $v1['variant_id'];
					}
				}	
				$deleteVarients = array_diff($existingVarientsIds, $selectedVariantsIds);	
				//	save or update record
				if (!empty($deleteVarients))
				{
					foreach ($deleteVarients as $k4=>$v4)
					{
						$model = array();
						$model['variant_id'] = $v4;
						$model['status'] = 'deleted';
						$savedVarients[] = $this->addUpdateVariants($model, $policy_id);
					}
				}
			
				if (!empty($savedVarients))
				{
					$result = true;
					$msg = 'Variant updated successfully';
				}
			}
	  		else if (in_array(false, $variantSave))
	  		{
	  			$msg = '';
	  			$variantErrors = array_unique($variantErrors);
	  			//	not update some fields are empty
	  			foreach ($variantErrors as $k1=>$v1)
	  			{
	  				$msg .= '<p class="error_msg">'.$v1.'</p>';
	  			}
	  			$result = false;
	  		}	
		}
		else 
		{
			$result = false;
			$msg = '<p class="error_msg">Varient cannot be blank.</p>';
		}
		$return = array('result'=>$result, 'msg'=>$msg, 'varientModel'=>$variantModel);
		return $return;	
	}
	
	public function addUpdateVariants($model, $policy_id)
	{	
		$save  = false;
		if (!empty($model))
		{	
			//	check if record exists
			$where = array();
			$arrSkip = array('variant_id', 'status', 'comments');
			if (isset($model['variant_id']) && !empty($model['variant_id']))
			{
				$where[0]['field'] = 'variant_id';
				$where[0]['value'] = $model['variant_id'];
				$where[0]['compare'] = 'equal';
			}
			else 
			{
				$i = 0;
				foreach ($model as $k1=>$v1)
				{
					if (!in_array($k1, $arrSkip))
					{
						$where[$i]['field'] = $k1;
						$where[$i]['value'] = $v1;
						$where[$i]['compare'] = 'equal';
						$i++;
					}
				}
			}
			
			$isExist = $this->util->getTableData($modelName='Policy_variants_master_model', $type="all", $where, $fields = array());
			
			if (!empty($isExist))
			{
				foreach ($isExist as $k1=>$v1)
				{
					$model['variant_id'] = (int)$v1['variant_id'];
					$save = $this->policy_variants_master_model->saveRecord($arrParams = $model, $modelType = 'update');
					break;	
				}
			}
			else 
			{
				$save = $this->policy_variants_master_model->saveRecord($arrParams = $model, $modelType = 'create');
			}
			
		}
		return $save;
	}
	
	
	
	
	/* 
	 * $value	: it will have current validations post value
	 * $validationFor	:defines type of validation on field
	 */
	public function validatePost($post , $validationFor = null)
	{
		if (!empty($_POST) || !empty($post))
		{
			$modelType = 'create';
			$policyModel = $_POST['policyModel'];
			
			if (isset($_POST['modelType']) && !empty($_POST['modelType']))
				$modelType = $_POST['modelType'];
				
			$policy_id = (isset($policyModel['policy_id']) && !empty($policyModel['policy_id'])) ? $policyModel['policy_id'] : '';
			$company_id = (isset($policyModel['company_id']) && !empty($policyModel['company_id'])) ? $policyModel['company_id'] : '';	
			
			$arrSkip = $arrParams = array();
			if ($validationFor == 'policy_name')
			{
				$arrSkip = array('type_health_plan');
			}
			else if ($validationFor == 'type_health_plan')
			{			
				if (!empty($policyModel['company_id']))
				{
					$where = array();
					$where[0]['field'] = 'company_id';
					$where[0]['value'] = (int)$policyModel['company_id'];
					$where[0]['compare'] = 'equal';
					$compType = reset($this->util->getTableData($modelName='Insurance_company_master_model', $type="single", $where, $fields = array('company_type_id')));
					$where = array();
					$where[0]['field'] = 'company_type_id';
					$where[0]['value'] = (int)$compType['company_type_id'];
					$where[0]['compare'] = 'equal';
					$policyHealth = $this->util->getTableData($modelName='Policy_health_type_model', $type="all", $where, $fields = array());

					if (!empty($policyHealth))
					{
						if (isset($policyModel['type_health_plan']) && !empty($policyModel['type_health_plan']))
						{
							return true;
							/*foreach ($policyHealth as $k2=>$v2)
							{
								$a[$v2['type_id']] = $v2['type_name']; 
								$op .= '<option value="'.$v2['type_id'].'">'.$v2['type_name'].'</option>';
							}*/
						}
						else 
						{
							$_POST['policyModel']['type_health_plan'] = null;
							$this->form_validation->set_message('validatePost', 'The %s is required');
							return FALSE;
						}
					}
					else 
					{
						$_POST['policyModel']['type_health_plan'] = null;
					}		
				}
				else 
				{
					return true;
				}
			}
			else 
			{
				$arrParams = $policyModel;
			}
			
			foreach ($policyModel as $k1=>$v1)
			{
				if (!in_array($k1, $arrSkip))
					$arrParams[$k1] = $v1;
			}	
	
			//	search for existing records
			$record = $this->policy_master_model->getPolicy($arrParams);

			if ($record->num_rows == 0)
			{
				return TRUE;
			}
			else if ($record->num_rows == 1)
			{
				if ($modelType == 'create' )
				{
					$this->form_validation->set_message('validatePost', 'The %s already exists');
					return FALSE;
				}
				else if ($modelType == 'update')
				{
					//	if company id matches with post company id, then true else record exists 
					$record = reset($record->result_array());
					if ($record['policy_id'] == $arrParams['policy_id'])
					{
						return true;
					}
					else 
					{
						$this->form_validation->set_message('validatePost', 'The %s already exists');
						return FALSE;
					}
				}
				else 
				{
					$this->form_validation->set_message('validatePost', 'Undefined validation error');
					return FALSE;
				}
			}
			else if ($record->num_rows > 1)
			{
				$this->form_validation->set_message('validatePost', 'The %s already exists');
			}
			else 
			{
				$this->form_validation->set_message('validatePost', 'Undefined validation error');
				return FALSE;
			}
		}
		else 
		{
			$this->form_validation->set_message('validatePost', 'Undefined validation error');
			return FALSE;
		}
	}

	function changeStatus($variant_id = null, $status = 'inactive')
	{
		if (!empty($variant_id))
		{
			//	check if policy id exists
			$where = array();
			$where[0]['field'] = 'variant_id';
			$where[0]['value'] = (int)$variant_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='Policy_variants_master_model', $type="single", $where, $fields = array());
			if (empty($exist))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
			}
			else 
			{
				$companyModel = $exist;	
				$modelType = 'update';
				$arrParams['status'] = $status;
				$arrParams['variant_id'] = $variant_id;				
				if ($this->policy_variants_master_model->saveRecord($arrParams, $modelType))
					$this->session->set_flashdata('message', '<p class="status_msg">Record updated successfully.</p>');
				else 
					$this->session->set_flashdata('message', '<p class="error_msg">Record could not be updated.</p>');
			}
		}
		else
			$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
		redirect('admin/policy/index');
	}
}
/* End of file auth_lite.php */
/* Location: ./application/controllers/auth_lite.php */