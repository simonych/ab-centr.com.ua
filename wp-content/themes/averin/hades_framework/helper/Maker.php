<?php

/* ======================================================================= */
/* == Custom Post Maker ================================================== */
/* ======================================================================= */

/* 

Author - WPTitans
Code Name - Loki
Version - 1.0
Description - Creates custom managers for themes that works on Hades Plus Framework.

*/



if(!class_exists('Loki')) {

// == Class defination begins	=====================================================
  class Loki {
	  
	  private $name;
	  private $panelName;
	  private $markup;
	  
	   // == Constructor ==============================================================
      function __construct($name,$markup=''){ 
	  
		
		$this->name = $name;
		$this->panelName = strtoupper(substr($name,0,4));
		$this->markup = $markup;
		add_action('admin_menu',array($this,'manager_admin_menu'));
        add_action('admin_init',array($this,'manager_admin_init'));
	  }
	  
	  function manager_admin_menu(){
		  
		if(isset($_GET['page'])&&$_GET['page']== $this->panelName){
          $page = $_GET['page'];
		   
        
  
		  }
		  
		  
		if(function_exists('add_submenu_page'))
		{
			 add_submenu_page("elements.php", $this->name.' Manager', $this->name.' Manager', 'edit_themes', $this->panelName ,array($this,'manager_admin_wrap'));
		}
		
			  
	  }
		  
	  function manager_admin_init(){	  }	
	  
	  function manager_admin_wrap(){	 }	  
	  
	   } // == End of Class ==========================
  
}

