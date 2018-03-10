--wf sql dump program
--nginx/1.13.7
-- 
--DATE:2018-03-08 09:22:34
--MYSQL SERVER VERSION:5.6.21-log
--PHP VERSION:fpm-fcgi
--VOL:2


DROP TABLE IF EXISTS `%DB_PREFIX%follow`;
CREATE TABLE `%DB_PREFIX%follow` (
  `follow` int(10) unsigned NOT NULL COMMENT '关注id',
  `fans` int(10) unsigned NOT NULL COMMENT '粉丝ID',
  `gid` int(10) unsigned NOT NULL COMMENT '关注所属分组id',
  KEY `follow` (`follow`),
  KEY `fans` (`fans`),
  KEY `gid` (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户关注';
DROP TABLE IF EXISTS `%DB_PREFIX%keep`;
CREATE TABLE `%DB_PREFIX%keep` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '收藏用户ID',
  `time` int(10) unsigned NOT NULL COMMENT '收藏时间',
  `wid` int(11) NOT NULL COMMENT '微博ID',
  PRIMARY KEY (`id`),
  KEY `wid` (`wid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='收藏表';
DROP TABLE IF EXISTS `%DB_PREFIX%letter`;
CREATE TABLE `%DB_PREFIX%letter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL COMMENT '发信人ID',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '信息内容',
  `time` int(10) unsigned NOT NULL COMMENT '发送时间',
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='私信';
DROP TABLE IF EXISTS `%DB_PREFIX%luyan`;
CREATE TABLE `%DB_PREFIX%luyan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) DEFAULT NULL,
  `time` varchar(45) DEFAULT NULL,
  `danwei` varchar(255) DEFAULT NULL,
  `area` varchar(45) DEFAULT NULL,
  `guimo` varchar(45) DEFAULT NULL,
  `icon1` varchar(255) DEFAULT NULL,
  `readrow` int(11) DEFAULT '0',
  `create_time` varchar(45) DEFAULT NULL,
  `is_effect` tinyint(1) DEFAULT '1',
  `is_end` tinyint(1) DEFAULT '0',
  `brief` text,
  `zhubanfang` varchar(45) DEFAULT NULL,
  `zbfbrief` text,
  `icon2` varchar(255) DEFAULT NULL,
  `icon3` varchar(255) NOT NULL,
  `zixun` varchar(255) DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='路演';
INSERT INTO `%DB_PREFIX%luyan` VALUES ('4','2017华汶实业新品发布暨股权投资','2017.??.??','山东华汶股份有限公司','中国？？？','1000人','/public/uploads/image/20170626/201706261314054515.png','4844','1496815723','1','0','2017华汶实业新品发布暨股权投资第二期即将开展，敬请期待！','山东华汶股份有限公司','山东华汶实业股份有限公司成立于2012年10月，占地面积264000平方米（约为396亩），投入巨资打造国际先进化一流生产型企业，是集科研，生产，销售为一体的专业卫生护理用品企业，主要经营范围为生产、销售卫生用品材料、一次性卫生护理用品、卫生用品设备；货物进出口、技术进出口等。','/public/uploads/image/20170626/201706261314245516.png','/public/uploads/image/20170607/201706071408395868.png','','1');
INSERT INTO `%DB_PREFIX%luyan` VALUES ('5','2017华汶实业新品发布暨股权投资','2016.12.08','山东华汶股份有限公司','上海浦东新区塘桥喜来登大酒店','1000人','/public/uploads/image/20170626/201706261713388039.jpg','5','1498449791','1','1','2016华汶实业新品发布暨股权投资峰会于2016.12.08在中国上海召开，以新品发布及行业发展探讨主题，邀请了来自行业主管部门、互联网金融企业、传统金融机构、投资机构、社会高净值人群、主流媒体等近千人出席会议，共同探讨中国新实业的未来的发展之路。','山东华汶股份有限公司','山东华汶实业股份有限公司成立于2012年10月，占地面积264000平方米（约为396亩），投入巨资打造国际先进化一流生产型企业，是集科研，生产，销售为一体的专业卫生护理用品企业，主要经营范围为生产、销售卫生用品材料、一次性卫生护理用品、卫生用品设备；货物进出口、技术进出口等。','/public/uploads/image/20170626/201706261713232366.png','/public/uploads/image/20170626/201706261714201008.png','1','2');
DROP TABLE IF EXISTS `%DB_PREFIX%mailserver`;
CREATE TABLE `%DB_PREFIX%mailserver` (
  `smtp_server` varchar(255) NOT NULL,
  `smtp_name` varchar(255) NOT NULL,
  `smtp_pwd` varchar(255) NOT NULL,
  `smtp_auth` varchar(255) NOT NULL,
  `smtp_port` varchar(255) NOT NULL,
  `charset` varchar(255) NOT NULL,
  `secure` varchar(255) NOT NULL,
  `is_smtp` varchar(255) NOT NULL,
  PRIMARY KEY (`smtp_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='// 邮件服务器';
INSERT INTO `%DB_PREFIX%mailserver` VALUES ('smtp.qq.com','admin@yuewux.com','xdeoypteftpnbfcc','1','25','UTF-8','0','1');
DROP TABLE IF EXISTS `%DB_PREFIX%mobile_verify_code`;
CREATE TABLE `%DB_PREFIX%mobile_verify_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `verify_code` varchar(10) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `create_time` int(11) NOT NULL,
  `client_ip` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL COMMENT '邮件',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='//手机验证';
DROP TABLE IF EXISTS `%DB_PREFIX%msg_temp`;
CREATE TABLE `%DB_PREFIX%msg_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(255) NOT NULL COMMENT '名字',
  `content` text NOT NULL COMMENT '内容',
  `type` tinyint(1) NOT NULL COMMENT '类型',
  `is_html` tinyint(1) NOT NULL COMMENT '是否成功：1表示成功，0表示失败',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='// 邮箱验证';
INSERT INTO `%DB_PREFIX%msg_temp` VALUES ('1','TPL_MAIL_USER_PASSWORD','<table cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"\" width=\"100%\" style=\"background:#ffffff;\" class=\"baidu_pass\">\n<tbody>\n	<tr>\n		<td>\n		<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n		<tr>\n			<td style=\"background:#ffffff;border-bottom:2px solid #dfdfdf;width:15px;\">&nbsp;</td>\n			<td style=\"background:#ffffff;border-bottom:2px solid #ffffff;width:10px;\">&nbsp;</td>\n			<td style=\"background:#ffffff;width:137px;\"><img src=\"{$user.logo}\" class=\"logo\" ellpadding=\"0\" cellspacing=\"0\"></td>\n			<td style=\"background:#ffffff;border-bottom:2px solid #ffffff;width:10px;\">&nbsp;</td>\n			<td style=\"background:#ffffff;border-bottom:2px solid #dfdfdf;\">&nbsp;</td>\n		</tr>\n        </tbody>\n		</table>\n		</td>\n	</tr>\n	<tr>\n		<td>\n		<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n		<tr>\n			<td width=\"25px;\" style=\"width:25px;\"></td>\n			<td align=\"\">\n				<div style=\"line-height:40px;height:40px;\"></div>\n				<p style=\"margin:0px;padding:0px;\"><strong style=\"font-size:14px;line-height:24px;color:#333333;font-family:arial,sans-serif;\">亲爱的用户：</strong></p>\n 				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\">{$user.user_name}你好，请点击以下链接修改您的密码：</p>\n				<p style=\"margin:0px;padding:0px;\"><a href=\"{$user.password_url}\" style=\"line-height:24px;font-size:12px;font-family:arial,sans-serif;color:#0000cc\" target=\"_blank\">{$user.password_url}</a></p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#979797;font-family:arial,sans-serif;\">(如果您无法点击此链接，请将它复制到浏览器地址栏后访问)</p>\n				<div style=\"line-height:80px;height:80px;\"></div>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\">{$user.site_name}团队</p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\"><span style=\"border-bottom:1px dashed #ccc;\" t=\"5\" times=\"\">{$user.send_time}</span></p>\n			</td>\n		</tr>\n		</tbody>\n		</table>\n		</td>\n	</tr>\n \n</tbody>\n</table>','1','1');
INSERT INTO `%DB_PREFIX%msg_temp` VALUES ('3','TPL_MAIL_USER_VERIFY','<table cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"\" width=\"100%\" style=\"background:#ffffff;\" class=\"baidu_pass\">\n<tbody>\n	<tr>\n		<td>\n		<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n		<tr>\n			<td style=\"background:#ffffff;border-bottom:2px solid #dfdfdf;width:15px;\">&nbsp;</td>\n			<td style=\"background:#ffffff;border-bottom:2px solid #ffffff;width:10px;\">&nbsp;</td>\n			<td style=\"background:#ffffff;width:137px;\"><img src=\"{$user.logo}\" class=\"logo\" ellpadding=\"0\" cellspacing=\"0\"></td>\n			<td style=\"background:#ffffff;border-bottom:2px solid #ffffff;width:10px;\">&nbsp;</td>\n			<td style=\"background:#ffffff;border-bottom:2px solid #dfdfdf;\">&nbsp;</td>\n		</tr>\n        </tbody>\n		</table>\n		</td>\n	</tr>\n	<tr>\n		<td>\n		<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n		<tr>\n			<td width=\"25px;\" style=\"width:25px;\"></td>\n			<td align=\"\">\n				<div style=\"line-height:40px;height:40px;\"></div>\n				<p style=\"margin:0px;padding:0px;\"><strong style=\"font-size:14px;line-height:24px;color:#333333;font-family:arial,sans-serif;\">亲爱的用户：</strong></p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\">您好！</p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\">您于 {$user.send_time_ms} 帐号 发送验证码：</p>\n				<p style=\"margin:0px;padding:0px;\">验证码：{$user.send_code}</p>\n 				 \n				<div style=\"line-height:80px;height:80px;\"></div>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\">{$user.site_name}帐号团队</p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\"><span style=\"border-bottom:1px dashed #ccc;\" t=\"5\" times=\"\">{$user.send_time}</span></p>\n			</td>\n		</tr>\n		</tbody>\n		</table>\n		</td>\n	</tr>\n	<tr>\n		<td>\n			<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"border-top:1px solid #dfdfdf\">\n			<tbody>\n			<tr>\n				<td width=\"25px;\" style=\"width:25px;\"></td>\n				<td align=\"\">\n					<div style=\"line-height:40px;height:40px;\"></div>\n					<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#979797;font-family:\'宋体\',arial,sans-serif;\">若您没有注册过{$user.site_name}帐号，请忽略此邮件，此帐号将不会被激活，由此给您带来的不便请谅解。</p>\n				</td>\n			</tr>\n			</tbody>\n			</table>\n		</td>\n	</tr>\n</tbody>\n</table>','1','1');
INSERT INTO `%DB_PREFIX%msg_temp` VALUES ('20','注册成功通知','恭喜你{$success_user_info.user_name}，注册验证成功!','0','0');
INSERT INTO `%DB_PREFIX%msg_temp` VALUES ('23','短信验证码发送','您的手机号为{$verify.mobile},验证码为{$verify.code}','0','0');
INSERT INTO `%DB_PREFIX%msg_temp` VALUES ('4','TPL_MAIL_CHANGE_USER_VERIFY','<table cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"\" width=\"100%\" style=\"background:#ffffff;\" class=\"baidu_pass\">\n<tbody>\n	<tr>\n		<td>\n		<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n		<tr>\n			<td style=\"background:#ffffff;border-bottom:2px solid #dfdfdf;width:15px;\">&nbsp;</td>\n			<td style=\"background:#ffffff;border-bottom:2px solid #ffffff;width:10px;\">&nbsp;</td>\n			<td style=\"background:#ffffff;width:137px;\"><img src=\"{$user.logo}\" class=\"logo\" ellpadding=\"0\" cellspacing=\"0\"></td>\n			<td style=\"background:#ffffff;border-bottom:2px solid #ffffff;width:10px;\">&nbsp;</td>\n			<td style=\"background:#ffffff;border-bottom:2px solid #dfdfdf;\">&nbsp;</td>\n		</tr>\n        </tbody>\n		</table>\n		</td>\n	</tr>\n	<tr>\n		<td>\n		<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n		<tr>\n			<td width=\"25px;\" style=\"width:25px;\"></td>\n			<td align=\"\">\n				<div style=\"line-height:40px;height:40px;\"></div>\n				<p style=\"margin:0px;padding:0px;\"><strong style=\"font-size:14px;line-height:24px;color:#333333;font-family:arial,sans-serif;\">亲爱的用户：</strong></p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\">您好！</p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\">您于 {$user.send_time_ms} 进行邮件修改 <a href=\"mailto:{$user.email}\" target=\"_blank\">{$user.email}<wbr>.com</a> ，点击以下链接，即可进行下一步操作：</p>\n				<p style=\"margin:0px;padding:0px;\"><a href=\"{$user.verify_url}\" style=\"line-height:24px;font-size:12px;font-family:arial,sans-serif;color:#0000cc\" target=\"_blank\">{$user.verify_url}</a></p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#979797;font-family:arial,sans-serif;\">(如果您无法点击此链接，请将它复制到浏览器地址栏后访问)</p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\">1、为了保障您帐号的安全性，请在 48小时内完成激活，此链接将在您激活过一次后失效！</p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\">2、注册的帐号可以畅行{$user.site_name}产品</p>\n				<div style=\"line-height:80px;height:80px;\"></div>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\">{$user.site_name}帐号团队</p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\"><span style=\"border-bottom:1px dashed #ccc;\" t=\"5\" times=\"\">{$user.send_time}</span></p>\n			</td>\n		</tr>\n		</tbody>\n		</table>\n		</td>\n	</tr>\n	<tr>\n		<td>\n			<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"border-top:1px solid #dfdfdf\">\n			<tbody>\n			<tr>\n				<td width=\"25px;\" style=\"width:25px;\"></td>\n				<td align=\"\">\n					<div style=\"line-height:40px;height:40px;\"></div>\n					<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#979797;font-family:\'宋体\',arial,sans-serif;\">若您没有注册过{$user.site_name}帐号，请忽略此邮件，此帐号将不会被激活，由此给您带来的不便请谅解。</p>\n				</td>\n			</tr>\n			</tbody>\n			</table>\n		</td>\n	</tr>\n</tbody>\n</table>','1','1');
INSERT INTO `%DB_PREFIX%msg_temp` VALUES ('5','TPL_MAIL_INVESTOR_STATUS','<table cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"\" width=\"100%\" style=\"background:#ffffff;\" class=\"baidu_pass\">\n<tbody>\n	<tr>\n		<td>\n		<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n		<tr>\n			<td style=\"background:#ffffff;border-bottom:2px solid #dfdfdf;width:15px;\">&nbsp;</td>\n			<td style=\"background:#ffffff;border-bottom:2px solid #ffffff;width:10px;\">&nbsp;</td>\n			<td style=\"background:#ffffff;width:137px;\"><img src=\"{$user.logo}\" class=\"logo\" ellpadding=\"0\" cellspacing=\"0\"></td>\n			<td style=\"background:#ffffff;border-bottom:2px solid #ffffff;width:10px;\">&nbsp;</td>\n			<td style=\"background:#ffffff;border-bottom:2px solid #dfdfdf;\">&nbsp;</td>\n		</tr>\n        </tbody>\n		</table>\n		</td>\n	</tr>\n	<tr>\n		<td>\n		<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n		<tr>\n			<td width=\"25px;\" style=\"width:25px;\"></td>\n			<td align=\"\">\n				<div style=\"line-height:40px;height:40px;\"></div>\n				<p style=\"margin:0px;padding:0px;\"><strong style=\"font-size:14px;line-height:24px;color:#333333;font-family:arial,sans-serif;\">亲爱的用户：</strong></p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\">您好！</p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\">您于 {$user.send_time_ms} 进行{$user.is_investor_name}申请，{if $user.investor_status eq 1}很高兴您审核通过,点击以下链接，即可进行下一步操作{else}很遗憾您的申请未通过,理由是：{$user.investor_send_info};点击以下链接，即可重新申请{/if}：</p>\n				<p style=\"margin:0px;padding:0px;\"><a href=\"{$user.verify_url}\" style=\"line-height:24px;font-size:12px;font-family:arial,sans-serif;color:#0000cc\" target=\"_blank\">{$user.verify_url}</a></p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#979797;font-family:arial,sans-serif;\">(如果您无法点击此链接，请将它复制到浏览器地址栏后访问)</p>\n 				<div style=\"line-height:80px;height:80px;\"></div>\n 				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\"><span style=\"border-bottom:1px dashed #ccc;\" t=\"5\" times=\"\">{$user.send_time}</span></p>\n			</td>\n		</tr>\n		</tbody>\n		</table>\n		</td>\n	</tr>\n	<tr>\n		<td>\n			<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"border-top:1px solid #dfdfdf\">\n			<tbody>\n			<tr>\n				<td width=\"25px;\" style=\"width:25px;\"></td>\n				<td align=\"\">\n					<div style=\"line-height:40px;height:40px;\"></div>\n					<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#979797;font-family:\'宋体\',arial,sans-serif;\">若您没有注册过{$user.site_name}帐号，请忽略此邮件，此帐号将不会被激活，由此给您带来的不便请谅解。</p>\n				</td>\n			</tr>\n			</tbody>\n			</table>\n		</td>\n	</tr>\n</tbody>\n</table>','1','1');
INSERT INTO `%DB_PREFIX%msg_temp` VALUES ('25','TPL_MAIL_INVESTOR_PAY_STATUS','<table cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"\" width=\"100%\" style=\"background:#ffffff;\" class=\"baidu_pass\">\n<tbody>\n	<tr>\n		<td>\n		<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n		<tr>\n			<td style=\"background:#ffffff;border-bottom:2px solid #dfdfdf;width:15px;\">&nbsp;</td>\n			<td style=\"background:#ffffff;border-bottom:2px solid #ffffff;width:10px;\">&nbsp;</td>\n			<td style=\"background:#ffffff;width:137px;\"><img src=\"{$user.logo}\" class=\"logo\" ellpadding=\"0\" cellspacing=\"0\"></td>\n			<td style=\"background:#ffffff;border-bottom:2px solid #ffffff;width:10px;\">&nbsp;</td>\n			<td style=\"background:#ffffff;border-bottom:2px solid #dfdfdf;\">&nbsp;</td>\n		</tr>\n        </tbody>\n		</table>\n		</td>\n	</tr>\n	<tr>\n		<td>\n		<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n		<tr>\n			<td width=\"25px;\" style=\"width:25px;\"></td>\n			<td align=\"\">\n				<div style=\"line-height:40px;height:40px;\"></div>\n				<p style=\"margin:0px;padding:0px;\"><strong style=\"font-size:14px;line-height:24px;color:#333333;font-family:arial,sans-serif;\">亲爱的用户：</strong></p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\">您好！</p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\">{$user.user_name}您好，您的投资申请已通过，请在{$user.pay_end_time}前进行支付{$user.money}元;点击以下链接</p>\n				<p style=\"margin:0px;padding:0px;\"><a href=\"{$user.note_url}\" style=\"line-height:24px;font-size:12px;font-family:arial,sans-serif;color:#0000cc\" target=\"_blank\">{$user.note_url}</a></p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#979797;font-family:arial,sans-serif;\">(如果您无法点击此链接，请将它复制到浏览器地址栏后访问)</p>\n			</td>\n		</tr>\n		</tbody>\n		</table>\n		</td>\n	</tr>\n	<tr>\n		<td>\n			<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"border-top:1px solid #dfdfdf\">\n			<tbody>\n			<tr>\n				<td width=\"25px;\" style=\"width:25px;\"></td>\n				<td align=\"\">\n					<div style=\"line-height:40px;height:40px;\"></div>\n					<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#979797;font-family:\'宋体\',arial,sans-serif;\">若您没有注册过{$user.site_name}帐号，请忽略此邮件，由此给您带来的不便请谅解。</p>\n				</td>\n			</tr>\n			</tbody>\n			</table>\n		</td>\n	</tr>\n</tbody>\n</table>','1','1');
INSERT INTO `%DB_PREFIX%msg_temp` VALUES ('27','支付状态模板','恭喜您，已经支付{$user.paid_money}元,支付单号为{$user.notice_sn}','0','0');
INSERT INTO `%DB_PREFIX%msg_temp` VALUES ('28','TPL_MAIL_INVESTOR_PAID_STATUS','<table cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"\" width=\"100%\" style=\"background:#ffffff;\" class=\"baidu_pass\">\n<tbody>\n	<tr>\n		<td>\n		<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n		<tr>\n			<td style=\"background:#ffffff;border-bottom:2px solid #dfdfdf;width:15px;\">&nbsp;</td>\n			<td style=\"background:#ffffff;border-bottom:2px solid #ffffff;width:10px;\">&nbsp;</td>\n			<td style=\"background:#ffffff;width:137px;\"><img src=\"{$user.logo}\" class=\"logo\" ellpadding=\"0\" cellspacing=\"0\"></td>\n			<td style=\"background:#ffffff;border-bottom:2px solid #ffffff;width:10px;\">&nbsp;</td>\n			<td style=\"background:#ffffff;border-bottom:2px solid #dfdfdf;\">&nbsp;</td>\n		</tr>\n        </tbody>\n		</table>\n		</td>\n	</tr>\n	<tr>\n		<td>\n		<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n		<tr>\n			<td width=\"25px;\" style=\"width:25px;\"></td>\n			<td align=\"\">\n				<div style=\"line-height:40px;height:40px;\"></div>\n				<p style=\"margin:0px;padding:0px;\"><strong style=\"font-size:14px;line-height:24px;color:#333333;font-family:arial,sans-serif;\">亲爱的用户：</strong></p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\">您好！</p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\">{$user.user_name}您好，恭喜您，已经支付{$user.paid_money}元,支付单号为{$user.notice_sn}</p>\n				\n  				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\"><span style=\"border-bottom:1px dashed #ccc;\" t=\"5\" times=\"\">{$user.send_time}</span></p>\n			</td>\n		</tr>\n		</tbody>\n		</table>\n		</td>\n	</tr>\n	<tr>\n		<td>\n			<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"border-top:1px solid #dfdfdf\">\n			<tbody>\n			<tr>\n				<td width=\"25px;\" style=\"width:25px;\"></td>\n				<td align=\"\">\n					<div style=\"line-height:40px;height:40px;\"></div>\n					<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#979797;font-family:\'宋体\',arial,sans-serif;\">若您没有注册过{$user.site_name}帐号，请忽略此邮件，由此给您带来的不便请谅解。</p>\n				</td>\n			</tr>\n			</tbody>\n			</table>\n		</td>\n	</tr>\n</tbody>\n</table>','1','1');
INSERT INTO `%DB_PREFIX%msg_temp` VALUES ('30','TPL_MAIL_ZC_STATUS','<table cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"\" width=\"100%\" style=\"background:#ffffff;\" class=\"baidu_pass\">\n<tbody>\n	<tr>\n		<td>\n		<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n		<tr>\n			<td style=\"background:#ffffff;border-bottom:2px solid #dfdfdf;width:15px;\">&nbsp;</td>\n			<td style=\"background:#ffffff;border-bottom:2px solid #ffffff;width:10px;\">&nbsp;</td>\n			<td style=\"background:#ffffff;width:137px;\"><img src=\"{$user.logo}\" class=\"logo\" ellpadding=\"0\" cellspacing=\"0\"></td>\n			<td style=\"background:#ffffff;border-bottom:2px solid #ffffff;width:10px;\">&nbsp;</td>\n			<td style=\"background:#ffffff;border-bottom:2px solid #dfdfdf;\">&nbsp;</td>\n		</tr>\n        </tbody>\n		</table>\n		</td>\n	</tr>\n	<tr>\n		<td>\n		<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n        <tbody>\n		<tr>\n			<td width=\"25px;\" style=\"width:25px;\"></td>\n			<td align=\"\">\n				<div style=\"line-height:40px;height:40px;\"></div>\n				<p style=\"margin:0px;padding:0px;\"><strong style=\"font-size:14px;line-height:24px;color:#333333;font-family:arial,sans-serif;\">亲爱的用户：</strong></p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\">您好！</p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\">{$user.control_content}</p>\n				<p style=\"margin:0px;padding:0px;\"><a href=\"{$user.verify_url}\" style=\"line-height:24px;font-size:12px;font-family:arial,sans-serif;color:#0000cc\" target=\"_blank\">{$user.verify_url}</a></p>\n				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#979797;font-family:arial,sans-serif;\">(如果您无法点击此链接，请将它复制到浏览器地址栏后访问)</p>\n 				<div style=\"line-height:80px;height:80px;\"></div>\n 				<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:\'宋体\',arial,sans-serif;\"><span style=\"border-bottom:1px dashed #ccc;\" t=\"5\" times=\"\">{$user.send_time}</span></p>\n			</td>\n		</tr>\n		</tbody>\n		</table>\n		</td>\n	</tr>\n	<tr>\n		<td>\n			<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"border-top:1px solid #dfdfdf\">\n			<tbody>\n			<tr>\n				<td width=\"25px;\" style=\"width:25px;\"></td>\n				<td align=\"\">\n					<div style=\"line-height:40px;height:40px;\"></div>\n					<p style=\"margin:0px;padding:0px;line-height:24px;font-size:12px;color:#979797;font-family:\'宋体\',arial,sans-serif;\">若您没有注册过{$user.site_name}帐号，请忽略此邮件，此帐号将不会被激活，由此给您带来的不便请谅解。</p>\n				</td>\n			</tr>\n			</tbody>\n			</table>\n		</td>\n	</tr>\n</tbody>\n</table>','1','1');
DROP TABLE IF EXISTS `%DB_PREFIX%nav`;
CREATE TABLE `%DB_PREFIX%nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `blank` tinyint(1) NOT NULL,
  `sort` int(11) NOT NULL,
  `is_effect` tinyint(1) NOT NULL,
  `u_module` varchar(255) NOT NULL,
  `u_action` varchar(255) NOT NULL,
  `u_id` int(11) NOT NULL,
  `u_param` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COMMENT='//导航菜单列表';
INSERT INTO `%DB_PREFIX%nav` VALUES ('71','关于我们','about','1','6','1','','','0','   ');
INSERT INTO `%DB_PREFIX%nav` VALUES ('66','首页','','1','1','1','Index','','0','  ');
DROP TABLE IF EXISTS `%DB_PREFIX%picture`;
CREATE TABLE `%DB_PREFIX%picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mini` varchar(60) NOT NULL DEFAULT '' COMMENT '小图',
  `medium` varchar(60) NOT NULL DEFAULT '' COMMENT '中图',
  `max` varchar(60) NOT NULL DEFAULT '' COMMENT '大图',
  `wid` int(11) NOT NULL COMMENT '微博ID',
  PRIMARY KEY (`id`),
  KEY `wid` (`wid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微博图片';
DROP TABLE IF EXISTS `%DB_PREFIX%sms`;
CREATE TABLE `%DB_PREFIX%sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `server_url` text NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `config` text NOT NULL,
  `is_effect` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='// 短信';
INSERT INTO `%DB_PREFIX%sms` VALUES ('10','方维短信平台','','FW','http://sms.fanwe.com/','dahaocaifu','dahaocaifu123','N;','1');
INSERT INTO `%DB_PREFIX%sms` VALUES ('16','短信宝平台','','DXB','http://api.smsbao.com/','123','123','N;','0');
INSERT INTO `%DB_PREFIX%sms` VALUES ('18','海岩短信平台','','HY','http://www.duanxin10086.com/','F2792','123456','N;','0');
DROP TABLE IF EXISTS `%DB_PREFIX%system`;
CREATE TABLE `%DB_PREFIX%system` (
  `WEBNAME` varchar(255) NOT NULL DEFAULT '',
  `id` int(10) NOT NULL,
  `LOGOIMG` varchar(255) DEFAULT NULL,
  `SEO_TITLE` varchar(255) DEFAULT NULL,
  `SEO_KEYWORDS` text,
  `SEO_BRIEF` text,
  `COPY` varchar(255) DEFAULT NULL,
  `ICP` varchar(255) DEFAULT NULL,
  `TOTALDATA` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统设置';
INSERT INTO `%DB_PREFIX%system` VALUES ('天下正品官网','1','/public/uploads/image/20180308/201803080825462422.jpg','天下正品','天下正品','天下正品','Copyright ©-天下正品版权所有','沪ICP备16034773号-1','<script type=\"text/javascript\">var cnzz_protocol = ((\"https:\" == document.location.protocol) ? \" https://\" : \" http://\");document.write(unescape(\"%3Cspan id=\'cnzz_stat_icon_1260889981\'%3E%3C/span%3E%3Cscript src=\'\" + cnzz_protocol + \"s95.cnzz.com/z_stat.php%3Fid%3D1260889981%26show%3Dpic1\' type=\'text/javascript\'%3E%3C/script%3E\"));</script>');
DROP TABLE IF EXISTS `%DB_PREFIX%user`;
CREATE TABLE `%DB_PREFIX%user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `mobile` varchar(15) NOT NULL,
  `time` int(10) unsigned NOT NULL COMMENT '注册时间',
  `login_time` int(15) NOT NULL COMMENT '最后登录时间',
  `login_ip` varchar(255) NOT NULL COMMENT '登录ip',
  `lock` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '是否锁定0否1是',
  `source` text NOT NULL COMMENT '来源页面',
  `is_pc` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='用户表';
INSERT INTO `%DB_PREFIX%user` VALUES ('16','18698524659','fcd0b69322f65813be084484749bd709','18698524659','1498616808','1498715650','60.163.24.216','0','http://www.touzidake.com/login/login.html','0');
INSERT INTO `%DB_PREFIX%user` VALUES ('17','18170601638','e10adc3949ba59abbe56e057f20f883e','18170601638','1498703624','1498703624','60.163.24.216','0','https://www.touzidake.com/login/login.html','0');
DROP TABLE IF EXISTS `%DB_PREFIX%userinfo`;
CREATE TABLE `%DB_PREFIX%userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL DEFAULT '' COMMENT '用户昵称',
  `truename` varchar(45) DEFAULT NULL COMMENT '真实姓名',
  `sex` enum('男','女') NOT NULL DEFAULT '男' COMMENT '性别',
  `location` varchar(45) NOT NULL DEFAULT '' COMMENT '所在地',
  `constellation` char(45) NOT NULL DEFAULT '' COMMENT '星座',
  `intro` varchar(100) NOT NULL DEFAULT '' COMMENT '自我介绍',
  `face50` varchar(60) NOT NULL DEFAULT '' COMMENT '50*50头像',
  `face80` varchar(60) NOT NULL DEFAULT '' COMMENT '80*80头像',
  `face180` varchar(60) NOT NULL DEFAULT '' COMMENT '180*180头像',
  `style` varchar(45) NOT NULL DEFAULT 'default' COMMENT '默认模板',
  `follow` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关注数',
  `fans` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '粉丝数',
  `weibo` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布微博数',
  `uid` int(11) NOT NULL,
  `mobile` int(11) unsigned NOT NULL,
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `mobile` (`mobile`),
  KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='用户信息';
INSERT INTO `%DB_PREFIX%userinfo` VALUES ('2','admin','','男','','','','/Public/upload/face/20170329/min_1490766442.jpg','/Public/upload/face/20170329/mid_1490766442.jpg','/Public/upload/face/20170329/max_1490766442.jpg','default','0','0','0','4','0','');
INSERT INTO `%DB_PREFIX%userinfo` VALUES ('3','伺服阀','','男','','','','','','','default','0','0','0','5','0','');
INSERT INTO `%DB_PREFIX%userinfo` VALUES ('4','顶顶顶顶','','男','','','','','','','default','0','0','0','6','0','');
DROP TABLE IF EXISTS `%DB_PREFIX%video`;
CREATE TABLE `%DB_PREFIX%video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` varchar(45) DEFAULT NULL,
  `name` varchar(125) DEFAULT NULL,
  `video_unique` varchar(45) DEFAULT NULL,
  `img` varchar(225) DEFAULT NULL,
  `is_effect` tinyint(2) DEFAULT '1',
  `sort` int(11) DEFAULT '0',
  `brief` text,
  `content` text NOT NULL,
  `create_time` int(30) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `is_index` tinyint(2) NOT NULL,
  `is_hot` tinyint(2) NOT NULL COMMENT '热门',
  `readrow` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='视频';
INSERT INTO `%DB_PREFIX%video` VALUES ('7','44573897','全国中小企业股份转让系统简介','783a3bc2c4','/public/uploads/image/20170621/201706211106419199.png','1','1','','&lt;p&gt;\n	&lt;span style=&quot;font-family:\'Microsoft YaHei\';font-size:14px;color:#64451D;&quot;&gt;“新三板”市场原指中关村科技园区非上市股份有限公司进入代办股份系统进行转让试点，因挂牌企业均为高科技企业而不同于原转让系统内的退市企业及原STAQ、NET系统挂牌公司，故形象地称为“新三板”。&lt;/span&gt; \n&lt;/p&gt;\n&lt;p&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p&gt;\n	&lt;span style=&quot;font-family:\'Microsoft YaHei\';font-size:14px;color:#64451D;&quot;&gt;新三板的意义主要是针对公司的，会给该企业，公司带来很大的好处。目前，新三板不再局限于中关村科技园区非上市股份有限公司，也不局限于天津滨海、武汉东湖以及上海张江等试点地的非上市股份有限公司，而是全国性的非上市股份有限公司股权交易平台，主要针对的是中小微型企业。&lt;/span&gt; \n&lt;/p&gt;','1494784436','1498002347','1','0','550');
INSERT INTO `%DB_PREFIX%video` VALUES ('8','41227029','申视股份宣传片','c267871cb8','./public/attachment/201705/16/09/591a5a36eac74.png','0','2','','','1494870471','1497039119','0','0','746');
INSERT INTO `%DB_PREFIX%video` VALUES ('9','43947728','五分钟看懂股权投资！','81ec16a877','/public/uploads/image/20170621/201706211106248253.png','1','4','','&lt;div class=&quot;content-item content-text-item&quot; style=&quot;margin:0px 0px 0.18rem;padding:0px;border:0px;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;span style=&quot;font-size:16px;font-family:\'Microsoft YaHei\';&quot;&gt;&lt;span style=&quot;color:#CCCCCC;&quot;&gt;&lt;/span&gt;&lt;span style=&quot;color:#64451D;font-size:14px;font-family:\'Microsoft YaHei\';&quot;&gt;在中国，如果你有车有房有保障，工作稳定有存款，那么恭喜你已经步入了中产阶级的行列。那中产阶级如何配置资产、保值增值呢？存银行？炒房产？买股票?做理财？ 选择那么多，到底应该怎么做资产配置？&lt;/span&gt;&lt;/span&gt; \n&lt;/div&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;span style=&quot;color:#CCCCCC;&quot;&gt;&lt;/span&gt; \n&lt;/p&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;strong&gt;&lt;span style=&quot;font-size:16px;font-family:\'Microsoft YaHei\';color:#337FE5;&quot;&gt;&lt;span style=&quot;color:#64451D;&quot;&gt;&lt;/span&gt;&lt;br /&gt;\n&lt;/span&gt;&lt;/strong&gt; \n&lt;/p&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;strong&gt;&lt;span style=&quot;font-size:14px;font-family:\'Microsoft YaHei\';color:#E56600;&quot;&gt;2016年两会特别提到了一种投资方式——股权投资&lt;/span&gt;&lt;/strong&gt; \n&lt;/p&gt;\n&lt;div class=&quot;content-item content-text-item&quot; style=&quot;margin:0px 0px 0.18rem;padding:0px;border:0px;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;span style=&quot;font-size:14px;font-family:\'Microsoft YaHei\';color:#64451D;&quot;&gt;两会中李总理对于股权投资行业带来了一系列的利好政策：一是总理鼓励股权投资基金的设立；二是引导股权投资基金良性发展。&lt;/span&gt; \n&lt;/div&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;span style=&quot;font-size:14px;font-family:\'Microsoft YaHei\';color:#64451D;&quot;&gt;在此背景之下，我们已经悄悄地进入了一个浩瀚辽阔的股权市场时代。随着“大众创业、万众创新”国家战略的推进，股权市场即将全面爆发能量。&lt;/span&gt; \n&lt;/p&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;span style=&quot;font-size:14px;font-family:\'Microsoft YaHei\';color:#64451D;&quot;&gt;央行行长周小川也积极倡导股权投资，希望有更大比例储蓄进入股本市场，并鼓励中国中小企业大力发展股权融资。股权投资为新三板的主要投资方式，企业增资扩股不仅能分散经营风险，且更利于吸引资本的目光。&lt;/span&gt; \n&lt;/p&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;strong&gt;&lt;span style=&quot;font-size:14px;font-family:\'Microsoft YaHei\';color:#E56600;&quot;&gt;那么股权投资有什么优势呢？&lt;/span&gt;&lt;/strong&gt; \n&lt;/p&gt;\n&lt;div class=&quot;content-item content-text-item&quot; style=&quot;margin:0px 0px 0.18rem;padding:0px;border:0px;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;span style=&quot;font-size:14px;font-family:\'Microsoft YaHei\';color:#64451D;&quot;&gt;未来的变化趋势和方向，我们要特别关注股权市场的发展：股权投资者可能成为未来最大赢家。&lt;/span&gt; \n&lt;/div&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;strong&gt;&lt;span style=&quot;font-size:14px;font-family:\'Microsoft YaHei\';color:#E56600;&quot;&gt;股权投资是布局未来的最佳方式。&lt;/span&gt;&lt;/strong&gt; \n&lt;/p&gt;\n&lt;div class=&quot;content-item content-text-item&quot; style=&quot;margin:0px 0px 0.18rem;padding:0px;border:0px;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;span style=&quot;font-size:14px;font-family:\'Microsoft YaHei\';color:#64451D;&quot;&gt;我们应当清醒地认识到，在大转折时代，投资传统领域、主流行业和大型企业，极有可能产生负面效应，甚至灾难性后果。&lt;/span&gt; \n&lt;/div&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;span style=&quot;line-height:1.5;font-size:14px;font-family:\'Microsoft YaHei\';color:#64451D;&quot;&gt;孙正义曾经说过，越是迷茫，越要向远看。2000年他以2000万美元投资，到2015年阿里巴巴纽交所上市市值达到588亿美元，涨幅2900倍，成为日本首富。&lt;/span&gt; \n&lt;/p&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;strong&gt;&lt;span style=&quot;font-size:14px;font-family:\'Microsoft YaHei\';color:#E56600;&quot;&gt;股权投资具有非常广阔的选择空间。&lt;/span&gt;&lt;/strong&gt; \n&lt;/p&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;span style=&quot;font-size:14px;font-family:\'Microsoft YaHei\';color:#64451D;&quot;&gt;特别值得一提的是，股权投资实际上是在分享企业家的智慧和成果。企业家是一国的最稀缺资源，能够发现普通人看不见的机会并通过组织管理变成财富。如果通过股权投资找到了企业家，我们就能伴随企业家巨人一起成长。&lt;/span&gt; \n&lt;/p&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;strong&gt;&lt;span style=&quot;font-size:14px;font-family:\'Microsoft YaHei\';color:#E56600;&quot;&gt;股权投资比买卖股票具有天然的成本优势。&lt;/span&gt;&lt;/strong&gt; \n&lt;/p&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;span style=&quot;font-size:14px;font-family:\'Microsoft YaHei\';color:#64451D;&quot;&gt;股权的本质是原始股，没有包装，也不需要进行股份切割，没有公开交易进行边际定价，大大降低了成本。&lt;/span&gt; \n&lt;/p&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;strong&gt;&lt;span style=&quot;font-size:14px;font-family:\'Microsoft YaHei\';color:#E56600;&quot;&gt;股权投资的核心要素是团队、机制和行业位次。&lt;/span&gt;&lt;/strong&gt; \n&lt;/p&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;span style=&quot;font-size:14px;font-family:\'Microsoft YaHei\';color:#64451D;&quot;&gt;一个企业是否优秀、能否卓越，不在自身好坏，关键在其细分市场的排序位次，处于中后位的企业收入再高也只是窗口性机会。&lt;/span&gt; \n&lt;/p&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p style=&quot;vertical-align:baseline;text-align:justify;&quot;&gt;\n	&lt;span style=&quot;font-size:14px;font-family:\'Microsoft YaHei\';color:#64451D;&quot;&gt;这是一个大金融的时代，不懂金融知识的投资者，最终将被这个时代遗弃到一无所有，很多人输就输在，对于新兴事物第一看不见，第二看不起，第三看不懂，第四来不及。股权又一个引领世界的创富神话，百年不遇的一个商机一个可以改变一生机遇就看你能否抓住。&lt;/span&gt; \n&lt;/p&gt;','1494870511','1498000393','1','0','611');
INSERT INTO `%DB_PREFIX%video` VALUES ('10','44616983','新三板——打造中国的纳斯达克！','5b9f5effb2','/public/uploads/image/20170621/201706211105545559.png','1','3','','&lt;p style=&quot;font-family:微软雅黑;text-align:justify;&quot;&gt;\n	&lt;span style=&quot;font-family:\'Microsoft YaHei\';font-size:14px;color:#64451D;&quot;&gt;新三板作为国家“大众创新，万众创新”战略的重要资本平台，为中小民营企业打开了一条直接融资的渠道，解决了中小企业融资难，融资贵等问题。新三板设立的原因就是为了更好的服务于国家发展战略，无论是从多层次资本市场的建设，还是创新型国家构建的发展思路，它都具有国家战略的高度。&lt;/span&gt;&lt;br class=&quot;&quot; /&gt;\n&lt;br class=&quot;&quot; /&gt;\n&lt;span style=&quot;font-family:\'Microsoft YaHei\';font-size:14px;color:#64451D;&quot;&gt;目前中国经济结构正处于急剧转型阶段，即从过去改革开放30年平均增速10%左右的增速，转为7%-8%，甚至5%-6%的中高速时期。但凡是进入高收入国家的经济体，比如美国、日本等，几乎无一例外地都出现增长速度较大的回落，中国也正经历着这一阶段。其中典型例子是钢铁、汽车、发电量指标的回落。&lt;/span&gt;&lt;span style=&quot;line-height:1.5;font-family:\'Microsoft YaHei\';font-size:14px;color:#64451D;&quot;&gt;尽管目前经济增速在下滑，但是就业在快速增长，原因是目前中国的新兴产业正在快速增长，成为推动中国新的经济增长点，中国正在摆脱以往“高增长，高污染，高能耗”的经济模式，转变“先污染，后治理”模式已刻不容缓。&lt;/span&gt; \n&lt;/p&gt;\n&lt;p style=&quot;font-family:微软雅黑;text-align:justify;&quot;&gt;\n	&lt;br /&gt;\n&lt;/p&gt;\n&lt;p style=&quot;font-family:微软雅黑;text-align:justify;&quot;&gt;\n	&lt;span style=&quot;font-family:\'Microsoft YaHei\';font-size:14px;color:#64451D;&quot;&gt;再者中小企业要做大、做强，无非第一目标就是要解决融资难的问题，想获得更多的融资渠道，就必须走资本市场的道路。然而创业板的高上市门槛并未能解决初创期高科技企业的融资问题，国家为了救市暂缓IPO,中小企业融资的希望又转头寄托在了新三板身上，纷纷转战新三板，而新三板的低门槛、不设财务指标的备案制度才是中小企业在这一融资平台上做大、做强的不二选择，而这样的大背景正是新三板市场后续发展的坚实基础。因此，国家实际上是希望将新三板打造成中国版的纳斯达克。&lt;/span&gt;&lt;span style=&quot;font-family:\'Microsoft YaHei\';font-size:14px;color:#64451D;&quot;&gt;&lt;/span&gt; \n&lt;/p&gt;','1494887989','1498002136','0','1','495');
DROP TABLE IF EXISTS `%DB_PREFIX%weibo`;
CREATE TABLE `%DB_PREFIX%weibo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '微博内容',
  `istrun` int(11) NOT NULL DEFAULT '0' COMMENT '是否转发0原创，如果是转发则保存该微博ID',
  `time` int(11) NOT NULL COMMENT '发布时间',
  `turn` int(11) NOT NULL DEFAULT '0' COMMENT '转发',
  `keep` int(11) NOT NULL DEFAULT '0' COMMENT '收藏',
  `comment` int(11) NOT NULL DEFAULT '0' COMMENT '评论条数',
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微博表';
DROP TABLE IF EXISTS `%DB_PREFIX%yuyue`;
CREATE TABLE `%DB_PREFIX%yuyue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(500) NOT NULL,
  `area` varchar(255) NOT NULL,
  `create_time` int(50) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `is_new` tinyint(1) NOT NULL DEFAULT '1',
  `source` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
