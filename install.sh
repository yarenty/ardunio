#!/usr/bin/bash

sudo chown yarenty /dev/ttyUSB0
sudo chown yarenty /dev/ttyUSB1
sudo chown yarenty /dev/ttyUSB2
sudo chown yarenty /dev/ttyUSB3


which java

cp RXTXcomm.jar /usr/lib/jvm/java-6-sun-1.6.0.26/jre/lib/ext
cp RXTXcomm.jar /usr/java/j2re1.6.0_04/lib/ext

cp librxtxSerial.so  /usr/lib/jvm/java-6-sun-1.6.0.26/jre/lib/i386 
cp librxtxSerial.so  /usr/java/j2re1.6.0_04/lib/i386
 