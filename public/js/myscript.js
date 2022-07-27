function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}
function myFunction2() {
  document.getElementById("myDropdown2").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  ////////////////////////////////////////////////// user list
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }

/////////////////////////////////////////////////////// post list

if (!event.target.matches('#select_post_b')) {
  var post_list_id=document.getElementById('select_post_id_input').value;
    document.getElementById(post_list_id).style.display='none';
  }

  //////////////////////////////////////////////////////////////

}

////////////////////////////////////////////////////////////////////////////////////////
function pgshow(){
    document.getElementById('username').value='';
    document.getElementById('password').value='';

}
function hide_comments_div(){
  var value=document.getElementById('comments_list_show_ch').value;
  if(value=='1'){
  document.getElementById('comments_list').style.display='none';
  document.getElementById('comments_list_show_ch').value='0';
 }
 else{
  document.getElementById('comments_list_show_ch').value='1';
  document.getElementById('comments_list').style.display='';
 }
}



function select_post_show(post_id){

  var select_id="select_post"+post_id;
  var ch= document.getElementById('select_show_var').value;
  ///////////////////////////////////// hide last one 
 
 if(ch==1){
  document.getElementById(select_id).style.display='none';
  document.getElementById('select_show_var').value=0;
  document.getElementById('select_post_b').style.display='';
 }
 else{
  document.getElementById('select_post_b').style.display='';
  document.getElementById(select_id).style.display='';
  document.getElementById('select_show_var').value=1;
  
 }

}



function profile(){
  document.getElementById('url_txt').value=document.getElementById('url').value;;
  var url=document.getElementById('url_txt').value;
  // alert(url);
}

function del_post_img(){
  document.getElementById('stay_post_photo').value=0;
  document.getElementById('profile_img').style.display='none';
  document.getElementById('del_post_img_btn').style.display='none';
  document.getElementById('ret_post_img_btn').style.display='';
  document.getElementById('url').value='';
  var url=document.getElementById('url').value;
  //alert(url);

}

function ret_post_img(){
  document.getElementById('stay_post_photo').value=1;
  document.getElementById('profile_img').style.display='';
  document.getElementById('del_post_img_btn').style.display='';
  document.getElementById('ret_post_img_btn').style.display='none';

}

function selectpostimg(){
  document.getElementById('stay_post_photo').value=1;
  document.getElementById('profile_img').style.display='none';
  document.getElementById('del_post_img_btn').style.display='';
  document.getElementById('ret_post_img_btn').style.display='none';
  var url=document.getElementById('url').value;
  //alert(url);

}


function new_category22(){
 var selected=document.getElementById('category_id').value;
 if(selected=='new_category'){
  document.getElementById('new_category').style.display='';
  }
  else{
     document.getElementById('new_category').style.display='none';
  }


}





