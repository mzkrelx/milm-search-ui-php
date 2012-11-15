<section>
	<header class="page-header">
		<h1><?php echo $proposal['mlTitle']?></h1>
	</header>
	<table class="table table-bordered">
	<tbody>
		<tr>
			<th class="text-success"><strong>承認済み</strong></th>
			<td>申請日：<?php echo $proposal['createdAt']?>　承認日：TODO<?php // TODO ?></td>
		</tr>
		<tr>
			<th>管理者コメント</th>
			<td>管理者コメントはまだ編集できません。<a class="btn btn-small" href=""><i class="icon-pencil"></i></a></td>
		</tr>
	</tbody>
	</table>
	<section>
		<header>
			<h2 class="pull-left">メーリングリスト情報</h2>
			<a class="btn btn-primary pull-right" href="<?php echo $base_url ?>admin/ml/proposal/edit/<?php echo $proposal_id ?>">変更する</a>
		</header>
		<table class="table table-bordered">
		<tbody>
		<tr>
			<th>MLタイトル</th>
			<td><?php echo $proposal['mlTitle']?><i class="icon-ok-circle pull-right"></i></td>
		</tr>
		<tr>
			<th>公開アーカイブURL</th>
			<td><a href="<?php echo $proposal['archiveUrl'] ?>"><?php echo $proposal['archiveUrl'] ?></a><i class="icon-ok-circle pull-right"></i></td>
		</tr>
		<tr>
			<th>アーカイブソフトタイプ</th>
			<td><?php echo $proposal['archiveType'] ?><i class="icon-ok-circle pull-right"></i></td>
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
			<th>申請者名</th>
			<td><?php echo $proposal['proposerName'] ?></td>
		</tr>
		<tr>
			<th>連絡先メールアドレス</th>
			<td><?php echo $proposal['proposerEmail'] ?></td>
		</tr>
		<tr>
			<th>申請時コメント</th>
			<td><?php echo $proposal['comment'] ?></td>
		</tr>
		</tbody>
		</table>
	</section>
	<a class="btn" href="<?php echo $base_url ?>admin/ml/proposal/list/accepted">一覧へ戻る</a>
</section>