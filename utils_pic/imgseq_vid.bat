@echo off
if "%1"=="" goto setdir
cd /d %1
ffmpeg -r 60 -i %%07d.jpg -c:v libx264 -crf 0 -vf fps=60 -pix_fmt yuv420p out.mp4
if not "%2"=="" ren out.mp4 %2.mp4
goto end
:setdir
echo Working directory not set.
echo Optional parameter - rename.
echo On different drive letter call by full path in folder . (ref to current)
:end