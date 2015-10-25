function checkPassStrength() {
    var passTextBox = document.getElementById("status");
    var password = passTextBox.value;
    var specialCar = "!@#$%^&*?_";
    var passScore = 0;
    
    for(var i=0; i<password.length; i++){
        //check if password contains one of these char, loop through each char
        //if the char can be found in specialchar var the index will be > -1
        if(specialCar.indexOf(password.charAt(i)) > -1){
            passScore += 20;   
        }
        
        if(/[a-z]/.test(password)) {
            passScore += 20;   
        }
        
        if(/[A-Z]/.test(password)) {
            passScore += 20;   
        }
        
        if(/[\d]/.test(password)) {
            passScore += 20;   
        }
        
        if(password.length >=8) {
            passScore += 20;   
        }
        
        var strength = "";
        var backgroundColour ="";
        
        if (passScore >= 100) {
            strength = "Strong";
            backgroundColour = "green";
        }
        
        else if (passScore >= 80){
            strength = "Medium";
            backgroundColour = "grey";
        }
        
        else if (passScore >= 60){
            strength = "Weak";
            backgroundColour = "maroon";
        }
        else{
            strength = "Very Weak";
            backgroundColour = "maroon";
            
        }
        
        document.getElementById("label").innerHTML =strength;
        passTextBox.style.color="white";
        passTextBox.style.backgroundColor = backgroundColour;
    }
    
    
    
}