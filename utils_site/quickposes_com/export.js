var lnks=document.querySelectorAll("#qp-slider-holder > div.image-history-cntr > table > tbody > tr > td > div > a");
var urls=[];
for (i=0;i<lnks.length;i++) urls.push("https://quickposes.com"+lnks[i].getAttribute("href"));
var text=JSON.stringify(urls);
navigator.clipboard.writeText(text).then(function(){alert('Copied.');},function(err){console.error('Copy error: ', err);alert('Error.');});
