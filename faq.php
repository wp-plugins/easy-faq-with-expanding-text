<?php
/*
Plugin Name: Easy FAQ with Expanding Text
Description: Easily create a Frequently Asked Questions page with answers that slide down when the questions are clicked. No need for a shortcode, HTML coding, or javascript tweaking.
Version: 1.0
Author: bgentry
Author URI: http://bryangentry.us
Plugin URI: http://bryangentry.us/easy-faq-page-with-expanding-text-wordpress-plugin/
*/

add_action( 'template_redirect', 'faq_template' );

function faq_template() {
//If WordPress is displaying a page with FAQ or frequently asked questions in the name, add the javascript
    global $wp, $wp_query;

    if ( isset( $wp->query_vars['pagename'] )) {

	$pos = strpos($wp->query_vars['pagename'], 'faq' );
	$posa = strpos($wp->query_vars['pagename'], 'frequently-asked-questions' );	
	if ($pos!==false || $posa!==false){
        if ( have_posts() ) {
			wp_enqueue_script('faqmaker', plugins_url( 'faqmaker.js' , __FILE__ ), array('jquery'));
			wp_enqueue_style( 'faqstyle', plugins_url( 'faqstyle.css' , __FILE__ ));
			add_filter( 'the_content', 'faq_filter' );
        }
        else {
            $wp_query->is_404 = true;
        }
    }}
	}

	function faq_filter($content) {
//this code adds a script to call our javascript function with arguments set on the admin page
	$faqoptions = get_option('bg_faq_options');
		$contentdiv = ($faqoptions['contentdiv_class']) ? $faqoptions['contentdiv_class'] : 'entry-content';
	$foldup = $faqoptions['foldup'];
		$content.='<script>bgfaq("'.$contentdiv.'","'.$foldup.'")</script>';
		return $content;
	}
	
	
//and, let's set up that admin page now:
	add_action('admin_menu', 'faq_admin_page');
function faq_admin_page() {
add_menu_page('FAQ Admin Page', 'FAQ Admin Page',  'manage_options', 'faq_options_page', 'faq_options_page');
}

function faq_options_page() {
?>
<h1>Create an interactive, animated FAQ page with the Easy FAQ with Expanding Text plugin by bGentry.</h1>
<p>This plugin turns your standard frequently asked questions page(s) into a dynamic, animated page. When users click on a question, the answer will expand underneath it. If they click the question again, the answer will slide up and disappear.</p>
<h2>Here's How...</h2>
<img src="<?php echo plugins_url( 'faq_title.png' , __FILE__ ); ?>" style="float:right; margin: 0 20px; border:1px solid #aaa"/>
<p><strong>First</strong>, create a page that includes "FAQ" or "Frequently Asked Questions" somewhere in the title. Note that permalinks must be set to include the title in the permalink.</p>
<img src="<?php echo plugins_url( 'faq_heading.png' , __FILE__ ); ?>" style="float:left; margin: 5px 10px; border:1px solid #aaa"/>
</p><strong>Second</strong>, type your questions and answers.</p>
<p>You indicate questions and answers via formatting that is built into the WordPress editor. Format questions as any kind of heading <strong>(h1, h6... it doesn't matter)</strong>, and format answers as paragraphs. You can include pictures in the answers, as WordPress usually wraps them in paragraph tags. Also, as of version 1.1, this plugin correctly handles lists (numbered and unnumbered) in the answers.</p>
<p>If you need to include some introductory text on your FAQ page, just make it the first paragraph. With some themes, thie plugin may allow two unhidden introductory paragraphs at the very beginning of your content.</p>
<p>Save the page, then view it.</p>
<p>The plugin creates the accordian FAQ functionality on headings and paragraphs within the post content div. For many themes, this div has a class of "entry-content," so that is the default. However, if your theme gives a different class to the div that contains the template tag for the_content(), you can enter that in the options below.</p>
<h2>See below to set options for this plugin and read troubleshooting tips.</h2>
<div style="clear:both;"></div>
<div style="float:right; width:35%; margin: 0px 2% 0px 2%; padding:10px; background-color:#c6ece8; border-radius:20px;">
<h1>Please consider donating</h1>
<p>Have you found this plugin useful? Please consider supporting this plugin (and my son's future college education) by making a donation here.</p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="YF26W5P9QYPWG">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</div>
<div style="border-radius: 20px; background-color: #ecd5c6; padding:10px; margin: 0px 2% 0px 50px; width: 50%;">
<form action='options.php' method='post'>
<?php
settings_fields('faq_settings');
do_settings_sections('faq_section');?>
<input name='submit' type='submit' value='Save FAQ Settings' class="button" style="background-color:#c6ece8; padding:10px;"/>
</form>
</div>
<div style="float:left; width:35%; margin: 20px 2% 0px 50px; padding:10px; background-color:#c6ece8; border-radius:20px;">
<h1>Troubleshooting</h1>
<p>If the plugin is not working correctly, here are a few things to check:</p>
<h2>Ensure page name is correct and permalinks include post name</h2>
<p>The plugin will only activate on pages (not posts!) whose titles include "FAQ" or "Frequently Asked Questions." Check the title of your page, and make sure it is a page, rather than a post.</p>
<p>Also, permalinks must be enabled in such a way that the post name appears in the URL. Check out your Permalink settings and ensure that %postname% is somewhere in your permalink structure. (For SEO purposes, it should be there anyway!) I recommend choosing the Post Name setting on your <a href="<?php echo admin_url('options-permalink.php'); ?>">Permalinks page</a>.</p>
<h2>Ensure the content div class is correct</h2>
<p>We wouldn't want the plugin to hide content from the wrong parts of your page, so it only creates the animation effect inside the HTML element that contains your page content. In many WordPress themes, including the Twenty Eleven theme, this HTML element has a class named "entry-content," and that is the default that we use. However, if you are using a less standard theme, you might need to change the content div setting above.</p>
<h4>Finding the right div calss</h3>
<p>To find out what to enter in the box for the class, do the following:</p>
<ol>
<li>Visit the <a href="<?php echo admin_url('theme-editor.php'); ?>">Theme Editor</a> under the WordPress Appearance menu.</li>
<li>Look down the list of file names on the right. Find the heading "page template" and click on the file beneath it.</li>
<li>Search for the text "the_content()."</li>
<li>If you do not find it in this file (or if there is no page template file), you might find it in a file such as content-page.php or index.php.</li>
<li>Once you find "the_content()" you can look above it. There likely is some text that reads "div class='____'" and that blank is exactly what you are looking for.</li>
</ol>
</div>

<div style="border-radius: 20px; background-color: #ecd5c6; padding:10px; margin: 20px 2%; width: 50%; float:right;">
<h1>About the plugin author</h1>
<p>My name is <a href="http://bryangentry.us">Bryan Gentry</a>. I'm a writer by day and a web designer and programmer by night.</p>
<p>I covered business for a local newspaper for four years after college, then I ran the blog and wrote marketing materials for a private liberal arts college. I have written copy for various websites, including websites I was designing.</p>
<p>I design websites with WordPress and I enjoy making them work better and look better, too. </p>
<p>I balance all this work with family life. My wife is one of my best web design critics. My son is too young to critique my work, but he provides great motivation to do good work, and lots of it!</p>
<h2>Contact Me:</h2>
<p>For support on this plugin, ask me a question, or to work with me on a project, <a href="http://bryangentry.us/contact-me">visit my contact page</a>.</p>
</div>

<?php
}
	
add_action('admin_init', 'faq_admin_init');
function faq_admin_init(){
register_setting( 'faq_settings', 'bg_faq_options');
add_settings_section('faq_settings_section', 'FAQ Plugin Settings', 'faq_get_content_div_class', 'faq_section');
}

function faq_get_content_div_class() {
$faqoptions = get_option('bg_faq_options');
echo "<p><label><strong>Class of div containing content: </strong><input id='plugin_text_string' name='bg_faq_options[contentdiv_class]' type='text' value='".$faqoptions['contentdiv_class']."'/>In your page template, what is the class of the HTML div or other element that contains the the_content() tag?</label></p>";

echo '<p><label><strong>One answer open at a time?</strong>';
if($faqoptions['foldup'] == "yes")
	echo "<input name='bg_faq_options[foldup]' type='checkbox' value='yes' checked /> When users open one question, do you want all other opened answers to disappear as the new answer appears? Check here for yes.";
else
	echo "<input name='bg_faq_options[foldup]' type='checkbox' value='yes' /> When users open one question, do you want all other opened answers to disappear as the new answer appears? Check here for yes.";
echo '</label></p>';
 }
	
	
?>