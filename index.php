<?php
function vanished(){
    if($_SESSION['vanish']||$_COOKIE['vanish']){
        return true;
    }
}
?>
<html>
    <head>
        <title>AHPPL</title>
        <link rel="stylesheet" href="//grantscdn.xyz/lib/grant.js/css/grant.js/0.1.css">
    </head>
    <body>
        <div class="content">
            <?php
            if(isset($_GET['vanish'])){
                header("location:vanish.php");
            }
            if($_GET['message']){
                echo "<b>Notice:</b> ".$_GET['message']."<br>";
            }
            ?>
            <form method="post" action="upload.php" enctype="multipart/form-data">
                <input type="file" name="fileToUpload">
                <input type="submit" value="Upload">
            </form>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Hash</th>
                    <th>Link</th>
                    <th>Info</th>
                </tr>
                <?php
                $data=json_decode(file_get_contents("views.json"),true);
                foreach(scandir("uploads") as $file){
                    if(str_split($file)[0]==="."){continue;}
                    if($file==="error_log"){continue;}
                    if(!$data[$file]){
                        echo "<tr><td>$file</td><td>".md5_file("upload/$file")."</td><td><a href='uploads/$file'>Link</a></td><td>(No Data)</td></tr>";
                        continue;
                    }
                    echo "<tr><td>".$data[$file]['name']."</td><td>".md5_file("uploads/$file")."</td><td><a href='uploads/$file'>Link</a></td><td>(".$data[$file]['views']." Views*)</td></tr>";
                }
                ?>
            </table>
            <br>
            * Views available (<a href="vanish.php"><?php if(vanished()){echo "Unvanish";}else{echo "Vanish";} ?></a> or add ?vanish to the direct link)
        </div>
    </body>
</html>