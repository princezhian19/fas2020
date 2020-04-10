<?php

// http://www.heylove.de/

class uploadFile
{
    var $temp_file_name; 
    var $file_name; 
    var $upload_dir; 
    var $upload_log_dir; 
    var $max_file_size; 
    var $banned_array; 
    var $ext_array; 	
	
	function uploadFile()
	{

	}
	
	function validate_extension() 
	{ 
		//SECTION #1 
		$file_name = trim($this->file_name); 
		$extension = strtolower(strrchr($file_name,".")); 
		$ext_array = $this->ext_array; 
		$ext_count = count($ext_array); 
	
		//SECTION #2 
		if (!$file_name) { 
			return false; 
		} else { 
			if (!$ext_array) { 
				return true; 
			} else { 
				foreach ($ext_array as $value) { 
					$first_char = substr($value,0,1); 
						if ($first_char <> ".") { 
							$extensions[] = ".".strtolower($value); 
						} else { 
							$extensions[] = strtolower($value); 
						} 
				} 
	
				//SECTION #3 
				foreach ($extensions as $value) { 
					if ($value == $extension) { 
						$valid_extension = "TRUE"; 
					}    
					else $valid_extension = false;             
				} 
	
				//SECTION #4 
				if ($valid_extension) { 
					return true; 
				} else { 
					return false; 
				} 
			} 
		} 
	}
	
	function validate_size() 
	{ 
		$temp_file_name = trim($this->temp_file_name); 
		$max_file_size = trim($this->max_file_size); 
	
		if ($temp_file_name) { 
			$size = filesize($temp_file_name); 
				if ($size > $max_file_size) { 
					return false;                                                         
				} else { 
					return true; 
				} 
		} else { 
			return false; 
		}     
	} 	 
	
	function existing_file() 
	{ 
		$file_name = trim($this->file_name); 
		$upload_dir = $this->get_upload_directory(); 
	
		if ($upload_dir == "ERROR") { 
			return true; 
		} else { 
			$file = $upload_dir . $file_name; 
			if (file_exists($file)) { 
				return true; 
			} else { 
				return false; 
			} 
		}     
	} 	
	
	function get_file_size()
	{ 
		//SECTION #1 
		$temp_file_name = trim($this->temp_file_name); 
		$kb = 1024; 
		$mb = 1024 * $kb; 
		$gb = 1024 * $mb; 
		$tb = 1024 * $gb; 
	
			//SECTION #2 
			if ($temp_file_name) { 
				$size = filesize($temp_file_name); 
				if ($size < $kb) { 
					$file_size = "$size Bytes"; 
				} 
				elseif ($size < $mb) { 
					$final = round($size/$kb,2); 
					$file_size = "$final KB"; 
				} 
				elseif ($size < $gb) { 
					$final = round($size/$mb,2); 
					$file_size = "$final MB"; 
				} 
				elseif($size < $tb) { 
					$final = round($size/$gb,2); 
					$file_size = "$final GB"; 
				} else { 
					$final = round($size/$tb,2); 
					$file_size = "$final TB"; 
				} 
			} else { 
				$file_size = "ERROR: NO FILE PASSED TO get_file_size()"; 
			} 
			return $file_size; 
	} 	
	
	function get_max_size() { 
		$max_file_size = trim($this->max_file_size); 
		$kb = 1024; 
		$mb = 1024 * $kb; 
		$gb = 1024 * $mb; 
		$tb = 1024 * $gb; 
	
		if ($max_file_size) { 
			if ($max_file_size < $kb) { 
				$max_file_size = "max_file_size Bytes"; 
			} 
			elseif ($max_file_size < $mb) { 
				$final = round($max_file_size/$kb,2); 
				$max_file_size = "$final KB"; 
			} 
			elseif ($max_file_size < $gb) { 
				$final = round($max_file_size/$mb,2); 
				$max_file_size = "$final MB"; 
			} 
			elseif($max_file_size < $tb) { 
				$final = round($max_file_size/$gb,2); 
					$max_file_size = "$final GB"; 
			} else { 
				$final = round($max_file_size/$tb,2); 
				$max_file_size = "$final TB"; 
			} 
		} else { 
			$max_file_size = "ERROR: NO SIZE PARAMETER PASSED TO  get_max_size()";
		} 
			return $max_file_size; 
	} 
	
	
	function validate_user() 
	{ 
		//SECTION #1 
		$banned_array 	= $this->banned_array; 
		$ip 			= trim($_SERVER['REMOTE_ADDR']); 
		$cpu 			= gethostbyaddr($ip); 
		$count 			= count($banned_array); 
	
		//SECTION #2 
		if ($count < 1) { 
			return true; 
		} else { 
			foreach($banned_array as $key => $value) { 
				if ($value == $ip ."-". $cpu) { 
					return false; 
				} else { 
					return true; 
				} 
			} 
		} 
	}	

	function get_upload_directory() 
	{ 
		//SECTION #1 
		$upload_dir = trim($this->upload_dir); 
	
		//SECTION #2 
		if ($upload_dir)
		{ 
			$ud_len 	= strlen($upload_dir); 
			$last_slash	= substr($upload_dir,$ud_len-1,1); 
				if ($last_slash <> "/")
				{ 
					$upload_dir = $upload_dir."/"; 
				}
				else 
				{ 
					$upload_dir = $upload_dir; 
				} 
	
			//SECTION #3 
			$upload_dir_logs_dir = $upload_dir."logs/";
			if (!file_exists($upload_dir_logs_dir))
			{
				mkdir($upload_dir_logs_dir , 0777);
			}			
			
			$handle = @opendir($upload_dir); 
				if ($handle) 
				{ 
					$upload_dir = $upload_dir; 
					closedir($handle); 
				}
				else
				{ 
					$upload_dir = "ERROR"; 
				} 
		}
		else
		{ 
			$upload_dir = "ERROR"; 
		} 
		return $upload_dir; 
	} 

	function get_upload_log_directory() 
	{ 
		$upload_log_dir = trim($this->upload_log_dir); 
		if ($upload_log_dir)
		{ 
			$ud_len 	= strlen($upload_log_dir); 
			$last_slash = substr($upload_log_dir,$ud_len-1,1); 
			if ($last_slash <> "/")
			{ 
				$upload_log_dir = $upload_log_dir."/"; 
			}
			else
			{ 
				$upload_log_dir = $upload_log_dir; 
			} 
			$handle = @opendir($upload_log_dir); 
			if ($handle)
			{ 
				$upload_log_dir = $upload_log_dir; 
				closedir($handle); 
			}
			else
			{ 
				$upload_log_dir = "ERROR"; 
			} 
		}
		else
		{ 
			$upload_log_dir = "ERROR"; 
		} 
		return $upload_log_dir; 
	} 
	
	function upload_file_no_validation($thumbnail = false) 
	{ 
		//SECTION #1 
		$temp_file_name = trim($this->temp_file_name); 
		$file_name 		= trim(strtolower($this->file_name)); 
		$upload_dir 	= $this->get_upload_directory(); 
		$upload_log_dir = $this->get_upload_log_directory(); 
		$file_size 		= $this->get_file_size(); 
		$ip 			= trim($_SERVER['REMOTE_ADDR']); 
		$cpu 			= gethostbyaddr($ip); 
		$m 				= date("m"); 
		$d 				= date("d"); 
		$y 				= date("Y"); 
		$date 			= date("m/d/Y"); 
		$time 			= date("h:i:s A"); 
	
		//SECTION #2 
		if (($upload_dir == "ERROR") OR ($upload_log_dir == "ERROR"))
		{ 
			return false; 
		}
		else
		{ 
			if (is_uploaded_file($temp_file_name))
			{ 
				if (move_uploaded_file($temp_file_name,$upload_dir . $file_name))
				{ 
					if ($thumbnail)
					{
						$image = new SimpleImage();
						$image->load($upload_dir.$file_name);
						$image->resizeToWidth(250);
						$image->save($upload_dir.'Small_'.$file_name);							
					}					
					$log = $upload_log_dir.$y."_".$m."_".$d.".txt"; 
					$fp = fopen($log,"a"); 
					fwrite($fp,"$ip-$cpu | $file_name | $file_size | $date | $time\r\n"); 
					fclose($fp); 
					return true; 
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
	
	function upload_file_with_validation($thumbnail = false, $size = 250)
	{ 
		//SECTION #1 
		$temp_file_name = trim($this->temp_file_name); 
		$file_name 		= trim(strtolower($this->file_name)); 
		$upload_dir 	= $this->get_upload_directory(); 
		$upload_log_dir = $this->get_upload_log_directory(); 
		$file_size 		= $this->get_file_size(); 
		$ip 			= trim($_SERVER['REMOTE_ADDR']); 
		$cpu 			= gethostbyaddr($ip); 
		$m 				= date("m"); 
		$d 				= date("d"); 
		$y 				= date("Y"); 
		$date 			= date("m/d/Y"); 
		$time 			= date("h:i:s A"); 
		$existing_file 	= $this->existing_file();    	//<-Add On 
		$valid_user 	= $this->validate_user();		//<-Add On 
		$valid_size 	= $this->validate_size();		//<-Add On 
		$valid_ext 		= $this->validate_extension();	//<-Add On 
	
		//SECTION #2 
		if (($upload_dir == "ERROR") OR ($upload_log_dir == "ERROR")) 
		{ 
			return false; 
		} 
		elseif ((((!$valid_user) OR (!$valid_size) OR (!$valid_ext) OR ($existing_file)))) 
		{ 
			return false; 
		} 
		else 
		{ 
			if (is_uploaded_file($temp_file_name)) { 
				if (move_uploaded_file($temp_file_name,$upload_dir.$file_name)) 
				{ 
					if ($thumbnail)
					{
						$image = new SimpleImage();
						$image->load($upload_dir.$file_name);
						$image->resizeToWidth($size);
						$image->save($upload_dir.'Small_'.$file_name);							
					}				
					$log = $upload_log_dir.$y."_".$m."_".$d.".txt"; 
					$fp = fopen($log,"a"); 
					fwrite($fp,"$ip-$cpu | $file_name | $file_size | $date | $time\r\n"); 
					fclose($fp); 
					return true;
				}
				else 
				{ 
					return false; 
					echo "error"; 	  exit();				
				} 
			} 
			else 
			{ 
				return false; 
			} 
		} 
	} 		
	
}

?>
<?php
 /*
* File: SimpleImage.php
* Author: Simon Jarvis
* Copyright: 2006 Simon Jarvis
* Date: 08/11/06
* Link: http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php
*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details:
* http://www.gnu.org/licenses/gpl.html
*
*/
 
class SimpleImage {
 
   var $image;
   var $image_type;
 
   function load($filename) {
 
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
 
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
 
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
 
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
 
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image);
      }
   }
   function getWidth() {
 
      return imagesx($this->image);
   }
   function getHeight() {
 
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
 
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
 
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
 
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
 
//   function resize($width,$height) {
//      $new_image = imagecreatetruecolor($width, $height);
//      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
//      $this->image = $new_image;
//   }      
   
	function resize($width,$height) {
		$new_image = imagecreatetruecolor($width, $height);
		if( $this->image_type == IMAGETYPE_GIF || $this->image_type == IMAGETYPE_PNG ) {
			$current_transparent = imagecolortransparent($this->image);
			if($current_transparent != -1) {
				$transparent_color = imagecolorsforindex($this->image, $current_transparent);
				$current_transparent = imagecolorallocate($new_image, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
				imagefill($new_image, 0, 0, $current_transparent);
				imagecolortransparent($new_image, $current_transparent);
			} elseif( $this->image_type == IMAGETYPE_PNG) {
				imagealphablending($new_image, false);
				$color = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
				imagefill($new_image, 0, 0, $color);
				imagesavealpha($new_image, true);
			}
		}
		imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
		$this->image = $new_image;	
	}   
	 
}
?>