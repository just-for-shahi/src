#!/usr/bin/env bash
# Break script on any non-zero status of any command
set -e

export DISPLAY SCREEN_NUM SCREEN_WHD VNC VNC_PASSWORD
export WINEDLLOVERRIDES="mscoree,mshtml="
XVFB_PID=0
TERMINAL_PID=0

term_handler() {
    echo '########################################'
    echo 'SIGTERM signal received'

    if ps -p $TERMINAL_PID > /dev/null; then
        kill -SIGTERM $TERMINAL_PID
        # Wait returns status of the killed process, with set -e this breaks the script
        wait $TERMINAL_PID || true
    fi

    # Wait end of all wine processes
    /docker/waitonprocess.sh wineserver

    if ps -p $XVFB_PID > /dev/null; then
        kill -SIGTERM $XVFB_PID
        # Wait returns status of the killed process, with set -e this breaks the script
        wait $XVFB_PID || true
    fi

    # SIGTERM comes from docker stop so treat it as normal signal
    exit 0
}

trap 'term_handler' SIGTERM

Xvfb $DISPLAY -screen $SCREEN_NUM $SCREEN_WHD \
    +extension GLX \
    +extension RANDR \
    +extension RENDER \
    &> /tmp/xvfb.log &
XVFB_PID=$!
sleep 3

if [[ $VNC == 'yes' ]]
then
x11vnc -bg -nopw -rfbport 5900 -rfbauth /home/winer/.vnc/passwd -forever -xkb -o /tmp/x11vnc.log
sleep 3
fi

# @TODO Use special argument to pass value "startup.ini"
wine C:/mt4/app/terminal.exe /portable C:/mt4/startup.ini &
TERMINAL_PID=$!

# Wait end of terminal
wait $TERMINAL_PID
# Wait end of all wine processes
/docker/waitonprocess.sh wineserver
# Wait end of Xvfb
wait $XVFB_PID
