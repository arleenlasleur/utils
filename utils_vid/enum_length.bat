echo %1>>_len
ffmpeg -i %1 2>&1 | find "dur" /i >>_len