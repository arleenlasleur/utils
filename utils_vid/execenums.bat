for /f "tokens=* delims=" %%G in ('dir /A-D /B *.jpg') do (
  call E:\utils\utils_vid\enum_stream.bat "%%~G"
)
