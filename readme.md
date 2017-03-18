用來選取範圍將Excel資料轉換成Array或是SQL Insert語法，或是Lravel的Query Builder.
DEMO:

[![Everything Is AWESOME](https://www.ccc.tc/Excelify.png)](https://youtu.be/LkaWIOUlOFU "Everything Is AWESOME")

<h3>安裝:</h3>

1. composer install

2. cp .env.example .env

3. php artisan key:generate

上傳的excel都會存放在:
app/files

<h3>為了確保執行上沒什麼問題，建議設定如下:</h3>

php.ini建議設定:
<pre>
upload_max_filesize = 50M
post_max_size = 50M
max_execution_time = 0
memory_limit = -1
</pre>

nginx的設定:
<pre>
client_max_body_size 50m;
</pre>

