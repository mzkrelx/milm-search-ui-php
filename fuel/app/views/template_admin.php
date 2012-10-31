<!DOCTYPE HTML>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>MilmSearch admin</title>
	<link href="<?php echo $base_url ?>assets/admin/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $base_url ?>assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $base_url ?>assets/admin/css/tuning.css" rel="stylesheet" type="text/css">
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
				<a class="brand" href="<?php echo $base_url ?>admin">MilmSearch admin</a>
				<nav class="nav-collapse">
					<ul class="nav nav-pills">
					<?php // TODO 可変 class ?>
						<li<?php if (isset($nav_status) AND $nav_status === 'new') : echo ' class="active"'; endif ?>>
							<a href="<?php echo $base_url ?>admin/ml/proposal/list?status=new">審査待ち</a>
						</li>
						<li<?php if (isset($nav_status) AND $nav_status === 'accepted') : echo ' class="active"'; endif ?>>
							<a href="<?php echo $base_url ?>admin/ml/proposal/list?status=accepted">承認済み</a>
						</li>
						<li<?php if (isset($nav_status) AND $nav_status === 'rejected') : echo ' class="active"'; endif ?>>
							<a href="<?php echo $base_url ?>admin/ml/proposal/list?status=rejected">却下済み</a>
						</li>
					</ul>
				</nav>
				<a href="<?php echo $base_url ?>">ユーザー側サイトを見る</a>
			</div>
		</div>
	</header>
	<?php echo $content    // <section>~</section> が入る?>
</div>
<footer id="footer">
	<div class="container-fluid">
		<a class="pull-right" href="">ページトップへ</a>
		<p>Copyright © MilmSearch All Rights Reserved.</p>
	</div>
</footer>


<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="<?php echo $base_url ?>assets/admin/js/bootstrap.min.js"></script>
</body>
</html>
