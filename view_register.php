
<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <meta charset="UTF-8">
<style type="text/css">
.bgimg {
    background-image: url('captchaO.png');
    width:197px;
    height:50px;
}
    .captcha { 
        font-size: 20px;
    padding-left: 30px;
    padding-top: 10px;
    color: #544c08;
    font-style: oblique;
}
</style>
    <script type="text/javascript">
        var randNumber;
       window.onload = function(){
             var n = 255;
              randNumber = Math.ceil(Math.random()*n)*n;
             document.getElementById("paraCaptcha").innerHTML = randNumber;
        };
        function validateAll() {

        }

        function captchaFilled() {
            var cap = document.getElementById("txtCaptchaCode").value;

            if (cap != "") {
                return true;
            }
            //alert("Invalid email address!")
            return false;
        }

        function emailIsValid() {
            var email = document.getElementById("txtEmail").value;

            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                checkUser(storeState)
                return true;
            }
            //alert("Invalid email address!")
            return false;
        }

        function usernameIsNotEmpty() {
            var username = document.getElementById("txtName").value;

            if (username != "") {
                return true;
            }
            //alert("Enter a username. ")
            return false;
        }

        function passwordsMatch() {

            var password = document.getElementById("txtPassword").value;
            var confirmPassword = document.getElementById("txtConfirmPassword").value;
            if (password != confirmPassword) {
                //alert("Passwords do not match.");
                return false;
            } else if (password == "" && confirmPassword == "") {
                //alert("Enter valid passwords.");
                return false;
            } else {
                //passwordSet = password;
                //getPassword(passwordSet);

                return true;
            }
        }

        var readyToSubmit; //global access for submit button

        function check(sender) {
            document.getElementById("lblUsernameError").innerHTML = "";
            document.getElementById("lblEmailError").innerHTML = "";
            document.getElementById("lblPasswordError").innerHTML = "";
            document.getElementById("lblCaptchaError").innerHTML = "";
            
            

            if (usernameIsNotEmpty() && emailIsValid() && passwordsMatch() && captchaFilled()) {
                return true;
            }
            if (!usernameIsNotEmpty()) {
                document.getElementById("lblUsernameError").innerHTML = "Enter a username. ";

            }
            if (!emailIsValid()) {
                document.getElementById("lblEmailError").innerHTML = "Invalid email address. ";

            }
            if (!passwordsMatch()) {
                document.getElementById("lblPasswordError").innerHTML = "Enter valid passwords. ";

            }
            if (!captchaFilled()) {
                document.getElementById("lblCaptchaError").innerHTML = "Enter captcha code. ";

            } 
            
            return false;
            
            var errorLabel = document.getElementById("lblUserError");
            
            if(sender.id == "txtEmail" && !emailIsValid()){ 
            document.getElementById("lblEmailError").innerHTML = "Invalid email address. ";
             
            }

            if (sender.value.length == 0 || sender.value == "") {
                errorLabel.innerHTML = sender.name + " is required";
                return false;
            } else {
                checkUser(storeState);
            }            
          
            return readyToSubmit;
        } //check

        function storeState(state) { //this function stores what the request object returns
            readyToSubmit = state;
        }



        function checkUser(storeState) {

            var typedUsername = document.getElementById("txtName").value;
            var typedEmail = document.getElementById("txtEmail").value;
            var typedCaptcha = document.getElementById("txtCaptchaCode").value;

            var typedPassword = document.getElementById("txtPassword").value;

            var typedConfirmPassword = document.getElementById("txtConfirmPassword").value;




            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   var returnedText = this.responseText.replace(/<(?:.|\n|\r)*?>/g, '').trim();
                    
                    if ( returnedText == "0" || returnedText=="" ) {

                        document.getElementById("lblUserError").innerHTML = "";
                        var isAvailable = true;
                        storeState(isAvailable);
                    } else {
                        document.getElementById("lblUserError").innerHTML = returnedText;
                        
                        if (returnedText == "Username Taken") {
                            document.getElementById("lblUsernameError").innerHTML = returnedText;

                        }
                        if (returnedText == "Email Taken") {
                            document.getElementById("lblEmailError").innerHTML = returnedText;

                        }
                        if (returnedText == "Wrong captcha") {
                            document.getElementById("lblCaptchaError").innerHTML = returnedText;

                        }

                        if (returnedText == "Password do not match") {
                            document.getElementById("lblPasswordError").innerHTML = returnedText;

                        }

                        var isAvailable = false;
                        storeState(isAvailable);
                    }
                }
            }

            xmlhttp.open("POST", "model_register.php/?username=" + typedUsername + "&email=" + typedEmail + "&enteredCaptcha=" + typedCaptcha + "&password=" + typedPassword + "&confirmPassword=" + typedConfirmPassword +"&generatedCaptcha="+randNumber);
            xmlhttp.send();

        } //checkUser

        function outputError() {


        }

    </script>
<link type="text/css" rel="stylesheet" href="style.css" />
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="inside">
    <div class="inn">
    <a href="index.php">Home</a>
    <form id="frmRegister" action="view_verify.php" method="post">
        <div>
            <h2>Register</h2>
            <label id="lblName">Username:</label>
            <input type="text" id="txtName" name="username" onblur="check(this);" minlength="1" ; maxlength="20" ;>
            <label style="color:blue;" id="lblUsernameError"></label>

        </div>

        <div>
            <label id="lblPassword">Password:</label>
            <input type="password" id="txtPassword" name="password" minlength="1" onblur="check(this);" >

        </div>

        <div>
            <label id="lblConfirmPassword">Re-enter Password:</label>
            <input type="password" id="txtConfirmPassword" name="confirmPassword" minlength="1" onblur="check(this);" >
            <label style="color:blue;" id="lblPasswordError"></label>

        </div>

        <div>
            <label id="email">Email:</label>
            <input type="email" id="txtEmail" name="email" onblur="check(this);">
            <label style="color:blue;" id="lblEmailError"></label>

        </div>

        <div>
           <!--<img src="model_captcha.php" id="captchaimg">-->
            <div class="bgimg">
               <p id="paraCaptcha" class="captcha"></p> 
             
            </div>
            <br>
            <label id="lblcaptcha">Enter the code above here :</label>

            <input type="text" id="txtCaptchaCode" name="cVercode" >
        
            <input id="btnRegister" type="submit" value="Register" name="doRegister"  onclick="return check(this);">
        

            <label style="color:blue;" id="lblCaptchaError"></label>

        </div>
        <br>
        <label style="color:red;" id="lblUserError"></label>


    </form>
</div>
        </div>

</body>


</html>
