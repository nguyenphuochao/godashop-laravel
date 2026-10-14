* Hướng dẫn setup source bằng xampp hoặc laragon:
    - Bước 1 : git clone source từ github
    - Bước 2 : copy .env.example => .env
    - Bước 3 : composer update
    - Bước 4 : cấu hình vhost chạy domain ảo. VD: godashop.laravel.com
    - Bước 5 : cấu hình database [godashop-laravel-k37.sql]
    - Bước 6 : 
               php artisan key:generate

               php artisan cache:clear

               php artisan config:clear

               php artisan config:cache

               php artisan view:clear

* Thông tin version : 
    - PHP : 7.3 | 8.0
    - Laravel : 8.12

* Setup những thứ cần thiết trong .env -> php artisan config:clear

    ITEM_PER_PAGE=9

    NOCAPTCHA_SECRET=secret-key

    NOCAPTCHA_SITEKEY=site-key

    GUEST=khachvanglai@gmail.com

    MAIL_MAILER=smtp

    MAIL_HOST=smtp.gmail.com

    MAIL_PORT=587

    MAIL_USERNAME=your_gmail

    MAIL_PASSWORD=your_password

    MAIL_ENCRYPTION=tls
    
    MAIL_SHOP=your_gmail

* Setup source bằng docker
    - Bước 1: install docker
    - Bước 2: cd godashop-laravel
    - Bước 3: docker compose up --build -d

    
