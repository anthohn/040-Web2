//  ETML
//	Author      : Younes Sayeh
//	Date        : 10.05.2021
//	Description : Main js page


const actualBtn = document.getElementById('upload');
const fileChosen = document.getElementById('fileChosen');
// let btn = document.querySelector("#btnSubmit");

// Check if the submit button is checked
// btn.addEventListener("click", active);
// function active() {
//   btn.classList.toggle("is_active");
// }

// Check if an image is upload
actualBtn.addEventListener('change', function(){
  fileChosen.textContent = this.files[0].name
})