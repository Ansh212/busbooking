function validateForm() {
  let pass = document.forms['reset']['pass'].value;
  let confirmpass = document.forms['reset']['repass'].value;
  let perror =  document.getElementById('password-error');
  let cerror =  document.getElementById('confirm-error'); 
console.log(pass);
console.log(confirmpass);
  const uppercaseRegex = /[A-Z]/;
  const lowercaseRegex = /[a-z]/;
  const numberRegex = /[0-9]/;
  const symbolRegex = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/;
  
 
 
  if(uppercaseRegex.test(pass) && lowercaseRegex.test(pass) && symbolRegex.test(pass) &&
      numberRegex.test(pass) && pass.length >= 8){
    if(pass===confirmpass){
      return true;
    }
    else{
      cerror.removeAttribute('hidden');
      document.getElementById('confirm-error').innerHTML = 'Passwords do not match.';
      return false;
    }
  }
  else{
    perror.removeAttribute('hidden');
    document.getElementById('password-error').innerHTML = 'Password not strong enough';
    return false;
  }
}
