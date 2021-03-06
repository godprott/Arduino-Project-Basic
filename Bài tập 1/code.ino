#include <LiquidCrystal.h>  // thư viên cho led 16x2
int trig = 12, echo = 11;
int led1 = 10;
int led2 = 13;

int RS =8;
int Enable = 9;
int D4=4,D5=5,D6=6,D7=7;
int led_value,percent;

LiquidCrystal lcd(RS,Enable,D4,D5,D6,D7);  //khởi tạo

unsigned long previousMillis = 0;
int led1s = LOW;
int led2s = HIGH;


void setup()
{
   lcd.begin(16,2);
  pinMode(trig,OUTPUT);
  pinMode(echo,INPUT);
  pinMode(led1, OUTPUT);
  pinMode(led2, OUTPUT);
  Serial.begin(9600);
  lcd.print("Kcach: ");
  lcd.setCursor(13,0);
  lcd.print(" cm");
}
float distance(){
  digitalWrite(trig, HIGH);
  delayMicroseconds(5);
  digitalWrite(trig,LOW);
  int timer = pulseIn(echo, HIGH);
  return timer/58.3f; 
 
}

void loop()
{
  float x = distance();
  Serial.println(x);
  lcd.setCursor(7,0);
 
  lcd.print("       ");  //đè khoảng trắng vì khi 1 kí tự đã vẽ lên thì nó ko tự xóa đi trong lần loop sau
  lcd.setCursor(7,0);
  lcd.print(x);
  
  if(x<50)
  {
  	lcd.setCursor(0,1);
    lcd.print("Canh bao");
  }
  else
  {
  	lcd.setCursor(0,1);
    lcd.print("        ");
  }
  //delay(1000);
  
  unsigned long currentMillis = millis();
  /*millis() có nhiệm vụ trả về một số - là thời gian
  (tính theo mili giây) 
  kể từ lúc mạch Arduino bắt đầu chương trình của bạn. 
  Nó sẽ tràn số và quay số 0 (sau đó tiếp tục tăng) sau 50 ngày.
*/
  if (currentMillis - previousMillis >= 1000) {
    // save the last time you blinked the LED
    previousMillis = currentMillis;

    // if the LED is off turn it on and vice-versa:
    if (led1s == LOW) {
      led1s = HIGH;
      led2s = LOW;
    } else {
       led2s = HIGH;
      led1s = LOW;
    }

    // set the LED with the ledState of the variable:
    digitalWrite(led1, led1s);
    digitalWrite(led2, led2s);
  } 
 
}
  
