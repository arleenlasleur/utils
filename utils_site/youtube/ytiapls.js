var lnks=document.querySelectorAll("a");
var urls=[];
var targ=undefined;
for (i=0;i<lnks.length;i++){
  lnks[i].setAttribute("data-href",lnks[i].getAttribute("href"));
  lnks[i].removeAttribute("href");
  lnks[i].onmouseover=function(){ targ=this; this.style.color="#f00"; }
  lnks[i].onmouseout=function(){ this.style.color="#000"; }
}
function keyproc(e){
  e.preventDefault();
  e=e||window.event; e=e.keyCode;
  console.log(e);
  switch(e){
    case 16:   //shft
      var text=JSON.stringify(urls);
      navigator.clipboard.writeText(text).then(function(){alert('Copied.');},function(err){console.error('Copy error: ', err);alert('Error.');});
    break;
    case 17:   //ctrl
      urls.push("ytdl https://www.youtube.com"+targ.getAttribute("data-href")+" -f 22");
      targ.style.backgroundColor="#f00";targ.style.color="#fff";
    break;
  }
}
document.addEventListener("keydown",keyproc);
console.log("%cPress "+"%cCtrl"+"%c to add, "+"%cShift"+"%c to dump. "+"%cCtrl+Shft+I disabled.","color:#fff","color:#77f","color:#fff","color:#77f","color:#fff","color:#f33");

