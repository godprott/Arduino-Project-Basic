int red = 11;
int blue = 10;
int green = 9;
int val1,val3,val2;
void setup() {
  pinMode(red,OUTPUT);
   pinMode(blue,OUTPUT);
   pinMode(green,OUTPUT);
}

void loop() {
  val1 = analogRead(A0);
  val1 = map(val1, 0, 1023, 0, 255); //doi so trong khoang tu 0-1023 sang khoang 0-255
  analogWrite(red,val1);
  
  val2 = analogRead(A2);
  val2 = map(val2, 0, 1023, 0, 255);
  analogWrite(blue,val2);
  
  val3 = analogRead(A4);
  val3 = map(val3, 0, 1023, 0, 255);
  analogWrite(green,val3);
  
  
  
}
 