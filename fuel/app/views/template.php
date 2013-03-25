<!DOCTYPE HTML>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>MilmSearch<?php echo isset($title) ? $title : '' ?></title>
	<link href="<?php echo $base_url ?>assets/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $base_url ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $base_url ?>assets/css/tuning.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="navbar navbar-fixed-top">
		<div class="header-inner">
			<div class="container">
				<a class="brand" title="MilmSearch Ver.0.1" href="<?php echo $base_url ?>"><img src="<?php echo $base_url ?>assets/img/logo_user.png"></a>
				<nav id="headmenu">
					<ul class="mainmenu">
						<li><a class="btn" href="<?php echo $base_url ?>ml/list">MLを見る</a></li>
						<li><a class="btn" href="<?php echo $base_url ?>ml/proposal/input">MLを登録する</a></li>
					</ul>
					<div class="submenu">
						<a href="<?php echo $base_url ?>top/help">ヘルプ</a><br>
						<a href="<?php echo $base_url ?>top/inquiry">お問い合わせ</a>
					</div>
				</nav>
			</div>
		</div>
	</div>
	<?php echo $content    // <div class="mainArea"><div class="container">~が入る?>
		</div>
	</div>
	<footer id="footer">
		<div class="container">
			<div class="navbar">
				<ul class="nav footnav">
					<li><a href="<?php echo $base_url ?>top/inquiry">お問い合わせ</a></li>
					<li><a href="<?php echo $base_url ?>top/rules">利用規約</a></li>
					<li><a href="<?php echo $base_url ?>top/poricy">プライバシーポリシー</a></li>
				</ul>
			</div>
			<a class="btn_pagetop" href="">ページトップへ</a>
			<p class="copyright">Copyright © MilmSearch All Rights Reserved.</p>
		</div>
	</footer>

<script src="<?php echo $base_url ?>assets/js/jquery-latest.js"></script>
<script src="<?php echo $base_url ?>assets/js/bootstrap.min.js"></script>
</body>
</html>
