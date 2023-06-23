
//---------------------------------------------------------------

function openTab(evt, TabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {                 //this function is to loop all the unselected nav or the graybox section to be not display
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {                   //this funcition is for the selected section in supposed to be nav and to the links to highlight the text white
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  document.getElementById(TabName).style.display = "block";// for selected links in the nav to be display the content
  evt.currentTarget.className += " active";
}

// Get the element with id="HomeLi" and click on it
document.getElementById("HomeLi").click();


//------------------------------------------------------------------




function openNav() {
  document.getElementById("myNav").style.width = "100%";
 

  
  
}

function closeNav() {
  // document.getElementById("myNav").style.display = "none";
  document.getElementById("myNav").style.width = "0%";

}

// style.width = "100%";
// style.width = "0%";