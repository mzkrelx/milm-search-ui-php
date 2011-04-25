/**
 * 並べ替え検索をします。
 * 
 * @param switcher selectタグのオブジェクト
 */
function sort(switcher) {
    document.getElementById("query").value = document.getElementById("query").value;
    document.getElementById("sortValue").value = switcher.value;
    document.getElementById("kensaku").submit();
}

/**
 * 順序リストの開始番号を設定します。
 * 
 * @param 開始番号
 */
function resetCounter(startCount) {
	document.getElementById("mailList").style.counterReset = "olcount " + startCount;
}

/** ロードしたメールのID */
var showId;

/**
 * AJAXでメール本文の全文を取得します。
 * 
 * @param mailSubject 表示するメールの件名
 * @param scoreDoc メールを検索するためのポインタ
 */
function loadMailText(mailSubject, scoreDoc) {
	showId = scoreDoc;
    MailLoader.loadText(scoreDoc, showMailText);
    $(".mailContent").colorbox(
    	{
    	    width:  "750px",
    	    height: "500px",
    	    inline: true,
    	    href:   "#inline_" + showId,
    	    title:  htmlEscape(mailSubject)
    	}
    );
}

/**
 * カラーボックスで表示するための文書を設定します。 
 * MailLoader.loadMailText の戻り値が引数になって呼ばれるコールバック関数 
 *  
 * @param mailText メール本文の全文
 */
function showMailText(mailText) {
	document.getElementById("showTarget_" + showId).innerHTML = mailText;
}

/**
 * 文字列をHTMLエスケープします。
 * 
 * @param str 文字列
 * @returns HTMLエスケープした文字列
 */
function htmlEscape(str) {
	var map = {"<":"&lt;", ">":"&gt;", "&":"&amp;", "'":"&#39;", "\"":"&quot;", " ":"&nbsp;"};
    var replaceStrFunc = function(s){ return map[s]; };
	return str.replace(/<|>|&|'|"|\s/g, replaceStrFunc);
}