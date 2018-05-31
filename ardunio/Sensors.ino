/*
 * (C)2018 by yarenty.com
*/


//PINS
int motionPin = 8; //digital
int soundPin = 1; //analog

int photocellPin = 0;     // the cell and 10K pulldown are connected to a0
int photocellReading;     // the analog reading from the sensor divider


//SOUND
const int sampleWindow = 50; // Sample window width in mS (50 mS = 20Hz)
unsigned int sample;


//MOTION
int mPirState = LOW;             // we start, assuming no motion detected
int mVal = 0;   // variable for reading the pin status


//DEBUG!! remove me:
int ledPin = 13;                // choose the pin for the LED


// the setup routine runs once when you press reset:
void setup() {
  // initialize serial communication at 9600 bits per second:
  pinMode(ledPin, OUTPUT);      // declare LED as output
  pinMode(motionPin, INPUT);     // declare sensor as input
 
  Serial.begin(9600);
}

// the loop routine runs over and over again forever:
void loop() {
  photocellReading = analogRead(photocellPin);  
  motionCheck(); 
  
  Serial.print("LIGHT:");
  Serial.print(photocellReading);  
  Serial.print("; MOTION:");

  Serial.print(mPirState);
  Serial.print("; SND:");
  Serial.println(soundCheck());
  //Serial.println(analogRead(soundPin));
}

int soundCheck() {
   unsigned long startMillis = millis();  // Start of sample window
   unsigned int peakToPeak = 0;   // peak-to-peak level
 
   unsigned int signalMax = 0;
   unsigned int signalMin = 1024;
 
   // collect data for 50 mS
   while (millis() - startMillis < sampleWindow)
   {
      sample = analogRead(soundPin);
      if (sample < 1024)  // toss out spurious readings
      {
         if (sample > signalMax)
         {
            signalMax = sample;  // save just the max levels
         }
         else if (sample < signalMin)
         {
            signalMin = sample;  // save just the min levels
         }
      }
   }
//
//          Serial.print("min:");
//          Serial.print(signalMin);
//          Serial.print(" max:");
//          Serial.print(signalMax);
//          Serial.print("  sss:");
//          Serial.println(sample);
 
   peakToPeak = signalMax - signalMin;  // max - min = peak-peak amplitude
   //double volts = (peakToPeak * 5.0) / 1024;  // convert to volts

   //return volts;
   //Serial.print("SOUND:");
   return peakToPeak;
}


int motionCheck() {
  int motion=0;
  mVal = digitalRead(motionPin);  // read input value
  if (mVal == HIGH) {            // check if the input is HIGH
    digitalWrite(ledPin, HIGH);  // turn LED ON
    if (mPirState == LOW) {
      // we have just turned on
      //Serial.println("Motion detected!");
      motion=1;
      // We only want to print on the output change, not state
      mPirState = HIGH;
    }
  } else {
    digitalWrite(ledPin, LOW); // turn LED OFF
    if (mPirState == HIGH){
      // we have just turned of
      //Serial.println("Motion ended!");
      motion=2;
      // We only want to print on the output change, not state
      mPirState = LOW;
    }
  }
  return motion;
}

