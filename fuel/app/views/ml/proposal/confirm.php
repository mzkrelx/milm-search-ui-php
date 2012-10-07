<form class="well form-horizontal"
      enctype="application/x-www-form-urlencoded"
      action="<?php echo $basePath . '/ml/proposal/add'?>"
      method="post">
    <fieldset>
        <dl>
            <dt>お名前</dt>
            <dd>milm</dd>

            <dt>メールアドレス</dt>
            <dd>milm@milmsearch.org</dd>

            <dt>メーリングリストの名前</dt>
            <dd>milm-search-public</dd>

            <dt>メーリングリストのタイプ</dt>
            <dd>分からない</dd>

            <dt>メーリングリストのアーカイブページのURL</dt>
            <dd>http://sourceforge.jp/projects/milm-search/lists/archive/public/</dd>

            <dt>コメント</dt>
            <dd>こめこめ</dd>
        </dl>
    </fieldset>
    <div class="form-actions">
        <input type="submit" name="return" id="return" value="戻る" class="btn" />
        <input type="submit" name="submit" id="submit" value="登録" class="btn btn-primary" />
    </div>
</form>