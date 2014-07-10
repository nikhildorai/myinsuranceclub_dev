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
		else if($type== 'base_url')
			$value = base_url();
		return $value;
	}
	
	function getTableData($modelName = '', $type="all", $where = array(), $fields = array('id'), $sqlFilter = array())
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
				else if($v2['compare'] == 'empty')
				{
					$condition .= empty($condition) ? $v2['field'].' IS NULL ' : ' AND '.$v2['field'].' IS NULL ';
				}
				else if($v2['compare'] == 'notEmpty')
				{
					$condition .= empty($condition) ? $v2['field'].' IS NOT NULL ' : ' AND '.$v2['field'].' IS NOT NULL ';
				}
				else if($v2['compare'] == 'findInSet')
				{
					if (count(explode(',', $v2['value'])) > 1)			
						$condition .= empty($condition) ? ' FIND_IN_SET('.$v2['field'].', '.$v2['value'].')' : ' AND FIND_IN_SET('.$v2['field'].', '.$v2['value'].')';
					else
						$condition .= empty($condition) ? ' FIND_IN_SET('.$v2['value'].', '.$v2['field'].')' : ' AND FIND_IN_SET('.$v2['value'].', '.$v2['field'].')';
				}
			}	
		}
		
		$sql = 'SELECT * FROM '.$tableName;
		if (!empty($condition))
		{
			 $sql .= ' WHERE '.$condition;	
		}	
		if (!empty($sqlFilter))
		{
			$sort = (isset($sqlFilter['sortOrder'])) ? $sqlFilter['sortOrder'] : 'ASC';
			if (isset($sqlFilter['orderBy']))
				$sql .= ' ORDER BY '.$sqlFilter['orderBy'].' '.$sort;
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
	
	public function getCompanyTypeDropDownOptions($modelName ='Company_type_model', $optionKey = 'id', $optionValue = 'id', $defaultEmpty = "Please Select", $extraKeys = false, $where = array(), $sqlFilter = array())
	{
		$result = $this->getTableData($modelName, $type="all", $where, $fields = array(), $sqlFilter);	
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
    	if (isset($userIdentifier['flexi_auth']['user_details']) && !empty($userIdentifier['flexi_auth']['user_details']))
    	{
    		$userDetails = $userIdentifier['flexi_auth']['user_details'];
    		$userDetails['group'] = $userIdentifier['flexi_auth']['group'];	
    	}
    	return $userDetails;
    }
    
    public function getUserSearchFiltersHtml($customer_details = array(), $type = "health")
    {
    	$return = '';
    	 
    	if($type == "health")
    	{
    		if(empty($customer_details))
    		{
    			$return.='<div>There are no plans that match your selection criteria.</div>';
    		}
    
    		elseif (!empty($customer_details))
    		{
    			foreach($customer_details as $detail)
    			{
    				$return	.=	'<div class="cmp_tbl"><div style="min-height: 74px; height: auto; margin-top: 10px; background: #effdfe; border: 2px solid #dadada;" class="main_acc">
									<div class="col-md-5">
										<label for="1_1_refundable" style="margin-top: -5px; margin-bottom: 0px; padding: 25px 0px 20px 0px;">';
    
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
									</div>
									';
    
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
																<div><ul style="list-style-type: none;"><li></li></ul></div>
														</div>
    
    
													</div>';
    
    				$return	.=	'</div>
											</div>
										</div>
									</div>
								</div></div>';
    			}
    		}
    		//return $return;
    	}
    	elseif($type == "criticalillness")
    	{
    		if(empty($customer_details))
    		{
    			$return.='<div>There are no plans that match your selection criteria.</div>';
    		}
    		elseif(!empty($customer_details))
    		{
    			foreach($customer_details as $detail)
    			{
    				$return	.=	'<div class="cmp_tbl"><div style="min-height: 74px; height: auto; margin-top: 10px; background: #effdfe; border: 2px solid #dadada;" class="main_acc">
									<div class="col-md-5">
										<label for="1_1_refundable" style="margin-top: -5px; margin-bottom: 0px; padding: 25px 0px 20px 0px;">';
    
    				if($detail['preexisting_age']!='Not Covered')
    				{
    					$preexist_diseases='Waiting period of '.$detail['preexisting_age'].' years';
    				}
    				else
    				{
    					$preexist_diseases=$detail['preexisting_age'];
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
									</div>
									';
    
    				$return	.=	'<div class="accordion_a">
										<div class="col-md-12">
											<div class="col-md-8">
												<h4 class="h_d">Plan Details</h4>
												<div class="custom-table-1">
													<table width="100%">
														<tbody>
															<tr class="odd">
																<td>Pre-existing diseases</td>
																<td>'.$preexist_diseases.'</td>
															</tr>
															<tr><td><h4 class="h_d">Diseases Covered</h4></td></tr>';
    
    				//if($detail['gender_id'] != '2'){
    
    					if($detail['cancer'] != 'No'){
    						$return .=	'<tr class="odd">
											<td>Cancer</td>
											<td>'.$detail['cancer'].'</td>
									</tr>';
    					}
    					if($detail['myocardial_infraction'] != 'No'){
    						$return .=	'<tr>
											<td>Myocardial Infraction</td>
											<td>'.$detail['myocardial_infraction'].'</td>
									</tr>';
    					}
    					if($detail['kidney_faliure'] != 'No'){
    						$return .=	'<tr class="odd">
											<td>Kidney Faliure</td>
											<td>'.$detail['kidney_faliure'].'</td>
									</tr>';
    					}
    					if($detail['stroke'] != 'No'){
    						$return .=	'<tr >
											<td>Stroke</td>
											<td>'.$detail['stroke'].'</td>
									</tr>';
    					}
    					if($detail['obt'] != 'No'){
    						$return .=	'<tr class="odd">
											<td>Organ/Bone Marrow Transplant</td>
											<td>'.$detail['obt'].'</td>
									</tr>';
    					}
    					if($detail['cabg'] != 'No'){
    						$return .=	'<tr>
											<td>Coronary Artery Bypass Surgery</td>
											<td>'.$detail['cabg'].'</td>
									</tr>';
    					}
    					if($detail['ppah'] != 'No'){
    						$return .=	'<tr class="odd">
											<td>Primary Pulmonary Arterial Hypertension</td>
											<td>'.$detail['ppah'].'</td>
									</tr>';
    					}
    					if($detail['ms'] != 'No'){
    						$return .=	'<tr>
											<td>Multiple Sclerosis</td>
											<td>'.$detail['ms'].'</td>
									</tr>';
    					}
    					if($detail['coma'] != 'No'){
    						$return .=	'<tr class="odd">
											<td>Coma</td>
											<td>'.$detail['coma'].'</td>
									</tr>';
    					}
    					if($detail['ags'] != 'No'){
    						$return .=	'<tr>
											<td>Aorta Graft Surgery</td>
											<td>'.$detail['ags'].'</td>
									</tr>';
    					}
    					if($detail['ppl'] != 'No'){
    							
    						$return .='	<tr class="odd">
											<td>Permenant Paralysis Of Limbs</td>
											<td>'.$detail['ppl'].'</td>
									</tr>';
    					}
    					if($detail['cad'] != 'No'){
    					$return .='	 <tr>
											<td>Coronary Artery Disease</td>
											<td>'.$detail['cad'].'</td>
									</tr>';
    					}
    					if($detail['opr'] != 'No'){
    
    						$return .='	<tr class="odd">
											<td>Open Heart Replacement</td>
											<td>'.$detail['opr'].'</td>
									</tr>';
    					}
    					if($detail['aplastic_anemia'] != 'No'){
    						$return .='	<tr>
											<td>Aplastic Anemia</td>
											<td>'.$detail['aplastic_anemia'].'</td>
									</tr>';
    					}
    					if($detail['e_lu_d'] != 'No'){
    						$return .='	<tr class="odd">
											<td>End Stage Lung Disease</td>
											<td>'.$detail['e_lu_d'].'</td>
									</tr>';
    					}
    					if($detail['e_li_d'] != 'No'){
    						$return .='	<tr>
											<td>End Stage Liver Disease</td>
											<td>'.$detail['e_li_d'].'</td>
									</tr>';
    					}
    					if($detail['major_burns'] != 'No'){
    						$return .='	<tr class="odd">
											<td>Major Burns</td>
											<td>'.$detail['major_burns'].'</td>
									</tr>';
    					}
    					if($detail['mnd'] != 'No'){
    						$return .='	<tr>
											<td>Motor Neuron Disease</td>
											<td>'.$detail['mnd'].'</td>
									</tr>';
    					}
    					if($detail['ti'] != 'No'){
    						$return .='	<tr class="odd">
											<td>Terminal Illness</td>
											<td>'.$detail['ti'].'</td>
									</tr>';
    					}
    					if($detail['bm'] != 'No'){
    						$return .='	<tr>
											<td>Bacterial Meningitis</td>
											<td>'.$detail['bm'].'</td>
									</tr>';
    					}
    					if($detail['parkinsons'] != 'No'){
    							
    						$return .='	<tr class="odd">
											<td>Parkinsons</td>
											<td>'.$detail['parkinsons'].'</td>
									</tr>';
    					}
    					if($detail['blindness'] != 'No'){
    						$return .='	<tr>
											<td>Blindness</td>
											<td>'.$detail['blindness'].'</td>
									</tr>';
    					}
    
    					if($detail['speech_loss'] != 'No'){
    						$return .='	<tr class="odd">
											<td>Speech Loss</td>
											<td>'.$detail['speech_loss'].'</td>
									</tr>';
    					}
    					if($detail['deafness'] != 'No'){
    						$return .='	<tr>
										<td>Deafness</td>
										<td>'.$detail['deafness'].'</td>
									</tr>';
    					}
    					if($detail['md'] != 'No'){
    						$return .='	<tr class="odd">
											<td>Muscular Dystrophy</td>
											<td>'.$detail['md'].'</td>
									</tr>';
    					}
    					if($detail['paraplegia'] != 'No'){
    						$return .='	<tr>
											<td>Paraplegia</td>
											<td>'.$detail['paraplegia'].'</td>
									</tr>';
    					}
    					if($detail['hepatoma'] != 'No'){
    						$return .='	<tr class="odd">
											<td>Hepatoma</td>
											<td>'.$detail['hepatoma'].'</td>
									</tr>';
    					}
    					if($detail['hvs'] != 'No'){
    						$return .='	<tr>
											<td>Heart Valve Surgery</td>
											<td>'.$detail['hvs'].'</td>
									</tr>';
    					}
    					if($detail['quad'] != 'No'){
    						$return .='	<tr class="odd">
											<td>Quadriplegia</td>
											<td>'.$detail['quad'].'</td>
									</tr>';
    					}
    
    				//}
    				//elseif($detail['gender_id'] == '2')
    				//{
    					if($detail['ovarian_c'] != 'No'){
    						$return .= '<tr class="odd">
																<td>Ovarian Cancer</td>
																<td>'.$detail['ovarian_c'].'</td>
															</tr>';
    					}
    					if($detail['vaginal_c'] != 'No'){
    						$return .= '<tr>
																<td>Vaginal Cancer</td>
																<td>'.$detail['vaginal_c'].'</td>
															</tr>';
    					}
    					if($detail['breast_c'] != 'No'){
    						$return .= '<tr class="odd">
																<td>Breast Cancer</td>
																<td>'.$detail['breast_c'].'</td>
															</tr>';
    					}
    					if($detail['cervical'] != 'No'){
    						$return .= '<tr>
																<td>Cervical Cancer</td>
																<td>'.$detail['cervical'].'</td>
															</tr>';
    					}
    					if($detail['endometrial_c'] != 'No'){
    						$return .= '<tr class="odd">
																<td>Uterine/Endometrial Cancer</td>
																<td>'.$detail['endometrial_c'].'</td>
															</tr>';
    					}
    					if($detail['fallopian_tube_c'] != 'No'){
    						$return .= '<tr>
																<td>Fallopian Tube Cancer</td>
																<td>'.$detail['fallopian_tube_c'].'</td>
															</tr>';
    					}
    					if($detail['burns'] != 'No'){
    						$return .= '<tr class="odd">
																<td>Burns</td>
																<td>'.$detail['burns'].'</td>
															</tr>';
    					}
    					if($detail['paralysis_multitrauma'] != 'No'){
    						$return .= '<tr>
																<td>Paralysis/Multitrauma</td>
																<td>'.$detail['paralysis_multitrauma'].'</td>
															</tr>';
    					}
    					if($detail['cdb'] != 'No'){
    						$return .= '<tr class="odd">
																<td>Congenital Disability Benefit</td>
																<td>'.$detail['cdb'].'</td>
															</tr>';
    					}
    				//}
    				$return .=				'<tr>
															<td></td>
															<td>'."".'</td>
													</tr>
													</tbody>
													</table>
												</div>
											</div>';
    					
    				$return	.=	'<div class="col-md-4 no_pad_lr">
												<h4 class="h_d mar-40">Product Brouchure <img src="'.base_url().'assets/images/pdf.png" border="0"></h4>
    
												<div style="padding: 5px;">
							
													<div style="float: left; width: 100%;">
    
														<div style="float: right; width: 150px;">
								
														</div>
													</div>
    
    
													<div>
    
														<div class="col-md-12">
								
														</div>
    
														<div class=" col-md-12">
								
														</div>
    
    
													</div>';
    
    				$return	.=	'</div>
											</div>
										</div>
									</div>
								</div></div>';
    			}
    		}
    
    	}
    	elseif($type == "personalAccident")
    	{
    		if(empty($customer_details))
    		{
    			$return.='<div>There are no plans that match your selection criteria.</div>';
    		}
    		elseif(!empty($customer_details))
    		{
    			foreach($customer_details as $detail)
    			{
    				$preexist_diseases = '';
    				$variant='';
    				if($detail['variant_name']!='Base')
    					$variant=' '.$detail['variant_name'];
    				
    				$compare_data=$detail['variant_id'].'-'.$detail['annual_premium'];//.'-'.$detail['age'];
    				
					$return .= '
								<div class="cmp_tbl">
									<div class="cus_tb clearfix">
										<div class="col-md-2 pad-right-10 logo_ins">
											<div class="img_bx">
												<img src="'.base_url().'assets/images/client/bhartiaxa.jpg" border="0" class="img_bx_i">
												<div class="check_bx">
													<div class="checkbox">
														<label> 
															<input type="checkbox" name="compare[]" id="c_name" class="refundable" value="'.$compare_data.'"> 
															<label class="chk" for="Field4"></label> 
														</label>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-3 pad-left-10">
											<div class="c_t">
												<span class="title_c" style="width: 100%;">'.$detail['company_shortname'].'</span>
												<span class="sub_tit">'.$detail['policy_name'].$variant.'</span>
											</div>
										</div>
										<div class="col-md-7 m_anc">
											<div class="col-md-6 no_pad_l">
												<h3 class="anc">Rs. '.number_format($detail['annual_premium']).'</h3>
												<p class="sub_tit">for cover of Rs. '.number_format($detail['sum_assured']).'</p>
											</div>
											<div class="col-md-2" style="padding: 0px">
												<div class="down_cnt" style="width: 20px; height: auto; float: left; color: #999999;">
													<i class="fa fa-th"></i>
												</div>
												<div class="down_cnt_up" style="">
													<i class="fa fa-angle-up"></i>
												</div>
											</div>
			
											<div class="col-md-4 pad_r_10">
												<a class="btn_offer_block" href="#">Buy Now <i class="fa fa-angle-right"></i> </a>
												<div class="thumb">
													<i class="fa fa-thumbs-up"></i>
													<div class="text_t">12 people chose this plan</div>
												</div>
											</div>
										</div>
									</div>
			
									<div class="accordion_a">
										<div class="col-md-12">
											<div class="col-md-12 mar-10">
												<h4 class="h_d">Key Features</h4>
												<div class="custom-table-1">
													<table width="100%">
														<tbody>';
    												$featureList = Util::featureList($type);
    												$featureKeys = array_keys($featureList);
    												$i = 1;
    												foreach ($detail as $k1=>$v1)
    												{
    													if (in_array($k1, $featureKeys) && !empty($v1))
    													{
    														if ($i == 1)
								    							$return .=	'<tr class="odd">';
								    						else 
								    							$return .=	'<tr>';
								    							
																$return .=		'<td>'.$featureList[$k1].'</td>
																				<td class="cus_width">';
																
									    						if ($k1 == 'major_exclusions')
									    						{
									    							$v1 = unserialize($v1);
									    							if (!empty($v1))
									    							{
											    						$return .=	'<ul class="no">';
											    								foreach ($v1 as $k2=>$v2)
											    								{
																			$return .=	'<ll>'.$v2.'</li>';
											    								}
																		$return .=	'</ul>';
									    							}
									    						}
									    						else 
									    							$return .=			$v1;
									    							
																$return .=		'</td>
																			</tr>';
						    								$i++;
						    								if ($i == 3)
						    									$i = 1;
    													}
    												}
					$return .=							'
														</tbody>
													</table>
												</div>
											</div>
			
			
											<div class="col-md-7 medical" style="padding-right: 0px; margin-bottom: 0px;">
												<h4 class="h_d mar-40">List of Hospitals with Cashless Facility</h4>
												<div class="cus_d" style="padding: 5px;">
													<div style="float: left; width: 100%; margin-top: 10px;">
														<div style="float: right; width: 100%; padding-left: 15px;">
															<div class="form-group col-md-12" style="margin-bottom: 0px;">
																<label for="" class="sr-only">Search by Pin Code</label> 
																<input type="text" placeholder="Search by Pin Code or Hospital Name" name="pin" id="" data-id="hos_class" autocomplete="off" spellcheck="false" class="form-control brdr typeahead tt-query med_search">
																<div class="search_icon">
																	<i class="fa fa-search"></i>
																</div>
															</div>
														</div>
														<div class="loc_d hos" style="padding: 0px 15px; border: none; display: none; margin-top: 20px;">
															<div class="col-md-12">
																<span class="tt-dropdown-menu" style="position: absolute; top: 100%; left: 0px; z-index: 1; display: block; right: auto;">
																	<div class="tt-dataset-accounts">
																		<div class="city_m">
																			<div class="city_a">Hospital Name</div>
																			<div class="city_b">City</div>
																			<div class="city_c">Pin Code</div>
																		</div>
																		<span class="tt-suggestions resultTable" id=""
																			style="display: block;"> </span>
																	</div> 
																</span>
															</div>
															<div style="float: left; position: absolute; bottom: 0px; margin-bottom: 10px;" class="">Note: This list is subject to change without any notice</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-5">
												<h4 class="h_d mar-40" style="margin-left: 50px;">Documents</h4>
												<ul class="doc">
													<li>Policy Brouchure <a href="javascript:void(0)"><img src="'.base_url().'assets/images/pdf.jpg"> </a></li>
													<li>Policy Wordings <a href="javascript:void(0)"><img src="'.base_url().'assets/images/pdf.jpg" class="dimg"> </a></li>
												</ul>
											</div>
											<div class="col-md-12  hide_d">
												Hide details <i class="fa fa-angle-up"></i>
											</div>
										</div>
									</div>
								</div>';
    			}
    		}
    
    	}
    	elseif($type == "termplan")
    	{
    		if(empty($customer_details))
    		{
    			$return.='<div>There are no plans that match your selection criteria.</div>';
    		}
    		elseif(!empty($customer_details))
    		{
    			foreach ($customer_details as $detail)
    			{
    	
    				$calpremium = '';
    					
    				$CI =& get_instance();
    					
    				$sum_assured_session = $CI->session->userdata['user_input']['coverage_amount_literal'];
    					
    				$calpremium = round($sum_assured_session/1000);
    					
    				if(!($detail['rate_per_1000_SA']=='0' || $detail['rate_per_1000_SA']=='0.0' || $detail['rate_per_1000_SA']=='0.00'))
    				{
    					$annual_premium = $calpremium * $detail['rate_per_1000_SA'];
    				}
    				else
    				{
    					$annual_premium = $calpremium;
    				}
    					
    				$service_tax = round($annual_premium * 0.1236);
    					
    					
    				$return	.=	'<div class="cmp_tbl"><div style="min-height: 74px; height: auto; margin-top: 10px; background: #effdfe; border: 2px solid #dadada;" class="main_acc">
									<div class="col-md-5">
										<label for="1_1_refundable" style="margin-top: -5px; margin-bottom: 0px; padding: 25px 0px 20px 0px;">';
    					
    				$variant='';
    				if($detail['variant_name']!='Base')
    				{
    					$variant=' '.$detail['variant_name'];
    				}
    				else
    				{
    					$variant='';
    				}
    					
    				$compare_data=$detail['variant_id'].'-'.$annual_premium .'-'.$detail['age'];
    					
    				$return	.=	'<input type="checkbox" name="compare[]" class="term_check" value="'.$compare_data.'" />
										<span class="title_c">'.$detail['company_shortname'].'</span>
										<span class="sub_tit">('.$detail['policy_name'].$variant.')</span>
										</label>
									</div>';
    					
    					
    				$return	.=	'<div class="col-md-7">
										<div class="col-md-6 no_pad_l">
											<h3 class="anc">Rs. '.number_format($annual_premium).'</h3>
											<p class="anc_f">for cover of Rs. '.number_format($sum_assured_session).'</p>
										</div>
    	
										<div class="col-md-2">
											<div class="down_cnt">
												<img src="'.base_url().'assets/images/down_ar.jpg" border="0">
											</div>
										</div>
    	
										<div class="col-md-3">
											<button type="submit" class="btn btn-primary my buy_now" style="margin-top: 18px;">Buy Now &gt;</button>
										</div>
									</div>
									';
    					
    				$return	.=	'<div class="accordion_a">
										<div class="col-md-12">
											<div class="col-md-8">
												<h4 class="h_d">Plan Details</h4>
												<div class="custom-table-1">
													<table width="100%">
														<tbody>
															<tr class="odd">
																<td>Duration</td>
																<td>'.$detail['term'].' years</td>
															</tr>
															<tr>
																<td>Claims Ratio</td>
																<td>'.$detail['financial_year'].' : <span style="color:green;">'.$detail['claim_ratio'].'%</span></td>
															</tr>
    	
															<tr class="odd">
																<td>Service Tax</td>
																<td>Rs.'.$service_tax.'</td>
															</tr>
															<tr>
																<td></td>
																<td>'."".'</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>';
    	
    				$return	.=	'<div class="col-md-4 no_pad_lr">
												<h4 class="h_d mar-40">Product Brouchure <img src="'.base_url().'assets/images/pdf.png" border="0"></h4>
    	
												<div style="padding: 5px;">
							
													<div style="float: left; width: 100%;">
														<div style="float: left;">
								
														</div>
														<div style="float: right; width: 150px;">
															<div class="form-group col-md-12">
    	
															</div>
														</div>
													</div>
    	
    	
													<div>
    	
														<div class="col-md-12">
								
														</div>
    	
														<div class=" col-md-12">
			
														</div>
    	
    	
													</div>';
    					
    				$return	.=	'</div>
											</div>
										</div>
									</div>
								</div></div>';
    	
    			}
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
			$value = '<span class="btn-icon-round btn-icon-round-sm bg-danger"></span>';
		}
		else if ($status == 'deleted') {
			$value = '<span class="btn-icon-round btn-icon-round-sm bg-danger"></span>';
		}
		return $value;
	}
	
	public function getActiveUserLIst()
	{
		$db = &get_instance();	
		$sql = 	'SELECT us.uacc_id, dp.upro_first_name,dp.upro_last_name,us.uacc_username 
				FROM user_accounts us, demo_user_profiles dp 
				WHERE us.uacc_active = 1 AND
				us.uacc_id = dp.upro_uacc_fk 
				AND FIND_IN_SET(uacc_group_fk, "2,3")';
		return $db->db->query($sql);
	}
	
	public function getUserDropdownList($selected = null)
	{
		$records = $this->getActiveUserLIst();
		$value = '<option value="" data-company_type_id="">Please Select</option>';
		if ($records->num_rows > 0)
		{
			foreach ($records->result_array() as $k1=>$v1)
			{
				if ($selected == $v1['uacc_id'])
					$value .= '<option value="'.$v1['uacc_id'].'"  selected>'.$v1['upro_first_name'].' '.$v1['upro_last_name'].'</option>';
				else
					$value .= '<option value="'.$v1['uacc_id'].'">'.$v1['upro_first_name'].' '.$v1['upro_last_name'].'</option>';			
			}
		}
		return $value;
	}
	
	public function addUpdateTags($post = null)
	{
		$tagIds = null;
		if (!empty($post['name']))
		{
			$tags = explode(',', $post['name']);
			foreach ($tags as $k1=>$v1)
			{
				//	check if tag already exists
				$arrParams = array();
				$arrParams['name'] = $v1;
			
				$where = array();
				$where[0]['field'] = 'name';
				$where[0]['value'] = $v1;
				$where[0]['compare'] = 'equal';
				
				$record = $this->getTableData($modelName='Master_tags_model', $type="all", $where, $fields = array());
				if (!empty($record))
				{
					foreach ($record as $k2=>$v2)
					{
						$tagIds[] = $v2['tag_id'];
					}
				}
				else 
				{
					$arrParams['slug'] = $this->getSlug($v1);
					$arrParams['tag_for'] = $post['tag_for'];
					$recordId = Master_tags_model::saveRecord($arrParams, $modelType='create');					
					if ($recordId != false)
						$tagIds[] = $recordId;
				}		
			}
			$tagIds = implode(',', $tagIds);
		}
		return $tagIds;
	}
	
	public function getAllTags()
	{
		$value = array();
		$tags = $this->getTableData($modelName='Master_tags_model', $type="all", $where = array(), $fields = array());
		if (!empty($tags))
		{
			$i = 0;
			foreach ($tags as $k1=>$v1)
			{
				$value[$i]['name'] = $v1['name'];
				$value[$i]['tag_for'] = $v1['tag_for'];
				$i++;
			}
		}
		return $value;	
	}
	
	
	public static function getDate($value,$format=null)
	{
		$value = strtotime($value);
		
		if(empty($value) && $format !=3)
			return null;
		else 
		{
			switch ($format)
			{
				case 1 	:	$format 	= 'm/d/Y'; 				break;
				case 2 	:	$format 	= 'Y-m-d'; 				break;
				case 3 	:	$format 	= 'Y-m-d H:i:s'; 		break;
				case 4 	: 	$format 	= 'm/d/Y \a\t h:i A'; 	break;
				case 5 	: 	$format 	= 'm/d/Y h:i A'; 		break;
				case 6	: 	$format 	= 'l, M-d-Y, h:i:s A';	break;
				case 7	: 	$format 	= '\G\M\T P';			break;
				case 8 : 	$format 	= 'd/m/Y';				break;
				default : 	$format 	= 'd-m-Y';				break;
			}
			$return = date($format, $value);
			return $return;
		}
	}
	
	public static function getDescription($desc)
	{
		$value = '';
		if (!empty($desc))
		{
			$value = substr(strip_tags($desc), 0, 100);
		}	
		return $value;
	}
	
	public static function getUniqueTagFor()
	{
		$db = &get_instance();
		$sql = 'SELECT DISTINCT tag_for FROM master_tags';
		$result = $db->db->query($sql);
		$value = array();
		if ($result->num_rows > 0)
		{
			foreach ($result->result_array() as $k1=>$v1)
			{		
				$value[$v1['tag_for']] = ucfirst($v1['tag_for']);
			}
		}
		$value['others'] = 'Others';
		return $value;		
	}
	
	public static function getParentChildRelationComment($commentModel)
	{
		//	identify parent child comments
		foreach ($commentModel as $k2=>$v2)
		{
			if (empty($v2['parent_comment_id']))
			{
				if (!in_array($v2['comment_id'], $commentModel))
				{
					$commentModel[$v2['comment_id']]['parent'] = $v2;
				}
				$parentComments[$v2['comment_id']] = $v2['comment_id'];
			}
			else if (!empty($v2['parent_comment_id']))
			{
				if (in_array($v2['parent_comment_id'], $parentComments))
				{
					$commentModel[$v2['parent_comment_id']]['child'][$v2['comment_id']] = $v2;
				}
				else 
				{
					Util::getParentChildRelationComment($v2);
				}
			}
		}
			/*
		if (is_array($comments)) {
			foreach($comments as $k1 => $v1) {
				$comments[$k1] = Util::getParentChildRelationComment($v1);
			}
		} else {
echo '----------------->';			
var_dump($comments);			
			// Now you do anything you want...
			$comments = stripslashes($comments);
echo '=================>';
		}
		*/
		return $comments;
	}
	
	public static function featureList($featureType = '')
	{
		$value = array();
		if ($featureType == 'personalAccident')
		{
			$value = array(
				'minimum_coverage_amount'=>'Minimum Coverage amount',
				'maximum_coverage_amount'=>'Maximum Coverage amount',
				'coverage_years'=>'Coverage Years',
				'maximum_renewal_age'=>'Maximum Renewal Age',
				'minimum_entry_age'=>'Minimum Entry Age',
				'maximum_entry_age'=>'Maximum Entry Age',
				'annual_income_eligibility'=>'Annual Income Eligibility',
				'no_medical_test_age'=>'No Medical Test Age',
				'no_medical_sum_assured_limit'=>'No Medical Sum Assured Limit',
				'pre_existing_diseases'=>'Pre Existing Diseases',
				'co_payment'=>'Co Payment',
				'buying_mode'=>'Buying Mode',
				'online'=>'Online',
				'offline'=>'Offline',
				'list_of_hospitals'=>'List of Hospitals',
				'tax_benefits'=>'Tax Benefits',
				'waiting_period'=>'Waiting Period',
				'free_look_period'=>'Free Look Period',
				'grace_period'=>'Grace Period',
				'world_wide_coverage'=>'World Wide Coverage',
				'cumulative_bonus'=>'Cumulative Bonus',
				'accidental_death'=>'Accidental Death',
				'permanent_total_disablement'=>'Permanent Total Disablement',
				'permanent_partial_disablement'=>'Permanent Partial Disablement',
				'hospital_daily_cash'=>'Hospital Daily Cash',
				'double_indemnity'=>'Double Indemnity',
				'accident_medical_expenses'=>'Accident Medical Expenses',
				'accidental_hospitalisation_expenses_reimbursement'=>'Accidental Hospitalisation Expenses Reimbursement',
				'accidental_out_patient_expenses_reimbursement'=>'Accidental Out Patient Expenses Reimbursement',
				'weekly_indemnity'=>'Weekly Indemnity',
				'broken_bone'=>'Broken Bone',
				'modification_of_residence_vehicle'=>'Modification of Residence Vehicle',
				'cost_of_transporting_mortal_remains'=>'Cost of Transporting Mortal Remains',
				'cost_of_performane_of_death_ceremonies'=>'Cost of Performane of Death Ceremonies',
				'ambulance_hiring_charges'=>'Ambulance Hiring Charges',
				'family_transportation_benefit'=>'Family Transportation Benefit',
				'burns'=>'Burns',
				'major_exclusions'=>'Major Exclusions',
				'accident_death_spouse'=>'Accident Death Spouse',
				'permanent_total_disablity_spouse'=>'Permanent Total Disablity Spouse',
				'permanent_partial_disablity_spouse'=>'Permanent Partial Disablity Spouse',
				'accident_death_per_child'=>'Accident Death Per Child',
				'permanent_total_disablity_per_child'=>'Permanent Total Disablity Per Child',
				'permanent_partial_disablity_per_child'=>'Permanent Partial Disablity Per Child',
				'tution_fees_per_child'=>'Tution Fees Per Child',
			);
		}
		return $value;
	}
}

// END Util class

/* End of file Util.php */
/* Location: ./application/libraries/Util.php */