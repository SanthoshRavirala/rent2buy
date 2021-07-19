<?php

function get_pagination_settings()
{
		$ci = & get_instance();
		$p_config['per_page']   = $ci->config->item('c_limit');
		$p_config['num_links']  = 5;

		$p_config['prev_link'] = '&lt;';
		$p_config['prev_tag_open'] = '<li class="previous">';
		$p_config['prev_tag_close'] = '</li>';
		$p_config['next_link'] = '&gt;';
		$p_config['next_tag_open'] = '<li class="paginate_button next">';
		$p_config['next_tag_close'] = '</li>';
		$p_config['cur_tag_open'] = '<li class="active"><a href="#">';
		$p_config['cur_tag_close'] = '</a></li>';
		$p_config['num_tag_open'] = '<li>';
		$p_config['num_tag_close'] = '</li>';
		 
		$p_config['first_tag_open'] = '<li>';
		$p_config['first_tag_close'] = '</li>';
		$p_config['last_tag_open'] = '<li>';
		$p_config['last_tag_close'] = '</li>';
		 
		$p_config['first_link'] = '&lt;&lt;';
		$p_config['last_link'] = '&gt;&gt;';
		
		return $p_config;
}

function html_revert($text)
{
	$text = html_entity_decode($text);
	return $text;
}

function getFileInfo($file)
{
	//$arrayZips = array("application/zip", "application/x-zip", "application/x-zip-compressed");

	$arrayImages = array("image/png", "image/jpeg", "image/gif","image/bmp");

    //$arrayExtensions = array(".pptx", ".docx", ".dotx", ".xlsx");

	$finfo = new finfo(FILEINFO_MIME);

	$type = $finfo->file($file);

	if (in_array($type, $arrayImages)){

		return true;

	} else {

		return false;

	} 	

}

function short_text($input, $length = 200, $ellipses='',$decode=1)
{
	if($decode){
		$input = html_revert($input);
	}
    $input = strip_tags($input);
    //no need to trim, already shorter than trim length
	
    if (strlen($input) <= $length) {
        return $input;
    }

    //find last space within length
    $last_space = strrpos(mb_substr($input, 0, $length), ' ');
    $trimmed_text = mb_substr($input, 0, $last_space);
    //add ellipses (...)
    if ($ellipses) {

        $trimmed_text .= '...';

    }
    return $trimmed_text;
}

function get_age($date_today, $date_birth)
{
	$dt = explode('-', $date_today);
	$db = explode('-', $date_birth);
	$age = $dt[0] - $db[0];
	if($dt[1] < $db[1]){
		$age -= 1;
	} elseif($dt[1] == $db[1] && $dt[2] < $db[2]){
		$age -= 1;
	}	
	return $age;
}

function random_token( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $token = substr( str_shuffle( $chars ), 0, $length );
    return $token;
}