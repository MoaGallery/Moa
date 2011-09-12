#!/usr/bin/perl

use File::Copy;
use File::Path;

if (0 eq @ARGV)
{
  print "Add the version number you tit\n\n";
  exit(-1);
}

$ver = @ARGV[0];

$upgrade = false;
if ('latest' eq @ARGV[1])
{
  $upgrade = true;
}

$latest = false;
if ('latest' eq @ARGV[0])
{
  $latest = true;
}

rmtree '/home/dan/public_html/moatest';
`mkdir /home/dan/public_html/moatest`;


if (true eq $latest)
{
  print "\n Adding latest version from SVN\n";
  rmtree 'fresh/latest';
  `svn export svn://moagallery.net/websites/gallery fresh/latest`;
  `rsync -r fresh/latest/ /home/dan/public_html/moatest/`;
} else
{
  print "\n Installing Moa $ver in moatest\n";

  `rsync -r installed/$ver/ /home/dan/public_html/moatest/`;

  `mysql -Dmoatest -umoatest -pmoatest < deleteDB.sql`;
  `mysql -Dmoatest -umoatest -pmoatest < moadb-$ver.sql`;
  
  if (true eq $upgrade)
  {
    print "\n Adding upgrade files\n";
    rmtree 'fresh/latest';
    `svn export svn://moagallery.net/websites/gallery fresh/latest`;
    `rsync -r fresh/latest/ /home/dan/public_html/moatest/`;
  }
}





`chmod -R 777 /home/dan/public_html/moatest`;
`chmod -R 777 /home/dan/public_html/moatest/*`;