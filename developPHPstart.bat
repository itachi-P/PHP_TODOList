cd c:\lesson\WebAppTr\
rem "ディレクトリとファイルの一覧出力しまっせ。"
dir /B /O:G > files.txt
php -S localhost:8100 -t c:/lesson/WebAppTr/
