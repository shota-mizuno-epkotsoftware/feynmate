# API設計

## 全体

- 認証: Sanctum SPA
- エラー： 401(Unauthorized)/ 403(Forbidden)/ 404(NotFound)/ 422(Validation, Laravel標準形式)/ 503(ServiceUnavailable)

## エンドポイント

現状は画面設計のMust中心に記載

### 認証

| メソッド | パス | 認証 | 概要 |
| --- | --- | --- | --- |
| GET | `/sanctum/csrf-cookie` | 不要 | CSRF Cookie 取得 |
| POST | `/api/register` | 不要 | ユーザー登録 |
| POST | `/api/login` | 不要 | ログイン |
| POST | `/api/logout` | 要 | ログアウト |
| GET | `/api/user` | 要 | ログイン中のユーザー |
| POST | `/api/forgot-password` | 不要 | パスワードリセットメール送信 |
| POST | `/api/reset-password` | 不要 | パスワードリセット実行 |
| GET | `/api/verify-email/{id}/{hash}` | 要 | メールアドレス確認 |
| POST | `/api/email/verification-notification` | 要 | 確認メール再送信 |

### アプリ

| メソッド | パス | 認証 | 概要 |
| --- | --- | --- | --- |
| GET | `/api/topics` | 要 | 自分のトピック一覧 |
| POST | `/api/topics` | 要 | 作成 |
| GET | `/api/topics/{topic}` | 要 | 詳細 |
| PUT | `/api/topics/{topic}` | 要 | 更新 |
| DELETE | `/api/topics/{topic}` | 要 | 削除 |
| GET | `/api/topics/{topic}/attempts` | 要 | 試行履歴一覧（推移グラフ用） |
| POST | `/api/topics/{topic}/attempts` | 要 | 説明文を投稿して AI 採点 |
| GET | `/api/topics/{topic}/attempts/{attempt}` | 要 | 過去の試行1件の採点結果（再表示・見返し用） |
