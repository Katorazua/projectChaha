const form = document.querySelector(".signup form"),
continueBtn = form.querySelector(".button input");

form.onsubmit = (e) => {
    e.preventDefault(); //preventing form from submitting
}
continueBtn.onclick = ()=>{
    //sseting Ajax
    let xhr = new XMLHttpRequest(); //creating ajax object
    xhr.open("POST", "sta.php", true);
    xhr.onload = ()=>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let data = xhr.response;
                console.log(data);
            }
        }
    }
    // we have to send the form part "status" through ajx to php
    let formData = new FormData(form); //creating new formData object
    xhr.send(formData); //sendingthe form data to php
}