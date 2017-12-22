GRANT ALL PRIVILEGES ON *.* TO 'root'@'%';

create database scraping character set UTF8 collate utf8_bin;
-- テーブル名（scrapesets）
-- id         :  int(11)  primary key
-- itemurl : varchar(100)　:  商品URL
-- delkeyword01: varchar(100)　:  除外キーワード01
-- delkeyword02: varchar(100)　:  除外キーワード02
-- delkeyword03: varchar(100)　:  除外キーワード03
-- delkeyword04: varchar(100)　:  除外キーワード04
-- delkeyword05: varchar(100)　:  除外キーワード05
create table scrapesets (
	id integer primary key not null auto_increment,
    itemurl varchar(500),
    delkeyword01 varchar(100),
    delkeyword02 varchar(100),
    delkeyword03 varchar(100),
    delkeyword04 varchar(100),
    delkeyword05 varchar(100)
);

-- テーブル名（mercaris）
-- id         :  int(11)  primary key
-- img01  : varchar(100)　:  商品画像URL1枚目（一覧表示のもの）
-- img02  : varchar(100)　:  商品URL2枚目
-- img03  : varchar(100)　:  商品URL3枚目
-- img04  : varchar(100)　:  商品URL4枚目
-- itemurl : varchar(100)　:  商品URL
-- jptitle   : varchar(200)　:  商品タイトル
-- entitle  :varchar(200)　：※こちらで使うもの
-- price    : varchar(50)　:  商品価格
-- jpdes   :  varchar(200)　:  商品説明文
-- stockstate : varchar(5) :  販売中→Active 売り切れ→Out
create table mercaris (
	id integer primary key not null auto_increment,
    img01 varchar(100),
    img02 varchar(100),
    img03 varchar(100),
    img04 varchar(100),
    itemurl varchar(100),
    jptitle varchar(200),
    entitle varchar(200),
    price varchar(50),
    jpdes varchar(1000),
    stockstate varchar(6)
);
