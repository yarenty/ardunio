# RXTX for Linux
jLog communicates with serial devices through the RXTX library available from http://rxtx.qbang.org. 


RXTX consists of two parts: The Java extension library RXTXcomm.jar and the serial driver to be integrated with the operating system.
RXTX must be installed after having installed the Java Runtime Environment (JRE) and before installing the jLog application.


*Please note that you must install RXTX as a user with 'root', Administrator or similar privileges (e.g. using sudo to run the installation script).*

## Installation  


| Name |  32-bit | 64-bit |
|RXTX Java serial controller	| RXTXcomm.jar	| RXTXcomm.jar |
|RXTX driver for i686-pc-linux-gnu	|librxtxSerial.so| |	
|RXTX driver for x86_64-unknown-linux-gnu |	|librxtxSerial.so |


- Download 'RXTXcomm.jar' and install it in the 'lib/ext' folder of the Java VM (e.g. for Ubuntu 11.04: '/usr/lib/jvm/java-6-sun-1.6.0.26/jre' and for RH9 with Sun's Java 1.6.0_04: '/usr/java/j2re1.6.0_04/lib/ext'). 
You may need to download the file to a temporary location (e.g. Desktop) and use a privileged command (or sudo from the command/terminal) to move it to the destination.
- Download 'librxtxSerial.so' and install it in the 'lib/i386' or 'lib/amd64' folder of the Java VM (e.g. for Ubuntu 11.04: '/usr/lib/jvm/java-6-sun-1.6.0.26/jre' and for RH9 with Sun's Java 1.6.0_04: '/usr/java/j2re1.6.0_04/lib/i386'). Try the 'bin' folder for this file if the 'lib/i386' is not found (e.g. for IBM's Java 1.4.x). Make sure that 'librxtxSerial' has execute permissions for all. You may need to download the file to a temporary location (e.g. Desktop) and use a privileged command (or sudo from the command/terminal) to move it to the destination.
- You may need to Log in as 'root' and add your jLog user to the group owning the '/var/lock' directory and the group owning the serial port (e.g. /dev/ttyS0) to be used. This is not needed for Ubuntu 11.04.
- This would typically (e.g. for Red Hat 9 and Fedora Core) be users 'lock' and 'uucp' respectively.
- Try running jLog as root if you experience problems, i.e. to find out if the problem is caused by improper access or improper installation of the files.
- On Ubuntu: 

```$bash
sudo chown user:user /dev/ttyUSB0
sudo chown user:user /dev/ttyUSB1
```