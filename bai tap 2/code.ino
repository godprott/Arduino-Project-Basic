// 2 den nhap nhay va 1 den bat tat

//c1:
/*
unsigned long previousMillis = 0;
int led1s = LOW;
int led2s = HIGH;

int previous_button = 0 ; 
int current_button ;
int count = 0;
int stateLED = LOW;


void setup()
{
  pinMode(13, OUTPUT);
  pinMode(12, OUTPUT);
  pinMode(11, OUTPUT);
  pinMode(2, INPUT);
}

void loop()
{
   unsigned long currentMillis = millis();
  if (currentMillis - previousMillis >= 1000) {
    previousMillis = currentMillis;
    if (led1s == LOW) {
      led1s = HIGH;
      led2s = LOW;
    } else {
       led2s = HIGH;
      led1s = LOW;
    }
    digitalWrite(13, led1s);
    digitalWrite(12, led2s);
    }
    
    current_button = digitalRead(2);
  if(current_button == LOW && previous_button == HIGH){
    if(stateLED == HIGH){
      stateLED = LOW; 
    } else {
       stateLED = HIGH; 
    }
  }
  previous_button = current_button;
 
    digitalWrite(11, stateLED);
}*/



//c2: dung interrupt - chi su dung interrupt dc pin 2, 3 trong uno R3
// ko su dung dc ham delay trong interrupt
//attachInterrupt(interrupt, ISR, mode);
/*
interrupt: chân pin
ISR: tên hàm sẽ gọi khi có sự kiện ngắt được sinh ra.

mode: kiểu kích hoạt ngắt, bao gồm

LOW: kích hoạt liên tục khi trạng thái chân digital có mức thấp
HIGH: kích hoạt liên tục khi trạng thái chân digital có mức cao.
RISING: kích hoạt khi trạng thái của chân digital chuyển từ mức điện áp thấp sang mức điện áp cao.
FALLING: kích hoạt khi trạng thái của chân digital chuyển từ mức điện áp cao sang mức điện áp thấp.
*/
boolean check = false;
void setup()
{
  pinMode(13, OUTPUT);
  pinMode(12, OUTPUT);
  pinMode(11, OUTPUT);
  pinMode(2, INPUT);
  attachInterrupt(digitalPinToInterrupt(2),chay,FALLING);

}


void chay()
{
	if(!check)
    {
    	digitalWrite(11,HIGH);
        check = true;
    }
  else
  {
  		digitalWrite(11,LOW);
        check = false;
  }
}

void loop()
{
	digitalWrite(13,HIGH);
  digitalWrite(12,LOW);
 delay(1000);
  digitalWrite(12,HIGH);
  digitalWrite(13,LOW);
  delay(1000);
 
  // ham interrupt dc uu tien cao hon delay,
  //do do khi delay cx ko ngan dc interrupt dc goi
  //co the coi interrupt dc chay tren 1 luồng khac

}


//c3 : timerOne hoac RTOS




















