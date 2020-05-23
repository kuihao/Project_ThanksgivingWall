/*由於表單外掛的設計，這個Javascript必須要引入在footer底下，和其他的snippets用法不同*/

/*取得HTTP Get值*/
function httpGet(){
    /*利用location.href取得網址，並存入變數*/
    var getUrlString = location.href;
    /*將字串轉成URL*/
    var url = new URL(getUrlString);
    /*使用URL.searchParams + get 取得HTTP Get值*/
    return String(url.searchParams.get('pos'));

}

/*將副標題的位置資訊改成本頁面應顯示的的位置*/
document.getElementById("id_FormPage_pos_tittle").innerHTML = httpGet();

/*將特定欄位給予預設值並加以鎖定*/
/*src: https://www.w3schools.com/jsref/dom_obj_text.asp*/
function AutoInsert_Lock_Field(){
    var x = document.getElementById("id_FormPage_position"); 
    // x.setAttribute("type", "hidden");這是用來隱藏物件的語法
     x.setAttribute( "value", httpGet() );
    //x.value = httpGet();這是另一種更改value的方式
    //x.disabled = true; 注意！表單寄送請勿設此語法，經測試很多次發現這樣會傳不出去，請改用hidden
}
AutoInsert_Lock_Field();

/*----------------------------------------*/
window.onload=function(){
ChangeDisabled();
}

function CheckForm()
{
  if(confirm("確認要送出本表單嗎？")==true)   
    /*這邊應該可以ajax*/
    return true;

  else  

    return false;
}   

<script defer="defer">
//alert("頁面載入完我才執行的")

on_submit: "CheckForm();"

<script type="text/javascript">

</script>

document.addEventListener( 'wpcf7submit', function( event ) {
  if ( '242' == event.detail.contactFormId ) {
    alert( "The contact form ID is 242." );
    /*取得HTTP Get值*/
function httpGet(){
    /*利用location.href取得網址，並存入變數*/
    var getUrlString = location.href;
    /*將字串轉成URL*/
    var url = new URL(getUrlString);
    /*使用URL.searchParams + get 取得HTTP Get值*/
    return url.searchParams.get('pos');
}

/*將特定欄位給予預設值並加以鎖定*/
/*src: https://www.w3schools.com/jsref/dom_obj_text.asp*/
function ChangeDisabled(){
    var x = document.getElementById("id_position"); 
    // x.setAttribute("type", "hidden");
    x.setAttribute( "value", httpGet() );
    x.disabled = true;
}
ChangeDisabled();
  }
}, false );

var wpcf7Elm = document.querySelector( '.wpcf7' );
 
wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {
  alert( "Fire!" );
}, false );

<span class="wpcf7-form-control-wrap position">
    <input type="text" name="position" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" id="id_position" aria-required="true" aria-invalid="false">
    <script type="text/javascript">
    alert( "Fire!" );
    var getUrlString = location.href;
    var url = new URL(getUrlString);
    var v = url.searchParams.get('pos');
    var x = document.getElementById("id_position");
    x.setAttribute( "value", v );
    x.disabled = true;
    alert( "Fire2!" );
    </script>
</span>


    var getUrlString = location.href;
    var url = new URL(getUrlString);
    var v = url.searchParams.get('pos');
    var x = document.getElementById("id_position");
    x.setAttribute( "value", v );

document.addEventListener( 'wpcf7submit', function( event ) {
    console.log(event.detail.contactFormId);
}, false );


detail.contactFormId	The ID of the contact form. 這張聯絡表單的短碼裡的ID
detail.pluginVersion	The version of Contact Form 7 plugin.
detail.contactFormLocale	The locale code of the contact form.
detail.unitTag	The unit-tag of the contact form.
detail.containerPostId	The ID of the post that the contact form is placed in. 這個WP頁面的ID

<script>alert("確認要送出本表單嗎？");confirm("確認要送出本表單嗎？");</script>

<script type="text/javascript">
document.addEventListener( 'wpcf7submit', function( event ) {
    if ( event.detail.contactFormId == '242' ) {
        console.log(event.detail);
        alert(document.getElementById("id_form_name").value);
    }
}, false );
</script>
取得欄位是有效 可以船個重要的回booking

setTimeout(ChangeDisabled(), 3000);

//setTimeout(ChangeDisabled(), 3000);
//setTimeout(function(){ alert("Hello"); }, 3000);

