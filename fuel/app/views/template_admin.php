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
<div class="container">
	<div class="navbar">
		<div class="navbar-inner">
			<a class="brand" href="<?php echo $base_url ?>admin"><img src="<?php echo $base_url ?>assets/admin/img/logo_admin.png" alt="MilmSearch admin" title="MilmSearch admin"></a>
			<ul class="nav">
					<li<?php if (isset($nav_status) AND $nav_status === 'new'): echo ' class="active"'; endif ?>>
						<a href="<?php echo $base_url ?>admin/ml/proposal/list/new">審査待ち</a>
					</li>
					<li<?php if (isset($nav_status) AND $nav_status === 'accepted'): echo ' class="active"'; endif ?>>
						<a href="<?php echo $base_url ?>admin/ml/proposal/list/accepted">承認済み</a>
					</li>
					<li<?php if (isset($nav_status) AND $nav_status === 'rejected'): echo ' class="active"'; endif ?>>
						<a href="<?php echo $base_url ?>admin/ml/proposal/list/rejected">却下済み</a>
					</li>
				<a class="btn tune_btn-user" href="<?php echo $base_url ?>">ユーザー側サイト</a>
			</ul>
		</div>
	</div>
	<?php echo $content    // <section>~</section> が入る?>
</div>
<footer id="footer">
	<div class="container">
		<a class="pull-right" href="">ページトップへ</a>
		<p>Copyright © MilmSearch All Rights Reserved.</p>
	</div>
</footer>


<script src="<?php echo $base_url ?>assets/admin/js/jquery-latest.js"></script>
<script src="<?php echo $base_url ?>assets/admin/js/bootstrap.min.js"></script>
</body>
</html>
