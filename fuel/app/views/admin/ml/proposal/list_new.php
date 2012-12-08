<section>
	<header class="page-header">
		<h1>審査待ちML一覧</h1>
	</header>
	<div class="row">
		<div class="span2 tune_pagetotal"><?php echo $per_page ?>/<?php echo $total_items ?>件</div>
		<div class="span10"><?php echo Pagination::create_links() ?></div>
	</div>
	<table class="table table-bordered">
	<thead>
		<tr>
			<th class="tune_table_date">申請日</th>
			<th>MLタイトル</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($ml_proposals as $ml_proposal): ?>
		<tr>
			<td class="tune_table_date"><?php echo $ml_proposal['createdAt'] ?></td>
			<td><a href="<?php echo $base_url ?>admin/ml/proposal/show/<?php echo $ml_proposal['id'] ?>"><?php echo $ml_proposal['mlTitle'] ?></a></td>
		</tr>
	<?php endforeach ?>
	</tbody>
	</table>
	<div class="row">
		<div class="span2 tune_pagetotal"><?php echo $per_page ?>/<?php echo $total_items ?>件</div>
		<div class="span10"><?php echo Pagination::create_links() ?></div>
	</div>
</section>
