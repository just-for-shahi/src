## Build
```
docker build . -t mt4
```

# Run
```
docker run -d --rm \
    --cap-add=SYS_PTRACE \
    -v $(pwd):/home/winer/.wine/drive_c/mt4 \
    -p 5900:5900 \
    mt4
```

# VNC

if you don't use VNC_PASSWORD envirement, vnc password set `m@123456`
```
docker run -d --rm \
    --cap-add=SYS_PTRACE \
    -v $(pwd):/home/winer/.wine/drive_c/mt4 \
    -p 5900:5900 \
    -e VNC='yes' \
    -e VNC_PASSWORD='m@123456' \
    mt4
```

# Add Exper
for add expert file, move to `app/MQL4/Experts`

# Config
For config account edit `startup.ini`