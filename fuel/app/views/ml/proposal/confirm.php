<section>
	<header class="page-header">
		<h1>メーリングリストの登録申請</h1>
	</header>
	<p>
		以下の内容でよろしいですか？<br>
		問題なければ、「申請する」ボタンを押して登録申請は完了です。
	</p>
	<table class="table table-bordered">
		<tbody>
		<tr>
			<th>申請者のお名前</th>
			<td>みるむ太郎</td><?php // TODO ?>
		</tr>
		<tr>
			<th>連絡先メールアドレス</th>
			<td>sample@example.com</td><?php // TODO ?>
		</tr>
		<tr>
			<th>メーリングリストのタイトル</th>
			<td>MilmSearch開発メーリングリスト</td><?php // TODO ?>
		</tr>
		<tr>
			<th>メーリングリストのアーカイブソフトタイプ</th>
			<td>Mailman</td><?php // TODO ?>
		</tr>
		<tr>
			<th>メーリングリスト公開アーカイブのURL</th>
			<td>http://aaa.com/archive.html</td><?php // TODO ?>
		</tr>
		<tr>
			<th>ご質問やコメントをどうぞ</th>
			<td>よろしくお願いします！</td><?php // TODO ?>
		</tr>
		</tbody>
	</table>

	<div class="clearfix">
		<form action="<?php echo $base_url ?>ml/proposal/complete" method="post">
			<input type="submit" class="btn btn-large pull-left" name="modify" value="修正する" />
			<input type="submit" class="btn btn-large pull-right btn-primary" value="申請する" />
			<input type="hidden" value="" />	<?php // TODO hidden ?>
		</form>
	</div>
</section>
