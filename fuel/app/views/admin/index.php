<section>
	<h1>登録状況</h1>
	審査待ち：<?php echo $new_count ?>件
	承認済み：<?php echo $accepted_count ?>件
	承認却下：<?php echo $rejected_count ?>件
	<nav>
		<a href="<?php echo $base_url ?>admin/ml/proposal/list?status=new">審査待ちML一覧</a>
		<a href="<?php echo $base_url ?>admin/ml/proposal/list?status=accepted">承認済みML一覧</a>
		<a href="<?php echo $base_url ?>admin/ml/proposal/list?status=rejected">却下済みML一覧</a>
	</nav>
</section>
<section>
	<h1>審査待ちML</h1>
	<table class="table table-bordered">
	<thead>
		<tr>
			<th>申請日</th>
			<th>MLタイトル</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($new_ml_proposals as $ml_proposal): ?>
		<tr>
			<td><?php echo $ml_proposal['createdAt'] ?></td>
			<td><a href="<?php echo $base_url ?>admin/ml/proposal/show/<?php echo $ml_proposal['id'] ?>"><?php echo $ml_proposal['mlTitle'] ?></a></td>
	<?php endforeach ?>
	</tbody>
	</table>
<?php if ($is_more): ?>
	<nav>
		<a class="btn btn-primary pull-right" href="<?php echo $base_url ?>admin/ml/proposal/list?status=new">審査待ちML一覧</a>
	</nav>
<?php endif ?>
</section>