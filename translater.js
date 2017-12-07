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

var selectArr = DBselect();
console.log('jptitle:' + selectArr);
// DBupdate(entitle,selectArr['id'])

function DBselect(){

	connection.connect();
	connection.query('SELECT * from mandaras;', (err, rows, fields) => {
	  if (err) throw err;

	  var selectArr =[];
	  selectArr['jptitle'] = rows[0]['jptitle'];
	  selectArr['id'] = rows[0]['id'];

	  console.log('jptitle: ', selectArr['jptitle']);
	  console.log('id: ', selectArr['id']);

	  hoyanku(selectArr['jptitle'],selectArr['id']);

	  
	});
	connection.end();
}

function DBupdate(entitle,id){
  
	connection.connect();
	var id=id;
	var entitle=entitle;
	connection.query('UPDATE `mandaras` SET entitle = ' + entitle+ ' WHERE id = ' + id);
	connection.end();
}


function hoyanku(honyakuword) {

  console.log('befor文:' + honyakuword);
  result2 = client.fetchSync('https://www.excite.co.jp/world/');
  result3 = result2.$('#exec_transfer').submitSync({
    auto_detect: 'on',
    before: honyakuword
  });
  honyakuword = result3.$('#after').val();
  console.log('after文:' + honyakuword);
  DBupdate(honyakuword,id)
}