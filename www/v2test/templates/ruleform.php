<?php

  $query="select * from dslprov_rules where 1";
  $result=mysql_query($query);
  $number=mysql_num_rows($result);
  if ($number!=1)
    {
    return(-1);
    }
  $ArticleTextRow=mysql_fetch_array($result);
  $btproduct_vpok_pref1=$ArticleTextRow['btproduct_vpok_pref1'];
  $btproduct_novp_pref1=$ArticleTextRow['btproduct_novp_pref1'];
  $btproductbw_vpok_pref1=$ArticleTextRow['btproductbw_vpok_pref1'];
  $btproductbw_novp_pref1=$ArticleTextRow['btproductbw_novp_pref1'];
  $btproduct_vpok_pref2=$ArticleTextRow['btproduct_vpok_pref2'];
  $btproduct_novp_pref2=$ArticleTextRow['btproduct_novp_pref2'];
  $btproductbw_vpok_pref2=$ArticleTextRow['btproductbw_vpok_pref2'];
  $btproductbw_novp_pref2=$ArticleTextRow['btproductbw_novp_pref2'];
  $vc_leadtime=$ArticleTextRow['vc_leadtime'];
  $vp_leadtime=$ArticleTextRow['vp_leadtime'];

echo("

<center>
<form method=get>
<input type=hidden name=page value=11>
<input type=hidden name=action value='saverules'>

<table border=0>
  <tr>
    <td colspan=3 bgcolor=$tcolor0>no VP</td>
    <td colspan=3 bgcolor=$tcolor0>VP connected</td>
  </tr>
  <tr>
    <td bgcolor=$tcolor1>1.</td>
    <td bgcolor=$tcolor1>
    <select name=btproduct_novp_pref1>
");

  $query="select distinct btproduct_short,btproduct_long from dslprov_btproduct";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
         $sel='';
         if ($btproduct_novp_pref1==$value)
           {
           $sel=" selected";
           }
         print "<option value=$value$sel>";
         }
       if ($j==1)
         {
         print"$value</option>";
         }
       $j++;
       }
     }

echo("
    </select>
    </td>
    <td bgcolor=$tcolor1>
    <select name=btproductbw_novp_pref1>
    <option value=0>BW=ProductBW</option>
");

  $query="select distinct btproduct_bw from dslprov_btproduct order by btproduct_bw";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
         $sel='';
         if ($btproductbw_novp_pref1==$value)
           {
           $sel=" selected";
           }
         print "<option value=$value$sel>";
         print"$value Kbits</option>";
       $j++;
       }
     }

echo("
    </select>
    </td>
    <td bgcolor=$tcolor1>1.</td>
    <td bgcolor=$tcolor1>
    <select name=btproduct_vpok_pref1>
");

  $query="select distinct btproduct_short,btproduct_long from dslprov_btproduct";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
         $sel='';
         if ($btproduct_vpok_pref1==$value)
           {
           $sel=" selected";
           }
         print "<option value=$value$sel>";
         }
       if ($j==1)
         {
         print"$value</option>";
         }
       $j++;
       }
     }

echo("
    </select>
    </td>
    <td bgcolor=$tcolor1>
    <select name=btproductbw_vpok_pref1>
    <option value=0>BW=ProductBW</option>
");

  $query="select distinct btproduct_bw from dslprov_btproduct order by btproduct_bw";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
         $sel='';
         if ($btproductbw_vpok_pref1==$value)
           {
           $sel=" selected";
           }
         print "<option value=$value$sel>";
         print"$value Kbits</option>";
       $j++;
       }
     }

echo("
    </select>
    </td>
  </tr>
  <tr>
    <td bgcolor=$tcolor0>2.</td>
    <td bgcolor=$tcolor0>
    <select name=btproduct_novp_pref2>
    <option value=-1>none</option>
");

  $query="select distinct btproduct_short,btproduct_long from dslprov_btproduct";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
         $sel='';
         if ($btproduct_novp_pref2==$value)
           {
           $sel=" selected";
           }
         print "<option value=$value$sel>";
         }
       if ($j==1)
         {
         print"$value</option>";
         }
       $j++;
       }
     }

echo("
    </select>

    </td>
    <td bgcolor=$tcolor0>
    <select name=btproductbw_novp_pref2>
    <option value=-1>none</option>
    <option value=0>BW=ProductBW</option>
");

  $query="select distinct btproduct_bw from dslprov_btproduct order by btproduct_bw";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
         $sel='';
         if ($btproductbw_novp_pref2==$value)
           {
           $sel=" selected";
           }
         print "<option value=$value$sel>";
         print"$value Kbits</option>";
       $j++;
       }
     }

echo("
    </select>
    </td>
    <td bgcolor=$tcolor0>2.</td>
    <td bgcolor=$tcolor0>
    <select name=btproduct_vpok_pref2>
    <option value=-1>none</option>
");

  $query="select distinct btproduct_short,btproduct_long from dslprov_btproduct";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($j==0)
         {
         $sel='';
         if ($btproduct_vpok_pref2==$value)
           {
           $sel=" selected";
           }
         print "<option value=$value$sel>";
         }
       if ($j==1)
         {
         print"$value</option>";
         }
       $j++;
       }
     }

echo("
    </select>
    </td>
    <td bgcolor=$tcolor0>
    <select name=btproductbw_vpok_pref2>
    <option value=-1>none</option>
    <option value=0>BW=ProductBW</option>
");

  $query="select distinct btproduct_bw from dslprov_btproduct order by btproduct_bw";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
         $sel='';
         if ($btproductbw_vpok_pref2==$value)
           {
           $sel=" selected";
           }
         print "<option value=$value$sel>";
         print"$value Kbits</option>";
       $j++;
       }
     }

echo("

    </select>
    </td>
  </tr>
  <tr>
    <td colspan=3 bgcolor=$tcolor0>&nbsp;</td>
    <td colspan=3 bgcolor=$tcolor0>&nbsp;</td>
  </tr>
  <tr>
    <td colspan=2 bgcolor=$tcolor1>VC RDD Leadtime</td>
    <td colspan=1 bgcolor=$tcolor1>
    <select name=vc_leadtime>
  ");

  $query="select dayselect_id from dslprov_dayselect";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($value>0 && $value<31)
         {
         if ($vc_leadtime==$value)
           {
           $sel=" selected";
           }
         else
           {
           $sel='';
           }
         print "<option value=$value$sel>";
         print "$value day(s)</option>\n";
         }
       $j++;
       }
     }

echo("
    </select>
    </td>
    <td colspan=2 bgcolor=$tcolor1>VP RDD Leadtime</td>
    <td colspan=1 bgcolor=$tcolor1>
    <select name=vp_leadtime>
  ");

  $query="select dayselect_id from dslprov_dayselect";
  $result = mysql_query($query);
  $number = mysql_num_rows($result);

   // Print table Content
   for ($i=0;$i < mysql_num_rows($result);$i++)
     {
     $row = mysql_fetch_row($result);
     $j=0;
     foreach ($row as $value)
       {
       if ($value>0 && $value<31)
         {
         if ($vp_leadtime==$value)
           {
           $sel=" selected";
           }
         else
           {
           $sel='';
           }
         print "<option value=$value$sel>";
         print "$value day(s)</option>\n";
         }
       $j++;
       }
     }

echo("
    </select>
    </td>
  </tr>


  <tr>
    <td colspan=6><center><br><br>
    <input type=submit value='SaveRules' name=formtype>
    </center>
   </td>
  </tr>
</table>
</form>
</center>
");

?>
