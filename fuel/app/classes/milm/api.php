<?php
namespace Milm;

class Api
{
	/**
	 * クエリStringのパラメータ名
	 */
	const QUERY_FILTER_BY    = 'filterBy';
	const QUERY_FILTER_VALUE = 'filterValue';
	const QUERY_SORT_BY      = 'sortBy';
	const QUERY_SORT_ORDER   = 'sortOrder';
	const QUERY_COUNT        = 'count';
	const QUERY_START_PAGE   = 'startPage';

	/**
	 * 並び順指定
	 */
	const SORT_ORDER_ASC  = 'ascending';
	const SORT_ORDER_DESC = 'descending';

	/**
	 * APIの検索結果の項目名
	 */
	const RESULT_TOTAL_RESULTS  = "totalResults";
	const RESULT_START_INDEX    = "startIndex";
	const RESULT_ITEMS_PER_PAGE = "itemsPerPage";
}