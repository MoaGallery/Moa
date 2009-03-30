#!/usr/bin/perl

use File::Copy;
use File::Path;

my $ver = '1.1.0';
my $path = 'Moa-'.$ver;

sub MakeRepo
{
  system 'svn export svn://77.98.144.13/websites/gallery --force '.$path;
  rmtree $path.'/media/source';
  unlink $path.'/media/debug-moa-logo-vector.png';
  system 'zip -r -v -9 '.$path.'.zip '.$path.'\*.*';
  system 'tar -cvvf '.$path.'.tar '.$path;
  system 'gzip '.$path.'.tar';
}

MakeRepo();

exit;