/*
SQLyog Community v12.4.1 (64 bit)
MySQL - 5.7.17-log : Database - turtlesmiracle_DB
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`turtlesmiracle_DB` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `turtlesmiracle_DB`;

/*Table structure for table `tbl_member` */

DROP TABLE IF EXISTS `tbl_member`;

CREATE TABLE `tbl_member` (
  `member_idx` int(11) NOT NULL AUTO_INCREMENT COMMENT '회원테이블 키',
  `member_no` varchar(45) DEFAULT NULL COMMENT '회원번호[멤버쉽카드번호]',
  `member_id` varchar(200) DEFAULT NULL COMMENT '회원 아이디(이메일형태)',
  `member_view_id` varchar(200) DEFAULT NULL COMMENT '회원 아이디(이메일형태): SNS가입시 필요한 view용 아이디',
  `member_pw` varchar(200) DEFAULT NULL COMMENT '회원 패스워드\n',
  `member_name` varchar(200) DEFAULT NULL COMMENT '회원명\n',
  `member_phone` varchar(200) DEFAULT NULL COMMENT '회원 휴대폰 번호\n',
  `member_birth` varchar(200) DEFAULT NULL COMMENT '회원생년월일\n',
  `member_img` varchar(200) DEFAULT NULL COMMENT '회원 이미지',
  `lunar_solar_birth` char(1) DEFAULT '0' COMMENT '(0): 양력, (1): 음력',
  `member_addr` varchar(300) DEFAULT NULL COMMENT '회원주소',
  `member_addr_detail` varchar(300) DEFAULT NULL COMMENT '회원주소 상세정보',
  `member_addr_postcode` varchar(45) DEFAULT NULL COMMENT '회원주소 우편번호',
  `member_join_type` char(1) DEFAULT NULL COMMENT '회원가입타입\nC:일반, K: 카카오톡, F:페이스북',
  `member_gender` char(1) DEFAULT NULL COMMENT '성별\n0:남성, 1:여성, 2:무관',
  `membership_grade` varchar(45) DEFAULT '0' COMMENT '멤버쉽 등급\n0: white, 1: red, 2: black, 3: gold',
  `member_point` int(11) DEFAULT '1000' COMMENT '멤버포인트점수\n\n',
  `member_leave_type` char(1) DEFAULT NULL COMMENT '회원탈퇴 사유',
  `member_leave_reason` varchar(500) DEFAULT NULL COMMENT '회원탈퇴 사유 (텍스트형식)',
  `event_alarm_yn` char(1) DEFAULT 'Y' COMMENT '이벤트 푸쉬알람 (N): 수신거부, (Y): 수신',
  `notice_alarm_yn` char(1) DEFAULT 'Y' COMMENT '공지사항 푸쉬알람 (N): 수신거부, (Y): 수신',
  `all_alarm_yn` char(1) DEFAULT 'Y' COMMENT '모든 푸쉬알람(N):수신거부 (Y):수신',
  `email_alarm_yn` char(1) DEFAULT 'Y' COMMENT '이메일알람 (N): 수신거부, (Y): 수신',
  `pw_key` varchar(100) DEFAULT NULL COMMENT '비밀번호 변경키',
  `member_additional_info` char(1) DEFAULT 'N' COMMENT 'N: 미입력, Y:입력 // SNS로그인 후 추가 정보 입력을 했는지 확인하는 구분자',
  `visit_route` char(1) DEFAULT NULL COMMENT '방문 경로 0:블로그, 1:소셜, 2:추천, 3:기타',
  `purpose_of_visit` char(1) DEFAULT NULL COMMENT '방문목적 0:어학,1:수능,2:자격증,3:공무원, 4:업무, 5:기타',
  `study_and_date` varchar(10) DEFAULT NULL COMMENT '공부 종료일',
  `full_room_count` int(3) DEFAULT NULL COMMENT '만석 연장 횟수',
  `last_full_room_date` datetime DEFAULT NULL COMMENT '마지막 만석 연장일',
  `full_room_corp_idx` int(11) DEFAULT NULL COMMENT '마지막 만석 연장 업체',
  `del_yn` char(1) DEFAULT 'N' COMMENT '삭제유무\n(N):정상, (Y)삭제\n',
  `gcm_key` varchar(200) DEFAULT NULL COMMENT 'GCM 키',
  `device_os` varchar(1) DEFAULT NULL COMMENT '모바일 OS: (I) IOS, (A) 안드로이드',
  `ins_date` datetime DEFAULT NULL COMMENT '등록일',
  `upd_date` datetime DEFAULT NULL COMMENT '수정일',
  PRIMARY KEY (`member_idx`),
  KEY `member_idx_UNIQUE` (`member_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COMMENT='회원멤버테이블';

/*Data for the table `tbl_member` */

insert  into `tbl_member`(`member_idx`,`member_no`,`member_id`,`member_view_id`,`member_pw`,`member_name`,`member_phone`,`member_birth`,`member_img`,`lunar_solar_birth`,`member_addr`,`member_addr_detail`,`member_addr_postcode`,`member_join_type`,`member_gender`,`membership_grade`,`member_point`,`member_leave_type`,`member_leave_reason`,`event_alarm_yn`,`notice_alarm_yn`,`all_alarm_yn`,`email_alarm_yn`,`pwd_key`,`member_additional_info`,`visit_route`,`purpose_of_visit`,`study_and_date`,`full_room_count`,`last_full_room_date`,`full_room_corp_idx`,`del_yn`,`gcm_key`,`device_os`,`ins_date`,`upd_date`) values
(1,NULL,'20000',NULL,'23f07656b76662e9ab4319fb37c922f5b58ef721753d33ef56f144374e0460137ea412c338559e8c0d4111743914ed847c7071660d989177d9a6799468708af3','ED80496659AF604028732672FB6377D3A690A6AF6DC50DA9B6EF5ED1222CEE44',NULL,NULL,'111','0','22','22','22',NULL,NULL,'0',1000,NULL,NULL,'N','Y','Y','N',NULL,'N','2','1','2018-02-01',NULL,NULL,NULL,'Y',NULL,'A',NULL,'2018-03-05 15:07:20'),
(3,NULL,'69A826E0952387065EA2F8B2FFE0BC482104F411BB12A1DBFB164088820F395D',NULL,'23f07656b76662e9ab4319fb37c922f5b58ef721753d33ef56f144374e0460137ea412c338559e8c0d4111743914ed847c7071660d989177d9a6799468708af3','A690A6AF6DC50DA9B6EF5ED1222CEE44','71C20AFC5F7208370E64CC3503CFE3F9','FF440380287EBC868F3427A62C65666B','12','0','962BAE4E63AF67F1B576BDD2928F20FB','A690A6AF6DC50DA9B6EF5ED1222CEE44','5DDDE2FB8DA966E0F6D43963C66F03C1','C','0','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N','1','2','2018-01-02',NULL,NULL,NULL,'N',NULL,NULL,'2017-12-24 18:29:01','2018-03-06 16:57:10'),
(4,NULL,'DF86E7603526C8AA49116A2F1D20B6DF274BB33DBDB31DBB42482B51B6D554BE',NULL,NULL,'ED80496659AF604028732672FB6377D3A690A6AF6DC50DA9B6EF5ED1222CEE44','71C20AFC5F7208370E64CC3503CFE3F9','FF440380287EBC868F3427A62C65666B',NULL,'0','B6BF71A42EFC079B218ED25CFB9BD0EA','AA6DDC637028BAFC27CC83216F2952D0','89D0B578CEE2C28E30681886E1933577','K','0','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N',NULL,NULL,'2017-12-24 18:37:18',NULL),
(5,NULL,'DF86E7603526C8AA49116A2F1D20B6DF274BB33DBDB31DBB42482B51B6D554BE',NULL,NULL,'ED80496659AF604028732672FB6377D3A690A6AF6DC50DA9B6EF5ED1222CEE44','71C20AFC5F7208370E64CC3503CFE3F9','FF440380287EBC868F3427A62C65666B',NULL,'0','B6BF71A42EFC079B218ED25CFB9BD0EA','AA6DDC637028BAFC27CC83216F2952D0','89D0B578CEE2C28E30681886E1933577','K','0','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N',NULL,NULL,'2017-12-24 18:38:01',NULL),
(6,NULL,'DF86E7603526C8AA49116A2F1D20B6DF274BB33DBDB31DBB42482B51B6D554BE',NULL,NULL,'ED80496659AF604028732672FB6377D3A690A6AF6DC50DA9B6EF5ED1222CEE44','71C20AFC5F7208370E64CC3503CFE3F9','FF440380287EBC868F3427A62C65666B',NULL,'0','B6BF71A42EFC079B218ED25CFB9BD0EA','AA6DDC637028BAFC27CC83216F2952D0','89D0B578CEE2C28E30681886E1933577','K','0','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N',NULL,NULL,'2017-12-24 18:39:27',NULL),
(7,NULL,'DF86E7603526C8AA49116A2F1D20B6DF274BB33DBDB31DBB42482B51B6D554BE',NULL,NULL,'ED80496659AF604028732672FB6377D3A690A6AF6DC50DA9B6EF5ED1222CEE44','71C20AFC5F7208370E64CC3503CFE3F9','FF440380287EBC868F3427A62C65666B',NULL,'0','B6BF71A42EFC079B218ED25CFB9BD0EA','AA6DDC637028BAFC27CC83216F2952D0','89D0B578CEE2C28E30681886E1933577','K','0','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N',NULL,NULL,'2017-12-24 18:39:43',NULL),
(8,NULL,'AA6FBAA44AC97EE002896F29011A2675274BB33DBDB31DBB42482B51B6D554BE',NULL,NULL,'ED80496659AF604028732672FB6377D3A690A6AF6DC50DA9B6EF5ED1222CEE44','71C20AFC5F7208370E64CC3503CFE3F9','FF440380287EBC868F3427A62C65666B',NULL,'0','B6BF71A42EFC079B218ED25CFB9BD0EA','AA6DDC637028BAFC27CC83216F2952D0','89D0B578CEE2C28E30681886E1933577','K','0','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N',NULL,NULL,'2017-12-24 18:47:01',NULL),
(9,NULL,'DF18D524C475B49B8FD013702B28C41A2104F411BB12A1DBFB164088820F395D',NULL,'23f07656b76662e9ab4319fb37c922f5b58ef721753d33ef56f144374e0460137ea412c338559e8c0d4111743914ed847c7071660d989177d9a6799468708af3','ED80496659AF604028732672FB6377D3A690A6AF6DC50DA9B6EF5ED1222CEE44','71C20AFC5F7208370E64CC3503CFE3F9','FF440380287EBC868F3427A62C65666B',NULL,'0','B6BF71A42EFC079B218ED25CFB9BD0EA','AA6DDC637028BAFC27CC83216F2952D0','89D0B578CEE2C28E30681886E1933577','C','0','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'Y',NULL,'A','2018-01-16 22:35:13','2018-01-26 15:41:20'),
(10,NULL,'55A6B90EFB71BAFCFEE1831847BBAB87',NULL,'68fc52132fe3e5e6869076548544118f456fe9f2a03d222b598395c6ddd402db47d5ed0fa6426617be9c4377ae00bfab91d2473f2e6315cd0672c147fe13ed7a','0F9DE38450F04D0A1A41F92CB02E79FD','F1846EFA2C9372C59E5D87561A573C8C','B26EB6F62C4D4CDE0105290C024A2476',NULL,'0','DE4CFBB30E695B0F556489E959E90A64','DE4CFBB30E695B0F556489E959E90A64','175CD480064D95493330C97E3A0159D6','C','1','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'Y',NULL,'A','2018-01-25 17:05:43','2018-02-02 10:19:53'),
(11,NULL,'4D103E25CE44F743677DF1DB444799F1',NULL,'55a5560f37d53fca2dd4de1032bdc3e1b4a2727c5caf70d80ad7cb30f715afafe415b3ebda3c70da8286734e54a9ea8f02e64fa11a72321e3670b35addbf3cfa','1E1E70AF7F3AE40C71F8D38D5785EF2C','F1846EFA2C9372C59E5D87561A573C8C','B26EB6F62C4D4CDE0105290C024A2476',NULL,'0','DE4CFBB30E695B0F556489E959E90A64','4C8215779112B5D87E97DB2035A139B3','175CD480064D95493330C97E3A0159D6','C','1','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N','3333333','A','2018-01-25 18:51:58','2018-01-25 18:52:19'),
(12,NULL,'4DE4547B7D4BF384980B1C9B786EEBA8',NULL,'303f052cc17c981c620713f8cd719b819ff3cf2e9215bc9cee418d787b9b68061dec594919ff6cc13543450b131011eccd08bf83194cd429988d7fe88f7465c0','C5B1C2D355162B7E15D5C7964622A9BF','F1846EFA2C9372C59E5D87561A573C8C','B26EB6F62C4D4CDE0105290C024A2476',NULL,'0','DE4CFBB30E695B0F556489E959E90A64','DE4CFBB30E695B0F556489E959E90A64','175CD480064D95493330C97E3A0159D6','C','1','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N',NULL,NULL,'2018-01-26 16:55:17',NULL),
(13,NULL,'A34180225C19683DF7700445EE4E26B8',NULL,'ab5aa2824c34472b1be850e8158196ba31e1a30e8f906214a749cb9a65321fd95f7cdae12f7db1b4ad6b73354eb1e6abbc30411faccc9cf9bbee02f61314977a','4FC6D0B8DC24A90A33C224C4D6B30944','F1846EFA2C9372C59E5D87561A573C8C','B26EB6F62C4D4CDE0105290C024A2476',NULL,'0','DE4CFBB30E695B0F556489E959E90A64','DE4CFBB30E695B0F556489E959E90A64','175CD480064D95493330C97E3A0159D6','C','1','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'Y',NULL,'A','2018-01-31 16:32:32','2018-01-31 16:33:09'),
(14,NULL,'2227534944D43F68F394AB6E6BC77C3A',NULL,'0bac14ce8442b36803e8e6623f3e55623ef766c54c6f405ff42d9b964ae134cb31df609c5485d95ebd801384a59022d0e563c302f3ebfec7bd9f7a69d45745f4','4C8215779112B5D87E97DB2035A139B3','F1846EFA2C9372C59E5D87561A573C8C','B26EB6F62C4D4CDE0105290C024A2476',NULL,'0','DE4CFBB30E695B0F556489E959E90A64','47B3218B540F1A29087CB98476E7C317','175CD480064D95493330C97E3A0159D6','C','1','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'Y',NULL,'A','2018-01-31 16:38:52','2018-01-31 16:39:22'),
(15,NULL,'3A75F13D1D99AFFB8B287CA938B9F170',NULL,'23f07656b76662e9ab4319fb37c922f5b58ef721753d33ef56f144374e0460137ea412c338559e8c0d4111743914ed847c7071660d989177d9a6799468708af3','5EB66D10D64CEAD9DE9A1C0A4DAD9120','F1846EFA2C9372C59E5D87561A573C8C','B26EB6F62C4D4CDE0105290C024A2476',NULL,'0','DE4CFBB30E695B0F556489E959E90A64','47B3218B540F1A29087CB98476E7C317','175CD480064D95493330C97E3A0159D6','C','1','0',1000,NULL,NULL,'Y','Y','Y','Y','YrPvG1lVpkYfwFMNLK4x9A3WVz6L7O3F','N',NULL,NULL,NULL,NULL,NULL,NULL,'Y',NULL,'A','2018-01-31 16:40:58','2018-03-06 11:10:14'),
(16,NULL,'A844725D2D436C3989CDDBA3D6EFBF7A',NULL,'150990c01ce3198086c91576d323046d5cd72c3846bb006c96ba4bbb2fea819e0c0be618b54da576daca212f10340c57ab2f09b46666f1e2c15056ae77b22527','D250C9FA48F36A17C5666355A0C5E610','F1846EFA2C9372C59E5D87561A573C8C','B26EB6F62C4D4CDE0105290C024A2476',NULL,'0','3C42C1A0F2217945D08160EA8BF01098','3C42C1A0F2217945D08160EA8BF01098','175CD480064D95493330C97E3A0159D6','C','1','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N','3333333','A','2018-01-31 16:56:50','2018-03-08 11:57:49'),
(17,NULL,'40E06ACD78769E64B854590900A5701C',NULL,'f6c5600ed1dbdcfdf829081f5417dccbbd2b9288e0b427e65c8cf67e274b69009cd142475e15304f599f429f260a661b5df4de26746459a3cef7f32006e5d1c1','0F9DE38450F04D0A1A41F92CB02E79FD','F1846EFA2C9372C59E5D87561A573C8C','B26EB6F62C4D4CDE0105290C024A2476',NULL,'0','904ADBCD568AB7C65D87DC967E22FC9B5F668E0EB07E8607C68EB6BF1E2AF1D2B9950194284778443ADDCDDF869CEDF8151D061E81D143B9E8CC2CE5B686A715A80C67442EF66F7747A4ABA541981000','8E8B79D5E92030C02803BDA1C6F467998959C18C4F1F81A08DF326157B2753DE','175CD480064D95493330C97E3A0159D6','C','1','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N','3333333','A','2018-02-13 18:25:54','2018-02-19 10:11:02'),
(18,NULL,'3FE594AC52E24C0908CD823E4A49E80CA7D5F4178A65B3E949BCA815044734C7',NULL,'cb6d5af95641916c26c493c4f4de656d4cbcc4103d4208f08addb36ebf84a2ea6b466bad00857ee5aeeb8bb41865f97ceab361a4d348b48db3ab3c59b2e0608e','A43141BB25A656A420323EF848215F2A','A690A6AF6DC50DA9B6EF5ED1222CEE44','A690A6AF6DC50DA9B6EF5ED1222CEE44',NULL,'0','55D0DC63E75781882FE32281D99BBC74','E626ED2230BC18505EA3B3E8F4CA57DD','4D3263D4FA8ACAB9758AD07A7BD0B947','C','','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N','abcdefg','I','2018-02-17 22:22:09','2018-02-23 10:38:24'),
(19,NULL,'AA6FBAA44AC97EE002896F29011A2675274BB33DBDB31DBB42482B51B6D554BE',NULL,'23f07656b76662e9ab4319fb37c922f5b58ef721753d33ef56f144374e0460137ea412c338559e8c0d4111743914ed847c7071660d989177d9a6799468708af3','ED80496659AF604028732672FB6377D3A690A6AF6DC50DA9B6EF5ED1222CEE44','A690A6AF6DC50DA9B6EF5ED1222CEE44','A690A6AF6DC50DA9B6EF5ED1222CEE44',NULL,'0','B6BF71A42EFC079B218ED25CFB9BD0EA','AA6DDC637028BAFC27CC83216F2952D0','89D0B578CEE2C28E30681886E1933577','C','','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N',NULL,NULL,'2018-02-19 10:21:33',NULL),
(20,NULL,'021921895CF33436030FD090D5B3BAF4',NULL,'617e115814675db57bd7fd21b2e5471d612583de968b29bf08b9aec647cbfbc3f90269f41151eaafed0cbdba0d3a0a1db79e0dab03b8f6f1c6af57e43e0426ed','A690A6AF6DC50DA9B6EF5ED1222CEE44','A690A6AF6DC50DA9B6EF5ED1222CEE44','A690A6AF6DC50DA9B6EF5ED1222CEE44','','0','962BAE4E63AF67F1B576BDD2928F20FB','A690A6AF6DC50DA9B6EF5ED1222CEE44','5DDDE2FB8DA966E0F6D43963C66F03C1','C','','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N','1','2','2018-01-02',NULL,NULL,NULL,'N','3333333','A','2018-02-19 10:25:14','2018-02-19 11:14:54'),
(21,NULL,'805D2091B16D4420447989084A9EB372',NULL,'4b0ab7b94e92a4f175774a4ad8a9a8c4d273671086ef091a689d63d3752a53ba043a1daf6204c9d4043b24bb42e18903029b43acd5efeabf7f368c26d532ab6e','A690A6AF6DC50DA9B6EF5ED1222CEE44','A690A6AF6DC50DA9B6EF5ED1222CEE44','A690A6AF6DC50DA9B6EF5ED1222CEE44','','0','962BAE4E63AF67F1B576BDD2928F20FB','A690A6AF6DC50DA9B6EF5ED1222CEE44','5DDDE2FB8DA966E0F6D43963C66F03C1','C','','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N','1','2','2018-01-02',NULL,NULL,NULL,'N','3333333','A','2018-02-19 11:13:42','2018-02-19 11:29:05'),
(22,NULL,'0DCB869C505662457EBDEAB5CAF7C64F274BB33DBDB31DBB42482B51B6D554BE',NULL,'23f07656b76662e9ab4319fb37c922f5b58ef721753d33ef56f144374e0460137ea412c338559e8c0d4111743914ed847c7071660d989177d9a6799468708af3','ED80496659AF604028732672FB6377D3A690A6AF6DC50DA9B6EF5ED1222CEE44','A690A6AF6DC50DA9B6EF5ED1222CEE44','A690A6AF6DC50DA9B6EF5ED1222CEE44',NULL,'0','B6BF71A42EFC079B218ED25CFB9BD0EA','AA6DDC637028BAFC27CC83216F2952D0','89D0B578CEE2C28E30681886E1933577','C','','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N',NULL,NULL,'2018-02-19 11:38:48',NULL),
(23,NULL,'98A15A787AFBA029FC623544255CDB06',NULL,'4b0ab7b94e92a4f175774a4ad8a9a8c4d273671086ef091a689d63d3752a53ba043a1daf6204c9d4043b24bb42e18903029b43acd5efeabf7f368c26d532ab6e','9D1BCD4E9ACF1834108E43CD8E27B063','A690A6AF6DC50DA9B6EF5ED1222CEE44','A690A6AF6DC50DA9B6EF5ED1222CEE44',NULL,'0','F81D206AE0E705A5D14AED889C3C989FFAFC53F6AEE843A06FE2B24934AF9189D38D0C1690467EB2A015413B0C5D4AB278BEC7FA7E1EFA7846333BAB81BEF066276AA06709111A070EF80EB092CFD6D4','50C47D0DD8D37376BDCA0BC454941B18','175CD480064D95493330C97E3A0159D6','C','','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,2,'N','3333333','A','2018-02-19 11:39:27','2018-02-19 11:39:41'),
(24,NULL,'728B7B20F7E6B34756E79BD7C8657697',NULL,'7de896b588a8efaf14ecf59bcf17e883194ecbc7115e259b435551d69dbaf17741f13aaab0a759567d9b6ff361b5354edb35204d41c651bb944d2d5405e5b1de','FA12583ECDD9A26E0782187D1679B7C0BC8ACCAC6EC40B9B3D93065EB9E65E55','A690A6AF6DC50DA9B6EF5ED1222CEE44','A690A6AF6DC50DA9B6EF5ED1222CEE44','','0','9BFD52FD4AD109D9ABB004DF85BE475C','1CCEFF1A26287495A304AA6ECC3B3DB5','A690A6AF6DC50DA9B6EF5ED1222CEE44','C','','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N','','','2016.02.03',13,'2018-03-09 15:46:46',3,'N','3333333','A','2018-02-19 11:42:03','2018-03-09 15:46:46'),
(25,NULL,'CA7DA9871C9A9AF2677FD5AF4947EC82A7D5F4178A65B3E949BCA815044734C7',NULL,'e21c5e433890694eb3df3b019c631b8b7ed6a35185bfbd9644eec5853534c0a01d5cd75a3d81e90bbf8f339f3a388dbca992f3d042d952206ef24e4c64d3f283','6F4CC5715D451B0134A538E458666701','A690A6AF6DC50DA9B6EF5ED1222CEE44','A690A6AF6DC50DA9B6EF5ED1222CEE44',NULL,'0','55D0DC63E75781882FE32281D99BBC74','E626ED2230BC18505EA3B3E8F4CA57DD','4D3263D4FA8ACAB9758AD07A7BD0B947','C','','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N','3333333','A','2018-02-26 10:31:19','2018-02-27 13:32:00'),
(26,NULL,'2B3BD0F1C138084022D478FC09FC678A',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'',NULL,'0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N','3333333','A','2018-02-26 21:38:44','2018-02-26 21:38:46'),
(27,NULL,'227718E0C1B9113F3EDA6A2EEA3EFC83',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'K',NULL,'0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N','3333333','A','2018-02-26 21:40:12','2018-02-27 09:40:43'),
(28,NULL,'6615640C90BDF530061F622BA1BB86FF',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'K',NULL,'0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N','3333333','A','2018-02-26 21:41:13','2018-02-26 21:41:39'),
(29,NULL,'B05FB41B31595169EC90ABDBF6914240',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'K',NULL,'0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N','3333333','A','2018-02-27 09:40:55','2018-02-27 09:41:01'),
(30,NULL,'CA7DA9871C9A9AF2677FD5AF4947EC82A7D5F4178A65B3E949BCA815044734C7',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'K',NULL,'0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N','abcdefg','I','2018-02-27 10:10:00','2018-02-27 17:58:50'),
(31,NULL,'CA7DA9871C9A9AF2677FD5AF4947EC82A7D5F4178A65B3E949BCA815044734C7',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'F',NULL,'0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N','abcdefg','I','2018-02-27 10:11:16','2018-02-27 11:30:45'),
(32,NULL,'21AE70057ED78C09D25A50593127038C2104F411BB12A1DBFB164088820F395D',NULL,'e21c5e433890694eb3df3b019c631b8b7ed6a35185bfbd9644eec5853534c0a01d5cd75a3d81e90bbf8f339f3a388dbca992f3d042d952206ef24e4c64d3f283','4EECC3756DE1D5A22DA37616CF3E4E6B','A690A6AF6DC50DA9B6EF5ED1222CEE44','A690A6AF6DC50DA9B6EF5ED1222CEE44',NULL,'0','55D0DC63E75781882FE32281D99BBC74','E626ED2230BC18505EA3B3E8F4CA57DD','4D3263D4FA8ACAB9758AD07A7BD0B947','C','','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N',NULL,NULL,'2018-02-27 10:34:55',NULL),
(33,NULL,'CA7DA9871C9A9AF2677FD5AF4947EC82A690A6AF6DC50DA9B6EF5ED1222CEE44',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'K',NULL,'0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N','abcdefg','I','2018-02-27 10:54:38','2018-02-27 11:23:33'),
(34,NULL,'BDA9F59B02130D4AEE1C7AE63394B8CE',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'K',NULL,'0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N','3333333','A','2018-02-27 10:56:51','2018-02-27 11:14:28'),
(35,NULL,'DBBE16C7A0CC5C88B5FA94F89552AA1E',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'K',NULL,'0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N','3333333','A','2018-02-27 11:14:30','2018-02-27 11:36:32'),
(36,NULL,'79AB9E034A6A06B2E52AF907B1D8619A93889683DE685C9970580E5BBF229D27',NULL,'66ce4a7289697a9e77b6ee4dbd6dfa1251ce9ecc2feb0c07bd8160faf0a8905c94cd49fc144a99a9b3303fd7cae03bc8e891e407625429d05f9869e6f873e69d','E4C13A91F31FD5D88174A01193100D0F53EF2BDD2A261172B365B8B78C9AFEA8','A690A6AF6DC50DA9B6EF5ED1222CEE44','A690A6AF6DC50DA9B6EF5ED1222CEE44',NULL,'0','23BBA08C5685BA6313FAC9B732538ABD840C743875D4D8F428E440675EADCC39D01FB3829A0D1BC7628F72B8457ABBDDF76842C977A42E85472B400D501C5BDA','FB0D2D70E4AA6A903BD490F1EDE52DF8','175CD480064D95493330C97E3A0159D6','C','','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N','3333333','A','2018-03-01 11:35:13','2018-03-11 17:55:17'),
(37,NULL,'4113B78B06E817AB1F47096E1826DC56274BB33DBDB31DBB42482B51B6D554BE',NULL,'a3e59c7d6248188bbe6ecce6070806c05c03e118a0aad1936c4bc304a4d7b31a23cfde9527a97f07f930f43d775156fd15f4542065ad933eb709105a1cb79408','A43141BB25A656A420323EF848215F2A','A690A6AF6DC50DA9B6EF5ED1222CEE44','A690A6AF6DC50DA9B6EF5ED1222CEE44',NULL,'0','55D0DC63E75781882FE32281D99BBC74','E626ED2230BC18505EA3B3E8F4CA57DD','4D3263D4FA8ACAB9758AD07A7BD0B947','C','','0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N','abcdefg','I','2018-03-04 10:10:58','2018-03-09 15:37:03'),
(38,NULL,'4113B78B06E817AB1F47096E1826DC56274BB33DBDB31DBB42482B51B6D554BE',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'',NULL,'0',1000,NULL,NULL,'Y','Y','Y','Y',NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,'N','abcdefg','I','2018-03-04 10:24:56','2018-03-11 08:03:01'),
(39,NULL,'50F24D4466864CF2C65642982D942820274BB33DBDB31DBB42482B51B6D554BE',NULL,'4f93e10119588840fda87ef5b218c24a26b95a7a08c33106b760bd4740c8b50b5ef763284380bc1c01f3414d20841a0663a28977d5b20a7e671afbf4e3bdfa7d','C4DD351469DCBBF63CDEC982ACAEF976','947EDA7F5F63B4D0DF72AA8CC2F68EEA','A690A6AF6DC50DA9B6EF5ED1222CEE44','','0','962BAE4E63AF67F1B576BDD2928F20FB','A690A6AF6DC50DA9B6EF5ED1222CEE44','A690A6AF6DC50DA9B6EF5ED1222CEE44','C','','0',1000,NULL,NULL,'Y','Y','Y','Y','','N','2','0','2016.02.03',NULL,NULL,NULL,'N','3333333','A','2018-03-06 11:18:56','2018-03-09 19:24:23');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
