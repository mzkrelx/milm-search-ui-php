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
<div class="container-fluid">
	<header class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggles="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="<?php echo $base_url ?>">MilmSearch Ver.0.1</a>
				<nav class="nav-collapse">
					<ul class="nav nav-pills">
						<li><a href="<?php echo $base_url ?>ml/list">MLを見る</a></li>
						<li><a href="<?php echo $base_url ?>ml/proposal/input">MLを登録する</a></li>
					</ul>
				</nav>
				<a href="<?php echo $base_url ?>top/help">ヘルプ</a><br>
				<a href="<?php echo $base_url ?>top/inquiry">お問い合わせ</a>
			</div>
		</div>
	</header>
	<?php echo $content    // <section>~</section> が入る?>
</div>
<footer id="footer">
	<div class="container-fluid">
		<a href="">ページトップへ</a>
		<nav>
			<ul>
				<li><a href="<?php echo $base_url ?>top/inquiry">お問い合わせ</a></li>
				<li><a href="<?php echo $base_url ?>top/rules">利用規約</a></li>
				<li><a href="<?php echo $base_url ?>top/poricy">プライバシーポリシー</a></li>
			</ul>
		</nav>
		<p>Copyright © MilmSearch All Rights Reserved.</p>
	</div>
</footer>


<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="<?php echo $base_url ?>assets/js/bootstrap.min.js"></script>
</body>
</html>
