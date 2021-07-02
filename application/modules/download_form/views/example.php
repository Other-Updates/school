<?php

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

  try {
    $searchResponse = $youtube->search->listSearch('id,snippet', array(
      'q' => $_GET['q'],
      'maxResults' => $_GET['maxResults'],
    ));

    $videos = '';
    $channels = '';

    foreach ($searchResponse['items'] as $searchResult) {
      switch ($searchResult['id']['kind']) {
        case 'youtube#video':
          $videos .= sprintf('<li>%s (%s)</li>', $searchResult['snippet']['title'],
            $searchResult['id']['videoId']."<a href=http://www.youtube.com/watch?v=".$searchResult['id']['videoId']." target=_blank>   Watch This Video</a>");
          break;
        case 'youtube#channel':
          $channels .= sprintf('<li>%s (%s)</li>', $searchResult['snippet']['title'],
            $searchResult['id']['channelId']);
          break;
       }
    }

   } catch (Google_ServiceException $e) {
    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  } catch (Google_Exception $e) {
    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  }
}
?>

<!doctype html>
<html>
  <head>
    <title>YouTube Search</title>
<link href="//www.w3resource.com/includes/bootstrap.css" rel="stylesheet">
<style type="text/css">
body{margin-top: 50px; margin-left: 50px}
</style>
  </head>
  <body>
    <form method="GET" onsubmit="return badword();">
  <div>
    Search Term: <input type="search" id="q" name="q" placeholder="Enter Search Term"><span id="bad" style="color:#F00;"></span>
  </div>
  <div>
    Max Results: <input type="number" id="maxResults" name="maxResults" min="1" max="50" step="1" value="25">
  </div>
  <input type="submit" value="Search" id="submit"  >
</form>
<h3>Videos</h3>
    <ul><?php echo $videos; ?></ul>
    <h3>Channels</h3>
    <ul><?php echo $channels; ?></ul>
</body>
</html>
<script type="text/javascript">
var bad_words_array=new Array("sex","fuck","bomb","dick","penis","boob","tits","cunt","vagina","pussy","xxx","blow","felch","skullfuck","dumpster","blumpkin","rusty","trombone","Cleveland","hole","cum freak","porn","plug hole","cumdump","blue waffle","assmucus","fist","mother fucker","bitch","buggery","struck","fart","drapes","licker","cock","shum","salami","anal","mufugly","pole","leakage","corn","sausage","guzzler","gang","bang","facial","spank","Hank","muppet","crapsticks","hair","ass","lick",
"aunty","mallu","punda","sunny","sunni","masturbation","masturbate","sauce","taaja","kaaja");

function badwords(txt)
{
 var alert_arr=new Array;
 var alert_count=0;
 var compare_text=document.getElementById('q').value;
 for(var i=0; i<bad_words_array.length; i++)
 {
  for(var j=0; j<(compare_text.length); j++)
  {
   if(bad_words_array[i]==compare_text.substring(j,(j+bad_words_array[i].length)).toLowerCase())
   {
    alert_count++;
   }
  }
 }

 return alert_count;
}



function badword()

{
	
var textbox_val=document.getElementById('q').value;
if(textbox_val=="")
{
//alert("Please enter a message");
return false;
}

bwords=badwords(textbox_val);
if(bwords>0)
{
//alert("Your message contains inappropriate words.Please clean up your message.");
 $("#bad").html("Your message contains inappropriate words.");
return false;
}
else
{
	 $("#bad").html("");
}
}
</script>