<?php

/*
 Plugin Name: Clippy Function for PHP
 Plugin URI: http://github.com/infomaniac50/php-clippy
 Description: Adds Clippy to PHP.
 Author: Derek Chafin
 Original Author: Kenneth Reitz
 Version: 0.2
 */



function clippy($text='copy-me', $dir = 'lib/') { ?>
    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
            width="110"
            height="14"
            id="clippy" >
    <param name="movie" value="<?php echo $dir; ?>clippy.swf"/>
    <param name="allowScriptAccess" value="always" />
    <param name="quality" value="high" />
    <param name="scale" value="noscale" />
    <param NAME="FlashVars" value="text=<?php echo urlencode($text); ?>">
    <param name="bgcolor" value="#FFFFFF">
    <embed src="<?php echo $dir; ?>clippy.swf"
           width="110"
           height="14"
           name="clippy"
           quality="high"
           allowScriptAccess="always"
           type="application/x-shockwave-flash"
           pluginspage="http://www.macromedia.com/go/getflashplayer"
           FlashVars="text=<?php echo urlencode($text); ?>"
           bgcolor="#FFFFFF"
    />
    </object>
<?php } ?>