<?php

// list.php上部のDBアクセス→「完了」項目の値から「操作」項目のボタンを生成する一連の流れを外に出すか？
// 尚且つその2次元配列型のテーブルレコードをクラス化してインスタンスとして返しHTML表示部とロジックを分離するか？

// DB接続、SELECT文発行部


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
    //（予定）引数を受け取って「完了」ボタンを「未完了」ボタンに変える処理を追記
    public function getControls() {
        //（仮）nameに設定したキーは自動で渡って$_GET['finish']等で取り出せるが、id属性はダメなのか
        //「完了」「未完了」ボタン押下時の処理はデータ操作分の追記が必要
        if (isset($_POST['finish'])) {
            if ($_POST['finish'] == "完了") {
                $finish = "未完了";
            } else if ($_POST['finish'] == "未完了") {
                $finish = "完了";
            }
        } else {
            $finish = "完了";
        }
        $submits = 
            "<input name='finish' class='btn-s' type='submit' value='".$finish."'>"
            ."<input name='update' class='btn-s' type='submit' value='更新'>"
            ."<input name='delete' class='btn-s' type='submit' value='削除'>";
        return $submits;
    }
}
?>