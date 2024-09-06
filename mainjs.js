search=document.querySelector('.search')
document.querySelector('#search-btn').onclick=()=>{
    search.classList.toggle('active');
}




window.onscroll=()=>{
    search.classList.toggle('active');
    if(window.scrollY>80){
        document.querySelector('.header1 ').classList.add('active');
    }
    else{
        document.querySelector('.header1').classList.remove('active');
    }
}

window.onload=()=>{
    if(window.scrollY>80){
        document.querySelector('.header1').classList.add('active');
    }
    else{
        document.querySelector('.header1').classList.remove('active');
    }


    fadeOut();
}




let loginform=document.querySelector('.form-container');

document.querySelector('#login').onclick=()=>{
    loginform.classList.toggle('active');
}
document.querySelector('#close-btn').onclick=()=>{
    loginform.classList.remove('active');
}







/*let loginForm = document.querySelector('.form-container#login-form');
let userDetails = document.querySelector('.form-container#user-details');
let loginButton = document.querySelector('#login');
let closeButton = document.querySelector('#close-btn');
let closeButton2 = document.querySelector('#user-details#close-btn2');

loginButton.onclick = () => {
    if (loginForm.style.display === 'block') {
        loginForm.style.display = 'none';
    } else {
        loginForm.style.display = 'block';
    }
}

closeButton.onclick = () => {
    loginForm.style.display = 'none';
    userDetails.style.display = 'none';
}

closeButton2.onclick = () => {
    loginForm.style.display = 'none';
    userDetails.style.display = 'none';
}*/





function loader(){
  document.querySelector('.loader-container').classList.add('active');
}

function fadeOut(){
  setTimeout(loader,2000);
}




var swiper = new Swiper(".slider",{
    loop:true,
    centeredSlides:true,
    autoplay:{
        delay:9500,
        disableOnInteraction:false,
    },
    breakpoints: {
      640: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
    },
  });





  var swiper = new Swiper(".featured-slider",{
    spaceBetween:10,
    loop:true,
    centeredSlides:true,
    autoplay:{
        delay:9500,
        disableOnInteraction:false,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      450: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 3,
      },
      1024: {
        slidesPerView: 4,
      },
    },
  });





var swiper = new Swiper(".arrivals-slider",{
    spaceBetween:10,
    loop:true,
    centeredSlides:true,
    autoplay:{
        delay:9500,
        disableOnInteraction:false,
    },
   
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
    },
  });





  
var swiper = new Swiper(".reviews-slider",{
  spaceBetween:10,
  loop:true,
  centeredSlides:true,
  autoplay:{
      delay:9500,
      disableOnInteraction:false,
  },
 
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
  },
});