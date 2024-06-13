#!/usr/bin/perl

open(CNT,"<../numberrange.ADSL.txt") || die "Error";
while(<CNT>)
  {
  chop($_);
  chop($_);
  @line=split(/,/,$_);
  print ("INSERT INTO dslprov_cliranges VALUES ('$line[0]','$line[1]','$line[2]');\n");
  }
close(CNT);
