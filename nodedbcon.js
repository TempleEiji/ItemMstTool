'use strict';

let mysql = require('mysql');
let connection = mysql.createConnection({
  host: "210.140.100.232",
  user: "nodeusertera",
  password: "nodepasstera",
  port: 3306,
  database: 'all_item_mst'
});

// connection.connect();
// connection.query('SELECT * from mercari_mst LIMIT 10;', (err, rows, fields) => {
//   if (err) throw err;

//   console.log('The solution is: ', rows);
// });

connection.connect();
connection.query('SELECT * from scrapesets LIMIT 10;', (err, rows, fields) => {
  if (err) throw err;

  console.log('url: ', rows[0]['userid']);
  console.log('url: ', rows['userid']);
  console.log('url: ', rows['listname']);
  console.log('url: ', rows['delword1']);
  console.log('url: ', rows['delword2']);
  console.log('url: ', rows['delword3']);
  console.log('url: ', rows['delword4']);
  
});


var ctt = '1';
var pageURL= 'maaj112222';
var itemtitle= 'シナもロール';
var price= '1000';
var description= 'sinamoroall'; 

connection.query("insert into itemlists set ?",
	{
		id: ctt,
		itemurl: pageURL,
		jptitle: itemtitle,
		price: price,
		jpdes: description
	},function
(error,results,fields){
});

connection.end();