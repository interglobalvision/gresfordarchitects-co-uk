<?php
require_once(dirname(__DIR__) . "/lib/twitteroauth/autoload.php");
use Abraham\TwitterOAuth\TwitterOAuth;

$connection = new TwitterOAuth("ZUE6ROyNbvpCad072o0DLfsng", "2N9bE1gA17NXNDyRv1QCiVNKzj8Z595AkSH28F1PqyzquNhTD3", "3186926720-3ExiqCHFToVwZQMvj3FpruwK8zoQ4HDPfaue8mM", "SltWM2ALnBCtCZ1kRyaojOisiZIknuk3aU0tuNZL4AIwx");

$statuses = $connection->get("statuses/user_timeline", array(
  "count" => 15,
  "exclude_replies" => true,
  "screen_name" => "gresfordarch"
));

?>

<section id="twitter-feed">

<?php
foreach($statuses as $tweet) {
  echo '<article class="tweet item" id="tweet-' . $tweet->id_str . '">';
  echo '<div class="tweet-meta"><a target="_blank" href="https://twitter.com/__ARPA__/status/' . $tweet->id_str . '">';
  $time = strtotime($tweet->created_at);
  echo '<span class="date">' . date('M d' , $time) . '</span>';
  //if (!empty($tweet->place)) {echo '<span class="location"> - from ' . $tweet->place->full_name . '</span>';};
  echo '</a></div>';

  if (!empty($tweet->entities->media)) {
    foreach ($tweet->entities->media as $media) {
      echo '<a target="_blank" href="https://twitter.com/__ARPA__/status/' . $tweet->id_str . '"><img src="' . $media->media_url_https . '" class="tweet-img" alt="twitter image"></a>';
    }
  }

  $filtered = preg_replace('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', '', $tweet->text);
  echo '<p>';
  echo link_it($filtered);
  echo '</p>';
  if (!empty($tweet->entities->urls)) {
    foreach ($tweet->entities->urls as $url) {
      echo '<a class="tweet-link" target="_blank" href="' . $url->expanded_url . '">' . $url->display_url . '</a> ';
    }
  }
  echo '<hr />';
  echo '</article>';
  $i++;
}

?>
  <a class="button" href="
</section>
