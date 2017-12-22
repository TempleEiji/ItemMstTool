var myDB = require('./00_database.js');
var basedir = process.argv[2];

myDB.sequelize
  .authenticate()
  .then(() => {
    console.log('Connection has been established successfully.');
  })
  .catch(err => {
    console.error('Unable to connect to the database:', err);
  });

myDB.Mercari.findAll({
  attributes: ['itemurl'],
  where: {
    stockstate: 'Active'
  }
}).then(function(scrapset) {
  var urlArr = [];
  for (id in scrapset) {
    urlArr.push(scrapset[id].itemurl);
  }

  console.log('トタール在庫チェック件数：' + urlArr.length);

  if( urlArr.length == 0 )
    process.exit(0);

  /**
   * executing-phantom.js
   */

  var spawn = require('child_process').spawn;
  // console.log(urlArr.join(':_:'));
  var args = [ basedir + "/phantomcode/00_scraping.js", urlArr.join(':_:')];
  // In case you want to customize the process, modify the options object
  var options = {};

  // If phantom is in the path use 'phantomjs', otherwise provide the path to the phantom phantomExecutable
  // e.g for windows:
  // var phantomExecutable = 'E:\\Programs\\PhantomJS\\bin\\phantomjs.exe';
  var phantomExecutable = 'phantomjs';

  /**
   * This method converts a Uint8Array to its string representation
   */
  function Uint8ArrToString(myUint8Arr){
    return myUint8Arr.toString('utf-8');
  };

  var child = spawn(phantomExecutable, args, options);

  child.stdout.on('data', function(data) {
      var textData = Uint8ArrToString(data);

      var headers = ['title', 'price', 'state', 'shipping', 'soldout', 'descrpt', 'img_0', 'img_1', 'img_2', 'img_3', 'url'];
      var data = textData.split(':_:');
      var obj = {};

      if( headers.length != data.length ) {
        console.log(headers.length);
        console.log(data.length);
        console.log(data);
      }

      for(var i = 0; i < data.length; i++) {
         obj[headers[i]] = data[i].trim();
      }

      for( var i = 0; i < urlArr.length; i++ ) {
        if ( urlArr[i].trim() == obj['url'] ) {
          if( obj['soldout'] != '販売中' ) {
            // console.log(obj);
            myDB.Mercari.update({ stockstate: 'Out' }, { where: { itemurl: obj['url'] } })
            .then((result) => {
              console.log('Update Out for: ' + obj['url'] + ' ' + result);
            });
          }

          urlArr.splice(i, 1);
          break;
        }
      }

      if( urlArr.length % 10 == 0 )
        console.log('在庫チェック残り件数：' + urlArr.length);
  });

  // Receive error output of the child process
  child.stderr.on('data', function(err) {
    var textErr = Uint8ArrToString(err);
    console.log(textErr);
  });

  // Triggered when the process closes
  child.on('close', function(code) {
    console.log('Process closed with status code: ' + code);

    if(urlArr.length == 0)
      process.exit(0);
  });
});
