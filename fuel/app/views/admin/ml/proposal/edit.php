<section>
	<header class="page-header">
		<h1>メーリングリスト情報の変更</h1>
	</header>
	<form>
		<table class="table table-bordered">
		<tbody>
		<tr>
			<th>MLタイトル</th>
			<td><input type="text" value="MilmSearch開発するよ！ML"></td>
		</tr>
		<tr>
			<th>公開アーカイブURL</th>
			<td><input type="url" value="http://aaa.com/arcieve.html"></td>
		</tr>
		<tr>
			<th>アーカイブソフトタイプ</th>
			<td>
				<select>
					<option value="Mailman">Mailman</option>
					<option value="その他">その他</option>
				</select>
				<p><small>「その他」の場合、ソフト名等の注記はML詳細画面から管理者コメントに追記してください。</small></p>
			</td>
		</tr>
		</tbody>
		</table>
		<div class="clearfix">
			<a class="btn btn-large pull-left" href="<?php echo $base_url ?>admin/ml/proposal/show/10<?php // TODO id 可変?>">戻る</a>
			<input class="btn btn-large btn-primary pull-right" type="submit" value="変更する">
		</div>
	</form>
</section>
