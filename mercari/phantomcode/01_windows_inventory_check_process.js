var system   = require('system');

var inputPath = './input/在庫チェック用フォーマット.csv';
var outputPathNotExist = './output/01_windows_inventory_check_process_not_exist_UTF8.csv';
var outputPathExist = './output/01_windows_inventory_check_process_exist_UTF8.csv';

var fs = require('fs');
var file_input = fs.open(inputPath, 'r');

var line = file_input.readLine();
var line_count = 0;

var url_ary = [];
var data_set = [];

while( line ) {
  if( line_count > 0 ) {
    var attr = line.split(",");
    if( attr[10].length != 0 ) {
      var data = {
        'action': attr[0].trim(),
        'item_id': attr[1].trim(),
        'url': attr[10].trim(),
      }

      data_set.push(data);
    }
  }

  line_count++;
  line = file_input.readLine();
}

file_input.close();
data_set.reverse();

console.log('total scraping number item: ' + data_set.length);

fs.write(outputPathNotExist, '"Action(SiteID=US|Country=JP|Currency=USD|Version=745|CC=UTF-8)","ItemID","EndCode"', 'w');

next();
function next(){
  var data = data_set.pop();
  var url = data['url'];

  if(url.length != 0) {
    page = require('webpage').create();
    page.injectJs('jquery.min.js');

    page.open(url, function() {
      var result = page.evaluate(function() {

        var title    = $("h2.item-name").text();
        var delete_item_check  = $(".deleted-item-name").text();
        var soldout = $("div.item-buy-btn.disabled.f18-24").text();
        if( delete_item_check.length > 0 )
          soldout = "ページ削除済";
        else if(title.length > 0 && soldout.length == 0)
          soldout = "販売中";
        else if(title.length > 0 && soldout.length >= 0)
          soldout = "在庫切れ";
        else
          soldout = "不明";

        return soldout;
      });

      if( result != '販売中'){
        // fs.write(outputPathNotExist, '"' + data['item_id'] + '","' + result + '"\n', 'a');
        fs.write(outputPathNotExist, '\n"End","' + data['item_id'] + '","NotAvailable"', 'a');
      } else {
        fs.write(outputPathExist, '"' + data['item_id'] + '","' + result + '"\n', 'a');
      }

      if(data_set.length == 0) {
        phantom.exit();
      } else {
        if( data_set.length % 10 == 0 )
          console.log('remain scraping number item: ' + data_set.length);
        page.close();

        setTimeout(next, 1500);
      }
    });
  } else {
    setTimeout(next, 1500);
  }
}
