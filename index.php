<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    <br>
  <div id="result"></div>


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

function RUN()
{
  $.ajax({
    type:"GET",
    url: 'result.php',
    success: function(response){
      $("#result").html(response);
    }
  });
}

</script>
<?php
if(isset($_POST['submit']))
{
    $myfile = fopen("result.php", "w") or die("Unable to open file!");
    $txt = $_POST['code']."\n\n?>";
    fwrite($myfile, $txt);
    echo "<script>RUN();</script>";
}
?>
</body>
</html>
