<section>
	<header class="page-header">
		<h1>メーリングリスト情報の変更</h1>
	</header>
	<form action="<?php echo $base_url ?>admin/ml/proposal/edit/<?php echo $proposal_id ?>" method="post">
		<table class="table table-bordered">
		<tbody>
		<tr>
			<th class="tune_th-250 tune_th-head">MLタイトル</th>
			<td><input type="text" name="ml_title" value="<?php echo $proposal['ml_title']?>"></td>
		</tr>
		<tr>
			<th class="tune_th-250 tune_th-head">公開アーカイブURL</th>
			<td><input type="url" name="archive_url" value="<?php echo $proposal['archive_url']?>"></td>
		</tr>
		<tr>
			<th class="tune_th-250 tune_th-head">アーカイブソフトタイプ</th>
			<td>
				<select name="archive_type">
				<?php foreach ($archive_type_options as $id => $label) : ?>
					<option value="<?php echo $id ?>"><?php echo $label ?></option>
				<?php endforeach ?>
				</select>
				<p><small>「その他」の場合、ソフト名等の注記はML詳細画面から管理者コメントに追記してください。</small></p>
			</td>
		</tr>
		</tbody>
		</table>
		<div class="tune_decide">
			<a class="btn btn-large tune_btn-decide" href="<?php echo $base_url ?>admin/ml/proposal/show/<?php echo $proposal_id ?>">戻る</a>
			<input class="btn btn-large btn-primary tune_btn-decide" type="submit" value="変更する">
		</div>
	</form>
</section>
