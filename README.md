もぎたて
### mogitate（モギタテ）商品登録管理編集アプリ

![Reseアプリの画面](<rese.png>)

#### サービス概要

- 飲食店予約サービス Rese（リーズ）は、ある企業のグループ会社向けの飲食店予約サービスです。外部サービスに依存せず、手数料を節約しながら自社で完全にコントロール可能な予約システムを提供します。

### 制作の背景と目的

外部の飲食店予約サービスでは手数料が発生するため、自社で予約サービスを持つことでコスト削減とデータ管理の自由度を高めたいと考えています。

### 制作の目標

- 初年度でのユーザー数 10,000 人を達成する。
- 直感的で使いやすいインターフェースを提供する。

### 機能要件

- **予約変更機能**: ユーザーはマイページから予約日時や人数を変更できる。
- **評価機能**: 来店後、ユーザーが店舗を 5 段階で評価し、コメントを残せる。
- **バリデーション**: 認証と予約の際に FormRequest を使用してバリデーションを行う。
- **レスポンシブデザイン**: タブレット・スマートフォン用にブレイクポイント 768px でレスポンシブデザインを実装。
- **管理画面**: 管理者、店舗代表者、利用者の 3 種類の権限に基づく管理画面を提供。
- **ストレージ**: 店舗の画像をストレージに保存。
- **認証**: メールによる本人確認機能。
- **メール送信**: 管理画面から利用者にお知らせメールを送信。
- **リマインダー**: タスクスケジューラーを利用して、予約当日の朝にリマインダーを送信。
- **QR コード**: 利用者が来店時に提示する QR コードを発行し、店舗側で照合。
- **決済機能**: Stripe を利用した決済機能。

### 作業範囲

- 設計
- コーディング
- テスト

### ターゲットユーザー

- 20〜30 代の社会人

### システム要件

- **開発言語**: PHP
- **フレームワーク**: Laravel
- **データベース**: MySQL
- **バージョン管理**: GitHub

### 使用技術

- **フロントエンド**: HTML, CSS, JavaScript
- **バックエンド**: PHP, Laravel
- **データベース**: MySQL
- **バージョン管理**: Git, GitHub

### ライセンス

このプロジェクトは特定のクライアントにのみ提供される専用のソフトウェアです。再配布や商用利用は禁止されています。

#### 使用技術（実行環境）

- **開発言語**: PHP
- **フレームワーク**: Laravel 8.x
- **データベース**: MySQL
- **バージョン管理**: GitHub
- **コンテナ化技術**: Docker

#### ER 図

![mogitate ER Diagram](/mogitate.drawio.png)

#### 環境構築

- **PHP**: 8.1.29
- **MySQL**: 10.11.6-MariaDB
- **Composer**: 2.7.7
- **Docker**: 27.4.0
- **Laravel Framework**: 8.83.27

- ＊ご使用の PC に合わせて各種必要なファイル(.env や docker-compose.yml 等)は作成、編集してください。

- **1.docker-compose exec bash**
- **2.composer install**
- **3..env.example ファイルから.env を作成し、環境変数を変更**
- **4.php artisan key:generate**
- **5.php artisan migrate**
- **6.php artisan db:seed**

####クローン作製手順

1. GitHub リポジトリのクローン

```bash
git clone https://github.com/ponponmama/20241220_hara_erika.git
cd 20241220_hara_erika
```

2. 必要なパッケージのインストール

```bash　
sudo apt-get update
```

Docker コンテナのビルドと起動

```bash
docker-compose up -d --build
```

3. Composer を使用した依存関係のインストール

- Docker 環境で PHP コンテナに入り、依存関係をインストールします。

```bash
docker-compose exec php bash
composer install
```

4. 環境設定ファイルの設定

- .env.example ファイルを .env としてコピーし、必要に応じてデータベースなどの設定を行います。

```bash
cp .env.example .env
```

- 環境設定を更新した後、設定キャッシュをクリアするために以下のコマンドを実行します。これにより、新しい設定がアプリケーションに反映されます。

```bash
docker-compose exec php bash
php artisan config:clear
```

この手順は、特に環境変数が更新された後や、`.env` ファイルに重要な変更を加えた場合に重要です。設定キャッシュをクリアすることで、古い設定が引き続き使用されることを防ぎます。

5. 環境設定手順
```
####ディレクトリの作成とストレージ設定

- プロジェクトを始める前に、以下のディレクトリを作成してください。これにより、ファイルの保存場所が正しく設定されます。
- 商品の画像の保存するために以下のディレクトリを作成してください。PHP コンテナ内で実行します。

```bash
mkdir -p /path/to/your/project/storage/app/public/images
php artisan storage:link
```

次に、これらのディレクトリに適切なパーミッションを設定してください。これにより、アプリケーションがファイルを適切に読み書きできるようになります。

```bash
chmod -R 775 /var/www/storage/app/public/images
chmod -R 775 /var/www/storage/app/public/qr_codes
chown -R www-data:www-data /var/www/storage/app/public
```
- シーダー用の画像を配置する

これらのコマンドは、アプリケーションが画像や QR コードを保存するためのディレクトリに適切なアクセス権を設定するために必要です。`www-data` はウェブサーバーのユーザーですが、使用しているサーバーによっては異なるユーザー名になる場合があるため、環境に合わせて適宜変更してください。

6. アプリケーションキーの生成

```bash
php artisan key:generate
```

6.データベースのマイグレーション

```bash
php artisan migrate
```

7.データベースシーダーの実行

```bash
php artisan db:seed
```

### URL

- **開発環境:** [https://localhost/](https://localhost/)
- **phpMyAdmin:** [http://localhost:8080/](http://localhost:8080/)