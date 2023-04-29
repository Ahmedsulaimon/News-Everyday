
//this code was gotten from w3school
//https://www.w3schools.com/howto/howto_js_collapsible.asp
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
//code to create word count was gotten from YouTube
//https://www.youtube.com/watch?v=Ev5In-UI5sc
let maxcount = 450;
let maxCouuntForHeadline = 100;
const countDisplay = document.querySelector('.word-count');
const textAreaLimit = document.querySelector('.text-area-size');
const countDisplayForHeadline = document.querySelector('.word-count-for-headline');
const textAreaLimitForHeadline = document.querySelector('.headline-textarea');

function countWords(self){
    let spaces = self.value.match(/\S+/g);
    let wordCount = spaces ? spaces.length : 0;
    let words = self.value.match(/\S+/g);
    let count = words.length;
    if(count>=maxcount) self.value = words.slice(0,maxcount).join(" ");
   

    countDisplay.innerHTML = wordCount;

}
    
function countWordsForHeadline(self){
    let spaces = self.value.match(/\S+/g);
    let wordCount = spaces ? spaces.length : 0;
    let words = self.value.match(/\S+/g);
    let count = words.length;
    if(count>=maxCouuntForHeadline ) self.value = words.slice(0,maxCouuntForHeadline ).join(" ");
   

    countDisplayForHeadline.innerHTML = wordCount;

}
//for contact form
const myForm = document.getElementById('myForm');
const fname = document.getElementById('name');
const message = document.getElementById('message');
const email = document.getElementById('email');


myForm.addEventListener('submit', e => {
    e.preventDefault();

    validateInputs();
});

const validateInputs = () => {
     fname.value.trim();
     message.value.trim();
     email.value.trim();

    if(fname !== '' && message !== '' && email !== ''){
        alert("FORM SUBMISSION WAS SUCCESSFUL"); 
        document.getElementById("myForm").reset();
    }
};

  