<div class="mainArea">
	<div class="container">
		<section>
		<header class="page-header">
			<h1>登録メーリングリスト一覧</h1>
		</header>
		<div class="row">
			<div class="span2 tune_pagetotal"><?php echo $per_page ?>/<?php echo $total_items ?>件</div>
			<div class="span10"><?php echo Pagination::create_links() ?></div>
		</div>
		<table class="table table-bordered">
		<tbody>
		<?php foreach ($mls as $ml) : ?>
			<tr>
				<td>
					<h5><a href="<?php echo $ml['archive_u_r_l'] ?>"><?php echo $ml['title'] ?></a></h5>
					<a href="<?php echo $ml['archive_u_r_l'] ?>"><?php echo $ml['archive_u_r_l'] ?></a>
				</td>
				<td class="tune_table_date"><?php echo ($ml['last_mailed_at'] === null) ? '更新なし' : $ml['last_mailed_at'].'更新' ?></td>
			</tr>
		<?php endforeach ?>
		</tbody>
		</table>
		<div class="row">
			<div class="span2 tune_pagetotal"><?php echo $per_page ?>/<?php echo $total_items ?>件</div>
			<div class="span10"><?php echo Pagination::create_links() ?></div>
		</div>
	</section>
