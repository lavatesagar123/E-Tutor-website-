<?php
	session_start();
	date_default_timezone_set('Asia/Kolkata');
		$project_title  =   "PATHFINDERS";
		class login_function
		{
			private $con;
			
			function __construct()
			{
				$this->con = new mysqli("localhost","root","","bravemy8_pathfinders_new");
				//$this->con	=	new mysqli("localhost","pathfin1_new","pass***778**2@#$%","pathfin1_new");
				//$this->con	=	new mysqli("localhost","bravemy8_admin_db","q};S%UAZ8,%K","bravemy8_pathfinders_new");
			}
			
				function  get_password_from_mobile_number($mobile_number){
      if($stmt = $this->con->prepare("SELECT `password` FROM `entry` WHERE `mo_no`=?")){
      $stmt->bind_param("s",$mobile_number);
      $stmt->bind_result($reg_password);
      if($stmt->execute()){
            if($stmt->fetch()){
                  return $reg_password;
            }
      
      }
      return false;


      
      }
      }	
	  
			function add_new_registration($var_full_name,$var_mo_no,$var_address,$var_email,$var_password)
		  {
				
				$current_date = date("Y-m-d");
				$current_time = date("h:i:s a");
				if($stmt = $this->con->prepare("INSERT INTO `entry`( `full_name`, `mo_no`, `address`, `email`, `password`, `date`, `time`)  VALUES (?,?,?,?,?,?,?)"))
				{
					  $stmt->bind_param("sssssss",$var_full_name,$var_mo_no,$var_address,$var_email,$var_password,$current_date,$current_time);

					  if($stmt->execute()){
							return true;
					  }
					  return false;
				}
		  }
			
			function get_password_from_user_name($email)
			{
				if($stmt_select = $this->con->prepare("Select `password` from `admin` where `admin_name` = ? "))
				{	
					$stmt_select->bind_param("s",$email);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function change_user_password($email,$password)
			{ 
				$date = date("Y-m-d");
				$time = date("H:i:s A");
			
				if($stmt_select = $this->con->prepare("update `admin` set `password`='".$password."' where `admin_name` = ?"))
				{
					$stmt_select->bind_param("s",$email);				
				
					if($stmt_select->execute())
					{					
						return true;
					}
						return false;
				}
			}
			function new_images($description,$actual_image_name)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `gallery`(`description`,`images`, `date`, `time`) VALUES (?,?,?,?)"))
				{
					$stmt_insert->bind_param("ssss",$description,$actual_image_name,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			
			function new_slider_images($actual_image_name)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `slider_images`(`images`, `date`, `time`) VALUES (?,?,?)"))
				{
					$stmt_insert->bind_param("sss",$actual_image_name,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			
		
			
			
			function get_all_gallery_images()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`images`,`description` FROM `gallery` ORDER BY `id` DESC"))
				{	
					$stmt_insert->bind_result($id,$images,$description);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							
							$details[$counter][1]	=	$images;
							$details[$counter][2]	=	$description;
						
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
	
		
			function get_all_slider_images()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`images` FROM `slider_images`"))
				{	
					$stmt_insert->bind_result($id,$images);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$images;
						
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			
			
			function delete_gallery_images($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `gallery` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			
		
			function delete_slider_images($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `slider_images` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			
			
			function new_downloads_images($department,$title,$actual_image_name)
			{	
		
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `downloads`(`department`,`title`,`images`, `date`, `time`) VALUES (?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("sssss",$department,$title,$actual_image_name,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			
			function add_order($payment_type,$payment_amount,$payment_description,$tut_id,$purchase_by)
			{
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `orders`(`tuto_id`, `fees`, `purchase_by`, `payment_method`, `payment_by_id`, `date`, `time`) VALUES (?,?,?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("sssssss",$tut_id,$payment_amount,$purchase_by,$payment_type,$payment_description,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
					else{
						echo $stmt_insert->error;
					}
					return false;
				} 	
			}
			
			
			function new_downloads_category($title)
			{		
			
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `downloads_category`(`title` ,`date`, `time`) VALUES (?,?,?)"))
				{
					$stmt_insert->bind_param("sss",$title,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_all_downloads_images()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`department`,`title`,`images` FROM `downloads` ORDER BY `id` DESC"))
				{	
					$stmt_insert->bind_result($id,$category,$title,$images);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$category;
							$details[$counter][2]	=	$title;
							$details[$counter][3]	=	$images;
						
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function delete_downloads_images($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `downloads` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
		
			function add_feedback($name,$email,$phone,$feedback,$status,$actual_image_name)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `feedback`(`name`,`email`,`contact`,`feedback`, `date`, `time`,`status`,`profile`) VALUES (?,?,?,?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("ssssssss",$name,$email,$phone,$feedback,$date,$time,$status,$actual_image_name);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_all_feedback()
			{	
				$status = "pending";
				if($stmt_insert = $this->con->prepare("SELECT `id`,`name`,`email`,`contact`,`feedback`,`status`,`profile` FROM `feedback` where `status`= ?"))
				{	
					$stmt_insert->bind_param("s",$status);
					$stmt_insert->bind_result($id,$name,$email,$contact,$feedback,$status,$profile);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$name;
							$details[$counter][2]	=	$email;
							$details[$counter][3]	=	$contact;
							$details[$counter][4]	=	$feedback;
							$details[$counter][5]	=	$status;
							$details[$counter][6]	=	$profile;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function delete_feedback($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `feedback` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function get_all_feedback_for_show()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`name`,`email`,`contact`,`feedback`,`date`,`time` FROM `feedback`"))
				{	
					$stmt_insert->bind_result($id,$name,$email,$contact,$feedback,$date,$time);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$name;
							$details[$counter][2]	=	$email;
							$details[$counter][3]	=	$contact;
							$details[$counter][4]	=	$feedback;
							$details[$counter][5]	=	$date;
							$details[$counter][6]	=	$time;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
		
			function get_facebook_link()
			{
				if($stmt_select = $this->con->prepare("Select `link` from `social_media` where `name` = 'facebook' "))
				{	
					$stmt_select->bind_result($result_link);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_link;
						}
					}
							return false;
				}
			}
			function get_twitter_link()
			{
				if($stmt_select = $this->con->prepare("Select `link` from `social_media` where `name` = 'twitter' "))
				{	
					$stmt_select->bind_result($result_link);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_link;
						}
					}
							return false;
				}
			}
			function get_linked_link()
			{
				if($stmt_select = $this->con->prepare("Select `link` from `social_media` where `name` = 'linked in' "))
				{	
					$stmt_select->bind_result($result_link);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_link;
						}
					}
							return false;
				}
			}
			function get_google_link()
			{
				if($stmt_select = $this->con->prepare("Select `link` from `social_media` where `name` = 'google+' "))
				{	
					$stmt_select->bind_result($result_link);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_link;
						}
					}
							return false;
				}
			}
			function get_youtube_link()
			{
				if($stmt_select = $this->con->prepare("Select `link` from `social_media` where `name` = 'you tube' "))
				{	
					$stmt_select->bind_result($result_link);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_link;
						}
					}
							return false;
				}
			}
			function get_telegram_link()
			{
				if($stmt_select = $this->con->prepare("Select `link` from `social_media` where `name` = 'telegram' "))
				{	
					$stmt_select->bind_result($result_link);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_link;
						}
					}
							return false;
				}
			}
			function get_phone_link()
			{
				if($stmt_select = $this->con->prepare("Select `link` from `social_media` where `name` = 'phone' "))
				{	
					$stmt_select->bind_result($result_link);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_link;
						}
					}
							return false;
				}
			}
			function update_social_media($facebook)
			{	
				if($stmt_insert = $this->con->prepare("UPDATE `social_media` set `link` = ? Where `name` = 'facebook' "))
				{
					$stmt_insert->bind_param("s",$facebook);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function update_social_media1($twitter)
			{	
				if($stmt_insert = $this->con->prepare("UPDATE `social_media` set `link` = ? Where `name` = 'twitter' "))
				{
					$stmt_insert->bind_param("s",$twitter);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function update_social_media2($facebook)
			{	
				if($stmt_insert = $this->con->prepare("UPDATE `social_media` set `link` = ? Where `name` = 'linked in' "))
				{
					$stmt_insert->bind_param("s",$facebook);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function update_social_media3($twitter)
			{	
				if($stmt_insert = $this->con->prepare("UPDATE `social_media` set `link` = ? Where `name` = 'google+' "))
				{
					$stmt_insert->bind_param("s",$twitter);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function update_social_media4($twitter)
			{	
				if($stmt_insert = $this->con->prepare("UPDATE `social_media` set `link` = ? Where `name` = 'you tube' "))
				{
					$stmt_insert->bind_param("s",$twitter);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function update_social_media5($telegram)
			{	
				if($stmt_insert = $this->con->prepare("UPDATE `social_media` set `link` = ? Where `name` = 'telegram' "))
				{
					$stmt_insert->bind_param("s",$telegram);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function update_visitor($counter)
			{	
				if($stmt_insert = $this->con->prepare("UPDATE `visitors` set `total_counter` = ? "))
				{
					$stmt_insert->bind_param("s",$counter);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_counter()
			{
				if($stmt_select = $this->con->prepare("Select `total_counter` from `visitors` "))
				{	
					$stmt_select->bind_result($result);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result;
						}
					}
							return false;
				}
			}
			
		
			/*Testimonial pending*/
		
			function pending_testimonial($pending_id)
			{	
				$status="approved";
				
				if($stmt_update = $this->con->prepare("UPDATE `feedback` set `status` = ? Where `id`=?"))
				{
					$stmt_update->bind_param("si",$status,$pending_id);
					
					if($stmt_update->execute())
					{
						return true;
					}
						return false;
				} 	
			}
		
		
		function get_all_approved_testinomials()
			{ 
				$status="approved";
				if($stmt_select = $this->con->prepare("SELECT `id`,`name`,`email`,`contact`,`feedback`,`status`,`profile` FROM `feedback` where `status` = ?"))
				{	
					$stmt_select->bind_param("s",$status);
					$stmt_select->bind_result($id,$name,$email,$contact,$feedback,$status,$profile);
					
					if($stmt_select->execute())
					{ 
							$counter	=	0;
							$details	=	array();
						while($stmt_select->fetch())
						{ 
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$name;
							$details[$counter][2]	=	$email;
							$details[$counter][3]	=	$contact;
							$details[$counter][4]	=	$feedback;
							$details[$counter][5]	=	$status;
							$details[$counter][6]	=	$profile;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			
			/*Register*/
			function add_regis($name,$email,$phone,$password,$status)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `registrations`(`name`,`email`,`contact`, `password`, `date`, `time`,`status`) VALUES (?,?,?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("sssssss",$name,$email,$phone,$password,$date,$time,$status);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			
			/*Registration update pending*/
		
			function pending_registration($pending_id)
			{	
				$status="approved";
				
				if($stmt_update = $this->con->prepare("UPDATE `registrations` set `status` = ? Where `id`=?"))
				{
					$stmt_update->bind_param("si",$status,$pending_id);
					
					if($stmt_update->execute())
					{
						return true;
					}
						return false;
				} 	
			}
		
			
			function get_all_approved_registrations($from_date,$to_date)
			{ 
				$from_date = date("Y-m-d" , strtotime($from_date));
				$to_date = date("Y-m-d" , strtotime($to_date));
				$status="approved";
				if($stmt_select = $this->con->prepare("SELECT `id`,`name`,`email`,`contact`,`status`,`password`,`other_mobile_no`, `address`, `state`, `photo`, `sign`, `token`, `city` FROM `registrations` where `status` = ? AND `date` BETWEEN '$from_date' AND '$to_date'"))
				{	
					$stmt_select->bind_param("s",$status);
					$stmt_select->bind_result($id,$name,$email,$contact,$status,$password,$other_mobile_no,$address,$state,$photo,$sign,$token,$city);
					
					if($stmt_select->execute())
					{ 
							$counter	=	0;
							$details	=	array();
						while($stmt_select->fetch())
						{ 
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$name;
							$details[$counter][2]	=	$email;
							$details[$counter][3]	=	$contact;
							$details[$counter][4]	=	$status;
							$details[$counter][5]	=	$password;
							$details[$counter][6]	=	$other_mobile_no;
							$details[$counter][7]	=	$address;
							$details[$counter][8]	=	$state;
							$details[$counter][9]	=	$photo;
							$details[$counter][10]	=	$sign;
							$details[$counter][11]	=	$token;
							$details[$counter][12]	=	$city;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			
			function get_all_registrations($from_date,$to_date)
			{	
				$from_date = date("Y-m-d" , strtotime($from_date));
				$to_date = date("Y-m-d" , strtotime($to_date));
				$status="pending";
				if($stmt_select = $this->con->prepare("SELECT `id`,`name`,`email`,`contact`,`status`,`password`,`other_mobile_no`, `address`, `state`, `photo`, `sign`, `token`, `city` FROM `registrations` where `status` = ? AND `date` BETWEEN '$from_date' AND '$to_date'"))
				{	
					$stmt_select->bind_param("s",$status);
					$stmt_select->bind_result($id,$name,$email,$contact,$status,$password,$other_mobile_no,$address,$state,$photo,$sign,$token,$city);
					
					if($stmt_select->execute())
					{ 
							$counter	=	0;
							$details	=	array();
						while($stmt_select->fetch())
						{ 
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$name;
							$details[$counter][2]	=	$email;
							$details[$counter][3]	=	$contact;
							$details[$counter][4]	=	$status;
							$details[$counter][5]	=	$password;
							$details[$counter][6]	=	$other_mobile_no;
							$details[$counter][7]	=	$address;
							$details[$counter][8]	=	$state;
							$details[$counter][9]	=	$photo;
							$details[$counter][10]	=	$sign;
							$details[$counter][11]	=	$token;
							$details[$counter][12]	=	$city;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			
			function delete_registration($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `registrations` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
	
		/*login fetch keycode*/
			function get_id_from_email($email)
			{ 
				if($stmt_select = $this->con->prepare("Select `id` from `registrations` where `email` = ? "))
				{	
					$stmt_select->bind_param("s",$email);
				
					$stmt_select->bind_result($regist_id);
				
					if($stmt_select->execute())
					{ 
						if($stmt_select->fetch())
						{
							return $regist_id;
						}
					}
							return false;
				}
			}
			
			function get_id_from_keycode($keycode)
			{ 
				if($stmt_select = $this->con->prepare("Select `id` from `keycode` where `keycode` = ? "))
				{	
					$stmt_select->bind_param("s",$keycode);
				
					$stmt_select->bind_result($id);
				
					if($stmt_select->execute())
					{ 
						if($stmt_select->fetch())
						{
							return $id;
						}
					}
							return false;
				}
			}
			function check_email_exist_or_not($email)
			{ 
				if($stmt_select = $this->con->prepare("Select `id` from `registrations` where `email` = ? "))
				{	
					$stmt_select->bind_param("s",$email);
				
					$stmt_select->bind_result($regist_id);
				
					if($stmt_select->execute())
					{ 
						if($stmt_select->fetch())
						{
							return $regist_id;
						}
					}
							return false;
				}
			}
			function new_batch($description,$actual_image_name)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `batch`(`title`,`attachment`, `date`, `time`) VALUES (?,?,?,?)"))
				{
					$stmt_insert->bind_param("ssss",$description,$actual_image_name,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function delete_batch_info($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `batch` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function get_all_batch_info()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`title`,`attachment` FROM `batch` ORDER BY `id` DESC"))
				{	
					$stmt_insert->bind_result($id,$images,$description);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							
							$details[$counter][1]	=	$images;
							$details[$counter][2]	=	$description;
						
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function add_new_notification($title,$actual_image_name)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `notification`(`title`,`attachment`, `date`, `time`) VALUES (?,?,?,?)"))
				{
					$stmt_insert->bind_param("ssss",$title,$actual_image_name,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function delete_notification_images($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `notification` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function get_all_notification()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`title`,`attachment` FROM `notification` ORDER BY `id` DESC"))
				{	
					$stmt_insert->bind_result($id,$title,$images);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$title;
							$details[$counter][2]	=	$images;
						
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			
			function get_all_my_tutorials($user)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`, `tuto_id`, `fees`, `purchase_by`, `payment_method`, `payment_by_id`, `date`, `time` FROM `orders` WHERE `purchase_by`='$user'"))
				{	
					$stmt_insert->bind_result($id,$tuto_id,$fees,$purchase_by,$payment_method, $payment_by_id,$date,$time);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$tuto_id;
							$details[$counter][2]	=	$fees;
							$details[$counter][3]	=	$purchase_by;
							$details[$counter][4]	=	$payment_method;
							$details[$counter][5]	=	$payment_by_id;
							$details[$counter][6]	=	$date;
							$details[$counter][7]	=	$time;
						
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			
			function fetch_record_exist_or_not()
			{
				if($stmt_select = $this->con->prepare("Select `id` from `highlights`"))
				{	
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function add_highlights_title($title)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `highlights`(`title`, `date`, `time`) VALUES (?,?,?)"))
				{
					$stmt_insert->bind_param("sss",$title,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function update_highlights_title($title)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("update `highlights` set `title` = ?, `date` = ?, `time` = ? "))
				{
					$stmt_insert->bind_param("sss",$title,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_all_highlights()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`title`,`attachment` FROM `highlights`"))
				{	
					$stmt_insert->bind_result($id,$title,$images);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$title;
							$details[$counter][2]	=	$images;
						
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function new_current_affairs($title,$actual_image_name)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `current_affairs`(`title`,`attachment`, `date`, `time`) VALUES (?,?,?,?)"))
				{
					$stmt_insert->bind_param("ssss",$title,$actual_image_name,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function delete_current_affairs($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `current_affairs` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function get_all_current_affairs()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`title`,`attachment` FROM `current_affairs` ORDER BY `id` DESC"))
				{	
					$stmt_insert->bind_result($id,$title,$images);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$title;
							$details[$counter][2]	=	$images;
						
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function get_all_current_affairs_by_id($up_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`title`,`attachment` FROM `current_affairs`Where `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$up_id);
					
					$stmt_insert->bind_result($id,$title,$images);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$title;
							$details[$counter][2]	=	$images;
						
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function update_current_affairs_title($up_id,$title)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("UPDATE `current_affairs` set `title` = ? where `id` = ?"))
				{
					$stmt_insert->bind_param("si",$title,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function update_attachment_in_current_affairs($update_id)
			{		
				$actual_image_name = "";					
				if($stmt_insert = $this->con->prepare("Update `current_affairs` set `attachment`=? Where `id`=?"))
				{
					$stmt_insert->bind_param("si",$actual_image_name,$update_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_current_affairs_attachment($update_id)
			{
				if($stmt_select = $this->con->prepare("Select `attachment` from `current_affairs` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$update_id);
				
					$stmt_select->bind_result($result_image);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_image;
						}
					}
							return false;
				}
			}
			function update_current_affairs_attachemnt($update_id,$actual_image_name)
			{							
				if($stmt_insert = $this->con->prepare("Update `current_affairs` set `attachment`=? Where `id`=?"))
				{
					$stmt_insert->bind_param("si",$actual_image_name,$update_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function add_highlights_attachment($attachment)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `highlights`(`attachment`, `date`, `time`) VALUES (?,?,?)"))
				{
					$stmt_insert->bind_param("sss",$attachment,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function update_highlights_attachment($attachment)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("update `highlights` set `attachment` = ?, `date` = ?, `time` = ? "))
				{
					$stmt_insert->bind_param("sss",$attachment,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function check_category_exist_or_not($title)
			{
				if($stmt_select = $this->con->prepare("Select `id` from `downloads_category` where `title` = ? "))
				{	
					$stmt_select->bind_param("s",$title);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function get_all_download_category()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`title` FROM `downloads_category` ORDER BY `id` DESC"))
				{	
					$stmt_insert->bind_result($id,$title);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$title;
						
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function delete_download_category($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `downloads_category` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function get_all_download_category_by_id($up_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`title` FROM `downloads_category` Where `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$up_id);
					
					$stmt_insert->bind_result($id,$title);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$title;
						
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function update_downloads_category($up_id,$title)
			{	
				if($stmt_insert = $this->con->prepare("Update `downloads_category` set `title`= ? Where `id` = ?"))
				{
					$stmt_insert->bind_param("ss",$title,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function check_category_exist_or_not_for_update($up_id,$title)
			{
				if($stmt_select = $this->con->prepare("Select `id` from `downloads_category` where `title` = ? AND `id` != ? "))
				{	
					$stmt_select->bind_param("si",$title,$up_id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function get_all_downloads_data_by_category($category)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`department`,`title`,`images` FROM `downloads` Where `department` LIKE '%$category%'"))
				{	
					$stmt_insert->bind_result($id,$category,$title,$images);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$category;
							$details[$counter][2]	=	$title;
							$details[$counter][3]	=	$images;
						
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			
			
			
			function get_password_from_user_registration($email)
			{
				if($stmt_select = $this->con->prepare("Select `password` from `registrations` where `email` = ? "))
				{	
					$stmt_select->bind_param("s",$email);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function change_user_information_password($email,$password)
			{ 
				$date = date("Y-m-d");
				$time = date("H:i:s A");
			
				if($stmt_select = $this->con->prepare("update `registrations` set `password`='".$password."' where `email` = ?"))
				{
					$stmt_select->bind_param("s",$email);				
				
					if($stmt_select->execute())
					{					
						return true;
					}
						return false;
				}
			}
			//new functions
			function create_new_title($title,$t_marks,$instruction,$exam_date,$from_time,$to_time)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `titles`(`title`,`total_marks`,`instruction`,`exam_date`,`from_date`,`to_date`, `date`, `time`) VALUES (?,?,?,?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("ssssssss",$title,$t_marks,$instruction,$exam_date,$from_time,$to_time,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function title_exists_or_not($title)
			{
				if($stmt_select = $this->con->prepare("Select `id` from `titles` where `title` = ? "))
				{	
					$stmt_select->bind_param("s",$title);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			
			function get_all_titles()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`title`,`total_marks`,`instruction`,`exam_date`,`from_date`,`to_date` FROM `titles` ORDER BY `id` DESC"))
				{	
					$stmt_insert->bind_result($id,$title,$total_marks,$instruction,$exam_date,$from_date,$to_date);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$title;
							$details[$counter][2]	=	$total_marks;
							$details[$counter][3]	=	$instruction;
							$details[$counter][4]	=	$exam_date;
							$details[$counter][5]	=	$from_date;
							$details[$counter][6]	=	$to_date;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			
			function get_exam_title_from_id($ex_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`title`,`total_marks`,`instruction`,`exam_date`,`from_date`,`to_date` FROM `titles` Where `id`=?"))
				{	
					$stmt_insert->bind_param("i",$ex_id);
				
					$stmt_insert->bind_result($id,$title,$total_marks,$instruction,$exam_date,$from_date,$to_date);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$title;
							$details[$counter][2]	=	$total_marks;
							$details[$counter][3]	=	$instruction;
							$details[$counter][4]	=	$exam_date;
							$details[$counter][5]	=	$from_date;
							$details[$counter][6]	=	$to_date;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			
			function delete_titles($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `titles` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function add_new_questions($title,$title_id,$questions,$option1,$option2,$option3,$option4,$option5,$option6,$option7,$option8,$correct_answers,$description,$marks)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `questions`(`titles`, `title_id`, `question`,
				`option1`,`option2`,`option3`,`option4`,`option5`,`option6`,`option7`,`option8`, `correct_answer`,`description`,`marks`, `date`, `time`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("ssssssssssssssss",$title,$title_id,$questions,$option1,$option2,$option3,$option4,$option5,$option6,$option7,$option8,$correct_answers,$description,$marks,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_all_questions($title)
			{	
				if($title == "Select Titles")
				{
					$title = "";
				}
				if($stmt_insert = $this->con->prepare("SELECT `id`,`titles`, `question`, `option1`, `option2`, `option3`, `option4`, `option5`, `option6`, `option7`, `option8`, `correct_answer`, `description`, `marks` FROM `questions` Where `titles` LIKE '%$title%'"))
				{	
					$stmt_insert->bind_result($id,$title,$question,$option1,$option2,$option3,$option4,$option5,$option6,$option7,$option8,$correct_answer,$description,$marks);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$title;
							$details[$counter][2]	=	$question;
							$details[$counter][3]	=	$option1;
							$details[$counter][4]	=	$option2;
							$details[$counter][5]	=	$option3;
							$details[$counter][6]	=	$option4;
							$details[$counter][7]	=	$option5;
							$details[$counter][8]	=	$option6;
							$details[$counter][9]	=	$option7;
							$details[$counter][10]	=	$option8;
							$details[$counter][11]	=	$correct_answer;
							$details[$counter][12]	=	$description;
							$details[$counter][13]	=	$marks;
						
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function delete_question($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `questions` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function get_all_questions_by_id($title)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`titles`, `question`, `option1`, `option2`, `option3`, `option4`, `option5`, `option6`, `option7`, `option8`, `correct_answer` FROM `questions` Where `titles` = ? "))
				{	
					$stmt_insert->bind_param("s",$title);
					
					$stmt_insert->bind_result($id,$title,$question,$option1,$option2,$option3,$option4,$option5,$option6,$option7,$option8,$correct_answer);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$title;
							$details[$counter][2]	=	$question;
							$details[$counter][3]	=	$option1;
							$details[$counter][4]	=	$option2;
							$details[$counter][5]	=	$option3;
							$details[$counter][6]	=	$option4;
							$details[$counter][7]	=	$option5;
							$details[$counter][8]	=	$option6;
							$details[$counter][9]	=	$option7;
							$details[$counter][10]	=	$option8;
							$details[$counter][11]	=	$correct_answer;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function add_solved_answers($email,$title,$title_id,$questions,$q_id,$a_id,$correct_answer,$marks)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `solved_questionnaires`(`user_email`, `title`, `title_id`, `question`, `question_id`, `answer`,`correct_answer`,`marks`, `date`, `time`) VALUES (?,?,?,?,?,?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("ssssssssss",$email,$title,$title_id,$questions,$q_id,$a_id,$correct_answer,$marks,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_all_titles_by_id($up_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`title`,`total_marks`,`instruction`,`exam_date`,`from_date`,`to_date` FROM `titles` Where `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$up_id);
					
					$stmt_insert->bind_result($id,$title,$total_marks,$instruction,$exam_date,$from_date,$to_date);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$title;
							$details[$counter][2]	=	$total_marks;
							$details[$counter][3]	=	$instruction;
							$details[$counter][4]	=	$exam_date;
							$details[$counter][5]	=	$from_date;
							$details[$counter][6]	=	$to_date;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function title_exists_or_not_for_update($title,$up_id)
			{
				if($stmt_select = $this->con->prepare("Select `id` from `titles` where `title` = ? AND `id` != ? "))
				{	
					$stmt_select->bind_param("si",$title,$up_id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function update_new_title($up_id,$title,$t_marks,$instruction,$exam_date,$from_time,$to_time)
			{	
				if($stmt_insert = $this->con->prepare("update `titles` set `title` = ?,`total_marks`=?,`instruction` = ?,`exam_date` = ?,`from_date` = ?,`to_date`= ? Where `id` = ?"))
				{
					$stmt_insert->bind_param("ssssssi",$title,$t_marks,$instruction,$exam_date,$from_time,$to_time,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function fetch_title_id_by_name($title)
			{
				if($stmt_select = $this->con->prepare("Select `id` from `titles` where `title` = ? "))
				{	
					$stmt_select->bind_param("s",$title);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function fetch_question_id_by_name($title)
			{
				if($stmt_select = $this->con->prepare("Select `question` from `questions` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$title);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function fetch_correct_answer_id_by_name($title)
			{
				if($stmt_select = $this->con->prepare("Select `correct_answer` from `questions` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$title);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function get_total_marks($email,$title)
			{
				if($stmt_select = $this->con->prepare("Select SUM(`marks`) from `solved_questionnaires` where `user_email` = ? AND `title` = ?"))
				{	
					$stmt_select->bind_param("ss",$email,$title);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function get_all_course_info()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`, `c_section`, `title`, `duration`, `mode`, `description`, `fees`, `contact_no`, `pdf` FROM `courses`  ORDER BY `id` DESC"))
				{	
					$stmt_insert->bind_result($id,$c_section,$title,$duration,$mode,$description,$fees,$contact_no,$pdf);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$c_section;							
							$details[$counter][2]	=	$title;
							$details[$counter][3]	=	$duration;	
							$details[$counter][4]	=	$mode;
							$details[$counter][5]	=	$description;
							$details[$counter][6]	=	$fees;
							$details[$counter][7]	=	$contact_no;
							$details[$counter][8]	=	$pdf;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			
			function get_all_course_info_by_search($title)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`, `c_section`, `title`, `duration`, `mode`, `description`, `fees`, `contact_no`, `pdf` FROM `courses` where `title` LIKE '%$title%'  ORDER BY `id` DESC"))
				{	
					$stmt_insert->bind_result($id,$c_section,$title,$duration,$mode,$description,$fees,$contact_no,$pdf);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$c_section;							
							$details[$counter][2]	=	$title;
							$details[$counter][3]	=	$duration;	
							$details[$counter][4]	=	$mode;
							$details[$counter][5]	=	$description;
							$details[$counter][6]	=	$fees;
							$details[$counter][7]	=	$contact_no;
							$details[$counter][8]	=	$pdf;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			
			function get_all_course_info_by_id($up_id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`, `c_section`, `title`, `duration`, `mode`, `description`,`fees`,`contact_no`,`pdf` FROM `courses` Where `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$up_id);
					
					$stmt_insert->bind_result($id,$c_section,$title,$duration,$mode,$description,$fees,$contact_no,$pdf);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;	
							$details[$counter][1]	=	$c_section;
							$details[$counter][2]	=	$title;
							$details[$counter][3]	=	$duration;	
							$details[$counter][4]	=	$mode;
							$details[$counter][5]	=	$description;
							$details[$counter][6]	=	$fees;
							$details[$counter][7]	=	$contact_no	;
							$details[$counter][8]	=	$pdf;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function add_courses($c_type,$title,$duration,$mode,$description,$fees,$contact,$actual_image_name)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `courses`(`c_section`,`title`,`duration` ,`mode`,`description`,`fees`,`contact_no`,`pdf`, `date`, `time`) VALUES(?,?,?,?,?,?,?,?,?,?)  "))
				{
					$stmt_insert->bind_param("ssssssssss",$c_type,$title,$duration,$mode,$description,$fees,$contact,$actual_image_name,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			
			function add_examinations($title,$duration,$mode,$description,$contact,$actual_image_name)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				
				if($stmt_insert = $this->con->prepare("INSERT INTO `examinations`(`title`,`duration` ,`mode`,`description`,`contact_no`,`pdf`, `date`, `time`) VALUES(?,?,?,?,?,?,?,?)"))
				{
					$stmt_insert->bind_param("ssssssss",$title,$duration,$mode,$description,$contact,$actual_image_name,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
					return false;
				} 	
			}
			
			
			function update_courses($up_id,$c_type,$title,$duration,$mode,$description,$fees,$contact)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("Update `courses` set `c_section` = ?, `title` = ?, `duration` = ?,`mode` = ?,`description` = ?,`fees` = ?,`contact_no` = ?, `date` = ?, `time` = ? Where `id` = ?"))
				{
					$stmt_insert->bind_param("sssssssssi",$c_type,$title,$duration,$mode,$description,$fees,$contact,$date,$time,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_all_user_solved_questionnaries($user_email)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`user_email`, `title`, `title_id`, `question`, `question_id`, `answer`, `correct_answer`, `marks` FROM `solved_questionnaires` Where `user_email` = ? "))
				{	
					$stmt_insert->bind_param("s",$user_email);
					
					$stmt_insert->bind_result($id,$user_email,$title,$title_id,$question,$question_id,$answer,$correct_answer,$marks);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$user_email;
							$details[$counter][2]	=	$title;
							$details[$counter][3]	=	$title_id;
							$details[$counter][4]	=	$question;
							$details[$counter][5]	=	$question_id;
							$details[$counter][6]	=	$answer;
							$details[$counter][7]	=	$correct_answer;
							$details[$counter][8]	=	$marks;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function get_all_questions_by_title_id($title)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`titles`, `question`, `option1`, `option2`, `option3`, `option4`, `option5`, `option6`, `option7`, `option8`, `correct_answer`,`description`,`marks` FROM `questions` Where `id` = ? "))
				{	
					$stmt_insert->bind_param("i",$title);
					
					$stmt_insert->bind_result($id,$title,$question,$option1,$option2,$option3,$option4,$option5,$option6,$option7,$option8,$correct_answer,$description,$marks);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$title;
							$details[$counter][2]	=	$question;
							$details[$counter][3]	=	$option1;
							$details[$counter][4]	=	$option2;
							$details[$counter][5]	=	$option3;
							$details[$counter][6]	=	$option4;
							$details[$counter][7]	=	$option5;
							$details[$counter][8]	=	$option6;
							$details[$counter][9]	=	$option7;
							$details[$counter][10]	=	$option8;
							$details[$counter][11]	=	$correct_answer;
							$details[$counter][12]	=	$description;
							$details[$counter][13]	=	$marks;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function get_all_course_info_by_section($section)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`, `c_section`, `title`, `duration`, `mode`, `description`,`fees`,`contact_no`,`pdf` FROM `courses` Where `c_section` = ?"))
				{	
					$stmt_insert->bind_param("s",$section);
					
					$stmt_insert->bind_result($id,$c_section,$title,$duration,$mode,$description,$fees,$contact_no,$pdf);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;	
							$details[$counter][1]	=	$c_section;
							$details[$counter][2]	=	$title;
							$details[$counter][3]	=	$duration;	
							$details[$counter][4]	=	$mode;
							$details[$counter][5]	=	$description;
							$details[$counter][6]	=	$fees;
							$details[$counter][7]	=	$contact_no	;
							$details[$counter][8]	=	$pdf	;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function delete_courses($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `courses` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			
			function delete_examination_data($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `examinations` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			
			
			function get_all_register_user_info()
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`name`,`email`,`contact`,`status` FROM `registrations`"))
				{	
					$stmt_insert->bind_result($id,$name,$email,$contact,$status);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$name;
							$details[$counter][2]	=	$email;
							$details[$counter][3]	=	$contact;
							$details[$counter][4]	=	$status;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function add_exam_allocation($title,$records)
			{							
				$date = date("Y-m-d");
				$time = date("H-i-s A");
				if($stmt_insert = $this->con->prepare("INSERT INTO `exam_allocation`(`exam_id`, `user_id`, `date`, `time`) VALUES (?,?,?,?)"))
				{
					$stmt_insert->bind_param("ssss",$title,$records,$date,$time);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function check_user_id_exists_or_not($email)
			{
				if($stmt_select = $this->con->prepare("Select `id` from `exam_allocation` where 
				`user_id` = ? "))
				{	
					$stmt_select->bind_param("s",$email);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function get_all_exam_allocation_info($f_title)
			{	
				if($f_title == "Select Titles")
				{
					$f_title = "";
				}
				if($stmt_insert = $this->con->prepare("SELECT `id`, `exam_id`, `user_id` FROM `exam_allocation` Where `exam_id` LIKE '%$f_title%' ORDER BY `id` DESC"))
				{	
					$stmt_insert->bind_result($id,$exam_id,$user_id);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;	
							$details[$counter][1]	=	$exam_id;
							$details[$counter][2]	=	$user_id;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function get_all_user_data_by_id($id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`name`,`email`,`contact`,`status` FROM `registrations` where `id`= ? "))
				{	
					$stmt_insert->bind_param("i",$id);
					
					$stmt_insert->bind_result($id,$name,$email,$contact,$status);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$name;
							$details[$counter][2]	=	$email;
							$details[$counter][3]	=	$contact;
							$details[$counter][4]	=	$status;
							
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function fetch_title_name_by_id($title)
			{
				if($stmt_select = $this->con->prepare("Select `title` from `titles` where `id` = ? "))
				{	
					$stmt_select->bind_param("s",$title);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function delete_exam_allocation($del_id)
			{
				if($stmt_select = $this->con->prepare("Delete from `exam_allocation` where `id`=?"))
				{
					$stmt_select->bind_param("i",$del_id);
				
					if($stmt_select->execute())
					{					
							return true;
					}
						return false;
				}
			}
			function fetch_user_id_by_email($title)
			{
				if($stmt_select = $this->con->prepare("Select `id` from `registrations` where `email` = ? "))
				{	
					$stmt_select->bind_param("s",$title);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function fetch_exam_id_by_user_id($title)
			{
				if($stmt_select = $this->con->prepare("Select `exam_id` from `exam_allocation` where `user_id` = ? "))
				{	
					$stmt_select->bind_param("s",$title);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function get_all_titles_by_title_id($id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`title`,`total_marks`,`instruction`,`exam_date`,`from_date`,`to_date` FROM `titles` Where `id` = ?"))
				{	
					$stmt_insert->bind_param("i",$id);
					
					$stmt_insert->bind_result($id,$title,$total_marks,$instruction,$exam_date,$from_date,$to_date);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$title;
							$details[$counter][2]	=	$total_marks;
							$details[$counter][3]	=	$instruction;
							$details[$counter][4]	=	$exam_date;
							$details[$counter][5]	=	$from_date;
							$details[$counter][6]	=	$to_date;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function fetch_title_info_by_title($id)
			{	
				if($stmt_insert = $this->con->prepare("SELECT `id`,`title`,`total_marks`,`instruction`,`exam_date`,`from_date`,`to_date` FROM `titles` Where `title` = ?"))
				{	
					$stmt_insert->bind_param("s",$id);
					
					$stmt_insert->bind_result($id,$title,$total_marks,$instruction,$exam_date,$from_date,$to_date);
					
					if($stmt_insert->execute())
					{
							$counter	=	0;
							$details	=	array();
						while($stmt_insert->fetch())
						{
							$details[$counter][0]	=	$id;
							$details[$counter][1]	=	$title;
							$details[$counter][2]	=	$total_marks;
							$details[$counter][3]	=	$instruction;
							$details[$counter][4]	=	$exam_date;
							$details[$counter][5]	=	$from_date;
							$details[$counter][6]	=	$to_date;
							$counter++;
						}
						if(!empty($details))	
						{
							return $details;
						}
						return false;
					}	
				}
			}
			function update_faculty_profile($up_id)
			{	
				$actual_image_name="";
				
				if($stmt_insert = $this->con->prepare("UPDATE `courses` set `pdf` = ? Where `id`=?"))
				{
					$stmt_insert->bind_param("si",$actual_image_name,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
			function get_faculty_image_name_by_id($id)
			{
				if($stmt_select = $this->con->prepare("Select `pdf` from `courses` where `id` = ? "))
				{	
					$stmt_select->bind_param("i",$id);
				
					$stmt_select->bind_result($result_password);
				
					if($stmt_select->execute())
					{
						if($stmt_select->fetch())
						{
							return $result_password;
						}
					}
							return false;
				}
			}
			function update_faculty_image_info($up_id,$image)
			{	
				if($stmt_insert = $this->con->prepare("UPDATE `courses` set `pdf` = ? Where `id`=?"))
				{
					$stmt_insert->bind_param("si",$image,$up_id);
					
					if($stmt_insert->execute())
					{
						return true;
					}
						return false;
				} 	
			}
				//24-8-2020
	function create_package($title,$rate,$no_of_papers,$package_description)
	{		
	
		$date = date("Y-m-d");
		$time = date("H-i-s A");
		if($stmt_insert = $this->con->prepare("INSERT INTO `package`(`title`, `rate`, `date`, `time`,`no_of_papers`,`package_description`) VALUES (?,?,?,?,?,?)"))
		{
			$stmt_insert->bind_param("ssssss",$title,$rate,$date,$time,$no_of_papers,$package_description);
			
			if($stmt_insert->execute())
			{
				return true;
			}
				return false;
		} 	
	}
	function get_all_package_details()
	{	
		if($stmt_insert = $this->con->prepare("SELECT `id`, `title`, `rate`,`no_of_papers`,`package_description` FROM `package` ORDER BY `id` DESC"))
		{	
			$stmt_insert->bind_result($id,$title,$rate,$no_of_papers,$package_description);
			
			if($stmt_insert->execute())
			{
					$counter	=	0;
					$details	=	array();
				while($stmt_insert->fetch())
				{
					$details[$counter][0]	=	$id;
					$details[$counter][1]	=	$title;
					$details[$counter][2]	=	$rate;
					$details[$counter][3]	=	$no_of_papers;
					$details[$counter][4]	=	$package_description;
				
					$counter++;
				}
				if(!empty($details))	
				{
					return $details;
				}
				return false;
			}	
		}
	}
	function delete_package($del_id)
	{
		if($stmt_select = $this->con->prepare("Delete from `package` where `id`=?"))
		{
			$stmt_select->bind_param("i",$del_id);
		
			if($stmt_select->execute())
			{					
					return true;
			}
				return false;
		}
	}
	function get_all_rate_by_id($up_id)
	{	
		if($stmt_insert = $this->con->prepare("SELECT `id`, `title`, `rate`,`no_of_papers`,`package_description` FROM `package` WHERE `id`=?"))
		{	
			$stmt_insert->bind_param("i",$up_id);
			
			$stmt_insert->bind_result($id,$title,$rate,$no_of_papers,$package_description);
			
			if($stmt_insert->execute())
			{
					$counter	=	0;
					$details	=	array();
				while($stmt_insert->fetch())
				{
					$details[$counter][0]	=	$id;
					$details[$counter][1]	=	$title;
					$details[$counter][2]	=	$rate;
					$details[$counter][3]	=	$no_of_papers;
					$details[$counter][4]	=	$package_description;
					$counter++;
				}
				if(!empty($details))	
				{
					return $details;
				}
				return false;
			}	
		}
	}
	function update_package($up_id,$title,$rate,$no_of_papers,$package_description)
	{	
		if($stmt_insert = $this->con->prepare("UPDATE `package` SET `title`=?,`rate`=?,`no_of_papers`=?,
		`package_description`=? WHERE `id`=?"))
		{
			$stmt_insert->bind_param("ssssi",$title,$rate,$no_of_papers,$package_description,$up_id);
			
			if($stmt_insert->execute())
			{
				return true;
			}
				return false;
		} 	
	}
	//EXAM 
	function get_exam_exist($title)
	{
		if($stmt_insert = $this->con->prepare("SELECT `id` FROM `new_exam` WHERE `title`=?"))
		{	
			$stmt_insert->bind_param("s",$title);
			
			$stmt_insert->bind_result($res_id);
			
			if($stmt_insert->execute())
			{
				if($stmt_insert->fetch())
				{
					return $res_id;
				}
				return false;
			}	
		}
	
	}
	
	function get_exam_exist_to_update($title,$edit_id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `id` FROM `new_exam` WHERE `title`=? AND `id`!=?"))
		{	
			$stmt_insert->bind_param("si",$title,$edit_id);
			
			$stmt_insert->bind_result($res_id);
			
			if($stmt_insert->execute())
			{
				if($stmt_insert->fetch())
				{
					return $res_id;
				}
				return false;
			}	
		}
	
	}
	
	function create_exam($scheme,$title,$hour,$minutes,$time_section,$instruction,$actual_image)
	{
		$date = date("Y-m-d");
		$time = date("H-i-s A");
		
		if($stmt_insert = $this->con->prepare("INSERT INTO `new_exam`(`scheme`, `title`, `hour`, `minutes`, `time_section`, `instruction`, `attachment`, `date`, `time`) VALUES (?,?,?,?,?,?,?,?,?)"))
		{
		
			$stmt_insert->bind_param("sssssssss",$scheme,$title,$hour,$minutes,$time_section,$instruction,$actual_image,$date,$time);
			
			if($stmt_insert->execute())
			{ 
				return $stmt_insert->insert_id;
			}
			return false;
		} 
	
	}
	
	function get_all_exam_details()
	{
		if($stmt_insert = $this->con->prepare("SELECT `id`, `scheme`, `title`, `hour`, `minutes`, `time_section`, `instruction`, 
		`attachment`, `date`, `time` FROM `new_exam`"))
		{	
			$stmt_insert->bind_result($id,$res_scheme,$res_title,$res_hour,$res_min,$res_time_section,$res_instruction,$res_attachment,$res_date,$res_time);
			
			if($stmt_insert->execute())
			{
					$counter	=	0;
					$details	=	array();
				while($stmt_insert->fetch())
				{
					$details[$counter][0]	=	$id;
					$details[$counter][1]	=	$res_scheme;
					$details[$counter][2]	=	$res_title;
					$details[$counter][3]	=	$res_hour;
					$details[$counter][4]	=	$res_min;
					$details[$counter][5]	=	$res_time_section;
					$details[$counter][6]	=	$res_instruction;
					$details[$counter][7]	=	$res_attachment;
					$details[$counter][8]	=	$res_date;
					$details[$counter][9]	=	$res_time;
					
					$counter++;
				}
				if(!empty($details))	
				{
					return $details;
				}
				return false;
			}	
		}
	}
	
	function delete_exam($del)
	{
		if($stmt_select = $this->con->prepare("DELETE FROM `new_exam` WHERE `id`=?"))
		{
			$stmt_select->bind_param("i",$del);
		
			if($stmt_select->execute())
			{					
					return true;
			}
				return false;
		}
	}
	
	function get_exam_details_by_id($edit_id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `id`, `scheme`, `title`, `hour`, `minutes`, `time_section`, `instruction`, 
		`attachment` FROM `new_exam` WHERE `id`=?"))
		{	
			$stmt_insert->bind_param("i",$edit_id);
			
			$stmt_insert->bind_result($id,$res_scheme,$res_title,$res_hour,$res_min,$res_time_section,$res_instruction,$res_attachment);
			
			if($stmt_insert->execute())
			{
				$details	=	array();
				if($stmt_insert->fetch())
				{
					$details[0]	=	$id;
					$details[1]	=	$res_scheme;
					$details[2]	=	$res_title;
					$details[3]	=	$res_hour;
					$details[4]	=	$res_min;
					$details[5]	=	$res_time_section;
					$details[6]	=	$res_instruction;
					$details[7]	=	$res_attachment;
					
					return $details;
				}
				return false;
			}	
		}
	
	}
	
	function update_exam($scheme,$title,$hour,$minutes,$time_section,$instruction,$edit_id)
	{
		if($stmt_select = $this->con->prepare("UPDATE `new_exam` SET `scheme`=?,`title`=?,`hour`=?,`minutes`=?,`time_section`=?,`instruction`=? WHERE `id`=?"))
		{	
			$stmt_select->bind_param("ssssssi",$scheme,$title,$hour,$minutes,$time_section,$instruction,$edit_id);
		
			if($stmt_select->execute())
			{
				return true;
			}
		    return false;
		}
	
	}
	
	function update_exam_pdf_file($up_id)
	{
		if($stmt_select = $this->con->prepare("UPDATE `new_exam` SET `attachment`='' WHERE `id`=?"))
		{	
			$stmt_select->bind_param("i",$up_id);
		
			if($stmt_select->execute())
			{
				return true;
			}
		    return false;
		}
	
	}
	
	function update_exam_attachment($actual_image,$id)
	{
		if($stmt_select = $this->con->prepare("UPDATE `new_exam` SET `attachment`=? WHERE `id`=?"))
		{	
			$stmt_select->bind_param("si",$actual_image,$id);
		
			if($stmt_select->execute())
			{
				return true;
			}
		    return false;
		}
	
	}
	
	function create_answer_key($chk_counter,$answer,$exam_id)
	{
		$date = date("Y-m-d");
		$time = date("H-i-s A");
		
		if($stmt_insert = $this->con->prepare("INSERT INTO `answer_keys`(`question`, `answer`, `exam_id`, `date`, `time`) VALUES (?,?,?,?,?)"))
		{
		
			$stmt_insert->bind_param("sssss",$chk_counter,$answer,$exam_id,$date,$time);
			
			if($stmt_insert->execute())
			{ 
				return true;
			}
			return false;
		} 
	}
	
	function get_answer_keys_details($exam_id)
	{ 
	if($stmt_insert = $this->con->prepare("SELECT `id`, `question`, `answer`, `exam_id`, `date`, `time` FROM `answer_keys` WHERE `exam_id`=?"))
		{	
			$stmt_insert->bind_param("s",$exam_id);
			$stmt_insert->bind_result($id,$res_question,$res_answer,$res_exam_id,$res_date,$res_time);
			
			if($stmt_insert->execute())
			{ 
					$counter	=	0;
					$details	=	array();
				while($stmt_insert->fetch())
				{ 
					$details[$counter][0]	=	$id;
					$details[$counter][1]	=	$res_question;
					$details[$counter][2]	=	$res_answer;
					$details[$counter][3]	=	$res_exam_id;
					$details[$counter][4]	=	$res_date;
					$details[$counter][5]	=	$res_time;
					
					$counter++;
				}
				if(!empty($details))	
				{
					return $details;
				}
				return false;
			}	
		}
	
	}
	
	function update_answer_key($question,$answer,$exam_id,$ans_id)
	{ 
		if($stmt_select = $this->con->prepare("UPDATE `answer_keys` SET `question`=?,`answer`=? WHERE `exam_id`=? AND `id`=?"))
		{	
			$stmt_select->bind_param("sssi",$question,$answer,$exam_id,$ans_id);
		
			if($stmt_select->execute())
			{
				return true;
			}
		    return false;
		}
	
	}
	function get_exist_db_id($ans_id,$exam_id)
	{
		
		if($stmt_insert = $this->con->prepare("SELECT `id` FROM `answer_keys` WHERE `id`=? AND `exam_id`=? "))
		{	
			$stmt_insert->bind_param("is",$ans_id,$exam_id);
			
			$stmt_insert->bind_result($res_id);
			
			if($stmt_insert->execute())
			{
				if($stmt_insert->fetch())
				{
					return $res_id;
				}
				return false;
			}	
		}
	}
	function get_register_exists_by_email($email)
	{ 
		if($stmt_insert = $this->con->prepare("SELECT `id` FROM `registrations` WHERE `email`=?"))
		{	
			$stmt_insert->bind_param("s",$email);
			
			$stmt_insert->bind_result($id);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return 0;
				}
				return 1;
			}	
		}
	}
	
	function get_register_exists_by_mobile($mobile_no)
	{ 
		if($stmt_insert = $this->con->prepare("SELECT `id` FROM `registrations` WHERE `contact`=?"))
		{	
			$stmt_insert->bind_param("s",$mobile_no);
			
			$stmt_insert->bind_result($id);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return 0;
				}
				return 1;
			}	
		}
	}
	
	
	function insert_registration_entry($name,$email,$phone,$password)
	{ 
		$date = date("Y-m-d");
		$time = date("H-i-s A");
		$status="pending";
		if($stmt_insert = $this->con->prepare("INSERT INTO `registrations`(`name`,`email`,`contact`, `password`, `date`, `time`,`status`) VALUES (?,?,?,?,?,?,?)"))
		{
			$stmt_insert->bind_param("sssssss",$name,$email,$phone,$password,$date,$time,$status);
			
			if($stmt_insert->execute())
			{
				return true;
			}
				return false;
		} 	
	}
	
	function get_user_password_by_mobile($user_id)
	{ 
		if($stmt_insert = $this->con->prepare("SELECT `password` FROM `registrations` WHERE `contact`=?"))
		{
			$stmt_insert->bind_param("s",$user_id);
			
			$stmt_insert->bind_result($id);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $id;
				}
				return false;
			}	
		}
	
	}
	
	function get_user_password_by_email($user_id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `password` FROM `registrations` WHERE `email`=?"))
		{	
			$stmt_insert->bind_param("s",$user_id);
			
			$stmt_insert->bind_result($id);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $id;
				}
				return false;
			}	
		}
	}
	
	function get_user_email($user_id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `email` FROM `registrations` WHERE `email`=?"))
		{	
			$stmt_insert->bind_param("s",$user_id);
			
			$stmt_insert->bind_result($id);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $id;
				}
				return false;
			}	
		}
	}
	function get_user_mobile($user_id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `contact` FROM `registrations` WHERE `contact`=?"))
		{	
			$stmt_insert->bind_param("s",$user_id);
			
			$stmt_insert->bind_result($id);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $id;
				}
				return false;
			}	
		}
	}
	
	function get_user_unique_email_id($user_id)
	{ 
		if($stmt_insert = $this->con->prepare("SELECT `id` FROM `registrations` WHERE `email`=?"))
		{	
			$stmt_insert->bind_param("s",$user_id);
			
			$stmt_insert->bind_result($id);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $id;
				}
				return false;
			}	
		}
	}
	
	function get_user_unique_mobile_id($user_id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `id` FROM `registrations` WHERE `contact`=?"))
		{	
			$stmt_insert->bind_param("s",$user_id);
			
			$stmt_insert->bind_result($id);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $id;
				}
				return false;
			}	
		}
	}
	
	//change password
	
	function get_user_id_by_mobile($user_id)
	{ 
		if($stmt_insert = $this->con->prepare("SELECT `id` FROM `registrations` WHERE `contact`=?"))
		{	
			$stmt_insert->bind_param("s",$user_id);
			
			$stmt_insert->bind_result($id);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $id;
				}
				return false;
			}	
		}
	
	}
	function get_user_password($user_id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `password` FROM `registrations` WHERE `id`=?"))
		{	
			$stmt_insert->bind_param("i",$user_id);
			
			$stmt_insert->bind_result($id);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $id;
				}
				return false;
			}	
		}
	}
	
	function get_user_id_by_email($user_id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `id` FROM `registrations` WHERE `email`=?"))
		{	
			$stmt_insert->bind_param("s",$user_id);
			
			$stmt_insert->bind_result($id);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $id;
				}
				return false;
			}	
		}
	
	}
	
	function change_user_new_password($password,$result_id)
	{
		if($stmt_insert = $this->con->prepare("UPDATE `registrations` SET `password`=? WHERE `id`=?"))
		{
		
			$stmt_insert->bind_param("si",$password,$result_id);
			
			if($stmt_insert->execute())
			{ 
				return true;
			}
			return false;
		} 
	}
	
	function update_user_profile($username,$email,$mobile_no,$password,$user_login)
	{
		if($stmt_insert = $this->con->prepare("UPDATE `registrations` SET `name`=?,`email`=?,`contact`=?,`password`=? WHERE `id`=?"))
		{
		
			$stmt_insert->bind_param("ssssi",$username,$email,$mobile_no,$password,$user_login);
			
			if($stmt_insert->execute())
			{ 
				return true;
			}
			return false;
		} 
	}
	
	function get_contact_no_exist($mobile_no,$user_id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `id` FROM `registrations` WHERE `contact`=? AND `id`!=?"))
		{	
			$stmt_insert->bind_param("si",$mobile_no,$user_id);
			
			$stmt_insert->bind_result($id);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $id;
				}
				return false;
			}	
		}
	
	}
	
	function get_email_exist($email,$user_id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `id` FROM `registrations` WHERE `email`=? AND `id`!=?"))
		{	
			$stmt_insert->bind_param("si",$email,$user_id);
			
			$stmt_insert->bind_result($id);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $id;
				}
				return false;
			}	
		}
	
	}
	
	
	
	function get_profile_by_id($user_id)
	{
		echo $user_id;
	if($stmt_insert = $this->con->prepare("SELECT `id`,`name`,`email`,`contact`,`password` FROM `registrations` WHERE `id`=?"))
		{	
			$stmt_insert->bind_param("i",$user_id);
			
			$stmt_insert->bind_result($id,$name,$email,$mobile_no,$password);
			
			if($stmt_insert->execute())
			{
				$details	=	array();
				if($stmt_insert->fetch())
				{
					$details[0]	=	$id;
					$details[1]	=	$name;
					$details[2]	=	$email;
					$details[3]	=	$mobile_no;
					$details[4]	=	$password;
					
					return $details;
				}
				return false;
			}	
		}
	}
	
	function get_profile_by_mob_no($user_id)
	{
	if($stmt_insert = $this->con->prepare("SELECT `id`,`name`,`email`,`contact`,`password` FROM `registrations` WHERE `id`=?"))
		{	
			$stmt_insert->bind_param("i",$user_id);
			
			$stmt_insert->bind_result($id,$name,$email,$mobile_no,$password);
			
			if($stmt_insert->execute())
			{
				$details	=	array();
				if($stmt_insert->fetch())
				{
					$details[0]	=	$id;
					$details[1]	=	$name;
					$details[2]	=	$email;
					$details[3]	=	$mobile_no;
					$details[4]	=	$password;
					
					return $details;
				}
				return false;
			}	
		}
	}
	
	
	function add_question_paper($title,$actual_image_name)
	{
		$date = date("Y-m-d");
		$time = date("H-i-s A");
		
		if($stmt_insert = $this->con->prepare("INSERT INTO `question_paper`(`title`, `attachment`, `date`, `time`) VALUES (?,?,?,?)"))
		{
			$stmt_insert->bind_param("ssss",$title,$actual_image_name,$date,$time);
			
			if($stmt_insert->execute())
			{
				return true;
			}
				return false;
		} 	
	}
	
	function get_title_exists($title)
	{
		if($stmt_insert = $this->con->prepare("SELECT `id` FROM `question_paper` WHERE `title`=?"))
		{	
			$stmt_insert->bind_param("s",$title);
			
			$stmt_insert->bind_result($id);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $id;
				}
				return false;
			}	
		}
	}
	function get_all_question_paper_details()
	{
		if($stmt_insert = $this->con->prepare("SELECT `id`, `title`, `attachment`, `date`, `time` FROM `question_paper`"))
		{	
			$stmt_insert->bind_result($id,$title,$attachment,$date,$res_time);
			
			if($stmt_insert->execute())
			{ 
					$counter	=	0;
					$details	=	array();
				while($stmt_insert->fetch())
				{ 
					$details[$counter][0]	=	$id;
					$details[$counter][1]	=	$title;
					$details[$counter][2]	=	$attachment;
					$details[$counter][3]	=	$date;
					$details[$counter][4]	=	$res_time;
					
					$counter++;
				}
				if(!empty($details))	
				{
					return $details;
				}
				return false;
			}	
		}	
	}
	
	function delete_question_paper($del)
	{
		if($stmt_select = $this->con->prepare("DELETE FROM `question_paper` WHERE `id`=?"))
		{
			$stmt_select->bind_param("i",$del);
		
			if($stmt_select->execute())
			{					
					return true;
			}
				return false;
		}
	}
	
	function add_answer_key($id,$actual_image_name,$user_login)
	{
		$date = date("Y-m-d");
		$time = date("H-i-s A");
		
		if($stmt_insert = $this->con->prepare("INSERT INTO `question_paper_answers`(`question_id`, `answer_attachment`, `user_id`, `date`, `time`) VALUES (?,?,?,?,?)"))
		{
			$stmt_insert->bind_param("sssss",$id,$actual_image_name,$user_login,$date,$time);
			
			if($stmt_insert->execute())
			{
				return true;
			}
				return false;
		} 	
	}
	
	function get_user_id_by_contact($user_id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `id` FROM `registrations` WHERE `contact`=?"))
		{	
			$stmt_insert->bind_param("s",$user_id);
			
			$stmt_insert->bind_result($id);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $id;
				}
				return false;
			}	
		}
	
	}
	
	function get_all_answer_keys_details_for_user($user_login,$id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `id`, `question_id`, `answer_attachment`, `user_id`, `date`, `time` FROM `question_paper_answers` WHERE `user_id`=? AND `question_id`=?"))
		{	
			$stmt_insert->bind_param("ss",$user_login,$id);
			$stmt_insert->bind_result($id,$question_id,$answer_attachment,$user_id,$date,$res_time);
			
			if($stmt_insert->execute())
			{ 
					$counter	=	0;
					$details	=	array();
				while($stmt_insert->fetch())
				{ 
					$details[$counter][0]	=	$id;
					$details[$counter][1]	=	$question_id;
					$details[$counter][2]	=	$answer_attachment;
					$details[$counter][3]	=	$user_id;
					$details[$counter][4]	=	$date;
					$details[$counter][5]	=	$res_time;
					
					$counter++;
				}
				if(!empty($details))	
				{
					return $details;
				}
				return false;
			}	
		}	
	}
	
	function get_question_paper_title($res_question_id)
	{ 
		if($stmt_insert = $this->con->prepare("SELECT `title` FROM `question_paper` WHERE `id`=?"))
		{	
			$stmt_insert->bind_param("i",$res_question_id);
			
			$stmt_insert->bind_result($title);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $title;
				}
				return false;
			}	
		}
	}
	
	function delete_answer_key($del)
	{
		if($stmt_select = $this->con->prepare("DELETE FROM `question_paper_answers` WHERE `id`=?"))
		{
			$stmt_select->bind_param("i",$del);
		
			if($stmt_select->execute())
			{					
					return true;
			}
				return false;
		}
	}
	
	function get_all_answer_keys_details($edit_id,$from_date,$to_date,$question_paper)
	{
		
		
		$stmt	=	"";
		if($question_paper=='all')
		{
			$stmt=" AND `question_id` LIKE '%%'";
		}
		else
		{
			$stmt=" AND `question_id` = '".$question_paper."'";
		}
		$from_date = date("Y-m-d" , strtotime($from_date));
		$to_date = date("Y-m-d" , strtotime($to_date));
		
		if($stmt_insert = $this->con->prepare("SELECT  `user_id`,`question_id`,`answer_attachment` FROM `question_paper_answers` WHERE `question_id`=? AND `date` BETWEEN ? AND ? ".$stmt))
		{	
			$stmt_insert->bind_param("sss",$edit_id,$from_date,$to_date);
			$stmt_insert->bind_result($user_id,$question_id,$answer_attachment);
			
			if($stmt_insert->execute())
			{ 
					$counter	=	0;
					$details	=	array();
				while($stmt_insert->fetch())
				{ 
					$details[$counter][0]	=	$user_id;
					$details[$counter][1]	=	$question_id;
					$details[$counter][2]	=	$answer_attachment;
					$counter++;
				}
				if(!empty($details))	
				{
					return $details;
				}
				return false;
			}	
		}	
	}
	
	function get_user_name($res_question_id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `name` FROM `registrations` WHERE `id`=?"))
		{	
			$stmt_insert->bind_param("i",$res_question_id);
			
			$stmt_insert->bind_result($title);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $title;
				}
				return false;
			}	
		}
	}
	
	function get_user_contact_no($res_question_id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `contact` FROM `registrations` WHERE `id`=?"))
		{	
			$stmt_insert->bind_param("i",$res_question_id);
			
			$stmt_insert->bind_result($contact);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $contact;
				}
				return false;
			}	
		}
	}
	function get_answer_keys_details_by_individual($user_id,$ques_id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `answer_attachment` FROM `question_paper_answers` WHERE `question_id`=? AND `user_id`=?"))
		{	
			$stmt_insert->bind_param("ss",$ques_id,$user_id);
			$stmt_insert->bind_result($answer_attachment);
			
			if($stmt_insert->execute())
			{ 
					$counter	=	0;
					$details	=	array();
				while($stmt_insert->fetch())
				{ 
					$details[$counter][0]	=	$answer_attachment;
					
					$counter++;
				}
				if(!empty($details))	
				{
					return $details;
				}
				return false;
			}	
		}
	}
	//11-10-2020
	function insert_contact($contact_name,$contact_email,$contact_contact_no,$contact_message)
	{ 
		$date = date("Y-m-d");
		$time = date("H-i-s A");
		
		if($stmt_insert = $this->con->prepare("INSERT INTO `contact_us`(`name`, `email`, `contact_no`, `message`, `date`, `time`) VALUES (?,?,?,?,?,?)"))
		{
			$stmt_insert->bind_param("ssssss",$contact_name,$contact_email,$contact_contact_no,$contact_message,$date,$time);
			
			if($stmt_insert->execute())
			{
				return true;
			}
				return false;
		} 	
	}
	//31-12-2020
	function register_new_user($name,$mobile,$other_mobile_no,$email,$address,$state,$actual_file_name1,$actual_file_name2,$password,$token,$city)
	{
		$date = date("Y-m-d");
		$time = date("H-i-s A");
		$status="approved";
		if($stmt_insert = $this->con->prepare("INSERT INTO `registrations`(`name`,`email`,`contact`, `password`, `date`, `time`,`status`, `other_mobile_no`, `address`, `state`, `photo`, `sign`,`token`,`city`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)"))
		{
			$stmt_insert->bind_param("ssssssssssssss",$name,$email,$mobile,$password,$date,$time,$status,$other_mobile_no,$address,$state,$actual_file_name1,$actual_file_name2,$token,$city);
			
			if($stmt_insert->execute())
			{
				return true;
			}
				return false;
		} 	
	}
	function update_new_user($name,$mobile,$other_mobile_no,$email,$address,$state,$city)
	{
		$date = date("Y-m-d");
		$time = date("H-i-s A");
		
		if($stmt_insert = $this->con->prepare("UPDATE `registrations` SET `name`=?,`email`=?,`other_mobile_no`=?,`address`=?,`state`=?,`city`=? WHERE `contact`=?"))
		{
			$stmt_insert->bind_param("sssssss",$name,$email,$other_mobile_no,$address,$state,$city,$mobile);
			
			if($stmt_insert->execute())
			{
				return true;
			}
				return false;
		} 	
	}
	function get_user_profile_data_by_mobile_no($mobile_no)
	{
		if($stmt_insert = $this->con->prepare("SELECT `id`, `name`, `email`, `contact`, `password`, `other_mobile_no`, `address`, `state`, `photo`, `sign`,`token`,`city` FROM `registrations` WHERE `contact`=?"))
			{	
				$stmt_insert->bind_param("s",$mobile_no);
				
				$stmt_insert->bind_result($id,$name,$email,$mobile_no,$password,$other_mobile_no,$address,$state,$actual_file_name1,$actual_file_name2,$token,$city);
				
				if($stmt_insert->execute())
				{
					$details	=	array();
					if($stmt_insert->fetch())
					{
						$details['id']			=	$id;
						$details['name']		=	$name;
						$details['email']		=	$email;
						$details['mobile_no']	=	$mobile_no;
						$details['password']	=	$password;
						$details['other_mobile_no']	=	$other_mobile_no;
						$details['address']		=	$address;
						$details['state']		=	$state;
						if($actual_file_name1=='')
						{
						    	$details['photo']		=	"NULL";
						}
						else
						{
						    	$details['photo']		=	$actual_file_name1;
						}
					    if($actual_file_name2=='')
						{
						    	$details['sign']		=	"NULL";
						}
						else
						{
						     $details['sign']		=	$actual_file_name2;
						}
					
						$details['token']		=	$token;
						$details['city']		=	$city;
						return $details;
					}
					return false;
				}	
			}
	}
	/*function get_all_question_paper_details()
	{
		if($stmt_insert = $this->con->prepare("SELECT `id`, `title`, `attachment`, `date`, `time` FROM `question_paper`"))
		{	
			$stmt_insert->bind_result($id,$title,$attachment,$date,$res_time);
			
			if($stmt_insert->execute())
			{ 
					$counter	=	0;
					$details	=	array();
				while($stmt_insert->fetch())
				{ 
					$details[$counter][0]	=	$id;
					$details[$counter][1]	=	$title;
					$details[$counter][2]	=	$attachment;
					$details[$counter][3]	=	$date;
					$details[$counter][4]	=	$res_time;
					
					$counter++;
				}
				if(!empty($details))	
				{
					return $details;
				}
				return false;
			}	
		}	
	}*/
	function get_question_paper_by_id($up_id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `id`, `title`, `attachment`, `date`, `time` FROM `question_paper` WHERE `id`=? "))
		{	
			$stmt_insert->bind_param("s",$up_id);
			$stmt_insert->bind_result($id,$title,$attachment,$date,$res_time);
			
			if($stmt_insert->execute())
			{ 
					$counter	=	0;
					$details	=	array();
				if($stmt_insert->fetch())
				{ 
					$details[0]	=	$id;
					$details[1]	=	$title;
					$details[2]	=	$attachment;
					$details[3]	=	$date;
					$details[4]	=	$res_time;
					
					return $details;

				}
				else
				{
					return false;
				}
			}	
		}	
	}
	function update_question($up_id,$title)
	{
		if($stmt_insert = $this->con->prepare("UPDATE `question_paper` SET `title`=? WHERE `id`=?"))
		{
			$stmt_insert->bind_param("si",$title,$up_id);
			
			if($stmt_insert->execute())
			{
				return true;
			}
				return false;
		} 	
	}
	function update_question_paper($up_id,$actual_image_name)
	{
		if($stmt_insert = $this->con->prepare("UPDATE `question_paper` SET `attachment`=? WHERE `id`=?"))
		{
			$stmt_insert->bind_param("si",$actual_image_name,$up_id);
			
			if($stmt_insert->execute())
			{
				return true;
			}
				return false;
		} 	
	}
	
	function subscription_data_details()
	{
		if($stmt_insert = $this->con->prepare("SELECT `id`, `title`, `rate`,`no_of_papers`,`package_description` FROM `package` ORDER BY `id` DESC"))
		{	
			$stmt_insert->bind_result($id,$title,$rate,$no_of_papers,$package_description);
			
			if($stmt_insert->execute())
			{
					$counter	=	0;
					$details	=	array();
				while($stmt_insert->fetch())
				{
					$details[$counter]['id']					=	$id;
					$details[$counter]['title']				=	$title;
					$details[$counter]['rate']				=	$rate;
					$details[$counter]['no_of_papers']		=	$no_of_papers;
					$details[$counter]['package_description']	=	$package_description;
				
					$counter++;
				}
				if(!empty($details))	
				{
					return $details;
				}
				return false;
			}	
		}
	}
	function get_all_question_paper_details_api()
	{
		if($stmt_insert = $this->con->prepare("SELECT `id`, `title`, `attachment`, `date`, `time` FROM `question_paper`"))
		{	
			$stmt_insert->bind_result($id,$title,$attachment,$date,$res_time);
			
			if($stmt_insert->execute())
			{ 
					$counter	=	0;
					$details	=	array();
				while($stmt_insert->fetch())
				{ 
					$details[$counter]['id']			=	$id;
					$details[$counter]['title']		=	$title;
					$details[$counter]['attachment']	=	$attachment;
					$details[$counter]['date']		=	$date;
					$details[$counter]['time']		=	$res_time;
					
					$counter++;
				}
				if(!empty($details))	
				{
					return $details;
				}
				return false;
			}	
		}	
	}
	function get_question_id_exist($id,$mobile_no)
	{
		if($stmt_insert = $this->con->prepare("SELECT `id` FROM `question_paper_answers` WHERE `question_id`=? AND `user_id`=?"))
		{	
			$stmt_insert->bind_param("ss",$id,$mobile_no);
			
			$stmt_insert->bind_result($res_id);
			
			if($stmt_insert->execute())
			{
				if($stmt_insert->fetch())
				{
					return $res_id;
				}
				return false;
			}	
		}
	
	}
	//1-1-2020
	function create_containt_category($title,$rate)
	{
		$date = date("Y-m-d");
		$time = date("H-i-s A");
		
		if($stmt_insert = $this->con->prepare("INSERT INTO `containt_category`(`title`, `amount`, `date`, `time`) VALUES (?,?,?,?)"))
		{
			$stmt_insert->bind_param("ssss",$title,$rate,$date,$time);
			
			if($stmt_insert->execute())
			{
				return true;
			}
				return false;
		} 	
	}
	function delete_containt_category($del_id)
	{
		if($stmt_select = $this->con->prepare("DELETE FROM `containt_category` WHERE `id`=?"))
		{
			$stmt_select->bind_param("i",$del_id);
		
			if($stmt_select->execute())
			{					
					return true;
			}
				return false;
		}
	}
	function get_all_containt_category_details()
	{
		if($stmt_insert = $this->con->prepare("SELECT `id`, `title`, `amount`  FROM `containt_category` ORDER BY `id` DESC"))
		{	
			$stmt_insert->bind_result($id,$title,$amount);
			
			if($stmt_insert->execute())
			{
					$counter	=	0;
					$details	=	array();
				while($stmt_insert->fetch())
				{
					$details[$counter]['id']				=	$id;
					$details[$counter]['title']				=	$title;
					$details[$counter]['amount']			=	$amount;
					
				
					$counter++;
				}
				if(!empty($details))	
				{
					return $details;
				}
				return false;
			}	
		}
	}
	function update_containt_category($up_id,$title,$rate)
	{
		if($stmt_insert = $this->con->prepare("UPDATE `containt_category` SET `title`=?,`amount`=? WHERE `id`=?"))
		{
			$stmt_insert->bind_param("ssi",$title,$rate,$up_id);
			
			if($stmt_insert->execute())
			{
				return true;
			}
				return false;
		} 	
	}
	function get_all_category_by_id($up_id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `id`, `title`, `amount`  FROM `containt_category` WHERE `id`=?"))
		{	
			$stmt_insert->bind_param("i",$up_id);
			
			$stmt_insert->bind_result($id,$title,$rate);
			
			if($stmt_insert->execute())
			{
					$counter	=	0;
					$details	=	array();
				if($stmt_insert->fetch())
				{
					$details[0]	=	$id;
					$details[1]	=	$title;
					$details[2]	=	$rate;
					
					return $details;
				}
				else
				{
					return false;
				}
			}	
		}
	}
 function update_upi_id($title)
{
	if($stmt_select = $this->con->prepare("UPDATE `upi` SET `upi_id`=?"))
	{
		$stmt_select->bind_param("s",$title);				
	
		if($stmt_select->execute())
		{					
			return true;
		}
			return false;
	}	
}
function get_upi_id()
{
	if($stmt_insert = $this->con->prepare("SELECT  `upi_id` FROM `upi` "))
	{	
		$stmt_insert->bind_result($upi_id);
		
		if($stmt_insert->execute())
		{
			if($stmt_insert->fetch())
			{
				return $upi_id;
			}
			return false;
		}	
	}
}
function upload_containt_category($mobile_no,$containt_id,$pdf,$containt_count,$total_amount)
{
		$date = date("Y-m-d");
		$time = date("H-i-s A");
		
		if($stmt_insert = $this->con->prepare("INSERT INTO `containt_category_upload`(`mobile_no`, `containt_id`, `pdf`, `containt_count`, `total_amount`, `date`, `time`) VALUES  (?,?,?,?,?,?,?)"))
		{
			$stmt_insert->bind_param("sssssss",$mobile_no,$containt_id,$pdf,$containt_count,$total_amount,$date,$time);
			
			if($stmt_insert->execute())
			{
				return true;
			}
				return false;
		} 	
}
//2-1-2020
function buy_subscription($mobile_no,$subscription_id,$amount,$no_of_paper,$added_by)
{
		$date = date("Y-m-d");
		$time = date("H-i-s A");
		$status="Active";
		if($stmt_insert = $this->con->prepare("INSERT INTO `package_buy`(`mobile_no`, `packge_id`, `amount`, `no_of_papers`, `date`, `time`,`added_by`,`status`) VALUES  (?,?,?,?,?,?,?,?)"))
		{
			$stmt_insert->bind_param("ssssssss",$mobile_no,$subscription_id,$amount,$no_of_paper,$date,$time,$added_by,$status);
			
			if($stmt_insert->execute())
			{
				return true;
			}
				return false;
		} 	
}
	function get_all_my_subscription_details_api($mobile_no)
	{
		if($stmt_insert = $this->con->prepare("SELECT `id`, `mobile_no`, `packge_id`, `amount`, `no_of_papers`, `date`, `time` FROM `package_buy` WHERE `mobile_no`=?"))
		{	
			$stmt_insert->bind_param("s",$mobile_no);

			$stmt_insert->bind_result($id,$mobile_no,$packge_id,$amount,$no_of_papers,$date,$time);
			
			if($stmt_insert->execute())
			{ 
					$counter	=	0;
					$details	=	array();
				while($stmt_insert->fetch())
				{ 
					$details[$counter]['id']			=	$id;
					$details[$counter]['mobile_no']		=	$mobile_no;
					$details[$counter]['packge_id']		=	$packge_id;
					$details[$counter]['amount']		=	$amount;
					$details[$counter]['no_of_papers']	=	$no_of_papers;
					$details[$counter]['date']			=	$date;
					$details[$counter]['time']			=	$time;

					$counter++;
				}
				if(!empty($details))	
				{
					return $details;
				}
				return false;
			}	
		}	
	}
	function get_all_my_subscription_details_all($from_date,$to_date,$package_name)
	{
		$from_date = date("Y-m-d" , strtotime($from_date));
		$to_date   = date("Y-m-d" , strtotime($to_date));
		$stmt	   =	"";
		if($package_name=='all')
		{
			$stmt=" AND `packge_id` LIKE '%%'";
		}
		else
		{
			$stmt=" AND `packge_id` = '".$package_name."'";
		}
	
		if($stmt_insert = $this->con->prepare("SELECT `id`, `mobile_no`, `packge_id`, `amount`, `no_of_papers`, `date`, `time`,`added_by`,`status` FROM `package_buy` WHERE  `date` BETWEEN '$from_date' AND '$to_date'  ".$stmt))
		{	

			$stmt_insert->bind_result($id,$mobile_no,$packge_id,$amount,$no_of_papers,$date,$time,$added_by,$status);
			
			if($stmt_insert->execute())
			{ 
					$counter	=	0;
					$details	=	array();
				while($stmt_insert->fetch())
				{ 
					$details[$counter]['id']			=	$id;
					$details[$counter]['mobile_no']		=	$mobile_no;
					$details[$counter]['packge_id']		=	$packge_id;
					$details[$counter]['amount']		=	$amount;
					$details[$counter]['no_of_papers']	=	$no_of_papers;
					$details[$counter]['date']			=	$date;
					$details[$counter]['time']			=	$time;
					$details[$counter]['added_by']		=	$added_by;
					$details[$counter]['status']		=	$status;
					$counter++;
				}
				if(!empty($details))	
				{
					return $details;
				}
				return false;
			}	
		}	
	}
	
	//
	function get_package_name_exist($pkg_id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `title` FROM `package` WHERE `id`=?"))
		{	
			$stmt_insert->bind_param("i",$pkg_id);
			
			$stmt_insert->bind_result($title);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $title;
				}
				return false;
			}	
		}
	}
	
	//2-1-2020
	function get_sum_of_no_of_test_purchace($mobile_no)
	{
		if($stmt_insert = $this->con->prepare("SELECT SUM(`no_of_papers`)  FROM `package_buy` WHERE `mobile_no`=?"))
		{	
			$stmt_insert->bind_param("s",$mobile_no);
			
			$stmt_insert->bind_result($no_of_papers);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $no_of_papers;
				}
				return false;
			}	
		}
	}
	function get_sum_of_counted_answer_sheet($mobile_no)
	{
		if($stmt_insert = $this->con->prepare("SELECT count(`id`) FROM `question_paper_answers` WHERE `user_id`=?"))
		{	
			$stmt_insert->bind_param("s",$mobile_no);
			
			$stmt_insert->bind_result($res_id);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $res_id;
				}
				return false;
			}	
		}
	}
	//2-1-2020
	function get_student_data_new()
	{
		if($stmt = $this->con->prepare("SELECT `name` , `contact` FROM `registrations`"))
		{	
			
			$stmt->bind_result($name,$contact);
			
			if($stmt->execute())
			{
					$counter	=	0;
					$details	=	array();
				while($stmt->fetch())
				{
					$details[$counter][0]	=	$name;
					$details[$counter][1]	=	$contact;
					$counter++;
				}
				if(!empty($details))	
				{
					return $details;
				}
				return false;
			}	
		}
	}
	function update_subscription_as_active($active)
	{
		$user_status=	"Active";
		
		if($stmt_select = $this->con->prepare("UPDATE `package_buy` SET `status`=? WHERE `id`=?"))
		{
			$stmt_select->bind_param("si",$user_status,$active);				
		
			if($stmt_select->execute())
			{					
				return true;
			}
				return false;
		}
	}
	
	function update_subscription_as_block($block)
	{
		$user_status	=	"Block";
		
		if($stmt_select = $this->con->prepare("UPDATE `package_buy` SET `status`=? WHERE `id`=?"))
		{
			$stmt_select->bind_param("si",$user_status,$block);				
		
			if($stmt_select->execute())
			{					
				return true;
			}
				return false;
		}
	}
	//11-1-2020
	function update_user_photo($actual_file_name1,$mobile_no)
	{
		
		if($stmt_select = $this->con->prepare("UPDATE `registrations` SET `photo`=? WHERE `contact`=? "))
		{
			$stmt_select->bind_param("ss",$actual_file_name1,$mobile_no);				
		
			if($stmt_select->execute())
			{					
				return true;
			}
				return false;
		}
	}
	function remove_user_photo($mobile_no)
	{
		
		if($stmt_select = $this->con->prepare("UPDATE `registrations` SET `photo`='' WHERE `contact`=? "))
		{
			$stmt_select->bind_param("s",$mobile_no);				
		
			if($stmt_select->execute())
			{					
				return true;
			}
				return false;
		}
	}
	function remove_user_sign($mobile_no)
	{
		
		if($stmt_select = $this->con->prepare("UPDATE `registrations` SET `sign`='' WHERE `contact`=? "))
		{
			$stmt_select->bind_param("s",$mobile_no);				
		
			if($stmt_select->execute())
			{					
				return true;
			}
				return false;
		}
	}
	function update_user_sign($actual_file_name1,$mobile_no)
	{
		
		if($stmt_select = $this->con->prepare("UPDATE `registrations` SET `sign`=? WHERE `contact`=? "))
		{
			$stmt_select->bind_param("ss",$actual_file_name1,$mobile_no);				
		
			if($stmt_select->execute())
			{					
				return true;
			}
				return false;
		}
	}
	//11-1-new
	function add_staff($staff_name,$email,$mobile_no,$password,$address)
	{
		$date = date("Y-m-d");
		$time = date("H-i-s A");
		
		if($stmt_insert = $this->con->prepare("INSERT INTO `staff_panel`(`staff_name`, `email`, `mobile_no`, `password`, `address`, `date`, `time`)  VALUES  (?,?,?,?,?,?,?)"))
		{
			$stmt_insert->bind_param("sssssss",$staff_name,$email,$mobile_no,$password,$address,$date,$time);
			
			if($stmt_insert->execute())
			{
				return true;
			}
				return false;
		} 	
	}
	
	function get_staff_password_from_mobile_no($mobile_no)
	{
		if($stmt_insert = $this->con->prepare("SELECT `password` FROM `staff_panel` WHERE `mobile_no`=?"))
		{	
			$stmt_insert->bind_param("s",$mobile_no);
			
			$stmt_insert->bind_result($title);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $title;
				}
				return false;
			}	
		}
	}
	 function get_all_staff_reg_details($from_date,$to_date)
	{ 
		$from_date = date("Y-m-d" , strtotime($from_date));
		$to_date = date("Y-m-d" , strtotime($to_date));
		
		if($stmt_select = $this->con->prepare("SELECT `id`, `staff_name`, `email`, `mobile_no`, `password`, `address` FROM `staff_panel`  WHERE  `date` BETWEEN '$from_date' AND '$to_date'"))
		{	
			
			$stmt_select->bind_result($id,$name,$email,$contact,$password,$address);
			
			if($stmt_select->execute())
			{ 
					$counter	=	0;
					$details	=	array();
				while($stmt_select->fetch())
				{ 
					$details[$counter][0]	=	$id;
					$details[$counter][1]	=	$name;
					$details[$counter][2]	=	$email;
					$details[$counter][3]	=	$contact;
					$details[$counter][4]	=	$password;
					$details[$counter][5]	=	$address;
					
					$counter++;
				}
				if(!empty($details))	
				{
					return $details;
				}
				return false;
			}	
		}
	}
	function delete_staff_registration($del_id)
	{
		if($stmt_select = $this->con->prepare("Delete from `staff_panel` where `id`=?"))
		{
			$stmt_select->bind_param("i",$del_id);
		
			if($stmt_select->execute())
			{					
					return true;
			}
				return false;
		}
	}
	function get_staff_password_from_mobile_no_edit($mobile_no,$up_id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `id` FROM `staff_panel` WHERE `mobile_no`=? AND `id`!=? "))
		{	
			$stmt_insert->bind_param("ss",$mobile_no,$up_id);
			
			$stmt_insert->bind_result($title);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $title;
				}
				return false;
			}	
		}
	}
	function update_staff($staff_name,$email,$mobile_no,$password,$address,$up_id)
	{
		if($stmt_select = $this->con->prepare("UPDATE `staff_panel` SET `staff_name`=?,`email`=?,`mobile_no`=?,`password`=?,`address`=? WHERE `id`=?"))
		{
			$stmt_select->bind_param("ssssss",$staff_name,$email,$mobile_no,$password,$address,$up_id);				
		
			if($stmt_select->execute())
			{					
				return true;
			}
				return false;
		}
	}
	
	function get_all_staff_reg_details_by_id($up_id)
	{ 
		
		if($stmt_select = $this->con->prepare("SELECT `id`, `staff_name`, `email`, `mobile_no`, `password`, `address` FROM `staff_panel`  WHERE  `id`=?"))
		{	
			
			$stmt_select->bind_param("i",$up_id);
			$stmt_select->bind_result($id,$name,$email,$contact,$password,$address);
			
			if($stmt_select->execute())
			{ 
					$counter	=	0;
					$details	=	array();
				if($stmt_select->fetch())
				{ 
					$details[0]	=	$id;
					$details[1]	=	$name;
					$details[2]	=	$email;
					$details[3]	=	$contact;
					$details[4]	=	$password;
					$details[5]	=	$address;
					
					return $details;
				}
				
				return false;
			}	
		}
	}
	function get_all_staff_reg_details_by_mobile_no($up_id)
	{ 
		
		if($stmt_select = $this->con->prepare("SELECT `id`, `staff_name`, `email`, `mobile_no`, `password`, `address` FROM `staff_panel`  WHERE  `mobile_no`=?"))
		{	
			
			$stmt_select->bind_param("s",$up_id);
			$stmt_select->bind_result($id,$name,$email,$contact,$password,$address);
			
			if($stmt_select->execute())
			{ 
					$counter	=	0;
					$details	=	array();
				if($stmt_select->fetch())
				{ 
					$details[0]	=	$id;
					$details[1]	=	$name;
					$details[2]	=	$email;
					$details[3]	=	$contact;
					$details[4]	=	$password;
					$details[5]	=	$address;
					
					return $details;
				}
				
				return false;
			}	
		}
	}
	
	function change_staff_password($password,$result_id)
	{
		if($stmt_insert = $this->con->prepare("UPDATE `staff_panel` SET `password`=? WHERE `mobile_no`=?"))
		{
		
			$stmt_insert->bind_param("ss",$password,$result_id);
			
			if($stmt_insert->execute())
			{ 
				return true;
			}
			return false;
		} 
	}
	function get_all_staff_reg_details_all()
	{ 
		
		
		if($stmt_select = $this->con->prepare("SELECT `id`, `staff_name`, `email`, `mobile_no`, `password`, `address` FROM `staff_panel` "))
		{	
			
			$stmt_select->bind_result($id,$name,$email,$contact,$password,$address);
			
			if($stmt_select->execute())
			{ 
					$counter	=	0;
					$details	=	array();
				while($stmt_select->fetch())
				{ 
					$details[$counter][0]	=	$id;
					$details[$counter][1]	=	$name;
					$details[$counter][2]	=	$email;
					$details[$counter][3]	=	$contact;
					$details[$counter][4]	=	$password;
					$details[$counter][5]	=	$address;
					
					$counter++;
				}
				if(!empty($details))	
				{
					return $details;
				}
				return false;
			}	
		}
	}
	
	//12-1--2020
	function check_staff_assign_or_not($user_id,$question_id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `staff_assign`  FROM `question_paper_answers` WHERE `question_id`=? AND `user_id`=?"))
		{	
			$stmt_insert->bind_param("ss",$question_id,$user_id);
			
			$stmt_insert->bind_result($title);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $title;
				}
				return false;
			}	
		}
	}
	function set_staff_for_answer_key($user_id,$question_id,$select_staff)
	{
		//echo $user_id,$question_id,$select_staff;
		if($stmt_insert = $this->con->prepare("UPDATE `question_paper_answers` SET `staff_assign`=? WHERE `question_id`=? AND `user_id`=?"))
		{
		
			$stmt_insert->bind_param("sss",$select_staff,$question_id,$user_id);
			
			if($stmt_insert->execute())
			{ 
				return true;
			}
			return false;
		} 
	}
	function get_all_answer_keys_details_assign_to_staff($staff_assign)
	{
		if($stmt_insert = $this->con->prepare("SELECT  `user_id`,`question_id`,`answer_attachment` FROM `question_paper_answers` WHERE `staff_assign`=?"))
		{	
			$stmt_insert->bind_param("s",$staff_assign);
			$stmt_insert->bind_result($user_id,$question_id,$answer_attachment);
			
			if($stmt_insert->execute())
			{ 
					$counter	=	0;
					$details	=	array();
				while($stmt_insert->fetch())
				{ 
					$details[$counter][0]	=	$user_id;
					$details[$counter][1]	=	$question_id;
					$details[$counter][2]	=	$answer_attachment;
					$counter++;
				}
				if(!empty($details))	
				{
					return $details;
				}
				return false;
			}	
		}	
	}
	
	function set_checked_status_for_answer_key($user_id,$question_id)
	{
		if($stmt_insert = $this->con->prepare("UPDATE `question_paper_answers` SET `checked_status`='checked' WHERE `question_id`=? AND `user_id`=?"))
		{
		
			$stmt_insert->bind_param("ss",$question_id,$user_id);
			
			if($stmt_insert->execute())
			{ 
				return true;
			}
			return false;
		} 
	}
	function get_all_answer_keys_details_checked_by_staff()
	{
		if($stmt_insert = $this->con->prepare("SELECT DISTINCT `user_id`,`question_id` FROM `question_paper_answers` WHERE `checked_status`='checked' "))
		{	
			
			$stmt_insert->bind_result($user_id,$question_id);
			
			if($stmt_insert->execute())
			{ 
					$counter	=	0;
					$details	=	array();
				while($stmt_insert->fetch())
				{ 
					$details[$counter][0]	=	$user_id;
					$details[$counter][1]	=	$question_id;
					
					$counter++;
				}
				if(!empty($details))	
				{
					return $details;
				}
				return false;
			}	
		}	
	}
	function get_answer_key_id($question_id,$user_id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `id` FROM `question_paper_answers` WHERE `question_id`=? AND `user_id`=?"))
		{	
			$stmt_insert->bind_param("ss",$question_id,$user_id);
			
			$stmt_insert->bind_result($res_id);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $res_id;
				}
				return false;
			}	
		}
	}
	function get_staff_name($mobile_no)
	{
		if($stmt_insert = $this->con->prepare("SELECT `staff_name` FROM `staff_panel` WHERE `mobile_no`=?"))
		{	
			$stmt_insert->bind_param("s",$mobile_no);
			
			$stmt_insert->bind_result($res_id);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $res_id;
				}
				return false;
			}	
		}
	}
	function check_checked_status_assign_or_not($user_id,$question_id)
	{
		if($stmt_insert = $this->con->prepare("SELECT `checked_status`  FROM `question_paper_answers` WHERE `question_id`=? AND `user_id`=?"))
		{	
			$stmt_insert->bind_param("ss",$question_id,$user_id);
			
			$stmt_insert->bind_result($title);
			
			if($stmt_insert->execute())
			{ 
				if($stmt_insert->fetch())
				{ 
					return $title;
				}
				return false;
			}	
		}
	}
	function change_user_password_new($password,$result_id)
	{
		if($stmt_insert = $this->con->prepare("UPDATE `registrations` SET `password`=? WHERE `contact`=?"))
		{
		
			$stmt_insert->bind_param("ss",$password,$result_id);
			
			if($stmt_insert->execute())
			{ 
				return true;
			}
			return false;
		} 
	}
	function get_checked_status($id,$mobile_no)
	{
		if($stmt_insert = $this->con->prepare("SELECT `checked_status` FROM `question_paper_answers` WHERE `question_id`=? AND `user_id`=?"))
		{	
			$stmt_insert->bind_param("ss",$id,$mobile_no);
			
			$stmt_insert->bind_result($res_id);
			
			if($stmt_insert->execute())
			{
				if($stmt_insert->fetch())
				{
					return $res_id;
				}
				return false;
			}	
		}
	
	}
	function get_file_attachment($id,$mobile_no)
	{
		if($stmt_insert = $this->con->prepare("SELECT `answer_attachment` FROM `question_paper_answers` WHERE `question_id`=? AND `user_id`=?"))
		{	
			$stmt_insert->bind_param("ss",$id,$mobile_no);
			
			$stmt_insert->bind_result($res_id);
			
			if($stmt_insert->execute())
			{
				if($stmt_insert->fetch())
				{
					return $res_id;
				}
				return false;
			}	
		}
	
	}

    //30-1-2020
	function get_all_contact_us_details()
	{
		if($stmt=$this->con->prepare("SELECT `id`, `name`, `email`, `contact_no`, `message`, `date`, `time` FROM `contact_us` "))
		{
		
			$stmt->bind_result($res_id,$full_name,$email,$contact_no,$message,$date,$time);
			if($stmt->execute())
			{

				$getdata	=	array();
				$counter	=	0;
				while($stmt->fetch())
				{
					$getdata[$counter][0]=$res_id;
					$getdata[$counter][1]=$full_name;
					$getdata[$counter][2]=$email;
					$getdata[$counter][3]=$contact_no;
					$getdata[$counter][4]=$message;
					$getdata[$counter][5]=$date;
					$getdata[$counter][6]=$time;
					
					$counter++;
				}
				if(!empty($getdata))
				{
					return $getdata;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
				
		}
	}
	function delete_contact_record($delete_id)
	{
		if($stmt= $this->con->prepare("DELETE FROM `contact_us` WHERE `id`=?"))
		 {
			$stmt->bind_param("i",$delete_id);
			if($stmt->execute())
			{
				return true;
			}
		}
		else
		{
		return false;
		}
	}
	function save_slider_image($actual_image_name,$url)
	{
		$date = date("Y-m-d");
		$time = date("h:i:s t");
		
		if($stmt=$this->con->prepare("INSERT INTO `slider_images_app`(`image`, `date`, `time`,`url`) VALUES (?,?,?,?)"))
		{
			$stmt->bind_param("ssss",$actual_image_name,$date,$time,$url);
			
			if($stmt->execute())
			{
				return true;
			}
			else
			{
			    echo $stmt->error;
			}
		}
		else
		{
			return false;
		}
	}
	
	function get_all_slider_image_details()
	{
		if($stmt=$this->con->prepare("SELECT `id`, `image`,`url` FROM `slider_images_app` ORDER BY `id` DESC"))
		{
		
			$stmt->bind_result($res_id,$image,$url);
			if($stmt->execute())
			{

				$getdata	=	array();
				$counter	=	0;
				while($stmt->fetch())
				{
					$getdata[$counter]['res_id']=$res_id;
					$getdata[$counter]['image']=$image;
					$getdata[$counter]['image_url']=$url;
					$counter++;
				}
				if(!empty($getdata))
				{
					return $getdata;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
				
		}
	}
	function delete_slider_image_record($delete_id)
	{
		if($stmt= $this->con->prepare("DELETE FROM `slider_images_app` WHERE `id`=?"))
		 {
			$stmt->bind_param("i",$delete_id);
			if($stmt->execute())
			{
				return true;
			}
		}
		else
		{
		return false;
		}
	}
	function update_url($url,$edit_id)
	{
		if($stmt=$this->con->prepare("UPDATE `slider_images_app` SET `url`=? WHERE `id`=?"))
		{
			$stmt->bind_param("si",$url,$edit_id);
			
			
			if($stmt->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
	function get_slider_details_by_id($edit_id)
	{
		if($stmt=$this->con->prepare("SELECT `id`, `image`,`url` FROM `slider_images_app` WHERE `id`=?"))
		{
			
			$stmt->bind_param("i",$edit_id);
			
			$stmt->bind_result($res_id,$image,$url);
			if($stmt->execute())
			{
				$getdata	=	array();
				if($stmt->fetch())
				{
						$getdata[0]	=$res_id;
						$getdata[1]	=$image;
						$getdata[2]	=$url;
						
					return $getdata;
				}
			}
		}
	}
	function get_icon_from_slider($edit_id)
	{
		
		if($stmt_select = $this->con->prepare("SELECT  `image` FROM `slider_images_app` WHERE `id`=?"))
			{	
				
				$stmt_select->bind_param("i",$edit_id);
				$stmt_select->bind_result($icon);
			
				if($stmt_select->execute())
				{
					if($stmt_select->fetch())
					{
						return $icon;
					}
				}
				return false;
			}		
	}
	function update_icon_in_slider($edit_id,$actual_image_name)
	{
		
		if($stmt=$this->con->prepare("UPDATE `slider_images_app` SET `image`=?  WHERE `id`=?"))
			{
				$stmt->bind_param("si",$actual_image_name,$edit_id);
				
				if($stmt->execute())
				{
					return true;
				}
			}
			else
			{
				return false;
			}
	}
	function delete_icon_from_slider($edit_id)
	{
		if($stmt=$this->con->prepare("UPDATE `slider_images_app` SET `image`=''  WHERE `id`=?"))
		{
			$stmt->bind_param("i",$edit_id);
			
			if($stmt->execute())
			{
				return true;
			}
		}
		else
		{
			return false;
		}
	}
	function get_link_exist($link)
	{ 
		if($stmt=$this->con->prepare("SELECT `id` FROM `link` WHERE `link`=?"))
		{
			$stmt->bind_param("s",$link);
			
			$stmt->bind_result($res_id);
			
			if($stmt->execute())
			{
				if($stmt->fetch())
				{
					return $res_id;
				}
			}
			else
			{
				return false;
			}
		}
		
	}
	
	function save_link($link_title,$link,$actual_image_name)
	{
		$date = date("Y-m-d");
		$time = date("h:i:s t");
		
		if($stmt=$this->con->prepare("INSERT INTO `link`(`link_title`, `link`, `icon`, `date`, `time`) VALUES (?,?,?,?,?)"))
		{
			$stmt->bind_param("sssss",$link_title,$link,$actual_image_name,$date,$time);
			
			if($stmt->execute())
			{
				return true;
			}
		}
		else
		{
			return false;
		}
	}
	
	function get_all_link_details()
	{
		if($stmt=$this->con->prepare("SELECT `id`, `link_title`, `link`, `icon`, `date`, `time` FROM `link` ORDER BY `id` DESC "))
		{
		
			$stmt->bind_result($res_id,$link_title,$link,$icon,$date,$time);
			if($stmt->execute())
			{

				$getdata	=	array();
				$counter	=	0;
				while($stmt->fetch())
				{
					$getdata[$counter][0]=$res_id;
					$getdata[$counter][1]=$link_title;
					$getdata[$counter][2]=$link;
					$getdata[$counter][3]=$icon;
					$getdata[$counter][4]=$date;
					$getdata[$counter][5]=$time;
					$counter++;
				}
				if(!empty($getdata))
				{
					return $getdata;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
				
		}
	}
	
	function delete_link_record($delete_id)
	{
		if($stmt= $this->con->prepare("DELETE FROM `link` WHERE `id`=?"))
		 {
			$stmt->bind_param("i",$delete_id);
			if($stmt->execute())
			{
				return true;
			}
		}
		else
		{
		return false;
		}
	}
	function update_link($link_title,$link,$edit_id)
	{
		if($stmt=$this->con->prepare("UPDATE `link` SET `link_title`=? , `link`=?  WHERE `id`=?"))
		{
			$stmt->bind_param("ssi",$link_title,$link,$edit_id);
			
			
			if($stmt->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
	function get_link_details_by_id($edit_id)
	{
		if($stmt=$this->con->prepare("SELECT `id`, `link_title`, `link`, `icon` FROM `link` WHERE `id`=?"))
		{
			
			$stmt->bind_param("i",$edit_id);
			
			$stmt->bind_result($res_id,$link_title,$link,$icon);
			if($stmt->execute())
			{
				$getdata	=	array();
				if($stmt->fetch())
				{
						$getdata[0]	=$res_id;
						$getdata[1]	=$link_title;
						$getdata[2]	=$link;
						$getdata[3]	=$icon;
						
					return $getdata;
				}
			}
		}
	}
	function get_icon_from_link($edit_id)
	{
		
		if($stmt_select = $this->con->prepare("SELECT  `icon` FROM `link` WHERE `id`=?"))
			{	
				
				$stmt_select->bind_param("i",$edit_id);
				$stmt_select->bind_result($icon);
			
				if($stmt_select->execute())
				{
					if($stmt_select->fetch())
					{
						return $icon;
					}
				}
				return false;
			}		
	}
	function update_icon_in_link($edit_id,$actual_image_name)
	{
		
		if($stmt=$this->con->prepare("UPDATE `link` SET `icon`=?  WHERE `id`=?"))
			{
				$stmt->bind_param("si",$actual_image_name,$edit_id);
				
				if($stmt->execute())
				{
					return true;
				}
			}
			else
			{
				return false;
			}
	}
	function delete_icon_from_link($edit_id)
	{
		if($stmt=$this->con->prepare("UPDATE `link` SET `icon`=''  WHERE `id`=?"))
		{
			$stmt->bind_param("i",$edit_id);
			
			if($stmt->execute())
			{
				return true;
			}
		}
		else
		{
			return false;
		}
	}
	function get_all_link_details_api()
	{
		if($stmt=$this->con->prepare("SELECT `id`, `link_title`, `link`, `icon`  FROM `link` ORDER BY `link_title` ASC "))
		{
		
			$stmt->bind_result($res_id,$title,$link,$icon);
			if($stmt->execute())
			{

				$getdata	=	array();
				$counter	=	0;
				while($stmt->fetch())
				{
					$getdata[$counter]['res_id']=$res_id;
					$getdata[$counter]['title']=$title;
					$getdata[$counter]['link']=$link;
					$getdata[$counter]['icon']=$icon;
					$counter++;
				}
				if(!empty($getdata))
				{
					return $getdata;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
				
		}
	}
	}//END
?>