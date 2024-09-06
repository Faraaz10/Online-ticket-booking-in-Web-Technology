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
  