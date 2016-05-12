<?php
/* Get form request and save it. */
if(isset($_REQUEST['submit']))
{
	$tmpl_amp_enable=sanitize_text_field($_REQUEST['tmpl_amp_enable']);
	$tmpl_amp_theme=sanitize_text_field($_REQUEST['tmpl_amp_theme']);
	$tmpl_amp_header_code=$_REQUEST['tmpl_amp_header_code'];
	$tmpl_amp_footer_code=$_REQUEST['tmpl_amp_footer_code'];
	$tmpdata = get_option('tmpl_amp_settings');
	$tmpdata['tmpl_amp_enable']=$tmpl_amp_enable;
	$tmpdata['tmpl_amp_theme']=$tmpl_amp_theme;
	$tmpdata['tmpl_amp_header_code']=$tmpl_amp_header_code;
	$tmpdata['tmpl_amp_footer_code']=$tmpl_amp_footer_code;
	update_option('tmpl_amp_settings',$tmpdata);
	flush_rewrite_rules();
}

/* Reset setting to default */
if(isset($_REQUEST['reset']))
{
	$tmpdata = get_option('tmpl_amp_settings');
	$tmpdata['tmpl_amp_enable']="1";
	$tmpdata['tmpl_amp_theme']="templatic";
	$tmpdata['tmpl_amp_header_code']='';
	$tmpdata['tmpl_amp_footer_code']='';
	update_option('tmpl_amp_settings',$tmpdata);
	flush_rewrite_rules();
}
?>
<div class="wrapper">
<h1><?php _e('AMP Setting','templatic-amp'); ?></h1>
<form action="" method="POST">
<?php $tmpdata = get_option('tmpl_amp_settings'); ?>
<table class="tmpl-general-settings form-table" style="display: table;">
<tbody>
<tr>
		<th>
			<label><?php _e('Enable AMP?','templatic-amp'); ?></label>
		</th>
		<td> 
			<div class="onoffswitch">
				<input type="checkbox" name="tmpl_amp_enable" class="onoffswitch-checkbox" id="myonoffswitch" value="1"<?php if($tmpdata['tmpl_amp_enable']){ echo 'checked="checked"'; } ?>>
				<label class="onoffswitch-label" for="myonoffswitch">
					<span class="onoffswitch-inner"></span>
					<span class="onoffswitch-switch"></span>
				</label>
			</div>
			<p class="description"><?php _e('Enable/Desable AMP','templatic-amp'); ?></p>
		</td>
</tr>
<tr>
		<th>
			<label><?php _e('AMP Theme','templatic-amp'); ?></label>
		</th>
		<td> 
			<div class="element">
			 <div class="input_wrap">
			 <input type="text" value="<?php echo $tmpdata['tmpl_amp_theme']; ?>" name="tmpl_amp_theme" required> </div>
			</div>
		</td>
</tr>
<tr>
		<th>
			<label><?php _e('Header Code','templatic-amp'); ?></label>
		</th>
		<td> 
			<div class="element">
			 <div class="input_wrap">
			 <textarea name="tmpl_amp_header_code" rows='10' cols='50'><?php echo $tmpdata['tmpl_amp_header_code']; ?></textarea></div>
			</div>
		</td>
</tr>
<tr>
		<th>
			<label><?php _e('Footer Code','templatic-amp'); ?></label>
		</th>
		<td> 
			<div class="element">
			 <div class="input_wrap">
			 <textarea name="tmpl_amp_footer_code" rows='10' cols='50'><?php echo $tmpdata['tmpl_amp_footer_code']; ?></textarea></div>
			</div>
		</td>
</tr>
<tr>
	<td>
	<p style="clear: both;" class="submit">
	  <input type="submit" value="Save All Setting" class="button button-primary button-hero" name="submit">
	</p>
	</td>
	<td>
	<p style="clear: both;" class="submit">
	  <input type="submit" value="Reset Default" class="button button-primary button-hero" name="reset">
	</p>
	</td>
</tr>
</tbody>
</table>
</form>
</div>