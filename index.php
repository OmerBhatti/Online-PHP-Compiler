<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet/less" type="text/css" href="style.less" />
    <script src="//cdn.jsdelivr.net/npm/less" ></script>
    <title>Document</title>
</head>
<body>
  <div class="Container1">
    <h1>PHP Compiler</h1>
    <form action="index.php" method="post">
    <div class='custom-textarea'>
      <textarea spellcheck="false" class='textarea' name="code" id="code" cols="100" rows="25" required><?php echo "<?php\n\necho \"Hello World\";\n"?>
      </textarea>
      <div class='linenumbers'></div>
    </div>
    </div>
    <br><br>
    <input type="submit" id="button" name="submit" value="RUN">
    </form>
  </div>
  <div class="Container2">
    <h1 class='heading'>Result</h1>
    <div id="result"></div>
  </div>

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

class CustomTextarea {
    constructor(element) {
        this.element = element;
        this.textarea = this.element.querySelector('.textarea');
        this.numbers = this.element.querySelector('.linenumbers');
        
        this.numberOfNumbers = 1;

        this.addMoreNumbers();
        this.initEventListeners();
    }

    addMoreNumbers() {
        let html = '';

        for (let i = this.numberOfNumbers; i < this.numberOfNumbers + 100; i++) {
            html += `<div class='number'>${ i }</div>`;
        }

        this.numberOfNumbers += 100;
        this.numbers.innerHTML += html;
    }

    initEventListeners() {
        this.textarea.addEventListener('scroll', () => {
            this.numbers.style.transform = `translateY(-${ this.textarea.scrollTop }px)`;
            
            if (Math.abs(
                this.numbers.offsetHeight
                    - this.textarea.offsetHeight
                    - this.textarea.scrollTop) < 100) {
                this.addMoreNumbers();
            }
        });
    }
};

const textarea = new CustomTextarea(document.querySelector('.custom-textarea'));
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
