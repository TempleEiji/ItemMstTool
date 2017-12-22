chcp 65001
.\bin\phantomjs.exe .\phantomcode\01_windows_inventory_check_process.js
.\bin\iconv.exe -c -f UTF-8 -t SJIS "./output/01_windows_inventory_check_process_not_exist_UTF8.csv" > "./output/ebay 削除用.csv"
del .\output\01_windows_inventory_check_process_not_exist_UTF8.csv
.\bin\iconv.exe -c -f UTF-8 -t SJIS "./output/01_windows_inventory_check_process_exist_UTF8.csv" > "./output/ebay 在庫有り.csv"
del .\output\01_windows_inventory_check_process_exist_UTF8.csv
