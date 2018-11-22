<?php
require "connadmin.php";
// $item1 = $_POST["item1"];
// $item2 = $_POST["item2"];
// $latitude = $_POST["latitude"];
session_start();
$username =  $_SESSION["username"];
$item1 =  $_SESSION["item1"];
$item2 =  $_SESSION["item2"];
$mysql_qry = "select * from admin where username like '$username';";
$result2 = mysqli_query($conn ,$mysql_qry);
if(mysqli_num_rows($result2)>0)
{
  while($row = mysqli_fetch_assoc($result2))
   {
      $lat=$row["latitude"];
      $long=$row["longitude"];
    }
  }
  else {
    echo 'no item1';
  }
$shoplist=array();
$cost=array();
$x=0;$y=0;$count=0;
  $sql = "SELECT * FROM items where name='$item1' ;";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0)
  {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
          //echo "SHOP NAME: " . $row["shopname"]." <br>";
          $shoplist[$x]= $row["shopname"];
          $cost[$x]= $row["cost"];
          $x=$x+1;
          $shoplist[$x]= $row["shopname"];
          $cost[$x]= $row["cost"];
          $x=$x+1;
      }
  for($i=0;$i<$x-1;$i++)
  {
    for($j=0;$j<$x-$i-1;$j++)
    {
      if ($cost[$j]>$cost[$j+1])
      {
        $temp=$cost[$j];
        $cost[$j]=$cost[$j+1];
        $cost[$j+1]=$temp;
        $temp=$shoplist[$j];
        $shoplist[$j]=$shoplist[$j+1];
        $shoplist[$j+1]=$temp;
      }
    }
  }
  $shoplist2 = array();
  $cost2 = array();
  $x=0;$y=0;
  foreach ($shoplist as $value)
  {
    if(!in_array($value, $shoplist2))
    {
       $shoplist2[$x]=$value;
       $cost2[$x]=$cost[$y];
       $x=$x+1;
    }
      $y=$y+1;
  }
  // for($m = 0; $m < $x; $m++)
  // {
  // echo $shoplist2[$m];
  // echo $cost2[$m];
  // echo "<br>";
  // }
}
else {
    echo "0 results";
}
$shoplist=array();
$cost=array();
$x=0;$y=0;
  $sql = "SELECT * FROM items where name='$item2' ;";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0)
  {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
          //echo "SHOP NAME: " . $row["shopname"]." <br>";
          $shoplist[$x]= $row["shopname"];
          $cost[$x]= $row["cost"];
          $x=$x+1;
          $shoplist[$x]= $row["shopname"];
          $cost[$x]= $row["cost"];
          $x=$x+1;
      }
  for($i=0;$i<$x-1;$i++)
  {
    for($j=0;$j<$x-$i-1;$j++)
    {
      if ($cost[$j]>$cost[$j+1])
      {
        $temp=$cost[$j];
        $cost[$j]=$cost[$j+1];
        $cost[$j+1]=$temp;
        $temp=$shoplist[$j];
        $shoplist[$j]=$shoplist[$j+1];
        $shoplist[$j+1]=$temp;
      }
    }
  }
  $shoplist3 = array();
  $cost3 = array();
  $x=0;$y=0;
  foreach ($shoplist as $value)
  {
    if(!in_array($value, $shoplist3))
    {
       $shoplist3[$x]=$value;
       $cost3[$x]=$cost[$y];
       $x=$x+1;
    }
      $y=$y+1;
  }
}
else {
    echo "0 results";
}
$finalshoplist=array_merge($shoplist2,$shoplist3);
$finalcost=array_merge($cost2,$cost3);
$finalshoplist2=array();
$finalcost2=array();
$count=array();
$index=0;
$len=sizeof($finalshoplist);
for($m=0;$m<$len;$m++)
{
  $count2=0;
  for($n=0;$n<$len;$n++)
  {
    if($finalshoplist[$m]==$finalshoplist[$n])
    {
       $finalshoplist2[$index]=$finalshoplist[$m];
       $finalcost2[$index]=$finalcost2[$index]+$finalcost[$n];
       $count2=$count2+1;
       if($m!=$n)
       {
         for($x=$n;$x<$len-1;$x++)
         {
           $finalshoplist[$x]=$finalshoplist[$x+1];
           $finalcost[$x]=$finalcost[$x+1];
         }
         $len=$len-1;
       }
    }
  }
   $count[$index]=$count2;
   $index=$index+1;
 }
 $finalshoplist3=array();
 $finalcost3=array();
 for($m=0;$m<sizeof($finalshoplist2);$m++)
 {
   $count2=0;
   for($n=0;$n<sizeof($finalshoplist2);$n++)
   {
     if($finalshoplist[$m]==$finalshoplist[$n])
     $count2=$count2+1;
   }
   }
   $latarray=array();
   $longarray=array();
   $distance=array();
for($m=0;$m<sizeof($finalshoplist);$m++)
{
  $mysql_qry = "select * from shops where name like '$finalshoplist[$m]';";
  $result3 = mysqli_query($conn ,$mysql_qry);
  if(mysqli_num_rows($result3)>0)
  {
    while($row = mysqli_fetch_assoc($result3))
     {
        $latarray[$m]=$row["latitude"];
        $longarray[$m]=$row["longitude"];
      }
    }
    if (($lat == $latarray[$m]) && ($long == $longarray[$m]))
     {
    $distance[$m]=0;
     }
  else
    {
     $theta = $long - $longarray[$m];
    $dist = sin(deg2rad($lat)) * sin(deg2rad($latarray[$m])) +  cos(deg2rad($lat)) * cos(deg2rad($latarray[$m])) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $distance[$m]=$miles;
    }
}

   for($i=0;$i<$index-1;$i++)
   {
     for($j=0;$j<$index-$i-1;$j++)
     {
       if ($distance[$j]>$distance[$j+1])
       {
         $temp=$distance[$j];
         $distance[$j]=$distance[$j+1];
         $distance[$j+1]=$temp;
         $temp=$count[$j];
         $count[$j]=$count[$j+1];
         $count[$j+1]=$temp;
         $temp=$finalshoplist2[$j];
         $finalshoplist2[$j]=$finalshoplist2[$j+1];
         $finalshoplist2[$j+1]=$temp;
         $temp=$finalcost2[$j];
         $finalcost2[$j]=$finalcost2[$j+1];
         $finalcost2[$j+1]=$temp;
       }
     }
   }
 for($m=0;$m<sizeof($finalshoplist2);$m++)
 {
   echo "<center>";
   echo '<font color=\'blue\'><div style="border:1px solid red; padding:16px;"></font>';
   echo 'Shopname:  ' .$finalshoplist2[$m]."<br>" ;
   $mysql_qry = "select * from shops where name='$finalshoplist2[$m]' ";
   $result = mysqli_query($conn ,$mysql_qry);
   while($rows=mysqli_fetch_array($result))
   {
   	echo '<img height="150" width="200" src="'.$rows['image'].' ">',"<br>";
     $lat=$rows['latitude'];
     $long=$rows['longitude'];
   }
   echo  'Total Cost:  ' .$finalcost2[$m]."<br>" ;
   echo 'Number of Items:  ' .$count[$m]."<br>" ;
   //$lat='41.8911684';$long='12.507724100000019';
   echo '<a href="https://maps.google.com/?q='.$lat.','.$long.'"> Show Map </a>';
   echo "<br>"; echo "<br>"; echo "<br>";
    echo "</center>";
 }
mysqli_close($conn);
?>
