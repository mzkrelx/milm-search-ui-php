<section>
	<header class="page-header">
		<h1><?php echo $proposal['mlTitle']?></h1>
	</header>
	<table class="table table-bordered">
	<tbody>
		<tr>
			<th class="text-info tune_table-staccepted"><strong>承認済み</strong></th>
			<td>申請日：<?php echo $proposal['createdAt']?>　承認日：TODO<?php // TODO ?></td>
		</tr>
		<tr>
			<th class="tune_th-250 tune_th-head">管理者コメント</th>
			<td><a class="editor " href="javascript:void(0)">管理者コメントはまだ編集できません。</a><i class="icon-pencil"></i></td>
		</tr>
	</tbody>
	</table>
	<section>
		<header class="clearfix">
			<h2 class="pull-left">メーリングリスト情報</h2>
			<a class="btn btn-primary pull-right tune_btn-mledit" href="<?php echo $base_url ?>admin/ml/proposal/edit/<?php echo $proposal_id ?>">変更する</a>
		</header>
		<table class="table table-bordered">
		<tbody>
		<tr>
			<th class="tune_th-250 tune_th-head">MLタイトル</th>
			<td><?php echo $proposal['mlTitle']?><i class="tune_icon-ok pull-right"></i></td>
		</tr>
		<tr>
			<th class="tune_th-250 tune_th-head">公開アーカイブURL</th>
			<td><a href="<?php echo $proposal['archiveUrl'] ?>"><?php echo $proposal['archiveUrl'] ?></a><i class="tune_icon-ok pull-right"></i></td>
		</tr>
		<tr>
			<th class="tune_th-250 tune_th-head">アーカイブソフトタイプ</th>
			<td><?php echo $proposal['archiveType'] ?><i class="tune_icon-ok pull-right"></i></td>
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
			<td><?php echo $proposal['proposerName'] ?></td>
		</tr>
		<tr>
			<th class="tune_th-250 tune_th-head">連絡先メールアドレス</th>
			<td><?php echo $proposal['proposerEmail'] ?></td>
		</tr>
		<tr>
			<th class="tune_th-250 tune_th-head">申請時コメント</th>
			<td><?php echo $proposal['comment'] ?></td>
		</tr>
		</tbody>
		</table>
	</section>
	<a class="btn" href="<?php echo $base_url ?>admin/ml/proposal/list/accepted">一覧へ戻る</a>
</section>