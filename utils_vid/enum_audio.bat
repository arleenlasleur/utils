@echo off
echo %1 >>esa.log
ffmpeg -i %1 2>&1 | find "audio" /i >>esa.log
