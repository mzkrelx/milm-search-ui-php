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