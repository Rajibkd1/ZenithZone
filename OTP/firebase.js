window.onload = function(){
    render();
};
var coderesult;
function phoneAuth(){
    var number = document.getElementById('number').value;
    firebase.auth().signInWithPhoneNumber(number).then(function(confirmationResult){
        window.confirmationResult = confirmationResult;
        coderesult = confirmationResult;
        console.log(coderesult);
        alert("Message sent, Please verify your phone number");

    }).catch(function(error)){
        
    }
}