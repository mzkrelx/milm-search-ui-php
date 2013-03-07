<?php
namespace Milm;

class Email_Admin
{
	/**
	 * ML登録申請をメール通知します。
	 *
	 * @param  array $proposal 申請されたML登録申請情報
	 * @return void
	 */
	public static function new_ml_proposal($proposal)
	{
		$email = \Email::forge();
		$email->from(
			\Config::get('_webmaster_email'),
			\Config::get('_webmaster_name')
		);
		$email->to(\Config::get('_admin_mail_email'), \Config::get('_admin_mail_name'));
		$email->subject('[MilmSearch] ML登録申請が届きました');

		$email->body(
			"新しいML登録申請です。\n".
			"\n".
			"【メーリングリスト情報】\n".
			"・公開アーカイブURL：".$proposal['archive_url']."\n".
			"・アーカイブソフトタイプ：".$proposal['archive_type']."\n".
			"・MLタイトル：".$proposal['ml_title']."\n".
			"\n".
			"【申請者情報】\n".
			"・申請者名:".$proposal['proposer_name']."\n".
			"・連絡先メールアドレス:".$proposal['proposer_email']."\n".
			"・申請時コメント:".$proposal['comment']."\n"
		);

		try
		{
			$email->send();
		}
		catch(\EmailValidationFailedException $e)
		{
			throw new Email_EmailException($e->getMessage());
		}
		catch(\EmailSendingFailedException $e)
		{
			throw new EmailException($e->getMessage());
		}
	}
}