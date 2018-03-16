ARDUNIO communication
---------------------

Current output:  [IoT](http://www.yarenty.com/ardunio)  


# BIG PICTURE

![Example daily output](/pics/IoT_architecture.PNG)


PATH:  
sensors => ardunio => serial port => java/scala collector => send to server => DB persistence => visualizaiton



# PARTS

## Linux RXTX installation:
RXTX library: http://jlog.org/rxtx-lin.html

- Download 'RXTXcomm.jar' and install it in the 'lib/ext' folder of 
the Java VM (e.g. for Ubuntu: '/usr/java/j2reXXX/lib/ext').   
- Download 'librxtxSerial.so' and install it in the 'lib/i386' or 'lib/amd64' folder of the Java VM (e.g. for Ubuntu: '/usr/lib/jvm/java-XXX/jre'). Try the 'bin' folder for this file if the 'lib/i386' is not found. Make sure that 'librxtxSerial' has execute permissions for all.  You may need to download the file to a temporary location (e.g. Desktop) and use a privileged command (or sudo from the command/terminal) to move it to the destination.  
- You may need to Log in as 'root' and add your jLog user to the group owning the '/var/lock' directory and the group owning the serial port (e.g. /dev/ttyS0) to be used. This is not needed for Ubuntu 11.04.



##  Java connection - basic intro

http://playground.arduino.cc/interfacing/java


## Access to the USB port - Linux

```
sudo chown yarenty /dev/ttyUSB0
```
 
 
## ON ERROR: java.lang.UnsatisfiedLinkError: no rxtxSerial in java.library.path
check if you got proper java directories:
```
which java
```
copy RXTX libraries to that folders (see first point above) 
 

# EXAMPLES 

## Web data collection link

```
http://www.yarenty.com/ardunio/add.php?year=2018&month=1&day=9&hour=10&minute=12&light=0&sound=222&&motion=1
```


## Output

![Example daily output](/pics/IoT_example.png)

 

# TODO
- server: calendar
 
 
 
# Changelog

### v0.06 
- java: full build

### v0.05
- server: PHP display

### v0.04
- java: build big jar to run from command line

### v0.03
- server: send PHP to server
    
### v0.02
- jave: joda DateTime
- java: reading from port

### v0.01 
- java: connect to port
- java: CURL
- ardunio: send to USB port / serial
- ardunio: collect readings
