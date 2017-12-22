var system   = require('system');
var url_line = system.args[1];
var url_ary  = url_line.split(":_:");

// var url_ary = ["https://item.mercari.com/jp/m877928680/"];
//console.log(url);
// var page = require('webpage').create().includeJs("http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js", function() { });

next();
function next(){
  var url = url_ary.pop();

  if( url && url.length != 0) {
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

        return ret_line.join(':_:');
      });

      console.log(result);
      if(url_ary.length == 0) {
        phantom.exit();
      } else {
        page.close();
        // next();
        setTimeout(next, 1500);
      }
    });
  } else {
    // next();
    setTimeout(next, 1500);
  }
}
