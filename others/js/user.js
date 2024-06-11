function myfunction(){
    location.href='#about';
    var x=document.querySelector(".about");
    document.querySelector(".ffq").setAttribute("style", "display:block");
    document.querySelector(".ff").setAttribute("style", "display:none");
    x.setAttribute("style", "display:block");
}
function mydunction(){
    location.href='#head';
    var x=document.querySelector(".about");
    x.setAttribute("style", "display:none");
    document.querySelector(".ffq").setAttribute("style", "display:none");
    document.querySelector(".ff").setAttribute("style", "display:block");
}