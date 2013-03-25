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
			\Config::get('_system.email'),
			\Config::get('_system.name')
		);
		$email->to(\Config::get('_admin.email'), \Config::get('_admin.name'));
		$email->subject('[MilmSearch] ML登録申請が届きました');

		$email->body(
			"新しいML登録申請です。\n".
			"\n".
			"【メーリングリスト情報】\n".
			"・公開アーカイブURL：".$proposal['archive_u_r_l']."\n".
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