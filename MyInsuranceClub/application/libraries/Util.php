<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Util {

	function get_css_folder()
	{
		$CI =& get_instance();
		return $CI->config->config['css_path'];
	}
	
	function get_js_folder()
	{
		$CI =& get_instance();
		return $CI->config->config['js_path'];
	}
	
	function get_pagination_params()
	{
		$CI =& get_instance();
		$config =  $CI->config->config['pagination'];
		
		$pageUrl = $this->getUrl().'?';
		if (isset($_SERVER['QUERY_STRING']) &&!empty($_SERVER['QUERY_STRING']))
		{
			$qString = explode('&', $_SERVER['QUERY_STRING']);			
			foreach ($qString as $k1=>$v1)
			{
				if (reset(explode('=', $v1)) != 'per_page' && !empty($v1))
					$pageUrl .= '&'.$v1;
			}
		}
		$config['base_url'] 	= $pageUrl;
		return $config;
	}
	
	function getUrl($type = 'currentUrl')
	{
		$value = base_url();
		$router =& load_class('Router', 'core');
		$uri = & load_class('URI','core');
		$url = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];
		
		if ($type == 'currentUrl' )
			$value = reset(explode('?', $url));
		else if ($type == 'currentPageUrl')
			$value = $url;
		else if ($type == 'serverName')
			$value = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'].'/';
		else if ($type == 'module')
			$value = $uri->segment(1);
		else if($type == 'controller')
			$value = $uri->segment(2);
		else if ($type == 'action')
			$value = $uri->segment(3);
		return $value;
	}
	
	function getTableData($modelName = '', $type="all", $where = array(), $fields = array('id'))
	{
		$result = $value = array();
		$model = &get_instance();
		$model->load->model($modelName);
		$condition = '';
		$tableName = $model->$modelName->getTableName();
		if (!empty($where))
		{
			foreach ($where as $k2=>$v2)
			{
				if (is_string($v2['value']))
					$v2['value'] = '"'.$v2['value'].'"';
				if ($v2['compare'] == 'equal')
				{
					$condition .= empty($condition) ? $v2['field'].' = '.$v2['value'] : ' AND '.$v2['field'].' = '.$v2['value'];
				}
			}	
		}
		
		$sql = 'SELECT * FROM '.$tableName;
		if (!empty($condition))
		{
			 $sql .= ' WHERE '.$condition;	
		}	
		$result = $model->$modelName->excuteQuery($sql);

		if (!empty($result))
		{
			if ($result->num_rows > 0)
			{
				$i = 0;
				foreach ($result->result_array() as $k1=>$v1)
				{			
					if (!empty($v1))
					{	
						if ($type == 'all')
						{
							$value[$i] = $v1;
						}
						else if (in_array($type, array('single')) && !empty($fields) )
						{			
							$value[$i] = array_intersect_key($v1, array_flip($fields));
						}
						else if (in_array($type, array('single')) && empty($fields) )
						{			
							$value = $v1;
						}
					}
					$i++;
				}
			}
		}
		return $value;
	}
	
	public function getCompanyTypeDropDownOptions($modelName ='Company_type_model', $optionKey = 'id', $optionValue = 'id', $defaultEmpty = "Please Select", $extraKeys = false)
	{
		$result = $this->getTableData($modelName, $type="all", $where = array(), $fields = array());		
		$options[''] = $defaultEmpty;
		$optionsExtra = array();
		foreach ($result as $k1=>$v1)
		{
			$options[$v1[$optionKey]] = $v1[$optionValue];
			$optionsExtra[$v1[$optionKey]] = $v1;			
		}
		if ($extraKeys == false)
			return $options;
		else 
			return $optionsExtra;
	}
	

	public function getSlug($title) {
	   	$title = strip_tags($title);
	   	
	    $search_arr 	= array('%', ',', '?', '.', '!',
	    						'"', '\'', '/', '\\', '#',
	    						'©', 'Ã', '¨', 'â', 'ƒ', 'â'
	    						,'+','^','$','%','&','(',')','=',
	    						' ', ';','//', '`', '*', '');
	    $replace_arr 	= '-';
	    $title = str_replace($search_arr, $replace_arr, $title);
	    $title = preg_replace('/\s+/', '-', $title);
	    $title = preg_replace('/&.+?;/', '', $title); // kill entities
	    
	    $title = preg_replace('|-+|', '-', $title);
	    $title = trim($title, '-');
	    $title = strtolower($title);
	    return $title;
    }
    
    public function getLoggedInUserDetails()
    {
    	$userDetails = array();
		$model = &get_instance();
    	$userIdentifier =  $model->session->all_userdata(); //$this->CI->auth->session_name['user_identifier'];
    	if (isset($userIdentifier['flexi_auth']['user_identifier']) && !empty($userIdentifier['flexi_auth']['user_identifier']))
    	{
    		$userDetails = $userIdentifier['flexi_auth'];
    		$userId = $userIdentifier['flexi_auth']['user_id'];
			$where = array();
			$where[0]['field'] = 'upro_uacc_fk';
			$where[0]['value'] = (int)$userId;
			$where[0]['compare'] = 'equal';
			$exist = $this->getTableData($modelName='Demo_user_profiles_model', $type="single", $where, $fields = array());
			if (!empty($exist))
			{
				$userDetails['firstName'] = $exist['upro_first_name'];
				$userDetails['lastName'] = $exist['upro_last_name'];
				$userDetails['name'] = $exist['upro_first_name'].' '.$exist['upro_last_name'];
				$userDetails['phone'] = $exist['upro_phone'];
			}		
    	}
    	return $userDetails;
    }
    
    public function getUserSearchFiltersHtml($customer_details = array(), $type="health")
    {
    	$return = '';
		if(empty($customer_details))
		{
			$return.='<div>There are no plans that match your selection criteria.</div>';
		}
		
		elseif (!empty($customer_details)) 
		{
        	foreach($customer_details as $detail)
        	{
        		$preexist_diseases='';
				$return	.=	'<div style="min-height: 74px; height: auto; margin-top: 10px; background: #effdfe; border: 2px solid #dadada;" class="main_acc">
								<div class="col-md-5">
									<label for="1_1_refundable" style="margin-top: -5px; margin-bottom: 0px; padding: 25px 0px 20px 0px;">';
                 					/* if($detail['room_rent']!='Fully Covered')
                 					{
										$room_rent='Rs.'.round(0.01*$detail['sum_assured']).'/day';	
                 					}else 
                 					{
                 						$room_rent=$detail['room_rent'];
                 					}
                 					if($detail['icu_rent']!='Fully Covered')
                 					{
										$icu_rent='Rs.'.round(0.02*$detail['sum_assured']).'/day';
                 					}
                 					else
                 					{
                 						$icu_rent=$detail['icu_rent'];
                 					}
                 					if($detail['doctor_fee']!='Fully Covered')
                 					{
                 						$doctor_fee='As per actuals';
                 					}
                 					else 
                 					{
                 						$doctor_fee=$detail['doctor_fee'];
                 					} */
                 					if($detail['preexisting_diseases']!='Not Covered')
                 					{
                 						$preexist_diseases='Waiting period of '.$detail['preexisting_diseases'].' years';
                 					}
                 					else
                 					{
                 						$preexist_diseases=$detail['preexisting_diseases'];
                 					}
									$variant='';
									if($detail['variant_name']!='Base')
									{
										$variant=' '.$detail['variant_name'];
									}
									else{
										$variant='';
									}
									$compare_data=$detail['variant_id'].'-'.$detail['annual_premium'].'-'.$detail['age'];
						$return	.=	'<input type="checkbox" name="compare[]" class="refundable" value="'.$compare_data.'" /> 
									<span class="title_c">'.$detail['company_shortname'].'</span>
									<span class="sub_tit">('.$detail['policy_name'].$variant.')</span>
									</label>
								</div>';


					$return	.=	'<div class="col-md-7">
									<div class="col-md-6 no_pad_l">
										<h3 class="anc">Rs. '.number_format($detail['annual_premium']).'</h3>
										<p class="anc_f">for cover of Rs. '.number_format($detail['sum_assured']).'</p>
									</div>

									<div class="col-md-2">
										<div class="down_cnt">
											<img src="'.base_url().'assets/images/down_ar.jpg" border="0">
										</div>
									</div>

									<div class="col-md-3">
										<button type="submit" class="btn btn-primary my" style="margin-top: 18px;">Buy Now &gt;</button>
									</div>
								</div>';

					$return	.=	'<div class="accordion_a">
									<div class="col-md-12">
										<div class="col-md-8">
											<h4 class="h_d">Plan Details</h4>
											<div class="custom-table-1">
												<table width="100%">
													<tbody>
														<tr class="odd">
															<td>Cashless treatment</td>
															<td>'.$detail['cashless_treatment'].'</td>
														</tr>
														<tr>
															<td>Pre-existing diseases</td>
															<td>'.$preexist_diseases.'</td>
														</tr>

														<tr class="odd">
															<td>Auto recharge of Sum Insured</td>
															<td>'.$detail['autorecharge_SI'].'</td>
														</tr>
														<tr>
															<td>Hospitalisation expenses
																<ul>
																	<li>Room Rent</li>
																	<li>ICU Rent</li>
																	<li>Fees of Surgeon, Anesthetist, Medicines, Nurses, etc</li>
																</ul>
															</td>
															<td>
																<ul class="no">
																	<li>'.$detail['room_rent'].'</li>
																	<li>'.$detail['icu_rent'].'</li>
																	<li>'.$detail['doctor_fee'].'</li>
																</ul>
															</td>
														</tr>
														<tr class="odd">
															<td>Pre-hospitalisation</td>
															<td>'.$detail['pre_hosp'].'</td>
														</tr>
														<tr>
															<td>Post-hospitalisation</td>
															<td>'.$detail['post_hosp'].'</td>
														</tr>

														<tr class="odd">
															<td>Day care expenses</td>
															<td>'.$detail['day_care'].'</td>
														</tr>

														<tr>
															<td>Maternity Benefits</td>
															<td>'.$detail['maternity'].'</td>
														</tr>
														<tr class="odd">
															<td>Auto Recharge of Sum Insured</td>
															<td>Yes â€“ only if hospitalisation due to Accident</td>
														</tr>
														<tr>
															<td>Health Check up</td>
															<td>'.$detail['check_up'].'</td>
														</tr>

														<tr class="odd">
															<td>Ayurvedic Treatment</td>
															<td>'.$detail['ayurvedic'].'</td>
														</tr>
														<tr>
															<td>Co-payment</td>
															<td>'.$detail['co_pay'].'</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>';
					
							$return	.=	'<div class="col-md-4 no_pad_lr">
											<h4 class="h_d mar-40">Product Brouchure <img src="'.base_url().'assets/images/pdf.png" border="0"></h4>

											<div class="cus_d" style="padding: 5px;">
												<h4 class="h_d3">List of Cashless Hospitalization facility</h4>
												<div style="float: left; width: 100%;">
													<div style="float: left;">
														<h4 class="h_d" style="margin-top: 7px">Enter Pincode</h4>
													</div>
													<div style="float: right; width: 150px;">
														<div class="form-group col-md-12">
															<label class="sr-only" for="">Enter Pincode</label> <input
																type="text" class="form-control brdr" id="pin"
																name="pin" placeholder="Enter Pincode">
														</div>
													</div>
												</div>


												<div class="loc_d">

													<div class="col-md-12">
														<label for="1_1_refundable22"> <input type="radio"
															name="loc_current1" value="Mumbai" class="loc_fnt">
															Mumbai
														</label> <label for="1_1_refundable2"> <input type="radio"
															name="loc_current1" value="Anywhere in India"
															class="loc_fnt"> Anywhere in India
														</label>
													</div>

													<div class=" col-md-12">
														<label class="sr-only" for="">Enter Pincode</label> <input
															type="text" class="form-control brdr" id="pin"
															name="pin1" placeholder="Search by name of hospital">
													</div>


												</div>';

								$return	.=	'</div>
										</div>
									</div>
								</div>
							</div>';
        	}
		}
		return $return;
    }
    

	public function addUpdateClaimRatio($model, $company_id)
	{	
		$save  = false;
		if (!empty($model))
		{	
			//	check if record exists
			$where = array();
			$arrSkip = array('claim_ratio_id');
			if (isset($model['claim_ratio_id']) && !empty($model['claim_ratio_id']))
			{
				$where[0]['field'] = 'claim_ratio_id';
				$where[0]['value'] = $model['claim_ratio_id'];
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
			
			$isExist = $this->getTableData($modelName='company_claim_ratio_model', $type="all", $where, $fields = array());
			$model1 = &get_instance();	
			$model1->load->model('company_claim_ratio_model');		
			if (!empty($isExist))
			{
				foreach ($isExist as $k1=>$v1)
				{
					$model['claim_ratio_id'] = (int)$v1['claim_ratio_id'];
					$save = $model1->company_claim_ratio_model->saveRecord($arrParams = $model, $modelType = 'update');
					break;	
				}
			}
			else 
			{
				$save = $model1->company_claim_ratio_model->saveRecord($arrParams = $model, $modelType = 'create');
			}
			
		}
		return $save;
	}
	
	public function getStatusIcon($status)
	{
		$status = strtolower($status);
		$value = '<span class="btn-icon-round btn-icon-round-sm bg-info"></span>';
		if ($status == 'active') {
			$value = '<span class="btn-icon-round btn-icon-round-sm bg-success"></span>';
		}
		else if ($status == 'inactive') {
			$value = '<span class="btn-icon-round btn-icon-round-sm bg-warning"></span>';
		}
		else if ($status == 'deleted') {
			$value = '<span class="btn-icon-round btn-icon-round-sm bg-danger"></span>';
		}
		return $value;
	}
}

// END Util class

/* End of file Util.php */
/* Location: ./application/libraries/Util.php */