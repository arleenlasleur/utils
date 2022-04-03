var lnks=document.querySelectorAll("a#main-link");
// var lnks=document.querySelectorAll("yt-formatted-string#text");    // shit: queries excess elements, remove until last N only
// var lnks=document.querySelectorAll("yt-formatted-string#description");
// var lnks=document.querySelectorAll("div#avatar img#img");
var urls=[];
for (i=0;i<lnks.length;i++) urls.push(lnks[i].getAttribute("href"));  // .innerText);  // .getAttribute("src"));
var text=JSON.stringify(urls);
console.log(text);
