--TEST--
New testcase for 93f65cd
--FILE--
<?php
error_reporting(E_ALL ^ E_WARNING);
for($iter = 0;$iter < 400; $iter++ )
{
   var_dump($iter);
   for($i=0;$i<10000;$i++)
   {
      $socket_array[$i] = pfsockopen('udp://127.0.0.1','63844');
      fwrite($socket_array[$i],"1");
   }
   for($i=1;$i<10000;$i++)
   {
      fclose($socket_array[$i]);
   }
   fwrite($socket_array[0],"1");
   fclose($socket_array[0]);
}?>
--EXPECT--
int(0)
int(1)
int(2)
int(3)
int(4)
int(5)
int(6)
int(7)
int(8)
int(9)
int(10)
int(11)
int(12)
int(13)
int(14)
int(15)
int(16)
int(17)
int(18)
int(19)
int(20)
int(21)
int(22)
int(23)
int(24)
int(25)
int(26)
int(27)
int(28)
int(29)
int(30)
int(31)
int(32)
int(33)
int(34)
int(35)
int(36)
int(37)
int(38)
int(39)
int(40)
int(41)
int(42)
int(43)
int(44)
int(45)
int(46)
int(47)
int(48)
int(49)
int(50)
int(51)
int(52)
int(53)
int(54)
int(55)
int(56)
int(57)
int(58)
int(59)
int(60)
int(61)
int(62)
int(63)
int(64)
int(65)
int(66)
int(67)
int(68)
int(69)
int(70)
int(71)
int(72)
int(73)
int(74)
int(75)
int(76)
int(77)
int(78)
int(79)
int(80)
int(81)
int(82)
int(83)
int(84)
int(85)
int(86)
int(87)
int(88)
int(89)
int(90)
int(91)
int(92)
int(93)
int(94)
int(95)
int(96)
int(97)
int(98)
int(99)
int(100)
int(101)
int(102)
int(103)
int(104)
int(105)
int(106)
int(107)
int(108)
int(109)
int(110)
int(111)
int(112)
int(113)
int(114)
int(115)
int(116)
int(117)
int(118)
int(119)
int(120)
int(121)
int(122)
int(123)
int(124)
int(125)
int(126)
int(127)
int(128)
int(129)
int(130)
int(131)
int(132)
int(133)
int(134)
int(135)
int(136)
int(137)
int(138)
int(139)
int(140)
int(141)
int(142)
int(143)
int(144)
int(145)
int(146)
int(147)
int(148)
int(149)
int(150)
int(151)
int(152)
int(153)
int(154)
int(155)
int(156)
int(157)
int(158)
int(159)
int(160)
int(161)
int(162)
int(163)
int(164)
int(165)
int(166)
int(167)
int(168)
int(169)
int(170)
int(171)
int(172)
int(173)
int(174)
int(175)
int(176)
int(177)
int(178)
int(179)
int(180)
int(181)
int(182)
int(183)
int(184)
int(185)
int(186)
int(187)
int(188)
int(189)
int(190)
int(191)
int(192)
int(193)
int(194)
int(195)
int(196)
int(197)
int(198)
int(199)
int(200)
int(201)
int(202)
int(203)
int(204)
int(205)
int(206)
int(207)
int(208)
int(209)
int(210)
int(211)
int(212)
int(213)
int(214)
int(215)
int(216)
int(217)
int(218)
int(219)
int(220)
int(221)
int(222)
int(223)
int(224)
int(225)
int(226)
int(227)
int(228)
int(229)
int(230)
int(231)
int(232)
int(233)
int(234)
int(235)
int(236)
int(237)
int(238)
int(239)
int(240)
int(241)
int(242)
int(243)
int(244)
int(245)
int(246)
int(247)
int(248)
int(249)
int(250)
int(251)
int(252)
int(253)
int(254)
int(255)
int(256)
int(257)
int(258)
int(259)
int(260)
int(261)
int(262)
int(263)
int(264)
int(265)
int(266)
int(267)
int(268)
int(269)
int(270)
int(271)
int(272)
int(273)
int(274)
int(275)
int(276)
int(277)
int(278)
int(279)
int(280)
int(281)
int(282)
int(283)
int(284)
int(285)
int(286)
int(287)
int(288)
int(289)
int(290)
int(291)
int(292)
int(293)
int(294)
int(295)
int(296)
int(297)
int(298)
int(299)
int(300)
int(301)
int(302)
int(303)
int(304)
int(305)
int(306)
int(307)
int(308)
int(309)
int(310)
int(311)
int(312)
int(313)
int(314)
int(315)
int(316)
int(317)
int(318)
int(319)
int(320)
int(321)
int(322)
int(323)
int(324)
int(325)
int(326)
int(327)
int(328)
int(329)
int(330)
int(331)
int(332)
int(333)
int(334)
int(335)
int(336)
int(337)
int(338)
int(339)
int(340)
int(341)
int(342)
int(343)
int(344)
int(345)
int(346)
int(347)
int(348)
int(349)
int(350)
int(351)
int(352)
int(353)
int(354)
int(355)
int(356)
int(357)
int(358)
int(359)
int(360)
int(361)
int(362)
int(363)
int(364)
int(365)
int(366)
int(367)
int(368)
int(369)
int(370)
int(371)
int(372)
int(373)
int(374)
int(375)
int(376)
int(377)
int(378)
int(379)
int(380)
int(381)
int(382)
int(383)
int(384)
int(385)
int(386)
int(387)
int(388)
int(389)
int(390)
int(391)
int(392)
int(393)
int(394)
int(395)
int(396)
int(397)
int(398)
int(399)
