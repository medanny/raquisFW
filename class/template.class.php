<?php

  class Template//Inicio de clase
{
	var $siteName;     //Nombre completo de la Persona
    var $title;
    var $HTML;

	function  Template(){
    $this->HTML=" ";

	}
	
	function  strHeaderMsgs($number){
	$this->htmlAdd('<li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Tiene ');
    $this->htmlAdd($number.' <li>
                                    <ul class="menu">');  	    
	}
	function HeaderMsgs_addMsg($img,$title,$msg,$mins){
    $this->htmlAdd('<li>
    	<a href="#">
    	 <div class="pull-left">
    	  <img src="'.$img.' " class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>'. $title . ' <small><i class="fa fa-clock-o"></i>'. $mins .' mins</small>
                                                </h4>
                                                <p>'. $msg . '</p>
                                            </a>
                                        </li>');
	}
	function HeaderMsgs_reder(){
    $this->htmlAdd('</ul>
                                </li>
                                <li class="footer"><a href="#">Mirar todos los mensajes</a></li>
                            </ul>
                        </li>');
    
   // return this->$HTML;
    echo $this->HTML;
	}



	function htmlAdd($text){
	$this->HTML=$this->HTML.$text;
	}

}
;
$template = new Template();
?>