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
			<th><span class="text-error">【必須】</span>お名前（ニックネーム可）</th>
			<td><input type="text" value=""></td>
		</tr>
		<tr>
			<th><span class="text-error">【必須】</span>連絡先メールアドレス</th>
			<td>
				<input type="email" value=""><br>
				確認のため、再度ご入力ください。<br>
				<input type="email" value="">
			</td>
		</tr>
		<tr>
			<th><span class="text-error">【必須】</span>メーリングリストのタイトル</th>
			<td><input type="text" value=""></td>
		</tr>
		<tr>
			<td><span class="text-error">【必須】</span>メーリングリストのアーカイブソフトタイプ</td>
			<td>
				<select>
					<option value="選択してください">選択してください</option>
					<option value="Mailman">Mailman</option>
					<option value="その他">その他</option>
					<option value="不明">不明</option>
				</select>
				<p><small>
					「その他」のソフトをご利用の方は、コメント欄にソフト名をご記入ください。<br>
					今後の参考にさせていただきます。
				</small></p>
			</td>
		</tr>
		<tr>
			<th><span class="text-error">【必須】</span>メーリングリスト公開アーカイブのURL</th>
			<td><input type="url" value="http://"></td>
		</tr>
		<tr>
			<th>ご質問やコメントをどうぞ</th>
			<td><textarea></textarea></td>
		</tr>
		</tbody>
		</table>
		<div class="row-fluid">
			<div class="span12">
			<label><input type="checkbox">利用規約に同意する</label>
			<a href="<?php echo $base_url ?>top/rules">利用規約</a>
			</div>
		</div>
		<div class="clearfix">
			<a class="btn btn-large pull-left" href="<?php echo $base_url ?>">トップページへ</a>
			<input class="btn btn-large btn-primary pull-right" type="submit" value="確認する">
		</div>
	</form>

</section>