/*由於表單外掛Contact Forms 7的設計方式，這個Javascript必須要引入在footer底下，和其他的snippets用法不同*/

/*判定為編輯模式時，變更表單的事件*/
function AdminMode() {
  /*以表單中的id_FormPage_addmsg標籤定址，便可找到表單元素(Form element)*/
  var Formtag = document.getElementById("id_FormPage_addmsg").parentElement;
  /*將表單傳送路徑變更，以防止誤傳資料*/
  Formtag.action = "#";

  /*嵌入訊息標籤告知編輯人員*/
  var node = document.createElement("DIV"); //這是創造<div>標籤元素語法
  var textnode = document.createTextNode("已設定為編輯模式誤觸submit按鈕不會傳送資料");
  node.appendChild(textnode);
  document.getElementById("id_FormPage_addmsg").appendChild(node);
}

/*header file的php檔案若偵測本頁面是管理人員編輯頁面，則會設置id_It_is_Administrator標籤*/
var existAdmin = document.getElementById("id_It_is_Administrator");
/*若標籤id存在*/
if (existAdmin) {
  /*將表單設定為編輯者模式*/
  AdminMode();
}

/*取得HTTP Get值*/
function httpGet() {
  /*利用location.href取得網址，並存入變數*/
  var getUrlString = location.href;
  /*將字串轉成URL*/
  var url = new URL(getUrlString);
  /*使用URL.searchParams + get 取得HTTP Get值*/
  return String(url.searchParams.get('pos'));
}

/*將副標題的位置資訊改成本頁面應顯示的的位置*/
document.getElementById("id_FormPage_pos_tittle").innerHTML = httpGet();

/*將特定欄位給予預設值*/
/*src: https://www.w3schools.com/jsref/dom_obj_text.asp*/
function AutoInsert_Lock_Field() {
  var x = document.getElementById("id_FormPage_position");
  x.setAttribute("value", httpGet());
  //x.setAttribute("type", "hidden");這是用來隱藏物件的語法
  //x.value = httpGet();這是另一種更改value的方式，不會更改實際值，只更改顯示值
  //x.disabled = true; 鎖定欄位的語法(注意！表單寄送請勿設此語法，經測試很多次發現這樣會傳不出去，請改用hidden)
}
AutoInsert_Lock_Field();


/*當使用者按下送出時，會跳出詢問視窗，讓使用者有機會檢查資料*/
function CheckForm() {
  if (confirm("確認要送出本表單嗎？") == true)
    return true;
  else
    return false;
}


var flag;
  $("#id_FormPage_trigger_bt").click(function(){
  	flag = CheckForm();
  	if(flag){
    	$("#id_FormPage_submit_bt").click();
    }
  });

/*當表單送出之後、寄信之前，對DB更新欄位的效期，更多API可查詢Contact Form 7: DOM events*/
document.addEventListener('wpcf7mailsent', function (event) {
  if (event.detail.contactFormId == '242') {
    /*更新DB的位置效期(設為已劃位)*/
    JS_call_jQuery();
  }
}, false);

