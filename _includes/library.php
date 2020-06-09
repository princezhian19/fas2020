<?php
/* mysql  */

function printr($data){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}


function antiSqlinject($data, $type = ""){
	
	if (!empty($type))
	{
		$inline = "<a><b><br><em><i><img><span><strong><sub><sup>";
		$block	= "<blockquote><div><h1><h2><h3><h4><h5><h6><hr><li><ol><p><pre><table><th><tr><td><ul>";		
		
		switch ($type) 
		{
			case "content":
				$data = strip_tags($data,$inline.$block);
				break;
			case "inline":
				$data = strip_tags($data,$inline);
				break;
			case "block":
				$data = strip_tags($data,$block);
				break;			
		}	
	}
	else
	{
		$data = strip_tags($data);		
	}
			
	if (get_magic_quotes_gpc())
	{
		$safedata = html_entity_decode(stripslashes($data),ENT_QUOTES);
	}
	else
	{
		$safedata = html_entity_decode(stripslashes($data),ENT_QUOTES);		
	}
		
	return $safedata;
}

function ifRecordExist($sql){

	$DBConn = dbConnect();
	if (!$DBConn)
	{
		return false;
	}

	$queryUser = $DBConn->query( $sql );
	
	if (!$queryUser->num_rows) return false;
	else return true;
	 	 
}

function globalSetting($section="")
{
	$DBConn = dbConnect();
	if (!$DBConn)
	{
		return false;
	}
	
	if (empty($section))
	{	
		$query = "SELECT website_url, website_name, administrator, email, mobile, address, list_perpage, allow_comment, admin_section, gname, gpass FROM global_setting LIMIT 1";
		$queryRs = $DBConn->query( $query );				
		if ($queryRs->num_rows)
		{
			$row = $queryRs->fetch_array(MYSQLI_ASSOC);
			return $row;
		}
		else return "none";
	}
	else
	{
		$query = "SELECT * FROM global_setting LIMIT 1";	
		$queryRs = $DBConn->query( $query );				
		if ($queryRs->num_rows)
		{
			$row = $queryRs->fetch_assoc();
			return $row[$section];
		}
		else return "none";		
	}
}

function mainmenu($parent, $level, $folderpath = '') 
{
	
	$DBConn = dbConnect();
	if (!$DBConn) {
		return false;
	}	
		
	$data = '';	
	$query = "
				SELECT 
					a.id, 
					a.label, 
					a.link,
					a.file,					 
					Deriv1.Count 
				FROM navigation a  
				LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count FROM navigation GROUP BY parent) Deriv1 ON a.id = Deriv1.parent 
				WHERE a.parent= '".$parent."' Order by sort, label ASC";
	
	if ($parent == 0) $css = 'class="dropdown"';
	else			$css = '';
	$data = '<ul '.$css.'>'."\n";	
	
	$queryRs = $DBConn->query( $query );	
	if ($queryRs->num_rows)
	{		
		while ($row = $queryRs->fetch_assoc()) 
		{					   	
			if (empty($row['link']) && empty($row['file'])) $row['link'] = 'page.php?id='.$row['id'];
			if (empty($row['link']) && !empty($row['file'])) $row['link'] = 'files/'.$row['file'];			
						
			if ($row['Count'] > 0) 
			{		
				if ($parent >  0) $data .= "\t\t";
				if ($parent == 0) $linkcss = 'class="mainmenu" ';
				else			  $linkcss = '';
				$data .= "\t".'<li><a '.$linkcss.'href="'.$folderpath.$row['link'].'"><span>'.$row['label']."</span></a>";			
				$data .= "\n\t\t".mainmenu($row['id'], $level + 1, $folderpath);		
				$data .= "</li>"."\n";
			}
			elseif ($row['Count']==0)
			{			
				if ($parent >  0) $data .= "\t\t";
				if ($parent == 0) $linkcss = 'class="mainmenu" ';				
				$data .= "\t".'<li><a '.$linkcss.'href="'.$folderpath.$row['link'].'"><span>'.$row['label']."</span></a></li>"."\n";
			} 
		}
	}
	
	$data .= '</ul>'."\n";
	
	return $data;
}

/**********************************/
/*	Inet Access Option Menu       */
/**********************************/
function inetmainmenu_v2($parent,$level)
{
	?>

	<?php
			// Getting all the codes in table employee
			$link = mysqli_connect("localhost","root","", "loop");

			if(mysqli_connect_errno()){echo mysqli_connect_error();}  
			$query = "SELECT ACCESSLIST FROM tblemployeinfo WHERE CODE='".$_SESSION['inet_credentials']['code']."'";
			$result = mysqli_query($link, $query);
			if($row = mysqli_fetch_array($result))
			{
				$useraccess = array();
				$crt = 0;		
				$useraccess = explode("|",$row['ACCESSLIST']);
			}
			// Show options and view in sidebar
			$data = '';	
			$query2 = "SELECT 
			a.id, 
			a.menuname, 
			a.parent,
			a.menulink,	
			a.accesslinks,
			Deriv1.Count 
		FROM inetoption_mainmenu a  
		LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count FROM inetoption_mainmenu GROUP BY parent) Deriv1 ON a.id = Deriv1.parent 
		WHERE a.parent= '".$parent."' AND active = 'Y' Order by menuname ASC";
			if ($row['parent'] == 40 )
			{

			
			}
			if ($parent == 0)
			{
				// edit_profile_test.php
				$data .= '<p style = "line-height:100%;font-size:12px;border-bottom:2px solid #B0BEC5;"><a style = "text-decoration:none;"  href="edit_profile_dashboard.php">Edit Profile</a></p>';
				$data .= '<p style = "line-height:100%;font-size:12px;border-bottom:2px solid #B0BEC5;"><a style = "text-decoration:none;"   href="edit_password.php" data-toggle="modal" data-target="#edit_password">Edit Password</a></p>';
			}
				
			$result2 = mysqli_query($link, $query2);
			while ($row = mysqli_fetch_array($result2))
			{
				////////////////////////////////////////////////////////////////////////////////////////////////////////////
				if (($_SESSION['inet_credentials']['access_type'] == 'user') && in_array($row["accesslinks"],$useraccess)) 
				{
					$showlink = true;
					if ($showlink)
					{
						if ($row['Count'] > 0) 
						{				
							$data .= '<p style = "line-height:100%;font-size:12px;border-bottom:2px solid #B0BEC5;"><a style = "text-decoration:none;" href="'.$row['menulink'].'" data-toggle = "modal" data-target="#'.str_replace('.php',$row['menulink']).'">'.$row['menuname'].'</a></p>';

					
		
						}
						elseif ($row['Count']==0)
						{				
							$data .= '<p style = "line-height:100%;font-size:12px;border-bottom:2px solid #B0BEC5;text-indent:20px;"><a style = "text-decoration:none;"  href="index.php">'.$row['menuname'].'</a></p>';
						} 
						else{
							$data .='<p style = "line-height:100%;font-size:12px;border-bottom:2px solid #B0BEC5;"><a style = "text-decoration:none;text-indent:20px;"   href="'.$row['menulink'].'">'.$row['menuname'].'</a></p>';

						}
					}
					$data .= "\n\t\t".inetmainmenu_v2($row['id'], $level + 1);	
				}
				elseif ($_SESSION['inet_credentials']['access_type'] == 'admin')
				{
					$showlink = true;
					if ($showlink)
					{
						if ($row['Count'] > 0) 
						{				
							$data .= '<p style = "line-height:100%;font-size:12px;border-bottom:2px solid #B0BEC5;"><a style = "text-decoration:none;"  href="'.$row['menulink'].'" ></i>'.$row['menuname'].'</a></p>';
		
						}
						elseif ($row['Count']==0)
						{				
						  //  data-toggle = "modal" data-target="#'.str_replace('.php','',$row['menulink']).'"
						  $link = $row['menulink'];
						  switch($link)
						  {
						      case 'fml_records.php':
						          	$data .= '<p style = "line-height:100%;font-size:12px;border-bottom:2px solid #B0BEC5;text-indent:20px;"><a style = "text-decoration:none;" href = "index.php"   >'.$row['menuname'].'</a></p>';
                              break;
                              case 'incoming_records.php';
  						          	$data .= '<p style = "line-height:100%;font-size:12px;border-bottom:2px solid #B0BEC5;text-indent:20px;"><a style = "text-decoration:none;" href = "index.php"   >'.$row['menuname'].'</a></p>';
                              break;
                               case 'outgoing_records.php';
  						          	$data .= '<p style = "line-height:100%;font-size:12px;border-bottom:2px solid #B0BEC5;text-indent:20px;"><a style = "text-decoration:none;" href = "index.php"   >'.$row['menuname'].'</a></p>';
                              break;
                              case 'psl_records.php';
  						          	$data .= '<p style = "line-height:100%;font-size:12px;border-bottom:2px solid #B0BEC5;text-indent:20px;"><a style = "text-decoration:none;" href = "index.php"   >'.$row['menuname'].'</a></p>';
                              break;
                              case 'qme_records.php';
  						          	$data .= '<p style = "line-height:100%;font-size:12px;border-bottom:2px solid #B0BEC5;text-indent:20px;"><a style = "text-decoration:none;" href = "index.php"   >'.$row['menuname'].'</a></p>';
                              break;
                              default:
                                  				$data .= '<p style = "line-height:100%;font-size:12px;border-bottom:2px solid #B0BEC5;text-indent:20px;"><a style = "text-decoration:none;" href = "'.$row['menulink'].'"   >'.$row['menuname'].'</a></p>';

						          
						  }
				// 			$data .= '<p style = "line-height:100%;font-size:12px;border-bottom:2px solid #B0BEC5;text-indent:20px;"><a style = "text-decoration:none;" href = "'.$row['menulink'].'"   >'.$row['menuname'].'</a></p>';
						} 
						else{
							$data .= '<p style = "line-height:100%;font-size:12px;border-bottom:2px solid #B0BEC5;"><a style = "text-decoration:none;"    href="'.$row['menulink'].'" data-toggle = "modal" data-target="#'.str_replace('.php','',$row['menulink']).'">'.$row['menuname'].'</a></p>';

						}
					}
					$data .= "\n\t\t".inetmainmenu_v2($row['id'], $level + 1);	
				}
				elseif (($_SESSION['inet_credentials']['access_type'] == 'reports') && in_array($row["accesslinks"],array('reports'))) 
				{
					$showlink = true;
				}
				else{
					$showlink = false;

				}

			
				////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			
			}
			if ($parent == 0)
			{	
		 		$data .= "\t\t".'<p style = "line-height:100%;font-size:12px;border-bottom:2px solid #B0BEC5;"><a style = "text-decoration:none;"   href="function.php?logout=1">Logout</a></p>'."<br>";
			}
		return $data;
}
function inetmainmenu($parent, $level)
{
	
	$DBConn = dbConnect();
	if (!$DBConn) {
		return false;
	}
		
	$query = "SELECT ACCESSLIST FROM tblemployeinfo WHERE CODE='".$_SESSION['inet_credentials']['code']."'";
	$queryRs = $DBConn->query( $query );																			
	$useraccess = array();
	$crt = 0;								
	if ($queryRs->num_rows)
	{
		$row = $queryRs->fetch_assoc();
		$useraccess = explode("|",$row['ACCESSLIST']);
	}			

	$data = '';	
	$query = "
				SELECT 
					a.id, 
					a.menuname, 
					a.parent,
					a.menulink,	
					a.accesslinks,
					Deriv1.Count 
				FROM inetoption_mainmenu a  
				LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count FROM inetoption_mainmenu GROUP BY parent) Deriv1 ON a.id = Deriv1.parent 
				WHERE a.parent= '".$parent."' AND active = 'Y' Order by menuname ASC";

	if ($row['parent'] == 40 ) {
		# co
	}

	//echo $query;
	if ($parent == 0) $css = 'class="dropdown"';
	else			$css = '';
	$data = '<ul '.$css.'>'."\n";
	
	if ($parent == 0)
	{
		 $data .= "\t\t".'<li><a href="edit_profile_dashboard.php">Edit Profile</a></li>'."\n";
		 $data .= "\t\t".'<li><a href="edit_password.php" class="popupTall">Edit Password</a></li> '."\n"; 		 
	}
		
	$queryRs = $DBConn->query( $query );	
	if ($queryRs->num_rows)
	{		
		while ($row = $queryRs->fetch_assoc()) 
		{
			//if (in_array('whatsnew',$useraccess) && ($_SESSION['inet_credentials']['access_type'] == 'user')) print_r($_SESSION['inet_credentials']['access_type']); exit();
			
			if (($_SESSION['inet_credentials']['access_type'] == 'user') && in_array($row["accesslinks"],$useraccess)) $showlink = true;
			elseif ($_SESSION['inet_credentials']['access_type'] == 'admin')
			{
				if($row["accesslinks"] == 'reports') 	$showlink = false;
				else 									$showlink = true;
			}
			elseif (($_SESSION['inet_credentials']['access_type'] == 'reports') && in_array($row["accesslinks"],array('reports'))) $showlink = true;
			else $showlink = false;
								   	
			if ($showlink)
			{
				if ($row['Count'] > 0) 
				{				
					if ($parent >  0) $data .= "\t\t";
					if ($parent == 0) $linkcss = 'class="mMain" ';
					else			  $linkcss = '';
					
					if (!empty($row['menulink'])) 	$menu_name = '<a '.$linkcss.'href="'.$row['menulink'].'"><span>'.$row['menuname']."</span></a>";
					else							$menu_name = '<span>'.$row['menuname']."</span>";
					
					$data .= "\t".'<li>'.$menu_name;			
					$data .= "\n\t\t".inetmainmenu($row['id'], $level + 1);		
					$data .= "</li>"."\n";

				}
				elseif ($row['Count']==0)
				{						
					if ($parent >  0) $data .= "\t\t";
					if ($parent == 0) $linkcss = 'class="mainmenu" ';
					else			  $linkcss = '';			
					
					if ($row['parent']== 40 && $row['accesslinks']=="records") {
						$addclass = "popupsmaller reporting fancybox";
					}
					else{
						$addclass="";
					}

					if ($row["id"] == '26') $countRegAcc = cntregacc();
					else					$countRegAcc = "";	
					
					if (!empty($row['menulink'])) 	$menu_name = '<a  class="'.$addclass.'" '.$linkcss.'href="'.$row['menulink'].'"><span>'.$row['menuname'].$countRegAcc."</span></a>";
					else							$menu_name = '<span>'.$row['menuname']."</span>";
										
					$data .= "\t".'<li>'.$menu_name."</li>"."\n";
				} 
			}
		}
	}
	if ($parent == 0)
	{
		 $data .= "\t\t".'<li><a href="function.php?logout=1">Logout</a></li>'."\n";
	}	
	
	$data .= '</ul>'."\n";
	
	return $data;

}

function DetermineAccess($section){
	if (!empty($_SESSION['inet_credentials']['access_type']) && $_SESSION['inet_credentials']['access_type'] == 'admin' )
	{
		// Do nothing
	}
	elseif(!empty($section) && $section == 'reports' && $_SESSION['inet_credentials']['access_type'] == 'reports')
	{
		// Do nothing		
	}
	else
	{
		if (!IsthereAccess($section)) 
		{
			unset($_SESSION['inet_credentials']);
			header("Location: login.php");
			exit();
		}
	}
}

function IsthereAccess($section){

	$DBConn = dbConnect();
	if (!$DBConn){ return false; }

	if (empty($_SESSION['inet_credentials']['code'])) return false;
	if (empty($section)) return false;

	//$query = "SELECT access FROM user_rights WHERE md5(`code`)='".md5($_SESSION['inet_credentials']['code'])."' LIMIT 1";
	$query = "SELECT ACCESSLIST FROM tblemployeinfo WHERE CODE='".$_SESSION['inet_credentials']['code']."' LIMIT 1";
		
	$queryRs = $DBConn->query( $query );
	$useraccess = array();
	if ($queryRs->num_rows)
	{
		$row = $queryRs->fetch_assoc();
		$useraccess = explode("|",$row['ACCESSLIST']);
	}

	if (!empty($useraccess))
	{
	  if (in_array($section,$useraccess)) return true;
	  else	return false;
	}
	else return false;

}

/**********************************/
/*	Count Registered Account      */
/**********************************/
function cntregacc()
{
	$DBConn = dbConnect();
	if (!$DBConn) {
		return false;
	}	
	
	$sqlCount = "SELECT count(EMP_N) as cnt FROM tblemployeinfo WHERE tblemployeinfo.REGION_C = ".$_SESSION['inet_credentials']["region"]." AND tblemployeinfo.INVI = 'No' AND activated = 'No'	AND tblemployeinfo.UNAME IS NOT NULL AND  tblemployeinfo.PSWORD IS NOT NULL";						
	$queryRs = $DBConn->query( $sqlCount );	
	if ($queryRs->num_rows)
	{		
		$row = $queryRs->fetch_assoc();
		return '('.$row["cnt"].')';
	}
	else return false;	
}

/**********************************/
/*	Single Dropdown Menu     	  */
/**********************************/
function breadCrumbs($child)
{
	
	$DBConn = dbConnect();
	if (!$DBConn) {
		return false;
	}	

	$links = "";
		
	$query = "SELECT id, parent, label, link FROM `navigation` WHERE md5(id)='".md5($child)."'";
	$queryRs = $DBConn->query( $query );	
	if ($queryRs->num_rows)
	{		
		$row = $queryRs->fetch_assoc();

		$parentQuery =  "SELECT id, parent, label, link FROM `navigation` WHERE md5(id)='".md5($row["parent"])."'";
		$parentyRs = $DBConn->query( $parentQuery );	
		if ($parentyRs->num_rows)
		{		
			$parentRow = $parentyRs->fetch_assoc();
			$links = " <a href='#'>".$parentRow["label"]."</a> > ";
		}
		
		if (!empty($row["link"]) && $row["link"] == '#')
		{
			$links .= " ".$row["label"];		
		}
		elseif (!empty($row["link"]) && $row["link"] != '#')
		{
			$links .= " <a href='".$row["link"]."'>".$row["label"]."</a>";			
		}
		else
		{
			$links .= "<a href='page.php?id=".$row["id"]."'>".$row["label"]."</a>";
		}
		return $links;
	}
	else return false;
}

function msgBox($msgDetails, $type = 'information'){

	if (!empty($type) && $type == 'information') 	$css = 'background:url(images/about.gif) 20px 14px no-repeat #e1f5f7; border:1px solid #1e7078; ';
	if (!empty($type) && $type == 'error') 			$css = 'background:url(images/alert_icon.jpg) 20px 14px no-repeat #ffdddd; border:1px solid #990000; ';
	
	$msg = '<div id="msgBox" style=" '.$css.' margin:20px 30px; font-size:12px; padding:20px 20px 20px 60px;">'.$msgDetails.'</div>';
	
	return $msg;
}


function msgBoxArray($msgDetails){
	
	if (!empty($msgDetails) && $msgDetails[1] == 'INFO')	
	{
		$css = 'info';
		$msg = $msgDetails[0];		
	}
	if (!empty($msgDetails) && $msgDetails[1] == 'ERROR')
	{
		$css = 'error';
		$msg = $msgDetails[0];		
	}
	if (empty($css)) 										$css = '';
	
	if (empty($msgDetails[0])) $msg = $msgDetails;

	$msg = '<div class="msgBox '.$css.'" >'.$msg.'</div>';
	
	return $msg;
}

function is_valid_email($email){
	if(preg_match("/[.+a-zA-Z0-9_-]+@[a-zA-Z0-9-]+.[a-zA-Z]+/", $email) > 0) return true;
	else return false;
}

function fileExtensionType($file)
{
	$filename = $file;
	
	if (!empty($filename))
	{
		$imgtype = array(".jpeg",".jpg",".gif",".png");
		$doctype = array(".pdf",".xls",".xlsx",".doc",".docx",".ppt",".pptx",".rar",".zip",".txt");		
		$fileExtensionType = strrchr(strtolower($filename),".");
		if (in_array($fileExtensionType,$imgtype))
		{
			return "image";
		}
		elseif (in_array($fileExtensionType,$doctype))
		{
			return "document";		
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

function ConvertDate($sql_date, $format = "") {

	$date=strtotime($sql_date);

	if ($format == 'datetime') 			$final_date = date("F j, Y h:i a", $date);
	elseif ($format == 'shortdate')		$final_date = date("M j, Y ", $date);
	elseif ($format == 'shortdatetime') $final_date = date("M j, Y h:i a", $date);	
	elseif ($format == 'numericdate')	$final_date = date("Y-m-d", $date);		
	else 								$final_date = date("F j, Y", $date);
	
	return $final_date;
	
}

function dateDiff($d1, $d2) {
  //return round(abs(strtotime($d1)-strtotime($d2))/86400);
  return round((strtotime($d2)-strtotime($d1))/86400);  
}

function CropTitle ($strText, $intLength, $strTrail){
	if (strlen($strText) > $intLength) {
		$CropTitle = substr($strText, 0, $intLength);
		$CropTitle = substr($CropTitle, 0, strrpos($CropTitle," ",-1)) . $strTrail;
	}
	else{
		$CropTitle = $strText;
	}
	return $CropTitle;
}

/**
 * Truncates text.
 *
 * Cuts a string to the length of $length and replaces the last characters
 * with the ending if the text is longer than length.
 *
 * @param string  $text String to truncate.
 * @param integer $length Length of returned string, including ellipsis.
 * @param string  $ending Ending to be appended to the trimmed string.
 * @param boolean $exact If false, $text will not be cut mid-word
 * @param boolean $considerHtml If true, HTML tags would be handled correctly
 * @return string Trimmed string.
 */

function truncate($text, $length = 100, $ending = '...', $exact = false, $considerHtml = true) 
{

 $text = str_replace(array('<br />'), '<br/>' , $text);
  
  if ($considerHtml)
  {
	// if the plain text is shorter than the maximum length, return the whole text
	if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length)
	{
	  return $text;
	}
	// splits all html-tags to scanable lines
	preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
	$total_length = strlen($ending);
	$open_tags = array();
	$truncate = '';
	foreach ($lines as $line_matchings)
	{
	  // if there is any html-tag in this line, handle it and add it (uncounted) to the output
	  if (!empty($line_matchings[1]))
	  {
		// if it's an "empty element" with or without xhtml-conform closing slash (f.e. <br/>)
		if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1]))
		{
		  // do nothing
		// if tag is a closing tag (f.e. </b>)
		}
		else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings))
		{
		  // delete tag from $open_tags list
		  $pos = array_search($tag_matchings[1], $open_tags);
		  if ($pos !== false)
		  {
			unset($open_tags[$pos]);
		  }
		// if tag is an opening tag (f.e. <b>)
		}
		else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings))
		{
		  // add tag to the beginning of $open_tags list
		  array_unshift($open_tags, strtolower($tag_matchings[1]));
		}
		// add html-tag to $truncate'd text
		$truncate .= $line_matchings[1];
	  }
	  // calculate the length of the plain text part of the line; handle entities as one character
	  $content_length = strlen(preg_replace('/&amp;[0-9a-z]{2,8};|&amp;#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
	  if ($total_length+$content_length> $length)
	  {
		// the number of characters which are left
		$left = $length - $total_length;
		$entities_length = 0;
		// search for html entities
		if (preg_match_all('/&amp;[0-9a-z]{2,8};|&amp;#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE))
		{
		  // calculate the real length of all entities in the legal range
		  foreach ($entities[0] as $entity)
		  {
			if ($entity[1]+1-$entities_length <= $left)
			{
			  $left--;
			  $entities_length += strlen($entity[0]);
			} 
			else
			{
			  // no more characters left
			  break;
			}
		  }
		}
		$truncate .= substr($line_matchings[2], 0, $left+$entities_length);
		// maximum lenght is reached, so get off the loop
		break;
	  }
	  else 
	  {
		$truncate .= $line_matchings[2];
		$total_length += $content_length;
	  }
	  // if the maximum length is reached, get off the loop
	  if($total_length>= $length) 
	  {
		break;
	  }
	}
  } 
  else 
  {
	if (strlen($text) <= $length)
	{
	  return $text;
	} 
	else 
	{
	  $truncate = substr($text, 0, $length - strlen($ending));
	}
  }
  // if the words shouldn't be cut in the middle...
  if (!$exact)
  {
	// ...search the last occurance of a space...
	$spacepos = strrpos($truncate, ' ');
	if (isset($spacepos))
	{
	  // ...and cut the text in this position
	  $truncate = substr($truncate, 0, $spacepos);
	}
  }
  // add the defined ending to the text
  $truncate .= $ending;
  if($considerHtml)
  {
	// close all unclosed html-tags
	foreach ($open_tags as $tag)
	{
	  $truncate .= '</' . $tag . '>';
	}
  }
  return $truncate;
}

function IsthereAccess1($username, $section){

	$DBConn = dbConnect();
	if (!$DBConn)
	{
		return false;
	}

	$sql = "SELECT access FROM user_rights WHERE md5(username)='".md5($username)."' ORDER BY access";

	$queryUserAccess = $DBConn->query( $sql );
	
	if ($queryUserAccess->num_rows)
	{
		while ($row = $queryUserAccess->fetch_assoc()) {
			$access = false;
			if ($row['access'] == $section){
				$access = true;
				break;
			}			
		}	
		return $access;			
	}
}

function ReturnLastLogin($username){

	$DBConn = dbConnect();
	if (!$DBConn)
	{
		return false;
	}
	
	$sql = "SELECT datetime_logged, IP_used  FROM logs WHERE md5(user)='".md5($username)."' AND transaction_type='login' ORDER BY datetime_logged DESC LIMIT 0,1";

	$queryUserLastLogin = $DBConn->query( $sql );

	if ($queryUserLastLogin->num_rows)
	{
		$lastlogsRS = $queryUserLastLogin->fetch_assoc();
		$lastlogs = "Your Last Login was " . date('F j, Y h:i:s A', strtotime($lastlogsRS['datetime_logged'])) . " from " . $lastlogsRS['IP_used'];
	}
	else { $lastlogs = "This is your First Login!"; }
	
	return $lastlogs;
}

function DetermineAccess1($username, $section, $conn_database){
	if (!IsthereAccess($username, $section, $conn_database)) {
		unset($_SESSION['user_credentials']);
		header("Location: login.php");
		exit();
	}
}

function IsThereAccess2($section){

	$DBConn = dbConnect();
	if (!$DBConn){ return false; }

	if (empty($_SESSION['inet_credentials']['code'])) return false;
	if (empty($section)) return false;

	//$query = "SELECT access FROM user_rights WHERE md5(`code`)='".md5($_SESSION['inet_credentials']['code'])."' LIMIT 1";
	$query = "SELECT ACCESSLIST FROM tblemployeinfo WHERE CODE='".$_SESSION['inet_credentials']['code']."' LIMIT 1";

	$queryRs = $DBConn->query( $query );
	$useraccess = array();
	if ($queryRs->num_rows)
	{
		$row = $queryRs->fetch_assoc();
		$useraccess = explode("|",$row['ACCESSLIST']);
	}
    if($_SESSION['inet_credentials']['access_type']=='admin'){
      return true;

    }

	if (!empty($useraccess))
	{
	  if (in_array($section,$useraccess)) return true;
	  else	return false;
	}
	else return false;


}


///////////////////////////////////////////////////////////////////
//	Activity Log Begin							 				//
///////////////////////////////////////////////////////////////////

function dbaselogs($transaction_type, $affected_table="", $affected_UID="", $remarks=""){
	// save logs to database
	$DBConn = dbConnect();
	if (!$DBConn)
	{
		return false;
	}


	if (empty($_SESSION['inet_credentials']['uname'])) $name = "No Session";
	else 											   $name = $_SESSION['inet_credentials']['uname'];

	$sql = "INSERT INTO logs ( 
					datetime_logged, 
					IP_used, User, 
					transaction_type, 
					affected_table, 
					affected_UID_field, 
					remarks) 
			VALUES ( 
					'".date("Y-m-j H:i:s")."' , 
					'".$_SERVER['REMOTE_ADDR']."', 
					'".$name."', 
					'".$transaction_type."', 
					'".$affected_table."', 
					'".$affected_UID."', 
					'".antiSqlinject($remarks)."')";									
		
	$queryUserLastLogin = $DBConn->query( $sql );
			
	if ($queryUserLastLogin)
	{ 
		//Dbase Logs Save  
	}
	else
	{
		//err saving
	}
			
}

function txtlogs($transaction_type, $affected_table="", $affected_UID="", $remarks=""){

	// save logs to txtfiles		
	$path = "logs/";
	$txtFileName = date("Y_M")."_DILG_Intranet_logs.txt";
	$file = $path.$txtFileName;

	if (empty($_SESSION['inet_credentials']['uname'])) $name = "No Session";
	else 											   $name = $_SESSION['inet_credentials']['uname'];

	if (file_exists($file)) {
		$file = fopen($file, 'a') or die("can't open file for append");	
	} else {
		$file = fopen($file, 'w') or die("can't open file for writing");			
	}
	
	if (!empty($affected_table) && !empty($affected_UID) && !empty($remarks))
	{
		$DataLogs = date("Y-m-j H:i:s").", ".$_SERVER['REMOTE_ADDR'].", ".$name.", ".$transaction_type.", ".$affected_table.", ".$affected_UID.", ".$remarks." "."\r\n";	
	}
	elseif (!empty($affected_table) && !empty($affected_UID))
	{
		$DataLogs = date("Y-m-j H:i:s").", ".$_SERVER['REMOTE_ADDR'].", ".$name.", ".$transaction_type.", ".$affected_table.", ".$affected_UID." "."\r\n";		
	}
	else
	{
		$DataLogs = date("Y-m-j H:i:s").", ".$_SERVER['REMOTE_ADDR'].", ".$name.", ".$transaction_type."\r\n";
	}

	// save to file
	fwrite($file, $DataLogs);	
	fclose($file);

}

function txtlogsLoginAttempts($transaction_type, $username="", $password="", $try=""){

	// save logs to txtfiles		
	$path = "logs/";
	$txtFileName = date("Y_M")."_DILGIntranetFailedLoginslogs.txt";
	$file = $path.$txtFileName;

	if (file_exists($file)) {
		$file = fopen($file, 'a') or die("can't open file for append");	
	} else {
		$file = fopen($file, 'w') or die("can't open file for writing");			
	}
	
	if (!empty($username) && !empty($password))
	{
		$DataLogs = date("Y-m-j H:i:s").", ".$_SERVER['REMOTE_ADDR'].", ".$transaction_type.", ".$username.", ".$password." , ".$try." "."\r\n";	
	}
	else
	{
		$DataLogs = date("Y-m-j H:i:s").", ".$_SERVER['REMOTE_ADDR'].", ".$transaction_type."\r\n";
	}
	// save to file
	fwrite($file, $DataLogs);	
	fclose($file);

}

///////////////////////////////////////////////////////////////////
//	Activity Log End							 				//
///////////////////////////////////////////////////////////////////


function getFirstWord($word){
	$z = strrpos($word," ",1);
	if ($z > 0) {
		$z = substr($word, 0, $z+1);
	}
	else {
		$z = $word;
	}
	return $z;
}

function getFileExtension($filename)
{
    $path_info = pathinfo($filename);
    return $path_info['extension'];
}

function lockuser(){
	header("Location: userlock.php");
	exit();		
}


///////////////////////////////////////////////////////////////////
//	Pagination 													//
///////////////////////////////////////////////////////////////////

function Pages($tbl_name,$limit,$path)
{

	// Connect to database
	$DBConn = dbConnect();
	if (!$DBConn) {
		return false;
	}



    //echo $query;
    if(stristr($tbl_name,'GROUP')===FALSE){
        $query = "SELECT COUNT(*) as num FROM $tbl_name";
        $queryRs = $DBConn->query( $query );
        $rs = $queryRs->fetch_assoc();
        $total_pages = $rs ['num'];
    }else{
        $query = "SELECT * FROM $tbl_name";
        $queryRs = $DBConn->query( $query );
        $total_pages = $queryRs -> num_rows;

    }


	
	$adjacents = "2";
	$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
			$page = ($page == 0 ? 1 : $page);
	
	if($page)
		$start = ($page - 1) * $limit;
	else
		$start = 0;

	if ($page == 0) $page = 1;
	$prev = $page - 1;
	$next = $page + 1;
	$lastpage = ceil($total_pages/$limit);
	$lpm1 = $lastpage - 1;

	$pagination = "";
	
	if($lastpage > 1)
		{   
			$pagination .= "<div class='pagination'>
								<ul>";

			if ($page > 1) $pagination.= "<li class='pWord'><a href='".$path."page=$prev'>&laquo; previous</a></li>";
			else $pagination.= "<li class='pWord'><span class='disabled'>&laquo; previous</span></li>";
		
			if ($lastpage < 7 + ($adjacents * 2))
				{   
					for ($counter = 1; $counter <= $lastpage; $counter++)
						{
							if ($counter == $page){
								$pagination.= "<li><span class='current'>$counter</span></li>";
								}
							else{
								$pagination.= "<li><a href='".$path."page=$counter'>$counter</a></li>";                   
								}
						}
				}
			elseif($lastpage > 5 + ($adjacents * 2))
				{
					if($page < 1 + ($adjacents * 2))       
					{
						for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
							{
							if ($counter == $page)
								$pagination.= "<li><span class='current'>$counter</span></li>";
							else
								$pagination.= "<li><a href='".$path."page=$counter'>$counter</a></li>";                   
							}
						$pagination.= "<li>...</li>";
						$pagination.= "<li><a href='".$path."page=$lpm1'>$lpm1</a></li>";
						$pagination.= "<li><a href='".$path."page=$lastpage'>$lastpage</a></li>";       
					}
					elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
						{
							$pagination.= "<li><a href='".$path."page=1'>1</a></li>";
							$pagination.= "<li><a href='".$path."page=2'>2</a></li>";
							$pagination.= "<li>...</li>";
							
							for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
								{
									if ($counter == $page) $pagination.= "<li><span class='current'>$counter</span></li>";
									else $pagination.= "<li><a href='".$path."page=$counter'>$counter</a></li>";                   
								}
								
							$pagination.= "<li>..</li>";
							$pagination.= "<li><a href='".$path."page=$lpm1'>$lpm1</a></li>";
							$pagination.= "<li><a href='".$path."page=$lastpage'>$lastpage</a></li>";       
						}
					else
					{
						$pagination.= "<li><a href='".$path."page=1'>1</a></li>";
						$pagination.= "<li><a href='".$path."page=2'>2</a></li>";
						$pagination.= "<li>..</li>";
						for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
							{
								if ($counter == $page) $pagination.= "<li><span class='current'>$counter</span></li>";
								else $pagination.= "<li><a href='".$path."page=$counter'>$counter</a></li>";                   
							}
					}
				}
		
			if ($page < $counter - 1) $pagination.= "<li class='pWord'><a href='".$path."page=$next'>next &raquo;</a></li>";
			else
				$pagination.= "<li class='pWord'><span class='disabled'>next &raquo;</span></li>";
				$pagination.= "	</ul>
								</div>\n";       
		}


return $pagination;
}

?>