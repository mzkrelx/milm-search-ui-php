<div class="mainArea">
	<div class="container">
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
				<th class="tune_th-250 tune_th-head">申請者のお名前</th>
				<td><?php echo $proposer_name ?></td>
			</tr>
			<tr>
				<th class="tune_th-250 tune_th-head">連絡先メールアドレス</th>
				<td><?php echo $proposer_email ?></td>
			</tr>
			<tr>
				<th class="tune_th-250 tune_th-head">メーリングリストのタイトル</th>
				<td><?php echo $ml_title ?></td>
			</tr>
			<tr>
				<th class="tune_th-250 tune_th-head">メーリングリストのアーカイブソフトタイプ</th>
				<td><?php echo $archive_type ?></td>
			</tr>
			<tr>
				<th class="tune_th-250 tune_th-head">メーリングリスト公開アーカイブのURL</th>
				<td><?php echo $archive_url ?></td>
			</tr>
			<tr>
				<th class="tune_th-250 tune_th-head">ご質問やコメントをどうぞ</th>
				<td><?php echo $comment ?></td>
			</tr>
			</tbody>
		</table>
	
		<div class="tune_stdecide">
			<form class="desidebtn" action="<?php echo $base_url ?>ml/proposal/input" method="post">
				<input type="submit" class="btn btn-large tune_btn-decide" name="modify" value="修正する">
				<input type="hidden" name="proposer_name" value="<?php echo $proposer_name ?>">
				<input type="hidden" name="proposer_email" value="<?php echo $proposer_email ?>">
				<input type="hidden" name="proposer_email2" value="<?php echo $proposer_email2 ?>">
				<input type="hidden" name="ml_title" value="<?php echo $ml_title ?>">
				<input type="hidden" name="archive_type" value="<?php echo $archive_type ?>">
				<input type="hidden" name="archive_url" value="<?php echo $archive_url ?>">
				<input type="hidden" name="comment" value="<?php echo $comment ?>">
				<input type="hidden" name="agreement" value="<?php echo $agreement ?>">
			</form>
	
			<form class="desidebtn" action="<?php echo $base_url ?>ml/proposal/complete" method="post">
				<input type="submit" class="btn btn-large btn-primary tune_btn-decide" value="申請する">
				<input type="hidden" name="proposer_name" value="<?php echo $proposer_name ?>">
				<input type="hidden" name="proposer_email" value="<?php echo $proposer_email ?>">
				<input type="hidden" name="proposer_email2" value="<?php echo $proposer_email2 ?>">
				<input type="hidden" name="ml_title" value="<?php echo $ml_title ?>">
				<input type="hidden" name="archive_type" value="<?php echo $archive_type ?>">
				<input type="hidden" name="archive_url" value="<?php echo $archive_url ?>">
				<input type="hidden" name="comment" value="<?php echo $comment ?>">
				<input type="hidden" name="agreement" value="<?php echo $agreement ?>">
			</form>
		</div>
	</section>
