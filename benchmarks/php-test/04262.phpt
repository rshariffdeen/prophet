--TEST--
DateTime::diff() add() sub() -- fall type3 type2
--CREDITS--
Daniel Convissor <danielc@php.net>
--XFAIL--
PHP < 5.4 has bugs
--FILE--
<?php

/*
 * Note: test names match method names in a set of PHPUnit tests
 * in a userland package.  Please be so kind as to leave them.
 */

require 'examine_diff.inc';
date_default_timezone_set('America/New_York');


/*
 * Time, Fall, Zone Type 3 to Zone Type 2
 *
 * + prev: the day before the transition day  2010-11-06 18:38:28 EDT
 * + dt: daylight time on transition day      2010-11-07 00:10:20 EDT
 * + redodt: daylight time in the redo period 2010-11-07 01:12:33 EDT
 * + redost: standard time in the redo period 2010-11-07 01:14:44 EST
 * + st: standard time on the transition day  2010-11-07 03:16:55 EST
 * + post: the day after the transition day   2010-11-08 19:59:59 EST
 */
echo "test_time_fall_type3_prev_type2_prev: ";
$end   = new DateTime('2010-11-06 18:38:28 EDT');  // prev, zt2
$start = new DateTime('2010-10-04 02:18:48');  // sp prev, zt3
examine_diff($end, $start, 'P+0Y1M2DT16H19M40S', 33);

echo "test_time_fall_type3_prev_type2_dt: ";
$end   = new DateTime('2010-11-07 00:10:20 EDT');  // dt, zt2
$start = new DateTime('2010-11-06 18:38:28');  // prev, zt3
examine_diff($end, $start, 'P+0Y0M0DT5H31M52S', 0);

echo "test_time_fall_type3_prev_type2_redodt: ";
$end   = new DateTime('2010-11-07 01:12:33 EDT');  // redodt, zt2
$end->setTimezone(new DateTimeZone('America/New_York'));  // zt2 -> zt3
$start = new DateTime('2010-11-06 18:38:28');  // prev, zt3
examine_diff($end, $start, 'P+0Y0M0DT6H34M5S', 0);

echo "test_time_fall_type3_prev_type2_redost: ";
$end   = new DateTime('2010-11-07 01:14:44 EST');  // redost, zt2
$end->setTimezone(new DateTimeZone('America/New_York'));  // zt2 -> zt3
$start = new DateTime('2010-11-06 18:38:28');  // prev, zt3
examine_diff($end, $start, 'P+0Y0M0DT7H36M16S', 0);

echo "test_time_fall_type3_prev_type2_st: ";
$end   = new DateTime('2010-11-07 03:16:55 EST');  // st, zt2
$start = new DateTime('2010-11-06 18:38:28');  // prev, zt3
examine_diff($end, $start, 'P+0Y0M0DT9H38M27S', 0);

echo "test_time_fall_type3_prev_type2_post: ";
$end   = new DateTime('2010-11-08 19:59:59 EST');  // post, zt2
$start = new DateTime('2010-11-06 18:38:28');  // prev, zt3
examine_diff($end, $start, 'P+0Y0M2DT1H21M31S', 2);

echo "test_time_fall_type3_dt_type2_prev: ";
$end   = new DateTime('2010-11-06 18:38:28 EDT');  // prev, zt2
$start = new DateTime('2010-11-07 00:10:20');  // dt, zt3
examine_diff($end, $start, 'P-0Y0M0DT5H31M52S', 0);

echo "test_time_fall_type3_dt_type2_dt: ";
$end   = new DateTime('2010-11-07 00:15:35 EDT');  // sp dt, zt2
$start = new DateTime('2010-11-07 00:10:20');  // dt, zt3
examine_diff($end, $start, 'P+0Y0M0DT0H5M15S', 0);

echo "test_time_fall_type3_dt_type2_redodt: ";
$end   = new DateTime('2010-11-07 01:12:33 EDT');  // redodt, zt2
$start = new DateTime('2010-11-07 00:10:20');  // dt, zt3
examine_diff($end, $start, 'P+0Y0M0DT1H2M13S', 0);

echo "test_time_fall_type3_dt_type2_redost: ";
$end   = new DateTime('2010-11-07 01:14:44 EST');  // redost, zt2
$start = new DateTime('2010-11-07 00:10:20');  // dt, zt3
examine_diff($end, $start, 'P+0Y0M0DT2H4M24S', 0);

echo "test_time_fall_type3_dt_type2_st: ";
$end   = new DateTime('2010-11-07 03:16:55 EST');  // st, zt2
$start = new DateTime('2010-11-07 00:10:20');  // dt, zt3
examine_diff($end, $start, 'P+0Y0M0DT4H6M35S', 0);

echo "test_time_fall_type3_dt_type2_post: ";
$end   = new DateTime('2010-11-08 19:59:59 EST');  // post, zt2
$start = new DateTime('2010-11-07 00:10:20');  // dt, zt3
examine_diff($end, $start, 'P+0Y0M1DT20H49M39S', 1);

echo "test_time_fall_type3_redodt_type2_prev: ";
$end   = new DateTime('2010-11-06 18:38:28 EDT');  // prev, zt2
$start = new DateTime('2010-11-07 01:12:33 EDT');  // redodt, zt2
$start->setTimezone(new DateTimeZone('America/New_York'));  // zt2 -> zt3
examine_diff($end, $start, 'P-0Y0M0DT6H34M5S', 0);

echo "test_time_fall_type3_redodt_type2_dt: ";
$end   = new DateTime('2010-11-07 00:10:20 EDT');  // dt, zt2
$start = new DateTime('2010-11-07 01:12:33 EDT');  // redodt, zt2
$start->setTimezone(new DateTimeZone('America/New_York'));  // zt2 -> zt3
examine_diff($end, $start, 'P-0Y0M0DT1H2M13S', 0);

echo "test_time_fall_type3_redodt_type2_redodt: ";
$end   = new DateTime('2010-11-07 01:15:35 EDT');  // sp redodt, zt2
$start = new DateTime('2010-11-07 01:12:33 EDT');  // redodt, zt2
$start->setTimezone(new DateTimeZone('America/New_York'));  // zt2 -> zt3
examine_diff($end, $start, 'P+0Y0M0DT0H3M2S', 0);

echo "test_time_fall_type3_redodt_type2_redost: ";
$end   = new DateTime('2010-11-07 01:14:44 EST');  // redost, zt2
$start = new DateTime('2010-11-07 01:12:33 EDT');  // redodt, zt2
$start->setTimezone(new DateTimeZone('America/New_York'));  // zt2 -> zt3
examine_diff($end, $start, 'P+0Y0M0DT1H2M11S', 0);

echo "test_time_fall_type3_redodt_type2_st: ";
$end   = new DateTime('2010-11-07 03:16:55 EST');  // st, zt2
$start = new DateTime('2010-11-07 01:12:33 EDT');  // redodt, zt2
$start->setTimezone(new DateTimeZone('America/New_York'));  // zt2 -> zt3
examine_diff($end, $start, 'P+0Y0M0DT3H4M22S', 0);

echo "test_time_fall_type3_redodt_type2_post: ";
$end   = new DateTime('2010-11-08 19:59:59 EST');  // post, zt2
$start = new DateTime('2010-11-07 01:12:33 EDT');  // redodt, zt2
$start->setTimezone(new DateTimeZone('America/New_York'));  // zt2 -> zt3
examine_diff($end, $start, 'P+0Y0M1DT19H47M26S', 1);

echo "test_time_fall_type3_redost_type2_prev: ";
$end   = new DateTime('2010-11-06 18:38:28 EDT');  // prev, zt2
$start = new DateTime('2010-11-07 01:14:44 EST');  // redost, zt2
$start->setTimezone(new DateTimeZone('America/New_York'));  // zt2 -> zt3
examine_diff($end, $start, 'P-0Y0M0DT7H36M16S', 0);

echo "test_time_fall_type3_redost_type2_dt: ";
$end   = new DateTime('2010-11-07 00:10:20 EDT');  // dt, zt2
$start = new DateTime('2010-11-07 01:14:44 EST');  // redost, zt2
$start->setTimezone(new DateTimeZone('America/New_York'));  // zt2 -> zt3
examine_diff($end, $start, 'P-0Y0M0DT2H4M24S', 0);

echo "test_time_fall_type3_redost_type2_redodt: ";
$end   = new DateTime('2010-11-07 01:12:33 EDT');  // redodt, zt2
$start = new DateTime('2010-11-07 01:14:44 EST');  // redost, zt2
$start->setTimezone(new DateTimeZone('America/New_York'));  // zt2 -> zt3
examine_diff($end, $start, 'P-0Y0M0DT1H2M11S', 0);

echo "test_time_fall_type3_redost_type2_redost: ";
$end   = new DateTime('2010-11-07 01:16:54 EST');  // sp redodt, zt2
$start = new DateTime('2010-11-07 01:14:44 EST');  // redost, zt2
$start->setTimezone(new DateTimeZone('America/New_York'));  // zt2 -> zt3
examine_diff($end, $start, 'P+0Y0M0DT0H2M10S', 0);

echo "test_time_fall_type3_redost_type2_st: ";
$end   = new DateTime('2010-11-07 03:16:55 EST');  // st, zt2
$start = new DateTime('2010-11-07 01:14:44 EST');  // redost, zt2
$start->setTimezone(new DateTimeZone('America/New_York'));  // zt2 -> zt3
examine_diff($end, $start, 'P+0Y0M0DT2H2M11S', 0);

echo "test_time_fall_type3_redost_type2_post: ";
$end   = new DateTime('2010-11-08 19:59:59 EST');  // post, zt2
$start = new DateTime('2010-11-07 01:14:44 EST');  // redost, zt2
$start->setTimezone(new DateTimeZone('America/New_York'));  // zt2 -> zt3
examine_diff($end, $start, 'P+0Y0M1DT18H45M15S', 1);

echo "test_time_fall_type3_st_type2_prev: ";
$end   = new DateTime('2010-11-06 18:38:28 EDT');  // prev, zt2
$start = new DateTime('2010-11-07 03:16:55');  // st, zt3
examine_diff($end, $start, 'P-0Y0M0DT9H38M27S', 0);

echo "test_time_fall_type3_st_type2_dt: ";
$end   = new DateTime('2010-11-07 00:10:20 EDT');  // dt, zt2
$start = new DateTime('2010-11-07 03:16:55');  // st, zt3
examine_diff($end, $start, 'P-0Y0M0DT4H6M35S', 0);

echo "test_time_fall_type3_st_type2_redodt: ";
$end   = new DateTime('2010-11-07 01:12:33 EDT');  // redodt, zt2
$start = new DateTime('2010-11-07 03:16:55');  // st, zt3
examine_diff($end, $start, 'P-0Y0M0DT3H4M22S', 0);

echo "test_time_fall_type3_st_type2_redost: ";
$end   = new DateTime('2010-11-07 01:14:44 EST');  // redost, zt2
$start = new DateTime('2010-11-07 03:16:55');  // st, zt3
examine_diff($end, $start, 'P-0Y0M0DT2H2M11S', 0);

echo "test_time_fall_type3_st_type2_st: ";
$end   = new DateTime('2010-11-07 05:19:56 EST');  // sp st, zt2
$start = new DateTime('2010-11-07 03:16:55');  // st, zt3
examine_diff($end, $start, 'P+0Y0M0DT2H3M1S', 0);

echo "test_time_fall_type3_st_type2_post: ";
$end   = new DateTime('2010-11-08 19:59:59 EST');  // post, zt2
$start = new DateTime('2010-11-07 03:16:55');  // st, zt3
examine_diff($end, $start, 'P+0Y0M1DT16H43M4S', 1);

echo "test_time_fall_type3_post_type2_prev: ";
$end   = new DateTime('2010-11-06 18:38:28 EDT');  // prev, zt2
$start = new DateTime('2010-11-08 19:59:59');  // post, zt3
examine_diff($end, $start, 'P-0Y0M2DT1H21M31S', 2);

echo "test_time_fall_type3_post_type2_dt: ";
$end   = new DateTime('2010-11-07 00:10:20 EDT');  // dt, zt2
$start = new DateTime('2010-11-08 19:59:59');  // post, zt3
examine_diff($end, $start, 'P-0Y0M1DT20H49M39S', 1);

echo "test_time_fall_type3_post_type2_redodt: ";
$end   = new DateTime('2010-11-07 01:12:33 EDT');  // redodt, zt2
$start = new DateTime('2010-11-08 19:59:59');  // post, zt3
examine_diff($end, $start, 'P-0Y0M1DT19H47M26S', 1);

echo "test_time_fall_type3_post_type2_redost: ";
$end   = new DateTime('2010-11-07 01:14:44 EST');  // redost, zt2
$start = new DateTime('2010-11-08 19:59:59');  // post, zt3
examine_diff($end, $start, 'P-0Y0M1DT18H45M15S', 1);

echo "test_time_fall_type3_post_type2_st: ";
$end   = new DateTime('2010-11-07 03:16:55 EST');  // st, zt2
$start = new DateTime('2010-11-08 19:59:59');  // post, zt3
examine_diff($end, $start, 'P-0Y0M1DT16H43M4S', 1);

echo "test_time_fall_type3_post_type2_post: ";
$end   = new DateTime('2010-11-08 19:59:59 EST');  // post, zt2
$start = new DateTime('2010-11-08 18:57:55');  // sp post, zt3
examine_diff($end, $start, 'P+0Y0M0DT1H2M4S', 0);

?>
--EXPECT--
test_time_fall_type3_prev_type2_prev: FWD: 2010-11-06 18:38:28 EDT - 2010-10-04 02:18:48 EDT = **P+0Y1M2DT16H19M40S** | BACK: 2010-10-04 02:18:48 EDT + P+0Y1M2DT16H19M40S = **2010-11-06 18:38:28 EDT** | DAYS: **33**
test_time_fall_type3_prev_type2_dt: FWD: 2010-11-07 00:10:20 EDT - 2010-11-06 18:38:28 EDT = **P+0Y0M0DT5H31M52S** | BACK: 2010-11-06 18:38:28 EDT + P+0Y0M0DT5H31M52S = **2010-11-07 00:10:20 EDT** | DAYS: **0**
test_time_fall_type3_prev_type2_redodt: FWD: 2010-11-07 01:12:33 EDT - 2010-11-06 18:38:28 EDT = **P+0Y0M0DT6H34M5S** | BACK: 2010-11-06 18:38:28 EDT + P+0Y0M0DT6H34M5S = **2010-11-07 01:12:33 EDT** | DAYS: **0**
test_time_fall_type3_prev_type2_redost: FWD: 2010-11-07 01:14:44 EST - 2010-11-06 18:38:28 EDT = **P+0Y0M0DT7H36M16S** | BACK: 2010-11-06 18:38:28 EDT + P+0Y0M0DT7H36M16S = **2010-11-07 01:14:44 EST** | DAYS: **0**
test_time_fall_type3_prev_type2_st: FWD: 2010-11-07 03:16:55 EST - 2010-11-06 18:38:28 EDT = **P+0Y0M0DT9H38M27S** | BACK: 2010-11-06 18:38:28 EDT + P+0Y0M0DT9H38M27S = **2010-11-07 03:16:55 EST** | DAYS: **0**
test_time_fall_type3_prev_type2_post: FWD: 2010-11-08 19:59:59 EST - 2010-11-06 18:38:28 EDT = **P+0Y0M2DT1H21M31S** | BACK: 2010-11-06 18:38:28 EDT + P+0Y0M2DT1H21M31S = **2010-11-08 19:59:59 EST** | DAYS: **2**
test_time_fall_type3_dt_type2_prev: FWD: 2010-11-06 18:38:28 EDT - 2010-11-07 00:10:20 EDT = **P-0Y0M0DT5H31M52S** | BACK: 2010-11-07 00:10:20 EDT + P-0Y0M0DT5H31M52S = **2010-11-06 18:38:28 EDT** | DAYS: **0**
test_time_fall_type3_dt_type2_dt: FWD: 2010-11-07 00:15:35 EDT - 2010-11-07 00:10:20 EDT = **P+0Y0M0DT0H5M15S** | BACK: 2010-11-07 00:10:20 EDT + P+0Y0M0DT0H5M15S = **2010-11-07 00:15:35 EDT** | DAYS: **0**
test_time_fall_type3_dt_type2_redodt: FWD: 2010-11-07 01:12:33 EDT - 2010-11-07 00:10:20 EDT = **P+0Y0M0DT1H2M13S** | BACK: 2010-11-07 00:10:20 EDT + P+0Y0M0DT1H2M13S = **2010-11-07 01:12:33 EDT** | DAYS: **0**
test_time_fall_type3_dt_type2_redost: FWD: 2010-11-07 01:14:44 EST - 2010-11-07 00:10:20 EDT = **P+0Y0M0DT2H4M24S** | BACK: 2010-11-07 00:10:20 EDT + P+0Y0M0DT2H4M24S = **2010-11-07 01:14:44 EST** | DAYS: **0**
test_time_fall_type3_dt_type2_st: FWD: 2010-11-07 03:16:55 EST - 2010-11-07 00:10:20 EDT = **P+0Y0M0DT4H6M35S** | BACK: 2010-11-07 00:10:20 EDT + P+0Y0M0DT4H6M35S = **2010-11-07 03:16:55 EST** | DAYS: **0**
test_time_fall_type3_dt_type2_post: FWD: 2010-11-08 19:59:59 EST - 2010-11-07 00:10:20 EDT = **P+0Y0M1DT20H49M39S** | BACK: 2010-11-07 00:10:20 EDT + P+0Y0M1DT20H49M39S = **2010-11-08 19:59:59 EST** | DAYS: **1**
test_time_fall_type3_redodt_type2_prev: FWD: 2010-11-06 18:38:28 EDT - 2010-11-07 01:12:33 EDT = **P-0Y0M0DT6H34M5S** | BACK: 2010-11-07 01:12:33 EDT + P-0Y0M0DT6H34M5S = **2010-11-06 18:38:28 EDT** | DAYS: **0**
test_time_fall_type3_redodt_type2_dt: FWD: 2010-11-07 00:10:20 EDT - 2010-11-07 01:12:33 EDT = **P-0Y0M0DT1H2M13S** | BACK: 2010-11-07 01:12:33 EDT + P-0Y0M0DT1H2M13S = **2010-11-07 00:10:20 EDT** | DAYS: **0**
test_time_fall_type3_redodt_type2_redodt: FWD: 2010-11-07 01:15:35 EDT - 2010-11-07 01:12:33 EDT = **P+0Y0M0DT0H3M2S** | BACK: 2010-11-07 01:12:33 EDT + P+0Y0M0DT0H3M2S = **2010-11-07 01:15:35 EDT** | DAYS: **0**
test_time_fall_type3_redodt_type2_redost: FWD: 2010-11-07 01:14:44 EST - 2010-11-07 01:12:33 EDT = **P+0Y0M0DT1H2M11S** | BACK: 2010-11-07 01:12:33 EDT + P+0Y0M0DT1H2M11S = **2010-11-07 01:14:44 EST** | DAYS: **0**
test_time_fall_type3_redodt_type2_st: FWD: 2010-11-07 03:16:55 EST - 2010-11-07 01:12:33 EDT = **P+0Y0M0DT3H4M22S** | BACK: 2010-11-07 01:12:33 EDT + P+0Y0M0DT3H4M22S = **2010-11-07 03:16:55 EST** | DAYS: **0**
test_time_fall_type3_redodt_type2_post: FWD: 2010-11-08 19:59:59 EST - 2010-11-07 01:12:33 EDT = **P+0Y0M1DT19H47M26S** | BACK: 2010-11-07 01:12:33 EDT + P+0Y0M1DT19H47M26S = **2010-11-08 19:59:59 EST** | DAYS: **1**
test_time_fall_type3_redost_type2_prev: FWD: 2010-11-06 18:38:28 EDT - 2010-11-07 01:14:44 EST = **P-0Y0M0DT7H36M16S** | BACK: 2010-11-07 01:14:44 EST + P-0Y0M0DT7H36M16S = **2010-11-06 18:38:28 EDT** | DAYS: **0**
test_time_fall_type3_redost_type2_dt: FWD: 2010-11-07 00:10:20 EDT - 2010-11-07 01:14:44 EST = **P-0Y0M0DT2H4M24S** | BACK: 2010-11-07 01:14:44 EST + P-0Y0M0DT2H4M24S = **2010-11-07 00:10:20 EDT** | DAYS: **0**
test_time_fall_type3_redost_type2_redodt: FWD: 2010-11-07 01:12:33 EDT - 2010-11-07 01:14:44 EST = **P-0Y0M0DT1H2M11S** | BACK: 2010-11-07 01:14:44 EST + P-0Y0M0DT1H2M11S = **2010-11-07 01:12:33 EDT** | DAYS: **0**
test_time_fall_type3_redost_type2_redost: FWD: 2010-11-07 01:16:54 EST - 2010-11-07 01:14:44 EST = **P+0Y0M0DT0H2M10S** | BACK: 2010-11-07 01:14:44 EST + P+0Y0M0DT0H2M10S = **2010-11-07 01:16:54 EST** | DAYS: **0**
test_time_fall_type3_redost_type2_st: FWD: 2010-11-07 03:16:55 EST - 2010-11-07 01:14:44 EST = **P+0Y0M0DT2H2M11S** | BACK: 2010-11-07 01:14:44 EST + P+0Y0M0DT2H2M11S = **2010-11-07 03:16:55 EST** | DAYS: **0**
test_time_fall_type3_redost_type2_post: FWD: 2010-11-08 19:59:59 EST - 2010-11-07 01:14:44 EST = **P+0Y0M1DT18H45M15S** | BACK: 2010-11-07 01:14:44 EST + P+0Y0M1DT18H45M15S = **2010-11-08 19:59:59 EST** | DAYS: **1**
test_time_fall_type3_st_type2_prev: FWD: 2010-11-06 18:38:28 EDT - 2010-11-07 03:16:55 EST = **P-0Y0M0DT9H38M27S** | BACK: 2010-11-07 03:16:55 EST + P-0Y0M0DT9H38M27S = **2010-11-06 18:38:28 EDT** | DAYS: **0**
test_time_fall_type3_st_type2_dt: FWD: 2010-11-07 00:10:20 EDT - 2010-11-07 03:16:55 EST = **P-0Y0M0DT4H6M35S** | BACK: 2010-11-07 03:16:55 EST + P-0Y0M0DT4H6M35S = **2010-11-07 00:10:20 EDT** | DAYS: **0**
test_time_fall_type3_st_type2_redodt: FWD: 2010-11-07 01:12:33 EDT - 2010-11-07 03:16:55 EST = **P-0Y0M0DT3H4M22S** | BACK: 2010-11-07 03:16:55 EST + P-0Y0M0DT3H4M22S = **2010-11-07 01:12:33 EDT** | DAYS: **0**
test_time_fall_type3_st_type2_redost: FWD: 2010-11-07 01:14:44 EST - 2010-11-07 03:16:55 EST = **P-0Y0M0DT2H2M11S** | BACK: 2010-11-07 03:16:55 EST + P-0Y0M0DT2H2M11S = **2010-11-07 01:14:44 EST** | DAYS: **0**
test_time_fall_type3_st_type2_st: FWD: 2010-11-07 05:19:56 EST - 2010-11-07 03:16:55 EST = **P+0Y0M0DT2H3M1S** | BACK: 2010-11-07 03:16:55 EST + P+0Y0M0DT2H3M1S = **2010-11-07 05:19:56 EST** | DAYS: **0**
test_time_fall_type3_st_type2_post: FWD: 2010-11-08 19:59:59 EST - 2010-11-07 03:16:55 EST = **P+0Y0M1DT16H43M4S** | BACK: 2010-11-07 03:16:55 EST + P+0Y0M1DT16H43M4S = **2010-11-08 19:59:59 EST** | DAYS: **1**
test_time_fall_type3_post_type2_prev: FWD: 2010-11-06 18:38:28 EDT - 2010-11-08 19:59:59 EST = **P-0Y0M2DT1H21M31S** | BACK: 2010-11-08 19:59:59 EST + P-0Y0M2DT1H21M31S = **2010-11-06 18:38:28 EDT** | DAYS: **2**
test_time_fall_type3_post_type2_dt: FWD: 2010-11-07 00:10:20 EDT - 2010-11-08 19:59:59 EST = **P-0Y0M1DT20H49M39S** | BACK: 2010-11-08 19:59:59 EST + P-0Y0M1DT20H49M39S = **2010-11-07 00:10:20 EDT** | DAYS: **1**
test_time_fall_type3_post_type2_redodt: FWD: 2010-11-07 01:12:33 EDT - 2010-11-08 19:59:59 EST = **P-0Y0M1DT19H47M26S** | BACK: 2010-11-08 19:59:59 EST + P-0Y0M1DT19H47M26S = **2010-11-07 01:12:33 EDT** | DAYS: **1**
test_time_fall_type3_post_type2_redost: FWD: 2010-11-07 01:14:44 EST - 2010-11-08 19:59:59 EST = **P-0Y0M1DT18H45M15S** | BACK: 2010-11-08 19:59:59 EST + P-0Y0M1DT18H45M15S = **2010-11-07 01:14:44 EST** | DAYS: **1**
test_time_fall_type3_post_type2_st: FWD: 2010-11-07 03:16:55 EST - 2010-11-08 19:59:59 EST = **P-0Y0M1DT16H43M4S** | BACK: 2010-11-08 19:59:59 EST + P-0Y0M1DT16H43M4S = **2010-11-07 03:16:55 EST** | DAYS: **1**
test_time_fall_type3_post_type2_post: FWD: 2010-11-08 19:59:59 EST - 2010-11-08 18:57:55 EST = **P+0Y0M0DT1H2M4S** | BACK: 2010-11-08 18:57:55 EST + P+0Y0M0DT1H2M4S = **2010-11-08 19:59:59 EST** | DAYS: **0**
