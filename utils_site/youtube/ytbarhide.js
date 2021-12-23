var hidstate=false;
function keyproc(e){
  e.preventDefault();
  e=e||window.event; e=e.keyCode; if(e==72){ //h
    hidstate=!hidstate;
    document.getElementById("masthead-container").style.display=hidstate?"none":"initial";
  }
}
document.addEventListener("keydown",keyproc);
