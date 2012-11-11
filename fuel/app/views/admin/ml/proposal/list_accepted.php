<section>
	<header class="page-header">
		<h1>承認済みML一覧</h1>
	</header>
	<p><?php echo $per_page ?>/<?php echo $total_items ?>件</p>
	<?php echo Pagination::create_links() ?>
	<table class="table table-bordered">
	<thead>
		<tr>
			<th>申請日</th>
			<th>承認日</th>
			<th>MLタイトル</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($ml_proposals as $ml_proposal): ?>
		<tr>
			<td><?php echo $ml_proposal['createdAt'] ?></td>
			<td>TODO 承認日<?php //TODO ?></td>
			<td><a href="<?php echo $base_url ?>admin/ml/proposal/show/<?php echo $ml_proposal['id'] ?>"><?php echo $ml_proposal['mlTitle'] ?></a></td>
		</tr>
	<?php endforeach ?>
	</tbody>
	</table>
	<p><?php echo $per_page ?>/<?php echo $total_items ?>件</p>
	<?php echo Pagination::create_links() ?>
</section>
