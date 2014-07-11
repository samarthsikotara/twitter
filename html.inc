<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Twitter World</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <style type="text/css">
      img {border-width: 0}
     /* * {font-family:'Lucida Grande', sans-serif;} */
    </style>
  </head>
  <body>
    <div>
      <h2>Welcome to a Twitter World</h2>

      <p>This site is a basic showcase of Twitters OAuth authentication method. If you are having issues try <a href='./clearsessions.php'>clearing your session</a>.</p>

      <!--<p>
        Links:
        <a href='http://github.com/abraham/twitteroauth'>Source Code</a> &amp;
        <a href='http://wiki.github.com/abraham/twitteroauth/documentation'>Documentation</a> |
        Contact @<a href='http://twitter.com/abraham'>abraham</a>
      </p>-->
      <hr />
      <?php if (isset($menu)) { ?>
        <?php echo $menu; ?>
      <?php } ?>
    </div>
    <?php if (isset($status_text)) { ?>
      <?php echo '<h3>'.$status_text.'</h3>'; ?>
    <?php } ?>
    <p>
        <pre>
            <?php
            //header("Content-type: image/png");
            for($i=0;$i<count($followers->users);$i++){

                echo "<img src=".$followers->users[$i]->profile_image_url." style = 'width: 50px;height: 50px;' />";
                //echo $content->users[$i]->profile_image_url;
                echo $followers->users[$i]->name.'<br />';
            }
            print_r($content);
            ?>

        </pre>
    </p>

  </body>
</html>
