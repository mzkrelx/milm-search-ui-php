<?php
/**
 * ページネーターを表示するための必要な情報を設定したり取得するクラスです。
 *
 * @author Mizuki Yamanaka
 */
class Paginator {

    /** 現在のページ番号 */
    private $_currentPageNum;

    /** 1ページに表示する最大数 */
    private $_itemCountPerPage;

    /** ページ番号リンクを表示するページ数の片方向の長さ(現在のページを含む) */
    private $_oneSideRenge;

    /** 全てのアイテムの件数 */
    private $_totalItemCount;

    /**
     * コンストラクタ
     *
     * @param currentPageNum
     * @param itemCountPerPage
     * @param oneSideRenge
     * @param totalItemCount
     */
    public function __construct($currentPageNum, $itemCountPerPage,
            $oneSideRenge, $totalItemCount) {
        $this->currentPageNum = $currentPageNum;
        $this->itemCountPerPage = $itemCountPerPage;
        $this->oneSideRenge = $oneSideRenge;
        $this->totalItemCount = $totalItemCount;
    }

    /**
     * currentItemCount を取得します。
     *
     * @return int currentItemCount
     */
    public function getCurrentItemCount() {
        if ($this->currentPageNum == $this->getTotalPageCount()) {
            return $this->totalItemCount % $this->getItemCountPerPage();
        }
        return $this->getItemCountPerPage();
    }

    /**
     * currentPageNum を取得します。
     *
     * @return int currentPageNum
     */
    public function getCurrentPageNum() {
        return $this->currentPageNum;
    }

    /**
     * currentItemCountStart を取得します。
     *
     * @return int currentItemCountStart
     */
    public function getCurrentItemCountStart() {
        return ($this->getCurrentPageNum() - 1) * $this->getItemCountPerPage() + 1;
    }

    /**
     * currentItemCountEnd を取得します。
     *
     * @return int currentItemCountEnd
     */
    public function getCurrentItemCountEnd() {
        return $this->getCurrentItemCountStart() + $this->getCurrentItemCount() - 1;
    }

    /**
     * itemCountPerPage を取得します。
     *
     * @return int itemCountPerPage
     */
    public function getItemCountPerPage() {
        return $this->itemCountPerPage;
    }

    /**
     * prePageExists を取得します。
     *
     * @return bool prePageExists
     */
    public function isPrePageExists() {
        return $this->getCurrentPageNum() != 1;
    }

    /**
     * nextPageExists を取得します。
     *
     * @return bool nextPageExists
     */
    public function isNextPageExists() {
        return $this->getCurrentPageNum() < $this->getTotalPageCount();
    }

    /**
     * oneSideRenge を取得します。
     *
     * @return int oneSideRenge
     */
    public function getOneSideRenge() {
        return $this->oneSideRenge;
    }

    /**
     * pageNumsInRange を取得します。
     *
     * @return array pageNumsInRange
     */
    public function getPageNumsInRange() {
        $pageNumsInRange = array();
        $currentPageNum = $this->getCurrentPageNum();
        $renge = $this->getOneSideRenge();
        $maxRengePageNum = $currentPageNum + $renge;
        $minRengePageNum = $currentPageNum - $renge;
        for ($i = 1; $i < $maxRengePageNum; $i++) {
            if ($i < $minRengePageNum) {
                continue;
            }
            if ($i > $this->getTotalPageCount()) {
                break;
            }
            $pageNumsInRange[] = $i;
        }
        return $pageNumsInRange;
    }

    /**
     * totalItemCount を取得します。
     *
     * @return int totalItemCount
     */
    public function getTotalItemCount() {
        return $this->totalItemCount;
    }

    /**
     * totalPageCount を取得します。
     *
     * @return int totalPageCount
     */
    public function getTotalPageCount() {
        $division = (int) ($this->getTotalItemCount() / $this->getItemCountPerPage());
        $remainder = $this->getTotalItemCount() % $this->getItemCountPerPage();
        $add = $remainder > 0 ? 1 : 0;
        return $division + $add;
    }

    /**
     * currentPageNum を設定します。
     *
     * @param int currentPageNum 設定する currentPageNum
     */
    public function setCurrentPageNum($currentPageNum) {
        $this->currentPageNum = $currentPageNum;
    }

    /**
     * itemCountPerPage を設定します。
     *
     * @param int itemCountPerPage 設定する itemCountPerPage
     */
    public function setItemCountPerPage($itemCountPerPage) {
        $this->itemCountPerPage = $itemCountPerPage;
    }

    /**
     * oneSideRenge を設定します。
     *
     * @param int oneSideRenge 設定する oneSideRenge
     */
    public function setOneSideRenge($oneSideRenge) {
        $this->oneSideRenge = $oneSideRenge;
    }

    /**
     * totalItemCount を設定します。
     *
     * @param int totalItemCount 設定する totalItemCount
     */
    public function setTotalItemCount($totalItemCount) {
        $this->totalItemCount = $totalItemCount;
    }

}
