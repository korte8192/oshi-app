<?php
// データベース接続ファイルを読み込む
require_once 'db_connect.php';

try {
    // アーティスト情報をすべて取得するSQL（新しい順）
    $stmt = $pdo->query("SELECT * FROM artist ORDER BY created_at DESC");
    $artist = $stmt->fetchAll();
} catch (PDOException $e) {
    exit("取得エラー: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>推しアーティスト一覧</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .nav-links { margin-bottom: 20px; }
        .nav-links a { 
            margin-right: 15px; 
            text-decoration: none; 
            color: #007bff; 
            font-weight: bold; 
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 16px;
            max-width: 400px;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
        }
        .card h2 {
            margin-top: 0;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>推しアーティスト一覧</h1>
    
    <!-- ナビゲーションリンク -->
    <div class="nav-links">
        <a href="index.php">← ホームに戻る</a>
        <a href="register.php">＋ 新しく登録する</a>
    </div>
    <hr>

    <?php if (empty($artist)): ?>
        <p>まだ登録されていません。</p>
    <?php else: ?>
        <!-- 取得したデータの数だけループしてカードを作成 -->
        <?php foreach ($artist as $artist): ?>
            <div class="card">
                <h2><?php echo htmlspecialchars($artist['name'], ENT_QUOTES, 'UTF-8'); ?></h2>
                <p><strong>推し度:</strong> <?php echo htmlspecialchars($artist['level'], ENT_QUOTES, 'UTF-8'); ?> / 5</p>
                <p><strong>お気に入り作品:</strong> <?php echo htmlspecialchars($artist['favorite_work'], ENT_QUOTES, 'UTF-8'); ?></p>
                
                <p><strong>メモ:</strong><br>
                <?php echo nl2br(htmlspecialchars($artist['memo'], ENT_QUOTES, 'UTF-8')); ?>
                </p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
