SET NAMES utf8;
SET foreign_key_checks = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- --------------------------------------------------------

--
-- 表的结构 `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT 0,
  `total` decimal(12,2) NOT NULL DEFAULT 0,
  `method` varchar(64) NOT NULL DEFAULT '支付宝',
  `tradeno` varchar(128),
  `renew` int(11) NOT NULL DEFAULT 1,
  `datetime` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `order`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
