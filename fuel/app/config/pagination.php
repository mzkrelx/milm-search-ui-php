<?php
// ページネーションの初期値テンプレート。
return array(
//     'pagination_url' => ロード後に手動設定してください。,
	'uri_segment'    => 3,
	'num_links'      => 5,
	'per_page'       => 20,
	//    'total_items'    => ロード後に手動設定してください。,
	'template'       => array(
		'wrapper_start'           => "<nav class=\"pagination\"><ul>\n",
		'wrapper_end'             => "</ul></nav>\n",
		'page_start'              => '',
		'page_end'                => '',
		'previous_start'          => '<li class="previous">',
		'previous_end'            => '</li>',
		'previous_inactive_start' => '<li class="disabled"><a href="">',
		'previous_inactive_end'   => '</a></li>',
		'previous_mark'           => '',
		'next_start'              => '<li class="next">',
		'next_end'                => '</li>',
		'next_inactive_start'     => '<li class="disabled"><a href="">',
		'next_inactive_end'       => '</a></li>',
		'next_mark'               => '',
		'active_start'            => '<li class="active"><a href="">',
		'active_end'              => '</a></li>',
		'regular_start'           => '<li>',
		'regular_end'             => '</li>',
	)
);