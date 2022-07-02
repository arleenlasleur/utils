for /f "tokens=* delims=" %%G in ('dir /A-D /B *.m4a') do (
  call E:\utils\utils_vid\enum_length.bat "%%~G"
)
