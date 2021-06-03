#!/usr/bin/env perl
BEGIN {
	# add current source dir to the include-path
	# we need this for make distcheck
	(my $srcdir = $0) =~ s,/[^/]+$,/,;
	unshift @INC, $srcdir;
}

use strict;
use IO::Socket;
use Test::More tests => 3;
use LightyTest;

my $tf = LightyTest->new();
my $t;

ok($tf->start_proc == 0, "Starting lighttpd") or die();
$t->{REQUEST}  = ( <<EOF
GET /index.html HTTP/1.0
If-Modified-Since: Sun, 01 Jan 2036 00:00:02 GMT
EOF
 );
$t->{RESPONSE} = [ { 'HTTP-Protocol' => 'HTTP/1.0', 'HTTP-Status' => 304, '-Content-Length' => '' } ];
ok($tf->handle_http($t) == 0, 'Status 304 has no Content-Length (#1002)');

ok($tf->stop_proc == 0, "Stopping lighttpd");
