<?php
/*
Plugin Name: Simple Tag Shortcode
Plugin URI: http://webhelp.pl
Description: Simple [tag] shortcode.
Author: Bartosz Romanowski
Version: 1.0
Author URI: http://webhelp.pl
*/

function tag_shortcode($atts, $content = null)
{
	extract(shortcode_atts(array('slug' => '', 'name' => ''), $atts));

	if(trim($slug))
		$tag = get_term_by('slug', trim($slug), 'post_tag');
	elseif(trim($name))
		$tag = get_term_by('name', trim($name), 'post_tag');
	elseif(trim($content))
		$tag = get_term_by('name', trim($content), 'post_tag');
		
	if($tag)
		return '<a href="'.get_tag_link($tag->term_id).'" title="'.$tag->name.'">'.$content.'</a>';
	else
		return str_replace(array("[tag]", "[/tag]"), "", $content);
}

add_shortcode('tag', 'tag_shortcode');

?>
