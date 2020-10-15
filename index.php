<?php
if(isset($_POST['submit']))
{
    $BR = file_get_contents('beforeResult.php');
    $myfile = fopen("result.php", "w") or die("Unable to open file!");
    $txt = $BR.$_POST['code']."\n\n?>\n<br><br>\n<a href='index.php'>Go Back To Editor</a></div>\n</body>\n</html>";
    fwrite($myfile, $txt);
    header("Location: result.php");
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="Container">
    <h1>PHP Compiler</h1>
    <form action="index.php" method="post">
    <textarea name="code" id="code" cols="100" rows="25" required><?php echo "<?php\n\necho \"Hello World\";"?>
    </textarea>
    <br><br>
    <input type="submit" id="button" name="submit" value="RUN">
    </form>
    </div>
</body>

<script>
//resolves tab bug in textarea
document.getElementById('code').addEventListener('keydown', function(e) {
  if (e.key == 'Tab') {
    e.preventDefault();
    var start = this.selectionStart;
    var end = this.selectionEnd;

    // set textarea value to: text before caret + tab + text after caret
    this.value = this.value.substring(0, start) +
      "\t" + this.value.substring(end);
  }
});
</script>
</html>
