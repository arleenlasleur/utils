for /f "tokens=* delims=" %%G in ('dir /A-D /B *.json') do (
  q php E:\utils_file\izzyparse.php "%%~G"
)
