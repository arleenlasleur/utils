pls=document.getElementsByClassName("yt-simple-endpoint style-scope ytd-playlist-panel-video-renderer");
//pls=document.getElementsByClassName("style-scope ytd-playlist-panel-video-renderer");
//pls=document.getElementsByClassName("yt-simple-endpoint style-scope ytd-playlist-video-renderer");
urls=[];
for(i=0;i<pls.length;i++) urls.push("ytdl "+pls[i]["href"].slice(0,43)+" -f 18");
copy(urls);
