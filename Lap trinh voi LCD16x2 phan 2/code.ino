#include <LiquidCrystal.h>  // thư viên cho led 16x2

int RS =8;
int Enable = 9;
int D4=4,D5=5,D6=6,D7=7;
int led_value,percent;

LiquidCrystal lcd(RS,Enable,D4,D5,D6,D7);  //khởi tạo


void setup()
{/*
  lcd.begin(16,2);  //Khởi tạo màn hình LCD và chỉ định kích thước (chiều rộng và chiều cao) của màn hình. 
  					//begin()cần được gọi trước bất kỳ lệnh thư viện LCD nào khác.
  
  lcd.setCursor(4,0);  // đặt con trỏ (cột,hàng), mặc định ở đầu  
  lcd.print("hello");*/
  
  pinMode(13,OUTPUT);
}

void loop()
{
 	led_value = analogRead(A0); 
    led_value = map(led_value,0,1023,0,255);
  percent = (int)(led_value/2.55);
  lcd.setCursor(5,0);
  lcd.print(percent);
}



//R/W noi đất nghia la cho phep ghi (low) nếu là high thì là đọc 

//chan V0 dieu khien do tuong phan man hinh

// LED anode va canode dieu khien den đèn nền
//anode chân dương, canode chân âm

//co 8 chan DB, ko nhat thiet phai nối het, chi can 4 chan la du
// do ng ta lap trinh cac hàm sd như vậy

//Enable Cho phép ghi vào LCD

//Register Select (RS): điều khiển địa chỉ nào sẽ được ghi dữ liệu

//vcc nối nguồn gnd đất




