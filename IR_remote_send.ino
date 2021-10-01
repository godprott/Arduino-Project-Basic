#include <Arduino.h>
#include <IRremoteESP8266.h>
#include <IRsend.h>

const uint16_t kIrLed = 4;  // ESP8266 GPIO pin to use. Recommended: 4 (D2).

IRsend irsend(kIrLed);  // Set the GPIO to be used to sending the message.


void setup() {
  irsend.begin();
  Serial.begin(9600);
}

void loop() {
  Serial.println("SEND");
  irsend.sendSAMSUNG(0xE0E040BF,32);  // 32 bits
  delay(5000);
}
