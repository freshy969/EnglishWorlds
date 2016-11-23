<?php
  ob_start();
  require_once './inc/header.inc.php';
  $buffer = ob_get_contents();
  ob_end_clean();
  $buffer=str_replace("%TITLE%","Messages",$buffer);
  echo $buffer;
  echo "<h2>My unread messages:</h2>";
  // Grab the messages from the logged in user
  $grab_messages = $db->query("SELECT * FROM pvt_messages WHERE user_to = '$username' AND opened = 'no'");
  if ($grab_messages->num_rows) {
    while ($get_msgs = $grab_messages->fetch_assoc()) {
      $id = $get_msgs['id'];
      $user_from = $get_msgs['user_from'];
      $user_to = $get_msgs['user_to'];
      $msg_body = $get_msgs['msg_body'];
      $date = $get_msgs['date'];
      $opened = $get_msgs['opened'];
      if (strlen($msg_body) > 150) {
        echo substr($msg_body, 0, 150).' ....';
      } else {
        $msg_body = $msg_body;
        echo '<b><a href="'.$user_from.'">'.$user_from.'</a></b><br>'.$msg_body.'<hr><br>';
      }
    }
  } else {
    echo "You don't have any new messages";
  }

  echo "<h2>My read messages:</h2>";
  // Grab the messages from the logged in user
  $grab_messages = $db->query("SELECT * FROM pvt_messages WHERE user_to = '$username' AND opened = 'yes'");
  if ($grab_messages->num_rows) {
    while ($get_msgs = $grab_messages->fetch_assoc()) {
      $id = $get_msgs['id'];
      $user_from = $get_msgs['user_from'];
      $user_to = $get_msgs['user_to'];
      $msg_body = $get_msgs['msg_body'];
      $date = $get_msgs['date'];
      $opened = $get_msgs['opened'];
      if (strlen($msg_body) > 150) {
        echo substr($msg_body, 0, 150).' ....';
      } else {
        $msg_body = $msg_body;
        echo '<b><a href="'.$user_from.'">'.$user_from.'</a></b><br>'.$msg_body.'<hr><br>';
      }
    }
  } else {
    echo "You haven't read any messages yet";
  }
 ?>