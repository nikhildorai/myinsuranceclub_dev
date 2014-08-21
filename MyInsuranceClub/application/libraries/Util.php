<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Util {
	
	/**
	 * @abstract Validating user input for all forms
	 */
	public static function getUserInputValidation($product = '')
	{
		$CI = &get_instance();
	
		if(isset($_POST['cust_name']))
		{
			$CI->form_validation->set_rules('cust_name', 'Full Name', 'required|alpha|xss_clean');
		}
		if(isset($_POST['cust_email']))
		{
			$CI->form_validation->set_rules('cust_email', 'Email', 'required|valid_email|xss_clean');
		}
		if(isset($_POST['desktop_cust_dob']))
		{
			$CI->form_validation->set_rules('desktop_cust_dob', 'Date of Birth', 'required|age_greater_than_18|xss_clean');
		}
		if(isset($_POST['cust_mobile']))
		{
			$CI->form_validation->set_rules('cust_mobile', 'Phone Number', 'required|phone_789|exact_length[10]|xss_clean');
		}
		if(isset($_POST['agree']))
		{
			$CI->form_validation->set_rules('agree', 'Terms of Use', 'required');
		}
	
		if($product == 'term')
		{
			$CI->form_validation->set_rules('smoker', 'Smoker/Non-Smoker', 'required');
		}
	
		$CI->form_validation->set_error_delimiters('<div class="error" style="color: red;">', '</div>');
	
		return $CI->form_validation->run();
	
	}
	
	
	
	/**
	 *
	 * @param unknown $custName
	 * @return array
	 */
	public static function explodeFullName($custName = '')
	{
		$custName_arr = array();
	
		if(!empty($custName))
		{
			$explodedCustName = explode(' ',$custName);
				
			if(sizeof($explodedCustName) == 1)
			{
				$custName_arr['first_name'] = $explodedCustName[0];
				$custName_arr['middle_name'] = "";
				$custName_arr['last_name'] = "";
			}
				
			elseif(sizeof($explodedCustName)==2)
			{
				$custName_arr['first_name']=$explodedCustName[0];
					
				$custName_arr['middle_name']="";
					
				$custName_arr['last_name']=$explodedCustName[1];
			}
			elseif(sizeof($explodedCustName)==3)
			{
				$custName_arr['first_name']=$explodedCustName[0];
					
				$custName_arr['middle_name']=$explodedCustName[1];
					
				$custName_arr['last_name']=$explodedCustName[2];
			}
		}
	
		return $custName_arr;
	}
	
	
	
	
	/**
	 *
	 * @param unknown $num
	 * @return Ambigous <string, unknown>
	 */
	public static function moneyFormatIndia($num){
		$explrestunits = "" ;
		if(strlen($num)>3){
			$lastthree = substr($num, strlen($num)-3, strlen($num));
			$restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
			$restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
			$expunit = str_split($restunits, 2);
			for($i=0; $i<sizeof($expunit); $i++){
				// creates each of the 2's group and adds a comma to the end
				if($i==0)
				{
					$explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
				}else{
					$explrestunits .= $expunit[$i].",";
				}
			}
			$thecash = $explrestunits.$lastthree;
		} else {
			$thecash = $num;
		}
		return $thecash; // writes the final format where $currency is the currency symbol.
	}
	
	
	
	
	/**
	 *
	 * @param string $birthDate
	 * @return number|NULL
	 */
	public static function convertBirthdateToAge($birthDate = '')
	{
		$returnAge = '';
	
		if(!empty($birthDate))
		{
			$birthDateArray = explode('/',$birthDate);
				
			$returnAge = (date("md", date("U", mktime(0, 0, 0, $birthDateArray[0], $birthDateArray[1], $birthDateArray[2]))) > date("md")
					? ((date("Y") - $birthDateArray[2]) - 1)
					: (date("Y") - $birthDateArray[2]));
	
			return $returnAge;
		}
		else
		{
			return null;
		}
	}
	

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
				if ( !empty($v1) && reset(explode('=', $v1)) != 'per_page')
					$pageUrl .= '&'.$v1;
				if ( !empty($v1) && reset(explode('=', $v1)) == 'per_page')
				{
					$a = explode('=', $v1);
					if (isset($a[1]) && !empty($a[1])) 
					{
						$config['currentPage'] = ((int)substr($_GET['per_page'], 0, -1) + 1);
					}
					
				}
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
	
	function getTableData($modelName, $type="all", $where = array(), $fields = array('id'), $sqlFilter = array())
	{
		$result = $value = array();
		$model = &get_instance();
		$db = &get_instance();
		$model->load->model($modelName);
		$condition = '';
		$tableName = $model->$modelName->getTableName();
		if (!empty($where))
		{
			$condition = Util::formatWhereStatement($where);	
		}
		$dbPrefix = Util::getDbPrefix();
		$pos = strpos($tableName, $dbPrefix);
		if ($pos === false)
			$tableName = $dbPrefix.$tableName; 
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
		
		$db->db->freeDBResource($db->db->conn_id);
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

	public static function formatWhereStatement($where = array())
	{
		$condition = '';
		if (!empty($where))
		{
			foreach ($where as $k2=>$v2)
			{
				if (is_string($v2['value']) && !in_array($v2['compare'], array('like', 'rightLike', 'leftLike')))
					$v2['value'] = '"'.$v2['value'].'"';
					
				if ($v2['compare'] == 'equal')
				{
					$condition .= empty($condition) ? $v2['field'].' = '.$v2['value'] : ' AND '.$v2['field'].' = '.$v2['value'];
				}
				else if ($v2['compare'] == 'notEqual')
				{
					$condition .= empty($condition) ? $v2['field'].' != '.$v2['value'] : ' AND '.$v2['field'].' != '.$v2['value'];
				}
				else if ($v2['compare'] == 'like')
				{
					$condition .= empty($condition) ? $v2['field'].' LIKE "%'.$v2['value'].'%"' : ' AND LIKE "%'.$v2['value'].'%"';
				}
				else if ($v2['compare'] == 'rightLike')
				{
					$condition .= empty($condition) ? $v2['field'].' LIKE "'.$v2['value'].'%"' : ' AND LIKE "'.$v2['value'].'%"';
				}
				else if ($v2['compare'] == 'leftLike')
				{
					$condition .= empty($condition) ? $v2['field'].' LIKE "%'.$v2['value'].'"' : ' AND LIKE "%'.$v2['value'].'"';
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
		return $condition;
	}
	
	
	public static function getdbPrefix()
	{
		$db = &get_instance();
		return $db->db->dbprefix;
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
	   	
	    $search_arr 	= array('%', ',', ':','?', '.', '!',
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
    
    /**
     *
     * @param string $sub_product
     * @return Ambigous <multitype:, multitype:string >
     */
    
    public static function getFamilyComposition($sub_product='')
    {
    	$family_composition = array();
    	if($sub_product == 'mediclaim' || $sub_product == 'critical-illness')
    	{
    		$family_composition = 	array(	'1A'=>'Myself',
    				'2A'=>'Self + Spouse',
    				'2A1C'=>'Self + Spouse + 1 Child',
    				'2A2C'=>'Self + Spouse + 2 Children',
    				'2A3C'=>'Self + Spouse + 3 Children',
    				'2A4C'=>'Self + Spouse + 4 Children',
    				'1A1C'=>'Self + 1 Child',
    				'1A2C'=>'Self + 2 Children',
    				'1A3C'=>'Self + 3 Children',
    				'1A4C'=>'Self + 4 Children'
    		);
    	}
    	 
    	elseif($sub_product == 'personal accident')
    	{
    		$family_composition = 	array(	'1A'=>'Myself',
    				'2A'=>'Self + Spouse',
    				'2A1C'=>'Self + Spouse + 1 Child',
    				'2A2C'=>'Self + Spouse + 2 Children',
    				'2A3C'=>'Self + Spouse + 3 Children',
    				'2A4C'=>'Self + Spouse + 4 Children'
    		);
    	}
    	return $family_composition;
    }
    
    
    /**
     * @abstract returns Min & Max Premium From Result Array
     */
    public static function getMinAndMaxPremium($premium_array = array())
    {
    	$min_max_premium = array();
    	 
    	if(count($premium_array) > 0)
    	{
    		$anuual_premium = array_map(function($detail)
    		{
    			return $detail['annual_premium'];
    		}, $premium_array);
    		$min_max_premium['min_premium'] = min($anuual_premium);
    		$min_max_premium['max_premium'] = max($anuual_premium);
    	}
    	elseif(count($premium_array) == 0)
    	{
    		$min_max_premium['min_premium'] = '0';
    		$min_max_premium['max_premium'] = '0';
    	}
    
    	return $min_max_premium;
    }
    
    
    
    public function getUserSearchFiltersHtml($customer_details = array(), $type = "health")
    {
    	$return = '';
		$con = &get_instance();
		$folderUrl = $con->config->config['folder_path']['company'];
		$fileUrl = $con->config->config['url_path']['company'];
		$pfolderUrl = $con->config->config['folder_path']['policy'];
		$pfileUrl = $con->config->config['url_path']['policy'];
		
    	if($type == "health")
    	{
    		/* if(empty($customer_details))
    		{
    			$return.='<div>There are no plans that match your selection criteria.</div>';
    		}
    
    		elseif (!empty($customer_details))
    		{
    			foreach($customer_details as $detail)
    			{
    				
    				$preexist_diseases='';
    				 
    				if(trim($detail['preexisting_diseases'])!='Not Covered')
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
    					
    				if(trim($detail['sum_assured']) != $con->session->userdata['user_input']['coverage_amount_literal'])
    				{
    					$sum_assured = "<span style='color: #ff6633;'>&#8377;".number_format($detail['sum_assured'])."</span>";
    				}
    				else
    				{
    					$sum_assured = "<span>&#8377;".number_format($detail['sum_assured'])."</span>";
    				}
    				
    				
    				$return .= '<div class="cmp_tbl">
        			                	<div class="cus_tb clearfix" >
        			                		<div class="col-md-2 pad-right-10 logo_ins">
        			               				<div class="img_bx" >
        			            					<img src="'.$fileUrl.$detail['logo_image_2'].'" border="0" class="img_bx_i">
        			            						<div class="check_bx">
        			            							<div class="checkbox">
        			            								<label>
        			            									<input type="checkbox" name="compare[]" id="c_name" class="cmpplans" value="'.$compare_data.'">
        			            										<label class="chk" for="Field4"></label>
        			          									</label>
        			            							</div>
        			            						</div>
        			            				</div>
        			                	</div>';
    					
    				$return .= '<div class="col-md-3 pad-left-10">
        			               		<div class="c_t" >
        			            			<span class="title_c" style="width:100%;">'.$detail['company_shortname'].'</span><span class="sub_tit" >'.$detail['policy_name'].$variant.'</span>
        			          			</div>
        			                </div>';
    					
    				$return .= '<div class="col-md-7 m_anc">
        			                	<div class="col-md-6 no_pad_l">
        			                 		<h3 class="anc">&#8377;'.number_format($detail['annual_premium']).'</h3>
        			                 			<p class="sub_tit">for cover of '.$sum_assured.'</p>
        			                 	</div>
        			                  			<div class="col-md-2" style="padding:0px">
        			                 				<div class="down_cnt" style="width:20px; height:auto; float:left; color:#999999;"><i class="fa fa-th"></i>
		        			                 		</div>
        			  									<div class="down_cnt_up" style=""><i class="fa fa-angle-up"></i>
        			                 					</div>
        			                			 </div>
        			                  					<div class="col-md-4 pad_r_10">
        			                  						<a class="btn_offer_block" href="#">Buy Now <i class="fa fa-angle-right"></i></a>
        			                  							<div class="thumb"><i class="fa fa-thumbs-up"></i><div class="text_t"> 12 people chose this plan</div></div>
        			                					 </div>
        			               			 </div>
        			                </div>';
    					
    				$return .= '<div class="accordion_a">
        			                 	<div class="col-md-12">
        			                		<div class="col-md-12 mar-10">
        			               				<h4 class="h_d">Key Features</h4>
        			               					<div class="custom-table-1">
        												<table width="100%">
        													<tbody>
        														<tr class="odd">
        															<td>Cashless treatment</td>
        															<td class="cus_width">'.$detail['cashless_treatment'].'
        															</td>
        														</tr>
        														<tr>
        															<td>Pre-existing diseases</td>
        															<td class="cus_width">'.$preexist_diseases.'
        															</td>
        														</tr>
        														<tr class="odd">
        															<td>Auto recharge of Sum Insured</td>
        															<td class="cus_width">'.$detail['autorecharge_SI'].'
        															</td>
        														</tr>
        														<tr>
        															<td>Hospitalisation expenses
        			    												<ul><li><i class="fa fa-angle-right"></i> Room Rent</li>
        			   														<li><i class="fa fa-angle-right"></i> ICU Rent</li>
        			    													<li><i class="fa fa-angle-right"></i> Fees of Surgeon, Anesthetist,  Medicines, Nurses, etc</li>
        																</ul>
        															</td>
        															<td class="cus_width">
        																<ul class="no">
        																	<li>'.$detail['room_rent'].'</li>
        																	<li>'.$detail['icu_rent'].'</li>
        																	<li>'.$detail['doctor_fee'].'</li>
        																</ul>
        															</td>
        														</tr>';
    				$return .= ' <tr class="odd">
        							<td>Pre-hospitalisation</td>
        							<td class="cus_width">'.$detail['pre_hosp'].'</td>
        						</tr>
        						<tr>
        							<td>Post-hospitalisation</td>
        							<td class="cus_width">'.$detail['post_hosp'].'</td>
        						</tr>
        						<tr class="odd">
        							<td>Day care expenses</td>
        							<td class="cus_width">'.$detail['day_care'].'</td>
        						</tr>
        						<tr>
        							<td>Maternity Benefits</td>
        							<td class="cus_width">'.$detail['maternity'].'</td>
        						</tr>
        						<tr >
        							<td>Health Check up</td>
        							<td class="cus_width">'.$detail['check_up'].'</td>
        						</tr>
        						<tr class="odd">
        							<td>Ayurvedic Treatment</td>
        							<td class="cus_width">'.$detail['ayurvedic'].'</td>
        						</tr>
        						<tr>
        							<td>Co-payment</td>
        							<td class="cus_width">'.$detail['co_pay'].'</td>
        						</tr>';
    					
    				$return .='</tbody>
        							</table>
        							</div>
        			               </div>';
    					
    					
    				$return .= '<div class="col-md-7 medical" style="padding-right:0px;margin-bottom: 0px;">
        					 		<h4 class="h_d mar-40" >List of Hospitals with Cashless Facility</h4>
        			               		<div class="cus_d" style="padding:5px;">
        			               			<div style="float: left; width: 100%; margin-top: 10px;">
        			               				<div style="float: right; width: 100%; padding-left: 15px;">
        											<div class="form-group col-md-12" style="margin-bottom:0px;">
        			                   					 <label for="" class="sr-only">Search by Pin Code</label>
        			                    					<input type="text" placeholder="Search by Pin Code or Hospital Name" name="hospital_list" id="" data-company-id="'.$detail['company_id'].'" data-hospital-list-id="resultTable_'.$detail['variant_id'].'" data-id="hos_class" autocomplete="off" spellcheck="false" class="form-control brdr typeahead tt-query med_search">
        			       
        			                    							<!--<div class="bs-example">
        			        									<input type="text" class="typeahead tt-query" autocomplete="off" spellcheck="false">
        			    									</div>-->
        			                    						<div class="search_icon"><i class="fa fa-search"></i></div>
        			                  				</div>
        										</div>';
    					
    				$return .= '<div class="loc_d hos"  style="padding:0px 15px; border:none; display:none; margin-top:20px;">
        			               	<div class="col-md-12">
        			              		<span class="tt-dropdown-menu" style="position: absolute; top: 100%; left: 0px; z-index:1; display: block; right: auto;">
        									<div class="tt-dataset-accounts">
        			  							<div class="city_m">
        			   								 <div class="city_a">Hospital Name</div>
        			   									 <div class="city_b">City</div>
        			    									<div class="city_c">Pin Code</div>
        			  							</div>
        			  						<span class="tt-suggestions resultTable" id="resultTable_'.$detail['variant_id'].'" style="display: block;"></span>
        									</div>
        								</span>
        			                </div>
        			            <div style="float: left; position: absolute; bottom: 0px; margin-bottom: 10px;" class="">Note: This list is subject to change without any notice</div>
    
        						</div>
        			    	</div>
        			  	</div>
        			 </div>';
    				
    				
    				$return .= '<div class="col-md-5">
        			        	<h4 class="h_d mar-40" style="margin-left:50px;">Documents</h4>
        							<ul class="doc">
        								<li>Policy Brouchure <a href="javascript:void(0)"><img src="'.base_url().'/assets/images/pdf.jpg"></a></li>
        								<li>Policy Wordings <a href="javascript:void(0)"><img src="'.base_url().'/assets/images/pdf.jpg" class="dimg"></a></li></ul>
        							</ul>
        			        </div>
        			           <div class="col-md-12  hide_d" >Hide details <i class="fa fa-angle-up"></i></div>
        			</div>
        		</div>
        	</div> ';
    				
    			}
    		} */
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
											<div class="img_bx">';
												if (!empty($detail['logo_image_2']) && file_exists($folderUrl.$detail['logo_image_2']))
												{
													$return .= '<img src="'.$fileUrl.$detail['logo_image_2'].'" border="0" class="img_bx_i">';
												}
					$return .= 					'<div class="check_bx">
													<div class="checkbox">
														<label> 
															<input type="checkbox" name="compare[]" id="c_name" class="cmpplans" value="'.$compare_data.'"> 
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
								    							
																$return .=		'<td>'.$featureList[$k1]['name'].'</td>
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
												<ul class="doc">';
    			
													if (!empty($detail['brochure']) && file_exists($pfolderUrl.$detail['brochure']))
													{
														$return .=	'<li>Policy Brouchure <a href="'.base_url().'admin/policy/download/'.$detail['policy_id'].'/brochure"><img src="'.base_url().'assets/images/pdf.jpg"> </a></li>';
													}
													if (!empty($detail['policy_wordings']) && file_exists($pfolderUrl.$detail['policy_wordings']))
													{
														$return .=	'<li>Policy Wordings <a href="'.base_url().'admin/policy/download/'.$detail['policy_id'].'/policy_wordings"><img src="'.base_url().'assets/images/pdf.jpg" class="dimg"> </a></li>';
													}
							$return .=			'</ul>
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
    
    /**
     * @abstract: Get search result from cache
     * @author: Nikhil Dorai.
     * @date: 14 July 2014.
     * @param: string $cacheFileName
     * @return: array()
     */
public static function getCachedObject($cacheKey='')
    {
    	$CI = &get_instance();
    
    	$CI->load->driver('cache', array('adapter' => 'file'));
    
    	$returnCacheObject = array();
    
    	if($CI->cache->get($cacheKey) != null)
    	{
    		$returnCacheObject = $CI->cache->get($cacheKey);
    	}
    	return $returnCacheObject;
    }
    
    /**
     * @abstract: Save database result set to cache.
     * @author: Nikhil Dorai.
     * @date: 14 July 2014.
     * @param: string $cacheFileName.
     * @param: array $customer_details.
     * @return: true/false.
     */
    public static function saveResultToCache($cacheFileName='',$customer_details=array())
    {
    	$CI = &get_instance();
    
    	$CI->load->driver('cache', array('adapter' => 'file'));
    
    	$saveCacheFile = '';
    
    	if(!empty($cacheFileName) && !empty($customer_details))
    	{
    		$saveCacheFile = $CI->cache->save($cacheFileName, $customer_details, 120);
    			
    		return $saveCacheFile;
    	}
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
			if (empty($model['claim_ratio']))
				$model['status'] = 'inactive';
			else  
				$model['status'] = 'active';
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
		if (!empty($save) && is_numeric($save))
			return true;
		else 
			return false;
		//return $save;
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
				FROM MIC_user_accounts us, MIC_demo_user_profiles dp 
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
						$arrParams['slug'] = $this->getSlug($v1);
						$arrParams['tag_for'] = $post['tag_for'];
						$arrParams['comments'] = $post['comments'];
						if (isset($post['display_name']) && !empty($post['display_name']))
							$arrParams['display_name'] = $post['display_name'];
						$arrParams['tag_id'] = $v2['tag_id'];
						$recordId = Master_tags_model::saveRecord($arrParams, $modelType='update');					
						if ($recordId != false)
							$tagIds[] = $recordId;
					}
				}
				else 
				{
					$arrParams['slug'] = $this->getSlug($v1);
					$arrParams['tag_for'] = $post['tag_for'];
					$arrParams['comments'] = $post['comments'];
						$arrParams['display_name'] = $post['display_name'];
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
				case 9 : 	$format 	= 'M d, Y';				break;
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
		$sql = 'SELECT DISTINCT tag_for FROM '.Util::getdbPrefix().'master_tags';
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
				'minimum_coverage_amount'=>array('name'=>'Minimum Coverage amount','tooltip'=>'Minimum Coverage Amount'),
				'maximum_coverage_amount'=>array('name'=>'Maximum Coverage amount','tooltip'=>'Maximum Coverage Amount'),
				'coverage_years'=>array('name'=>'Coverage Years','tooltip'=>''),
				'maximum_renewal_age'=>array('name'=>'Maximum Renewal Age','tooltip'=>''),
				'minimum_entry_age'=>array('name'=>'Minimum Entry Age','tooltip'=>''),
				'maximum_entry_age'=>array('name'=>'Maximum Entry Age','tooltip'=>''),
				'annual_income_eligibility'=>array('name'=>'Annual Income Eligibility','tooltip'=>''),
				'no_medical_test_age'=>array('name'=>'No Medical Test Age','tooltip'=>''),
				'no_medical_sum_assured_limit'=>array('name'=>'No Medical Sum Assured Limit','tooltip'=>''),
				'pre_existing_diseases'=>array('name'=>'Pre Existing Diseases','tooltip'=>''),
				'co_payment'=>array('name'=>'Co Payment','tooltip'=>''),
				'buying_mode'=>array('name'=>'Buying Mode','tooltip'=>''),
				'online'=>array('name'=>'Online','tooltip'=>''),
				'offline'=>array('name'=>'Offline','tooltip'=>''),
				'list_of_hospitals'=>array('name'=>'List of Hospitals','tooltip'=>''),
				'tax_benefits'=>array('name'=>'Tax Benefits','tooltip'=>''),
				'waiting_period'=>array('name'=>'Waiting Period','tooltip'=>''),
				'free_look_period'=>array('name'=>'Free Look Period','tooltip'=>''),
				'grace_period'=>array('name'=>'Grace Period','tooltip'=>''),
				'world_wide_coverage'=>array('name'=>'World Wide Coverage','tooltip'=>''),
				'cumulative_bonus'=>array('name'=>'Cumulative Bonus','tooltip'=>''),
				'accidental_death'=>array('name'=>'Accidental Death','tooltip'=>''),
				'permanent_total_disablement'=>array('name'=>'Permanent Total Disablement','tooltip'=>''),
				'permanent_partial_disablement'=>array('name'=>'Permanent Partial Disablement','tooltip'=>''),
				'hospital_daily_cash'=>array('name'=>'Hospital Daily Cash','tooltip'=>''),
				'double_indemnity'=>array('name'=>'Double Indemnity','tooltip'=>''),
				'accident_medical_expenses'=>array('name'=>'Accident Medical Expenses','tooltip'=>''),
				'accidental_hospitalisation_expenses_reimbursement'=>array('name'=>'Accidental Hospitalisation Expenses Reimbursement','tooltip'=>''),
				'accidental_out_patient_expenses_reimbursement'=>array('name'=>'Accidental Out Patient Expenses Reimbursement','tooltip'=>''),
				'weekly_indemnity'=>array('name'=>'Weekly Indemnity','tooltip'=>''),
				'broken_bone'=>array('name'=>'Broken Bone','tooltip'=>''),
				'modification_of_residence_vehicle'=>array('name'=>'Modification of Residence Vehicle','tooltip'=>''),
				'cost_of_transporting_mortal_remains'=>array('name'=>'Cost of Transporting Mortal Remains','tooltip'=>''),
				'cost_of_performane_of_death_ceremonies'=>array('name'=>'Cost of Performane of Death Ceremonies','tooltip'=>''),
				'ambulance_hiring_charges'=>array('name'=>'Ambulance Hiring Charges','tooltip'=>''),
				'family_transportation_benefit'=>array('name'=>'Family Transportation Benefit','tooltip'=>''),
				'burns'=>array('name'=>'Burns','tooltip'=>''),
				'major_exclusions'=>array('name'=>'Major Exclusions','tooltip'=>''),
				'accident_death_spouse'=>array('name'=>'Accident Death Spouse','tooltip'=>''),
				'permanent_total_disablity_spouse'=>array('name'=>'Permanent Total Disablity Spouse','tooltip'=>''),
				'permanent_partial_disablity_spouse'=>array('name'=>'Permanent Partial Disablity Spouse','tooltip'=>''),
				'accident_death_per_child'=>array('name'=>'Accident Death Per Child','tooltip'=>''),
				'permanent_total_disablity_per_child'=>array('name'=>'Permanent Total Disablity Per Child','tooltip'=>''),
				'permanent_partial_disablity_per_child'=>array('name'=>'Permanent Partial Disablity Per Child','tooltip'=>''),
				'tution_fees_per_child'=>array('name'=>'Tution Fees Per Child','tooltip'=>''),
			);
		}
		
		elseif($featureType == 'Mediclaim')
		{
			$value = array(
					'cashless_treatment'=>array('name'=>'Cashless treatment','tooltip'=>'Cashless treatment'),
					'preexisitng_diseases'=>array('name'=>'Pre-existing diseases','tooltip'=>'Pre-Existing Diseases'),
					'autorecharge_SI'=>array('name'=>'Auto recharge of Sum Insured','tooltip'=>''),
					'pre_hosp'=>array('name'=>'Pre-hospitalisation','tooltip'=>''),
					'post_hosp'=>array('name'=>'Post-hospitalisation','tooltip'=>''),
					'daycare'=>array('name'=>'Day care expenses','tooltip'=>''),
					'maternity'=>array('name'=>'Maternity benefits','tooltip'=>''),
					'check_up'=>array('name'=>'Health Check up','tooltip'=>''),
					'room_rent'=>array('name'=>'Room Rent','tooltip'=>''),
					'icu_rent'=>array('name'=>'Icu Rent','tooltip'=>''),
					'doctor_fee'=>array('name'=>'Fees of Surgeon, Anesthetist, Nurses, etc','tooltip'=>''),
					'buying_mode'=>array('name'=>'Buying Mode','tooltip'=>''),
					'ayurvedic'=>array('name'=>'Ayurvedic Treatment','tooltip'=>''),
					'co_pay'=>array('name'=>'Co-payment','tooltip'=>''),
					'buy_online'=>array('name'=>'Buy Online','tooltip'=>''),
					'tax_benefits'=>array('name'=>'Tax Benefits','tooltip'=>'')
					
			);
		}
		
		elseif($featureType == 'Critical Illness')
		{
			$value = array(
					'policy_renewable'=>array('name'=>'Policy Renewable','tooltip'=>'Policy Renewable'),
					'medical_test_age'=>array('name'=>'Medical Test Age','tooltip'=>'Cashless treatment'),
					'preexisting_age'=>array('name'=>'Preexisting Diseases','tooltip'=>''),
					'copay'=>array('name'=>'Copayment','tooltip'=>'Cashless treatment'),
					'tax_benifits'=>array('name'=>'Tax Benefits','tooltip'=>'Cashless treatment'),
					'cancer'=>array('name'=>'Cancer','tooltip'=>'Cashless treatment'),
					'cabg'=>array('name'=>'Coronary artery bypass surgery','tooltip'=>'Cashless treatment'),
					'myocardial_infraction'=>array('name'=>'Myocardial Infraction','tooltip'=>'Cashless treatment'),
					'kidney_faliure'=>array('name'=>'Kidney Faliure','tooltip'=>'Cashless treatment'),
					'obt'=>array('name'=>'Organ/Bone Marrow Transplant','tooltip'=>'Cashless treatment'),
					'stroke'=>array('name'=>'Stroke','tooltip'=>'Cashless treatment'),
					'ags'=>array('name'=>'Aorta Graft Surgery','tooltip'=>'Cashless treatment'),
					'ppah'=>array('name'=>'Primary Pulmonary Arterial Hypertension','tooltip'=>'Cashless treatment'),
					'ms'=>array('name'=>'Multiple Scleriosis','tooltip'=>'Cashless treatment'),
					'ppl'=>array('name'=>'Permenant Paralysis Of Limbs','tooltip'=>'Cashless treatment'),
					'cad'=>array('name'=>'Coronary Artery Disease','tooltip'=>'Cashless treatment'),
					'opr'=>array('name'=>'Open Heart Replacement','tooltip'=>'Cashless treatment'),
					'aplastic_anemia'=>array('name'=>'Aplastic Anemia','tooltip'=>'Cashless treatment'),
					'e_lu_d'=>array('name'=>'End Stage Lung Disease','tooltip'=>'Cashless treatment'),
					'e_li_d'=>array('name'=>'End Stage Liver Disease','tooltip'=>'Cashless treatment'),
					'coma'=>array('name'=>'Coma','tooltip'=>'Cashless treatment'),
					'major_burns'=>array('name'=>'Major Burns','tooltip'=>'Cashless treatment'),
					'mnd'=>array('name'=>'Motor Neuron Disease','tooltip'=>'Cashless treatment'),
					'ti'=>array('name'=>'Terminal Illness','tooltip'=>'Cashless treatment'),
					'bm'=>array('name'=>'Bacterial Meningitis','tooltip'=>'Cashless treatment'),
					'parkinsons'=>array('name'=>'Parkinsons','tooltip'=>'Cashless treatment'),
					'blindness'=>array('name'=>'Blindness','tooltip'=>'Cashless treatment'),
					'speech_loss'=>array('name'=>'Speech Loss','tooltip'=>'Cashless treatment'),
					'deafness'=>array('name'=>'Deafness','tooltip'=>'Cashless treatment'),
					'md'=>array('name'=>'Muscular Dystrophy','tooltip'=>'Cashless treatment'),
					'paraplegia'=>array('name'=>'Paraplegia','tooltip'=>'Cashless treatment'),
					'hepatoma'=>array('name'=>'Hepatoma','tooltip'=>'Cashless treatment'),
					'ovarian_c'=>array('name'=>'Ovarian Cancer','tooltip'=>'Cashless treatment'),
					'vaginal_c'=>array('name'=>'Vaginal Cancer','tooltip'=>'Cashless treatment'),
					'breast_c'=>array('name'=>'Breast Cancer','tooltip'=>'Cashless treatment'),
					'cervical'=>array('name'=>'Cervical Cancer','tooltip'=>'Cashless treatment'),
					'endometrial_c'=>array('name'=>'Endometrial Cancer','tooltip'=>'Cashless treatment'),
					'fallopian_tube_c'=>array('name'=>'Fallopian Tube Cancer','tooltip'=>'Cashless treatment'),
					'burns'=>array('name'=>'Burns','tooltip'=>'Cashless treatment'),
					'paralysis_multitrauma'=>array('name'=>'Paralysis Multitrauma','tooltip'=>'Cashless treatment'),
					'cdb'=>array('name'=>'Congenital Disability Benefit','tooltip'=>'Cashless treatment'),
					'hvs'=>array('name'=>'Heart Valve Surgery','tooltip'=>'Cashless treatment'),
					'quad'=>array('name'=>'Quadraplegia','tooltip'=>'Cashless treatment')
						
			);
		}
		
		elseif($featureType == 'termPlan')
		{
			$value = array(	'minimum_sum_assured'=>array('name'=>'Minimum Sum Assured','tooltip'=>''),
					'maximum_sum_assured'=>array('name'=>'Maximum Sum Assured','tooltip'=>''),
					'minimum_policy_terms'=>array('name'=>'Minimum Policy Term','tooltip'=>''),
					'maximum_policy_terms'=>array('name'=>'Maximum Policy Term','tooltip'=>''),
					'minimum_age_at_maturity'=>array('name'=>'Minimum Age At Maturity','tooltip'=>''),
					'maximum_age_at_maturity'=>array('name'=>'Maximum Age At Maturity','tooltip'=>''),
					'minimum_premium'=>array('name'=>'Minimum Premium','tooltip'=>''),
					'maximum_premium'=>array('name'=>'Maximum Premium','tooltip'=>''),
					'payment_modes'=>array('name'=>'Payment Modes','tooltip'=>''),
					'death_benefit'=>array('name'=>'Death Benefit','tooltip'=>''),
					'maturity_benefit'=>array('name'=>'Maturity Benefit','tooltip'=>''),
					'surrender_benefit'=>array('name'=>'Surrender Benefit','tooltip'=>''),
					'surrender_policy'=>array('name'=>'Surrender Policy	','tooltip'=>''),
					'revive_policy'=>array('name'=>'Revive Policy','tooltip'=>''),
					'loan'=>array('name'=>'Loan','tooltip'=>''),
					'tax_benefits'=>array('name'=>'Tax Benefits','tooltip'=>''),
					'additional_benefit'=>array('name'=>'Additional Benefits','tooltip'=>''),
					'purpose_of_insurance'=>array('name'=>'Purpose Of Insurance','tooltip'=>'')
			);
		}
		elseif($featureType == 'travelInsurance')
		{
			$value = array('sum_assured'=>array('name'=>'Sum Assured','tooltip'=>''),
					'trip_duration'=>array('name'=>'Trip Duration','tooltip'=>''),
					'medical_expenses'=>array('name'=>'Medical Expenses','tooltip'=>''),
					'dental'=>array('name'=>'Dental','tooltip'=>''),
					'repatriation_of_mortal_remains'=>array('name'=>'Repatriation Of Moral Remains','tooltip'=>''),
					'hospital_daily_cash'=>array('name'=>'Hospital Daily Cash','tooltip'=>''),
					'total_loss_of_checked_baggage'=>array('name'=>'Total Loss Of Checked Baggage','tooltip'=>''),
					'delay_of_checked_baggage'=>array('name'=>'Delay of Checked Baggage','tooltip'=>''),
					'loss_of_passport'=>array('name'=>'Loss Of Passport','tooltip'=>''),
					'personal_accident'=>array('name'=>'Personal Accident','tooltip'=>''),
					'personal_liability'=>array('name'=>'Personal Liability','tooltip'=>''),
					'financial_emergency'=>array('name'=>'Financial Emergency','tooltip'=>''),
					'hijack_daily_allowance'=>array('name'=>'Hijack Daily Allowance','tooltip'=>''),
					'trip_delay'=>array('name'=>'Trip Delay','tooltip'=>''),
					'trip_cancellation'=>array('name'=>'Trip Cancellation','tooltip'=>''),
					'trip_curtailment'=>array('name'=>'Trip Curtailment','tooltip'=>''),
					'missed_connection'=>array('name'=>'MIssed Connection','tooltip'=>''),
					'comments'=>array('name'=>'Comments','tooltip'=>''),
					'gender'=>array('name'=>'Gender','tooltip'=>''),
					'healthy'=>array('name'=>'Healthy','tooltip'=>''),
					'smoker'=>array('name'=>'Smoker','tooltip'=>'')
			);
		}
		return $value;
	}
	
	public static function setCookies($cookieName, $cookieData = '', $time = '864000')
	{
		$ci = &get_instance();
		$ci->load->helper('cookie');
		if (!empty($cookieName))
		{
			//	check if cookie exists
			if (isset($_COOKIE[$cookieName]) && !empty($_COOKIE[$cookieName]))
			{
				$cookie = unserialize($_COOKIE[$cookieName]);
				//$cookieData = array_merge($cookie, $cookieData);
				$ci->input->set_cookie($cookieName,serialize($cookieData),$time);		
			}
			else 
			{
				$ci->input->set_cookie($cookieName,serialize($cookieData),$time);
			}
		}
	}
	
	/**
	 *
	 * @param string $cookieName
	 * @return Ambigous <multitype:, mixed>
	 */
	public static function getCookie($cookieName = '')
	{
		$cookie = array();
	
		if(!empty($cookieName))
		{
			$cookie = (isset($_COOKIE[$cookieName]) && !empty($_COOKIE[$cookieName])) ? unserialize($_COOKIE[$cookieName]) : array();
				
		}
	
		return $cookie;
	
	}
	
	
	/**
	 *
	 * @param unknown $data
	 * @param unknown $filter
	 */
	public static function getFilteredData($data,$search_filter = array())
	{
		if(!empty($data) && !empty($search_filter))
		{
				
			foreach($data as $k => $v)
			{
				if(isset($search_filter['room_rent']))
				{
					if ( $v['room_rent'] != 'Fully Covered' )
					{
						unset($data[$k]);
					}
				}
				if(isset($search_filter['maternity']))
				{
					if ( $v['maternity'] == 'Not Covered' )
					{
						unset($data[$k]);
					}
				}
				if(isset($search_filter['precover']))
				{
					if (!(in_array(trim($v['preexisting_diseases']),$search_filter['precover'])))
					{
						unset($data[$k]);
					}
				}
				if(isset($search_filter['sector']))
				{
						
					if (!(in_array(trim($v['public_private_health']),$search_filter['sector'])))
					{
						unset($data[$k]);
					}
				}
					
				if(isset($search_filter['health_comp']))
				{
						
					if (!(in_array(trim($v['company_type_id']),$search_filter['health_comp'])))
					{
						unset($data[$k]);
					}
				}
					
				if(isset($search_filter['company_name']))
				{
					if (!(in_array(trim($v['company_id']),$search_filter['company_name'])))
					{
						unset($data[$k]);
					}
				}
					
					
				if(isset($search_filter['min_premium_amt']))
				{
					$min_amt_arr = explode('â‚¹',$search_filter['min_premium_amt']);
						
					$min_premium = (int) str_replace(',','',$min_amt_arr[1]);
						
					if(!($v['annual_premium'] >= $min_premium))
					{
						unset($data[$k]);
					}
				}
					
				if(isset($search_filter['max_premium_amt']))
				{
					$max_amt_arr = explode('â‚¹',$search_filter['max_premium_amt']);
						
					$max_premium = (int) str_replace(',','',$max_amt_arr[1]);
						
					if(!($v['annual_premium'] <= $max_premium))
					{
						unset($data[$k]);
					}
				}
					
				/* if(isset($search_filter['min_claim_ratio']))
				 {
					
				$min_claims_ratio = (int) str_replace(' %','',$search_filter['min_claim_ratio']);
					
				if($v['claim_ratio'] <= $min_claims_ratio)
				{
				unset($data[$k]);
				}
				}
					
				if(isset($search_filter['max_claim_ratio']))
				{
					
				$max_claims_ratio = (int) str_replace(' %','',$search_filter['max_claim_ratio']);
					
				if($v['claim_ratio'] >= $max_claims_ratio)
				{
				unset($data[$k]);
				}
				} */
					
	
			}
			//$data['plan_count'] = count($data);
				
		}
	
		return $data;
	}
	
	
	public static function getFilteredDataForCriticalIllness($data,$search_filter = array())
	{
		if(!empty($data) && !empty($search_filter))
		{
			foreach($data as $k=>$v)
			{
				if(isset($search_filter['sum_assured']))
				{
	
					if (!in_array($v['sum_assured'],$search_filter['sum_assured']))
					{
						unset($data[$k]);
					}
				}
	
				if(isset($search_filter['sector']))
				{
	
					if (!(in_array($v['public_private_health'],$search_filter['sector'])))
					{
						unset($data[$k]);
					}
				}
				
			if(isset($search_filter['precover_4']))
				{
					if(!(in_array($v['preexisting_age'],$search_filter['precover_4'])))
					{
						unset($data[$k]);
					}	
				}
				
				if(isset($search_filter['precover_no']))
				{
					if(!(in_array($v['preexisting_age'],$search_filter['precover_no'])))
					{
						unset($data[$k]);
					}
				}
				
				if(isset($search_filter['disease_covered']))
				{
						
					foreach($search_filter['disease_covered'] as $k1=>$v1)
					{
				
						if(isset($v[$v1]) && $v[$v1] == 'No')
						{
							unset($data[$k]);
						}
					}
				}
				
				if(isset($search_filter['company_name']))
				{
					if (!(in_array(trim($v['company_id']),$search_filter['company_name'])))
					{
						unset($data[$k]);
					}
				}
					
				if(isset($search_filter['health_comp']))
				{
					if (!(in_array(trim($v['company_type_id']),$search_filter['health_comp'])))
					{
						unset($data[$k]);
					}
				}
	
				if(isset($search_filter['min_premium_amt']))
				{
					$min_amt_arr = explode('â‚¹',$search_filter['min_premium_amt']);
	
					$min_premium = (int) str_replace(',','',$min_amt_arr[1]);
	
					if(!($v['annual_premium'] >= $min_premium))
					{
						unset($data[$k]);
					}
				}
					
				if(isset($search_filter['max_premium_amt']))
				{
					$max_amt_arr = explode('â‚¹',$search_filter['max_premium_amt']);
	
					$max_premium = (int) str_replace(',','',$max_amt_arr[1]);
	
					if(!($v['annual_premium'] <= $max_premium))
					{
						unset($data[$k]);
					}
				}
			}
				
		}
		return $data;
	}
	
	
public static function getFilteredDataForTermPlan($data,$search_filter = array())
	{
		if(!empty($data))
		{
			foreach($data as $k=>$v)
			{
				if(isset($search_filter['company_name']))
				{
					if (!(in_array(trim($v['company_id']),$search_filter['company_name'])))
					{
						unset($data[$k]);
					}
				}
			
				if(isset($search_filter['min_premium_amt']))
				{
					$min_amt_arr = explode('â‚¹',$search_filter['min_premium_amt']);
						
					$min_premium = (int) str_replace(',','',$min_amt_arr[1]);
						
					if(!($v['annual_premium'] >= $min_premium))
					{
						unset($data[$k]);
					}
				}
				
				if(isset($search_filter['max_premium_amt']))
				{
					$max_amt_arr = explode('â‚¹',$search_filter['max_premium_amt']);
						
					$max_premium = (int) str_replace(',','',$max_amt_arr[1]);
						
					if(!($v['annual_premium'] <= $max_premium))
					{
						unset($data[$k]);
					}
				}
				
				if(isset($search_filter['policy_term']))
				{
					if(!in_array($v['term'],$search_filter['policy_term']))
					{
						unset($data[$k]);
					}
				}
				
				if (isset($search_filter['payment_freq'])) 
				{
					
					$db_payment_freq = explode(', ',strtolower($v['payment_modes']));
					
					$inPaymentMode = array();
					
					foreach($search_filter['payment_freq'] as $k3=>$v3)
					{
						if (!in_array(trim($v3),$db_payment_freq))
						{	
							$inPaymentMode[] = false;
							
						}
							
						elseif(in_array(trim($v3),$db_payment_freq))
						{
							$inPaymentMode[] = true;
						}
						
					}	
					
					if(!in_array(true, $inPaymentMode))
					{
						unset($data[$k]);
					}
				}
				
				if(isset($search_filter['purpose']))
				{
					if(!in_array(trim($v['purpose_of_insurance']) ,$search_filter['purpose']))
					{
						unset($data[$k]);
					}
				}
				
				if(isset($search_filter['min_claims']))
				{
					$min_claim = (float) str_replace(' %','',$search_filter['min_claims']);
					
					
					if(!((float) $v['claim_ratio'] >= $min_claim))
					{
						unset($data[$k]);
					}
				}
				
				if(isset($search_filter['max_claims']))
				{
					$max_claim = (float) str_replace(' %','',$search_filter['max_claims']);
						
					if(!((float) $v['claim_ratio'] <= $max_claim))
					{
						unset($data[$k]);
					}
				}
				
			}
		
		}
		return $data;
	}
	
	/**
	 *
	 * @param result set data $data
	 * @param filter data     $search_filter
	 */
	public static function getFilteredDataForTravel($data,$search_filter = array())
	{
		if(!empty($data))
		{
			foreach($data as $k=>$v)
			{
				if(isset($search_filter['coverage_amount']))
				{
	
					if (!in_array($v['sum_assured'],$search_filter['coverage_amount']))
					{
						unset($data[$k]);
					}
				}
	
				if(isset($search_filter['company_name']))
				{
					if (!(in_array(trim($v['company_id']),$search_filter['company_name'])))
					{
						unset($data[$k]);
					}
				}
					
				if(isset($search_filter['min_premium_amt']))
				{
					$min_amt_arr = explode('â‚¹',$search_filter['min_premium_amt']);
	
					$min_premium = (int) str_replace(',','',$min_amt_arr[1]);
	
					if(!($v['annual_premium'] >= $min_premium))
					{
						unset($data[$k]);
					}
				}
	
				if(isset($search_filter['max_premium_amt']))
				{
					$max_amt_arr = explode('â‚¹',$search_filter['max_premium_amt']);
	
					$max_premium = (int) str_replace(',','',$max_amt_arr[1]);
	
					if(!($v['annual_premium'] <= $max_premium))
					{
						unset($data[$k]);
					}
				}
				
				if(isset($search_filter['trip_duration']))
				{
					if(!(in_array($v['maximum_trip_duration'],$search_filter['trip_duration'])))
					{
						unset($data[$k]);
					}
				}
			}
		}
		return $data;
	}
	
	public static function getConfigForFileUpload($type = 'company')
	{
		$config = array();
		$ci = &get_instance();
		if ($type == 'company')
		{
			$config['logo_image_1']	=	array(	'allowed_types'	=>	'gif|jpg|png|jpeg',
												'max_size'		=>	'200',
												'max_width'		=>	'172',
												'max_height'	=>	'68',
												'upload_path'	=>	$ci->config->config['folder_path']['company']['companyPageLogo'],
											);
			$config['logo_image_2']	=	array(	'allowed_types'	=>	'gif|jpg|png|jpeg',
												'max_size'		=>	'200',
												'max_width'		=>	'80',
												'max_height'	=>	'50',
												'upload_path'	=>	$ci->config->config['folder_path']['company']['searchResultLogo'],
											);
			$config['logo_image_partner']	=	array(	'allowed_types'	=>	'gif|jpg|png|jpeg',
												'max_size'		=>	'200',
												'max_width'		=>	'147',
												'max_height'	=>	'107',
												'upload_path'	=>	$ci->config->config['folder_path']['company']['partnerLogo'],
											);
			$config['logo_image_leadership']=	array(	'allowed_types'	=>	'gif|jpg|png|jpeg',
												'max_size'		=>	'200',
												'max_width'		=>	'160',
												'max_height'	=>	'160',
												'upload_path'	=>	$ci->config->config['folder_path']['company']['companyLeadership'],
											);
		}
		else if ($type == 'policy')
		{
			$config['brochure']			=	array(	'allowed_types'	=>	'*',
												'max_size'		=>	'5120',
												'max_width'		=>	'2000',
												'max_height'	=>	'2000',
												'upload_path'	=>	$ci->config->config['folder_path']['policy']['brochure'],
											);
			$config['policy_wordings']	=	array(	'allowed_types'	=>	'*',
												'max_size'		=>	'5120',
												'max_width'		=>	'2000',
												'max_height'	=>	'2000',
												'upload_path'	=>	$ci->config->config['folder_path']['policy']['policy_wordings'],
											);
			$config['policy_logo']	=	array(	'allowed_types'	=>	'gif|jpg|png|jpeg',
												'max_size'		=>	'200',
												'max_width'		=>	'172',
												'max_height'	=>	'68',
												'upload_path'	=>	$ci->config->config['folder_path']['policy']['policy_logo'],
											);
			$config['policy_wordings_images']	=	array(	'allowed_types'	=>	'gif|jpg|png|jpeg',
												'max_size'		=>	'5120',
												'max_width'		=>	'2000',
												'max_height'	=>	'2000',
												'upload_path'	=>	$ci->config->config['folder_path']['policy']['policy_wordings_images'],
											);
			$config['brochure_images']	=	array(	'allowed_types'	=>	'gif|jpg|png|jpeg',
												'max_size'		=>	'5120',
												'max_width'		=>	'2000',
												'max_height'	=>	'2000',
												'upload_path'	=>	$ci->config->config['folder_path']['policy']['brochure_images'],
											);
		}
		else if ($type == 'news')
		{
			$config['original_image']	=	array(	'allowed_types'	=>	'gif|jpg|png|jpeg',
												'max_size'		=>	'5120',
												'max_width'		=>	'2000',
												'max_height'	=>	'2000',
												'upload_path'	=>	$ci->config->config['folder_path']['news']['original_image'],
											);
		}
		else if ($type == 'users')
		{
			$config['user_image']	=	array(	'allowed_types'	=>	'gif|jpg|png|jpeg',
												'max_size'		=>	'5120',
												'max_width'		=>	'5000',
												'max_height'	=>	'5000',
												'upload_path'	=>	$ci->config->config['folder_path']['users']['original'],
											);
		}
		else 
		{
			$config['temp']	=	array(	'allowed_types'	=>	'*',
												'max_size'		=>	'5000',
												'max_width'		=>	'50000',
												'max_height'	=>	'68000',
												'upload_path'	=>	$ci->config->config['folder_path']['temp'],
												'upload_url'	=>	$ci->config->config['url_path']['temp'],
											);
		}
		return $config;
	}
	
	public static function getCKEditorConfig($params = array())
	{
		$config = array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"100%",	//Setting a custom width
				'height' 	=> 	'300px',	//Setting a custom height
			);
		if (!empty($params))
		{
			$config = array_merge($config, $params);
		}
		return $config;
	}
	

    /**
     * @abstract: Call store procedure
     * @author: krishna maurya.
     * @date: 23 July 2014.
     * @param: string $type - name of store procedure.
     * @param: array $arrParams - query filter for store procedure.
     * @return: array.
     */
	public static function callStoreProcedure($type, $arrParams = array())
	{
		$query = '';
		$resultData = array();
		$db = &get_instance();
		$db->db->freeDBResource($db->db->conn_id);
		if (!empty($type))
		{
			if ($type == 'singleCompanyAllDetails')
				$query = "CALL sp_getSingleInsuranceCompanyAllDetails(?)";
			else if ($type == 'singleCompanyDetails')
				$query = "CALL sp_getSingleInsuranceCompanyDetails(?)";
			else if ($type == 'allPolicyOfSingleCompany')
				$query = "CALL sp_getAllPolicyOfSingleCompany(?)";
			else if ($type == 'getAllDetailsOfSingleHealthPolicy')
				$query = "CALL sp_getAllDetailsOfSingleHealthPolicy(?)";
			else if ($type == 'getAllPolicyVariantsDetails')
				$query = "CALL sp_getAllPolicyVariantsDetails(?,?,?,?,?,?,?,?,?)";
			else if ($type == 'getPolicyVariantsFeaturesRidersDetails')
				$query = "CALL sp_getPolicyVariantsFeaturesRidersDetails(?,?,?)";
			else if ($type == 'getCompanyClaimRatio')
				$query = "CALL sp_getCompanyClaimRatio(?,?,?)";
			else if ($type == 'sp_incrementPageViewCount')
				$query = "CALL sp_incrementPageViewCount(?,?,?,?,?)";
			else if ($type == 'sp_getSingleRecordFromTable')
				$query = "CALL sp_getSingleRecordFromTable(?,?,?)";
			else if ($type == 'sp_updateRatingValuesForRecords')
				$query = "CALL sp_updateRatingValuesForRecords(?,?,?,?,?,?)";
			else if ($type == 'sp_insetIntoMIC_disqus_threads')
				$query = "CALL sp_insetIntoMIC_disqus_threads(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			else if ($type == 'sp_insetIntoMIC_disqus_comments')
				$query = "CALL sp_insetIntoMIC_disqus_comments(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			else if ($type == 'sp_getNewsDetails')
				$query = "CALL sp_getNewsDetails(?,?,?,?,?)";
			else if ($type == 'sp_getTopNewsArticlesGuide')
				$query = "CALL sp_getTopNewsArticlesGuide(?)";
			else if ($type == 'sp_getRelatedNewsArticlesGuides')
				$query = "CALL sp_getRelatedNewsArticlesGuides(?,?)";
			else if ($type == 'sp_getTagsWithNewsCount')
				$query = "CALL sp_getTagsWithNewsCount(?)";
				
			$queryData = $arrParams;
			$resultData = $db->db->query($query,$queryData);
		}
		
		if (!empty($resultData))
			return $resultData->result_array();
		else 
			return array();
	}
	
	public static function getControllerForPolicyVariantFeatures($variantType)
	{
		$return  = array();
		$variantType = explode(',', $variantType);
		$variantType = reset($variantType);
		if (!empty($variantType))
		{
			switch ($variantType)
			{
				case 'car-insurance':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'car_insurance';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'child':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'child';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'endowment':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'endowment';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'health-insurance':
					$return['backendController'] = 'policy_features_mediclaim';
					$return['backendFeatureAction'] = 'mediclaim';
					$return['feature_table'] = 'policy_features_mediclaim';
					$return['premium_table'] = 'annual_premium_health';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = 'policy_rider_mediclaim';
					break;
				case 'health-insurance-li-companies':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'health_insurance-li-companies';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'home-insurance':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'home_insurance';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'money-back':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'money_back';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'pension':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'pension';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'term-insurance':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'term_insurance';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'travel-insurance': case 'single-trip': case 'annual-multitrip': case 'student':
					$return['backendController'] = 'policy_features_travel';
					$return['backendFeatureAction'] = 'travel_insurance';
					$return['feature_table'] = 'policy_features_travel';
					$return['premium_table'] = 'annual_premium_travel';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = 'policy_rider_travel';
					break;
				case 'two-wheelar-insurance':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'two_wheelar_insurance';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'ulip':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'ulip';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'whole-life':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'whole_life';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'critical-illness':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'critical_illness';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'decreasing-term':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'decreasing_term';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'deferred-annutiy':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'deferred_annutiy';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'domestic-travel':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'domestic_travel';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'hospital-cash':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'hospital_cash';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'immediate-annuity':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'immediate_annuity';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'increasing-term':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'increasing_term';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'international-travel':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'international_travel';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'level-term':
					$return['backendController'] = 'policy_features_level_term';
					$return['backendFeatureAction'] = 'level_term';
					$return['feature_table'] = 'policy_features_level_term';
					$return['premium_table'] = 'annual_premium_term_plan';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = 'policy_rider_mediclaim';
					break;
				case 'mediclaim':
					$return['backendController'] = 'policy_features_mediclaim';
					$return['backendFeatureAction'] = 'mediclaim';
					$return['feature_table'] = 'policy_features_mediclaim';
					$return['premium_table'] = 'annual_premium_health';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = 'policy_rider_mediclaim';
					break;
				case 'opd':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'opd';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'personal-accident':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'personal_accident';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'special-plans':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'special_plans';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'super-top-up':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'super_top-up';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'top-up':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'top_up';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				case 'trop':
					$return['backendController'] = 'policy_variants_master';
					$return['backendFeatureAction'] = 'trop';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
				default :
					$return['backendController'] = '';
					$return['backendFeatureAction'] = '';
					$return['feature_table'] = '';
					$return['premium_table'] = '';
					$return['frontEndController'] = '';
					$return['frontEndView'] = '';
					$return['riderTable'] = '';
					break;
			}
		}
		return $return;
	}
	
	public static function getPremiumPaymentMode()
	{
		return array('monthly'=>'Monthly', 'quaterly'=>'Quaterly', 'yearly'=>'Yearly');
	}
	
	public static function getRiderSlugs($type)
	{
		$rider = array();
		if (!empty($type))
		{
			switch ($type)
			{
				case 'car-insurance':
					break;
				case 'child':
					break;
				case 'endowment':
					break;
				case 'health-insurance':
					break;
				case 'health-insurance-li-companies':
					break;
				case 'home-insurance':
					break;
				case 'money-back':
					break;
				case 'pension':
					break;
				case 'term-insurance':
					break;
				case 'travel-insurance':
					break;
				case 'two-wheelar-insurance':
					break;
				case 'ulip':
					break;
				case 'whole-life':
					break;
				case 'critical-illness':
					break;
				case 'decreasing-term':
					break;
				case 'deferred-annutiy':
					break;
				case 'domestic-travel':
					break;
				case 'hospital-cash':
					break;
				case 'immediate-annuity':
					break;
				case 'increasing-term':
					break;
				case 'international-travel':
					break;
				case 'level-term':
					$rider['rider_name'] 			= 	'';
					$rider['rider_display_name'] 	= 	'';
					$rider['rider_value'] 			= 	'';
					$rider['comments'] 				= 	'';
					$rider['slug'] 					= 	array('accidental-death-benefit'=>'Accidental Death Benefit', 'accidental-dismemberment-benefit'=>'Accidental Dismemberment Benefit', 'waiver-of-premium'=>'Waiver of Premium', 'critical-illness'=>'Critical illness',
															'family-income-benefit'=>'Family Income Benefit', 'accelerated-sum-assured'=>'Accelerated Sum Assured', 'hospital-cash-benefit'=>'Hospital Cash Benefit');
					break;
				case 'mediclaim':
					$rider['slug']					=	array('critical-illness'=>'Critical Illness', 'waiver-of-room-rent-sub-limits'=>'Waiver of Room Rent Sub-limits');
					break;
				case 'opd':
					break;
				case 'personal-accident':
					break;
				case 'special-plans':
					break;
				case 'super-top-up':
					break;
				case 'top-up':
					break;
				case 'trop':
					break;
				default :
					$rider = array();
					break;
			}
		}
		return $rider;
	} 
	
	/**
	 * 
	 * rearrange the riders as slug value pair
	 * @param $riders : arraya
	 * returns array()
	 */
	public static function rearrangeRiders($riders = array())
	{
		$return = array();
		if (!empty($riders))
		{
			foreach ($riders as $k1=>$v1)
			{
				$return[$v1['slug']] = $v1;
			}
		}		
		return $return;
	}
	
	
	
	public static function saveRiderData($variant_id, $riderPost = array(), $riderModelName = '')
	{
		$return = $riderModel = array();
		$result = false;
		$ci = &get_instance();
		$msg = '<p class="error_msg">Undefined error in riders.</p>';
		if (!empty($riderPost))
		{
			foreach ($riderPost as $k1=>$v1)
			{
				foreach ($v1 as $k2=>$v2)
				{
					$riderModel[$k1][$k2] = $v2;
					$riderModel[$k1]['variant_id'] = $variant_id;
					$riderModel[$k1]['slug'] = $k1;
				}
			}
			if (!empty($riderModel))
			{
				foreach ($riderModel as $k6=>$v6)
				{		
					$savedRiders[] = Util::addUpdateRiders($model = $v6, $variant_id, $riderModelName);
				}
			}	
			if (!empty($savedRiders) && !in_array(false, $savedRiders))
			{
				$result = true;
				$msg = 'Riders updated successfully';
			}
			else 
			{
				$result = false;
				$msg = '<p class="error_msg">Rider cannot be updated.</p>';
			}
		}
		else 
		{
			$result = false;
			$msg = '<p class="error_msg">Rider cannot be blank.</p>';
		}
		$return = array('result'=>$result, 'msg'=>$msg, 'riderModel'=>$riderModel);
		return $return;	
	}

	
	public static function addUpdateRiders($model, $variant_id, $riderModelName)
	{
		$save  = false;
		$ci = &get_instance();
		if (!empty($model))
		{	
			//	check if record exists
			$where = $isExist = array();
			$arrSkip = array('variant_id', 'status', 'comments');
			if (isset($model['variant_id']) && !empty($model['variant_id']))
			{
				$where[0]['field'] = 'variant_id';
				$where[0]['value'] = $model['variant_id'];
				$where[0]['compare'] = 'equal';
			}
			if (isset($model['slug']) && !empty($model['slug']))
			{
				$where[1]['field'] = 'slug';
				$where[1]['value'] = $model['slug'];
				$where[1]['compare'] = 'equal';
			}
			if (!empty($where))
				$isExist = $ci->util->getTableData($modelName=$riderModelName, $type="all", $where, $fields = array());

			$riderModelName = strtolower($riderModelName);

			if (!empty($isExist))
			{
				foreach ($isExist as $k1=>$v1)
				{					
					if ($v1['status'] == 'active' || $model['status'] == 'deleted')
					{
						$model['rider_id'] = (int)$v1['rider_id'];
						$ci->db->freeDBResource($ci->db->conn_id);
						$save = $ci->$riderModelName->saveRecord($arrParams = $model, $modelType = 'update');
						break;	
					}
				}
			}
			else 
			{
				$ci->db->freeDBResource($ci->db->conn_id);
				$save = $ci->$riderModelName->saveRecord($arrParams = $model, $modelType = 'create');
			}
		}
		return $save;
	}
	
	
	public static function updatePeerConnectionCountValue($newPeerComparision, $oldPeerComparision)
	{
		//	get new peer added in the group 
		$newPeer = array_diff($newPeerComparision, $oldPeerComparision);
		$ci = &get_instance();
		$ci->db->freeDBResource($ci->db->conn_id);
		if (!empty($newPeer)) 
		{
			foreach ($newPeer as $k1=>$v1)
			{
				if (!empty($v1))
				{
					$where[0]['field'] = 'variant_id';
					$where[0]['value'] = $v1;
					$where[0]['compare'] = 'equal';
					$isExist = $ci->util->getTableData($modelName='Policy_variants_master_model', $type="single", $where, $fields = array());
					if (!empty($isExist))
					{
						$isExist['peer_comparision_count'] = $isExist['peer_comparision_count'] + 1;
						$ci->db->freeDBResource($ci->db->conn_id);
						$save = $ci->policy_variants_master_model->saveRecord($arrParams = $isExist, $modelType = 'update');
					}
				}			
			}
		}
		
		//	get deleted peer in the group
		$oldPeer = array_diff($oldPeerComparision, $newPeerComparision);

		if (!empty($oldPeer)) 
		{
			foreach ($oldPeer as $k1=>$v1)
			{
				if (!empty($v1))
				{
					$where[0]['field'] = 'variant_id';
					$where[0]['value'] = $v1;
					$where[0]['compare'] = 'equal';
					$isExist = $ci->util->getTableData($modelName='Policy_variants_master_model', $type="single", $where, $fields = array());
					if (!empty($isExist))
					{
						$isExist['peer_comparision_count'] = ($isExist['peer_comparision_count'] > 0) ? $isExist['peer_comparision_count'] - 1 : 0;
						$ci->db->freeDBResource($ci->db->conn_id);
						$save = $ci->policy_variants_master_model->saveRecord($arrParams = $isExist, $modelType = 'update');
					}
				}			
			}
		}	
	}
	
	public static function getTotalRowTable($type = "", $tableName, $where = '', $limit = 0, $orderBy = '')
	{
		$db = &get_instance();
		
		if (!empty($where))
			$db->db->where($where);
		
		if ($type == 'total')
		{
			$db->db->freeDBResource($db->db->conn_id);
			$db->db->from($tableName);
			$db->db->freeDBResource($db->db->conn_id);
			$record = $db->db->count_all_results();
		}
		else
		{
			if (!empty($limit))
				$db->db->limit($db->config->config['pagination']['per_page'], $limit);
			else 
				$db->db->limit($db->config->config['pagination']['per_page'], 0);
				
			if (!empty($orderBy))
				$db->db->order_by($orderBy);
				
			$db->db->freeDBResource($db->db->conn_id);	
	        $qry= $db->db->get($tableName);
	        $record = $qry;
		}
		return $record;
	}

	public static function getAllowedImageExtensionType()
	{
		//$imageExt is dependent on $fileExt = Util::getFileTypeExt();
		$imageExt = 'jpg,jpeg,png,gif';
		return $imageExt;
	}
	
	
	/**
	 * function to generate filename 
	 * $extension 	:	Extension of file to be used
	 * $isMD5		: 	decides wether to return md5 string or not. Default is no MD5
	 * @return generated filename
	 * */
	
	public static function generateFileName($isMD5 = false){
		$random = ''; 
		$i=0;
		//crate random string of length 4
		while($i<4) { 
			/* selects random alphabets */
			$random .= chr( (rand(0,1) ? 97:65) + mt_rand(0, 25) );
			$i++;
		}
		
		$t1 = time() * rand(); $x = substr(str_shuffle('_-'),0,1);
		$return = substr(number_format($t1,0,'',''),0,11).$x.substr($t1,11,strlen($t1)).$x.$random;
		return $isMD5 ? md5($return):$return;
	}

	public static function resizeForThumbnail($size = null)
	{
		if ($size ='resize_to_thumbnail')
			return array('width'=>154, 'height'=>103);
		else 
			return array('width'=>154, 'height'=>103);
	}
	
	public static function resizeImage($source, $destination, $scaling_type, $scaling_params=array())
	{
		$image = new ResizeImage();
		$image->load($source);
		switch($scaling_type)
		{
			case 'SCALE' :
				$image->scale($scaling_params['scale']);
			break;
			
			case 'RESIZE' :
				$image->resize($scaling_params['width'],$scaling_params['height']);
			break;
			case 'RESIZE_AUTOMATICALLY':
				$width = $image->getWidth();
				$height= $image->getHeight();
				//calculate $scaling values
				$scaling_params['width'] =  430;
				$scaling_params['height'] =  250;
				//resize to new size
				$image->resize($scaling_params['width'],$scaling_params['height']);
				
			break;
		}
		$image->save($destination);
	}
	
	
	public static function getPolicyVariantsFeaturesRidersDetails($policySlug, $variantType = '', $companyType = '')
	{
		$data['companyDetails'] = $data['policyDetails'] = $data['variantDetails'] = $data['claimRatio'] = $data['claimRatioJson'] = $data['peerComparisionResult'] = $arrParams = array();
		$data['disqusUrl'] = $url = '';
		if (!empty($policySlug))
		{
			$url = base_url().'health-insurance/'.$policySlug;	
			$arrParams['policy_slug'] = $policySlug;
			$allVariantTypes = Util::getControllerForPolicyVariantFeatures($variantType);
			$arrParams['feature_table'] = $allVariantTypes['feature_table'];
			$arrParams['rider_table'] = $allVariantTypes['riderTable'];
		//	$arrParams['company_type_slug'] = $companyType;
		//	$arrParams['premium_table'] = $allVariantTypes['premium_table'];
			$cacheFileName = 'policy_'.$policySlug.'_'.$variantType;
			$cacheResult = Util::getCachedObject($cacheFileName);			
			//	check if cache file exist
			if(!empty($cacheResult))
			{
				// get result set from cache
				$data = $cacheResult;
			}
			else
			{
				//get resultset from DB and save in cache
				$db = &get_instance();
				$tableNames = Util::getFieldNamesOfAllTables();
				$tableNames['variantFeatureFields'] 	= $db->db->list_fields($allVariantTypes['feature_table']);
				$tableNames['riderFields'] 	= $db->db->list_fields($allVariantTypes['riderTable']);

				$db->db->freeDBResource($db->db->conn_id);
				$details = Util::callStoreProcedure($type = 'getPolicyVariantsFeaturesRidersDetails', $arrParams);
				if (!empty($details))
				{
					$data = Util::rearrangeDataAsPerColumnName('policyDetailsPage',$details, $tableNames);
					
					$data['company'] = reset($data['company']);
					$data['companyDetails'] = reset($data['companyDetails']);
					$data['policyDetails'] = reset($data['policyDetails']);
					
					//	update page view count
					$updateCount = Util::incrementPageViewCount('policy_master', 'page_view_count','policy_id',$data['policyDetails']['policy']['policy_id']);
					
					$claimParams = array('year_to'=>date('Y'),'company_id'=>'', 'company_type_id'=>$data['company']['company_type_id']);
					//$claimRatio = Util::getCompanyClaimRatio(array('year_to'=>"2013",'company_id'=>'', 'company_type_id'=>''));
					$claimRatio = Util::getCompanyClaimRatio($claimParams);			
					if (!empty($claimRatio))
					{
						foreach ($claimRatio as $k1=>$v1)
						{
							$num = (is_numeric($v1['claim_ratio'])) ? (int) $v1['claim_ratio'] : (is_float($var)) ? (float)$v1['claim_ratio'] : $v1['claim_ratio'] ;
							$data['claimRatio'][] = array($v1['company_display_name'],$num); 
						}
					}
					$data['claimRatioJson'] = json_encode($data['claimRatio']);
					
					//	peer comparision data
					
					$dbPrefix = Util::getdbPrefix();
									
					$param['premium_table'] = (!empty($allVariantTypes['premium_table'])) ? $dbPrefix.$allVariantTypes['premium_table'] : $dbPrefix.'annual_premium_health';
					$param['product_id'] = (isset($data['policyDetails']['policy']['product_id']) && !empty($data['policyDetails']['policy']['product_id'])) ? $data['policyDetails']['policy']['product_id'] : '' ;
					$param['sub_product_id'] = (isset($data['policyDetails']['policy']['sub_product_id']) && !empty($data['policyDetails']['policy']['sub_product_id'])) ? $data['policyDetails']['policy']['sub_product_id'] : '' ;
					$param['city'] = 590;
					$param['gender'] = 'male';
					
					$param['age'] = 25;
					if (isset($data['policyDetails']['policy']['peer_comparision_age']) && !empty($data['policyDetails']['policy']['peer_comparision_age']))
					{
						$param['age'] = explode(',', $data['policyDetails']['policy']['peer_comparision_age']);
						$param['age'] = reset($param['age']);
					}
					
					$param['members'] = !empty($data['policyDetails']['policy']['policy_composition_type']) ? ($data['policyDetails']['policy']['policy_composition_type'] == 'individual') ? '1A' : '2A' : '1A';
				
					$param['sum_assured'] = 500000;
					if (isset($data['policyDetails']['policy']['peer_comparision_coverage_amounts']) && !empty($data['policyDetails']['policy']['peer_comparision_coverage_amounts']))
					{
						$param['sum_assured'] = explode(',', $data['policyDetails']['policy']['peer_comparision_coverage_amounts']);
						$param['sum_assured'] = reset($param['sum_assured']);
					}
					//$param['sum_assured'] = 500000;
					$peerVariants = explode(',', $data['policyDetails']['policy']['peer_comparision_variants']);
					foreach (array_filter(array_values(array_flip($data['variantNames']))) as $k2=>$v2)	
						$peerVariants[] = $v2; 
							
					$param['variant_id'] = implode(',', $peerVariants); 
//var_dump($data['policyDetails']['policy']['policy_composition'], $param);
					$data['peerComparisionResult'] = Policy_variants_master_model::getAllPolicyVariantsDetails($param);
					
//var_dump($data['policyDetails']['policy']['policy_composition'], $param,$data['peerComparisionResult']);
					//	seo data
			        $data['socialSeoData'] = Util::getSocialMediaSeoData($data['policyDetails']['policy'], $url);
			        $data['seoData']['title'] = $data['policyDetails']['policy']['seo_title'];
			        $data['seoData']['keywords'] = $data['policyDetails']['policy']['seo_keywords'];
			        $data['seoData']['description'] = $data['policyDetails']['policy']['seo_description'];
			        $data['seoData']['url'] = $url;
			        $data['url'] = $url;
				}
//				Util::saveResultToCache($cacheFileName,$data);
			}
		}
		$data['disqusUrl'] = $url;	
		return $data;
	}
	
	public static function getFieldNamesOfAllTables()
	{
		$db = &get_instance();
		$dbPrefix = Util::getdbPrefix();
		$tables = $db->db->list_tables();
		foreach ($tables as $k1=>$v1)
		{
			$tableNames[$v1] = $db->db->list_fields($v1);
		}
			
		$tableNames[$dbPrefix.'insurance_company_master'][] 	= 'company_slug';
		$tableNames[$dbPrefix.'policy_master'][] 				= 'policy_slug';
		$tableNames[$dbPrefix.'policy_master'][] 				= 'policy_tax_benefits';
		$tableNames[$dbPrefix.'policy_variants_master'][] 		= 'variant_slug';
		$tableNames[$dbPrefix.'company_private_public_health'][] = 'company_pph_slug';
		$tableNames[$dbPrefix.'product'][] 						= 'product_slug';
		$tableNames[$dbPrefix.'sub_product'][] 					= 'sub_product_slug';
		$tableNames[$dbPrefix.'policy_rider_level_term'][] 		= 'rider_slug';
		$tableNames[$dbPrefix.'policy_rider_mediclaim'][] 		= 'rider_slug';
		$tableNames[$dbPrefix.'policy_rider_personal_accident'][] = 'rider_slug';
		$tableNames[$dbPrefix.'news'][]							= 'news_slug';
		$tableNames[$dbPrefix.'news'][]							= 'comment_count';
		$tableNames[$dbPrefix.'articles'][]						= 'article_slug';
		$tableNames[$dbPrefix.'guides'][]						= 'guide_slug';
		$tableNames[$dbPrefix.'master_tags'][] 					= 'tag_slug';
//var_dump($tableNames['MIC_policy_features_mediclaim']);die;		
	//	$tableNames[$dbPrefix.''][] 				= '_slug';
		return $tableNames;
	}
	
	
	public static function rearrangeDataAsPerColumnName($type= '', $details = array(), $tableNames = array())
	{
		$data = array();
		$dbPrefix = Util::getdbPrefix();
		if (!empty($details) && !empty($type))
		{
			if (empty($tableNames))
				$tableNames = Util::getFieldNamesOfAllTables();
				
			foreach ($details as $k1=>$v1)
			{	
				foreach ($v1 as $k2=>$v2)
				{			
					if ($type == 'policyDetailsPage')
					{
							//	company details
						if (in_array($k2, $tableNames[$dbPrefix.'insurance_company_master']))
							$data['company'][$v1['company_id']][$k2] = $v2;
							
						//	company features details
						if (in_array($k2, $tableNames[$dbPrefix.'insurance_company_master_detail']))
							$data['companyDetails'][$v1['company_id']][$k2] = $v2;
							
						//	policy details
						if (in_array($k2, $tableNames[$dbPrefix.'policy_master']))
							$data['policyDetails'][$v1['policy_id']]['policy'][$k2] = $v2;
							
						//	product details
						if (in_array($k2, $tableNames[$dbPrefix.'product']))	
						{
							$data['policyDetails'][$v1['policy_id']]['policy']['product'][$v1['product_id']][$k2] = $v2;
							$data['company'][$v1['company_id']]['product'][$k2] = $v2;
						}	
						
						//	subproduct details
						if (in_array($k2, $tableNames[$dbPrefix.'sub_product']))	
						{
							$data['policyDetails'][$v1['policy_id']]['policy']['sub_product'][$v1['sub_product_id']][$k2] = $v2;
							$data['company'][$v1['company_id']]['sub_product'][$k2] = $v2;
						}	
						
						// 	policy features details details
						if (in_array($k2, $tableNames[$dbPrefix.'policy_features']))	
							$data['policyDetails'][$v1['policy_id']]['features'][$k2] = $v2;
							
						// 	variant details
						if (in_array($k2, $tableNames[$dbPrefix.'policy_variants_master']))
							$data['variantDetails'][$v1['variant_id']]['variant'][$k2] = $v2;
							
						// 	variant features details
						if (isset($tableNames['variantFeatureFields']) && in_array($k2, $tableNames['variantFeatureFields']))	
							$data['variantDetails'][$v1['variant_id']]['features'][$k2] = $v2;
							
						//	rider details
						if (isset($tableNames['riderFields']) && in_array($k2, $tableNames['riderFields']))
							$data['variantDetails'][$v1['variant_id']]['rider'][$v1['rider_id']][$k2] = $v2;
						
						if (isset($v1['variant_id']))
							$data['variantNames'][$v1['variant_id']] = $v1['variant_name']; 
					}
					else if ($type == 'newsListing')
					{
						if (in_array($k2, $tableNames[$dbPrefix.'news']))	
							$data['newsDetails'][$v1['news_id']]['news'][$k2] = $v2;
							
				//		if (in_array($k2, $tableNames[$dbPrefix.'master_tags']))	
				//			$data['newsDetails'][$v1['news_id']]['tag'][$v1['tag_id']][$k2] = $v2;
						
						if (in_array($k2, $tableNames[$dbPrefix.'user_accounts']) || in_array($k2, $tableNames[$dbPrefix.'demo_user_profiles']))	
							$data['newsDetails'][$v1['news_id']]['author'][$k2] = $v2;
					}
				}		
			}
		}
		return $data;
	}
	
	public static function getCompanyClaimRatio($arrParams = array())
	{
		$data = array();
		$data = Util::callStoreProcedure('getCompanyClaimRatio', $arrParams);
		return $data;
	}
	
	public static function peerComparisionTableViewBackend($allVariants, $policy_id, $peerValue, $modelName)
	{
		$html = 	'<table cellspacing="0" class="eligibility">
						<tr>
							<th scope="col" style="border-left: 1px solid #c1dad7;">#</th>
							<th scope="col">Company Name</th>
							<th scope="col">Policy Name</th>
							<th scope="col">Variant Name</th>
							<th scope="col">Comparision Count</th>
							<th class="nobg" abbr="Configurations" scope="col" style=" border-right:0px; !important">&nbsp;</th>
						</tr>';
				$peerValue = explode(',', $peerValue);			
				if (!empty($allVariants))
				{
					$i = 1;
					foreach ($allVariants as $k1=>$v1)
					{	
						if ($v1['policy_id'] != $policy_id)
						{
							$checked = '';
							if (in_array($v1['variant_id'], $peerValue))
								$checked = 'checked';
			$html .= 		'<tr>
								<td class="spec" scope="row" valign="top" style="border-top: 1px solid #c1dad7; border-left: 1px solid #c1dad7">'.$i.'</td>
								<td class="spec" scope="row" width="334" valign="top" style="border-top: 1px solid #c1dad7;">
									'.$v1['company_display_name'].'
								</td>
								<td class="spec" scope="row" width="334" valign="top" style="border-top: 1px solid #c1dad7">';
			$html .=				(!empty($v1['policy_display_name'])) ? $v1['policy_display_name'] : $v1['policy_name'];
			$html .=			'</td>
								<td class="spec" scope="row" width="234" valign="top" style="border-top: 1px solid #c1dad7">'.$v1['variant_name'].'</td>
								<td class="spec" scope="row" width="200" valign="top" style="border-top: 1px solid #c1dad7">'.$v1['peer_comparision_count'].'</td>
								<td class="spec" scope="row" width="24" valign="top" style="border-top: 1px solid #c1dad7;">
									<label class="ui-checkbox"><input name="'.$modelName.'[peer_comparision_variants][]" type="checkbox" value="'.$v1['variant_id'].'" class="peerComparisionChk" '.$checked.'><span></span></label>
								</td>
							</tr>';		
							$i++;		
						}
					}
				}             
		$html .=	'</table>';
		return $html;
	}
	
	public static function incrementPageViewCount($tableName = '', $updateFieldName = 'page_view_count', $whereFieldName = '',$whereFieldValue = '', $count = '')
	{
		if (!empty($tableName))
		{
			$arrParams = array();
			
			$dbPrefix = Util::getDbPrefix();
			$pos = strpos($tableName, $dbPrefix);
			if ($pos === false)
				$tableName = $dbPrefix.$tableName; 
				
			$arrParams['tableName'] = $tableName;
			$arrParams['updateFieldName'] = $updateFieldName;
			$arrParams['whereFieldName'] = $whereFieldName;
			$arrParams['whereFieldValue'] = $whereFieldValue;
			$arrParams['countValue'] = $count;

			return Util::callStoreProcedure('sp_incrementPageViewCount', $arrParams);
		}
	}
	
	public static function getSocialMediaSeoData($record = array(), $url = '')
	{
		$data = '';
		if (!empty($record))
		{
			$ci =& get_instance();
			$micLogo = $ci->config->config['url_path']['company']['companyLogoUrlLarge'];
			if (empty($url))
				$url = $ci->util->getUrl();
			//	twitter
			$data .=	'<meta name="twitter:card" content="policy">
				        <meta name="twitter:site" content="@myinsuranceclub">
				        <meta name="twitter:creator" content="@myinsuranceclub">
				        <meta name="twitter:title" content="'.$record['seo_title'].'">
				        <meta name="twitter:description" content="'.$record['seo_description'].'">
				        <meta name="twitter:image" content="'.$micLogo.'">
				        <meta name="twitter:data1" content="Rating">
				        <meta name="twitter:label1" content="'.$record['rating_value'].'">
				        <meta name="twitter:data2" content="Views">
				        <meta name="twitter:label2" content="'.($record['page_view_count'] + 1).'">';
			//	facebook
			$data .=	'<meta property="og:title" content="'.$record['seo_title'].'"/>
			            <meta property="og:type" content="myinsuranceclubcom:policy comparision"/>
			            <meta property="og:url" content="'.$url.'"/>
			            <meta property="fb:app_id" content="288523881080"/>
			            <meta property="og:site_name" content="MyInsuranceClub"/>
			            <meta property="og:description" content="'.$record['seo_description'].'"/>
			            <meta property="og:image" content="'.$micLogo.'"/>
			            <meta property="og:locale" content="en_US" />
			            ';
		}
		return $data;
	}
	
	public static function getFileExtension($str)
	{
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}

	public static function getSubStringFromString($str, $limit = 120)
	{
		$return = '';
		if (!empty($str))
		{
			$return = substr(strip_tags($str), 0, $limit);
			if (strlen($str) > $limit)
				$return .= '...';
			else 
				$return = $return;
		}
		return $return;
	}
	
	
	public static function getImagedimensions($type="")
	{
		if($type=='news')
		{
			$arrImageSizes = array(
					'listing_image_300x220'=> array('width'=>'300','height'=>'220'),
					'main_image_680x309'=> array('width'=>'680','height'=>'309'),
					'thumbnail_75x75'=> array('width'=>'75','height'=>'75')
			);
			
		}
		else if($type=='users')
		{
			$arrImageSizes = array(
					'75x75'=> array('width'=>'75','height'=>'75'),
					'user_image'=> array('width'=>'75','height'=>'75'),
					'75x75'=> array('width'=>'75','height'=>'75')
			);
			
		}
		else 
		{
			$arrImageSizes = array(
					'temp'=> array('width'=>'100','height'=>'100')
			);
		}
		return $arrImageSizes;
	}
	
	public static function getDefaultSeoData($type = "", $arrSeo = array())
	{
		$data['title'] = $data['description'] = $data['keywords'] = '';
		$page = (isset($arrSeo['currentPage']) && !empty($arrSeo['currentPage'])) ? ' - Page '.$arrSeo['currentPage'].' ' : '';
		if ($type== 'newsListing')
		{
			$data['title'] = 'Indian Insurance Industry News &amp; Views'.$page;
			$data['title'] .=  '- MyInsuranceClub Newsdesk';
			$data['description'] = 'Latest Indian Insurance Industry News and Views - both life insurance and general insurance businesses. Updated daily and brought to you by MyInsuranceClub.com Newsdesk.';
			$data['keywords'] = 'insurance, india, indian, news, insurance news, myinsuranceclub.com, newsdesk';
		}
		else if ($type== 'newsByAuthor')
		{
			$authorName = (isset($arrSeo['author_name']) && !empty($arrSeo['author_name'])) ? ' by '.$arrSeo['author_name'].' ' : '';
			$keywords = (isset($arrSeo['author_name']) && !empty($arrSeo['author_name'])) ? $arrSeo['author_name'].', ' : '';
			$data['title'] = 'Insurance News';	
			$data['title'] .= $authorName;
			$data['title'] .= $page;
			$data['title'] .=  '- MyInsuranceClub Newsdesk';
			$data['description'] = 'Latest Insurance News'.$authorName.$page.'. Updated daily and brought to you by MyInsuranceClub.com Newsdesk.';
			$data['keywords'] = 'insurance, india, indian, news, '.$keywords.'insurance news, myinsuranceclub.com, newsdesk';
		}
		else if ($type== 'newsByTag')
		{
			$keywords = (isset($arrSeo['tag_name']) && !empty($arrSeo['tag_name'])) ? $arrSeo['tag_name'].', ' : '';
			$tagName = (isset($arrSeo['tag_name']) && !empty($arrSeo['tag_name'])) ? ' on '.$arrSeo['tag_name'].' ' : '';
			$data['title'] = 'Insurance News';
			$data['title'] .= $tagName;
			$data['title'] .= $page;
			$data['title'] .=  '- MyInsuranceClub Newsdesk';
			$data['description'] = 'Latest Insurance News'.$tagName.$page.'. Updated daily and brought to you by MyInsuranceClub.com Newsdesk.';
			$data['keywords'] = 'insurance, india, indian, '.$keywords.'news, insurance news, myinsuranceclub.com, newsdesk';
		}
		else
		{
			$data['title'] = 'Compare Insurance Policies and Plans in India | MyInsuranceClub.com';
			$data['description'] = 'Compare and get free quotes for the best life insurance, health insurance, travel insurance, car and auto insurance plans, policies and schemes in India offered by different insurance companies only at MyInsuranceClub.com';
			$data['keywords'] = 'Compare insurance, best life insurance, best health insurance, cheap car insurance, auto insurance quote, cheap travel insurance, affordable insurance, best insurance policy, insurance companies in India';
		}
		return $data;
	}
	
	public static function getNumbersFromString($str = '', $type = '')
	{
		$matches = array();
		if (!empty($str))
		{
			if ($type == 'strWithSpaces')
			{
				preg_match_all('/\d{1,}/',$str,$matches);
			}
			else 
			{
				preg_match_all('/\d{1,}/',$str,$matches);
			}
		}
		return $matches;
	}
	
	public static function getCharactersFromString($str = '', $type = '')
	{
		$matches = array();
		if (!empty($str))
		{
			$str = explode(' ', $str);
			foreach ($str as $k1=>$v1)
			{
				if (!is_integer($v1))
					$matches[] = $v1;
			}
		}	
		return $matches;
	}
	
	public static function array_overlay($a1,$a2)
	{
		if (is_array($a1) && is_array($a2))
		{
			foreach($a1 as $k => $v) 
			{
				if(!array_key_exists($k,$a2)) continue;
				if(is_array($v) && is_array($a2[$k]))
				{
					if (!empty($v))				
						$a1[$k] = Util::array_overlay($v,$a2[$k]);
					else 	
						$a1[$k] = Util::array_overlay($a2[$k], $v);				
				}
				else
				{
					$a1[$k] = $a2[$k];
				}
			}
			return $a1;
		}
		else 
			return $a1;
	}
}

// END Util class

/* End of file Util.php */
/* Location: ./application/libraries/Util.php */
