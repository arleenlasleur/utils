var head=document.getElementsByTagName('head')[0];    // inc css
var link=document.createElement('link'); 
link.rel='stylesheet';  
link.type='text/css'; 
link.href='slide.css';  
head.appendChild(link);

var screenplay=document.createElement('script');      // inc js
screenplay.src = 'screenplay.js';
head.appendChild(screenplay);
