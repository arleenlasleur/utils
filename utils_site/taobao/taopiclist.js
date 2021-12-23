var tbii="";
var lnk=document.getElementsByTagName("link");
for(i=0;i<lnk.length;i++) if(lnk[i].getAttribute("rel")==="canonical") tbii=lnk[i].getAttribute("href")
tbii=tbii.substring(tbii.indexOf("?id")+4);
var page=document.querySelector("div#description");
var imgs=page.getElementsByTagName("img");
urls=[];
urls.push("md "+tbii);
urls.push("cd "+tbii);
for(i=0;i<imgs.length;i++) urls.push("curl "+imgs[i]["src"]+" -o "+i+".jpg");
copy(urls);
