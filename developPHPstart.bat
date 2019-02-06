cd c:\lesson\
rem "ディレクトリとファイルの一覧出力しまっせ。"
dir /B /O:G > files.txt
php -S localhost:8080 -t c:/lesson/develop/
