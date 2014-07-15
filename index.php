<?php 
include ("tutzi/class/template.class.php");



if(isset($_GET["page"])){

$template->buildSite();

}else {
include("view/login.view.php");
}

?>