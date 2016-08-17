<?php
function fileupload($type,$folder,$key,$val,$path='', $prefix='', $cond = NULL)
{
	ini_set( 'memory_limit','10000M' );
	ini_set('upload_max_filesize','100000');
	ini_set('max_input_time','-1'); // -1 is equiv to infinite
	
	 if($val === 'N')
	 {
		 $filesource = $_FILES[$key]['name'];
		 $source = $_FILES[$key]['tmp_name'];
	 }
	 else{
		 $filesource = $_FILES[$key]['name'][$val];
		 $source = $_FILES[$key]['tmp_name'][$val];
	 }
	$file_name =  ($prefix ?  $prefix.'_' : '' ).str_replace(' ', '_', $filesource);

	 if ($source) {
         	$img_extn = @strtoupper(end(explode('.',$filesource)));

		switch($type)           
		 {
			case 'IMG':
				 if ($img_extn == 'png' ||$img_extn == 'PNG' || $img_extn == 'JPG' || $img_extn == 'jpg' || $img_extn == 'JPEG' || $img_extn == 'jpeg' || $img_extn == 'GIF' || $img_extn == 'gif' || $img_extn == 'BMP' || $img_extn == 'bmp' || $img_extn == 'swf' || $img_extn == 'SWF' || $img_extn == 'FLV' || $img_extn == 'flv') {
                    $act_file_path = ($path ? $path : $folder.'/').$file_name;
					
			}
			break;
			case 'TXT':
				if ($img_extn == 'doc' || $img_extn == 'txt' || $img_extn == 'TXT' || $img_extn == 'DOC' || $img_extn == 'PDF' ||$img_extn == 'pdf' || $img_extn == 'docx' || $img_extn == 'DOCX' || $img_extn == 'ZIP' || $img_extn == 'zip'){
					if(!$cond  || strtoupper($cond) == $img_extn)
					{
						$act_file_path = ($path ? $path : $folder.'/').$file_name;
					}
				}
			break;
			
			case 'INT':
				$act_file_path = ($path ? $path : $folder.'/').$file_name;
			break;
		 }//end of switch
		 if($act_file_path)
		 {
          copy($source, $act_file_path) or die('Upload Problem');
		 }
        }
       
        return $file_name;
		
}