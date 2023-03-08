<?php
  $server_root = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://'.$_SERVER['SERVER_NAME'].'/vegetablestore';
  if ($_POST['FilterStatistic'] == "sales") {
    echo "<script>window.location.href = './sales/index.php'</script>";
  } else if ($_POST['FilterStatistic'] == "best-selling") {
    echo "<script>window.location.href = './best-selling/index.php'</script>";
  } else echo "<script>window.location.href = './inventory/index.php'</script>";
?>