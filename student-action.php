<?php
	session_start();
	require_once("./phpincludes/commonfunctions.php");
	//require_once("./phpincludes/connection.php");
	include("./phpincludes/smtp-details.php");
	//require("class.phpmailer.php");
	//require_once("./phpincludes/class.phpmailer.php");
	//print_r($_POST);
	//exit();
	
	date_default_timezone_set('asia/kolkata');
	
	if(isset($_POST['StudentName']) && $_POST['StudentName'] != "")
	{	
		if(!preg_match("/[A-Za-z]/", $_POST['StudentName']))
		{
			$_SESSION['Error'] = "Invalid Data";
			$_SESSION['Post'] = $_POST;
			header("Location:".$_SERVER['HTTP_REFERER']);
			exit();
		}
		if(!preg_match("/^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$/", $_POST['StudentEmail']))
		{
			$_SESSION['Error'] = "Invalid Data";
			$_SESSION['Post'] = $_POST;
			header("Location:".$_SERVER['HTTP_REFERER']);
			exit();
		}
		if(!preg_match("/^[0-9]*$/", $_POST['StudentContact']))
		{
			$_SESSION['Error'] = "Invalid Data";
			$_SESSION['Post'] = $_POST;
			header("Location:".$_SERVER['HTTP_REFERER']);
			exit();
		}
		
	
		/*if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
		{
    		//your site secret key
    			$secret = '6LfjLjQUAAAAAJVFWKWYAr2-AibqLjEC4v07OePH';
    		//get verify response data
			
			$url = 'https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response'];		
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$verifyResponse = curl_exec($ch);
			curl_close($ch);
		
		
			$responseData = json_decode($verifyResponse);
			if($responseData->success)
			{*/
				//echo "in Response"; exit();
				$fp=fopen("./mailer/StudentMailer.html","r");
				$message= fread($fp,filesize("./mailer/StudentMailer.html"));
				
				$DateTime = convertDBDateTime(date("Y-m-d H:i:s"));
				$Subject = "Student Feedback posted by ".$_POST['name']. " on ".$DateTime;
				$_POST['RegTime']=date("Y-m-d H:i:s");
				
				$productsNew="";
				foreach($_POST['products'] as $product)
				{
					$productsNew.=$product.", ";
					
				}
				$productsNew1= substr(trim($productsNew), 0, -1);
				
				if($_POST['anyOther']!=""){
					$productsNew1 = $productsNew1.", ".$_POST['anyOther'];
				}else{
					$productsNew1 = $productsNew1;
				}	
							
				$message=str_replace('$StudentName', $_POST['StudentName'],$message);
				$message=str_replace('$StudentEmail',$_POST['StudentEmail'],$message);
				$message=str_replace('$StudentContact',$_POST['StudentContact'],$message);
				$message=str_replace('$SelectType',$_POST['SelectType'],$message);
				
				$message=str_replace('$StudentProgramName',$_POST['StudentProgramName'],$message);
				$message=str_replace('$StudentDivision',$_POST['StudentDivision'],$message);
				$message=str_replace('$StudentFeedback',$_POST['StudentFeedback'],$message);
				/*$message=str_replace('$Country',$_POST['country'],$message);
				$message=str_replace('$Company',$_POST['companyName'],$message);
				$message=str_replace('$Contact',$_POST['number'],$message);
				$message=str_replace('$Address',$_POST['address'],$message);
				$message=str_replace('$Products',$productsNew1,$message);
				$message=str_replace('$Classification',$_POST['classification'],$message);
				$message=str_replace('$Description',$_POST['description'],$message);	
				$message=str_replace('$DateTime', $DateTime,$message);*/
				
				//echo $message; exit();
				include("./class.phpmailer.php");
				$mail             = new PHPMailer1();
				$body             = $message;
				$mail->IsSMTP(); // telling the class to use SMTP
				$mail->Host       = $SmtpHost; // SMTP server
				$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
														   // 1 = errors and messages
														  // 2 = messages only
				$mail->SMTPAuth   = true;                  // enable SMTP authentication
				$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
				$mail->Host       = $SmtpHost;      // sets  as the SMTP server
				$mail->Port       = $SmtpPort;                   // set the SMTP port for the server
				$mail->Username   = $SmtpUserName;  // username
				$mail->Password   = $SmtpPassword;            // password
				//$mail->Host     = "localhost"; // SMTP servers
				//$mail->SMTPAuth = false;     // turn on SMTP authentication
				//$mail->WordWrap = 50; 
				//$mail->IsHTML(true); 
				//$mail->Subject = $Subject; 
				//$mail->Body = $body; 
				
				$mail->SetFrom($FromEmail, $_POST['name']);
				//$mail->From = $_POST['name'];
				//$mail->FromName = $_POST['email'];
				//$mail->AddAddress($sendTo);
				$mail->Subject    = $Subject;
				$mail->MsgHTML($body);
				
				$mail->AddAddress($RecipientMailId);
				$mail->AddCC($RecipientMailIdCC);
				//$mail->AddBCC("jay@dimakhconsultants.com");
				//$mail->AddBCC("dcplseo@gmail.com");
				//echo "hi"; exit();
				if(!$mail->Send()) 
				{
				 //echo "Mailer Error: " . $mail->ErrorInfo; exit;
				} 
				else 
				{
				 //echo "Message sent!"; exit;
				}
				
				header("location:./index.php/thankyou");
				exit();
				
			/*} // End of if($responseData->success)
			else
			{
				$_SESSION['SpanError'] = "Robot verification failed, please try again.";
				header("Location:./customer-support.html");
				exit();	
			}
		} // End of if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
		else
		{
			$_SESSION['SpanError'] = "Please click on the reCAPTCHA box..";
			header("Location:./customer-support.html");
			exit();	
		}*/
	} // End of if(isset($_POST['form_name']) && $_POST['form_name'] != "")
	else
	{
		header("Location:./index.php");
		exit();		
	}
	//echo $message; exit;


		/*//$sendTo="info@montverthomes.com";
		//$sendTo="contact@montverthomes.com";
		$sendTo="info@sqpgloal.com";
		//$subject="Invite Pramod" ;
		$mail = new phpmailer(); 
		$mail->IsSMTP(); 
		$mail->Mailer = "smtp"; 
		//$mail->Host = "72.51.40.40"; 
		$mail->Host     = "localhost"; // SMTP servers
		$mail->SMTPAuth = false;     // turn on SMTP authentication
		$mail->WordWrap = 50; 
		$mail->IsHTML(true); 
		$mail->Subject = $Subject; 
		$mail->Body = $message; 
		//$mail->AltBody = $content; 
		
		$mail->From = $_POST['form_email'];
		$mail->FromName = $_POST['form_name'];
		$mail->AddAddress($sendTo);
		//$mail->AddCC("onkar.pujari@kinglifestyle.com"); 
		$mail->AddBCC("aneesh@dimakhconsultants.com");
		//$mail->AddBCC("ashwini@dimakhconsultants.com"); 
	//	$mail->AddBCC("dimakh@gmail.com");
		
		if(!$mail->Send()) 
		{ 
		echo "Message was not sent <p>"; 
		echo "Mailer Error: " . $mail->ErrorInfo; 
		exit; 
		} 	*/
		
		/*include("./class.phpmailer.php");
		$mail             = new PHPMailer1();
		$body             = $message;
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host       = "localhost"; // SMTP server
		$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
												   // 1 = errors and messages
												  // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "localhost";      // sets  as the SMTP server
		$mail->Port       = 25;                   // set the SMTP port for the server
		$mail->Username   = "";  // username
		$mail->Password   = "";            // password
		
		$mail->SetFrom($_POST['Email'], "".$_POST['FirstName']." ".$_POST['LastName']."");
		$mail->Subject    = $Subject;
		$mail->MsgHTML($body);
		
	
		//$mail->AddAddress("rotarychildsafety@gmail.com"); 
		//$mail->AddBCC("priyankap@dimakhconsultants.com"); 
		$mail->AddAddress("rohit@dimakhconsultants.com"); 
		//$mail->AddBCC("ashwini@dimakhconsultants.com");
		
		if(!$mail->Send()) 
	
		{
		  echo "Mailer Error: " . $mail->ErrorInfo; exit;
		} 
		else 
		{
		 echo "Message sent!"; exit;
		}*/
		
		/*$mail = new phpmailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->Host     = "localhost"; // SMTP servers
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->WordWrap = 50;
        $mail->IsHTML(true);
        $mail->Subject = $Subject;
        $mail->From = $_POST['Email'];
        $mail->FromName = $_POST['Name'];       
        $mail->Body = $message;   

        $mail->AddAddress("info@rudrali.com");
   
		if(!$mail->Send()) 
		{
		  echo "Mailer Error: " . $mail->ErrorInfo; exit;
		} 
		else 
		{
		 echo "Message sent!"; exit;
		}*/
       // $mail->Send();               
	//error_reporting(E_ALL);
		
		/*unset($_SESSION['Post']);
		header("Location:./thank-you-invite.php");
		exit();
	}*/
?>