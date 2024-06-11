function checkPassword() {
    let pass = document.getElementById("pd").value;
    let cpass = document.getElementById("cpd").value;
    if (pass != cpass) {
        document.getElementById("demo").innerHTML = "Password didn't match";
        document.getElementById("cpd").value=null;
    }
    else  document.getElementById("demo").innerHTML="";
}