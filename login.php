<?php
if(isset($_POST['name']) && !isset($display_case)){
 $name=htmlspecialchars($_POST['name']);
 $sql=$dbh->prepare("SELECT name FROM chatters WHERE name=?");
 $sql->execute(array($name));
 if($sql->rowCount()!=0){
  $ermsg="<h2 class='error'>Name Taken. <a href='index.php'>Try another Name.</a></h2>";
 }else{
  $sql=$dbh->prepare("INSERT INTO chatters (name,seen) VALUES (?,NOW())");
  $sql->execute(array($name));
  $_SESSION['user']=$name;
 }
}elseif(isset($display_case)){
 if(!isset($ermsg)){
?>

 <h2>Name Needed For Chatting</h2>
 You must provide a name for chatting. This name will be visible to other users.<br/><br/>
 <form action="index.php" method="POST">
  <div class="container" align="center">  <input name="name" placeholder="A Name Please" required/>
  <button>Open Chatroom</button></div>
 </form>
<?php
 }else{
  echo $ermsg;
 }
}
?>
