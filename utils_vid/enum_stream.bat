echo %1>>_len
ffmpeg -i %1 2>&1 | find "stream" /i >>_len