@echo off
echo %1 >>esv.log
ffmpeg -i %1 2>&1 | find "video" /i >>esv.log
