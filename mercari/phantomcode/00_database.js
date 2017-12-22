const Sequelize = require('sequelize');
const sequelize = new Sequelize('scraping', 'root', 'hobbytera', { // databasename, username, password
  host: 'localhost',
  dialect: 'mysql',
  port: 3306,

  pool: {
    max: 5,
    min: 0,
    acquire: 30000,
    idle: 10000
  },

  // http://docs.sequelizejs.com/manual/tutorial/querying.html#operators
  operatorsAliases: false,
  logging: false
});

module.exports.sequelize = sequelize;

module.exports.Scrapeset = sequelize.define('scrapesets', {
  itemurl: Sequelize.STRING, // 商品URL
  delkeyword01: Sequelize.STRING, // 除外キーワード01
  delkeyword02: Sequelize.STRING, // 除外キーワード02
  delkeyword03: Sequelize.STRING, // 除外キーワード03
  delkeyword04: Sequelize.STRING, // 除外キーワード04
  delkeyword05: Sequelize.STRING // 除外キーワード05
}, {
  timestamps: false
});

module.exports.Mercari = sequelize.define('mercaris', {
  img01: Sequelize.STRING, // 商品画像URL1枚目（一覧表示のもの）
  img02: Sequelize.STRING, // 商品URL2枚目
  img03: Sequelize.STRING, // 商品URL3枚目
  img04: Sequelize.STRING, // 商品URL4枚目
  itemurl: Sequelize.STRING, // 商品URL
  jptitle: Sequelize.STRING, // 商品タイトル
  entitle: Sequelize.STRING, // ※こちらで使うもの
  price: Sequelize.STRING, // 商品価格
  jpdes: Sequelize.STRING, // 商品説明文
  stockstate: Sequelize.STRING, defaultValue: 'Active' // 販売中→Active 売り切れ→Out,
}, {
  timestamps: false
});
