<?php
$form_page = true;
$dont_check_login = true;
$content_class = true;
$class_names = [
		'content'
];
?>
<?php
include_once("includes/functions/loader.inc");
$read_access = true;
//exit script in case of delete statement
if ((!empty($_GET['delete'])) && ($_GET['delete'] == 1)) {
 return;
}
if ((!empty($_POST))) {
 return;
}
?>
<?php
$content_rp = getrwuPrivilage($content_type->read_role, $_SESSION['user_roles'][0]);
$content_wp = getrwuPrivilage($content_type->write_role, $_SESSION['user_roles'][0]);
$content_up = getrwuPrivilage($content_type->update_role, $_SESSION['user_roles'][0]);
$content_privilage = $content_rp + $content_wp + $content_up;

$crp = getrwuPrivilage($content_type->comment_read_role, $_SESSION['user_roles'][0]);
$cwp = getrwuPrivilage($content_type->comment_write_role, $_SESSION['user_roles'][0]);
$cup = getrwuPrivilage($content_type->comment_update_role, $_SESSION['user_roles'][0]);
$comment_privilage = $crp + $cwp + $cup;

 if ($continue) {
  include_once(THEME_DIR . '/header.inc');
 } else {
  $continue = false;
  echo "<h2>Could n't call the header</h2>";
  return;
 }
 
if (($content_privilage >= 6) && ($mode == 9)) {
 include_once(THEME_DIR . '/content_template.inc');
} else if (($content_privilage >= 4) && empty($$class->$class_id_first) && ($mode == 9)) {
 include_once(THEME_DIR . '/content_template.inc');
} else if (($content_privilage >= 4) && !empty($_SESSION['username']) && ($$class->created_by == $_SESSION['username']) && ($mode == 9)) {
 include_once(THEME_DIR . '/content_template.inc');
} else if (($mode == 9)) {
 access_denied();
} else {
 require_once(INC_EXTENSIONS . DS . 'content' . DS . 'view' . DS . "content_view.php");
 echo !empty($breadCrum) ? '<div class="container">'.$breadCrum .'</div>': false;
 if ((!empty($content->content_id)) && ($content_type_name)) {
	include_once(THEME_DIR . '/view_content_template.inc');
 } elseif ((!empty($category_id)) && ($content_type_name)) {
	include_once(THEME_DIR . '/contents_list_template.inc');
 } else {
	include_once(THEME_DIR . '/contents_list_template.inc');
//	echo $content->showSummaryList_byConteTypeCategory($pageno, $per_page, $query_string);
//	require_once(INC_BASICS . DS . "list_page.inc");
//	include_once(THEME_DIR . '/content_search.php');
 }
}
?>
<script type="text/javascript">
 $(document).ready(function () {
//  $('body').on('click', '#header_top .menu a',function(e){
//  e.preventDefault();
//  window.location.replace($(this).prop('href'));
//});
 });
</script>