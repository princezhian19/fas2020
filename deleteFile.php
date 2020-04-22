<?php

require_once('includes/setting.php'); 
require_once('includes/dbaseCon.php'); 
require_once('includes/library.php'); 
require_once('includes/secure.php');

$DBConn = dbConnect();
if (!$DBConn) {
	return false;
}	

// delete records
if (!empty($_GET['id']) && !empty($_GET['i']) && !empty($_GET['d']) && !empty($_GET['t']) )
{
	if (!empty($_GET['t']) && $_GET['t'] == 'pages' )
	{
		$query = "UPDATE pages SET file='' WHERE md5(page_id) = '".md5($_GET['id'])."' LIMIT 1";							
		$checkQuery = "SELECT * FROM pages WHERE md5(page_id) = '".md5($_GET['id'])."' LIMIT 1";	
		$directory = '../files/';
		$id 	   = antiSqlinject($_GET['id']);
	
		if (ifRecordExist($checkQuery))
		{
			$queryRs = $DBConn->query( $checkQuery );				  			
			if ($queryRs->num_rows)
			{
				$row			= $queryRs->fetch_assoc();				
				$rndFilename	= $row["file"];														
	
				if ($DBConn->query( $query ))
				{
					// Display message
					if (!empty($rndFilename))
					{
						if (file_exists($directory.$rndFilename)) unlink($directory.$rndFilename);
					}
	
					$_SESSION['message'] = array("File: ".$rndFilename." deleted","INFO");			  
		
					header("Location: pages.php?option=edit&id=".$id);																	
					exit();					
					
				}		  
			}	
		}		
		else
		{
				header("Location: pages.php?option=edit&id=".$id);																	
				exit();	
		}	
	}
	
	if (!empty($_GET['t']) && $_GET['t'] == 'issuances' )
	{
		$query = "UPDATE issuances SET pdf_file='' WHERE md5(id) = '".md5($_GET['id'])."' LIMIT 1";							
		$checkQuery = "SELECT * FROM issuances WHERE md5(id) = '".md5($_GET['id'])."' LIMIT 1";	
		$directory = '../files/';
		$id 	   = antiSqlinject($_GET['id']);
	
		if (ifRecordExist($checkQuery))
		{
			$queryRs = $DBConn->query( $checkQuery );				  			
			if ($queryRs->num_rows)
			{
				$row			= $queryRs->fetch_assoc();				
				$rndFilename	= $row["pdf_file"];														
	
				if ($DBConn->query( $query ))
				{
					// Display message
					if (!empty($rndFilename))
					{
						if (file_exists($directory.$rndFilename)) unlink($directory.$rndFilename);
					}
	
					$_SESSION['message'] = array("File: ".$rndFilename." deleted","INFO");			  
		
					header("Location: issuances.php?option=edit&id=".$id);																	
					exit();					
					
				}		  
			}	
		}		
		else
		{
				header("Location: issuances.php?option=edit&id=".$id);																	
				exit();	
		}	
	}	
	
	if (!empty($_GET['t']) && $_GET['t'] == 'programs' )
	{
		$query = "UPDATE programs_n_projects SET pdf_file='' WHERE md5(id) = '".md5($_GET['id'])."' LIMIT 1";							
		$checkQuery = "SELECT * FROM programs_n_projects WHERE md5(id) = '".md5($_GET['id'])."' LIMIT 1";	
		$directory = '../files/';
		$id 	   = antiSqlinject($_GET['id']);
	
		if (ifRecordExist($checkQuery))
		{
			$queryRs = $DBConn->query( $checkQuery );				  			
			if ($queryRs->num_rows)
			{
				$row			= $queryRs->fetch_assoc();				
				$rndFilename	= $row["pdf_file"];														
	
				if ($DBConn->query( $query ))
				{
					// Display message
					if (!empty($rndFilename))
					{
						if (file_exists($directory.$rndFilename)) unlink($directory.$rndFilename);
					}
	
					$_SESSION['message'] = array("File: ".$rndFilename." deleted","INFO");			  
		
					header("Location: program-projects.php?option=edit&id=".$id);																	
					exit();					
					
				}		  
			}	
		}		
		else
		{
				header("Location: program-projects.php?option=edit&id=".$id);																	
				exit();	
		}	
	}	
		
}
else
{
	  header("Location: index.php");																	
	  exit();	
}
?>
