@echo off
if "%1"=="" goto setdir
cd %1
if not exist resize md resize
for /f "tokens=* delims=" %%G in ('dir /A-D /B *.jpg') do (
  ffmpeg -hide_banner -i "%%~G" -vf scale=1280:-1,crop=1280:720:0:24 -qmin 1 -q:v 1 "resize\%%~nG.jpg"
)
:setdir
echo Working directory not set.
:end
