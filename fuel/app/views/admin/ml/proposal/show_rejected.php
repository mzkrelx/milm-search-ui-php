<section>
	<header class="page-header">
		<h1><?php echo $proposal['ml_title']?></h1>
	</header>
	<table class="table table-bordered">
	<tbody>
		<tr>
			<th class="text-warning tune_table-strejected"><strong>却下済み</strong></th>
			<td>申請日：<?php echo $proposal['created_at']?>　却下日：TODO<?php // TODO ?></td>
		</tr>
		<tr>
			<th class="tune_th-250 tune_th-head">管理者コメント</th>
			<td><a class="editor " href="javascript:void(0)">管理者コメントはまだ編集できません。</a><i class="icon-pencil"></i></td>
		</tr>
	</tbody>
	</table>
	<section>
		<header>
			<h2>メーリングリスト情報</h2>
		</header>
		<table class="table table-bordered">
		<tbody>
		<tr>
			<th class="tune_th-250 tune_th-head">MLタイトル</th>
			<td><?php echo $proposal['ml_title']?><i class="tune_icon-ok pull-right"></i></td>
		</tr>
		<tr>
			<th class="tune_th-250 tune_th-head">公開アーカイブURL</th>
			<td><a href="<?php echo $proposal['archive_u_r_l'] ?>"><?php echo $proposal['archive_u_r_l'] ?></a><i class="tune_icon-ok pull-right"></i></td>
		</tr>
		<tr>
			<th class="tune_th-250 tune_th-head">アーカイブソフトタイプ</th>
			<td><?php echo $proposal['archive_type'] ?><i class="tune_icon-ok pull-right"></i></td>
		</tr>
		</tbody>
		</table>
	</section>
	<section>
		<header>
			<h2>申請者情報</h2>
		</header>
		<table class="table table-bordered">
		<tbody>
		<tr>
			<th class="tune_th-250 tune_th-head">申請者名</th>
			<td><?php echo $proposal['proposer_name'] ?></td>
		</tr>
		<tr>
			<th class="tune_th-250 tune_th-head">連絡先メールアドレス</th>
			<td><?php echo $proposal['proposer_email'] ?></td>
		</tr>
		<tr>
			<th class="tune_th-250 tune_th-head">申請時コメント</th>
			<td><?php echo $proposal['comment'] ?></td>
		</tr>
		</tbody>
		</table>
	</section>
	<a class="btn" href="<?php echo $base_url ?>admin/ml/proposal/list/rejected">一覧へ戻る</a>
</section>
