<html>
<head>
<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">

function CheckForm() {
  if (confirm("確認要送出本表單嗎？") == true)
    return true;
  else
    return false;
}

var flag;
$(document).ready(function(){
  $("#bt1").click(function(){
  	flag = CheckForm();
  	if(flag){
    	$("#bt2").click();
    }
  });
});

function slide(){$("p").slideToggle();}

</script>
</head>
<body>
<p>这是一个段落。</p>
<button id="bt1">bt1</button>
<button id="bt2" onclick="slide()" >bt2</button>
</body>
</html>