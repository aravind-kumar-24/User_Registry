function sanitizeTextFields(name){
    name.addEventListener('input', function(){

        //This regex restrict the user from entering empty space at the beginning
        this.value = this.value.replace(/^\s+/, '');

        //This regex restrict the user from not entering more than one empty space inbetween
        this.value = this.value.replace(/\s{2,}/g, ' ');

        this.value = trim(this.value);
    })
}

function sanitizeEmailFields(email){
    email.addEventListener('input', function(){

        //This regex restrict the user from entering empty spaces anywhere.
        this.value = this.value.replace(/\s/g, '');
    })
}

function sanitizeNumberFields(number){
    number.addEventListener('input', function(){

        //This regex restrict the user from entering empty spaces anywhere.
        this.value = this.value.replace(/\s/g, '');

        //This regex restrict the user from entering any non-digit characters
        this.value = this.value.replace(/\D/g, '');

        if(this.value.length > 10){
            this.value = this.value.slice(0, 10);
        }
    })
}

function sanitizePasswordFields(password){
    password.addEventListener('input', function(){

        //This regex restrict the user from entering empty spaces anywhere.
        this.value = this.value.replace(/\s/g, '');

        if(this.value.length > 10){
            this.value = this.value.slice(0, 20);
        }
    })
}

function passwordEyeIcon(password, icon){
    icon.addEventListener('click', function(){
        if(password.type == 'password'){
            password.type = "text";
            icon.src = "../../assets/images/eye_opened.png";
        }else{
            password.type = "password";
            icon.src = "../../assets/images/eye_closed.png";
        }
    })
}
