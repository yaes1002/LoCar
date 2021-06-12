
/////////////////////////    Login/Sign up form      //////////////////////////////

function ShowLogin() {
  LoginAreaBtn = document.getElementsByClassName("loginAreaBtn")[0];
  SignUpAreaBtn = document.getElementsByClassName("signUpAreaBtn")[0];
  LoginAreaBtn.classList.remove("ShadowedAreaBtn")
  SignUpAreaBtn.classList.add("ShadowedAreaBtn");

  document.getElementsByClassName("LoginForm")[0].classList.remove("hideForm");
  document.getElementsByClassName("signUpForm")[0].classList.add("hideForm");

}


function ShowSignUp() {
  LoginAreaBtn = document.getElementsByClassName("loginAreaBtn")[0];
  SignUpAreaBtn = document.getElementsByClassName("signUpAreaBtn")[0];
  SignUpAreaBtn.classList.remove("ShadowedAreaBtn");
  LoginAreaBtn.classList.add("ShadowedAreaBtn");
  
  document.getElementsByClassName("signUpForm")[0].classList.remove("hideForm");
  document.getElementsByClassName("LoginForm")[0].classList.add("hideForm");
}

/////////////////////////    Car Infos     //////////////////////////////

function CarInfosRedirect(VehiculeId)
{
  window.location.href = "voitureinfos.php?id=" + VehiculeId ;
}


/////////////////////////    set date in search form   //////////////////////////////

function setTodayDate()
{
  var todayDate = new Date();
  todayDate = todayDate.getFullYear() + '-' + ('0' + (todayDate.getMonth() + 1)).slice(-2) + '-' + ('0' + todayDate.getDate()).slice(-2);

  document.getElementsByClassName("dateLoc")[0].value = todayDate;;
  document.getElementsByClassName("dateLoc")[1].value = todayDate;
  //setMinMaxDate();
}


function setMinMaxDate()
{
  var todayDate = new Date();
  todayDate = todayDate.getFullYear() + '-' + ('0' + (todayDate.getMonth() + 1)).slice(-2) + '-' + ('0' + todayDate.getDate()).slice(-2);
  
  document.getElementById("dateDebut").setAttribute("min", todayDate);
  document.getElementById("dateFin").setAttribute("min", document.getElementById("dateDebut").value);
}


/////////////////////////////////    Afficher le price total de location   //////////////////////////////////////////

function getCarPrice()
{
  var carPricePerDay = document.getElementById('carPricePerDay').textContent;
  var fullDate = document.getElementById('datePicker').value;

  var DebutDate = new Date(fullDate.substr(0, 10));
  var FinDate = new Date(fullDate.substr(13, 10));

  var DaysBetweem =  ( FinDate.getTime() - DebutDate.getTime() )  / ( 1000*3600*24 ) + 1 ;
  if(fullDate)
  {
    var carPriceFull = carPricePerDay * Math.round(DaysBetweem) ;

    if( !isNaN(carPriceFull) )
    {
      document.getElementById('carPriceFull').innerHTML = carPriceFull +'<span>MAD</span>';
      document.getElementById('NbrJoursText').innerHTML = '<p id="nbrJours">Pour ' + Math.round(DaysBetweem)+ ' Jours</p>';
      document.getElementsByClassName('carInfosFullPriceCont')[0].classList.add("ShowFullPrice");
      document.getElementsByClassName('carReserverBtnCont')[0].classList.add("ShowReserveBtn");
      
    }
    else
    {
      document.getElementsByClassName('carInfosFullPriceCont')[0].classList.remove("ShowFullPrice");
      document.getElementsByClassName('carReserverBtnCont')[0].classList.add("ShowReserveBtn");
    }
    

  }
}


function TodayDate()
{
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = today.getFullYear();
  
  today = mm + '/' + dd + '/' + yyyy;
  return today;
}


function addDays( days) {
  const date = new Date();
  const copy = new Date(Number(date))
  copy.setDate(date.getDate() + days)
  return copy;
}

















(function() {
  "use strict";


   const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }


  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

  
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  
  const scrollto = (el) => {
    let header = select('#header')
    let offset = header.offsetHeight

    let elementPos = select(el).offsetTop
    window.scrollTo({
      top: elementPos - offset,
      behavior: 'smooth'
    })
  }

  
  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
      } else {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  
  on('click', '.mobile-nav-toggle', function(e) {
    select('#navbar').classList.toggle('navbar-mobile')
    this.classList.toggle('bi-list')
    this.classList.toggle('bi-x')
  })

  on('click', '.navbar .dropdown > a', function(e) {
    if (select('#navbar').classList.contains('navbar-mobile')) {
      e.preventDefault()
      this.nextElementSibling.classList.toggle('dropdown-active')
    }
  }, true)

  on('click', '.scrollto', function(e) {
    if (select(this.hash)) {
      e.preventDefault()

      let navbar = select('#navbar')
      if (navbar.classList.contains('navbar-mobile')) {
        navbar.classList.remove('navbar-mobile')
        let navbarToggle = select('.mobile-nav-toggle')
        navbarToggle.classList.toggle('bi-list')
        navbarToggle.classList.toggle('bi-x')
      }
      scrollto(this.hash)
    }
  }, true)

  
  window.addEventListener('load', () => {
    if (window.location.hash) {
      if (select(window.location.hash)) {
        scrollto(window.location.hash)
      }
    }
  });

  
  let preloader = select('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove()
    });
  }


})()


