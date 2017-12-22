var system = require('system');
var rootURL = system.args[1];
// var rootURL = 'https://www.mercari.com/jp/search/?sort_order=like_desc&keyword=ZOOM&category_root=5&category_child=79&category_grand_child%5B1297%5D=1&brand_name=&brand_id=&size_group=&price_min=500&price_max=10000&item_condition_id%5B1%5D=1&item_condition_id%5B2%5D=1&item_condition_id%5B3%5D=1&item_condition_id%5B4%5D=1&item_condition_id%5B5%5D=1&shipping_payer_id%5B2%5D=1&status_on_sale=1'

var page = require('webpage').create();
page.injectJs('jquery.min.js');

page.open(rootURL, function() {
  var link = page.evaluate(function() {
    var link = $("section.items-box a");
    var ret_link = "";
    for( i = 0; i < link.length; i++ ) {
      ret_link = $(link[i]).attr("href") + ":_:" + ret_link;
    }

    return ret_link;
  });

  console.log(link);
  phantom.exit()
});
