
//---------------    SideBar functions   --------------------------------//

//------------- SHOW NAVBAR ----------------// 
const showNavbar = (toggleId, navId, bodyId, headerId,mainClass) =>{
  const toggle = document.getElementById(toggleId),
  nav = document.getElementById(navId),
  bodypd = document.getElementById(bodyId),
  headerpd = document.getElementById(headerId),
  mainpd = document.getElementsByClassName(mainClass)[0]

  // Validate that all variables exist
  if(toggle && nav && bodypd && headerpd && mainpd){
      toggle.addEventListener('click', ()=>{
          // show navbar
          nav.classList.toggle('show')
          // change icon
          toggle.classList.toggle('bx-x')
          // add padding to body
          bodypd.classList.toggle('body-pd')
          // add padding to header
          headerpd.classList.toggle('body-pd')
          // add padding to main
          mainpd.classList.toggle('main-pd')
      })
  }
}
showNavbar('header-toggle','nav-bar','body-pd','headerBar','main')


//------------- LINK ACTIVE-------------//

const linkColor = document.querySelectorAll('.navLink')

function colorLink(){
  if(linkColor)
  {
      linkColor.forEach(l=> l.classList.remove('active'))
      this.classList.add('active')
  }
}
linkColor.forEach(l=> l.addEventListener('click', colorLink));


// ---------------- show drop menu  --------------- //

x=0;
function ShowDropMenu()
{
  dropMenu = document.getElementById('dropMenu');

  if(x%2==0)
    dropMenu.classList.add('showDropMenu');
  else
    dropMenu.classList.remove('showDropMenu');
  x++;
}

// ---------------- Sorting Table  --------------- //

let tableId = "#voituresTable";
let headers = document.querySelectorAll(tableId + " th");

// Sort the table element when clicking on the table headers
headers.forEach(function(element, i) 
{
  element.addEventListener("click", function() 
  {
    w3.sortHTML(tableId, ".item", "td:nth-child(" + (i + 1) + ")");
  });
});

// ---------------- Show Table sorting Arrow  --------------- //

function showArrow(i) 
{
  var trTag = document.querySelector("#voituresTable tr");

  for (var index = 0; index < trTag.children.length ; index++ ) 
  {
    if( index == i)
      trTag.children[index].firstElementChild.classList.remove("hideArrow");
    else 
      trTag.children[index].firstElementChild.classList.add("hideArrow");  
  } 
}

// ---------------- Table search function  --------------- //

function FilterVoitureResult() {
  // Declare variables
  var input, filter, table, tr, td,tdLength, i,j ,txtValue,cpt;
  input = document.getElementById("searchInput");
  filter = input.value.toLowerCase();
  table = document.getElementById("voituresTable");
  tr = table.getElementsByTagName("tr");
  cpt = 0;
  // Loop through all table rows, and hide those who don't match the search query

  for (i = 1; i < tr.length; i++) 
  {
    tdLength = tr[i].getElementsByTagName("td").length;
    for (j = 0; j < tdLength-1; j++) 
    {
      td = tr[i].getElementsByTagName("td")[j];
      if (td) 
      {
        txtValue = td.textContent || td.innerText;
        
        if (txtValue.toLowerCase().indexOf(filter) > -1) 
        {
          tr[i].style.display = "";
          cpt++;
          break;
        }
        tr[i].style.display = "none";
      }
    }
  }

  document.getElementsByClassName("searchNumberRes")[0].innerHTML =  cpt ;
}


//document.getElementById.onload = function() {InitialiseNumberResults()}

function InitialiseNumberResults()
{ 
  var cpt = document.querySelectorAll("tr.item").length
  document.getElementsByClassName("searchNumberRes")[0].innerHTML =  cpt ; 
}


//---------------------- car image ------------------------------//

function showCarImg()
{
  const [file] = $(".carImageSrc")[0].files

  if (file) {
    carImage.src = URL.createObjectURL(file)
  }
  if($(".carImageSrc")[0].value=="")
  carImage.src = ""

}
function showCarImgModif()
{
  const [file] = $(".carImageSrc")[1].files
  if (file) {
    carImageModif.src = URL.createObjectURL(file)
  }
  if($(".carImageSrc")[1].value=="")
  carImageModif.src = ""
}

function hideCarImg()
{
  carImage.src = ""
}

//---------------------- Show table form ------------------------------//

function showTableForm(ModifAjout)
{
  ShowFirstFormPart();
  if(ModifAjout==1)
  $('#ajoutForm').fadeToggle();
  else if (ModifAjout==2)
  $('#modificationForm').fadeToggle();
  else
  $('#suppressionForm').fadeToggle();

  $('.blurBackground').fadeToggle("slow");
  $('.blackBlurBackground').fadeToggle("slow");
  $('.TableFormCont').fadeToggle();
  $('#AjoutTableForm').addClass('openTableForm');

}

function hideTableForm()
{

  $('.blurBackground').fadeOut("slow");
  $('.blackBlurBackground').fadeOut("slow");
  $('.TableFormCont').fadeOut();

  $('#ajoutForm').fadeOut("slow");
  $('#modificationForm').fadeOut("slow");
  $('#suppressionForm').fadeOut("slow");
  $('#AjoutTableForm').removeClass('openTableForm');
  $('#FormAjoutAlert').fadeOut("slow");
  $('#FormEditAlert').fadeOut("slow");
  
}

//---------------------- ErrorBorder ------------------------------//


function changeInputFileBorder()
{
  if($('.carImageSrc')[0].value=='')
    $('.custom-file-upload')[0].classList.add('ErrorBorder');
  else
    $('.custom-file-upload')[0].classList.remove('ErrorBorder');
}

function RemoveInputFileBorder()
{
    $('.custom-file-upload')[0].classList.remove('ErrorBorder');
}

//---------------------- modifification Voiture ------------------------------//

function  getModificationForm(id)
{

  getDisponibilites(id);
  ShowFirstFormPart();
  $.ajax({
    
    method: "POST", 
    url: "./scripts/voituregetinfos.php", 
    data: { vehicule_id: id}, 

    success: function(data) 
    {
      let voitureObject = JSON.parse( data );
      RemplirInput(voitureObject);
    },
  
  });
  showTableForm(2);

}

function RemplirInput(voitureObject)
{
  modificationForm = document.getElementById('modificationForm');
  ListInput = modificationForm.getElementsByTagName('input');

  inputValues = [voitureObject.vehicule_id,voitureObject.modele ,voitureObject.marque,voitureObject.annee ,voitureObject.matricule ,voitureObject.couleur ,voitureObject.kilometrage ,voitureObject.prix_j ,voitureObject.vehicule_image];
  selectValues = [voitureObject.boite_vitesse, voitureObject.energie,voitureObject.nbr_places,voitureObject.nbr_portes,voitureObject.gps,voitureObject.climat ];

  
  //------- input initialisation --------//
  for (i = 0; i < 7; i++) 
  {
    ListInput[i].value =  inputValues[i];
  } 
  ListInput[7].value = parseInt( inputValues[7]); 

  //ListInput[8].value = parseInt( inputValues[7]);
  //ListInput[9].value = inputValues[8];
  $('#carImageModif').attr("src",'../'+ inputValues[8]);

  //------- Select initialisation --------//
  Listselect = modificationForm.getElementsByTagName('select');
  for (i = 0; i <Listselect.length; i++) 
  {
    Select = Listselect[i];
    ListOption = Select.getElementsByTagName('option');
    
    for (j = 0 ; j <ListOption.length ; j++) 
    {
      if(ListOption[j].value==selectValues[i])
      ListOption[j].setAttribute('selected','');
    }

  }
}

//------------get voiture Disponibilites---------------//
function getDisponibilites(id)
{
  $.ajax({
    
    method: "POST", 
    url: "./scripts/voituregetdispo.php", 
    data: { vehicule_id: id}, 

    success: function(data) 
    {
      $('#intervalesCont').empty() ; 
      $('#intervalesCont').append(data) ; 
    },
  
  
  });
}

//------------show first Form part---------------//
function ShowFirstFormPart(){

  $(".seconFormPart").css({"-webkit-transform":"translate(+600px,0)",
                            "-ms-transform":"translate(+600px,0)",
                            "transform":"translate(+600px,0)"});

  $(".seconFormPart").css( {display:"none"});
  $(".firstFormPart").css({ display:"block"});

  $(".PreviousPartArrow").css( {display:"none"});          
  $(".NextPartArrow").css( {display:"inline"});  

  $(".firstFormPart").css({  "-webkit-transform":"translate(0,0)",
                              "-ms-transform":"translate(0,0)",
                              "transform":"translate(0,0)"});                   
}


$(document).ready(function(){
  
  $('#hideIntervalAlert').click(function(){
    $('#IntervalAlert').fadeOut("slow");
  });
});



//---------------------- Suppression Voiture ------------------------------//

function  getSuppressionForm(id)
{
  
  suppressionForm = document.getElementById('suppressionForm');
  ListInput = suppressionForm.getElementsByTagName('input');
  ListInput[0].value = id;
  showTableForm(3);

}


//-------------Today Date --------------------//

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
  return copy
}


$(function() {


  $('input[name="datefilter"]').daterangepicker({
    
    autoUpdateInput: false,
    locale: {
      cancelLabel: 'Clear'
    },
    "startDate": TodayDate(),
    "endDate": "05/25/2021",
    "minDate": TodayDate(),
    "maxDate": addDays(90)
  }, function(start, end, label) {
  console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
  
  });
  
  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
  });

  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
  });

});

//-------------fade out alert -----------------//

setTimeout(function () {
  $(".alertVoitures").fadeOut("slow")
  },4000);

setTimeout(function () {
  $(".alertMsgBox").fadeOut("slow")
  },5000);

setTimeout(function () {
  $(".profileALert").fadeOut("slow")
  },5000);


//-------------Initialise profile infos -----------------//

function InitialiseProfile(civilite,ville)
{
  profileForm = document.getElementsByClassName('profileForm')[0];
  Listselect = profileForm.getElementsByTagName('select');

  selectValues = [civilite,ville]

  for (i = 0; i <Listselect.length; i++) 
  {
    Select = Listselect[i];
    ListOption = Select.getElementsByTagName('option');
    
    for (j = 0 ; j <ListOption.length ; j++) 
    {
      if(ListOption[j].value==selectValues[i])
      ListOption[j].setAttribute('selected','');
    }

  }
}


//-------------Shoe profile Form -----------------//

function AfficheProfileForm(i)
{
  
  if(i==1)
  {
    $('#infos').removeClass("hideProfile");
    $('#param').addClass("hideProfile");
    $('.ProfileBtn').removeClass("hideBtn");
    $('.ParameterBtn').addClass("hideBtn");
    
  }
  else
  {
    $('#infos').addClass("hideProfile");
    $('#param').removeClass("hideProfile");
    $('.ProfileBtn').addClass("hideBtn");
    $('.ParameterBtn').removeClass("hideBtn");
  }

}


function showProfilImgModif()
{
  const [file] = $(".ProfilImageSrc")[0].files
  if (file) {
    ProfilImageModif.src = URL.createObjectURL(file)
  }
  
}


//--------------------initilise----------------------//


function InitialiseProfilePage(id,user)
{
  $.ajax({
    
    method: "POST", 
    url: "scripts/profilgetinfos.php", 
    data: { id: id,user:user}, 

    success: function(data) 
    {
      let UserObject = JSON.parse( data );
      RemplirProfile(UserObject,user);
    },
  
  
  });
  
 
}

function RemplirProfile(UserObject,user)
{
  profileForm = document.getElementsByClassName('profileForm')[0];
  ListInput = profileForm.getElementsByTagName('input');
  Listselect = profileForm.getElementsByTagName('select');


  inputValues = [UserObject.nom,UserObject.prenom,UserObject.age,UserObject.tel,UserObject.cin,UserObject.code_postal,UserObject.adresse,UserObject.email];
  selectValues = [UserObject.civilite,UserObject.ville]


  //----------initialiser les Images----------//
  if(user=='client')
  {
    document.getElementById('ProfileAvatar').src = '../'+ UserObject.client_image ;
    document.getElementById('ProfilImageModif').src = '../'+ UserObject.client_image;
  }
  else if(user=='locataire')
  {
    document.getElementById('ProfileAvatar').src = '../'+ UserObject.locataire_image ;
    document.getElementById('ProfilImageModif').src = '../'+ UserObject.locataire_image;
  }

  $('.HeaderNom').append(UserObject.nom + " " + UserObject.prenom);


  //console.log(UserObject.client_image);
  //----------initialiser les Input----------//
  for ( i = 0; i < 8; i++) {
    if(i==5)
    ListInput[i+2].value=parseInt(inputValues[i]);
    else
    ListInput[i+2].value=inputValues[i];
  }

  //----------initialiser les Select----------//
  for (i = 0; i <Listselect.length; i++) 
  {
    Select = Listselect[i];
    ListOption = Select.getElementsByTagName('option');
    
    for (j = 0 ; j <ListOption.length ; j++) 
    {
      if(ListOption[j].value==selectValues[i])
      ListOption[j].setAttribute('selected','');
    }

  }
}


//----------initialiser Les Avatars----------//
function GetAvatarPic(id,user)
{
  $.ajax({

    method: "POST", 
    url: "scripts/profilgetavatar.php", 
    data: { id: id,user:user}, 

    success: function(data) 
    {
      let UserObject = JSON.parse( data );
      $("#ProfileAvatar").attr("src",'../'+ UserObject.image);
      $('.HeaderNom').append(UserObject.nom + " " + UserObject.prenom );
       
    },
  });
  
}


//----------initialiser Les Voitures pour le client----------//

function GetClientVoitures()
{
  $.ajax({
    
    method: "POST", 
    url: "scripts/voituregetinfos.php", 
    data: { }, 

    success: function(data) 
    {
      document.getElementById('ClientVoitureTbody').innerHTML = data ;
    },
  });
}


//----------initaliser min date----------//

function setMinDate()
{
  $('#dateDebut').val(TodayDateInputFormat());
  $('#dateDebut').attr( "min", TodayDateInputFormat() );
  $('#dateFin').attr( "min", TodayDateInputFormat() );
}


function TodayDateInputFormat()
{
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = today.getFullYear();
  
  today =yyyy + '-' + mm + '-' + dd ;
  return today;
}

function setMinMax()
{
  var todayDate = new Date();
  todayDate = todayDate.getFullYear() + '-' + ('0' + (todayDate.getMonth() + 1)).slice(-2) + '-' + ('0' + todayDate.getDate()).slice(-2);
  
  document.getElementById("dateDebut").setAttribute("min", todayDate);
  document.getElementById("dateFin").setAttribute("min", document.getElementById("dateDebut").value);
  document.getElementById("dateFin").value = "";
}









//----------Filtrer les Voitures pour le client----------//

function FiltreVoitures()
{
  SelectVille = $('#SelectVille').val();
  dateDebut = $('#dateDebut').val();
  dateFin = $('#dateFin').val();
  
  $.ajax({
    
    // cache: false, // Cache The Request, Default is True
    method: "POST", 
    url: "scripts/voituregetinfosfiltrer.php", 
    data: {ville:SelectVille,debut:dateDebut,fin:dateFin }, 

    //contentType:'multipart/form-data',
    success: function(data) 
    {
      document.getElementById('ClientVoitureTbody').innerHTML = data ;
    },
  });
}




//----------show and hidefrom parts----------//

$(document).ready(function(){
  $(".NextPartArrow").click(function(){
    $(".firstFormPart").css({"-webkit-transform":"translate(-600px,0)",
                              "-ms-transform":"translate(-600px,0)",
                              "transform":"translate(-600px,0)"});
    setTimeout(function() { 
      $(".firstFormPart").css( {display:"none"});
      $(".seconFormPart").css({ display:"block"});
      
      $(".NextPartArrow").css( {display:"none"});          
      $(".PreviousPartArrow").css( {display:"inline"}); 

    }, 500);
    setTimeout(function() { 
      $(".seconFormPart").css({  "-webkit-transform":"translate(0,0)",
                                "-ms-transform":"translate(0,0)",
                                "transform":"translate(0,0)"});                    
    }, 510);
  });

  $(".PreviousPartArrow").click(function(){
    $(".seconFormPart").css({"-webkit-transform":"translate(+600px,0)",
                              "-ms-transform":"translate(+600px,0)",
                              "transform":"translate(+600px,0)"});
    setTimeout(function() { 
      $(".seconFormPart").css( {display:"none"});
      $(".firstFormPart").css({ display:"block"});

      $(".PreviousPartArrow").css( {display:"none"});          
      $(".NextPartArrow").css( {display:"inline"});  

    }, 510);
    setTimeout(function() { 
      $(".firstFormPart").css({  "-webkit-transform":"translate(0,0)",
                                "-ms-transform":"translate(0,0)",
                                "transform":"translate(0,0)"});                   
    }, 600);
    
  });
});



//----------Stop writing by keyboard----------//

$(".DispoDuree").keydown(function (event) {
  event.preventDefault();
});
$(".DispoDureeAjout").keydown(function (event) {
  event.preventDefault();
});
//----------Add interval ----------//

$(document).ready(function(){
  
  $(".addIntervalCont").click(function(){
    var fullDate = $('#newDatePicker').val();

    intervalNbr = $('.DispoDuree').length+1;
    i = intervalNbr-1;
    var IntervalInput = '<input type="text" name="dispo[]" class="DispoDuree form-control TableFormInput" value="'+fullDate+'" required readonly>';
    var IntervalCOnt ='<div class="mb-3 input-group intervaleCont'+i+'" ><label class="input-group-text intervalLabel">La Durée '+intervalNbr+' </label> ' + IntervalInput + ' <label class="input-group-text suppIntervalCont" onclick=\'suppInterval('+i+')\'><i class="fas fa-times suppInterval"></i></label></div>';
    
    if(fullDate && intervalNbr<6 && testInterval(IntervalInput,'DispoDuree') )
    {
      $('#intervalesCont').append(IntervalCOnt) ; 
      $('#FormEditAlert').css({"display":"none"});
    }
    else
    {
      $('#FormEditAlertText').empty();
      $('#FormEditAlertText').append('Choisir des intervalles distinctes');
      $('#FormEditAlert').css({"display":"block"});
    }
  });

});

//----------test interval ----------//
function testInterval(IntervalInput,classInput)
{
  var intervalDate = $(IntervalInput).val(); 

  var DebutDate = DebutStrToDate(intervalDate);
  var FinDate = FinStrToDate(intervalDate);

  
  intervalesList = $('.'+classInput);

  for (let i = 0; i < intervalesList.length; i++) 
  {
    DebutDatei =DebutStrToDate(intervalesList[i].value);
    FinDatei = FinStrToDate(intervalesList[i].value); 
    
    if((DebutDate >= DebutDatei && DebutDate <= FinDatei)  || (FinDate >= DebutDatei && FinDate <= FinDatei) || (DebutDate <= DebutDatei && FinDate >= FinDatei))
    return false;
  }
  return true;
}


//----------delete interval ----------//

function suppInterval(i)
{
  $('.intervaleCont'+i).remove();
}


//----------next form part on submit ----------//
$(document).ready(function(){
  $(".NextPartSubmit").click(function(){
    $(".firstFormPart").css({"-webkit-transform":"translate(-600px,0)",
                              "-ms-transform":"translate(-600px,0)",
                              "transform":"translate(-600px,0)"});
    setTimeout(function() { 
      $(".firstFormPart").css( {display:"none"});
      $(".seconFormPart").css({ display:"block"});
      
      $(".NextPartArrow").css( {display:"none"});          
      $(".PreviousPartArrow").css( {display:"inline"}); 

    }, 500);
    setTimeout(function() { 
      $(".seconFormPart").css({  "-webkit-transform":"translate(0,0)",
                                "-ms-transform":"translate(0,0)",
                                "transform":"translate(0,0)"});                    
    }, 510);
  });
});


//----------Test form inputs on submit ----------//

function TestFormInputs()
{
  modificationForm = document.getElementById('modificationForm');
  ListInput = modificationForm.getElementsByTagName('input');
  Listselect = modificationForm.getElementsByTagName('select');

  
  $('#FormEditAlertText').empty() ; 
  for (let i = 0; i < ListInput.length; i++) {
    if(!ListInput[i].value && ListInput[i].name != 'vehicule_image' && ListInput[i].name != 'datefilter')
    {
      $('#FormEditAlertText').append('Vous Devez remplir tous les champs')
      $('#FormEditAlert').css({"display":"block"});
      return false;
    }
  }

  for (let i = 0; i < Listselect.length; i++) {
    if(!Listselect[i].value )
    {
      $('#FormEditAlertText').append('Vous Devez remplir tous les champs')
      $('#FormEditAlert').css({"display":"block"});
      return false;
    }
  }
  ListInput = modificationForm.getElementsByClassName('DispoDuree');
  if(ListInput.length==0)
  {
    $('#FormEditAlertText').append('Vous devez ajouter au moins un intervalle de disponibilite')
    $('#FormEditAlert').css({"display":"block"});
    return false;
  }

  $('#FormEditAlert').css({"display":"none"});
  $('#modificationForm').submit();
}


$(document).ready(function(){
  $('#hideFormEditAlert').click(function(){
    $('#FormEditAlert').fadeOut("slow");
  });
});

//---------------Add interval Ajout From -----------------//

$(document).ready(function(){
  
  $(".addIntervalCont").click(function(){
    var fullDate = $('#datePicker').val();

    intervalNbr = $('.DispoDureeAjout').length+1;
    i = intervalNbr-1;
    var IntervalInput = '<input type="text" name="dispo[]" class="DispoDureeAjout form-control TableFormInput" value="'+fullDate+'" required readonly>';
    var IntervalCOnt ='<div class="mb-3 input-group intervaleCont'+i+'" ><label class="input-group-text intervalLabel">La Durée '+intervalNbr+' </label> ' + IntervalInput + ' <label class="input-group-text suppIntervalCont" onclick=\'suppInterval('+i+')\'><i class="fas fa-times suppInterval"></i></label></div>';
    
    if(fullDate && intervalNbr < 6 && testInterval(IntervalInput,'DispoDureeAjout') )
    {
      $('#intervalesContAjout').append(IntervalCOnt) ; 
      $('#FormAjoutAlert').css({"display":"none"});
    }
    else
    {
      $('#FormAjoutAlertText').empty();
      $('#FormAjoutAlertText').append('Choisir des intervalles distinctes')
      $('#FormAjoutAlert').css({"display":"block"});
    }
  });
});

$(document).ready(function(){
  $('#hideFormAjoutAlert').click(function(){
    $('#FormAjoutAlert').fadeOut("slow");
  });
});

//----------next form ajout part on submit  ----------//
$(document).ready(function(){
  $(".NextPartSubmit").click(function(){
    $(".firstFormPart").css({"-webkit-transform":"translate(-600px,0)",
                              "-ms-transform":"translate(-600px,0)",
                              "transform":"translate(-600px,0)"});
    setTimeout(function() { 
      $(".firstFormPart").css( {display:"none"});
      $(".seconFormPart").css({ display:"block"});
      
      $(".NextPartArrow").css( {display:"none"});          
      $(".PreviousPartArrow").css( {display:"inline"}); 

    }, 500);
    setTimeout(function() { 
      $(".seconFormPart").css({  "-webkit-transform":"translate(0,0)",
                                "-ms-transform":"translate(0,0)",
                                "transform":"translate(0,0)"});                    
    }, 510);
  });
});


//----------Test form inputs on submit ajout form ----------//

function TestFormInputsAjout()
{
  modificationForm = document.getElementById('ajoutForm');
  ListInput = modificationForm.getElementsByTagName('input');
  Listselect = modificationForm.getElementsByTagName('select');

  
  $('#FormAjoutAlertText').empty() ; 
  for (let i = 0; i < ListInput.length; i++) {
    if(!ListInput[i].value && ListInput[i].name != 'datefilter')
    {
      $('#FormAjoutAlertText').append('Vous Devez remplir tous les champs');
      $('#FormAjoutAlert').css({"display":"block"});
      return false;
    }
  }

  for (let i = 0; i < Listselect.length; i++) {
    if(!Listselect[i].value )
    {
      $('#FormAjoutAlertText').append('Vous Devez remplir tous les champs');
      $('#FormAjoutAlert').css({"display":"block"});
      return false;
    }
  }
  ListInput = modificationForm.getElementsByClassName('DispoDureeAjout');
  if(ListInput.length==0)
  {
    $('#FormAjoutAlertText').append('Vous devez ajouter au moins un intervalle de disponibilite')
    $('#FormAjoutAlert').css({"display":"block"});
    return false;
  }

  $('#FormAjoutAlert').css({"display":"none"});
  console.log('suubmit')
  $('#ajoutForm').submit();
}



//----------Get Client car disponibilite ----------//


function GetVoitureDispo(id)
{
  $.ajax({
    
    // cache: false, // Cache The Request, Default is True
    method: "POST", 
    url: "scripts/voituregetdispocatalogue.php", 
    data:{ vehicule_id:id}, 

    //contentType:'multipart/form-data',
    success: function(data) 
    {
      document.getElementsByClassName('carDispoCatalogue')[0].innerHTML = data ;
    },
  });
}



//--------------Turn date picke date to real date ---------------//

function DebutStrToDate(str)
{
  Debut = new Date(str.substr(0, 10));
  return Debut;
}

function FinStrToDate(str)
{
  Fin = new Date(str.substr(13, 10));
  return Fin;
}


//----------Reserver une Voiture ----------//

function ReserverVoiture(vehicule_id,client_id)
{

  dispos = $('.DispoDuree');
  ReservInterval = $('#datePicker').val();


  var ReservDebut = DebutStrToDate(ReservInterval);
  var ReservFin = FinStrToDate(ReservInterval);

  if(dispos != 0)
  {
    LocValide = false ;
    for ( i = 0; i < dispos.length; i++)
    {
      dispo = dispos[i].value;
      DispoDebut = DebutStrToDate(dispo);
      DispoFin = FinStrToDate(dispo);

      if( ( ReservDebut >= DispoDebut  &&  ReservDebut <= DispoFin )  && ( ReservFin >= DispoDebut  &&  ReservFin <= DispoFin )  )
      LocValide = true;
    }

    if(LocValide)
    {
      $('.LocCarALertWarning').css({"display":"none"});
      AjouterReservation(vehicule_id,client_id,ReservInterval);
    }
    else
    {
      $('.LocCarALertWarningText').empty() ; 
      $('.LocCarALertWarningText').append("Chosir un interval valid") ; 
      
      $('.LocCarALertSucces').css({"display":"none"});
      $('.LocCarALertWarning').css({"display":"block"});
      setTimeout(function() { 
      $('.LocCarALertWarning').css({"display":"none"});                 
      }, 5000);
    }
  }
  else
  {
    console.log('no dispo');
  }


}


//----------Ajouter une Reservation ----------//

function AjouterReservation(vehicule_id,client_id,ReserveInterval)
{
  
  ReservDebut = ReserveInterval.substr(0, 10);
  ReservFin = ReserveInterval.substr(13, 10);
  $.ajax({
    
    method: "POST", 
    url: "scripts/reservationajout.php", 
    data:{ vehicule_id:vehicule_id,client_id:client_id,date_debut:ReservDebut,date_fin:ReservFin}, 

    success: function(data) 
    {
      if(data == '0')
      {
        $('.LocCarALertSucces').css({"display":"block"});
        setTimeout(function() { 
        $('.LocCarALertSucces').css({"display":"none"});                 
        }, 5000);
      }
      else 
      {
        $('.LocCarALertWarningText').empty() ; 
        $('.LocCarALertSucces').css({"display":"none"});
        if(data == '1')
        {
          $('.LocCarALertWarningText').append("Erreur Au moment de l'ajout de la reservation") ; 
          $('.LocCarALertWarning').css({"display":"block"});
        }
        else
        {
          $('.LocCarALertWarningText').append("Vous Avez deja effectuer cette Reservation") ;
          $('.LocCarALertWarning').css({"display":"block"});
        }
      }
      setTimeout(function() { 
        $('.LocCarALertWarning').fadeOut("slow");               
      }, 5000);
      
    },
  });
}


$(document).ready(function(){
  $('#hideReservErrorAlert').click(function(){
    $('.LocCarALertWarning').fadeOut("slow");
  });
  $('#hideReservSuccessAlert').click(function(){
    $('.LocCarALertSucces').fadeOut("slow");
  });
});




//----------Refuser une Reservation ----------//

function refuserClick()
{
  ShowBlurBack();
  $('#RefuserForm').fadeToggle();
}

function AccepterClick()
{
  ShowBlurBack();
  $('#AccepterForm').fadeToggle();
}
  

function ShowBlurBack() {
  $('.blackBlurBackground').fadeToggle("slow");
  $('.blurBackground').fadeToggle();
}



//---------hide Btn --------------//
$('#CloseFormIcon').click(function(){
  $('.blackBlurBackground').fadeOut("slow");
  $('.blurBackground').fadeOut("slow");
  $('#RefuserForm').fadeOut();
  $('#AccepterForm').fadeOut();
  $('#PlusInfosForm').fadeOut();
});

$('.TableFormReset').click(function(){
  $('.blackBlurBackground').fadeOut("slow");
  $('.blurBackground').fadeOut("slow");
  $('#RefuserForm').fadeOut();
  $('#AccepterForm').fadeOut();
  $('#PlusInfosForm').fadeOut();
});

//-------------hide background and form---------------//
function hideFormsAndBacks()
{
  $('.blackBlurBackground').fadeOut("slow");
  $('.blurBackground').fadeOut("slow");
  $('#RefuserForm').fadeOut();
  $('#AccepterForm').fadeOut();
  $('#PlusInfosForm').fadeOut();
}


//-------------fill submit buttons---------------//

function RefuseReserv(id,locataire_id)
{
  $('#RefuseSubmit').attr("onclick","RefuserReservation('"+ id +"','Refuse','" + locataire_id +"')");
  $('.moreInfos').attr("onclick","ClickMoreInfos('"+ id +"')");
  
}

function AcceptReserv(id,locataire_id)
{
  $('#AcceptSubmit').attr("onclick","AccepterReservation('"+ id +"','Accepte','" + locataire_id +"')");
  $('.moreInfos').attr("onclick","ClickMoreInfos('"+ id +"')");
}

//-------------Modifier reservation---------------//

///====> Refuser
function RefuserReservation(id,modif,locataire_id)
{
  $.ajax({
    
    method: "POST", 
    url: "scripts/reservationmodif.php", 
    data:{ reservation_id:id,modification:modif}, 

    success: function(data) 
    {
      $('.ReservALertSuccesText').empty();
      $('.ReservALertWarningText').empty();
      if(data=='0')
      {
        $('.ReservALertSuccesText').append("Reservation Refusé avec succes");
        $('.ReservALertSucces').css({"display":"block"});
        setTimeout(function() { 
          $('.ReservALertSucces').css({"display":"none"});                 
        }, 5000);
        RemplirReservationTable(locataire_id);
      }
      else
      {
        $('.ReservALertWarningText').append("Reservation n'est pas Refusé avec succes") ;
        $('.ReservALertWarning').css({"display":"block"});
        setTimeout(function() { 
          $('.ReservALertWarning').css({"display":"none"});                 
        }, 5000);
      }
      hideFormsAndBacks();
    },
  });
}

///====> Accepter
function AccepterReservation(id,modif,locataire_id)
{
  $.ajax({
    
    method: "POST", 
    url: "scripts/reservationmodif.php", 
    data:{ reservation_id:id,modification:modif}, 

    success: function(data) 
    {
      $('.ReservALertSuccesText').empty();
      $('.ReservALertWarningText').empty();
      if(data=='0')
      {
        $('.ReservALertSuccesText').append("Reservation Accepté avec succes");
        $('.ReservALertSucces').css({"display":"block"});
        setTimeout(function() { 
          $('.ReservALertSucces').fadeOut("slow");              
        }, 5000);
        RemplirReservationTable(locataire_id);
      }
      else
      {
        $('.ReservALertWarningText').append("Reservation n'est pas Accepté avec succes") ;
        $('.ReservALertWarning').css({"display":"block"});
        setTimeout(function() { 
          $('.ReservALertWarning').fadeOut("slow");                
        }, 5000);
      }
      
        hideFormsAndBacks();
    },
  });
}

//----------------hide alerts ----------///

$('#hideReservErrorAlert').click(function(){
  $('.ReservALertWarning').fadeOut("slow");
});
$('#hideReservSuccessAlert').click(function(){
  $('.LocCarALertSucces').fadeOut("slow");
});



//-------------Remplir le table des reservation---------------//

function RemplirReservationTable(locataire_id)
{
  $.ajax({
    
    method: "POST", 
    url: "scripts/reservationgetall.php", 
    data:{ locataire_id:locataire_id}, 

    success: function(data) 
    {
      $('.tbody').empty();
      $('.tbody').append(data);
    },
  });
}

//------------affciher plus d'information -------------//

function AfficherInfosClick(id)
{
  ShowBlurBack();
  $('#PlusInfosForm').fadeToggle();
  RemplirReservationForm(id);
}

function  RemplirReservationForm(id)
{
  $.ajax({
    
    method: "POST", 
    url: "scripts/reservationgetinfos.php", 
    data:{ reservation_id:id}, 

    success: function(data) 
    {
      let reservationObj = JSON.parse( data );

      ReservInputs = $('.Reservationinput');
      i = 0;
      for (const inputVal in reservationObj) 
      {
        ReservInputs[i++].value = reservationObj[inputVal];
        if(i>=ReservInputs.length)
        break;
      }
      ReservInputs[ReservInputs.length-1].value += " MAD";

      if(reservationObj.etat == 'Accepte')
      {
        TeleOnj = '<div class="col-sm-12 mt-3 ReservTeleCont">  <label for="age" class="ProfileLabel"> Numéro de téléphone  </label>  <input type="text"  class="form-control Reservationinput" id="ville" value="+212 '+ reservationObj.tel  +'" readonly>  </div>'
        $('.TelContCont').append(TeleOnj);
      }
      else
      {
        $('.ReservTeleCont').remove();
      }


    },
  });
}


//-------------when u clcik more infos------------//

function ClickMoreInfos(id)
{  
  hideFormsAndBacks();
  setTimeout(function () {
    AfficherInfosClick(id);
    },400);
}






























//------------------------------------------------------------------//

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
    let header = select('#headerBar')
    let offset = header.offsetHeight

    let elementPos = select(el).offsetTop
    window.scrollTo({
      top: elementPos - offset,
      behavior: 'smooth'
    })
  }


  let selectHeader = select('#headerBar')
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


