// JavaScript Document
<?php

$path = __FILE__;
$pathwp = explode( 'wp-content', $path );
$wp_url = $pathwp[0];
require_once( $wp_url.'/wp-load.php' ); ?>


var loc = "<?php echo HURL; ?>";

var img_loc = loc+"/css/i/shortcode.png";
loc = loc + "/helper/shortcode_listener.php";
// Creates a new plugin class
tinymce.create('tinymce.plugins.button', {
    createControl: function(n, cm) 
                {
                    switch (n) {
            case 'button':
                var c = cm.createMenuButton('Shortcodes', {
   title : 'WPTitans Shortcode Editor',
    image : img_loc
});

c.onRenderMenu.add(function(c, m) {
    m.add({title : 'Shortcodes', 'class' : 'mceMenuItemTitle'}).setDisabled(1);
    
	 m.add({title : 'Layouts'
	 ,onclick:function(){
		  
		   tb_show('Insert Shortcode',"#TB_inline"); 
		 jQuery("#TB_ajaxContent").load(loc+"?type=layout");
					jQuery("#TB_ajaxContent").css({ 
					  
					  width: jQuery("#TB_ajaxContent").parent().width()-30,
					  height: jQuery("#TB_ajaxContent").parent().height()-40
					 });
		 }
	 });
	
	
					
					 
	var sub1 = m.addMenu({title : 'Blog', onclick : function() {   }});
	sub1.add({title : 'Recent Posts', onclick : function() { tinyMCE.activeEditor.selection.setContent("[recentposts count='3' excerpt=true excerpt_length='100' post_type='post' /]");  }});
	sub1.add({title : 'Popular Posts', onclick : function() { tinyMCE.activeEditor.selection.setContent("[popularposts count='3' excerpt=true excerpt_length='100' post_type='post' /]");  }});
	sub1.add({title : 'Related Posts', onclick : function() { tinyMCE.activeEditor.selection.setContent("[relatedposts count='3'  /]");  }});
	sub1.add({title : 'Posts', onclick : function() {  tinyMCE.activeEditor.selection.setContent("[posts count='3' excerpt=true excerpt_length='100' author_name='' category_name='' tag=''  post_type='post' /]");  }});
	
	var sub2 = m.addMenu({title : 'Media', onclick : function() {   }});
	sub2.add({title : 'Youtube', onclick : function() { tinyMCE.activeEditor.selection.setContent("[youtube id='j0lSpNtjPM8' width='300' height='250' /]   ");  }});
	sub2.add({title : 'Vimeo', onclick : function() { tinyMCE.activeEditor.selection.setContent("[vimeo id='23281150' width='300' height='250' /]   ");  }});
	sub2.add({title : 'Dedicated Video', onclick : function() { tinyMCE.activeEditor.selection.setContent("[video  width='300' height='250' src='' /]   ");  }});
	sub2.add({title : 'Imagewrapper', onclick : function() { tinyMCE.activeEditor.selection.setContent("[imagewrapper src='' caption='' class='' width='' height='' /]   ");  }});
	
	
	var sub3 = m.addMenu({title : 'Typography', onclick : function() {   }});

	sub3.add({title : 'Quotes', onclick : function() { tinyMCE.activeEditor.selection.setContent('[quotes]'+tinyMCE.activeEditor.selection.getContent()+"[/quotes]");  }});
	sub3.add({title : 'Quotes Left', onclick : function() { tinyMCE.activeEditor.selection.setContent('[quotes_left]'+tinyMCE.activeEditor.selection.getContent()+"[/quotes_left]");  }});
	sub3.add({title : 'Quotes Right', onclick : function() { tinyMCE.activeEditor.selection.setContent('[quotes_right]'+tinyMCE.activeEditor.selection.getContent()+"[/quotes_right]");  }});
    sub3.add({title : 'PRE', onclick : function() { tinyMCE.activeEditor.selection.setContent('[pre]'+tinyMCE.activeEditor.selection.getContent()+"[/pre]");  }});


	
	
	var sub4 = m.addMenu({title : 'UI', onclick : function() {   }});
		sub4.add({title : 'Error Box', onclick : function() {  tinyMCE.activeEditor.selection.setContent('[error_box title="your title" ]'+tinyMCE.activeEditor.selection.getContent()+"[/error_box]");  }});
		sub4.add({title : 'Warning Box', onclick : function() {  tinyMCE.activeEditor.selection.setContent('[warning_box title="your title"   ]'+tinyMCE.activeEditor.selection.getContent()+"[/warning_box]");  }});
		sub4.add({title : 'Success Box', onclick : function() {  tinyMCE.activeEditor.selection.setContent('[success_box title="your title"   ]'+tinyMCE.activeEditor.selection.getContent()+"[/success_box]");  }});
		sub4.add({title : 'Information Box', onclick : function() {  tinyMCE.activeEditor.selection.setContent('[information_box title="your title" ]'+tinyMCE.activeEditor.selection.getContent()+"[/information_box]");  }});
		
		
		sub4.add({title : 'Button', onclick : function() {    tb_show('Insert Shortcode',"#TB_inline"); 
		 jQuery("#TB_ajaxContent").load(loc+"?type=button");
					jQuery("#TB_ajaxContent").css({ 
					  
					  width: jQuery("#TB_ajaxContent").parent().width()-30,
					  height: jQuery("#TB_ajaxContent").parent().height()-40
					 });  }});
	
		sub4.add({title : 'Separator', onclick : function() { tinyMCE.activeEditor.selection.setContent("[separator /]");  }});
	  
		
	var sub5 = m.addMenu({title : 'Widgets', onclick : function() {   }});
   sub5.add({title : 'Tabs', onclick : function() { tinyMCE.activeEditor.selection.setContent('[tabs][tab title="your tab1 title"] your content here... [/tab][/tabs]');   }});
    sub5.add({title : 'Accordion', onclick : function() { tinyMCE.activeEditor.selection.setContent('[accordion][section  title="your tab1 title"] your content here...  [/section][/accordion]');   }});

	sub5.add({title : 'Google Map', onclick : function() { tinyMCE.activeEditor.selection.setContent("[map address='' width='300' height='' /]");   }});
	 
	
	
	m.add({title : 'Sliders', onclick : function() { 
	 
	  tb_show('Insert Shortcode',"#TB_inline"); 
		 jQuery("#TB_ajaxContent").load(loc+"?type=slider");
					jQuery("#TB_ajaxContent").css({ 
					  
					  width: jQuery("#TB_ajaxContent").parent().width()-30,
					  height: jQuery("#TB_ajaxContent").parent().height()-40
					});
					
	  }});
      
    
     
 
});
                // Return the new splitbutton instance
                return c;
        }

            
                    return null;
                }
});

// Register plugin
tinymce.PluginManager.add('button', tinymce.plugins.button);