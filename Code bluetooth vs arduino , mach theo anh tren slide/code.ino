#include<SoftwareSerial.h>
#include <string.h>
    int Rx = 3, Tx = 2;
    SoftwareSerial bluetooth(Rx, Tx);
    int led1 = 11;
    int led2 = 10;
    int led3 = 6;
    int led4 = 5;
    String cmd;

	 String pin;
     String dosang;
     int dosangint;

    
    void setup() {
      // khai bao Serial Monitor
      Serial.begin(57600);   //Arduino vs PC
      bluetooth.begin(9600);  // Arduino vs Bluetooth
      pinMode(led1, OUTPUT);
      pinMode(led2, OUTPUT);
      pinMode(led3, OUTPUT);
      pinMode(led4, OUTPUT);
    }

    void loop() {
      
      cmd=""; //xoa cmd sau moi vong lap
      while(bluetooth.available() > 0){
        char c = bluetooth.read();
        cmd = cmd + c;
      }
      

     dosang = cmd.substring(2,5);
     dosangint = dosang.toInt();
   
      if(cmd.length()>0) Serial.println(cmd); //neu ko, no se in khoang trang lien tuc khien ta ko xem dc ban tin co den dc serial monitor hay k
      if(cmd.substring(0,1) == "1") analogWrite(led1, dosangint);
      if(cmd.substring(0,1) == "2") analogWrite(led2, dosangint);
      if(cmd.substring(0,1) == "3") analogWrite(led3, dosangint);
      if(cmd.substring(0,1) == "4") analogWrite(led4, dosangint);
    }