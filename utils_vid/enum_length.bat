@echo off
echo %1 >>esl.log
ffmpeg -i %1 2>&1 | find "duration" /i >>esl.log
