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
  /*
  abc.write(0); // 0 là góc 0 độ
  delay(1000);
  abc.write(90); //hướng quay của servo tự nó quyết định, nó tìm cách quay đến gần nhất
  delay(1000);
  abc.write(180);
  delay(1000);
  
  Serial.println(abc.read());// doc goc quay hien tai
  */
  
  int x = analogRead(A0);
  x = map(x,0,1023,0,180);
  if(y!=x)
  abc.write(x);
  y = x;
  
}