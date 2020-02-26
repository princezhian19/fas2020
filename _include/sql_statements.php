<?php
$DIR_MAIN_FOLDER = '/pcf';
$DIR_PHYSICAL = 'C:/xammp/htdocs/'.$DIR_MAIN_FOLDER.'/';

$DB_HOST = 'localhost';
$DB_USER = 'calaba9_intra';
$DB_PASS = '{^-LouqU_vpV';
$BD_TABLE = 'calaba9_intranetdb';
$target=$_SERVER['SERVER_NAME'].$DIR_MAIN_FOLDER;
// $target="dreams.freetzi.com";

function log_activity($transaction_type, $affected_table="", $affected_UID="", $type="", $type_id="", $name=""){
	// save logs to database
    if(!isset($_SESSION)){
    session_start();
    }
    if(isset($_SESSION['focal_peson_id'][0])){
      $name = $_SESSION['focal_peson_id'][0];
    }

	$query = "INSERT INTO focal_person_activity_logs ( datetime_logged, IP_used, User, transaction_type, affected_table, affected_UID_field, type, type_id)
		VALUES ('".date("Y-m-j H:i:s")."', '".$_SERVER['REMOTE_ADDR']."', '".$name."', '".$transaction_type."', '".$affected_table."', '".$affected_UID."','".$type."', '".$type_id."')";
    //echo $query;
    insert_update_delete($query);
}

function insert_update_delete($query)
 {

 global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE;
mysql_connect($DB_HOST, $DB_USER,$DB_PASS);
mysql_select_db($BD_TABLE) or die( "Unable to select database");

   mysql_query($query)or die( "Unable to execute query");


mysql_close();
  }



function select_info($query)
{
//echo $query;
global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE;
mysql_connect($DB_HOST, $DB_USER,$DB_PASS);
mysql_select_db($BD_TABLE) or die( "Unable to select database");

//mysql_query($query);

if($res=mysql_query($query))
    {
		if(mysql_num_rows($res))
        {
		    $retvalue = array();

			while($r=mysql_fetch_array($res,MYSQL_BOTH))
            {
                $a_keys = array_keys($r);
                //in supplying the query string specify first the ID (PK) ex. select id, name etc..
				$retvalue[$r[0]] = array();

                //(
                //'str_license'=>$r['str_license']
			   	//,'str_license_description'=>html_entity_decode(stripslashes($r['str_license_description']),ENT_QUOTES)
			    //);

                 for($x = 0; $x<count($a_keys); $x++)
                    {
                     $retvalue[$r[0]][$a_keys[$x]]=html_entity_decode(stripslashes($r[$a_keys[$x]]),ENT_QUOTES);
                    }

			}
			return $retvalue;
		}
		else
        {
		//addDebug('InfoMgmt_getLicense','Zero Result');
		return null;
		}
	}
else
    {
	//addDebug('InfoMgmt_getLicense',sql);
	//addDebug('InfoMgmt_getLicense',mysql_error());
	return null;
	}

mysql_close();
}



/*function select_info_multiple_key($query)
{
//echo $query;
global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE;
mysql_connect($DB_HOST, $DB_USER,$DB_PASS);
mysql_select_db($BD_TABLE) or die( "Unable to select database");

//mysql_query($query);

if($res=mysql_query($query))
    {
		if(mysql_num_rows($res))
        {
		    $retvalue = array();

            $ctr = 1;
			while($r=mysql_fetch_array($res,MYSQL_BOTH))
            {
                $a_keys = array_keys($r);
                //in supplying the query string specify first the ID (PK) ex. select id, name etc..
                $row_name = $r[0].$ctr;
				$retvalue[$row_name] = array();

                //(
                //'str_license'=>$r['str_license']
			   	//,'str_license_description'=>html_entity_decode(stripslashes($r['str_license_description']),ENT_QUOTES)
			    //);

                 for($x = 0; $x<count($a_keys); $x++)
                    {
                     $retvalue[$row_name][$a_keys[$x]]=html_entity_decode(stripslashes($r[$a_keys[$x]]),ENT_QUOTES);
                    }
              $ctr = $ctr+1;
			}
			return $retvalue;
		}
		else
        {
		//addDebug('InfoMgmt_getLicense','Zero Result');
		return null;
		}
	}
else
    {
	//addDebug('InfoMgmt_getLicense',sql);
	//addDebug('InfoMgmt_getLicense',mysql_error());
	return null;
	}

mysql_close();
}
*/


function select_info_multiple_key($query)
{
// echo $query;
global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE;
@mysql_connect($DB_HOST, $DB_USER,$DB_PASS);
mysql_select_db($BD_TABLE) or die( "Unable to select database");
error_reporting(E_ALL ^ E_DEPRECATED);
//mysql_query($query);

if($res=mysql_query($query))
    {
		if(mysql_num_rows($res))
        {
		    $retvalue = array();

            $ctr = 0;
			while($r=mysql_fetch_array($res,MYSQL_BOTH))
            {
                $a_keys = array_keys($r);
                //in supplying the query string specify first the ID (PK) ex. select id, name etc..
                //$row_name = $r[0].$ctr;
				$retvalue[$ctr] = array();

                //(
                //'str_license'=>$r['str_license']
			   	//,'str_license_description'=>html_entity_decode(stripslashes($r['str_license_description']),ENT_QUOTES)
			    //);

                 for($x = 0; $x<count($a_keys); $x++)
                    {
                     $retvalue[$ctr][$a_keys[$x]]=html_entity_decode(stripslashes($r[$a_keys[$x]]),ENT_QUOTES);
                    }
              $ctr = $ctr+1;
			}
			return $retvalue;
		}
		else
        {
		//addDebug('InfoMgmt_getLicense','Zero Result');
		return null;
		}
	}
else
    {
	//addDebug('InfoMgmt_getLicense',sql);
	//addDebug('InfoMgmt_getLicense',mysql_error());
	return null;
	}

mysql_close();
}


function select_info_1D($query)
{
//echo $query;
global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE;
mysql_connect($DB_HOST, $DB_USER,$DB_PASS);
mysql_select_db($BD_TABLE) or die( "Unable to select database");

//mysql_query($query);

if($res=mysql_query($query))
    {
		if(mysql_num_rows($res))
        {
		    $retvalue = array();

			while($r=mysql_fetch_array($res,MYSQL_BOTH))
            {
                $a_keys = array_keys($r);


                 for($x = 0; $x<count($a_keys)-1; $x++)
                    {
                     $retvalue[]=html_entity_decode(stripslashes($r[$x]),ENT_QUOTES);
                    }

			}
			return $retvalue;
		}
		else
        {
		//addDebug('InfoMgmt_getLicense','Zero Result');
		return null;
		}
	}
else
    {
	//addDebug('InfoMgmt_getLicense',sql);
	//addDebug('InfoMgmt_getLicense',mysql_error());
	return null;
	}

mysql_close();
}



function select_info_1D_ASSOC($query)
{
//echo $query;
global $DB_HOST, $DB_USER,$DB_PASS, $BD_TABLE;
mysql_connect($DB_HOST, $DB_USER,$DB_PASS);
mysql_select_db($BD_TABLE) or die( "Unable to select database");

//mysql_query($query);

if($res=mysql_query($query))
    {
		if(mysql_num_rows($res))
        {
		    $retvalue = array();


			while($r=mysql_fetch_array($res,MYSQL_ASSOC))
            {
                $a_keys = array_keys($r);


                    foreach($a_keys as $keys)
                    {
                      $retvalue[$keys]=html_entity_decode(stripslashes($r[$keys]),ENT_QUOTES);
                    }



			}
			return $retvalue;
		}
		else
        {
		//addDebug('InfoMgmt_getLicense','Zero Result');
		return null;
		}
	}
else
    {
	//addDebug('InfoMgmt_getLicense',sql);
	//addDebug('InfoMgmt_getLicense',mysql_error());
	return null;
	}

mysql_close();
}

?>