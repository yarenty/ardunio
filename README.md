ADRUNIO communication
----------------------




## Linux RXTX installation:
RXTX library: http://jlog.org/rxtx-lin.html

- Download 'RXTXcomm.jar' and install it in the 'lib/ext' folder of the Java VM (e.g. for Ubuntu: '/usr/java/j2reXXX/lib/ext').   
- Download 'librxtxSerial.so' and install it in the 'lib/i386' or 'lib/amd64' folder of the Java VM (e.g. for Ubuntu: '/usr/lib/jvm/java-XXX/jre'). Try the 'bin' folder for this file if the 'lib/i386' is not found. Make sure that 'librxtxSerial' has execute permissions for all.  You may need to download the file to a temporary location (e.g. Desktop) and use a privileged command (or sudo from the command/terminal) to move it to the destination.  
- You may need to Log in as 'root' and add your jLog user to the group owning the '/var/lock' directory and the group owning the serial port (e.g. /dev/ttyS0) to be used. This is not needed for Ubuntu 11.04.

