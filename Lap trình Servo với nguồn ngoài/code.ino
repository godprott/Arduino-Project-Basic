#include <Servo.h>

Servo abc;
int y=-1;
void setup()
{
  abc.attach(13);  //chân
  Serial.begin(9600);
}

void loop()
{
 
 //nguồn ngoài fai có đất nối chung vs arduino nếu ko servo khong chạy 
  
  int x = analogRead(A0);
  x = map(x,0,1023,0,180);
  if(y!=x)
  abc.write(x);
  y = x;
  
}