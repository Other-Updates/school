<div class="message-container">
<div class="message-form-content">
<div class="message-form-header">
    <div class="message-form-user">
    	<img src="<?= $theme_path; ?>/images/icons/events/download.png">
    </div>
    Videos Search		
</div>
<div class="message-form-inner">
<?php

if(isset($_GET['q']) && !empty($_GET['q']))
{
if ($_GET['q'] && $_GET['maxResults']) {
  // Call set_include_path() as needed to point to your client library.
  require_once ($_SERVER["DOCUMENT_ROOT"].'/demo/google-api-php-client/src/Google_Client.php');
  require_once ($_SERVER["DOCUMENT_ROOT"].'/demo/google-api-php-client/src/contrib/Google_YouTubeService.php');

  /* Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
  Google APIs Console <http://code.google.com/apis/console#access>
  Please ensure that you have enabled the YouTube Data API for your project. */
  $DEVELOPER_KEY = 'AIzaSyDOkg-u9jnhP-WnzX5WPJyV1sc5QQrtuyc';

  $client = new Google_Client();
  $client->setDeveloperKey($DEVELOPER_KEY);

  $youtube = new Google_YoutubeService($client);


    $searchResponse = $youtube->search->listSearch('id,snippet', array(
      'q' => $_GET['q'],
      'maxResults' => $_GET['maxResults'],
    ));

    $videos = '';
    $channels = '';

    $i=1;

     foreach ($searchResponse['items'] as $searchResult) {

          if($i==1)
         {
           $first=$searchResult['id']['videoId'];
$i++;
         }
          
    
    }
?>
<input type='hidden' id='assignt' value='<?=$first?>'>
<?php
}
}
else
{
?>
<input type='hidden' id='assignt' value=''>
<?php
}
?>

<!doctype html>
<html>
  <head>
   


<style type="text/css">
body{margin-top: 50px; margin-left: 50px}
</style>
  </head>
  <body>
    <form method="GET">
<table>
<tr>
<td style='position: relative;
top: -5px;'>Search Term:</td>
<td><input type="search" id="q" name="q" placeholder="Enter Search Term"></td>
<td style='position: relative;
top: -5px;'> Max Results:</td>
<td> <input type="number"  id="maxResults" name="maxResults" style='height:30px;' step="1" value="25"></td>
<td><input type="submit" value="Search"></td>
</tr>
</table>

</form>
<script type="text/javascript">
	$(document).ready(function(){
                if($('#assignt').val()=='')
		  $('.ff').attr('src','//www.youtube.com/embed/hI2qjbROkhk');
	        else
                  $('.ff').attr('src','//www.youtube.com/embed/'+$('#assignt').val()); 
	});
		
	$('.ss').live('click',function(){
		
			$('.ff').attr('src','//www.youtube.com/embed/'+$(this).attr('id'));	
						
	});
	
</script>
<h3>Search Result for '<?=$_GET['q']?>'</h3>
     <iframe class="ff" width="100%" height="470"  frameborder="0" allowfullscreen></iframe>
    <?php

      foreach ($searchResponse['items'] as $searchResult) {

         ?>
         
           <a href='#' class='ss' id='<?=$searchResult['id']['videoId']?>' title='<?=$searchResult['id']['title']?>'><img width="200px" height="150px" src="<?=$searchResult['snippet']['thumbnails']['default']['url'];?>"></a>  
   <?php
          
    
    }
    ?>
    
</body>
</html>

</div>
</div>
</div>