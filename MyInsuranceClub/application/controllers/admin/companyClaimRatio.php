<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CompanyClaimRatio extends Admin_Controller {
 
    function __construct() 
    {
        parent::__construct();
		$this->load->model('company_claim_ratio_model');
	}

    public function index($company_id)
	{
		//	check if policy id exists
		if ((isset($_GET['company_id']) && !empty($_GET['company_id'])) || !empty($company_id))
		{
			if (isset($_GET['policy_id']))
				$policy_id = $_GET['policy_id'];
			$where = array();
			$where[0]['field'] = 'company_id';
			$where[0]['value'] = (int)$company_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='company_claim_ratio_model', $type="all", $where, $fields = array());
			if (empty($exist))
			{
				$modelType = 'create';
				$ratioModel = array();
			}
			else 
			{
				foreach ($exist as $k4=>$v4)
				{
					$ratioModel[$v4['year_to']] = $v4;
				}
				$modelType = 'update';				
			}
			$this->data['message'] = '';
			if (!empty($_POST))
			{				
				$claimRatioPost = $_POST;			
				$saveClaim = $savedRecords = $errorClaim = array();
				if (!empty($claimRatioPost))
				{
					$variantErrors = array();
					$arrSkip = array('claim_ratio_id');
					foreach ($claimRatioPost as $k1=>$v1)
					{
						if (!empty($v1['claim_ratio']) && $v1['claim_ratio'] <= 100)
						{	
							foreach ($v1 as $k2=>$v2)
							{
								$saveClaim[$k1][$k2] = $v2;
							}
							$saveClaim[$k1]['year_from'] = $k1-1;
							$saveClaim[$k1]['year_to'] = $k1;
							$saveClaim[$k1]['company_id'] = $company_id;
						}
						else if (!empty($v1['claim_ratio']))
						{
							$errorClaim[] = false;
						}
					}
				}						
				if (!empty($saveClaim))
				{
					foreach ($saveClaim as $k3=>$v3)
					{
						$savedRecords[] = $this->addUpdateClaimRatio($model = $v3, $company_id);
					}
				}
				
				if (!empty($savedRecords) && !empty($errorClaim))
				{
					$this->data['message'] = '<p class="status_msg">Records added successfully.</p>';
					$this->data['message'] .= '<p class="error_msg">Records with claim ratio cannot be greater than 100 could not be saved.</p>';
				}
				else if (!empty($savedRecords) && empty($errorClaim))
				{
					$this->data['message'] = '<p class="status_msg">Records added successfully.</p>';
				}
				
				else if (!empty($errorClaim))
				{
					//	show error if validation fails
					$this->data['message'] = '<p class="error_msg">Claim ratio cannot be greater than 100.</p>';
				}
		  		else
		  		{
					//	show error if no record saved
					$this->data['message'] = '<p class="error_msg">Minimum 1 record is required.</p>';
		  		}
		  		$ratioModel = $saveClaim;
			}		
			
			$this->data['modelType'] = $modelType;
			$this->data['ratioModel'] = $ratioModel;
			$this->data['company_id'] = $company_id;
			$this->template->write_view('content', 'admin/companyClaimRatio/index', $this->data, TRUE);
			$this->template->render();
		}
		else 
		{
			$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
			redirect('admin/company/index');
		}
	}

	
	
	

	function changeStatus($company_id = null, $status = 'inactive')
	{
		if (!empty($company_id))
		{
			//	check if company id exists
			$where[0]['field'] = 'company_id';
			$where[0]['value'] = (int)$company_id;
			$where[0]['compare'] = 'equal';
			$exist = $this->util->getTableData($modelName='Insurance_company_master_model', $type="single", $where, $fields = array());
	
			if (empty($exist))
			{
				$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
			}
			else 
			{
				$companyModel = $exist;	
				$modelType = 'update';
				$arrParams['status'] = $status;
				$arrParams['company_id'] = $company_id;
				if ($this->insurance_company_master_model->saveCompanyRecord($arrParams, $modelType))
					$this->session->set_flashdata('message', '<p class="status_msg">Record updated successfully.</p>');
				else 
					$this->session->set_flashdata('message', '<p class="error_msg">Record could not be updated.</p>');
			}
		}
		else
			$this->session->set_flashdata('message', '<p class="error_msg">Invalid record.</p>');
			
		redirect('admin/company/index');
	}
}

/* End of file auth_lite.php */
/* Location: ./application/controllers/auth_lite.php */