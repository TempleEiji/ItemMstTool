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

function Uint8ArrToString(myUint8Arr){
  return myUint8Arr.toString('utf-8');
};

function removeNotNeedWord(clearStringInput, clearWordArr){
  var clearString = clearStringInput;

  for (var i = 0; i < clearWordArr.length; i++) {
    if( clearWordArr[i] && clearWordArr[i] != '' ) {
      clearString = clearString.replace(clearWordArr[i],'');
    }
  }

  return clearString;
};

myDB.Scrapeset.findAll({
  attributes: ['itemurl', 'delkeyword01', 'delkeyword02', 'delkeyword03', 'delkeyword04', 'delkeyword05']
}).then(function(scrapset) {
  if( scrapset.length == 0 )
    process.exit(0);

  var total = 0;
  var count = 0;

  for (id in scrapset) {
    var spawn = require('child_process').spawn;
    var args = [ basedir + "/phantomcode/00_scraping_item_list.js", scrapset[id].itemurl ];
    var options = {};

    var phantomExecutable = 'phantomjs';

    var child = spawn(phantomExecutable, args, options);

    child.stdout.on('data', function(data) {
      var textData = Uint8ArrToString(data);
      var urlArr = textData.split(':_:');

      total += urlArr.length;

      var spawn_child = require('child_process').spawn;
      var args_child = [ basedir + "/phantomcode/00_scraping.js", urlArr.join(':_:')];
      var options_child = {};

      var phantomExecutable_child = 'phantomjs';

      var child2 = spawn_child(phantomExecutable_child, args_child, options_child);

      child2.stdout.on('data', function(data) {
          var itemData = Uint8ArrToString(data);

          var headers = ['title', 'price', 'state', 'shipping', 'soldout', 'descrpt', 'img_0', 'img_1', 'img_2', 'img_3', 'url'];
          var data = itemData.split(':_:');
          var obj = {};

          for(var i = 0; i < data.length; i++) {
             obj[headers[i]] = data[i].trim();
          }

          if( obj['title'].length > 0 && obj['url'].length > 0) {
            obj['title'] = removeNotNeedWord(obj['title'], [
              scrapset[id].delkeyword01,
              scrapset[id].delkeyword02,
              scrapset[id].delkeyword03,
              scrapset[id].delkeyword04,
              scrapset[id].delkeyword05
            ]);

            obj['descrpt'] = removeNotNeedWord(obj['descrpt'], [
              scrapset[id].delkeyword01,
              scrapset[id].delkeyword02,
              scrapset[id].delkeyword03,
              scrapset[id].delkeyword04,
              scrapset[id].delkeyword05
            ]);

            myDB.Mercari.create({
              img01: obj['img_0'],
              img02: obj['img_1'],
              img03: obj['img_2'],
              img04: obj['img_3'],
              itemurl: obj['url'],
              jptitle: obj['title'],
              entitle: null,
              price: obj['price'],
              jpdes: obj['descrpt'],
              stockstate: "Active"
            })
            .then(item => {
              // console.log(item.toJSON());
            });
          }

          count++;
      });

      // Receive error output of the child process
      child2.stderr.on('data', function(err) {
        var textErr = Uint8ArrToString(err);
        console.log(textErr);
      });

      child2.stderr.on('close', function(err) {
        if (count >= total)
          process.exit(0);
      });

    });

    // Receive error output of the child process
    child.stderr.on('data', function(err) {
      var textErr = Uint8ArrToString(err);
      console.log(textErr);
    });
  }
});
