<?php

class ToDoList {

    private static $count = 0;
    private $subject;
    private $staff;
    private $term;
    private $completion;

    public function __construct($subject, $staff, $term, $completion) {
        $this->subject = $subject;
        $this->staff = $staff;
        $this->term = $term;
        $this->completion = $completion;
        self::$count++;
    }

    public static function getCount() {
        return self::$count;
    }
    public function getSubject() {
        return $this->subject;
    }
    public function getStaff() {
        return $this->staff;
    }
    public function getTerm() {
        return $this->term;
    }
    public function getCompletion() {
        return $this->completion;
    }

    //「完了状態」他の現在状況に合わせて処理を分岐させる戻り値を返す
    //表示色や「操作」欄に表示・非表示するボタンも変更
    public function isFinished($completion) {
        if ($completion == "unfinished") {
            //（仮）
            return true;
        }
    }

    //一覧表の「操作」に表示するボタンのHTMLを返す
    public function getControls() {
        //（仮）
        $submits = "<input class=\"btn-s\" type=\"submit\" value=\"完了\">"
                ."<input class=\"btn-s\" type=\"submit\" value=\"更新\">"
                ."<input class=\"btn-s\" type=\"submit\" value=\"削除\">";
        return $submits;
    }
}

?>