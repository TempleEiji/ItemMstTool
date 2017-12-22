chcp 65001
.\bin\phantomjs.exe .\phantomcode\02_windows_individual_check_process.js
.\bin\iconv.exe -c -f UTF-8 -t SJIS "./output/02_windows_individual_check_process_output_UTF8.csv" > "./output/リサーチ用排出フォーマット.csv"
del .\output\02_windows_individual_check_process_output_UTF8.csv
