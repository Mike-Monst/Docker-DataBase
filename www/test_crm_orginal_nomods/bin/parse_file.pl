#!/usr/bin/perl

open(CNT,"<../html/vcorder.html") || die "Error";
while(<CNT>)
  {
  $x=$_;
  $x=~s/\"/\'/gi;
  print $x;
  }
close(CNT);
