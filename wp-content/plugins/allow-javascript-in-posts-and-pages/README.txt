=== Allow Javascript in Posts and Pages ===
Contributors: Hit Reach
Donate link: 
Tags: post, pages, javascript, filtering, text, add javascript
Requires at least: 2.0
Tested up to: 3.0.5
Stable tag: 0.0.1

Allow Javascript in posts and pages allows the include of Javascript inside posts and pages, whilst retaining HTML tags and functional script

== Description ==

Allow Javascript in posts and pages adds the functionality to include Javascript in wordpress posts and pages by adding a simple shortcode [js].code.[/js]

This plugin strips away the automatically generated wordpress &lt;p&gt; and &lt;br/&gt; tags but still allows the addition of your own &lt;p&gt; and &lt;br/&gt; tags by using [p] and [/p] or [br/] or [a href='void(0)']link[/a]

Please submit bugs

== Usage ==

To add the Javascript code to your post or page simply place any Javascript code inside the shortcode tags.

For example: If you wanted to add content that is visible to a particular user id:

For example: a simple alert

	[js]
	 alert('helloWorld');
	[/js]
	
This code will cause a popup when the page is loaded.  in addition, should this code not be working (for example a missing ";") simply just change the [js] to be [js debug=1]

     [js debug=1]
      alert('helloWorld');
      [/js]

= Some Important Notes = 

This plugin strips away all instances of &lt;p&gt; and &lt;br /&gt; therefore code has been added so that if you wish to use tags in your output (e.g.): 
     [js]
      alert("hello &lt;br /&gt; world");
     [/js]
	
the < and > tags will need to be swapped for [ and ] respectively so &lt;p&gt; becomes [p] and &lt;/p&gt; becomes [/p] which is converted back to &lt;/p&gt; at runtime. these [ ] work for all tags (p, strong, em etc.). 
     [js]
      alert("hello [br /] world");
     [/js]

== Installation ==

1. Extract the zip file and drop the contents in the wp-content/plugins/ directory of your WordPress installation
1. Activate the Plugin from Plugins page

== Misc ==
Developed by <a href='http://www.hitreach.co.uk' target="_blank" style='text-decoration:none;'>Hit Reach</a>

Check out our other <a href='http://www.hitreach.co.uk/services/wordpress-plugins/' target="_blank" style='text-decoration:none;'>Wordpress Plugins</a>

Version: 1.0 <a href='http://www.hitreach.co.uk/wordpress-plugins/allow-javascript-in-posts-and-pages/' target="_blank" style='text-decoration:none;'>Support & Comments</a>

== Change log ==
= 0.0.1 =
* Initial Release

== Frequently Asked Questions ==
= What Tags Are Automatically Removed? =
Currently all &lt;br /&gt; and &lt;p&gt; (and its closing counterpart) tags are removed from the input code because these are the tags that Wordpress automatically add.
= How Do I Add Tags Without Them Being Stripped? =
If you want to echo a paragraph tag or a line break, or any other tag (strong, em etc) instead of enclosing them in &lt; and &gt; tags, enclose them in [ ] brackets for example [p] instead of &lt;p&gt; The square brackets are converted after the inital tags are stripped and function as normal tags.
= Thats All Good But I want To Include A [ and ] In My Output! =
To include square brackets in your output simply add a \ before it so [ becomes \[ and ] becomes \], again these are converted and will display as [ and ]
= My Question Is Not Answered Here! =
If your question is not listed here please look on: <a href='http://www.hitreach.co.uk/wordpress-plugins/allow-javascript-in-posts-and-pages/' target="_blank" style='text-decoration:none;'>http://www.hitreach.co.uk/wordpress-plugins/allow-javascript-in-posts-and-pages/</a> and if the answer is not listed there, just leave a comment
