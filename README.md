ARDUNIO communication
---------------------

Current output:  [IoT](http://www.yarenty.com/ardunio)  


# BIG PICTURE

![Example daily output](/pics/IoT_architecture.PNG)


PATH:  
sensors => ardunio => serial port => java/scala collector => send to server => DB persistence => visualizaiton



# PARTS

## Linux RXTX installation: [follow those steps to install RXTX libraries](libs/README.md)

##  Java connection - basic intro

http://playground.arduino.cc/interfacing/java


## Add sccess to the USB port 

- Linux
```bash
sudo chown yarenty /dev/ttyUSB0
```
 
-Mac OSX 
```bash
sudo chown yarenty /dev/tty.<yourUSBport>
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

### 1.0
- production style version

### 0.08
- moved from prototype to *production release* ;-)

### 0.07
- Mac support

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
