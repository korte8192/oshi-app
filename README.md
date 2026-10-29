# 推しアーティスト管理システム (Oshi Management System)

推しアーティストの情報（名前、推し度、お気に入り作品、メモなど）を一元管理するためのWebアプリケーションです。
Web開発の基礎（PHP / MySQL）と、安全なコード記述（基本的なセキュリティ対策）を学ぶ目的で制作しています。

---

## 実装済み機能

- [x] **ホーム画面 (`index.php`)**: 各機能へ遷移するメインメニュー
- [x] **新規登録機能 (`register.php`)**: アーティスト情報の登録＆登録完了後の自動リダイレクト
- [x] **一覧表示機能 (`list.php`)**: 登録されたデータをデータベースから取得し、カード型デザインで表示

### 今後実装予定の機能
- [ ] **編集機能 (`edit.php`)**: 登録済みデータの修正
- [ ] **削除機能 (`delete.php`)**: データの削除
- [ ] **ログイン・ユーザー管理機能**: ユーザーごとにデータを分離する仕組み

---

## 安全対策

フレームワークを使わずVanilla PHPで記述するにあたり、以下の基本的な安全策を最初からコードに組み込んでいます。

1. **SQLインジェクション対策**
   - データベース操作にはPDOを使用し、変数処理には**プリペアドステートメント（`prepare()` / `execute()`）**を適用してSQLの不正実行を防いでいます。
2. **クロスサイトスクリプティング（XSS）対策**
   - 画面にユーザーの入力値を表示する際は、必ず **`htmlspecialchars()`** を通してHTMLエスケープ処理を行っています。

---

## 開発環境

- **OS**: Ubuntu (WSL2)
- **Webサーバー**: Apache
- **言語**: PHP 8.3
- **データベース**: MySQL 8.0
- **バージョン管理**: Git / GitHub

---

## 🗄 データベース構造 (`artists` テーブル)

```sql
CREATE TABLE artists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    level INT DEFAULT 3,
    favorite_work VARCHAR(255),
    urls TEXT,
    memo TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
