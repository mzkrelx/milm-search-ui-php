<?php
/**
 * The default api settings.
 */

return array(

	/**
	 * ML登録申請のパラメータ
	 */
	'_mlp' => array(

		/**
		 * ML登録申請の絞り込み項目
		 */
		'filter_by' => array(
			'status' => 'status',
		),

		/**
		 * ML登録申請の並べ替え項目
		 */
		'sort_by' => array(
			'ml_title'     => 'mlTitle',
			'status'       => 'status',
			'archive_type' => 'archiveType',
			'created_at'   => 'createdAt',
			'updated_at'   => 'updatedAt',
		),

		/**
		 * ML登録申請のステータス値
		 */
		'status' => array(
			'new'      => 'new',
			'accepted' => 'accepted',
			'rejected' => 'rejected',
		),
	),

	/**
	 * MLアーカイブタイプの種類
	 */
	'_ml_archive_type' => array(
		'mailman'       => 'mailman',
		'mailman_label' => 'Mailman',
		'other'         => 'other',
		'other_label'   => 'その他',
	),

	/**
	 * クエリStringのパラメータ名
	 */
	'_query' => array(
		'filter_by'    => 'filterBy',
		'filter_value' => 'filterValue',
		'count'        => 'count',
		'start_page'   => 'startPage',
		'sort_by'      => 'sortBy',
		'sort_order'   => 'sortOrder',
	),

	/**
	 * 並び順指定
	 */
	'_sort_order' => array(
		'asc'  => 'ascending',
		'desc' => 'descending',
	),

	/**
	 * APIの検索結果の項目名
	 */
	'_result_key' => array(
		'total_results'  => 'total_results',
		'start_index'    => 'start_index',
		'items_per_page' => 'items_per_page',
		'items'          => 'items',
	),

);
