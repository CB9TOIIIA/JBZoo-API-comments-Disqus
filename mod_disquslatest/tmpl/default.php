<div class="disquslatest" class="<?php echo $moduleclass_sfx ?>">
<?php
$forumid = $params['forumid'];
$apikey = $params['apikey'];
$limit = $params['limit'];
if ($params['apikey'] !='') {
$get_disquscomments = file_get_contents("https://disqus.com/api/3.0/forums/listPosts.json?forum=$forumid&limit=$limit&related=thread&api_key=$apikey");
$contentdisquscomments = json_decode($get_disquscomments, true);
// SEE ALL DATA
// echo "<pre>";
// var_dump($content);
// echo "</pre>";
// if all not work - you can use this javascript variant: <script type="text/javascript" src="http://IDFORUM.disqus.com/recent_comments_widget.js?num_items=15&hide_avatars=0&avatar_size=32&excerpt_length=200"></script>
// done
foreach ($contentdisquscomments['response'] as $details) {
  $url = $details['url'];
  $raw_message = $details['raw_message'];
  $raw_message = htmlspecialchars($raw_message);
  $raw_message = mb_substr($raw_message, 0, 300, 'UTF-8');
  $createdAt = $details['createdAt'];
  $createdAtformat = date('d.m.y H:i:s', strtotime($createdAt));
  $nameauthor = $details['author']['name'];
  $checkisAnonymous = $details['author']['isAnonymous'];
  if ($checkisAnonymous != "1") {
      $nickauthor = $details['author']['username'];
  }
  $titlepost = $details['thread']['clean_title'];
  $authorprofileUrl = $details['author']['profileUrl'];
  $authoravatar = $details['author']['avatar']['small']['permalink'];
  // echo "URL: " .$url;  echo "<br>";
  // echo "Текст: ".$raw_message."...";  echo "<br>";
  // echo("Дата: ".$createdAtformat);  echo "<br>";
  // echo("nameauthor: ".$nameauthor);  echo "<br>";
  // echo "<!-- ";
  // echo("nickauthor ".$nickauthor);
  // echo " -->";
  // echo("authorprofileUrl: ".$authorprofileUrl);  echo "<br>";
  // echo("authoravatar: ".$authoravatar);  echo "<br>";
  // echo "<img src='".$authoravatar."'>";  echo "<br>";
  // echo "<br>";
  // echo "<br>";
  echo "<!--noindex-->";
  echo "<blockquote>";
  echo "<p><a rel='nofollow' class='avatarandurlcomment' href='".$authorprofileUrl."'>" . "<img width='32px' height='32px' src='" .$authoravatar. "'>" .$nameauthor. "</a> " . "<span class='datecomment'>" . $createdAtformat. "</span>". "</p>";
  echo "<p class='smallcomment'>".$raw_message."..."."</p>";
  echo "<footer><a href='".$url."'>".$titlepost."</a></footer>";
  echo "<!-- ";
  echo "nickauthor ";
  if (!empty($nickauthor)) { echo $nickauthor; }
  echo " -->";
  echo "</blockquote>";
  echo "<!--/noindex-->";

  }
}
?>
</div>