int button_pin = 7;
int led = 12;
int previous = 1;
int current ;
int count = 0;
void setup()
{
  pinMode(led, OUTPUT);
  pinMode(button_pin, INPUT_PULLUP);
}

void loop()
{
  current = digitalRead(button_pin);
  if(current == HIGH && previous == LOW){
    count = count + 1; 
  }
  previous = current;
  if(count % 2 ==0 ) digitalWrite(led, LOW);
  else digitalWrite(led, HIGH);
}

/*
chân 7 đặt là INPUT_PULLUP khi đó nó ko nhận điện như chân INPUT
mà nó truyền điện đi đồng thời kèm theo 1 trở có sẵn đễ ngăn việc 
ngắn mạch (gây nổ vì ko có trở) 
và mạch sẽ nhận dc tín hiệu ở chân GND

*/