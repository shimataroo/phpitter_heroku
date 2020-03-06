<?php
session_start();
require('dbconnect.php');

if (empty($_REQUEST['id'])){
  header('Location: index.php'); 
  exit();
}

$posts = $db->prepare('SELECT m.name, m.picture, p.* FROM members m, posts p
                      WHERE m.id=p.member_id AND p.id=?');
$posts->execute(array($_REQUEST['id']));
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>タイムライン</title>

	<link rel="stylesheet" href="style.css" />
  <link href="bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div id="wrap">
  <div id="head">
    <h1>タイムライン</h1>
  </div>
  <div id="content">
  <p><a href="index.php">一覧にもどる</a></p>

  <?php if($post = $posts->fetch()): ?>
    <div class="msg">
    <img src="member_picture/<?php print(htmlspecialchars($post['picture'])); ?>" />
    <p><?php print(htmlspecialchars($post['message'])); ?><span class="name">（<?php print(htmlspecialchars($post['name'])); ?>）</span></p>
    <p class="day"></p>
    </div>
  <?php else: ?>
	<p>その投稿は削除されたか、URLが間違えています</p>
  <?php endif; ?>
  </div>
</div>
</body>
</html>
