#!/usr/bin/perl

use File::Copy;
use File::Path;

my $ver = '1.2.4';
my $path = 'Moa-'.$ver;

sub MakeRepo
{
  system 'svn export svn://www.moagallery.net/websites/gallery --force '.$path;

  rmtree $path.'/perl';
  rmtree $path.'/media/source';
  unlink $path.'/media/debug-moa-logo-vector.png';
  unlink $path.'/docs/template_reference.html';
  unlink $path.'/docs/TODO';
  unlink $path.'/docs/refactoring.txt'; 
  rmtree $path.'/templates/media/source';
  rmtree $path.'/templates/Aperture/media/source';
  rmtree $path.'/templates/MoaDefault/media/source';
  rmtree $path.'/templates/MoaDefault-blue';
  rmtree $path.'/templates/minimal';

  # Make .zip archive
  system 'zip -r -v -9 '.$path.'.zip '.$path.'/*';

  # Make .tar.gz archive
  system 'tar -cvvf '.$path.'.tar '.$path;
  system 'gzip '.$path.'.tar';
}

MakeRepo();

exit;
