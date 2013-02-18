<div class="mainArea">
	<div class="container">
		<section>
		<header class="page-header">
			<h1>メーリングリストの登録申請</h1>
		</header>
		登録フローイメージが入ります
		<nav>
		<p class="pull-right">
			<small>メーリングリスト登録は注意点について詳しくは…</small>
			<a class="btn btn-primary" href="<?php echo $base_url ?>top/help">ヘルプ</a>
		</p>
		</nav>
	
		<form action="<?php echo $base_url ?>ml/proposal/confirm" method="post">
			<table class="table table-bordered">
			<tbody>
			<tr>
				<th class="tune_th-250 tune_th-head"><span class="text-error">【必須】</span>お名前（ニックネーム可）</th>
				<td><input type="text" name="proposer_name" value="<?php echo array_get_or($inputs, 'proposer_name') ?>"><?php if (isset($errors['proposer_name'])): ?><span class="text-error">　※<?php echo $errors['proposer_name'] ?></span><?php endif ?></td>
			</tr>
			<tr>
				<th class="tune_th-250 tune_th-head"><span class="text-error">【必須】</span>連絡先メールアドレス</th>
				<td>
					<input type="email" name="proposer_email" value="<?php echo array_get_or($inputs, 'proposer_email') ?>"><?php if (isset($errors['proposer_email'])): ?><span class="text-error">　※<?php echo $errors['proposer_email'] ?></span><?php endif ?> <br />
					確認のため、再度ご入力ください。<br>
					<input type="email" name="proposer_email2" value="<?php echo array_get_or($inputs, 'proposer_email2') ?>"><?php if (isset($errors['proposer_email2'])): ?><span class="text-error">　※<?php echo $errors['proposer_email2'] ?></span><?php endif ?>
				</td>
			</tr>
			<tr>
				<th class="tune_th-250 tune_th-head"><span class="text-error">【必須】</span>メーリングリストのタイトル</th>
				<td><input type="text" name="ml_title" value="<?php echo array_get_or($inputs, 'ml_title') ?>"><?php if (isset($errors['ml_title'])): ?><span class="text-error">　※<?php echo $errors['ml_title'] ?></span><?php endif ?></td>
			</tr>
			<tr>
				<th class="tune_th-250 tune_th-head"><span class="text-error">【必須】</span>メーリングリストのアーカイブソフトタイプ</td>
				<td>
					<select name="archive_type">
						<option value="">選択してください</option>
						<option value="<?php echo Config::get('_ml_archive_type.mailman_label') ?>"<?php if (array_get_or($inputs, 'archive_type') === Config::get('_ml_archive_type.mailman_label')) echo ' selected'?>><?php echo Config::get('_ml_archive_type.mailman_label') ?></option>
						<option value="<?php echo Config::get('_ml_archive_type.other_label') ?>"<?php if (array_get_or($inputs, 'archive_type') === Config::get('_ml_archive_type.other_label')) echo ' selected'?>><?php echo Config::get('_ml_archive_type.other_label') ?></option>
						<option value="不明"<?php if (array_get_or($inputs, 'archive_type') === '不明') echo ' selected'?>>不明</option>
					</select>
					<?php if (isset($errors['archive_type'])): ?><span class="text-error">　※<?php echo $errors['archive_type'] ?></span><?php endif ?>
					<p><small>
						「その他」のソフトをご利用の方は、コメント欄にソフト名をご記入ください。<br>
						今後の参考にさせていただきます。
					</small></p>
				</td>
			</tr>
			<tr>
				<th class="tune_th-250 tune_th-head"><span class="text-error">【必須】</span>メーリングリスト公開アーカイブのURL</th>
				<td><input type="url" name="archive_url" value="<?php echo array_get_or($inputs, 'archive_url') ?>"><?php if (isset($errors['archive_url'])): ?><span class="text-error">　※<?php echo $errors['archive_url'] ?></span><?php endif ?></td>
			</tr>
			<tr>
				<th class="tune_th-250 tune_th-head">ご質問やコメントをどうぞ</th>
				<td><textarea name="comment"><?php echo array_get_or($inputs, 'comment') ?></textarea></td>
			</tr>
			</tbody>
			</table>
			<div class="check_rule">
				<label><input type="checkbox" name="agreement" value="on"<?php if (array_get_or($inputs, 'agreement') === 'on') echo ' checked'?>>利用規約に同意する</label><?php if (isset($errors['agreement'])): ?><span class="text-error">　※<?php echo $errors['agreement'] ?></span><?php endif ?>
				<a href="<?php echo $base_url ?>top/rules">利用規約</a>
			</div>

			<div class="tune_decide">
				<a class="btn btn-large tune_btn-decide" href="<?php echo $base_url ?>">トップページへ</a>
				<input class="btn btn-large btn-primary tune_btn-decide" type="submit" value="確認する">
			</div>
		</form>
	
	</section>