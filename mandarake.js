'use strict';
let mysql = require('mysql');
let connection = mysql.createConnection({
  host: "210.140.100.232",
  user: "nodeusertera",
  password: "nodepasstera",
  port: 3306,
  database: 'all_item_mst'
});

var fs = require('fs');
var client = require('cheerio-httpcli');
var request = require('request');
var URL = require('url');
client.headers['User-Agent'] = 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; NP06; rv:11.0) like Gecko';

DBselectct();

function DBselectct(){
	connection.connect();
	connection.query('SELECT COUNT(*) FROM mandaras WHERE listno=1231868154', (err, rows, fields) => {
		DBselect(rows[0]['COUNT(*)']);
		console.log(rows[0]['COUNT(*)']);

	});
}


function DBselect(findcount){
	connection.query('SELECT * from mandaras WHERE listno=1231868154', (err, rows, fields) => {
		if (err) throw err;

		console.log(findcount);

		for(var ct=0;ct<findcount;ct++){
			var itemurl = client.fetchSync(rows[ct]['itemurl']);
			var zaiko = itemurl.$('.operate .addcart').text();
			if(!zaiko.indexOf('カート')){
			  // 在庫あり
			  var zaiko = "Active";
			  DBupdate(rows[ct]['id'],zaiko);
			  console.log(zaiko);
			}else{
			  // 在庫なし
			  var zaiko = "Out";
			  DBupdate(rows[ct]['id'],zaiko);
			}
		}
	});
}

function DBupdate(id,zaiko){
	//connection.connect();
	console.log("update");
	connection.query('UPDATE `mandaras` SET stockstate = "' + zaiko + '" WHERE id = ' + id);
	//connection.end();
}
