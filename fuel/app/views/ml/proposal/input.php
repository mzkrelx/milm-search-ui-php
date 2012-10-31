<form class="well form-horizontal"
      enctype="application/x-www-form-urlencoded"
      action="<?php echo $base_url . 'ml/proposal/confirm'?>"
      method="post">
    <fieldset>
        <div class="control-group">
            <label class="control-label" for="name">お名前</label>
            <div class="controls">
                <input id="name" name="name" class="input-xlarge" type="text">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="email">メールアドレス</label>
            <div class="controls">
                <input id="email" name="email" class="input-xlarge" type="email">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="mlName">メーリングリストの名前</label>
            <div class="controls">
                <input id="password" name="password" class="input-xlarge" type="text">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="mlName">メーリングリストのタイプ</label>
            <div class="controls">
                <input name="mlType" type="radio">Mailman
                <input name="mlType" type="radio">分からない
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="mlName">メーリングリストのアーカイブページのURL</label>
            <div class="controls">
                <input id="mlUrl" name="mlUrl" class="input-xlarge" type="text">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="mlName">コメント</label>
            <div class="controls">
                <textarea id="comment" name="comment" rows="3" class="input-xlarge"></textarea>
            </div>
        </div>
    </fieldset>
    <div class="form-actions">
        <button class="btn" type="submit">戻る</button>
        <button class="btn btn-primary" type="submit">確認</button>
    </div>
</form>