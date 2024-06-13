<?

$formquery=$query;

$bgcolor='#ffeebb';

  $query="select * from dslprov_reports where deleted='0'";
  echo("<center>");

  echo("<table border=0><tr bgcolor=$tcolor0>");
  echo("<td align=center nowrap><b>No.</b></td>");
  echo("<td align=center nowrap><b>Type</b></td>");
  echo("<td align=center nowrap><b>Frequency(d)</b>");
  echo("<td align=center nowrap><b>Format</b>");
  echo("<td align=center nowrap><b>Address</b>");
  echo("<td align=center nowrap><b>Show</b></td>");
  echo("<td align=center nowrap><b>Delete</b></td>");

  $result=mysql_query($query);

  for ($i=0;$i < mysql_num_rows($result);$i++)
    {
    $row = mysql_fetch_row($result);
    $j=0;
    echo("</tr><tr bgcolor=$bgcolor>");
    foreach ($row as $value)
      {
      if ($j==0)
        {
        $k=$i+1;
        $report_id=$value;
        echo("<td align=center><b>$k</b></td>");
        }
      else if ($j==2)
        {
        }
      else if ($j==6)
        {
        echo("<td align=center><b><a href=$value>>Show</a></b></td>");         
        echo("<td align=center><b><a href=index.php?page=20&action=deleterep&report_id=$report_id>>Delete</a></b></td>");              
        }
      else if ($j==7)
        {
        }
      else
        {
        echo("<td align=center>$value</td>");
        }

      $j++;
      }
    }
  echo("</tr></table>");

echo("</center>");
     
?>
