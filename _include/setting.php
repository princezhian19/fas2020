<?php
ob_start();
	date_default_timezone_set('Asia/Manila');
	error_reporting(0);
	ini_set('display_errors', 0);
	session_start();

	// Set error reporting
	//error_reporting(E_USER_ERROR | E_USER_WARNING | E_ERROR | E_WARNING | E_PARSE);
	
	//set_error_handler('error_handler');

	function error_handler($errno, $errmsg, $filename, $linenum, $vars)
	{
		// timestamp for the error entry
		//$dt = date("Y-m-d H:i:s (T)");
	
		// define an assoc array of error string
		// in reality the only entries we should consider are E_WARNING, E_NOTICE, E_USER_ERROR, E_USER_WARNING and E_USER_NOTICE
		$errortype = array (
					E_ERROR              => 'Error',
					E_WARNING            => 'Warning',
					E_PARSE              => 'Parsing Error',
					E_NOTICE             => 'Notice',
					E_CORE_ERROR         => 'Core Error',
					E_CORE_WARNING       => 'Core Warning',
					E_COMPILE_ERROR      => 'Compile Error',
					E_COMPILE_WARNING    => 'Compile Warning',
					E_USER_ERROR         => 'User Error',
					E_USER_WARNING       => 'User Warning',
					E_USER_NOTICE        => 'User Notice',
					E_STRICT             => 'Runtime Notice',
					E_RECOVERABLE_ERROR  => 'Catchable Fatal Error'
					);
		//print_r($errortype);
		// set of errors for which a administrator must notify
		$user_errors = array(E_USER_ERROR, E_USER_WARNING, E_ERROR, E_WARNING, E_PARSE, E_CORE_ERROR, E_CORE_WARNING, E_COMPILE_ERROR, E_COMPILE_WARNING, E_RECOVERABLE_ERROR);
		//$user_errors = array(E_ERROR, E_WARNING, E_USER_ERROR, E_USER_WARNING);	
	
		$error = "[ERROR: $errortype[$errno]][$errno] - [$errmsg][$filename on line $linenum]";
		$emailerror = "$errortype[$errno] : [Error on $filename in line number $linenum]\r\n$errmsg";
			
		if (in_array($user_errors[$errno], $user_errors)) 
		{
			//email me
			//echo "Need Urgent Attention ".$errortype[$errno];
			$_SESSION['err'] = $emailerror;
			header('Location: error.php');	
			exit();
						
			if (txtlogs($error))    // logs error to txt file
			{
				// do something ....when logs error save to txtfile
				//activitylog($_SESSION['Account_Name'], $_SESSION['Account_Username'], "ERROR Encountered", $error);
				//$_SESSION['error_msg'] .= $error . "|";				
			}						
		}		
	}

?>