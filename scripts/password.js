
/* ########### Function for password validation ########### */
function  validate(){
   let password_value1 = document.querySelector('#password1').value;
   let password_value2 = document.querySelector('#password2').value;

   if (password_value1.length < 8 || password_value2.length < 8) {
      alert("both passwords must be greater than seven characters");
      return false;
   }
   else if(password_value1.indexOf(" ")!=-1){
      alert("password must not contain space");
      return false;
   }
   else{
      return true;
   }
}


/* ########### References ########### */
let show_text1 = document.querySelector(".show1");
let show_text2 = document.querySelector(".show2");
let password1 = document.querySelector("#password1");
let password2 = document.querySelector("#password2");

show_text1.addEventListener('click', ()=>{
   if (password1.type === "password") {
      password1.type = "text";
      show_text1.innerHTML = "HIDE";
   }
   else{
      password1.type = "password";
      show_text1.innerHTML = "SHOW";
   }
});

show_text2.addEventListener('click', ()=>{
   if (password2.type === "password") {
      password2.type = "text";
      show_text2.innerHTML = "HIDE";
   }
   else{
      password2.type = "password";
      show_text2.innerHTML = "SHOW";
   }
});

