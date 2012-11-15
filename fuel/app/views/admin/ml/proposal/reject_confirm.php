<section>
	<header class="page-header">
		<h1><?php echo $proposal['mlTitle'] ?></h1>
	</header>
	<p>このMLを登録申請を却下し、申請者に下記のご案内メールを送信します。</p>
	<h2>ご案内メール</h2>
	<p>
		登録申請却下のご案内メール本文が入ります<br>
		登録申請却下のご案内メール本文が入ります<br>
		登録申請却下のご案内メール本文が入ります<br>
		登録申請却下のご案内メール本文が入ります<br>
		登録申請却下のご案内メール本文が入ります
	</p>
	<p><strong>このMLの登録申請を却下してよろしいですか？</strong></p>
	<div class="clearfix">
		<a class="btn btn-large pull-left" href="<?php echo $base_url ?>admin/ml/proposal/show/<?php echo $proposal_id ?>">ML詳細画面に戻る</a>
		<form action="<?php echo $base_url ?>admin/ml/proposal/reject" method="post">
			<input type="hidden" name="id" value="<?php echo $proposal_id ?>">
			<input type="submit" class="btn btn-large btn-primary pull-right" value="この申請を却下する">
		</form>
	</div>
</section>
