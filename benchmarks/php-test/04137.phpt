--TEST--
DateTime::diff() add() sub() -- february 
--CREDITS--
Daniel Convissor <danielc@php.net>
--FILE--
<?php

/*
 * Note: test names match method names in a set of PHPUnit tests
 * in a userland package.  Please be so kind as to leave them.
 */

require 'examine_diff.inc';
date_default_timezone_set('America/New_York');


/*
 * Check PHP bug 49081
 */
echo "test_bug_49081__1: ";
examine_diff('2010-03-31', '2010-03-01', 'P+0Y0M30DT0H0M0S', 30);

echo "test_bug_49081__2: ";
examine_diff('2010-04-01', '2010-03-01', 'P+0Y1M0DT0H0M0S', 31);

echo "test_bug_49081__3: ";
examine_diff('2010-04-01', '2010-03-31', 'P+0Y0M1DT0H0M0S', 1);

echo "test_bug_49081__4: ";
examine_diff('2010-04-29', '2010-03-31', 'P+0Y0M29DT0H0M0S', 29);

echo "test_bug_49081__5: ";
examine_diff('2010-04-30', '2010-03-31', 'P+0Y0M30DT0H0M0S', 30);

echo "test_bug_49081__6: ";
examine_diff('2010-04-30', '2010-03-30', 'P+0Y1M0DT0H0M0S', 31);

echo "test_bug_49081__7: ";
examine_diff('2010-04-30', '2010-03-29', 'P+0Y1M1DT0H0M0S', 32);

echo "test_bug_49081__8: ";
examine_diff('2010-01-29', '2010-01-01', 'P+0Y0M28DT0H0M0S', 28);

echo "test_bug_49081__9: ";
examine_diff('2010-01-30', '2010-01-01', 'P+0Y0M29DT0H0M0S', 29);

echo "test_bug_49081__10: ";
examine_diff('2010-01-31', '2010-01-01', 'P+0Y0M30DT0H0M0S', 30);

echo "test_bug_49081__11: ";
examine_diff('2010-02-01', '2010-01-01', 'P+0Y1M0DT0H0M0S', 31);

echo "test_bug_49081__12: ";
examine_diff('2010-02-01', '2010-01-31', 'P+0Y0M1DT0H0M0S', 1);

echo "test_bug_49081__13: ";
examine_diff('2010-02-27', '2010-01-31', 'P+0Y0M27DT0H0M0S', 27);

echo "test_bug_49081__14: ";
examine_diff('2010-02-28', '2010-01-31', 'P+0Y0M28DT0H0M0S', 28);

echo "test_bug_49081__15: ";
examine_diff('2010-02-28', '2010-01-30', 'P+0Y0M29DT0H0M0S', 29);

echo "test_bug_49081__16: ";
examine_diff('2010-02-28', '2010-01-29', 'P+0Y0M30DT0H0M0S', 30);

echo "test_bug_49081__17: ";
examine_diff('2010-02-28', '2010-01-28', 'P+0Y1M0DT0H0M0S', 31);

echo "test_bug_49081__18: ";
examine_diff('2010-02-28', '2010-01-27', 'P+0Y1M1DT0H0M0S', 32);

echo "test_bug_49081__19: ";
examine_diff('2010-03-01', '2010-01-01', 'P+0Y2M0DT0H0M0S', 59);

echo "test_bug_49081__20: ";
examine_diff('2010-03-01', '2010-01-31', 'P+0Y0M29DT0H0M0S', 29);

echo "test_bug_49081__21: ";
examine_diff('2010-03-27', '2010-01-31', 'P+0Y1M24DT0H0M0S', 55);

echo "test_bug_49081__22: ";
examine_diff('2010-03-28', '2010-01-31', 'P+0Y1M25DT0H0M0S', 56);

echo "test_bug_49081__23: ";
examine_diff('2010-03-29', '2010-01-31', 'P+0Y1M26DT0H0M0S', 57);

echo "test_bug_49081__24: ";
examine_diff('2010-03-30', '2010-01-31', 'P+0Y1M27DT0H0M0S', 58);

echo "test_bug_49081__25: ";
examine_diff('2010-03-31', '2010-01-31', 'P+0Y2M0DT0H0M0S', 59);

echo "test_bug_49081__26: ";
examine_diff('2010-03-31', '2010-01-30', 'P+0Y2M1DT0H0M0S', 60);

echo "test_bug_49081__27: ";
examine_diff('2009-01-31', '2009-01-01', 'P+0Y0M30DT0H0M0S', 30);

echo "test_bug_49081__28: ";
examine_diff('2010-03-27', '2010-02-28', 'P+0Y0M27DT0H0M0S', 27);

echo "test_bug_49081__29: ";
examine_diff('2010-03-28', '2010-02-28', 'P+0Y1M0DT0H0M0S', 28);

echo "test_bug_49081__30: ";
examine_diff('2010-03-29', '2010-02-28', 'P+0Y1M1DT0H0M0S', 29);

echo "test_bug_49081__31: ";
examine_diff('2010-03-27', '2010-02-27', 'P+0Y1M0DT0H0M0S', 28);

echo "test_bug_49081__32: ";
examine_diff('2010-03-27', '2010-02-26', 'P+0Y1M1DT0H0M0S', 29);


/*
 * Check PHP bug 49081, negative
 */
echo "test_bug_49081_negative__1: ";
examine_diff('2010-03-01', '2010-03-31', 'P-0Y0M30DT0H0M0S', 30);

echo "test_bug_49081_negative__2: ";
examine_diff('2010-03-01', '2010-04-01', 'P-0Y1M0DT0H0M0S', 31);

echo "test_bug_49081_negative__3: ";
examine_diff('2010-03-31', '2010-04-01', 'P-0Y0M1DT0H0M0S', 1);

echo "test_bug_49081_negative__4: ";
examine_diff('2010-03-31', '2010-04-29', 'P-0Y0M29DT0H0M0S', 29);

echo "test_bug_49081_negative__5: ";
examine_diff('2010-03-31', '2010-04-30', 'P-0Y0M30DT0H0M0S', 30);

echo "test_bug_49081_negative__6: ";
examine_diff('2010-03-30', '2010-04-30', 'P-0Y1M0DT0H0M0S', 31);

echo "test_bug_49081_negative__7: ";
examine_diff('2010-03-29', '2010-04-30', 'P-0Y1M1DT0H0M0S', 32);

echo "test_bug_49081_negative__8: ";
examine_diff('2010-01-01', '2010-01-29', 'P-0Y0M28DT0H0M0S', 28);

echo "test_bug_49081_negative__9: ";
examine_diff('2010-01-01', '2010-01-30', 'P-0Y0M29DT0H0M0S', 29);

echo "test_bug_49081_negative__10: ";
examine_diff('2010-01-01', '2010-01-31', 'P-0Y0M30DT0H0M0S', 30);

echo "test_bug_49081_negative__11: ";
examine_diff('2010-01-01', '2010-02-01', 'P-0Y1M0DT0H0M0S', 31);

echo "test_bug_49081_negative__12: ";
examine_diff('2010-01-31', '2010-02-01', 'P-0Y0M1DT0H0M0S', 1);

echo "test_bug_49081_negative__13: ";
examine_diff('2010-01-31', '2010-02-27', 'P-0Y0M27DT0H0M0S', 27);

echo "test_bug_49081_negative__14: ";
examine_diff('2010-01-31', '2010-02-28', 'P-0Y0M28DT0H0M0S', 28);

echo "test_bug_49081_negative__15: ";
examine_diff('2010-01-30', '2010-02-28', 'P-0Y0M29DT0H0M0S', 29);

echo "test_bug_49081_negative__16: ";
examine_diff('2010-01-29', '2010-02-28', 'P-0Y0M30DT0H0M0S', 30);

echo "test_bug_49081_negative__17: ";
examine_diff('2010-01-28', '2010-02-28', 'P-0Y1M0DT0H0M0S', 31);

echo "test_bug_49081_negative__18: ";
examine_diff('2010-01-27', '2010-02-28', 'P-0Y1M1DT0H0M0S', 32);

echo "test_bug_49081_negative__19: ";
examine_diff('2010-01-01', '2010-03-01', 'P-0Y2M0DT0H0M0S', 59);

echo "test_bug_49081_negative__20: ";
examine_diff('2010-01-31', '2010-03-01', 'P-0Y1M1DT0H0M0S', 29);

echo "test_bug_49081_negative__21: ";
examine_diff('2010-01-31', '2010-03-27', 'P-0Y1M27DT0H0M0S', 55);

echo "test_bug_49081_negative__22: ";
examine_diff('2010-01-31', '2010-03-28', 'P-0Y1M28DT0H0M0S', 56);

echo "test_bug_49081_negative__23: ";
examine_diff('2010-01-31', '2010-03-29', 'P-0Y1M29DT0H0M0S', 57);

echo "test_bug_49081_negative__24: ";
examine_diff('2010-01-31', '2010-03-30', 'P-0Y1M30DT0H0M0S', 58);

echo "test_bug_49081_negative__25: ";
examine_diff('2010-01-31', '2010-03-31', 'P-0Y2M0DT0H0M0S', 59);

echo "test_bug_49081_negative__26: ";
examine_diff('2010-01-30', '2010-03-31', 'P-0Y2M1DT0H0M0S', 60);

echo "test_bug_49081_negative__27: ";
examine_diff('2009-01-01', '2009-01-31', 'P-0Y0M30DT0H0M0S', 30);

echo "test_bug_49081_negative__28: ";
examine_diff('2010-02-28', '2010-03-27', 'P-0Y0M27DT0H0M0S', 27);

echo "test_bug_49081_negative__29: ";
examine_diff('2010-02-28', '2010-03-28', 'P-0Y1M0DT0H0M0S', 28);

echo "test_bug_49081_negative__30: ";
examine_diff('2010-02-28', '2010-03-29', 'P-0Y1M1DT0H0M0S', 29);

echo "test_bug_49081_negative__31: ";
examine_diff('2010-02-27', '2010-03-27', 'P-0Y1M0DT0H0M0S', 28);

echo "test_bug_49081_negative__32: ";
examine_diff('2010-02-26', '2010-03-27', 'P-0Y1M1DT0H0M0S', 29);

?>
--EXPECT--
test_bug_49081__1: FWD: 2010-03-31 00:00:00 EDT - 2010-03-01 00:00:00 EST = **P+0Y0M30DT0H0M0S** | BACK: 2010-03-01 00:00:00 EST + P+0Y0M30DT0H0M0S = **2010-03-31 00:00:00 EDT** | DAYS: **30**
test_bug_49081__2: FWD: 2010-04-01 00:00:00 EDT - 2010-03-01 00:00:00 EST = **P+0Y1M0DT0H0M0S** | BACK: 2010-03-01 00:00:00 EST + P+0Y1M0DT0H0M0S = **2010-04-01 00:00:00 EDT** | DAYS: **31**
test_bug_49081__3: FWD: 2010-04-01 00:00:00 EDT - 2010-03-31 00:00:00 EDT = **P+0Y0M1DT0H0M0S** | BACK: 2010-03-31 00:00:00 EDT + P+0Y0M1DT0H0M0S = **2010-04-01 00:00:00 EDT** | DAYS: **1**
test_bug_49081__4: FWD: 2010-04-29 00:00:00 EDT - 2010-03-31 00:00:00 EDT = **P+0Y0M29DT0H0M0S** | BACK: 2010-03-31 00:00:00 EDT + P+0Y0M29DT0H0M0S = **2010-04-29 00:00:00 EDT** | DAYS: **29**
test_bug_49081__5: FWD: 2010-04-30 00:00:00 EDT - 2010-03-31 00:00:00 EDT = **P+0Y0M30DT0H0M0S** | BACK: 2010-03-31 00:00:00 EDT + P+0Y0M30DT0H0M0S = **2010-04-30 00:00:00 EDT** | DAYS: **30**
test_bug_49081__6: FWD: 2010-04-30 00:00:00 EDT - 2010-03-30 00:00:00 EDT = **P+0Y1M0DT0H0M0S** | BACK: 2010-03-30 00:00:00 EDT + P+0Y1M0DT0H0M0S = **2010-04-30 00:00:00 EDT** | DAYS: **31**
test_bug_49081__7: FWD: 2010-04-30 00:00:00 EDT - 2010-03-29 00:00:00 EDT = **P+0Y1M1DT0H0M0S** | BACK: 2010-03-29 00:00:00 EDT + P+0Y1M1DT0H0M0S = **2010-04-30 00:00:00 EDT** | DAYS: **32**
test_bug_49081__8: FWD: 2010-01-29 00:00:00 EST - 2010-01-01 00:00:00 EST = **P+0Y0M28DT0H0M0S** | BACK: 2010-01-01 00:00:00 EST + P+0Y0M28DT0H0M0S = **2010-01-29 00:00:00 EST** | DAYS: **28**
test_bug_49081__9: FWD: 2010-01-30 00:00:00 EST - 2010-01-01 00:00:00 EST = **P+0Y0M29DT0H0M0S** | BACK: 2010-01-01 00:00:00 EST + P+0Y0M29DT0H0M0S = **2010-01-30 00:00:00 EST** | DAYS: **29**
test_bug_49081__10: FWD: 2010-01-31 00:00:00 EST - 2010-01-01 00:00:00 EST = **P+0Y0M30DT0H0M0S** | BACK: 2010-01-01 00:00:00 EST + P+0Y0M30DT0H0M0S = **2010-01-31 00:00:00 EST** | DAYS: **30**
test_bug_49081__11: FWD: 2010-02-01 00:00:00 EST - 2010-01-01 00:00:00 EST = **P+0Y1M0DT0H0M0S** | BACK: 2010-01-01 00:00:00 EST + P+0Y1M0DT0H0M0S = **2010-02-01 00:00:00 EST** | DAYS: **31**
test_bug_49081__12: FWD: 2010-02-01 00:00:00 EST - 2010-01-31 00:00:00 EST = **P+0Y0M1DT0H0M0S** | BACK: 2010-01-31 00:00:00 EST + P+0Y0M1DT0H0M0S = **2010-02-01 00:00:00 EST** | DAYS: **1**
test_bug_49081__13: FWD: 2010-02-27 00:00:00 EST - 2010-01-31 00:00:00 EST = **P+0Y0M27DT0H0M0S** | BACK: 2010-01-31 00:00:00 EST + P+0Y0M27DT0H0M0S = **2010-02-27 00:00:00 EST** | DAYS: **27**
test_bug_49081__14: FWD: 2010-02-28 00:00:00 EST - 2010-01-31 00:00:00 EST = **P+0Y0M28DT0H0M0S** | BACK: 2010-01-31 00:00:00 EST + P+0Y0M28DT0H0M0S = **2010-02-28 00:00:00 EST** | DAYS: **28**
test_bug_49081__15: FWD: 2010-02-28 00:00:00 EST - 2010-01-30 00:00:00 EST = **P+0Y0M29DT0H0M0S** | BACK: 2010-01-30 00:00:00 EST + P+0Y0M29DT0H0M0S = **2010-02-28 00:00:00 EST** | DAYS: **29**
test_bug_49081__16: FWD: 2010-02-28 00:00:00 EST - 2010-01-29 00:00:00 EST = **P+0Y0M30DT0H0M0S** | BACK: 2010-01-29 00:00:00 EST + P+0Y0M30DT0H0M0S = **2010-02-28 00:00:00 EST** | DAYS: **30**
test_bug_49081__17: FWD: 2010-02-28 00:00:00 EST - 2010-01-28 00:00:00 EST = **P+0Y1M0DT0H0M0S** | BACK: 2010-01-28 00:00:00 EST + P+0Y1M0DT0H0M0S = **2010-02-28 00:00:00 EST** | DAYS: **31**
test_bug_49081__18: FWD: 2010-02-28 00:00:00 EST - 2010-01-27 00:00:00 EST = **P+0Y1M1DT0H0M0S** | BACK: 2010-01-27 00:00:00 EST + P+0Y1M1DT0H0M0S = **2010-02-28 00:00:00 EST** | DAYS: **32**
test_bug_49081__19: FWD: 2010-03-01 00:00:00 EST - 2010-01-01 00:00:00 EST = **P+0Y2M0DT0H0M0S** | BACK: 2010-01-01 00:00:00 EST + P+0Y2M0DT0H0M0S = **2010-03-01 00:00:00 EST** | DAYS: **59**
test_bug_49081__20: FWD: 2010-03-01 00:00:00 EST - 2010-01-31 00:00:00 EST = **P+0Y0M29DT0H0M0S** | BACK: 2010-01-31 00:00:00 EST + P+0Y0M29DT0H0M0S = **2010-03-01 00:00:00 EST** | DAYS: **29**
test_bug_49081__21: FWD: 2010-03-27 00:00:00 EDT - 2010-01-31 00:00:00 EST = **P+0Y1M24DT0H0M0S** | BACK: 2010-01-31 00:00:00 EST + P+0Y1M24DT0H0M0S = **2010-03-27 00:00:00 EDT** | DAYS: **55**
test_bug_49081__22: FWD: 2010-03-28 00:00:00 EDT - 2010-01-31 00:00:00 EST = **P+0Y1M25DT0H0M0S** | BACK: 2010-01-31 00:00:00 EST + P+0Y1M25DT0H0M0S = **2010-03-28 00:00:00 EDT** | DAYS: **56**
test_bug_49081__23: FWD: 2010-03-29 00:00:00 EDT - 2010-01-31 00:00:00 EST = **P+0Y1M26DT0H0M0S** | BACK: 2010-01-31 00:00:00 EST + P+0Y1M26DT0H0M0S = **2010-03-29 00:00:00 EDT** | DAYS: **57**
test_bug_49081__24: FWD: 2010-03-30 00:00:00 EDT - 2010-01-31 00:00:00 EST = **P+0Y1M27DT0H0M0S** | BACK: 2010-01-31 00:00:00 EST + P+0Y1M27DT0H0M0S = **2010-03-30 00:00:00 EDT** | DAYS: **58**
test_bug_49081__25: FWD: 2010-03-31 00:00:00 EDT - 2010-01-31 00:00:00 EST = **P+0Y2M0DT0H0M0S** | BACK: 2010-01-31 00:00:00 EST + P+0Y2M0DT0H0M0S = **2010-03-31 00:00:00 EDT** | DAYS: **59**
test_bug_49081__26: FWD: 2010-03-31 00:00:00 EDT - 2010-01-30 00:00:00 EST = **P+0Y2M1DT0H0M0S** | BACK: 2010-01-30 00:00:00 EST + P+0Y2M1DT0H0M0S = **2010-03-31 00:00:00 EDT** | DAYS: **60**
test_bug_49081__27: FWD: 2009-01-31 00:00:00 EST - 2009-01-01 00:00:00 EST = **P+0Y0M30DT0H0M0S** | BACK: 2009-01-01 00:00:00 EST + P+0Y0M30DT0H0M0S = **2009-01-31 00:00:00 EST** | DAYS: **30**
test_bug_49081__28: FWD: 2010-03-27 00:00:00 EDT - 2010-02-28 00:00:00 EST = **P+0Y0M27DT0H0M0S** | BACK: 2010-02-28 00:00:00 EST + P+0Y0M27DT0H0M0S = **2010-03-27 00:00:00 EDT** | DAYS: **27**
test_bug_49081__29: FWD: 2010-03-28 00:00:00 EDT - 2010-02-28 00:00:00 EST = **P+0Y1M0DT0H0M0S** | BACK: 2010-02-28 00:00:00 EST + P+0Y1M0DT0H0M0S = **2010-03-28 00:00:00 EDT** | DAYS: **28**
test_bug_49081__30: FWD: 2010-03-29 00:00:00 EDT - 2010-02-28 00:00:00 EST = **P+0Y1M1DT0H0M0S** | BACK: 2010-02-28 00:00:00 EST + P+0Y1M1DT0H0M0S = **2010-03-29 00:00:00 EDT** | DAYS: **29**
test_bug_49081__31: FWD: 2010-03-27 00:00:00 EDT - 2010-02-27 00:00:00 EST = **P+0Y1M0DT0H0M0S** | BACK: 2010-02-27 00:00:00 EST + P+0Y1M0DT0H0M0S = **2010-03-27 00:00:00 EDT** | DAYS: **28**
test_bug_49081__32: FWD: 2010-03-27 00:00:00 EDT - 2010-02-26 00:00:00 EST = **P+0Y1M1DT0H0M0S** | BACK: 2010-02-26 00:00:00 EST + P+0Y1M1DT0H0M0S = **2010-03-27 00:00:00 EDT** | DAYS: **29**
test_bug_49081_negative__1: FWD: 2010-03-01 00:00:00 EST - 2010-03-31 00:00:00 EDT = **P-0Y0M30DT0H0M0S** | BACK: 2010-03-31 00:00:00 EDT + P-0Y0M30DT0H0M0S = **2010-03-01 00:00:00 EST** | DAYS: **30**
test_bug_49081_negative__2: FWD: 2010-03-01 00:00:00 EST - 2010-04-01 00:00:00 EDT = **P-0Y1M0DT0H0M0S** | BACK: 2010-04-01 00:00:00 EDT + P-0Y1M0DT0H0M0S = **2010-03-01 00:00:00 EST** | DAYS: **31**
test_bug_49081_negative__3: FWD: 2010-03-31 00:00:00 EDT - 2010-04-01 00:00:00 EDT = **P-0Y0M1DT0H0M0S** | BACK: 2010-04-01 00:00:00 EDT + P-0Y0M1DT0H0M0S = **2010-03-31 00:00:00 EDT** | DAYS: **1**
test_bug_49081_negative__4: FWD: 2010-03-31 00:00:00 EDT - 2010-04-29 00:00:00 EDT = **P-0Y0M29DT0H0M0S** | BACK: 2010-04-29 00:00:00 EDT + P-0Y0M29DT0H0M0S = **2010-03-31 00:00:00 EDT** | DAYS: **29**
test_bug_49081_negative__5: FWD: 2010-03-31 00:00:00 EDT - 2010-04-30 00:00:00 EDT = **P-0Y0M30DT0H0M0S** | BACK: 2010-04-30 00:00:00 EDT + P-0Y0M30DT0H0M0S = **2010-03-31 00:00:00 EDT** | DAYS: **30**
test_bug_49081_negative__6: FWD: 2010-03-30 00:00:00 EDT - 2010-04-30 00:00:00 EDT = **P-0Y1M0DT0H0M0S** | BACK: 2010-04-30 00:00:00 EDT + P-0Y1M0DT0H0M0S = **2010-03-30 00:00:00 EDT** | DAYS: **31**
test_bug_49081_negative__7: FWD: 2010-03-29 00:00:00 EDT - 2010-04-30 00:00:00 EDT = **P-0Y1M1DT0H0M0S** | BACK: 2010-04-30 00:00:00 EDT + P-0Y1M1DT0H0M0S = **2010-03-29 00:00:00 EDT** | DAYS: **32**
test_bug_49081_negative__8: FWD: 2010-01-01 00:00:00 EST - 2010-01-29 00:00:00 EST = **P-0Y0M28DT0H0M0S** | BACK: 2010-01-29 00:00:00 EST + P-0Y0M28DT0H0M0S = **2010-01-01 00:00:00 EST** | DAYS: **28**
test_bug_49081_negative__9: FWD: 2010-01-01 00:00:00 EST - 2010-01-30 00:00:00 EST = **P-0Y0M29DT0H0M0S** | BACK: 2010-01-30 00:00:00 EST + P-0Y0M29DT0H0M0S = **2010-01-01 00:00:00 EST** | DAYS: **29**
test_bug_49081_negative__10: FWD: 2010-01-01 00:00:00 EST - 2010-01-31 00:00:00 EST = **P-0Y0M30DT0H0M0S** | BACK: 2010-01-31 00:00:00 EST + P-0Y0M30DT0H0M0S = **2010-01-01 00:00:00 EST** | DAYS: **30**
test_bug_49081_negative__11: FWD: 2010-01-01 00:00:00 EST - 2010-02-01 00:00:00 EST = **P-0Y1M0DT0H0M0S** | BACK: 2010-02-01 00:00:00 EST + P-0Y1M0DT0H0M0S = **2010-01-01 00:00:00 EST** | DAYS: **31**
test_bug_49081_negative__12: FWD: 2010-01-31 00:00:00 EST - 2010-02-01 00:00:00 EST = **P-0Y0M1DT0H0M0S** | BACK: 2010-02-01 00:00:00 EST + P-0Y0M1DT0H0M0S = **2010-01-31 00:00:00 EST** | DAYS: **1**
test_bug_49081_negative__13: FWD: 2010-01-31 00:00:00 EST - 2010-02-27 00:00:00 EST = **P-0Y0M27DT0H0M0S** | BACK: 2010-02-27 00:00:00 EST + P-0Y0M27DT0H0M0S = **2010-01-31 00:00:00 EST** | DAYS: **27**
test_bug_49081_negative__14: FWD: 2010-01-31 00:00:00 EST - 2010-02-28 00:00:00 EST = **P-0Y0M28DT0H0M0S** | BACK: 2010-02-28 00:00:00 EST + P-0Y0M28DT0H0M0S = **2010-01-31 00:00:00 EST** | DAYS: **28**
test_bug_49081_negative__15: FWD: 2010-01-30 00:00:00 EST - 2010-02-28 00:00:00 EST = **P-0Y0M29DT0H0M0S** | BACK: 2010-02-28 00:00:00 EST + P-0Y0M29DT0H0M0S = **2010-01-30 00:00:00 EST** | DAYS: **29**
test_bug_49081_negative__16: FWD: 2010-01-29 00:00:00 EST - 2010-02-28 00:00:00 EST = **P-0Y0M30DT0H0M0S** | BACK: 2010-02-28 00:00:00 EST + P-0Y0M30DT0H0M0S = **2010-01-29 00:00:00 EST** | DAYS: **30**
test_bug_49081_negative__17: FWD: 2010-01-28 00:00:00 EST - 2010-02-28 00:00:00 EST = **P-0Y1M0DT0H0M0S** | BACK: 2010-02-28 00:00:00 EST + P-0Y1M0DT0H0M0S = **2010-01-28 00:00:00 EST** | DAYS: **31**
test_bug_49081_negative__18: FWD: 2010-01-27 00:00:00 EST - 2010-02-28 00:00:00 EST = **P-0Y1M1DT0H0M0S** | BACK: 2010-02-28 00:00:00 EST + P-0Y1M1DT0H0M0S = **2010-01-27 00:00:00 EST** | DAYS: **32**
test_bug_49081_negative__19: FWD: 2010-01-01 00:00:00 EST - 2010-03-01 00:00:00 EST = **P-0Y2M0DT0H0M0S** | BACK: 2010-03-01 00:00:00 EST + P-0Y2M0DT0H0M0S = **2010-01-01 00:00:00 EST** | DAYS: **59**
test_bug_49081_negative__20: FWD: 2010-01-31 00:00:00 EST - 2010-03-01 00:00:00 EST = **P-0Y1M1DT0H0M0S** | BACK: 2010-03-01 00:00:00 EST + P-0Y1M1DT0H0M0S = **2010-01-31 00:00:00 EST** | DAYS: **29**
test_bug_49081_negative__21: FWD: 2010-01-31 00:00:00 EST - 2010-03-27 00:00:00 EDT = **P-0Y1M27DT0H0M0S** | BACK: 2010-03-27 00:00:00 EDT + P-0Y1M27DT0H0M0S = **2010-01-31 00:00:00 EST** | DAYS: **55**
test_bug_49081_negative__22: FWD: 2010-01-31 00:00:00 EST - 2010-03-28 00:00:00 EDT = **P-0Y1M28DT0H0M0S** | BACK: 2010-03-28 00:00:00 EDT + P-0Y1M28DT0H0M0S = **2010-01-31 00:00:00 EST** | DAYS: **56**
test_bug_49081_negative__23: FWD: 2010-01-31 00:00:00 EST - 2010-03-29 00:00:00 EDT = **P-0Y1M29DT0H0M0S** | BACK: 2010-03-29 00:00:00 EDT + P-0Y1M29DT0H0M0S = **2010-01-31 00:00:00 EST** | DAYS: **57**
test_bug_49081_negative__24: FWD: 2010-01-31 00:00:00 EST - 2010-03-30 00:00:00 EDT = **P-0Y1M30DT0H0M0S** | BACK: 2010-03-30 00:00:00 EDT + P-0Y1M30DT0H0M0S = **2010-01-31 00:00:00 EST** | DAYS: **58**
test_bug_49081_negative__25: FWD: 2010-01-31 00:00:00 EST - 2010-03-31 00:00:00 EDT = **P-0Y2M0DT0H0M0S** | BACK: 2010-03-31 00:00:00 EDT + P-0Y2M0DT0H0M0S = **2010-01-31 00:00:00 EST** | DAYS: **59**
test_bug_49081_negative__26: FWD: 2010-01-30 00:00:00 EST - 2010-03-31 00:00:00 EDT = **P-0Y2M1DT0H0M0S** | BACK: 2010-03-31 00:00:00 EDT + P-0Y2M1DT0H0M0S = **2010-01-30 00:00:00 EST** | DAYS: **60**
test_bug_49081_negative__27: FWD: 2009-01-01 00:00:00 EST - 2009-01-31 00:00:00 EST = **P-0Y0M30DT0H0M0S** | BACK: 2009-01-31 00:00:00 EST + P-0Y0M30DT0H0M0S = **2009-01-01 00:00:00 EST** | DAYS: **30**
test_bug_49081_negative__28: FWD: 2010-02-28 00:00:00 EST - 2010-03-27 00:00:00 EDT = **P-0Y0M27DT0H0M0S** | BACK: 2010-03-27 00:00:00 EDT + P-0Y0M27DT0H0M0S = **2010-02-28 00:00:00 EST** | DAYS: **27**
test_bug_49081_negative__29: FWD: 2010-02-28 00:00:00 EST - 2010-03-28 00:00:00 EDT = **P-0Y1M0DT0H0M0S** | BACK: 2010-03-28 00:00:00 EDT + P-0Y1M0DT0H0M0S = **2010-02-28 00:00:00 EST** | DAYS: **28**
test_bug_49081_negative__30: FWD: 2010-02-28 00:00:00 EST - 2010-03-29 00:00:00 EDT = **P-0Y1M1DT0H0M0S** | BACK: 2010-03-29 00:00:00 EDT + P-0Y1M1DT0H0M0S = **2010-02-28 00:00:00 EST** | DAYS: **29**
test_bug_49081_negative__31: FWD: 2010-02-27 00:00:00 EST - 2010-03-27 00:00:00 EDT = **P-0Y1M0DT0H0M0S** | BACK: 2010-03-27 00:00:00 EDT + P-0Y1M0DT0H0M0S = **2010-02-27 00:00:00 EST** | DAYS: **28**
test_bug_49081_negative__32: FWD: 2010-02-26 00:00:00 EST - 2010-03-27 00:00:00 EDT = **P-0Y1M1DT0H0M0S** | BACK: 2010-03-27 00:00:00 EDT + P-0Y1M1DT0H0M0S = **2010-02-26 00:00:00 EST** | DAYS: **29**
