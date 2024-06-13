#!/usr/bin/perl

open(CNT,"<e_exchange_list.txt") || die "Error";
print("
CREATE TABLE dslprov_btexchange (
  exchange_id varchar(8) NOT NULL default '',
  exchange_name varchar(64) NOT NULL default '',
  exchange_fname varchar(64) NOT NULL default '',
  exchange_county varchar(64) NOT NULL default '',
  exchange_targetdatecomm varchar(16) NOT NULL default '',
  exchange_commissioned varchar(8) NOT NULL default '',
  exchange_acceptorders varchar(8) NOT NULL default '',
  PRIMARY KEY  (exchange_id),
) TYPE=InnoDB;
");
while(<CNT>)
  {
  chop($_);
  chop($_);
  $x=$_;
  $x=~s/\"//gi;
  $x=~s/'//gi;
  @line=split(/,/,$x);
  $line[5]=~s/ ..:..:..//gi;
  if ($line[1] ne 'Code')
    {
    print ("INSERT INTO dslprov_btexchange VALUES ('$line[1]','$line[2]','$line[3]','$line[4]','$line[5]','$line[6]','$line[7]');\n");
    }
  }
close(CNT);
