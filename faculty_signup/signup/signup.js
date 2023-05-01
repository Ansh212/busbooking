function validateForm() {
  let name = document.forms['signup']['name'].value;
  let pass = document.forms['signup']['pass'].value;
  let user = document.forms['signup']['pass'].value;
  let nerror =  document.getElementById('name-error');
  let perror =  document.getElementById('password-error');
  let cerror =  document.getElementById('confirm-error');
  let uerror =  document.getElementById('user-error')

  let confirmpass = document.forms['signup']['repass'].value;


  const uppercaseRegex = /[A-Z]/;
  const lowercaseRegex = /[a-z]/;
  const numberRegex = /[0-9]/;
  const symbolRegex = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/;
  
 
  if(name.length===0){
    nerror.removeAttribute('hidden');
    document.getElementById('name-error').innerHTML = 'Enter your name.';
    return false;
  }
  else{
    document.getElementById('name-error').innerHTML = '';
  }

  if(user.length==0){
    uerror.removeAttribute('hidden');
    document.getElementById('user-error').innerHTML = 'Enter your Faculty Id'
  }
  else{
    document.getElementById('user-error').innerHTML = '';
  }

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
