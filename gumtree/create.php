<html>
    <head>
        <title>Create ad</title>
    </head>
    <body>
        <form action="" method="post">
            <input type="text" name="title" placeholder="title"><br>
            <textarea name="content">
                details.....
            </textarea><br>
            <input type="number" name="price" placeholder="xxx$"><br>
            <select>
                <?php for($i = 1970; $i < date('Y'); $i++){
                   echo '<option value="'.$i.'">'.$i.'</option>';
                }?>
            </select>
            <br>
        </form>
    </body>
</html>