# confirmation-test_PiGLy

# 体重管理アプリ

## 環境構築

### Docker ビルド

1. git clone git@github.com:nakagawa-hayato/confirmation-test_PiGLy.git
2. docker-compose up -d build

### ＊ MySQL は、OS によって起動しない場合があるのでそれぞれの PC に合わせて docker-compose.yml ファイルを編集してください。

### Laravel 環境構築

1. docker-compose exec php bash
2. composer install
3. .env.example ファイルから.env を作成し、環境変数を変更
4. php artisan key:generate
5. php artisan migrate
6. php artisan db:seed

## 使用技術

- PHP 8.1.33
- Laravel 8.83.29
- MySQL 8.0.26

## ER 図

<img width="761" height="301" alt="Image" src="https://github.com/user-attachments/assets/0e5f5e7c-7c5b-43c5-9553-7b8735abf16d" />

## URL

- 開発環境：http:/localhost/
- phpMyAdmin : http://localhost:8080/
