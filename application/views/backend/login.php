
<html>

<head>

<?php
	
	$system_name	=	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	$system_title	=	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;

	$hash = $this->input->post('hash_app');

	$prompt['status'] = '';

	if( $hash != null )
	{
		$get_app = $this->db->where('code', $hash)->get('app_hash')->result_array();

		if($get_app != null)
		{
			if($this->input->post('accept'))
			{	
				$appdata1 = array(
		        'name'		=> $this->input->post('full_name'),
		        'birthday'	=> $this->input->post('b_date'),
		        'gender'	=> $this->input->post('gender'),
		        'nat_id'	=> $this->input->post('nat_id'),
		        'loc_id'	=> $this->input->post('loc_id'),
		        'address'	=> $this->input->post('address'),
		        'email'		=> $this->input->post('email'),
		        'phone'		=> $this->input->post('contact'),
		        'password'	=> substr( $get_app[0]['code'] , 0, 12)
		        );

		        $appdata2 = array(
		        'ept_id'		=> $this->input->post('ept'),
		        'ept_score'		=> $this->input->post('ept_score'),
		        'skype_id'		=> $this->input->post('skype'),
		        'isp_id'		=> $this->input->post('isp'),
		        'isp_spd_id'	=> $this->input->post('isp_spd'),
		        'last_school'	=> $this->input->post('last_sch'),
		        'work_exp'		=> $this->input->post('exp'),
		        'speak_other'	=> $this->input->post('spk_other')
		        );

				$this->applicant_model->processApplicant($get_app[0]['code'], $appdata1, $appdata2,'accepted');

				$prompt['status'] = 'Applicant Accepted';
				$prompt['div']  = 'accepted';
				$prompt['css'] = "alert-box accepted";
				$prompt['font_size'] = "font-size:32px;";
			}
			else
			{

				$appdata1 = array(
		        'name'		=> $this->input->post('full_name'),
		        'email'		=> $this->input->post('email'),
		        'password'	=> substr( $get_app[0]['code'] , 0, 12)
		        );
				$appdata2 = array();

				$this->applicant_model->processApplicant($get_app[0]['code'], $appdata1, $appdata2,'rejected');

				$prompt['status'] = 'Applicant Rejected';
				$prompt['div']  = 'rejected';
				$prompt['css'] = "alert-box rejected";
				$prompt['font_size'] = "font-size:32px;";
			}
		}else
		{
			$prompt['status'] = 'Applicant<br>already proccess';
			$prompt['div']  = 'warning';
			$prompt['css'] = "alert-box warning";
			$prompt['font_size'] = "font-size:32px;";
		}

		$promp_request = "<script>
					var statusPrompt = function()
						{
	    					$( 'div.". $prompt['div'] ."' ).fadeIn( 300 ).delay( 3000 ).fadeOut( 400 );
						};
						setTimeout(statusPrompt, 1000);

					var closeWindow = function()
						{
	    					window.close();
						};
						setTimeout(closeWindow, 5500);
					</script>";
		echo $promp_request;


	} // if hash not null end

	if ($this->session->userdata('application_sent') == 1)
	{
		$this->session->set_userdata('application_sent', '0');

		$prompt['status'] = 'Application sent.<br>please check your email<br>and skype often for a potential interview.<br>Thank you and good luck!';
		$prompt['div']  = 'accepted';
		$prompt['css'] = "alert-box accepted";
		$prompt['font_size'] = "font-size:24px;";

		$promp_request = "<script>
					var statusPrompt = function()
						{
	    					$( 'div.". $prompt['div'] ."' ).fadeIn( 300 ).delay( 10000 ).fadeOut( 400 );
						};
						setTimeout(statusPrompt, 1000);
					</script>";
		echo $promp_request;
	}
	else if($this->session->userdata('application_not_sent') == 1)
	{
		$this->session->set_userdata('application_not_sent', '0');

		$prompt['status'] = 'Application failed to sent.<br> The system might be having some difficulty<br>Or your internet connection is having a problem<br>sending your application form.<br>Please try again later. <br>Sorry for the inconvenience.';
		$prompt['div']  = 'rejected';
		$prompt['css'] = "alert-box rejected";
		$prompt['font_size'] = "font-size:24px;";

		$promp_request = "<script>
					var statusPrompt = function()
						{
	    					$( 'div.". $prompt['div'] ."' ).fadeIn( 300 ).delay( 10000 ).fadeOut( 400 );
						};
						setTimeout(statusPrompt, 1000);
					</script>";
		echo $promp_request;

	}

?>
	
<title><?php echo $system_title;?></title>
	<link rel="stylesheet" type="text/css" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">
</head>

<script type='text/javascript' src='assets/js/jquery-3.1.1.js'></script>
<script type='text/javascript' src='assets/js/jquery-ui-1.12.1/jquery-ui.js'></script>
<script type="text/javascript" src='assets/js/registration.js'></script>

<script type="text/javascript">

	var baseurl = '<?php echo base_url();?>';

</script>

<body>
	<div class='wrapper'>
		<div id='signin' class='signin'>
			<div class='signin-box'>
				<div class='signin-header'>
					<img src="uploads/logo.png">
					<span></span>
					<span onclick='hideConfirm("signin")' class='fa fa-close'></span>
				</div>
				
				<div class='signin-body'>

				<!--Login Form-->
				<form method="post" role="form" id="form_login">
				
					<div class="form-group">
						
						<div class="input-group">
							<div class="input-group-addon">
								<i class="entypo-user"></i>
							</div>
							<input type="text" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" data-mask="email" />
						</div>
					</div>
					
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="entypo-key"></i>
							</div>
							<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
						</div>
					</div>
					
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block btn-login">
							<i class="entypo-login"></i>
							Login
						</button>
					</div>
				</form>

					<div class="login-bottom-links">
						<a href="<?php echo base_url();?>index.php?login/forgot_password" class="link">
							<?php echo get_phrase('forgot_your_password');?> ?
						</a>
					</div>

				</div>
			</div>
		</div>
		<div class='header'>
			<div class='header-top'>
				<div>
					<ul>
						<li>		
							<div class='<?php echo $prompt['css'];?>' style='<?php echo $prompt['font_size'];?>'> <?php echo $prompt['status'];?> </div>
						</li>
						<li><a href="">HOME</a></li>
						<li><a href="">ABOUT US</a></li>
						<li><a href="">FEES</a></li>
						<li><a href="book.php">BOOK A CLASS</a></li>
						<li><a onclick='showConfirm("signin")'>SIGN IN</a></li>
					</ul>

				</div>
				<div>
				</div>
				<div>
				</div>
				<div>
				</div>
			</div>
			<div class='header-bot'>
				<div class='header-bot-line'>
					<div>
					</div>
					<div>
					</div>
				</div>
				<div class='header-left'>
					<div class='header-title'>
						<div>"Those who know nothing of foreign languages, <br>know nothing of their own." <span>Johann Wolfgang von Goethe</span></div>
						<div>
							<?php 
								echo $system_name;
							?>
						</div>
						<div>Integrated Online English Learning Platform</div>
						<div>LAINIC International Ltd. is an online English learning platform  
							based in Manila, Philippines. Caters foudents interested and 
							enthusiastic in learning English Language. LAINIC International Ltd. 
							is equipped with  selected professional and experienced teachers from 
							the Philippines. Founded by Nickie Mossman,  a known professional ESL 
							educator who started from different ESL companies.</div>
						<button>APPLY NOW</button>
					</div>
					<div class='header-left-line'>
						<div></div>
						<div></div>
					</div>
					<div class='header-border'>
						<div></div>
						<div></div>
					</div>
				</div>
				<div class='header-right'>
					<div class='header-visual'>
						<div class='header-chat-head-1'>
							<img src="uploads/img/c1.jpg">
							<div class='balloon-point-1'>
							</div>
							<div class='balloon-body-1'>
								<p>This is the best online english school on the Internet!</p>
							</div>
						</div>
						<div class='visual-line'></div>
						<div class='header-chat-head-2'>
							<div class='balloon-body-2'>
								<p>I would recommend this site to all my friends because it makes my english skills really good.</p>
							</div>
							<img src="uploads/img/c2.jpg">
						</div>
						<div class='balloon-point-2'>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class='about'>
			<div class='about-top'>
				<div>
				</div>
				<div>
				</div>
			</div>
			<div class='about-top-line'>
				<div></div>
				<div></div>
			</div>
			<div class='about-body'>
				<div>LAINIC INTERNATIONAL <span>LTD.</span></div>
				<div>ONLINE ENGLISH SCHOOL</div>
				<div>
					LAINIC International Ltd. offers variants of effective lesson 
					materials  such as TOEFL, TOEIC, IELTS, Business, Pronunciation, 
					etc. that the Students and Teachers will love and enjoy. Students 
					can also choose free-talk for their lesson. Please click the button 
					below to browse lesson materials you would like to use.
					<br><br>
					Teaching business people how to communicate effectively. 
					In the world of business, there are some vocabularies that student must learn and apply.  
					<br><br>
					Strengthen your English and get the best TOEFL score.
					Preparations can be done from student's end, but here in 
					LAINIC we would highly recommend you to book a review lesson. 
					That way, the teacher will share you the best strategies and 
					recommendations. The teacher will also give you an examination 
					to test how much you have learned.
					<br><br>
					All classes are conducted through Skype, and WeChat. Students 
					can choose their lesson materials through our website or email 
					us at lainic.edu@yahoo.com or call us at (63) 46-423-2768. 
					Add us on skype: nickiemossman
				</div>
				<button>Apply now!</button>
			</div>
			<div class='about-bot'>
				<div>
				</div>
			</div>
			<div class='about-bot-line'>
				<div></div>
				<div></div>
			</div>
		</div>
		<div class='application'>
			<div class='application-overlay'>
				<div class='application-form'>
					<div class='application-form-top'>
						<div></div>
						<div></div>
						<div>
							<div class='application-form-nav'>
								<div class='nav-1'>
									<span><div id='c1' class='uncheck'></div></span>
									<span></span>
								</div>
								<div class='nav-2'>
									<span></span>
									<span><div id='c2' class='uncheck'></div></span>
									<span></span>
								</div>
								<div class='nav-3'>
									<span></span>
									<span><div id='c3' class='uncheck'></div></span>
								</div>
							</div>
						</div>
					</div>
					<div class='application-form-body'>
						<p>*FILL IN ALL THE FIELDS TO APPLY FOR A HOME-BASED ONLINE ENGLISH TEACHING JOB.</p>
						<form action="<?php echo base_url() . 'index.php?email/send_applicant_info/';?>" method='post' id='form_login'>
							<div id='afp1' class='application-form-page-1'>
								<div class='application-row'>
									<input name='fname' placeholder='FIRST NAME...' class='req1 application-input-1'>
									<input name='lname' placeholder='LAST NAME...' class='req1 application-input-1'>
									<input name='mname' placeholder='MIDDLE NAME...' class='req1 application-input-1'>
								</div>
								<div class='application-row'>
									<input name='birth' placeholder='BIRTHDATE...' type='date'  class='req1 application-input-1'>
									<select name='gender' class='req1 application-input-1'>
										<option value=''>GENDER...</option>
										<option value='Male'>MALE</option>
										<option value='Female'>FEMALE</option>
									</select>

									<select name="nationality" class="req1 application-input-1">
		                              <option value="">SELECT NATIONALITY</option>
		                              <?php 
											$nat = $this->db->get('nationality')->result_array();
											foreach($nat as $row3):
									  ?>
		                                		<option value="<?php echo $row3['nat_id'];?>">
													<?php echo $row3['nationality'];?>
		                                        </option>
			                                <?php
											endforeach;
										    ?>

		                            </select>
								</div>
								<div class='application-row'>
									
									<select name="location" class="req1 application-input-1">
		                              <option value="">SELECT LOCATION</option>
		                              <?php 
											$loc = $this->db->get('form_loc')->result_array();
											foreach($loc as $row3):
									  ?>
		                                		<option value="<?php echo $row3['loc_id'];?>">
													<?php echo $row3['loc_name'];?>
		                                        </option>
			                                <?php
											endforeach;
										    ?>
		                            </select>

									<input name='address' placeholder='COMPLETE ADDRESS...' class='req1 application-input-3'>
								</div>
								<div class='application-row'>
									<input id="skype" name='skype' placeholder='SKYPE ID...' class='req1 application-input-1'>
									<div id='valid' style='float:left; overflow: hidden;  position:fixed;'></div>	
									<input name='email' type='email' placeholder='E-MAIL ADDRESS...' class='req1 application-input-1'>
									<input name='mobile_no' type='number' placeholder='MOBILE NUMBER...' class='req1 application-input-1'>
								</div>
								<a id='n1' onclick='changeAppPage("afp2")' class='application-btn disabled-btn'>
									NEXT
								</a>
							</div>
							<div id='afp2' class='application-form-page-2'>
								<div class='application-row'>
									<input name='tax_id' placeholder='TAX IDENTIFICATION NUMBER...' class='req2 application-input-1'>
									
									<select name="isp" class="req2 application-input-1" data-validate="required">
		                              <option value="">SELECT ISP</option>
		                              
			                              	<?php 
												$isp = $this->db->get('form_isp')->result_array();
												foreach($isp as $row3):
										  	?>
		                                		<option value="<?php echo $row3['isp_id'];?>">
													<?php echo $row3['isp_name'];?>
		                                        </option>

			                                <?php
											endforeach;
										    ?>

		                            </select>
									<select name="isp_spd" class="req2 application-input-1" data-validate="required">
		                              <option value="">ISP SPEED</option>
		                              <?php 
											$isp_spd = $this->db->get('form_isp_spd')->result_array();
											foreach($isp_spd as $row3):
												?>
		                                		<option value="<?php echo $row3['isp_spd_id'];?>">
													<?php echo $row3['speed'];?>
		                                        </option>
			                                <?php
											endforeach;
										    ?>
		                            </select>
								</div>
								<div class='application-row'>
									<input name='last_school_attended' placeholder='LAST SCHOOL ATTENDED...' class='req2 application-input-2'>
									<input name='work_experience' placeholder='WORK EXPERIENCE...' class='req2 application-input-2'>
								</div>
								<div class='application-row'>
									<select name="ept" class="req2 application-input-1" data-validate="required">
		                              <option value="">ENGLISH PROFICIENCY TEST</option>
		                              <?php 
											$ept = $this->db->get('form_ept')->result_array();
											foreach($ept as $row3):
									  ?>
		                                		<option value="<?php echo $row3['ept_id'];?>">
													<?php echo $row3['type'];?>
		                                        </option>
			                                <?php
											endforeach;
										    ?>

		                            </select>
									<input name='ept_score' type='number' placeholder='SCORE...' class='req2 application-input-1'>
									<select name='foreign_language' class='req2 application-input-1'>
										<option value=''>SPEAK OTHER FOREIGN LANGUAGE?</option>
										<option value='1'>YES</option>
										<option value='0'>NO</option>
									</select>
								</div>	
								<div class='application-row'>
								</div>
								<a id='n2' onclick='changeAppPage("afp3")' class='application-btn disabled-btn'>
									NEXT
								</a>
								<a id='p1,' onclick='changeAppPage("afp1")' class='application-btn'>
									PREVIOUS
								</a>
							</div>
							<div id='afp3' class='application-form-page-3'>
								<div class='application-row'>
									<div class='tac'>
										<p>Terms and Conditions</p>
 									
										<p>Educators’ Conduct</p>
										 
										<span>a. Obligations of the Educators</span>

										<div>The educators shall provide a computer-based online tutorial services to the company’s foreign students/clients to the best of his/her ability with due care, skill and expertise while maintaining the highest degree of propriety and professionalism in providing such services and, at all times, carrying out their duties in accordance with the applicable law, rules and regulations of the company. Without limiting the generality of the foregoing, the following are the non-exclusive and non-exhaustive specific obligations of the tutors:</div>

										<div>I.	To provide the company true, accurate, current and complete information about their personal profile and maintain and regularly update his/her personal profile to keep it true, accurate, and precise</div>
										<div>II.	To refrain from using false identities, pseudonyms and aliases,  misrepresenting himself/herself as being affiliated with a third party or any entity,  uploading photographs of celebrities or other famous people in his/her tutor account profile and feigning his/her age, identity and current or previous positions and qualifications;</div>
										<div>III.	To attend training/coaching sessions provided by the company for the improvement of the quality of service provided to the students/clients and actively participate therein;</div>
										<div>IV.	To regularly and punctually submit his/her schedule of committed time slots and to be ready, punctual, and available to conduct classes during all his/her committed time slots.</div>
										<div>V.	To login to educator’s and communication application account and click the ready button at least ten (10) minutes before the committed time slot. The failure of the educator to login on time or the cancellation of classes without prior notice shall warrant the imposition of penalties or the deduction of fees against the educator.</div>
										<div>VI.	To refrain from using an account issued by the company to another educator in logging into communication application , the company’s website or any other program, or allowing another teacher or any other person to use the educator’s account;</div>
										<div>VII.	To refrain from logging into the communication application using the account issued by the company outside the time required by the company;</div>
										<div>VIII.	The educator is not allowed to use mobile phones during class. Please make sure to turn your phone off/change to silent mode.</div>
										 
										<span>b. Contacting Operations Support Department (Operations)</span>
										<div>The Operations Support Department is an important entity of the company tasked to monitor educators’ schedules, to check their attendance, to monitor the cancellation of classes, and to ensure that educators start and end their classes on time.
										Basically, educators should contact the Operations Support via communication application. In case educators have internet connection problems, trouble requiring technical support or power outages, please contact Operations Support at once.</div>
										 
										 
										<span>c. Educator-Student Relationship</span>
										<div>The relationship of the educators and students are strictly professional. Educators and students are prohibited to develop personal relationship with each other to maintain the integrity and credibility of the company. With this, educators are not allowed to make any personal transaction(s) with their students beyond the knowledge of the company.</div>
										<div>The following are the detailed restrictions:</div>
										<div>a)    NO giving and receiving of cell phone or phone number or residential address.</div>
										<div>b)    NO taking of pictures of students.</div>
										<div>c)    NO posting of student’s picture or documents that could show his or her information on Facebook or other websites.</div>       
										<div>d.	   Educator-Staff Relationship</div>
										 
										<div>The support staff is here to assist you with any concerns you may have.</div>
										<div>Available support staff are as follows:</div>
										<div>1.	Operations support</div>
										<div>a.	Handles class cancellations, assists with finding Skype ID’s. </div>
										<div>2.	Teacher support</div>
										<div>b.	Handles quality of classes, assists educators with any query they may have related to classes, regulations, materials etc.</div>
										<div>The staff will always act courteously towards teachers. Any abuse from any of the team members should be reported to management. At the same time, we require that you also maintain a professional attitude while interacting with any and all staff members. Sanctions will be applied for verbal abuse incurred on or by staff members.</div>
										               
										<p>Payment and Penalties</p>
										 
										<span class='bold'>1.	Possible salary deductions:</span>
										

										<span class='bold'>Lesson cancellation penalties</span>
										

										<ul>										
											<li>•	Each cancelled class implies a cancellation fee that will be deducted from your salary. </li>
											<li>•	If you inform Operations Support about the cancellation at least 30 minutes before the class, it will be tagged as WITH notice. Otherwise, it will be tagged as WITHOUT notice. </li>
										</ul>
										<span>Step up cancellation rules for Filipino teachers:</span>
										<ul>
											<li>•	The same cancellation penalties will apply to the 1st up to the 5th cancellation in a cut-off - Php20 for “with notice” and twice the teacher’s rate for “without notice”.</li>
											<li>•	However, the 6th to 10th cancellations in a cut-off will have graver penalties - same as the teacher’s rate for “with notice” and thrice the teacher’s rate for “without notice”. In addition, once the 6th cancellation is reached, the increased penalty will also apply to the first five (5) incurred.</li>
											<li>•	The 11th cancellation will then compel the Management to impose a 7-day suspension (that can be carried out anytime) or worst, termination. This is aside from the increased penalties, same as the penalties for six (6) to ten (10) cancellations in a cut-off.</li>
											<li>•	In times of typhoons and regional-wide blackouts, the cancellation penalties will not increase as long as you’ve submitted a report with proof (from VECO, MERALCO, etc.) to (LAINIC EMAIL ADDRESS)  within 24 hours after the cancellation. </li>
										</ul>
										 
										<span>Step up cancellation rules for International teachers:</span>
										<ul> 
											<li>•	For with notice cancellations, if during 1 cutoff you have less than 4% cancelled classes the fee will be 0.6$ per cancellation (just as before)</li>
										    <li>Any class cancelled over the 4% threshold will come at a fee of $1.8.</span>
											<li>•	For without notice cancellations, if during 1 cutoff you have less than 1% cancelled the classes the will be $1 per class.</li>
										    <li>Any class cancelled without notice over the threshold will come at a fee of $3.</span>
										</ul> 
										 
										<span class='bold'>Penalty for non-submitted or late submission of lesson notes</span>
										 
										<div>Teachers will not get paid for the conducted classes if they do not submit the Lesson Notes for it within 24 hours.</div>

										<div>Dress Code</div>
										<div>The educator is strongly encouraged to follow the dress code during working time. It is to protect the educator from any unwelcoming acts, including sexual harassment by the student.</div>
										 
										<div>a. Casual, plain, or collared shirts are recommended.</div>
										<div>b. Avoid wearing any clothes with offensive logos, pictures or words.</div>
										<div>c. Tube tops, off shoulder or spaghetti strapped are not suitable for conducting classes. You are recommended to wear a jacket, blazer or blouse over it.</div>

										<p>Quality and Lesson Complaints</p>
										 
										<div>In case there are connection issues on your end, you might get a quality complaint from your student.
										This will be solved by the TS or the Quality Management Department after having a Skype check with you.</div>
										 
										<div>If the students have a complaint about the way the class was conducted, the teacher will be again contacted for a coaching from the QMD. After reviewing class recordings and all relevant proof, if the complaint is considered valid, the appropriate sanction will be applied.</div>
										 
										<div>The sanction flow is as follows:</div>
										 
										<div>1.	First complaint: First verbal warning</div>
										<div>2.	Second complaint: Second verbal warning</div>
										<div>3.	Third complaint: Third verbal warning</div>
										<div>4.	Fourth complaint: Fourth verbal warning</div>
										<div>5.	Fifth complaint: First written warning</div>
										<div>6.	Sixth complaint: Final written warning</div>
										<div>7.	Seventh Complaint: Termination</div>

									</div>
								</div>
								<input name='apply' type='submit' class='application-submit' value='AGREE'>
								<a  onclick='changeAppPage("afp2")' class='application-btn'>
									PREVIOUS
								</a>
							</div>

						</form> <!-- Registration form-->

					</div>
				</div>
			</div>
		</div>
		<div class='contact'>
			<div class='contact-overlay'>
				<div class='contact-top-line'>
					<div></div>
					<div></div>
				</div>
				<div class='contact-top'>
					<div></div>
					<div></div>
				</div>
				<div class='contact-body'>
					<div class='contact-column'>
						<img src="uploads/img/owner.jpg">
						<span>
							We are pleased to introduce the newest online English 
							teaching and learning platform that will cater to students
							around the globe. Through further researches and deep 
							contemplation, LAINIC was finally born. We named it 
							LAINIC which stands for Language Information Clinic.
 							<br><br>
							Our Goal is to interconnect different races in one language... English. 
							LAINIC is an integrated Online English learning Platform that is equipped 
							with professional and experienced educators.
							<br><br>
							Our motto "Speaking English is my road to success" is our way of 
							motivating our students
						</span>
					</div>
					<div class='contact-column'>
						<span>
							and teachers who wish to pursue their dreams 
							of achieving success at work or travelling to other countries.
							<br><br>
							We are proud to give both our students and educators an opportunity 
							to meet people from different countries and to broaden their horizon 
							using their English skills. Wherever and whoever you are, we are your 
							partner to your road to success.
							<br><br>
							With enthusiasm we will continue growing LAINIC in different corners 
							of the globe.
						</span>
						<button>CONTACT NOW!</button>
					</div>
					<div class='contact-column'>
						<div class='contact-title'>
							Contact Us
						</div>
						<div class='contact-bottom'>
							<div></div>
							<div></div>
						</div>
						<div class='contact-bottom-line'>
							<div></div>
							<div></div>
						</div>
					</div>
				</div>
				<div class='contact-footer'>
					<div class='contact-footer-left'>
						<div class='contact-footer-left-top'>
							<div></div>
							<div></div>
						</div>
						<div class='contact-footer-left-bottom'>
						</div>
					</div>
					<div class='contact-footer-right'>
						<p>Lainic LTD</p>
						<p>ONLINE ENGLISH SCHOOL</p>
					</div>
				</div>
				<div class='contact-footer-bottom'>
					<ul>
						<li>HOME</li>
						<li>ABOUT US</li>
						<li>FEES</li>
						<li>BOOK A CLASS</li>
						<li>SIGN IN</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

<script src="assets/js/gsap/main-gsap.js"></script>
<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/joinable.js"></script>
<script src="assets/js/resizeable.js"></script>
<script src="assets/js/neon-api.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/neon-login.js"></script>
<script src="assets/js/neon-custom.js"></script>
<script src="assets/js/neon-demo.js"></script>

</body>
</html>

