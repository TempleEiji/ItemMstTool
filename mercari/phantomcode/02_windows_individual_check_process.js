// node 00_mercari_scraping_program.js -m 2 -i "input/リサーチ読み込む用.csv" -o "output/リサーチ用排出フォーマット.csv"
var system   = require('system');

var inputPath = './input/リサーチ読み込む用.csv';
var outputPathUtf8 = './output/02_windows_individual_check_process_output_UTF8.csv';
var outputPath = './output/リサーチ用排出フォーマット.csv';

var fs = require('fs');
var file_input = fs.open(inputPath, 'r');

var line = file_input.readLine();
var line_count = 0;

var url_ary = [];
var data_set = [];

while( line ) {
  if( line_count > 0 ) {
    var attr = line.split(",");
    if( attr[1].length != 0 ) {
      var data = {
        'item_id': attr[0],
        'url': attr[1],
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

next();
function next(){
  var data = data_set.pop();
  var url = data['url'];

  if(url.length != 0) {
    page = require('webpage').create();
    page.injectJs('jquery.min.js');

    page.open(url, function() {
      var result = page.evaluate(function() {
        var url      = location.href ;
        var title    = $("h2.item-name").text();
        var price    = $("span.item-price.bold").text();
        var postage  = $("span.item-shipping-fee").text();
        var ship_ary = $("table.item-detail-table tbody tr td");
        var state    = $(ship_ary[3]).text();
        var shipping = $(ship_ary[5]).text();
        var descrpt  = $("div.item-description.f14").text();

        var soldout = $("div.item-buy-btn.disabled.f18-24").text();
        var delete_item_check  = $(".deleted-item-name").text();

        if( delete_item_check.length > 0 )
          soldout = "ページ削除済";
        else if(title.length > 0 && soldout.length == 0)
          soldout = "販売中";
        else if(title.length > 0 && soldout.length >= 0)
          soldout = "在庫切れ";
        else
          soldout = "不明";

        var img_ary  = $("div.owl-dots div img");
        var img_0    = $("div.owl-item.active img.owl-lazy").attr("src");
        var img_1    = $(img_ary[1]).attr("src");
        var img_2    = $(img_ary[2]).attr("src");
        var img_3    = $(img_ary[3]).attr("src");
        if(!img_0){ img_0 = "" };
        if(!img_1){ img_1 = "" };
        if(!img_2){ img_2 = "" };
        if(!img_3){ img_3 = "" };

        var ret_line = [];
        ret_line.push(title.split("\n").join("").trim());
        ret_line.push(price.split("\n").join("").trim()    + '(' + postage.split("\n").join("").trim() + ')');
        ret_line.push(state.split("\n").join("").trim());
        ret_line.push(shipping.split("\n").join("").trim());
        ret_line.push(soldout.split("\n").join("").trim());
        ret_line.push(descrpt.split("\n").join("").trim());
        ret_line.push(img_0.split("\n").join("").trim());
        ret_line.push(img_1.split("\n").join("").trim());
        ret_line.push(img_2.split("\n").join("").trim());
        ret_line.push(img_3.split("\n").join("").trim());
        ret_line.push(url.split("\n").join("").trim());

        if( postage.length && title.length > 0 )
          return ret_line.join('","');
        else
          return '存在しない';
      });

      if( result != '存在しない' )
        fs.write(outputPathUtf8, '"' + result + '","' + data['item_id'] + '"\n', 'a');
      else
        fs.write(outputPathUtf8, '"' + data['item_id'] + '","' + url +  '"\n', 'a');

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
