package com.yarenty.ardunio;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStream;
import gnu.io.CommPortIdentifier;
import gnu.io.SerialPort;
import gnu.io.SerialPortEvent;
import gnu.io.SerialPortEventListener;
import org.joda.time.DateTime;

import java.util.*;


public class DataCollector implements SerialPortEventListener {
    SerialPort serialPort;
    /** The port we're normally going to use. */
    private static final String PORT_NAMES[] = {
            "/dev/tty.usbserial-A9007UX1", // Mac OS X
            "/dev/tty.wchusbserial1410", // Mac OS X
            "/dev/ttyACM0", // Raspberry Pi
            "/dev/ttyUSB0", // Linux
            "/dev/ttyUSB1", // Linux
            "COM3", // Windows
    };
    /**
     * A BufferedReader which will be fed by a InputStreamReader 
     * converting the bytes into characters 
     * making the displayed results codepage independent
     */
    private BufferedReader input;
    /** The output stream to the port */
    private OutputStream output;
    /** Milliseconds to block while waiting for port open */
    private static final int TIME_OUT = 2000;
    /** Default bits per second for COM port. */
    private static final int DATA_RATE = 9600;

    private DateTime currentDate = new DateTime();
    private List<Integer> lights = new ArrayList<Integer>();
    private List<Integer> sounds = new ArrayList<Integer>();
    private Boolean motion = false;
    private String sendMe="";
       
    
    
    public void initialize() {
        // the next line is for Raspberry Pi and 
        // gets us into the while loop and was suggested here was suggested http://www.raspberrypi.org/phpBB3/viewtopic.php?f=81&t=32186
        // System.setProperty("gnu.io.rxtx.SerialPorts", "/dev/ttyACM0");

        CommPortIdentifier portId = null;
        Enumeration portEnum = CommPortIdentifier.getPortIdentifiers();

        //First, Find an instance of serial port as set in PORT_NAMES.
        while (portEnum.hasMoreElements()) {
            CommPortIdentifier currPortId = (CommPortIdentifier) portEnum.nextElement();
            for (String portName : PORT_NAMES) {
                if (currPortId.getName().equals(portName)) {
                    portId = currPortId;
                    break;
                }
            }
        }
        if (portId == null) {
            System.out.println("Could not find COM port.");
            return;
        }

        try {
            // open serial port, and use class name for the appName.
            serialPort = (SerialPort) portId.open(this.getClass().getName(),
                    TIME_OUT);

            // set port parameters
            serialPort.setSerialPortParams(DATA_RATE,
                    SerialPort.DATABITS_8,
                    SerialPort.STOPBITS_1,
                    SerialPort.PARITY_NONE);

            // open the streams
            input = new BufferedReader(new InputStreamReader(serialPort.getInputStream()));
            output = serialPort.getOutputStream();

            // add event listeners
            serialPort.addEventListener(this);
            serialPort.notifyOnDataAvailable(true);
        } catch (Exception e) {
            System.err.println(e.toString());
        }
    }

    /**
     * This should be called when you stop using the port.
     * This will prevent port locking on platforms like Linux.
     */
    public synchronized void close() {
        if (serialPort != null) {
            serialPort.removeEventListener();
            serialPort.close();
        }
    }

    public synchronized Boolean updateStats(String in){
        String[] a = in.split(";");
        
        //TODO:  clean that ;-)
             Integer light = Integer.parseInt(a[0].split(":")[1]);
             Integer sound = Integer.parseInt(a[2].split(":")[1]);
             Boolean m = false;
             if (Integer.parseInt(a[1].split(":")[1]) == 1) m = true;

             DateTime newDate = new DateTime();
             if (newDate.getMinuteOfHour() != currentDate.getMinuteOfHour()) {
                 //update clean send
                 lights.add(light);
                 sounds.add(sound);
                 if (!motion) motion = m;

                 Integer ll = 0;
                 for (Integer l : lights) {
                     ll += l;
                 }
                 ll = 1024 - (ll / lights.size()); //new version - light is inverted ;-)

                 Integer ss = 0;
                 for (Integer s : sounds) {
                     ss += s;
                 }
                 ss = ss / sounds.size();

                 Integer mm = 0;
                 if (motion) mm = 1;

                 sendMe = "year=" + newDate.getYear() + "&month=" + newDate.getMonthOfYear() + "&day=" + newDate.getDayOfMonth() + "&hour=" +
                         newDate.getHourOfDay() + "&minute=" + newDate.getMinuteOfHour() + "&light=" + ll + "&sound=" + ss + "&motion=" + mm;


                 motion = m;
                 lights = new ArrayList<Integer>();
                 sounds = new ArrayList<Integer>();
                 currentDate = newDate;

                 return true;
             } else {
                 //just update stats
                 lights.add(light);
                 sounds.add(sound);
                 if (!motion) motion = m;

                 return false;
             }

    }

    
    /**
     * Handle an event on the serial port. Read the data and print it.
     */
    public synchronized void serialEvent(SerialPortEvent oEvent) {
        if (oEvent.getEventType() == SerialPortEvent.DATA_AVAILABLE) {
            try {
                String inputLine=input.readLine();
//                System.out.println(inputLine);
                if (updateStats(inputLine)) {
                    String out = CURL.getRestContent("http://www.yarenty.com/ardunio/add.php?" + sendMe, 5000, 5000);
                    System.out.println("http://www.yarenty.com/ardunio/add.php?" + sendMe + "  =>" + out);
                }
            } catch (Exception e) {
                System.err.println(e.toString());
            }
        }
        // Ignore all the other eventTypes, but you should consider the other ones.
    }

    public static void main(String[] args) throws Exception {
        DataCollector main = new DataCollector();
        main.initialize();
        Thread t=new Thread() {
            public void run() {
                //the following line will keep this app alive for 1000 seconds,
                //waiting for events to occur and responding to them (printing incoming messages to console).
                try {Thread.sleep(1000000);} catch (InterruptedException ie) {}
            }
        };
        t.start();
        System.out.println("Started");
    }
}
