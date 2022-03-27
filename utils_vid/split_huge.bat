ffmpeg -i %1 -c copy -f segment -segment_time 28000 -reset_timestamps 1 %1_%%02d.mp4
rem 4200 for 720p