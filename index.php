<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet/less" type="text/css" href="style.less" />
    <script src="//cdn.jsdelivr.net/npm/less" ></script>
    <title>Document</title>
</head>
<body>
  <div class="Container1">
    <h1 class="title1">PHP Compiler</h1>
    <form action="index.php" method="post">
    <div class='custom-textarea'>
      <textarea spellcheck="false" class='textarea' name="code" id="code" cols="100" rows="25" required><?php echo "<?php\n\necho \"Hello World\";\n"?>
      </textarea>
      <div class='linenumbers'></div>
    </div>
    </div>
    <input type="submit" id="button" name="submit" value="RUN">
  </form>
</div>

<div class="Container2">
  <h2 class='heading'>Result</h2>
  <div id="result"></div>
</div>

<div class="Container3">
  <h2 class='heading2'>Files</h2>
  <div id="files"></div>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">File Content</h4>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
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

function readFile(x)
{ 
  var fileName = $(x).attr("id");
  console.log(fileName);
  var fileURL= '/Online-PHP-Interpreter/';
  fetch(fileURL.concat(fileName))
    .then( r => r.text() )
    .then( t => 
    $('.modal-body').html(t) 
    )
    $('#myModal').modal("show"); 
}

function RUN()
{
  $.ajax({
    type:"GET",
    url: 'result.php',
    success: function(response){
      $("#result").html(response);
    }
  });
  $.ajax({
    type:"GET",
    url: 'listFiles.php',
    success: function(response){
      $("#files").html(response);
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
