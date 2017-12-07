-- phpMyAdmin SQL Dump
-- version 4.0.10.17
-- https://www.phpmyadmin.net
--
-- ホスト: localhost
-- 生成日時: 2017 年 12 月 07 日 15:13
-- サーバのバージョン: 5.6.35-log
-- PHP のバージョン: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- データベース: `all_item_mst`
--
CREATE DATABASE IF NOT EXISTS `all_item_mst` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `all_item_mst`;

-- --------------------------------------------------------

--
-- テーブルの構造 `amasnuses`
--

CREATE TABLE IF NOT EXISTS `amasnuses` (
  `id` int(11) NOT NULL,
  `img01` varchar(100) NOT NULL,
  `img02` varchar(100) NOT NULL,
  `img03` varchar(100) NOT NULL,
  `img04` varchar(100) NOT NULL,
  `itemurl` varchar(100) NOT NULL,
  `jptitle` varchar(200) NOT NULL,
  `entitle` varchar(200) NOT NULL,
  `price` varchar(50) NOT NULL,
  `addprice` varchar(50) NOT NULL,
  `jpdes` varchar(200) NOT NULL,
  `endes` varchar(200) NOT NULL,
  `delflg` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `amazonuses`
--

CREATE TABLE IF NOT EXISTS `amazonuses` (
  `id` int(11) NOT NULL,
  `img01` varchar(100) NOT NULL,
  `img02` varchar(100) NOT NULL,
  `img03` varchar(100) NOT NULL,
  `img04` varchar(100) NOT NULL,
  `img05` varchar(100) NOT NULL,
  `img06` varchar(100) NOT NULL,
  `img07` varchar(100) NOT NULL,
  `itemurl` varchar(100) NOT NULL,
  `jptitle` varchar(200) NOT NULL,
  `entitle` varchar(200) NOT NULL,
  `price` varchar(50) NOT NULL,
  `addprice` varchar(50) NOT NULL,
  `jpdes` varchar(200) NOT NULL,
  `endes` varchar(200) NOT NULL,
  `delete` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `cataloglists`
--

CREATE TABLE IF NOT EXISTS `cataloglists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listno` int(11) NOT NULL,
  `listname` varchar(100) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `mekerid` int(10) NOT NULL,
  `categolyid` int(10) NOT NULL,
  `typeid` int(10) NOT NULL,
  `riekiritsu` varchar(20) NOT NULL COMMENT '1.5',
  `tesuryo` varchar(20) NOT NULL,
  `frontword` varchar(100) NOT NULL COMMENT '#figures #plush #japanitem',
  `backword` varchar(100) NOT NULL COMMENT '#hatsunemiku ',
  `ebayflg` varchar(10) NOT NULL COMMENT 'ok',
  PRIMARY KEY (`id`),
  KEY `listno` (`listno`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `categolylists`
--

CREATE TABLE IF NOT EXISTS `categolylists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categolyno` int(11) NOT NULL,
  `categolyname` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `categolytbl`
--

CREATE TABLE IF NOT EXISTS `categolytbl` (
  `cateno` int(10) NOT NULL,
  `catename` varchar(100) CHARACTER SET utf8 NOT NULL,
  `catenamejp` varchar(100) CHARACTER SET utf8 NOT NULL,
  `yahcateno` int(10) NOT NULL,
  `amacateno` int(10) NOT NULL,
  `keyword` varchar(200) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`cateno`),
  KEY `cate_no` (`cateno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- テーブルの構造 `clothing_tamplate`
--

CREATE TABLE IF NOT EXISTS `clothing_tamplate` (
  `item_sku` varchar(50) CHARACTER SET latin1 NOT NULL,
  `item_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `external_product_id_type` varchar(50) CHARACTER SET latin1 NOT NULL,
  `brand_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `product_subtype` varchar(50) CHARACTER SET latin1 NOT NULL,
  `part_number` varchar(50) CHARACTER SET latin1 NOT NULL,
  `product_description` varchar(50) CHARACTER SET latin1 NOT NULL,
  `update_delete` varchar(50) CHARACTER SET latin1 NOT NULL,
  `quantity` varchar(50) CHARACTER SET latin1 NOT NULL,
  `fulfillment_latency` varchar(50) CHARACTER SET latin1 NOT NULL,
  `condition_type` varchar(50) CHARACTER SET latin1 NOT NULL,
  `condition_note` varchar(50) CHARACTER SET latin1 NOT NULL,
  `standard_price` varchar(50) CHARACTER SET latin1 NOT NULL,
  `currency` varchar(50) CHARACTER SET latin1 NOT NULL,
  `product_site_launch_date` varchar(50) CHARACTER SET latin1 NOT NULL,
  `merchant_release_date` varchar(50) CHARACTER SET latin1 NOT NULL,
  `list_price` varchar(50) CHARACTER SET latin1 NOT NULL,
  `optional_payment_type_exclusion` varchar(50) CHARACTER SET latin1 NOT NULL,
  `delivery_schedule_group_id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `sale_price` varchar(50) CHARACTER SET latin1 NOT NULL,
  `sale_from_date` varchar(50) CHARACTER SET latin1 NOT NULL,
  `sale_end_date` varchar(50) CHARACTER SET latin1 NOT NULL,
  `restock_date` varchar(50) CHARACTER SET latin1 NOT NULL,
  `max_order_quantity` varchar(50) CHARACTER SET latin1 NOT NULL,
  `max_aggregate_ship_quantity` varchar(50) CHARACTER SET latin1 NOT NULL,
  `offering_can_be_gift_messaged` varchar(50) CHARACTER SET latin1 NOT NULL,
  `offering_can_be_giftwrapped` varchar(50) CHARACTER SET latin1 NOT NULL,
  `is_discontinued_by_manufacturer` varchar(50) CHARACTER SET latin1 NOT NULL,
  `missing_keyset_reason` varchar(50) CHARACTER SET latin1 NOT NULL,
  `website_shipping_weight_unit_of_measure` varchar(50) CHARACTER SET latin1 NOT NULL,
  `website_shipping_weight` varchar(50) CHARACTER SET latin1 NOT NULL,
  `bullet_point1` varchar(50) CHARACTER SET latin1 NOT NULL,
  `bullet_point2` varchar(50) CHARACTER SET latin1 NOT NULL,
  `bullet_point3` varchar(50) CHARACTER SET latin1 NOT NULL,
  `bullet_point4` varchar(50) CHARACTER SET latin1 NOT NULL,
  `bullet_point5` varchar(50) CHARACTER SET latin1 NOT NULL,
  `generic_keywords1` varchar(50) CHARACTER SET latin1 NOT NULL,
  `generic_keywords2` varchar(50) CHARACTER SET latin1 NOT NULL,
  `generic_keywords3` varchar(50) CHARACTER SET latin1 NOT NULL,
  `generic_keywords4` varchar(50) CHARACTER SET latin1 NOT NULL,
  `generic_keywords5` varchar(50) CHARACTER SET latin1 NOT NULL,
  `recommended_browse_nodes1` varchar(50) CHARACTER SET latin1 NOT NULL,
  `recommended_browse_nodes2` varchar(50) CHARACTER SET latin1 NOT NULL,
  `style_keywords1` varchar(50) CHARACTER SET latin1 NOT NULL,
  `style_keywords2` varchar(50) CHARACTER SET latin1 NOT NULL,
  `style_keywords3` varchar(50) CHARACTER SET latin1 NOT NULL,
  `style_keywords4` varchar(50) CHARACTER SET latin1 NOT NULL,
  `style_keywords5` varchar(50) CHARACTER SET latin1 NOT NULL,
  `platinum_keywords1` varchar(50) CHARACTER SET latin1 NOT NULL,
  `platinum_keywords2` varchar(50) CHARACTER SET latin1 NOT NULL,
  `platinum_keywords3` varchar(50) CHARACTER SET latin1 NOT NULL,
  `platinum_keywords4` varchar(50) CHARACTER SET latin1 NOT NULL,
  `platinum_keywords5` varchar(50) CHARACTER SET latin1 NOT NULL,
  `specific_uses_keywords` varchar(50) CHARACTER SET latin1 NOT NULL,
  `main_image_url` varchar(50) CHARACTER SET latin1 NOT NULL,
  `swatch_image_url` varchar(50) CHARACTER SET latin1 NOT NULL,
  `other_image_url1` varchar(50) CHARACTER SET latin1 NOT NULL,
  `other_image_url2` varchar(50) CHARACTER SET latin1 NOT NULL,
  `other_image_url3` varchar(50) CHARACTER SET latin1 NOT NULL,
  `other_image_url4` varchar(50) CHARACTER SET latin1 NOT NULL,
  `other_image_url5` varchar(50) CHARACTER SET latin1 NOT NULL,
  `other_image_url6` varchar(50) CHARACTER SET latin1 NOT NULL,
  `other_image_url7` varchar(50) CHARACTER SET latin1 NOT NULL,
  `other_image_url8` varchar(50) CHARACTER SET latin1 NOT NULL,
  `fulfillment_center_id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `package_length` varchar(50) CHARACTER SET latin1 NOT NULL,
  `package_width` varchar(50) CHARACTER SET latin1 NOT NULL,
  `package_length_unit_of_measure` varchar(50) CHARACTER SET latin1 NOT NULL,
  `package_height` varchar(50) CHARACTER SET latin1 NOT NULL,
  `package_weight` varchar(50) CHARACTER SET latin1 NOT NULL,
  `package_weight_unit_of_measure` varchar(50) CHARACTER SET latin1 NOT NULL,
  `parent_child` varchar(50) CHARACTER SET latin1 NOT NULL,
  `parent_sku` varchar(50) CHARACTER SET latin1 NOT NULL,
  `relationship_type` varchar(50) CHARACTER SET latin1 NOT NULL,
  `variation_theme` varchar(50) CHARACTER SET latin1 NOT NULL,
  `size_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `size_map` varchar(50) CHARACTER SET latin1 NOT NULL,
  `color_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `color_map` varchar(50) CHARACTER SET latin1 NOT NULL,
  `style_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `shoe_width` varchar(50) CHARACTER SET latin1 NOT NULL,
  `heel_height_unit_of_measure` varchar(50) CHARACTER SET latin1 NOT NULL,
  `heel_height` varchar(50) CHARACTER SET latin1 NOT NULL,
  `strap_type` varchar(50) CHARACTER SET latin1 NOT NULL,
  `toe_shape` varchar(50) CHARACTER SET latin1 NOT NULL,
  `waist_style` varchar(50) CHARACTER SET latin1 NOT NULL,
  `opacity` varchar(50) CHARACTER SET latin1 NOT NULL,
  `heel_type` varchar(50) CHARACTER SET latin1 NOT NULL,
  `shaft_height` varchar(50) CHARACTER SET latin1 NOT NULL,
  `outer_material_type` varchar(50) CHARACTER SET latin1 NOT NULL,
  `shaft_diameter` varchar(50) CHARACTER SET latin1 NOT NULL,
  `sleeve_type` varchar(50) CHARACTER SET latin1 NOT NULL,
  `closure_type` varchar(50) CHARACTER SET latin1 NOT NULL,
  `lifestyle1` varchar(50) CHARACTER SET latin1 NOT NULL,
  `lifestyle2` varchar(50) CHARACTER SET latin1 NOT NULL,
  `lifestyle3` varchar(50) CHARACTER SET latin1 NOT NULL,
  `lifestyle4` varchar(50) CHARACTER SET latin1 NOT NULL,
  `lifestyle5` varchar(50) CHARACTER SET latin1 NOT NULL,
  `fabric_type` varchar(50) CHARACTER SET latin1 NOT NULL,
  `department_name1` varchar(50) CHARACTER SET latin1 NOT NULL,
  `department_name2` varchar(50) CHARACTER SET latin1 NOT NULL,
  `is_adult_product` varchar(50) CHARACTER SET latin1 NOT NULL,
  `minimum_height_recommendation_unit_of_measure` varchar(50) CHARACTER SET latin1 NOT NULL,
  `minimum_height_recommendation` varchar(50) CHARACTER SET latin1 NOT NULL,
  `maximum_height_recommendation_unit_of_measure` varchar(50) CHARACTER SET latin1 NOT NULL,
  `maximum_height_recommendation` varchar(50) CHARACTER SET latin1 NOT NULL,
  `waist_size_unit_of_measure` varchar(50) CHARACTER SET latin1 NOT NULL,
  `waist_size` varchar(50) CHARACTER SET latin1 NOT NULL,
  `inseam_length_unit_of_measure` varchar(50) CHARACTER SET latin1 NOT NULL,
  `inseam_length` varchar(50) CHARACTER SET latin1 NOT NULL,
  `sleeve_length_unit_of_measure` varchar(50) CHARACTER SET latin1 NOT NULL,
  `sleeve_length` varchar(50) CHARACTER SET latin1 NOT NULL,
  `collar_style` varchar(50) CHARACTER SET latin1 NOT NULL,
  `neck_style` varchar(50) CHARACTER SET latin1 NOT NULL,
  `neck_size_unit_of_measure` varchar(50) CHARACTER SET latin1 NOT NULL,
  `neck_size` varchar(50) CHARACTER SET latin1 NOT NULL,
  `bottom_style` varchar(50) CHARACTER SET latin1 NOT NULL,
  `chest_size_unit_of_measure` varchar(50) CHARACTER SET latin1 NOT NULL,
  `chest_size` varchar(50) CHARACTER SET latin1 NOT NULL,
  `cup_size` varchar(50) CHARACTER SET latin1 NOT NULL,
  `furisode_length_unit_of_measure` varchar(50) CHARACTER SET latin1 NOT NULL,
  `furisode_length` varchar(50) CHARACTER SET latin1 NOT NULL,
  `furisode_width_unit_of_measure` varchar(50) CHARACTER SET latin1 NOT NULL,
  `furisode_width` varchar(50) CHARACTER SET latin1 NOT NULL,
  `obi_length_unit_of_measure` varchar(50) CHARACTER SET latin1 NOT NULL,
  `obi_length` varchar(50) CHARACTER SET latin1 NOT NULL,
  `obi_width_unit_of_measure` varchar(50) CHARACTER SET latin1 NOT NULL,
  `obi_width` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tsukeobi_width_unit_of_measure` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tsukeobi_width` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tsukeobi_height_unit_of_measure` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tsukeobi_height` varchar(50) CHARACTER SET latin1 NOT NULL,
  `pillow_size` varchar(50) CHARACTER SET latin1 NOT NULL,
  `pillow_size_unit_of_measure` varchar(50) CHARACTER SET latin1 NOT NULL,
  `model_year` varchar(50) CHARACTER SET latin1 NOT NULL,
  `seasons` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `cronschedules`
--

CREATE TABLE IF NOT EXISTS `cronschedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trigertime` varchar(11) NOT NULL,
  `listno` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `ebaysellerinfos`
--

CREATE TABLE IF NOT EXISTS `ebaysellerinfos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paypalemail` varchar(50) NOT NULL,
  `shopname` varchar(50) NOT NULL,
  `shippingprofilename` varchar(50) NOT NULL,
  `itemtemp_front` text NOT NULL,
  `itemtemp_center1` text NOT NULL,
  `itemtemp_center2` text NOT NULL,
  `itemtemp_center3` text NOT NULL,
  `itemtemp_back` text NOT NULL,
  `sandbox_devId` text NOT NULL,
  `sandbox_appId` text NOT NULL,
  `sandbox_certId` text NOT NULL,
  `sandbox_authToken` text NOT NULL,
  `sandbox_oauthUserToken` text NOT NULL,
  `sandbox_ruName` text NOT NULL,
  `production_devId` text NOT NULL,
  `production_appId` text NOT NULL,
  `production_certId` text NOT NULL,
  `production_authToken` text NOT NULL,
  `production_oauthUserToken` text NOT NULL,
  `production_ruName` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `itemlists`
--

CREATE TABLE IF NOT EXISTS `itemlists` (
  `id` int(11) NOT NULL,
  `img01` varchar(100) NOT NULL,
  `img02` varchar(100) NOT NULL,
  `img03` varchar(100) NOT NULL,
  `img04` varchar(100) NOT NULL,
  `itemurl` varchar(100) NOT NULL,
  `jptitle` varchar(200) NOT NULL,
  `entitle` varchar(200) NOT NULL,
  `price` varchar(50) NOT NULL,
  `addprice` varchar(50) NOT NULL,
  `jpdes` varchar(200) NOT NULL,
  `endes` varchar(200) NOT NULL,
  `delflg` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `makerlists`
--

CREATE TABLE IF NOT EXISTS `makerlists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `makerno` int(11) NOT NULL,
  `makername` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `mandaras`
--

CREATE TABLE IF NOT EXISTS `mandaras` (
  `id` int(11) NOT NULL,
  `ebayitemid` int(50) NOT NULL,
  `listno` int(50) NOT NULL,
  `img01` varchar(100) NOT NULL,
  `img02` varchar(100) NOT NULL,
  `img03` varchar(100) NOT NULL,
  `img04` varchar(100) NOT NULL,
  `itemurl` varchar(100) NOT NULL,
  `jptitle` varchar(200) NOT NULL,
  `entitle` varchar(200) NOT NULL,
  `price` varchar(50) NOT NULL,
  `jyuryou` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `endes` varchar(200) NOT NULL,
  `souryoudoru` varchar(50) NOT NULL,
  `goukeidoru` varchar(50) NOT NULL,
  `asin` varchar(50) NOT NULL,
  `jancode` varchar(50) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `condition` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `makername` varchar(100) NOT NULL,
  `delflg` varchar(4) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `stockstate` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ebayitemid` (`ebayitemid`),
  KEY `ebayitemid_2` (`ebayitemid`),
  KEY `id` (`id`),
  KEY `listno` (`listno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `mercaris`
--

CREATE TABLE IF NOT EXISTS `mercaris` (
  `id` int(11) NOT NULL,
  `img01` varchar(100) NOT NULL,
  `img02` varchar(100) NOT NULL,
  `img03` varchar(100) NOT NULL,
  `img04` varchar(100) NOT NULL,
  `itemurl` varchar(100) NOT NULL,
  `jptitle` varchar(200) NOT NULL,
  `entitle` varchar(200) NOT NULL,
  `price` varchar(50) NOT NULL,
  `addprice` varchar(50) NOT NULL,
  `jpdes` varchar(200) NOT NULL,
  `endes` varchar(200) NOT NULL,
  `delflg` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `mercari_mst`
--

CREATE TABLE IF NOT EXISTS `mercari_mst` (
  `no` int(5) NOT NULL,
  `url` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` varchar(50) NOT NULL,
  `searchkeyword` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  PRIMARY KEY (`no`),
  KEY `no` (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- テーブルの構造 `scrapesets`
--

CREATE TABLE IF NOT EXISTS `scrapesets` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `userid` varchar(50) NOT NULL,
  `getshopname` varchar(50) NOT NULL,
  `listname` varchar(100) NOT NULL,
  `url` varchar(200) NOT NULL,
  `delword1` varchar(100) NOT NULL,
  `delword2` varchar(100) NOT NULL,
  `delword3` varchar(100) NOT NULL,
  `delword4` varchar(100) NOT NULL,
  `delword5` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `shippinglists`
--

CREATE TABLE IF NOT EXISTS `shippinglists` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `method` varchar(50) NOT NULL,
  `jyuryou` int(50) NOT NULL COMMENT 'g',
  `price` int(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `typelists`
--

CREATE TABLE IF NOT EXISTS `typelists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeno` int(11) NOT NULL,
  `typename` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
