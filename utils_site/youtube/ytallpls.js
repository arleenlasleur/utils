var lnks=document.querySelectorAll("a");
var urls=[];
for (i=0;i<lnks.length;i++) urls.push(lnks[i].getAttribute("href"));
var text=JSON.stringify(urls);
console.log(text);
