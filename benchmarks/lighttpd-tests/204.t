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
my $docroot = "$tf->{'TESTDIR'}/tmp/lighttpd/servers/www.example.org/pages/";

sub init_testbed {
    return 0 unless eval { symlink("",""); 1 };
    my $f = "$docroot/index.html";
    my $l = "$docroot/index.xhtml";
    my $rc = undef;
    unless (-l $l) {
        return 0 unless symlink($f,$l);
    };
    $f = "$docroot/expire";
    $l = "$docroot/symlinked";
    $rc = undef;
    unless (-l $l) {
        return 0 unless symlink($f,$l);
    };
    return 1;
};

    init_testbed;
    ok($tf->start_proc == 0, "Starting lighttpd") or die();
	$t->{REQUEST} = ( <<EOF
GET /symlinked/access.txt HTTP/1.0
Host: symlink.example.org
EOF
 );
	$t->{RESPONSE} = [ { 'HTTP-Protocol' => 'HTTP/1.0', 'HTTP-Status' => 200 } ];
	ok($tf->handle_http($t) == 0, 'allow: symlinked dir in path');

# deny case
# simple file
    ok($tf->stop_proc == 0, "Stopping lighttpd");
