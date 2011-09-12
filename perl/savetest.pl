#!/usr/bin/perl

use File::Copy;
use File::Path;

if (0 == @ARGV)
{
  print "Add the version number you tit\n\n";
  exit(-1);
}

$ver = @ARGV[0];

unlink 'moadb-'.$ver.'.sql';
rmtree 'installed/'.$ver;

`mysqldump moatest -umoatest -pmoatest > moadb-$ver.sql`;
`mkdir installed/$ver`;
$result = `rsync -r ~/public_html/moatest/ installed/$ver`;
`chmod 757 installed/$ver`;
`chmod 757 installed/$ver/images`;
`chmod 757 installed/$ver/images/thumbs`;
`chmod 757 installed/$ver/private`;
`chmod 757 installed/$ver/incoming`;

`chmod 757 installed/$ver/config.php`;
`chmod 757 installed/$ver/private/db_config.php`;

print $result."\n"; 
