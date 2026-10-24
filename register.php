<?php
require_once 'db_connect.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$name = $_POST['name']?? '';
	$level = $_POST['level'] ?? 3;
	$favorite_work = $_POST['favorite_work'] ?? '';
    	$urls = $_POST['urls'] ?? '';
	$memo = $_POST['memo'] ?? '';

	if($name!==''){

	$sql = "INSERT INTO artist (name, level, favorite_work, urls, memo)
		VALUES (:name, :level, :favorite_work, :urls, :memo)";
	$stmt = $pdo->prepare($sql);

	try {
            $stmt->execute([
                ':name' => $name,
                ':level' => $level,
                ':favorite_work' => $favorite_work,
                ':urls' => $urls,
                ':memo' => $memo
            ]);
	    header('Location: list.php');
            exit;
        } catch (PDOException $e) {
            $message = "登録エラー: " . $e->getMessage();
        }
    } else {
        $message = "アーティスト名は必須です。";
    }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>推しアーティスト登録</title>
</head>
<body>
    <h1>推しアーティスト登録</h1>

    <!-- メッセージがあれば表示する -->
    <?php if ($message !== ''): ?>
        <p style="color: blue; font-weight: bold;"><?php echo $message; ?></p>
    <?php endif; ?>

    <!-- 登録フォーム -->
    <form action="register.php" method="POST">
        <div style="margin-bottom: 10px;">
            <label>アーティスト名 (必須):</label><br>
            <input type="text" name="name" required>
        </div>
        <div style="margin-bottom: 10px;">
            <label>推し度 (1〜5):</label><br>
            <input type="number" name="level" min="1" max="5" value="3">
        </div>
        <div style="margin-bottom: 10px;">
            <label>お気に入り作品:</label><br>
            <input type="text" name="favorite_work">
        </div>
        <div style="margin-bottom: 10px;">
            <label>関連URL (改行で複数入力):</label><br>
            <textarea name="urls" rows="3" cols="40"></textarea>
        </div>
        <div style="margin-bottom: 10px;">
            <label>メモ:</label><br>
            <textarea name="memo" rows="4" cols="40"></textarea>
        </div>
        <button type="submit">登録する</button>
    </form>
</body>
</html>
