@echo off
echo %1 >>ess.log
ffmpeg -i %1 2>&1 | find "stream" /i >>ess.log
