#include <LiquidCrystal.h>
int RS= 8, Enable = 9, D4= 4, D5=5, D6= 6, D7 =7;
LiquidCrystal lcd(RS, Enable, D4, D5, D6, D7);
int led = 11;
int led_value;
int percent;

void setup()
{
  pinMode(led, OUTPUT);
  lcd.begin(16,2);
  /*
  lcd.setCursor(5,0) ; // 0 = col; 1= row 
  lcd.print("hello");
  lcd.setCursor(5,1);
  lcd.print("world");
  */
  
}

void loop()
{
  led_value = analogRead(A0);
  led_value = map(led_value,0,1023,0,255);
//  percent = (int) (led_value/2.55f);
  percent = map(led_value, 0,255,0,100);
  analogWrite(led, led_value);
  lcd.setCursor(5,0);
  lcd.print(percent);
  
}