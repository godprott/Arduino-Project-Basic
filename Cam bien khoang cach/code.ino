#define SIGNAL_PIN 8
void setup()
{
  Serial.begin(9600);
  pinMode(SIGNAL_PIN, INPUT);
  pinMode(9, OUTPUT);
}
void loop() {
  if(digitalRead(SIGNAL_PIN)==HIGH) {
    digitalWrite(9, HIGH);
    Serial.println("ok");
  } else {
    digitalWrite(9, LOW);
    Serial.println("no");
  }
  delay(1000);
 
}