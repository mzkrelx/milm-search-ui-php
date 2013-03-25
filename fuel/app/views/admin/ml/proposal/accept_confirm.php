<section>
	<header class="page-header">
		<h1><?php echo $proposal['ml_title'] ?></h1>
	</header>
	<p>このMLを登録し、申請者に下記のご案内メールを送信します。</p>
	<h2>ご案内メール</h2>
	<div class="tune_mailtext">
		<pre><?php echo $mail_text ?></pre>
	</div>
	<p><strong>このMLの登録申請を承認してよろしいですか？</strong></p>
	<form action="<?php echo $base_url ?>admin/ml/proposal/accept" method="post">
		<div class="tune_stdecide">
			<a class="btn btn-large tune_btn-decide" href="<?php echo $base_url ?>admin/ml/proposal/show/<?php echo $proposal_id ?>">ML詳細画面に戻る</a>
			<input type="hidden" name="id" value="<?php echo $proposal_id ?>">
			<input type="submit" class="btn btn-large btn-primary tune_btn-decide" value="この内容で承認する">
		</div>
	</form>
</section>
