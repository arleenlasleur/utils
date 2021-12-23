var x,max;
function keyproc(e){
  e.preventDefault();
  e=e||window.event; e=e.keyCode;
  console.log(e);
  switch(e){
    case 16:   //shft
      x=[];
      max=document.querySelector("#episodes_content > div.clear > div.list.detail.eplist").children.length;
      for(var i=1;i<=max;i++) x.push(document.querySelector("#episodes_content > div.clear > div.list.detail.eplist > div:nth-child("+i+") > div.info > strong > a").innerText)
      var text=JSON.stringify(x);
      navigator.clipboard.writeText(text).then(function(){alert('Copied.');},function(err){console.error('Copy error: ', err);alert('Error.');});
    break;
  }
}
document.addEventListener("keydown",keyproc);
console.log("%cPress "+"%cCtrl"+"%c to add, "+"%cShift"+"%c to dump. "+"%cCtrl+Shft+I disabled.","color:#fff","color:#77f","color:#fff","color:#77f","color:#fff","color:#f33");

