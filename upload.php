<form action="process.php" method="POST" enctype="multipart/form-data">
    
    <input type="file" name="files[]" multiple>
    <input type="submit" value="upload now!">

</form>

<?php
    include "config/db.php";

   $result = mysqli_query($connect, "SELECT path FROM album_one");

    $num_rows = mysqli_num_rows($result);

    while($row = mysqli_fetch_assoc($result)){
     
        echo "<img src='";
        echo $row['path'];
        echo "'>";
        }

?>



