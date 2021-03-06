<?php
return array(

	'_mail_accepted_subject' => "【MilmSearch】MLご登録完了のお知らせ",

	/**
	 * ML登録申請承認時に申請者に送るメールの本文。
	 * __xxx__ のところは適宜代入されます。
	 *
	 * 使用可能変数は以下の通り。
	 * ・__proposer_name__ (ML登録申請者の名前)
	 * ・__ml_title__      (MLタイトル)
	 * ・__archive_url__   (MLアーカイブURL)
	 * ・__base_url__      (システムの基底URL)
	 */
	'_mail_accepted_text' =>
"[__proposer_name__] 様

このたびは、MilmSearch へメーリングリスト登録をお申し込みいただきまして
誠にありがとうございます。
審査の結果、下記の内容でメーリングリストを登録させていただきました。


━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
　● メーリングリスト登録情報
------------------------------------

　申請者のお名前　　　　：[__proposer_name__]
　メーリングリストタイトル：[__ml_title__]
　公開アーカイブURL　　：[__archive_url__]

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

★ご登録の内容に変更がある場合は…
現在、MilmSearch では会員機能を含め鋭意開発中です。
登録内容に変更がありましたら、お問い合わせフォームよりご連絡ください。

お問い合わせフォーム：
__base_url__/top/inquiry

★MilmSearch の使い方などについて、詳しくはこちら
ヘルプ：
__base_url__/top/help

***

MilmSearch ではメーリングリストのアーカイブ情報を取得し、
登録された様々な過去のメールを探すことができます。
ぜひご活用ください。

ご不明な点やご質問、ご要望等がございましたら、お気軽にお問い合わせください。
今後とも MilmSearch をよろしくお願いいたします。



━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

MilmSearch 運営チーム
http://milmsearch.org

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
",

	'_mail_rejected_subject' => "【MilmSearch】MLご登録に関するお知らせ",

	/**
	 * ML登録申請却下時に申請者に送るメールの本文。
	 * __xxx__ のところは適宜代入されます。
	 *
	 * 使用可能変数は以下の通り。
	 * ・__proposer_name__ (ML登録申請者の名前)
	 * ・__ml_title__      (MLタイトル)
	 * ・__archive_url__   (MLアーカイブURL)
	 * ・__base_url__      (システムの基底URL)
	 */
	'_mail_rejected_text' =>
	"[__proposer_name__] 様

このたびは、MilmSearch へメーリングリスト登録をお申し込みいただきまして
誠にありがとうございます。

審査の結果、大変遺憾ではございますが、
MilmSearchにて未対応のメーリングリストソフトをご利用のため、
登録を見送らせていただくこととなりました。

せっかくのお申し出に沿えず誠に恐縮ですが、
MilmSearchでは今後、対応ソフトを増やしていく所存でございますので、
バージョンアップした際にはぜひ、再度のお申し込みをご検討ください。

★メーリングリストの登録や対応ソフト等に関してはこちら
ヘルプ：
__base_url__/top/help

***

MilmSearch ではメーリングリストのアーカイブ情報を取得し、
登録された様々な過去のメールを探すことができます。
ぜひご活用ください。

ご不明な点やご質問、ご要望等がございましたら、お気軽にお問い合わせください。
今後とも MilmSearch をよろしくお願いいたします。



━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

MilmSearch 運営チーム
http://milmsearch.org

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
",
);