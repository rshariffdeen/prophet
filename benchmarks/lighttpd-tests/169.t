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
GET /12345.txt HTTP/1.0
Host: 123.example.org
Range: bytes=0-3
EOF
 );
$t->{RESPONSE} = [ { 'HTTP-Protocol' => 'HTTP/1.0', 'HTTP-Status' => 206, 'HTTP-Content' => '1234' } ];
ok($tf->handle_http($t) == 0, 'GET, Range 0-3');

ok($tf->stop_proc == 0, "Stopping lighttpd");
