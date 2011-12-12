function validate() {
   // make sure field is not blank
   if (document.register.username.value=="" || document.register.username.value == undefined){
      alert("Username cannot be blank");
      return false;
   }

   if (document.register.name.value=="" || document.register.name.value == undefined){
      alert("Name cannot be blank");
      return false;
   }

   // validate an e-mail address
   if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(document.register.email.value)){
      alert("Email formatted incorrectly");
      return false;
   }

   if (document.register.password.value=="" || document.register.password.value==undefined) {
      alert("Password can not be blank");
      return false;
   }

   if (document.register.password.value!=document.register.confirm_password.value) {
      alert("Password confirmation must match")
      return false;
   }

   return true;
}
