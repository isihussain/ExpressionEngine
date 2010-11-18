<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title><?=$cp_page_title?> | ExpressionEngine</title>

	<link rel="stylesheet" href="<?=$this->config->item('theme_folder_url')?>cp_themes/<?=$this->cp->cp_theme;?>/css/jquery-ui-1.7.2.custom.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?=$this->config->item('theme_folder_url')?>cp_themes/<?=$this->cp->cp_theme;?>/css/global.css?v=<?=$theme_css_mtime;?>" type="text/css" media="screen" />
	
	<?php if ($this->extensions->active_hook('cp_css_end') === TRUE):?>
	<link rel="stylesheet" href="<?=BASE.AMP.'C=css'.AMP.'M=cp_global_ext';?>" type="text/css" />
	<?php endif;?>
	<!--[if lte IE 7]>
	<link rel="stylesheet" href="<?=BASE.AMP.'C=css'.AMP.'M=iefix'?>" type="text/css" media="screen" charset="utf-8" />
	<![endif]-->

	<?php

	if (isset($cp_global_js))
	{
		echo $cp_global_js;
	}
	?>
		<script type="text/javascript" src="<?=$this->config->item('theme_folder_url')?>javascript/<?=JS_FOLDER?>/jquery/jquery.js?v=<?=$jquery_mtime?>"></script>
	
	<script charset="utf-8" type="text/javascript" src="<?=BASE.AMP.'C=javascript'.AMP.'M=load'.AMP.'plugin=corner'.AMP.'v='.$corner_mtime?>"></script>
	<script charset="utf-8" type="text/javascript" src="<?=BASE.AMP.'C=javascript'.AMP.'M=load'.AMP.'file=css'.AMP.'theme='.$this->cp->cp_theme.AMP.'v='.$advanced_css_mtime?>"></script>

	<?php
	if (isset($script_head))
	{
		echo $script_head;
	}

	foreach ($this->cp->its_all_in_your_head as $item)
	{
		echo $item."\n";
	}
	?>

</head>
<body>
<noscript>
<div class="js_notification" style="top: 0;">
	<div class="notice_inner js_error">
		<span><?=lang('no_js_warning')?></span>
	</div>
</div>
</noscript>
<!--[if lte IE 6]>
<div class="js_notification" style="top: 0;">
	<div class="notice_inner js_error">
		<span><?=lang('ie_6_warning')?></span>
	</div>
</div>
<![endif]-->
<div id="branding"></div>

<?php
/* End of file header.php */
/* Location: ./themes/cp_themes/default/_shared/header.php */