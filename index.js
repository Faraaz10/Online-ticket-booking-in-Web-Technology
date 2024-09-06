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