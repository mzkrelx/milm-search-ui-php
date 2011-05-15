<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    require_once '../application/SystemUtil.php';
    init();
    $view = new Zend_View();
    $http = new Zend_Controller_Request_Http();
    $basePath = $http->getBasePath();
    $query = $http->getParam("query", "");
    $sortValue = $http->getParam("sortValue", "DATE_R");
    $field = $http->getParam("field", "text");
    $pp = $http->getParam("pp", 20);
    $page = $http->getParam("page", 1);
    $mails = null;
    $totalMailCount = 0;
    $isError = false;
    if ($query !== "") :
        $enQuery = urlencode($query);
        $url = SERVER_URL . "?q={$enQuery}&field={$field}&sortValue={$sortValue}&pp={$pp}&page={$page}";
        try {
            $mails = new Zend_Feed_Atom($url);
            $totalMailCount = $mails->__get('totalResults')->__toString();
        } catch (Exception $e) {
            // TODO ログはく
            d($e->getMessage());    // TODO 後で消す
            $isError = true;
        }
        require_once '../application/Paginator.php';
        $paginator = new Paginator($page, $pp, 10, $totalMailCount);
    endif;
    $startCount = 0; // olの開始番号に使用する
    if (isset($pagenator)) :
        // onloadで1増やすので1減らしておく
        $startCount = $paginator->getCurrentItemCountStart() - 1;
    endif;

?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-script-type" content="text/jascript" />
    <meta http-equiv="content-style-type" content="text/css" />
    <title><?php echo $view->escape(SYSTEM_TITLE) ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $basePath ?>/css/common.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $basePath ?>/css/colorbox.css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $basePath ?>/js/jquery/colorbox-min.js"></script>
    <script type="text/javascript" src="<?php echo $basePath ?>/js/common.js"></script>
</head>

<body<?php echo ($mails != null) ? " onload=\"resetCounter({$startCount})\"" : '' ?>>

<!-- ヘッダーここから -->
<div id="header">
    <div id="title">
        <a href="<?php echo $basePath ?>/index.php"><?php echo $view->escape(SYSTEM_TITLE) ?></a>
    </div>

    <form id="kensaku" action="<?php echo $basePath ?>/index.php" method="get">
        <p>
            <input type="text" name="query" id ="query" value="<?php echo $view->escape($query) ?>" />
            <input type="submit" value="検索" />
            <input type="radio" name="field" value="text" <?php echo ('text' === $field) ? "checked=\"checked\"" : "" ?>/>メール本文
            <input type="radio" name="field" value="subject" <?php echo ('subject' === $field) ? "checked=\"checked\"" : "" ?>/>件名
            <input type="hidden" name="sortValue" id ="sortValue" value="DATE_R" />
        </p>
    </form>
    <hr />
</div>
<!-- ヘッダーここまで -->

<!-- コンテンツここから -->
<div id="content">
<?php if ($isError) : ?>
    <!-- エラー情報ここから -->
    <p>サーバーでエラーが発生したため、実行することができませんでした。<br />しばらく時間をおいてからもう一度アクセスして頂くか、管理者にお問い合わせください。<br />E-MAIL：densetubu@users.sourceforge.jp</p>
    <!-- エラー情報ここまで -->
<?php elseif ($mails == null) : ?>
    <!-- トップ画面ここから -->
    <div id="topImg">
        <img src="<?php echo $basePath ?>/img/top.gif" alt="温故知新" />
    </div>
    <!-- トップ画面ここまで -->
<?php elseif (count($mails) == 0) : ?>
    <p>「<?php echo $view->escape($query) ?>」 の検索結果 <?php echo $totalMailCount ?> 件</p>
<?php else : ?>
    <!-- メールリスト表示ここから -->
<?php
      $searchPath = $view->escape("{$basePath}/index.php?sortValue={$sortValue}&query={$query}&field={$field}&pp={$pp}&page=");
?>
<?php     if ($query !== '') : ?>
    <p>「<?php echo $view->escape($query) ?>」 の検索結果 <?php echo $totalMailCount ?> 件中<?php echo $paginator->getCurrentItemCountStart() ?> 件から<?php echo $paginator->getCurrentItemCountEnd() ?> 件表示</p>

    <p id="narabekae">並べ替え：
        <select name="sortValue" onchange="sort(this);">
            <option value="DATE_R" <?php echo ("DATE_R" === $sortValue) ? "selected=\"selected\"" : "" ?>>新しい順</option>
            <option value="DATE" <?php echo ("DATE" === $sortValue) ? "selected=\"selected\"" : "" ?>>古い順</option>
            <option value="FROM" <?php echo ("FROM" === $sortValue) ? "selected=\"selected\"" : "" ?>>差出人 昇順</option>
            <option value="FROM_R" <?php echo ("FROM_R" === $sortValue) ? "selected=\"selected\"" : "" ?>>差出人 降順</option>
            <option value="DEFAULT" <?php echo ("DEFAULT" === $sortValue) ? "selected=\"selected\"" : "" ?>>--指定なし--</option>
        </select>
    </p>
<?php     endif ?>
<?php     if ($paginator != null) : ?>
    <div class="pageNav upper">
        <ul>
<?php         if ($paginator->isPrePageExists()) : ?>
            <li>
                <a href="<?php echo $searchPath . ($paginator->getCurrentPageNum() - 1) ?>">前へ</a>
            </li>
<?php         endif ?>

<?php         foreach ($paginator->getPageNumsInRange() as $pageNum) : ?>
<?php             if ($pageNum == $paginator->getCurrentPageNum()) : ?>
            <li class="navNumber current">
                <span><?php echo $pageNum ?></span>
            </li>
<?php             else: ?>
            <li class="navNumber">
                <a href="<?php echo $searchPath . $pageNum ?>"><?php echo $pageNum ?></a>
            </li>
<?php             endif ?>
<?php         endforeach ?>

<?php         if ($paginator->isNextPageExists()) : ?>
            <li>
                <a href="<?php echo $searchPath . ($paginator->getCurrentPageNum() + 1); ?>">次へ</a>
            </li>
<?php         endif ?>
        </ul>
    </div>
<?php     endif ?>
    <ol id="mailList">
<?php     foreach ($mails as $mail) : ?>
        <li>
            <div class="mail">
                <div class="mailHead">
                    <div class="subject">
                        <a title="<?php echo $view->escape($mail->title()) ?>" href="<?php echo $view->escape($mail->link('alternate')) ?>"><?php echo $view->escape($mail->title()) // TODO ハイライト対応?></a>
                    </div>
                    <div class="sender">
                        <p><?php echo $view->escape($mail->author->name()) ?> &lt;<?php echo $view->escape($mail->author->email()) ?>&gt;</p>
                    </div>
                    <div class="date">
                        <p><?php echo new Zend_Date($mail->updated(), 'Y\-m\-d\TH\:i\:s\.SP', 'ja_JP') ?></p>
                    </div>
                    <hr />
                </div>
                <div class="mailContent">
                    <pre><?php echo $view->escape($mail->summary()) // TODO ハイライト対応 ?></pre>
                </div>
            </div>
            <div class="mailContentAll">
                <div id="inline_<?php echo $mail->id() ?>" class="inline">
                    <pre id="showTarget_<?php echo $mail->id() ?>"></pre>
                </div>
            </div>
        </li>
<?php     endforeach ?>
    </ol>
<?php     if ($paginator != null) : ?>
    <div class="pageNav upper">
        <ul>
<?php         if ($paginator->isPrePageExists()) : ?>
            <li>
                <a href="<?php echo $searchPath . ($paginator->getCurrentPageNum() - 1) ?>">前へ</a>
            </li>
<?php         endif ?>

<?php         foreach ($paginator->getPageNumsInRange() as $pageNum) : ?>
<?php             if ($pageNum == $paginator->getCurrentPageNum()) : ?>
            <li class="navNumber current">
                <span><?php echo $pageNum ?></span>
            </li>
<?php             else: ?>
            <li class="navNumber">
                <a href="<?php echo $searchPath . $pageNum ?>"><?php echo $pageNum ?></a>
            </li>
<?php             endif ?>
<?php         endforeach ?>

<?php          if ($paginator->isNextPageExists()) : ?>
            <li>
                <a href="<?php echo $searchPath . ($paginator->getCurrentPageNum() + 1) ?>">次へ</a>
            </li>
<?php          endif ?>
        </ul>
    </div>
<?php     endif ?>
    <!-- メールリスト表示ここまで -->
<?php endif ?>

</div>
<!-- コンテンツここまで -->

<!-- フッターここから -->
<div id="footer">
    <hr />
    <p>Copyright &copy; 2011 Mizuki Yamanaka All Rights Reserved.</p>
</div>
<!-- フッターここまで -->

</body>
</html>
