<?php
/**
 * MilmSearch UI-PHP is a part of mailing list searching system,
 * user interface on the WEB.
 *
 * Copyright (C) 2013 MilmSearch Project.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public
 * License along with this program.
 * If not, see <http://www.gnu.org/licenses/>.
 *
 * You can contact MilmSearch Project at mailing list
 * milm-search-public@lists.sourceforge.jp.
 *
 * @package    Milm
 * @version    0.1
 * @author     MilmSearch Project
 * @license    GPLv3 or later License
 * @copyright  Copyright (C) 2013 MilmSearch Project
 */
use Milm\Unicode;
use Milm\Api_UnexpectedStatusException;
use Milm\Http_Client;
use Milm\Http_Utils;
use Milm\Email_Admin;
use Milm\Email_EmailException;

use Fuel\Core\HttpServerErrorException;

/**
 * ML登録申請に関するロジッククラスです。
 */
class Model_Ml_Proposal
{
	/**
	 * ML登録申請情報のリストを取得します。
	 *
	 * @param  array $cond 取得条件。キー=Config::get('_result_key.xxxx')、値=キー項目の値
	 * @return array APIに準じて取得結果の配列が返ります。
	 */
	public static function find_list($cond)
	{
		return Http_Client::get_array(
			Config::get('_api_root_url').'/'.
			Config::get('_ml_proposals').Http_Utils::make_query_string($cond)
		);
	}

	/**
	 * ML登録新生情報を1件取得します。
	 *
	 * @param  int $id
	 * @return array
	 */
	public static function find_by_id($id)
	{
		return Http_Client::get_array(
			Config::get('_api_root_url').'/'.
			Config::get('_ml_proposals').'/'.$id);
	}

	/**
	 * ML登録申請します。
	 *
	 * @param  array $data 申請情報
	 * @return void
	 * @throws Api_Unexpectedstatusexception
	 */
	public static function propose($data)
	{
		$proposal = array(
			Config::get('_mlp.cols.proposer_name')    => $data['proposer_name'],
			Config::get('_mlp.cols.proposer_email')   => $data['proposer_email'],
			Config::get('_mlp.cols.ml_title')         => $data['ml_title'],
			Config::get('_mlp.cols.status')           => Config::get('_mlp.status.new'),
			Config::get('_mlp.cols.archive_type')     => $data['archive_type'],
			Config::get('_mlp.cols.archive_u_r_l')    => $data['archive_u_r_l'],
			Config::get('_mlp.cols.comment')          => $data['comment'],
		);

		Log::info("New ML Proposal!\n".array_to_string($proposal));

		Email_Admin::new_ml_proposal($data);

		$response = Http_Client::post_json(
			Config::get('_api_root_url').'/'.
			Config::get('_ml_proposals'),
			$proposal
		);

		if ($response->getStatus() != 201) {
			throw new Api_Unexpectedstatusexception(
				'ML登録申請情報登録時にAPIが予期せぬHTTPステータスを返しました。:'.$response->getBody()
			);
		}

		Log::info('Status: '.$response->getStatus().
			', Body: '.Unicode::decode($response->getBody()), __METHOD__
		);
	}

	/**
	 * 申請情報を更新します。
	 *
	 * @param  int $id
	 * @param  int $data
	 * @return void
	 */
	public static function update($id, $data)
	{
		Log::info("Update ML Proposal! id=[{$id}]\n".array_to_string($data));

		Http_Client::put_json(
			Config::get('_api_root_url').'/'.
			Config::get('_ml_proposals').'/'.$id,
			$data);
	}

	/**
	 * 申請を承認します。
	 *
	 * @param  int $id
	 * @return void
	 */
	public static function accept($id)
	{
		Http_Client::post(
			Config::get('_api_root_url').'/'.
			Config::get('_ml_proposals').'/'.$id.
			'?accept=true');

		self::send_accept_mail($id);
	}

	/**
	 * ML登録申請者に登録完了通知のメールを送ります。
	 *
	 * @param  int $id
	 * @throws Email_EmailException
	 * @throws EmailException
	 */
	public static function send_accept_mail($id)
	{
		$email = Email::forge();
		$email->from(
			Config::get('_system.email'),
			Config::get('_system.name')
		);
		$email->subject(Config::get('_mail_accepted_subject'));

		$proposal = self::find_by_id($id);
		$email->to($proposal['proposer_email']);
		$email->body(self::get_accept_mail_text($proposal));

		try
		{
			$email->send();
		}
		catch(EmailValidationFailedException $e)
		{
			throw new Email_EmailException($e->getMessage());
		}
		catch(EmailSendingFailedException $e)
		{
			throw new Email_EmailException($e->getMessage());
		}
	}

	/**
	 * ML登録完了通知のメール本文を取得します。
	 *
	 * @param  array $proposal ML登録申請情報
	 * @return string メール本文
	 */
	public static function get_accept_mail_text($proposal)
	{
		$mail_text_template = Config::get('_mail_accepted_text');

		$mail_text = str_replace('__proposer_name__', $proposal['proposer_name'],   $mail_text_template);
		$mail_text = str_replace('__ml_title__',      $proposal['ml_title'],        $mail_text);
		$mail_text = str_replace('__archive_url__',   $proposal['archive_u_r_l'],   $mail_text);
		$mail_text = str_replace('__base_url__',      Config::get('base_url'),      $mail_text);

		return $mail_text;
	}

	/**
	 * 申請を却下します。
	 *
	 * @param  int $id
	 * @return void
	 */
	public static function reject($id)
	{
		Http_Client::post(
			Config::get('_api_root_url').'/'.
			Config::get('_ml_proposals').'/'.$id.
			'?accept=false');

		self::send_reject_mail($id);
	}

	/**
	 * ML登録申請者に登録却下通知のメールを送ります。
	 *
	 * @param  int $id
	 * @throws Email_EmailException
	 * @throws EmailException
	 */
	public static function send_reject_mail($id)
	{
		$email = Email::forge();
		$email->from(
				Config::get('_system.email'),
				Config::get('_system.name')
		);
		$email->subject(Config::get('_mail_rejected_subject'));

		$proposal = self::find_by_id($id);
		$email->to($proposal['proposer_email']);
		$email->body(self::get_reject_mail_text($proposal));

		try
		{
			$email->send();
		}
		catch(EmailValidationFailedException $e)
		{
			throw new Email_EmailException($e->getMessage());
		}
		catch(EmailSendingFailedException $e)
		{
			throw new Email_EmailException($e->getMessage());
		}
	}

	/**
	 * ML登録却下通知のメール本文を取得します。
	 *
	 * @param  array $proposal ML登録申請情報
	 * @return string メール本文
	 */
	public static function get_reject_mail_text($proposal)
	{
		$mail_text_template = Config::get('_mail_rejected_text');

		$mail_text = str_replace('__proposer_name__', $proposal['proposer_name'],   $mail_text_template);
		$mail_text = str_replace('__ml_title__',      $proposal['ml_title'],        $mail_text);
		$mail_text = str_replace('__archive_url__',   $proposal['archive_u_r_l'],   $mail_text);
		$mail_text = str_replace('__base_url__',      Config::get('base_url'),      $mail_text);

		return $mail_text;
	}
}